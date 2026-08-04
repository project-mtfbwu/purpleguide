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
        @media (max-width: 767px) {
    .avatar-box {
        flex-direction: column;
        gap: 0px !important;
        display: none;
    }
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


    <div class="wrapper-content">

        <!-- AboutUs -->
        <section class="pt-0 about-section half-section overlap-height position-relative" style="margin-top : -3%">
            <div class=" m-auto overlap-gap-section p-0">
                <div class="row align-items-center justify-content-md-center">


                    <div class="">
						
                        <div class="text-center mobile-flow-arrow">
						<img src="<?= base_url('assets/img/arrow-down-1.png')?>" class="newarrow-singup" />
						<h5 class="fnt-family text-black fs-48 text-start m-auto" style="width : 327px;">Start by choosing your pathway.</h5>
						</div>
						
                        <div class="path ">
                            <div class="heart-icon w-80">
                                <i class="bi bi-heart-fill"></i>
                            </div>

                            <div data-target="content1"
                                class="d-flex w-723px m-auto justify-content-center align-items-center gap-1 mt-2 path-item flex-item-m">
                                <div class="bg-path">
                                    <span>path 1</span>
                                    <br />
                                    <i class="bi bi-arrow-right-short fs-40"></i>
                                </div>
                                <h5 class="mb-0 fs-18 lh-25 text-black bg-gray border-radius-8px p-2 fw-500">
                                    For all from — <br />
                                    STEM, MBA or Masters, Law & Undergrad abroad.
                                </h5>
                            </div>
							
							 <!-- <div data-target="content2">-->

                            <div data-target="content1"
                                class="d-flex w-723px m-auto justify-content-center align-items-center gap-1 mt-2 path-item flex-item-m">
                                <div class="bg-path">
                                    <span>path 2</span>
                                    <br />
                                    <i class="bi bi-arrow-right-short fs-40"></i>
                                </div>
                                <h5 class="mb-0 fs-18 lh-25 text-black bg-gray border-radius-8px p-2 fw-500">
                                    For Everything Medical-Related — We’ve Got Two Dedicated Tracks:<br />
                                    Track 1: Medical Pathways — USMLE, PLAB, AMC.<br />
                                    Track 2: Nursing, Allied Health, Physiotherapy & More
                                </h5>
                            </div>
                        </div>
                        
                        <div class="w-704px m-auto">

                        <div class="content" id="content1" style="display : none;">
                            <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $this->session->flashdata('error') ?>
                                </div>
                            <?php endif; ?>
                            
                            <!--<?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $this->session->flashdata('success') ?>
                                </div>
                            <?php endif; ?>-->
                            
                            <form action="<?= base_url('Singup/singup') ?>" method="post" enctype="multipart/form-data">
                                <div class="singup-process mt-10 w-80 m-auto">
                                    <div class="choose-avatar d-flex align-items-center gap-3 position-relative">
                                        <div class="circle-avartar">
                                            <img id="avatarPreview" src="<?= isset($user->image1) && $user->image1 ? base_url('assets/images/'.$user->image1) : base_url('assets/img/avatar.png') ?>" alt="avatar" />
                                        </div>
                                        <div class="choose-avatar-text">
                                            <label for="chooseImg">
                                                <img src="<?= base_url('assets/img/edit-03.png')?>" />
                                            </label>
                                            <input type="file" id="chooseImg" name="profile_image" accept="image/*" class="d-none">
                                        </div>
                                        <p class="mb-0">Upload your pic here for personalization , preferably in square</p>
                                    </div>
                                    <hr />
                                </div>
                                <div class="w-100 m-auto black-border">
                                    <div class="form-group d-flex align-items-center border-bottom pb-2">
                                        <label for="name" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Full Name</label>
                                        <input type="text" name="name" class="form-control w-70 p-2" id="name" placeholder="Full Name" value="<?= isset($user->name) ? htmlspecialchars($user->name) : '' ?>" required>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="email" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Email</label>
                                        <input type="email" name="email" class="form-control w-70 p-2" id="email" value="<?= isset($user->email) ? htmlspecialchars($user->email) : '' ?>" readonly style="background-color: #f0f0f0;">
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="dial_code" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Phone Number</label>
                                        <div class="w-70 d-flex gap-2">
                                            <select name="dial_code" id="dial_code" class="form-control w-30 p-2" required>
                                                <option value="">Code</option>
                                                <?php foreach($dial_codes as $code): ?>
                                                    <option value="<?= $code->dial_code ?>" <?= (isset($user->dial_code) && $user->dial_code == $code->dial_code) ? 'selected' : '' ?>>
                                                        <?= $code->dial_code ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="number" class="form-control w-70 p-2" placeholder="Phone Number" value="<?= isset($user->number) ? htmlspecialchars($user->number) : '' ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group nowrap d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Whatsapp Number</label>
                                        <div class="d-flex align-items-center gap-3 lh-20-m">
                                            <div class="d-flex gap-2 align-items-center w-m-50">
                                                <label for="whatsappYes">Yes</label>
                                                <input type="radio" name="whatsapp" id="whatsappYes" value="Yes" class="form-check-input" style="padding: 12px !important;" <?= (isset($user->whatsapp) && $user->whatsapp == 'Yes') ? 'checked' : '' ?> required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-center w-m-50">
                                                <label for="whatsappNo">No</label>
                                                <input type="radio" name="whatsapp" id="whatsappNo" value="No" class="form-check-input" style="padding: 12px !important;" <?= (isset($user->whatsapp) && $user->whatsapp == 'No') ? 'checked' : '' ?>>
                                            </div>
                                            Is the above number on Whatsapp?
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="country_code" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Country of Citizenship</label>
                                        <select name="country_code" id="country_code" class="w-70 form-select border-radius-8px p-2" required>
                                            <option value="">-- Select Country --</option>
                                            <?php foreach($countries as $country): ?>
                                                <option value="<?= $country->country_name ?>" <?= (isset($user->country_code) && $user->country_code == $country->country_name) ? 'selected' : '' ?>>
                                                    <?= $country->country_name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="preferred_country_code" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Preferred Study Country</label>
                                        <select name="preferred_country_code" id="preferred_country_code" class="w-70 form-select border-radius-8px p-2" required>
                                            <option value="">-- Preferred Study Country --</option>
                                            <?php foreach($countries as $country): ?>
                                                <option value="<?= $country->country_name ?>" <?= (isset($user->preferred_country_code) && $user->preferred_country_code == $country->country_name) ? 'selected' : '' ?>>
                                                    <?= $country->country_name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="study_level" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Study Level</label>
                                        <select name="study_level" id="study_level" class="w-70 form-select border-radius-8px p-2" required>
                                            <option value="">-- Study Level --</option>
                                            <option value="UG" <?= (isset($user->study_level) && $user->study_level == 'UG') ? 'selected' : '' ?>>UG</option>
                                            <option value="PG" <?= (isset($user->study_level) && $user->study_level == 'PG') ? 'selected' : '' ?>>PG</option>
                                            <option value="PhD" <?= (isset($user->study_level) && $user->study_level == 'PhD') ? 'selected' : '' ?>>PhD</option>
                                            <option value="Post MBBS" <?= (isset($user->study_level) && $user->study_level == 'Post MBBS') ? 'selected' : '' ?>>Post MBBS</option>
                                            <option value="Medical Student" <?= (isset($user->study_level) && $user->study_level == 'Medical Student') ? 'selected' : '' ?>>Medical Student</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="field_interest" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Course or Field of Interest</label>
                                        <textarea name="field_interest" id="field_interest" class="w-70 form-control" rows="3"><?= isset($user->field_interest) ? htmlspecialchars($user->field_interest) : '' ?></textarea>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="work_experience" class="form-label w-50 lh-30 text-black fs-20 fw-500 mb-0">Work Experience <span> (If Any)</span></label>
                                        <textarea name="work_experience" id="work_experience" class="w-70 form-control" rows="3"><?= isset($user->work_experience) ? htmlspecialchars($user->work_experience) : '' ?></textarea>
                                    </div>
                                    <div class="form-group d-flex align-items-center pb-2 pt-2 border-bottom">
                                        <label for="referral_code" class="form-label w-50 lh-30 text-black fs-20 fw-500 mb-0">Referral Code</label>
                                        <input type="text" name="referral_code" id="referral_code" class="form-control w-70 p-2" value="<?= isset($user->referral_code) ? htmlspecialchars($user->referral_code) : '' ?>">
                                    </div>

                                    <div class="form-group d-flex align-items-start w-50 pb-3 pt-4 text-end m-w-100">
                                        <div class="form-password text-start">
                                            <input type="password" name="password" class="mb-3 p-2 border-radius-0px" placeholder="Set your password" required minlength="6">
                                            <input type="password" name="cpassword" class="mb-3 p-2 border-radius-0px" placeholder="Confirm your password" required minlength="6">
                                            <button type="submit" class="btn btn-purple w-50" style="background-color: #2489FF !important;">Complete Profile</button>
                                        </div>
                                    </div>

                                    <!-- Checkbox + OTP -->
                                    <div class="mt-4 text-sm">
                                        <p class="text-green-600 font-semibold mb-0 text-black">
                                            <b>✅ Checkbox:</b> <span class="text-black">"I agree to the Terms & Privacy Policy"</span>
                                        </p>
                                        <p class="text-green-700 font-semibold text-black">
                                            <b> 🔒 OTP Verification </b><span class="text-black">(Phone or Email)</span>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="content mt-20" id="content2" style="display:none;">
                            <div class="heart-icon w-100 text-center">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                        </div>
                        </div>





                    </div>
                </div>
        </section>

    </div>


      <!-- Footer -->
<div class="footer-bg">
    <section class="footer">
        <div class="flot-img">
            <img src="./assets/img/top.png" />
        </div>
        <!-- <footer> -->
        <div class="container pt-5 pb-8">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <div class="card-bg-pruple text-center w-210px">
                        <h4 class="mb-0 fs-20 lh-full mt-7">Currently studying? Become a mentor <br/> and help students.</h4>
                        <button type="button" class="btn btn-join">Join The Team!</button>
                    </div>
                </div>
                <div class="col-lg-5 offset-1">
                    <div class="yellow-bg">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-2">
                        <img src="./assets/img/mail.png" width="25px"> hello@purpleguide.study
                    </div>
                    <div class="yellow-bg mt-3">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-3">
                        <img src="./assets/img/mail.png" width="25px"> connect@purpleguide.study
                    </div>
                    <div class="social-flex mt-5 mb-3 d-flex align-items-center gap-3">
                        <img src="./assets/img/right.png" />
                        <h6 class="mb-0 text-white fs-20">Our Socials</h6>
                        <div class="social-img d-flex align-items-center gap-3">
                            <a href="#">
                                <img src="./assets/img/instagram.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/facebook.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/threads.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/youtube.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/linkdln.png">
                            </a>
                        </div>
                        <img src="./assets/img/left.png" />
                    </div>
                    
                    <div class="terms-content mt-6">
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Privacy Policy</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Terms & Conditions</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Refund Policy</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fs-14 lh-full mb-5 text-white">
                        <span class="fs-15"> For</span><br />
                        Feedback, <br /> Escalations <br /> & Complaints
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 align-items-start">
                        <img src="./assets/img/mail.png" width="25px">
                        <div>
                            <span class="" style="white-space:nowrap;">hey@purpleguide.study</span>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">We’re a project-first team, and we try to sort out
                                complaints within 7 business days.
                                Good vibes or tough love: your feedback actually helps us level up.</p>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">All emails sent to this address will stay
                                anonymous—unless we spot any signs of misuse or suspicious activity.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- </footer> -->
    </section>

    <section class="copyrght">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center">
                        <h4 class="w-20 text-white">#PGS</h4>
                        <div class="d-flex align-items-center gap-4">
                            <h4 class="text-white fs-24  fw-700 lh-28">(For Mentors) Help Students Choose <br/>
                                Smarter – Earn with Our Referral Program</h4>
                            <h4 class="text-white fw-700 fs-24 lh-28">(For Universities) Give Your Students a <br/>
                                Global Edge – Partner with #PGS</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>
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
        const pathItems = document.querySelectorAll('.path-item');
        const contents = document.querySelectorAll('.content');

        // Set the first item active by default
        //if (pathItems.length > 0) {
         //   pathItems[0].classList.add('active');
         //   contents[0].style.display = 'block';
        // }

        pathItems.forEach(item => {
            item.addEventListener('click', () => {
                // Remove active class from all items
                pathItems.forEach(el => el.classList.remove('active'));
                // Add active to clicked item
                item.classList.add('active');

                // Hide all content
                contents.forEach(c => c.style.display = 'none');

                // Show the selected content
                const target = item.getAttribute('data-target');
                document.getElementById(target).style.display = 'block';
            });
        });
    </script>
    <!-- <script>
        document.querySelectorAll('.path-item').forEach(item => {
            item.addEventListener('click', () => {
                // remove active from all
                document.querySelectorAll('.path-item').forEach(el => el.classList.remove('active'));
                // add active to clicked one
                item.classList.add('active');
            });
        });

    </script> -->
    <script>
        const chooseImg = document.getElementById('chooseImg');
        const avatarPreview = document.getElementById('avatarPreview');
        if (chooseImg) {
            chooseImg.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        avatarPreview.src = e.target.result; // update image preview
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>

</html>