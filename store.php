<?php
session_start();
include 'c_db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $selectedSpaces = $data['selectedSpaces'];

    // ตรวจสอบว่ามีการจองอยู่ในเซสชันหรือไม่
    if (!isset($_SESSION['reservations'])) {
        $_SESSION['reservations'] = [];
    }

    // เตรียมการดึงข้อมูลจากฐานข้อมูล
    $placeholders = implode(',', array_fill(0, count($selectedSpaces), '?'));
    $sql = "SELECT title, price, description FROM rental_space WHERE title IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($selectedSpaces)), ...$selectedSpaces);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $_SESSION['reservations'][] = [
            'title' => $row['title'],
            'price' => $row['price'],
            'description' => $row['description']
        ];

        // อัปเดตสถานะเป็น "ไม่ว่าง" ในฐานข้อมูล
        $updateSql = "UPDATE rental_space SET status = 'ไม่ว่าง' WHERE title = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $row['title']);
        $updateStmt->execute();
    }

    echo json_encode(['reservations' => $_SESSION['reservations']]);
    exit();
}

// ตรวจสอบการจองที่มีในเซสชัน
if (!isset($_SESSION['status'])) {
    $_SESSION['status'] = 'ว่าง'; // ตั้งค่าเริ่มต้น
}

// ดึงข้อมูลพื้นที่ให้เช่าจากฐานข้อมูลเมื่อโหลดหน้า
$query = "SELECT title, price, description, status FROM rental_space";
$result = $conn->query($query);

$spaces = [];
while ($row = $result->fetch_assoc()) {
    $spaces[] = $row;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
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
        
        
        .status-count {
           color: #28a745; /* สีสำหรับล็อคว่าง */
        }
        .status-unavailable {
            color: #dc3545; /* สีสำหรับล็อคไม่ว่าง */
        }
        .status-total {
            color: blue; /* สีสำหรับรวมล็อค */
        }
                    
    </style>
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
                            <h1 class="mx-auto my-0 text-uppercase" style="color: #109e6f;">ตลาดกลาง (เย็น)</h1>
                            <p class="text-black-50 mb-0">เลือกพื้นที่แล้วกดยืนยันได้เลย!</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 text-right" style="float: right;">
                        <div class="col-xl-4 col-lg-5 offset-lg-2 text-right"> <!-- เพิ่ม offset เพื่อเคลื่อนให้ไปขวา -->
                            <div class="status-summary" style="color: #109e6f;">
                                <p>รวมล็อค: <span id="total-count" class="status-total">8</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="grid-container">
                    <!-- กริดพื้นที่สำหรับตลาดดินแดง(จำนงค์) --> 
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space1" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 1" class="checkbox-overlay">
                            <h3>พื้นที่ 1</h3>
                            <p class="price">฿1,200/เดือน</p>
                            <p class="status <?php echo ($_SESSION['status'] === 'ไม่ว่าง') ? 'rented' : 'available'; ?>">
                                <?php echo htmlspecialchars($_SESSION['status'] ?? 'ว่าง'); ?>
                            </p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="1" data-price="฿1,200/เดือน" onclick="viewDetails('พื้นที่ 1', '฿1,200/เดือน', 'ว่าง', 'ขนาด 6 ตารางเมตร อยู่ด้านหน้าติดถนน', '1')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space2" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 2" class="checkbox-overlay">
                            <h3>พื้นที่ 2</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 2" -->
                            <p class="price">฿1,100/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="2" data-price="฿1,100/เดือน" onclick="viewDetails('พื้นที่ 2', '฿1,100/เดือน', 'ว่าง', 'ขนาด 5 ตารางเมตร อยู่ใกล้ห้องน้ำ', '2')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space3" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 3" class="checkbox-overlay">
                            <h3>พื้นที่ 3</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 3" -->
                            <p class="price">฿900/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="3" data-price="฿900/เดือน" onclick="viewDetails('พื้นที่ 3', '฿1,100/เดือน', 'ว่าง', 'ขนาด 4 ตารางเมตร อยู่ใกล้ทางออก', '3')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space4" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 4" class="checkbox-overlay">
                            <h3>พื้นที่ 4</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 4" -->
                            <p class="price">฿1,100/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="4" data-price="฿1,100/เดือน" onclick="viewDetails('พื้นที่ 4', '฿1,100/เดือน', 'ว่าง', 'ขนาด 5.5 ตารางเมตร อยู่ใกล้หน้าตลาด', '4')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space5" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 5" class="checkbox-overlay">
                            <h3>พื้นที่ 5</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 5" -->
                            <p class="price">฿900/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="5" data-price="฿900/เดือน" onclick="viewDetails('พื้นที่ 5', '฿900/เดือน', 'ว่าง', 'ขนาด 5 ตารางเมตร อยู่ใกล้ทางแยก', '5')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space6" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 6" class="checkbox-overlay">
                            <h3>พื้นที่ 6</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 6" -->
                            <p class="price">฿850/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="6" data-price="฿850/เดือน" onclick="viewDetails('พื้นที่ 6', '฿850/เดือน', 'ว่าง', 'ขนาด 4.5 ตารางเมตร อยู่ใกล้หน้าตลาด', '6')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space7" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 7" class="checkbox-overlay">
                            <h3>พื้นที่ 7</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 7" -->
                            <p class="price">฿900/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="7" data-price="฿900/เดือน" onclick="viewDetails('พื้นที่ 7', '฿900/เดือน', 'ว่าง', 'ขนาด 5 ตารางเมตร อยู่ใกล้หน้าตลาด', '7')">ดูรายละเอียด</button>
                        </div>
                    </div>

                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space8" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 8" class="checkbox-overlay">
                            <h3>พื้นที่ 8</h3> <!-- เปลี่ยนชื่อเป็น "พื้นที่ 8" -->
                            <p class="price">฿900/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <!-- ปุ่มดูรายละเอียด -->
                            <button class="btn btn-info" data-space-id="8" data-price="฿900/เดือน" onclick="viewDetails('พื้นที่ 8', '฿900/เดือน', 'ว่าง', 'ขนาด 5 ตารางเมตร อยู่ใกล้ห้องน้ำ', '8')">ดูรายละเอียด</button>
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
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
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
                                <h5 class="modal-title" id="spaceDetailsLabel2">รายละเอียดพื้นที่ 2</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 2" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle2"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice2"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus2"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription2"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
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
                                <h5 class="modal-title" id="spaceDetailsLabel3">รายละเอียดพื้นที่ 3</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 3" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle3"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice3"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus3"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription3"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
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
                                <h5 class="modal-title" id="spaceDetailsLabel4">รายละเอียดพื้นที่ 4</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 4" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle4"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice4"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus4"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription4"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
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
                                <h5 class="modal-title" id="spaceDetailsLabel5">รายละเอียดพื้นที่ 5</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 5" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle5"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice5"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus5"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription5"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
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
                                <h5 class="modal-title" id="spaceDetailsLabel6">รายละเอียดพื้นที่ 6</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 6" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle6"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice6"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus6"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription6"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- โมดัลสำหรับแสดงรายละเอียด 7 -->
                <div class="modal fade" id="spaceDetailsModal7" tabindex="-1" aria-labelledby="spaceDetailsLabel7" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel7">รายละเอียดพื้นที่ 7</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 7" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle7"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice7"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus7"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription7"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
                                    ซื้อพื้นที่ที่เลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- โมดัลสำหรับแสดงรายละเอียด 8 -->
                <div class="modal fade" id="spaceDetailsModal8" tabindex="-1" aria-labelledby="spaceDetailsLabel8" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #109e6f;">
                                <h5 class="modal-title" id="spaceDetailsLabel8">รายละเอียดพื้นที่ 8</h5> <!-- เปลี่ยนเป็น "รายละเอียดพื้นที่ 8" -->
                            </div>
                            <div class="modal-body" style="color: #109e6f;">
                                <h3 id="spaceTitle8"></h3>
                                <p><strong>ราคา: </strong><span id="spacePrice8"></span></p>
                                <p><strong>สถานะ: </strong><span id="spaceStatus8"></span></p>
                                <p><strong>รายละเอียด: </strong><span id="spaceDescription8"></span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s;">
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
                    พื้นที่ที่เลือก
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

        <!-- โมดัลสำหรับจองพื้นที่ -->
        <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="color: #109e6f;">
                        <h5 class="modal-title" id="reservationModalLabel">รายละเอียดการจองพื้นที่</h5>
                    </div>
                    <div class="modal-body" style="color: #000;">
                        <h3>พื้นที่ที่คุณเลือก:</h3>
                        <ul id="selectedSpacesList">
                            <!-- รายการพื้นที่ที่เลือกจะแสดงที่นี่ -->
                        </ul>
                        <p><strong>ราคารวม: </strong><span id="totalPrice" style="color: #109e6f;">฿0</span></p>

                        <!-- ฟอร์มการจอง -->
                        <form id="reservationForm" onsubmit="return false;">
                            <button type="button" class="btn btn-success" onclick="confirmRental()">ยืนยันการจอง</button>
                        </form>

                        <hr>

                        <!-- ข้อความขอบคุณ -->
                        <div id="thankYouMessage" style="display:none; text-align: center; margin-top: 20px;">
                            <h3 style="color: #109e6f;">ขอบคุณสำหรับการจอง!</h3>
                            <p>การจองพื้นที่ของคุณเสร็จสมบูรณ์แล้ว</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <script>
        const selectedPrices = []; // Array to store selected prices
        const loadedSpaces = new Set(); // Set to track loaded spaces

        function purchaseSelected() {
            const selectedSpaces = [];
            let totalPrice = 0;

            // Get selected checkboxes
            const checkboxes = document.querySelectorAll('.grid-container input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                const spaceTitle = checkbox.value; // Assuming the checkbox value is the title of the space
                selectedSpaces.push(spaceTitle);

                // Get the price button related to the checkbox
                const priceButton = document.querySelector(`button[data-space-id="${checkbox.id.split("space")[1]}"]`); 
                if (priceButton) {
                    const priceText = priceButton.getAttribute('data-price'); // Get price from attribute
                    const priceValue = parsePrice(priceText); // Convert price to a number
                    selectedPrices.push(priceValue); // Add price to the array
                    totalPrice += priceValue; // Add price to total
                }
            });

            console.log(`Total Price: ${totalPrice}`); // Check the total price

            if (selectedSpaces.length > 0) {
                // Update modal with selected spaces
                const spacesList = document.getElementById('selectedSpacesList');
                spacesList.innerHTML = ''; // Clear previous list
                selectedSpaces.forEach(space => {
                    const li = document.createElement('li');
                    li.textContent = space; // Assuming space is the name of the area
                    spacesList.appendChild(li);
                });

                document.getElementById('totalPrice').textContent = `฿${totalPrice.toLocaleString()}`;

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('reservationModal'));
                modal.show();
            } else {
                alert('กรุณาเลือกพื้นที่ที่ต้องการจอง'); // Please select the spaces to purchase
            }
        }

        function parsePrice(priceText) {
            // Convert price text to a number
            return parseFloat(priceText.replace(/[^0-9.-]+/g, "")); // Remove non-numeric characters
        }

        // Function to show details of the selected space
        function viewDetails(spaceTitle, spacePrice, spaceStatus, spaceDescription, spaceId) {
            // Set content in modal
            document.getElementById(`spaceTitle${spaceId}`).innerText = spaceTitle;
            document.getElementById(`spacePrice${spaceId}`).innerText = spacePrice;
            document.getElementById(`spaceStatus${spaceId}`).innerText = spaceStatus;
            document.getElementById(`spaceDescription${spaceId}`).innerText = spaceDescription;

            // Show modal
            const detailsModal = new bootstrap.Modal(document.getElementById(`spaceDetailsModal${spaceId}`));
            detailsModal.show();
        }

        // ฟังก์ชันยืนยันการจองพื้นที่ที่เลือก
        function confirmRental() {
            const selectedSpaces = document.querySelectorAll('input[name="space"]:checked');
            const selectedIds = Array.from(selectedSpaces).map(space => space.value);

            if (selectedIds.length > 0) {
                alert("คุณได้ทำการจองพื้นที่แล้ว!");

                // อัปเดตสถานะใน UI
                selectedIds.forEach(space => {
                    const spaceElement = document.querySelector(`input[value="${space}"]`);
                    const statusElement = spaceElement.parentElement.querySelector('.status');
                    statusElement.innerText = 'ไม่ว่าง';
                    statusElement.classList.remove('available');
                    statusElement.classList.add('rented');
                });

                // ส่งข้อมูลการจองไปยังเซิร์ฟเวอร์
                fetch('save_reservation.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ selectedSpaces: selectedIds })
                }).then(response => response.json())
                .then(data => {
                    // บันทึกการจองใน Local Storage
                    let reservations = JSON.parse(localStorage.getItem('reservations')) || [];
                    selectedIds.forEach(space => {
                        reservations.push(space);
                    });
                    localStorage.setItem('reservations', JSON.stringify(reservations));

                    // อัปเดตสถานะในฐานข้อมูล
                    updateStatus(selectedIds);
                });
            } else {
                alert("กรุณาเลือกพื้นที่ที่ต้องการจอง");
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const reservations = JSON.parse(localStorage.getItem('reservations')) || [];
            
            // แสดงการจองใน DOM
            const reservationList = document.getElementById('reservationList');
            reservationList.innerHTML = ''; // เคลียร์รายการก่อน
            
            if (reservations.length > 0) {
                reservations.forEach(reservation => {
                    const reservationItem = document.createElement('div');
                    reservationItem.className = 'col-md-4 mb-3 reservation-item';
                    reservationItem.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${reservation}</h5>
                                <p class="card-text">
                                    <strong>ราคา:</strong> ฿1,200/เดือน<br>
                                    <strong>รายละเอียด:</strong> ...<br> <!-- เพิ่มรายละเอียดอื่นๆ ตามต้องการ -->
                                </p>
                                <button class="btn btn-danger" onclick="cancelReservation('${reservation}')">ยกเลิก</button>
                            </div>
                        </div>
                    `;
                    reservationList.appendChild(reservationItem);
                });
            } else {
                reservationList.innerHTML = '<div class="col-12"><p>ไม่มีข้อมูลการจอง</p></div>';
            }
        });

        function updateReservationDetails(reservations) {
            const reservationContainer = document.querySelector('.reservation-details .row');
            reservationContainer.innerHTML = ''; // เคลียร์ข้อมูลเก่า

            if (reservations && reservations.length > 0) { // เพิ่มการตรวจสอบ
                reservations.forEach(reservation => {
                    const card = document.createElement('div');
                    card.className = 'col-md-4 mb-3';
                    card.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${reservation.title}</h5>
                                <p class="card-text">
                                    <strong>ราคา:</strong> ${reservation.price} บาท<br>
                                    <strong>รายละเอียด:</strong> ${reservation.description}<br>
                                </p>
                            </div>
                        </div>`;
                    reservationContainer.appendChild(card);
                });
            } else {
                reservationContainer.innerHTML = '<div class="col-12"><p>ไม่มีข้อมูลการจอง</p></div>';
            }
        }

        // ฟังก์ชันส่งข้อมูลพื้นที่ที่เลือกไปยังเซิร์ฟเวอร์เพื่ออัปเดตสถานะ
        function updateStatus(selectedIds) {
            if (selectedIds.length > 0) {
                fetch('updateStatus.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ selectedIds: selectedIds }),
                })
                .then(response => response.json())
                .then(data => {
                    // แสดงข้อความสถานะที่ได้รับ
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                alert("กรุณาเลือกพื้นที่ที่ต้องการจอง");
            }
        }

        function showReservationModal() {
            // ปิดโมดัลพื้นที่
            const spaceModal = bootstrap.Modal.getInstance(document.getElementById('spaceDetailsModal2'));
            if (spaceModal) {
                spaceModal.hide(); // ปิดโมดัล
            }

            // เปิดโมดัลการจอง
            const reservationModal = new bootstrap.Modal(document.getElementById('reservationModal'));
            reservationModal.show();
        }

        $(document).ready(function() {
            $('#reservationModal').modal('show'); // เปิดโมดัลทันที
        });

        function loadSpaceStatus() {
            fetch('load_space_status.php') // ดึงข้อมูลสถานะพื้นที่จากเซิร์ฟเวอร์
                .then(response => response.json())
                .then(data => {
                    updateSpaceUI(data); // อัปเดต UI ด้วยข้อมูลสถานะ
                })
                .catch(error => {
                    console.error('Error loading space status:', error);
                });
        }

        function updateSpaceUI(spaces) {
            spaces.forEach(space => {
                const statusElement = document.querySelector(`input[value="${space.title}"]`).parentElement.querySelector('.status');
                statusElement.innerText = space.status; // แสดงสถานะที่ดึงมาจากเซิร์ฟเวอร์
                statusElement.classList.toggle('rented', space.status === 'ไม่ว่าง');
                statusElement.classList.toggle('available', space.status === 'ว่าง');
                const checkbox = document.querySelector(`input[value="${space.title}"]`);
                checkbox.disabled = (space.status === 'ไม่ว่าง'); // ปิดไม่ให้เลือก
            });
        }
    </script>

    <style>
    .modal {
        z-index: 1050; /* ค่า z-index ปกติสำหรับ Bootstrap */
    }
    #reservationModal {
        z-index: 1060; /* ปรับให้สูงกว่าค่า z-index ปกติ */
    }
    </style>




    <?php include("footer.php") ?>  
    <!-- Bootstrap JavaScript (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
    
</body>
</html>
