<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Urgent Deadlines & Updates</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Student Resources</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="m-t-0 header-title mb-0"><b>Urgent Deadlines & Updates</b></h4>
                                <a href="<?= base_url('Student_resources/urgent_add') ?>" class="btn btn-primary">Add Deadline</a>
                            </div>
                            <p class="text-muted">These appear in the red "Urgent Deadlines & Updates" section on the Student Resources page.</p>
                            <table id="datatable" class="table table-bordered table-sm">
                                <thead>
                                    <tr><th>ID</th><th>Date</th><th>What's Happening</th><th>Order</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($items)): ?>
                                        <tr><td colspan="5">No deadlines yet. <a href="<?= base_url('Student_resources/urgent_add') ?>">Add one</a>.</td></tr>
                                    <?php else: foreach ($items as $r): ?>
                                        <tr>
                                            <td><?= (int)$r->id ?></td>
                                            <td><?= htmlspecialchars($r->date_text) ?></td>
                                            <td><?= htmlspecialchars(mb_substr($r->description, 0, 80)) ?>...</td>
                                            <td><?= (int)$r->display_order ?></td>
                                            <td>
                                                <a href="<?= base_url('Student_resources/urgent_edit/' . $r->id) ?>" class="btn btn-sm btn-info">Edit</a>
                                                <a href="<?= base_url('Student_resources/urgent_delete/' . $r->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">Delete</a>
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
