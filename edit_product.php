<?php
include "connect.php";

$product_id = $_GET['product_id'] ?? '';

if ($product_id == '') {
    echo "ไม่พบรหัสสินค้า";
    exit;
}

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
$stmt->bind_param("s", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบสินค้าที่ระบุ";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสินค้า</title>
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
        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: none;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #ffcc00;
            color: #121212;
            border: none;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e6b800;
        }
        img {
            max-width: 200px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>แก้ไขสินค้า</h1>
    <form action="update_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']); ?>">

        <label for="product_name">ชื่อสินค้า</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" required>

        <label for="details">รายละเอียดสินค้า</label>
        <textarea name="details" rows="4" required><?= htmlspecialchars($product['details']); ?></textarea>

        <label>รูปภาพปัจจุบัน:</label>
        <?php if (!empty($product['image'])): ?>
            <img src="product_image/<?= htmlspecialchars($product['image']); ?>" alt="รูปสินค้า">
        <?php else: ?>
            <p>ไม่มีรูปภาพ</p>
        <?php endif; ?>

        <label for="image">อัปโหลดรูปใหม่ (ถ้าต้องการเปลี่ยน)</label>
        <input type="file" name="image">

        <button type="submit">บันทึกการแก้ไข</button>
    </form>
</body>
</html>
