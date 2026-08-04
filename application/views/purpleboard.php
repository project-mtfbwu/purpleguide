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
        /* Wishlist heart: outline + grey by default; filled + red only when saved */
        .purpleboard-course-card .btn-saved:not(.saved) { color: #333 !important; }
        .purpleboard-course-card .btn-saved.saved { color: #EB0801 !important; }
        .purpleboard-course-card .btn-saved-outline { color: #333 !important; }

        /* #weeklywall: clamp long titles with a Read more toggle instead of scrolling the card */
        #weeklywall .box-style-3 .box-border { height: auto; overflow: visible; }
        #weeklywall .wall-title {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            overflow: hidden;
        }
        #weeklywall .wall-title.is-expanded { -webkit-line-clamp: unset; line-clamp: unset; }
        #weeklywall .wall-readmore {
            display: none;
            margin: 4px 0 8px 10px;
            padding: 0;
            border: 0;
            background: none;
            color: #201C1D;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
        }
        #weeklywall .wall-readmore.is-visible { display: inline-block; }
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
    <section class="pt-0 about-section half-section overlap-height position-relative minus-5 mobile-scholarship-cart mobile-ml-80">
        <div class="container overlap-gap-section p-0">
            <div class="row justify-content-center">

                <div class="w-611px">
                    <div class="m-auto text-center mobile-text-start mobile-w-85">
                        <h1 class="text-black fw-500 fs-75 fnt-family pt-0 mb-7 mobile-fs-30 mobile-lh-full mobile-mb-0 mobile-pb-2 mobile-w-full">#purpleboard</h1>
                        <p class="mb-0 lh-24 fs-17 text-black w-90 text-start m-auto mobile-m-0 mobile-fs-14 mobile-lh-20">Here you’ll find all the important openings
                            you need to know. Check out
                            scholarships, discounts, and special perks before they close. Act early so you don’t miss
                            your chance. Stay updated and make the most of every opportunity.</p>
                    </div>
                    <div class="w-100 m-auto">
                        <div class="search-box flex-group-icon w-100">
                            <input type="search" class="from-control" placeholder="Search Programs Here">
                            <i class="bi bi-search"></i>
                        </div>

                    </div>

                </div>

            </div>
      </div>
    </section>
    <!-- AboutUs -->
    <section class="pt-0 saved-list-pgs board-list-pgs half-section overlap-height position-relative overflow-hidden">
        <div class="w-990px m-auto overlap-gap-section p-0">
            <div class="row align-items-start justify-content-md-start mobile-row-0" id="purpleboardCourses">
                <?php
                $saved_ids = isset($saved_course_ids) ? $saved_course_ids : [];
                // Admin uploads live in the admin app's `assets/images/` folder.
                // Prefer the configured admin_base_url (e.g. https://purpleguide.study/pgs_admin/);
                // fall back to deriving it from base_url only if that config is missing.
                $admin_base = $this->config->item('admin_base_url');
                if (!empty($admin_base)) {
                    $admin_assets_images_base = rtrim($admin_base, '/') . '/assets/images/';
                } else {
                    $base_url_no_slash = rtrim(base_url(), '/');
                    if (preg_match('#/pgs/?$#', $base_url_no_slash)) {
                        $admin_assets_images_base = preg_replace('#/pgs/?$#', '/pgs_admin', $base_url_no_slash) . '/assets/images/';
                    } else {
                        $admin_assets_images_base = $base_url_no_slash . '/pgs_admin/assets/images/';
                    }
                }
                if (empty($courses)): ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted mb-0">No courses available yet. Courses added in admin will appear here.</p>
                    </div>
                <?php else:
                    foreach ($courses as $c):
                        $img_src = !empty($c->image1) ? ($admin_assets_images_base . $c->image1) : base_url('assets/img/saved_1.jpg');
                        $tags_arr = !empty($c->tags) ? preg_split('/[\s,#]+/', trim($c->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                        $is_saved = in_array((int)$c->id, $saved_ids);
                        $e_ts = !empty($c->e_date) ? strtotime($c->e_date) : 0;
                        $is_closed = ($e_ts > 0 && $e_ts < time());
                ?>
                <div class="explore-section m-auto purpleboard-course-card" data-course-id="<?= (int)$c->id ?>" data-search-text="<?= htmlspecialchars(strtolower($c->product_name . ' ' . (isset($c->category_name) ? $c->category_name : '') . ' ' . $c->tags)) ?>">
                    <?php if ($is_closed): ?>
                    <div class="closed-status">
                    <?php endif; ?>
                    <div class="cardbox">
                        <div class="w-30 cardbox-left">
                            <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($c->product_name) ?>" onerror="this.src='<?= base_url('assets/img/saved_1.jpg') ?>'">
                            <?php if (!$is_closed): ?>
                            <div class="cardbox-tag">
                                <img src="<?= base_url('assets/img/red-hours.gif') ?>" alt="Filling Fast">
                                Filling Fast
                            </div>
                            <?php endif; ?>
                            <div class="cardbox-logo purple-dot-1">
                                <img src="<?= base_url('assets/img/saved_logo.jpg') ?>" width="80" alt="">
                            </div>
                        </div>
                        <div class="w-30 cardbox-middle">
                            <h3><?= htmlspecialchars($c->product_name) ?></h3>
                            <?php if (!empty($c->duration)): ?>
                            <div>
                                <div class="cardbox-highlight">Duration: <br /><span class=""><?= htmlspecialchars($c->duration) ?></span></div>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($c->pekrs)): ?>
                            <div class="tag-perks">Perks</div>
                            <div>
                                <span class="cardbox-scholarship"><?= nl2br(htmlspecialchars($c->pekrs)) ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($tags_arr)): ?>
                            <div class="cardbox-tags">
                                <?php foreach ($tags_arr as $t): $t = trim($t); if ($t === '') continue; ?>
                                <span><?= (strpos($t, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($t) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="w-30 cardbox-right">
                            <?php if ($logged_in): ?>
                            <button type="button" class="btn btn-saved js-save-course <?= $is_saved ? 'saved' : '' ?>" data-course-id="<?= (int)$c->id ?>" title="<?= $is_saved ? 'Unsave' : 'Save' ?>">
                                <i class="bi <?= $is_saved ? 'bi-suit-heart-fill text-red' : 'bi-suit-heart' ?>"></i>
                            </button>
                            <?php else: ?>
                            <a href="<?= base_url('Login') ?>" class="btn btn-saved btn-saved-outline" title="Login to save"><i class="bi bi-suit-heart"></i></a>
                            <?php endif; ?>
                            <div class="d-flex gap-4">
                                <div class="w-108px">
                                    <div class="green-bg-box">
                                        <h4 class="mb-0"><?= $is_closed ? 'Closed' : 'Dates' ?></h4>
                                        <div class="bg-black">
                                            <?php if ($is_closed): ?>
                                            <h5 class="mb-0 px-1">Closed</h5>
                                            <?php elseif (!empty($c->e_date)): ?>
                                            <h5 class="mb-0 px-1"><?= htmlspecialchars($c->e_date) ?></h5>
                                            <?php else: ?>
                                            <h5 class="mb-0 px-1">Check With US</h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($c->e_date)): ?>
                                    <p class="mb-0 fs-12 lh-16">*<?= htmlspecialchars($c->e_date) ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="w-50 text-start">
                                    <img src="<?= base_url('assets/img/qr.png') ?>" class="w-40" alt="" />
                                    <a href="<?= base_url('Programsfull/program/' . (int)$c->id) ?>" class="bg-black fw-500 fs-17 mt-2 text-white border-radius-6px border-none px-3 custom-width-pad d-inline-block text-decoration-none">Learn More</a>
                                </div>
                            </div>
                            <?php if (!empty($c->file)): ?>
                            <a href="<?= htmlspecialchars($admin_assets_images_base . $c->file) ?>" download class="btn btn-download"><i class="bi bi-download"></i></a>
                            <?php else: ?>
                            <button type="button" class="btn btn-download"><i class="bi bi-download"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($is_closed): ?>
                        <div class="closed-box-status">
                            <div class="closed-box">Closed – <?= htmlspecialchars(isset($c->e_date) ? $c->e_date : '') ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>
    <!-- END AboutUs -->

    <?php if (!empty($weekly_wall)): ?>
    <section id="weeklywall" style="scroll-margin-top: 140px;" class="pt-0 half-section overlap-height position-relative overflow-hidden mobile-weeklywall">
        <div class="col-lg-11 m-auto overlap-gap-section p-0">
            <div class="row align-items-start justify-content-md-start">
                <h3 class="fnt-family text-black bg-light-greeen border-radius-10px d-inline-block fs-75">#weeklywall</h3>
                <div class="flex-wrap">
                    <?php
                    $weekly_wall_images_base = rtrim(base_url(), '/') . '/pgs_admin/assets/images/';
                    foreach ($weekly_wall as $wall):
                        $wall_title = strip_tags($wall->product_name);
                        $wall_image = !empty($wall->image1)
                            ? $weekly_wall_images_base . rawurlencode(basename($wall->image1))
                            : base_url('assets/img/yellow-box-img.png');
                    ?>
                    <div class="box-style-3">
                        <div class="mini-box">
                            <img src="<?= base_url('assets/img/clip.png') ?>" alt="" />
                        </div>
                        <div class="box-border">
                            <div class="ht-150px">
                                <img src="<?= htmlspecialchars($wall_image, ENT_QUOTES, 'UTF-8') ?>"
                                    class="w-100 ht-100o object-fit-cover"
                                    alt="<?= htmlspecialchars($wall_title, ENT_QUOTES, 'UTF-8') ?>" />
                            </div>
                            <p class="w-90 text-black fs-16 lh-20 mt-3 mb-0 wall-title"><?= htmlspecialchars($wall_title, ENT_QUOTES, 'UTF-8') ?></p>
                            <button type="button" class="wall-readmore" aria-expanded="false">Read more</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>


    <section class="">
        <div class="container">
            <div class="w-70 m-auto">
                <div
                    >
                    <h5 class="mb-0 text-black fs-20 mobile-fs-16 mobile-pb-2">Simple, clear, useful</h5>
                    <p class="text-blac lh-25 fs-17 w-40 mobile-w-full mobile-fs-14 mobile-lh-full">Using our experience, feedback from students
                        who made it, and insights from thousands of real
                        applications—we’ve built an approach that puts
                        you, the student, at the center ❤️</p>
                </div>
                <div class="row justify-content-end">
                    <div class="col-lg-7 d-flex gap-5 align-items-center mobile-avatar-info"
                        >
                        <div class="wiriter-info">
                            <h5 class="writter-name">Build your own lane</h5>
                            <p class="text-black text-center fs-15 lh-22">Need to figure something out or have a
                                question? Don’t
                                hesitate, reach out to our Help Hub!</p>
                        </div>
                        <div class="author-box-img">
                            <img src="./assets/img/author.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<?php $this->load->view('footer'); ?>

<!--<div class="footer-bg">-->
<!--    <section class="footer">-->
<!--        <div class="flot-img">-->
<!--            <img src="./assets/img/top.png" />-->
<!--        </div>-->
        <!-- <footer> -->
<!--        <div class="container pt-5 pb-8">-->
<!--            <div class="row justify-content-center">-->
<!--                <div class="col-lg-2">-->
<!--                    <div class="card-bg-pruple text-center w-210px">-->
<!--                        <h4 class="mb-0 fs-20 lh-full mt-7">Currently studying? Become a mentor <br/> and help students.</h4>-->
<!--                        <button type="button" class="btn btn-join">Join The Team!</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-5 offset-1">-->
<!--                    <div class="yellow-bg">-->
<!--                        General Enquiries-->
<!--                    </div>-->
<!--                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-2">-->
<!--                        <img src="./assets/img/mail.png" width="25px"> hello@purpleguide.study-->
<!--                    </div>-->
<!--                    <div class="yellow-bg mt-3">-->
<!--                        General Enquiries-->
<!--                    </div>-->
<!--                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-3">-->
<!--                        <img src="./assets/img/mail.png" width="25px"> connect@purpleguide.study-->
<!--                    </div>-->
<!--                    <div class="social-flex mt-5 mb-3 d-flex align-items-center gap-3">-->
<!--                        <img src="./assets/img/right.png" />-->
<!--                        <h6 class="mb-0 text-white fs-20">Our Socials</h6>-->
<!--                        <div class="social-img d-flex align-items-center gap-3">-->
<!--                            <a href="#">-->
<!--                                <img src="./assets/img/instagram.png">-->
<!--                            </a>-->
<!--                            <a href="#">-->
<!--                                <img src="./assets/img/facebook.png">-->
<!--                            </a>-->
<!--                            <a href="#">-->
<!--                                <img src="./assets/img/threads.png">-->
<!--                            </a>-->
<!--                            <a href="#">-->
<!--                                <img src="./assets/img/youtube.png">-->
<!--                            </a>-->
<!--                            <a href="#">-->
<!--                                <img src="./assets/img/linkdln.png">-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <img src="./assets/img/left.png" />-->
<!--                    </div>-->
                    
<!--                    <div class="terms-content mt-6">-->
<!--                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Privacy Policy</a>-->
<!--                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Terms & Conditions</a>-->
<!--                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Refund Policy</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3">-->
<!--                    <div class="fs-14 lh-full mb-5 text-white">-->
<!--                        <span class="fs-15"> For</span><br />-->
<!--                        Feedback, <br /> Escalations <br /> & Complaints-->
<!--                    </div>-->
<!--                    <div class="d-flex gap-2 fs-20 text-white mt-2 align-items-start">-->
<!--                        <img src="./assets/img/mail.png" width="25px">-->
<!--                        <div>-->
<!--                            <span class="" style="white-space:nowrap;">hey@purpleguide.study</span>-->
<!--                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">We’re a project-first team, and we try to sort out-->
<!--                                complaints within 7 business days.-->
<!--                                Good vibes or tough love: your feedback actually helps us level up.</p>-->
<!--                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">All emails sent to this address will stay-->
<!--                                anonymous—unless we spot any signs of misuse or suspicious activity.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            </div>-->
            <!-- </footer> -->
<!--    </section>-->

<!--    <section class="copyrght">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="d-flex justify-content-center">-->
<!--                        <h4 class="w-20 text-white">#PGS</h4>-->
<!--                        <div class="d-flex align-items-center gap-4">-->
<!--                            <h4 class="text-white fs-24  fw-700 lh-28">(For Mentors) Help Students Choose <br/>-->
<!--                                Smarter – Earn with Our Referral Program</h4>-->
<!--                            <h4 class="text-white fw-700 fs-24 lh-28">(For Universities) Give Your Students a <br/>-->
<!--                                Global Edge – Partner with #PGS</h4>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <!-- end section -->
<!--</div>-->


    <!-- start scroll progress -->
<!--    <div class="scroll-progress d-none d-xxl-block">-->
<!--        <a href="#" class="scroll-top" aria-label="scroll">-->
<!--            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>-->
<!--        </a>-->
<!--    </div>-->
    <!-- end scroll progress -->
    <!-- javascript libraries -->
<!--    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>-->
<!--    <script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>-->
<!--    <script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>-->
    <script>
    (function() {
        // Search filter
        $('#purpleboardSearch').on('input', function() {
            var q = $(this).val().toLowerCase().trim();
            $('.purpleboard-course-card').each(function() {
                var text = $(this).data('search-text') || '';
                $(this).toggle(!q || text.indexOf(q) !== -1);
            });
        });
        // Save/unsave course – optimistic UI: update heart immediately
        $(document).on('click', '.js-save-course', function() {
            var $btn = $(this);
            var $icon = $btn.find('i');
            var courseId = $btn.data('course-id');
            if (!courseId) return;
            var wasSaved = $btn.hasClass('saved');
            var newSaved = !wasSaved;
            if (newSaved) {
                $btn.addClass('saved').attr('title', 'Unsave');
                $icon.removeClass('bi-suit-heart').addClass('bi-suit-heart-fill text-red');
            } else {
                $btn.removeClass('saved').attr('title', 'Save');
                $icon.removeClass('bi-suit-heart-fill text-red').addClass('bi-suit-heart');
            }
            $.post('<?= base_url('Saved/toggle_save_course') ?>', { course_id: courseId })
                .done(function(res) {
                    if (res && typeof res === 'object' && res.success) {
                        if (res.saved) {
                            $btn.addClass('saved').attr('title', 'Unsave');
                            $icon.removeClass('bi-suit-heart').addClass('bi-suit-heart-fill text-red');
                        } else {
                            $btn.removeClass('saved').attr('title', 'Save');
                            $icon.removeClass('bi-suit-heart-fill text-red').addClass('bi-suit-heart');
                        }
                    } else if (res && typeof res === 'object' && res.success === false) {
                        if (wasSaved) { $btn.addClass('saved'); $icon.removeClass('bi-suit-heart').addClass('bi-suit-heart-fill text-red'); $btn.attr('title', 'Unsave'); }
                        else { $btn.removeClass('saved'); $icon.removeClass('bi-suit-heart-fill text-red').addClass('bi-suit-heart'); $btn.attr('title', 'Save'); }
                        if (res.message) alert(res.message);
                    }
                })
                .fail(function() {
                });
        });
        // #weeklywall: only offer Read more on titles that are actually clamped
        function refreshWallReadMore() {
            $('#weeklywall .wall-title').each(function() {
                if ($(this).hasClass('is-expanded')) return;
                $(this).next('.wall-readmore')
                    .toggleClass('is-visible', this.scrollHeight > this.clientHeight + 1);
            });
        }
        $(refreshWallReadMore);
        $(window).on('load resize', refreshWallReadMore);
        $(document).on('click', '#weeklywall .wall-readmore', function() {
            var expanded = $(this).prev('.wall-title').toggleClass('is-expanded').hasClass('is-expanded');
            $(this).text(expanded ? 'Read less' : 'Read more').attr('aria-expanded', expanded);
        });
    })();
    </script>
</body>

</html>