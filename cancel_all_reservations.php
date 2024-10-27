<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีการจองในเซสชันหรือไม่
    if (isset($_SESSION['reservations'])) {
        // อัปเดตราคารวมให้เป็น 0
        $_SESSION['totalPrice'] = 0;

        // ลบการจองทั้งหมด
        unset($_SESSION['reservations']);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit();
}
?>
