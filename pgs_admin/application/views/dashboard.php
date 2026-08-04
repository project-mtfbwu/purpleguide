<?php include('header.php') ?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <!-- <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li> -->
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body widget-style-2">
                                        <div class="media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0"><span data-plugin="counterup"><?= $admin_count ?></span></h2>
                                                <p class="mb-0">Admin Count</p>
                                            </div>
                                            <!-- <i class="ion-md-eye text-pink bg-light"></i> -->
                                            <i class="ion-ios-pricetag text-info bg-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body widget-style-2">
                                        <div class="media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0"><span data-plugin="counterup">1268</span></h2>
                                                <p class="mb-0">New Orders</p>
                                            </div>
                                            <i class="ion-ios-pricetag text-info bg-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body widget-style-2">
                                        <div class="media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0"><span data-plugin="counterup"><?= $users_count ?></span></h2>
                                                <p class="mb-0">Users Count</p>
                                            </div>
                                            <i class="mdi mdi-comment-multiple text-primary bg-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body widget-style-2">
                                        <div class="media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0"><span data-plugin="counterup"><?= $enquiries_count ?></span></h2>
                                                <p class="mb-0">Total Enquires</p>
                                            </div>
                                            <i class="ion-md-paper-plane text-purple bg-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include('footer.php') ?>