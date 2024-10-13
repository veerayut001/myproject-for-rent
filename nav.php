    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5"  >
            <a class="navbar-brand"  href="index.php" >JONG KAB CHAN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                เมนู
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="store.php">ร้านค้า</a></li>
                    <li class="nav-item"><a class="nav-link" href="d_contact.php">ติดต่อ</a></li>
                    <li class="nav-item"><a class="nav-link" href="u_profile.php">บัญชีของฉัน</a></li>
                    <li class="nav-item">
                    <a class="nav-link" href="u_profile.php" style="display: flex; align-items: center;">
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <i class="fas fa-user-circle" style="font-size: 50px; color: #00ff00; margin-left: 10px;"></i> <!-- สีเขียวถ้าล็อกอิน -->
                        <?php else: ?>
                            <i class="fas fa-user-circle" style="font-size: 50px; color: #ff0000; margin-left: 10px;"></i> <!-- สีแดงถ้าไม่ได้ล็อกอิน -->
                        <?php endif; ?>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>