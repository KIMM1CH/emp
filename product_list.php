<?php
include "connect.php";


$sql = "SELECT product_id, product_name FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการสินค้า</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #ffcc00;
            border-bottom: 2px solid #ffcc00;
            padding-bottom: 10px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #333;
            color: #ffcc00;
        }
        tr:hover {
            background-color: #2a2a2a;
        }
        
        td:first-child {
            color: #ffcc00;
            font-weight: bold;
        }
        a, button {
            display: inline-block;
            margin: 5px;
            padding: 6px 12px;
            text-decoration: none;
            color: #121212;
            background-color: #ffcc00;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        a:hover, button:hover {
            background-color: #ffffff;
        }
        
        .delete-btn {
            background-color: #ff4444;
            color: #fff;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
        
        .product-link {
            background: none;
            color: #ffcc00;
            font-weight: bold;
        }
        .product-link:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function confirmDelete(productId) {
            if (confirm("คุณแน่ใจว่าต้องการลบสินค้านี้?")) {
                window.location.href = "delete_product.php?product_id=" + productId;
            }
        }
    </script>
</head>
<body>
    <h1>รายการสินค้า</h1>
    <table>
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>การจัดการ</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['product_id']); ?></td>
            <td>
                <a href="show_product.php?product_id=<?= urlencode($row['product_id']); ?>" class="product-link">
                    <?= htmlspecialchars($row['product_name']); ?>
                </a>
            </td>
            <td>
                <a href="edit_product.php?product_id=<?= urlencode($row['product_id']); ?>">แก้ไข</a>
                <button class="delete-btn" onclick="confirmDelete('<?= $row['product_id']; ?>')">ลบ</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
