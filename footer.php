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
    <!-- Footer-->
    <section class="contact-section bg-black">
        <div class="social d-flex justify-content-center">
        <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
        <a class="mx-2" href="https://web.facebook.com/keng.kk.2"><i class="fab fa-facebook-f"></i></a>
        <a class="mx-2" href="https://www.youtube.com/channel/UCLPoAGKuqUsHJwh51QWFhkw"><i class="fab fa-youtube"></i></a>

    </div>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50">
            
            <div class="container px-4 px-lg-5">Copyright &copy; Jong Kab Chan 2023</div>
        </footer>