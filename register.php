<?php
// 3. รับค่าจากฟอร์ม
$username = $_POST['username'];
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน
$password = $_POST['password'];
$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$address  = $_POST['address'];

include "connect.php";

// 4. เตรียมคำสั่ง SQL และ bind parameter (ปลอดภัยจาก SQL Injection)
$stmt = $conn->prepare("INSERT INTO customer (username, password, name, email, phone, address) 
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $username, $password, $name, $email, $phone, $address);

// 5. รันคำสั่ง SQL
if ($stmt->execute()) {
    echo "<h1>สมัครสมาชิกสำเร็จ!</h2><a href='register_form.php'> ย้อนกลับ</a>";
} else {
    echo "<h2>เกิดข้อผิดพลาด: " . $stmt->error . "</h2><a href='register_form.php'> ลองใหม่อีกครั้ง</a>";
}

// 6. ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>