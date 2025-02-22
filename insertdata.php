<?php
header('Content-Type: text/html; charset=UTF-8');

//เชื่อมต่อฐานข้อมูล
require('dbconnect.php');

//รับค่าที่ส่งมาจากฟอร์ม
$emp_title = $_POST["emp_title"];
$emp_name = $_POST["emp_name"];
$emp_surname = $_POST["emp_surname"];
$emp_birthday = $_POST["emp_birthday"];
$emp_adr = $_POST["emp_adr"];
$emp_skill = $_POST["emp_skill"];
$emp_tel = $_POST["emp_tel"];
$emp_user = $_POST["emp_user"];
$emp_pass = md5($_POST["emp_pass"]);
$emp_level = $_POST["emp_level"];
//บันทึกข้อมูล
$sql = "INSERT INTO employee(emp_title,emp_name,emp_surname,emp_birthday,emp_adr,emp_skill,emp_tel,emp_user,emp_pass,emp_level) VALUE('$emp_title','$emp_name','$emp_surname','$emp_birthday','$emp_adr','$emp_skill','$emp_tel','$emp_user','$emp_pass','$emp_level')";

//รันคำสั่ง SQL
$result = mysqli_query($con, $sql);

//ตรวจสอบการทำงานของคำสั่ง Insert
if ($result) {
  header("location:index.php");
  exit(0);
} else {
  echo mysqli_error($con);
}
