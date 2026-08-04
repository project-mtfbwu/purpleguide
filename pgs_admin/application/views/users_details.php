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
                                    <h4 class="page-title">User Details</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">User Details</li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h4 class="card-title m-0">User Information</h4>
                                            <a href="<?= base_url('Users/users_list') ?>" class="btn btn-primary">
                                                <i class="fas fa-arrow-left"></i> Back to Users List
                                            </a>
                                        </div>
                                        
                                        <?php if (isset($product) && $product): ?>
                                        <!-- Profile Section -->
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <div class="border rounded p-4 bg-light">
                                                    <div class="row align-items-center">
                                                        <?php if (!empty($product->image1)): ?>
                                                        <div class="col-md-2 text-center">
                                                            <img src="<?= base_url('../assets/images/' . $product->image1) ?>" 
                                                                 class="img-thumbnail" 
                                                                 style="width:120px; height:120px; object-fit: cover;"
                                                                 onerror="this.src='<?= base_url('../assets/images/doc-thumb-2.jpg') ?>'">
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="<?= !empty($product->image1) ? 'col-md-10' : 'col-md-12' ?>">
                                                            <?php if (!empty($product->name)): ?>
                                                            <h3 class="mb-2"><?php echo htmlspecialchars($product->name); ?></h3>
                                                            <?php endif; ?>
                                                            <?php if (!empty($product->email)): ?>
                                                            <p class="text-muted mb-1">
                                                                <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($product->email); ?>
                                                            </p>
                                                            <?php endif; ?>
                                                            <?php if (!empty($product->dial_code) || !empty($product->number)): ?>
                                                            <p class="text-muted mb-0">
                                                                <i class="fas fa-phone"></i> <?php echo htmlspecialchars(trim(($product->dial_code ?? '') . ' ' . ($product->number ?? ''))); ?>
                                                            </p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Personal Information Section -->
                                        <?php 
                                        $hasPersonalInfo = !empty($product->name) || !empty($product->email) || !empty($product->dial_code) || !empty($product->number) || isset($product->whatsapp);
                                        if ($hasPersonalInfo): 
                                        ?>
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <h5 class="mb-3 border-bottom pb-2">
                                                    <i class="fas fa-user"></i> Personal Information
                                                </h5>
                                            </div>
                                            <?php if (!empty($product->name)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Full Name</label>
                                                <div class="form-control-plaintext"><?php echo htmlspecialchars($product->name); ?></div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->email)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Email Address</label>
                                                <div class="form-control-plaintext"><?php echo htmlspecialchars($product->email); ?></div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->dial_code) || !empty($product->number)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Phone Number</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars(trim(($product->dial_code ?? '') . ' ' . ($product->number ?? ''))); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (isset($product->whatsapp)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">WhatsApp</label>
                                                <div class="form-control-plaintext">
                                                    <?php 
                                                        if ($product->whatsapp == 1 && (!empty($product->dial_code) || !empty($product->number))) {
                                                            echo '<span class="badge bg-success">Yes</span> - ' . htmlspecialchars(trim(($product->dial_code ?? '') . ' ' . ($product->number ?? '')));
                                                        } else {
                                                            echo '<span class="badge bg-secondary">No</span>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>

                                        <!-- Location & Study Information Section -->
                                        <?php 
                                        $hasLocationInfo = !empty($product->country_name) || !empty($product->preferred_country_name) || !empty($product->study_level) || !empty($product->field_interest);
                                        if ($hasLocationInfo): 
                                        ?>
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <h5 class="mb-3 border-bottom pb-2">
                                                    <i class="fas fa-globe"></i> Location & Study Information
                                                </h5>
                                            </div>
                                            <?php if (!empty($product->country_name)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Country of Citizenship</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars($product->country_name); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->preferred_country_name)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Preferred Study Country</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars($product->preferred_country_name); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->study_level)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Study Level</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars($product->study_level); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->field_interest)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Course or Field of Interest</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars($product->field_interest); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>

                                        <!-- Additional Information Section -->
                                        <?php 
                                        $hasAdditionalInfo = !empty($product->work_experience) || !empty($product->referral_code) || !empty($product->created_at);
                                        if ($hasAdditionalInfo): 
                                        ?>
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <h5 class="mb-3 border-bottom pb-2">
                                                    <i class="fas fa-info-circle"></i> Additional Information
                                                </h5>
                                            </div>
                                            <?php if (!empty($product->work_experience)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Work Experience</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars($product->work_experience); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->referral_code)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Referral Code</label>
                                                <div class="form-control-plaintext">
                                                    <?php echo htmlspecialchars($product->referral_code); ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product->created_at)): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold text-muted">Account Created</label>
                                                <div class="form-control-plaintext">
                                                    <?php 
                                                        try {
                                                            echo date('d M Y, h:i A', strtotime($product->created_at));
                                                        } catch (Exception $e) {
                                                            echo htmlspecialchars($product->created_at);
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <h5>User Not Found</h5>
                                    <p>The user you are looking for does not exist or has been deleted.</p>
                                    <a href="<?= base_url('Users/users_list') ?>" class="btn btn-primary">Back to Users List</a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

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