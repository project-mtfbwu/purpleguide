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
                                    <h4 class="page-title">Course Details</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Course Details</li>
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
                                            <form action="<?= base_url('Courses/add_course_data') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-3">Select Category*</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-control" name="cat_id" id="categorySelect" required>
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
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Course title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="prod_name"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Course sub title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="prod_sub_name"required>
                                                        </div>
                                                      </div>
                                                    </div>                         
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="col-md-3">Upload Course Image*</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" type="file" name="banner_image" required>
                                                            </div>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Registration Start Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" name="s_date"required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Registration End Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" name="e_date"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Duration*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="duration" min="0" step="0.5" placeholder="Hours (e.g. 2 or 2.5)" required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Perks*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="pekrs"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Tags*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="tags"required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">File Upload*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="file" id="example-text-input" name="file"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Course Description*</h4>
                                                            <textarea name="pro_desc" id="myTextarea" class="form-control" ></textarea>
                                                        </div>
                                                    </div>
                                                    </div>                                               
                                                </div>
                                                <?php $website_base = rtrim((string) $this->config->item('website_base_url'), '/'); if ($website_base === '') $website_base = 'http://127.0.0.1:8002'; ?>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-outline-secondary"
                                                        formaction="<?= htmlspecialchars($website_base . '/preview/course') ?>"
                                                        formtarget="_blank"
                                                    >
                                                        Preview
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
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