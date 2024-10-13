<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>JONG KAB CHAN | CONTACT</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="description" content="ติดต่อเรา - JONG KAB CHAN" />
    <meta name="author" content="JONG KAB CHAN" />
    <link rel="icon" href="assets/img/i2store.ico" type="image/x-icon">
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet" />
    
    <?php
session_start(); // เริ่มต้น session

// เช็คว่ามี firstname ใน session หรือไม่
if (!isset($_SESSION['firstname'])) {
    // ถ้าไม่มี ให้กำหนดค่าเริ่มต้น หรือ redirect ไปที่หน้า login
    $_SESSION['firstname'] = ''; // หรือกำหนดค่าที่ต้องการ
}
?>

</head>
<body>
    <!-- Navigation-->
    <?php include("nav.php") ?>

    <!-- Masthead-->
    <header class="masthead">
        <div class="text-center">
            <?php if (isset($_SESSION['firstname'])): ?>
                <div class="text-left" style="font-size: 14px; color: #00ff00; margin-left: 0px;">
                    <h1 style="font-size: 3rem;">ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h1>
                </div>
            <?php else: ?>
                <div class="text-left" style="font-size: 14px; color: #ff0000; margin-left: 0px;">
                    <h1 style="font-size: 3rem;">ยินดีต้อนรับ, </h1>
                </div>
            <?php endif; ?>

            <!-- หัวข้อ Contact -->
            <h1 class="mx-auto my-0 text-uppercase">Contact</h1>

            <!-- ข้อความรอง "จองกับฉัน" -->
            <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>

            <!-- ข้อความเพิ่มเติม -->
            <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">สอบถามติดต่อข้อมูลจากทางเรา</p>

            <!-- ปุ่มสำหรับติดต่อ -->
            <a class="btn btn-primary" href="#con">ติดต่อ</a>
        </div>
    </header>


    
    <section class="contact-section bg-light py-5" id="con">
        <div class="container px-4 px-lg-5">
    
            <!-- ข้อมูลการติดต่อ -->
            <div class="contact-info mb-4 mb-lg-5" style="color: #109e6f;">
                <div class="row gx-0 align-items-center">
                    <div class="col-xl-6 col-lg-7">
                        <div class="featured-text text-lg-left">
                            <h1 class="mx-auto my-0 text-uppercase">ข้อมูลการติดต่อ</h1>
                            <p style="white-space: nowrap;"><strong>ที่อยู่:</strong> 39/1 ถ. รัชดาภิเษก แขวงจันทรเกษม เขตจตุจักร กรุงเทพมหานคร 10900</p>
                            <p><strong>โทรศัพท์:</strong> +66 802161638</p>
                            <p><strong>อีเมล:</strong> veerayut.p64@chandra.ac.th</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- ฟอร์มติดต่อ -->
            <div class="contact-form mb-4 mb-lg-5">
                <h2 class="text-uppercase" style="color: #109e6f;">ฟอร์มติดต่อ</h2>

                <form action="d_submit-form.php" method="post" style="color: #109e6f;">
                    <div class="form-group mb-3">
                        <label for="name">ชื่อ:</label>
                        <input type="text" id="name" name="name" class="form-control" style="width: 400px;"  required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="email">อีเมล:</label>
                        <input type="email" id="email" name="email" class="form-control" style="width: 400px;"  required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="message">ข้อความ:</label>
                        <textarea id="message" name="message" class="form-control" rows="4" style="width: 600px;"  required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">ส่งข้อความ</button>
                </form>
            </div>
    
            <!-- แผนที่ -->
            <div class="map mb-4 mb-lg-5">
                <h2 class="text-uppercase" style="color: #109e6f;">แผนที่</h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387197.8550575609!2d100.53297884315057!3d13.818820897291998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29daba07cbffd%3A0xf0100b33d0b32b0!2sChandrakasem+Rajabhat+University!5e0!3m2!1sth!2sth!4v1696822891935!5m2!1sth!2sth&z=14" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>




    
            
        </div>
    </section>
    
    <?php include("footer.php") ?> 

    
    
    
        <!-- Bootstrap JavaScript (CDN) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('scroll', function() {
                var button = document.querySelector('.btn-primary');
                var position = button.getBoundingClientRect();
                
                // ตรวจสอบว่าปุ่มอยู่ในตำแหน่งที่มองเห็น
                if (position.top < window.innerHeight && position.bottom >= 0) {
                    button.classList.add('visible');
                } else {
                    button.classList.remove('visible');
                }
            });
        </script>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>




</body>
</html>
