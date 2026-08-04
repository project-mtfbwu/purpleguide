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
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Profile</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2015 - 2020 &copy; Velonic theme by <a href="">Coderthemes</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>


        <?php include('footer.php') ?>