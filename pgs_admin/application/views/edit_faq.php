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
                                    <h4 class="page-title">Edit FAQs</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Edit FAQs</li>
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
                                            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                        </div>
                                            <form action="<?= base_url('Faq/edit_faq_data') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">FAQs title</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="<?php echo  $product->product_name; ?>" id="example-text-input" name="prod_name"required>
                                                            <input class="form-control" type="hidden" value="<?php echo  $product->id; ?>" name="id">
                                                        </div>
                                                      </div>
                                                    </div>
                                                                                                   
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">FAQs Description*</h4>
                                                            <textarea name="description" id="myTextarea" class="form-control" required><?= $product->description ?></textarea>

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

        <!--tinymce js-->
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