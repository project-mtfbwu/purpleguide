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
   <style>
       .avatar-box
       {
              visibility: hidden;
       }
       .text-green {
           color: #28a745 !important;
       }
       .text-yellow {
           color: #ffc107 !important;
       }
       .premium-unlock-link:hover {
           opacity: 0.7;
       }
   </style>
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
    <div class="wrapper-content">
        <!-- AboutUs -->
        <section class="pt-0 mobile-student-cart about-section half-section overlap-height position-relative overflow-hidden minus-10 pl-100px">
            <div class="w-729px p-0">
                    <div class="card-box-avatar">
                        <div class="avatar-info position-relative">
                            <div class="avatar-img">
                                <img src="<?= isset($user->image1) && $user->image1 ? base_url('assets/images/'.$user->image1) : base_url('assets/img/avatar.jpg') ?>" alt="" class="border-radius-6px" data-no-retina="">
                                <!--<div class="choose-avatar-text">-->
                                <!--    <label for="chooseImg">-->
                                <!--        <img src="../assets/img/edit-03.png" />-->
                                <!--    </label>-->
                                <!--    <input type="file" id="chooseImg" accept="image/*" class="d-none">-->
                                <!--</div>-->
                                <div class="avatar_name">
                                    <h5 class="mb-3"><?= isset($user->name) && !empty($user->name) ? htmlspecialchars($user->name) : 'User' ?></h5>
                                    <span><?= isset($user->email) ? '@' . explode('@', htmlspecialchars($user->email))[0] : '@user' ?></span>
                                    <span>id: <?= isset($user->id) ? $user->id : '' ?></span>
                                </div>
                            </div>
                            <div class="title-info">
                                <h5 class="mb-0">#purplePremium</h5>
                                <h6 class="mb-0">stem PATHWAY</h6>
                            </div>
                        </div>
                        <div class="avatar-heading-right-box justify-content-start" style="padding-left : 10px">
                            <?php 
                            $premium_status = isset($premium_status) ? $premium_status : 'none';
                            if ($premium_status == 'approved'): ?>
                                <h4 class="mb-0 text-green">Full Access <br/> Allotted</h4>
                            <?php elseif ($premium_status == 'pending'): ?>
                                <h4 class="mb-0 text-yellow">Already <br/> Applied</h4>
                            <?php elseif ($this->session->userdata('logged_in')): ?>
                                <h4 class="mb-0 premium-unlock-link" style="cursor: pointer; transition: opacity 0.3s;" data-toggle="modal" data-target="#premiumModal">Yet to <br/> Unlock Full <br/> Access</h4>
                            <?php else: ?>
                                <h4 class="mb-0" style="cursor: pointer; transition: opacity 0.3s;">
                                    <a href="<?= base_url('Login') . '?redirect=' . rawurlencode(uri_string() . '?openPremium=1') ?>" class="text-black text-decoration-none">Yet to <br/> Unlock Full <br/> Access</a>
                                </h4>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <div class="container overlap-gap-section p-0">
                <div class="row align-items-end mt-4">
                    <div class="w-616px">
                        <div class="">
                            <h1 class="text-start text-black fnt-family fw-500 fs-76 custom-padding-10 lh-full mb-0 pb-2 mobile-fs-24 mobile-text-center">
                                counsellor <br/> page for <br/> students</h1>
                        </div>
                        <!--Mobile View-->
                        <div class="group-todo-list new-mobile-todo-list desktop-none">
                            <div class="top-todo-list toggle-todo">
                                <div class="d-flex justify-content-space">
                                    <h4 class="mb-0 fs-20 text-black mt-0 mobile-fs-12">Top picks &nbsp;&nbsp;></h4>
                                    <img src="../assets/img/filter-icon.png" />
                                </div>
                                </div>
                                <div class="body-of-todo">
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" data-no-retina="">
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                         <!--Mobile View-->
                            
                            
                        <div class="card-overview mt-10">
                            <h5 class="text-black text-center fs-17 lh-22 fw-600 mb-3">Your Quick Dashboard overview</h5>
                        </div>
                        <div class="d-flex gap-3 justify-content-space mobile-wrap-2-template position-relative">
                            <div class="lock-box">
                                <img src="../assets/img/lock.png" />
                            </div>
                            <div class="card-fill-box">
                                Uni <br /> Applied
                                <div class="d-flex justify-content-space">
                                    <span>|</span>
                                    <span>02</span>
                                </div>
                            </div>
                            <div class="card-fill-box">
                                Offers <br />Received
                                <div class="d-flex justify-content-space">
                                    <span>|</span>
                                    <span>02</span>
                                </div>
                            </div>
                            <div class="card-fill-box">
                                Tuition Receipt <br />
                                Uploaded
                                <div class="d-flex justify-content-space">
                                    <span>|</span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-fill-box">
                                Visa <br />Applied
                                <div class="d-flex justify-content-space">
                                    <span>|</span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-303px p-0">
                        <!--Desktop View-->
                        <div class="group-todo-list mobile-none">
                            <div class="top-todo-list">
                                <div class="d-flex justify-content-space">
                                    <h4 class="mb-0 fs-20 text-black lh-20 mt-2">Top picks &nbsp;&nbsp;></h4>
                                    <img src="../assets/img/filter-icon.png" />
                                </div>
                                <hr />

                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span
                                                class="yellow-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" />
                                    </div>
                                </div>

                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0"> Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span
                                                class="blue-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" />
                                    </div>
                                </div>

                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0">Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span
                                                class="red-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" />
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0">Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span
                                                class="purple-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" />
                                    </div>
                                </div>
                                <div class="todo-list">
                                    <div class="content-todo">
                                        <h5 class="mb-0">Clinical rotation sign up for next batch booking are in progress.</h5>
                                        <span class="todo-tag">InProgress</span>
                                        <span class="todo-tag-hightlist"><span
                                                class="yellow-dark-bg dot-tag"></span>#medical</span>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../assets/img/computer.jpg" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--END Desktop-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">

                        <div class="d-flex gap-3 mt-5 align-items-start mobile-notes-div">
                            <div
                                class="notes-box w-50 d-flex flex-grid pt-3 pb-3 justify-content-center flex-direction-column">
                                <h5 class="mb-2 text-black fs-17 lh-22 fw-600 mobile-fs-14">Notes</h5>
                                <p class="mb-0 text-black fs-14 lh-19 mobile-fs-14">
                                    This is the phase where we check your documents, get your applications ready, and
                                    start
                                    planning your university journey. Got questions or need feedback? Reach out to your
                                    counselor anytime—and make sure to join any upcoming sessions we invite you to.
                                </p>
                            </div>
                            <div class="w-50 position-relative">
                                <div class="mobile-width-set">
                                <div>
                                    <h5 class="mb-0 bg-bluey fs-19 lh-19 fw-500 mobile-fs-14">MBA Aspirant @class of 2025</h5>
                                </div>
                                <div class="lh-full">
                                    <h6 class="mb-0 bg-dark-pink fs-12 lh-12 ">Gender</h6>
                                </div>
                                <div class="lh-full">
                                    <h6 class="mb-0 bg-bluey  fs-12 lh-12">Male</h6>
                                </div>
                                <div class="d-flex lh-full align-items-center">
                                    <div class="bg-light-yellow-2 w-12-ht-19"><i class="bi bi-ui-radios-grid"></i></div>
                                    <div class="bg-light-yellow w-12-ht-19"><i class="bi bi-geo-alt-fill"></i></div>
                                    <h5 class="bg-dark-pink  fs-12 lh-12 mb-0">White Town, Pondicherry</h5>
                                </div>
                                <div class="d-flex ht-custom25">
                                    <div class="light-gray-bg"><img src="../assets/img/US.png"></div>
                                    <div class="bg-bluey lh-12">USA</div>
                                    <div class="light-gray-bg"><img src="../assets/img/US.png"></div>
                                    <div class="bg-bluey px-2 lh-12">UK</div>
                                </div>
                                </div>
                                <div class="">
                                    <div class="post-arrow">
                                        <img src="../assets/img/top-down-arrow.png" />
                                        <p>See what’s done,
                                            what’s in progress,
                                            and what’s coming next.</p>
                                    </div>
                                    
                                    <a href="<?= base_url('Feed_track_progress') ?>" type="button" class="btn-progress mobile-top-space text-white text-center">Track Your Progress</a>
                                    
                                    <a href="<?= base_url('purpleboard') ?>" class="btn-progress text-white text-center">#purpleBoard</a>
                                    <div class="post-arrow-2">
                                        <img src="../assets/img/left-right.png" />
                                        <p>Get the latest on scholarships, newly opened courses, and important updates,
                                            all in one place. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="w-841px m-auto">
            
        <section class="dashboard-lock-action">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-4">
                        <img src="../assets/img/lock-border.png" class="w-60" style="    margin-bottom: -20px;" />
                        <h4 class="text-red text-uppercase fnt-family fs-75 mb-0">no</h4>
                        <p class="fs-19 lh-20 text-black fnt-family mobile-fs-24 mobile-lh-full mobile-w-60">Don’t get stuck figuring it all out!Get the full dashboard access, mentor support,
                        <span class="bg-yellow mobile-bg-white">and admissions help</span>
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="d-flex align-items-start gap-3 mobile-wrap">
                            <div class="w-50 mobile-w-full position-relative">
                            
                            <div class="flot-lock-yes">
                             <h4 class="text-green text-uppercase fnt-family fs-75 mb-0 text-end mobile-none">Yes</h4>
                            
                            <img src="../assets/img/lock-arrow-down.png" class="m-last d-block mt-1-img mobile-none" />
                            <img src="../assets/img/lock-2.png" class="m-last d-block mobile-m-start" />
                             </div>
                            <div class="desktop-none d-flex gap-2 mobile-pt-4">
                              <h4 class="text-green text-uppercase fnt-family fs-75 mb-0 text-end ">Yes</h4>
                              <img src="../assets/img/lock-arrow-down-2.png" class="m-last d-block mobile-m-start" />
                            </div>
                            
                            </div>
                            <div class="w-50 mobile-w-full mobile-pt-0">
                             <p class="fs-34 lh-full text-black fnt-family mobile-fs-24 mobile-w-70">Unlock the full dashboard experience  <span class="bg-yellow">with #PurplePremium</span>
                             we accept only a  <span class="bg-yellow">limited number of seats each month</span>, connect with our Help Hub to get in.
                        </p> 
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content-report">
            <div class="">
                <div class="text-center">
                    <h2 class="mb-1 fnt-family text-black fs-38 mobile-fs-24">Where You Stand</h2>
                    <p class="mb-3 w-60 fs-16 lh-19 m-auto text-black mobile-fs-14 text-start">This is the heart of your study path. This centralized study
                        dashboard helps you track onboarding,
                        monitor progress, see key milestones, and identify next steps. Designed to keep you on track.
                    </p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-11 m-auto p-0">
                        <div class="card-box-border pb-10 position-relative" style="z-index: -1;">
                            <div class="lock-box-2">
                                <img src="../assets/img/lock.png" data-no-retina="">
                            </div>
                            <div class="d-flex gap-4 w-100  justify-content-center mobile-wrap-box-style-4">
                                <div class="w-100px d-flex align-items-center m-auto">
                                    <div class="">
                                        <h5 class="fnt-family text-back fs-60 text-black mb-0">14%</h5>
                                        <h6 class="mb-0 text-black fs-16 lh-19">through your <br />
                                            onboarding <br />
                                            journey</h6>

                                    </div>
                                </div>
                                <div class="w-40">
                                    <div class="checkbox-card">
                                        <h5 class="mb-5">Onboarding Checklist </h5>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">Profile Setup Complete</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">University Shortlist Discussed</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">SOP Discussion Done</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">IELTS/GRE Status Confirmed</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">Resume Uploaded</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">LOR Briefed</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">Loan & Finance Discussed</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-40">
                                    <div class="checkbox-card" style="height : 60%">
                                        <h5 class="mb-5">June feedback session </h5>
                                        <div class="d-flex align-items-center gap-4 mb-4">
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                            <span class="w-80 text-start">One-on-One Session Booked</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-4 w-100 justify-content-start mt-3 mobile-wrap-box-style-4">
                                <div class="w-100px d-flex align-items-center" style="margin-left: 9px;margin-right: -5px;">
                                    <h5 class="fnt-family text-back fs-40 text-black mb-0">Prep Status</h5>

                                </div>
                                <div class="w-264px">
                                    <div class="checkbox-card">
                                        <h5 class="mb-5">Documents Tracker</h5>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40">10</h1>
                                            <span class="w-80 text-start">SOP Drafts Uploaded</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40">03</h1>
                                            <span class="w-80 text-start">LORs Uploaded</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40">03</h1>
                                            <span class="w-80 text-start">Degree Certificate Uploaded</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40">03</h1>
                                            <span class="w-80 text-start">Graduation Transcript</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40">03</h1>
                                            <span class="w-80 text-start">Passport Front/Back</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40">03</h1>
                                            <span class="w-80 text-start">Loan Documents If Applied</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40 text-red">03</h1>
                                            <span class="w-80 text-start">Other Documents</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="w-264px">
                                    <div class="checkbox-card pbs-100" style="height: 90%;">
                                        <h5 class="mb-5">Uni Shortlist</h5>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 fs-30 fw-500 w-20 text-black">03</h1>
                                            <span class="w-80 text-start">USA - Stream Choice 1</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h1 class="mb-0 fs-30 fw-500 w-20 text-black">03</h1>
                                            <span class="w-80 text-start">USA- Stream Choice 3</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 p-0">
                        <div class="bg-black d-flex border-radius-20px p-2 custom-mobile-margin" style="margin-top: -7px;">
                            <div class="w-25 d-flex align-items-center justify-content-center">
                                <div>
                                    <h5 class="fnt-family text-back fs-60 text-white mb-0">06</h5>
                                    <h5 class="fnt-family text-back fs-28 lh-24 text-white mb-0 fw-400">Finalized
                                        <br /> Uni List
                                    </h5>
                                </div>
                            </div>
                            <div class="w-80">
                                <div class="d-flex gap-3 flex-wrap position-relative">
                                    <div class="lock-box">
                                    <img src="../assets/img/lock.png" data-no-retina="">
                                </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-with-image w-30">
                                        <div class="header-caption">
                                            <i class="bi bi-plus-circle-fill"></i> Univ of washington
                                        </div>
                                        <div class="fix-image-box position-relative">
                                            <img src="../assets/img/uni.jpg" />
                                            <div class="caption--absoulte">
                                                #USA
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-11 m-auto p-0">
                        <div class="card-box-border pb-5 pt-5 px-5 mobile-flex-boxes">
                            <div class="w-70 position-relative">
                                 <div class="lock-box-3">
                                    <img src="../assets/img/lock.png" data-no-retina="">
                                </div>
                                <div class="d-flex align-items-center mb-4 gap-4">
                                    <div class="w-35">
                                        <h1 class="mb-0 fnt-family text-black fs-38 lh-32 fw-400 mobile-fs-24 mobile-lh-full">You are <br />
                                            Currently <br />
                                            Working On</h1>
                                    </div>
                                    <div class="w-70">
                                        <div class="card-white-box-border">
                                            <div class="list-type">
                                                <span>URGENT</span>One-on-One Session Booked
                                            </div>
                                            <div class="list-type">
                                                One-on-One Session Booked
                                            </div>
                                            <div class="list-type">
                                                One-on-One Session Booked One-on-One Session Booked
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-4">
                                    <div class="w-35">
                                        <h1 class="mb-0 fnt-family text-black  fs-38 lh-32 fw-400 mobile-fs-24 mobile-lh-full">
                                            Future task
                                            <span class="" style="color:rgba(10, 191, 140, 1)">preview</span>
                                        </h1>
                                    </div>
                                    <div class="w-70">
                                        <div class="card-white-box-border">
                                            <div class="list-type">
                                              One-on-One Session Booked
                                            </div>
                                            <div class="list-type">
                                                 <span>IMP</span>One-on-One Session Booked
                                            </div>
                                            <div class="list-type">
                                                One-on-One Session Booked One-on-One Session Booked
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-4 pb-0 mobile-pb-10">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-11 d-flex gap-2 mobile-row-reverse">
                        <p class="mb-0 w-60 fw-600 text-black d-flex gap-2 fs-17 lh-22 qd-heading mobile-fs-14 mobile-lh-full">
                            <span>*</span>
                            Got a quick doubt? Drop it in the comments.
                            For detailed queries or feedback, reach out via email,
                            direct call, group meet, or join our feedback sessions.
                        </p>
                        <div class="w-30">
                            <div class="tag-perks mobile-tag-perks">Status</div>
                            <div>
                                <span class="cardbox-scholarship">Ready for Your <br/> Input</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-4 pb-0">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="comment-box-grid">
                            <h3>Comments</h3>

                            <div class="comment-input">
                                <div class="comment-header">
                                    <img src="https://i.pravatar.cc/35?img=1" alt="John Doe">
                                    John Doe
                                </div>
                                <div class="comment-text">
                                    <textarea placeholder=" Hey I am facing difficulty with my SOP can you help me out?"
                                        class="form-control"></textarea>
                                </div>
                                <div class="comment-actions">
                                    <div class="vote-btns">
                                        <button><i class="bi bi-arrow-up-short"></i></button>
                                        <button><i class="bi bi-arrow-down-short"></i></button>
                                    </div>
                                    <button class="comment-btn btn" type="button">Comment</button>
                                </div>
                            </div>

                            <div class="comment-item">
                                <div class="comment-author">
                                    <img src="https://i.pravatar.cc/35?img=2" alt="Jane Doe">
                                    <h4>Jane Doe</h4>
                                </div>
                                <div class="comment-content">
                                    We are going with your university application. If you have any doubts do let us
                                    know.
                                    Also on
                                    other notes can you update us on your SOP status. Have you made drafts?
                                </div>
                                <div class="comment-footer">
                                    <button style="background:#f3f0ff"><i class="bi bi-arrow-up-short"></i></button>
                                    <button><i class="bi bi-arrow-down-short"></i></button>
                                    <span>5 min ago</span>
                                </div>
                            </div>

                            <div class="comment-item">
                                <div class="comment-author">
                                    <img src="https://i.pravatar.cc/35?img=3" alt="Jane Doe">
                                    <h4>Jane Doe</h4>
                                </div>
                                <div class="comment-content">
                                    Nice to connect, with the feedback session I could figure out your concerns and the
                                    path
                                    you are
                                    aiming for. We were pleasantly surprised that you started taking right steps
                                    already!
                                </div>
                                <div class="comment-footer">
                                    <button><i class="bi bi-arrow-up-short"></i></button>
                                    <button style="background:#fff0ed"><i class="bi bi-arrow-down-short"></i></button>
                                    <span>21st May 2025</span>
                                </div>
                            </div>

                            <div class="load-more">
                                <button type="button" class="btn ">Load More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content-report pt-10">
            <div class="">
                <div class="text-center">
                    <h2 class="mb-4 fnt-family text-black fs-38 heading-up-event mobile-fs-24 mobile-pb-4">Upcoming Events</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-11 d-flex gap-3 mobile-grid-calendar">
                        <div class="w-50">
                            <img src="../assets/img/calendar-2.png" />
                        </div>
                        <div class="w-50">
                            <div class="grid-box-style-2">
                                <div class="card-box-1">
                                    <div class="d-flex">
                                        <h5 class="">Visa 101 Webinar</h5>
                                        <h5 class="">SEP 7</h5>
                                        <h5 class="">7 PM IST</h5>
                                    </div>
                                    <p class="mb-0 fs-11 lh-full text-black fw-400 lh-new-100  mt-3">Meet our Visa Counselor
                                        (5+ years experience)</p>
                                    <p class="mb-0 fs-11 lh-full text-black fw-400 lh-full  mt-3"><b>Mode:&nbsp;</b>Google Meet</p>
                                </div>
                                <div class="card-box-1">
                                    <div class="d-flex ">
                                        <h5 class="">Visa 101 Webinar</h5>
                                        <h5 class="">SEP 7</h5>
                                        <h5 class="">7 PM IST</h5>
                                    </div>
                                    <p class="mb-0 fs-11 lh-full mt-3">Meet our Visa Counselor
                                        (5+ years experience)</p>
                                    <p class="mb-0 fs-11 lh-full mt-3"><b>Mode:&nbsp;</b>Google Meet</p>
                                </div>
                                <div class="card-box-1">
                                    <div class="d-flex">
                                        <h5 class="w-100 text-center class="event-heading"">Spotlight <br />UCL</h5>
                                        <h5 class="">SEP 7</h5>
                                        <h5 class="">7 PM IST</h5>
                                    </div>
                                    <p class="mb-0 fs-11 lh-full mt-3">Meet our Visa Counselor
                                        (5+ years experience)</p>
                                    <p class="mb-0 fs-11 lh-full mt-3"><b>Mode:&nbsp;</b>Google Meet</p>
                                </div>
                                <div class="card-box-1 border-none d-flex align-items-center justify-content-start">
                                    <div class="d-flex align-items-center">
                                        <h2 class="text-black mb-0 fw-600 d-flex align-items-center gap-2"><span class="fnt-family fs-38 fw-400">+4 </span><span class="fs-17 lh-22">more</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        </div>

    </div>

     <?php $this->load->view('footer'); ?>
     
     <!-- JavaScript libraries -->
     <!--<script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>-->
     <!--<script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>-->
     <!--<script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>-->
     
     <!-- PurplePremium Application Modal -->
     <div id="premiumModal" class="premium-modal-overlay" style="display: none;">
         <div class="premium-modal-container">
             <button type="button" class="premium-modal-close" onclick="closePremiumModal()">×</button>
             
             <div class="premium-modal-header">
                 <h1 class="fnt-family fs-75 text-black mb-0 text-center" style="line-height: 1;">#PurplePremium</h1>
                 <h2 class="fnt-family fs-38 text-black mb-3 text-center mt-3">Unlock Full Dashboard Access</h2>
             </div>
             
             <div class="premium-modal-body">
                 <p class="fs-24 lh-full text-black fnt-family mb-4 text-center">
                     Unlock the full dashboard experience <span class="bg-yellow">with #PurplePremium</span>
                 </p>
                 
                 <p class="fs-19 lh-24 text-black fnt-family mb-4 text-center">
                     We accept only a <span class="bg-yellow">limited number of seats each month</span>, connect with our Help Hub to get in.
                 </p>
                 
                 <div class="premium-features-box">
                     <div class="premium-feature-item">
                         <div class="premium-feature-icon">✓</div>
                         <span class="fs-18 lh-24 text-black fnt-family">Mentor support & guidance</span>
                     </div>
                     <div class="premium-feature-item">
                         <div class="premium-feature-icon">✓</div>
                         <span class="fs-18 lh-24 text-black fnt-family">Admissions help</span>
                     </div>
                     <div class="premium-feature-item">
                         <div class="premium-feature-icon">✓</div>
                         <span class="fs-18 lh-24 text-black fnt-family">Full dashboard access</span>
                     </div>
                 </div>
             </div>
             
             <div class="premium-modal-footer">
                 <button type="button" class="btn-premium-cancel" onclick="closePremiumModal()">Cancel</button>
                 <button type="button" class="btn-premium-apply" id="submitPremiumApp">Apply Now</button>
             </div>
             
             <div id="premiumModalMessage" class="mt-3 text-center" style="display: none;"></div>
         </div>
     </div>
     
     <style>
     /* Premium Modal Styles */
     .premium-modal-overlay {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.8);
         z-index: 10000;
         display: flex;
         align-items: center;
         justify-content: center;
         padding: 20px;
     }
     
     .premium-modal-container {
         background: #fff;
         padding: 50px 40px;
         border-radius: 12px;
         box-shadow: 0 10px 40px rgba(0,0,0,0.3);
         position: relative;
         max-width: 650px;
         width: 100%;
         max-height: 90vh;
         overflow-y: auto;
         animation: modalFadeIn 0.3s ease;
     }
     
     @keyframes modalFadeIn {
         from {
             opacity: 0;
             transform: scale(0.9);
         }
         to {
             opacity: 1;
             transform: scale(1);
         }
     }
     
     .premium-modal-close {
         position: absolute;
         top: 15px;
         right: 15px;
         width: 40px;
         height: 40px;
         font-size: 30px;
         line-height: 30px;
         color: #000;
         background: transparent;
         border: none;
         cursor: pointer;
         z-index: 10001;
         text-align: center;
         padding: 0;
         transition: color 0.3s;
     }
     
     .premium-modal-close:hover {
         color: #2489FF;
     }
     
     .premium-modal-header {
         text-align: center;
         margin-bottom: 30px;
         padding-bottom: 25px;
         border-bottom: 2px solid #f0f0f0;
     }
     
     .premium-modal-body {
         margin-bottom: 35px;
     }
     
     .premium-features-box {
         background: #f8f9fa;
         padding: 25px;
         border-radius: 8px;
         margin-top: 25px;
     }
     
     .premium-feature-item {
         display: flex;
         align-items: center;
         gap: 15px;
         margin-bottom: 15px;
     }
     
     .premium-feature-item:last-child {
         margin-bottom: 0;
     }
     
     .premium-feature-icon {
         width: 28px;
         height: 28px;
         background: #2489FF;
         color: white;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-weight: bold;
         font-size: 16px;
         flex-shrink: 0;
     }
     
     .premium-modal-footer {
         display: flex;
         justify-content: center;
         gap: 20px;
         margin-top: 30px;
     }
     
     .btn-premium-cancel {
         padding: 14px 35px;
         background: transparent;
         color: #6c757d;
         border: 2px solid #dee2e6;
         border-radius: 8px;
         cursor: pointer;
         font-size: 18px;
         font-weight: 600;
         font-family: inherit;
         transition: all 0.3s ease;
     }
     
     .btn-premium-cancel:hover {
         background: #f8f9fa;
         border-color: #adb5bd;
     }
     
     .btn-premium-apply {
         padding: 14px 35px;
         background: #2489FF;
         color: white;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         font-size: 18px;
         font-weight: 700;
         font-family: inherit;
         transition: all 0.3s ease;
         box-shadow: 0 4px 15px rgba(36, 137, 255, 0.3);
     }
     
     .btn-premium-apply:hover {
         background: #1a7ae6;
         transform: translateY(-2px);
         box-shadow: 0 6px 20px rgba(36, 137, 255, 0.4);
     }
     
     .btn-premium-apply:disabled {
         background: #adb5bd;
         cursor: not-allowed;
         transform: none;
         box-shadow: none;
     }
     
     @media (max-width: 768px) {
         .premium-modal-container {
             padding: 35px 25px;
         }
         
         .premium-modal-footer {
             flex-direction: column;
         }
         
         .btn-premium-cancel,
         .btn-premium-apply {
             width: 100%;
         }
     }
     </style>
     
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
     <script>
        // Simple modal functions
        function openPremiumModal() {
            document.getElementById('premiumModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closePremiumModal() {
            document.getElementById('premiumModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        <?php
            $should_open_premium =
                $this->session->userdata('logged_in')
                && $premium_status !== 'approved' && $premium_status !== 'pending'
                && (
                    (isset($_GET['openPremium']) && $_GET['openPremium'] == '1')
                    || ($this->session->flashdata('openPremium') == '1')
                );
        ?>
        <?php if ($should_open_premium): ?>
        // User just logged in/signed up after clicking "Yet to Unlock Full Access" — show the apply popup now.
        document.addEventListener('DOMContentLoaded', function () {
            openPremiumModal();
        });
        <?php endif; ?>

        // Toggle todo
        if (document.querySelector(".toggle-todo")) {
            document.querySelector(".toggle-todo").addEventListener("click", function () {
                document.querySelector(".body-of-todo").classList.toggle("show");
            });
        }
        
        // Open modal on click
        document.addEventListener('DOMContentLoaded', function() {
            var unlockLink = document.querySelector('.premium-unlock-link');
            if (unlockLink) {
                unlockLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    openPremiumModal();
                });
            }
            
            // Close modal when clicking overlay
            var modalOverlay = document.getElementById('premiumModal');
            if (modalOverlay) {
                modalOverlay.addEventListener('click', function(e) {
                    if (e.target === modalOverlay) {
                        closePremiumModal();
                    }
                });
            }
        });
        
        // Submit premium application
        document.addEventListener('DOMContentLoaded', function() {
            var submitBtn = document.getElementById('submitPremiumApp');
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var btn = this;
                    var originalText = btn.textContent;
                    btn.disabled = true;
                    btn.textContent = 'Submitting...';
                    
                    fetch('<?= base_url("Home/apply_purplepremium") ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            btn.disabled = false;
                            btn.textContent = 'Applied Successfully!';
                            btn.style.background = '#28a745';
                            
                            Swal.fire({
                                title: 'Application Submitted!',
                                html: '<p class="fnt-family fs-18">' + data.message + '</p><p class="fnt-family fs-16 mt-3">We\'ll review your application and get back to you soon.</p>',
                                icon: 'success',
                                confirmButtonColor: '#2489FF',
                                confirmButtonText: 'Got it!',
                                customClass: {
                                    popup: 'fnt-family'
                                },
                                allowOutsideClick: false
                            }).then(function() {
                                closePremiumModal();
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Info',
                                html: '<p class="fnt-family fs-18">' + (data.message || 'Something went wrong') + '</p>',
                                icon: 'info',
                                confirmButtonColor: '#2489FF',
                                customClass: {
                                    popup: 'fnt-family'
                                }
                            });
                            btn.disabled = false;
                            btn.textContent = originalText;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Oops!',
                            html: '<p class="fnt-family fs-18">Something went wrong. Please try again.</p>',
                            icon: 'error',
                            confirmButtonColor: '#2489FF',
                            customClass: {
                                popup: 'fnt-family'
                            }
                        });
                        btn.disabled = false;
                        btn.textContent = originalText;
                    });
                });
            }
        });
     </script>
</body>

</html>