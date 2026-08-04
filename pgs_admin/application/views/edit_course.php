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
                                            <form action="<?= base_url('Courses/edit_course_data') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-3">Select Category*</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-control" name="cat_id" id="categorySelect" required>
                                                              <option value="">Select Category</option>
                                                                <?php
                                                                if ($cate && count($cate) > 0) {
                                                                    foreach ($cate as $cat) {  
                                                                ?>
                                                                    <option value="<?= $cat->id ?>" 
                                                                        <?= ($product->cat_id == $cat->id) ? 'selected' : '' ?>>
                                                                        <?= $cat->category_name ?>
                                                                    </option>
                                                                <?php 
                                                                    }  
                                                                }  
                                                                ?>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Course title</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="<?php echo  $product->product_name; ?>" id="example-text-input" name="prod_name"required>
                                                            <input class="form-control" type="hidden" value="<?php echo  $product->id; ?>" name="id">
                                                            <input type="hidden" name="course_id" value="<?= (int) ($product->id ?? 0) ?>">
                                                        </div>
                                                      </div>
                                                    </div>                                                                                                     
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Course sub title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" value="<?php echo  $product->prod_sub_name; ?>" name="prod_sub_name"required>
                                                        </div>
                                                      </div>
                                                    </div> 
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="col-md-3">Upload Course Image</label>
                                                            <div class="col-md-9">
                                                                <input type="hidden" name="existing_image1" value="<?= htmlspecialchars((string)($product->image1 ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                                                                <input class="form-control" type="file" value="<?= $product->image1; ?>"  name="prod_image1">
                                                                <img src="<?php $img = $product->image1? $product->image1:'doc-thumb-2.jpg' ; echo base_url('assets/images/').$img ?>" style="width:100px; height: 70px;" class="mt-2">
                                                            </div>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Registration Start Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" value="<?php echo  $product->s_date; ?>" name="s_date"required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Registration End Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" value="<?php echo  $product->e_date; ?>" name="e_date"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Duration*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" value="<?php echo  $product->duration; ?>" name="duration" min="0" step="0.5" placeholder="Hours (e.g. 2 or 2.5)" required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Perks*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" value="<?php echo  $product->pekrs; ?>" name="pekrs"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">Tags*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" value="<?php echo  $product->tags; ?>" name="tags"required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3">File Upload*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input type="hidden" name="existing_file" value="<?= htmlspecialchars((string)($product->file ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                                                            <input class="form-control" type="file" value="<?= $product->file; ?>"  name="file">
                                                            <?php 
                                                            $file = $product->file ? $product->file : 'doc-thumb-2.jpg';
                                                            $fullpath = base_url('assets/images/') . $file;
                                                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                                                            $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                                                            if (in_array($ext, $image_ext)) {
                                                            ?>
                                                                <img src="<?= $fullpath ?>" style="width:100px; height:70px;" class="mt-2">
                                                            <?php 
                                                            } else {
                                                            ?>
                                                                <a href="<?= $fullpath ?>" target="_blank" class="btn btn-primary btn-sm mt-1">
                                                                    View File
                                                                </a>
                                                            <?php 
                                                            }
                                                            ?>

                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Course Description*</h4>
                                                            <textarea name="description" id="myTextarea" class="form-control" required><?= $product->description ?></textarea>

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
                                                    <button type="submit" class="btn btn-primary">Update</button>
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