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

<style>
    .avatar-box
    {
        display : none;
    }
</style>

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
        
        <section class="pt-0 mobile-student-cart minus-2 about-section half-section overlap-height position-relative overflow-hidden">
        <div class="overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">

                <div class="w-729px p-0">
                    <div class="card-box-avatar">
                        <div class="avatar-info position-relative">
                            <div class="avatar-img">
                                <img src="<?= (isset($user->image1) && $user->image1) ? base_url('assets/images/'.$user->image1) : base_url('assets/img/avatar.png') ?>" alt="<?= isset($user->name) ? htmlspecialchars($user->name) : 'Profile' ?>" class="border-radius-6px" data-no-retina="">
                                <div class="avatar_name">
                                    <h5 class="mb-3"><?= isset($user->name) ? htmlspecialchars($user->name) : 'User' ?></h5>
                                    <span><?= isset($user->email) ? htmlspecialchars($user->email) : '' ?></span>
                                    <span>id: <?= isset($user->id) ? (int)$user->id : '' ?></span>
                                </div>
                            </div>
                            <div class="title-info">
                                <h5 class="mb-0">#purplePremium</h5>
                                <h6 class="mb-0"><?= isset($user->study_level) && $user->study_level ? htmlspecialchars($user->study_level) . ' PATHWAY' : 'Profile' ?></h6>
                            </div>
                        </div>
                        <?php
                        $pp_logged_in = isset($user) && !empty($user);
                        $pp_premium = isset($premium_status) ? $premium_status : null;
                        ?>
                        <div class="avatar-heading-right-box w-170px <?= ($pp_logged_in && $pp_premium !== 'approved') ? 'justify-content-start' : '' ?>" style="<?= ($pp_logged_in && $pp_premium !== 'approved') ? 'padding-left: 10px;' : '' ?>">
                            <?php if ($pp_logged_in && $pp_premium === 'approved'): ?>
                                <h4 class="mb-0">#PURPLEPREMIUM</h4>
                            <?php elseif ($pp_logged_in && $pp_premium === 'pending'): ?>
                                <h4 class="mb-0 text-yellow">Already <br/> Applied</h4>
                            <?php else: ?>
                                <?php if ($pp_logged_in): ?>
                                    <h4 class="mb-0" style="cursor: pointer; transition: opacity 0.3s;">
                                        <a href="<?= base_url('Purplepremiumhome') . '?openPremium=1' ?>" class="premium-unlock-link text-black text-decoration-none" style="display: inline-block;" onclick="if (window.ppOpenModal) { return window.ppOpenModal(); }">
                                            Yet to <br/> Unlock Full <br/> Access
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="mb-0">
                                        <a href="<?= base_url('Login') . '?redirect=' . rawurlencode(uri_string() . '?openPremium=1') ?>" class="text-black text-decoration-none">
                                            Yet to <br/> Unlock Full <br/> Access
                                        </a>
                                    </h4>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
            </div>
    </section>
    
        <section class="pt-0 sinup-process about-section half-section overlap-height position-relative" style="margin-top : -3%">
            <div class=" m-auto overlap-gap-section p-0">
                <div class="row align-items-center justify-content-md-center">
                    <div class="">
                        <!--<div class="path ">-->
                        <!--    <div class="heart-icon w-80">-->
                        <!--        <i class="bi bi-heart-fill"></i>-->
                        <!--    </div>-->

                        <!--    <div data-target="content1"-->
                        <!--        class="d-flex w-723px mobile-flex-direction m-auto justify-content-center align-items-center gap-1 mt-2 path-item">-->
                        <!--        <div class="bg-path">-->
                        <!--            <span>path 1</span>-->
                        <!--            <br />-->
                        <!--            <i class="bi bi-arrow-right-short fs-40"></i>-->
                        <!--        </div>-->
                        <!--        <h5 class="mb-0 fs-18 lh-25 text-black bg-gray border-radius-8px p-2 fw-500">-->
                        <!--            For all from — <br />-->
                        <!--            STEM, MBA or Masters, Law & Undergrad abroad.-->
                        <!--        </h5>-->
                        <!--    </div>-->

                        <!--    <div data-target="content2"-->
                        <!--        class="d-flex w-723px mobile-flex-direction m-auto justify-content-center align-items-center gap-1 mt-2 path-item">-->
                        <!--        <div class="bg-path">-->
                        <!--            <span>path 2</span>-->
                        <!--            <br />-->
                        <!--            <i class="bi bi-arrow-right-short fs-40"></i>-->
                        <!--        </div>-->
                        <!--        <h5 class="mb-0 fs-18lh-25 text-black bg-gray border-radius-8px p-2 fw-500">-->
                        <!--            For Everything Medical-Related — We’ve Got Two Dedicated Tracks:<br />-->
                        <!--            Track 1: Medical Pathways — USMLE, PLAB, AMC.<br />-->
                        <!--            Track 2: Nursing, Allied Health, Physiotherapy & More-->
                        <!--        </h5>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="w-704px m-auto">

                        <div class="content" id="content1">
                            <form action="<?= base_url('Home/update_profile') ?>" method="post" enctype="multipart/form-data">
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
                                        <p class="mb-0 mobile-p-1">Upload your pic here for personalization , preferably in square</p>
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
                                        <input type="email" name="email" class="form-control w-70 p-2" id="email" value="<?= isset($user->email) ? htmlspecialchars($user->email) : '' ?>" required>
                                    </div>
                                    <div class="form-group d-flex align-items-center border-bottom pb-2 pt-2">
                                        <label for="dial_code" class="form-label w-50 lh-30 text-black fs-24 fw-500 mb-0">Phone Number</label>
                                        <div class="w-70 d-flex gap-2">
                                            <select name="dial_code" id="dial_code" class="form-control w-30 p-2" required>
                                                <option value="">Code</option>
                                                <?php $dial_codes = isset($dial_codes) ? $dial_codes : []; foreach ($dial_codes as $code): ?>
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
                                        <div class="d-flex align-items-center gap-3 margin-left-mobile">
                                            <div class="d-flex gap-2 align-items-center">
                                                <label for="whatsappYes">Yes</label>
                                                <input type="radio" name="whatsapp" id="whatsappYes" value="Yes" class="form-check-input" style="padding: 12px !important;" <?= (isset($user->whatsapp) && $user->whatsapp == 'Yes') ? 'checked' : '' ?> required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-center">
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
                                            <?php $countries = isset($countries) ? $countries : []; foreach ($countries as $country): ?>
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
                                            <?php foreach ($countries as $country): ?>
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

                                    <div class="form-group d-flex align-items-start w-full mobile-w-100 pb-3 pt-4 text-end">
                                        <button type="submit" class="btn btn-purple" style="background-color: #2489FF !important; color: #fff; padding: 10px 24px;">Update Profile</button>
                                    </div>

                                    <!--<div class="form-group d-flex align-items-start w-full mobile-w-100 pb-3 pt-4 text-end">-->
                                    <!--    <div class="form-password text-start">-->
                                    <!--        <input type="password" name="password" class="mb-3 p-2 border-radius-0px" placeholder="Set your password" required minlength="6">-->
                                    <!--        <input type="password" name="cpassword" class="mb-3 p-2 border-radius-0px" placeholder="Confirm your password" required minlength="6">-->
                                    <!--        <button type="submit" class="btn btn-purple w-100" style="background-color: #2489FF !important;">Complete Profile</button>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!-- Checkbox + OTP -->
                                    <!--<div class="mt-4 text-sm">-->
                                    <!--    <p class="text-green-600 font-semibold mb-0 text-black">-->
                                    <!--        <b>✅ Checkbox:</b> <span class="text-black">"I agree to the Terms & Privacy Policy"</span>-->
                                    <!--    </p>-->
                                    <!--    <p class="text-green-700 font-semibold text-black">-->
                                    <!--        <b> 🔒 OTP Verification </b><span class="text-black">(Phone or Email)</span>-->
                                    <!--    </p>-->
                                    <!--</div>-->
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
            </div>
        </section>

    </div>



   <?php $this->load->view('footer'); ?>
    <script>
        const pathItems = document.querySelectorAll('.path-item');
        const contents = document.querySelectorAll('.content');

        // Set the first item active by default
        if (pathItems.length > 0) {
            pathItems[0].classList.add('active');
            contents[0].style.display = 'block';
        }

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
