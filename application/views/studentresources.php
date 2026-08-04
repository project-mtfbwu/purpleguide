<!doctype html>
<html class="no-js" lang="en">
   <?php $current = strtolower($this->uri->segment(1) ?? ''); ?>

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
    .arrow-box {
        background-color: #BBC8FF;
        width: 32px;
        height: 60px;
        padding: 0px 7px;
        border-radius: 10px !important;
        z-index: 100;
        position: relative;
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
    
     <?php $this->load->view('sidebar'); ?>
    <!-- end header -->

    <!-- user section -->
   
    
        <section class="pt-0 overlap-height position-relative scale-down minus-5 mobile-section-step hero-student-resource mobile-pb-0">
            <div class="container overlap-gap-section p-0 pt-3">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <h6 class="mb-3 text-black fs-24 mt-0 w-70 lh-35">
                           Stay updated with the latest deadlines, exam dates, and <br/> exclusive events organized by #PGS
                            <b>#PGS</b>
                        </h6>
                         <div class="border-box-gradiant mb-10">
                        <div class="card-box-img bg-gray ">
                            <div class="fit-object-cover-2 border-radius-10px">
                                <img src="./assets/img/fit-student-hero-desk.png" class="border-radius-10px" />
                            </div>
                            <div class="pt-3 d-flex justify-content-space align-items-start px-3">
                                <div>
                                    <h4 class="fnt-family mb-1 mt-3 fs-96 text-black lh-80 fw-400">Student Resources 
                                        <br />& Event<span class="fnt-family fs-40">updates</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                </div>
        </section>

        <section class="pt-0 studentResource">
            <div class="container-fluid overlap-gap-section px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-12 p-0">

                        <div class="card-box-100 py-5 position-relative px-3">


                            <div class="d-flex gap-3 mobile-wrap">
                                <div class="w-23 mobile-w-full">
                                    <div class="text-center">
                                        <h5 class="mb-0 fs-16 text-black">*Last updated on <?= htmlspecialchars(isset($key_dates_last_updated) ? $key_dates_last_updated : '6th June, 2025') ?></h5>
                                        <h3 class="p-1 fnt-family bg-white text-black d-inline-block fs-38">Upcoming Key Dates</h3>
                                    </div>
                                </div>
                                <?php
                                $key_dates_list = isset($key_dates) ? $key_dates : [];
                                $by_month = [];
                                foreach ($key_dates_list as $kd) {
                                    $m = $kd->month_label ?: 'other';
                                    if (!isset($by_month[$m])) $by_month[$m] = [];
                                    $by_month[$m][] = $kd;
                                }
                                if (empty($by_month)) {
                                    $by_month['aug'] = [(object)['title' => 'MCAT REGISTRATION', 'date_day' => '28th', 'date_month' => 'august', 'date_year' => '2025', 'link' => '#', 'tags' => '#UK #Engineering #Scholarship']];
                                }
                                foreach ($by_month as $month_label => $dates):
                                ?>
                                <div class="w-30 mobile-w-full">
                                    <div class="d-flex gap-3 align-items-start">
                                        <h4 class="mb-0 fnt-family text-black top-0 text-nowrap fs-38"><?= htmlspecialchars($month_label) ?></h4>
                                        <div class="w-100">
                                            <?php foreach ($dates as $kd):
                                                $tags = !empty($kd->tags) ? array_filter(array_map('trim', preg_split('/[,\s]+/', $kd->tags))) : [];
                                            ?>
                                            <div class="d-flex gap-2 mb-4">
                                                <div class="border-gray px-2 py-2 border-radius-15px w-270px">
                                                    <h5 class="bg-yellow text-black p-2 text-uppercase fs-22 mb-0 lh-30 d-inline"><?= htmlspecialchars($kd->title) ?></h5>
                                                    <?php if (!empty($tags)): ?>
                                                    <div class="sop-tags">
                                                        <?php foreach ($tags as $tag): $tag = (strpos($tag, '#') === 0) ? $tag : '#' . $tag; ?>
                                                        <span class="sop-tag"><?= htmlspecialchars($tag) ?></span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="w-25">
                                                    <h4 class="mb-0 fnt-family text-black fs-25 lh-25"><?= htmlspecialchars($kd->date_day) ?> <br /> <?= htmlspecialchars($kd->date_month) ?> <br /> <?= htmlspecialchars($kd->date_year) ?></h4>
                                                    <a href="<?= !empty($kd->link) ? htmlspecialchars($kd->link) : '#' ?>" class="bg-yellow p-5 text-underline text-black fs-16">link</a>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>


                        </div>
                    </div>
                    <div class="bottom-scrolling-hr">
                        <button type="button" class="btn p-0 border-none">
                            <img src="./assets/img/down-arrow-scroll.png" />
                        </button>
                        <button type="button" class="btn p-0 border-none">
                            <img src="./assets/img/top-arrow-scroll.png" />
                        </button>
                    </div>

                </div>
            </div>
        </section>
        
      
        <section class="pt-3">
            <div class="container-fluid overlap-gap-section px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-12 p-0">
                        
                        <div class="bg-red border-radius-20px p-4 pb-5">
                            <div class="text-start w-20 text-white m-auto mb-5 mobile-w-50 mobile-mb-0">
                                <p class="mb-0 fs-22">urgent</p>
                                <h1 class="mb-0 fs-36">Deadlines & Updates</h1>
                            </div>
                            
                            <div class="d-flex gap-4 align-items-start mobile-wrap">
                                <div class="w-50 mobile-w-full">
                                    <h5 class="d-flex gap-5 text-white border-bottom py-3 mb-3 align-items-center mb-3 align-items-center">
                                        <div class="w-35">
                                            <h5 class="mb-0 fs-22 lh-28">Date</h5>
                                        </div>
                                        <div class="w-65">
                                            <h5 class="mb-0 fs-22 lh-28">What’s Happening</h5>
                                        </div>
                                    </h5>
                                    <ul class="text-white p-0 m-0 px-1 pt-0 m-auto">
                                        <?php
                                        $ud_list = isset($urgent_deadlines) ? $urgent_deadlines : [];
                                        $ud_mid = (int) ceil(count($ud_list) / 2);
                                        $ud_col1 = array_slice($ud_list, 0, $ud_mid);
                                        $ud_col2 = array_slice($ud_list, $ud_mid);
                                        foreach ($ud_col1 as $i => $ud):
                                            $last = ($i === count($ud_col1) - 1);
                                        ?>
                                        <li class="d-flex gap-5 <?= $last ? 'py-3' : 'border-bottom py-3' ?> align-items-center">
                                            <div class="w-35"><h5 class="mb-0 fs-19 lh-20 mobile-fs-14 mobile-lh-16"><?= htmlspecialchars($ud->date_text) ?></h5></div>
                                            <div class="w-65"><h5 class="mb-0 fs-14 lh-20 fs-500"><?= nl2br(htmlspecialchars($ud->description)) ?></h5></div>
                                        </li>
                                        <?php endforeach; ?>
                                        <?php if (empty($ud_col1)): ?>
                                        <li class="d-flex gap-5 border-bottom py-3 align-items-center">
                                            <div class="w-35"><h5 class="mb-0 fs-19 lh-20">July 15–31, 2025</h5></div>
                                            <div class="w-65"><h5 class="mb-0 fs-14 lh-20 fs-500">Final mentor booking window for Fall 2025 intake</h5></div>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="w-50 mobile-w-full">
                                    <h5 class="d-flex gap-5 text-white border-bottom py-3 mb-3 align-items-center mb-3 align-items-center">
                                        <div class="w-35"><h5 class="mb-0 fs-22 lh-28">Date</h5></div>
                                        <div class="w-65"><h5 class="mb-0 fs-22 lh-28">What’s Happening</h5></div>
                                    </h5>
                                    <ul class="text-white p-0 m-0 px-1 pt-0 m-auto">
                                        <?php foreach ($ud_col2 as $i => $ud):
                                            $last = ($i === count($ud_col2) - 1);
                                        ?>
                                        <li class="d-flex gap-5 <?= $last ? 'align-items-center py-4' : 'border-bottom py-3 align-items-center' ?>">
                                            <div class="w-35"><h5 class="mb-0 fs-19 lh-20 mobile-fs-14 mobile-lh-16"><?= htmlspecialchars($ud->date_text) ?></h5></div>
                                            <div class="w-65"><h5 class="mb-0 fs-14 lh-20 fs-500"><?= nl2br(htmlspecialchars($ud->description)) ?></h5></div>
                                        </li>
                                        <?php endforeach; ?>
                                        <?php if (empty($ud_col2) && !empty($ud_col1)): ?>
                                        <li class="d-flex gap-5 align-items-center py-4">
                                            <div class="w-35"><h5 class="mb-0 fs-19 lh-20 mobile-fs-14 mobile-lh-16">December 1, 2025</h5></div>
                                            <div class="w-65"><h5 class="mb-0 fs-14 lh-20 fs-500">Lock-in date for Jan 2026 uni apps</h5></div>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
          <div class="wrapper-content">


        <section class="pt-3 pb-0">
            <style>
                /* Study abroad facts from DB: each <li> on its own line (override global inline/flex on lists) */
                .study-abroad-fact-content ul,
                .study-abroad-fact-content ol {
                    display: block;
                    list-style-position: outside;
                    padding-left: 1.35rem;
                    margin: 0 0 0.5rem 0;
                }
                .study-abroad-fact-content li {
                    display: list-item;
                    margin-bottom: 0.5rem;
                    line-height: 1.45;
                }
            </style>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="w-80">
                        <div class="swiper magic-cursor slider-review" data-slider-options='{
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "loop": true,
                                "navigation": { 
                                    "nextEl": ".slider-one-slide-next-3", 
                                    "prevEl": ".slider-one-slide-prev-3" 
                                },
                                "autoplay": { 
                                    "delay": 400000000000, 
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
                                <?php
                                $fact_slides = isset($study_abroad_facts_slides) ? $study_abroad_facts_slides : [];
                                if (!empty($fact_slides)):
                                    foreach ($fact_slides as $slide_i => $fact_html):
                                ?>
                                <div class="swiper-slide">
                                    <div class="yellow-box-style-3 mb-90">
                                        <div class="header-yellow-box-style-3 d-flex align-items-center mb-0"> <img
                                                src="<?= base_url('assets/img/bell.gif') ?>" width="" class="w-10 mobile-w-30" alt="" />
                                            <h2 class="fnt-family mb-0 fs-36 mobile-fs-24 mobile-lh-full mobile-font-normal mobile-w-50 <?= (int)$slide_i === 0 ? 'fs-36' : 'fs-30' ?>">Study Abroad Facts You Probably Didn’t Know</h2>
                                        </div>
                                        <div class="study-abroad-fact-content px-5 w-100 m-auto pt-0 w-100 fs-14 lh-20 fw-500"><?= $fact_html ?></div>
                                    </div>
                                </div>
                                <?php
                                    endforeach;
                                else:
                                ?>
                                <div class="swiper-slide">
                                    <div class="yellow-box-style-3 mb-90">
                                        <div class="header-yellow-box-style-3 d-flex align-items-center mb-0"> <img
                                                src="<?= base_url('assets/img/bell.gif') ?>" width="" class="w-10" alt="" />
                                            <h2 class="fnt-family mb-0 fs-36">Study Abroad Facts You Probably Didn’t Know</h2>
                                        </div>
                                        <p class="px-5 w-90 m-auto pt-2 text-muted fs-14 mb-0">No facts available.</p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div
                                class="upcoming-swiper bottom-scrolling-swiper-section d-flex justify-content-center justify-content-xl-start flex-column gap-3">
                                <!-- start slider navigation -->
                                <div class="slider-one-slide-prev-3 text-dark-gray swiper-button-prev slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                    tabindex="0" role="button" aria-label="Previous slide"><i
                                        class="fa-solid fa-arrow-left"></i></div>
                                <div class="slider-one-slide-next-3  text-dark-gray swiper-button-next slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                    tabindex="0" role="button" aria-label="Next slide"><i
                                        class="fa-solid fa-arrow-right"></i></div>
                                <!-- end slider navigation -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <section class="pt-3 mobile-event-program">
            <div class="container px-5">
                
                <div class="row mt-3 justify-content-start fix-box-design">
                    
                    <div class="col-lg-12">
                        <h5 class="mb-0 fs-36 text-black fnt-family mobile-fs-24 mobile-lh-full mobile-w-42 mobile-auto mobile-pb-4">#Purple Events & Other Programs</h5>
                    </div>
                    <?php
                    $upcoming_list = isset($upcoming_events) ? $upcoming_events : [];
                    foreach ($upcoming_list as $ev):
                        $ev_sd = format_event_date($ev->s_date ?? '');
                        $ev_ed = format_event_date($ev->e_date ?? '');
                        $ev_img = event_image_url($ev->image1 ?? null, base_url('assets/img/heroImage.png'), $ev->image2 ?? null);
                        $ev_tags = !empty($ev->tags) ? array_filter(array_map('trim', preg_split('/[\s,#]+/', $ev->tags))) : ['#TEAMPGS', '#UK'];
                    ?>
                    <div class="col-lg-4 col-sm-12 mt-1 col-md-4 position-relative mobile-w-50">
                        <div class="sop-card-unique left-13 border-none border-radius-20px">
                            <div class="sop-top-label h-30px">
                                <img src="<?= base_url('assets/img/red-hours.gif') ?>" alt="" />
                                Filling Fast
                            </div>
                            <div class="sop-start-free bg-purple-set fs-9">#inCampus</div>
                            <div class="sop-image-wrapper-1">
                                <img src="<?= htmlspecialchars($ev_img) ?>" alt="<?= htmlspecialchars($ev->product_name ?? '') ?>" class="big_img" onerror="this.src='<?= base_url('assets/img/heroImage.png') ?>'">
                                <div class="sop-heart-icon"><img src="<?= base_url('assets/img/share.png') ?>" width="20" alt=""></div>
                                <div class="event-author-info">
                                    <h5 class="fs-16 text-black mb-0"><?= htmlspecialchars($ev->author_name ?? 'Team PGS') ?></h5>
                                    <p class="fs-12 mb-0 lh-15">Upcoming session</p>
                                </div>
                            </div>
                            <div class="sop-content card-box-date">
                                <div class="date-box bg-transparent">
                                    <div>
                                        <div class="box-date-info bg-black">
                                            <span class="date text_purple"><?= htmlspecialchars($ev_sd['day'] ?? '') ?></span>
                                            <span class="month"><?= htmlspecialchars($ev_sd['month'] ?? '') ?></span>
                                        </div>
                                        <p class="fs-12 fw-600 mb-0 text-black text-center"><?= htmlspecialchars($ev_sd['time'] ?? '') ?></p>
                                    </div>
                                    <div>
                                        <div class="box-date-info bg-black">
                                            <span class="date text_purple"><?= htmlspecialchars($ev_ed['day'] ?? '') ?></span>
                                            <span class="month"><?= htmlspecialchars($ev_ed['month'] ?? '') ?></span>
                                        </div>
                                        <p class="fs-12 fw-600 mb-0 text-black text-center"><?= htmlspecialchars($ev_ed['time'] ?? '') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="content-wrap mt-4 p-3 pt-0">
                                <div class="">
                                    <h1 class="mb-0 border-black fnt-family px-2 py-2 text-black fs-40 border-radius-4px bg-white d-inline-block"><?= nl2br(htmlspecialchars($ev->product_name ?? 'Event')) ?></h1>
                                </div>
                                <div class="sop-tags px-2 py-2">
                                    <?php foreach (array_slice($ev_tags, 0, 5) as $tag): $t = (strpos($tag, '#') === 0) ? $tag : '#' . $tag; ?>
                                    <span class="sop-tag"><?= htmlspecialchars($t) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="content-p">
                                    <p class="fs-12 fw-400 mb-0 text-black text-start fs-12 lh-18"><?= nl2br(htmlspecialchars(mb_substr($ev->description ?? '', 0, 120))) ?><?= mb_strlen($ev->description ?? '') > 120 ? '…' : '' ?></p>
                                </div>
                                <div class="d-flex justify-content-space">
                                    <a href="<?= base_url('purpleevents/session/' . (int)$ev->id) ?>" class="sop-learn-btn bg-blue-500 mt-4 fs-12 text-decoration-none text-black d-inline-flex align-items-center justify-content-center">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if (empty($upcoming_list)): ?>
                    <div class="col-lg-12"><p class="text-black">No upcoming events at the moment. Check back soon!</p></div>
                    <?php endif; ?>

                </div>
            </div>
        </section>
        
        

        <section class="pt-3">
            <div class="container">
                <div class="row mt-3 justify-content-center">
                    <div class="col-lg-11">
                        <div class="bg-gray-100 border-radius-15px p-3 pt-5">
                            <div class="d-flex gap-2 align-items-start w-70 m-auto mobile-wrap mobile-w-full">
                                <img src="<?= base_url('assets/img/ball.png') ?>" width="84" height="84" alt="" />
                                <div class="text-black pt-1 w-100">
                                    <h1 class="mb-0 fnt-family fs-36">Never Miss an Important Deadline</h1>
                                    <h6 class="fs-16 lh-20 mb-0 mt-1 fw-500">Subscribe to our deadline alerts and event notifications.<br />Get personalized reminders delivered straight to your inbox.</h6>
                                    <div class="group-inpur-border mt-3" id="deadline-subscribe-form">
                                        <input type="email" name="email" id="deadline-email" class="ht-55px border-liner placeholder-text bg-transparent px-2 py-1 fs-30 text-black text-center" placeholder="Enter your email" required />
                                        <button type="button" id="deadline-subscribe-btn" class="btn border-liner bg-white w-100 px-2 py-2 fs-20 text-black text-captilize mt-3 ht-55px">Subscribe <img src="<?= base_url('assets/img/right-arrow-button.png') ?>" style="width: 35px;" alt="" /></button>
                                        <p id="deadline-subscribe-msg" class="fnt-family-1 mb-0 text-center mt-4 fs-12 lh-20"></p>
                                        <p class="fnt-family-1 mb-0 text-center mt-2 fs-12 lh-20">Your info stays private. We only use it to reach out, never share it.</p>
                                    </div>
                                    <script>
                                    (function(){ var btn=document.getElementById('deadline-subscribe-btn'); var email=document.getElementById('deadline-email'); var msg=document.getElementById('deadline-subscribe-msg');
                                    if(btn&&email){ btn.addEventListener('click',function(){ var val=(email.value||'').trim(); if(!val){ msg.textContent='Please enter your email.'; msg.style.color='#c00'; return; } btn.disabled=true;
                                    var xhr=new XMLHttpRequest(); xhr.open('POST','<?= base_url('Studentresources/subscribe') ?>'); xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
                                    xhr.onload=function(){ btn.disabled=false; try{ var r=JSON.parse(xhr.responseText); msg.textContent=r.message||(r.success?'Thank you!':'Error.'); msg.style.color=r.success?'#0a0':'#c00'; }catch(e){ msg.textContent='Thank you for subscribing!'; msg.style.color='#0a0'; } };
                                    xhr.onerror=function(){ btn.disabled=false; msg.textContent='Network error. Try again.'; msg.style.color='#c00'; }; xhr.send('email='+encodeURIComponent(val)); }); } })();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5 position-relative">
            <div class="container overlap-gap-section p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card-box-img position-relative p-0 border-radius-10px bg-transparent">
                            <?php $video_url = isset($purplepremium_video_url) ? trim($purplepremium_video_url) : '';
                            if (!empty($video_url) && preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m)): $embed = 'https://www.youtube.com/embed/'.$m[1]; ?>
                            <iframe width="100%" height="500" src="<?= htmlspecialchars($embed) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="border-radius-10px"></iframe>
                            <?php elseif (!empty($video_url)): ?>
                            <a href="<?= htmlspecialchars($video_url) ?>" target="_blank" rel="noopener" class="d-block position-relative">
                                <img src="<?= base_url('assets/img/premium-3.png') ?>" class="border-radius-10px aspact-rastion-2" alt="Step into purplepremium" />
                                <div class="position-static-img d-flex"><div class="play-circular-button"><i class="bi bi-play-circle fs-75 text-white"></i></div><h4 class="fnt-family fs-75 text-white pb-1 mobile-flot-heading lh-65" style="line-height:66px;">Step into <br /> #purplepremium</h4></div>
                            </a>
                            <?php else: ?>
                            <img src="<?= base_url('assets/img/premium-3.png') ?>" class="border-radius-10px aspact-rastion-2" alt="Step into purplepremium" />
                            <div class="position-static-img d-flex"><div class="play-circular-button"><i class="bi bi-play-circle fs-75 text-white"></i></div><h4 class="fnt-family fs-75 text-white pb-1 mobile-flot-heading lh-65" style="line-height:66px;">Step into <br /> #purplepremium</h4></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h1 class="text-black fnt-family fs-75"><span class="bg-light-green-200 d-block px-2 pt-1 mobile-fs-24 mobile-lh-full mobile-p-2">PGS data and stats</span></h1>
                        <div class="flex-wrap d-flex gap-4 justify-content-space mobile-wrap">
                        <?php $stats_list = isset($pgs_stats) ? $pgs_stats : []; $stats_by_cat = [];
                        foreach ($stats_list as $s) { $c = $s->category ?: 'general'; if (!isset($stats_by_cat[$c])) $stats_by_cat[$c] = []; $stats_by_cat[$c][] = $s; }
                        if (empty($stats_by_cat)) { $stats_by_cat['#stem'] = [(object)['stat_text' => '74 students just finished their SOP drafts this week']]; }
                        foreach ($stats_by_cat as $cat => $items): ?>
                        <div class="mb-1 w-45 mobile-w-90 mobile-auto mobile-pb-10">
                            <h6 class="text-black fnt-family mb-1 fs-38 mobile-fs-20 mobile-lh-full mobile-pb-2"><?= htmlspecialchars($cat) ?></h6>
                            <table class="table-custom-border">
                                <?php foreach ($items as $s): ?>
                                <tr><td><span class="icon-box"><img src="<?= base_url('assets/img/icon-traingal.png') ?>" data-no-retina="" alt=""></span></td><td><?= htmlspecialchars($s->stat_text) ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <?php endforeach; ?>
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

        <!--<section>-->
        <!--    <div class="container">-->
        <!--        <div class="row justify-content-center">-->
        <!--            <div class="col-lg-11">-->
        <!--                <h5 class="text-black fs-25 mb-4">Frequently Asked Questions</h5>-->
        <!--                <p class="text-black">Programme details, learning experience, and refund policy — reach out to our team for any questions.</p>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
       
        <!-- end wrapper-content so footer can be full width -->
 
    
    <!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
</div>

       
  <?php $this->load->view('footer'); ?>
  
      
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
