<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JONG KAB CHAN | Login & Registration</title>
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
    </style>
</head>
<body>
    <div class="wrapper">
            <?php include("nav.php") ?>            
            
            
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>
        <div class="form-box">
            <form class="login-container" id="login" action="c_process-login.php" method="POST">
                <div class="top">
                    <span>ยังไม่มีบัญชีใช่ไหม? <a href="#" onclick="register()">ลงชื่อเข้าใช้งาน</a></span>
                    <header>เข้าสู่ระบบ</header>
                </div>
                <div class="input-box">
                    <input name="email_account" type="text" class="input-field" placeholder="ชื่อผู้ใช้หรืออีเมล" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input name="password_account" type="password" class="input-field" placeholder="รหัสผ่าน" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="เข้าสู่ระบบ">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check">จำรหัสผ่านไว้</label>
                    </div>
                    <div class="two">
                        <label><a href="#">ลืมรหัสผ่าน?</a></label>
                    </div>
                </div>
            </form>
        

            <div class="register-container" id="register" action="c_process-login.php" method="POST">
                <div class="top">
                    <span>มีบัญชีใช่ไหม? <a href="#" onclick="login()">ลงชื่อเข้าใช้งาน</a></span>
                    <header>สมัคร</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input name="firstname_account" type="text" class="input-field" placeholder="ชื่อจริง">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input name="lastname_account" type="text" class="input-field" placeholder="นามสกุล">
                        <i class="bx bx-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input name="email_account" type="text" class="input-field" placeholder="อีเมล">
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input name="password_account" type="password" class="input-field" placeholder="รหัสผ่าน">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input  type="submit" class="submit" value="ลงทะเบียน">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> จำรหัสผ่านไว้</label>
                    </div>
                    <div class="two">
                        <label><a href="#">ข้อตกลงและเงื่อนไข</a></label>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");
            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }

        function login() {
            var loginContainer = document.getElementById("login");
            var registerContainer = document.getElementById("register");
            var loginBtn = document.getElementById("loginBtn");
            var registerBtn = document.getElementById("registerBtn");

            loginContainer.style.left = "4px";
            registerContainer.style.right = "-520px";
            loginBtn.className = "btn white-btn";
            registerBtn.className = "btn";
            loginContainer.style.opacity = 1;
            registerContainer.style.opacity = 0;
        }

        function register() {
            var loginContainer = document.getElementById("login");
            var registerContainer = document.getElementById("register");
            var loginBtn = document.getElementById("loginBtn");
            var registerBtn = document.getElementById("registerBtn");

            loginContainer.style.left = "-510px";
            registerContainer.style.right = "5px";
            loginBtn.className = "btn";
            registerBtn.className = "btn white-btn";
            loginContainer.style.opacity = 0;
            registerContainer.style.opacity = 1;
        }
    </script>
    <!-- Bootstrap JavaScript (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
