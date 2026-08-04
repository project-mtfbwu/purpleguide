<?php include('header.php') ?>  
            <style>
               body.modal-open {
                overflow: hidden !important;
              }

           </style>

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">PurplePremium Applications</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Users/users_list">Users</a></li>
                                            <li class="breadcrumb-item active">PurplePremium Applications</li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Premium Applications Section -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="m-t-0 header-title mb-4"><b>PurplePremium Applications</b></h4>

                                        <table id="premiumTable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Applied Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($premium_applications) && count($premium_applications) > 0){ 
                                                    foreach($premium_applications as $app){ ?>     
                                                <tr id="app-row-<?= $app->id ?>">
                                                    <td><?= isset($app->name) ? htmlspecialchars($app->name) : 'N/A'; ?></td>
                                                    <td><?= isset($app->email) ? htmlspecialchars($app->email) : 'N/A'; ?></td>
                                                    <td><?= isset($app->dial_code) ? htmlspecialchars($app->dial_code) : ''; ?> <?= isset($app->number) ? htmlspecialchars($app->number) : ''; ?></td>
                                                    <td><?= !empty($app->applied_at) ? date('d/m/Y H:i', strtotime($app->applied_at)) : ''; ?></td>
                                                    <td>
                                                        <?php 
                                                        $status_class = '';
                                                        if($app->status == 'approved') {
                                                            $status_class = 'badge-success';
                                                        } elseif($app->status == 'rejected') {
                                                            $status_class = 'badge-danger';
                                                        } else {
                                                            $status_class = 'badge-warning';
                                                        }
                                                        ?>
                                                        <span class="badge <?= $status_class ?>"><?= ucfirst($app->status); ?></span>
                                                    </td>
                                                    <td>
                                                        <?php if($app->status == 'pending'): ?>
                                                            <button type="button" class="btn btn-success btn-sm accept-btn" data-id="<?= $app->id ?>" title="Accept">
                                                                <i class="fas fa-check"></i> Accept
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm reject-btn" data-id="<?= $app->id ?>" title="Reject">
                                                                <i class="fas fa-times"></i> Reject
                                                            </button>
                                                        <?php else: ?>
                                                            <span class="text-muted">No action available</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php } 
                                                } else { ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No premium applications found</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

       <?php include('footer.php') ?>

        <!-- Load SweetAlert2 with onload callback -->
        <script>
        function loadSweetAlert2() {
            return new Promise(function(resolve, reject) {
                if (typeof Swal !== 'undefined') {
                    resolve();
                    return;
                }
                
                var script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js';
                script.onload = function() {
                    console.log('SweetAlert2 loaded successfully');
                    resolve();
                };
                script.onerror = function() {
                    console.error('Failed to load SweetAlert2');
                    reject();
                };
                document.head.appendChild(script);
            });
        }
        
        // Load SweetAlert2 and then initialize everything
        loadSweetAlert2().then(function() {
            // Show flash messages
            <?php if ($this->session->flashdata('error')) {?> 
            var isi= <?php echo json_encode ($this->session->flashdata('error')) ?> ;   
            Swal.fire({
                title: "Error",
                text: isi,
                icon: "error",
            });
            <?php } ?>
            
            <?php if ($this->session->flashdata('success')) {?> 
            var isi= <?php echo json_encode ($this->session->flashdata('success')) ?> ;   
            Swal.fire({
                title: "Success",
                text: isi,
                icon: "success",
            });
            <?php } ?>
            
            // Initialize premium handlers
            initPremiumHandlers();
        }).catch(function(error) {
            console.error('Error loading SweetAlert2:', error);
            // Fallback: try to initialize anyway after a delay
            setTimeout(function() {
                if (typeof Swal !== 'undefined') {
                    initPremiumHandlers();
                } else {
                    console.error('SweetAlert2 still not available');
                }
            }, 1000);
        });
        
        function initPremiumHandlers() {
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded! Retrying...');
                setTimeout(initPremiumHandlers, 100);
                return;
            }
            
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 is not loaded! Retrying...');
                setTimeout(initPremiumHandlers, 100);
                return;
            }
            
            console.log('jQuery version:', jQuery.fn.jquery);
            console.log('SweetAlert2 loaded:', typeof Swal !== 'undefined');
                    
            jQuery(document).ready(function($) {
                console.log('Document ready - initializing premium applications handlers');
                
                // Initialize DataTable for Premium Applications
                var table = null;
                if ($('#premiumTable').length) {
                    table = $('#premiumTable').DataTable({
                        "order": [[3, "desc"]], // Sort by applied date descending
                        "pageLength": 10,
                        "responsive": true
                    });
                    console.log('DataTable initialized');
                }
                        
                        // Attach event handlers - use direct binding on table body to work with DataTables
                        $('#premiumTable tbody').off('click', '.accept-btn').on('click', '.accept-btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Accept button clicked');
                    
                    var applicationId = $(this).data('id');
                    var btn = $(this);
                    var row = $('#app-row-' + applicationId);
                    
                    console.log('Application ID:', applicationId);
                    
                    if (!applicationId) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Invalid application ID',
                            icon: 'error'
                        });
                        return false;
                    }
                    
                    // Show confirmation modal
                    Swal.fire({
                        title: 'Confirm Approval',
                        text: 'Are you sure you want to approve this application?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, Approve',
                        cancelButtonText: 'No, Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User clicked Yes
                            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                            
                            var url = '<?= base_url("Users/accept_premium") ?>';
                            console.log('Accept URL:', url);
                            console.log('Sending AJAX request...');
                            
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: { application_id: applicationId },
                                dataType: 'json',
                                success: function(response) {
                                    console.log('Accept Response:', response);
                                    if (response && response.success) {
                                        Swal.fire({
                                            title: "Success",
                                            text: response.message || 'Application approved successfully',
                                            icon: "success",
                                            timer: 2000,
                                            showConfirmButton: false
                                        }).then(function() {
                                            // Reload page to refresh data
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Error",
                                            text: response.message || 'Failed to approve application',
                                            icon: "error",
                                        });
                                        btn.prop('disabled', false).html('<i class="fas fa-check"></i> Accept');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Accept Error:', xhr, status, error);
                                    console.error('Response Text:', xhr.responseText);
                                    console.error('Status Code:', xhr.status);
                                    var errorMsg = 'An error occurred. Please try again.';
                                    if (xhr.responseText) {
                                        try {
                                            var errorResponse = JSON.parse(xhr.responseText);
                                            if (errorResponse.message) {
                                                errorMsg = errorResponse.message;
                                            }
                                        } catch(e) {
                                            errorMsg = xhr.responseText.substring(0, 200);
                                        }
                                    }
                                    Swal.fire({
                                        title: "Error",
                                        text: errorMsg,
                                        icon: "error",
                                    });
                                    btn.prop('disabled', false).html('<i class="fas fa-check"></i> Accept');
                                }
                            });
                        }
                    });
                    
                    return false;
                });
                
                        // Reject Premium Application - use direct binding on table body
                        $('#premiumTable tbody').off('click', '.reject-btn').on('click', '.reject-btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Reject button clicked');
                    
                    var applicationId = $(this).data('id');
                    var btn = $(this);
                    var row = $('#app-row-' + applicationId);
                    
                    console.log('Application ID:', applicationId);
                    
                    if (!applicationId) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Invalid application ID',
                            icon: 'error'
                        });
                        return false;
                    }
                    
                    // Show confirmation modal
                    Swal.fire({
                        title: 'Confirm Rejection',
                        text: 'Are you sure you want to reject this application?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, Reject',
                        cancelButtonText: 'No, Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User clicked Yes
                            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                            
                            var url = '<?= base_url("Users/reject_premium") ?>';
                            console.log('Reject URL:', url);
                            console.log('Sending AJAX request...');
                            
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: { application_id: applicationId },
                                dataType: 'json',
                                success: function(response) {
                                    console.log('Reject Response:', response);
                                    if (response && response.success) {
                                        Swal.fire({
                                            title: "Success",
                                            text: response.message || 'Application rejected successfully',
                                            icon: "success",
                                            timer: 2000,
                                            showConfirmButton: false
                                        }).then(function() {
                                            // Reload page to refresh data
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Error",
                                            text: response.message || 'Failed to reject application',
                                            icon: "error",
                                        });
                                        btn.prop('disabled', false).html('<i class="fas fa-times"></i> Reject');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Reject Error:', xhr, status, error);
                                    console.error('Response Text:', xhr.responseText);
                                    console.error('Status Code:', xhr.status);
                                    var errorMsg = 'An error occurred. Please try again.';
                                    if (xhr.responseText) {
                                        try {
                                            var errorResponse = JSON.parse(xhr.responseText);
                                            if (errorResponse.message) {
                                                errorMsg = errorResponse.message;
                                            }
                                        } catch(e) {
                                            errorMsg = xhr.responseText.substring(0, 200);
                                        }
                                    }
                                    Swal.fire({
                                        title: "Error",
                                        text: errorMsg,
                                        icon: "error",
                                    });
                                    btn.prop('disabled', false).html('<i class="fas fa-times"></i> Reject');
                                }
                            });
                        }
                    });
                    
                    return false;
                });
                
                console.log('Event handlers attached');
            });
        }
        </script>
