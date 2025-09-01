<?php
session_start();
include "connect.php";
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แสดงสินค้าทั้งหมด</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
            background: #121212; 
            color: #f5f5f5; 
            position: relative;
        }
        h1 { margin-bottom: 20px; color: #f5f5f5; }

        /* ปุ่มกลับหน้าโปรไฟล์แบบลอยมุมขวาบน */
        .btn-profile {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745; /* สีเขียวเหมือนปุ่มหยิบใส่ตะกร้า */
            color: #fff;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.5);
            transition: background 0.2s;
            z-index: 1000;
        }
        .btn-profile:hover { background: #218838; }

        /* คอนเทนเนอร์ใหญ่ */
        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
        }

        /* กล่องสินค้า */
        .product {
            border: 1px solid #333;
            background: #1e1e1e;
            padding: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 380px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.5);
        }

        .product img { 
            width: 150px; 
            height: 150px; 
            object-fit: contain;
            margin: 0 auto;
        }

        .product strong {
            display: block;
            min-height: 40px;
            margin: 10px 0 5px 0;
            overflow: hidden;
            color: #fff;
        }

        .product .details {
            font-size: 13px;
            color: #ccc;
            height: 60px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .btn { 
            background: #28a745; 
            color: #fff; 
            padding: 8px; 
            text-decoration: none; 
            display: inline-block; 
            margin-top: 10px; 
            border-radius: 4px;
            transition: background 0.2s;
        }

        .btn:hover { background: #218838; }
    </style>
</head>
<body>
    <h1>รายการสินค้าทั้งหมด</h1>

    <!-- ปุ่มกลับไปหน้าโปรไฟล์ แบบลอย -->
    <a href="show_profile.php" class="btn-profile">กลับไปหน้าโปรไฟล์</a>

    <div class="products-container">
<?php
$sql = "SELECT product_id, product_name, price, image, details FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
        <div class="product">
            <img src="product_image/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">
            <strong><?php echo $row['product_name']; ?></strong>
            <div class="details"><?php echo htmlspecialchars($row['details']); ?></div>
            <div>
                ราคา: <?php echo number_format($row['price'], 2); ?> บาท<br>
                <a class="btn" href="cart.php?action=add&id=<?php echo $row['product_id']; ?>">หยิบใส่ตะกร้า</a>
            </div>
        </div>
<?php
    }
} else {
    echo "ไม่มีสินค้าในระบบ";
}
?>
    </div>

</body>
</html>
