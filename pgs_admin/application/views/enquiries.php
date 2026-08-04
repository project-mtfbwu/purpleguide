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
.card,
.card-body,
.container-fluid,
.main-content {
  overflow: visible !important;  /* allow modal to escape */
}

.modal-backdrop {
  z-index: 99998 !important;
}
.modal {
  z-index: 99999 !important;
  position: fixed !important;  /* make sure modal is fixed to viewport */
  top: 0;
  left: 0;
}
</style>

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Enquiries</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Enquiries</li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="m-t-0 header-title mb-4"><b>View Enquiries</b></h4>

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <!-- <th>Category</th> -->
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Message</th>
                                                    <th>Date of Enquiry</th>
                                                    <th>Reply</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(isset($product) && count($product) > 0){ foreach($product as $row){ ?>     
                                                <tr>
                                                    <td><?= $row->name; ?></td>
                                                    <!-- <td><?= $row->category_name; ?></td> -->
                                                    <td><?= $row->email; ?></td>
                                                    <td><?= $row->mobile; ?></td>
                                                    <td>
                                                       <?php
                                                        $fullText = strip_tags($row->message);
                                                        $shortenedText = substr($fullText, 0, 15);

                                                        echo $shortenedText;

                                                        if (strlen($fullText) > 15) {
                                                            echo " ...<br>";
                                                            ?>
                                                            <a href="#" data-toggle="modal" data-target="#message<?= $row->id; ?>">
                                                                Read More
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($row->created_at)); ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($row->reply == 0): ?>
                                                            <a href="javascript:void(0);" 
                                                           data-toggle="modal" 
                                                           data-target="#reply<?php echo $row->id; ?>" 
                                                           class="btn btn-sm btn-primary">
                                                           Reply
                                                        </a>

                                                        <?php else: ?>
                                                            <span href="javascript:void(0);" 
                                                               data-bs-toggle="modal" 
                                                               data-bs-target="#replied<?php echo $row->id; ?>" 
                                                               class="badge badge-success"
                                                               style="padding: 10px 11px; background-color: rgb(119, 119, 119);">
                                                               Replied
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <div class="modal fade" id="reply<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="replyLabel<?php echo $row->id; ?>" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <form method="post" action="<?= base_url('Enquiries/send_reply') ?>">
                                                            <div class="modal-header">
                                                              <h1 class="modal-title fs-5" id="replyLabel<?php echo $row->id; ?>">Reply</h1>
                                                              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                            </div>

                                                            <div class="modal-body">
                                                              <textarea name="reply_message" class="form-control" rows="4" required></textarea>
                                                              <input type="hidden" name="enquiry_id" value="<?php echo $row->id; ?>">
                                                              <input type="hidden" name="email" value="<?php echo $row->email; ?>">
                                                            </div>

                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                              <button type="submit" class="btn btn-primary">Send Reply</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>

                                                    <div class="modal fade" id="replied<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="replyLabel<?php echo $row->id; ?>" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <!-- <form method="post" action="<?= base_url('Enquiries/send_reply') ?>"> -->
                                                            <div class="modal-header">
                                                              <h1 class="modal-title fs-5" id="replyLabel<?php echo $row->id; ?>">Replied</h1>
                                                              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                            </div>

                                                            <div class="modal-body">
                                                              <?php echo $row->reply_message; ?>
                                                              <input type="hidden" name="enquiry_id" value="<?php echo $row->id; ?>">
                                                              <input type="hidden" name="email" value="<?php echo $row->email; ?>">
                                                            </div>

                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                          <!-- </form> -->
                                                        </div>
                                                      </div>
                                                    </div>

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
                        <?php foreach(isset($product) ? $product : [] as $row){ ?>
                        <div class="modal fade" id="message<?= $row->id; ?>" tabindex="-1" aria-labelledby="messageLabel<?= $row->id; ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="messageLabel<?= $row->id; ?>">Message</h1>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                              </div>
                              <div class="modal-body">
                                <textarea class="form-control" rows="8" readonly><?= strip_tags($row->message); ?></textarea>
                              </div>
                              <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

       <?php include('footer.php') ?>

<script>
// Initialize after footer loads jQuery + DataTables
window.addEventListener('load', function () {
    if (!window.jQuery || !jQuery.fn || !jQuery.fn.DataTable) return;
    if (jQuery.fn.DataTable.isDataTable('#datatable')) {
        jQuery('#datatable').DataTable().destroy();
    }
    jQuery('#datatable').DataTable({
        order: [],
        columnDefs: [{ orderable: false, targets: '_all' }],
        paging: false,
        searching: true,
        info: false,
        lengthChange: false
    });
});
</script>