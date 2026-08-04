<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">PGS Data and Stats</h4>
                        <div class="page-title-right">
                            <a href="<?= base_url('Student_resources/pgs_stat_add') ?>" class="btn btn-primary">Add Stat</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= htmlspecialchars($this->session->flashdata('success')) ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted">Stats shown in "PGS data and stats" section. Use category e.g. #stem, #usmle, #mba to group.</p>
                            <table id="datatable" class="table table-bordered table-sm">
                                <thead>
                                    <tr><th>ID</th><th>Category</th><th>Stat text</th><th>Order</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($items)): ?>
                                        <tr><td colspan="5">No stats yet. <a href="<?= base_url('Student_resources/pgs_stat_add') ?>">Add one</a>.</td></tr>
                                    <?php else: foreach ($items as $r): ?>
                                        <tr>
                                            <td><?= (int)$r->id ?></td>
                                            <td><?= htmlspecialchars($r->category) ?></td>
                                            <td><?= htmlspecialchars(mb_substr($r->stat_text, 0, 60)) ?>...</td>
                                            <td><?= (int)$r->display_order ?></td>
                                            <td>
                                                <a href="<?= base_url('Student_resources/pgs_stat_edit/' . $r->id) ?>" class="btn btn-sm btn-info">Edit</a>
                                                <a href="<?= base_url('Student_resources/pgs_stat_delete/' . $r->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
