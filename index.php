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
    
</head>
<body id="page-top">
    <!-- Navigation-->
    <?php include("nav.php") ?>

    <!-- Masthead-->
    <header class="masthead" id="page-top">
        <div class="text-center">
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
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/tokyo-Master.jpg" alt="Featured Project" /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>เนื่อหาเว็ป!</h4>
                        <p class="text-black-50 mb-0">เนื่อหาเว็ป!</p>
                    </div>
                </div>
            </div>
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/tokyo-Master.jpg" alt="Project One" /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">เนื่อหาเว็ป!</h4>
                                <p class="mb-0 text-white-50">เนื่อหาเว็ป!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/tokyo-Master.jpg" alt="Project Two" /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">เนื่อหาเว็ป!</h4>
                                <p class="mb-0 text-white-50">เนื่อหาเว็ป!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">สมัครสมาชิกเพื่อรับข้อมูลเพิ่มเติม!</h2>
                    <!-- SB Forms Contact Form -->
                    <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="กรอกที่อยู่อีเมล..." aria-label="กรอกที่อยู่อีเมล..." data-sb-validations="required,email" /></div>
                            <div class="col-auto"><button class="btn btn-primary" id="submitButton" type="submit">ส่งเลย!</button></div>
                        </div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">จำเป็นต้องมีอีเมล</div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">อีเมลไม่ถูกต้อง</div>
                        <!-- Submit success message-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3 mt-2 text-white">
                                <div class="fw-bolder">ส่งแบบฟอร์มสำเร็จ!</div>
                                หากต้องการเปิดใช้งานแบบฟอร์มนี้ ลงทะเบียนได้ที่
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3 mt-2">เกิดข้อผิดพลาดในการส่งข้อความ!</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0" style="color: rgb(255, 255, 255);">ที่อยู่</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small" style="color: #ffffff;">39/1 ถ. รัชดาภิเษก แขวงจันทรเกษม เขตจตุจักร กรุงเทพมหานคร 10900</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0" style="color: rgb(255, 255, 255);">อีเมล</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a href="mailto:hello@yourdomain.com">veerayut.p64@chandra.ac.th</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0" style="color: rgb(255, 255, 255);">เบอร์โทรศัพท์</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50" style="color: #ffffff !important;">+66 802161638</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="https://web.facebook.com/keng.kk.2"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="https://www.youtube.com/channel/UCLPoAGKuqUsHJwh51QWFhkw"><i class="fab fa-youtube"></i></a>

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
