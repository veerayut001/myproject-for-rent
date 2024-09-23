<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูล
$servername = "localhost";  // ชื่อเซิร์ฟเวอร์
$username = "root";         // ชื่อผู้ใช้ MySQL
$password = "";             // รหัสผ่าน (ถ้าไม่มีให้ใส่เป็นช่องว่าง)
$dbname = "for rent";     // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
