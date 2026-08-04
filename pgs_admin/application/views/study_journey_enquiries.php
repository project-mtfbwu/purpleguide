<?php include('header.php'); ?>

<?php
// The public form is single-select: one stream and one level-of-study pick per
// submission lands in a single column. These helpers collapse the legacy
// per-path columns into one readable value (older rows may have several set).
if (!function_exists('sj_combo_summary')) {
    function sj_combo_summary($row, array $map) {
        $parts = [];
        foreach ($map as $col => $label) {
            $val = isset($row->$col) ? trim((string) $row->$col) : '';
            if ($val !== '') {
                $parts[] = $label . ' — ' . $val;
            }
        }
        return implode(', ', $parts);
    }
}
if (!function_exists('sj_stream_summary')) {
    function sj_stream_summary($row) {
        return sj_combo_summary($row, [
            'medical_path'   => 'Medical Path',
            'masters_path'   => 'Masters Path',
            'undergrad_path' => 'Undergrad Path',
            'medical_path_2' => 'Medical Path 2',
        ]);
    }
}
if (!function_exists('sj_study_level_summary')) {
    function sj_study_level_summary($row) {
        return sj_combo_summary($row, [
            'current_medical_path'   => 'Medical Path',
            'current_masters_path'   => 'Masters Path',
            'current_undergrad_path' => 'Undergrad Path',
        ]);
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

<script>
<?php if ($this->session->flashdata('error')): ?>
    swal({ title: "Error", text: <?= json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
    swal({ title: "Success", text: <?= json_encode($this->session->flashdata('success')) ?>, icon: "success" });
<?php endif; ?>
</script>

<style>
    body.modal-open { overflow: hidden !important; }
    .sj-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .sj-table { border-collapse: collapse; width: 100%; font-size: 13px; }
    .sj-table th, .sj-table td { white-space: nowrap; padding: 8px 10px; border: 1px solid #dee2e6; vertical-align: middle; }
    .sj-table thead th { background: #f8f9fa; font-weight: 600; position: sticky; top: 0; z-index: 1; }
    .sj-table tbody tr:hover { background: #f1f5fb; }
    .sj-table .col-ua { white-space: normal; min-width: 180px; max-width: 220px; word-break: break-all; font-size: 11px; color: #6c757d; }
    .sj-search-wrap { display: flex; align-items: center; gap: 8px; margin-bottom: 14px; }
    .sj-search-wrap input { max-width: 280px; }
    .sj-count { font-size: 13px; color: #6c757d; margin-left: auto; }

    /* Modal sections */
    .modal-section-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #6c757d; padding: 10px 16px 4px; background: #f8f9fa; border-top: 1px solid #dee2e6; margin: 0; }
    .modal-section-title:first-child { border-top: none; }
    .sj-modal-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .sj-modal-table th { width: 38%; background: #f8f9fa; font-weight: 600; padding: 7px 14px; border: 1px solid #dee2e6; vertical-align: top; }
    .sj-modal-table td { padding: 7px 14px; border: 1px solid #dee2e6; vertical-align: top; word-break: break-word; }
    .sj-modal-table td a { color: #0d6efd; }
    .sj-modal-table .ua-cell { font-size: 11px; color: #6c757d; word-break: break-all; }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Study abroad journey</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Study abroad journey</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="m-t-0 header-title mb-3">
                                <b>Study abroad journey submissions</b>
                                <?php if (!empty($total)): ?>
                                    <span class="badge badge-secondary ml-2"><?= (int)$total ?> total</span>
                                <?php endif; ?>
                            </h4>

                            <?php if (!empty($missing_table)): ?>

                                <div class="alert alert-warning mb-0">
                                    Table <code>study_journey_enquiries</code> does not exist yet.
                                    It is created when a visitor submits the form on the site,
                                    or run the schema in
                                    <code>pgs_website/application/controllers/Home.php</code>
                                    method <code>_ensure_study_journey_table</code>.
                                </div>

                            <?php else: ?>

                                <!-- Search box -->
                                <div class="sj-search-wrap">
                                    <label for="sjSearch" class="mb-0 font-weight-600">Search:</label>
                                    <input type="text" id="sjSearch" class="form-control form-control-sm"
                                           placeholder="Name, email, phone, country…">
                                    <span class="sj-count" id="sjCount"></span>
                                </div>

                                <!-- Table -->
                                <div class="sj-table-wrap">
                                    <table class="sj-table" id="sjTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Submitted</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>You are</th>
                                                <th>Stream</th>
                                                <th>Journey step</th>
                                                <th>Study level</th>
                                                <th>Intake year</th>
                                                <th>Country</th>
                                                <th>IP address</th>
                                                <th>User agent</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($product)): ?>
                                                <?php foreach ($product as $row): ?>
                                                    <tr>
                                                        <td><?= (int)$row->id ?></td>
                                                        <td>
<?= !empty($row->created_at)
    ? date('d M Y', strtotime($row->created_at))
    : '' ?>
</td>
                                                        <td><?= htmlspecialchars($row->name ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td>
                                                            <a href="mailto:<?= htmlspecialchars($row->email ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                                                <?= htmlspecialchars($row->email ?? '', ENT_QUOTES, 'UTF-8') ?>
                                                            </a>
                                                        </td>
                                                        <td><?= htmlspecialchars($row->phone ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars($row->you_are ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars(sj_stream_summary($row), ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars($row->current_journey_step ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars(sj_study_level_summary($row), ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars($row->intake_year ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars($row->preferred_country ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars($row->ip_address ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td class="col-ua"><?= htmlspecialchars($row->user_agent ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td>
                                                            <a href="javascript:void(0);"
                                                               class="btn btn-outline-primary btn-sm"
                                                               data-toggle="modal"
                                                               data-target="#sjDetail<?= (int)$row->id ?>"
                                                               title="View full details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="14" class="text-center text-muted py-4">No submissions found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <?php if (!empty($pagination_links)): ?>
                                    <div class="d-flex justify-content-center mt-3"><?= $pagination_links ?></div>
                                <?php endif; ?>

                                <!-- ========== MODALS ========== -->
                                <?php if (!empty($product)): foreach ($product as $row): ?>
                                <div class="modal fade" id="sjDetail<?= (int)$row->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header" style="background:#6c5dd3;">
                                                <h5 class="modal-title text-white">
                                                    <i class="fas fa-user mr-2"></i>
                                                    Submission #<?= (int)$row->id ?>
                                                    &mdash; <?= htmlspecialchars($row->name ?? '', ENT_QUOTES, 'UTF-8') ?>
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body p-0">

                                                <p class="modal-section-title">Personal information</p>
                                                <table class="sj-modal-table">
                                                    <tr><th>ID</th><td><?= (int)$row->id ?></td></tr>
                                                    <tr>
    <th>Submitted</th>
    <td>
        <?= !empty($row->created_at)
            ? date('Y-m-d h:i:s A', strtotime($row->created_at . ' UTC') + 19800)
            : '' ?>
    </td>
</tr>
                                                    <tr><th>Name</th><td><?= htmlspecialchars($row->name ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td><a href="mailto:<?= htmlspecialchars($row->email ?? '', ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($row->email ?? '', ENT_QUOTES, 'UTF-8') ?></a></td>
                                                    </tr>
                                                    <tr><th>Phone</th><td><?= htmlspecialchars($row->phone ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                    <tr><th>You are</th><td><?= htmlspecialchars($row->you_are ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                </table>

                                                <p class="modal-section-title">Stream</p>
                                                <table class="sj-modal-table">
                                                    <tr><th>Stream</th><td><?= htmlspecialchars(sj_stream_summary($row), ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                </table>

                                                <p class="modal-section-title">Current journey</p>
                                                <table class="sj-modal-table">
                                                    <tr><th>Journey step</th><td><?= htmlspecialchars($row->current_journey_step ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                    <tr><th>Level of study</th><td><?= htmlspecialchars(sj_study_level_summary($row), ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                </table>

                                                <p class="modal-section-title">Preferences</p>
                                                <table class="sj-modal-table">
                                                    <tr><th>Intake year</th><td><?= htmlspecialchars($row->intake_year ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                    <tr><th>Preferred country</th><td><?= htmlspecialchars($row->preferred_country ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                </table>

                                                <p class="modal-section-title">Technical info</p>
                                                <table class="sj-modal-table">
                                                    <tr><th>IP address</th><td><?= htmlspecialchars($row->ip_address ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                    <tr><th>User agent</th><td class="ua-cell"><?= htmlspecialchars($row->user_agent ?? '', ENT_QUOTES, 'UTF-8') ?></td></tr>
                                                </table>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>

                            <?php endif; ?>

                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- Plain JS search — no DataTables needed -->
<?php if (empty($missing_table)): ?>
<script>
(function () {
    var input = document.getElementById('sjSearch');
    var count = document.getElementById('sjCount');
    var rows  = document.querySelectorAll('#sjTable tbody tr');

    function updateCount(visible) {
        count.textContent = visible + ' of <?= (int)$total ?> shown';
    }

    updateCount(rows.length);

    input.addEventListener('keyup', function () {
        var q = this.value.toLowerCase().trim();
        var visible = 0;
        rows.forEach(function (tr) {
            var text = tr.textContent.toLowerCase();
            var show = !q || text.indexOf(q) !== -1;
            tr.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        updateCount(visible);
    });
})();
</script>
<?php endif; ?>