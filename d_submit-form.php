<?php
// ดึงไฟล์เชื่อมต่อฐานข้อมูล
include 'c_db_connect.php'; // ตรวจสอบเส้นทางที่ถูกต้อง

// รับค่าจากฟอร์ม
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// ตรวจสอบข้อมูลก่อนบันทึกลงฐานข้อมูล
if (!empty($name) && !empty($email) && !empty($message)) {
    // สร้างคำสั่ง SQL เพื่อบันทึกข้อมูล
    $sql = "INSERT INTO user_contact (name, email, message) VALUES ('$name', '$email', '$message')";

    // ตรวจสอบผลการทำงานของคำสั่ง SQL
    if (mysqli_query($conn, $sql)) {
        echo '<script>
            alert("ข้อมูลถูกบันทึกเรียบร้อยแล้ว!");
            window.location.href = "d_contact.php"; // เปลี่ยนเส้นทางไปยัง d_contact.php
          </script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
} else {
    echo "กรุณากรอกข้อมูลให้ครบถ้วน!";
}

// ปิดการเชื่อมต่อ
mysqli_close($conn);
?>

