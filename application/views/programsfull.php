<?php
$program = isset($program) ? $program : null;
if (!$program) { echo '<p>Program not found. <a href="' . base_url('cvreadyprogram') . '">Discover our programs</a>.</p>'; return; }
$base_url_no_slash = rtrim(base_url(), '/');
// Optional config from website (same resolution as events_helper); falls back to legacy path logic below.
$ci = function_exists('get_instance') ? get_instance() : null;
$config_admin_assets = $ci ? trim((string) ($ci->config->item('admin_assets_images_base_url') ?? '')) : '';
if ($config_admin_assets !== '') {
    $admin_assets_images_base = rtrim($config_admin_assets, '/') . '/';
} elseif (preg_match('#/pgs/?$#', $base_url_no_slash)) {
    $admin_assets_images_base = preg_replace('#/pgs/?$#', '/pgs_admin', $base_url_no_slash) . '/assets/images/';
} else {
    $admin_base = rtrim((string) ($ci ? $ci->config->item('admin_base_url') : ''), '/');
    $admin_assets_images_base = ($admin_base !== '')
        ? ($admin_base . '/assets/images/')
        : ($base_url_no_slash . '/admin/assets/images/');
}

$raw_img = trim((string) ($program->image ?? ''));
$norm_img = ltrim($raw_img, '/');
if ($norm_img !== '' && strpos($norm_img, 'assets/tmp/') === 0) {
    $img_src = $base_url_no_slash . '/' . $norm_img;
} elseif (!empty($program->image)) {
    $img_src = $admin_assets_images_base . basename(preg_replace('#^(assets/images/|images/)#', '', $program->image));
} else {
    $img_src = base_url('assets/img/saved_2.jpg');
}

$raw_b = trim((string) ($program->brochure ?? ''));
$norm_b = ltrim($raw_b, '/');
if ($norm_b !== '' && strpos($norm_b, 'assets/tmp/') === 0) {
    $brochure_url = $base_url_no_slash . '/' . $norm_b;
} elseif (!empty($program->brochure)) {
    $brochure_url = $admin_assets_images_base . basename(preg_replace('#^(assets/images/|images/)#', '', $program->brochure));
} else {
    $brochure_url = '';
}

$raw_q = trim((string) ($program->qr_code ?? ''));
$norm_q = ltrim($raw_q, '/');
if ($norm_q !== '' && strpos($norm_q, 'assets/tmp/') === 0) {
    $qr_src = $base_url_no_slash . '/' . $norm_q;
} elseif (!empty($program->qr_code)) {
    $qr_src = $admin_assets_images_base . basename(preg_replace('#^(assets/images/|images/)#', '', $program->qr_code));
} else {
    $qr_src = '';
}
$tags_arr = !empty($program->tags) ? preg_split('/[\s,#]+/', trim($program->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
$who_text = !empty($program->who_is_it_for) ? $program->who_is_it_for : "This program is for you.";
$topics_arr = !empty($program->session_topics) ? array_values(array_filter(array_map('trim', preg_split('/[\r\n,]+/', $program->session_topics)))) : [];
$highlights = array_values(array_filter([$program->highlight_1 ?? '', $program->highlight_2 ?? '', $program->highlight_3 ?? '', $program->highlight_4 ?? '']));
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <title><?= htmlspecialchars($program->title) ?> – PGS</title>
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
            .avatar-box {
               display : none;
            }
            .program-full-hero.purple-event-hero .full-box-content-height .sop-heart-icon.bg-purple
            {
             margin-right: 30px;
             margin-top: -20px;
            }
        }
    </style>
</head>


<body data-mobile-nav-style="classic" class="custom-cursor">
    <?php if (!empty($is_preview)): ?>
        <div style="position:sticky;top:0;z-index:99999;background:#fff3cd;border-bottom:1px solid #ffeeba;padding:10px 12px;font-size:14px;color:#856404;">
            <b>Preview mode:</b> this does not save the course. Close this tab to continue editing in admin.
        </div>
    <?php endif; ?>
    <!-- start cursor -->
    <!--<div class="cursor-page-inner">-->
    <!--    <div class="circle-cursor circle-cursor-inner"></div>-->
    <!--    <div class="circle-cursor circle-cursor-outer"></div>-->
    <!--</div>-->
    <!-- end cursor -->
    <!-- start header -->
   <?php $this->load->view('header'); ?>
    <!-- end header -->

   <?php $this->load->view('sidebar'); ?>
    <div class="wrapper-content">
        <section class="position-relative pt-2 purple-event-hero program-full-hero">
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-sm-12 col-md-5 position-relative">
                        <div
                            class="sop-card-unique left-13 full-box-content full-box-content-height border-none d-flex align-items-start justify-content-end gap-3 mobile-wrap">
                            <div class="w-30 mobile-w-full">
                                <?php if (!empty($program->top_label)): ?>
                                <div class="sop-top-label h-30px w-130px">
                                    <img src="<?= base_url('assets/img/red-hours.gif') ?>" class="w-15 ml-2" alt="" />
                                    &nbsp;<?= htmlspecialchars($program->top_label) ?>
                                </div>
                                <?php endif; ?>
                                <div class="sop-image-wrapper-1 w-100">
                                    <img src="<?= htmlspecialchars($img_src) ?>" alt="<?= htmlspecialchars($program->title) ?>" class="big_img" onerror="this.src='<?= base_url('assets/img/saved_2.jpg') ?>'">

                                    <div class="sop-heart-icon">
                                        <img src="<?= base_url('assets/img/share.png') ?>" alt="Share">
                                    </div>
                                    <?php if (!empty($program->badge_text)): ?>
                                    <div class="sop-heart-icon bg-purple text-white px-1 fs-16 border-radius-6px">
                                        <?= htmlspecialchars($program->badge_text) ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="content-wrap w-50 p-1 pt-5  mobile-w-full">
                                <div class="w-90 purple-dot position-relative floting-left-100 mobile-w-70 mobile-m-auto">
                                    <h1 class=" mb-0 border-black fnt-family px-2 py-2 text-black fs-36 border-radius-4px bg-white w-461px mobile-fs-24 mobile-lh-full mobile-w-full">
                                        <?= nl2br(htmlspecialchars($program->title)) ?>
                                    </h1>
                                </div>
                                <?php if (!empty($program->short_description)): ?>
                                <div class="mt-2 mobile-w-70 mobile-m-auto mobile-pb-4 mobile-pt-2">
                                    <span class="fs-14 lh-18 d-block text-black mobile-fs-12 mobile-lh-full mobile-br-none"><?= nl2br(htmlspecialchars($program->short_description)) ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($tags_arr)): ?>
                                <div class="sop-tags px-2 py-2 mb-0 mt-2">
                                    <?php foreach ($tags_arr as $t): $t = trim($t); if ($t === '') continue; ?>
                                    <span class="sop-tag"><?= (strpos($t, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($t) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                <div class="d-flex justify-content-space mt-3">
                                    <?php if (!empty($program->learn_more_url)): ?>
                                    <a href="<?= htmlspecialchars($program->learn_more_url) ?>" target="_blank" rel="noopener" style="height: 48px !important;" class="sop-learn-btn bg-blue-500 mt-1 w-100 fw-500 text-black border-radius-4px fs-17 d-inline-flex align-items-center justify-content-center text-decoration-none">Book Your Seat</a>
                                    <?php else: ?>
                                    <a href="<?= base_url('cvreadyprogram') ?>" style="height: 48px !important;" class="sop-learn-btn bg-blue-500 mt-1 w-100 fw-500 text-black border-radius-4px fs-17 d-inline-flex align-items-center justify-content-center text-decoration-none">Discover Programs</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12"></div>
                    <div class="d-flex gap-5 w-60 align-items-start justify-content-center mt-8 mobile-wrap">
                        <div class="w-344px mobile-w-full">
                            <h3 class="fs-30 text-black fw-900 overflow-hidden text-blue mb-1 gr-mobile-1">
                                <span class="bg-light-green-200 text-uppercase p-1 fs-28">Who’s It For?</span>
                            </h3>
                            <div class="d-flex align-items-start gap-1 mb-3">
                                <h4 class="bg-light-green-200 mb-0 fs-24 lh-98 p-1 text-black fw-500 overflow-hidden text-blue">
                                <p class="bg-light-green-200 mb-0 fs-24 lh-98 p-1 text-black fw-500 overflow-hidden text-blue mobile-fs-14"> <?= nl2br(htmlspecialchars($who_text)) ?></p>   
                                </h4>
                            </div>
                        </div>
                        <div class="w-344px mobile-w-full">
                            <h3 class="fs-30 text-black fw-900 overflow-hidden text-blue mb-1 gr-mobile-1">
                                <span class="bg-light-green-200 p-1 text-uppercase fs-28">Session Topics</span>
                            </h3>
                            <?php if (!empty($topics_arr)): ?>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($topics_arr as $topic): ?>
                                <li class="bg-light-green-200 mb-2 p-1 fs-18 text-black"><?= htmlspecialchars($topic) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php else: ?>
                            <p class="bg-light-green-200 mb-0 fs-24 lh-98 p-1 text-black fw-500 overflow-hidden text-blue mobile-fs-14">Key topics covered in this program.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                </div>
        </section>

        <section class="pt-1">
            <div class="">
                <div class="row justify-content-center align-items-center gap-5">
                    <div class="col-lg-12">
                        <div class="bg-gray-100 px-4 py-8 border-radius-15px blue-border-line">
                            <div class="d-flex gap-4 align-items-center justify-content-center mobile-wrap mobile-align-center">
                                <div class="d-flex gap-2 w-20 mt-1 group-flex-items align-items-start mobile-fix-full">
                                    <span class="icon-box green-box" style="width: 50px;">
                                        <img src="<?= base_url('assets/img/icon-traingal.png') ?>" alt="">
                                    </span>
                                    <h4 class="mb-0 text-black fnt-family fs-36 mobile-fs-24 mobile-">Program
                                        Description</h4>
                                </div>
                                <h6 class="w-60 mb-0 text-black fs-20 lh-25 mobile-w-full mobile-fs-18 mobile-lh-20"><?= nl2br(htmlspecialchars(!empty($program->short_description) ? $program->short_description : 'Join this program to gain practical skills and add value to your profile.')) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mobile-box-4 mobile-box-style-2 mobile-pt-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h1 class="text-black fnt-family fw-500 fs-40 pt-0 text-center">
                            explore Program Highlights
                        </h1>

                        <div class="group-flex-items mt-5 d-flex wrap justify-content-space appear anime-child anime-complete">
                            <?php
                            $default_highlights = ['Hands-on training and practical skills', 'Expert-led theory and practice', 'Structured learning with feedback', 'Certificate or recognition on completion'];
                            $pts = !empty($highlights) ? $highlights : $default_highlights;
                            foreach (array_slice(array_pad($pts, 4, ''), 0, 4) as $i => $pt):
                                $num = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
                                $text = trim($pt) !== '' ? $pt : $default_highlights[$i];
                            ?>
                            <div class="w-211px column-flex">
                                <div class="d-flex align-items-start gap-3 mb-5">
                                    <span class="icon-box">
                                        <img src="<?= base_url('assets/img/icon-traingal.png') ?>" alt="">
                                    </span>
                                    <h4 class="text-black mb-0 fs-57 lh-50 fw-500"><?= $num ?></h4>
                                </div>
                                <h6 class="mb-0 fs-14 text- lh-20 text-black text-center max-ht-100px"><?= htmlspecialchars($text) ?></h6>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-8">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center gap-5 mobile-wrap">
                    <div class="w-344px">
                        <div class="d-flex align-items-start gap-1 mb-3 w-344px mobile-w-70 mobile-auto mobile-pb-4">
                            <h4
                                class="bg-light-green-200 mb-0 fs-24 mobile-fs-22 lh-28 w-344px p-1 text-black fw-500 overflow-hidden text-blue m-border-1">
                                And a few more to <br />
                                make sure you're on <br />
                                the right part.
                            </h4>
                        </div>
                    </div>
                        <div class="w-694">
                            <ul class="todo-update-list p-0">
                                <li class="fs-16 text-black mb-1 fw-500 d-flex gap-2 align-items-start">
                                    <img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>"/>
                                    Exclusive surgical exposure at RCSEd
                                </li>
                                <li class="fs-16 text-black mb-1 fw-500 d-flex gap-2 align-items-start">
                                    <img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>"/>
                                    Delivered by skilled consultant surgeons
                                </li>
                                <li class="fs-16 text-black mb-1 fw-500 d-flex gap-2 align-items-start">
                                    <img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>"/>
                                    Early-stage surgical skill-building
                                </li>
                                <li class="fs-16 text-black mb-1 fw-500 d-flex gap-2 align-items-start">
                                    <img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>"/>
                                    Global certification from RCSEd 
                                </li>
                                <li class="fs-16 text-black mb-1 fw-500 d-flex gap-2 align-items-start lh-full">
                                    <img src="<?= base_url('assets/img/flat-color-icons_ok.png') ?>"/>
                                   Small group focus ensures personalized <br /> attention
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php if ($brochure_url || $qr_src): ?>
        <section class="pt-5">
            <div class="container">
                <div class="row justify-content-center align-items-center gap-5">
                    <div class="col-lg-12">
                        <div class="bg-gray-100 p-4 border-radius-10px">
                            <div class="d-flex gap-4 flex-wrap align-items-center">
                                <?php if ($brochure_url): ?>
                                <div>
                                    <h4 class="mb-0 fw-500 fs-20 lh-25 text-black">Brochure</h4>
                                    <a href="<?= htmlspecialchars($brochure_url) ?>" target="_blank" rel="noopener" class="btn btn-black border-radius-6px text-captilize fs-14 mt-2">Download brochure</a>
                                </div>
                                <?php endif; ?>
                                <?php if ($qr_src): ?>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-500 fs-18 text-black">Scan to learn more</span>
                                    <img src="<?= htmlspecialchars($qr_src) ?>" alt="QR code" style="max-width: 120px; max-height: 120px;">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        
        
          <section class="pt-5">
            <div class="container">
                <div class="row justify-content-center align-items-center gap-5">

                    <div class="col-lg-10">
                        <div class="text-center">
                            <h1 class="mb-1 fnt-family fs-38 text-black mobile-fs-24 mobile-lh-full">Learn more about the awarding body</h1>
                            <p class="text-black fs-16 lh-20 mobile-fs-14 mobile-br-none">This program is officially awarded by [Name of
                                Institution], a
                                globally recognized institution <br />
                                known for its academic standards and real-world relevance.</p>
                        </div>
                        <div class="d-flex align-items-start gap-1 justify-content-center mt-5 mobile-wrap mobile-reverse">
                            <div class="w-30 mobile-w-full">
                                <!--hide mobile logo-->
                                <div class="border-black p-1 w-50 mb-6 mobile-none">
                                    <img src="<?= base_url('/assets/img/saved_logo.jpg') ?>" class="" />
                                </div>
                                
                                <div class="px-2 w-90 text-black">
                                    <div class="mobile-d-flex mobile-mt-30">
                                        <div>
                                    <h4 class="mb-0 fs-38 fnt-family mobile-fs-24 mobile-lh-full">Founded in 1505</h4>
                                    <p class="fs-16 mb-5 lh-20 fw-300 mobile-fs-14 mobile-lh-full">One of the oldest surgical colleges in the world,
                                        with
                                        over
                                        500 years of history.</p>

                                    <h4 class="fs-38 fnt-family  mobile-fs-24 mobile-lh-full">
                                        Home of the UK’s First Surgical Trainer Faculty</h4>
                                    <h4 class="mb-0 fs-38 fnt-family  mobile-fs-24 mobile-lh-full mobile-br-none">Expert-Led <br /> Training & Exams</h4>
                                    <p class="fs-16 lh-25 fw-300 mobile-fs-14 mobile-lh-full">Offers MRCS, dental, anatomy, perioperative care, and
                                        surgical
                                        trainer
                                        certifications.</p>

                                    <h4 class="fs-38 mb-0 fnt-family  mobile-fs-24 mobile-lh-full mobile-br-none">
                                        Global <br /> Reach</h4>
                                    <p class="fs-16 lh-25 lh-25 fw-300 mobile-fs-14 mobile-lh-full">Offers MRCS, dental, anatomy, perioperative
                                        care,
                                        and
                                        surgical
                                        trainer
                                        certifications.</p>
                                    </div>
                                    
                                    <!--mobile show- content-->
                                    <div class="mb-10 d-flex gap-3 desktop-none" style=" flex-direction: column; align-items: center;">
                                        <h4 class="mb-0 fs-38 text-black fnt-family mobile-fs-24 mobile-lh-full text-nowrap">Accreditation <br /> and
                                            Membership
                                        </h4>
                                        <div class="">
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-1.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-2.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-3.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-4.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"> <img src="<?= base_url('/assets/img/logo-5.png') ?>" /></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-60 mobile-w-full">
                                 <!--mobile logo-->
                                <div class="border-black p-1 w-50 mb-6 desktop-none">
                                    <img src="<?= base_url('/assets/img/saved_logo.jpg') ?>" class="" />
                                </div>
                                <div class="fit-object-cover-3">
                                    <img src="<?= base_url('/assets/img/rcrsed.jpg') ?>" />
                                </div>
                                
                                <div class="d-flex align-items-start mt-3">
                                    <div class="bg-gray-200 flot-overlapt-box px-4 w-45 border-radius-15px pt-5 pb-5">
                                        <h4 class="mb-5 fs-38 text-black fnt-family mobile-fs-24 mobile-lh-full">Rankings &
                                            Reputation</h4>
                                        <p class="text-black fs-15 lh-20 mobile-fs-14">Edinburgh’s Surgeons' Hall and RCSEd are
                                            touted
                                            globally as among the top
                                            surgical colleges—one of the world’s oldest and most respected surgical
                                            institutions</p>
                                        <p class="text-black fs-15 lh-20 mobile-fs-14 mb-0">Is backed by royal charter since
                                            1778—recognized by global health systems and
                                            regulators.</p>
                                    </div>
                                    
                                    <!--mobile-none-->
                                    <div class="mb-10 d-flex gap-3 mobile-none" style=" flex-direction: column; align-items: center;">
                                        <h4 class="mb-0 fs-38 text-black fnt-family   text-nowrap">Accreditation <br /> and
                                            Membership
                                        </h4>
                                        <div class="">
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-1.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-2.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-3.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"><img src="<?= base_url('/assets/img/logo-4.png') ?>" /></div>
                                            <div class="fit-object-cover-logo"> <img src="<?= base_url('/assets/img/logo-5.png') ?>" /></div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-10 mt-0">

                        <h4 class="text-black fs-25 fw-500 mb-0 mobile-fs-24">
                            How to Apply</h4>
                        <p class="fs-16 fw-400 lh-25 text-black mobile-fs-14 mobile-lh-full">The admission process for the 1-week surgical program
                            can
                            be completed in the following ways:</p>

                        <h4 class="mb-0 fs-16 fw-500">Eligibility</h4>
                        <div class="d-flex gap-1 wrap">
                            <span class="d-block bg-black text-white px-2 fs-14 mobile-fs-14">MBBS Students</span>
                            <span class="d-block bg-black text-white px-2 fs-14 mobile-fs-14">Medical Interns</span>
                            <span class="d-block bg-black text-white px-2 fs-14 mobile-fs-14">Surgeons aiming for global
                                exposure</span>
                            <span class="d-block bg-black text-white px-2 fs-14 mobile-fs-14">Candidates preparing for global
                                pathways</span>
                        </div>
                        <div class="full-content-wrap">
                            <div class="d-flex gap-4 mb-3 mt-4 align-items-center mobile-wrap">
                                <div class="w-70px mr-20px">
                                    <div class="border-black p-2">
                                        <h4 class="text-black nowrap text-end fs-17 lh-22 mb-0 fw-500 px-2">
                                            Option <span class="d-block text-end fs-40 text_purple">1</span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="w-30 mobile-w-70">
                                    <h5 class="mb-3 fs-17 lh-25 fw-500 text-black mobile-fs-16 mobile-mb-0">Submit Application</h5>
                                    <p class="text-black fs-14 lh-20 mb-3 mobile-fs-14">Fill the form in the course intro button or
                                        <a href="#" class="d-inline-block text-purple">apply here</a>
                                    </p>
                                </div>
                                <span class="mobile-d-block mobile-w-full mobile-text-center"><img src="<?= base_url('/assets/img/arrow-left-2.png') ?>" class="mobile-rotate-90" width="30px"></span>
                                <div class="w-30 mobile-w-full mobile-ml-26">
                                    <h5 class="mb-3 fs-17 lh-25 fw-500 text-black mobile-fs-16 mobile-mb-0">Wait for a follow up</h5>
                                    <p class="text-black fs-14 lh-20 mb-3 mobile-fs-14">Get on a call with our counselor & clear
                                        doubts.
                                    </p>
                                </div>
                                 <span class="mobile-d-block mobile-w-full mobile-text-center"><img src="<?= base_url('/assets/img/arrow-left-2.png') ?>" class="mobile-rotate-90" width="30px"></span>
                                <div class="w-30 mobile-w-full mobile-ml-26">
                                    <h5 class="mb-3 fs-17 lh-25 fw-500 text-black mobile-fs-16 mobile-mb-0">Get Payment Link</h5>
                                    <p class="text-black fs-14 lh-20 mb-3 mobile-fs-14">Complete the payment, and
                                        get the welcome email</p>
                                </div>
                            </div>
                            <div class="d-flex gap-4 mb-1 align-items-start">
                                <div class="w-70px">
                                    <div class="border-black p-2">
                                        <h4 class="text-black nowrap text-end fs-17 lh-22 mb-0 fw-500 px-2">
                                            Option <span class="d-block text-end fs-40 text_purple">2</span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="w-30 mobile-w-70">
                                    <h5 class="mb-3 fs-17 lh-25 fw-500 text-black mobile-fs-16 mobile-mb-0">Pay via the enroll button</h5>
                                    <p class="text-black fs-15 lh-20">Skip the wait — pay directly in the Program Fee
                                        section <a href="#" class="d-inline-block text-purple">below</a> to enroll and get your welcome email.</p>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <!--<section class="pt-5">-->
        <!--    <div class="container">-->
        <!--        <div class="row justify-content-center align-items-center gap-5">-->

        <!--            <div class="col-lg-10">-->
        <!--                <div class="text-center">-->
        <!--                    <h1 class="mb-1 fnt-family fs-38 text-black">Learn more about the awarding body</h1>-->
        <!--                    <p class="text-black fs-16 lh-20">This program is officially awarded by [Name of-->
        <!--                        Institution], a-->
        <!--                        globally recognized institution <br />-->
        <!--                        known for its academic standards and real-world relevance.</p>-->
        <!--                </div>-->
        <!--                <div class="d-flex align-items-start gap-1 justify-content-center mt-5">-->
        <!--                    <div class="w-30">-->
        <!--                        <div class="border-black p-1 w-50 mb-6">-->
        <!--                            <img src="<?= base_url('assets/img/saved_logo.jpg') ?>"class="" />-->
        <!--                        </div>-->
        <!--                        <div class="px-2 w-90 text-black">-->
        <!--                            <h4 class="mb-0 fs-38 fnt-family">Founded in 1505</h4>-->
        <!--                            <p class="fs-16 mb-5 lh-20 fw-300">One of the oldest surgical colleges in the world,-->
        <!--                                with-->
        <!--                                over-->
        <!--                                500 years of history.</p>-->

        <!--                            <h4 class="fs-38 fnt-family">-->
        <!--                                Home of the UK’s First Surgical Trainer Faculty</h4>-->
        <!--                            <h4 class="mb-0 fs-38 fnt-family">Expert-Led <br /> Training & Exams</h4>-->
        <!--                            <p class="fs-16 lh-25 fw-300">Offers MRCS, dental, anatomy, perioperative care, and-->
        <!--                                surgical-->
        <!--                                trainer-->
        <!--                                certifications.</p>-->

        <!--                            <h4 class="fs-38 mb-0 fnt-family">-->
        <!--                                Global <br /> Reach</h4>-->
        <!--                            <p class="fs-16 lh-25 lh-25 fw-300">Offers MRCS, dental, anatomy, perioperative-->
        <!--                                care,-->
        <!--                                and-->
        <!--                                surgical-->
        <!--                                trainer-->
        <!--                                certifications.</p>-->

        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="w-60">-->
        <!--                        <div class="fit-object-cover-3">-->
        <!--                            <img src="<?= base_url('assets/img/rcrsed.jpg') ?>"/>-->
        <!--                        </div>-->
        <!--                        <div class="d-flex align-items-start mt-3">-->
        <!--                            <div class="bg-gray-200 flot-overlapt-box px-4 w-45 border-radius-15px pt-5 pb-5">-->
        <!--                                <h4 class="mb-5 fs-38 text-black fnt-family">Rankings &-->
        <!--                                    Reputation</h4>-->
        <!--                                <p class="text-black fs-15 lh-20">Edinburgh’s Surgeons' Hall and RCSEd are-->
        <!--                                    touted-->
        <!--                                    globally as among the top-->
        <!--                                    surgical colleges—one of the world’s oldest and most respected surgical-->
        <!--                                    institutions</p>-->
        <!--                                <p class="text-black fs-15 lh-20 mb-0">Is backed by royal charter since-->
        <!--                                    1778—recognized by global health systems and-->
        <!--                                    regulators.</p>-->
        <!--                            </div>-->
        <!--                            <div class="mb-10 d-flex gap-3" style=" flex-direction: column; align-items: center;">-->
        <!--                                <h4 class="mb-0 fs-38 text-black fnt-family   text-nowrap">Accreditation <br /> and-->
        <!--                                    Membership-->
        <!--                                </h4>-->
        <!--                                <div class="">-->
        <!--                                    <div class="fit-object-cover-logo"><img src="<?= base_url('assets/img/logo-1.png') ?>"/></div>-->
        <!--                                    <div class="fit-object-cover-logo"><img src="<?= base_url('assets/img/logo-2.png') ?>"/></div>-->
        <!--                                    <div class="fit-object-cover-logo"><img src="<?= base_url('assets/img/logo-3.png') ?>"/></div>-->
        <!--                                    <div class="fit-object-cover-logo"><img src="<?= base_url('assets/img/logo-4.png') ?>"/></div>-->
        <!--                                    <div class="fit-object-cover-logo"> <img src="<?= base_url('assets/img/logo-5.png') ?>"/></div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->


        <!--            <div class="col-lg-10 mt-0">-->

        <!--                <h4 class="text-black fs-25 fw-500 mb-0">-->
        <!--                    How to Apply</h4>-->
        <!--                <p class="fs-16 fw-400 lh-25 text-black">The admission process for the 1-week surgical program-->
        <!--                    can-->
        <!--                    be completed in the following ways:</p>-->

        <!--                <h4 class="mb-0 fs-16 fw-500">Eligibility</h4>-->
        <!--                <div class="d-flex gap-1 wrap">-->
        <!--                    <span class="d-block bg-black text-white px-2 fs-14">MBBS Students</span>-->
        <!--                    <span class="d-block bg-black text-white px-2 fs-14">Medical Interns</span>-->
        <!--                    <span class="d-block bg-black text-white px-2 fs-14">Surgeons aiming for global-->
        <!--                        exposure</span>-->
        <!--                    <span class="d-block bg-black text-white px-2 fs-14">Candidates preparing for global-->
        <!--                        pathways</span>-->
        <!--                </div>-->
        <!--                <div class="full-content-wrap">-->
        <!--                    <div class="d-flex gap-4 mb-3 mt-4 align-items-center">-->
        <!--                        <div class="w-70px">-->
        <!--                            <div class="border-black p-2">-->
        <!--                                <h4 class="text-black nowrap text-end fs-17 lh-22 mb-0 fw-500 px-2">-->
        <!--                                    Option <span class="d-block text-end fs-40 text_purple">1</span>-->
        <!--                                </h4>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <div class="w-30">-->
        <!--                            <h5 class="mb-3 fs-17 lh-25 fw-500 text-black">Submit Application</h5>-->
        <!--                            <p class="text-black fs-14 lh-20 mb-3">Fill the form in the course intro button or-->
        <!--                                <a href="#" class="d-inline-block text-purple">apply here</a>-->
        <!--                            </p>-->
        <!--                        </div>-->
        <!--                        <span><img src="<?= base_url('assets/img/arrow-left-2.png') ?>"width="30px"></span>-->
        <!--                        <div class="w-30">-->
        <!--                            <h5 class="mb-3 fs-17 lh-25 fw-500 text-black">Wait for a follow up</h5>-->
        <!--                            <p class="text-black fs-14 lh-20 mb-3">Get on a call with our counselor & clear-->
        <!--                                doubts.-->
        <!--                            </p>-->
        <!--                        </div>-->
        <!--                         <span><img src="<?= base_url('assets/img/arrow-left-2.png') ?>"width="30px"></span>-->
        <!--                        <div class="w-30">-->
        <!--                            <h5 class="mb-3 fs-17 lh-25 fw-500 text-black">Get Payment Link</h5>-->
        <!--                            <p class="text-black fs-14 lh-20 mb-3">Complete the payment, and-->
        <!--                                get the welcome email</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="d-flex gap-4 mb-1 align-items-start">-->
        <!--                        <div class="w-70px">-->
        <!--                            <div class="border-black p-2">-->
        <!--                                <h4 class="text-black nowrap text-end fs-17 lh-22 mb-0 fw-500 px-2">-->
        <!--                                    Option <span class="d-block text-end fs-40 text_purple">2</span>-->
        <!--                                </h4>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <div class="w-30">-->
        <!--                            <h5 class="mb-3 fs-17 lh-25 fw-500 text-black">Pay via the enroll button</h5>-->
        <!--                            <p class="text-black fs-15 lh-20">Skip the wait — pay directly in the Program Fee-->
        <!--                                section <a href="#" class="d-inline-block text-purple">below</a> to enroll and get your welcome email.</p>-->
        <!--                        </div>-->

        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->


        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->


       

      

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="bg-gray-100 p-3 d-flex gap-3 position-relative border-radius-10px mobile-wrap">
                            <div class="w-50 mobile-w-full mobile-pt-0">
                                <h1 class="fnt-family fs-38 text-black mobile-fs-24 mobile-lh-full">Upon successful completion, <br />
                                    you’ll be awarded a <br />
                                    certificate by RCSEd</h1>
                                <h1 class="mb-2 fs-28 mt-4 fnt-family text-black">
                                    What’s Included:</h1>

                                <ul class="check-list mb-5">
                                    <li><i class="bi bi-check-circle-fill"></i>Marks your hands-on surgical training &
                                        skill
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>Recognized by hospitals & recruiters
                                        globally
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>Adds real weight to your CV</li>
                                </ul>
                            </div>
                            <div class="w-50 mobile-w-full mobile-pt-0">
                                <div class="ligt-blue-box">
                                    <div class="card-bg-black text-black mb-4">
                                        <h5 class="mb-0 fs-28 letter-2 text-white fnt-family-1">Certificate</h5>
                                    </div>
                                    <h4 class="mb-2 text-black fs-25 fw-500 letter-2 fnt-family-1">Program Title</h4>
                                    <div class="d-flex gap-4 w-80 mb-2 mobile-w-full mobile-pt-0 mobile-wrap">
                                        <div class="input-group-1 mobile-w-full">
                                            <label class="text-black fnt-family-1 fs-14 lh-full">Name</label>
                                            <input type="text" name="" placeholder="Your Name" />
                                        </div>
                                        <div class="input-group-1 mobile-w-full">
                                            <label class="text-black fnt-family-1 fs-14 lh-full">Date Of Program</label>
                                            <input type="date" name="" />
                                        </div>
                                    </div>
                                    <div class="d-flex gap-4 w-80 mb-3 mobile-w-full">
                                        <div class="input-group-1 mobile-w-full">
                                            <label class="text-black fnt-family-1 fs-14 lh-full mobile-w-full">Awarding Body</label>
                                            <input type="text" name="" placeholder="Awarding Body" />
                                        </div>
                                    </div>
                                    <div class="d-flex gap-4 w-100 mb-2">
                                        <div class="input-group-1">
                                            <textarea rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="img-flot-form">
                                        <img src="<?= base_url('assets/img/gold-sticker.png') ?>"/>
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
                                                <img src="<?= base_url('/assets/img/g-3.jpg') ?>" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="<?= base_url('/assets/img/g-3.jpg') ?>" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="<?= base_url('/assets/img/g-3.jpg') ?>" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="overflow-hidden border-radius-10px">
                                            <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                                                <img src="<?= base_url('/assets/img/g-3.jpg') ?>" />
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
        
        <div class="wrapper-content">
            
         <section class="pt-5 scale-down pb-0">
            <div class="container mobile-p-0">
                <div class="row justify-content-center">
                    <div class="w-899px mobile-p-0">
                        <div class="box-gray-2 border-radius-10px pt-5">
                            <div class="w-95 m-auto">
                                <div class="w-95 card-box-border bg-white border-black pt-7 m-auto ht-281 mobile-bg-white">
                                    <h1 class="fnt-family text-black fs-48 w-40 mb-0 mobile-fs-24" style="font-size : 48px">Enrollment Fee</h1>
                                    <p class="text-black fs-24 lh-32 w-70 pb-5 mobile-pb-0 mobile-fs-18 mobile-lh-full mobile-mb-0 mobile-w-full mobile-pt-0 mobile-fs-14">Surgery Week at RCSEd, Scotland</p>
                                </div>
                                <div
                                    class="w-100 card-box-border bg-black border-liner custom-padding-100 custom-padding-100-1 m-auto minus-10 border-radius-0px mobile-bg-black">
                                    <div class="d-flex gap-5 w-90 m-auto justify-content-center mobile-wrap">
                                        <div class="">
                                             <h6 class="fs-16 lh-25 text-white mb-0 desktop-none mb-10">Early Bird Fee (valid till
                                                July
                                                20)</h6>
                                            <h2 class="mb-2 text-white fs-40 pr-2 fw-800 mobile-fs-45">GBP 1500</h2>
                                            <button type="button" class="btn btn-purple2 text-black fw-500  fs-19 lh-16 mt-8 w-210px">Enroll
                                                Now</button>
                                        </div>
                                        <div class="">
                                            <h5
                                                class="fs-14 mb-3 bg-yellow text-black lh-25 py-1 px-2 border-radius-10px mobile-new-1">
                                                Includes full program access</h5>
                                            <h6 class="fs-16 lh-25 text-white mb-0 mobile-none">Early Bird Fee (valid till
                                                July
                                                20)</h6>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mb-2 fs-28 mt-2 fnt-family text-black px-3">
                                    course breakdowns:</h1>
                                     
                                <div class="d-flex gap-2 align-items-start px-3 mobile-wrap">

                                <ul class="check-list mb-0 w-50 mobile-w-full mobile-pt-0">
                                    <li><i class="bi bi-check-circle-fill"></i>Intensive hands-on training at RCSEd</li>
                                    <li><i class="bi bi-check-circle-fill"></i>Live sessions with global surgical
                                        experts
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>Official RCSEd Certificate upon
                                        completion
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>Study materials & surgical exam prep
                                        content
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>
                                    <span>
                                        Boosts your profile with a globally
                                        respected
                                        credential.VISA application guidance <b>(by #PGS)</b>
                                    </span>
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>
                                    <span>Exclusive access to alumni community &
                                        future
                                        sessions <b>(by #PGS)</b></span>
                                    </li>
                                </ul>
                               

                                <div class="w-50 mobile-w-full mobile-pt-0">
                                    <ul class="check-list mb">
                                     <li><i class="bi bi-check-circle-fill"></i>Be added to a prep group* (by #PGS)</li>
                                    <li><i class="bi bi-check-circle-fill"></i>& More</li>

                                    </ul>
                                    <div class="d-flex gap-3 align-items-start mobile-w-70 mobile-wrap mobile-m-last">
                                    <div class="w-228px mt-15">
                                        <h4 class="fs-14 lh-16 text-black fw-500 mb-1">Other expenses (optional) </h4>
                                    <div class="border-black d-inline-block p-1 border-radius-10px mb-3 w-100">
                                        <span class="mb-0 fs-14 text-black">Housing & Stay</span>
                                        <button
                                            class="btn bg-purple text-black border-radius-10px gap-2 d-flex align-items-start w-100 justify-content-space">
                                            <span class="fs-24 fw-600 d-block">GBP 200</span>
                                            <span
                                                class="bg-yellow px-2 py-1 text-captilize fs-13 border-radius-10px">*approx</span>
                                        </button>
                                    </div>
                                    </div>
                                     <div class="w-40 mt-12 mobile-mt-0">
                                    <h4 class="fs-14 lh-36 text-black fw-500 mb-0 mobile-pb-2" style="margin-bottom: -6px !important;">Payment Methods</h4>
                                    <div class="border-black d-inline-block p-1 border-radius-10px mb-3 w-90">
                                        <span class="mb-0 fs-14 lh-full text-black" style="
                                                line-height: 100% !important;
                                                color: rgba(0, 0, 0, 1);
                                                    display: block;
                                                padding: 3px !important;
                                            ">Pay via Credit/Debit Card, UPI, or
                                            Bank
                                            Transfer</span>
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
        
        <!-- <section class="pt-5 scale-down pb-0">-->
        <!--    <div class="container">-->
        <!--        <div class="row justify-content-center">-->
        <!--            <div class="w-899px">-->
        <!--                <div class="box-gray-2 border-radius-10px pt-5">-->
        <!--                    <div class="w-95 m-auto">-->
        <!--                        <div class="w-95 card-box-border bg-white border-black pt-7 m-auto ht-281">-->
        <!--                            <h1 class="fnt-family text-black fs-48 w-40 mb-0" style="font-size : 48px">Enrollment Fee</h1>-->
        <!--                            <p class="text-black fs-24 lh-32 w-70 pb-5">Surgery Week at RCSEd, Scotland</p>-->
        <!--                        </div>-->
        <!--                        <div-->
        <!--                            class="w-100 card-box-border bg-black border-liner custom-padding-100 m-auto minus-10 border-radius-0px">-->
        <!--                            <div class="d-flex gap-5 w-90 m-auto justify-content-center">-->
        <!--                                <div class="">-->
        <!--                                    <h2 class="mb-2 text-white fs-40 pr-2 fw-800">GBP 1500</h2>-->
        <!--                                    <button type="button" class="btn btn-purple2 text-black fw-500  fs-19 lh-16 mt-8 w-210px">Enroll-->
        <!--                                        Now</button>-->
        <!--                                </div>-->
        <!--                                <div class="">-->
        <!--                                    <h5-->
        <!--                                        class="fs-14 mb-3 bg-yellow text-black lh-25 py-1 px-2 border-radius-10px">-->
        <!--                                        Includes full program access</h5>-->
        <!--                                    <h6 class="fs-16 lh-25 text-white mb-0">Early Bird Fee (valid till-->
        <!--                                        July-->
        <!--                                        20)</h6>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <h1 class="mb-2 fs-28 mt-2 fnt-family text-black px-3">-->
        <!--                            course breakdowns:</h1>-->
                                     
        <!--                        <div class="d-flex gap-2 align-items-start px-3">-->

        <!--                        <ul class="check-list mb-0 w-50">-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>Intensive hands-on training at RCSEd</li>-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>Live sessions with global surgical-->
        <!--                                experts-->
        <!--                            </li>-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>Official RCSEd Certificate upon-->
        <!--                                completion-->
        <!--                            </li>-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>Study materials & surgical exam prep-->
        <!--                                content-->
        <!--                            </li>-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>-->
        <!--                            <span>-->
        <!--                                Boosts your profile with a globally-->
        <!--                                respected-->
        <!--                                credential.VISA application guidance <b>(by #PGS)</b>-->
        <!--                            </span>-->
        <!--                            </li>-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>-->
        <!--                            <span>Exclusive access to alumni community &-->
        <!--                                future-->
        <!--                                sessions <b>(by #PGS)</b></span>-->
        <!--                            </li>-->
        <!--                        </ul>-->
                               

        <!--                        <div class="w-50">-->
        <!--                            <ul class="check-list mb">-->
        <!--                             <li><i class="bi bi-check-circle-fill"></i>Be added to a prep group* (by #PGS)</li>-->
        <!--                            <li><i class="bi bi-check-circle-fill"></i>& More</li>-->

        <!--                            </ul>-->
        <!--                            <div class="d-flex gap-3 align-items-start">-->
        <!--                            <div class="w-228px mt-15">-->
        <!--                                <h4 class="fs-14 lh-16 text-black fw-500 mb-1">Other expenses (optional) </h4>-->
        <!--                            <div class="border-black d-inline-block p-1 border-radius-10px mb-3 w-100">-->
        <!--                                <span class="mb-0 fs-14 text-black">Housing & Stay</span>-->
        <!--                                <button-->
        <!--                                    class="btn bg-purple text-black border-radius-10px gap-2 d-flex align-items-start w-100 justify-content-space">-->
        <!--                                    <span class="fs-24 fw-600 d-block">GBP 200</span>-->
        <!--                                    <span-->
        <!--                                        class="bg-yellow px-2 py-1 text-captilize fs-13 border-radius-10px">*approx</span>-->
        <!--                                </button>-->
        <!--                            </div>-->
        <!--                            </div>-->
        <!--                             <div class="w-40 mt-12">-->
        <!--                            <h4 class="fs-14 lh-36 text-black fw-500 mb-0" style="margin-bottom: -6px !important;">Payment Methods</h4>-->
        <!--                            <div class="border-black d-inline-block p-1 border-radius-10px mb-3 w-90">-->
        <!--                                <span class="mb-0 fs-14 lh-full text-black" style="-->
        <!--                                        line-height: 100% !important;-->
        <!--                                        color: rgba(0, 0, 0, 1);-->
        <!--                                            display: block;-->
        <!--                                        padding: 3px !important;-->
        <!--                                    ">Pay via Credit/Debit Card, UPI, or-->
        <!--                                    Bank-->
        <!--                                    Transfer</span>-->
        <!--                            </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        </div>-->
        <!--                         </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

          <section class="position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 m-auto">
                            <div>
                                <h4
                                    class="top-heading-client text-black fs-25 text-center mb-1 appear anime-child anime-complete fw-500">
                                    A word from <span style>Our
                                        learners</span></h4>
                                <p class="text-center text-black w-60 m-auto fs-16 lh-22">Also
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
                                <div class="row mt-4">
                                    
                                    <?php
                                    $testimonials_list = isset($testimonials) ? $testimonials : [];
                                    if (empty($testimonials_list)) {
                                        $testimonials_list = [ (object)['description' => "I've picked up a really valuable skill set that makes my CV stand out.", 'product_name' => 'Raina Venkatesh', 'image1' => null] ];
                                    }
                                    foreach (array_slice($testimonials_list, 0, 3) as $t):
                                        $t_img = !empty($t->image1) ? ($admin_assets_images_base . $t->image1) : base_url('assets/img/selfe.jpg');
                                        $t_name = isset($t->product_name) ? $t->product_name : 'Our learner';
                                        $t_desc = isset($t->description) ? $t->description : '';
                                    ?>
                                    <div class="col-lg-4 p-0 pr-5 appear anime-complete"
                                        data-anime="{ &quot;translateY&quot;: [0, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;: 0, &quot;staggervalue&quot;: 300, &quot;easing&quot;: &quot;easeOutQuad&quot; }"
                                        style>
                                        <div class="testimonials">
                                            <div class="item-clients w-100">
                                                <div class="fix-object-img">
                                                    <img src="<?= htmlspecialchars($t_img) ?>" alt="<?= htmlspecialchars($t_name) ?>" data-no-retina="" onerror="this.src='<?= base_url('assets/img/selfe.jpg') ?>'">
                                                </div>
                                                <div class="review-content bg-black p-3">
                                                    <p class="text-white lh-20 fs-12 max-h-130px overflow-auto mb-2"><?= nl2br(htmlspecialchars($t_desc)) ?></p>
                                                    <div class="author-info">
                                                        <h6 class="mb-2 fs-14 lh-20 text-white"><?= htmlspecialchars($t_name) ?></h6>
                                                        <p class="text-white fs-12 lh-16 mb-0 opacity-08">#purplePremium learner</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        <h5 class="text-black fs-25 mb-3">
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
    <!-- end section -->
    <?php $this->load->view('footer'); ?>
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