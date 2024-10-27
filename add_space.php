<?php
include 'c_db_connect.php'; // รวมไฟล์การเชื่อมต่อ

// รับข้อมูลจากฟอร์ม
$title = $_POST['title'];
$price = $_POST['price'];
$status = 'available'; // ตั้งค่าสถานะเริ่มต้น
$description = $_POST['description'];
// ลบ $size ถ้าไม่จำเป็นต้องใช้

// สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูล
$sql = "INSERT INTO rental_space (title, price, status, description) VALUES (?, ?, ?, ?)";

// เตรียมคำสั่ง SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $title, $price, $status, $description);

// ประมวลผลคำสั่ง SQL
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>
