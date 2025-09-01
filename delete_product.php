<?php
include "connect.php";

$product_id = $_GET['product_id'] ?? '';

if ($product_id == '') {
    echo "ไม่พบรหัสสินค้า";
    exit;
}

// ดึงชื่อไฟล์ภาพก่อนลบ
$stmt = $conn->prepare("SELECT image FROM product WHERE product_id = ?");
$stmt->bind_param("s", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบสินค้าที่ต้องการลบ";
    exit;
}

$row = $result->fetch_assoc();
$imageFile = $row['image'];

// ลบข้อมูลสินค้า
$deleteStmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
$deleteStmt->bind_param("s", $product_id);

if ($deleteStmt->execute()) {
    // ลบไฟล์ภาพถ้ามี
    if (!empty($imageFile) && file_exists("product_image/" . $imageFile)) {
        unlink("product_image/" . $imageFile);
    }
    echo "<script>alert('ลบสินค้าสำเร็จ'); window.location.href='product_list.php';</script>";
} else {
    echo "เกิดข้อผิดพลาดในการลบ: " . $deleteStmt->error;
}
?>
