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


    <div class="wrapper-content">

        <section class="position-relative pt-4 purple-event-hero">
            <div class="container p-0">
                <div class="row justify-content-center">
                    <?php
                    $fe = isset($featured_event) ? $featured_event : null;
                    if ($fe):
                        $img_src = event_image_url(isset($fe->image1) ? $fe->image1 : null, base_url('assets/img/saved_4.jpg'), $fe->image2 ?? null);
                        $host = !empty($fe->host) ? $fe->host : (!empty($fe->category_name) ? '#' . $fe->category_name : '');
                        $sd = Purpleevents::format_event_date($fe->s_date);
                        $ed = Purpleevents::format_event_date($fe->e_date);
                        $tags_arr = !empty($fe->tags) ? preg_split('/[\s,#]+/', trim($fe->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                        if (!empty($fe->category_name) && empty($tags_arr)) $tags_arr = [trim($fe->category_name)];
                    ?>
                    <div class="col-lg-12 col-sm-12 mt-1 col-md-5 position-relative">
                        <div class="sop-card-unique left-13 full-box-content full-box-content-height border-none d-flex align-items-start justify-content-end gap-3 mobile-wrap">
                            <div class="w-30 mobile-w-full">
                                <?php if (!empty($fe->top_label)): ?>
                                <div class="sop-top-label h-30px w-130px fs-14 label-flot-update">
                                    <img src="<?= base_url('assets/img/red-hours.gif') ?>" class="w-15 ml-2" alt="" />
                                    &nbsp;<?= htmlspecialchars($fe->top_label) ?>
                                </div>
                                <?php endif; ?>
                                <div class="sop-image-wrapper-1 w-100">
                                    <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($fe->product_name) ?>" class="big_img" onerror="this.src='<?= base_url('assets/img/saved_4.jpg') ?>'">

                                    <div class="sop-heart-icon">
                                        <img src="<?= base_url('assets/img/share.png') ?>" alt="Share">
                                    </div>
                                    <?php if (!empty($fe->badge)): ?>
                                    <div class="sop-heart-icon bg-purple text-white px-1 fs-22 border-radius-6px">
                                        <?= htmlspecialchars($fe->badge) ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fe->author_name) || !empty($fe->author_bio)): ?>
                                    <div class="event-author-info">
                                        <?php if (!empty($fe->author_name)): ?>
                                        <h5 class="fs-12 text-black mb-0 lh-20"><?= htmlspecialchars($fe->author_name) ?></h5>
                                        <?php endif; ?>
                                        <?php if (!empty($fe->author_bio)): ?>
                                        <p class="fs-12 mb-0 lh-full"><?= nl2br(htmlspecialchars($fe->author_bio)) ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>


                            <div class="content-wrap w-50 p-1 pt-0 mobile-w-full">
                                <div class="w-70">
                                    <h1 class="mb-0 border-black fnt-family px-2 py-2 text-black fs-50 border-radius-4px bg-white">
                                        <?= htmlspecialchars($fe->product_name) ?>
                                    </h1>
                                </div>
                                <?php if ($host): ?>
                                <div class="mt-2 mb-4">
                                    <span class="fs-14">Host : </span> <span class="text-dark-gray fs-14"><?= htmlspecialchars($host) ?></span>
                                </div>
                                <?php endif; ?>

                                <div class="d-flex gap-3 mt-2">
                                    <div class="sop-content card-box-date">
                                        <div class="date-box bg-transparent">
                                            <div>
                                                <div class="box-date-info bg-black">
                                                    <span class="date text_purple"><?= $sd['day'] ?></span>
                                                    <span class="month"><?= $sd['month'] ?></span>
                                                </div>
                                                <p class="mb-0 text-black fw-600 fs-12 text-center"><?= $sd['time'] ?></p>
                                            </div>
                                            <div>
                                                <div class="box-date-info bg-black">
                                                    <span class="date text_purple"><?= $ed['day'] ?></span>
                                                    <span class="month"><?= $ed['month'] ?></span>
                                                </div>
                                                <p class="mb-0 text-black fw-600 fs-12 text-center"><?= $ed['time'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-p mobile-w-50">
                                        <?php if (!empty($fe->prod_sub_name)): ?>
                                        <h5 class="mb-2 text-black fs-25 fw-500 w-300px lh-30 mobile-w-full"><?= htmlspecialchars($fe->prod_sub_name) ?></h5>
                                        <?php endif; ?>
                                        <?php if (!empty($fe->description)): ?>
                                        <p class="mb-0 text-black fs-12 lh-12"><?= strip_tags(substr($fe->description, 0, 150)) ?><?= strlen(strip_tags($fe->description)) > 150 ? '…' : '' ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if (!empty($tags_arr)): ?>
                                <div class="sop-tags px-2 py-2 mb-0 mt-3">
                                    <?php foreach ($tags_arr as $t): $t = trim($t); if ($t === '') continue; ?>
                                    <span class="sop-tag"><?= (strpos($t, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($t) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                <div class="d-flex justify-content-space mt-0">
                                    <?php if (!empty($fe->book_url)): ?>
                                    <a href="<?= htmlspecialchars($fe->book_url) ?>" target="_blank" rel="noopener" 
                                    style="line-height : normal"
                                    class="sop-learn-btn bg-blue-500 mt-2 fs-17 w-100 fw-600 text-black border-radius-4px py-2 ht-48 text-center text-decoration-none">Book Your Seat</a>
                                    <?php else: ?>
                                    <button type="button" class="sop-learn-btn bg-blue-500 mt-2 fs-17 w-100 fw-600 text-black border-radius-4px py-2 ht-48">Book Your Seat</button>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fe->location_note)): ?>
                                <p class="mb-0 text-black text-center mt-2 pb-0 fs-16">📍 <?= htmlspecialchars($fe->location_note) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-lg-12 col-sm-12 mt-1 col-md-5 position-relative">
                        <div class="sop-card-unique left-13 full-box-content full-box-content-height border-none d-flex align-items-center justify-content-center p-5">
                            <p class="mb-0 text-black fs-18">No upcoming events at the moment. Check back soon.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-12"></div>
                    <div class="d-flex gap-5 w-60 align-items-start mt-8 mobile-wrap">
                        <div class="mobile-w-full">
                            <h3 class="fs-28 text-black text-uppercase fw-900 overflow-hidden text-blue mb-4 gr-mobile-1">
                                <span class="bg-light-green-200 p-1" style="white-space: nowrap;">Who’s It For?</span>
                            </h3>
                            <div class="d-flex align-items-start gap-1 mb-3">
                                <h4
                                    class="bg-light-green-200 mb-0 fs-24 lh-full p-1 text-black w-344px fw-500 overflow-hidden text-blue mobile-fs-14">
                                    Final-year student? <br/>
                                    Recent grad? Researching  <br/>
                                    for masters?
                                </h4>
                            </div>
                            <div class=" mb-3">
                                <h4
                                    class="bg-light-green-200 mb-0 fs-24 lh-full p-1 text-black w-344px fw-500 overflow-hidden text-blue mobile-fs-14">
                                  This session’s made for you.
                                </h4>
                            </div>
                        </div>
                        <div class="mobile-w-full">
                            <h3 class="fs-28 text-black text-uppercase fw-900 overflow-hidden text-blue mb-4 gr-mobile-1">
                                <span class="bg-light-green-200 p-1" style="white-space: nowrap;">Session Topics</span>
                            </h3>
                            <div class="mb-3">
                                 <h4
                                    class="bg-light-green-200 mb-0 fs-24 lh-full p-1 text-black w-344px fw-500 overflow-hidden text-blue mobile-fs-14">
                                  Masters in USA
                                </h4>
                                 <h4
                                    class="bg-light-green-200 mb-0 fs-24 lh-full p-1 text-black w-344px fw-500 overflow-hidden text-blue mobile-fs-14">
                                  UK for graduates
                                </h4>
                                 <h4
                                    class="bg-light-green-200 mb-0 fs-24 lh-full p-1 text-black w-344px fw-500 overflow-hidden text-blue mobile-fs-14">
                                 How to prepare your finances
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </section>

        <section class="pt-5">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mobile-box-4 mobile-box-style-2">
                        <h1 class="text-black fnt-family fw-500 fs-40 pt-0 text-center mobile-fs-24">
                            What We’ll Cover in This Session:
                        </h1>

                        <?php
                        $fe_cover = !empty($fe->what_we_cover) ? array_values(array_filter(array_map('trim', explode("\n", $fe->what_we_cover)))) : (!empty($fe->session_topics) ? array_values(array_filter(array_map('trim', explode("\n", $fe->session_topics)))) : []);
                        if (empty($fe_cover)) $fe_cover = ['How to shortlist unis that actually match your profile', 'Avoid common SOP/LOR mistakes that cost students', 'How Research Matters in your application', 'If you have gap in your profile or low CGPA how to proceed', 'What scholarships you be getting & what you need to do.'];
                        ?>
                        <div class="group-flex-items mt-5 d-flex wrap justify-content-center appear anime-child anime-complete">
                            <?php foreach ($fe_cover as $i => $point): ?>
                            <div class="w-211px column-flex">
                                <div class="d-flex align-items-start gap-3 mb-5">
                                    <span class="icon-box"><img src="<?= base_url('assets/img/icon-traingal.png') ?>" alt=""></span>
                                    <h4 class="text-black mb-0 fs-50 lh-50 fw-500"><?= sprintf('%02d', $i + 1) ?></h4>
                                </div>
                                <h6 class="mb-0 fs-14 text-center lh-20 text-black"><?= htmlspecialchars($point) ?></h6>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5">
            <div class="">
                <div class="d-flex justify-content-center align-items-center gap-5 mobile-wrap">
                        <div class="d-flex align-items-start gap-1 mb-3 w-344px mobile-w-70 mobile-auto mobile-pb-4">
                            <h4
                                class="bg-light-green-200 mb-0 fs-24 mobile-fs-22 lh-28 w-344px p-1 text-black fw-500 overflow-hidden text-blue m-border-1">
                                Final-year student? <br/>
                                Recent grad? Researching<br/>
                                for masters?
                            </h4>
                        </div>
                    <div class="w-25 mobile-w-50">
                        <ul class="todo-update-list p-0">
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4">
                                <img src="./assets/img/flat-color-icons_ok.png" />
                                Welcome Kit
                            </li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4">
                                <img src="./assets/img/flat-color-icons_ok.png" />
                                Live Q&A with Expert Counsellors
                            </li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4">
                                <img src="./assets/img/flat-color-icons_ok.png" />
                                Tips that you should know
                            </li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4">
                                <img src="./assets/img/flat-color-icons_ok.png" />
                                Goal-tracking and reflection chart
                            </li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4">
                                <img src="./assets/img/flat-color-icons_ok.png" />
                                Prep templates
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
        $facilitators_list = isset($facilitators) ? $facilitators : [];
        if (!empty($facilitators_list)):
        ?>
        <section class="pt-5">
            <div class="container">
                <div class="row justify-content-center align-items-center gap-5">
                    <div class="w-650px p-0 mobile-w-full">
                        <h4 class="text-black fs-40 text-center lh-50 mobile-fs-22 mobile-br-none mobile-lg-full mobile-mb-0">
                           <span class="fs-32"> Meet Your</span> <br> <span class="italic-texts fw-800">Facilitators</span>
                        </h4>

                        <div class="d-flex gap-3 justify-content-center flex-nowrap" style="flex-wrap: nowrap;">
                            <?php foreach ($facilitators_list as $fac): ?>
                            <div class="w-50 mobile-w-50 mobile-mt-0 mobile-pt-0">
                                <div class="founder-img-box border-radius-4px mb-2 w-full border-radius-20px">
                                    <img src="<?= htmlspecialchars(facilitator_image_url(isset($fac->image) ? $fac->image : null, base_url('assets/img/founder.png'))) ?>" alt="<?= htmlspecialchars($fac->name ?? '') ?>" data-no-retina="" onerror="this.src='<?= base_url('assets/img/founder.png') ?>'">
                                </div>
                                <h4 class="mb-0 text-black fs-40 mobile-fs-25"><?= htmlspecialchars($fac->name ?? '') ?></h4>
                                <?php if (!empty($fac->position)): ?>
                                <h6 class="text-uppercase fs-16 text-black mb-2 mt-2"><?= htmlspecialchars($fac->position) ?></h6>
                                <?php endif; ?>
                                <?php if (!empty($fac->details)): ?>
                                <div class="founder-info">
                                    <p><?= nl2br(htmlspecialchars($fac->details)) ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="position-relative pt-8">
            <div class="container overlap-gap-section p-0 position-relative">
                <div class="row align-items-center justify-content-center justify-content-md-center">
                    <div class="col-lg-10 m-auto mobile-w-90">
                        <div class="d-flex gap-5 align-items-center justify-content-center mobile-wrap">
                            <div class="w-40">
                                <div class="bg-black p-05 black-shadow mb-5">
                                    <div class="header-bg-black d-flex text-white justify-content-space pb-1 px-3">
                                        <span class="fs-13 fs-13 mobile-fs-10">
                                            <i class="bi bi-circle"></i>
                                            <i class="bi bi-circle"></i>
                                            <i class="bi bi-circle"></i>
                                        </span>
                                        <h5 class="mb-0 text-uppercase fs-20 mobile-fs-12">note</h5>
                                        <span><i class="bi bi-file-earmark-pdf"></i></span>
                                    </div>
                                    <div class="bg-purple-100 d-flex justify-content-center align-items-center h-180px">
                                        <h5 class="mb-0 fs-25 text-black text-center w-328px mobile-fs-16 mobile-lh-full">
                                            This is a tailor made 
                                            event for Masters, 
                                            engineering &amp; Mba Aspirants
                                        </h5>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="w-40 px-4 mb-4 mobile-d-flex mobile-gap-2">
                                <h5 class="mb-2 fs-22 fw-700 lh-30 text-black mobile-font-400 mobile-w-50 mobile-lh-16">Walk away with a clear roadmap for your study
                                    abroad
                                    journey.
                                </h5>
                                <p class="mb-0 fs-22 fw-400 lh-30 text-black mobile-w-50 mobile-lh-16">Get tips, avoid common mistakes, and boost your
                                    admit
                                    chances to top UK universities—plus crack scholarships, SOPs, and ROI planning like
                                    a
                                    pro.</p>
                            </div>
                        </div>
                        <div class="w-60 m-auto mt-4 mobile-last-auto mobile-w-48 mobile-auto-last">
                            <p class="mb-0 text-black fs-20 lh-full w-80 m-auto mt-3 lt-0.2 mobile-p-0 mobile-w-full mobile-fs-14 mobile-lh-16">More sessions coming up for
                                    Medical
                                    aspirants &amp; for STEAM streams connect with our
                                    counselors to <br> <b>get started. Get your seat locked.</b></p>
                        </div>
                    </div>
                       </div>
                          </div>
        </section>

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
                        <div class="overflow-hidden border-radius-16px w-383px box-border-fix">
                            <div class="card-box-gradiant border p-4">
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
                                <?php if (!empty($ev->who_is_it_for)): ?>
                                <div class="btn-content w-50">
                                    <h5 class="mb-0 text-black fw-600 fs-16 lh-24">Who's It For?</h5>
                                    <p class="mb-0 fs-14 lh-18 text-black"><?= nl2br(htmlspecialchars($ev->who_is_it_for)) ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($ev_topics)): ?>
                                <div class="text-content">
                                    <h5 class="mb-0 text-black fw-400 fs-16 lh-24">Topics Covered</h5>
                                    <?php foreach ($ev_topics as $tp): ?>
                                    <h6 class="mb-0 text-black fw-400 fs-15 lh-20"><?= htmlspecialchars($tp) ?></h6>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
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
                                "loop": true,
                                "navigation": { 
                                    "nextEl": ".slider-one-slide-next-1", 
                                    "prevEl": ".slider-one-slide-prev-1" 
                                },
                                "autoplay": { 
                                    "delay": 4000, 
                                    "disableOnInteraction": false 
                                },
                                "keyboard": { 
                                    "enabled": false, 
                                    "onlyInViewport": false 
                                },
                                "breakpoints": { 
                                    "1200": { "slidesPerView": 4 }, 
                                    "992": { "slidesPerView": 3 }, 
                                    "768": { "slidesPerView": 3 }, 
                                    "320": { "slidesPerView": 2 } 
                                },
                                "effect": "slide"
                                }'>
                                <div class="swiper-wrapper purple-teams" style="gap : 10px">
                                     <!--start slider item -->
                                    <?php
                                    $events_slider = isset($events) ? $events : [];
                                    foreach ($events_slider as $ev2):
                                        $ev2_sd = Purpleevents::format_event_date($ev2->s_date);
                                        $ev2_ed = Purpleevents::format_event_date($ev2->e_date);
                                        $ev2_topics = !empty($ev2->session_topics) ? array_filter(array_map('trim', explode("\n", $ev2->session_topics))) : [];
                                    ?>
                                        <div class="swiper-slide overflow-hidden border-radius-16px w-383px box-border-fix">
                            <div class="card-box-gradiant border p-4">
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
                                <?php if (!empty($ev2->who_is_it_for)): ?>
                                <div class="btn-content w-50">
                                    <h5 class="mb-0 text-black fw-600 fs-16 lh-24">Who's It For?</h5>
                                    <p class="mb-0 fs-14 lh-18 text-black"><?= nl2br(htmlspecialchars($ev2->who_is_it_for)) ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($ev2_topics)): ?>
                                <div class="text-content">
                                    <h5 class="mb-0 text-black fw-400 fs-16 lh-24">Topics Covered</h5>
                                    <?php foreach ($ev2_topics as $tp2): ?>
                                    <h6 class="mb-0 text-black fw-400 fs-15 lh-20"><?= htmlspecialchars($tp2) ?></h6>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
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
                        <img src="./assets/img/top-to-right.png" class="m-last d-block mb-4 mobile-none" />
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
                            <a href="#"><img width="45px" src="./assets/img/outline-wp.png" /></a>
                            <a href="#"><img width="45px" src="./assets/img/outline-messager.png" /></a>
                            <a href="#"><img width="45px" src="./assets/img/outline-insta.png" /></a>
                            <a href="#"><img width="45px" src="./assets/img/outline-facebook.png" /></a>
                        </div>
                        <img src="./assets/img/top-to-right.png" class="m-last d-block mb-4 desktop-none mobile-new-down-arrow-1" data-no-retina="">
                    </div>
                    <div class="w-50 mobile-w-full">
                        <div class="bg-gray-100 p-4 pr-0">
                            <div class="bg-card-set position-relative" style="background-image: url(img/green-1.png);">
                                <div class="bg-purple-100 d-inline-block p-2">
                                    <img src="./assets/img/logo-transparent.png" width="180px" alt=""><br />
                                    <h5 class="mb-0 text-uppercase fs-20 lh-28 d-inline-block bg-new px-2 py-1">invitation for
                                    </h5>
                                    <h5 class="mb-0 fnt-family fs-50 bg-new px-2 py-1">for aspirants</h5>
                                    <div class="sop-heart-icon">
                                        <button type="button" class="btn btn-download-custom">
                                            <img src="./assets/img/download.png" alt="download" />
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
                                            <img src="./assets/img/join-btn.png" />
                                        </button>
                                        <img src="./assets/img/qr-2.png" />
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
        <!--                                        <img src="./assets/img/g-1.jpg" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="./assets/img/g-3.jpg" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="./assets/img/g-3.jpg" />-->
        <!--                                    </div>-->

        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="swiper-slide">-->
        <!--                                <div class="overflow-hidden border-radius-10px">-->
        <!--                                    <div class="full-photo h-600px border-radius-15px mb-5 p-2">-->
        <!--                                        <img src="./assets/img/g-3.jpg" />-->
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
        
           <?php $this->load->view('partials/testimonials'); ?>

 

 <!-- Footer -->
     <?php $this->load->view('footer'); ?>
    <!-- end section -->

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script>
        console.log('Purple Events DB data:', <?= json_encode(isset($events) ? $events : [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>);
        console.log('Purple Featured Event DB data:', <?= json_encode(isset($featured_event) ? $featured_event : null, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>);
    </script>
</body>

</html>
