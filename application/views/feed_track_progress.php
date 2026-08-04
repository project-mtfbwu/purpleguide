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
        [data-anime]
        {
            opacity : 1;
        }
        .draft-default-note {
            background: #000;
            color: #27e08a !important;
            font-weight: 600;
            font-size: 16px;
            line-height: 22px;
            padding: 14px 16px;
            border-radius: 8px;
            width: 100%;
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
    <!-- end header -->
    

   <?php $this->load->view('sidebar'); ?>

    <div class="wrapper-content">

    <!-- AboutUs -->
    <section class="pt-6 about-section half-section overlap-height position-relative overflow-hidden minus-5 mobile-doc-section">
        <div class="container overlap-gap-section p-0">
            <div class="row justify-content-md-center align-items-center">
                <div class="col-lg-7 d-flex gap-10 align-items-center">
                    <div class="w-300px d-flex align-items-center justify-content-end">
                        <h1 class="text-start text-black fnt-family fw-400 fs-50 lh-full pt-0 mb-0">
                            your <br/> custom <br/>progress<br/> board
                        </h1>
                    </div>
                       <div class="yellow-box-style-3  w-300px" id="important-alerts" style="scroll-margin-top: 140px;">
                        <div class="header-yellow-box-style-3"> <img src="./assets/img/bell.gif" width="" class="w-10" />
                            Important Alerts</div>
                        <?php $alerts = isset($important_alerts) ? $important_alerts : []; ?>
                        <?php if (!empty($alerts)): ?>
                        <ol>
                            <?php foreach (array_slice($alerts, 0, 3) as $alert): ?>
                            <li><?= htmlspecialchars($alert->alert_text, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ol>
                        <?php else: ?>
                        <ol>
                            <li>No alerts right now. Your mentor will post updates here.</li>
                        </ol>
                        <?php endif; ?>
                    </div>

                </div>
               
                </div>
                <div class="row justify-content-md-center mt-3">
                <div class="col-lg-6 px-4">
                    <p class="mb-0 text-black m-auto fs-16 lh-19">
                        This section is built to guide you from Day 1 to your final university admit. It shows every step of your study journey in one clear view. Your mentor will create
                        a personalized map based on your profile. Think of it like your own Kanban board—split into draft, in 
                        progress, and completed stages. You’ll always know what’s done, what’s next, and what needs work. No guesswork, no confusion—just your path, laid out clearly.
                    </p>
                </div>
            </div>
                </div>
    </section>

    <section class="group-chart-section pt-0 mobile-doc-section">
        <div class="w-780px m-auto">
            <div class="row justify-content-center">
                <div class="m-auto p-0">

                    <div class="card-box">
                        <div class="list-of-graphs">
                            <div class="d-flex-group">
                                <p class="mb-0 text-black">#draftMeter</p>
                            </div>
                            <?php
                            // A draft has started once at least one document is uploaded/approved.
                            // Until then, show the default informational message instead of the doc list.
                            $has_draft = false;
                            if (!empty($draft_doc_items)) {
                                foreach ($draft_doc_items as $di) {
                                    if (!empty($di->uploaded) || !empty($di->approved)) { $has_draft = true; break; }
                                }
                            }
                            ?>
                            <?php if (!$has_draft): ?>
                                <div class="d-flex-group">
                                    <div class="graph-box-content draft-default-note" style="color: #27e08a !important;">
                                        We do three drafts for every document. Once the first draft is ready, you’ll see it here.
                                    </div>
                                </div>
                            <?php elseif (!empty($draft_doc_items)): ?>
                                <?php foreach ($draft_doc_items as $draft_item):
                                    // Enum: pending = uploaded, approved/rejected/indraft = post-review. Image by state:
                                    if (!empty($draft_item->approved)) {
                                        $draft_img = 'draft-meter-approved.png';
                                        $draft_title = 'Approved';
                                    } elseif (!empty($draft_item->uploaded)) {
                                        $draft_img = 'draft-meter-uploaded.png';
                                        $draft_title = 'Uploaded (pending/rejected/indraft)';
                                    } else {
                                        $draft_img = 'draft-meter- notuploaded.png';
                                        $draft_title = 'Not uploaded';
                                    }
                                ?>
                                <div class="d-flex-group">
                                    <div class="graph-box">
                                        <img src="<?= base_url('assets/img/' . $draft_img) ?>" alt="" title="<?= htmlspecialchars($draft_title) ?>" />
                                    </div>
                                    <span>|</span>
                                    <div class="graph-box-content <?= !empty($draft_item->approved) ? 'text-success' : (!empty($draft_item->uploaded) ? 'text-primary' : '') ?>">
                                        <?= htmlspecialchars($draft_item->doc_type) ?>
                                        <?php if (!empty($draft_item->approved)): ?><span class="small text-muted"> (approved)</span>
                                        <?php elseif (!empty($draft_item->uploaded)): ?><span class="small text-muted"> (uploaded)</span><?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="d-flex-group">
                                    <div class="graph-box-content text-muted">
                                        No document types configured. Upload docs at <a href="<?= base_url('Upload_your_doc') ?>">Upload your doc</a>.
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="count-of-grpah">
                            <span>+</span>
                            <p class="mb-0 fnt-family fs-100 lh-full"><?= isset($draft_doc_completed) ? (int)$draft_doc_completed : 0 ?></p><span>completed</span>
                        </div>
                    </div>

                    <div class="card-box">
                        <div class="list-of-graphs">
                            <div class="d-flex-group">
                                <p class="mb-0 text-black" id="review-notes" style="scroll-margin-top: 140px;">#reviewQueue</p>
                            </div>
                            <?php if(isset($review_queue_items) && count($review_queue_items) > 0): ?>
                                <?php foreach($review_queue_items as $item): ?>
                                <div class="d-flex-group">
                                    <label class="toggle-switch">
                                        <input type="checkbox" <?= $item->is_checked ? 'checked' : '' ?> disabled>
                                        <span class="slider"></span>
                                    </label>
                                    <span>|</span>
                                    <div class="graph-box-content">
                                        <?= htmlspecialchars($item->item_text) ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="d-flex-group">
                                    <div class="graph-box-content text-muted">
                                        No review queue items yet.
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="count-of-grpah">
                            <span>+</span>
                            <p class="mb-0 fnt-family fs-100 lh-full"><?= isset($review_queue_completed) ? $review_queue_completed : 0 ?></p><span>completed</span>
                        </div>
                    </div>

                    <div class="card-box list-of-notes">
                        <div class="list-of-graphs" style="max-height: 400px; overflow-y: auto;">
                            <div class="d-flex-group">
                                <p class="mb-0 text-black">#counselorNotes</p>
                            </div>
                            <?php if(isset($counselor_notes) && count($counselor_notes) > 0): ?>
                                <?php $note_index = 1; ?>
                                <?php foreach($counselor_notes as $note): ?>
                                <div class="d-flex-group gap-3">
                                    <div class="graph-box">
                                        <img src="<?= base_url('assets/img/default-avatar.png') ?>" alt="Avatar" />
                                    </div>
                                    <div class="card-border-1">
                                        <span class="count-of"><?= $note_index ?></span>
                                        <h5><?= nl2br(htmlspecialchars($note->note_text)) ?></h5>
                                    </div>
                                </div>
                                <?php $note_index++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="d-flex-group gap-3">
                                    <div class="card-border-1">
                                        <h5 class="text-muted">No counselor notes yet.</h5>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="count-of-grpah">
                            <span>+</span>
                            <p class="mb-0 fnt-family fs-100 lh-full"><?= isset($counselor_notes) ? count($counselor_notes) : 0 ?></p><span>pending</span>
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

    <section id="kanban-board" class="pt-4 pb-0 col-lg-11 m-auto" style="scroll-margin-top: 140px;">
        <div class="container-fluid bg-black border-radius-6px p-2">
            <div class="row mobile-row-scrolling">
                <!-- Journey Map Column -->
                <div class="col-lg-3">
                    <div class="card-white-box">
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">JOURNEY MAP</h5>
                        <?php if(isset($kanban_cards['journey_map']) && count($kanban_cards['journey_map']) > 0): ?>
                            <?php foreach($kanban_cards['journey_map'] as $card): ?>
                                <?php $this->load->view('partials/kanban_feed_card', ['card' => $card]); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted text-center py-3">
                                <p class="mb-0">No cards in this section</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- In Progress Column -->
                <div class="col-lg-3">
                    <div class="card-white-box">
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">IN PROGRESS</h5>
                        <?php if(isset($kanban_cards['in_progress']) && count($kanban_cards['in_progress']) > 0): ?>
                            <?php foreach($kanban_cards['in_progress'] as $card): ?>
                                <?php $this->load->view('partials/kanban_feed_card', ['card' => $card]); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted text-center py-3">
                                <p class="mb-0">No cards in this section</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Draft Phase Column -->
                <div class="col-lg-3">
                    <div class="card-white-box">
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">draft phase</h5>
                        <?php if(isset($kanban_cards['draft_phase']) && count($kanban_cards['draft_phase']) > 0): ?>
                            <?php foreach($kanban_cards['draft_phase'] as $card): ?>
                                <?php $this->load->view('partials/kanban_feed_card', ['card' => $card]); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted text-center py-3">
                                <p class="mb-0">No cards in this section</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Completed Column -->
                <div class="col-lg-3">
                    <div class="card-white-box">
                        <h5 class="mb-2 fs-22 fw-500 text-black text-uppercase">completed</h5>
                        <?php if(isset($kanban_cards['completed']) && count($kanban_cards['completed']) > 0): ?>
                            <?php foreach($kanban_cards['completed'] as $card): ?>
                                <?php $this->load->view('partials/kanban_feed_card', ['card' => $card]); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted text-center py-3">
                                <p class="mb-0">No cards in this section</p>
                            </div>
                        <?php endif; ?>
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
                            data-slider-options='{ "slidesPerView": 1, "spaceBetween": 40, "loop": true, "pagination": { "el": ".slider-one-slide-pagination", "clickable": true, "dynamicBullets": false }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 000000003000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 1 }, "768": { "slidesPerView": 1 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                            <div class="swiper-wrapper">
                                <!-- start review item -->
                                <div class="swiper-slide">
                                    <div class="card-gray-1 text-center w-700px m-left-170px">
                                        <h5
                                            class="fw-500 bg-black text-black d-inline-block text-white fs-20 px-2 border-radius-6px mb-2">
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
                                            class="fw-500 bg-black text-black d-inline-block text-white fs-20 px-2 border-radius-6px mb-2">
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
                                            class="fw-500 bg-black text-black d-inline-block text-white fs-20 px-2 border-radius-6px mb-2">
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
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js?v=' . filemtime(FCPATH . 'assets/js/main.js'))?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/pgs-autocomplete.js')?>"></script>
    
    
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
