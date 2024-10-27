<?php
session_start();
include 'c_db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['selectedSpaces'])) {
        // คิวรีข้อมูลจากฐานข้อมูลตามพื้นที่ที่จอง
        $selectedSpaces = implode(',', array_fill(0, count($data['selectedSpaces']), '?'));
        $sql = "SELECT title, price, description FROM rental_space WHERE id IN ($selectedSpaces)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('i', count($data['selectedSpaces'])), ...$data['selectedSpaces']);
        $stmt->execute();
        $result = $stmt->get_result();

        // เก็บข้อมูลการจองในเซสชัน
        $_SESSION['reservations'] = $result->fetch_all(MYSQLI_ASSOC);
        
        echo json_encode(['reservations' => $_SESSION['reservations']]);
    }
}
?>
