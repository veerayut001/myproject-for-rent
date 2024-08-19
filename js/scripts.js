window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink');
        } else {
            navbarCollapsible.classList.add('navbar-shrink');
        }
    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    }

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

    // ฟังก์ชั่นสำหรับการเปลี่ยนสีเนวิเกชันบาร์
    var navbarColorChange = function() {
        const mainNav = document.getElementById('mainNav');
        const threshold = 128; // ระดับความเข้มของสีที่ใช้เป็นเกณฑ์
        const bgColor = window.getComputedStyle(document.body, null).getPropertyValue('background-color');
        const rgb = bgColor.match(/\d+/g);
        const brightness = (parseInt(rgb[0]) * 299 + parseInt(rgb[1]) * 587 + parseInt(rgb[2]) * 114) / 1000;

        if (window.scrollY > 100 || brightness < threshold) {
            mainNav.classList.remove('navbar-light');
            mainNav.classList.add('navbar-dark');
        } else {
            mainNav.classList.remove('navbar-dark');
            mainNav.classList.add('navbar-light');
        }
    };
    // เรียกใช้ฟังก์ชั่นเมื่อเลื่อนหน้า
    document.addEventListener('scroll', navbarColorChange);

    // เรียกใช้ฟังก์ชั่นทันทีที่โหลดหน้าเว็บเสร็จ
    navbarColorChange();
});
