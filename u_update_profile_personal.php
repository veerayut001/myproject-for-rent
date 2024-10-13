<?php
session_start();
include 'c_db_connect.php';

if (isset($_SESSION['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST['firstname_account'] ?? '';
        $lastname = $_POST['lastname_account'] ?? '';
        $email = $_POST['email_account'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("UPDATE account SET firstname_account=?, lastname_account=?, email_account=?, birthdate=? WHERE id_account=?");
        $stmt->bind_param("ssssi", $firstname, $lastname, $email, $birthdate, $user_id);

        if ($stmt->execute()) {
            $_SESSION['firstname_account'] = $firstname;
            $_SESSION['lastname_account'] = $lastname;
            $_SESSION['email_account'] = $email;
            $_SESSION['birthdate'] = $birthdate;
            echo '<script>
                    alert("บันทึกข้อมูลส่วนตัวสำเร็จ!");
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
