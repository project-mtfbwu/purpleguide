<?php include('header.php') ?><!-- v20260526 -->

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Modal Submissions</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Modal Submissions</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="m-t-0 header-title mb-3">
                                <b>Modal Submissions</b>
                                <?php if (!empty($total)): ?>
                                <span class="badge badge-secondary ml-2" style="font-size:13px;background:#6c757d;color:#fff;padding:4px 10px;border-radius:4px;"><?php echo (int)$total; ?> total</span>
                                <?php endif; ?>
                            </h4>

                            <?php if (!empty($missing_table)): ?>

                                <div class="alert alert-warning mb-0">No submissions yet — the table will be created automatically on the first form submission.</div>

                            <?php else: ?>

                                <!-- Filter -->
                                <form method="get" action="<?php echo base_url('Modal_submissions/index'); ?>" class="d-flex gap-3 flex-wrap align-items-end mb-4">
                                    <div>
                                        <label class="form-label mb-1">Filter by Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Search name..." value="<?php echo htmlspecialchars($name_filter); ?>">
                                    </div>
                                    <div>
                                        <label class="form-label mb-1">Filter by Type</label>
                                        <select name="type" class="form-select">
                                            <option value="">All Types</option>
                                            <option value="applicant" <?php echo $type_filter === 'applicant' ? 'selected' : ''; ?>>Applicant (Application Prep)</option>
                                            <option value="investor" <?php echo $type_filter === 'investor' ? 'selected' : ''; ?>>Investor (Join / Connect)</option>
                                        </select>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="<?php echo base_url('Modal_submissions/index'); ?>" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="border-collapse:collapse;border-spacing:0;width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Checklist Items</th>
                                                <th>Planning to Study</th>
                                                <th>Pre-seed Round</th>
                                                <th>Source Page</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($submissions)): ?>
                                        <?php foreach ($submissions as $row): ?>
                                        <tr>
                                            <td><?php echo (int)$row->id; ?></td>
                                            <td>
                                                <?php if ($row->modal_type === 'applicant'): ?>
                                                    <span class="badge" style="background:#6f42c1;color:#fff;padding:4px 8px;border-radius:4px;">Applicant</span>
                                                <?php else: ?>
                                                    <span class="badge" style="background:#fd7e14;color:#fff;padding:4px 8px;border-radius:4px;">Investor</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($row->name); ?></td>
                                            <td><?php echo htmlspecialchars($row->email); ?></td>
                                            <td><?php echo htmlspecialchars($row->phone); ?></td>
                                            <td>
                                                <?php
                                                if (!empty($row->checklist_items)) {
                                                    $items = json_decode($row->checklist_items, true);
                                                    if (is_array($items) && count($items)) {
                                                        foreach ($items as $item) {
                                                            echo '<span style="display:inline-block;background:#e8f4fd;color:#1a6a9a;border-radius:3px;padding:2px 6px;margin:1px 2px;font-size:11px;">'
                                                                . htmlspecialchars($item) . '</span>';
                                                        }
                                                    } else {
                                                        echo '<span class="text-muted">—</span>';
                                                    }
                                                } else {
                                                    echo '<span class="text-muted">—</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($row->planning_to_study ?: '—'); ?></td>
                                            <td><?php echo htmlspecialchars($row->preseed_round ?: '—'); ?></td>
                                            <td>
                                                <span title="<?php echo htmlspecialchars($row->source_page); ?>" style="cursor:help;">
                                                    <?php
                                                    $sp = $row->source_page ?: '—';
                                                    echo htmlspecialchars(strlen($sp) > 30 ? substr($sp, 0, 30) . '…' : $sp);
                                                    ?>
                                                </span>
                                            </td>
                                            <td><?php echo $row->created_at ? date('d/m/Y', strtotime($row->created_at)) : '—'; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr><td colspan="10" class="text-center text-muted">No submissions found.</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <?php
                                $pg_per   = 10;
                                $pg_total = isset($total) ? (int) $total : 0;
                                $pg_pages = $pg_total > 0 ? (int) ceil($pg_total / $pg_per) : 1;
                                $pg_cur   = max(1, (int) ($this->input->get('page') ?: 1));
                                $pg_qs    = array_filter(['name' => isset($name_filter) ? $name_filter : '', 'type' => isset($type_filter) ? $type_filter : '']);
                                if ($pg_pages > 1):
                                ?>
                                <nav class="mt-3">
                                    <ul class="pagination pagination-sm justify-content-center mb-0">
                                        <?php
                                        $pg_prev = $pg_cur > 1 ? $pg_cur - 1 : null;
                                        $pg_next = $pg_cur < $pg_pages ? $pg_cur + 1 : null;

                                        // prev
                                        $qs_prev = http_build_query(array_merge($pg_qs, ['page' => $pg_prev]));
                                        echo '<li class="page-item' . ($pg_prev ? '' : ' disabled') . '">';
                                        echo '<a class="page-link" href="' . ($pg_prev ? base_url('Modal_submissions/index') . '?' . $qs_prev : '#') . '">‹</a></li>';

                                        // numbered pages (show window of 5 around current)
                                        $pg_start = max(1, $pg_cur - 2);
                                        $pg_end   = min($pg_pages, $pg_cur + 2);
                                        if ($pg_start > 1) {
                                            $qs1 = http_build_query(array_merge($pg_qs, ['page' => 1]));
                                            echo '<li class="page-item"><a class="page-link" href="' . base_url('Modal_submissions/index') . '?' . $qs1 . '">1</a></li>';
                                            if ($pg_start > 2) echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                                        }
                                        for ($p = $pg_start; $p <= $pg_end; $p++) {
                                            $qsp = http_build_query(array_merge($pg_qs, ['page' => $p]));
                                            $active = $p === $pg_cur ? ' active' : '';
                                            echo '<li class="page-item' . $active . '">';
                                            echo '<a class="page-link" href="' . base_url('Modal_submissions/index') . '?' . $qsp . '">' . $p . '</a></li>';
                                        }
                                        if ($pg_end < $pg_pages) {
                                            if ($pg_end < $pg_pages - 1) echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                                            $qslast = http_build_query(array_merge($pg_qs, ['page' => $pg_pages]));
                                            echo '<li class="page-item"><a class="page-link" href="' . base_url('Modal_submissions/index') . '?' . $qslast . '">' . $pg_pages . '</a></li>';
                                        }

                                        // next
                                        $qs_next = http_build_query(array_merge($pg_qs, ['page' => $pg_next]));
                                        echo '<li class="page-item' . ($pg_next ? '' : ' disabled') . '">';
                                        echo '<a class="page-link" href="' . ($pg_next ? base_url('Modal_submissions/index') . '?' . $qs_next : '#') . '">›</a></li>';
                                        ?>
                                    </ul>
                                    <p class="text-center text-muted mt-2 mb-0" style="font-size:12px;">
                                        Page <?php echo $pg_cur; ?> of <?php echo $pg_pages; ?> &nbsp;·&nbsp; <?php echo $pg_total; ?> total
                                    </p>
                                </nav>
                                <?php endif; ?>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php') ?>
