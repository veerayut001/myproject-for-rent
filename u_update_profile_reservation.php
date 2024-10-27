<?php
session_start();
include 'c_db_connect.php';

if (isset($_SESSION['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reservation_number = $_POST['reservation_number'] ?? '';
        $user_id = $_SESSION['user_id'];

        // เช็คว่ามีหมายเลขการจองและรายละเอียดการจองที่ส่งมา
        if (!empty($reservation_number)) {
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, reservation_number) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $reservation_number);

            if ($stmt->execute()) {
                $_SESSION['reservation_number'] = $reservation_number;
                echo '<script>
                        alert("บันทึกหมายเลขที่จองสำเร็จ!");
                        window.location.href = "u_profile.php"; // เปลี่ยนเส้นทางกลับไปที่หน้าโปรไฟล์
                      </script>';
            } else {
                echo '<script>
                        alert("เกิดข้อผิดพลาด: ' . $stmt->error . '");
                        window.history.back(); // กลับไปยังหน้าก่อนหน้า
                      </script>';
            }

            $stmt->close();
        } else {
            echo '<script>
                    alert("กรุณากรอกหมายเลขที่จอง!");
                    window.history.back(); // กลับไปยังหน้าก่อนหน้า
                  </script>';
        }
    } else {
        echo '<script>
                alert("ไม่มีข้อมูลถูกส่ง!");
                window.history.back(); // กลับไปยังหน้าก่อนหน้า
              </script>';
    }
} else {
    echo '<script>
            alert("คุณยังไม่ได้เข้าสู่ระบบ!");
            window.location.href = "c_login.php"; // เปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
          </script>';
}

$conn->close();
?>
