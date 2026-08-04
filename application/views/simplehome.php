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

    <script>
        // Define these early so the CTA + Apply works even if later scripts error out.
        window.openPremiumModal = window.openPremiumModal || function () {
            var el = document.getElementById('premiumModal');
            if (!el) return;
            el.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };
        window.closePremiumModal = window.closePremiumModal || function () {
            var el = document.getElementById('premiumModal');
            if (!el) return;
            el.style.display = 'none';
            document.body.style.overflow = '';
        };
        window.submitPremiumApplication = window.submitPremiumApplication || function (btn) {
            try {
                var originalText = btn && btn.textContent ? btn.textContent : 'Apply Now';
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Submitting...';
                }
                fetch('<?= base_url("Home/apply_purplepremium") ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (data && data.success) {
                        if (btn) {
                            btn.disabled = false;
                            btn.textContent = 'Applied Successfully!';
                            btn.style.background = '#28a745';
                        }
                        if (window.Swal && Swal.fire) {
                            Swal.fire({
                                title: 'Application Submitted!',
                                html: '<p class="fnt-family fs-18">' + data.message + '</p><p class="fnt-family fs-16 mt-3">We\\'ll review your application and get back to you soon.</p>',
                                icon: 'success',
                                confirmButtonColor: '#2489FF',
                                confirmButtonText: 'Got it!',
                                customClass: { popup: 'fnt-family' },
                                allowOutsideClick: false
                            }).then(function () {
                                window.closePremiumModal && window.closePremiumModal();
                                location.reload();
                            });
                        } else {
                            alert(data.message || 'Application submitted successfully');
                            window.closePremiumModal && window.closePremiumModal();
                            location.reload();
                        }
                    } else {
                        var msg = (data && data.message) ? data.message : 'Something went wrong';
                        if (window.Swal && Swal.fire) {
                            Swal.fire({
                                title: 'Info',
                                html: '<p class="fnt-family fs-18">' + msg + '</p>',
                                icon: 'info',
                                confirmButtonColor: '#2489FF',
                                customClass: { popup: 'fnt-family' }
                            });
                        } else {
                            alert(msg);
                        }
                        if (btn) {
                            btn.disabled = false;
                            btn.textContent = originalText;
                        }
                    }
                })
                .catch(function (e) {
                    console.error(e);
                    if (window.Swal && Swal.fire) {
                        Swal.fire({
                            title: 'Oops!',
                            html: '<p class="fnt-family fs-18">Something went wrong. Please try again.</p>',
                            icon: 'error',
                            confirmButtonColor: '#2489FF',
                            customClass: { popup: 'fnt-family' }
                        });
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                });
            } catch (e) {
                console.error(e);
            }
        };
    </script>

    <div class="wrapper-content">

        <!-- AboutUs -->
    <section class="pt-0 mobile-student-cart minus-2 about-section half-section overlap-height position-relative overflow-hidden">
        <div class="overlap-gap-section p-0">
            <div class="row align-items-center justify-content-md-center">

                <div class="w-729px p-0">
                    <div class="card-box-avatar">
                        <div class="avatar-info position-relative">
                            <div class="avatar-img">
                                <img src="<?= isset($user) && isset($user->image1) && $user->image1 ? base_url('assets/images/'.$user->image1) : base_url('assets/img/default-avatar.png') ?>" alt="" class="border-radius-6px">
                                <!--<div class="choose-avatar-text">-->
                                <!--    <label for="chooseImg">-->
                                <!--        <img src="./assets/img/edit-03.png" />-->
                                <!--    </label>-->
                                <!--    <input type="file" id="chooseImg" accept="image/*" class="d-none">-->
                                <!--</div>-->
                                <div class="avatar_name">
                                    <h5 class="mb-3"><?= isset($user) && isset($user->name) && !empty($user->name) ? htmlspecialchars($user->name) : 'User' ?></h5>
                                    <span><?= isset($user) && isset($user->email) ? '@' . explode('@', htmlspecialchars($user->email))[0] : '@user' ?></span>
                                    <span>id: <?= isset($user) && isset($user->id) ? $user->id : '' ?></span>
                                </div>
                            </div>
                            <div class="title-info">
                                <h5 class="mb-0">#purplePremium</h5>
                                <h6 class="mb-0">stem PATHWAY</h6>
                            </div>
                        </div>
                        <?php
                        $sh_logged_in = isset($user) && !empty($user);
                        $sh_premium = isset($premium_status) ? $premium_status : null;
                        ?>
                        <div class="avatar-heading-right-box justify-content-start w-200px ms-6" style="<?= ($sh_logged_in && $sh_premium !== 'approved' && $sh_premium !== null) ? 'padding-left: 10px;' : '' ?>">
                            <?php if ($sh_logged_in && $sh_premium === 'approved'): ?>
                                <h4 class="mb-0">#PURPLEPREMIUM</h4>
                            <?php elseif ($sh_logged_in && $sh_premium === 'pending'): ?>
                                <h4 class="mb-0 text-yellow">Already <br/> Applied</h4>
                            <?php else: ?>
                                <?php if ($sh_logged_in): ?>
                                    <h4 class="mb-0" style="cursor: pointer; transition: opacity 0.3s;">
                                        <a href="#" class="premium-unlock-link text-black text-decoration-none" style="display: inline-block;" onclick="return window.ppOpenModal();">
                                            Yet to <br/> Unlock Full <br/> Access
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="mb-0">
                                        <a href="<?= base_url('Login') . '?redirect=' . rawurlencode(uri_string() . '?openPremium=1') ?>" class="text-black text-decoration-none">
                                            Yet to <br/> Unlock Full <br/> Access
                                        </a>
                                    </h4>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
            </div>
    </section>
    
        <?php
                    $pp_user = isset($user) ? $user : null;
                    $pp_logged_in = !empty($pp_user);
                    $pp_premium = isset($premium_status) ? $premium_status : null;
                    ?>
        <!--payment pending-->

        
        <!-- END AboutUs -->
        
        
        <!--payment approved-->
        
        

        
        
          <?php if ($pp_logged_in && $pp_premium === 'approved'): ?>
                              <section class="pt-0 half-section overlap-height position-relative overflow-hidden mobile-pb-0">
            <div class="container overlap-gap-section p-0">
                <div class="row align-items-center justify-content-md-center">

                    <div class="col-lg-8 col-md-12 explore-section">
                        <div class="card card-explore border-color-transparent mobile-m-auto mobile-w-80">

                            <h3 class="mb-3 fnt-family text-center text-black fs-51 mobile-fs-24">welcome to #PGS</h3>
                            <h6 class="m-auto fs-18 lh-full fw-500 mb-3 mobile-fs-14">
                                You’ve just taken the first step toward your study abroad journey and we’re here to walk
                                it
                                with you. From building your <span class="text-red">${roadmap}</span> to guiding you
                                through
                                documents, deadlines, and
                                decisions, consider this your launchpad.
                            </h6>
                            <h6 class="m-auto fs-18 lh-full fw-500 mb-3 mobile-fs-14">
                                Your dashboard’s now your personal HQ track your progress, connect with mentors, and
                                access
                                tools that actually move the needle. Let’s get started.
                            </h6>

                            <h6 class=" fs-18 lh-full fw-500 mb-2 mobile-fs-14">
                                Wishing you the very best, </h6>

                            <h6 class=" fs-18 lh-full fw-500 mb-3 mobile-fs-14">
                              Team #PGS
                            </h6>

                        </div>
                    </div>
                </div>
                </div>
        </section> 
                            
                                <?php if ($pp_logged_in): ?>
                                    <h4 class="mb-0" style="cursor: pointer; transition: opacity 0.3s;">
                                        <a href="#" class="premium-unlock-link text-black text-decoration-none" style="display: inline-block;" onclick="return window.ppOpenModal();">
                                          <section class="pt-0 position-relative mobile-w-80 mobile-m-auto">
            <div class="container overlap-gap-section p-0">
                <div class="row align-items-center justify-content-md-center">

                    <div class="col-lg-8 col-md-12 explore-section">
                        <div class="card card-explore border-color-transparent">
                            <h6 class="mb-5 fs-14 lh-19 mobile-fs-12 mobile-lh-full w-230px mobile-w-60 text-gray-600 mobile-mb-40px" style="margin: 0 0 0 auto;">
                                Choose this if you're exploring your options or aiming for direct entry into top partner
                                universities, we’ll help you make the right move.
                                <img src="./assets/img/down-arrow.png" class="position-absolute flot-arrow-1" />
                            </h6>
                            <h3 class="mb-3 fnt-family text-center text-black fs-51 mobile-fs-24">Explore #PGS</h3>
                            <h5 class="w-520px m-auto ">
                                <!--<span class="fnt-50">“</span>-->
                                <span>
                                    Talk to a mentor or reach out to our <a href="#" class="text-purple"> Help Hub </a>,
                                    we’ll align your goals and get your study
                                    abroad plan moving towards getting an offer letter or admission done.
                                    <!--<span class="fnt-50">”</span>-->
                                </span>
                            </h5>
                            <h3 class="mb-3 fnt-family text-center text-black mt-4 fs-51 mobile-fs-24">OR</h3>
                            <h5 class="w-520px m-auto">
                                <!--<span class="fnt-50">“</span>-->
                                <span>
                                    Going for AIMING for top universities or USMLE, PLAB, AMC, or ?
                                    Join <a href="#"
                                        class="text-purple">#purplePremium </a> for a complete, guided roadmap with expert support from start to admit.
                                    
                                    <!--<span class="fnt-50">”</span>-->
                                </span>
                            </h5>
                            <h6 class="mb-5 w-30 fs-14 lh-19 d-flex mt-5 align-items-center mobile-fs-12 mobile-lh-full mobile-w-60" style="margin: 0 0 0 auto;">
                                <img src="./assets/img/up-arrow.png" class="flot-arrow-2" /> <br />
                                If you’re aiming for top admits or medical pathway and need a peer-driven, full-support
                                system this is for you.
                            </h6>
                        </div>
                    </div>
                </div>
                </div>
        </section>
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <section class="pt-0 position-relative mobile-w-80 mobile-m-auto">
            <div class="container overlap-gap-section p-0">
                <div class="row align-items-center justify-content-md-center">

                    <div class="col-lg-8 col-md-12 explore-section">
                        <div class="card card-explore border-color-transparent">
                            <h6 class="mb-5 fs-14 lh-19 mobile-fs-12 mobile-lh-full w-230px mobile-w-60 text-gray-600 mobile-mb-40px" style="margin: 0 0 0 auto;">
                                Choose this if you're exploring your options or aiming for direct entry into top partner
                                universities, we’ll help you make the right move.
                                <img src="./assets/img/down-arrow.png" class="position-absolute flot-arrow-1" />
                            </h6>
                            <h3 class="mb-3 fnt-family text-center text-black fs-51 mobile-fs-24">Explore #PGS</h3>
                            <h5 class="w-520px m-auto ">
                                <!--<span class="fnt-50">“</span>-->
                                <span>
                                    Talk to a mentor or reach out to our <a href="#" class="text-purple"> Help Hub </a>,
                                    we’ll align your goals and get your study
                                    abroad plan moving towards getting an offer letter or admission done.
                                    <!--<span class="fnt-50">”</span>-->
                                </span>
                            </h5>
                            <h3 class="mb-3 fnt-family text-center text-black mt-4 fs-51 mobile-fs-24">OR</h3>
                            <h5 class="w-520px m-auto">
                                <!--<span class="fnt-50">“</span>-->
                                <span>
                                    Going for AIMING for top universities or USMLE, PLAB, AMC, or ?
                                    Join <a href="#"
                                        class="text-purple">#purplePremium </a> for a complete, guided roadmap with expert support from start to admit.
                                    
                                    <!--<span class="fnt-50">”</span>-->
                                </span>
                            </h5>
                            <h6 class="mb-5 w-30 fs-14 lh-19 d-flex mt-5 align-items-center mobile-fs-12 mobile-lh-full mobile-w-60" style="margin: 0 0 0 auto;">
                                <img src="./assets/img/up-arrow.png" class="flot-arrow-2" /> <br />
                                If you’re aiming for top admits or medical pathway and need a peer-driven, full-support
                                system this is for you.
                            </h6>
                        </div>
                    </div>
                </div>
                </div>
        </section>
                                <?php endif; ?>
                            <?php endif; ?>
        
        
       <!-- Commnet Section -->
        <section class="about-section half-section overlap-height position-relative overflow-hidden pt-13">
            <div class="overlap-gap-section p-0 w-863px m-auto">
                <div class="row align-items-center justify-content-md-center m-0">

                    <div class="col-lg-12 col-md-12 m-0">

                        <div class="card card-comment">
                            <h5>
                                <span class="fnt-50">“</span>
                                <span>
                                   From your first step to your final admit 
                                    or medical pathway — our expert counselors 
                                    guide the entire journey with you.
                                    <span class="fnt-50 dot-flot-1">”</span>
                                </span>
                            </h5>
                            <div class="tag-comment lt-1">
                                <div class="tag-border">
                                    purpleguide.study
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>

        </section>
        <!-- Commnet Section -->

        <section class="pt-0 pb-5">
            <div class="w-863px m-auto">
                <div class="d-flex justify-content-space counter-style-04 mobile-grid mobile-grid-2 full-width-mobile">
                    <div class="w-128px last-paragraph-no-margin text-center sm-mb-40px">
                        <h3 class="d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0 cutsom-count-1">4/5</h3>
                        <p>of our students built a significantly stronger profile after working with us.</p>
                    </div>
                    
                    <div class="w-128px last-paragraph-no-margin text-center sm-mb-40px">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="90"><sup class="text-jungle-green top-0"></sup></h3>
                        <p>of our students received a confirmed offer letter in just four weeks.*</p>
                    </div>
                    <div class="w-128px last-paragraph-no-margin text-center xs-mb-40px">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="94"><sup class="text-jungle-green top-0"></sup></h3>
                        <p>of our students successfully earned scholarships with our proven strategies.**</p>
                    </div>
                    <div class="w-128px last-paragraph-no-margin text-center">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="85"><sup class="text-jungle-green top-0"></sup></h3>
                        <p class="mb-15px">of our students earned a spot at one of their top-choice universities.</p>
                    </div>
                    <div class="w-128px last-paragraph-no-margin text-center">
                        <h3 class="vertical-counter d-inline-flex alt-font text-green fw-700 ls-minus-3px m-0"
                            data-text="%" data-to="95"><sup class="text-jungle-green top-0"></sup></h3>
                        <p class="mb-15px">of our medical aspirants achieved their USMLE, PLAB, and AMC goals.</p>
                    </div>
                </div>
             </div>
              <div class="w-80 m-auto nowrap  mobile-none">
                <div class="row row-cols-4 row-cols-md-4 pt-4 pb-0 row-cols-sm-2 justify-content-end counter-style-05">
                    <div class="w-313px last-paragraph-no-margin text-center sm-mb-40px">
                        <div>
                            <p><span>*</span>Applicable to our partnered universities.</p>
                        </div>
                        <div>
                            <p><span>**</span>Medical professionals typically receive a salary, stipend.</p>
                        </div>
                        <div>
                            <p><span>**</span>Scholarships or assistantships for non-medical.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-intro-pgs">
            <div class="overlap-gap-section p-0">
                    <div class="mb-10px w-922px m-auto d-flex gap-2 align-items-center mobil-items-start">
                        <div class="" style="text-indent: 20px;">
                            <h6 class="mb-0 text-black fs-17 fw-600 nowrap mobile-nowrap lh-17 m-fs-12 mb-5">Step into</h6>
                            <h1 class="text-black fw-600 fs-75 m-fs-34px nowrap mobile-nowrap lh-30">
                                #pgs</h1>
                        </div>
                        <span class="text-black fs-14 text-gray fw-400 lh-20 d-inline-block mobile-w-half">
                        <b>#PGS (purpleguide.study) is your go-to admission team for studying abroad.</b> With 20+ years of hands‑on expertise
                        and education counseling, we make your path to top universities and medical careers simple, clear, and results-driven.
                        Our USP? Guiding you toward your goals — and making them happen!   
                        </span>
                    </div>
                    <div class="position-relative md-mb-50px sm-mb-40px w-880px m-auto p-0">
                        <figure class="position-relative m-0 text-center">
                            <img src="./assets/img/football-team.png" alt="" class="w-100 border-radius-6px">
                        </figure>
                    </div>
            </div>
        </section>
        <!-- End Section -->
        
        <section class="mobile-dashboard-box pt-5 mobile-dashboard-box pt-5">
            <div class="w-998px m-auto overlap-gap-section p-0">
                <div class="fnt-family fs-38 lh-full text-black w-40 m-auto mb-4">
                    One of the best parts of #PGS? <br/>
                    The Student Dashboard.
                </div>
                <div class="row justify-content-center position-relative">
                    <div class="col-lg-9">
                        <div class="section-img-setup">
                            <img src="./assets/img/dashboard-gif.png" />
                        </div>
                    </div>
                    <div class="bg-flot-box-dashboard">
                        <div class="like-floting-button">
                            <img src="./assets/img/heart.gif" />
                        </div>
                        
                        <div class="light-blue-text">
                            <img src="./assets/img/check-icon.png" alt="icon"> Mentor + Dashboard + Admission Counseling — #PGS
                            Advantage
                        </div>
                        <p class="mb-0 fs-14 lh-21 text-white fw-400 m-fs-14-update">Your full admission guide. Get expert advice, real
                            data, and hands-on support so you can
                            seamlessly turn your goals into admission success.</p>
                    </div>
                    <div class="flot-green-box-dashboard text-black">
                        <p class="mb-2 fs-16 lh-19 fw-400">
                            Get real-time updates, mentor feedback, and full progress tracking—every step from Day 1 to
                            your
                            admit.
Everything stays mapped, organized, and right here in one place.
                        </p>
                        <h5 class="mb-0 fs-17 lh-22 fw-500">Stay on track. Get admitted with confidence.</h5>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobile Section -->
        <section class="trust-box half-section overlap-height pgs-box-setup desktop-none
            position-relative mt-10">
            <div class="w-956px overlap-gap-section p-0 m-auto">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px">
                    <div class="mb-10px gap-5">
                        <div class="text-center">
                            <h5 class="text-black fw-700">The #PGS Edge & why students trust us</h5>
                        </div>
                    </div>
                </div>
                <!--<div-->
                <!--    class="d-flex gap-1 bg-black border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px mobile-wrap" style="padding-bottom: 7px;">-->
                <!--    <div class="border-radius-10px custom-gap-1 mobile-w-40">-->
                <!--        <div class="card-custom d-flex bg-white border-radius-15px justify-content-center mb-5 p-3 mt-2 w-150px ht-107px">-->
                <!--            <h5 class="mb-0 p-5 fs-25 lh-full fw-400 d-flex align-items-center  text-black text-center card-1 p-4">-->
                <!--                Visa Prep <br/>-->
                <!--                & Support-->
                <!--            </h5>-->
                <!--        </div>-->
                <!--        <div-->
                <!--            class="ht-343px w-150px card-custom bg-yellow border-radius-15px h-100 mb-2 p-3 d-flex align-items-center">-->
                <!--            <h4 class="mb-0 p-5 lh-full fw-400 fs-28 text-black text-center">-->
                <!--                Personalized Roadmap-->
                <!--                <br/> for STEM, <br />-->
                <!--                MBA & Other <br/> Courses-->
                <!--            </h4>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="mobile-w-55">-->
                <!--        <div class="d-flex align-items-center gap-3">-->
                <!--            <figure class="w-150px ht-222px position-relative fixed-img m-0 text-center mb-3">-->
                <!--                <img src="./assets/img/player-1.png" alt="">-->
                <!--            </figure>-->
                <!--            <div class="w-309px ht-222px calendar-box p-5">-->
                <!--                <div class="desktop-none text-calendar">-->
                <!--                    Feedback Session for Your Path-->
                <!--                </div>-->
                <!--                <img src="./assets/img/calendar.png" alt="" class="w-100">-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="banner-points bg-light-dark p-5 border-radius-10px w-469px ht-224px">-->
                <!--            <div>-->
                <!--                                                                        <div class="">-->
                <!--                <h5 class="w-100 fw-400 pt-2 lh-22">-->
                <!--                    for applications-->
                <!--                </h5>-->
                <!--                <div class="w-100 d-flex align-items-center justify-content-center">-->
                <!--                    <div class="check_box">-->
                <!--                        <ul>-->
                <!--                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>-->
                <!--                                Profile Review-->
                <!--                            </li>-->
                <!--                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>-->
                <!--                                Personalized SOP Guidance-->
                <!--                            </li>-->
                <!--                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>-->
                <!--                                CV Building Support-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->

                                
                <!--            </div>-->

                            
                           
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="">-->
                <!--        <div class="w-310px pt-10 pb-10 banner-points bg-light-dark p-5 border-radius-10px mt-2">-->

                            
                <!--             <div class="d-flex  gap-3">-->
                <!--                <h5 class="w-50 pt-2">-->
                <!--                    medical <br />-->
                <!--                    pathway <br />-->
                <!--                    support <br />-->
                <!--                </h5>-->
                <!--                <div class="w-50">-->
                <!--                    <div class="check_box">-->
                <!--                        <ul>-->
                <!--                            <li><i class="bi bi-check-circle-fill"></i>-->
                <!--                                Personalized Study Timelines-->
                <!--                            </li>-->
                <!--                            <li><i class="bi bi-check-circle-fill"></i>-->
                <!--                                Clinical Rotation Placements-->
                <!--                            </li>-->
                <!--                            <li><i class="bi bi-check-circle-fill"></i>-->
                <!--                                Hospital Observerships-->
                <!--                            </li>-->
                <!--                            <li><i class="bi bi-check-circle-fill"></i>-->
                <!--                                Peer Support Communities-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="d-flex gap-2 mt-2" style="flex-wrap: wrap;">-->
                <!--            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">-->
                <!--                <h5 class="mb-0 p-5 fs-25 text-black text-start card-1 p-4 lh-full">-->
                <!--                    scholarship-->
                <!--                    prep-->
                <!--                </h5>-->
                <!--            </div>-->
                <!--            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">-->
                <!--                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">-->
                <!--                    bank <br />loans-->
                <!--                </h5>-->
                <!--            </div>-->
                <!--            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">-->
                <!--                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">-->
                <!--                    research roadmap-->
                <!--                </h5>-->
                <!--            </div>-->
                <!--            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">-->
                <!--                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">-->
                <!--                    career sessions-->
                <!--                </h5>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div
                    class="d-flex gap-1 bg-black border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px mobile-wrap" style="padding-bottom: 7px;">
                    <div class="border-radius-10px custom-gap-1 mobile-w-40">
                        <div class="card-custom d-flex bg-white border-radius-15px justify-content-center mb-5 p-3 mt-2 w-150px ht-107px">
                            <h5 class="mb-0 p-5 fs-25 lh-full fw-400 d-flex align-items-center  text-black text-center card-1 p-4">
                                Visa Prep <br/>
                                & Support
                            </h5>
                        </div>
                        <div
                            class="ht-343px w-150px card-custom bg-yellow border-radius-15px h-100 mb-2 p-3 d-flex align-items-center">
                            <h4 class="mb-0 p-5 lh-full fw-400 fs-28 text-black text-center">
                                Personalized Roadmap
                                <br/> for STEM, <br />
                                MBA & Other <br/> Courses
                            </h4>
                        </div>
                    </div>
                    <div class="mobile-w-55">
                        <div class="d-flex align-items-center gap-3">
                            <figure class="w-150px ht-222px position-relative fixed-img m-0 text-center mb-3">
                                <img src="./assets/img/player-1.png" alt="">
                            </figure>
                            <div class="w-309px ht-222px calendar-box p-5">
                                <div class="desktop-none text-calendar">
                                    Feedback Session for Your Path
                                </div>
                                <img src="./assets/img/calendar.png" alt="" class="w-100">
                            </div>
                        </div>
                        <div class="mobile-d-flex">
                             
                             <div>
                             <div class="banner-points bg-light-dark p-5 border-radius-10px w-469px ht-224px">
                             
                              <div>
                            <div class="">
                                <h5 class="w-100 fw-400 pt-2 lh-22">
                                    for applications
                                </h5>
                                <div class="w-100 d-flex align-items-center justify-content-center">
                                    <div class="check_box">
                                        <ul>
                                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>
                                                Profile Review
                                            </li>
                                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>
                                                Personalized SOP Guidance
                                            </li>
                                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>
                                                CV Building Support
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                                
                            </div>
                            </div>
                        
                        
                        
                      
                    </div>
                        
                        
                              <div clas="d-flex ">
                            
                              <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">
                                    bank <br />loans
                                </h5>
                            </div>
                            <div class="card-custom w-76px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-start card-1 p-4 lh-full">
                                    scholarship
                                    prep
                                </h5>
                            </div>
                          
                                                        <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">
                                    research roadmap
                                </h5>
                            </div>
                            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">
                                    career sessions
                                </h5>
                            </div>
                        </div>

                    
                        </div>

                    </div>
                    
                      <div class="d-flex full-box-1">
                        <div class="w-310px pt-10 pb-10 banner-points bg-light-dark p-5 border-radius-10px mt-2">

                            
                             <div class="d-flex  gap-3">
                                <h5 class="w-50 pt-2">
                                    medical <br />
                                    pathway <br />
                                    support <br />
                                </h5>
                                <div class="w-50 mobile-w-60">
                                    <div class="check_box">
                                        <ul>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Personalized Study Timelines
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Clinical Rotation Placements
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Hospital Observerships
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Peer Support Communities
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-2" style="flex-wrap: wrap;">


                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
        
         <!--Desktop Section -->
        <section class="trust-box half-section overlap-height position-relative mt-10 mobile-none">
            <div class="w-956px overlap-gap-section p-0 m-auto">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px">
                    <div class="mb-10px gap-5">
                        <div class="text-center">
                            <h5 class="text-black fw-700">The #PGS Edge & why students trust us</h5>
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex gap-1 bg-black border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px" style="padding-bottom: 7px;">
                    <div class="border-radius-10px custom-gap-1">
                        <div class="card-custom d-flex bg-white border-radius-15px justify-content-center mb-5 p-3 mt-2 w-150px ht-107px">
                            <h5 class="mb-0 p-5 fs-25 lh-full fw-400 d-flex align-items-center  text-black text-center card-1 p-4">
                                Visa Prep <br/>
                                & Support
                            </h5>
                        </div>
                        <div
                            class="ht-343px w-150px card-custom bg-yellow border-radius-15px h-100 mb-2 p-3 d-flex align-items-center">
                            <h4 class="mb-0 p-5 lh-full fw-400 fs-28 text-black text-center">
                                Personalized Roadmap
                                <br/> for STEM, <br />
                                MBA & Other <br/> Courses
                            </h4>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-3">
                            <figure class="w-150px ht-222px position-relative fixed-img m-0 text-center mb-3">
                                <img src="./assets/img/player-1.png" alt="">
                            </figure>
                            <div class="w-309px ht-222px calendar-box p-5">
                                <img src="./assets/img/calendar.png" alt="" class="w-100">
                            </div>
                        </div>
                        <div class="banner-points bg-light-dark p-5 border-radius-10px w-469px ht-224px">
                            <div class="d-flex gap-3">
                                <h5 class="w-50 pt-2">
                                    medical <br />
                                    pathway <br />
                                    support <br />
                                </h5>
                                <div class="w-50">
                                    <div class="check_box">
                                        <ul>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Personalized Study Timelines
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Clinical Rotation Placements
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Hospital Observerships
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i>
                                                Peer Support Communities
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-310px pt-10 pb-10 banner-points bg-light-dark p-5 border-radius-10px mt-2">
                            <div class="">
                                <h5 class="w-100 fw-400 pt-2 lh-22">
                                    for applications
                                </h5>
                                <div class="w-100 d-flex align-items-center justify-content-center">
                                    <div class="check_box">
                                        <ul>
                                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>
                                                Profile Review
                                            </li>
                                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>
                                                Personalized SOP Guidance
                                            </li>
                                            <li class="mb-5"><i class="bi bi-check-circle-fill"></i>
                                                CV Building Support
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-2" style="flex-wrap: wrap;">
                            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-start card-1 p-4 lh-full">
                                    scholarship
                                    prep
                                </h5>
                            </div>
                            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">
                                    bank <br />loans
                                </h5>
                            </div>
                            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">
                                    research roadmap
                                </h5>
                            </div>
                            <div class="card-custom w-150px ht-107px d-flex align-items-center justify-content-center bg-yellow border-radius-15px mb-0 p-3">
                                <h5 class="mb-0 p-5 fs-25 text-black text-center card-1 p-4 lh-full">
                                    career sessions
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        

        <section class="pt-3 half-section overlap-height position-relative overflow-hidden mt-8 pt-0 section-video-category">
            <div class="w-773px overlap-gap-section p-0 m-auto">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-10px">
                    <div class="mb-10px">
                        <div class="">
                            <h6 class="mb-1 text-black fs-28 lh-35 fw-500">
                                Different goals need different plans! <br />Medical PG? MBA or STEM? Law or Undergrad
                                abroad?
                            </h6>
                            <p class="text-black fs-22 lh-22 mb-8">
                                Each path calls for a different approach—so we’ve built custom roadmap for <br /> our
                                students that actually match their journey.
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-1 mt-2">
                            <div class="bg-path">
                                <span>path 1</span>
                                <br />
                                <i class="bi bi-arrow-right-short fs-40"></i>
                            </div>
                            <h5 class="mb-0 fs-22 lh-28 text-black bg-gray border-radius-8px p-05 fw-500">
                                For all from — <br />
                                STEM, MBA or Masters, Law & Undergrad abroad.
                            </h5>
                        </div>
                        <div class="d-flex align-items-center gap-1 mt-2">
                            <div class="bg-path">
                                <span>path 2</span>
                                <br />
                                <i class="bi bi-arrow-right-short fs-40"></i>
                            </div>
                            <h5 class="mb-0 fs-22 lh-28 text-black bg-gray border-radius-8px p-05 fw-500">
                                For Everything Medical-Related — We’ve Got Two Dedicated Tracks:<br />
                                Track 1: Medical Pathways — USMLE, PLAB, AMC.<br />
                                Track 2: Nursing, Allied Health, Physiotherapy & More
                            </h5>
                        </div>
                        <div class="arrow-box-top m-auto d-flex align-items-center justify-content-center gap-3  mb-5">
                        <img src="./assets/img/dots-top-arrow.png" data-no-retina="" style="width: 70px;margin-left: 200px;">
                        <p class="mb-0 text-black fs-12 lh-15 fw-500 mt-10 mobile-fs-12">Our Counsellors &amp; Mentors <br/>
                            help you pick the right path <br/>
                            from day one</p>
                    </div>


                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-md-start mt-5 mt-sm-   gap-5 mobile-gap-3">
                    <div class="col-lg-5 col-md-5 position-relative md-mb-50px sm-mb-40px">
                        <figure class="position-relative m-0 text-center" style="height : 492px">
                          <video src="./assets/videos/uhd_25fps.mp4" 
                                     class="border-radius-6px flip-horizontal" 
                                     autoplay muted loop></video>
                        </figure>
                    </div>
                    <div class="col-lg-7 col-md-7 position-relative md-mb-50px sm-mb-40px">
                        <div class="d-flex justify-content-start counter-style-04 gap-4 flex-wrap">
                            <div class="card-light">
                                <p>Clear stepwise
                                    timeline update for each exam</p>
                            </div>
                            <div class="card-light">
                                <p>Expert profile
                                    reviews in
                                    24 hrs</p>
                            </div>
                            <div class="card-light">
                                <p>100% personalized
                                    licensing roadmap</p>
                            </div>
                            <div class="card-light">
                                <p>+50% stronger
                                    SOP drafts</p>
                            </div>
                            <div class="card-light">
                                <p>Access to proven
                                    scholarship prep guides</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
		  <section class="pt-15 half-section overlap-height position-relative step-progress-mobile">
                <div class="w-969px m-auto overlap-gap-section p-0 d-flex align-items-center">
                    <div class="col-lg-4">
                        <figure class="step-progress-img m-0 text-center">
                            <img src="./assets/img/step.png" alt="" class="border-radius-6px">
                        </figure>
                    </div>
                    <div
                        class="position-relative bg-gray w-667px  bg-very-light-green xl-p-4 md-p-50px sm-p-30px border-radius-10px pl-6-pt-6 ">
                        <div class="mb-10px">

                        </div>
                        <div class="">
                            <h2 class="mb-1 bg-text-step text-black fs-34">
                                Not Sure Where to Begin?
                            </h2>
                            <h4 class="mb-4 text-black fs-38 lh-22 fw-400 bg-text-step-1 mb-2 mt-2 mobile-fs-20">
                                Start Your Study Abroad Journey Here!
                            </h4>
                            <p class="text-black fs-17 lh-22 text-center mobile-fs-14 mobile-text-start">
                                A few quick questions so we know where you stand — and from there, our mentors will
                                guide
                                you step by step.
                            </p>
                            <form id="studyJourneyForm" action="<?= site_url('Home/submit_study_journey') ?>" method="post">
                                <div class="card-stps que-step-header">

                                    <!-- Progress header -->
                                    <div>
                                        <span class="fs-19 lh-25 text-black" id="step-counter">Step 1 of 4</span>
                                        <div class="que-progress">
                                            <div class="que-progress-bar" id="progress-bar"></div>
                                        </div>
                                    </div>

                                    <!-- Step 1 -->
                                    <div class="step step-1">
                                        <h3 class="que-yellow-label">You are a <span class="req">*</span></h3>
                                        <?php foreach ($study_journey_options['youare'] as $option): ?>
                                            <label><input type="radio" name="youare" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>

                                        <h3 class="que-yellow-label mb-4">Pick your stream <span class="req">*</span></h3>
                                        <div class="que-path-section">
                                            <div class="questions" style="justify-content: space-between;gap: 0px;">
                                                <div>
                                                    <h4>Medical Path</h4>
                                                    <?php foreach ($study_journey_options['medical1'] as $option): ?>
                                                        <label><input type="radio" name="stream" data-stream-group="medical1" value="medical1|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>

                                                <div>
                                                    <h4>Masters Path</h4>
                                                    <?php foreach ($study_journey_options['masters'] as $option): ?>
                                                        <label><input type="radio" name="stream" data-stream-group="masters" value="masters|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>

                                                <div>
                                                    <h4>Undergrad Path</h4>
                                                    <?php foreach ($study_journey_options['undergrad'] as $option): ?>
                                                        <label><input type="radio" name="stream" data-stream-group="undergrad" value="undergrad|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div>
                                                    <h4>Medical Path 2</h4>
                                                    <?php foreach ($study_journey_options['medical2'] as $option): ?>
                                                        <label><input type="radio" name="stream" data-stream-group="medical2" value="medical2|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="btn-next" onclick="nextStep()" style="border-radius : 10px">Next</button>
                                        </div>
                                    </div>

                                    <!-- Step 2 -->
                                    <div class="step step-2 hidden">
                                        <h3 class="que-yellow-label">What step of your journey are you currently in?
                                            <span class="req">*</span>
                                        </h3>
                                        <?php foreach ($study_journey_options['country'] as $option): ?>
                                            <label><input type="radio" name="country" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                        <?php endforeach; ?>

                                        <h3 class="que-yellow-label">Level of your study <span class="req">*</span></h3>
                                        <div class="que-path-section">
                                            <div class="questions">
                                                <div>
                                                    <h4>Medical Path</h4>
                                                    <?php foreach ($study_journey_options['medicalpath'] as $option): ?>
                                                        <label><input type="radio" name="study_level" data-study-level-group="medicalpath" value="medicalpath|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div>
                                                    <h4>Masters Path</h4>
                                                    <?php foreach ($study_journey_options['masterpath'] as $option): ?>
                                                        <label><input type="radio" name="study_level" data-study-level-group="masterpath" value="masterpath|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div>
                                                    <h4>Undergrad Path</h4>
                                                    <?php foreach ($study_journey_options['undergradpath'] as $option): ?>
                                                        <label><input type="radio" name="study_level" data-study-level-group="undergradpath" value="undergradpath|<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="btn-back" onclick="goBack()">Back</button>
                                            <button type="button" class="btn-next" onclick="nextStep()" style="border-radius : 10px">Next</button>
                                        </div>
                                    </div>

                                    <!-- Step 3 -->
                                    <div class="step step-3 hidden">
                                        <div>
                                            <h3 class="que-yellow-label">Which intake year are you aiming for? <span
                                                    class="req">*</span></h3>
                                            <?php foreach ($study_journey_options['plan'] as $option): ?>
                                                <label><input type="radio" name="plan" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                        <div>
                                            <h3 class="que-yellow-label" style="height : auto !important;">Which countries are you considering?<span
                                                    class="fs-15 fw-400 d-block" style="margin-top: -8px;">(for masters and
                                                    undergrad path)</span></h3>
                                            <?php foreach ($study_journey_options['countries'] as $option): ?>
                                                <label><input type="radio" name="countries" value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"> <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                        <div>
                                            <button type="button" class="btn-back" onclick="goBack()">Back</button>
                                            <button type="button" class="btn-next" onclick="nextStep()" style="border-radius : 10px">Next</button>
                                        </div>
                                    </div>

                                    <!-- Step 4 -->
                                    <div class="step step-4 hidden">
                                        <div class="mb-2">
                                            <h3 class="que-yellow-label">Your Name <span class="req">*</span></h3>
                                            <input class="form-control py-2 px-3" type="text" name="name" id="journeyName" maxlength="120" autocomplete="name">
                                        </div>
                                        <div class="mb-2">
                                            <h3 class="que-yellow-label">Email <span class="req">*</span></h3>
                                            <input class="form-control py-2 px-3" type="email" name="email" id="journeyEmail" maxlength="180" autocomplete="email">
                                        </div>
                                        <div class="mb-2">
                                            <h3 class="que-yellow-label">Phone No. <span class="req">*</span></h3>
                                            <input class="form-control py-2 px-3" type="number" name="number" id="journeyPhone" placeholder="" min="0" autocomplete="tel">
                                        </div>
                                        <div>
                                            <!--<button class="btn-back" onclick="goBack()">Back</button>-->
                                            <button type="button" class="btn-next" id="studyJourneySubmitBtn" onclick="finishForm()">Submit</button>
                                        </div>
                                    </div>


                                    <figure class="step-progress-img progress-small m-0 text-center desktop-none">
                                        <img src="./assets/img/step.png" alt="" class="border-radius-6px" data-no-retina="">
                                    </figure>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
        </section>

        
       <!-- < // ?php $this->load->view('partials/study_journey_section', ['study_journey_options' => isset($study_journey_options) ? $study_journey_options : null]); ?> -->

        <section class="half-section home-gallery-mobile overlap-height position-relative overflow-hidden mt-8">
            <div class="w-903px m-auto overlap-gap-section p-0">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px">
                    <div class="mb-10px gap-5">
                        <div class="text-start mb-4">
                            <h5 class="w-80 text-black fw-700 m-auto fs-28 lh-35 fw-500 mobile-compact-1">No matter the stage, our team has helped students
                                <br />
                                just like you get to their goal.
                            </h5>
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex gap-3 border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px grid-mobile-compact">
                    <div class="w-30 m-w-48 overflow-hidden border-radius-10px">
                        <div class="full-photo border-radius-15px mb-5">
                            <img src="./assets/img/Frame-1.png" />
                        </div>
                        
                         <div class="desktop-none">
                            <div class="card-img-box">
                                <figure class="position-relative fixed-gallery-1 m-0 text-center mb-4">
                                    <img src="./assets/img/photo-3.jpg" />
                                </figure>
                                <div class="img-catptio">
                                    <div class="avatar-name d-flex align-items-center justify-content-space gap-4">
                                        <div>
                                            <h5 class="mb-0">Ramya Thapar</h5>
                                        <h6 class="mb-0">Clinical Rotation</h6>
                                        <h6 class="mb-0">John Hopkins University, <b>USA</b> </h6>
                                        </div>
                                        <div>
                                            <h5 class="fs-28 lh-22 fw-500 fnt-family">#USMLE</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-img-box">
                                <figure class="position-relative fixed-gallery-1 m-0 text-center mb-4">
                                    <img src="./assets/img/photo-3.jpg" />
                                </figure>
                                <div class="img-catptio">
                                    <div class="avatar-name d-flex align-items-center justify-content-space gap-4">
                                        <div>
                                            <h5 class="mb-0">Ramya Thapar</h5>
                                        <h6 class="mb-0">Clinical Rotation</h6>
                                        <h6 class="mb-0">John Hopkins University, <b>USA</b> </h6>
                                        </div>
                                        <div>
                                            <h5 class="fs-28 lh-22 fw-500 fnt-family">#USMLE</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-img-box mobile-none">
                                <div class="paragraph-1">
                                    “ Everything changed when I crossed paths with my mentor, Mr. Nilmek of purpleGuide.
                                    Back when
                                    uncertainty clouded my path, they gave me more than just the right guidance—they
                                    offered
                                    unwavering support and care at every step. For me, they didn’t
                                    just make my dream possible—they made it happen. ”</div>
                            </div>
                        </div>

                    </div>
                    <div class="m-w-48">
                        <div class="">
                             <div class="caption-img-box-new small-caption">
                                                    <img src="./assets/img/photo-2.jpg " data-no-retina="">
                                                    <div class="d-flex position-absolute-css z-100 justify-content-space px-4">
                                                        <div>
                                                            <h5 class="fs-19 lh-22 fw-500 fnt-family text-white mb-0">vilivi p
                                                                aye
                                                            </h5>
                                                            <p class="mb-0 fs-9 lh-8 text-white mb-0">#purplePremium student
                                                            </p>
                                                        </div>
                                                        <div class="minus-10 flot-text">
                                                            <h5 class="fs-16 lh-16 fw-500 fnt-family text-white mb-0">masters</h5>
                                                            <h5 class="fs-25 lh-22 fw-500 fnt-family text-white mb-0">#UK</h5>
                                                        </div>
                                                    </div>
                                                </div>
                             <div class="caption-img-box-new small-caption">
                                                    <img src="./assets/img/photo-2.jpg " data-no-retina="">
                                                    <div class="d-flex position-absolute-css z-100 justify-content-space px-4">
                                                        <div>
                                                            <h5 class="fs-19 lh-22 fw-500 fnt-family text-white mb-0">vilivi p
                                                                aye
                                                            </h5>
                                                            <p class="mb-0 fs-9 lh-8 text-white mb-0">#purplePremium student
                                                            </p>
                                                        </div>
                                                        <div class="minus-10 flot-text">
                                                            <h5 class="fs-16 lh-16 fw-500 fnt-family text-white mb-0">masters</h5>
                                                            <h5 class="fs-25 lh-22 fw-500 fnt-family text-white mb-0">#UK</h5>
                                                        </div>
                                                    </div>
                                                </div>
                             <div class="caption-img-box-new small-caption">
                                                    <img src="./assets/img/photo-2.jpg " data-no-retina="">
                                                    <div class="d-flex position-absolute-css z-100 justify-content-space px-4">
                                                        <div>
                                                            <h5 class="fs-19 lh-22 fw-500 fnt-family text-white mb-0">vilivi p
                                                                aye
                                                            </h5>
                                                            <p class="mb-0 fs-9 lh-8 text-white mb-0">#purplePremium student
                                                            </p>
                                                        </div>
                                                        <div class="minus-10 flot-text">
                                                            <h5 class="fs-16 lh-16 fw-500 fnt-family text-white mb-0">masters</h5>
                                                            <h5 class="fs-25 lh-22 fw-500 fnt-family text-white mb-0">#UK</h5>
                                                        </div>
                                                    </div>
                                                </div>
                           

                        </div>
                         <div class="card-img-box desktop-none">
                                <div class="paragraph-1">
                                    “ Everything changed when I crossed paths with my mentor, Mr. Nilmek of purpleGuide.
                                    Back when
                                    uncertainty clouded my path, they gave me more than just the right guidance—they
                                    offered
                                    unwavering support and care at every step. For me, they didn’t
                                    just make my dream possible—they made it happen. ”</div>
                            </div>
                    </div>
                    <div class="w-35 m-w-48 mobile-none">
                        <div class="">
                            <div class="card-img-box">
                                <figure class="position-relative fixed-gallery-1 m-0 text-center mb-4">
                                    <img src="./assets/img/photo-3.jpg" />
                                </figure>
                                <div class="img-catptio">
                                    <div class="avatar-name d-flex align-items-center justify-content-space gap-4">
                                        <div>
                                            <h5 class="mb-0">Ramya Thapar</h5>
                                        <h6 class="mb-0">Clinical Rotation</h6>
                                        <h6 class="mb-0">John Hopkins University, <b>USA</b> </h6>
                                        </div>
                                        <div>
                                            <h5 class="fs-28 lh-22 fw-500 fnt-family">#USMLE</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-img-box">
                                <figure class="position-relative fixed-gallery-1 m-0 text-center mb-4">
                                    <img src="./assets/img/photo-3.jpg" />
                                </figure>
                                <div class="img-catptio">
                                    <div class="avatar-name d-flex align-items-center justify-content-space gap-4">
                                        <div>
                                            <h5 class="mb-0">Ramya Thapar</h5>
                                        <h6 class="mb-0">Clinical Rotation</h6>
                                        <h6 class="mb-0">John Hopkins University, <b>USA</b> </h6>
                                        </div>
                                        <div>
                                            <h5 class="fs-28 lh-22 fw-500 fnt-family">#USMLE</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-img-box mobile-none">
                                <div class="paragraph-1">
                                    “ Everything changed when I crossed paths with my mentor, Mr. Nilmek of purpleGuide.
                                    Back when
                                    uncertainty clouded my path, they gave me more than just the right guidance—they
                                    offered
                                    unwavering support and care at every step. For me, they didn’t
                                    just make my dream possible—they made it happen. ”</div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </section>

       <section class="half-section overlap-height position-relative overflow-hidden mobile-premium-section">
        <div class="w-873px m-auto overlap-gap-section p-0">
            <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px pb-sm-0" style="padding-bottom : 0px !important">
                <div class="mb-10px gap-5">
                    <div class="text-center mb-4">
                        <span class="small-caption fs-15 lh-full text-uppercase fw-600 mobile-fs-14">Built for aspirers</span>
                        <h5 class="w-100 text-black fs-25 mt-1 mb-2 fw-500 lh-full m-auto mobile-fs-16">
                            Jump into directly to our premium section
                        </h5>
                        <p class="w-75 fs-15 lh-full text-center m-auto mobile-fs-14">No generic advice—just solid guidance, proven routes, and personalized plans for USMLE, PLAB, STEM, MBA, or whatever path you're aiming for.</p>
                    </div>
                </div>
            </div>

            <!--Desktop code -->
            <div
                class="mobile-none d-flex gap-3 border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px mobile-flex-wrap">

                <div class="w-35">
                    <a href="/purpleusme" class="card-line">
                        <div class="black-header">
                            <h5>USMLE - </h5>
                            <h6>United States Medical
                                Licensing Examination</h6>
                        </div>
                        <p>
                            Start your USMLE journey with a plan that actually works. Stay on track with mentor
                            feedback,
                            peer groups, and a roadmap built just for you.
                        </p>
                    </a>
                    <a href="/purpleamc" class="card-line">
                        <div class="black-header">
                            <h5>AMC - </h5>
                            <h6>Australian Medical Council exams</h6>
                        </div>
                        <p>
                            This is the section where we guide you through the AMC journey. From roadmap to profile
                            review,
                            we help you plan each step toward practicing in Australia.
                        </p>
                    </a>
                    <a href="/Purpleplab" class="card-line">
                        <div class="black-header">
                            <h5>PLAB - </h5>
                            <h6>Professional and Linguistic
                                Assessments Board test </h6>
                        </div>
                        <p>
                            PLAB has shifted from a popular option to a highly competitive path even after licensing
                            —
                            we
                            guide you from prep to post-job steps, starting before PLAB 1.
                        </p>
                    </a>

                </div>

                <div>
                    <a href="/purpleusme" class="card-line">
                        <div class="black-header">
                            <h5>USMLE - </h5>
                            <h6>CLINICAL ROTATION</h6>
                        </div>
                        <p>
                            Hands-on clinical experience in the USA , tied to your USMLE journey. We connect you with verified hospitals, guide your documents, and support visa steps.
                        </p>
                    </a>
                    <div class="border-radius-6px overflow-hidden">
                        <div class="gradient-border">
                            <div class="gradient-border-inner">
                                <h5>Download our Application Planning Checklist (Free PDF)</h5>
                                <a href="#"  
								     onclick="return window.ppOpenModalset();"
                                    class="btn btn-small-large cm-buttom-1 border-radius-10px btn-base-color btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-5px">
                                    <span>
                                        <span class="btn-double-text ls-minus-05px fs-15" data-text="Request it here">Request
                                            it
                                            here</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-line-ht w-362px">
                        <h5>#purplePremium</h5>
                        <div class="black-header-1">
                            Now open for the Class of 2025, 2026, and 2027.
                        </div>
                    </div>
                </div>
                <div class="w-35">
                    <a href="/purplepremiumhome" class="card-line ht-535px" style="padding-bottom: 150px;margin-left: -78px;">
                        <div class="black-header-2">
                            <h5>STEM </h5>
                            <h5>MASTERS </h5>
                            <h5>LAW </h5>
                            <h5>MBA </h5>
                            <h5>OTHERS</h5>
                        </div>
                        <br />
                        <p class="mt-0">
                            This is the section where we help you plan your study abroad right. If you're aiming for a good university,
                            we look at your profile, tak
                            e your inputs, and get advice from our mentors to build a proper plan. It’s all about making your study abroad
                            journey well-guided, well-researched, and worth it.
                        </p>
                    </a>
                    <div class="card-box-webcome">
                        <div class="header-web">
                            <div class="webcome-buttons">
                                <span class="bg-red"></span>
                                <span class="bg-yellow"></span>
                                <span class="bg-green"></span>
                            </div>
                            <div class="webcome-buttons">
                                <img src="./assets/img/resize-icon.png" data-no-retina="">
                                <img src="./assets/img/lines-icon.png" data-no-retina="">
                            </div>
                        </div>
                        <div class="">
                            <div class="fit-cover-webcome position-relative">
                                <img src="./assets/img/read-you-girl.jpg" data-no-retina="">
                                <h6 class="position-absolute top-0 w-100 h-100 d-flex align-items-center justify-content-center fs-24 text-uppercase text-white mb-0 lh-full fw-400" style="background: #0000003d;">YOU</h6>
                            </div>
                            <div class="fit-cover-webcome position-relative">
                                <img src="./assets/img/girl-mentor.jpg" data-no-retina="">
                                <h6 class="position-absolute top-0 w-100 h-100 d-flex align-items-center justify-content-center fs-24 text-center text-white mb-0 lh-full fw-400" style="background: #0000003d;">your <br /> mentor</h6>
                            </div>
                            <div class="fit-cover-webcome dark-pink-bg d-flex align-items-center justify-content-center">
                                <h6 class="fs-24 text-white mb-0 lh-full fw-400">Team <br> #PGS</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Desktop code -->

            <!--Mobile code -->
             <div
                class="desktop-none  border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px p-4">

                <div class="card-line-ht w-362px">
                    <h5>#purplePremium</h5>
                    <div class="black-header-1">
                        Now open for the Class of 2025, 2026, and 2027.
                    </div>
                </div>
                <div class="border-radius-6px overflow-hidden mt-5">
                    <div class="gradient-border">
                        <div class="gradient-border-inner">
                            <h5>Download our Application Planning Checklist (Free PDF)</h5>
                            <a href="#"
                                onclick="return window.ppOpenModalset();"
                                class="btn btn-small-large cm-buttom-1 border-radius-10px btn-base-color btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-5px">
                                <span>
                                    <span class="btn-double-text ls-minus-05px fs-15" data-text="Request it here">Request
                                        it
                                        here</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>



                <div class="d-flex gap-3 px-3">

                    <div class="w-50 pt-2">
                        <a href="/purpleusme" class="card-line">
                            <div class="black-header">
                                <h5>USMLE - </h5>
                                <h6>United States Medical
                                    Licensing Examination</h6>
                            </div>
                            <p>
                                Start your USMLE journey with a plan that actually works. Stay on track with mentor
                                feedback,
                                peer groups, and a roadmap built just for you.
                            </p>
                        </a>
                        <a href="/purpleamc" class="card-line">
                            <div class="black-header">
                                <h5>AMC - </h5>
                                <h6>Australian Medical Council exams</h6>
                            </div>
                            <p>
                                This is the section where we guide you through the AMC journey. From roadmap to profile
                                review,
                                we help you plan each step toward practicing in Australia.
                            </p>
                        </a>
                        <a href="/Purpleplab" class="card-line">
                            <div class="black-header">
                                <h5>PLAB - </h5>
                                <h6>Professional and Linguistic
                                    Assessments Board test </h6>
                            </div>
                            <p>
                                PLAB has shifted from a popular option to a highly competitive path even after licensing
                                —
                                we
                                guide you from prep to post-job steps, starting before PLAB 1.
                            </p>
                        </a>
                        <a href="/purpleusme" class="card-line">
                            <div class="black-header">
                                <h5>USMLE - </h5>
                                <h6>CLINICAL ROTATION</h6>
                            </div>
                            <p>
                                Hands-on clinical experience in the USA , tied to your USMLE journey. We connect you with verified hospitals, guide your documents, and support visa steps.
                            </p>
                        </a>

                    </div>
                    <div class="w-50 pt-2">
                        <a href="/purplepremiumhome" class="card-line ht-535px" style="padding-bottom: 150px;margin-left: -78px;">
                            <div class="black-header-2">
                                <h5>STEM </h5>
                                <h5>MASTERS </h5>
                                <h5>LAW </h5>
                                <h5>MBA </h5>
                                <h5>OTHERS</h5>
                            </div>
                            <p class="mt-0">
                                This is the section where we help you plan your study abroad right. If you're aiming for a good university,
                                we look at your profile, tak
                                e your inputs, and get advice from our mentors to build a proper plan. It’s all about making your study abroad
                                journey well-guided, well-researched, and worth it.
                            </p>
                        </a>
                        <div class="card-box-webcome">
                            <div class="header-web">
                                <div class="webcome-buttons">
                                    <span class="bg-red"></span>
                                    <span class="bg-yellow"></span>
                                    <span class="bg-green"></span>
                                </div>
                                <div class="webcome-buttons">
                                    <img src="./assets/img/resize-icon.png" data-no-retina="">
                                    <img src="./assets/img/lines-icon.png" data-no-retina="">
                                </div>
                            </div>
                            <div class="">
                                <div class="fit-cover-webcome position-relative">
                                    <img src="./assets/img/read-you-girl.jpg" data-no-retina="">
                                    <h6 class="position-absolute top-0 w-100 h-100 d-flex align-items-center justify-content-center fs-14 text-uppercase text-white mb-0 lh-full fw-400" style="background: #0000003d;">YOU</h6>
                                </div>
                                <div class="fit-cover-webcome position-relative">
                                    <img src="./assets/img/girl-mentor.jpg" data-no-retina="">
                                    <h6 class="position-absolute top-0 w-100 h-100 d-flex align-items-center justify-content-center fs-14 text-center text-white mb-0 lh-full fw-400" style="background: #0000003d;">your <br /> mentor</h6>
                                </div>
                                <div class="fit-cover-webcome dark-pink-bg d-flex align-items-center justify-content-center">
                                    <h6 class="fs-14 text-white mb-0 lh-full fw-400">Team <br> #PGS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Mobile code -->

        </div>
    </section>

        <section class="pt-3 mobile-aboutus">
            <div class="w-503px m-auto overlap-gap-section p-0">
                <div
                    class="position-relative bg-gray bg-very-light-green xl-p-4 md-p-50px sm-p-30px border-radius-10px pl-6-pt-6">
                    <div class="mb-10px">
                        <div class="mt-10 mt-10 mobile-px-4">
                            <h2 class="mb-1 mt-30 text-uppercase fnt-bab text-black fs-38 fw-400 fnt-family mobile-fs-20 mobile-lh-18">
                                about us
                            </h2>
                            
                            <a href="#" style="padding: 8px 30px;"
                                class="mb-2  mobile-px-3 btn btn-small-large border-radius-10px btn-base-color btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-5px">
                                <span>
                                    <span class="btn-double-text ls-minus-05px fs-15" data-text="get to know #pgs">get to know
                                        #pgs</span>
                                </span>
                            </a>

                            <p class="text-black fs-16 lh-19 mt-6 mb-30 mobile-fs-14 mobile-pb-30">
                                PurpleGuide.study was built from real stories, not just strategy. What began as a search
                                for
                                answers became our mission to mentor students the right way. Over the years, we’ve
                                guided
                                students through study choices, career calls, and big leaps. Now, we're the platform we
                                wish
                                we had when we started off!
                            </p>
                        </div>

                        <figure class="about-floting-img m-0 text-center">
                            <img src="./assets/img/doctor.png" alt="" class="border-radius-6px">
                        </figure>


                    </div>
                </div>

            </div>
        </section>

        <section class="trust-box half-section overlap-height
            position-relative pt-15 mobile-partnar">
            <div class="container overlap-gap-section p-0">
                <div class="col-lg-12 bg-very-light-green xl-p-4 md-p-50px sm-p-30px mobile-pb-0">
                    <div class="mb-10px gap-5">
                        <div class="text-center">
                            <h5 class="text-black fw-700 fs-28 mobile-mb-0">#PGS in the news</h5>
                        </div>
                    </div>
                    
                </div>
                <div class="d-flex gap-3 p-1 border-radius-10px col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px">
                    <div class="col-lg-9 m-auto d-flex gap-5 border-radius-10px overflow-hidden">
                         <div class="d-flex justify-content-center justify-content-xl-start flex-column gap-3 mobile-partner-arrow desktop-none">
                                <!-- start slider navigation -->
                                <div class="slider-one-slide-prev-1 text-dark-gray swiper-button-prev slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                    tabindex="0" role="button" aria-label="Previous slide">
                                    <i class="fas fa-angle-left"></i>
                                </div>
                                <div class="slider-one-slide-next-1 text-dark-gray swiper-button-next slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                    tabindex="0" role="button" aria-label="Next slide">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                                <!-- end slider navigation -->
                            </div>
                          <div class="swiper sm-p-0"
                                data-slider-options='{ "slidesPerView": 1, "spaceBetween": 40, "loop": true, "pagination": { "el": ".slider-one-slide-pagination", "clickable": true, "dynamicBullets": false }, "navigation":
                                { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": 
                                { "delay": 3000000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true },
                                "breakpoints": { "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                                <div class="swiper-wrapper pt-30px pb-30px mobile-pt-0">
                                    <!-- start review item -->
                                    <div class="swiper-slide review-style-06">
                        
                        <div class="box-light w-284px mobile-m-auto">
                            <div class="header-light">
                                <img src="./assets/img/lvmint.png" alt="" data-no-retina="">
                            </div>
                            <p>
                                "Sequoia India joins 126
                                crores round in overseas
                                education startup Leap"
                            </p>
                        </div>
                        </div>
                        <div class="swiper-slide review-style-06">
                        <div class="box-light w-284px mobile-m-auto">
                            <div class="header-light">
                                 <img src="./assets/img/tc.png" alt="" data-no-retina="">
                            </div>
                            <p>
                                "Leap raises $55 million to
                                help Indian students study <br>
                                abroad"
                            </p>
                        </div>
                         </div>
                        <div class="swiper-slide review-style-06">
                        <div class="box-light w-284px mobile-m-auto">
                            <div class="header-light">
                                 <img src="./assets/img/et.png" alt="" data-no-retina="">
                            </div>
                            <p class="w-100">Leap raises 40 crores led by Sequoia India</p>
                        </div>
                        </div>
                    </div>
                  </div>
                   </div>
                </div>
            </div>
        </section>

        <section class="bg-tranquil position-relative mobile-faq-cart-box overflow-hidden" id="masterclass-tabs-section">

            <div class="w-895px m-auto">
                <div class="row align-items-center mb-4">
                    <div class="col-xl-12 lg-mb-30px text-center text-xl-start mobile-mb-0">
                        <h3 class="alt-font text-black m-auto text-center fw-500 lh-40 fs-32 mb-3 mobile-fs-16 mobile-bold mobile-lh-full">
                            Plan Your Study Abroad Like a Pro—Free <br/> Masterclass Inside
                        </h3>
                    </div>
                    <div class="col-xl-12 tab-style-03 tab-style-new text-center">
                        <!-- filter navigation -->
                        <ul
                            class="portfolio-filter fw-500 nav nav-tabs justify-content-center justify-content-center border-0">
                            <!-- <li class="nav active"><a data-filter="*" href="#">All</a></li> -->
                            <li class="nav active"><a data-filter=".study_abroad" href="#">study abroad masterclass</a>
                            </li>
                            <li class="nav"><a data-filter=".online_meet_event" href="#">online meet event</a></li>
                            <li class="nav"><a data-filter=".new_visit" href="#">uni visit @ecr</a></li>
                        </ul>
                        <!-- end filter navigation -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 filter-content p-md-0" style="min-height: 900px;">
                        <ul class="portfolio-wrapper grid-loading grid  gutter-extra-large mobile-ht-full">
                            <?php $upcoming_list = isset($upcoming_events) ? $upcoming_events : []; ?>
                            <li class="grid-sizer"></li>
                            <!-- Tab 1: study abroad masterclass -->
                            <li class="grid-item study_abroad transition-inner-all w-100">
                                <div class="row mobile-reverse-row">
                                    <div class="col-lg-6 mobile-p-0 mobile-pt-10">

                                        <h5 class="text-black moble-m-auto fw-400 mb-1 w-60 fs-25 lh-28 mobile-fs-19 mobile-lh-22 mobile-text-center">
                                            This Session Is Designed
                                            for MBA, Master’s &
                                            Engineering Applicants
                                        </h5>
                                        <div class="mobile-px-5">
                                        <p class="mobile-mt-13px mb-0 text-black fs-12 lh-12 mobile-fs-12">More sessions coming up for Medical & STEM aspirants
                                            —
                                            reach out to our counsellors.</p>
                                        </div>

                                        <div class="accordion accordion-style-02" id="accordion-style-02"
                                            data-active-icon="icon-feather-minus"
                                            data-inactive-icon="icon-feather-plus">
                                            <!-- start accordion item -->
                                            <div class="accordion-item active-accordion">
                                                <div
                                                    class="accordion-header border-bottom border-color-extra-medium-gray">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-01" aria-expanded="true"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-minus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18 mobile-fs-14 mobile-fw-600">How to shortlist unis
                                                                that actually match your profile</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-01" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                        <p class="fw-400 fs-14 lh-19">More sessions coming up for Medical & STEM
                                                            aspirants — reach out
                                                            to our counsellors.More sessions coming up for Medical &
                                                            STEM
                                                            aspirants — reach out to our counsellors.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                            <!-- start accordion item -->
                                            <div class="accordion-item">
                                                <div
                                                    class="accordion-header border-bottom border-color-extra-medium-gray">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-02" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18 mobile-fs-14 mobile-fw-600">Avoid common SOP/LOR
                                                                mistakes that cost students</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-02" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                            <!-- start accordion item -->
                                            <div class="accordion-item">
                                                <div class="accordion-header border-bottom border-color-transparent">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-03" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18 mobile-fs-14 mobile-fw-600">Visa timelines
                                                                explained,
                                                                when to do what</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-03 border-bottom"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header border-bottom border-color-transparent">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-04" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-04">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18 mobile-fs-14 mobile-fw-600">Learn how our team
                                                                supports you through it all</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-04" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-04">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mobile-p-0 offset-lg-1">
                                       <div class="overflow-hidden border-radius-16px w-383px">
                            <?php $ev = isset($upcoming_list[0]) ? $upcoming_list[0] : null; $this->load->view('simplehome_event_card', ['ev' => $ev]); ?>
                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="grid-item online_meet_event transition-inner-all w-100">
                               <div class="row">
                                    <div class="col-lg-6">

                                        <h5 class="text-black fw-400 mb-1 w-60 fs-25 lh-28 mobile-fw-600 mobile-text-center">
                                            This Session Is Designed
                                            for MBA, Master’s &
                                            Engineering Applicants
                                        </h5>
                                        <p class="mb-0 text-black fs-12 lh-12 mobile-fs-12">More sessions coming up for Medical & STEM aspirants
                                            —
                                            reach out to our counsellors.</p>

                                        <div class="accordion accordion-style-02" id="accordion-style-02"
                                            data-active-icon="icon-feather-minus"
                                            data-inactive-icon="icon-feather-plus">
                                            <!-- start accordion item -->
                                            <div class="accordion-item active-accordion">
                                                <div
                                                    class="accordion-header border-bottom border-color-extra-medium-gray">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-01" aria-expanded="true"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-minus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">How to shortlist unis
                                                                that actually match your profile</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-01" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                        <p class="fw-400 fs-14 lh-19">More sessions coming up for Medical & STEM
                                                            aspirants — reach out
                                                            to our counsellors.More sessions coming up for Medical &
                                                            STEM
                                                            aspirants — reach out to our counsellors.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                            <!-- start accordion item -->
                                            <div class="accordion-item">
                                                <div
                                                    class="accordion-header border-bottom border-color-extra-medium-gray">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-02" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Avoid common SOP/LOR
                                                                mistakes that cost students</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-02" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                            <!-- start accordion item -->
                                            <div class="accordion-item">
                                                <div class="accordion-header border-bottom border-color-transparent">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-03" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Visa timelines
                                                                explained,
                                                                when to do what</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-03 border-bottom"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header border-bottom border-color-transparent">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-04" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-04">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Learn how our team
                                                                supports you through it all</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-04" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-04">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                        </div>
                                    </div>
                                    <div class="col-lg-5 offset-lg-1">
                                       <div class="overflow-hidden border-radius-16px w-383px">
                            <?php $ev = isset($upcoming_list[1]) ? $upcoming_list[1] : null; $this->load->view('simplehome_event_card', ['ev' => $ev]); ?>
                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="grid-item new_visit transition-inner-all w-100">
                               <div class="row">
                                    <div class="col-lg-6">

                                        <h5 class="text-black fw-400 mb-1 w-60 fs-25 lh-28">
                                            This Session Is Designed
                                            for MBA, Master’s &
                                            Engineering Applicants
                                        </h5>
                                        <p class="mb-0 text-black fs-12 lh-12">More sessions coming up for Medical & STEM aspirants
                                            —
                                            reach out to our counsellors.</p>

                                        <div class="accordion accordion-style-02" id="accordion-style-02"
                                            data-active-icon="icon-feather-minus"
                                            data-inactive-icon="icon-feather-plus">
                                            <!-- start accordion item -->
                                            <div class="accordion-item active-accordion">
                                                <div
                                                    class="accordion-header border-bottom border-color-extra-medium-gray">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-01" aria-expanded="true"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-minus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">How to shortlist unis
                                                                that actually match your profile</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-01" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                        <p class="fw-400 fs-14 lh-19">More sessions coming up for Medical & STEM
                                                            aspirants — reach out
                                                            to our counsellors.More sessions coming up for Medical &
                                                            STEM
                                                            aspirants — reach out to our counsellors.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                            <!-- start accordion item -->
                                            <div class="accordion-item">
                                                <div
                                                    class="accordion-header border-bottom border-color-extra-medium-gray">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-02" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Avoid common SOP/LOR
                                                                mistakes that cost students</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-02" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                            <!-- start accordion item -->
                                            <div class="accordion-item">
                                                <div class="accordion-header border-bottom border-color-transparent">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-03" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-02">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Visa timelines
                                                                explained,
                                                                when to do what</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-03 border-bottom"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-02">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header border-bottom border-color-transparent">
                                                    <a href="#" data-bs-toggle="collapse"
                                                        data-bs-target="#accordion-style-02-04" aria-expanded="false"
                                                        data-bs-parent="#accordion-style-04">
                                                        <div class="accordion-title mb-0 position-relative text-black">
                                                            <i class="feather icon-feather-plus"></i><span
                                                                class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Learn how our team
                                                                supports you through it all</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="accordion-style-02-04" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-style-04">
                                                    <div
                                                        class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                                        <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to
                                                            use
                                                            your audience to
                                                            make a positive move.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end accordion item -->
                                        </div>
                                    </div>
                                    <div class="col-lg-5 offset-lg-1">
                                       <div class="overflow-hidden border-radius-16px w-383px">
                            <?php $ev = isset($upcoming_list[2]) ? $upcoming_list[2] : null; $this->load->view('simplehome_event_card', ['ev' => $ev]); ?>
                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
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
                            <h5 class="w-100 text-black fs-40 mb-2 fw-700 m-auto mobile-fs-18">
                                Ready to get started?
                            </h5>
                            <p class="w-40 text-center m-auto mobile-get-start">Let’s chart your study abroad path, together with Team
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

        <section class="pt-0 faq_section">
            <div class="container overlap-gap-section p-0">
                <div class="col-lg-10 bg-very-light-green xl-p-4 md-p-50px sm-p-30px m-auto">
                    <h2 class="fac-title">FAQ’s</h2>
                    <div class="accordion accordion-style-02" id="accordion-style-02"
                        data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">
                        <!-- start accordion item -->
                        <div class="accordion-item active-accordion">
                            <div class="accordion-header  border-color-extra-medium-gray">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-01"
                                    aria-expanded="true" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-black">
                                        <i class="feather icon-feather-minus"></i><span
                                            class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">How
                                            to
                                            shortlist unis
                                            that actually match your profile</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-01" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin  border-color-light-medium-gray">
                                    <p class="fw-400 fs-14 lh-19">More sessions coming up for Medical & STEM
                                        aspirants — reach out
                                        to our counsellors.More sessions coming up for Medical & STEM
                                        aspirants — reach out to our counsellors.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->
                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header  border-color-extra-medium-gray">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-02"
                                    aria-expanded="false" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-black">
                                        <i class="feather icon-feather-plus"></i><span
                                            class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Avoid
                                            common SOP/LOR
                                            mistakes that cost students</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-02" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin  border-color-light-medium-gray">
                                    <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to use
                                        your audience to
                                        make a positive move.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header  border-color-extra-medium-gray">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-022-022"
                                    aria-expanded="false" data-bs-parent="#accordion-style-022">
                                    <div class="accordion-title mb-0 position-relative text-black">
                                        <i class="feather icon-feather-plus"></i><span
                                            class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Avoid
                                            common SOP/LOR
                                            mistakes that cost students</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-022-022" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-style-022">
                                <div class="accordion-body last-paragraph-no-margin  border-color-light-medium-gray">
                                    <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to use
                                        your audience to
                                        make a positive move.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->
                        <!-- start accordion item -->

                        <div class="accordion-item">
                            <div class="accordion-header  border-color-transparent">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-04"
                                    aria-expanded="false" data-bs-parent="#accordion-style-04">
                                    <div class="accordion-title mb-0 position-relative text-black">
                                        <i class="feather icon-feather-plus"></i><span
                                            class="fw-600 fs-16 lh-20 ls-minus-05px mobile-fs-14 mobile-fw-500 mobile-lh-18">Learn
                                            how
                                            our team
                                            supports you through it all</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-04" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-style-04">
                                <div class="accordion-body last-paragraph-no-margin  border-color-transparent">
                                    <p class="fw-400 fs-14 lh-19">We deliver customized marketing campaign to use
                                        your audience to
                                        make a positive move.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->
                    </div>
                </div>
            </div>
        </section>

  </div>
        <!-- start section -->

        <!-- start section -->
        <?php $this->load->view('partials/testimonials'); ?>

  
 <?php $this->load->view('footer'); ?> 

    <script>
        // PurplePremium modal/apply logic (single source of truth for this page).
        window.ppOpenModal = function () {
            var el = document.getElementById('ppPremiumModal');
            if (!el) return false;
            el.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            return false;
        };
        window.ppCloseModal = function () {
            var el = document.getElementById('ppPremiumModal');
            if (!el) return false;
            el.style.display = 'none';
            document.body.style.overflow = '';
            return false;
        };
        window.ppApplyNow = function (btn) {
            try {
                var originalText = btn && btn.textContent ? btn.textContent : 'Apply Now';
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Submitting...';
                }

                fetch('<?= base_url("Home/apply_purplepremium") ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (data && data.success) {
                        // Requirement: insert pending in DB and reload so page shows "Already Applied".
                        location.reload();
                        return;
                    }
                    alert((data && data.message) ? data.message : 'Something went wrong');
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                })
                .catch(function (e) {
                    console.error(e);
                    alert('Something went wrong. Please try again.');
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                });
            } catch (e) {
                console.error(e);
            }
            return false;
        };
    </script>

 <div id="applicantPremiumModal" class="mobile-applicant pgs-modal premium-modal-overlay" style="display: none;" onclick="if(event.target===this){window.applicatModalCloseModal();}">
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
                    <div class="sub-label fnt-family">Application Prep</div>
                    <p class="tagline lh-18ppx">Know what to keep ready before you start your applications, from documents and SOPs to tests, timelines, and shortlisting.</p>

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
                                <input type="text" id="nameInput" placeholder="Enter Name" autocomplete="name">
                            </div>
                            <div class="field">
                                <input type="email" id="emailInput" placeholder="Email" autocomplete="email">
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
                                    <span>What documents I need before applying</span>
                                </label>
                                <label class="toggle-row">
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked="">
                                        <span class="slider"></span>
                                    </label>
                                    <span>SOP / LOR preparation</span>
                                </label>
                                <label class="toggle-row">
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked="">
                                        <span class="slider"></span>
                                    </label>
                                    <span>Test requirements (IELTS, GRE, etc.)</span>
                                </label>
                                <label class="toggle-row">
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked="">
                                        <span class="slider"></span>
                                    </label>
                                    <span>Application timeline</span>
                                </label>
                            </div>
                        </div>

                        <br />

                        <div class="divider"></div>
						
						  <div>
                        <p class="section-label mb-2">What are you planning to study?</p>
                        <div class="d-flex gap-3">
                             <select id="selectOption" class="modal-btn-pgs">
                                 <option value="1">MS / Masters Abroad</option>
                                 <option value="2">MS / Masters Abroad - 1</option>
                             </select>
                            <label for="selectOption">
                                <img src="<?= base_url('assets/img/arrow-btn.png') ?>" style="width : 26px; height :26px" />
                            </label>

                        </div>
                    </div>


                        <div class="cta-row">
                            <button class="cta-btn" id="ctaBtn">
                                GET MY CHECKLIST
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

        <div id="applicantPremiumModal2" class="pgs-modal premium-modal-overlay" style="display: none" onclick="if(event.target===this){window.applicatModalCloseModal2();}">
            <div class="premium-modal-container purple-modal d-flex bg-white pgs-modal-2" style="border-radius: 20px !important">
                <button class="close-btn" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal2();">✕</button>

                <div class="text-center">
                    <h5 class="fw-700 fs-48 text-black"><img src="<?= base_url('assets/img/check-12.png') ?>" style="width : 50px" />you’re in</h5>
                    <img src="<?= base_url('assets/img/okk.png') ?>" class="w-50%" />
                    <h5 class="fw-400 fs-24 fnt-family text-black">lets get things moving.</h5>
                </div>
                <div class="w-180px">
                    <p class="fs-13 fw-400 mb-5 text-black lh-15">
                        We’ve sent the #PGS Study Toolkit to your email.

                    </p>
                    <p class="fs-13 fw-400 mb-5 text-black lh-15">
                        This covers the basics you actually need.

                    </p>
                    <p class="fs-13 fw-400 mb-5 text-black lh-15">
                        We’ll send your study toolkit and important updates on WhatsApp (If you shared your WhatsApp number) (No spam. Unsubscribe anytime)
                    </p>
                </div>
                <div>
                    <img src="<?= base_url('assets/img/heart.gif') ?>" style="width: 50px;border-radius: 10px;margin: 0 0 0 auto;display: block;" />
                    <div style="background : #150035" class="p-3 mt-4">
                        <p class="fs-13 lh-15 text-white mb-4">Need to sort out the study journey?</p>
                        <p class="fs-13 lh-15 text-white mb-4">Book a free 15min clarity call</p>
                    </div>
                </div>
            </div>
        </div>



    <!-- PurplePremium Application Modal -->
    <div id="ppPremiumModal" class="premium-modal-overlay" style="display: none;" onclick="if(event.target===this){window.ppCloseModal();}">
        <div class="premium-modal-container">
            <button type="button" class="premium-modal-close" onclick="return window.ppCloseModal();">×</button>

            <div class="premium-modal-header">
                <h1 class="fnt-family fs-75 text-black mb-0 text-center" style="line-height: 1;">#PurplePremium</h1>
                <h2 class="fnt-family fs-38 text-black mb-3 text-center mt-3">Unlock Full Dashboard Access</h2>
            </div>

            <div class="premium-modal-body">
                <p class="fs-24 lh-full text-black fnt-family mb-4 text-center">
                    Unlock the full dashboard experience <span class="bg-yellow">with #PurplePremium</span>
                </p>

                <p class="fs-19 lh-24 text-black fnt-family mb-4 text-center">
                    We accept only a <span class="bg-yellow">limited number of seats each month</span>, connect with our Help Hub to get in.
                </p>

                <div class="premium-features-box">
                    <div class="premium-feature-item">
                        <div class="premium-feature-icon">✓</div>
                        <span class="fs-18 lh-24 text-black fnt-family">Mentor support & guidance</span>
                    </div>
                    <div class="premium-feature-item">
                        <div class="premium-feature-icon">✓</div>
                        <span class="fs-18 lh-24 text-black fnt-family">Admissions help</span>
                    </div>
                    <div class="premium-feature-item">
                        <div class="premium-feature-icon">✓</div>
                        <span class="fs-18 lh-24 text-black fnt-family">Full dashboard access</span>
                    </div>
                </div>
            </div>

            <div class="premium-modal-footer">
                <button type="button" class="btn-premium-cancel" onclick="return window.ppCloseModal();">Cancel</button>
                <button type="button" class="btn-premium-apply" id="ppApplyBtn" onclick="return window.ppApplyNow(this);">Apply Now</button>
            </div>

            <div id="premiumModalMessage" class="mt-3 text-center" style="display: none;"></div>
        </div>
    </div>

    <style>
    /* Premium Modal Styles */
    .premium-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .premium-modal-container {
        background: #fff;
        padding: 50px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        position: relative;
        max-width: 650px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .premium-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        font-size: 30px;
        line-height: 30px;
        color: #000;
        background: transparent;
        border: none;
        cursor: pointer;
        z-index: 10001;
        text-align: center;
        padding: 0;
        transition: color 0.3s;
    }

    .premium-modal-close:hover {
        color: #2489FF;
    }

    .premium-modal-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 2px solid #f0f0f0;
    }

    .premium-modal-body {
        margin-bottom: 35px;
    }

    .premium-features-box {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        margin-top: 25px;
    }

    .premium-feature-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .premium-feature-item:last-child {
        margin-bottom: 0;
    }

    .premium-feature-icon {
        width: 28px;
        height: 28px;
        background: #2489FF;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
        flex-shrink: 0;
    }

    .premium-modal-footer {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .btn-premium-cancel {
        padding: 14px 35px;
        background: transparent;
        color: #6c757d;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .btn-premium-cancel:hover {
        background: #f8f9fa;
        border-color: #adb5bd;
    }

    .btn-premium-apply {
        padding: 14px 35px;
        background: #2489FF;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 700;
        font-family: inherit;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(36, 137, 255, 0.3);
    }

    .btn-premium-apply:hover {
        background: #1a7ae6;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(36, 137, 255, 0.4);
    }

    .btn-premium-apply:disabled {
        background: #adb5bd;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    @media (max-width: 768px) {
        .premium-modal-container {
            padding: 35px 25px;
        }

        .premium-modal-footer {
            flex-direction: column;
        }

        .btn-premium-cancel,
        .btn-premium-apply {
            width: 100%;
        }
    }
    </style>

      <?php
            $pp_should_open_premium =
                ($pp_logged_in && $pp_premium !== 'approved' && $pp_premium !== 'pending')
                && (
                    (isset($_GET['openPremium']) && $_GET['openPremium'] == '1')
                    || ($this->session->flashdata('openPremium') == '1')
                );
        ?>
    <!-- Modal/apply handled by ppOpenModal/ppCloseModal/ppApplyNow above -->
     <script>
        // PurplePremium modal/apply logic (single source of truth for this page).
        window.ppOpenModalset = function() {
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
        <?php if ($pp_should_open_premium): ?>
        window.ppOpenModalset();
        <?php endif; ?>
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

 <!-- SweetAlert2: same styled popup as the home page study-journey form -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
 <script>
            function showStudyJourneyAlert(type, message) {
                if (window.Swal && Swal.fire) {
                    Swal.fire({
                        icon: type,
                        title: type === 'success' ? 'Submitted' : 'Oops',
                        text: message,
                        confirmButtonColor: '#6A5ED9'
                    });
                    return;
                }
                alert(message);
            }

            (function() {
                var btn = document.getElementById('homeHeroSignupBtn');
                var input = document.getElementById('homeHeroSignupEmail');
                if (!btn || !input) return;
                btn.addEventListener('click', function() {
                    var email = (input.value || '').trim();
                    if (!email) {
                        input.focus();
                        return;
                    }
                    input.setCustomValidity('');
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        return;
                    }
                    var loginUrl = <?= json_encode(site_url('Login')) ?>;
                    var sep = loginUrl.indexOf('?') >= 0 ? '&' : '?';
                    window.location.href = loginUrl + sep + 'signup=1&email=' + encodeURIComponent(email);
                });
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        btn.click();
                    }
                });
            })();

            let currentStep = 1;
            const totalSteps = 4;
            const progressBar = document.getElementById('progress-bar');
            const stepCounter = document.getElementById('step-counter');

            function updateProgress() {
                const percent = (currentStep / totalSteps) * 100;
                progressBar.style.width = percent + '%';
                stepCounter.textContent = `Step ${currentStep} of ${totalSteps}`;
            }

            function goToNextStep() {
                document.querySelector(`.step-${currentStep}`).classList.add('hidden');
                currentStep++;
                document.querySelector(`.step-${currentStep}`).classList.remove('hidden');
                updateProgress();
            }

            function goBack() {
                // Before going back, if returning from step 3 → clear step 2 selections
                if (currentStep === 3) {
                    clearStepInputs(2);
                }
                if (currentStep === 4) {
                    clearStepInputs(3);
                }

                document.querySelector(`.step-${currentStep}`).classList.add('hidden');
                currentStep--;
                document.querySelector(`.step-${currentStep}`).classList.remove('hidden');
                updateProgress();
            }

            function finishForm() {
                const form = document.getElementById('studyJourneyForm');
                const submitBtn = document.getElementById('studyJourneySubmitBtn');
                if (!form) return;

                const allRequired = ["youare", "stream", "country", "study_level", "plan", "countries"];
                const missingRadio = allRequired.find(name => !document.querySelector(`input[name="${name}"]:checked`));
                if (missingRadio) {
                    showStudyJourneyAlert('warning', "Please complete all required questions before submitting.");
                    return;
                }

                const name = (form.querySelector('[name="name"]').value || '').trim();
                const email = (form.querySelector('[name="email"]').value || '').trim();
                const phone = (form.querySelector('[name="number"]').value || '').trim();

                if (name.length < 2) {
                    showStudyJourneyAlert('warning', "Please enter your name.");
                    form.querySelector('[name="name"]').focus();
                    return;
                }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showStudyJourneyAlert('warning', "Please enter a valid email address.");
                    form.querySelector('[name="email"]').focus();
                    return;
                }
                if (!/^[0-9]{7,15}$/.test(phone)) {
                    showStudyJourneyAlert('warning', "Please enter a valid phone number.");
                    form.querySelector('[name="number"]').focus();
                    return;
                }

                const originalHtml = submitBtn ? submitBtn.innerHTML : '';
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="btn-loader" aria-label="Loading"></span>';
                }

                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        showStudyJourneyAlert(data.success ? 'success' : 'error', data.message || (data.success ? 'Form submitted successfully.' : 'Unable to submit your details right now.'));
                        if (data.success) {
                            form.reset();
                            document.querySelector(`.step-${currentStep}`).classList.add('hidden');
                            currentStep = 1;
                            document.querySelector('.step-1').classList.remove('hidden');
                            updateProgress();
                        }
                    })
                    .catch(() => {
                        showStudyJourneyAlert('error', "Unable to submit your details right now. Please try again.");
                    })
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalHtml;
                        }
                    });
            }

            // ✅ Function to clear all selected inputs in a given step
            function clearStepInputs(stepNumber) {
                const step = document.querySelector(`.step-${stepNumber}`);
                if (step) {
                    const inputs = step.querySelectorAll('input[type="radio"], input[type="checkbox"]');
                    inputs.forEach(input => input.checked = false);
                }
            }

            // Required fields for each step (checked by the "Next" button)
            const stepRequirements = {
                1: ["youare", "stream"],
                2: ["country", "study_level"],
                3: ["plan", "countries"]
            };

            // Advance only when the user clicks "Next" and every required
            // question in the current step has been answered.
            function nextStep() {
                const requiredNames = stepRequirements[currentStep] || [];
                const allSelected = requiredNames.every(n => document.querySelector(`input[name="${n}"]:checked`));
                if (!allSelected) {
                    showStudyJourneyAlert('warning', "Please answer all questions in this step before continuing.");
                    return;
                }
                goToNextStep();
            }

            updateProgress();
        </script>


    <?php
        $sh_should_open_premium =
            ($sh_logged_in && $sh_premium !== 'approved' && $sh_premium !== 'pending')
            && (
                (isset($_GET['openPremium']) && $_GET['openPremium'] == '1')
                || ($this->session->flashdata('openPremium') == '1')
            );
    ?>
    <?php if ($sh_should_open_premium): ?>
        <script>window.ppOpenModal && window.ppOpenModal();</script>
    <?php endif; ?>
     <?php $this->load->view('partials/study_journey_scripts'); ?>
     
     
       <?php
        $pp_should_open_premium =
            ($pp_logged_in && $pp_premium !== 'approved' && $pp_premium !== 'pending')
            && (
                (isset($_GET['openPremium']) && $_GET['openPremium'] == '1')
                || ($this->session->flashdata('openPremium') == '1')
            );
    ?>
    <?php if ($pp_should_open_premium): ?>
        <script>window.ppOpenModal && window.ppOpenModal();</script>
    <?php endif; ?>
</body>

</html>