    
    <?php include('header.php') ?>
            <!-- ========== Left Sidebar Start ========== -->
       
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
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
               .modals {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 200px;
    padding-left: 250px;
     padding-right: 500px;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

.modal-content {
    margin: auto;
    display: block;
    max-width: 80%;
    max-height: 80%;
}
@keyframes pop
{
  0%{transform:scale(0);}
  100%{transform:scale(0);}
}
.close {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #fff;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
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
                                    <h4 class="mb-0"> Contact</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">View Contact</li>
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
        
                                        <h4 class="card-title">View Contact</h4>
                                      
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th> Id</th>                                                
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Messages</th>
                                               <th> Action </th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                                
                                             <?php  $i=1; if(isset($contact) && count($contact)>0){
                                            foreach($contact as $row){?>   
                                            <tr>
                                              
                                                <td>   
                                                  <?=  $i ?>
                                                </td>
                                                <td><?=     $row->name ?></td>
                                                <td><?=     $row->email ?></td>
                                                <td><?=     $row->mobile ?></td>
                                                <td><?php $lmdts = $row->message; echo substr($lmdts, 0, 50); ?> ...<br> <a href="#" data-bs-toggle="modal" data-bs-target="#descrips<?php echo $row->id; ?>">
  Read More
</a></td>
                                              <td><a href="#" data-toggle="modal" data = "<?= $row->id ?>" onclick="confirmDelete(<?php echo $row->id; ?>)" class="btn btn-outline-danger btn-sm edit" title="Edit">
                                                                <i class="fas fa-trash-alt"></i>
                                              </td>
                                                       
                                            </tr><?php $i++;?>
                                            

                                                                                   <!-- Modal -->
                                                    <div class="modal fade" id="descrips<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">View Message</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <textarea type="text" name="desc" class="form-control" rows="8" placeholder="Description" readonly><?php echo strip_tags($row->message); ?></textarea>
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
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
         <script>
function confirmDelete(id)
 {
    if (confirm("Are you sure you want to delete this data?")) {
        window.location.href = "<?php echo base_url()?>Contact/delete_contact/" + id;

    } else {
        // If the user cancels the deletion, do nothing or provide feedback
        // Example: alert("Deletion canceled");
    }
}
</script>

                      
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
       <?php $this->load->view('footer'); ?>

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
<script>var modal = document.getElementById('imageModal');
var popupImage = document.getElementById('popupImage');
var images = document.getElementsByClassName('popup-image');
var closeBtn = document.getElementsByClassName('close')[0];

for (var i = 0; i < images.length; i++) {
    images[i].addEventListener('click', function() {
        modal.style.display = 'block';
        popupImage.src = this.src;
    });
}

closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});

modal.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
</script>
          <script>
function confirmDelete(id)
 {
    if (confirm("Are you sure you want to delete this data?")) {
        window.location.href = "<?php echo base_url()?>Contact/delete_contact/" + id;

    } else {
        // If the user cancels the deletion, do nothing or provide feedback
        // Example: alert("Deletion canceled");
    }
}
</script>
                      