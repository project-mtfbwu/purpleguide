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

        <section class="pt-3 position-relative mobile-pt-4">
            <div class="m-auto w-85 p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12 p-0">
                        <h6 class="mb-5 text-black fs-24 mt-0 w-40 m-auto lh-25 fw-400 mobile-w-42 mobile-fs-14 mobile-lh-18">
                            Indian universities and institutions seeking international visits and exchange programs can
                            connect with us for conference visits and program participation opportunities that give
                            students
                            real global exposure and academic experiences.
                        </h6>
                        <div class="card-box-img bg-gray p-4 pb-5 pt-5 border-gradient-purple-pink-1">
                            <div class="d-flex gap-2 align-items-start justify-content-center w-80 m-auto mobile-gap-1 mobile-w-full">
                                <div class="w-30 mobile-w-50">
                                    <div class="d-flex gap-2 align-items-start">
                                        <img src="./assets/img/my-college.png" class="w-10 mobile-fs-30" />
                                        <div class="text-black">
                                            <h1 class="fnt-family fs-38 mb-0 mobile-fs-24 mobile-lh-full">with university <br />
                                                partnerships</h1>
                                            <p class="fs-16 lh-19 mb-3 mt-1 mobile-fs-14 mobile-lh-full mobile-pt-4 mobile-pb-4">Connect your students with global opportunities
                                                through our comprehensive
                                                international programs</p>
                                            <button type="button" 
                                            onclick="return window.ppOpenModal();"
                                            style="text-transform: capitalize;"
                                                class="btn btn-black border-radius-10px fs-11">Partner With
                                                Us</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-35 mobile-w-50">
                                    <div class="text-black bg-white border-radius-10px p-3">
                                        <h5 class="fs-16 text-center fw-500 mobile-mb-0 mobile-pt-4 mobile-p-2 mobile-lh-full">Partnership Impact</h5>
                                        <div class="d-flex gap-5 justify-content-space mobile-wrap">
                                            <div class="w-50 mobile-w-full mobile-pt-0">
                                                <h4 class="fs-16 fw-500 mb-1 lh-25">150+</h4>
                                                <h4 class="mb-0 lh-19 fs-14">Students <br/>
                                                    participated in <br/> Exchange Program</h4>
                                            </div>
                                            <div class="w-50 mobile-w-full mobile-pt-0">
                                                <h4 class="fs-16 fw-500 mb-1 lh-25">5</h4>
                                                <h4 class="mb-0  fs-14 lh-19">Universities <br/> participated in <br/> international
                                                    events</h4>
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
        
         <div class="wrapper-content">

        <section class="pt-5">
            <div class="container">
                <div class="row justify-content-end">
                     <div class="col-lg-2 text-center"></div>
                    <div class="col-lg-7 text-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="fnt-family text-black fs-36 text-start mb-3 mobile-fs-24 mobile-text-center">Co-Developed Initiatives</h1>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-6 mobile-w-80">
                                <?php
                                $course_list = isset($courses) && is_array($courses) ? $courses : [];
                                // On server, admin uploads live in a sibling folder: `pgs_admin/assets/images/`
                                // while locally they're in `admin/assets/images/`.
                                $base_url_no_slash = rtrim(base_url(), '/');
                                if (preg_match('#/pgs/?$#', $base_url_no_slash)) {
                                    $admin_assets_images_base = preg_replace('#/pgs/?$#', '/pgs_admin', $base_url_no_slash) . '/assets/images/';
                                } else {
                                    $admin_assets_images_base = $base_url_no_slash . '/admin/assets/images/';
                                }
                                foreach ($course_list as $c):
                                    $img_src = !empty($c->image1) ? ($admin_assets_images_base . $c->image1) : base_url('assets/img/cut-college-img.png');
                                    $tags_arr = !empty($c->tags) ? array_filter(array_map('trim', preg_split('/[\s,#]+/', $c->tags))) : ['#TEAMPGS', '#all'];
                                    $c_desc = trim(strip_tags($c->description ?? ''));
                                    $close_ts = !empty($c->e_date) ? strtotime($c->e_date) : 0;
                                ?>
                                <div class="col-lg-12 position-relative m-auto mb-5">
                                    <div class="sop-card-unique">
                                        <!--<div class="sop-top-label">-->
                                        <!--    <img src="./assets/img/stars.gif" />-->
                                        <!--    Last 10 Spots-->
                                        <!--</div>-->
                                        <!--<div class="sop-start-free">-->
                                        <!--    Start Free</div>-->
                                        <div class="sop-image-wrapper">
                                            <img src="<?= htmlspecialchars($img_src) ?>" alt="<?= htmlspecialchars($c->product_name ?? '') ?>" onerror="this.src='<?= base_url('assets/img/cut-college-img.png') ?>'" data-no-retina="">
                                            <div class="sop-heart-icon">
                                                <i class="bi bi-heart-fill text-red text-black"></i>
                                            </div>
                                        </div>
                                        <div class="sop-content text-start w-90">
                                            <div class="sop-title fnt-family fw-500 fs-22 lh-28 w-100"><?= nl2br(htmlspecialchars($c->product_name ?? 'Course')) ?></div>
                                            <div class="sop-subtext fs-12 lh-16 w-100 mobile-fs-12 mobile-lh-15"><?= htmlspecialchars(mb_substr($c_desc, 0, 120)) ?><?= mb_strlen($c_desc) > 120 ? '…' : '' ?></div>
                                            <div class="sop-tags mb-0">
                                                <?php foreach (array_slice($tags_arr, 0, 4) as $tag): $t = (strpos($tag, '#') === 0) ? $tag : '#' . $tag; ?>
                                                <span class="sop-tag"><?= htmlspecialchars($t) ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-space">
                                            <button type="button" class="sop-learn-btn" style="line-height : normal" onclick="return window.ppOpenModal();">Connect With Us</button>
                                            <?php if ($close_ts): ?>
                                            <div class="sop-close-date border-radius-0px">Closes On<br><?= htmlspecialchars(date('F j', $close_ts)) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php if (empty($course_list)): ?>
                                <div class="col-lg-12"><p class="text-black mb-0">No courses available yet. Courses added in admin will appear here.</p></div>
                                <?php endif; ?>

                                <div class="bottom-scrolling-hr mobile-pb-10">
                                    <button type="button" class="btn p-0 border-none">
                                        <img src="./assets/img/down-arrow-scroll.png" />
                                    </button>
                                    <button type="button" class="btn p-0 border-none">
                                        <img src="./assets/img/top-arrow-scroll.png" />
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 mobile-none">
                                <div class="row justify-content-center position-sticky">
                                    <div class="col-lg-12">
                                        <div class="bg-gray-100 border-gradient-purple-pink-1  py-5 px-4">
                                            <div class="m-auto text-center">
                                                <div class="text-black pt-1">
                                                    <h1 class="mb-5 fnt-family fs-36 text-start">Ready to <br /> Partner
                                                        With <br /> Us?</h1>
                                                    <h6 class="fs-16 lh-22 mb-2 text-start w-80 mt-10">Join leading
                                                        institutions worldwide in
                                                        providing global opportunities to your students. Let's create
                                                        transformative
                                                        international experiences together.
                                                    </h6>
                                                    <button type="button"
                                                        class="btn btn-black border-radius-10px text-captilize fs-20 border-radius-15px mt-10 mb-7 px-3">Schedule
                                                        a
                                                        Call</button>

                                                    <div
                                                        class="d-flex gap-1 align-items-center justify-content-center mt-2">
                                                        <img src="./assets/img/black-mail.png" width="30px">
                                                        <h4 class="fs-16 lh-20 fw-500 text-black mb-0">
                                                           partnerships@purpleguide.study</h4>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                     <div class="col-lg-1 text-center"></div>
                </div>
            </div>
        </section>
    </div>
    
    <section class="overlap-height position-relative mobile-higlights overflow-hidden">
            <div class="overlap-gap-section p-0">
                <div class="row justify-content-end p-0">
                    <div class="col-lg-8 mobile-p-0">
                        <div 
                            class="d-flex justify-content-end gap-3 border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px mobile-wrap">
                            <div class="w-35 overflow-hidden border-radius-10px">
                                <h3 class="mb-0 fnt-family text-black fs-38">#higlights</h3>
                                <p class="mb-2 fw-400 lh-20 text-black fs-16">Students, in action
                                    —presenting their posters
                                    at an international medical
                                    conference.</p>
                                <h6 class="text-black fs-16"><i class="bi bi-geo-alt-fill"></i> Washington, D.C.</h6>
                                <p class="fs-14 text-black lh-18">Our NETWORK students* had a great time presenting
                                    their
                                    posters at an international medical
                                    conference—meeting med students from the U.S.
                                    and future doctors from around the world. It was solid exposure, good conversations,
                                    yep—definitely a strong addition to their resume.</p>
                            </div>


                            <div class="swiper magic-cursor slider-highlists" data-slider-options='{
                                "slidesPerView": 1,
                                "spaceBetween": 20,
                                "loop": true,
                                "navigation": { 
                                    "nextEl": ".slider-one-slide-next-3", 
                                    "prevEl": ".slider-one-slide-prev-3" 
                                },
                                "autoplay": { 
                                    "delay": 4000, 
                                    "disableOnInteraction": false 
                                },
                                "keyboard": { 
                                    "enabled": true, 
                                    "onlyInViewport": true 
                                },
                                "breakpoints": { 
                                    "1200": { "slidesPerView":2.8 }, 
                                    "992": { "slidesPerView": 2.5 }, 
                                    "768": { "slidesPerView": 1.5 }, 
                                    "320": { "slidesPerView": 1.5 } 
                                },
                                "effect": "slide"
                                }'>
                                <div class="swiper-wrapper">
                                    <!-- start slider item -->
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="./assets/img/g-1.jpg" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="./assets/img/g-3.jpg" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="./assets/img/g-3.jpg" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="./assets/img/g-3.jpg" />
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--<div-->
                            <!--    class="upcoming-swiper bottom-scrolling-swiper d-flex justify-content-center justify-content-xl-start flex-column gap-1">-->
                                <!-- start slider navigation -->
                            <!--    <div class="slider-one-slide-prev-3 text-dark-gray swiper-button-prev slider-navigation-style-04 border border-1 border-color-extra-medium-gray"-->
                            <!--        tabindex="0" role="button" aria-label="Previous slide"><i-->
                            <!--            class="fa-solid fa-arrow-left"></i></div>-->
                            <!--    <div class="slider-one-slide-next-3  text-dark-gray swiper-button-next slider-navigation-style-04 border border-1 border-color-extra-medium-gray"-->
                            <!--        tabindex="0" role="button" aria-label="Next slide"><i-->
                            <!--            class="fa-solid fa-arrow-right"></i></div>-->
                                <!-- end slider navigation -->
                            <!--</div>-->

                        </div>
                    </div>
                </div>
             </div>
             
        </section>
        
        
     <?php $this->load->view('partials/testimonials'); ?>
    
    
 
    <div id="applicantPremiumModal" class="mobile-applicant pgs-modal pgs-modal-uni pgs-modalamc premium-modal-overlay" style="display: none;" onclick="if(event.target===this){window.applicatModalCloseModal();}">
        <div class="premium-modal-container purple-modal d-flex">
            <!-- LEFT PANEL -->
            <div class="panel-left">
                <button class="close-btn desktop-none" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal();">✕</button>
                <div class="brand-row">
                    <div class="brand-title">#PGS</div>
                    <div class="heart-badge">
                        <img src="<?= base_url('assets/img/heart.gif') ?>" />
                    </div>
                </div>
                <div class="sub-label fnt-family">PARTNERSHIPS</div>
                <p class="tagline lh-18ppx">We work with institutions to create
                   international exposure, structured programs, and real outcomes.</p>

                <div class="boost-wrap">
                    <div class="mobile-none" style="margin : 0  0 0 auto">
                        <img src="<?= base_url('assets/img/arrow-modal.png') ?>" style="width: 95px;margin-left: -10px;" />
                        <span class="w-full d-block fs-16 text-white lh-18">get the <br />boost <br /> your <br /> deserves</span>
                    </div>
                    <div class="mb-4">
                        <img src="<?= base_url('assets/img/bump.png') ?>" />
                    </div>
                    <div class="desktop-none">
                        <p class="mb-0 fs-14 lh-20 fw-400 text-white">get the boost your <br /> PREP deserves</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="panel-right">
                <button class="close-btn mobile-none" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal();">✕</button>

                <div id="formContent">
                    <div class="field-group">
                        <div class="field">
                            <input type="text" id="nameInput" placeholder="Enter Name *" autocomplete="name" requried>
                        </div>
                        <div class="field">
                            <input type="email" id="emailInput" placeholder="Email *" autocomplete="email" requried>
                        </div>
                        <div class="field">
                            <input type="tel" id="phoneInput" placeholder="Phone (Whatsapp number preffered)" autocomplete="tel">
                        </div>
                    </div>

                    <div>
                        <p class="section-label mb-0">What are you aiming to sort out?</p>
                        <div class="toggle-list" style="margin-top:12px">
                            <label class="toggle-row">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked="">
                                    <span class="slider"></span>
                                </label>
                                <span>University Visits</span>
                            </label>
                            <label class="toggle-row">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked="">
                                    <span class="slider"></span>
                                </label>
                                <span>Exchange & Rotation Programs</span>
                            </label>
                            <label class="toggle-row">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked="">
                                    <span class="slider"></span>
                                </label>
                                <span>Student pathways</span>
                            </label>
                         
                        </div>
                    </div>

                    <br />

                    <div class="divider"></div>

                    <!--<div>-->
                    <!--    <p class="section-label">What are you planning to study?</p>-->
                    <!--    <div class="d-flex gap-3">-->
                    <!--        <button type="button" class="modal-btn-pgs"-->
                    <!--            onclick="if(event.target === this){ window.applicantPremiumOpen2(); } else { window.applicatModalCloseModal2(); }">-->
                    <!--            MS / Masters Abroad-->
                    <!--        </button>-->
                    <!--        <img src="<?= base_url('assets/img/arrow-btn.png') ?>" style="width : 26px; height :26px" />-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="cta-row">
                        <button class="cta-btn" id="ctaBtn">
                            Let’s build something
                            <span class="arrow">←</span>
                        </button>
                    </div>
                </div>

                <!-- SUCCESS STATE -->
                <div class="success-msg" id="successMsg">
                    <div class="checkmark">🎉</div>
                    <h3>You're all set!</h3>
                    <p>Your personalised checklist is on its way.<br>Check your inbox soon.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    

    <div id="applicantPremiumModal2" class="pgs-modal premium-modal-overlay modal-pgsamc-2 pgs-modal-uni-2" style="display: none;" onclick="if(event.target===this){window.applicatModalCloseModal2();}">
        <div class="premium-modal-container purple-modal d-flex bg-white pgs-modal-2" style="border-radius: 20px !important">
            <button class="close-btn" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal2();">✕</button>

            <div class="text-center">
                <h5 class="fw-700 fs-48 text-black"><img src="<?= base_url('assets/img/check-12.png') ?>" style="width : 50px" />you’re in</h5>
                <img  src="<?= base_url('assets/img/okk.png') ?>" class="w-50%" />
                <h5 class="fw-400 fs-24 fnt-family text-black">lets get things moving.</h5>
                <div class="w-180px desktop-none">
                 <p class="fs-13 fw-400 mb-5 text-black lh-15">
                   Our partnerships team will review your details
                   and reach out to you shortly.
                </p>
                <p class="fs-13 fw-400 mb-5 text-black lh-15">
                    A PGS advisor will contact you shortly
                </p>
                
                </div>
                
            </div>
            <div class="w-180px mobile-none">
                <p class="fs-13 fw-400 mb-5 text-black lh-15">
                   Our partnerships team will review your details
                   and reach out to you shortly.
                </p>
                <p class="fs-13 fw-400 mb-5 text-black lh-15">
                    A PGS advisor will contact you shortly
                </p>
            </div>
            <div class="mobile-none">
                <img class="mobile-none" src="<?= base_url('assets/img/heart.gif') ?>" style="width: 50px;border-radius: 10px;margin: 0 0 0 auto;display: block;" />
                <div style="background : #150035" class="p-3 mt-4">
                    <p class="fs-13 lh-15 text-white mb-4">Need to sort out the study journey?</p>
                    <p class="fs-13 lh-15 text-white mb-4">Book a free 15min clarity call</p>
                </div>
            </div>
        </div>
    </div>

    

   <!-- Footer -->
<?php $this->load->view('footer'); ?>
  
<script>
    // PurplePremium modal/apply logic (single source of truth for this page).
    window.ppOpenModal = function() {
        var el = document.getElementById('applicantPremiumModal');
        if (!el) return false;
        el.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        return false;
    };
    window.applicatCloseModal = function() {
        var el = document.getElementById('applicantPremiumModal');
        if (!el) return false;
        el.style.display = 'none';
        document.body.style.overflow = '';
        return false;
    };
</script>

<script>
    // PurplePremium modal/apply logic (single source of truth for this page).
    window.applicantPremiumOpen2 = function() {
        var el = document.getElementById('applicantPremiumModal2');
        if (!el) return false;
        el.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        return false;
    };
    window.applicatCloseModal2 = function() {
        var el = document.getElementById('applicantPremiumModal2');
        if (!el) return false;
        el.style.display = 'none';
        document.body.style.overflow = '';
        return false;
    };
</script>

<script>
    window.applicatModalCloseModal = function () {
        window.applicatCloseModal && window.applicatCloseModal();
        return false;
    };
    window.applicatModalCloseModal2 = function () {
        window.applicatCloseModal2 && window.applicatCloseModal2();
        return false;
    };
</script>
</body>

</html>