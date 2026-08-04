<section class="overflow-hidden p-0 mb-5 mobile-slider-pgs">
        <div class="">
            <h3 class="alt-font fw-700 ls-minus-1px text-dark-bab mb-0 mx-auto desktop-none">#Pgs picks</h3>
            <div class="row align-items-center justify-content-center">
                <div class="w-20  position-relative text-center text-xl-start lg-mb-15px">
                    <div class="d-flex align-items-center">
                        <h3 class="alt-font fw-700 ls-minus-1px text-dark-bab mb-0 mx-auto mobile-none">#Pgs picks</h3>
                        <div class="d-flex justify-content-center justify-content-xl-start flex-column gap-3">
                            <!-- start slider navigation -->
                            <div class="slider-one-slide-prev-1 text-dark-gray swiper-button-prev slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                tabindex="0" role="button" aria-label="Previous slide"><i
                                    class="fa-solid fa-arrow-left"></i></div>
                            <div class="slider-one-slide-next-1 text-dark-gray swiper-button-next slider-navigation-style-04 border border-1 border-color-extra-medium-gray"
                                tabindex="0" role="button" aria-label="Next slide"><i
                                    class="fa-solid fa-arrow-right"></i></div>
                            <!-- end slider navigation -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 overflow-hidden overflow-hidden">
                    <div class="outside-box-right-15 xl-outside-box-right-20 sm-outside-box-right-0">
                        <div class="swiper sm-p-0"
                            data-slider-options='{ "slidesPerView": 1, "spaceBetween": 40, "loop": true, "pagination": { "el": ".slider-one-slide-pagination", "clickable": true, "dynamicBullets": false }, "navigation":
                                { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": 
                                { "delay": 3000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true },
                                "breakpoints": { "992": { "slidesPerView": 2 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                            <div class="swiper-wrapper pt-30px pb-30px">
                                <?php if (!empty($picks_courses)): ?>
                                <?php foreach ($picks_courses as $pick):
                                    $pick_img   = event_image_url($pick->image1 ?? null, base_url('assets/img/doctor-2.jpg'));
                                    $pick_title = htmlspecialchars($pick->product_name);
                                    $pick_desc  = !empty($pick->prod_sub_name)
                                        ? htmlspecialchars($pick->prod_sub_name)
                                        : htmlspecialchars(substr(strip_tags($pick->description ?? ''), 0, 80)) . (strlen(strip_tags($pick->description ?? '')) > 80 ? '…' : '');
                                    $pick_url   = base_url('Programsfull/program/' . $pick->id);
                                ?>
                                <div class="swiper-slide review-style-06">
                                    <div class="d-flex justify-content-center h-100 flex-column bg-white box-shadow-medium p-20px md-p-35px border-radius-6px last-paragraph-no-margin">
                                        <div class="mb-20px d-flex align-items-center gap-3">
                                            <div class="avatar-box-full">
                                                <img class="" src="<?= $pick_img ?>" alt="<?= $pick_title ?>" onerror="this.src='<?= base_url('assets/img/doctor-2.jpg') ?>'">
                                            </div>
                                            <div class="d-inline-block align-middle p-paragrph last-paragraph-no-margin">
                                                <a href="<?= $pick_url ?>" class="alt-font text-dark-gray fw-600 fs-18 bg-dark"><?= $pick_title ?></a>
                                                <p class="lh-24 d-block"><?= $pick_desc ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <div class="swiper-slide review-style-06">
                                    <div class="d-flex justify-content-center h-100 flex-column bg-white box-shadow-medium p-20px md-p-35px border-radius-6px last-paragraph-no-margin">
                                        <div class="mb-20px d-flex align-items-center gap-3">
                                            <div class="avatar-box-full">
                                                <img class="" src="./assets/img/doctor-2.jpg" alt="">
                                            </div>
                                            <div class="d-inline-block align-middle p-paragrph last-paragraph-no-margin">
                                                <a href="purplepremiumhome" class="alt-font text-dark-gray fw-600 fs-18 bg-dark">For Clinical Rotation Click Here</a>
                                                <p class="lh-24 d-block">Reach out to us.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>