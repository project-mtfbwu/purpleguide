<?php
$event = isset($event) ? $event : null;
if (!$event) return;
$img_src = event_image_url($event->image1 ?? null, base_url('assets/img/saved_4.jpg'), $event->image2 ?? null);
$host = !empty($event->host) ? $event->host : (!empty($event->category_name) ? '#' . $event->category_name : '');
$sd = Purpleevents::format_event_date($event->s_date);
$ed = Purpleevents::format_event_date($event->e_date);
$tags_arr = !empty($event->tags) ? preg_split('/[\s,#]+/', trim($event->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
if (!empty($event->category_name) && empty($tags_arr)) $tags_arr = [trim($event->category_name)];
$event_topics = !empty($event->session_topics) ? array_values(array_filter(array_map('trim', explode("\n", $event->session_topics)))) : ['Masters in USA', 'UK for graduates', 'How to prepare your finances'];
$event_cover = !empty($event->what_we_cover) ? array_values(array_filter(array_map('trim', explode("\n", $event->what_we_cover)))) : $event_topics;
if (empty($event_cover)) $event_cover = ['How to shortlist unis that actually match your profile', 'Avoid common SOP/LOR mistakes that cost students', 'How Research Matters in your application', 'If you have gap in your profile or low CGPA how to proceed', 'What scholarships you be getting & what you need to do.'];
$event_who = isset($event->who_is_it_for) ? trim($event->who_is_it_for) : '';
if ($event_who === '') $event_who = "Final-year student?\nRecent grad? Researching for masters?\nThis session's made for you.";
$facilitators_list = isset($facilitators) ? $facilitators : [];
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <title><?= htmlspecialchars($event->product_name) ?> – PGS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= base_url('assets/css/vendors.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/icon.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/demos/marketing/marketing.css')?>" />
    <style>
        @media (max-width: 767px) {
    .sop-learn-btn {
        font-size: 12px !important;
        line-height: 22px !important;
        line-height: 7px !important;
    }
    .purple-event-hero .sop-learn-btn {
        height: 41px !important;
        background: rgba(0, 156, 112, 1) !important;
        margin-top: 4% !important;
        line-height: 25px !important;
    }
}
    </style>
</head>
<body data-mobile-nav-style="classic" class="custom-cursor">
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <?php if (!empty($is_preview)): ?>
        <div style="position:sticky;top:0;z-index:99999;background:#fff3cd;border-bottom:1px solid #ffeeba;padding:10px 12px;font-size:14px;color:#856404;">
            <b>Preview mode:</b> this does not save the event. Close this tab to continue editing.
        </div>
    <?php endif; ?>
    <?php $this->load->view('header'); ?>

    <?php $this->load->view('sidebar'); ?>

    <div class="wrapper-content">

        <section class="position-relative pt-4 purple-event-hero">
            <div class="container p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-sm-12 mt-1 col-md-5 position-relative">
                        <div class="sop-card-unique left-13 full-box-content full-box-content-height border-none d-flex align-items-start justify-content-end gap-3 mobile-wrap">
                            <div class="w-30 mobile-w-full">
                                <?php if (!empty($event->top_label)): ?>
                                <div class="sop-top-label h-30px w-130px fs-14 label-flot-update">
                                    <img src="<?= base_url('assets/img/red-hours.gif') ?>" class="w-15 ml-2" alt="" />
                                    &nbsp;<?= htmlspecialchars($event->top_label) ?>
                                </div>
                                <?php endif; ?>
                                <div class="sop-image-wrapper-1 w-100">
                                    <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($event->product_name) ?>" class="big_img" onerror="this.src='<?= base_url('assets/img/saved_4.jpg') ?>'">
                                    <div class="sop-heart-icon"><img src="<?= base_url('assets/img/share.png') ?>" alt="Share"></div>
                                    <?php if (!empty($event->badge)): ?>
                                    <div class="sop-heart-icon bg-purple text-white px-1 fs-22 border-radius-6px"><?= htmlspecialchars($event->badge) ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($event->author_name) || !empty($event->author_bio)): ?>
                                    <div class="event-author-info">
                                        <?php if (!empty($event->author_name)): ?><h5 class="fs-12 text-black mb-0 lh-20"><?= htmlspecialchars($event->author_name) ?></h5><?php endif; ?>
                                        <?php if (!empty($event->author_bio)): ?><p class="fs-12 mb-0 lh-full"><?= nl2br(htmlspecialchars($event->author_bio)) ?></p><?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="content-wrap w-50 p-1 pt-0 mobile-w-full">
                                <div class="w-70">
                                    <h1 class="mb-0 border-black fnt-family px-2 py-2 text-black fs-50 border-radius-4px bg-white"><?= htmlspecialchars($event->product_name) ?></h1>
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
                                        <?php if (!empty($event->prod_sub_name)): ?>
                                        <h5 class="mb-2 text-black fs-25 fw-500 w-300px lh-30 mobile-w-full"><?= htmlspecialchars($event->prod_sub_name) ?></h5>
                                        <?php endif; ?>
                                        <?php if (!empty($event->description)): ?>
                                        <p class="mb-0 text-black fs-12 lh-12"><?= nl2br(htmlspecialchars(strip_tags($event->description))) ?></p>
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
                                <div class="d-flex justify-content-space mt-0 flex-wrap gap-2">
                                    <a href="<?= base_url('purpleevents') ?>" class="sop-learn-btn bg-blue-500 mt-2 fs-17 fw-600 text-black border-radius-4px py-2 ht-48 px-4 text-center text-decoration-none" style="line-height : normal">← Back to Events</a>
                                    <?php if (!empty($event->book_url)): ?>
                                    <a href="<?= htmlspecialchars($event->book_url) ?>" target="_blank" rel="noopener" class="sop-learn-btn bg-blue-500 mt-2 fs-17 fw-600 text-black border-radius-4px py-2 ht-48 px-4 text-center text-decoration-none" style="line-height : normal">Book Your Seat</a>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($event->location_note)): ?>
                                <p class="mb-0 text-black text-center mt-2 pb-0 fs-16">📍 <?= htmlspecialchars($event->location_note) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12"></div>
                    <?php /* Who's It For + Session Topics always shown (use $event_who / $event_topics with defaults) */ ?>
                    <div class="d-flex gap-5 w-60 align-items-start mt-8 mobile-wrap">
                        <div class="mobile-w-full">
                            <h3 class="fs-28 text-black text-uppercase fw-900 overflow-hidden text-blue mb-4 gr-mobile-1">
                                <span class="bg-light-green-200 p-1">Who’s It For?</span>
                            </h3>
                            <div class="bg-light-green-200 p-1">
                                <p class="mb-0 fs-24 lh-full text-black w-344px fw-500 mobile-fs-14"><?= nl2br(htmlspecialchars($event_who)) ?></p>
                            </div>
                        </div>
                        <div class="mobile-w-full">
                            <h3 class="fs-28 text-black text-uppercase fw-900 overflow-hidden text-blue mb-4 gr-mobile-1">
                                <span class="bg-light-green-200 p-1">Session Topics</span>
                            </h3>
                            <div class="mb-3">
                                <?php foreach ($event_topics as $tp): ?>
                                <h4 class="bg-light-green-200 mb-2 fs-24 lh-full p-1 text-black w-344px fw-500 overflow-hidden text-blue mobile-fs-14"><?= htmlspecialchars($tp) ?></h4>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5">
            <div class="">
                <div class="d-flex justify-content-center align-items-center gap-5 mobile-wrap">
                    <div class="d-flex align-items-start gap-1 mb-3 w-344px mobile-w-70 mobile-auto mobile-pb-4">
                        <h4 class="bg-light-green-200 mb-0 fs-24 mobile-fs-22 lh-28 w-344px p-1 text-black fw-500 overflow-hidden text-blue m-border-1"><?= nl2br(htmlspecialchars($event_who)) ?></h4>
                    </div>
                    <div class="w-25 mobile-w-50">
                        <ul class="todo-update-list p-0">
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4"><img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>" alt="" /> Welcome Kit</li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4"><img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>" alt="" /> Live Q&A with Expert Counsellors</li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4"><img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>" alt="" /> Tips that you should know</li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4"><img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>" alt="" /> Goal-tracking and reflection chart</li>
                            <li class="fs-16 text-black mb-2 fw-600 d-flex gap-2 align-items-start mobile-lh-full mobile-fs-15 mobile-pb-4"><img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>" alt="" /> Prep templates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mobile-box-4 mobile-box-style-2">
                        <h1 class="text-black fnt-family fw-500 fs-40 pt-0 text-center mobile-fs-24">What We’ll Cover in This Session</h1>
                        <div class="group-flex-items mt-5 d-flex wrap justify-content-center">
                            <?php foreach ($event_cover as $i => $tp): ?>
                            <div class="w-211px column-flex">
                                <div class="d-flex align-items-start gap-3 mb-5">
                                    <span class="icon-box"><img src="<?= base_url('assets/img/icon-traingal.png') ?>" alt=""></span>
                                    <h4 class="text-black mb-0 fs-50 lh-50 fw-500"><?= sprintf('%02d', $i + 1) ?></h4>
                                </div>
                                <h6 class="mb-0 fs-14 text-center lh-20 text-black"><?= htmlspecialchars($tp) ?></h6>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5">
            <div class="container">
                <div class="row justify-content-center align-items-center gap-5">
                    <div class="w-650px p-0 mobile-w-full">
                        <h4 class="text-black fs-40 text-center lh-50 mobile-fs-22 mobile-br-none mobile-lg-full mobile-mb-0">
                            <span class="fs-32">Meet Your</span> <br> <span class="italic-texts fw-800">Facilitators</span>
                        </h4>
                        <div class="d-flex gap-3 justify-content-center flex-nowrap" style="flex-wrap: nowrap;">
                            <?php if (!empty($facilitators_list)): foreach ($facilitators_list as $fac): ?>
                            <div class="w-50 mobile-w-50 mobile-mt-0 mobile-pt-0">
                                <div class="founder-img-box border-radius-4px mb-2 w-full border-radius-20px">
                                    <img src="<?= htmlspecialchars(facilitator_image_url($fac->image ?? null, base_url('assets/img/founder.png'))) ?>" alt="<?= htmlspecialchars($fac->name ?? '') ?>" data-no-retina="" onerror="this.src='<?= base_url('assets/img/founder.png') ?>'">
                                </div>
                                <h4 class="mb-0 text-black fs-40 mobile-fs-25"><?= htmlspecialchars($fac->name ?? '') ?></h4>
                                <?php if (!empty($fac->position)): ?>
                                <h6 class="text-uppercase fs-16 text-black mb-2 mt-2"><?= htmlspecialchars($fac->position) ?></h6>
                                <?php endif; ?>
                                <?php if (!empty($fac->details)): ?>
                                <div class="founder-info"><p><?= nl2br(htmlspecialchars($fac->details)) ?></p></div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; else: ?>
                            <p class="text-black fs-16 text-center w-100 py-4">Facilitators for this session will be announced soon.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="position-relative pt-8">
            <div class="container overlap-gap-section p-0 position-relative">
                <div class="row align-items-center justify-content-center justify-content-md-center">
                    <div class="col-lg-10 m-auto mobile-w-90">
                        <div class="d-flex gap-5 align-items-center justify-content-center mobile-wrap">
                            <div class="w-40">
                                <div class="bg-black p-05 black-shadow mb-5">
                                    <div class="header-bg-black d-flex text-white justify-content-space pb-1 px-3">
                                        <span class="fs-13 mobile-fs-10"><i class="bi bi-circle"></i><i class="bi bi-circle"></i><i class="bi bi-circle"></i></span>
                                        <h5 class="mb-0 text-uppercase fs-20 mobile-fs-12">note</h5>
                                        <span><i class="bi bi-file-earmark-pdf"></i></span>
                                    </div>
                                    <div class="bg-purple-100 d-flex justify-content-center align-items-center h-180px">
                                        <h5 class="mb-0 fs-25 text-black text-center w-328px mobile-fs-16 mobile-lh-full"><?= !empty($event->description) ? htmlspecialchars(strip_tags(substr($event->description, 0, 200))) . (strlen(strip_tags($event->description)) > 200 ? '…' : '') : 'This is a tailor made event for Masters, engineering &amp; MBA Aspirants' ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="w-40 px-4 mb-4 mobile-d-flex mobile-gap-2">
                                <h5 class="mb-2 fs-22 fw-700 lh-30 text-black mobile-font-400 mobile-w-50 mobile-lh-16">Walk away with a clear roadmap for your study abroad journey.</h5>
                                <p class="mb-0 fs-22 fw-400 lh-30 text-black mobile-w-50 mobile-lh-16">Get tips, avoid common mistakes, and boost your admit chances to top UK universities—plus crack scholarships, SOPs, and ROI planning like a pro.</p>
                            </div>
                        </div>
                        <div class="w-60 m-auto mt-4 mobile-last-auto mobile-w-48 mobile-auto-last">
                            <p class="mb-0 text-black fs-20 lh-full w-80 m-auto mt-3 lt-0.2 mobile-p-0 mobile-w-full mobile-fs-14 mobile-lh-16">More sessions coming up for Medical aspirants &amp; for STEAM streams connect with our counselors to <br> <b>get started. Get your seat locked.</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5">
        <section class="pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h3 class="text-black fs-28 fw-700 mb-3">About This Session</h3>
                        <div class="text-black fs-16 lh-24" style="white-space: pre-wrap;"><?= nl2br(htmlspecialchars(strip_tags(!empty($event->description) ? $event->description : 'Join us for this session to get practical guidance and connect with experts. Book your seat to secure a spot.'))) ?></div>
                        <?php if (!empty($event->location_note)): ?>
                        <p class="mt-3 mb-0 text-black fs-16">📍 <?= htmlspecialchars($event->location_note) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($event->book_url)): ?>
                        <a href="<?= htmlspecialchars($event->book_url) ?>" target="_blank" rel="noopener" class="sop-learn-btn bg-blue-500 mt-4 fs-17 fw-600 text-black border-radius-4px py-2 ht-48 px-4 text-center text-decoration-none d-inline-block">Book Your Seat</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('purpleevents_upcoming_to_faq', ['events' => isset($events) ? $events : [], 'testimonials' => isset($testimonials) ? $testimonials : []]); ?>

    </div>


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
</body>

</html>
