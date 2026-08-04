<style>
    .text-content {
    width: 60%;
    margin-top: 10px;
    margin-bottom: 15px;
    height: 45px;
}
   .sop-learn-btn.bg-blue-500
        {
            line-height :34px !important;
        }
     .swiper-wrapper .purple-dot:after
     {
       top : 10px;
       left : 10px;
     }
</style>

<?php $events = isset($events) ? $events : []; $testimonials = isset($testimonials) ? $testimonials : []; ?>
        <section class="pt-3 mobile-event-program desktop-none">
            <div class="container overlap-gap-section p-0 position-relative">
                <div class="d-flex align-items-center justify-content-center justify-content-md-center mobile-wrap mobile-lh-full">
                    <div class="w-30 mobile-w-full text-center">
                        <h1 class="fnt-family fs-50 mb-0 text-black">
                            <span class="mobile-fs-24">Upcoming Sessions</span>
                        </h1>
                    </div>
                        <?php
                        $events_list = isset($events) ? $events : [];
                        foreach ($events_list as $ev):
                            $ev_sd = Purpleevents::format_event_date($ev->s_date);
                            $ev_ed = Purpleevents::format_event_date($ev->e_date);
                            $ev_topics = !empty($ev->session_topics) ? array_filter(array_map('trim', explode("\n", $ev->session_topics))) : [];
                        ?>
                        <div class="overflow-hidden border-radius-16px w-383px h-100">
                            <div class="card-box-gradiant border p-4 d-flex flex-column h-100">
                                <div>
                                    <div class="card-box-gradiant-header purple-dot">
                                        <h5 class="mb-0"><?= htmlspecialchars($ev->product_name) ?></h5>
                                    </div>
                                    <div class="date-box">
                                        <div>
                                            <div class="box-date-info">
                                                <span class="date"><?= $ev_sd['day'] ?></span>
                                                <span class="month"><?= $ev_sd['month'] ?></span>
                                            </div>
                                            <p class="mb-0 text-black fw-600 fs-12 lh-16 mt-2"><?= $ev_sd['time'] ?></p>
                                        </div>
                                        <div>
                                            <div class="box-date-info">
                                                <span class="date"><?= $ev_ed['day'] ?></span>
                                                <span class="month"><?= $ev_ed['month'] ?></span>
                                            </div>
                                            <p class="mb-0 text-black fw-600 fs-12 lh-16 mt-2"><?= $ev_ed['time'] ?></p>
                                        </div>
                                    </div>
                                    <div class="card-text-body mt-2">
                                        <?php if (!empty($ev->who_is_it_for)): ?>
                                        <div class="btn-content w-100" >
                                            <h5 class="mb-0 text-black fw-600 fs-16 lh-24">Who's It For?</h5>
                                            <p class="mb-0 fs-14 lh-18 text-black"><?= nl2br(htmlspecialchars($ev->who_is_it_for)) ?></p>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (!empty($ev_topics)): ?>
                                        <div class="text-content mt-2">
                                            <h5 class="mb-0 text-black fw-400 fs-16 lh-24">Topics Covered</h5>
                                            <?php foreach ($ev_topics as $tp): ?>
                                            <h6 class="mb-0 text-black fw-400 fs-15 lh-20"><?= htmlspecialchars($tp) ?></h6>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-space">
                                        <a href="<?= base_url('purpleevents/session/' . (int)$ev->id) ?>" class="sop-learn-btn bg-blue-500 mt-4 fs-12 ht-32 text-decoration-none text-black d-inline-flex align-items-center justify-content-center">Learn More</a>
                                    </div>
                                    <div class="img-left-absoulute">
                                        <figure class="position-relative m-0 text-center">
                                            <?php $card_img = event_image_url($ev->image1 ?? null, base_url('assets/img/tab-img.jpg'), $ev->image2 ?? null); ?>
                                            <img src="<?= htmlspecialchars($card_img) ?>" alt="<?= htmlspecialchars($ev->product_name) ?>" onerror="this.src='<?= base_url('assets/img/tab-img.jpg') ?>'">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        </div>
                </div>
            </div>
        </section>
 <div class="wrapper-content">
        <section
            class="overflow-hidden bg-regal-blue position-relative border-radius-6px lg-border-radius-0px z-index-0 mobile-none">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <h1 class="fnt-family fs-50 mb-0 text-black">Upcoming Sessions</h1>
                    </div>
                </div>
                <div class="row align-items-center mb-0 sm-mb-9 text-center text-lg-start justify-content-center">

                    <div class="col-lg-12">
                        <div class="outside-box-right-25 sm-outside-box-right-0 d-flex gap-4 upcoming-swiper">
                            <div class="d-flex align-items-center">
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
                            <div class="swiper magic-cursor slider-one-slide pb-40px" style="margin  : 0" data-slider-options='{
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "loop": false,
                                "navigation": { 
                                    "nextEl": ".slider-one-slide-next-1", 
                                    "prevEl": ".slider-one-slide-prev-1" 
                                },
                                "autoplay": { 
                                    "delay": 40000, 
                                    "disableOnInteraction": false 
                                },
                                "keyboard": { 
                                    "enabled": false, 
                                    "onlyInViewport": false 
                                },
                                "breakpoints": { 
                                    "1200": { "slidesPerView": 4 }, 
                                    "992": { "slidesPerView": 4 }, 
                                    "768": { "slidesPerView": 3 }, 
                                    "320": { "slidesPerView": 2 } 
                                },
                                "effect": "slide"
                                }'>
                                <div class="swiper-wrapper purple-teams">
                                     <!--start slider item -->
                                    <?php
                                    $events_slider = isset($events) ? $events : [];
                                    foreach ($events_slider as $ev2):
                                        $ev2_sd = Purpleevents::format_event_date($ev2->s_date);
                                        $ev2_ed = Purpleevents::format_event_date($ev2->e_date);
                                        $ev2_topics = !empty($ev2->session_topics) ? array_filter(array_map('trim', explode("\n", $ev2->session_topics))) : [];
                                    ?>
                                     <div class="swiper-slide overflow-hidden border-radius-16px w-383px box-border-fix">
                            <div class="card-box-gradiant border p-4 d-flex flex-column h-100">
                                <div>
                                    <div class="card-box-gradiant-header purple-dot">
                                        <h5 class="mb-0"><?= htmlspecialchars($ev2->product_name) ?></h5>
                                    </div>
                                    <div class="date-box">
                                        <div>
                                            <div class="box-date-info">
                                                <span class="date"><?= $ev2_sd['day'] ?></span>
                                                <span class="month"><?= $ev2_sd['month'] ?></span>
                                            </div>
                                            <p class="mb-0 text-black fw-600 fs-12 lh-16 mt-2"><?= $ev2_sd['time'] ?></p>
                                        </div>
                                        <div>
                                            <div class="box-date-info">
                                                <span class="date"><?= $ev2_ed['day'] ?></span>
                                                <span class="month"><?= $ev2_ed['month'] ?></span>
                                            </div>
                                            <p class="mb-0 text-black fw-600 fs-12 lh-16 mt-2"><?= $ev2_ed['time'] ?></p>
                                        </div>
                                    </div>
                                    <div class="card-text-body mt-2">
                                        <?php if (!empty($ev2->who_is_it_for)): ?>
                                        <div class="btn-content w-100" style="    height: 80px;">
                                            <h5 class="mb-0 text-black fw-600 fs-16 lh-24">Who's It For?</h5>
                                            <p class="mb-0 fs-14 lh-18 text-black"><?= nl2br(htmlspecialchars($ev2->who_is_it_for)) ?></p>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (!empty($ev2_topics)): ?>
                                        <div class="text-content mt-2">
                                            <h5 class="mb-0 text-black fw-400 fs-16 lh-24">Topics Covered</h5>
                                            <?php foreach ($ev2_topics as $tp2): ?>
                                            <h6 class="mb-0 text-black fw-400 fs-15 lh-20"><?= htmlspecialchars($tp2) ?></h6>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-autoc mt-5">
                                    <div class="d-flex justify-content-space">
                                        <a href="<?= base_url('purpleevents/session/' . (int)$ev2->id) ?>" class="sop-learn-btn bg-blue-500 mt-4 fs-12 ht-32 text-decoration-none text-black d-inline-flex align-items-center justify-content-center">Learn More</a>
                                    </div>
                                    <div class="img-left-absoulute">
                                        <figure class="position-relative m-0 text-center">
                                            <?php $card_img2 = event_image_url($ev2->image1 ?? null, base_url('assets/img/tab-img.jpg'), $ev2->image2 ?? null); ?>
                                            <img src="<?= htmlspecialchars($card_img2) ?>" alt="<?= htmlspecialchars($ev2->product_name) ?>" onerror="this.src='<?= base_url('assets/img/tab-img.jpg') ?>'">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        
        

        <section class="position-relative pt-5 mobile-download-1">
            <div class="container overlap-gap-section p-0 position-relative">
                <div class="d-flex align-items-center justify-content-center justify-content-md-center gap-4 mobile-wrap">
                    <div class="w-40 mobile-w-70 mobile-m-auto">
                        <img src="<?= base_url('assets/img/top-to-right.png') ?>" class="m-last d-block mb-4 mobile-none" />
                        <h4 class="fs-24 fw-500 lh-28 mb-4 text-black fnt-family-1">
                            Download the poster. Share it.
                            Tag us on your fav socials.
                        </h4>
                        <p class="text-black fs-14 lh-22  w-80 fnt-family-1 fw-300">Help us spread the word, and you might just win a 
                            <b>Purple
                            Hamper</b>
                            and <b>get free guidance on one
                            research project.</b>
                            Become a #PurpleAmbassador.</p>

                        <div class="d-flex gap-4 justify-content-space w-70">
                            <a href="#"><img width="45px" src="<?= base_url('assets/img/outline-wp.png') ?>" /></a>
                            <a href="#"><img width="45px" src="<?= base_url('assets/img/outline-messager.png') ?>" /></a>
                            <a href="#"><img width="45px" src="<?= base_url('assets/img/outline-insta.png') ?>" /></a>
                            <a href="#"><img width="45px" src="<?= base_url('assets/img/outline-facebook.png') ?>" /></a>
                        </div>
                        <img src="<?= base_url('assets/img/top-to-right.png') ?>" class="m-last d-block mb-4 desktop-none mobile-new-down-arrow-1" data-no-retina="">
                    </div>
                    <div class="w-50 mobile-w-full">
                        <div class="bg-gray-100 p-4 pr-0">
                            <div class="bg-card-set position-relative" style="background-image: url(<?= base_url('assets/img/green-1.png') ?>);">
                                <div class="bg-purple-100 d-inline-block p-2">
                                    <img src="<?= base_url('assets/img/logo-transparent.png') ?>" width="180px" alt=""><br />
                                    <h5 class="mb-0 text-uppercase fs-20 lh-28 d-inline-block bg-new px-2 py-1">invitation for
                                    </h5>
                                    <h5 class="mb-0 fnt-family fs-50 bg-new px-2 py-1">for aspirants</h5>
                                    <div class="sop-heart-icon">
                                        <button type="button" class="btn btn-download-custom">
                                            <img src="<?= base_url('assets/img/download.png') ?>" alt="download" />
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-purple-100 d-inline-block py-2 px-1 d-inline-block w-70 mt-4">
                                    <h5 class="mb-0 fs-24 d-inline-block text-black fw-500 px-2 py-1">
                                        Designed for Master’s, MBA, and Engineering aspirants planning to study abroad.
                                    </h5>
                                </div>
                                <div class="bg-purple-100 d-inline-block py-1 px-1 w-30 d-block mt-1">
                                    <h5 class="mb-0 fs-20 lh-25 d-inline-block text-black fw-400 px-2 ">
                                        Live on Zoom
                                    </h5>
                                </div>

                                <div class="d-flex mt-4 gap-3">
                                    <div class="card-box-date w-50 mobile-w-50">
                                        <div class="date-box bg-transparent ht-full justify-content-start p-0">
                                            <div>
                                                <div class="box-date-info bg-black text_purple">
                                                    <span class="date">31</span>
                                                    <span class="month">Dec 25</span>
                                                </div>
                                                <p class="mb-0 text-black fw-600 fs-12 text-center">12pm to 2 pm</p>
                                            </div>
                                            <div>
                                                <div class="box-date-info bg-black text_purple">
                                                    <span class="date">31</span>
                                                    <span class="month">Dec 25</span>
                                                </div>
                                                <p class="mb-0 text-black fw-600 fs-12 text-center">12pm to 2 pm</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-50 mobile-w-50">
                                        <button type="button" class="btn btn-trapsparent border-none bg-transparent">
                                            <img src="<?= base_url('assets/img/join-btn.png') ?>" />
                                        </button>
                                        <img src="<?= base_url('assets/img/qr-2.png') ?>" />
                                        <div class="text-content w-100">
                                            <h5 class="mb-3 text-black fw-400 fs-16 lh-20">Topics Covered</h5>
                                            <h6 class="mb-2 text-black fw-400 fs-14 lh-20 ">Masters in USA UK for
                                                graduates
                                            </h6>
                                            <h6 class="mb-2 text-black fw-400 fs-14 lh-20">How to prepare your finances
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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


                            <div class="swiper magic-cursor slider-highlists w-100" data-slider-options='{
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
                                    <?php $this->load->view('_higlights_slider', ['testimonials' => isset($testimonials) ? $testimonials : []]); ?>
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
        <!--<section class="overlap-height position-relative ">-->
        <!--    <div class="overlap-gap-section p-0">-->
        <!--        <div class="row justify-content-end p-0">-->
        <!--            <div class="col-lg-7">-->
        <!--                <div -->
        <!--                    class="d-flex justify-content-end gap-3 border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px">-->
        <!--                    <div class="w-35 overflow-hidden border-radius-10px">-->
        <!--                        <h3 class="mb-0 fnt-family text-black fs-38">#higlights</h3>-->
        <!--                        <p class="mb-2 fw-400 lh-20 text-black fs-16">Students, in action-->
        <!--                            —presenting their posters-->
        <!--                            at an international medical-->
        <!--                            conference.</p>-->
        <!--                        <h6 class="text-black fs-16"><i class="bi bi-geo-alt-fill"></i> Washington, D.C.</h6>-->
        <!--                        <p class="fs-14 text-black lh-18">Our NETWORK students* had a great time presenting-->
        <!--                            their-->
        <!--                            posters at an international medical-->
        <!--                            conference—meeting med students from the U.S.-->
        <!--                            and future doctors from around the world. It was solid exposure, good conversations,-->
        <!--                            yep—definitely a strong addition to their resume.</p>-->
        <!--                    </div>-->


        <!--                    <div class="swiper magic-cursor slider-highlists" data-slider-options='{-->
        <!--                        "slidesPerView": 1,-->
        <!--                        "spaceBetween": 20,-->
        <!--                        "loop": true,-->
        <!--                        "navigation": { -->
        <!--                            "nextEl": ".slider-one-slide-next-3", -->
        <!--                            "prevEl": ".slider-one-slide-prev-3" -->
        <!--                        },-->
        <!--                        "autoplay": { -->
        <!--                            "delay": 4000, -->
        <!--                            "disableOnInteraction": false -->
        <!--                        },-->
        <!--                        "keyboard": { -->
        <!--                            "enabled": true, -->
        <!--                            "onlyInViewport": true -->
        <!--                        },-->
        <!--                        "breakpoints": { -->
        <!--                            "1200": { "slidesPerView":2.4 }, -->
        <!--                            "992": { "slidesPerView": 2 }, -->
        <!--                            "768": { "slidesPerView": 1 }, -->
        <!--                            "320": { "slidesPerView": 1 } -->
        <!--                        },-->
        <!--                        "effect": "slide"-->
        <!--                        }'>-->
        <!--                        <div class="swiper-wrapper">-->
                                    <!-- start slider item -->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="<?= base_url('assets/img/g-1.jpg') ?>" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="<?= base_url('assets/img/g-3.jpg') ?>" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="<?= base_url('assets/img/g-3.jpg') ?>" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="<?= base_url('assets/img/g-3.jpg') ?>" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->

        <!--                    </div>-->

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

        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--     </div>-->
             
        <!--</section>-->
        
        <div class="wrapper-content">

               <section class="position-relative pt-5 mobile-pb-25">
            <div class="container overlap-gap-section p-0 position-relative">
                <div class="row align-items-center justify-content-center justify-content-md-center">
                    <div class="col-lg-9 m-last">
                        <div class="sm-outside-box-right-0 d-flex gap-4 upcoming-swiper mobile-wrap">
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-center justify-content-xl-start flex-column gap-3 mobile-arrow-new">
                                    <!-- start slider navigation -->
                                    <div class="slider-one-slide-prev-2 text-dark-gray swiper-button-prev slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                        tabindex="0" role="button" aria-label="Previous slide"><i
                                            class="fa-solid fa-arrow-left"></i></div>
                                    <div class="slider-one-slide-next-2  text-dark-gray swiper-button-next slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                        tabindex="0" role="button" aria-label="Next slide"><i
                                            class="fa-solid fa-arrow-right"></i></div>
                                    <!-- end slider navigation -->
                                </div>
                            </div>
                            <div class="swiper magic-cursor slider-review" data-slider-options='{
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "loop": true,
                                "navigation": { 
                                    "nextEl": ".slider-one-slide-next-2", 
                                    "prevEl": ".slider-one-slide-prev-2" 
                                },
                                "autoplay": { 
                                    "delay": 3000, 
                                    "disableOnInteraction": false 
                                },
                                "keyboard": { 
                                    "enabled": false, 
                                    "onlyInViewport": false 
                                },
                                "breakpoints": { 
                                    "1200": { "slidesPerView": 1 }, 
                                    "992": { "slidesPerView": 1 }, 
                                    "768": { "slidesPerView": 1 }, 
                                    "320": { "slidesPerView": 1 } 
                                },
                                "effect": "slide"
                                }'>
                                <div class="swiper-wrapper">
                                    <?php $this->load->view('_testimonials_slider', ['testimonials' => isset($testimonials) ? $testimonials : []]); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

<section class="half-section overlap-height position-relative overflow-hidden">
            <div class="container overlap-gap-section p-0">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px">
                    <div class="mb-10px gap-5">
                        <div class="text-center mb-2">
                            <span class="small-caption" style="color: #6A5ED9;">Let's Go</span>
                            <h5 class="w-100 text-black fs-40 mb-2 fw-700 m-auto">
                                Ready to get started?
                            </h5>
                            <p class="w-40 text-center m-auto">Let’s chart your study abroad path, together with Team
                                #PGS.
                            </p>
                            <a href="#" style="padding: 8px 30px; background-color: #6A5ED9;" class="mb-2 btn btn-small-large border-radius-10px text-white   btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-15px">
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
        
           <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <h5 class="text-black fs-25 mb-4">
                           Frequently Asked Questions</h5>
                        <div class="d-flex gap-5">
                            <div class="w-25">
                                <div class="group-of-button-div">
                                    <ul class="portfolio-filter box-tabs-bottom m-0 p-0 nav nav-tabs">
                                        <li class="nav active">
                                        <a data-filter=".tab_1" href="#" >Programme Details</a>
                                        </li>
                                        <li class="nav">
                                        <a data-filter=".tab_2" href="#" >Programme Learning Experience</a>
                                        </li>
                                        <li class="nav">
                                        <a data-filter=".tab_3" href="#" >Refund Policy/Financials</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="w-70 portfolio-wrapper">
                            <div class="grid-item tab_1 transition-inner-all w-100" class="text-red-active">
                                <div class="accordion accordion-style-02" id="accordion-style-02"
                                    data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">
                                    <!-- start accordion item -->
                                    <div class="accordion-item active-accordion border-bottom pt-0">
                                        <div class="accordion-header  border-color-extra-medium-gray pt-0">
                                            <a href="#" data-bs-toggle="collapse"
                                                data-bs-target="#accordion-style-02-01" aria-expanded="true"
                                                data-bs-parent="#accordion-style-02">
                                                <div class="accordion-title mb-0 position-relative text-black">
                                                    <i class="feather icon-feather-minus"></i><span
                                                        class="fw-600 fs-20 ls-minus-05px">Who can apply for
                                                        scholarships?</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="accordion-style-02-01" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordion-style-02">
                                            <div
                                                class="accordion-body last-paragraph-no-margin  border-color-light-medium-gray">
                                                <p class="fw-400">Scholarships are available for students and
                                                    professionals
                                                    looking to study abroad, whether you're pursuing undergraduate,
                                                    graduate, or professional development programs. Each scholarship has
                                                    specific eligibility criteria based on academic background, field of
                                                    study, and career goals.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end accordion item -->
                                    <!-- start accordion item -->
                                    <div class="accordion-item border-bottom">
                                        <div class="accordion-header  border-color-extra-medium-gray">
                                            <a href="#" data-bs-toggle="collapse"
                                                data-bs-target="#accordion-style-02-02" aria-expanded="false"
                                                data-bs-parent="#accordion-style-02">
                                                <div class="accordion-title mb-0 position-relative text-black">
                                                    <i class="feather icon-feather-plus"></i><span
                                                        class="fw-600 fs-20 ls-minus-05px">Are scholarships 100%
                                                        guaranteed?</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="accordion-style-02-02" class="accordion-collapse collapse"
                                            data-bs-parent="#accordion-style-02">
                                            <div
                                                class="accordion-body last-paragraph-no-margin  border-color-light-medium-gray">
                                                <p class="fw-400">We deliver customized marketing campaign to use
                                                    your audience to
                                                    make a positive move.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="grid-item tab_2 transition-inner-all w-100">Programme Learning Experience</div>
                            <div class="grid-item tab_3 transition-inner-all w-100">Refund Policy/Financials</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        </div>

