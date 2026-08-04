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

    <!-- AboutUs -->
    <section class="pt-6 about-section half-section overlap-height position-relative overflow-hidden minus-5 mobile-doc-section">
        <div class="container overlap-gap-section p-0">
            <div class="row justify-content-md-center align-items-center ">
                <div class="col-lg-7 d-flex gap-10 align-items-center">
                    
                    <div class="w-300px d-flex align-items-center justify-content-end">
                        <h1 class="text-start text-black fnt-family fw-400 fs-50 lh-full pt-0 mb-0">
                            your <br/> custom <br/>progress<br/> board
                        </h1>
                    </div>
                       <div class="yellow-box-style-3  w-300px position-relative">
                  <div class="lock-box-feed">
                      <img src="<?= base_url('assets/img/lock.png') ?>" data-no-retina="">
                    </div>
                        <div class="header-yellow-box-style-3"> <img src="./assets/img/bell.gif" width="" class="w-10" />
                            Important Alerts</div>
                        <ol>
                            <li>LOR is pending</li>
                            <li>Two UNIs have proved CAS!</li>
                            <li>Have to submit application by 28th June, 2025</li>
                        </ol>
                    </div>

                </div>
               
                </div>
                <div class="row justify-content-md-center mt-3">
                <div class="col-lg-6">
                   
                    <p class="mb-0 text-black m-auto fs-16 lh-19">
                        This section is built to guide you from Day 1 to your final university admit. It shows every step of your study journey in one clear view. Your mentor will create
                        a personalized map based on your profile. Think of it like your own Kanban board—split into draft, in 
                        progress, and completed stages. You’ll always know what’s done, what’s next, and what needs work. No guesswork, no confusion—just your path, laid out clearly.
                    </p>
                </div>
            </div>
                </div>
    </section>

    <section class="group-chart-section pt-0 mobile-doc-section ">
        <div class="w-780px m-auto">
           
            <div class="row justify-content-center position-relative border-radius-10">
                 <div class="lock-box-feed" style="border-radius : 10px">
                      <img src="<?= base_url('assets/img/lock.png') ?>" data-no-retina="">
            </div>
                <div class="m-auto p-0">

                    <div class="card-box">
                        <div class="list-of-graphs">
                            <div class="d-flex-group">
                                <p class="mb-0 text-black">#draftMeter</p>
                            </div>
                            <div class="d-flex-group">
                                <div class="graph-box">
                                    <img src="./assets/img/meeter.png" />
                                </div>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    SOP drafts
                                </div>
                            </div>
                            <div class="d-flex-group">
                                <div class="graph-box">
                                    <img src="./assets/img/meeter.png" />
                                </div>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    Mentor checking Visa Checklist for You
                                </div>
                            </div>
                            <div class="d-flex-group">
                                <div class="graph-box">
                                    <img src="./assets/img/meeter.png" />
                                </div>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    On Final Draft of your cover letter
                                </div>
                            </div>
                        </div>
                        <div class="count-of-grpah">
                            <span>+</span>
                            <p class="mb-0 fnt-family fs-100 lh-full">3</p><span>completed</span>
                        </div>
                    </div>

                    <div class="card-box">
                        <div class="list-of-graphs">
                            <div class="d-flex-group">
                                <p class="mb-0 text-black" id="review-notes">#reviewQueue</p>
                            </div>
                            <div class="d-flex-group">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    Scholarship Essay Reviewed
                                </div>
                            </div>
                            <div class="d-flex-group">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    Internship Application - King’s College London
                                </div>
                            </div>
                            <div class="d-flex-group">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    Waiting on LOR Feedback
                                </div>
                            </div>
                            <div class="d-flex-group">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                                <span class="mobile-roted">|</span>
                                <div class="graph-box-content">
                                    Waiting on LOR Feedback
                                </div>
                            </div>
                        </div>
                        <div class="count-of-grpah">
                            <span>+</span>
                            <p class="mb-0 fnt-family fs-100 lh-full">2</p><span>completed</span>
                        </div>
                    </div>

                    <div class="card-box list-of-notes">
                        <div class="list-of-graphs">
                            <div class="d-flex-group">
                                <p class="mb-0 text-black">#counselorNotes</p>
                            </div>
                            <div class="d-flex-group gap-3">
                                <div class="graph-box">
                                    <img src="./assets/img/avatar-icon.png" />
                                </div>
                                <div class="card-border-1">
                                    <span class="count-of">1</span>
                                    <h5>Passport needs clearer scan – reupload</h5>
                                </div>
                            </div>
                            <div class="d-flex-group gap-3">
                                <div class="graph-box">
                                    <img src="./assets/img/avatar-icon.png" />
                                </div>
                                <div class="card-border-1">
                                    <span class="count-of">2</span>
                                    <h5>LOR missing signature – resend</h5>
                                </div>
                            </div>
                            <div class="d-flex-group gap-3">
                                <div class="graph-box">
                                    <img src="./assets/img/avatar-icon.png" />
                                </div>
                                <div class="card-border-1">
                                    <span class="count-of">3</span>
                                    <h5>Degree PDF is password protected – please unlock</h5>
                                </div>
                            </div>
                            <div class="d-flex-group gap-3">
                                <div class="graph-box">
                                    <img src="./assets/img/avatar-icon.png" />
                                </div>
                                <div class="card-border-1">
                                    <span class="count-of">4</span>
                                    <h5>Degree PDF is password protected – please unlock</h5>
                                </div>
                            </div>

                        </div>
                        <div class="count-of-grpah">
                            <span>+</span>
                            <p class="mb-0 fnt-family fs-100 lh-full">4</p><span>pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-4 pb-0 mobile-doc-section margin-mobile-row">
        <div class="w-586px m-auto">
            <div class="text-center">
                <h2 class="mb-2 fnt-family text-black fs-38 lh-full fw-400">#PGS Loopboard</h2>
            </div>
            <div class="row justify-content-center">
                <div class="p-0"
                    >
                    <p class="mb-2 fw-400 text-black fs-16 lh-19">
                        At PurpleGuide.study, we believe targeted success starts with a clear, well-thought-out study
                        path. Most students waste time going in circles—trying things, pausing, rethinking, and starting
                        over. We’ve seen it happen way too often. But the ones who truly succeed? They know exactly what
                        they’re doing at every step.
                    </p>
                    <p class="mb-2 fw-400 text-black fs-16 lh-19">
                        That’s where we come in.
                    </p>
                    <p class="mb-2 fw-400 text-black fs-16 lh-19">
                        At #PGS, we help you build that clarity from day one. After a detailed chat with your counselor
                        and mentor, we reverse-engineer your journey—starting from your goal and working backward to
                        build the right steps for you.
                    </p>
                    <p class="mb-2 fw-400 text-black fs-16 lh-19">
                        Below, you’ll find your custom roadmap, broken into four key sections. This isn’t some generic
                        plan—it’s built just for you. Our goal? Every PurpleGuide student should know their path from
                        the very beginning.
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section class="pt-4 pb-0 col-lg-11 m-auto mobile-doc-section">
        <div class="container-fluid bg-black border-radius-6px p-2 mobile-custom-pd-20 position-relative">
            <div class="lock-box-feed" style="border-radius : 10px; top : 0;left:0;     z-index: 1000;">
                      <img src="<?= base_url('assets/img/lock.png') ?>" data-no-retina="">
            </div>
            <div class="row mobile-row-scrolling">
                <div class="col-lg-3">
                    <div class="card-white-box"
                        >
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">JOURNEY MAP</h5>
                        <div class="pink-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                                <span class="highlight-tag">Important</span>
                            </div>
                            <ul>
                                <li>Deck theme as per brand guidelines.</li>
                                <li>Limit to 12 slides.</li>
                                <li>Use images from image bank only.</li>
                                <li>Divide amongst presenters. (Not more than two.)</li>
                            </ul>
                        </div>
                        <div class="pink-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14">Twilio integration</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="pink-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="pink-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="card-sm mb-1 text-black">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Delegate tasks for next week.</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"
                    >
                    <div class="card-white-box">
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">IN PROGRESS</h5>
                        <div class="green-box-card card-sm mb-3">

                            <p class="text-black mb-0 fs-12 lh-full">Log-in extra hours on company portal.
                                Refer your personal Notion database for hours worked.</p>
                        </div>
                        <div class="purple-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <ul>
                                <li>Deck theme as per brand guidelines.</li>
                                <li>Limit to 12 slides.</li>
                                <li>Use images from image bank only.</li>
                                <li>Divide amongst presenters. (Not more than two.)</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3"
                    >
                    <div class="card-white-box"
                        >
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">draft phase</h5>

                        <div class="purple-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <ul>
                                <li>Deck theme as per brand guidelines.</li>
                                <li>Limit to 12 slides.</li>
                                <li>Use images from image bank only.</li>
                                <li>Divide amongst presenters. (Not more than two.)</li>
                            </ul>
                        </div>
                        <div class="pink-box-card card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Log-in extra hours on company portal.
                                Refer your personal Notion database for hours worked.</p>
                        </div>
                        <div class="card-sm mb-1 text-black">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Delegate tasks for next week.</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="card-sm mb-1 text-black">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Delegate tasks for next week.</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="card-sm mb-1 text-black">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Delegate tasks for next week.</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="card-sm mb-1 text-black">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Delegate tasks for next week.</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card-white-box">
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">completed</h5>

                        <div class="card-sm mb-3 card-sm-img text-black p-2">
                            <div class="wrap-img">
                                <img src="./assets/img/complete-notes.png" class="border-radius-10px" />
                            </div>
                            <div class="d-flex align-items-center justify-content-space mt-3">
                                <h5 class="mb-0 fs-14 fw-700">Gear up for Mt. Fuji!</h5>
                                <img src="./assets/img/smile.png" class="w-10" />
                            </div>
                        </div>

                        <div class="bg-black card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">IELTS exam</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>

                        <div class="green-bg card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                        <div class="green-bg card-sm mb-3">
                            <div class="d-flex justify-content-space mb-2">
                                <h6 class="mb-0 fs-14 fw-700">Twilio integration</h6>
                            </div>
                            <p class="mb-0 fs-12 lh-12 fw-400">Create new note via SMS. Support text, audio, links, and media.</p>
                        </div>
                      </div>


                    </div>
                </div>
            </div>
    </section>

    <!-- start section -->
    <section class="overflow-hidden  mb-5 mobile-doc-section">
        <div class="w-1000px m-auto">
            <div class="row align-items-center justify-content-cente position-relative">
                <div class="text-center">
                    <h3 class="alt-font fw-400 fs-38 ls-minus-1px text-dark-bab mb-3 mx-auto mobile-fs-24 mobile-pb-2">Useful Tips for Your Journey
                    </h3>
                    <div class="d-flex justify-content-center justify-content-xl-start align-cursor-center gap-3">
                        <div class="slider-one-slide-prev-1 text-dark-gray swiper-button-prev slider-navigation-style-04"
                            tabindex="0" role="button" aria-label="Previous slide"><i
                                class="fa-solid fa-arrow-left"></i></div>
                        <div class="slider-one-slide-next-1 text-dark-gray swiper-button-next slider-navigation-style-04"
                            tabindex="0" role="button" aria-label="Next slide"><i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden m-auto"
                    >
                    <div class="outside-box-right-15 xl-outside-box-right-20 sm-outside-box-right-0">
                        <div class="swiper slider-one-slide  sm-slider-shadow-none magic-cursor overflow-visible  sm-p-0"
                            data-slider-options='{ "slidesPerView": 1, "spaceBetween": 40, "loop": true, "pagination": { "el": ".slider-one-slide-pagination", "clickable": true, "dynamicBullets": false }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 3000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 1 }, "768": { "slidesPerView": 1 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                            <div class="swiper-wrapper">
                                <!-- start review item -->
                                <div class="swiper-slide">
                                    <div class="card-gray-1 text-center w-700px m-left-170px">
                                        <h5
                                            class="fw-500 bg-black text-black d-inline-block text-white fs-20 px-2 border-radius-6px mb-2 mobile-fs-14">
                                            SOP Flow
                                        </h5>
                                        <h3 class="mb-0 fs-19 lh-full w-80 m-auto text-black text-uppercase mobile-fs-14 mobile-lh-full">Don’t start
                                            your SOP with your academic history — start with why this dream matters to
                                            you. Story > Stats.</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card-gray-1 text-center w-700px m-left-170px">
                                        <h5
                                            class="fw-500 bg-black text-black d-inline-block text-white fs-20 px-2 border-radius-6px mb-2 mobile-fs-14">
                                            SOP Flow
                                        </h5>
                                        <h3 class="mb-0 fs-19 lh-full w-80 m-auto text-black text-uppercase mobile-fs-14 mobile-lh-full">Don’t start
                                            your SOP with your academic history — start with why this dream matters to
                                            you. Story > Stats.</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card-gray-1 text-center w-700px m-left-170px">
                                        <h5
                                            class="fw-500 bg-black text-black d-inline-block text-white fs-20 px-2 border-radius-6px mb-2 mobile-fs-14">
                                            SOP Flow
                                        </h5>
                                        <h3 class="mb-0 fs-19 lh-full w-80 m-auto text-black text-uppercase mobile-fs-14 mobile-lh-full">Don’t start
                                            your SOP with your academic history — start with why this dream matters to
                                            you. Story > Stats.</h3>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start mt-15">
                <div class="col-lg-4 offset-1">
                    <h3 class="alt-font fw-700 ls-minus-1px fs-51 text-dark-bab mb-0 mx-auto mobile-fs-24 mobile-pb-2 mobile-text-center">Resource Drop
                    </h3>
                    <ul class="m-0 p-0 list-arrow mobile-w-60 mobile-m-auto">
                        <li class="border-top border-color-black">Visa Docs Checklist <sapn class="down-arrow"><i
                                    class="bi bi-arrow-down-right"></i></sapn>
                        </li>
                        <li>Sample SOP for STEM <sapn class="down-arrow"><i class="bi bi-arrow-down-right"></i></sapn>
                        </li>
                        <li>pre-journey checklist <sapn class="down-arrow"><i class="bi bi-arrow-down-right"></i></sapn>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </section>


</div>

  <?php $this->load->view('footer'); ?>
</body>

</html>