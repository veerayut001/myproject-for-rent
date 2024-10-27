<?php
session_start();
include 'c_db_connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $index = $data['index'];

    // ตรวจสอบว่าเซสชันการจองมีอยู่หรือไม่
    if (isset($_SESSION['reservations']) && isset($_SESSION['reservations'][$index])) {
        // รับชื่อพื้นที่ที่ต้องการยกเลิก
        $title = $_SESSION['reservations'][$index]['title'];

        // ลบการจองที่ระบุจากเซสชัน
        unset($_SESSION['reservations'][$index]);

        // รีเซ็ตดัชนีเพื่อให้สอดคล้องกัน
        $_SESSION['reservations'] = array_values($_SESSION['reservations']); // รีเซ็ตดัชนี

        // อัปเดตสถานะในฐานข้อมูลให้กลับเป็น 'ว่าง'
        $updateSql = "UPDATE rental_space SET status = 'ว่าง' WHERE title = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $title);
        $updateStmt->execute();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit();
}
?>
