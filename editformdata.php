<?php
header('Content-Type: text/html; charset=UTF-8');

require('dbconnect.php');

$emp_id = $_GET["emp_id"];

$sql = "SELECT * FROM employee WHERE emp_id=$emp_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <title>แก้ไขข้อมูลพนักงาน</title>
</head>

<body>
  <div class="container my-3">
    <h2 class="text-left">แก้ไขข้อมูลพนักงาน</h2>
    <hr>
    <form action="updatedata.php" method="POST">
      <input type="hidden" value="<?php echo $row["emp_id"]; ?>" name="emp_id">
      <div class="form-group col-6">
        <label for="emp_title">คำนำหน้า :</label>
        <select name="emp_title" class="form-control" required>
          <option value="นาย" <?php if ($row["emp_title"] == "นาย") {
                                echo "SELECTED";
                              } ?>>นาย</option>
          <option value="นาง" <?php if ($row["emp_title"] == "นาง") {
                                echo "SELECTED";
                              } ?>>นาง</option>
          <option value="นางสาว" <?php if ($row["emp_title"] == "นางสาว") {
                                    echo "SELECTED";
                                  } ?>>นางสาว</option>
        </select>
        <div>
          <div class="form-group">
            <label for="emp_name">ชื่อ :</label>
            <input type="text" name="emp_name" class="form-control" value="<?php echo $row["emp_name"]; ?>">
          </div>
          <div class="form-group">
            <label for="emp_surname">นามสกุล :</label>
            <input type="text" name="emp_surname" class="form-control" value="<?php echo $row["emp_surname"]; ?>">
          </div>
          <div class="form-group">
            <label for="emp_birthday">วันเดือนปีเกิด :</label>
            <input type="date" name="emp_birthday" class="form-control" value="<?php echo $row["emp_birthday"]; ?>">
          </div>
          <div class="form-group">
            <label for="emp_adr">ที่อยู่ปัจจุบัน :</label>
            <textarea name="emp_adr" class="form-control"><?php echo $row["emp_adr"]; ?></textarea>
          </div>
          <div class="form-group">
            <label for="emp_skill">ทักษะความสามารถ :</label>
            <textarea name="emp_skill" class="form-control"><?php echo $row["emp_skill"]; ?></textarea>
          </div>
          <div class="form-group">
            <label for="emp_tel">เบอร์โทรศัพท์ :</label>
            <input type="tel" name="emp_tel" class="form-control" value="<?php echo $row["emp_tel"]; ?>">
          </div>
          <div class="my-3">
            <input type="submit" value="แก้ไขข้อมูล" class="btn btn-success">
            <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
            <a href="index.php" class="btn btn-primary">กลับหน้าแรก</a>
          </div>
    </form>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>