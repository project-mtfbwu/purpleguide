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
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 70px;   /* Increase width */
  height: 34px;  /* Increase height */
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

/* Background bar */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #dc3545; /* Unpublished Red */
  transition: .4s;
  border-radius: 34px;
}

/* Circle knob */
.slider:before {
  position: absolute;
  content: "";
  height: 26px;   /* Increase circle size */
  width: 26px;
  left: 4px;      /* Center alignment */
  bottom: 4px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

/* ON (Published) */
input:checked + .slider {
  background-color: #3bc0c3; /* Published Green */
}

/* Move circle */
input:checked + .slider:before {
  transform: translateX(36px); /* move circle to right */
}
</style>


            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Marquee</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Marquee</li>
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
                                            <h4 class="card-title m-0">Marquee</h4><br>
                                            <!-- <a href="javascript:history.back()" class="btn btn-primary">Back</a> -->
                                        </div>
                                        <br>
                                            <form action="<?= base_url('Marquee/update_marquee') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="marquee_text" class="col-md-3 col-form-label">Marquee Text</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" id="marquee_text" name="marquee_text" rows="4" required><?= htmlspecialchars($product->marquee_text ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                                                            <input class="form-control" type="hidden" value="<?php echo $product->id; ?>" name="id">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="marquee_link" class="col-md-3 col-form-label">Marquee Link</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="<?= htmlspecialchars($product->marquee_link ?? '', ENT_QUOTES, 'UTF-8') ?>" id="marquee_link" name="marquee_link" placeholder="https://example.com or /page-url">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-6 col-form-label">Marquee Visibility</label>
                                                        <div class="col-md-6">
                                                            <label class="switch">
                                                                <input type="checkbox" 
                                                                       onchange="window.location='<?= base_url('Marquee/update/' . $product->id); ?>'" 
                                                                       <?= ($product->block_status == 0) ? 'checked' : '' ?>>
                                                                <!-- <span class="slider round" style="background-color:#3bc0c3 !important;"></span> -->
                                                                <span class="slider round"></span>
                                                            </label>
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
        <?php include('footer.php') ?>
