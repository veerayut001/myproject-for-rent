<?php
session_start();
include 'c_db_connect.php'; // เชื่อมต่อกับฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $index = $data['index'] ?? null;

    if ($index !== null && isset($_SESSION['reservations'][$index])) {
        // เก็บชื่อพื้นที่ที่ต้องการยกเลิก
        $reservation = $_SESSION['reservations'][$index];
        $reservationTitle = $reservation['title'];

        // ลบการจองจากเซสชัน
        unset($_SESSION['reservations'][$index]);
        $_SESSION['reservations'] = array_values($_SESSION['reservations']); // รีเซ็ตค่า array

        // อัปเดตสถานะกลับเป็น "ว่าง" ในฐานข้อมูล
        $updateSql = "UPDATE rental_space SET status = 'ว่าง' WHERE title = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $reservationTitle);
        $updateStmt->execute();
        
        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid reservation index']);
        exit();
    }
}
