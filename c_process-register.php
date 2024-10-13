<?php
// เชื่อมต่อฐานข้อมูล (แก้ไขชื่อฐานข้อมูลเป็น 'for rent')
$conn = new mysqli("localhost", "root", "", "for rent");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$firstname = $_POST['firstname_account'];
$lastname = $_POST['lastname_account'];
$email = $_POST['email_account'];
$password = $_POST['password_account'];

// ตรวจสอบว่าผู้ใช้นี้มีอยู่แล้วหรือไม่ (แก้ไขจาก 'users' เป็น 'account')
$sql = "SELECT * FROM account WHERE email_account = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("อีเมลนี้มีผู้ใช้แล้ว");
            window.location.href = "c_login.php"; // เปลี่ยนเส้นทางไปยัง c_login.php
          </script>';
    exit(); // หยุดการทำงาน
    
} else {
    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // บันทึกข้อมูลลงในฐานข้อมูล (แก้ไขจาก 'users' เป็น 'account')
    $sql = "INSERT INTO account (firstname_account, lastname_account, email_account, password_account)
            VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
            alert("ลงทะเบียนสำเร็จ");
            window.location.href = "c_login.php"; // เปลี่ยนเส้นทางไปยัง c_login.php
          </script>';
    exit(); // หยุดการทำงานลซ้ำ

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
