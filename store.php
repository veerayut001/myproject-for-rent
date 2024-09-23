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
    <title>JONG KAB CHAN | STORE</title>
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

            .grid-container {
                grid-template-columns: 1fr; /* ใช้คอลัมน์เดียวในหน้าจอขนาดเล็ก */
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

            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* คอลัมน์หลายคอลัมน์ในหน้าจอขนาดใหญ่ */
                gap: 20px; /* ระยะห่างระหว่างไอเท็ม */
            }
        }

        .navbar-toggler {
            border: none; /* เอาขอบออก */
        }

        /* Masthead styles */
        .masthead {
            background-color: #343a40;
            color: #ffffff;
            padding: 100px 20px;
            text-align: center;
        }

        .masthead h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .masthead h2 {
            font-size: 2em;
            color: rgb(201, 195, 195);
            margin-bottom: 20px;
        }

        .masthead p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        

        /* Grid Container styles */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            position: relative;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            overflow: hidden;
            color: #ffffff;
            text-align: center;
            background-size: cover;
            background-position: center;
            height: 200px; /* ความสูงของ card */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card .card-body {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        .price {
            font-size: 1.2em;
            color: #ffffff;
        }

        .status {
            font-size: 1em;
            margin: 5px 0;
        }

        .status.available {
            color: #28a745;
        }

        .status.rented {
            color: #fa1c1c;
        }

        
    </style>
</head>
<body id="page-top">
    
    <!-- Navigation-->
    <?php include("nav.php") ?>

    <!-- Masthead-->
    <header class="masthead">
        <div class="text-center">
            <div class="text-right" style="font-size: 14px; color: #ffffff;">
                <h1 class="mx-auto my-0" style="font-size: 1.5rem;">ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h1>
            </div>
            <h1 class="mx-auto my-0 text-uppercase">Store</h1>
            <html lang="en">
            
            </html></h1>
            <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>
            <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">เลือกพื้นที่ที่ดีที่สุดสำหรับคุณจากรายการของเรา</p>
            <a class="btn btn-primary" href="#store01" >เลือกพื้นที่</a>
        </div>
    </header>

    <!-- Projects Section -->

    <section class="projects-section bg-light" id="store01">
        <div class="container px-4 px-lg-5">
            
            <!-- ตลาดดินแดง(จำนงค์) -->
            <div class="market-group" data-market="ตลาดดินแดง(จำนงค์)">
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h1 class="mx-auto my-0 text-uppercase" style="color: #109e6f;">ตลาดดินแดง(จำนงค์)</h1>
                            <h1 class="mx-auto my-0 text-uppercase" style="color: #109e6f;">ตลาดกลาง</h1>
                            <p class="text-black-50 mb-0">เลือกพื้นที่แล้วกดยืนยันได้เลย!</p>
                        </div>
                    </div>
                </div>
    
                <div class="grid-container">
                    <!-- กริดพื้นที่สำหรับตลาดดินแดง(จำนงค์) -->
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space1" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 1" class="checkbox-overlay">
                            <h3>พื้นที่ 1</h3>
                            <p class="price">฿2,500/เดือน</p>
                            <p class="status available">ว่าง</p>
                        </div>
                    </div>
    
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space2" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 2" class="checkbox-overlay">
                            <h3>พื้นที่ 2</h3>
                            <p class="price">฿3,000/เดือน</p>
                            <p class="status rented">เช่าแล้ว</p>
                        </div>
                    </div>
    
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space3" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 3" class="checkbox-overlay">
                            <h3>พื้นที่ 3</h3>
                            <p class="price">฿2,500/เดือน</p>
                            <p class="status available">ว่าง</p>
                        </div>
                    </div>
    
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space4" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 4" class="checkbox-overlay">
                            <h3>พื้นที่ 4</h3>
                            <p class="price">฿3,000/เดือน</p>
                            <p class="status rented">เช่าแล้ว</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- ตลาดจตุจักร -->
            <div class="market-group" data-market="ตลาดจตุจักร">
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h1 class="mx-auto my-0 text-uppercase" style="color: #109e6f;">ตลาดจตุจักร</h1>
                            <p class="text-black-50 mb-0">เลือกพื้นที่แล้วกดยืนยันได้เลย!</p>
                        </div>
                    </div>
                </div>
    
                <div class="grid-container">
                    <!-- กริดพื้นที่สำหรับตลาดจตุจักร -->
                    <div class="card" style="background: url('assets/img/market.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space5" name="space" value="ตลาดจตุจักร พื้นที่ 1" class="checkbox-overlay">
                            <h3>พื้นที่ 1</h3>
                            <p class="price">฿2,500/เดือน</p>
                            <p class="status available">ว่าง</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- ปุ่มยืนยันสำหรับทั้งตลาด -->
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary" onclick="purchaseSelected()" style="
                    transition: background-color 0.3s, transform 0.3s; 
                    color: rgb(255, 255, 255); 
                    cursor: pointer; 
                    box-shadow: 0 4px 8px rgba(26, 189, 153, 0.781);"
                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                    onmouseout="this.classList.toggle('btn-primary', true); this.style.transform='scale(1)';">
                    ซื้อพื้นที่ที่เลือก
                </button>
            </div>
    
            <!-- แสดงพื้นที่ที่เลือก -->
            <div id="selected-spaces" class="container px-4 px-lg-5 mt-5">
                <!-- ข้อมูลพื้นที่ที่เลือกจะถูกแสดงที่นี่ -->
            </div>
    
        </div>
    </section>
    
    <?php include("footer.php") ?> 

    <script>
        function purchaseSelected() {
            const selectedSpaces = [];
            document.querySelectorAll('.grid-container input[type="checkbox"]:checked').forEach(checkbox => {
                selectedSpaces.push(checkbox.value);
            });

            if (selectedSpaces.length > 0) {
                alert('พื้นที่ที่เลือก: ' + selectedSpaces.join(', '));
                // เพิ่มโค้ดสำหรับการดำเนินการซื้อที่นี่
            } else {
                alert('กรุณาเลือกพื้นที่ที่ต้องการซื้อ');
            }
        }
    </script>

    
    <!-- Bootstrap JavaScript (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
    
</body>
</html>
