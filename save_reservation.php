<?php
session_start();
include 'c_db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $selectedSpaces = $data['selectedSpaces'];

    if (!isset($_SESSION['reservations'])) {
        $_SESSION['reservations'] = [];
        $_SESSION['totalPrice'] = 0; // เริ่มต้นราคาทั้งหมด
    }

    $placeholders = implode(',', array_fill(0, count($selectedSpaces), '?'));
    $sql = "SELECT title, price, description FROM rental_space WHERE title IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($selectedSpaces)), ...$selectedSpaces);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['title'], array_column($_SESSION['reservations'], 'title'))) {
            $_SESSION['reservations'][] = [
                'title' => $row['title'],
                'price' => $row['price'],
                'description' => $row['description']
            ];

            // อัปเดตราคารวม
            $_SESSION['totalPrice'] += $row['price'];

            // อัปเดตสถานะเป็น "ไม่ว่าง" ในฐานข้อมูล
            $updateSql = "UPDATE rental_space SET status = 'ไม่ว่าง' WHERE title = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("s", $row['title']);
            $updateStmt->execute();
        }
    }

    echo json_encode(['reservations' => $_SESSION['reservations'], 'totalPrice' => $_SESSION['totalPrice']]);
    exit();
}


?>
