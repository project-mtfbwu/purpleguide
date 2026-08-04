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
            <!-- ========== Left Sidebar Start ========== -->
          
            <!-- Left Sidebar End -->

            

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
                                    <h4 class="mb-0">Profile</h4>

                                    <div class="page-title-right" style="align: center;">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
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
        
                                      
                                         <?php if(isset($profile) && count($profile)>0){
                                           foreach($profile as $pro){
                                             
                                             
                                          ?>
                                            
                                             <div class="col-md-12 mb-3">
                                                    <div class="mb- row">
                                                       
                                                        <div class="col-md-6">
                                                          <div class="form-floating mb-3" >
                                                            <form action="<?= base_url('Profile/update_profile') ?>" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Admin Name" value="<?= $pro->first_name ?>"    name="name" required>
        </div>
    </div>
  
<br>
                                                            
                                                             <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Contact</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  placeholder="Contact Number" value="<?= $pro->phone ?>"  name="mobile" required>
        </div>
    </div>
 
<br> <input type="hidden" value="<?= $pro->u_id ?>" name="id">
                                                           
                                                             <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" placeholder="Email" value="<?= $pro->email ?>"  name="email" required>
        </div>
    </div>
                                              
<br>
                                                            
                                            <button type="submit" class="btn btn-primary waves-effect waves-light w-md" value="submit">Update</button>
                                              </form>
                                        
                                                        </div>
                                                      </div>
                                                      
                                                        <div class="col-md-6">
                                                          <div class="form-floating mb-3" >
 <form action="<?= base_url('Profile/change_pass') ?>" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label" style="padding-right: 0px !important;">Current Password</label>
        <div class="col-sm-9">
            <input type="test" class="form-control" placeholder="Current Password" value=""    name="cur_pass" required>
        </div>
    </div>
  
<br>
                                                            <input type="hidden" value="<?= $pro->password ?>" name="password">
                                                             <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label">New Password</label>
        <div class="col-sm-9">
            <input type="text" class="form-control"  placeholder="New Password" value=""  name="new_pass" required>
        </div>
    </div>
 
<br> <input type="hidden" value="<?= $pro->u_id ?>" name="id">
                                                           
                                                             <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label" style="padding-right: 0px !important;padding-left: 9px !important;">Confirm Password</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Confirm Password" value=""  name="con_pass" required>
        </div>
    </div>
                                              
<br>
                                                            
                                            <button type="submit" class="btn btn-primary waves-effect waves-light w-md" value="submit">Update</button>
                                              </form>
                                        
</div>

                                                        </div>
    </div>
                                                </div>
                                               
                                                
                                        
    <?php }} ?>
                                       
                                        
                                        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                      
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
              
        <!-- END layout-wrapper -->

        

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <script>
        function confirmDelete(id)
         {
            if (confirm("Are you sure you want to delete this data?")) {
                window.location.href = "<?php echo base_url()?>Category/delete_category/" + id;

            } else {
                // If the user cancels the deletion, do nothing or provide feedback
                // Example: alert("Deletion canceled");
            }
        }
        </script>

        <script src="<?= base_url('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')?>"></script>

        <!--tinymce js-->
        <script src="<?= base_url('assets/libs/tinymce/tinymce.min.js')?>"></script>
        <!-- App js -->
       
        <script src="<?= base_url('assets/js/pages/form-editor.init.js')?>"></script> 

     
       

        <script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
        <script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor1' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
    <script>
      tinymce.init({
        selector: '#myTextarea',
        height: 250, // Specify the height of the editor
        plugins: 'autolink lists link image charmap print preview',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image|color',
      });
    </script>
    <?php $this->load->view('footer') ; ?>