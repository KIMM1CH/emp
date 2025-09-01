<?php
include "connect.php";

// รับค่าตัวแปร product_id จาก URL
$product_id = $_GET['product_id'] ?? '';

if ($product_id == '') {
    echo "ไม่พบรหัสสินค้า";
    exit;
}

// ใช้ Prepared Statement ป้องกัน SQL Injection
$stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
$stmt->bind_param("s", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบสินค้าที่ระบุ";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดสินค้า</title>
    <style>
        body {
            background-color: #121212;
            color: #FFD700; /* เปลี่ยนตัวอักษรทั้งหมดจากขาวเป็นทอง */
            font-family: 'Segoe UI', Tahoma, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #FFD700; 
            border-bottom: 2px solid #FFD700; /* ใช้ทองให้เข้ากัน */
            padding-bottom: 10px;
        }
        .product-container {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        img {
            display: block;
            margin: 10px auto;
            border-radius: 10px;
        }
        a, button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            text-decoration: none;
            color: #121212;
            background-color: #ffcc00;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        a:hover, button:hover {
            background-color: #e6b800;
        }
        .delete-btn {
            background-color: #ff4444;
            color: #fff;
        }
        .delete-btn:hover {
            background-color: #cc0000;
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
    <div class="product-container">
        <h1>รายละเอียดสินค้า</h1>
        <p><strong>รหัสสินค้า:</strong> <?= htmlspecialchars($row['product_id']); ?></p>
        <p><strong>ชื่อสินค้า:</strong> <?= htmlspecialchars($row['product_name']); ?></p>
        <p><strong>รายละเอียด:</strong> <?= nl2br(htmlspecialchars($row['details'])); ?></p>

        <?php if (!empty($row['image'])): ?>
            <img src="product_image/<?= htmlspecialchars($row['image']); ?>" alt="รูปสินค้า" style="max-width:300px;">
        <?php else: ?>
            <p>ไม่มีรูปสินค้า</p>
        <?php endif; ?>

        <br>
        <a href="product_list.php">กลับไปหน้ารายการสินค้า</a>
    </div>
</body>
</html>
