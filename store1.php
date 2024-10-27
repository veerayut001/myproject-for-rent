<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: c_login.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
include("c_db_con.php");

$query = "SELECT id, title, status FROM rental_space";
$result = $conn->query($query);

$spaces = [];
while ($row = $result->fetch_assoc()) {
    $spaces[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JONG KAB CHAN | STORE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="assets/img/i2store.ico" type="image/x-icon">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round|Nunito:200,400,600,700,800,900" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    
    <style>
        /* Media query สำหรับหน้าจอขนาดเล็ก */
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                color: #ffffff;
            }
            .navbar-nav .nav-link:hover {
                color: #43a76d !important;
            }
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        /* Media query สำหรับหน้าจอขนาดใหญ่ */
        @media (min-width: 769px) {
            .navbar-nav .nav-link {
                color: #ffffff;
            }
            .navbar-nav .nav-link:hover {
                color: #1fac88 !important;
            }
            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
        }

        .navbar-toggler {
            border: none;
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
            height: 200px;
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
            display: none;
        }

        .status-count {
            color: #28a745;
        }

        .status-unavailable {
            color: #dc3545;
        }

        .status-total {
            color: blue;
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
                <div class="text-left" style="font-size: 14px; color: #00ff00;">
                    <h1 style="font-size: 3rem;">ยินดีต้อนรับ, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h1>
                </div>
            <?php else: ?>
                <div class="text-left" style="font-size: 14px; color: #ff0000;">
                    <h1 style="font-size: 3rem;">ยินดีต้อนรับ, </h1>
                </div>
            <?php endif; ?>
            <h1 class="mx-auto my-0 text-uppercase">Store</h1>
            <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>
            <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">เลือกพื้นที่ที่ดีที่สุดสำหรับคุณจากรายการของเรา</p>
            <a class="btn btn-primary" href="#store01">เลือกพื้นที่</a>
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
                    <div class="col-xl-4 col-lg-5 text-right" style="float: right;">
                        <div class="col-xl-4 col-lg-5 offset-lg-2 text-right">
                            <div class="status-summary" style="color: #109e6f;">
                                <p>ล็อคว่าง: <span id="available-count" class="status-count">4</span></p>
                                <p>ล็อคไม่ว่าง: <span id="unavailable-count" class="status-unavailable">2</span></p>
                                <p>รวมล็อค: <span id="total-count" class="status-total">6</span></p>
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
                                <button class="btn btn-info" data-space-id="1" data-price="฿1,400/เดือน" onclick="openModal(this)">รายละเอียด</button>
                            </div>
                        </div>

                        <div class="modal fade" id="spaceDetailsModal1" tabindex="-1" aria-labelledby="spaceDetailsLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="color: #109e6f;">
                                        <h5 class="modal-title" id="spaceDetailsLabel1">รายละเอียดพื้นที่ 1</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: #109e6f;">
                                        <h3 id="spaceTitle1">พื้นที่ 1</h3>
                                        <p><strong>ราคา: </strong><span id="spacePrice1">฿1,400/เดือน</span></p>
                                        <p><strong>สถานะ: </strong><span class="status" id="spaceStatus1">ว่าง</span></p>
                                        <p><strong>รายละเอียดเพิ่มเติม: </strong>พื้นที่นี้เหมาะสำหรับการค้าขายและจัดกิจกรรมต่างๆ</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <button type="button" id="confirm-button" data-space-id="1" class="btn btn-primary" onclick="confirmBooking()">ยืนยันการจอง</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- คุณสามารถทำซ้ำโครงสร้างนี้สำหรับพื้นที่เพิ่มเติม -->
                    </div>
                </div>
            </div>

            <!-- ตลาดเมืองทอง -->
            <div class="market-group" data-market="ตลาดเมืองทอง">
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h1 class="mx-auto my-0 text-uppercase" style="color: #109e6f;">ตลาดเมืองทอง</h1>
                            <p class="text-black-50 mb-0">เลือกพื้นที่แล้วกดยืนยันได้เลย!</p>
                        </div>
                    </div>

                    <div class="grid-container">
                        <!-- กริดพื้นที่สำหรับตลาดเมืองทอง -->
                        <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                            <div class="card-body">
                                <input type="checkbox" id="space2" name="space" value="ตลาดเมืองทอง พื้นที่ 1" class="checkbox-overlay">
                                <h3>พื้นที่ 1</h3>
                                <p class="price">฿1,600/เดือน</p>
                                <p class="status available">ว่าง</p>
                                <button class="btn btn-info" data-space-id="2" data-price="฿1,600/เดือน" onclick="openModal(this)">รายละเอียด</button>
                            </div>
                        </div>

                        <div class="modal fade" id="spaceDetailsModal2" tabindex="-1" aria-labelledby="spaceDetailsLabel2" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="color: #109e6f;">
                                        <h5 class="modal-title" id="spaceDetailsLabel2">รายละเอียดพื้นที่ 2</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: #109e6f;">
                                        <h3 id="spaceTitle2">พื้นที่ 2</h3>
                                        <p><strong>ราคา: </strong><span id="spacePrice2">฿1,600/เดือน</span></p>
                                        <p><strong>สถานะ: </strong><span class="status" id="spaceStatus2">ว่าง</span></p>
                                        <p><strong>รายละเอียดเพิ่มเติม: </strong>พื้นที่นี้มีการเดินทางที่สะดวกและสามารถรองรับลูกค้าได้มาก</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <button type="button" id="confirm-button" data-space-id="2" class="btn btn-primary" onclick="confirmBooking()">ยืนยันการจอง</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer-->
    <footer class="footer bg-light py-4">
        <div class="container">
            <div class="text-center">
                <p class="m-0 text-center text-black">© 2024 JONG KAB CHAN | All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    
    <script>
        function openModal(button) {
            const spaceId = button.getAttribute('data-space-id');
            const modal = new bootstrap.Modal(document.getElementById('spaceDetailsModal' + spaceId));
            modal.show();
        }

        function confirmBooking() {
            const spaceId = document.getElementById('confirm-button').getAttribute('data-space-id');

            fetch(`book_space.php?space_id=${spaceId}`, {
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const statusElement = document.querySelector(`#spaceDetailsModal${spaceId} .status`);
                    statusElement.innerText = 'ไม่ว่าง';
                    statusElement.classList.remove('available');
                    statusElement.classList.add('rented');
                    
                    alert('จองพื้นที่ ID: ' + spaceId + ' เรียบร้อยแล้ว!');
                } else {
                    alert('การจองไม่สำเร็จ: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการจองพื้นที่');
            });
        }
    </script>
</body>
</html>
