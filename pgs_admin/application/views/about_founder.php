<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) { ?>
    swal({ title: "Error", text: <?= json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php } ?>
<?php if ($this->session->flashdata('success')) { ?>
    swal({ title: "Success", text: <?= json_encode($this->session->flashdata('success')) ?>, icon: "success" });
<?php } ?>
</script>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Meet The Founder</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Founder</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title m-0">Founder details (shown on the About page)</h4>
                            </div>
                            <form action="<?= base_url('About_page/founder_save') ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="name" placeholder="e.g. Anjay Nilmek" value="<?= !empty($founder) ? htmlspecialchars($founder->name ?? '') : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Title</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="title" placeholder="e.g. Counsellor & student strategist" value="<?= !empty($founder) ? htmlspecialchars($founder->title ?? '') : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="email" name="email" placeholder="e.g. anjay@purpleguide.study" value="<?= !empty($founder) ? htmlspecialchars($founder->email ?? '') : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Photo</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="file" name="image" accept="image/*">
                                                <?php if (!empty($founder) && !empty($founder->image)): ?>
                                                    <div class="mt-2">
                                                        <img src="<?= base_url('assets/images/' . $founder->image) ?>" alt="" style="max-width: 90px; max-height: 90px; object-fit: cover; border: 1px solid #ddd; padding: 2px; border-radius: 4px;" onerror="this.style.display='none'">
                                                        <small class="text-muted d-block">Leave empty to keep the current photo.</small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Bio</h4>
                                                <small class="text-muted d-block mb-2">Separate paragraphs with a blank line.</small>
                                                <textarea name="bio" class="form-control" rows="10"><?= !empty($founder) ? htmlspecialchars($founder->bio ?? '') : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
