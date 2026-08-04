<?php
$testimonials_list = isset($testimonials) ? $testimonials : [];
if (empty($testimonials_list)) {
    $testimonials_list = [ (object)['description' => 'Everything changed when I crossed paths with my mentor. They gave me more than just the right guidance—they offered unwavering support at every step.', 'product_name' => 'Our learner', 'image1' => null] ];
}
foreach ($testimonials_list as $t):
    $t_img = !empty($t->image1) ? base_url('admin/assets/images/' . $t->image1) : base_url('assets/img/g-1.jpg');
    $t_name = isset($t->product_name) ? $t->product_name : 'Our learner';
    $t_desc = isset($t->description) ? $t->description : '';
?>
  <div class="swiper-slide">
            <div class="overflow-hidden border-radius-10px">
              <div class="full-photo h-600px border-radius-15px mb-5 p-2">
                <img src="<?= base_url('/assets/img/g-1.jpg') ?>" />
             </div>
          </div>
     </div>
<?php endforeach; ?>
