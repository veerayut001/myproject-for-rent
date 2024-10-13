<?php
session_start();
include 'c_db_connect.php';

if (isset($_SESSION['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $twitter = $_POST['twitter'] ?? '';
        $facebook = $_POST['facebook'] ?? '';
        $google_plus = $_POST['google_plus'] ?? '';
        $instagram = $_POST['instagram'] ?? '';
        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("UPDATE account SET twitter=?, facebook=?, google_plus=?, instagram=? WHERE id_account=?");
        $stmt->bind_param("ssssi", $twitter, $facebook, $google_plus, $instagram, $user_id);

        if ($stmt->execute()) {
            $_SESSION['twitter'] = $twitter;
            $_SESSION['facebook'] = $facebook;
            $_SESSION['google_plus'] = $google_plus;
            $_SESSION['instagram'] = $instagram;
            echo '<script>
                    alert("บันทึกข้อมูลโซเชียลลิงก์สำเร็จ!");
                    window.location.href = "u_profile.php"; // เปลี่ยนเส้นทางกลับไปที่หน้าโปรไฟล์
                  </script>';
        } else {
            echo '<script>
                    alert("เกิดข้อผิดพลาด: ' . htmlspecialchars($stmt->error) . '");
                    window.history.back(); // กลับไปยังหน้าก่อนหน้า
                  </script>';
        }

        $stmt->close();
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
