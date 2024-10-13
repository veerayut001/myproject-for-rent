<?php
session_start();
include 'c_db_connect.php';

if (isset($_SESSION['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone = $_POST['phone'] ?? '';
        $website = $_POST['website'] ?? '';
        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("UPDATE account SET phone=?, website=? WHERE id_account=?");
        $stmt->bind_param("ssi", $phone, $website, $user_id);

        if ($stmt->execute()) {
            $_SESSION['phone'] = $phone;
            $_SESSION['website'] = $website;
            echo '<script>
                    alert("บันทึกข้อมูลติดต่อสำเร็จ!");
                    window.location.href = "u_profile.php"; // เปลี่ยนเส้นทางไปยังหน้าโปรไฟล์
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
