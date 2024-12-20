<?php
session_start();
include 'c_db_connect.php';

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: c_login.php");
    exit();
}

// ดึงข้อมูลการจองจากเซสชัน
$reservations = $_SESSION['reservations'] ?? []; 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JONG KAB CHAN | PROFILE </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="assets/img/i2store.ico" type="image/x-icon">
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="projects-section bg-light">  
    <div class="container light-style flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between no-border">
        <?php include("nav.php") ?>
    </div>
    <div class="row no-gutters row-bordered" id="profile">
        <div class="col-md-3 pt-0">
            <div class="list-group list-group-flush account-settings-links">
                <a class="list-group-item list-group-item-action custom-list-group-item" data-toggle="tab" href="#account-general1">ทั่วไป</a>
                <a class="list-group-item list-group-item-action custom-list-group-item" data-toggle="tab" href="#account-info">ข้อมูล</a>
                <a class="list-group-item list-group-item-action custom-list-group-item" data-toggle="tab" href="#account-social-links">ลิงค์โซเชียล</a>
            </div>
        </div>
    
        
        <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">
                <div class="card-body media align-items-left" style="text-align: left;">
                    <div class="media align-items-left" style="float: left;">
                        <img src="https://scontent.fbkk34-2.fna.fbcdn.net/v/t39.30808-6/353036638_3134299010200343_7816943231150869879_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFy1nJ-km8AIKEFysy0nYodUWT3KU9ZWjlRZPcpT1laOcmouaqNR554urhKw2tPv78p_3wnh4gGvKYLHonu9iVN&_nc_ohc=ur2ijit9V-cQ7kNvgHEQPB6&_nc_zt=23&_nc_ht=scontent.fbkk34-2.fna&_nc_gid=AcjKkPhikN5l4Qe68F4lZvN&oh=00_AYAtoJBuOoJWTIhraECOX0FT8oGmEagZTI25FzGfiMtnkQ&oe=671B951B" 
                            alt="Image description" class="d-block ui-w-40">
                        <div class="media-body ml-4">
                            <label class="btn btn-primary btn-small">
                                อัพโหลดรูปภาพ
                                <input type="file" class="account-settings-fileinput">
                            </label>
                        </div>  
                        <div class="text-light small mt-1">ไฟล์ JPG, GIF หรือ PNG. สูงสุด 800K</div>                                     
                        <button type="button" class="btn btn-primary btn-small">รีเซ็ต</button>
                    </div>
                </div>
                <hr class="border-light m-0">
                <style>
                    .form-label {
                        font-size: 1.3rem; /* ปรับขนาดตัวหนังสือใน label */
                    }
                    .form-control {
                        font-size: 1.2rem; /* ปรับขนาดตัวหนังสือใน input */
                    }
                </style>
                <!-- HTML สำหรับแท็บ -->
                <div class="tab-content " >
                            <!-- แท็บข้อมูลทั่วไป -->
                            <div class="tab-pane fade active show" id="account-general1">
                                <div class="card-body">
                                    <form method="POST" action="u_update_profile_personal.php">
                                        <div class="form-group input-box">
                                            <label class="form-label">ชื่อ</label>
                                            <input type="text" name="firstname" class="form-control " style="width: 400px;" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>"readonly >
                                        </div>
                                        <div class="form-group input-box">
                                            <label class="form-label">นามสกุล</label>
                                            <input type="text" name="lastname" class="form-control" style="width: 400px;" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>"readonly >
                                        </div>
                                        <div class="form-group input-box">
                                            <label class="form-label">อีเมล</label>
                                            <input type="email" name="email" class="form-control" style="width: 400px;" value="<?php echo htmlspecialchars($_SESSION['email']); ?>"readonly >
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <a href="c_logout.php" class="btn btn-danger" onclick="return confirmLogout()">ออกจากระบบ</a>
                                        </div>               
                                    </form>
                                </div>
                            </div>

                            <!-- แท็บข้อมูลการติดต่อ -->
                            <div class="tab-pane fade" id="account-info">
                                <form method="POST" action="u_update_profile_contact.php">
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">ติดต่อ</h6>
                                        <div class="form-group">
                                            <label class="form-label">โทรศัพท์</label>
                                            <input type="text" name="phone" class="form-control" style="width: 400px;"
                                                value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="text" name="website" class="form-control" style="width: 400px;"
                                                value="<?php echo isset($_SESSION['website']) ? htmlspecialchars($_SESSION['website']) : ''; ?>" required>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-primary me-2">ยืนยัน</button>
                                            <a href="u_profile.php" class="btn btn-secondary me-2">ยกเลิก</a>
                                            <a href="c_logout.php" class="btn btn-danger" onclick="return confirmLogout()">ออกจากระบบ</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- แท็บสำหรับลิงก์โซเชียล -->
                            <div class="tab-pane fade" id="account-social-links">
                                <div class="card-body pb-2">
                                    <form method="POST" action="u_update_profile_social.php"> <!-- เพิ่ม action สำหรับส่งข้อมูล -->
                                        <div class="form-group">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" name="twitter" class="form-control" style="width: 400px;"
                                                value="<?php echo isset($_SESSION['twitter']) ? htmlspecialchars($_SESSION['twitter']) : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" name="facebook" class="form-control" style="width: 400px;"
                                                value="<?php echo isset($_SESSION['facebook']) ? htmlspecialchars($_SESSION['facebook']) : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Google+</label>
                                            <input type="text" name="google_plus" class="form-control" style="width: 400px;"
                                                value="<?php echo isset($_SESSION['google_plus']) ? htmlspecialchars($_SESSION['google_plus']) : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="instagram" class="form-control" style="width: 400px;"
                                                value="<?php echo isset($_SESSION['instagram']) ? htmlspecialchars($_SESSION['instagram']) : ''; ?>">
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-primary me-2">ยืนยัน</button>
                                            <a href="u_profile.php" class="btn btn-secondary me-2">ยกเลิก</a>
                                            <a href="c_logout.php" class="btn btn-danger" onclick="return confirmLogout()">ออกจากระบบ</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- แสดงข้อมูลการจอง -->
                            <div class="reservation-details mt-4">
                                <h3>ข้อมูลการจอง</h3>
                                <div class="row" id="reservationList">
                                    <?php if (!empty($_SESSION['reservations'])): ?>
                                        <?php foreach ($_SESSION['reservations'] as $index => $reservation): ?>
                                            <div class="col-md-4 mb-3 reservation-item" data-index="<?php echo $index; ?>" data-price="<?php echo htmlspecialchars($reservation['price']); ?>">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo htmlspecialchars($reservation['title']); ?></h5>
                                                        <p class="card-text">
                                                            <strong>ราคา:</strong> <?php echo htmlspecialchars($reservation['price']); ?> บาท<br>
                                                            <strong>รายละเอียด:</strong> <?php echo htmlspecialchars($reservation['description']); ?><br>
                                                        </p>
                                                        <button class="btn btn-danger" onclick="cancelReservation(<?php echo $index; ?>)">ยกเลิก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <p>ไม่มีข้อมูลการจอง</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p><strong>ราคารวม: </strong><span id="totalPrice" style="color: #109e6f;">฿0</span></p>
                                <div class="d-flex justify-content-end mt-3 pb-3">
                                    <a class="btn btn-danger" onclick="cancelAllReservations()">ยกเลิกทั้งหมด</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

        
    <script>
    function confirmLogout() {
        // แสดงข้อความแจ้งเตือน
        return confirm("คุณแน่ใจหรือไม่ว่าจะออกจากระบบ?");
    }

    function cancelReservation(index) {
        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการจองนี้?")) {
            fetch('cancel_reservation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ index: index })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const reservationItem = document.querySelector(`.reservation-item[data-index="${index}"]`);
                    reservationItem.remove(); // ลบการจองออกจาก UI

                    // อัปเดตสถานะใน Local Storage
                    let reservations = JSON.parse(localStorage.getItem('reservations')) || [];
                    reservations.splice(index, 1); // ลบการจองที่ถูกยกเลิก
                    localStorage.setItem('reservations', JSON.stringify(reservations));

                    // คืนค่าตำแหน่งใน UI สำหรับพื้นที่ที่ยกเลิก
                    const spaceTitle = reservationItem.querySelector('.card-title').innerText;
                    const statusElement = reservationItem.querySelector('.status');
                    statusElement.innerText = 'ว่าง'; // เปลี่ยนสถานะกลับเป็น 'ว่าง'
                    statusElement.classList.remove('rented');
                    statusElement.classList.add('available');

                    // อัปเดตราคารวม
                    const price = parseFloat(reservationItem.querySelector('.card-text strong').innerText.replace('ราคา:', '').replace(' บาท', '').trim());
                    let totalPrice = parseFloat(document.getElementById('totalPrice').innerText.replace('฿', '').trim());
                    totalPrice -= price; // ลบราคาจากราคารวม
                    document.getElementById('totalPrice').innerText = `฿${totalPrice.toFixed(2)}`; // อัปเดตราคารวม
                } else {
                    alert("การยกเลิกการจองล้มเหลว");
                }
            });
        }
    }

    function cancelAllReservations() {
        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการจองทั้งหมด?")) {
            fetch('cancel_all_reservations.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // ลบรายการการจองทั้งหมดจาก UI
                    const reservationList = document.getElementById('reservationList');
                    reservationList.innerHTML = ''; // ลบเนื้อหาทั้งหมด
                    alert("ยกเลิกการจองทั้งหมดเรียบร้อยแล้ว");

                    // อัปเดตสถานะใน Local Storage
                    localStorage.setItem('reservations', JSON.stringify([]));

                    // อัปเดตราคารวมกลับไปเป็น 0
                    document.getElementById('totalPrice').innerText = '฿0';
                } else {
                    alert("เกิดข้อผิดพลาดในการยกเลิกการจองทั้งหมด");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("เกิดข้อผิดพลาดในการเชื่อมต่อ");
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const reservations = document.querySelectorAll('.reservation-item');
        let totalPrice = 0;

        reservations.forEach(reservation => {
            const price = parseFloat(reservation.getAttribute('data-price').replace(/[^0-9.-]+/g, ''));
            totalPrice += price;
        });

        // แสดงราคารวม
        document.getElementById('totalPrice').innerText = `฿${totalPrice.toFixed(2)}`;
    });

    </script>
    
    

        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- SB Forms JS -->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

</body>

</html>