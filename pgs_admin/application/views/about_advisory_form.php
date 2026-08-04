<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) { ?>
    swal({ title: "Error", text: <?= json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php } ?>
</script>
<?php $is_edit = !empty($member); ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?= $is_edit ? 'Edit' : 'Add' ?> Advisory Member</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('About_page/advisory') ?>">Advisory Team</a></li>
                                <li class="breadcrumb-item active"><?= $is_edit ? 'Edit' : 'Add' ?></li>
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
                                <h4 class="card-title m-0"></h4>
                                <a href="<?= base_url('About_page/advisory') ?>" class="btn btn-primary">Back</a>
                            </div>
                            <form action="<?= base_url('About_page/advisory_save') ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $is_edit ? (int) $member->id : '' ?>">
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Name*</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="name" placeholder="e.g. Mr Prabhakar" value="<?= $is_edit ? htmlspecialchars($member->name) : '' ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Display Order</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="number" name="display_order" value="<?= $is_edit ? (int) $member->display_order : 0 ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Designation</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="designation" placeholder="e.g. Ex Dean (International Admissions) SRM SRMC" value="<?= $is_edit ? htmlspecialchars($member->designation ?? '') : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 form-group">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 col-form-label">Photo<?= $is_edit ? '' : '*' ?></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="file" name="image" accept="image/*" <?= $is_edit ? '' : 'required' ?>>
                                                <?php if ($is_edit && !empty($member->image)): ?>
                                                    <div class="mt-2">
                                                        <img src="<?= base_url('assets/images/' . $member->image) ?>" alt="" style="max-width: 80px; max-height: 80px; object-fit: cover; border: 1px solid #ddd; padding: 2px; border-radius: 4px;" onerror="this.style.display='none'">
                                                        <small class="text-muted d-block">Leave empty to keep the current photo.</small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><?= $is_edit ? 'Update' : 'Create' ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
