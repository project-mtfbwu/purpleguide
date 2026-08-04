<?php include('header.php') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) {?> 
  var isi= <?php echo json_encode ($this->session->flashdata('error')) ?> ;   
  swal({ title: "Error", text: isi, icon: "error" });
<?php } ?>
<?php if ($this->session->flashdata('success')) {?> 
  var isi= <?php echo json_encode ($this->session->flashdata('success')) ?> ;   
  swal({ title: "Success", text: isi, icon: "success" });
<?php } ?>
</script>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Logs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>Users/users_list">Users</a></li>
                                <li class="breadcrumb-item active">Logs</li>
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
                            <h4 class="m-t-0 header-title mb-3"><b>Admin Activity Logs</b></h4>

                            <?php
                                $adminRole = strtolower(trim((string) $this->session->userdata('admin_role')));
                                if ($adminRole === 'superadmin') $adminRole = 'super_admin';
                                $isSuperAdmin = ($adminRole === 'super_admin');
                            ?>
                            <form class="row g-2 align-items-end mb-3" method="get" action="<?= base_url('Users/logs') ?>">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label class="form-label">Search</label>
                                    <input type="text" class="form-control" name="q" value="<?= htmlspecialchars($filters['q'] ?? '') ?>" placeholder="Search description, entity, admin, user...">
                                </div>
                                <?php if ($isSuperAdmin): ?>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <label class="form-label">Admin</label>
                                        <input type="hidden" name="admin_id" id="admin_id" value="<?= htmlspecialchars($filters['admin_id'] ?? '') ?>">
                                        <input type="text" class="form-control" name="admin_q" id="admin_q" list="admin_suggestions" autocomplete="off" value="<?= htmlspecialchars($filters['admin_q'] ?? '') ?>" placeholder="Type name/email">
                                        <datalist id="admin_suggestions"></datalist>
                                    </div>
                                <?php else: ?>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <label class="form-label">Admin</label>
                                        <input type="hidden" name="admin_id" id="admin_id" value="<?= htmlspecialchars($filters['admin_id'] ?? '') ?>">
                                        <div class="form-control bg-light text-muted" style="display:flex; align-items:center; min-height: 38px;">
                                            You
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-6 col-md-3 col-lg-3">
                                    <label class="form-label">User</label>
                                    <input type="hidden" name="user_id" id="user_id" value="<?= htmlspecialchars($filters['user_id'] ?? '') ?>">
                                    <input type="text" class="form-control" name="user_q" id="user_q" list="user_suggestions" autocomplete="off" value="<?= htmlspecialchars($filters['user_q'] ?? '') ?>" placeholder="Type name/email">
                                    <datalist id="user_suggestions"></datalist>
                                </div>
                                <div class="col-sm-6 col-md-2 col-lg-2 d-flex gap-2">
                                    <button class="btn btn-primary w-100" type="submit">Filter</button>
                                    <a class="btn btn-outline-secondary w-100" href="<?= base_url('Users/logs') ?>">Clear</a>
                                </div>
                            </form>

                            <script>
                            (function() {
                                function debounce(fn, wait) {
                                    var t = null;
                                    return function() {
                                        var args = arguments;
                                        clearTimeout(t);
                                        t = setTimeout(function(){ fn.apply(null, args); }, wait);
                                    };
                                }

                                function setDatalistOptions(datalistEl, items) {
                                    datalistEl.innerHTML = '';
                                    (items || []).forEach(function(it) {
                                        var opt = document.createElement('option');
                                        opt.value = it.label;
                                        opt.setAttribute('data-id', it.id);
                                        datalistEl.appendChild(opt);
                                    });
                                }

                                function resolveSelectedId(inputEl, datalistEl, hiddenIdEl) {
                                    var val = (inputEl.value || '').trim();
                                    if (!val) {
                                        hiddenIdEl.value = '';
                                        return;
                                    }
                                    var opts = datalistEl.querySelectorAll('option');
                                    for (var i = 0; i < opts.length; i++) {
                                        if ((opts[i].value || '').trim() === val) {
                                            hiddenIdEl.value = opts[i].getAttribute('data-id') || '';
                                            return;
                                        }
                                    }
                                    // If user typed arbitrary text, keep hidden id blank (server will do LIKE on *_q)
                                    hiddenIdEl.value = '';
                                }

                                function wireAutocomplete(inputId, datalistId, hiddenId, url) {
                                    var input = document.getElementById(inputId);
                                    var datalist = document.getElementById(datalistId);
                                    var hidden = document.getElementById(hiddenId);
                                    if (!input || !datalist || !hidden) return;

                                    var fetchSuggestions = debounce(function() {
                                        var q = (input.value || '').trim();
                                        if (q.length < 2) {
                                            setDatalistOptions(datalist, []);
                                            resolveSelectedId(input, datalist, hidden);
                                            return;
                                        }
                                        fetch(url + '?q=' + encodeURIComponent(q), { credentials: 'same-origin' })
                                            .then(function(r){ return r.json(); })
                                            .then(function(data){
                                                setDatalistOptions(datalist, (data && data.items) ? data.items : []);
                                                resolveSelectedId(input, datalist, hidden);
                                            })
                                            .catch(function(){
                                                setDatalistOptions(datalist, []);
                                                resolveSelectedId(input, datalist, hidden);
                                            });
                                    }, 200);

                                    input.addEventListener('input', fetchSuggestions);
                                    input.addEventListener('change', function() {
                                        resolveSelectedId(input, datalist, hidden);
                                    });
                                }

                                <?php if ($isSuperAdmin): ?>
                                wireAutocomplete('admin_q', 'admin_suggestions', 'admin_id', '<?= base_url('Users/ajax_admin_autocomplete') ?>');
                                <?php endif; ?>
                                wireAutocomplete('user_q', 'user_suggestions', 'user_id', '<?= base_url('Users/ajax_user_autocomplete') ?>');
                            })();
                            </script>

                            <?php if (!empty($table_missing)): ?>
                                <div class="alert alert-warning mb-0">
                                    Audit log table is missing. Please run <code>admin_audit_logs_table.sql</code>.
                                </div>
                            <?php else: ?>
                                <table class="table table-bordered table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 140px;">Time</th>
                                            <th>Admin</th>
                                            <th>Target User</th>
                                            <th>Action</th>
                                            <th>Entity</th>
                                            <th>Description</th>
                                            <th style="min-width: 240px;">Changes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($rows)): ?>
                                            <?php foreach ($rows as $r): ?>
                                                <tr>
                                                    <td><?= !empty($r->created_at) ? date('d/m/Y H:i', strtotime($r->created_at)) : '' ?></td>
                                                    <td>
                                                        <div class="fw-600"><?= htmlspecialchars($r->admin_name ?? ('Admin #' . (int)$r->admin_id)) ?></div>
                                                        <div class="text-muted" style="font-size: 0.85rem;"><?= htmlspecialchars($r->admin_email ?? '') ?></div>
                                                        <div class="text-muted" style="font-size: 0.8rem;"><?= htmlspecialchars($r->admin_role ?? '') ?></div>
                                                    </td>
                                                    <td>
                                                        <div class="fw-600"><?= htmlspecialchars($r->user_name ?? ('User #' . (int)$r->target_user_id)) ?></div>
                                                        <div class="text-muted" style="font-size: 0.85rem;"><?= htmlspecialchars($r->user_email ?? '') ?></div>
                                                    </td>
                                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($r->action ?? '') ?></span></td>
                                                    <td>
                                                        <div><?= htmlspecialchars($r->entity ?? '') ?></div>
                                                        <?php if (!empty($r->entity_id)): ?>
                                                            <div class="text-muted" style="font-size: 0.85rem;">#<?= (int)$r->entity_id ?></div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($r->description ?? '') ?></td>
                                                    <td>
                                                        <?php if (!empty($r->changes_json)): ?>
                                                            <pre class="mb-0" style="white-space: pre-wrap; max-height: 140px; overflow:auto;"><?= htmlspecialchars($r->changes_json) ?></pre>
                                                        <?php else: ?>
                                                            <span class="text-muted">—</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No logs found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <?php if (!empty($pagination_links)): ?>
                                    <div class="mt-3">
                                        <?= $pagination_links ?>
                                    </div>
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

