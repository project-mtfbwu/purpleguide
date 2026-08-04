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
        <style>
            .sinup-box {
                display: none;
                flex-direction: column;
            }
            .sinup-box.active {
                display: flex;
            }
            .alert {
                padding: 12px 16px;
                margin-bottom: 20px;
                border-radius: 4px;
                font-size: 14px;
            }
            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
        </style>
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

   <?php $this->load->view('sidebar'); ?>

   <?php
        $login_signup_open = !empty($signup_open);
        $login_signup_email = isset($signup_email) ? (string) $signup_email : '';
        if ($login_signup_email !== '' && !filter_var($login_signup_email, FILTER_VALIDATE_EMAIL)) {
            $login_signup_email = '';
        }
    ?>
   <div class="wrapper-content mobile-login-pgs">
    <!-- AboutUs -->
    <section class="login-box mobile-login-box pt-0 about-section half-section overlap-height position-relative overflow-hidden minus-5 pt-3">
        <div class="container overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">
               
                
                <div class="col-lg-5 col-md-12 w-445px">
                 
                    <div class="sinup-box<?= $login_signup_open ? '' : ' active' ?>" id="loginForm">
                        <h5 class="fnt-family fs-35 text-black mb-3 mt-15 mobile-fs-24">Welcome</h5>
                        <!-- <button type="button" class="btn btn-google">
                            <img src="<?= base_url('assets/img/google.png')?>" />
                            Sign up with Google
                        </button> -->

                        <a href="<?= base_url('Googlelogins/googleLogin') ?>" class="btn btn-google ht-48 fs-18 lh-24 fw-800">
                            <img src="<?= base_url('assets/img/google.png')?>" />
                           Continue with Google
                        </a>

                        <h2 class="mb-0 text-center fs-18 text-black lh-20 mt-5">OR</h2>

                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>

                    <form action="<?= base_url('Login/login') ?>" method="post">
                        <input type="hidden" name="redirect" value="<?= htmlspecialchars(isset($redirect) ? (string)$redirect : '', ENT_QUOTES, 'UTF-8') ?>">
                        <div class="form-controls">
                            <label class="mb-0">Email address</label>
                            <div class="input-groups">
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-controls mt-3">
                            <label class="mb-0">Password</label>
                            <div class="input-groups">
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-controls d-flex gap-1 mt-3 mb-3 justify-content-space align-items-center">
                            <button type="submit" class="btn btn-purple w-258px fs-16 nowrap mobile-fs-14">Access your #PGS account</button>
                                                    </div>


                    </form>         
                            <a href="<?= base_url('Forgot_password'); ?>" class="text-black nowrap mobile-fs-15s">Forgot Password?</a>
                        <div class="mt-10 mb-3">
                            <h4 class="mb-0 gap-3 d-flex fs-20 justify-content-center text-black mobil-flex-align-center fw-500 mobile-fs-13">Don't have an
                                account ? <button type="button" class="btn btn-outline-purple" onclick="showSignup()">Sign up</button></h4>
                        </div>
                        <div class="mt-10 mb-3">
                            <span class="mb-0 gap-1 d-flex fs-20 justify-content-center text-black mobile-fs-12">Secure & Private
                                ⚡️<span><span class="text-purple text-decoration-none">98%</span> Success
                                    Rate</span></span>
                        </div>
                    </div>

                    <div class="sinup-box<?= $login_signup_open ? ' active' : '' ?>" id="signupForm">
                        <h5 class="fnt-family fs-35 text-black mb-3 mt-15 mobile-fs-24">create an account</h5>
                        <!-- <button type="button" class="btn btn-google">
                            <img src="<?= base_url('assets/img/google.png')?>" />
                            Continue with Google
                        </button> -->
                        <a href="<?= base_url('Googlelogins/googleLogin') ?>" class="btn btn-google ht-48 fs-18 lh-24 fw-800">
                            <img src="<?= base_url('assets/img/google.png')?>" />
                           Continue with Google
                        </a>

                        <h2 class="mb-0 text-center fs-18 text-black lh-20 mt-5">OR</h2>
                        
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('Login/register') ?>" method="post" id="registerForm">
                            <div class="form-controls">
                                <label class="mb-0">Email address</label>
                                <div class="input-groups">
                                    <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($login_signup_email, ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                            </div>
                            <div class="form-controls mt-3">
                                <label class="mb-0">Password</label>
                                <div class="input-groups">
                                    <input type="password" name="password" class="form-control" required minlength="6">
                                </div>
                            </div>
                            <div class="form-controls mt-3">
                                <label class="mb-0">Confirm Password</label>
                                <div class="input-groups">
                                    <input type="password" name="confirm_password" class="form-control" required minlength="6">
                                </div>
                            </div>
                            <div class="form-controls d-flex gap-5 mt-3 mb-3 justify-content-start align-items-center">
                                <button type="submit" class="btn btn-purple w-258px">Create #PGS Account</button>
                            </div>
                        </form>
                        <div class="mt-10 mb-3">
                            <h4 class="mb-0 gap-3 d-flex fs-22 justify-content-center text-black fw-500 align-items-center">Already have an account ?
                                <button type="button" class="btn btn-outline-purple" onclick="showLogin()">Log in</button></h4>
                        </div>
                        <div class="mt-10 mb-3">
                            <span class="mb-0 gap-1 d-flex fs-20 justify-content-center text-black mobile-fs-12">Secure & Private
                                ⚡️<span><span class="text-purple text-decoration-none">98%</span> Success
                                    Rate</span></span>
                        </div>
                    </div>
                   
                </div>
            </div>
    </section>

    <!-- END AboutUs -->

 <!--<section class="about-section half-section overlap-height position-relative overflow-hidden pt-13">-->
 <!--           <div class="overlap-gap-section p-0 w-863px m-auto">-->
 <!--               <div class="row align-items-center justify-content-md-center">-->

 <!--                   <div class="col-lg-12 col-md-12">-->

 <!--                       <div class="card card-comment">-->
 <!--                           <h5>-->
 <!--                               <span class="fnt-50">“</span>-->
 <!--                               <span>-->
 <!--                                 From your first step to your final admit -->
 <!--                                   or medical pathway — our expert counselors -->
 <!--                                   guide the entire journey with you.-->
 <!--                                   <span class="fnt-50 dot-flot-1">”</span>-->
 <!--                               </span>-->
 <!--                           </h5>-->
 <!--                           <div class="tag-comment">-->
 <!--                               <div class="tag-border">-->
 <!--                                   purpleguide.study-->
 <!--                               </div>-->
 <!--                           </div>-->
 <!--                       </div>-->

 <!--                   </div>-->
 <!--               </div>-->
 <!--               </div>-->

 <!--       </section>-->
        
        <section class="pt-4 pb-5">
            <div class="w-863px fs-12 m-auto">
                <div class="d-flex justify-content-space counter-style-04 mobile-grid mobile-grid-2 full-width-mobile">
                    <div class="w-128px last-paragraph-no-margin text-center sm-mb-40px">
                        <h3 class="d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0 cutsom-count-1">4/5</h3>
                        <p>of our students built a significantly stronger profile after working with us.</p>
                    </div>
                    
                    <div class="w-128px last-paragraph-no-margin text-center sm-mb-40px">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="90"><sup class="text-jungle-green top-0"></sup></h3>
                        <p>of our students received a confirmed offer letter in just four weeks.*</p>
                    </div>
                    <div class="w-128px last-paragraph-no-margin text-center xs-mb-40px">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="94"><sup class="text-jungle-green top-0"></sup></h3>
                        <p>of our students successfully earned scholarships with our proven strategies.**</p>
                    </div>
                    <div class="w-128px last-paragraph-no-margin text-center">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="85"><sup class="text-jungle-green top-0"></sup></h3>
                        <p class="mb-15px">of our students earned a spot at one of their top-choice universities.</p>
                    </div>
                    <div class="w-128px last-paragraph-no-margin text-center">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="95"><sup class="text-jungle-green top-0"></sup></h3>
                        <p class="mb-15px">of our medical aspirants achieved their USMLE, PLAB, and AMC goals.</p>
                    </div>
                </div>
             </div>
              <div class="w-80 m-auto nowrap">
                <div class="row row-cols-4 row-cols-md-4 pt-4 pb-0 row-cols-sm-2 justify-content-end counter-style-05">
                    <div class="w-313px last-paragraph-no-margin text-center sm-mb-40px">
                        <div>
                            <p><span>*</span>Applicable to our partnered universities.</p>
                        </div>
                        <div>
                            <p><span>**</span>Medical professionals typically receive a salary, stipend.</p>
                        </div>
                        <div>
                            <p><span>**</span>Scholarships or assistantships for non-medical.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <section class="pt-4 pb-5">
        <div class="w-803px m-auto">

            <h5 class="mb-4 fnt-family fs-38 text-center text-black">What You Get as a Member</h5>
            <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2 justify-content-start counter-style-04">
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">VIP Access</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Priority Expert Consultation</h6>
                        </div>
                        <div class="card-half-content">
                            Skip the queue and get instant access to our senior counselors
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">Members Only</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Exclusive Scholarship Alerts</h6>
                        </div>
                        <div class="card-half-content">
                            Access to scholarships guidance from bottom up
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">#PurplePremium</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Personalized University Matching</h6>
                        </div>
                        <div class="card-half-content">
                            Mentor-powered recommendations
                            based on your profile
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">VIP Access</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Application Tracking Dashboard</h6>
                        </div>
                        <div class="card-half-content">
                            Skip the queue and get instant access to our senior counselors
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">Members Only</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">USMLE <br />
                                Pathway Group</h6>
                        </div>
                        <div class="card-half-content">
                            Access to scholarships guidance from bottom up
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">#PurplePremium</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Plab <br />
                                Pathway Group</h6>
                        </div>
                        <div class="card-half-content">
                           Mentor-powered recommendations 
based on your profile
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">VIP Access</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">AMC <br />
                                Pathway Group</h6>
                        </div>
                        <div class="card-half-content">
                            Skip the queue and get instant access to our senior counselors
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">Members Only</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Application <br /> Tracking Dashboard</h6>
                        </div>
                        <div class="card-half-content">
                            Access to scholarships guidance from bottom up
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mobile-w-50 mb-3">
                    <div class="card-half-bg">
                        <div class="yellow-bg-header">
                            <small class="m-auto d-block text-end text-black">#PurplePremium</small>
                            <img src="<?= base_url('assets/img/crown.png')?>" />
                            <h6 class="mb-0">Member Community & <br /> Networking</h6>
                        </div>
                        <div class="card-half-content">
                            Mentor-powered recommendations
                            based on your profile
                        </div>
                    </div>
                </div>

            </div>
            <h6 class="text-end fs-24 lh-40 fw-600 text-black">& More</h6>
        </div>
    </section>
    
     <section class="about-section half-section overlap-height position-relative overflow-hidden pt-10">
            <div class="overlap-gap-section p-0 w-863px m-auto">
                <div class="row align-items-center justify-content-md-center">

                    <div class="col-lg-12 col-md-12">

                        <div class="card card-comment">
                            <h5>
                                <span class="fnt-50">“</span>
                                <span>
                                  From your first step to your final admit 
                                    or medical pathway — our expert counselors 
                                    guide the entire journey with you.
                                    <span class="fnt-50 dot-flot-1">”</span>
                                </span>
                            </h5>
                            <div class="tag-comment">
                                <div class="tag-border">
                                    purpleguide.study
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>

        </section>
    </div>



    <?php $this->load->view('footer'); ?>


    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <!--<script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>-->
    <!--<script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>-->
    <!--<script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>-->
    <!--<script type="text/javascript" src="<?= base_url('assets/js/pgs-autocomplete.js')?>"></script>-->

    <script>
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');
        function showSignup() {
            loginForm.classList.remove('active');
            signupForm.classList.add('active');
        }
        function showLogin() {
            signupForm.classList.remove('active');
            loginForm.classList.add('active');
        }
    </script>
    
       <script>
        const drawer = document.getElementById("drawer");
        const overlay = document.getElementById("overlay");
    
        function openDrawer() {
          drawer.classList.add("active");
          overlay.classList.add("active");
        }
    
        function closeDrawer() {
          drawer.classList.remove("active");
          overlay.classList.remove("active");
        }
      </script>
          

</body>

</html>