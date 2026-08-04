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
                                    <h4 class="page-title">Terms Conditions</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Terms Conditions</li>
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
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title m-0"></h4>
                                            <!-- <a href="javascript:history.back()" class="btn btn-primary">Back</a> -->
                                        </div>
                                            <form action="<?= base_url('Terms_conditions/update_terms_conditions') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-5 col-form-label">Terms Conditions Title</label>
                                                        <div class="col-md-7">
                                                            <input class="form-control" type="text" value="<?php echo  $product->title; ?>" id="example-text-input" name="title"required>
                                                            <input class="form-control" type="hidden" value="<?php echo  $product->id; ?>" name="id">
                                                        </div>
                                                      </div>
                                                    </div>                                                
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Terms Conditions Description*</h4>
                                                            <textarea name="description" id="myTextarea" class="form-control" ><?= $product->description ?></textarea>

                                                        </div>
                                                    </div>
                                                    </div>                                               
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <script src="<?= base_url('assets/libs/tinymce/tinymce.min.js')?>"></script>
<script>
tinymce.init({
    selector: '#myTextarea',
    height: 250,
    plugins: 'autolink lists link image charmap print preview',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image|color'
});
</script>


        <?php include('footer.php') ?>