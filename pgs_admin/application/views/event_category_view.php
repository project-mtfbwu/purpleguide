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

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Event Category</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> View Event Category</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title m-0"></h4>
                                            <a href="<?= base_url('Event_category/add_event_category') ?>" class="btn btn-primary">Add Event Category</a>
                                        </div>
                                      
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th> Event Category Name</th>
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
                                                   <?php 
                                                        $fullText = strip_tags($row->category_name);
                                                        $shortenedText = substr($fullText, 0, 25);
                                                        echo $shortenedText;

                                                        if (strlen($fullText) > 25) {
                                                            echo " ...<br>";
                                                            ?>
                                                            <a href="your_link_here" data-bs-toggle="modal" data-bs-target="#title<?php echo $row->id; ?>">Read More</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                 
                                                <td>
                                                    <?php if ($row->block_status == 0) { ?>
                                                    <a class="btn btn-primary btn-sm" href="<?= base_url('Event_category/block/' . $row->id); ?>">
                                                        Published
                                                    </a>
                                                    <?php } else { ?>
                                                    <a class="btn btn-danger btn-sm" href="<?= base_url('Event_category/block/' . $row->id); ?>">
                                                        Unpublished
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                     <a class="btn btn-outline-success btn-sm edit" href="<?= base_url('Event_category/edit_event_category/').$row->id ?>" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                     </a>
                                                     <a href="#" data-toggle="modal" data = "<?= $row->id ?>" onclick="confirmDelete(<?php echo $row->id; ?>)" class="btn btn-outline-danger btn-sm edit" title="delete">
                                                       <i class="fas fa-trash-alt"></i>
                                                     </a>     
                                                </td>
                                                
                                            </tr>
                                              
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="tecnicle<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Event Description</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <textarea type="text" name="desc" class="form-control" rows="8" placeholder="Description" readonly><?php echo strip_tags($row->description); ?></textarea>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                           
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    
                                                    <div class="modal fade" id="title<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Event Title</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <textarea type="text" name="desc" class="form-control" rows="8" placeholder="Description" readonly><?php echo strip_tags($row->category_name); ?></textarea>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                           
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                 <?php }} ?>
                                          </tbody>
                                        </table>
                                        <?php if (!empty($pagination_links)): ?>
                                        <div class="d-flex justify-content-center mt-3"><?= $pagination_links ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
<script>
function confirmDelete(id)
 {
    if (confirm("Are you sure you want to delete this data?")) {
        window.location.href = "<?php echo base_url()?>Event_category/delete_event_category/" + id;

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