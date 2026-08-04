<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) { ?>
    swal({ title: "Error", text: <?= json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php } ?>
</script>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add University</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('Universities') ?>">Universities</a></li>
                                <li class="breadcrumb-item active">Add</li>
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
                                <h4 class="card-title m-0">New University</h4>
                                <a href="<?= base_url('Universities') ?>" class="btn btn-secondary">Back</a>
                            </div>
                            <form action="<?= base_url('Universities/add_save') ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">University Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="e.g. Harvard University" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" placeholder="e.g. Cambridge, USA">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image (logo)</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <small class="text-muted">JPG, PNG, GIF, WebP. Optional.</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Save University</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
