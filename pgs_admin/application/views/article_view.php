<?php  include('header.php') ?>
            <!-- ========== Left Sidebar Start ========== -->

<!-- <link href="https://unpkg.com/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

            <!-- Left Sidebar End -->

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
               /*.my_block td{*/
               /*    background-color: #f2e5dc;*/
               /*     color: black;*/
               /*}*/
               body.modal-open {
                    overflow: hidden !important;
               }
           </style>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Blog</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> View Blog</li>
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
        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="card-title m-0"></h4>
                                            <a href="<?= base_url('Article/add_article') ?>" class="btn btn-primary">Add Blog</a>
                                        </div>
                                        
                                        <form class="form-inline" action="<?= base_url('Article/article_view') ?>" method="post">
                                          <div class="row align-items-end">
                                            <!-- Start Date -->
                                            <div class="col-md-4 mt-3 mb-3">
                                              <label class="form-label">Select Category</label>
                                              <select class="form-select" name="cat_id" id="categorySelect" >
                                                              <option value="">Select Category</option>
                                                                <?php
                                                                  if ($cate && count($cate) > 0) {
                                                                    foreach ($cate as $cat) {  ?>
                                                                     <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                                <?php }  }  ?>
                                                            </select>
                                            </div>
                                        
                                            <!-- Submit + Reset -->
                                            <div class="col-md-4 mt-3 mb-3 d-flex gap-2">
                                              <input type="submit" class="btn btn-primary" name="sbmt" value="Submit">
                                              <a href="<?= base_url('Article/article_view') ?>" class="btn btn-danger">Reset</a>
                                            </div>
                                          </div>
                                        </form>

                                      
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th> Blog Title</th>
                                                <th> Category</th>
                                                <th> Blog Image </th>
                                                <th> Description</th>
                                                <th> Visible Homepage</th>
                                                <th> Status </th>
                                                <th> Action </th>
                                                
                                            </tr>
                                            </thead>
        
        
                                            <tbody  style="background-color:black;color:white;">
                                             <?php  $i=1; if(isset($product) && count($product)>0){
                                               foreach($product as $row){
                                               $c_class = ($row->block_status==0)?'': 'my_block';
                                             ?>
                                             
                                            <tr class = "bg-info <?= $c_class ?> " >
                                                <td>
                                                   <?php 
                                                        $fullText = strip_tags($row->product_name);
                                                        $shortenedText = substr($fullText, 0, 15);
                                                        echo $shortenedText;

                                                        if (strlen($fullText) > 15) {
                                                            echo " ...<br>";
                                                            ?>
                                                            <a href="your_link_here" data-bs-toggle="modal" data-bs-target="#title<?php echo $row->id; ?>">Read More</a>
                                                            <?php
                                                        }
                                                    ?>
                                                 </td>
                                                 <td>
                                                     <?= $row->category_name ?>
                                                 </td>
                                                 <td style="text-align: center;">
                                                    <img src="<?php $image = $row->image1?$row->image1:'portal-logo.svg'  ; echo base_url('assets/images/').$row->image1
                                                   ?>" style="height: 50px;">
                                                 </td> 
                                                 <td> 
                                                  <?php 
                                                    $fullText = strip_tags($row->description);
                                                    $shortenedText = substr($fullText, 0, 25);
                                                    echo $shortenedText;

                                                    if (strlen($fullText) > 25) {
                                                        echo " ...<br>";
                                                        ?>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#tecnicle<?php echo $row->id; ?>">Read More</a>
                                                        <?php
                                                    }
                                                  ?>
                                                </td>
                                                <td>
                                                   <a href="<?= base_url('Article/toggle_view_home/' . $row->id) ?>">
                                                     <i class="fa <?= ($row->view_home == 1) ? 'fa-toggle-on' : 'fa-toggle-off' ?> fa-2x" aria-hidden="true"></i>
                                                   </a>
                                                </td>
                                                <td>
                                                    <?php if ($row->block_status == 0) { ?>
                                                    <a class="btn btn-primary btn-sm" href="<?= base_url('Article/block/' . $row->id); ?>">
                                                        Published
                                                    </a>
                                                    <?php } else { ?>
                                                    <a class="btn btn-danger btn-sm" href="<?= base_url('Article/block/' . $row->id); ?>">
                                                        Unpublished
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                     <a class="btn btn-outline-success btn-sm edit" href="<?= base_url('Article/edit_article/').$row->id ?>" title="Edit">
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
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Description</h1>
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
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Title</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <textarea type="text" name="desc" class="form-control" rows="8" placeholder="Description" readonly><?php echo strip_tags($row->product_name); ?></textarea>
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
                        </div> <!-- end row -->

<script>
function confirmDelete(id)
 {
    if (confirm("Are you sure you want to delete this data?")) {
        window.location.href = "<?php echo base_url()?>Article/delete_article/" + id;

    } else {
        // If the user cancels the deletion, do nothing or provide feedback
        // Example: alert("Deletion canceled");
    }
}
</script>

   <?php  $this->load->view('footer'); ?>

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
   
         
















