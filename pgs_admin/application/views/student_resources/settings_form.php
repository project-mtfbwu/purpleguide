<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Student Resources Settings</h4>
                    </div>
                </div>
            </div>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= htmlspecialchars($this->session->flashdata('success')) ?></div>
            <?php endif; ?>
            <?php
            if (!function_exists('sr_setting')) {
                function sr_setting($settings, $key, $fallback = '') {
                    return htmlspecialchars(isset($settings[$key]) ? $settings[$key] : $fallback, ENT_QUOTES, 'UTF-8');
                }
            }
            ?>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open(current_url()) ?>
                            <div class="mb-3">
                                <label class="form-label">Step into #purplepremium - Video URL</label>
                                <input type="url" name="purplepremium_video_url" class="form-control" value="<?= sr_setting($settings, 'purplepremium_video_url') ?>" placeholder="https://..." />
                                <small class="text-muted">YouTube embed URL or direct video URL. Shown in "Step into #purplepremium" section.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Key Dates - "Last updated on" text</label>
                                <input type="text" name="key_dates_last_updated" class="form-control" value="<?= sr_setting($settings, 'key_dates_last_updated', '6th June, 2025') ?>" placeholder="e.g. 6th June, 2025" />
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                                <div>
                                    <h5 class="mb-1">#PurplePremium Offer Section</h5>
                                    <small class="text-muted">Controls the USMLE journey pricing block shown in the attached design.</small>
                                </div>
                                <label class="mb-0">
                                    <input type="checkbox" name="purplepremium_offer_visible" value="1" <?= (isset($settings['purplepremium_offer_visible']) && (string) $settings['purplepremium_offer_visible'] === '0') ? '' : 'checked' ?>>
                                    Show section
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Heading</label>
                                    <textarea name="purplepremium_offer_heading" class="form-control" rows="2"><?= sr_setting($settings, 'purplepremium_offer_heading') ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="purplepremium_offer_description" class="form-control" rows="3"><?= sr_setting($settings, 'purplepremium_offer_description') ?></textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Small Label</label>
                                    <input type="text" name="purplepremium_offer_label" class="form-control" value="<?= sr_setting($settings, 'purplepremium_offer_label') ?>" placeholder="Get Started at discounted price" />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Discount Badge</label>
                                    <input type="text" name="purplepremium_offer_discount" class="form-control" value="<?= sr_setting($settings, 'purplepremium_offer_discount') ?>" placeholder="35% off" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="purplepremium_offer_price" class="form-control" value="<?= sr_setting($settings, 'purplepremium_offer_price') ?>" placeholder="65,0000" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Original Price</label>
                                    <input type="text" name="purplepremium_offer_original_price" class="form-control" value="<?= sr_setting($settings, 'purplepremium_offer_original_price') ?>" placeholder="509,998" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CTA Button Text</label>
                                    <input type="text" name="purplepremium_offer_cta_text" class="form-control" value="<?= sr_setting($settings, 'purplepremium_offer_cta_text') ?>" placeholder="Enroll Now" />
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">CTA Button URL</label>
                                    <input type="text" name="purplepremium_offer_cta_url" class="form-control" value="<?= sr_setting($settings, 'purplepremium_offer_cta_url') ?>" placeholder="https://... or /enroll" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save settings</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
