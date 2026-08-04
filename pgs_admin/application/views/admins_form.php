<?php include('header.php') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) { ?>
  swal({ title: "Error", text: <?php echo json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php } ?>
</script>

<?php
  $isEdit = ($mode ?? '') === 'edit';
  $a = $admin ?? null;
?>

<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title"><?= $isEdit ? 'Edit Admin' : 'Create Admin' ?></h4>
            <div class="page-title-right">
              <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('Admins') ?>">Admins</a></li>
                <li class="breadcrumb-item active"><?= $isEdit ? 'Edit' : 'Create' ?></li>
              </ol>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="card">
            <div class="card-body">
              <form method="post" action="<?= base_url('Admins/save') ?>">
                <input type="hidden" name="mode" value="<?= htmlspecialchars($mode ?? 'create') ?>">
                <?php if ($isEdit): ?>
                  <input type="hidden" name="u_id" value="<?= (int) ($a->u_id ?? 0) ?>">
                <?php endif; ?>

                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" name="first_name" required value="<?= htmlspecialchars((string)($a->first_name ?? '')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars((string)($a->last_name ?? '')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required value="<?= htmlspecialchars((string)($a->email ?? '')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars((string)($a->phone ?? '')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="user_role" required>
                      <?php $role = (string)($a->user_role ?? 'admin'); ?>
                      <option value="super_admin" <?= $role === 'super_admin' ? 'selected' : '' ?>>super_admin</option>
                      <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>admin</option>
                      <option value="mentor" <?= $role === 'mentor' ? 'selected' : '' ?>>mentor</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label"><?= $isEdit ? 'Password (leave blank to keep)' : 'Password' ?></label>
                    <input type="text" class="form-control" name="password" <?= $isEdit ? '' : 'required' ?> value="">
                  </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                  <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Create admin' ?></button>
                  <a class="btn btn-outline-secondary" href="<?= base_url('Admins') ?>">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php') ?>

