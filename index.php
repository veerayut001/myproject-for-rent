

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JONG KAB CHAN | HOME</title>
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

    <style>
        /* Media query สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 768px) {  
            .navbar-nav .nav-link {
                color: #ffffff; /* สีตัวอักษรในหน้าจอขนาดเล็ก */
            }

            .navbar-nav .nav-link:hover {
                color: #43a76d !important; /* เปลี่ยนสีเป็นเขียวเมื่อโฮเวอร์ในหน้าจอขนาดเล็ก */
            }
        }

        /* Media query สำหรับหน้าจอขนาดใหญ่ */
        @media (min-width: 769px) {
            .navbar-nav .nav-link {
                color: #ffffff; /* สีตัวอักษรในหน้าจอขนาดใหญ่ */
            }

            .navbar-nav .nav-link:hover {
                color: #1fac88 !important; /* เปลี่ยนสีเป็นเขียวเมื่อโฮเวอร์ในหน้าจอขนาดใหญ่ */
            }
        }

        .navbar-toggler {
            border: none; /* เอาขอบออก */
        }
    </style>
<?php
session_start(); // เริ่มต้น session

// เช็คว่ามี firstname ใน session หรือไม่
if (!isset($_SESSION['firstname'])) {
    // ถ้าไม่มี ให้กำหนดค่าเริ่มต้น หรือ redirect ไปที่หน้า login
    $_SESSION['firstname'] = ''; // หรือกำหนดค่าที่ต้องการ
}
?>
    
    
</head>
<body id="page-top">
    <!-- Navigation-->
    <?php include("nav.php") ?>

    <!-- Masthead-->
    <header class="masthead" id="page-top">
    <div class="text-center">
        <div class="text-left" style="font-size: 14px; color: #00ff00; margin-left: 0px;">
            <h1 style="font-size: 3rem;">ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h1>
        </div>



        <h1 class="mx-auto my-0 text-uppercase">Jong Kab Chan</h1>
        <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>
        <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">ยินดีตอนรับเข้าสู่เว็ปไซต์ "จองกับฉัน" เพื่อการจองที่สะดวกสบายและง่ายต่อการใช้งาน อย่างกับปลอกกล้วยเข้าปาก?</p>
        <a class="btn btn-primary" href="store.php" target="_blank">จองกันเลย!</a>
    </div>
    </header>
    
    <!-- Projects-->
    <section class="projects-section bg-light" id="about">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/ตลาดดินแดง2.jpg" alt="Featured Project" /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left" style="color: #109e6f;">
                        <h2>ตลาดดินแดง</h2>
                        <h6 class="text-black-50 mb-0">ตลาดดินแดงเป็นตลาดขนาดใหญ่ที่ตั้งอยู่บริเวณซอยประชาสงเคราะห์ 9 และเป็นจุดหมายปลายทางที่น่าสนใจสำหรับคนรักการเดินตลาดและช้อปปิ้งในกรุงเทพฯ การเดินทางไปยังตลาดนี้สะดวกมาก โดยสามารถใช้บริการรถโดยสารสาธารณะได้หลากหลายสาย
                        </h6>
                    </div>
                </div>
            </div>
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/ตลาดดินแดง1.jpg" alt="Project One" /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">เวลาเปิด-ปิดของตลาดดินแดง</h4>
                                <p class="mb-0 text-white-50">
                                ตลาดเช้า: เปิดตั้งแต่เวลา 05:00 น. ถึง 10:00 น. โดยจะมีสินค้าประเภทอาหารสด เช่น ผัก ผลไม้ เนื้อสัตว์ เครื่องแกง และอาหารสำเร็จรูปต่าง ๆ เช่น น้ำเต้าหู้และกับข้าวถุง
                                </p>
                                <p class="mb-0 text-white-50">
                                ตลาดเย็น: กลับมาคึกคักอีกครั้งในเวลา 17:00 น. โดยมีร้านอาหารมากมายสำหรับนั่งรับประทาน มีทั้งร้านอาหารตามสั่ง ส้มตำ ปลาเผา ก๋วยเตี๋ยว และอาหารพื้นบ้าน เช่น แกงใต้ แกงเหนือ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/ตลาดดินแดง3.jpg" alt="Project Two" /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">เสาร์-อาทิตย์</h4>
                                <p class="mb-0 text-white-50">
                                    ในวันเสาร์และวันอาทิตย์ ตลาดดินแดงจะมีการเปิดท้ายขายเสื้อผ้า กระเป๋า และขนมต่าง ๆ เช่น เครปและน้ำแข็งไส ซึ่งเป็นโอกาสที่ดีในการช้อปปิ้งและสัมผัสบรรยากาศที่แตกต่างจากวันปกติ
                                    ตลาดดินแดงจึงถือเป็นสวรรค์สำหรับพ่อบ้านแม่บ้านที่ต้องการซื้อของสดและอาหารสำเร็จรูปอย่างครบครัน ทั้งยังเป็นสถานที่ที่สามารถเพลิดเพลินกับการช้อปปิ้งในบรรยากาศที่คึกคักและสนุกสนาน
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-70">
        <div class="container px-4 px-lg-5">Copyright &copy; Jong Kab Chan 2023</div>
    </footer>

     <!-- Bootstrap core JS-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Core theme JS-->
     <script src="js/scripts.js"></script>
     <!-- SB Forms JS -->
     <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
     
</body>
</html>
