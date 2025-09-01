<?php
include "check_session.php";

$sess_username = $_SESSION['username'];
$sess_id = $_SESSION['session_id'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลผู้ใช้</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
            width: 400px;
            position: relative; /* เพื่อให้ใช้ตำแหน่ง absolute ภายในได้ */
            min-height: 300px; /* ให้มีความสูงพอวางปุ่ม */
        }

        h1, h2 {
            text-align: center;
        }

        p {
            margin: 10px 0;
        }

        .logout-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #f61515;
            text-decoration: none;
            border: 1px solid #f61515;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #f61515;
            color: #ffffff;
        }

        /* ปุ่มไปหน้าสินค้า */
        .products-btn {
            position: absolute;
            bottom: 15px;
            right: 15px;
            color: #ffffff;
            text-decoration: none;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .products-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="logout.php" class="logout-btn">ออกจากระบบ</a>
    <h1>ข้อมูลผู้ใช้</h1>

    <?php
    include "connect.php";

    $sess_username = $_SESSION['username'];

    $sql = "SELECT * FROM customer WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sess_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>ชื่อ: " . htmlspecialchars($row['name']) . "</p>";
        echo "<p>อีเมล: " . htmlspecialchars($row['email']) . "</p>";
        echo "<p>เบอร์โทร: " . htmlspecialchars($row['phone']) . "</p>";
        echo "<p>ที่อยู่: " . htmlspecialchars($row['address']) . "</p>";
    } else {
        echo "<p>ไม่พบข้อมูลผู้ใช้</p>";
    }

    $stmt->close();
    $conn->close();
    ?>

    <!-- ✅ ปุ่มลิงก์ไปหน้าสินค้าทั้งหมด -->
    <a href="show_allProduct.php" class="products-btn">ดูสินค้าทั้งหมด</a>
</div>

</body>
</html>
