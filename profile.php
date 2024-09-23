<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: c_login.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล (ตามที่คุณได้ระบุไว้ใน c_db_config.php)
// include("c_db_config.php");

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

<body>  
    <div class="card overflow-hidden" style="background: url('../assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover; color: #ffffff;"></div>
    <div class="container light-style flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between no-border">
        <?php include("nav.php") ?>
    </div>
    <header class="masthead" id="page-top">
        <div class="text-center">
            <div class="text-right" style="font-size: 14px; color: #ffffff;">
                <h1 class="mx-auto my-0" style="font-size: 1.5rem;">ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h1>
            </div>
            <h1 class="mx-auto my-0 text-uppercase">Jong Kab Chan</h1>
            <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>
            <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">ยินดีตอนรับเข้าสู่เว็ปไซต์ "จองกับฉัน" เพื่อการจองที่สะดวกสบายและง่ายต่อการใช้งาน อย่างกับปลอกกล้วยเข้าปาก?</p>
            <a class="btn btn-primary" href="#profile" >บัญชีของฉัน</a>

        </div>
    </header>
    
    <div class="row no-gutters row-bordered row-border-light" id="profile">
        <div class="col-md-3 pt-0">
            <div class="list-group list-group-flush account-settings-links">
                <a class="list-group-item list-group-item-action custom-list-group-item" data-toggle="tab" href="#account-general">ทั่วไป</a>
                <a class="list-group-item list-group-item-action custom-list-group-item" data-toggle="tab" href="#account-change-password">เปลี่ยนรหัสผ่าน</a>
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
                                    <img src="https://scontent.fbkk33-2.fna.fbcdn.net/v/t39.30808-1/429815762_3300227416940834_7291681446868113561_n.jpg?stp=dst-jpg_s160x160&_nc_cat=102&ccb=1-7&_nc_sid=0ecb9b&_nc_eui2=AeHXnCMMQkX8o1C7j0L2jYE5KrR4WiEP5D4qtHhaIQ_kPt9Kb4xCXZ7w4DmwHJA0FYDR2kmqnnjTn3bV-SZAw30C&_nc_ohc=wDdyv94HhWgQ7kNvgE1rHQa&_nc_ht=scontent.fbkk33-2.fna&_nc_gid=ApCPI3BDPIGOOR7gQP-yUAp&oh=00_AYBb9Sau_W2ixk4pjHtQz-f0LsumpK9OqPjMy33iEah7uA&oe=66E1A238" 
                                        alt="Image description" class="d-block ui-w-40">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-primary btn-small" >
                                            อัพโหลดรูปภาพ
                                        <input type="file" class="account-settings-fileinput" >
                                        </label>
                                    </div>  
                                    <div class="text-light small mt-1">ไฟล์ JPG, GIF หรือ PNG. สูงสุด 800K</div>                                     
                                        <button type="button" class="btn btn-primary btn-small" >
                                            รีเซ็ต
                                        </button>
                                    </div>
                                    
                            </div><hr class="border-light m-0">
                            <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body">
                            <form method="POST" action="">
                                <div class="form-group input-box">
                                    <label class="form-label">ชื่อ</label>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>" readonly>
                                </div>
                                <div class="form-group input-box">
                                    <label class="form-label">นามสกุล</label>
                                    <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" readonly>
                                </div>
                                <div class="form-group input-box">
                                    <label class="form-label">อีเมล</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
                                </div>
                            </form>
                        </div>
                </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password"> 
                            <div class="card-body">
                                <div class="form-group input-box">
                                    <label class="form-label">รหัสผ่านปัจจุบัน</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">รหัสผ่านใหม่</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">เปลี่ยนรหัสใหม่</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">                   
                                <div class="form-group">
                                    <label class="form-label">วันเกิด</label>
                                    <input type="text" class="form-control" value="3 สิงหาคม, 2002">
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">ติดต่อ</h6>
                                <div class="form-group">
                                    <label class="form-label">โทรศัพทร์</label>
                                    <input type="text" class="form-control" value="0802161638">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" value>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-social-links">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" value="https://twitter.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" value="https://www.facebook.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Google+</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" value="https://www.instagram.com/user">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="connections">
                            <div class="card-body pb-2">                   
                                <div class="form-group">
                                    <label class="form-label">หมายเลขที่จอง</label>
                                    <input type="text" class="form-control" value="7B,3A ">
                                </div>
                            </div>


                        </div>
                        
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary">ยืนยัน</button>&nbsp;
        <button type="button" class="btn btn-primary">ยกเลิก</button>&nbsp;
        <a href="c_logout.php" class="btn btn-danger" onclick="return confirmLogout()">ออกจากระบบ</a>
        <script>
        function confirmLogout() {
            // แสดงข้อความแจ้งเตือน
            return confirm("คุณแน่ใจหรือไม่ว่าจะออกจากระบบ?");
        }
        </script>

    </div>
    

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