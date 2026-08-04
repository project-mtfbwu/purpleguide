<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <title>PGS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- favicon icon -->
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendors.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/icon.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/demos/marketing/marketing.css')?>" />
</head>

<body data-mobile-nav-style="classic" class="custom-cursor">
    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->
    <!-- start header -->

    <?php $this->load->view('header'); ?>
    
    <!-- end header -->

    <!-- user section -->
    <?php $this->load->view('sidebar'); ?>

    <!-- AboutUs -->
    <section class="pt-0 about-section half-section overlap-height position-relative overflow-hidden mobile-student-cart">
        <div class="container overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">

                <div class="col-lg-8 col-md-12">
                    <div class="card-box-avatar mobile-wrap mobile-p-none" data-anime='{ "el": "childs", "translateY": [60, 0], "opacity": [0,1], "duration": 1300, "delay": 0, "staggervalue": 130, "easing": "easeOutQuad" }'>
                        <div class="avatar-info position-relative">
                            <div class="avatar-img">
                                <img src="<?= base_url('assets/img/avatar.jpg')?>" alt="" class="border-radius-6px">
                            <!--     <div class="choose-avatar-text">-->
                            <!--    <label for="chooseImg">-->
                            <!--        <img src="<?= base_url('assets/img/edit-03.png')?>" />-->
                            <!--    </label>-->
                            <!--    <input type="file" id="chooseImg" accept="image/*" class="d-none">-->
                            <!--</div>-->
                                <div class="avatar_name">
                                    <h5 class="mb-3">Rajeev Singh</h5>
                                    <span>@rajsingh</span>
                                    <span>id: 2123456</span>
                                </div>
                            </div>
                            <div class="title-info">
                                <h5 class="mb-0">starter aspirant</h5>
                                <h6 class="mb-0">stem PATHWAY</h6>
                            </div>
                        </div>
                        <div class="avatar-heading-right">
                            <h4 class="mb-0 mobile-fs-20 mobile-br-none">Yet to <br /> Unlock <br />Full Access</h4>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <section class="pt-0 half-section overlap-height position-relative overflow-hidden">
        <div class="container overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">

                <div class="col-lg-4 col-md-12 explore-section mobile-w-80 mobile-m-auto" data-anime='{ "el": "childs", "translateY": [60, 0], "opacity": [0,1], "duration": 1300, "delay": 0, "staggervalue": 130, "easing": "easeOutQuad" }'>
                    <div class="card card-explore border-color-transparent">

                        <h3 class="mb-3 fw-500 fs-50 text-black mobile-fs-25">
                            Time for a quick
                            security refresh?
                        </h3>
                        <p class="mb-0 fs-18 fw-500">Change password here</p>
                     <form class="form-horizontal m-t-20" method="POST" action="<?php echo base_url('Forgot_password/forgot_password/'); ?>"
                                  onsubmit="return validatePasswords(event)">
                       <div class="form-group pb-3 pt-4">
                            <div class="form-password changePassword">
                                <input type="email" name="email" class="mb-3" placeholder="Enter Email" required>
                            </div>
                            <button type="submit" class="btn btn-purple w-35" style="background-color: #2489FF !important;">Submit</button>
                        </div>
                     </form>

                    </div>
                </div>
            </div>
    </section>
    <!-- END AboutUs -->



    <?php $this->load->view('footer'); ?>


    <!--<section class="copyrght">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-12">-->
    <!--                <div class="d-flex justify-content-center">-->
    <!--                    <h4 class="w-15 text-white">#PGS</h4>-->
    <!--                    <div class="d-flex align-items-center gap-4">-->
    <!--                        <h4 class="text-white fs-20 lh-28">(For Mentors) Help Students Choose-->
    <!--                            Smarter – Earn with Our Referral Program</h4>-->
    <!--                        <h4 class="text-white fs-20 lh-28">(For Universities) Give Your Students a-->
    <!--                            Global Edge – Partner with #PGS</h4>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- end section -->



    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>

    <script>
    function validatePassword() {
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;

        if (password !== cpassword) {
            alert("Password and Confirm Password do not match!");
            return false; // ❌ stop form submit
        }
        return true; // ✅ allow submit
    }
    </script>
</body>

</html>