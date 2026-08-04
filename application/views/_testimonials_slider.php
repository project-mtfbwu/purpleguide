<?php
$testimonials_list = isset($testimonials) ? $testimonials : [];
if (empty($testimonials_list)) {
    $testimonials_list = [ (object)['description' => 'Everything changed when I crossed paths with my mentor. They gave me more than just the right guidance—they offered unwavering support at every step.', 'product_name' => 'Our learner', 'image1' => null] ];
}
foreach ($testimonials_list as $t):
    $t_img = !empty($t->image1) ? base_url('admin/assets/images/' . $t->image1) : base_url('assets/img/photo-2.jpg');
    $t_name = isset($t->product_name) ? $t->product_name : 'Our learner';
    $t_desc = isset($t->description) ? $t->description : '';
?>
<div class="swiper-slide">
    <div class="m-auto d-flex align-items-center gap-4 mobile-wrap">
        <div class="w-50 mobile-w-full mobile-pt-0">
            <div class="d-flex align-items-end">
                <h5 class="fs-14 lh-full text-black d-flex gap-2 mobile-fs-14 mobile-lh-full mobile-mb-0 mobile-pb-4 mobile-w-80 mobile-auto">
                    <span class="fnt-family fs-50">"</span>
                    <?= nl2br(htmlspecialchars($t_desc)) ?>
                </h5>
                <span class="fnt-family fs-50 text-black">"</span>
            </div>
        </div>
        <div class="w-50 mobile-w-full mobile-pt-0">
            <div class="caption-img-box-new">
                <img src="<?= htmlspecialchars($t_img) ?>" alt="<?= htmlspecialchars($t_name) ?>" data-no-retina="" onerror="this.src='<?= base_url('assets/img/photo-2.jpg') ?>'">
                <div class="d-flex position-absolute-css z-100 justify-content-space px-4" style="bottom: 15px;">
                    <div>
                        <h5 class="fs-40 lh-30 fnt-family text-white mb-0 mobile-fs-24"><?= htmlspecialchars($t_name) ?></h5>
                        <p class="mb-0 fs-15 text-white mb-0">#purplePremium student</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
