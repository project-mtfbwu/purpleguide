<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>PGS</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>material/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
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
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url();?>upload/admin/2.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db" style="font-size: 18px; font-weight: 600;">
                            <!-- <span>
                                <img src="<?= base_url('assets/logo.png') ?>" alt="logo" style="height:40px;">
                            </span> -->
                        <h5 class="font-medium m-b-20 mt-2">Reset Password Admin</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" method="POST" action="<?php echo base_url('Reset_password/reset_password/'.$user_id); ?>"
                                  onsubmit="return validatePasswords(event)">
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="password" id="passwordField" class="form-control form-control-lg" placeholder="Password" required>
                                     <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                            <i id="eyeIcon" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="passwords" id="passwordFields" class="form-control form-control-lg" placeholder="Confirm New Password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswords()" style="cursor: pointer;">
                                            <i id="eyeIcons" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button type="submit" class="btn btn-block btn-lg btn-info" style="background-color: #3bc0c3;border-color: #3bc0c3;">Reset Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
       
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url();?>material/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url();?>material/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url();?>material/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>
    <script>
    function togglePassword() {
        let passwordInput = document.getElementById("passwordField");
        let eyeIcon = document.getElementById("eyeIcon");
    
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
    </script>
    
    <script>
    function togglePasswords() {
        let passwordInput = document.getElementById("passwordFields");
        let eyeIcons = document.getElementById("eyeIcons");
    
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcons.classList.remove("fa-eye");
            eyeIcons.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcons.classList.remove("fa-eye-slash");
            eyeIcons.classList.add("fa-eye");
        }
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function validatePasswords(event) {
        var pass1 = document.getElementById('passwordField').value.trim();
        var pass2 = document.getElementById('passwordFields').value.trim();
    
        if (pass1 !== pass2) {
            event.preventDefault(); // stop form submission
            Swal.fire({
                icon: 'error',
                title: 'Password Mismatch',
                text: 'Please enter both passwords the same!'
            });
            return false;
        }
        return true; // allow submit
    }
    </script>


</body>
</html>