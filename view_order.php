<?php
session_start();
include "connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit;
}

$customer_id = $_SESSION['username'];

if (!isset($_GET['order_id'])) {
    echo "<p>ไม่พบรหัสคำสั่งซื้อ</p>";
    exit;
}

$order_id = intval($_GET['order_id']);

// ดึงข้อมูลคำสั่งซื้อ
$sql_order = "SELECT * FROM orders WHERE order_id=? AND customer_id=?";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("is", $order_id, $customer_id);
$stmt->execute();
$result_order = $stmt->get_result();
$order = $result_order->fetch_assoc();

if (!$order) {
    echo "<p>ไม่พบคำสั่งซื้อนี้</p>";
    exit;
}

// ดึงชื่อลูกค้า
$sql_customer = "SELECT name FROM customer WHERE username=?";
$stmt_customer = $conn->prepare($sql_customer);
$stmt_customer->bind_param("s", $customer_id);
$stmt_customer->execute();
$result_customer = $stmt_customer->get_result();
$customer = $result_customer->fetch_assoc();

// ดึงรายละเอียดสินค้า
$sql_detail = "SELECT * FROM order_details WHERE order_id=?";
$stmt_detail = $conn->prepare($sql_detail);
$stmt_detail->bind_param("i", $order_id);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>รายละเอียดคำสั่งซื้อ #<?= $order['order_id'] ?></title>
<style>
body { 
    background:#111; 
    color:#fff; 
    font-family:Arial; 
    display:flex; 
    justify-content:center; 
    padding:30px 0; 
    margin:0;
}
.container { width:100%; max-width:700px; }
h1 { text-align:center; margin-bottom:20px; }
table { width:100%; border-collapse:collapse; margin-bottom:15px; }
table th, table td { border:1px solid #333; padding:10px; text-align:center; }
table th { background:#222; }
.total-box { background:#222; padding:12px; border-radius:8px; margin-bottom:20px; font-weight:bold; text-align:right; }
.button { 
    padding:12px; 
    border:none; 
    border-radius:5px; 
    color:#fff; 
    cursor:pointer; 
    width:100%; 
    max-width:200px; 
    display:block; 
    margin:0 auto; 
    text-align:center;
    background:#28a745;
    text-decoration:none;
}
.button:hover { background:#218838; }
.info-box { background:#1a1a1a; padding:15px; border-radius:8px; margin-bottom:20px; }
.info-box p { margin:5px 0; }
</style>
</head>
<body>
<div class="container">
    <h1>รายละเอียดคำสั่งซื้อ #<?= $order['order_id'] ?></h1>

    <div class="info-box">
        <p><strong>ชื่อลูกค้า:</strong> <?= htmlspecialchars($customer['name']) ?></p>
        <p><strong>วันที่สั่งซื้อ:</strong> <?= $order['order_date'] ?></p>
        <p><strong>วิธีชำระเงิน:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
        <p><strong>ที่อยู่จัดส่ง:</strong><br><?= nl2br(htmlspecialchars($order['shipping_address'])) ?></p>
    </div>

    <table>
        <tr>
            <th>สินค้า</th>
            <th>จำนวน</th>
            <th>ราคา/ชิ้น</th>
            <th>รวม</th>
        </tr>
        <?php while($item = $result_detail->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($item['product_name']) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= number_format($item['price'],2) ?></td>
            <td><?= number_format($item['price'] * $item['quantity'],2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="total-box">
        ราคารวมทั้งหมด: <?= number_format($order['total_price'],2) ?> บาท
    </div>

    <a href="show_allProduct.php" class="button">กลับไปเลือกสินค้า</a>
</div>
</body>
</html>
