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
        .avatar-box{
            display : none;
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
      
    <section class="pt-0 about-section half-section overlap-height position-relative minus-5 mobile-board-2">
        <div class="container overlap-gap-section p-0">
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="w-75 m-auto text-center">
                        <h1 class="text-black fw-500 fs-36 pt-0 mb-1 lh-40">Get Into Your Dream University
                            Abroad with a Structured Workflow</h1>
                        <p class="mb-0 lh-20 fs-16">Boost Your Chances of Selection 3X with Smart, Informed University
                            Picks
                        </p>
                        <h6 class="mb-0 text-black fs-16 mt-0">For Medical, STEM, and More—We’ve Got You Covered
                        </h6>

                        <button type="button" class="btn btn-purple mt-1 bg-black-btn fs-11 mt-1 mb-0">Set Up a Quick
                            Call</button>
                        <p class="mb-0 fs-12 lh-15 mt-1">Clear All Your Doubts in 30 Minutes, Figure out your scholarship
                            path.</p>

                    </div>

                </div>

            </div>
              </div>
    </section>


        <section class="pt-0  position-relative mobile-frame-video">
            <div class="container overlap-gap-section p-0">
                <div class="row justify-content-center">

                    <div class="col-lg-12">
                        <?php
                        // Admin-managed hero video (Premium_video). Falls back to the static
                        // poster image when no active video has been uploaded.
                        $pv = isset($premium_video) ? $premium_video : null;
                        $pv_active = $pv && isset($pv->block_status) && (int)$pv->block_status === 0 && !empty($pv->video);

                        $admin_base = $this->config->item('admin_base_url');
                        if (!empty($admin_base)) {
                            $admin_assets_images_base = rtrim($admin_base, '/') . '/assets/images/';
                        } else {
                            $admin_assets_images_base = rtrim(base_url(), '/') . '/pgs_admin/assets/images/';
                        }
                        $pv_poster = ($pv && !empty($pv->poster))
                            ? $admin_assets_images_base . $pv->poster
                            : '../assets/img/premium-2.png';
                        ?>
                        <?php if ($pv_active): ?>
                        <div class="card-box-img position-relative p-0 border-radius-10px bg-transparent">
                            <video id="premiumHeroVideo" class="border-radius-20px aspact-ratio-16-9 w-100"
                                   src="<?= htmlspecialchars($admin_assets_images_base . $pv->video) ?>"
                                   poster="<?= htmlspecialchars($pv_poster) ?>"
                                   playsinline controls preload="metadata"
                                   style="width:100%; object-fit:cover; cursor:pointer;"></video>
                            <div class="position-static-img d-flex gap-3" id="premiumVideoOverlay">
                                <div class="play-circular-button">
                                    <i class="bi bi-play-circle fs-80 text-white"></i>
                                    <div class="play-click-arrow">
                                        <img src="../assets/img/yellow-noun-arrow.png" width="90px" />
                                        <span class="text-yellow d-block fnt-family text-end fs-25">click here</span>
                                    </div>
                                </div>
                                <h4 class="fnt-family fs-75 text-white pb-1">Step into <br /> #purplepremium</h4>
                            </div>
                        </div>
                        <script>
                        (function () {
                            var v = document.getElementById('premiumHeroVideo');
                            var ov = document.getElementById('premiumVideoOverlay');
                            if (!v || !ov) return;
                            function hideOverlay() { ov.style.display = 'none'; }   // hide "Step into #purplepremium" + "click here" while playing
                            function showOverlay() { ov.style.display = ''; }       // bring it back when paused/ended
                            ov.addEventListener('click', function () { hideOverlay(); v.play(); });
                            v.addEventListener('play', hideOverlay);
                            v.addEventListener('playing', hideOverlay);
                            v.addEventListener('pause', showOverlay);
                            v.addEventListener('ended', showOverlay);
                        })();
                        </script>
                        <?php else: ?>
                        <div class="card-box-img position-relative p-0 border-radius-10px bg-transparent">
                            <img src="<?= htmlspecialchars($pv_poster) ?>" class="border-radius-20px aspact-ratio-16-9" />
                            <div class="position-static-img d-flex gap-3">
                                <div class="play-circular-button">
                                    <i class="bi bi-play-circle fs-80 text-white"></i>
                                    <div class="play-click-arrow">
                                        <img src="../assets/img/yellow-noun-arrow.png" width="90px" />
                                        <span class="text-yellow d-block fnt-family text-end fs-25">click here</span>
                                    </div>
                                </div>
                                <h4 class="fnt-family fs-75 text-white pb-1">Step into <br /> #purplepremium</h4>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
                </div>
        </section>

        <section class="pt-8 mt-3 about-section half-section overlap-height position-relative minus-5">
            <div class="overlap-gap-section p-0">
                <div class="row justify-content-center">

                    <div class="w-870px text-center mobile-text-start">
                        <div class="w-90 m-auto">
                            <h1 class="text-black fnt-family fw-500 m-auto fs-38 pt-0 mb-1 lh-42 mobile-fs-24 mobile-lh-full mobile-w-60 mobile-br-none mobile-auto">With #PurplePremium,
                                you
                                can choose <br/>
                                the path that matches your goals.</h1>

                        </div>

                        <div class="d-flex gap-3 mt-4 justify-content-center mobile-wrap">

                            <div class="">
                                <div class="img-box-fit-about position-relative">
                                    <img src="../assets/img/girl-with-book.jpg" class="parent-img" />
                                    <div class="caption-img-start">
                                        <img src="../assets/img/start-now-icon.png" class="" />
                                    </div>
                                </div>
                            </div>

                            <div class="w-80 mobile-comments-board">
                                <div class="d-flex align-items-start gap-1 w-100 mb-3">
                                    <span class="bg-blue-hash text-black">#</span>
                                    <a
									     href="<?= base_url('purpleusme') ?>"
                                        class="bg-black text-white d-block fs-45 fw-500 text-uppercase w-95 lh-50 p-2">USMLE</a>
                                </div>
                                <div class="d-flex align-items-start gap-1 w-100 mb-3">
                                    <span class="bg-blue-hash text-black">#</span>
                                    <a  href="<?= base_url('Purpleplab') ?>"
                                        class="bg-black text-white d-block fs-45 fw-500 text-uppercase w-95 lh-50 p-2">PLAB</a>
                                </div>
                                <div class="d-flex align-items-start gap-1 w-100 mb-3">
                                    <span class="bg-blue-hash text-black">#</span>
                                    <a  href="<?= base_url('purpleamc') ?>"
                                        class="bg-black text-white d-block fs-45 fw-500 text-uppercase w-95 lh-50 p-2">AMC</a>
                                </div>
                                <div class="d-flex align-items-start gap-1 w-100 mb-3 mt-6">
                                    <span class="bg-blue-hash text-black">#</span>
                                    <a href="<?= base_url('Purplenonmedical') ?>" class="bg-black text-white d-block fs-45 fw-500 text-uppercase w-95 lh-50 p-2">
                                        Masters, STEM <br />
                                        UG, MBA & Others</a>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                </div>
        </section>

        <section class="pt-3 mobile-count-pgs-board">
            <div class="">
                <div class="row justify-content-center">
                    <div class="w-960px m-auto">
                        <div class="card-box-gray p-5">
                            <div class="d-flex align-items-center gap-1 m-auto justify-content-center mobile-wrap">
                                <div class="w-50 mobile-w-full">
                                    <h2 class="mb-0 text-black fs-38 fnt-family fw-400">
                                        With #PurplePremium, <br />
                                        we aim to give our aspirants:</h2>
                                    <div class="grid-count-box d-flex flex-wrap gap-4 mt-5">
                                        <div class="w-45 mb-2">
                                            <h3 class="mb-0 text-green fw-500 fs-45 lh-50">40%</h3>
                                            <p class="mb-0 text-black fs-19 lh-25 fw-500 ">Stronger Applications</p>
                                        </div>
                                        <div class="w-45 mb-2">
                                            <h3 class="mb-0 text-green fw-500 fs-45 lh-50">3x</h3>
                                            <p class="mb-0 text-black fs-19 lh-25 fw-500 ">Profile Boost</p>
                                        </div>
                                        <div class="w-45 mb-2">
                                            <h3 class="mb-0 text-green fw-500 fs-45 lh-50">100%</h3>
                                            <p class="mb-0 text-black fs-19 lh-25 fw-500 ">Personalized Support</p>
                                        </div>
                                        <div class="w-45 mb-2">
                                            <h3 class="mb-0 text-green fw-500 fs-45 lh-50">10/10</h3>
                                            <p class="mb-0 text-black fs-19 lh-25 fw-500 ">Targeted Roadmaps</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-40">
                                    <div class="bg-black padding-custom-10">
                                        <div class="text-end padding-custom-11">
                                            <h2 class="text_purple mb-0 fw-800 fs-50 lh-40">#PGS</h2>
                                            <p class="text_purple fs-500 fs-17">#PurplePremium</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-white w-50 fnt-family-1 fs-19 m-end fw-400 lh-full ">Your roadmap to a smarter,
                                                well-guided
                                                study abroad journey.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </section>
        
        
        <section class="mobile-dashboard-box pt-5 mobile-dashboard-box pt-5">
            <div class="w-998px m-auto overlap-gap-section p-0">
                 <div class="fnt-family fs-38 lh-full text-black text-start m-auto mb-4 mobile-fs-24 mobile-lh-full mobile-w-60 mobile-auto mobile-pb-2 w-60 m-auto">
                One of the best parts of #PGS? 
                 The Student Dashboard.
                </div>
                <div class="row justify-content-center position-relative">
                    <div class="col-lg-9">
                        <div class="section-img-setup">
                            <img src="../assets/img/dashboard-gif.png" />
                        </div>
                    </div>
                    <div class="bg-flot-box-dashboard">
                        <div class="like-floting-button">
                            <img src="../assets/img/heart.gif" />
                        </div>
                        
                        <div class="light-blue-text">
                            <img src="../assets/img/check-icon.png" alt="icon"> Mentor + Dashboard + Admission Counseling — #PGS
                            Advantage
                        </div>
                        <p class="mb-0 fs-14 lh-21 text-white fw-400 m-fs-14-update">Your full admission guide. Get expert advice, real
                            data, and hands-on support so you can
                            seamlessly turn your goals into admission success.</p>
                    </div>
                    <div class="flot-green-box-dashboard text-black">
                        <p class="mb-2 fs-16 lh-19 fw-400">
                            Get real-time updates, mentor feedback, and full progress tracking—every step from Day 1 to
                            your
                            admit.
Everything stays mapped, organized, and right here in one place.
                        </p>
                        <h5 class="mb-0 fs-17 lh-22 fw-500">Stay on track. Get admitted with confidence.</h5>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- <section class="pt-5 half-section overlap-height position-relative">-->
            
        <!--     <div class="bg-flot-box-dashboard" style="top: 41% !important;width: 86%;">-->
        <!--                <div class="like-floting-button">-->
        <!--                    <img src="../assets/img/heart.gif" data-no-retina="">-->
        <!--                </div>-->
        <!--                <div class="light-blue-text">-->
        <!--                    <img src="../assets/img/check-icon.png" alt="icon" data-no-retina=""> Mentor + Dashboard + Admission Counseling — #PGS-->
        <!--                    Advantage-->
        <!--                </div>-->
        <!--                <p class="mb-0 fs-14 lh-21 text-white fw-400">Your full admission guide. Get expert advice, real-->
        <!--                    data, and hands-on support so you can-->
        <!--                    seamlessly turn your goals into admission success.</p>-->
        <!--            </div>-->
                    
        <!--    <div class="w-668px m-auto overlap-gap-section p-0 border-dashboard">-->
        <!--        <div class="fnt-family fs-38 lh-full text-black text-start m-auto mb-4 mobile-fs-24 mobile-lh-full mobile-w-60 mobile-auto mobile-pb-2 w-60 m-auto">-->
        <!--        One of the best parts of #PGS? -->
        <!--         The Student Dashboard.-->
        <!--        </div>-->
        <!--        <div class="row justify-content-center position-relative">-->
        <!--            <div class="col-lg-9">-->
        <!--                <div class="section-img-setup">-->
        <!--                    <img src="../assets/img/dashboard-gif.png" data-no-retina="">-->
        <!--                </div>-->
        <!--            </div>-->
                   
        <!--            <div class="flot-green-box-dashboard-1 text-black fnt-family">-->
        <!--                <p class="mb-2 fs-38 lh-full fw-400">-->
        <!--                  dashboard <br />-->
        <!--                Fully unlocked  <br /> when you sign up for  <br /> #purplePremium.-->
        <!--                </p>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        
       

        <section class="position-relative testimonial-custom-mobile">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 m-auto">
                            <div>
                                <h4
                                    class="top-heading-client mobile-w-75 text-black fs-25 mobile-fs-20 text-center mb-1 appear anime-child anime-complete fw-500 mobile-auto mobile-text-start mobile-pb-4">
                                    A word from <span style>Our
                                        learners</span></h4>
                                <p class="text-center text-black w-60 m-auto fs-16 lh-22 mobile-text-start mobile-fs-14 mobile-lh-full">Also
                                    at <b>#PGS,</b> we believe that
                                    with the
                                    right prep, skills, and a solid
                                    game plan,
                                    most students
                                    <b>3x their portfolio </b>and
                                    <b>gain
                                        real-world skills along the
                                        way.</b>
                                </p>
                                <div class="row">
                                   <div class="overflow-hidden m-auto">
                                <div class="xl-outside-box-right-20 sm-outside-box-right-0">
                                    <div class="swiper slider-one-slide  sm-slider-shadow-none magic-cursor overflow-visible ps-25px sm-p-0"
                                        data-slider-options='{ "slidesPerView": 1, "spaceBetween": 40, "loop": true, "pagination": { "el": ".slider-one-slide-pagination", "clickable": true, "dynamicBullets": false }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 30000000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1.5 } }, "effect": "slide" }'>
                                        <div class="swiper-wrapper pt-30px pb-30px">
                                            <!-- start review item -->

                                           
                                            <div class="swiper-slide testimonials full-items-width">

                                                <div class="item-clients">
                                                    <div class="fix-object-img">
                                                        <img src="../assets/img/selfe.jpg" />
                                                    </div>
                                                    <div class="review-content bg-black p-3">
                                                        <p class="text-white lh-18 fs-15 w-90">I’ve picked up a really
                                                            valuable skill
                                                            set that makes my CV stand
                                                            out. I realized you don’t always have to keep applying
                                                            everywhere—you can actually focus on improving your current
                                                            application, make it stronger and more efficient, and
                                                            seriously
                                                            boost your chances of getting selected.</p>
                                                        <div class="author-info">
                                                            <h6 class="mb-0 fs-18 text-white">Raina Venkatesh</h6>
                                                            <p class="text-white fs-13 mb-0 opacity-08">Research Fellow
                                                                Maryland, USA</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="swiper-slide testimonials full-items-width">

                                                <div class="item-clients">
                                                    <div class="fix-object-img">
                                                        <img src="../assets/img/selfe.jpg" />
                                                    </div>
                                                    <div class="review-content bg-black p-3">
                                                        <p class="text-white lh-18 fs-15 w-90">I’ve picked up a really
                                                            valuable skill
                                                            set that makes my CV stand
                                                            out. I realized you don’t always have to keep applying
                                                            everywhere—you can actually focus on improving your current
                                                            application, make it stronger and more efficient, and
                                                            seriously
                                                            boost your chances of getting selected.</p>
                                                        <div class="author-info">
                                                            <h6 class="mb-0 fs-18 text-white">Raina Venkatesh</h6>
                                                            <p class="text-white fs-13 mb-0 opacity-08">Research Fellow
                                                                Maryland, USA</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="swiper-slide testimonials full-items-width">

                                                <div class="item-clients">
                                                    <div class="fix-object-img">
                                                        <img src="../assets/img/selfe.jpg" />
                                                    </div>
                                                    <div class="review-content bg-black p-3">
                                                        <p class="text-white lh-18 fs-15 w-90">I’ve picked up a really
                                                            valuable skill
                                                            set that makes my CV stand
                                                            out. I realized you don’t always have to keep applying
                                                            everywhere—you can actually focus on improving your current
                                                            application, make it stronger and more efficient, and
                                                            seriously
                                                            boost your chances of getting selected.</p>
                                                        <div class="author-info">
                                                            <h6 class="mb-0 fs-18 text-white">Raina Venkatesh</h6>
                                                            <p class="text-white fs-13 mb-0 opacity-08">Research Fellow
                                                                Maryland, USA</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="swiper-slide testimonials full-items-width">

                                                <div class="item-clients">
                                                    <div class="fix-object-img">
                                                        <img src="../assets/img/selfe.jpg" />
                                                    </div>
                                                    <div class="review-content bg-black p-3">
                                                        <p class="text-white lh-18 fs-15 w-90">I’ve picked up a really
                                                            valuable skill
                                                            set that makes my CV stand
                                                            out. I realized you don’t always have to keep applying
                                                            everywhere—you can actually focus on improving your current
                                                            application, make it stronger and more efficient, and
                                                            seriously
                                                            boost your chances of getting selected.</p>
                                                        <div class="author-info">
                                                            <h6 class="mb-0 fs-18 text-white">Raina Venkatesh</h6>
                                                            <p class="text-white fs-13 mb-0 opacity-08">Research Fellow
                                                                Maryland, USA</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

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

        <section class="partner-container">
            <div class="">
                <div class="row p-0 justify-content-center">
                    <div class="w-903px p-0">
                        <div class="card-box-gray-1 border-radius-10px mobile-bg-gray">
                            <div class=" w-698px m-auto mobile-w-60 mobile-m-auto">
                                <h5 class="text-black mb-0 fs-19 lh-19 mb-1 fw-500 mobile-fs-14">Discover Top Universities in Every Country — With
                                    Scholarships & Fee Waivers</h5>
                                <h6 class="text-black fs-17 lh-22 mb-0 mobile-fs-14 mobile-lh-full">Explore our global university tie-ups and map out your
                                    perfect path — we’re here to guide you.</h6>
                                    
                                <span class="text-black fs-12 fw-500 mobile-fs-12 mobile-heading-college">Your College Journey Starts Here</span>
                                <h5 class="text-black mb-0 fs-17 fw-500 mt-2 d-flex wrap gap-4 mobile-fs-12 mobile-gap-0 mobile-lh-16"><span>500+ University
                                        Tie-ups</span><span>20+ years experienced Mentors</span><span>Current Student as
                                        Mentors</span></h5>
                            </div>
                            <div class="top-partners-style mt-5">
                                <div class="flex-wrap d-flex w-698px m-auto align-items-center justify-content-center" style="gap:17px;">
                                    <div class="client-box-top"><img src="../assets/img/partner-1.png" alt="top-client">
                                    </div> 
                                    <div class="client-box-top"><img src="../assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-9.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-1.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-9.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-1.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-9.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-1.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="../assets/img/partner-9.png" alt="top-client">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 mobile-mt-10">
                                <h5 class="fnt-family fs-38 text-black d-flex justify-content-center mb-8 mobile-fs-24 mobile-lh-25 mobile-mb-0 mobile-w-60 mobile-auto mobile-text-start mobile-pb-2 mobile-br-none">Medicine.
                                    engineering.
                                    Allied <br />Health. masters.management</h5>
                            </div>
                            <div class="d-flex gap-3 align-items-center justify-content-center mobile-wrap">
                                <h5 class="text-black w-35 fs-28 fw-400 lh-35 mobile-lh-16 mobile-fs-14 mobile-w-60 mobile-auto  mobile-pb-2">
                                    Connect with our
                                    expert today and
                                    kickstart your
                                    study abroad journey!</h5>
                                <div class="box-white-card w-470px mobile-box-winner">

                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <div class="position-relative">
                                            <div class="bg-white border-radius-10px lh-35 py-1 d-inline-block w-186px text-center border-radius-10">
                                                <span class="text-black fs-28 fw-300 lh-35">+</span>&nbsp;&nbsp;<span
                                                    class="text-black fs-28 ">MBA</span>
                                            </div>
                                            <div class="floting-plus-icon">
                                                <i class="bi bi-plus-circle"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3">
                                            <div class="yellow-border-box">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <div class="arrow-yellow-bg">
                                                <span
                                                    class="d-flex gap-2 bg-yellow mb-4 px-3 py-1 text-black border-radius-10px w-90px"><i
                                                        class="bi bi-arrow-right-circle-fill fs-14"></i><span
                                                        class="fnt-family fs-16">USMLE</span></span>
                                                <span
                                                    class="d-flex gap-2 bg-yellow mb-4 px-3 py-1 text-black border-radius-10px w-90px"><i
                                                        class="bi bi-arrow-right-circle-fill fs-14"></i><span
                                                        class="fnt-family fs-16">PLAB</span></span>
                                                <span
                                                    class="d-flex gap-2 bg-yellow mb-4 px-3 py-1 text-black border-radius-10px w-90px"><i
                                                        class="bi bi-arrow-right-circle-fill fs-14"></i><span
                                                        class="fnt-family fs-16">AMC</span></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 align-items-center justify-content-center mobile-wrap mobile-space-evenly mobile-pb-2 mobile-pt-2">
                                        <div class="green-box-radius  border-radius-20px ">
                                            <h6 class="fnt-family text-white fs-16 lh-15 text-center fw-400 mb-0">
                                                Scholarship
                                                + Fee Waiver
                                            </h6>
                                        </div>
                                        <div class="desktop-none">
                                             <div class="d-flex gap-1 align-items-center">
                                                <h4 class="mb-0 text-black fs-19 fw-700 lh-19 d-flex nowrap mt-2">98%</h4>
                                                <span class="h-20px d-block bg-black" style="width: 1px;"></span>
                                                <h6 class="text-black fs-11 lh-16 mb-0 nowrap fw-700"><span
                                                        class="text-uppercase"><b>VISA SUCESS RATE</b></span></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 w-70 mobile-w-75">
                                            <div class="bg-purple d-flex gap-2 align-items-center p-1">
                                                <h5
                                                    class="mb-0 w-80px fs-17 mb-0 lh-16 fw-600 text-uppercase text-black bg-white" style="    width: 45px !important;">
                                                    Engi<br/>
                                                    neer<br/>
                                                    ing</h5>
                                                <h6 class="mb-0 w-80 mb-0 fs-10 lh-12 text-white">Computer Science / AI
                                                    /
                                                    Data Science
                                                    Software & Web Development <br/>
                                                    Mechanical / Electrical / Civil / Aerospace</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4 align-items-start gap-3">
                                        <div class="w-55 d-flex gap-2 align-items-center">
                                            <h4 class="mb-0 text-black fs-38 fw-700 d-flex nowrap mt-2 lh-19 mobile-nowrap mobile-fs-28">95%</h4>
                                            <span class="h-25px d-block bg-black" style="width: 3px;"></span>
                                            <h6 class="text-black fs-11 lh-full mb-0 fw-400"><span
                                                    class="text-uppercase"><b>offer
                                                        letter</b></span>—delivered in
                                                less than 4 weeks with our
                                                tie-up universities.</h6>
                                        </div>
                                        <div class="w-40 mobile-w-60">
                                            <div class="bg-light-blue border-radius-4px mb-4">
                                                <h6 class="text-black fs-9 lh-12 p-2 mb-2">Physiotherapy / Nursing
                                                    Speech &
                                                    Language Therapy Clinical Embryology</h6>
                                            </div>
                                            <div class="d-flex gap-1 align-items-center mobile-none">
                                                <h4 class="mb-0 text-black fs-19 fw-700 lh-19 d-flex nowrap mt-2">98%</h4>
                                                <span class="h-20px d-block bg-black" style="width: 1px;"></span>
                                                <h6 class="text-black fs-11 lh-16 mb-0 nowrap fw-700"><span
                                                        class="text-uppercase"><b>VISA SUCESS RATE</b></span></h6>
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
        
      
         <section class="position-relative pb-100 mobile-aboutus">
                <div class="w-903px p-0 m-auto p-0 pb-100">
                    <div class="row align-items-center justify-content-center d-flex gap-5">
                        <div
                            class="position-relative bg-gray w-504px bg-very-light-green xl-p-4 md-p-50px sm-p-30px border-radius-10px px-5">
                          <div class="mb-10px">
                        <div class="mt-10 mt-10 mobile-px-4">
                           <h2 class="mb-1 text-uppercase fnt-bab text-black fs-38 mobile-br-none mobile-fs-20 mobile-lh-20 mobile-w-60" style="">
                                       Need a detailed expense <br>
                                        breakdown for your <br>
                                        journey?
                                    </h2>
                            
                            <a href="#" style="padding: 8px 30px;"
                                class="mb-2  mobile-px-3 btn btn-small-large border-radius-10px btn-base-color btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-5px">
                                <span>
                                    <span class="btn-double-text ls-minus-05px fs-15" data-text="get to know #pgs">Request it here</span>
                                </span>
                            </a>
                            
                            <p class="text-black mt-3 mb-3" style="">—
                                        we’ll send it straight to
                                        your
                                        inbox.</p>

                            <p class="text-black fs-16 lh-19 mt-6 mb-30 mobile-fs-14 mobile-pb-30">
                                        Whether you're just getting
                                        started or
                                        planning ahead for all three
                                        steps,
                                        knowing the
                                        costs involved can help you
                                        make better
                                        decisions. From registration
                                        fees and
                                        travel
                                        expenses to prep materials
                                        and clinical
                                        rotations — we’ve mapped out
                                        the full
                                        journey.
                                        Just drop a request and get
                                        a clear
                                        picture of what to expect,
                                        without
                                        surprises.
                            </p>
                        </div>

                        <figure class="about-floting-img m-0 text-center">
                            <img src="../assets/img/doctor.png" alt="" class="border-radius-6px">
                        </figure>


                    </div>
                        </div>

                        <div class="w-336px">
                            <figure class="request-img-box text-center">
                                <img src="../assets/img/insta-girl.png" alt class="border-radius-6px" data-no-retina>
                            </figure>
                        </div>
                    </div>
                </div>
            </section>

        <section class="why-purple mobile-aboutus">
            <div class="">
                <div class="row">
                    <div class="w-861px m-auto p-0">
                        <div class="gray-box-style-5">

                            <div class="d-flex gap-5 mb-10 mobile-wrap">
                                <div class="bg-purple w-40 px-4 py-5 d-flex align-items-center w-256px ht-294">
                                    <h4 class="fnt-family fs-30 text-black mb-0 lh-full fw-400">why<br />
                                        #purplepremium?</h4>
                                </div>
                                <div class="count-of-box-why d-flex wrap justify-content-start gap-4 w-70 py-4">
                                    <div class="w-135px">
                                        <div class="d-flex align-items-center gap-2 mb-5">
                                            <span class="icon-box w-30-ht-30">
                                                <img src="../assets/img/icon-traingal.png">
                                            </span>
                                            <h2 class="text-black mb-0 fs-36 lh-40 fw-500">01</h2>
                                        </div>
                                        <h6 class="mb-0 fs-15 lh-20">6/10 apply to the wrong programs; wasting a year.</h6>
                                    </div>
                                    <div class="w-30">
                                        <div class="d-flex align-items-center gap-2 mb-5">
                                            <span class="icon-box w-30-ht-30">
                                                <img src="../assets/img/icon-traingal.png">
                                            </span>
                                            <h2 class="text-black mb-0 fs-36 lh-40 fw-500">02</h2>
                                        </div>
                                        <h6 class="mb-0 fs-15 lh-20">Most don’t know how to show off their CV; we help you
                                            with
                                            it.</h6>
                                    </div>
                                    <div class="w-135px">
                                        <div class="d-flex align-items-center gap-2 mb-5">
                                            <span class="icon-box w-30-ht-30">
                                                <img src="../assets/img/icon-traingal.png">
                                            </span>
                                            <h2 class="text-black mb-0 fs-36 lh-40 fw-500">03</h2>
                                        </div>
                                        <h6 class="mb-0 fs-15 lh-20">Deadlines, forms, SOPs? We manage that stress.</h6>
                                    </div>
                                    <div class="w-135px">
                                        <div class="d-flex align-items-center gap-2 mb-5">
                                            <span class="icon-box w-30-ht-30">
                                                <img src="../assets/img/icon-traingal.png">
                                            </span>
                                            <h2 class="text-black mb-0 fs-36 lh-40 fw-500">04</h2>
                                        </div>
                                        <h6 class="mb-0 fs-15 lh-20">Deadlines, forms, SOPs? We manage that stress.</h6>
                                    </div>
                                    <div class="w-135px">
                                        <div class="d-flex align-items-center gap-2 mb-5">
                                            <span class="icon-box w-30-ht-30">
                                                <img src="../assets/img/icon-traingal.png">
                                            </span>
                                            <h2 class="text-black mb-0 fs-36 lh-40 fw-500">05</h2>
                                        </div>
                                        <h6 class="mb-0 fs-15 lh-20">Deadlines, forms, SOPs? We manage that stress.</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="reading-book-section mt-5 d-flex gap-2 w-90 mb-5 mobile-w-full">
                                <div>
                                    <h4 class="fnt-family text-black mb-0 text-end fs-30 lh-full">&ALSO</h4>
                                    <div class="fix-object-reading">
                                        <img src="../assets/img/reading-book-boy.png" class="fix-object-img" />
                                    </div>
                                </div>
                                <div class="reading-content-box w-80">
                                    <p class="text-black fs-12 lh-15">over the years, we’ve noticed a pattern with
                                        students.
                                        No matter which path they
                                        take, many succeed—and they’ve truly earned it. But the reality is, 7 out of 10
                                        still run into the same common roadblocks. They start strong, inspired by others
                                        who’ve “made it” (on social media or in real life), and try to figure things out
                                        on
                                        their own. But somewhere around the halfway point, they hit a wall—losing time,
                                        money, and momentum. That’s when things start to feel like they’re back to
                                        square
                                        one—or worse, stuck in a “I’m lost and don’t see the point anymore” loop.
                                        <b>SOUNDS
                                            FAMILIAR ?</b></p>
                                    <p class="text-black fs-12 lh-15">
                                        That’s why we took a closer look at the journeys we’ve seen again and again. And
                                        that’s what led us to one simple solution: <b> #purplePremium.</b>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-10 d-flex align-items-end">
                                 <div class="w-15 m-auto mt-5">
                                    <img src="../assets/img/yellow-arrow-down.png" />
                                </div>
                                <h5 class="text-black fs-23 lh-28 w-85 fw-500 m-auto mb-10 mobile-fs-14 mobile-lh-15">Below, we’ve laid out some of the
                                    biggest
                                    challenges students face—and more importantly, how
                                    we at #pgs help you avoid them.</h5>
                               
                            </div>
                            <br />

                            <div class="box-with-vs position-relative">
                                <div class="d-flex justify-content-center mobile-wrap">
                                    <div class="w-45 cross-icon-box">
                                        <h1 class="fnt-family text-red fs-80">NO</h1>
                                        <div class="dark-gray">
                                            <h4 class="text-dark-gray fs-17 lh-24">The “Figure It Out” <br />
                                                Struggle</h4>
                                            <ul class="m-0 p-0">
                                                <li><img src="../assets/img/cross-red.png" />Apply to random programs hoping for
                                                    the best</li>
                                                <li><img src="../assets/img/cross-red.png" />Generic SOPs, reused CVs</li>
                                                <li><img src="../assets/img/cross-red.png" />No idea how much the journey will
                                                    cost</li>
                                                <li><img src="../assets/img/cross-red.png" />Confused about timelines, intakes,
                                                    and deadlines</li>
                                                <li><img src="../assets/img/cross-red.png" />Burnt out doing it all alone</li>
                                                <li><img src="../assets/img/cross-red.png" />Spend months just figuring things out
                                                </li>
                                                <li><img src="../assets/img/cross-red.png" />#Medical students often get stuck
                                                    after exams or even post-license. With long prep timelines and no
                                                    clear
                                                    plan, resume, or job match—it’s easy to lose years. Restarting later
                                                    takes serious motivation.</li>
                                                <li><img src="../assets/img/cross-red.png" />No clue how to get into top STEM or
                                                    MBA programs #TopUNIs</li>
                                                <li><img src="../assets/img/cross-red.png" />Struggle to get offer letters</li>
                                                <li><img src="../assets/img/cross-red.png" />Always second-guessing</li>
                                                <li><img src="../assets/img/cross-red.png" />No profile-building help</li>
                                                <li><img src="../assets/img/cross-red.png" />Struggling with scholarships or
                                                    getting your loan approved?</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="w-10 px-2 py-2">
                                        <h5 class="text-black mb-0 fnt-family pt-4">VS</h5>
                                    </div>
                                    <div class="w-45 check-icon-box">
                                        <h1 class="fnt-family text-green fs-80">YES</h1>
                                        <div class="box-shadow-black" style="height: 98%;">
                                            <div class="light-blue-bg">
                                                <h4 class="text-dark-gray fs-17 lh-24 d-flex justify-content-space">With
                                                    <br />
                                                    #PurplePremium
                                                    <img src="../assets/img/heart.gif">
                                                </h4>
                                                <ul class="m-0 p-0">
                                                    <li><img src="../assets/img/check-green.png">Smart university picks tailored
                                                        to
                                                        your
                                                        background, ROI, and success chances</li>
                                                    <li><img src="../assets/img/check-green.png">Personalized SOPs, project
                                                        suggestions,
                                                        and a CV that stands out</li>
                                                    <li><img src="../assets/img/check-green.png">Detailed expense breakdown — from
                                                        exam
                                                        fees to till final step #Medical & #AllPaths </li>
                                                    <li><img src="../assets/img/check-green.png">Roadmap from day one, with alerts
                                                        and
                                                        reminders. So you don’t waste time researching everything
                                                        yourself.
                                                        #Medical & #AllPaths </li>
                                                    <li><img src="../assets/img/check-green.png">Access to experienced mentors and
                                                        students who are in the same path</li>
                                                    <li><img src="../assets/img/check-green.png">Spend weeks actually moving
                                                        forward
                                                        with
                                                        a plan that works. Every form, every application—guided. Just
                                                        focus
                                                        on
                                                        what really matters: your #medical license exams or your uni
                                                        application
                                                        #all</li>
                                                    <li><img src="../assets/img/check-green.png">Clinical rotation support +
                                                        interview
                                                        readiness mapped out #USMLE</li>
                                                    <li><img src="../assets/img/check-green.png">University shortlists with
                                                        scholarship
                                                        options and pre-interview prep</li>
                                                    <li><img src="../assets/img/check-green.png">95% offers within 4 weeks via our
                                                        university tie-ups</li>
                                                    <li><img src="../assets/img/check-green.png">Clarity and confidence at every
                                                        step
                                                    </li>
                                                    <li><img src="../assets/img/check-green.png">Research projects, workshops, and
                                                        profile
                                                        upgrades included #Medical & #AllPaths</li>
                                                    <li><img src="../assets/img/check-green.png">Multiple pathways planned based
                                                        on
                                                        your
                                                        goals</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="marquee-section bg-black text-white p-1 mt-5">
                                <marquee direction="left">
                                    <h5 class="mb-0 text-white fs-16 lh-25 pt-1">2 days left to apply for X University
                                        with
                                        full waiver. We help you prep. Parents
                                        welcome on consultation calls. We've helped families just like yours plan with
                                        confidence.</h5>
                                </marquee>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

   <section class="pt-10 half-section overlap-height position-relative overflow-hidden lets-start-mobile">
            <div class="container overlap-gap-section p-0">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px appear anime-child anime-complete"
                    data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [30, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
                    <div class="mb-10px gap-5">
                        <div class="text-center mb-2">
                            <span class="small-caption" style="color: #6A5ED9;">Let's
                                Go</span>
                            <h5 class="w-100 text-black fs-32 mb-2 fw-700 m-auto">
                                Ready to get started?
                            </h5>
                            <p class="w-40 text-center m-auto">Let’s
                                chart
                                your study abroad path, together
                                with Team
                                #PGS.
                            </p>
                            <a href="#" style="padding: 8px 30px; background-color: #6A5ED9;"
                                class="mb-2 btn btn-small-large border-radius-10px text-white   btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-15px">
                                <span>
                                    <span class="btn-double-text ls-minus-05px" data-text="Start Your Journey">Start
                                        Your
                                        Journey</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      

        <section class="pt-0 mobile-pgs-info mobilepb-10">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11 m-auto">
                        <div class="d-flex align-items-center justify-content-center m-d-flex">
                            <div class="w-20 new-black-m">
                                <h5 class="mb-0 bg-black text_purple_bg">
                                    #PGS
                                </h5>
                                <p class="text-black fs-15 mb-0">#StudentSupportHub</p>
                            </div>
                            <div class="w-40">
                                <h6 class="mb-2 text-black d-flex gap-2 fs-20 fw-500"><span
                                        class="w-20 ml-3 px-1 bg-yellow fs-18 d-inline-block">Call
                                        Us </span>
                                    <img src="../assets/img/phone.png" width="20px">
                                    91 95665 66298
                                </h6>
                                <h6 class="mb-2 text-black d-flex gap-2 fs-20 fw-500"><span
                                        class="w-20 ml-3 px-1 bg-yellow fs-18 d-inline-block">Email
                                        Us</span>
                                    <img src="../assets/img/phone.png" width="20px">
                                    connect@purpleguid.study
                                </h6>
                            </div>
                            <div class="w-15">
                                <p class="text-black font-style-italic fs-15 lh-20">Reach
                                    out on our helpline for fast
                                    bookings, expert advice, and
                                    answers to
                                    all your study
                                    abroad questions. We’ve also
                                    got
                                    dedicated mentor groups for
                                    medical and
                                    non-medical
                                    courses—so you’re always
                                    connected to
                                    the right people.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

        

            
            </div>
    </div>
    
    
  <!-- start section -->
        <section class="overflow-hidden p-0 mb-5 mobile-slider-pgs">
            <div class="">
                <h3 class="alt-font fw-700 ls-minus-1px text-dark-bab mb-0 mx-auto desktop-none">#Pgs picks</h3>
                <div class="row align-items-center justify-content-center">
                    <div class="w-20  position-relative text-center text-xl-start lg-mb-15px">
                        <div class="d-flex align-items-center">
                            <h3 class="alt-font fw-700 ls-minus-1px text-dark-bab mb-0 mx-auto mobile-none">#Pgs picks</h3>
                            <div class="d-flex justify-content-center justify-content-xl-start flex-column gap-3">
                                <!-- start slider navigation -->
                                <div class="slider-one-slide-prev-1 text-dark-gray swiper-button-prev slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                    tabindex="0" role="button" aria-label="Previous slide"><i
                                        class="fa-solid fa-arrow-left"></i></div>
                                <div class="slider-one-slide-next-1 text-dark-gray swiper-button-next slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                    tabindex="0" role="button" aria-label="Next slide"><i
                                        class="fa-solid fa-arrow-right"></i></div>
                                <!-- end slider navigation -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 overflow-hidden overflow-hidden">
                        <div class="outside-box-right-15 xl-outside-box-right-20 sm-outside-box-right-0">
                            <div class="swiper sm-p-0"
                                data-slider-options='{ "slidesPerView": 1, "spaceBetween": 40, "loop": true, "pagination": { "el": ".slider-one-slide-pagination", "clickable": true, "dynamicBullets": false }, "navigation":
                                { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": 
                                { "delay": 3000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true },
                                "breakpoints": { "992": { "slidesPerView": 2 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                                <div class="swiper-wrapper pt-30px pb-30px">
                                    <!-- start review item -->
                                    <div class="swiper-slide review-style-06">
                                        <div
                                            class="d-flex justify-content-center h-100 flex-column bg-white box-shadow-medium p-20px md-p-35px border-radius-6px last-paragraph-no-margin">
                                            <div class="mb-20px d-flex align-items-center gap-3">
                                                <div class="avatar-box-full">
                                                    <img class="" src="../assets/img/doctor-2.jpg" alt="">
                                                </div>
                                                <div
                                                    class="d-inline-block align-middle p-paragrph last-paragraph-no-margin">
                                                    <div class="alt-font text-dark-gray fw-600 fs-18 bg-dark">For
                                                        Clinical
                                                        Rotation Click Here</div>
                                                    <p class="lh-24 d-block">Reach out to us.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide review-style-06">
                                        <div
                                            class="d-flex justify-content-center h-100 flex-column bg-white box-shadow-medium p-20px md-p-35px border-radius-6px last-paragraph-no-margin">
                                            <div class="mb-20px d-flex align-items-center gap-3">
                                                <div class="avatar-box-full">
                                                    <img class="" src="../assets/img/doctor-2.jpg" alt="">
                                                </div>
                                                <div
                                                    class="d-inline-block align-middle p-paragrph last-paragraph-no-margin">
                                                    <div class="alt-font text-dark-gray fw-600 fs-18 bg-dark">For
                                                        Clinical
                                                        Rotation Click Here</div>
                                                    <p class="lh-24 d-block">Reach out to us.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide review-style-06">
                                        <div
                                            class="d-flex justify-content-center h-100 flex-column bg-white box-shadow-medium p-20px md-p-35px border-radius-6px last-paragraph-no-margin">
                                            <div class="mb-20px d-flex align-items-center gap-3">
                                                <div class="avatar-box-full">
                                                    <img class="" src="../assets/img/doctor-2.jpg" alt="">
                                                </div>
                                                <div
                                                    class="d-inline-block align-middle p-paragrph last-paragraph-no-margin">
                                                    <div class="alt-font text-dark-gray fw-600 fs-18 bg-dark">For
                                                        Clinical
                                                        Rotation Click Here</div>
                                                    <p class="lh-24 d-block">Reach out to us.</p>
                                                </div>
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



         
          
  <?php $this->load->view('footer'); ?>
</body>

</html>