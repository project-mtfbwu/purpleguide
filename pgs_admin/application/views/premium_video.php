<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
    <?php if ($this->session->flashdata('error')) { ?>
        swal({ title: "Error", text: <?php echo json_encode($this->session->flashdata('error')); ?>, icon: "error" });
    <?php } ?>
    <?php if ($this->session->flashdata('success')) { ?>
        swal({ title: "Success", text: <?php echo json_encode($this->session->flashdata('success')); ?>, icon: "success" });
    <?php } ?>
</script>

<?php
$admin_img_base = base_url('assets/images/');
$has_video  = !empty($video) && !empty($video->video);
$has_poster = !empty($video) && !empty($video->poster);
$is_active  = (!empty($video) && (int)$video->block_status === 0);
?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Premium Hero Video</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Premium Hero Video</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-0 mb-3">"Step into #purplepremium" section</h4>
                            <p class="text-muted">Upload the hero video shown on the Purple Premium overview page. Max size <b>5 MB</b>. Allowed: mp4, webm, ogg, mov.</p>

                            <form id="premiumVideoForm" action="<?= base_url('Premium_video/update') ?>" method="POST" enctype="multipart/form-data">

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Video file (max 5MB)</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="file" id="videoInput" name="video" accept="video/mp4,video/webm,video/ogg,video/quicktime">
                                        <small class="text-muted">Leave empty to keep the current video.</small>
                                        <?php if ($has_video): ?>
                                            <div class="mt-3">
                                                <video src="<?= $admin_img_base . htmlspecialchars($video->video) ?>" controls style="max-width:320px; border-radius:8px;"></video>
                                                <div class="text-muted small mt-1">Current video</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Poster image (optional)</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="file" id="posterInput" name="poster" accept="image/*">
                                        <small class="text-muted">Shown before the video plays. Leave empty to keep current.</small>
                                        <?php if ($has_poster): ?>
                                            <div class="mt-2">
                                                <img src="<?= $admin_img_base . htmlspecialchars($video->poster) ?>" style="max-width:200px; border-radius:8px;">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Show on site</label>
                                    <div class="col-md-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="block_status" name="block_status" value="1" <?= $is_active ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="block_status">Display this video on the frontend</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Save Video</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var MAX = 5 * 1024 * 1024; // 5 MB
    var form = document.getElementById('premiumVideoForm');
    var videoInput = document.getElementById('videoInput');
    var posterInput = document.getElementById('posterInput');

    function tooBig(input, label) {
        if (input && input.files && input.files.length && input.files[0].size > MAX) {
            swal({ title: "File too large", text: label + " must be less than 5MB.", icon: "warning" });
            input.value = '';
            return true;
        }
        return false;
    }

    if (videoInput) {
        videoInput.addEventListener('change', function () { tooBig(videoInput, 'Video'); });
    }
    if (posterInput) {
        posterInput.addEventListener('change', function () { tooBig(posterInput, 'Poster image'); });
    }
    if (form) {
        form.addEventListener('submit', function (e) {
            if (tooBig(videoInput, 'Video') || tooBig(posterInput, 'Poster image')) {
                e.preventDefault();
            }
        });
    }
})();
</script>
