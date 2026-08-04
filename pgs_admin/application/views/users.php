<?php include('header.php') ?>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
        <script>
         <?php if ($this->session->flashdata('error')) {?> 
          var isi= <?php echo json_encode ($this->session->flashdata('error')) ?> ;   
          swal({
          title: "Error",
          text: isi,
          icon: "error",
        });
            <?php } ?>
        </script>
             
        <script>
                 <?php if ($this->session->flashdata('success')) {?> 
                  var isi= <?php echo json_encode ($this->session->flashdata('success')) ?> ;   
                  swal({
                      title: "Success",
                      text: isi,
                      icon: "success",
                    });
                        <?php } ?>
        </script>  
            <style>
               body.modal-open {
                overflow: hidden !important;
              }

           </style>

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Users</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Users</li>
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
                                        <h4 class="m-t-0 header-title mb-4"><b>View Users</b></h4>

                                        <form class="row g-2 align-items-center mb-3" method="get" action="<?= base_url('Users/users_list') ?>">
                                            <div class="col-sm-8 col-md-6 col-lg-5">
                                                <input type="text" class="form-control" name="q" value="<?= htmlspecialchars($search_q ?? '') ?>" placeholder="Search by student name, ID, email<?= !empty($mentor_field_exists) ? ' or tag' : '' ?>">
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </div>
                                            <?php if (!empty($search_q)): ?>
                                            <div class="col-auto">
                                                <a class="btn btn-outline-secondary" href="<?= base_url('Users/users_list') ?>">Clear</a>
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
                                                    <th>Country of Citizenship</th>
                                                    <th>Tag</th>
                                                    <th>Mentor</th>
                                                    <th>Create Date</th>
                                                    <th>View Details</th>
                                                    <th>View Docs</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(isset($product) && count($product) > 0){ foreach($product as $row){ ?>     
                                                <tr>
                                                    <td><?= (int) $row->id; ?></td>
                                                    <td><?= $row->name; ?></td>
                                                    <td><?= $row->email; ?></td>
                                                    <td><?= $row->dial_code; ?> <?= $row->number; ?>
                                                    <td><?= $row->country_name; ?></td>
                                                    <td><?= isset($row->tag) ? htmlspecialchars((string) $row->tag) : '' ?></td>
                                                    <td>
                                                        <?php if(($admin_role ?? '') === 'super_admin'): ?>
                                                            <?php if(!empty($mentor_field_exists)): ?>
                                                                <form method="post" action="<?= base_url('Users/assign_mentor') ?>" class="d-flex gap-2 align-items-center">
                                                                    <input type="hidden" name="user_id" value="<?= (int) $row->id ?>">
                                                                    <select class="form-select form-select-sm" name="mentor_id" style="min-width: 200px;">
                                                                        <option value="">Unassigned</option>
                                                                        <?php foreach(($mentors ?? []) as $m): ?>
                                                                            <option value="<?= (int) $m->u_id ?>" <?= (isset($row->mentor_admin_id) && (int)$row->mentor_admin_id === (int)$m->u_id) ? 'selected' : '' ?>>
                                                                                <?= htmlspecialchars(trim(($m->first_name ?? '').' ('.($m->email ?? '').')')) ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <button class="btn btn-outline-primary btn-sm" type="submit">Save</button>
                                                                </form>
                                                            <?php else: ?>
                                                                <span class="text-muted">Requires DB column</span>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?= isset($row->mentor_name) ? htmlspecialchars((string) $row->mentor_name) : '' ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <!-- <td>
                                                        <?php 
                                                            $fullText = strip_tags($row->message);
                                                            $shortenedText = substr($fullText, 0, 15);
                                                            echo $shortenedText;
                                        
                                                            if (strlen($fullText) > 15) {
                                                                echo " ...<br>";
                                                                ?>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#message<?= $row->id; ?>">Read More</a>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td> -->
                                                    <td><?= !empty($row->created_at) ? date('d/m/Y', strtotime($row->created_at)) : ''; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-sm edit" href="<?= base_url('Users/user_details/').$row->id ?>" title="Details">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('Users/user_documents/').$row->id ?>"  class="btn btn-primary btn-sm mt-1">
                                                                  View Docs
                                                                </a>
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

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

       <?php include('footer.php') ?>

<script>
$(document).ready(function() {
    // Destroy existing DataTable initialization if it exists
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }
    
    // Keep DataTables for styling/responsiveness, but use server-side pagination/search
    $('#datatable').DataTable({
        "order": [], // Disable initial sorting
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Disable sorting on all columns
        ],
        "paging": false,
        "searching": false,
        "info": false,
        "lengthChange": false
    });
});
</script>