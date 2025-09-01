<?php
session_start();
include "connect.php";

// รับค่าจากฟอร์ม
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

print_r ($_POST) ;
// ป้องกัน SQL Injection (แบบเบื้องต้น)
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// ตรวจสอบในฐานข้อมูล
$sql = "SELECT * FROM customer WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Login ผ่าน
    $_SESSION['username'] = $username;
    $_SESSION['session_id'] = session_id();
    header("Location: show_profile.php");
    exit();
} else {
    // Login ไม่ผ่าน
   header("Location: login_form.php?error=1");

    
}

$conn->close();
?>
