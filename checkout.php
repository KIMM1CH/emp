<?php
session_start();
include "connect.php";

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['username'])) {
    header("Location: login_form.php?redirect=checkout.php");
    exit;
}

$customer_id = $_SESSION['username']; // ใช้ username เป็น customer_id

// คำนวณราคารวม
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['qty'] * $item['price'];
    }
}

// บันทึกคำสั่งซื้อ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['cart'])) {
    $payment_method = $_POST['payment_method'];
    $shipping_address = $_POST['address'];

    $conn->begin_transaction();
    try {
        // INSERT ลง orders
        $sql_order = "INSERT INTO orders (customer_id, order_date, total_price, payment_method, shipping_address)
                      VALUES (?, NOW(), ?, ?, ?)";
        $stmt = $conn->prepare($sql_order);
        $stmt->bind_param("sdss", $customer_id, $total_price, $payment_method, $shipping_address);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        // INSERT รายละเอียดสินค้า
        foreach ($_SESSION['cart'] as $item) {
            $sql_detail = "INSERT INTO order_details (order_id, product_id, product_name, price, quantity)
                           VALUES (?, ?, ?, ?, ?)";
            $stmt_detail = $conn->prepare($sql_detail);
            $stmt_detail->bind_param("issdi", $order_id, $item['product_id'], $item['name'], $item['price'], $item['qty']);
            $stmt_detail->execute();
        }

        $conn->commit();
        unset($_SESSION['cart']);
        $success_order_id = $order_id; // เก็บ order_id สำหรับโมดัล
    } catch (Exception $e) {
        $conn->rollback();
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ยืนยันการสั่งซื้อ</title>
<style>
body { background:#111; color:#fff; font-family:Arial; display:flex; justify-content:center; align-items:flex-start; min-height:100vh; margin:0; padding:30px; }
.container { width:100%; max-width:700px; }
h1 { text-align:center; margin-bottom:20px; }
table { width:100%; border-collapse:collapse; margin-bottom:15px; }
table th, table td { border:1px solid #333; padding:10px; text-align:center; }
table th { background:#222; }
.total-box { background:#222; padding:12px; border-radius:8px; margin-bottom:20px; font-weight:bold; text-align:right; }
form { background:#1a1a1a; padding:20px; border-radius:10px; }
label { display:block; margin-bottom:6px; }
input, textarea, select { width:100%; padding:10px; margin-bottom:15px; border:none; border-radius:5px; background:#2a2a2a; color:#fff; }
.btn-group { display:flex; justify-content:space-between; gap:10px; }
.btn-back, .btn-submit { padding:12px; border:none; border-radius:5px; color:#fff; cursor:pointer; flex:1; }
.btn-back { background:#444; }
.btn-submit { background:#28a745; }
.btn-back:hover { background:#666; }
.btn-submit:hover { background:#218838; }

/* โมดัล */
.modal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); justify-content:center; align-items:center; z-index:10; }
.modal-content { background:#1a1a1a; padding:30px; border-radius:10px; text-align:center; max-width:400px; width:90%; }
.modal-content p { margin-bottom:20px; font-size:16px; }
.modal-content .modal-btn { padding:12px 20px; border:none; border-radius:5px; color:#fff; cursor:pointer; margin:5px; }
.view-btn { background:#28a745; }
.view-btn:hover { background:#218838; }
.continue-btn { background:#444; }
.continue-btn:hover { background:#666; }

.message { text-align:center; padding:20px; background:#222; border-radius:8px; }
</style>
</head>
<body>
<div class="container">
    <h1>ยืนยันการสั่งซื้อ</h1>

    <?php if (empty($_SESSION['cart']) && !isset($success_order_id)): ?>
        <div class="message">
            <p>ตะกร้าสินค้าว่าง กรุณาเลือกสินค้าก่อนทำรายการสั่งซื้อ</p>
            <button class="btn-back" onclick="window.location.href='show_allProduct.php'">เลือกสินค้าต่อ</button>
        </div>
    <?php else: ?>
        <?php if (!isset($success_order_id)): ?>
            <table>
                <tr>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา/ชิ้น</th>
                    <th>รวม</th>
                </tr>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= number_format($item['price'], 2) ?></td>
                        <td><?= number_format($item['qty'] * $item['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="total-box">
                ราคารวมทั้งหมด: <?= number_format($total_price, 2) ?> บาท
            </div>

            <form method="post">
                <label>วิธีชำระเงิน:</label>
                <select name="payment_method" required>
                    <option value="โอนเงิน">โอนเงิน</option>
                    <option value="เก็บเงินปลายทาง">เก็บเงินปลายทาง</option>
                    <option value="บัตรเครดิต">บัตรเครดิต</option>
                </select>

                <label>ที่อยู่จัดส่ง:</label>
                <textarea name="address" rows="3" required></textarea>

                <div class="btn-group">
                    <button type="button" class="btn-back" onclick="window.location.href='show_allProduct.php'">กลับไปเลือกสินค้า</button>
                    <button type="submit" class="btn-submit">ยืนยันการสั่งซื้อ</button>
                </div>
            </form>
        <?php else: ?>
            <!-- โมดัลแสดงหลังสั่งซื้อสำเร็จ -->
            <div class="modal" id="successModal">
                <div class="modal-content">
                    <p>บันทึกการสั่งซื้อเรียบร้อย!</p>
                    <button class="modal-btn view-btn" onclick="window.location.href='view_order.php?order_id=<?= $success_order_id ?>'">ดูรายละเอียดคำสั่งซื้อ</button>
                    <button class="modal-btn continue-btn" onclick="window.location.href='show_allProduct.php'">เลือกสินค้าต่อ</button>
                </div>
            </div>

            <script>
                document.getElementById('successModal').style.display = 'flex';
            </script>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
