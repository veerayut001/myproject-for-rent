<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: c_login.php");
    exit();
}
// เชื่อมต่อฐานข้อมูล (ตามที่คุณได้ระบุไว้ใน c_db_config.php)
// include("c_db_config.php"); ตอนนี้การ์ดพื้นหลังสีขาวอะ เอาออกยังไง 




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
                <a class="list-group-item list-group-item-action custom-list-group-item" data-toggle="tab" href="#connections">ข้อมูลการค้า</a>
            </div>
        </div>
    
        
        <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">
                <div class="card-body media align-items-center">
                    <div class="media align-items-center">
                        <img src="https://scontent.fbkk34-2.fna.fbcdn.net/v/t39.30808-6/353036638_3134299010200343_7816943231150869879_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFy1nJ-km8AIKEFysy0nYodUWT3KU9ZWjlRZPcpT1laOcmouaqNR554urhKw2tPv78p_3wnh4gGvKYLHonu9iVN&_nc_ohc=obimkLGHNU4Q7kNvgEi1v0s&_nc_zt=23&_nc_ht=scontent.fbkk34-2.fna&_nc_gid=AzDeDBrY0mWy9OU851PnUmp&oh=00_AYAcqv-i9vzGEojRTbmgOn9dcwQZNDbTXNe-TwIAbD-wQQ&oe=6708775B" 
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
                                            <input type="text" name="firstname" class="form-control " style="width: 400px;" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>" readonly>
                                        </div>
                                        <div class="form-group input-box">
                                            <label class="form-label">นามสกุล</label>
                                            <input type="text" name="lastname" class="form-control" style="width: 400px;" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" readonly>
                                        </div>
                                        <div class="form-group input-box">
                                            <label class="form-label">อีเมล</label>
                                            <input type="email" name="email" class="form-control" style="width: 400px;" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
                                        </div>                
                                        <div class="form-group input-box">
                                            <label class="form-label">วันเกิด</label>
                                            <input type="date" name="birthdate" class="form-control" style="width: 400px;" 
                                                value="<?php echo isset($_SESSION['birthdate']) ? htmlspecialchars($_SESSION['birthdate']) : ''; ?>" required>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-primary me-2">ยืนยัน</button>
                                            <a href="u_profile.php" class="btn btn-secondary me-2">ยกเลิก</a>
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

                            <!-- แท็บสำหรับการเชื่อมต่อ -->
                            <div class="tab-pane fade" id="connections">
                                <div class="card-body pb-2">
                                    <form method="POST" action="u_update_profile_reservation.php"> <!-- เพิ่ม action สำหรับส่งข้อมูล -->
                                        <div class="form-group">
                                            <label class="form-label">หมายเลขที่จอง</label> 
                                            <input type="text" name="reservation_number" class="form-control" style="width: 300px;"
                                                value="<?php echo isset($_SESSION['reservation_number']) ? htmlspecialchars($_SESSION['reservation_number']) : ''; ?>">
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-primary me-2">ยืนยัน</button>
                                            <a href="u_profile.php" class="btn btn-secondary me-2">ยกเลิก</a>
                                            <a href="c_logout.php" class="btn btn-danger" onclick="return confirmLogout()">ออกจากระบบ</a>
                                        </div>
                                    </form>
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