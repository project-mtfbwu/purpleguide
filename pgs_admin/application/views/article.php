<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) {?> 
  var isi = <?= json_encode(strip_tags($this->session->flashdata('error'))) ?>;   
  swal({
    title: "Error",
    text: isi,
    type: "error"
  });
<?php } ?>
</script>

<script>
<?php if ($this->session->flashdata('success')) {?> 
  var isi = <?= json_encode(strip_tags($this->session->flashdata('success'))) ?>;   
  swal({
    title: "Success",
    text: isi,
    type: "success"
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
                                    <h4 class="mb-0">Add Blog</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Add Blog</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <!-- end page title -->
                        <form action="<?= base_url('Article/add_article_data') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title m-0"></h4>
                                            <a href="javascript:history.back()" class="btn btn-primary">Back</a>

                                        </div>
                                        
                                        
                                        <h4 class="card-title"></h4> 
                                            <div class="row">
                                                <div class="col-md-6 mt-3 mb-3">
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Select Category*</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select" name="cat_id" id="categorySelect" required>
                                                              <option value="">Select Category</option>
                                                                <?php
                                                                  if ($cate && count($cate) > 0) {
                                                                    foreach ($cate as $cat) {  ?>
                                                                     <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                                <?php }  }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Blog Title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" placeholder = 'Enter Blog Title' type="text" id="example-text-input" name="prod_name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Upload Blog Image*</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="file" value="Artisanal kale" name="banner_image" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Blog Description*</h4>
                                                            <!-- <p class="card-title-desc">Example of Ckeditor Classic editor</p> -->
                                                            <div id=""><textarea name="pro_desc" id="myTextarea" class="form-control" required> </textarea></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 row">
                                                        <!--<label for="example-text-input" class="col-md-3 col-form-label">View on Homepage</spam> </label>-->
                                                        <!--<input type="hidden" name="view_home" value="0">-->
                                                        <div class="col-md-7">
                                                            <input type="hidden" value="0" name="view_home" style="margin-top: 13px; transform: scale(1.5);">        
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="d-flex flex-wrap gap-3  justify-content-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light w-md" value="submit">Submit</button>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                           </form>
                      
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>


    <script src="<?= base_url('assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')?>"></script>

        <!--tinymce js-->
    <script src="<?= base_url('assets/libs/tinymce/tinymce.min.js')?>"></script>
        <!-- App js -->
       
    <script src="<?= base_url('assets/js/pages/form-editor.init.js')?>"></script> 
    <script>
      tinymce.init({
        selector: '#myTextarea',
        height: 250, // Specify the height of the editor
        plugins: 'autolink lists link image charmap print preview',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image|color',
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <?php $this->load->view('footer'); ?>