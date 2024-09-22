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
    


</head>
<body>
    <!-- Navigation-->
    <?php include("nav.php") ?>

    <!-- Masthead-->
    <header class="masthead">
        <div class="text-center">
            <h1 class="mx-auto my-0 text-uppercase">Contact</h1>
            <html lang="en">
            
            </html></h1>
            <h2 class="mx-auto my-0 text-uppercase" style="color: rgb(201, 195, 195); font-size: 35px;">จองกับฉัน</h2>
            <p class="text-white-50 mx-auto mt-2 mb-5" style="font-size: 15px;">สอบถามติดต่อข้อมูลจากทางเรา</p>
            <a class="btn btn-primary" href="#con" >ติดต่อ</a>
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
                            <p><strong>โทรศัพท์:</strong> 080-123-4567</p>
                            <p><strong>อีเมล:</strong> info@example.com</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- ฟอร์มติดต่อ -->
            <div class="contact-form mb-4 mb-lg-5">
                <h2 class="text-uppercase" style="color: #109e6f;">ฟอร์มติดต่อ</h2>
                <form action="/submit-form" method="post" style="color: #109e6f;">
                    <div class="form-group mb-3">
                        <label for="name">ชื่อ:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="email">อีเมล:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="message">ข้อความ:</label>
                        <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">ส่งข้อความ</button>
                </form>
            </div>
    
            <!-- แผนที่ -->
            <div class="map mb-4 mb-lg-5">
                <h2 class="text-uppercase" style="color: #109e6f;">แผนที่</h2>
                <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
