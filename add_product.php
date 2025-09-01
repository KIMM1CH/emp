<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $details = $_POST["details"];

    // ---- จัดการกับไฟล์ภาพแบบไม่ตรวจสอบ ----
    $image_name = "";
    if (isset($_FILES["image"])) {
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $image_name = uniqid("img_") . "." . $ext;
        $target_dir = "product_image/";
        $target_path = $target_dir . $image_name;

        // สร้างโฟลเดอร์หากยังไม่มี
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0775, true);
        }

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_path);
    }

    // ---- บันทึกลงฐานข้อมูล ----
    $sql = "INSERT INTO product (product_id, product_name, price, details, image)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("เตรียมคำสั่ง SQL ไม่สำเร็จ: " . $conn->error);
    }

    $stmt->bind_param("ssdss", $product_id, $product_name, $price, $details, $image_name);

    if ($stmt->execute()) {
        echo "<script>alert('บันทึกสินค้าเรียบร้อย'); window.location.href='add_product_form.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ไม่อนุญาตให้เข้าถึงโดยตรง";
}
?>
