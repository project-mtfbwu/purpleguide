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
                        <h4 class="page-title">University Management</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Universities</li>
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
                                <h4 class="card-title m-0">Universities (used in user dashboard shortlist)</h4>
                                <a href="<?= base_url('Universities/add') ?>" class="btn btn-primary"><i class="mdi mdi-plus me-1"></i> Add University</a>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($universities)): foreach ($universities as $i => $u): ?>
                                    <tr>
                                        <td><?= (int)($offset ?? 0) + $i + 1 ?></td>
                                        <td>
                                            <?php if (!empty($u->image)): ?>
                                                <img src="<?= base_url('../assets/images/' . $u->image) ?>" alt="" style="max-width: 50px; max-height: 50px; object-fit: contain;" onerror="this.style.display='none'">
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($u->name) ?></td>
                                        <td><?= htmlspecialchars($u->location ?? '') ?></td>
                                        <td>
                                            <a href="<?= base_url('Universities/edit/' . $u->id) ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></a>
                                            <a href="<?= base_url('Universities/delete/' . $u->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this university?');"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            <?php if (!empty($q)): ?>
                                                No results for "<strong><?= htmlspecialchars($q) ?></strong>".
                                            <?php else: ?>
                                                No universities yet. <a href="<?= base_url('Universities/add') ?>">Add one</a>.
                                            <?php endif; ?>
                                        </td>
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
