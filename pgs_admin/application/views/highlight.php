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
                                    <h4 class="page-title">View Highlights</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">View Highlights</li>
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
                                        <h4 class="m-t-0 header-title"><b>View Highlights</b></h4>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title m-0"></h4>
                                            <a href="<?= base_url('Highlights/add_highlight') ?>" class="btn btn-primary">Add Highlight</a>
                                        </div>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>  Title</th>
                                                    <th> Highlight Image </th>
                                                    <th> Status </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $i=1; if(isset($product) && count($product)>0){
                                            foreach($product as $row){
                                               $c_class = ($row->block_status==0)?'': 'my_block';
                                                            
                                               ?>
                                                <tr>
                                                    <td>
                                                  <?php $fullText = strip_tags($row->product_name); $shortenedText = substr($fullText, 0, 40); echo $shortenedText; if (strlen($fullText) > 40) { echo " ...<br>"; ?> <a href="your_link_here" data-toggle="modal" data-target="#title<?php echo $row->id; ?>">Read More</a> <?php } ?>
                                                 </td>
                                                <td style="text-align: center;">
                                                    <img src="<?php $image = $row->image1?$row->image1:'portal-logo.svg'  ; echo base_url('assets/images/').$row->image1
                                                   ?>" style="height: 70px;width: 180px;">
                                                 </td>
                                                <td>
                                                <?php if ($row->block_status == 0) { ?>
                                                    <a class="btn btn-primary btn-sm" href="<?= base_url('Highlights/block/' . $row->id); ?>">
                                                        Published
                                                    </a>
                                                <?php } else { ?>
                                                    <a class="btn btn-danger btn-sm" href="<?= base_url('Highlights/block/' . $row->id); ?>">
                                                        Unpublished
                                                    </a>
                                                <?php } ?>
                                                        </td>
                                                 <td>
                                                            <a class="btn btn-outline-success btn-sm edit" href="<?= base_url('Highlights/edit_highlight/').$row->id ?>" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                              <a href="#" data-toggle="modal" data = "<?= $row->id ?>" onclick="confirmDelete(<?php echo $row->id; ?>)" class="btn btn-outline-danger btn-sm edit" title="delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>  
                                                        </td>
                                                </tr>
                                                    <div class="modal fade" id="tecnicle<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Highlight Description</h1>
                                                          </div>
                                                          <div class="modal-body">
                                                            <textarea type="text" name="desc" class="form-control" rows="8" placeholder="Description" readonly><?php echo strip_tags($row->description); ?></textarea>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal fade" id="title<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Highlight Title</h1>  
                                                          </div>
                                                          <div class="modal-body">
                                                            <textarea type="text" name="desc" class="form-control" rows="8" placeholder="Description" readonly><?php echo strip_tags($row->product_name); ?></textarea>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                 <?php }} ?>
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
function confirmDelete(id)
 {
    if (confirm("Are you sure you want to delete this data?")) {
        window.location.href = "<?php echo base_url()?>Highlights/delete_highlight/" + id;

    } else {
        // If the user cancels the deletion, do nothing or provide feedback
        // Example: alert("Deletion canceled");
    }
}
</script>            

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