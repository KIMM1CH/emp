<?php
session_start();
include "connect.php";

if (isset($_GET['action'])) {
    $productID = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

    if ($_GET['action'] == "add" && $productID != '') {
        $sql = "SELECT product_id, product_name, price FROM product WHERE product_id = '$productID'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            if (isset($_SESSION['cart'][$productID])) {
                $_SESSION['cart'][$productID]['qty'] += 1;
            } else {
                $_SESSION['cart'][$productID] = [
                    "product_id" => $product['product_id'],
                    "name" => $product['product_name'],
                    "price" => $product['price'],
                    "qty" => 1
                ];
            }
        }
    }
    if ($_GET['action'] == "decrease" && isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID]['qty'] -= 1;
        if ($_SESSION['cart'][$productID]['qty'] <= 0) {
            unset($_SESSION['cart'][$productID]);
        }
    }
    if ($_GET['action'] == "increase" && isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID]['qty'] += 1;
    }
    if ($_GET['action'] == "clear") {
        unset($_SESSION['cart']);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตะกร้าสินค้า</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            color: #f5f5f5;
            margin: 20px auto;
            max-width: 800px; /* ลดความกว้างคอนเทนเนอร์ */
        }
        h1 { color: #f5f5f5; margin-bottom: 20px; text-align:center; }

        /* ปุ่มกลับไปหน้าสินค้า */
        .back-btn {
            display: inline-block;
            padding: 6px 10px;
            background: #444;
            color: #f5f5f5;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 10px;
            transition: background 0.2s;
        }
        .back-btn:hover {
            background: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #1e1e1e;
            border-radius: 6px;
            overflow: hidden;
            font-size: 14px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background: #222;
            color: #f5f5f5;
        }
        td {
            color: #ddd;
        }

        .qty-btn {
            padding: 3px 6px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            border-radius: 3px;
            margin: 0 2px;
            transition: background 0.2s;
        }
        .qty-btn:hover {
            background: #0056b3;
        }

        /* ปุ่มด้านล่างตาราง */
        .cart-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }
        .clear-btn, .checkout-btn {
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .clear-btn {
            background: #dc3545;
            color: #fff;
        }
        .clear-btn:hover {
            background: #b52a37;
        }
        .checkout-btn {
            background: #28a745;
            color: #fff;
        }
        .checkout-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<h1>ตะกร้าสินค้า</h1>

<a href="show_allProduct.php" class="back-btn">กลับไปหน้าสินค้า</a>

<table>
    <tr>
        <th>ชื่อสินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>รวม</th>
    </tr>
<?php
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $sum = $item['price'] * $item['qty'];
        $total += $sum;
?>
    <tr>
        <td><?php echo htmlspecialchars($item['name']); ?></td>
        <td><?php echo number_format($item['price'], 2); ?> บาท</td>
        <td>
            <a class="qty-btn" href="cart.php?action=decrease&id=<?php echo $item['product_id']; ?>">-</a>
            <?php echo $item['qty']; ?>
            <a class="qty-btn" href="cart.php?action=increase&id=<?php echo $item['product_id']; ?>">+</a>
        </td>
        <td><?php echo number_format($sum, 2); ?> บาท</td>
    </tr>
<?php
    }
    echo "<tr><td colspan='3' align='right'><strong>รวมทั้งหมด:</strong></td><td>" . number_format($total, 2) . " บาท</td></tr>";
} else {
    echo "<tr><td colspan='4'>ไม่มีสินค้าในตะกร้า</td></tr>";
}
?>
</table>

<?php if (!empty($_SESSION['cart'])) { ?>
<div class="cart-footer">
    <a href="cart.php?action=clear" class="clear-btn">ล้างตะกร้า</a>
    <a href="checkout.php" class="checkout-btn">ยืนยันการสั่งซื้อ</a>
</div>
<?php } ?>
</body>
</html>
