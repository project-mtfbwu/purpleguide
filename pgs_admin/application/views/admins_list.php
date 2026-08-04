<?php include('header.php') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) { ?>
  swal({ title: "Error", text: <?php echo json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php } ?>
<?php if ($this->session->flashdata('success')) { ?>
  swal({ title: "Success", text: <?php echo json_encode($this->session->flashdata('success')) ?>, icon: "success" });
<?php } ?>
</script>

<div class="content-page">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Admins</h4>
            <div class="page-title-right">
              <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Admins</li>
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
              <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <h4 class="m-t-0 header-title mb-0"><b>Manage Admins</b></h4>
                <a class="btn btn-primary" href="<?= base_url('Admins/create') ?>">Create Admin</a>
              </div>

              <form class="row g-2 align-items-center mb-3" method="get" action="<?= base_url('Admins') ?>">
                <div class="col-sm-8 col-md-6 col-lg-5">
                  <input type="text" class="form-control" name="q" value="<?= htmlspecialchars($search_q ?? '') ?>" placeholder="Search by name, email, id or role">
                </div>
                <div class="col-auto">
                  <button class="btn btn-primary" type="submit">Search</button>
                </div>
                <?php if (!empty($search_q)): ?>
                  <div class="col-auto">
                    <a class="btn btn-outline-secondary" href="<?= base_url('Admins') ?>">Clear</a>
                  </div>
                <?php endif; ?>
              </form>

              <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($admins)) { foreach ($admins as $a) { ?>
                  <tr>
                    <td><?= (int) $a->u_id ?></td>
                    <td><?= htmlspecialchars(trim(($a->first_name ?? '').' '.($a->last_name ?? ''))) ?></td>
                    <td><?= htmlspecialchars((string) $a->email) ?></td>
                    <td><?= htmlspecialchars((string) ($a->phone ?? '')) ?></td>
                    <td><?= htmlspecialchars((string) $a->user_role) ?></td>
                    <td class="d-flex gap-2">
                      <a class="btn btn-outline-primary btn-sm" href="<?= base_url('Admins/edit/'.(int)$a->u_id) ?>">Edit</a>
                      <a class="btn btn-outline-danger btn-sm" href="<?= base_url('Admins/delete/'.(int)$a->u_id) ?>" onclick="return confirm('Delete this admin?')">Delete</a>
                    </td>
                  </tr>
                <?php } } ?>
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
  if ($.fn.DataTable.isDataTable('#datatable')) {
    $('#datatable').DataTable().destroy();
  }
  $('#datatable').DataTable({
    "order": [],
    "columnDefs": [{ "orderable": false, "targets": "_all" }],
    "paging": false,
    "searching": false,
    "info": false,
    "lengthChange": false
  });
});
</script>

