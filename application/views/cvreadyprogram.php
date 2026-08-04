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

<?php
// CV program/course card images come from admin uploads under the admin app's assets folder.
// Prefer the configured admin_base_url (e.g. https://purpleguide.study/pgs_admin/); otherwise derive it.
$admin_base_cfg = $this->config->item('admin_base_url');
if (!empty($admin_base_cfg)) {
    $admin_assets_images_base = rtrim($admin_base_cfg, '/') . '/assets/images/';
} else {
    $base_url_no_slash = rtrim(base_url(), '/');
    if (preg_match('#/pgs/?$#', $base_url_no_slash)) {
        $admin_assets_images_base = preg_replace('#/pgs/?$#', '/pgs_admin', $base_url_no_slash) . '/assets/images/';
    } else {
        $admin_assets_images_base = $base_url_no_slash . '/pgs_admin/assets/images/';
    }
}
?>
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
        <section class="pt-0 about-section half-section mobile-cvready-cart overlap-height position-relative minus-5">
            <div class="container overlap-gap-section p-0">
                <div class="row justify-content-center">

                    <div class="col-lg-8">
                        <div class="w-90 m-auto">
                            <h1 class="text-black fw-500 fs-50 lh-full fnt-family pt-0 mb-3 w-30 m-auto">Courses That Actually
                                Count
                            </h1>
							
                            <p class="mb-10 lh-24 text-black w-100 text-start fs-19 lh-25 fw-400">This section covers everything from
                                short-term
                                courses, internships, and clinical visit programs to English language classes,
                                confidence-building sessions, and more. We made this page to help you find things that
                                not
                                only look good on your CV but also actually help you grow, explore new things, and feel
                                more
                                ready for what’s next.</p>
                        </div>
                        <div>
                            <div class="filer-tag fnt-update">
                                <h5 class="mb-0 text-black fs-19">Filter:</h5>
                                <div class="tag-highlights js-filter-tags">
                                    <span class="active js-filter-tag" data-filter="">#all</span>
                                    <?php foreach (isset($unique_tags) ? $unique_tags : [] as $tag): ?>
                                    <span class="js-filter-tag" data-filter="<?= htmlspecialchars(strtolower($tag)) ?>"><?= (strpos($tag, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($tag) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filer-tag mt-1">
                                <h5 class="mb-0 text-black fs-19">Sort:</h5>
                                <div class="tag-highlights js-sort-tags">
                                    <span class="active js-sort-tag" data-sort="order">#all</span>
                                    <span class="js-sort-tag" data-sort="title">#A–Z</span>
                                </div>
                            </div>
                            <div class="w-80 m-auto d-flex justify-content-end align-items-baseline">
                                <img src="./assets/img/yellow-top-arrow.png" />
                                <h1 class="text-black fw-500 fs-36 fnt-family pt-0 mb-3 mobile-fs-24 mobile-lh-full mobile-br-none mobile-w-60 mobile-pb-4">
                                    Filter out above  <br /> or <br />
                                    select a pre selected group below.
                                </h1>
                            </div>
                        </div>
                        <div class="box-tags-card mt-1 w-730px m-auto d-flex flex-wrap gap-1 justify-content-start">
                            <?php $all_tags = isset($unique_tags) ? $unique_tags : []; foreach ($all_tags as $tag): ?>
                            <div class="d-flex gap-1 align-items-start js-filter-tag-box" data-filter="<?= htmlspecialchars(strtolower($tag)) ?>"><span class="bg-blue-hash text-black">#</span><span class="bg-black text-white"><?= htmlspecialchars($tag) ?></span></div>
                            <?php endforeach; ?>
                            <?php if (empty($all_tags)): ?><span class="text-muted">No tags yet.</span><?php endif; ?>
                        </div>

                    </div>

                </div>
        </section>

        <section class="top-partners">
            <div class="w-888px m-auto">
                <div class="row justify-content-center">
					
                    <h4 class="top-heading-client text-black fs-25 text-center">
                        Our Top <span>Partners</span></h4>
                    <div class="col-lg-11 p-0 mobile-w-90 mobile-m-auto">
                        <div class="flex-wrap d-flex align-items-center justify-content-space mobile-justify-center">
                            <div class="client-box-top"><img src="./assets/img/client-1.png" alt="top-client"></div>
                            <div class="client-box-top"><img src="./assets/img/client-2.png" alt="top-client"></div>
                            <div class="client-box-top"><img src="./assets/img/client-3.png" alt="top-client"></div>
                            <div class="client-box-top"><img src="./assets/img/client-4.png" alt="top-client"></div>
                            <div class="client-box-top"><img src="./assets/img/client-5.png" alt="top-client"></div>
                            <div class="client-box-top"><img src="./assets/img/client-6.png" alt="top-client"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-4">
            <div class="w-947px m-auto">
                <div class="row">
                    <div class="col-lg-12 p-0 m-auto">
                        <div class="yellow-bg-box-5">
                            <h5 class="text-black text-center fs-25 fw-500 lh-32 mobile-fs-18 mobile-lh-full mobile-w-60 mobile-auto">
								'#purpleSelected' Explore Our Most Wanted Course </h5>
                            <div class="row mt-3">
                                <div class="box-style-45 d-flex align-items-stretch gap-3 justify-content-center flex-wrap">
                                    <?php
                                    $feat_saved_c = isset($saved_course_ids) ? $saved_course_ids : [];
                                    if (!empty($featured_courses)):
                                        foreach ($featured_courses as $fc):
                                            // Course image: prefer image1, fall back to the uploaded file, else placeholder.
                                            $fc_img_name = !empty($fc->image1) ? $fc->image1 : (!empty($fc->file) ? $fc->file : '');
                                            $fimg = $fc_img_name ? ($admin_assets_images_base . $fc_img_name) : base_url('assets/img/left-cut-saved-3.png');
                                            $ftags = !empty($fc->tags) ? preg_split('/[\s,#]+/', trim($fc->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                                            $f_saved = in_array((int)$fc->id, $feat_saved_c);
                                            $f_desc = !empty($fc->description) ? trim(strip_tags($fc->description)) : '';
                                            // Course detail page (Programsfull maps course IDs via courses_tbl fallback).
                                            $fc_url = base_url('Programsfull/program/' . (int)$fc->id);
                                    ?>
                                    <div class="county-box-short d-flex flex-column" data-course-id="<?= (int)$fc->id ?>">
                                        <div style="position:relative;" class="img-box-fit">
                                            <a href="<?= $fc_url ?>">
                                                <img src="<?= $fimg ?>" alt="<?= htmlspecialchars($fc->product_name) ?>" style="width:100%; height:140px; object-fit:cover; display:block; border-radius:8px;" onerror="this.onerror=null;this.src='<?= base_url('assets/img/left-cut-saved-3.png') ?>'">
                                            </a>
                                            <?php if (!empty($fc->category_name)): ?>
                                            <div class="fav-text"><?= htmlspecialchars($fc->category_name) ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="m-pb-20 d-flex flex-column flex-grow-1" style="padding:15px 0px 0px 0px;">
                                            <a href="<?= $fc_url ?>" class="fs-22 fw-600 mb-2 text-black lh-full text-limit-small-3 text-decoration-none d-block"><?= htmlspecialchars($fc->product_name) ?></a>
                                            <?php if (!empty($f_desc)): ?>
                                            <div class="fs-14 lh-full mb-3"><?= nl2br(htmlspecialchars(strlen($f_desc) > 100 ? substr($f_desc, 0, 100) . '…' : $f_desc)) ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($ftags)): ?>
                                            <div class="d-flex flex-wrap gap-1" style="margin-bottom:10px;">
                                                <?php foreach (array_slice($ftags, 0, 3) as $ft): $ft = trim($ft); if ($ft === '') continue; ?>
                                                <span class="tag-comment-cv"><?= (strpos($ft, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($ft) ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fc->duration)): ?>
                                            <div class="d-flex gap-2 align-items-center mb-2">
                                                <i class="bi bi-check-circle-fill fs-30 fw-500 text-blue-dark"></i>
                                                <h5 class="mb-0 fs-30 fw-500 fnt-family text-black"><?= htmlspecialchars($fc->duration) ?></h5>
                                            </div>
                                            <?php endif; ?>

                                            <div class="mt-auto d-flex justify-content-end pt-2">
                                                <div class="sop-heart-icon js-save-course" data-course-id="<?= (int)$fc->id ?>" role="button" title="<?= $f_saved ? 'Unsave' : 'Save' ?>"><i class="bi bi-heart-fill <?= $f_saved ? 'text-red' : 'text-black' ?>"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;
                                    else: ?>
                                    <p class="text-muted">No featured courses yet. Mark courses as "show in picks" in admin.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="our-program pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                         
                         <div class="w-80 m-auto">
                                <h4 class="top-heading-client fw-500 text-black fs-25 text-start">
                            Discover <span>Our Programs</span></h4>

                        <div class="">
                            <div class="search-box flex-group-icon left-side-icon w-576px">
                                <i class="bi bi-list left-0"></i>
                                <input type="search" id="programSearch" class="from-control" placeholder="Search programs by name or tags...">
                                <i class="bi bi-search"></i>
                            </div>

                        </div>
                         </div>
                        
                        <div class="row mt-3 wrap mobile-all-w-47">
                          <div class="d-flex wrap align-items-start gap-3 mt-3 justify-content-center">
                            <?php
                            $saved_ids = isset($saved_program_ids) ? $saved_program_ids : [];
                            if (!empty($programs)):
                                foreach ($programs as $prog):
                                    $img_src = !empty($prog->image) ? ($admin_assets_images_base . $prog->image) : base_url('assets/img/cut-college-img.png');
                                    $tags_arr = !empty($prog->tags) ? preg_split('/[\s,#]+/', trim($prog->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                                    $is_saved = in_array((int)$prog->id, $saved_ids);
                                    $search_text = strtolower($prog->title . ' ' . ($prog->short_description ?? '') . ' ' . ($prog->tags ?? ''));
                                    $tags_str = implode(' ', array_map('strtolower', array_map('trim', $tags_arr)));
                            ?>
                            <div class="w-304px position-relative p-0 m-0 mb-0 js-program-card" data-program-id="<?= (int)$prog->id ?>" data-search="<?= htmlspecialchars($search_text) ?>" data-tags="<?= htmlspecialchars($tags_str) ?>" data-title="<?= htmlspecialchars($prog->title) ?>">
                                <div class="sop-card-unique">
                                    <?php if (!empty($prog->top_label)): ?>
                                    <div class="sop-top-label">
                                        <img src="<?= base_url('assets/img/stars.gif') ?>" data-no-retina="">
                                        <?= htmlspecialchars($prog->top_label) ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($prog->badge_text)): ?>
                                    <div class="sop-start-free"><?= htmlspecialchars($prog->badge_text) ?></div>
                                    <?php endif; ?>
                                    <div class="sop-image-wrapper">
                                        <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($prog->title) ?>" data-no-retina="" >
                                        <div class="sop-heart-icon js-save-program" data-program-id="<?= (int)$prog->id ?>" role="button" title="<?= $is_saved ? 'Unsave' : 'Save' ?>">
                                            <i class="bi bi-heart-fill <?= $is_saved ? 'text-red' : 'text-black' ?>"></i>
                                        </div>
                                    </div>
                                    <div class="sop-content text-start w-80">
                                        <div class="sop-title sop-title fnt-family fw-500 fs-26 lh-35 w-100 text-limit-03"><?= htmlspecialchars($prog->title) ?></div>
                                        <?php if (!empty($prog->short_description)): ?>
                                        <div class="sop-subtext fs-12 lh-16 w-100 text-limit-5"><?= nl2br(htmlspecialchars($prog->short_description)) ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($tags_arr)): ?>
                                        <div class="sop-tags">
                                            <?php foreach ($tags_arr as $t): $t = trim($t); if ($t === '') continue; ?>
                                            <span class="sop-tag"><?= (strpos($t, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($t) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-space">
                                        <a href="<?= base_url('Programsfull/program/' . (int)$prog->id) ?>" class="sop-learn-btn" style="line-height : normal ">Learn More</a>
                                        <?php if (!empty($prog->close_date_text)): ?>
                                        <div class="sop-close-date border-radius-0px"><?= nl2br(htmlspecialchars($prog->close_date_text)) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;
                            else: ?>
                            <p class="text-muted">No programs yet. Check back later.</p>
                            <?php endif; ?>
                        </div>
                        </div>
                        <div class="arrows-section mt-5">
                           <div class="dummy-arrows">
                             <img src="./assets/img/down-arrow-scroll.png" width="38px" style="rotate: 92deg;">
                             <img src="./assets/img/down-arrow-scroll.png" width="38px" style="rotate: 272deg;">
                            </div>
                            <p class="mb-0 mt-2 text-black fs-12 lh-19 text-center">Section 1</p>
                          </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="count-box-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11 m-auto mb-2">
                        <div class="flex-grid d-flex gap-3 align-items-center justify-content-center">
                            <div>
                                <h5 class="text-green mb-0 fs-45 fw-500 lh-50"><?= isset($programs_count) ? (int)$programs_count : 0 ?></h5>
                                <h6 class="text-black fs-19 lh-25">Of our students got <br /> a cv boost with our courses</h6>
                            </div>
                            <div class="img-box">
                                <img src="<?= base_url('assets/img/speech-1.png') ?>" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-11 m-auto mb-2">
                        <div class="flex-grid d-flex gap-3 align-items-center justify-content-center">
                            <div class="img-box">
                                <img src="<?= base_url('assets/img/speech-2.png') ?>" alt="" />
                            </div>
                            <div>
                                <h5 class="text-green mb-0 fs-45 fw-500 lh-50">100%</h5>
                                <h6 class="text-black fs-19 lh-25">Of our programs are <br /> created towards student’s <br/>
                                    profile
                                </h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
			
			
			<section class="pt-4">
            <div class="w-947px m-auto">
                <div class="row">
                    <div class="col-lg-12 p-0 m-auto">
                        <div class="yellow-bg-box-5">
                            <h5 class="text-black text-center fs-25 fw-500 lh-32 mobile-fs-18 mobile-lh-full mobile-w-60 mobile-auto">Begin Your Journey: Explore with a Free #studyJam</h5>
                            <div class="row mt-3">
                                <div class="box-style-45 d-flex align-items-start gap-3 justify-content-center flex-wrap">
                                    <?php
                                    $feat_saved = isset($saved_program_ids) ? $saved_program_ids : [];
                                    if (!empty($featured_programs)):
                                        foreach ($featured_programs as $fp):
                                            $fimg = !empty($fp->image) ? ($admin_assets_images_base . $fp->image) : base_url('assets/img/left-cut-saved-3.png');
                                            $ftags = !empty($fp->tags) ? preg_split('/[\s,#]+/', trim($fp->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                                            $f_saved = in_array((int)$fp->id, $feat_saved);
                                    ?>
									
									
                                    <div class="county-box-short" data-program-id="<?= (int)$fp->id ?>">
                                        <div style="position:relative;" class="img-box-fit">
                                            <img src="<?= $fimg ?>" alt="<?= htmlspecialchars($fp->title) ?>" style="width:100%; border-top-right-radius:12px;" onerror="this.src='<?= base_url('assets/img/left-cut-saved-3.png') ?>'">
                                            <?php if (!empty($fp->top_label)): ?>
                                            <div class="fav-text"><?= htmlspecialchars($fp->top_label) ?></div>
                                            <?php endif; ?>
                                        </div>
										
                                        <div  class="m-pb-20" style="padding:15px 0px 30px 0px;">
                                            <div class="fs-22 fw-600 mb-3 text-black lh-full text-limit-small-3"><?= htmlspecialchars($fp->title) ?></div>
                                            <?php if (!empty($fp->short_description)): ?>
                                            <div class="fs-14 lh-full 0 mb-4"><?= nl2br(htmlspecialchars(strlen($fp->short_description) > 120 ? substr($fp->short_description, 0, 120) . '…' : $fp->short_description)) ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($ftags)): ?>
                                            <div style="margin-bottom:6px;">
                                                <?php foreach (array_slice($ftags, 0, 3) as $ft): $ft = trim($ft); if ($ft === '') continue; ?>
                                                <span class="tag-comment-cv"><?= (strpos($ft, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($ft) ?></span>
                                                <?php endforeach; ?>
                                            </div>
											
                                            <?php endif; ?>
                                            <div class="d-flex justify-content-space">
                                                <a href="<?= base_url('Programsfull/program/' . (int)$fp->id) ?>" class="sop-learn-btn lh-25" style="line-height : normal">Learn More</a>
                                            </div>
                                            <div style="display:flex; justify-content: end; margin-top:8px;">
                                                <div class="sop-heart-icon js-save-program" data-program-id="<?= (int)$fp->id ?>" role="button" title="<?= $f_saved ? 'Unsave' : 'Save' ?>"><i class="bi bi-heart-fill <?= $f_saved ? 'text-red' : 'text-black' ?>"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;
                                    else: ?>
                                    <p class="text-muted">No featured programs yet. Add programs in admin.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="w-850px m-auto">
                <div class="row justify-content-center">
                    <div class="p-0 m-auto mobile-w-75">
                        <span class="text-black fs-14 lh-20">How to make best use of <b>#PGS</b> programs</span>
                        <h5 class="text-black fs-27 lh-32 fw-400 mb-2">We are mapped for your Education Goals</h5>
                        <img src="./assets/img/dots-slider.png" class=" mb-6" />

                        <div class="step-check-grid d-flex gap-3 align-items-start">
                            <div class="w-400px">
                                <h6 class="fs-19 lh-31 text-black mb-2">Discover Your Path</h6>
                                <ul class="m-0 p-0">
                                    <li>
                                        <span class="box-dot"></span>
                                        <p class="w-100">Explore handpicked CV-ready programs (internships, research,
                                            projects) matched to
                                            your future goal; whether it’s <b>med school, MBA, a top STEM course &amp;
                                                more.</b>
                                        </p>
                                    </li>
                                    <li>
                                        <span class="box-dot"></span>
                                        <p class="w-100">Get real feedback from our counsellors.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="img-box-fix">
                                <img src="./assets/img/outro-program.jpg" data-no-retina="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



          <section class="pt-10 half-section overlap-height position-relative overflow-hidden ">
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

      

        <section class="pt-0 mobile-pgs-info">
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
                                    <img src="./assets/img/phone.png" width="20px">
                                    91 95665 66298
                                </h6>
                                <h6 class="mb-2 text-black d-flex gap-2 fs-20 fw-500"><span
                                        class="w-20 ml-3 px-1 bg-yellow fs-18 d-inline-block">Email
                                        Us</span>
                                    <img src="./assets/img/phone.png" width="20px">
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
        

 <!-- Footer -->
    
    <?php $this->load->view('footer'); ?> 

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- NOTE: jQuery, vendors and main.js are already loaded by footer.php above.
         Re-including them here double-binds the sidebar toggle (it fired twice and
         cancelled itself out), so the page-specific code below relies on those. -->
    <script>
    (function() {
        var currentFilter = '';
        var currentSort = 'order';

        function applyFilterAndSort() {
            var q = ($('#programSearch').val() || '').toLowerCase().trim();
            var filter = currentFilter.toLowerCase();
            var sort = currentSort;
            var $cards = $('.js-program-card');
            var $visible = $cards.filter(function() {
                var search = ($(this).data('search') || '').toLowerCase();
                var tags = ($(this).data('tags') || '').toLowerCase();
                var matchSearch = !q || search.indexOf(q) !== -1 || tags.indexOf(q) !== -1;
                var matchTag = !filter || tags.indexOf(filter) !== -1;
                return matchSearch && matchTag;
            });
            if (sort === 'title' && $visible.length) {
                var $parent = $cards.first().parent();
                var sorted = $visible.get().sort(function(a, b) {
                    var ta = ($(a).data('title') || '').toLowerCase();
                    var tb = ($(b).data('title') || '').toLowerCase();
                    return ta.localeCompare(tb);
                });
                $(sorted).appendTo($parent);
            }
            $cards.hide();
            $visible.show();
        }

        $(document).on('click', '.js-filter-tag', function() {
            $('.js-filter-tag').removeClass('active');
            $(this).addClass('active');
            currentFilter = $(this).data('filter') || '';
            applyFilterAndSort();
        });
        $(document).on('click', '.js-filter-tag-box', function() {
            currentFilter = $(this).data('filter') || '';
            $('.js-filter-tag').removeClass('active').filter('[data-filter="' + currentFilter + '"]').addClass('active');
            if (!currentFilter) $('.js-filter-tag[data-filter=""]').addClass('active');
            applyFilterAndSort();
        });
        $(document).on('click', '.js-sort-tag', function() {
            $('.js-sort-tag').removeClass('active');
            $(this).addClass('active');
            currentSort = $(this).data('sort') || 'order';
            applyFilterAndSort();
        });
        $('#programSearch').on('input', applyFilterAndSort);

        $(document).on('click', '.js-save-program', function(e) {
            e.preventDefault();
            var $icon = $(this).find('i');
            var $iconParent = $(this).closest('.sop-heart-icon');
            var programId = $(this).data('program-id');
            if (!programId) return;
            var isRed = $icon.hasClass('text-red');
            var newSaved = !isRed;
            if (newSaved) {
                $icon.removeClass('text-black').addClass('text-red');
                $iconParent.attr('title', 'Unsave');
            } else {
                $icon.removeClass('text-red').addClass('text-black');
                $iconParent.attr('title', 'Save');
            }
            $.post('<?= base_url('Cvreadyprogram/toggle_save') ?>', { program_id: programId })
                .done(function(res) {
                    if (res && typeof res === 'object' && res.success) {
                        if (res.saved) {
                            $icon.removeClass('text-black').addClass('text-red');
                            $iconParent.attr('title', 'Unsave');
                        } else {
                            $icon.removeClass('text-red').addClass('text-black');
                            $iconParent.attr('title', 'Save');
                        }
                    } else if (res && typeof res === 'object' && res.success === false) {
                        if (isRed) { $icon.removeClass('text-black').addClass('text-red'); $iconParent.attr('title', 'Unsave'); }
                        else { $icon.removeClass('text-red').addClass('text-black'); $iconParent.attr('title', 'Save'); }
                        if (res.message) alert(res.message);
                    }
                })
                .fail(function() {
                });
        });

        // Save / unsave courses in the "Most Wanted Course" picks section
        $(document).on('click', '.js-save-course', function(e) {
            e.preventDefault();
            var $icon = $(this).find('i');
            var $iconParent = $(this).closest('.sop-heart-icon');
            var courseId = $(this).data('course-id');
            if (!courseId) return;
            var isRed = $icon.hasClass('text-red');
            if (!isRed) {
                $icon.removeClass('text-black').addClass('text-red');
                $iconParent.attr('title', 'Unsave');
            } else {
                $icon.removeClass('text-red').addClass('text-black');
                $iconParent.attr('title', 'Save');
            }
            $.post('<?= base_url('Saved/toggle_save_course') ?>', { course_id: courseId })
                .done(function(res) {
                    if (res && typeof res === 'object' && res.success) {
                        if (res.saved) {
                            $icon.removeClass('text-black').addClass('text-red');
                            $iconParent.attr('title', 'Unsave');
                        } else {
                            $icon.removeClass('text-red').addClass('text-black');
                            $iconParent.attr('title', 'Save');
                        }
                    } else if (res && typeof res === 'object' && res.success === false) {
                        if (isRed) { $icon.removeClass('text-black').addClass('text-red'); $iconParent.attr('title', 'Unsave'); }
                        else { $icon.removeClass('text-red').addClass('text-black'); $iconParent.attr('title', 'Save'); }
                        if (res.message) alert(res.message);
                    }
                })
                .fail(function() {
                });
        });
    })();
    </script>
    <!-- drawer open/close (openDrawer/closeDrawer) is defined once in footer.php -->
</body>

</html>