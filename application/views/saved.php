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

    <!-- Hero: user info when logged in -->
    <section class="pt-0 mobile-student-cart about-section half-section overlap-height position-relative overflow-hidden">
        <div class="overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">
                <div class="w-729px p-0">
                    <div class="card-box-avatar">
                        <div class="avatar-info position-relative">
                            <div class="avatar-img">
                                <?php if (!empty($user_image)): ?>
                                <img src="<?= base_url('assets/images/' . $user_image) ?>" alt="" class="border-radius-6px" onerror="this.src='<?= base_url('assets/img/default-avatar.png') ?>'">
                                <?php else: ?>
                                <img src="<?= base_url('assets/img/default-avatar.png') ?>" alt="" class="border-radius-6px">
                                <?php endif; ?>
                                <div class="avatar_name">
                                    <?php if (!empty($logged_in)): ?>
                                    <h5 class="mb-3"><?= htmlspecialchars(!empty($user_name) ? $user_name : 'Member') ?></h5>
                                    <?php if (!empty($user_email)): ?>
                                    <span><?= htmlspecialchars($user_email) ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($user_id)): ?>
                                    <span>id: <?= (int)$user_id ?></span>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <h5 class="mb-3">Your Saved Picks</h5>
                                    <span>Login to see your saved programs and courses</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="title-info">
                                <h5 class="mb-0">#purplePremium</h5>
                                <h6 class="mb-0">Saved</h6>
                            </div>
                        </div>
                        <div class="avatar-heading-right-box">
                            <h4 class="mb-0">#SAVED</h4>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="pt-0 half-section overlap-height position-relative overflow-hidden">
        <div class="w-990px m-auto overlap-gap-section p-0">

            <div class="w-100">
                <div class="">

                    <h4 class="text-center mb-4 text-black fw-500 fs-45 fw-500"><i
                            class="bi bi-suit-heart-fill text-red-heart fs-25"></i> Your Saved Picks</h4>

                    <?php if (empty($logged_in)): ?>
                        <p class="text-center text-muted">Please <a href="<?= base_url('Login') ?>">login</a> to see your saved programs and courses.</p>
                    <?php elseif (empty($saved_programs) && empty($saved_courses)): ?>
                        <p class="text-center text-muted">No saved items yet. <a href="<?= base_url('cvreadyprogram') ?>">Discover Our Programs</a> or <a href="<?= base_url('purpleboard') ?>">#purpleboard</a> and save your favourites.</p>
                    <?php else: ?>
                        <?php if (!empty($saved_courses)): ?>
                        <h5 class="text-black fw-500 fs-22 mb-3">Saved Courses <small class="text-muted">(from #purpleboard)</small></h5>
                        <div class="d-flex flex-wrap align-items-start gap-3 justify-content-center mb-5 m-justify-start">
                            <?php foreach ($saved_courses as $c):
                                $c_img = !empty($c->image1) ? base_url('admin/assets/images/' . $c->image1) : base_url('assets/img/saved_1.jpg');
                                $c_tags = !empty($c->tags) ? preg_split('/[\s,#]+/', trim($c->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                            ?>
                            <div class="w-304px position-relative p-0 m-0 mb-2 saved-course-card" data-course-id="<?= (int)$c->id ?>">
                                <div class="sop-card-unique">
                                    <div class="sop-image-wrapper">
                                        <img src="<?= $c_img ?>" alt="<?= htmlspecialchars($c->product_name) ?>" onerror="this.src='<?= base_url('assets/img/saved_1.jpg') ?>'" style="width:100%; max-height:180px; object-fit:cover;">
                                        <div class="sop-heart-icon js-unsave-course text-red" data-course-id="<?= (int)$c->id ?>" role="button" title="Remove from saved">
                                            <i class="bi bi-heart-fill text-red"></i>
                                        </div>
                                    </div>
                                    <div class="sop-content text-start w-95 p-3">
                                        <div class="sop-title sop-title fnt-family fw-500 fs-26 lh-26 w-100 text-limit-03"><?= htmlspecialchars($c->product_name) ?></div>
                                        <?php if (!empty($c->prod_sub_name)): ?>
                                        <div class="sop-subtext fs-12 lh-16 w-100 text-limit-3"><?= nl2br(htmlspecialchars($c->prod_sub_name)) ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($c->duration)): ?>
                                        <div class="fs-12 text-muted mt-3 mb-3">Duration: <?= htmlspecialchars($c->duration) ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($c_tags)): ?>
                                        <div class="sop-tags mt-1 mb-0">
                                            <?php foreach ($c_tags as $t): $t = trim($t); if ($t === '') continue; ?>
                                            <span class="sop-tag"><?= (strpos($t, '#') === 0 ? '' : '#') ?><?= htmlspecialchars($t) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-space p-2">
                                        <?php if (!empty($c->file)): ?>
                                                                                <a href="<?= base_url('Programsfull/program/' . (int)$c->id) ?>" class="sop-learn-btn lh-25">Learn More</a>

                                        <?php endif; ?>
                                        <a href="<?= base_url('purpleboard') ?>" class="sop-learn-btn lh-25">#purpleboard</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($saved_programs)): ?>
                        <h5 class="text-black fw-500 fs-22 mb-3">Saved Programs <small class="text-muted">(from Discover Our Programs)</small></h5>
                        <div class="d-flex flex-wrap align-items-start gap-3 justify-content-center mb-5 m-justify-start">
                            <?php foreach ($saved_programs as $prog):
                                $img_src = !empty($prog->image) ? base_url('assets/img/' . $prog->image) : base_url('assets/img/cut-college-img.png');
                                $tags_arr = !empty($prog->tags) ? preg_split('/[\s,#]+/', trim($prog->tags), -1, PREG_SPLIT_NO_EMPTY) : [];
                            ?>
                            <div class="w-304px position-relative p-0 m-0 mb-2 saved-program-card" data-program-id="<?= (int)$prog->id ?>">
                                <div class="sop-card-unique">
                                    <?php if (!empty($prog->top_label)): ?>
                                    <div class="sop-top-label">
                                        <img src="<?= base_url('assets/img/stars.gif') ?>" alt="">
                                        <?= htmlspecialchars($prog->top_label) ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($prog->badge_text)): ?>
                                    <div class="sop-start-free"><?= htmlspecialchars($prog->badge_text) ?></div>
                                    <?php endif; ?>
                                    <div class="sop-image-wrapper">
                                        <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($prog->title) ?>" onerror="this.src='<?= base_url('assets/img/cut-college-img.png') ?>'">
                                        <div class="sop-heart-icon js-unsave-program text-red" data-program-id="<?= (int)$prog->id ?>" role="button" title="Remove from saved">
                                            <i class="bi bi-heart-fill text-red"></i>
                                        </div>
                                    </div>
                                    <div class="sop-content text-start w-80">
                                        <div class="sop-title sop-title fnt-family fw-500 fs-26 lh-26 w-100 text-limit-03"><?= htmlspecialchars($prog->title) ?></div>
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
                                        <?php if (!empty($prog->learn_more_url)): ?>
                                        <a href="<?= htmlspecialchars($prog->learn_more_url) ?>" target="_blank" rel="noopener" class="sop-learn-btn lh-25">Learn More</a>
                                        <?php else: ?>
                                        <span class="sop-learn-btn lh-25">Learn More</span>
                                        <?php endif; ?>
                                        <?php if (!empty($prog->close_date_text)): ?>
                                        <div class="sop-close-date border-radius-0px"><?= nl2br(htmlspecialchars($prog->close_date_text)) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
    <!-- END AboutUs -->

</div>


    <!-- Footer -->
<div class="footer-bg">
    <section class="footer">
        <div class="flot-img">
            <img src="./assets/img/top.png" />
        </div>
        <!-- <footer> -->
        <div class="container pt-5 pb-8">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <div class="card-bg-pruple text-center w-210px">
                        <h4 class="mb-0 fs-20 lh-full mt-7">Currently studying? Become a mentor <br/> and help students.</h4>
                        <button type="button" class="btn btn-join">Join The Team!</button>
                    </div>
                </div>
                <div class="col-lg-5 offset-1">
                    <div class="yellow-bg">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-2">
                        <img src="./assets/img/mail.png" width="25px"> hello@purpleguide.study
                    </div>
                    <div class="yellow-bg mt-3">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-3">
                        <img src="./assets/img/mail.png" width="25px"> connect@purpleguide.study
                    </div>
                    <div class="social-flex mt-5 mb-3 d-flex align-items-center gap-3">
                        <img src="./assets/img/right.png" />
                        <h6 class="mb-0 text-white fs-20">Our Socials</h6>
                        <div class="social-img d-flex align-items-center gap-3">
                            <a href="#">
                                <img src="./assets/img/instagram.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/facebook.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/threads.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/youtube.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/linkdln.png">
                            </a>
                        </div>
                        <img src="./assets/img/left.png" />
                    </div>
                    
                    <div class="terms-content mt-6">
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Privacy Policy</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Terms & Conditions</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Refund Policy</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fs-14 lh-full mb-5 text-white">
                        <span class="fs-15"> For</span><br />
                        Feedback, <br /> Escalations <br /> & Complaints
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 align-items-start">
                        <img src="./assets/img/mail.png" width="25px">
                        <div>
                            <span class="" style="white-space:nowrap;">hey@purpleguide.study</span>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">We’re a project-first team, and we try to sort out
                                complaints within 7 business days.
                                Good vibes or tough love: your feedback actually helps us level up.</p>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">All emails sent to this address will stay
                                anonymous—unless we spot any signs of misuse or suspicious activity.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- </footer> -->
    </section>

    <section class="copyrght">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center">
                        <h4 class="w-20 text-white">#PGS</h4>
                        <div class="d-flex align-items-center gap-4">
                            <h4 class="text-white fs-24  fw-700 lh-28">(For Mentors) Help Students Choose <br/>
                                Smarter – Earn with Our Referral Program</h4>
                            <h4 class="text-white fw-700 fs-24 lh-28">(For Universities) Give Your Students a <br/>
                                Global Edge – Partner with #PGS</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>


    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>
    <script>
    $(document).on('click', '.js-unsave-program', function() {
        var $card = $(this).closest('.saved-program-card');
        var programId = $(this).data('program-id');
        if (!programId) return;
        $card.fadeOut(300);
        $.ajax({
            url: '<?= base_url('Saved/toggle_save') ?>',
            type: 'POST',
            data: { program_id: programId },
            dataType: 'json'
        }).done(function(res) {
            if (res && res.success && !res.saved) {
                $card.remove();
            } else {
                $card.show();
            }
        }).fail(function() {
            $card.show();
        });
    });
    $(document).on('click', '.js-unsave-course', function() {
        var $card = $(this).closest('.saved-course-card');
        var courseId = $(this).data('course-id');
        if (!courseId) return;
        $card.fadeOut(300);
        $.ajax({
            url: '<?= base_url('Saved/toggle_save_course') ?>',
            type: 'POST',
            data: { course_id: courseId },
            dataType: 'json'
        }).done(function(res) {
            if (res && res.success && !res.saved) {
                $card.remove();
            } else {
                $card.show();
            }
        }).fail(function() {
            $card.show();
        });
    });
    </script>
    
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