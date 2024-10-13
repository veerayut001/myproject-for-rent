<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/"; // โฟลเดอร์ที่ใช้เก็บไฟล์
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // ตรวจสอบว่าการอัพโหลดสำเร็จหรือไม่
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // เปลี่ยนเส้นทางไปยังฟอร์มพร้อมกับชื่อไฟล์
        header("Location: your_form_file.php?image=" . urlencode($_FILES["image"]["name"]));
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัพโหลดไฟล์.";
    }
}
?>
