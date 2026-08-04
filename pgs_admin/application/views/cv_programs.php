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
                        <h4 class="page-title">Discover Our Programs (CV Ready)</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Programs</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title m-0">Programs shown on cvreadyprogram &amp; saveable by users</h4>
                                <a href="<?= base_url('Cv_programs/add') ?>" class="btn btn-primary"><i class="mdi mdi-plus me-1"></i> Add Program</a>
                            </div>
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Tags</th>
                                        <th>Most wanted</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($programs)): foreach ($programs as $i => $p): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td>
                                            <?php if (!empty($p->image)): ?>
                                                <img src="<?= base_url('assets/images/' . $p->image) ?>" alt="" style="max-width: 60px; max-height: 60px; object-fit: contain;" onerror="this.style.display='none'">
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($p->title) ?></td>
                                        <td><?= htmlspecialchars($p->tags ?? '') ?></td>
                                        <td><?= !empty($p->most_wanted) ? '<span class="badge bg-warning text-dark">Yes</span>' : '<span class="text-muted">—</span>' ?></td>
                                        <td><?= (int)$p->display_order ?></td>
                                        <td>
                                            <a href="<?= base_url('Cv_programs/edit/' . $p->id) ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></a>
                                            <a href="<?= base_url('Cv_programs/delete/' . $p->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this program?');"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No programs yet. <a href="<?= base_url('Cv_programs/add') ?>">Add one</a>.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php if (!empty($pagination_links)): ?>
                            <div class="d-flex justify-content-center mt-3"><?= $pagination_links ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>

<script>
// Enable client-side search via DataTables
window.addEventListener('load', function () {
    if (!window.jQuery || !jQuery.fn || !jQuery.fn.DataTable) return;
    if (jQuery.fn.DataTable.isDataTable('#datatable')) {
        jQuery('#datatable').DataTable().destroy();
    }
    jQuery('#datatable').DataTable({
        order: [],
        paging: false,
        searching: true,
        info: false,
        lengthChange: false
    });
});
</script>
