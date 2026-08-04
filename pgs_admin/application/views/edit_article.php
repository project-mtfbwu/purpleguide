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
                                    <h4 class="mb-0">Edit Blog</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Edit Blog</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form action="<?= base_url('Article/edit_article_data') ?>" method="POST" enctype="multipart/form-data">                                
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
                                                        <label class="col-md-3 col-form-label">Select Category</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select" id="categorySelect" name="cat_id" required>
                                                                <?php if (!empty($category)) { 
                                                                    foreach ($category as $cat) { ?>
                                                                        <option value="<?= $cat->id ?>" <?= ($cat->id == $product->cat_id) ? 'selected' : '' ?>><?= $cat->category_name ?>
                                                                        </option>
                                                                <?php }
                                                                } ?>
                                                            </select>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mb-3">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Blog title</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="<?php echo  $product->product_name; ?>" id="example-text-input" name="prod_name"required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Upload Blog Image</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="file" value="<?= $product->image1; ?>"  name="prod_image1">
                                                        
                                                       <img src="<?php $img = $product->image1? $product->image1:'doc-thumb-2.jpg' ; echo base_url('assets/images/').$img ?>" style="width:100px; height: 80px;">
                                                       </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 mb-3">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Upload Thumbnail Image</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="file" value="<?= $row->image2 ?>" name="prod_image2">
                                                        
                                                        <img src="<?php $img = $row->image2? $row->image2:'doc-thumb-2.jpg' ; echo base_url('assets/images/').$img ?>" style="width:100px; height: 80px;">
                                                        </div>
                                                
                                                    </div>
                                                </div> -->
                                                <!-- <input type="hidden" name="id" value="<?= $row->p_id ?>"> -->
                                                <!-- <div class="col-md-6">
                                                    <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-3 col-form-label">Upload Article Images</label>
                                                    <div class="col-md-9">
                                                        <!-- Input for uploading new images -->
                                                        <!-- <input type="file" class="form-control" name="layouts[]" placeholder="Project Name" multiple>
                                                             <?php if (isset($lay_tbl_data) && count($lay_tbl_data)>0) {
                                                    foreach($lay_tbl_data as $lay) { ?>
                                                    
                                                   <img src="<?= base_url('assets/images/').$lay->layouts ?>" style="width: 80px;">
                                                   <a href="<?= base_url('Article/dlt_lays/') . $lay->id ?>/<?= $this->uri->segment(3); ?>" class="btn-sm edit" onclick="return confirmDelete();"><i class="fa fa-trash"></i></a> &nbsp &nbsp &nbsp
                                                    <?php }}  ?>
                                                    </div> -->
                                                    
                                               <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Blog Description*</h4>
                                                            <!-- <p class="card-title-desc">Example of Ckeditor Classic editor</p> -->
                                                            <div id=""><textarea name="description" id="myTextarea" class="form-control" required> <?= $product->description ?> </textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="form-control" type="hidden" value="<?php echo $product->id; ?>" name="id">

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <!--<label for="example-text-input" class="col-md-3 col-form-label">View on Homepage</spam> </label>-->
                                                        <!--<input type="hidden" name="view_home" value="0">-->
                                                        <div class="col-md-7">
                                                            <input type="hidden" value="$product->view_home" name="view_home" style="margin-top: 13px; transform: scale(1.5);">         
                                                        </div>
                                                    </div>
                                                </div>
                                      
    
                                        <div class="d-flex flex-wrap gap-3 justify-content-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light w-md" value="submit">Update</button>
                                            <!-- <button type="reset" class="btn btn-outline-danger waves-effect waves-light w-md">Reset</button> -->
                                        </div>
                                    
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                           </form>
                      
                        
                    </div> <!-- container-fluid -->
                </div>
            </div>
                <!-- End Page-content -->

                
                

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

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
 <script>
  tinymce.init({
    selector: '#myTextara',
    height: 250, // Specify the height of the editor
    plugins: 'autolink lists link image charmap print preview',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image|color',
  });
</script>
<script>
  tinymce.init({
    selector: '#myTextaraa',
    height: 250, // Specify the height of the editor
    plugins: 'autolink lists link image charmap print preview',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image|color',
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#categorySelect').change(function() {
        var categoryId = $(this).val();
        //console.log('Selected categoryId:', categoryId); 
        if (categoryId !== '') {
            $.ajax({
                url: '<?= base_url('Product/get_subcategories') ?>',
                type: 'POST',
                data: {categoryId: categoryId},
                dataType: 'json',
                success: function(response) {
                    $('#subcategorySelect').empty().append('<option value="">Select Subcategory</option>');
                    $.each(response, function(index, subcategory) {
                        $('#subcategorySelect').append('<option value="' + subcategory.id + '">' + subcategory.category_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#subcategorySelect').empty().append('<option value="">Select Subcategory</option>');
        }
    });
});
</script>
<script>
function confirmDelete() {
    console.log("Are you sure you want to delete this data?");
    return confirm("Are you sure you want to delete this data?"); // This line ensures that the default link action is executed only if the user confirms
}
</script>
   <?php $this->load->view('footer');  ?>