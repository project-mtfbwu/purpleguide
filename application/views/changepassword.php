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

   <?php $this->load->view('sidebar'); ?>

    <div class="wrapper-content mobile-change-password">

        <!-- AboutUs -->
        <section class="pt-0 mobile-student-cart about-section half-section overlap-height position-relative overflow-hidden">
        <div class="overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">

                <div class="w-729px p-0">
                    <div class="card-box-avatar">
                        <div class="avatar-info position-relative">
                            <div class="avatar-img">
                                <img src="<?= isset($user) && isset($user->image1) && $user->image1 ? base_url('assets/images/'.$user->image1) : base_url('assets/img/avatar.jpg') ?>" alt="" class="border-radius-6px" data-no-retina="">
                                <!--<div class="choose-avatar-text">-->
                                <!--    <label for="chooseImg">-->
                                <!--        <img src="./assets/img/edit-03.png" />-->
                                <!--    </label>-->
                                <!--    <input type="file" id="chooseImg" accept="image/*" class="d-none">-->
                                <!--</div>-->
                                <div class="avatar_name">
                                    <h5 class="mb-3"><?= isset($user) && isset($user->name) && !empty($user->name) ? htmlspecialchars($user->name) : 'User' ?></h5>
                                    <span><?= isset($user) && isset($user->email) ? '@' . explode('@', htmlspecialchars($user->email))[0] : '@user' ?></span>
                                    <span>id: <?= isset($user) && isset($user->id) ? $user->id : '' ?></span>
                                </div>
                            </div>
                            <div class="title-info">
                                <h5 class="mb-0">#purplePremium</h5>
                                <h6 class="mb-0">stem PATHWAY</h6>
                            </div>
                        </div>
                        <div class="avatar-heading-right-box">
                            <h4 class="mb-0">#PURPLEPREMIUM</h4>
                        </div>
                    </div>

                </div>
            </div>
    </div></section>
        <section class="pt-0 half-section overlap-height position-relative overflow-hidden">
            <div class="container overlap-gap-section p-0">
                <div class="row align-items-center justify-content-md-center">

                    <div class="w-305px explore-section">
                        <div class="card card-explore border-color-transparent">

                            <h3 class="mb-3 fw-500 fs-40 text-black mobile-fs-20 mobile-lh-full">
                                Time for a quick
                                security refresh?
                            </h3>
                            <p class="mb-0 fs-18 fw-500 mobile-fs-14">Change password here</p>
                            
                            <?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success" role="alert" style="padding: 12px 16px; margin-bottom: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
                                    <?= $this->session->flashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger" role="alert" style="padding: 12px 16px; margin-bottom: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;">
                                    <?= $this->session->flashdata('error') ?>
                                </div>
                            <?php endif; ?>
                            
                            <form action="<?= base_url('Change_password/change_password') ?>" method="post">
                                <div class="form-group pb-3 pt-4">
                                    <div class="form-password changePassword">
                                        <input type="password" name="old_password" class="mb-3" placeholder="Old password" required>
                                        <input type="password" name="password" class="mb-3" placeholder="Set your password" required minlength="6">
                                        <input type="password" name="cpassword" class="mb-3" placeholder="Confirm your password" required minlength="6">
                                    </div>
                                    <button type="submit" class="btn btn-purple w-50 mobile-fs-14 mobile-w-60"
                                        style="background-color: #2489FF !important;">Save
                                        Change</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                 </div>
        </section>
        <!-- END AboutUs -->
    
    </div>

   
 <?php $this->load->view('footer'); ?>

</body>

</html>