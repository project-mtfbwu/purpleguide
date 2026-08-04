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
                        <h4 class="page-title">Advisory Team</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Advisory Team</li>
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
                                <h4 class="card-title m-0">Advisory team members (shown on the About page)</h4>
                                <a href="<?= base_url('About_page/advisory_add') ?>" class="btn btn-primary"><i class="mdi mdi-plus me-1"></i> Add Member</a>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($members)): foreach ($members as $m): ?>
                                    <tr>
                                        <td><?= (int) $m->display_order ?></td>
                                        <td>
                                            <?php if (!empty($m->image)): ?>
                                                <img src="<?= base_url('assets/images/' . $m->image) ?>" alt="" style="max-width: 50px; max-height: 50px; object-fit: cover;" onerror="this.style.display='none'">
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($m->name) ?></td>
                                        <td><?= htmlspecialchars($m->designation ?? '') ?></td>
                                        <td>
                                            <?php if ((int) $m->block_status === 0): ?>
                                                <span class="badge bg-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Unpublished</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('About_page/advisory_edit/' . $m->id) ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></a>
                                            <a href="<?= base_url('About_page/advisory_block/' . $m->id) ?>" class="btn btn-sm btn-warning" title="<?= (int) $m->block_status === 0 ? 'Unpublish' : 'Publish' ?>">
                                                <i class="mdi <?= (int) $m->block_status === 0 ? 'mdi-eye-off' : 'mdi-eye' ?>"></i>
                                            </a>
                                            <a href="<?= base_url('About_page/advisory_delete/' . $m->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this advisory member?');"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No advisory members yet. <a href="<?= base_url('About_page/advisory_add') ?>">Add one</a>.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>

<script>
$(document).ready(function() {
    if ($.fn.DataTable && $.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }
    if ($.fn.DataTable) {
        $('#datatable').DataTable({
            "order": [],
            "columnDefs": [{ "orderable": false, "targets": "_all" }],
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true
        });
    }
});
</script>
