<?php
session_start();

// ตรวจสอบว่าได้รับข้อมูลการจอง
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $selectedIds = $data['selectedIds'];

    // สมมติว่าโค้ดนี้ทำการบันทึกข้อมูลการจองเรียบร้อยแล้ว
    // ตั้งค่าสถานะในเซสชันเพื่อแสดงข้อมูลการจอง
    $_SESSION['has_reservation'] = true;

    // ส่งผลลัพธ์กลับไปยัง JavaScript
    echo json_encode(['success' => true]);
}
?>
