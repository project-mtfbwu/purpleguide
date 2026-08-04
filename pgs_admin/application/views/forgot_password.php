<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Forgot Password | PGS Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets\images\favicon.ico">

        <!-- App css -->
        <link href="assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
        <link href="assets\css\icons.min.css" rel="stylesheet" type="text/css">
        <link href="assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">

    </head>

    <body class="authentication-page">
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
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-header text-center p-4 bg-primary">
                                <h4 class="text-white mb-0 mt-0">Forgot Password Admin</h4>
                                <!-- <h5 class="text-white font-13 mb-0">Reset Password</h5> -->
                            </div>
                            <div class="card-body">
                                <form class="p-2" method="POST" action="<?php echo base_url('Forgot_password/forgot_password/'); ?>"
                                  onsubmit="return validatePasswords(event)" >

                                    <p class="text-muted text-center mb-4">Enter your email address and we'll send you an email with instructions to reset your password. </p>

                                    <div class="form-group mb-0">
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                            <span class="input-group-append"> <button type="submit" class="btn btn-primary">Forgot Password</button> </span>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>

        <!-- Vendor js -->
        <script src="assets\js\vendor.min.js"></script>

        <!-- App js -->
        <script src="assets\js\app.min.js"></script>

    </body>

</html>