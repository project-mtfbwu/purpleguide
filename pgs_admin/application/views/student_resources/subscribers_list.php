<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Deadline Alert Subscribers</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted">Emails collected from "Never Miss an Important Deadline" subscribe form on Student Resources. Stored uniquely.</p>
                            <table id="datatable" class="table table-bordered table-sm">
                                <thead>
                                    <tr><th>ID</th><th>Email</th><th>Subscribed at</th></tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($items)): ?>
                                        <tr><td colspan="3">No subscribers yet.</td></tr>
                                    <?php else: foreach ($items as $r): ?>
                                        <tr>
                                            <td><?= (int)$r->id ?></td>
                                            <td><?= htmlspecialchars($r->email) ?></td>
                                            <td><?= htmlspecialchars($r->created_at) ?></td>
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
