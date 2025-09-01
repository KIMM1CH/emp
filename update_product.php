<?php
include "connect.php";

$product_id = $_POST['product_id'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$details = $_POST['details'] ?? '';
$new_image = $_FILES['image']['name'] ?? '';

// ดึงชื่อไฟล์เดิม
$stmt = $conn->prepare("SELECT image FROM product WHERE product_id = ?");
$stmt->bind_param("s", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$old_image = $row['image'];

// ถ้ามีการอัปโหลดรูปใหม่
if (!empty($new_image)) {
    $target_dir = "product_image/";
    $new_file = uniqid() . "_" . basename($new_image);
    $target_file = $target_dir . $new_file;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // ลบรูปเก่า
        if (!empty($old_image) && file_exists($target_dir . $old_image)) {
            unlink($target_dir . $old_image);
        }
        $image_to_save = $new_file;
    } else {
        echo "อัปโหลดรูปใหม่ไม่สำเร็จ";
        exit;
    }
} else {
    $image_to_save = $old_image;
}

// อัปเดตข้อมูล
$update = $conn->prepare("UPDATE product SET product_name=?, details=?, image=? WHERE product_id=?");
$update->bind_param("ssss", $product_name, $details, $image_to_save, $product_id);

if ($update->execute()) {
    echo "<script>alert('แก้ไขสำเร็จ'); window.location.href='show_product.php?product_id=$product_id';</script>";
} else {
    echo "เกิดข้อผิดพลาด: " . $update->error;
}
?>
