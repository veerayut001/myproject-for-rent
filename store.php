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
        
        .modal-backdrop {
            display: none; /* ทำให้แบ็กกราวด์ไม่มีการแสดง */
        }       
        

    </style>
</head>
<body id="page-top">
    
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
            <h1 class="mx-auto my-0 text-uppercase">Store</h1>
            <html lang="en">
            
            </html></h1>
            <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>
            <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">เลือกพื้นที่ที่ดีที่สุดสำหรับคุณจากรายการของเรา</p>
            <a class="btn btn-primary" href="#store01" >เลือกพื้นที่</a>
        </div>
    </header>

    <!-- Projects Section -->

    <section class="projects-section bg-light" id="store01" >
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
                            <p class="price">฿1,400/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="1" data-price="฿1,400/เดือน"  onclick="viewDetails
                            ('พื้นที่ 1', '฿1,400/เดือน', 'ว่าง', 'ขนาด 20x20 ตารางเมตร อยู่ใกล้ห้องน้ำ', '1')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space2" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 2" class="checkbox-overlay">
                            <h3>พื้นที่ 2</h3>
                            <p class="price">฿2,000/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="2" data-price="฿2,000/เดือน"  onclick="viewDetails
                            ('พื้นที่ 2', '฿2,000/เดือน', 'ว่าง', 'ขนาด 25x25 ตารางเมตร อยู่ใกล้ลิฟต์', '2')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space3" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 3" class="checkbox-overlay">
                            <h3>พื้นที่ 3</h3>
                            <p class="price">฿1,400/เดือน</p>
                            <p class="status rented">ไม่ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="3" data-price="฿1,400/เดือน"  onclick="viewDetails
                            ('พื้นที่ 3', '฿1,400/เดือน', 'ไม่ว่าง', 'ขนาด 20x20 ตารางเมตร อยู่กลางตลาด', '3')">ดูรายละเอียด</button>
                        </div>
                    </div>
                </div>

                <div class="grid-container">
                    <!-- กริดพื้นที่สำหรับตลาดดินแดง(จำนงค์) -->
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space4" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 4" class="checkbox-overlay">
                            <h3>พื้นที่ 4</h3>
                            <p class="price">฿1,400/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="4" data-price="฿1,400/เดือน"  onclick="viewDetails
                            ('พื้นที่ 4', '฿1,400/เดือน', 'ว่าง', 'ขนาด 20x20 ตารางเมตร อยู่ใกล้ห้องน้ำ', '4')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space5" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 5" class="checkbox-overlay">
                            <h3>พื้นที่ 5</h3>
                            <p class="price">฿2,000/เดือน</p>
                            <p class="status rented">ไม่ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="5" data-price="฿2,000/เดือน"  onclick="viewDetails
                            ('พื้นที่ 5', '฿2,000/เดือน', 'ไม่ว่าง', 'ขนาด 25x25 ตารางเมตร อยู่ใกล้ลิฟต์', '5')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space6" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 6" class="checkbox-overlay">
                            <h3>พื้นที่ 6</h3>
                            <p class="price">฿1,400/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="6" data-price="฿1,400/เดือน"  onclick="viewDetails
                            ('พื้นที่ 6', '฿1,400/เดือน', 'ว่าง', 'ขนาด 20x20 ตารางเมตร อยู่กลางตลาด', '6')">ดูรายละเอียด</button>
                        </div>
                    </div>
                </div>

                
                <!-- โมดัลสำหรับแสดงรายละเอียด 1 -->
                <div class="modal fade" id="spaceDetailsModal1" tabindex="-1" aria-labelledby="spaceDetailsLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel1">รายละเอียดพื้นที่ 1</h5>
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle1"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice1"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus1"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription1"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" 
                                    style="transition: background-color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            

                <!-- โมดัลสำหรับแสดงรายละเอียด 2 -->
                <div class="modal fade" id="spaceDetailsModal2" tabindex="-1" aria-labelledby="spaceDetailsLabel2" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel2">รายละเอียดพื้นที่ 2</h5>
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle2"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice2"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus2"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription2"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" 
                                    style="transition: background-color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- โมดัลสำหรับแสดงรายละเอียด 3 -->
                <div class="modal fade" id="spaceDetailsModal3" tabindex="-1" aria-labelledby="spaceDetailsLabel3" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel3">รายละเอียดพื้นที่ 3</h5>
                            </div>
                            <div class="modal-body" style="color: #fa1c1c;">
                                <h3 id="spaceTitle3"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice3"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus3"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription3"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" 
                                    style="transition: background-color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <!-- โมดัลสำหรับแสดงรายละเอียด 4 -->
                <div class="modal fade" id="spaceDetailsModal4" tabindex="-1" aria-labelledby="spaceDetailsLabel4" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel4">รายละเอียดพื้นที่ 4</h5>
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle4"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice4"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus4"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription4"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" 
                                    style="transition: background-color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            

                <!-- โมดัลสำหรับแสดงรายละเอียด 5 -->
                <div class="modal fade" id="spaceDetailsModal5" tabindex="-1" aria-labelledby="spaceDetailsLabel5" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel5">รายละเอียดพื้นที่ 5</h5>
                            </div>
                            <div class="modal-body" style="color: #fa1c1c;">
                                <h3 id="spaceTitle5"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice5"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus5"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription5"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" 
                                    style="transition: background-color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- โมดัลสำหรับแสดงรายละเอียด 6 -->
                <div class="modal fade" id="spaceDetailsModal6" tabindex="-1" aria-labelledby="spaceDetailsLabel6" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel3">รายละเอียดพื้นที่ 6</h5>
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle6"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice6"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus6"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription6"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" 
                                    style="transition: background-color 0.3s, transform 0.3s;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ปุ่มยืนยันสำหรับทั้งตลาด -->
            <div class="d-flex justify-content-end mt-3"> 
                <button class="btn btn-primary" onclick="purchaseSelected()" 
                    style="transition: background-color 0.3s, transform 0.3s;"
                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';"
                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                    ซื้อพื้นที่ที่เลือก
                </button>
            </div>
            
            <div class="map mb-4 mb-lg-5">
                <h2 class="text-uppercase" style="color: #109e6f;">แผนที่</h2>
                <img src="assets/img/แผนที่ตลาดดินแดง.jpg" alt="แผนที่ของตลาด" width="100%" height="100%" style="border:0;">
            </div>
    
            <!-- แสดงพื้นที่ที่เลือก -->
            <div id="selected-spaces" class="container px-4 px-lg-5 mt-5">
                <!-- ข้อมูลพื้นที่ที่เลือกจะถูกแสดงที่นี่ -->
            </div>
    
        </div>

        <!-- โมดัลสำหรับจ่ายเงิน -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="color: #109e6f;">
                        <h5 class="modal-title" id="paymentModalLabel">รายละเอียดการจ่ายเงิน</h5>
                    </div>
                    <div class="modal-body" style="color: #000;">
                        <h3>พื้นที่ที่คุณเลือก:</h3>
                        <ul id="selectedSpacesList">
                            <!-- รายการพื้นที่ที่เลือกจะแสดงที่นี่ -->
                        </ul>
                        <p><strong>ราคารวม: </strong><span id="totalPrice" style="color: #109e6f;">฿0</span></p>

                        <!-- ฟอร์มการจ่ายเงิน -->
                        <form action="/submit-payment" method="POST">
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">หมายเลขบัตรเครดิต/เดบิต</label>
                                <input type="text" class="form-control" id="cardNumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="cardExpiry" class="form-label">วันหมดอายุ</label>
                                <input type="text" class="form-control" id="cardExpiry" placeholder="MM/YY" required>
                            </div>
                            <div class="mb-3">
                                <label for="cardCVC" class="form-label">CVC</label>
                                <input type="text" class="form-control" id="cardCVC" required>
                            </div>
                            <button type="submit" class="btn btn-success">ยืนยันการชำระเงิน</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        const selectedPrices = []; // สร้างอาเรย์เพื่อเก็บราคาที่เลือก

        function purchaseSelected() {
            const selectedSpaces = [];
            let totalPrice = 0;

            // ดึงราคาจาก checkbox ที่ถูกเลือก
            document.querySelectorAll('.grid-container input[type="checkbox"]:checked').forEach(checkbox => {
                selectedSpaces.push(checkbox.value);

                // ดึงราคาจากปุ่ม "ดูรายละเอียด" ที่เกี่ยวข้อง
                const priceButton = document.querySelector(`button[data-space-id="${checkbox.value.split(" ")[2]}"]`); // แก้ไขตรงนี้ให้เข้ากับ id
                if (priceButton) {
                    const priceText = priceButton.getAttribute('data-price'); // ดึงราคาจาก attribute
                    const priceValue = parsePrice(priceText); // แปลงราคาเป็นตัวเลข
                    selectedPrices.push(priceValue); // เพิ่มราคาลงในอาเรย์
                    totalPrice += priceValue; // บวกค่าราคาเข้ากับ totalPrice
                }
            });

            console.log(`Total Price: ${totalPrice}`); // ตรวจสอบค่าราคา

            if (selectedSpaces.length > 0) {
                // อัปเดตข้อมูลในโมดัล
                const spacesList = document.getElementById('selectedSpacesList');
                spacesList.innerHTML = ''; // ล้างรายการเดิม
                selectedSpaces.forEach(space => {
                    const li = document.createElement('li');
                    li.textContent = space; // สมมุติว่า space คือชื่อพื้นที่
                    spacesList.appendChild(li);
                });

                document.getElementById('totalPrice').textContent = `฿${totalPrice.toLocaleString()}`;

                // แสดงโมดัล
                const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
                modal.show();
            } else {
                alert('กรุณาเลือกพื้นที่ที่ต้องการซื้อ');
            }
        }

        function parsePrice(priceText) {
            // แปลงข้อความราคาเป็นตัวเลข
            return parseFloat(priceText.replace(/[^0-9.-]+/g, "")); // ลบอักขระที่ไม่ใช่ตัวเลข
        }
    </script>



    <?php include("footer.php") ?> 

    <script>
            function viewDetails(title, price, status, description, modalId) {
            // ตั้งค่าข้อมูลในโมดัล
            document.getElementById('spaceTitle' + modalId).textContent = title;
            document.getElementById('spacePrice' + modalId).textContent = price;
            document.getElementById('spaceStatus' + modalId).textContent = status;
            document.getElementById('spaceDescription' + modalId).textContent = description;

            // สร้างโมดัลใหม่
            var detailsModal = new bootstrap.Modal(document.getElementById('spaceDetailsModal' + modalId), {
                backdrop: true, // ให้สามารถคลิกนอกโมดัลเพื่อปิดได้
                keyboard: true // ให้สามารถปิดโมดัลด้วยปุ่ม ESC ได้
            });
            detailsModal.show();
        }

        // ฟังก์ชันยืนยันการเช่า
        function confirmRental() {
            alert("คุณได้ทำการเช่าพื้นที่แล้ว! กรุณาชำระเงิน...");
            // โค้ดสำหรับดำเนินการเช่าพื้นที่จริง เช่น ส่งข้อมูลไปยัง server
        }
    </script>
    
    <!-- Bootstrap JavaScript (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
    
</body>
</html>
