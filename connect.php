<?php
$host = "localhost";         // ชื่อโฮสต์
$user = "root";          // ชื่อผู้ใช้ MySQL (เปลี่ยนถ้าคุณตั้งค่าผู้ใช้อื่นไว้)
$pass = "";              // รหัสผ่านของผู้ใช้ MySQL
$database = "kimm1ch";       // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($host, $user, $pass, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

//echo "เชื่อมต่อฐานข้อมูลสำเร็จ!";
?>
