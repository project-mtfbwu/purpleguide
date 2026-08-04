<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Study Abroad Facts You Probably Didn’t Know</h4>
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
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($this->session->flashdata('error')) ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="m-t-0 header-title mb-0"><b>Study Abroad Facts</b></h4>
                                <a href="<?= base_url('Student_resources/study_abroad_fact_add') ?>" class="btn btn-primary">Add fact</a>
                            </div>
                            <p class="text-muted mb-2">These entries power the yellow <strong>“Study Abroad Facts You Probably Didn’t Know”</strong> carousel on the public Student Resources page. Order = slide sequence (low numbers first).</p>
                            <p class="text-muted small">Frontend: query <code>study_abroad_facts</code> ordered by <code>display_order</code>, then <code>id</code>. Each row: <code>title</code> (optional), <code>fact_content</code> (HTML from editor — render with <code>dangerouslySetInnerHTML</code> / <code>v-html</code> / equivalent, or sanitize first).</p>
                            <table id="datatable" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Fact (preview)</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($items)): ?>
                                        <tr><td colspan="5">No facts yet. <a href="<?= base_url('Student_resources/study_abroad_fact_add') ?>">Add one</a>.</td></tr>
                                    <?php else: foreach ($items as $r): ?>
                                        <tr>
                                            <td><?= (int)$r->id ?></td>
                                            <td><?= $r->title ? htmlspecialchars($r->title) : '<span class="text-muted">—</span>' ?></td>
                                            <td><?php
                                                $plain = trim(strip_tags($r->fact_content ?? ''));
                                                $prev = function_exists('mb_substr') ? mb_substr($plain, 0, 100) : substr($plain, 0, 100);
                                                echo htmlspecialchars($prev);
                                                echo (function_exists('mb_strlen') ? mb_strlen($plain) : strlen($plain)) > 100 ? '…' : '';
                                            ?></td>
                                            <td><?= (int)$r->display_order ?></td>
                                            <td>
                                                <a href="<?= base_url('Student_resources/study_abroad_fact_edit/' . $r->id) ?>" class="btn btn-sm btn-info">Edit</a>
                                                <a href="<?= base_url('Student_resources/study_abroad_fact_delete/' . $r->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this fact?');">Delete</a>
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
