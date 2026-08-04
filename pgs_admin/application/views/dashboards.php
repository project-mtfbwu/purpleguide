<?php  include('header.php') ?>
            <!-- ========== Left Sidebar Start ========== -->
           
            <!-- Left Sidebar End -->

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
               .my_block td{
                   background-color: #f2e5dc;
                    color: black;
               }
               .card-text{
                   padding:17px;
                   padding-bottom: 0px !important;
                   font-size: large;
               }
               .col-md-4{
                   padding:30px;
               }
               .card-bodys{
                   background-color: #f7e8e8;
               }
               .dashboard-card {
                    min-height: 300px; /* ensures it's not too short */
                    height: auto; /* lets it grow as needed */
                }
                .card-bodys {
                    padding: 30px 20px;
                    border-radius: 25px;
                    color: white;
                }
                .row > .col-md-4 .card {
                    height: 100%;
                }
                @media (max-width: 768px) {
                    .dashboard-card {
                        min-height: auto;
                        padding: 10px;
                    }
                }
                .h-100{
                    border: 0px;
                    box-shadow: none !important;
                }
                .card-heading{
                    color: white !important;
                    padding-top: 30px;
                }
            </style>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> Dashboard</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-12">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card text-center h-100" >
                                                    <div class="card-body card-bodys" style="background-color: #8b76ff !important;">
                                                        <h5 class="card-title card-heading" style="">Admin</h5>
                                                        <p class="card-text" ><?= $admin_count ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card text-center h-100">
                                                    <div class="card-body card-bodys" style="background-color: #0bb2fb !important;">
                                                        <h5 class="card-title card-heading">Users</h5>
                                                        <p class="card-text"><?= $users_count ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card text-center h-100">
                                                    <div class="card-body card-bodys" style="background-color: #ff6708 !important;">
                                                        <h5 class="card-title card-heading">Total Enquires</h5>
                                                        <p class="card-text"><?= $enquiries_count ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card text-center h-100" >
                                                    <div class="card-body card-bodys" style="background-color: #8b76ff !important;">
                                                        <h5 class="card-title card-heading" style="">Admin</h5>
                                                        <p class="card-text" ><?= $admin_count ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card text-center h-100">
                                                    <div class="card-body card-bodys" style="background-color: #0bb2fb !important;">
                                                        <h5 class="card-title card-heading">Users</h5>
                                                        <p class="card-text"><?= $users_count ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card text-center h-100">
                                                    <div class="card-body card-bodys" style="background-color: #ff6708 !important;">
                                                        <h5 class="card-title card-heading">Total Enquires</h5>
                                                        <p class="card-text"><?= $enquiries_count ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <div class="rightbar-overlay"></div>

   <?php  $this->load->view('footer'); ?>
   
         
















