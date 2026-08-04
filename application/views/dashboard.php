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
    <style>
        .avatar-box
        {
                visibility: hidden;
        }
        
        /* Fix button hover text color - ensure white text on hover */
        .btn-progress {
            color: #ffffff !important;
            transition: color 0.2s ease;
        }
        
        .btn-progress:hover,
        .btn-progress:focus,
        .btn-progress:active,
        .btn-progress:visited {
            color: #ffffff !important;
        }

       .dashboard-calendar-card {
           background: #f7f7f7;
           border: 1px solid #e0e0e0;
           border-radius: 12px;
           box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
           padding: 18px 20px;
           width: 100%;
       }

       .dashboard-calendar-header {
           display: grid;
           grid-template-columns: 42px 1fr 42px;
           align-items: center;
           gap: 12px;
           margin-bottom: 16px;
       }

       .dashboard-calendar-arrow {
           width: 34px;
           height: 34px;
           border-radius: 50%;
           background: #ffffff;
           display: inline-flex;
           align-items: center;
           justify-content: center;
           color: #000000;
           font-size: 28px;
           line-height: 1;
           font-weight: 600;
       }

       .dashboard-calendar-arrow.next {
           background: #0b55ff;
           color: #ffffff;
       }

       .dashboard-calendar-month {
           display: flex;
           justify-content: center;
           gap: 4px;
       }

       .dashboard-calendar-month span {
           background: #ffffff;
           border-radius: 4px;
           color: #222222;
           font-size: 17px;
           font-weight: 800;
           line-height: 38px;
           min-width: 72px;
           padding: 0 10px;
           text-align: center;
           text-transform: uppercase;
       }

       .dashboard-calendar-week,
       .dashboard-calendar-days {
           display: grid;
           grid-template-columns: repeat(7, minmax(0, 1fr));
           gap: 5px;
       }

       .dashboard-calendar-week span {
           color: #333333;
           font-size: 14px;
           font-weight: 700;
           text-align: center;
           line-height: 28px;
       }

       .dashboard-calendar-day {
           background: #ffffff;
           border-radius: 5px;
           color: #333333;
           font-size: 14px;
           font-weight: 700;
           height: 34px;
           line-height: 34px;
           text-align: center;
       }

       .dashboard-calendar-day.is-muted {
           background: transparent;
           color: #cdd2dc;
       }

       .dashboard-calendar-day.has-event {
           background: #0b55ff;
           box-shadow: 0 3px 8px rgba(11, 85, 255, 0.28);
           color: #ffffff;
       }

       .grid-box-style-2.dashboard-events-board {
           display: grid !important;
           grid-template-columns: repeat(2, minmax(0, 1fr));
           gap: 16px 24px;
           align-items: center;
       }

       .grid-box-style-2.dashboard-events-board .dashboard-event-card {
           border: 1px solid #cfcfcf !important;
           border-radius: 12px;
           color: inherit;
           display: block;
           padding: 10px !important;
           min-height: 124px;
           background: #ffffff;
           text-decoration: none;
           transition: transform 0.2s ease, box-shadow 0.2s ease;
       }

       .grid-box-style-2.dashboard-events-board .dashboard-event-card:hover,
       .grid-box-style-2.dashboard-events-board .dashboard-event-card:focus {
           box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
           color: inherit;
           text-decoration: none;
           transform: translateY(-2px);
       }

       .dashboard-event-row {
           display: flex;
           gap: 5px;
           align-items: flex-start;
           flex-wrap: wrap;
       }

       .dashboard-event-chip {
           background: #000000;
           color: #9f54ff;
           display: inline-block;
           font-size: 16px;
           font-weight: 800;
           line-height: 22px;
           padding: 0 4px;
       }

       .dashboard-event-chip.title {
           max-width: 140px;
       }

       .grid-box-style-2.dashboard-events-board .dashboard-event-card p {
           color: #1c1c1c;
           font-size: 9px;
           line-height: 11px;
       }

       .grid-box-style-2.dashboard-events-board .dashboard-event-more {
           min-height: 124px;
       }
    </style>
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
            <section class="pt-0 mobile-student-cart about-section half-section overlap-height position-relative overflow-hidden minus-10 pl-100px">
                <div class="w-729px p-0">
                        <div class="card-box-avatar mt-2">
                            <div class="avatar-info position-relative">
                                <div class="avatar-img">
                                    <img src="<?= isset($user->image1) && $user->image1 ? base_url('assets/images/'.$user->image1) : base_url('assets/img/default-avatar.png') ?>" alt="" class="border-radius-6px" data-no-retina="">
                                    <!--<div class="choose-avatar-text">-->
                                    <!--    <label for="chooseImg">-->
                                    <!--        <img src="./assets/img/edit-03.png" />-->
                                    <!--    </label>-->
                                    <!--    <input type="file" id="chooseImg" accept="image/*" class="d-none">-->
                                    <!--</div>-->
                                    <div class="avatar_name">
                                        <h5 class="mb-3"><?= isset($user->name) && !empty($user->name) ? htmlspecialchars($user->name) : 'User' ?></h5>
                                        <span><?= isset($user->email) ? htmlspecialchars($user->email) : '' ?></span>
                                        <!-- <span>id: <?= isset($user->id) ? $user->id : '' ?></span> -->
                                    </div>
                                </div>
                                <div class="title-info">
                                    <h5 class="mb-0">#purplePremium</h5>
                                    <h6 class="mb-0">stem PATHWAY</h6>
                                </div>
                            </div>
                            <div class="avatar-heading-right-box">
                                <h4 class="mb-0">#PURPLEPREMIUM</h4>
                                
                            </div>
                        </div>

                    </div>
                <div class="container overlap-gap-section p-0">
                    <div class="row align-items-end mt-4">
                        <div class="w-616px">
                            <div class="">
                                <h1 class="text-start text-black fnt-family fw-500 fs-76 custom-padding-10 lh-full mb-0 pb-2 mobile-fs-24 mobile-text-center">
                                    counsellor <br/> page for <br/> students</h1>
                            </div>
                            <div class="card-overview mt-10" id="quick-dashboard-overview" style="scroll-margin-top: 140px;">
                                <h5 class="text-black text-center fs-17 lh-22 fw-600 mb-3">Your Quick Dashboard overview</h5>
                            </div>
                            <div class="d-flex gap-3 justify-content-space mobile-wrap-2-template">
                                <div class="card-fill-box">
                                    Uni <br /> Applied
                                    <div class="d-flex justify-content-space">
                                        <span>|</span>
                                        <span><?= isset($dashboard) && isset($dashboard->uni_applied) ? $dashboard->uni_applied : '0' ?></span>
                                    </div>
                                </div>
                                <div class="card-fill-box">
                                    Offers <br />Received
                                    <div class="d-flex justify-content-space">
                                        <span>|</span>
                                        <span><?= isset($dashboard) && isset($dashboard->offers_received) ? $dashboard->offers_received : '0' ?></span>
                                    </div>
                                </div>
                                <div class="card-fill-box">
                                    Tuition Receipt <br />
                                    Uploaded
                                    <div class="d-flex justify-content-space">
                                        <span>|</span>
                                        <label class="toggle-switch">
                                            <input type="checkbox" <?= (isset($dashboard) && $dashboard->tuition_receipt_uploaded) ? 'checked' : '' ?> disabled>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-fill-box">
                                    Visa <br />Applied
                                    <div class="d-flex justify-content-space">
                                        <span>|</span>
                                        <label class="toggle-switch">
                                            <input type="checkbox" <?= (isset($dashboard) && $dashboard->visa_applied) ? 'checked' : '' ?> disabled>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-303px p-0">
                            <div class="group-todo-list">
                                <div class="top-todo-list" id="top-picks">
                                    <div class="d-flex justify-content-space">
                                        <h4 class="mb-0 fs-20 text-black lh-20 mt-2">Top picks &nbsp;&nbsp;></h4>
                                        <img src="./assets/img/filter-icon.png" />
                                    </div>
                                    <hr />

                                    <?php
                                    $top_pick_items = [];
                                    $top_pick_dot_classes = ['yellow-bg', 'blue-bg', 'red-bg', 'purple-bg', 'yellow-dark-bg'];
                                    $top_pick_events = isset($events) && is_array($events) ? array_slice($events, 0, 3) : [];
                                    $top_pick_course_limit = max(5 - count($top_pick_events), 0);
                                    $top_pick_courses = isset($top_pick_courses) && is_array($top_pick_courses) ? array_slice($top_pick_courses, 0, $top_pick_course_limit) : [];
                                    $base_url_no_slash = rtrim(base_url(), '/');
                                    if (preg_match('#/pgs/?$#', $base_url_no_slash)) {
                                        $admin_assets_images_base = preg_replace('#/pgs/?$#', '/pgs_admin', $base_url_no_slash) . '/assets/images/';
                                    } else {
                                        $admin_assets_images_base = $base_url_no_slash . '/admin/assets/images/';
                                    }

                                    foreach ($top_pick_events as $event_pick) {
                                        $event_ts = !empty($event_pick->s_date) ? strtotime($event_pick->s_date) : false;
                                        $event_label = $event_ts ? strtoupper(date('M j', $event_ts)) : 'Event';
                                        $event_tag = !empty($event_pick->category_name) ? $event_pick->category_name : (!empty($event_pick->tags) ? trim(strtok($event_pick->tags, " ,#\n\r\t")) : 'event');
                                        $top_pick_items[] = [
                                            'title' => !empty($event_pick->product_name) ? $event_pick->product_name : 'Upcoming Event',
                                            'label' => $event_label,
                                            'tag' => $event_tag,
                                            'image' => event_image_url($event_pick->image1 ?? null, base_url('assets/img/computer.jpg'), $event_pick->image2 ?? null),
                                            'url' => base_url('purpleevents/session/' . (int) $event_pick->id),
                                        ];
                                    }

                                    foreach ($top_pick_courses as $course_pick) {
                                        $course_tag = !empty($course_pick->category_name) ? $course_pick->category_name : (!empty($course_pick->tags) ? trim(strtok($course_pick->tags, " ,#\n\r\t")) : 'course');
                                        $course_label = !empty($course_pick->e_date) ? 'Open' : 'Course';
                                        $top_pick_items[] = [
                                            'title' => !empty($course_pick->product_name) ? $course_pick->product_name : 'Course',
                                            'label' => $course_label,
                                            'tag' => $course_tag,
                                            'image' => !empty($course_pick->image1) ? ($admin_assets_images_base . $course_pick->image1) : base_url('assets/img/saved_1.jpg'),
                                            'url' => base_url('Programsfull/program/' . (int) $course_pick->id),
                                        ];
                                    }
                                    $top_pick_items = array_slice($top_pick_items, 0, 5);
                                    ?>

                                    <?php if (!empty($top_pick_items)): ?>
                                        <?php foreach ($top_pick_items as $top_pick_index => $top_pick): ?>
                                            <a href="<?= htmlspecialchars($top_pick['url']) ?>" class="todo-list text-decoration-none">
                                                <div class="content-todo">
                                                    <h5 class="mb-0"><?= htmlspecialchars($top_pick['title']) ?></h5>
                                                    <span class="todo-tag"><?= htmlspecialchars($top_pick['label']) ?></span>
                                                    <span class="todo-tag-hightlist"><span
                                                            class="<?= htmlspecialchars($top_pick_dot_classes[$top_pick_index % count($top_pick_dot_classes)]) ?> dot-tag"></span>#<?= htmlspecialchars(ltrim($top_pick['tag'], '#')) ?></span>
                                                </div>
                                                <div class="img-wrap">
                                                    <img src="<?= htmlspecialchars($top_pick['image']) ?>" onerror="this.src='<?= base_url('assets/img/computer.jpg') ?>'" />
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="todo-list">
                                            <div class="content-todo">
                                                <h5 class="mb-0">No top picks available yet.</h5>
                                                <span class="todo-tag">Soon</span>
                                                <span class="todo-tag-hightlist"><span class="yellow-bg dot-tag"></span>#pgs</span>
                                            </div>
                                            <div class="img-wrap">
                                                <img src="./assets/img/computer.jpg" />
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="d-flex gap-3 mt-5 align-items-start mobile-notes-div">
                                <div
                                    class="notes-box w-50 d-flex flex-grid pt-3 pb-3 justify-content-center flex-direction-column">
                                    <h5 class="mb-2 text-black fs-17 lh-22 fw-600">Notes</h5>
                                    <p class="mb-0 text-black fs-14 lh-19">
                                        This is the phase where we check your documents, get your applications ready, and
                                        start
                                        planning your university journey. Got questions or need feedback? Reach out to your
                                        counselor anytime—and make sure to join any upcoming sessions we invite you to.
                                    </p>
                                </div>
                                <div class="w-50 position-relative">
                                    <div class="mobile-width-set">
                                    <div>
                                        <h5 class="mb-0 bg-bluey fs-19 lh-19 fw-500">MBA Aspirant @class of 2025</h5>
                                    </div>
                                
                                    <div class="lh-full">
                                        <h6 class="mb-0 bg-dark-pink fs-12 lh-12">Gender</h6>
                                    </div>
                                    <div class="lh-full">
                                        <h6 class="mb-0 bg-bluey  fs-12 lh-12">Male</h6>
                                    </div>
                                    <div class="d-flex lh-full align-items-center">
                                        <div class="bg-light-yellow-2 w-12-ht-19"><i class="bi bi-ui-radios-grid"></i></div>
                                        <div class="bg-light-yellow w-12-ht-19"><i class="bi bi-geo-alt-fill"></i></div>
                                        <h5 class="bg-dark-pink  fs-12 lh-12 mb-0">White Town, Pondicherry</h5>
                                    </div>
                                    <div class="d-flex ht-custom25">
                                        <div class="light-gray-bg"><img src="./assets/img/US.png"></div>
                                        <div class="bg-bluey lh-12">USA</div>
                                        <div class="light-gray-bg"><img src="./assets/img/US.png"></div>
                                        <div class="bg-bluey px-2 lh-12">UK</div>
                                    </div>
                                                                    </div>

                                    <div class="">
                                        <div class="post-arrow">
                                            <img src="./assets/img/top-down-arrow.png" />
                                            <p>See what’s done,
                                                what’s in progress,
                                                and what’s coming next.</p>
                                        </div>
                                        <a href="<?= base_url('Feed_track_progress') ?>" class="btn-progress" style="text-decoration: none; display: inline-block;">Track Your Progress</a>
                                        <a href="<?= base_url('purpleboard') ?>" class="btn-progress" style="text-decoration: none; display: inline-block;">#purpleBoard</a>
                                        <div class="post-arrow-2">
                                            <img src="./assets/img/left-right.png" />
                                            <p>Get the latest on scholarships, newly opened courses, and important updates,
                                                all in one place. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="w-841px m-auto">

            <section class="content-report" id="where-you-stand" style="scroll-margin-top: 140px;">
                <div class="">
                    <div class="text-center">
                        <h2 class="mb-1 fnt-family text-black fs-38 mobile-fs-24">Where You Stand</h2>
                        <p class="mb-3 w-60 fs-16 lh-19 m-auto text-black mobile-fs-14 text-start">This is the heart of your study path. This centralized study
                            dashboard helps you track onboarding,
                            monitor progress, see key milestones, and identify next steps. Designed to keep you on track.
                        </p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-11 m-auto p-0">
                            <div class="card-box-border pb-10">
                                <div class="d-flex gap-4 w-100  justify-content-center mobile-wrap-box-style-4">
                                    <div class="w-100px d-flex align-items-center m-auto">
                                        <div class="">
                                            <h5 class="fnt-family text-back fs-60 text-black mb-0"><?= isset($dashboard) && isset($dashboard->onboarding_percentage) ? $dashboard->onboarding_percentage : 14 ?>%</h5>
                                            <h6 class="mb-0 text-black fs-16 lh-19">through your <br />
                                                onboarding <br />
                                                journey</h6>

                                        </div>
                                    </div>
                                    <div class="w-40">
                                        <div class="checkbox-card">
                                            <h5 class="mb-5">Onboarding Checklist </h5>
                                            <?php if(isset($onboarding_checklist) && count($onboarding_checklist) > 0): ?>
                                                <?php foreach($onboarding_checklist as $item): ?>
                                                <div class="d-flex align-items-center gap-4 mb-4">
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" <?= (isset($item['checked']) && $item['checked']) ? 'checked' : '' ?> disabled>
                                                        <span class="slider"></span>
                                                    </label>
                                                    <span class="w-80 text-start"><?= htmlspecialchars($item['text'] ?? '') ?></span>
                                                </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="text-muted">No checklist items configured</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="w-40">
                                        <div class="checkbox-card" style="height : 60%">
                                            <h5 class="mb-5"><?= isset($dashboard) && isset($dashboard->feedback_session_title) ? htmlspecialchars($dashboard->feedback_session_title) : 'June feedback session' ?></h5>
                                            <?php if(isset($feedback_session_items) && count($feedback_session_items) > 0): ?>
                                                <?php foreach($feedback_session_items as $item): ?>
                                                <div class="d-flex align-items-center gap-4 mb-4">
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" <?= (isset($item['checked']) && $item['checked']) ? 'checked' : '' ?> disabled>
                                                        <span class="slider"></span>
                                                    </label>
                                                    <span class="w-80 text-start"><?= htmlspecialchars($item['text'] ?? '') ?></span>
                                                </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="text-muted">No feedback items configured</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-4 w-100 justify-content-start mt-3 mobile-wrap-box-style-4">
                                    <div class="w-100px d-flex align-items-center" style="margin-left: 9px;margin-right: -5px;">
                                        <h5 class="fnt-family text-back fs-40 text-black mb-0">Prep Status</h5>

                                    </div>
                                    <div class="w-264px">
                                        <div class="checkbox-card">
                                            <h5 class="mb-5">Documents Tracker</h5>
                                            <?php if(isset($documents_tracker) && count($documents_tracker) > 0): ?>
                                                <?php foreach($documents_tracker as $doc_name => $doc_data): ?>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <h1 class="mb-0 text-black fs-36 fw-500 w-20 lh-40 <?= (isset($doc_data['is_red']) && $doc_data['is_red']) ? 'text-red' : '' ?>">
                                                        <?= isset($doc_data['count']) ? $doc_data['count'] : 0 ?>
                                                    </h1>
                                                    <span class="w-80 text-start"><?= htmlspecialchars($doc_name) ?></span>
                                                </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="text-muted">No documents configured</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="w-264px">
                                        <div class="checkbox-card pbs-100" style="height: 90%;">
                                            <h5 class="mb-5">Uni Shortlist</h5>
                                            <?php if(isset($uni_shortlist) && count($uni_shortlist) > 0): ?>
                                                <?php foreach($uni_shortlist as $item): ?>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <h1 class="mb-0 fs-30 fw-500 w-20 text-black"><?= isset($item['count']) ? $item['count'] : 0 ?></h1>
                                                    <span class="w-80 text-start"><?= htmlspecialchars($item['name'] ?? '') ?></span>
                                                </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="text-muted">No shortlist items configured</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 p-0" id="finalized-universities" style="scroll-margin-top: 140px;">
                            <div class="bg-black d-flex border-radius-20px p-2" style="margin-top: -7px;">
                                <div class="w-25 d-flex align-items-center justify-content-center">
                                    <div>
                                        <h5 class="fnt-family text-back fs-60 text-white mb-0"><?= isset($universities) ? count($universities) : 0 ?></h5>
                                        <h5 class="fnt-family text-back fs-28 lh-24 text-white mb-0 fw-400">Finalized
                                            <br /> Uni List
                                        </h5>
                                    </div>
                                </div>
                                <div class="w-80">
                                    <div class="d-flex gap-3 flex-wrap">
                                        <?php if(isset($universities) && count($universities) > 0): ?>
                                            <?php foreach($universities as $uni): ?>
                                            <?php
                                            // Resolve image dynamically: per-row override first, then the
                                            // live master university image (admin-managed), then placeholder.
                                            $uni_image_file = !empty($uni->image)
                                                ? $uni->image
                                                : (!empty($uni->master_image) ? $uni->master_image : '');
                                            $uni_image_url = $uni_image_file
                                                ? base_url('assets/images/' . $uni_image_file)
                                                : base_url('assets/img/uni.jpg');
                                            ?>
                                            <div class="card-with-image w-30">
                                                <div class="header-caption">
                                                    <i class="bi bi-plus-circle-fill"></i> <?= htmlspecialchars($uni->university_name) ?>
                                                </div>
                                                <div class="fix-image-box position-relative">
                                                    <img src="<?= htmlspecialchars($uni_image_url) ?>"
                                                        onerror="this.src='<?= base_url('assets/img/uni.jpg') ?>'" />
                                                    <div class="caption--absoulte">
                                                        <?= !empty($uni->country) ? htmlspecialchars($uni->country) : '#USA' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-muted p-3">No universities finalized yet</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-11 m-auto p-0">
                            <div class="card-box-border pb-5 pt-5 px-5 mobile-flex-boxes">
                                <div class="w-70">
                                    <div class="d-flex align-items-center mb-4 gap-4" id="currently-working-on" style="scroll-margin-top: 140px;">
                                        <div class="w-35">
                                            <h1 class="mb-0 fnt-family text-black fs-38 lh-32 fw-400 mobile-fs-24 mobile-lh-full">You are <br />
                                                Currently <br />
                                                Working On</h1>
                                        </div>
                                        <div class="w-70">
                                            <div class="card-white-box-border">
                                                <?php if(isset($currently_working_on) && count($currently_working_on) > 0): ?>
                                                    <?php foreach($currently_working_on as $index => $task): ?>
                                                        <?php if(!empty(trim($task))): ?>
                                                        <div class="list-type">
                                                            <?= $index === 0 ? '<span>URGENT</span>' : '' ?>
                                                            <?= htmlspecialchars($task) ?>
                                                        </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="list-type text-muted">No tasks currently being worked on</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-4" id="future-tasks" style="scroll-margin-top: 140px;">
                                        <div class="w-35">
                                            <h1 class="mb-0 fnt-family text-black  fs-38 lh-32 fw-400 mobile-fs-24 mobile-lh-full">
                                                Future task
                                                <span class="" style="color:rgba(10, 191, 140, 1)">preview</span>
                                            </h1>
                                        </div>
                                        <div class="w-70">
                                            <div class="card-white-box-border">
                                                <?php if(isset($future_tasks) && count($future_tasks) > 0): ?>
                                                    <?php foreach($future_tasks as $index => $task): ?>
                                                        <?php if(!empty(trim($task))): ?>
                                                        <div class="list-type">
                                                            <?= $index === 1 ? '<span>IMP</span>' : '' ?>
                                                            <?= htmlspecialchars($task) ?>
                                                        </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="list-type text-muted">No future tasks scheduled</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pt-4 pb-0">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 d-flex gap-2 mobile-row-reverse">
                            <p class="mb-0 w-60 fw-600 text-black d-flex gap-2 fs-17 lh-22 qd-heading mobile-fs-14 mobile-lh-full">
                                <span>*</span>
                                Got a quick doubt? Drop it in the comments.
                                For detailed queries or feedback, reach out via email,
                                direct call, group meet, or join our feedback sessions.
                            </p>
                            <div class="w-30">
                                <div class="tag-perks mobile-tag-perks">Status</div>
                                <div>
                                    <span class="cardbox-scholarship">Ready for Your <br/> Input</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pt-4 pb-0">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <div class="comment-box-grid">
                                <h3>Comments</h3>

                                <!-- Add Comment Form -->
                                <div class="comment-input">
                                    <div class="comment-header">
                                        <?php 
                                        $user_avatar = (isset($user->image1) && !empty($user->image1)) 
                                            ? base_url('assets/images/'.$user->image1) 
                                            : base_url('assets/img/default-avatar.png');
                                        ?>
                                        <img src="<?= $user_avatar ?>" alt="<?= htmlspecialchars($user->name ?? 'User') ?>" 
                                            onerror="this.src='<?= base_url('assets/img/default-avatar.png') ?>'">
                                        <?= htmlspecialchars($user->name ?? 'User') ?>
                                    </div>
                                    <form id="addCommentForm">
                                        <div class="comment-text">
                                            <textarea name="comment_text" id="commentText" placeholder="Hey I am facing difficulty with my SOP can you help me out?"
                                                class="form-control" required></textarea>
                                        </div>
                                        <div class="comment-actions">
                                            <div class="vote-btns" style="visibility: hidden;">
                                                <button type="button"><i class="bi bi-arrow-up-short"></i></button>
                                                <button type="button"><i class="bi bi-arrow-down-short"></i></button>
                                            </div>
                                            <button class="comment-btn btn" type="submit" id="submitCommentBtn">Comment</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Comments List -->
                                <div id="commentsList" style="scroll-margin-top: 140px;">
                                    <?php if(isset($comments) && count($comments) > 0): ?>
                                        <?php foreach($comments as $comment_index => $comment): ?>
                                        <div class="comment-item <?= $comment_index >= 5 ? 'collapsed-comment d-none' : '' ?>" data-comment-id="<?= $comment->id ?>">
                                            <div class="comment-author">
                                                <?php 
                                                $comment_user_avatar = (isset($user->image1) && !empty($user->image1)) 
                                                    ? base_url('assets/images/'.$user->image1) 
                                                    : base_url('assets/img/default-avatar.png');
                                                ?>
                                                <img src="<?= $comment_user_avatar ?>" alt="<?= htmlspecialchars($user->name ?? 'User') ?>"
                                                    onerror="this.src='<?= base_url('assets/img/default-avatar.png') ?>'">
                                                <h4><?= htmlspecialchars($user->name ?? 'User') ?></h4>
                                            </div>
                                            <div class="comment-content">
                                                <?= nl2br(htmlspecialchars($comment->comment_text)) ?>
                                            </div>
                                            <?php if(!empty($comment->admin_reply)): ?>
                                            <div class="admin-reply" style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-left: 3px solid #6366f1; border-radius: 4px;">
                                                <div style="font-weight: 600; color: #6366f1; margin-bottom: 8px;">Admin Reply:</div>
                                                <div style="color: #333;"><?= nl2br(htmlspecialchars($comment->admin_reply)) ?></div>
                                                <?php if($comment->replied_at): ?>
                                                <div style="font-size: 12px; color: #666; margin-top: 8px;">
                                                    Replied on <?= date('d M Y, h:i A', strtotime($comment->replied_at)) ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="comment-footer">
                                                <span><?= date('d M Y, h:i A', strtotime($comment->created_at)) ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php if(count($comments) > 5): ?>
                                        <button type="button" class="btn btn-link w-100 comments-toggle" aria-expanded="false">Show <?= count($comments) - 5 ?> more <i class="bi bi-chevron-down"></i></button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="text-muted text-center p-4">No comments yet. Be the first to comment!</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content-report pt-10">
                <div class="">
                    <div class="text-center">
                        <h2 class="mb-4 fnt-family text-black fs-38 heading-up-event ">Upcoming Events</h2>
                    </div>
                    <?php
                    $dashboard_events = isset($events) ? $events : [];
                    if (!is_array($dashboard_events)) $dashboard_events = [];
                    $dashboard_event_cards = array_slice($dashboard_events, 0, 3);
                    // Total number of live/upcoming events (shown in the "+N more" badge).
                    $dashboard_more_count = count($dashboard_events);
                    $dashboard_calendar_ts = !empty($dashboard_events[0]->s_date) ? strtotime($dashboard_events[0]->s_date) : time();
                    if (!$dashboard_calendar_ts) $dashboard_calendar_ts = time();
                    $dashboard_month_start = strtotime(date('Y-m-01', $dashboard_calendar_ts));
                    $dashboard_month_key = date('Y-m', $dashboard_month_start);
                    $dashboard_month_label = strtoupper(date('F', $dashboard_month_start));
                    $dashboard_year_label = date('Y', $dashboard_month_start);
                    $dashboard_days_in_month = (int) date('t', $dashboard_month_start);
                    $dashboard_first_weekday = (int) date('N', $dashboard_month_start);
                    $dashboard_prev_month_days = (int) date('t', strtotime('-1 month', $dashboard_month_start));
                    $dashboard_event_days = [];
                    foreach ($dashboard_events as $calendar_event) {
                        $calendar_event_ts = !empty($calendar_event->s_date) ? strtotime($calendar_event->s_date) : false;
                        if ($calendar_event_ts && date('Y-m', $calendar_event_ts) === $dashboard_month_key) {
                            $dashboard_event_days[(int) date('j', $calendar_event_ts)] = true;
                        }
                    }
                    $dashboard_calendar_cells = [];
                    $dashboard_leading_days = $dashboard_first_weekday - 1;
                    for ($i = $dashboard_leading_days; $i > 0; $i--) {
                        $dashboard_calendar_cells[] = ['day' => $dashboard_prev_month_days - $i + 1, 'current' => false, 'event' => false];
                    }
                    for ($day = 1; $day <= $dashboard_days_in_month; $day++) {
                        $dashboard_calendar_cells[] = ['day' => $day, 'current' => true, 'event' => isset($dashboard_event_days[$day])];
                    }
                    while ((count($dashboard_calendar_cells) % 7) !== 0 || count($dashboard_calendar_cells) < 35) {
                        $dashboard_calendar_cells[] = ['day' => count($dashboard_calendar_cells) - $dashboard_leading_days - $dashboard_days_in_month + 1, 'current' => false, 'event' => false];
                    }
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-11 d-flex gap-3 mobile-grid-calendar">
                            <div class="w-50">
                                <div class="dashboard-calendar-card">
                                    <div class="dashboard-calendar-header">
                                        <span class="dashboard-calendar-arrow">&lsaquo;</span>
                                        <div class="dashboard-calendar-month">
                                            <span><?= htmlspecialchars($dashboard_month_label) ?></span>
                                            <span><?= htmlspecialchars($dashboard_year_label) ?></span>
                                        </div>
                                        <span class="dashboard-calendar-arrow next">&rsaquo;</span>
                                    </div>
                                    <div class="dashboard-calendar-week">
                                        <span>Mo</span>
                                        <span>Tu</span>
                                        <span>We</span>
                                        <span>Th</span>
                                        <span>Fr</span>
                                        <span>Sa</span>
                                        <span>Su</span>
                                    </div>
                                    <div class="dashboard-calendar-days">
                                        <?php foreach ($dashboard_calendar_cells as $cell): ?>
                                            <span class="dashboard-calendar-day<?= !$cell['current'] ? ' is-muted' : '' ?><?= $cell['event'] ? ' has-event' : '' ?>"><?= (int) $cell['day'] ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="w-50">
                                <div class="grid-box-style-2 dashboard-events-board">
                                    <?php if (!empty($dashboard_event_cards)): ?>
                                        <?php foreach ($dashboard_event_cards as $ev): ?>
                                            <?php
                                            $ev_sd = format_event_date($ev->s_date ?? '');
                                            $ev_ts = !empty($ev->s_date) ? strtotime($ev->s_date) : false;
                                            $ev_date_label = $ev_ts ? strtoupper(date('M j', $ev_ts)) : strtoupper(trim($ev_sd['month'] . ' ' . $ev_sd['day']));
                                            $ev_time_label = $ev_ts ? strtoupper(date(((int) date('i', $ev_ts) === 0 ? 'g A' : 'g:i A'), $ev_ts)) . ' IST' : '';
                                            $ev_title = !empty($ev->product_name) ? $ev->product_name : 'Upcoming Event';
                                            $ev_url = base_url('purpleevents/session/' . (int) $ev->id);
                                            $ev_description = '';
                                            foreach (['prod_sub_name', 'description', 'who_is_it_for'] as $field) {
                                                if (!empty($ev->{$field})) {
                                                    $ev_description = trim(strip_tags($ev->{$field}));
                                                    break;
                                                }
                                            }
                                            if (strlen($ev_description) > 120) {
                                                $ev_description = substr($ev_description, 0, 117) . '...';
                                            }
                                            $ev_mode = '';
                                            if (!empty($ev->mode)) {
                                                $ev_mode = $ev->mode;
                                            } elseif (!empty($ev->location_note)) {
                                                $ev_mode = $ev->location_note;
                                            }
                                            ?>
                                            <a href="<?= htmlspecialchars($ev_url) ?>" class="card-box-1 dashboard-event-card">
                                                <div class="dashboard-event-row">
                                                    <h5 class="dashboard-event-chip title mb-0"><?= htmlspecialchars($ev_title) ?></h5>
                                                    <h5 class="dashboard-event-chip mb-0"><?= htmlspecialchars($ev_date_label) ?></h5>
                                                    <?php if ($ev_time_label !== ''): ?>
                                                        <h5 class="dashboard-event-chip mb-0"><?= htmlspecialchars($ev_time_label) ?></h5>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($ev_description !== ''): ?>
                                                    <p class="mb-0 fw-400 mt-2"><?= htmlspecialchars($ev_description) ?></p>
                                                <?php endif; ?>
                                                <?php if ($ev_mode !== ''): ?>
                                                    <p class="mb-0 fw-400"><b>Mode:&nbsp;</b><?= htmlspecialchars($ev_mode) ?></p>
                                                <?php endif; ?>
                                            </a>
                                        <?php endforeach; ?>
                                        <?php if ($dashboard_more_count > 0): ?>
                                            <div class="card-box-1 border-none dashboard-event-more d-flex align-items-center justify-content-start">
                                                <div class="d-flex align-items-center">
                                                    <h2 class="text-black mb-0 fw-600 d-flex align-items-center gap-2"><span class="fnt-family fs-38 fw-400">+<?= (int) $dashboard_more_count ?> </span><span class="fs-17 lh-22">more</span></h2>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card-box-1 border-none d-flex align-items-center justify-content-center">
                                            <p class="mb-0 text-black fs-14 lh-20">No upcoming events at the moment.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            </div>

        </div>
        
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
                                <a href="<?= base_url('unitieup') ?>" class="text-white fw-700 fs-24 lh-28">(For Universities) Give Your Students a <br/>
                                    Global Edge – Partner with #PGS</a>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        
        <script>
        $(document).ready(function() {
            // Handle comment submission
            $('#addCommentForm').on('submit', function(e) {
                e.preventDefault();
                
                var commentText = $('#commentText').val().trim();
                if (!commentText) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Please enter a comment',
                        icon: 'error'
                    });
                    return;
                }
                
                var submitBtn = $('#submitCommentBtn');
                var originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Posting...');
                
                $.ajax({
                    url: '<?= base_url("Dashboard/add_comment") ?>',
                    type: 'POST',
                    data: {
                        comment_text: commentText
                    },
                    dataType: 'json',
                    success: function(response) {
                        submitBtn.prop('disabled', false).text(originalText);
                        
                        if(response && response.success) {
                            $('#commentText').val('');
                            loadComments();
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message || 'Failed to post comment',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        submitBtn.prop('disabled', false).text(originalText);
                        console.error('Comment error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while posting comment',
                            icon: 'error'
                        });
                    }
                });
            });
            
            // Function to load comments
            function loadComments() {
                $.ajax({
                    url: '<?= base_url("Dashboard/get_comments") ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if(response && response.success) {
                            var commentsHtml = '';
                            
                            if(response.comments && response.comments.length > 0) {
                                response.comments.forEach(function(comment) {
                                    var timeAgo = getTimeAgo(comment.created_at);
                                    var userAvatar = '<?= (isset($user->image1) && !empty($user->image1)) ? base_url("assets/images/".$user->image1) : base_url("assets/img/default-avatar.png") ?>';
                                    var userName = '<?= htmlspecialchars($user->name ?? "User", ENT_QUOTES) ?>';
                                    
                                    commentsHtml += '<div class="comment-item" data-comment-id="' + comment.id + '">';
                                    commentsHtml += '<div class="comment-author">';
                                    commentsHtml += '<img src="' + userAvatar + '" alt="' + userName + '" onerror="this.src=\'<?= base_url("assets/img/default-avatar.png") ?>\'">';
                                    commentsHtml += '<h4>' + userName + '</h4>';
                                    commentsHtml += '</div>';
                                    commentsHtml += '<div class="comment-content">' + escapeHtml(comment.comment_text).replace(/\n/g, '<br>') + '</div>';
                                    
                                    if(comment.has_reply) {
                                        var repliedAt = comment.replied_at ? formatDate(comment.replied_at) : '';
                                        commentsHtml += '<div class="admin-reply" style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-left: 3px solid #6366f1; border-radius: 4px;">';
                                        commentsHtml += '<div style="font-weight: 600; color: #6366f1; margin-bottom: 8px;">Admin Reply:</div>';
                                        commentsHtml += '<div style="color: #333;">' + escapeHtml(comment.admin_reply).replace(/\n/g, '<br>') + '</div>';
                                        if(repliedAt) {
                                            commentsHtml += '<div style="font-size: 12px; color: #666; margin-top: 8px;">Replied on ' + repliedAt + '</div>';
                                        }
                                        commentsHtml += '</div>';
                                    }
                                    
                                    commentsHtml += '<div class="comment-footer">';
                                    commentsHtml += '<span>' + timeAgo + '</span>';
                                    commentsHtml += '</div>';
                                    commentsHtml += '</div>';
                                });
                            } else {
                                commentsHtml = '<div class="text-muted text-center p-4">No comments yet. Be the first to comment!</div>';
                            }
                            
                            $('#commentsList').html(commentsHtml);
                            applyCommentCollapse();
                        }
                    },
                    error: function() {
                        console.error('Failed to load comments');
                    }
                });
            }
            
            function applyCommentCollapse() {
                var $list = $('#commentsList');
                var $comments = $list.find('.comment-item');
                $list.find('.comments-toggle').remove();
                $comments.removeClass('collapsed-comment d-none');
                if ($comments.length > 5) {
                    $comments.slice(5).addClass('collapsed-comment d-none');
                    $list.append('<button type="button" class="btn btn-link w-100 comments-toggle" aria-expanded="false">Show ' + ($comments.length - 5) + ' more <i class="bi bi-chevron-down"></i></button>');
                }
            }

            $(document).on('click', '.comments-toggle', function() {
                var $button = $(this);
                var expanded = $button.attr('aria-expanded') === 'true';
                $('#commentsList .collapsed-comment').toggleClass('d-none', expanded);
                $button.attr('aria-expanded', expanded ? 'false' : 'true');
                $button.html(expanded ? 'Show ' + $('#commentsList .collapsed-comment').length + ' more <i class="bi bi-chevron-down"></i>' : 'Show less <i class="bi bi-chevron-up"></i>');
            });

            // Helper functions
            function escapeHtml(text) {
                var map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return text.replace(/[&<>"']/g, function(m) { return map[m]; });
            }
            
            function getTimeAgo(dateString) {
                var date = new Date(dateString);
                var now = new Date();
                var seconds = Math.floor((now - date) / 1000);
                
                if(seconds < 60) return seconds + ' seconds ago';
                var minutes = Math.floor(seconds / 60);
                if(minutes < 60) return minutes + ' min ago';
                var hours = Math.floor(minutes / 60);
                if(hours < 24) return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
                var days = Math.floor(hours / 24);
                if(days < 7) return days + ' day' + (days > 1 ? 's' : '') + ' ago';
                return formatDate(dateString);
            }
            
            function formatDate(dateString) {
                var date = new Date(dateString);
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear() + ', ' + 
                    date.toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit'});
            }
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
