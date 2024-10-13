<?php
session_start();  // เริ่มการใช้งาน session

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "for rent");

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $email = $_POST['email_account'];
    $password = $_POST['password_account'];

    // ตรวจสอบผู้ใช้งานในฐานข้อมูล
    $sql = "SELECT * FROM account WHERE email_account = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row['password_account'])) {
            // ตั้งค่า session สำหรับชื่อจริงและ ID
            $_SESSION['user_id'] = $row['id_account']; // สมมติว่า 'id_account' คือคอลัมน์ ID ในตาราง
            $_SESSION['firstname'] = $row['firstname_account'];
            $_SESSION['lastname'] = $row['lastname_account']; // เพิ่มการตั้งค่านามสกุล
            $_SESSION['email'] = $row['email_account']; // เพิ่มการตั้งค่าอีเมล

            // นำผู้ใช้งานไปหน้าอื่น เช่น หน้าแรก
           // แสดงข้อความยืนยันการล็อกอินสำเร็จก่อนเปลี่ยนเส้นทาง
            echo '<script>
            alert("ล็อกอินสำเร็จ ยินดีต้อนรับ ' . $_SESSION['firstname'] . ' !");
            window.location.href = "index.php"; // เปลี่ยนเส้นทางไปยังหน้าแรก
        </script>';
        exit();  // หยุดการทำงานของ script หลังจาก redirect
        } else {
            echo '<script>
            alert("รหัสผ่านไม่ถูกต้อง");
            window.location.href = "c_login.php"; // เปลี่ยนเส้นทางไปยัง c_login.php
          </script>';
        }
    } else {
        echo '<script>
            alert("ไม่พบผู้ใช้งานนี้");
            window.location.href = "c_login.php"; // เปลี่ยนเส้นทางไปยัง c_login.php
          </script>';
    }
}

$conn->close();
?>
