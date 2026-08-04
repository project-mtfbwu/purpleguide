<?php include('header.php') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    // Wait for SweetAlert2 to load
    (function() {
        function showFlashMessages() {
            if (typeof Swal === 'undefined') {
                setTimeout(showFlashMessages, 100);
                return;
            }
            
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
        }
        showFlashMessages();
    })();
</script>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <h4 class="page-title mb-1">
                                    <i class="mdi mdi-view-dashboard me-2"></i>
                                    Premium Dashboard Management
                                </h4>
                                <p class="mb-0">Manage dashboard data for PurplePremium users</p>
                            </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Users/users_list">Users</a></li>
                                    <li class="breadcrumb-item active">Premium Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="stats-card-label mb-0">Total Premium Users</p>
                                <h3 class="stats-card-value mb-0"><?= isset($premium_users) ? count($premium_users) : 0 ?></h3>
                            </div>
                            <div class="text-primary" style="font-size: 3rem; opacity: 0.2;">
                                <i class="mdi mdi-account-group"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="stats-card-label mb-0">Configured Dashboards</p>
                                <h3 class="stats-card-value mb-0" style="color: var(--success);">
                                    <?php 
                                    $configured = 0;
                                    if(isset($premium_users)) {
                                        foreach($premium_users as $user) {
                                            if($user->dashboard_id) $configured++;
                                        }
                                    }
                                    echo $configured;
                                    ?>
                                </h3>
                            </div>
                            <div class="text-success" style="font-size: 3rem; opacity: 0.2;">
                                <i class="mdi mdi-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="stats-card-label mb-0">Pending Configuration</p>
                                <h3 class="stats-card-value mb-0" style="color: var(--warning);">
                                    <?php 
                                    $pending = 0;
                                    if(isset($premium_users)) {
                                        foreach($premium_users as $user) {
                                            if(!$user->dashboard_id) $pending++;
                                        }
                                    }
                                    echo $pending;
                                    ?>
                                </h3>
                            </div>
                            <div class="text-warning" style="font-size: 3rem; opacity: 0.2;">
                                <i class="mdi mdi-clock-outline"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Premium Users Table -->
            <div class="row">
                <div class="col-12">
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1" style="font-weight: 600; color: var(--text-primary);">
                                        <i class="mdi mdi-account-star me-2 text-primary"></i>
                                        Approved Premium Users
                                    </h4>
                                    <p class="text-muted mb-0" style="font-size: 0.875rem;">Manage and configure user dashboards</p>
                                </div>
                            </div>
                        </div>
                        <div class="modern-card-body">
                            <div class="modern-table-wrapper">
                                <table id="premiumUsersTable" class="table modern-table table-hover">
                                    <thead>
                                        <tr>
                                            <th><i class="mdi mdi-account me-1"></i> User Name</th>
                                            <th><i class="mdi mdi-email me-1"></i> Email</th>
                                            <th><i class="mdi mdi-information me-1"></i> Dashboard Status</th>
                                            <th class="text-center"><i class="mdi mdi-cog me-1"></i> Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($premium_users) && count($premium_users) > 0){ 
                                            foreach($premium_users as $user){ ?>     
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                        <?= strtoupper(substr($user->name, 0, 1)) ?>
                                                    </div>
                                                    <strong><?= htmlspecialchars($user->name) ?></strong>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($user->email) ?></td>
                                            <td>
                                                <?php if($user->dashboard_id): ?>
                                                    <span class="modern-badge badge-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Configured
                                                    </span>
                                                <?php else: ?>
                                                    <span class="modern-badge badge-warning">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Not Configured
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Users/manage_premium_dashboard/').$user->id ?>" class="btn btn-modern btn-primary btn-sm">
                                                    <i class="mdi mdi-pencil me-1"></i> Manage Dashboard
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } 
                                        } else { ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="mdi mdi-information-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                                    <p class="mt-3 mb-0">No approved premium users found</p>
                                                </div>
                                            </td>
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
</div>

<?php include('footer.php') ?>

<script>
$(document).ready(function() {
    $('#premiumUsersTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 25,
        "language": {
            "search": "",
            "searchPlaceholder": "Search users...",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No entries found",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "paginate": {
                "previous": "<i class='mdi mdi-chevron-left'></i>",
                "next": "<i class='mdi mdi-chevron-right'></i>"
            }
        },
        "drawCallback": function() {
            // Add animation to table rows
            $('tbody tr').each(function(index) {
                $(this).css('animation-delay', (index * 0.05) + 's');
                $(this).addClass('animate__animated animate__fadeInUp');
            });
        }
    });
    
    // Style DataTables search box
    $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Search users...');
});
</script>
