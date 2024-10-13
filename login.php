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
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    
    <style>
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                color: #ffffff;
            }
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 769px) {
            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
        }

        .navbar-toggler {
            border: none;
        }

        .masthead {
            background-color: #343a40;
            color: #ffffff;
            padding: 100px 20px;
            text-align: center;
        }

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

        .status.available {
            color: #28a745;
        }

        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }

        .grid-container {
            display: flex; /* ใช้ Flexbox สำหรับจัดเรียงการ์ดในแถว */
            justify-content: space-between; /* จัดเรียงให้มีพื้นที่ระหว่างการ์ด */
            flex-wrap: wrap; /* ช่วยให้การ์ดเลื่อนลงเมื่อพื้นที่ไม่พอ */
            margin: 20px; /* เพิ่มระยะห่างรอบ ๆ กริด */
        }

        .card {
            flex: 1; /* ให้การ์ดแต่ละใบมีขนาดเท่ากัน */
            margin: 10px; /* เพิ่มระยะห่างระหว่างการ์ด */
            max-width: 300px; /* กำหนดความกว้างสูงสุดของการ์ด */
            /* หากคุณต้องการให้การ์ดมีความสูงเท่ากัน สามารถเพิ่มความสูงที่กำหนด */
        }
    </style>
</head>
<body id="page-top">
    
    <!-- Navigation-->
    <?php include("nav.php") ?>

    <!-- Masthead-->
    <header class="masthead">
        <div class="text-center">
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
                <div class="grid-container">
                    <div class="card" style="background: url('assets/img/tokyo-Master.jpg') no-repeat center center; background-size: cover;">
                        <div class="card-body">
                            <input type="checkbox" id="space1" name="space" value="ตลาดดินแดง(จำนงค์) พื้นที่ 1" class="checkbox-overlay">
                            <h3>พื้นที่ 1</h3>
                            <p class="price">฿2,500/เดือน</p>
                            <p class="status available">ว่าง</p>
                            <button class="btn btn-info" onclick="viewDetails('พื้นที่ 1', '฿2,500/เดือน', 'ว่าง', 'รายละเอียดของพื้นที่ 1')">ดูรายละเอียด</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- โมดัลสำหรับแสดงรายละเอียด -->
            <div class="modal fade" id="spaceDetailsModal" tabindex="-1" aria-labelledby="spaceDetailsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="spaceDetailsLabel">รายละเอียดพื้นที่</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h3 id="spaceTitle"></h3>
                            <p><strong>ราคา: </strong><span id="spacePrice"></span></p>
                            <p><strong>สถานะ: </strong><span id="spaceStatus"></span></p>
                            <p><strong>รายละเอียด: </strong><span id="spaceDescription"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary" onclick="rentSpace()">เช่าพื้นที่</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal ยืนยันการเช่า -->
            <div class="modal fade" id="confirmRentalModal" tabindex="-1" aria-labelledby="confirmRentalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRentalLabel">ยืนยันการเช่า</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            คุณต้องการเช่าพื้นที่นี้ใช่หรือไม่?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="confirmRental()">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ปุ่มยืนยันสำหรับทั้งตลาด -->
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary" onclick="purchaseSelected()" style="transition: background-color 0.3s, transform 0.3s; color: rgb(255, 255, 255); cursor: pointer; box-shadow: 0 4px 8px rgba(26, 189, 153, 0.781);" onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.05)';" onmouseout="this.classList.toggle('btn-primary', true); this.style.transform='scale(1)';">
                    ซื้อพื้นที่ที่เลือก
                </button>
            </div>

            <!-- แสดงพื้นที่ที่เลือก -->
            <div id="selected-spaces" class="container px-4 px-lg-5 mt-5"></div>
        </div>
    </section>

    <?php include("footer.php") ?>

    <script>
        // ฟังก์ชันแสดงรายละเอียดพื้นที่ใน Modal
        function viewDetails(title, price, status, description) {
            document.getElementById('spaceTitle').textContent = title;
            document.getElementById('spacePrice').textContent = price;
            document.getElementById('spaceStatus').textContent = status;
            document.getElementById('spaceDescription').textContent = description;

            var detailsModal = new bootstrap.Modal(document.getElementById('spaceDetailsModal'), {
                backdrop: 'static',
                keyboard: false
            });
            detailsModal.show();
        }

        // ฟังก์ชันสำหรับเช่าพื้นที่
        function rentSpace() {
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmRentalModal'), {
                backdrop: 'static',
                keyboard: false
            });
            confirmModal.show();
        }

        // ฟังก์ชันยืนยันการเช่า
        function confirmRental() {
            alert("เช่าพื้นที่สำเร็จ!");
            var confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmRentalModal'));
            confirmModal.hide();
        }

        // ฟังก์ชันสำหรับซื้อพื้นที่ที่เลือก
        function purchaseSelected() {
            var selected = document.querySelectorAll('.checkbox-overlay:checked');
            var selectedSpaces = Array.from(selected).map(checkbox => checkbox.value).join(", ");
            document.getElementById('selected-spaces').textContent = "พื้นที่ที่เลือก: " + selectedSpaces;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>
