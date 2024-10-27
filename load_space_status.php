<?php
session_start();
include 'c_db_connect.php';

// ดึงข้อมูลพื้นที่ทั้งหมด
$query = "SELECT title, status FROM rental_space";
$result = $conn->query($query);

$spaces = [];
while ($row = $result->fetch_assoc()) {
    $spaces[] = $row;
}

echo json_encode($spaces); // ส่งคืนข้อมูลสถานะพื้นที่ในรูปแบบ JSON
