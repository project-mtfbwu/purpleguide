<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login | PGS Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
    
    <!-- Modern Admin CSS -->
    <link href="<?php echo base_url();?>assets/css/modern-admin.css" rel="stylesheet" type="text/css">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body.login-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 0.6s ease-out;
        }
        
        .login-card {
            background: var(--bg-primary);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }
        
        .login-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .login-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.875rem;
        }
        
        .login-body {
            padding: 2.5rem 2rem;
        }
        
        .login-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
        }
        
        .login-logo i {
            font-size: 2rem;
            color: white;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .form-control {
            border-radius: 8px;
            border: 2px solid var(--border-color);
            padding: 0.75rem 1rem;
            transition: all var(--transition-fast);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 8px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            width: 100%;
            transition: all var(--transition-base);
            box-shadow: var(--shadow-md);
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .forgot-password-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: all var(--transition-fast);
        }
        
        .forgot-password-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .input-group-icon {
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-right: none;
            border-radius: 8px 0 0 8px;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            color: var(--text-secondary);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
        
        .input-group .form-control:focus {
            border-left: 2px solid var(--primary);
        }
        
        .input-group:focus-within .input-group-icon {
            border-color: var(--primary);
            color: var(--primary);
        }
    </style>
</head>

<body class="login-page">
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

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="mdi mdi-shield-lock"></i>
                </div>
                <h3>Welcome Back</h3>
                <p>Sign in to continue to Admin Panel</p>
            </div>
            
            <div class="login-body">
                <form method="POST" action="<?php echo base_url('Users/login');?>" id="loginForm">
                    <div class="mb-4">
                        <label for="emailaddress" class="form-label">
                            <i class="mdi mdi-email me-1"></i> Email Address
                        </label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="mdi mdi-email"></i>
                            </span>
                            <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="admin@example.com" autocomplete="email">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="mdi mdi-lock me-1"></i> Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="mdi mdi-lock"></i>
                            </span>
                            <input class="form-control" type="password" name="password" required id="password" placeholder="Enter your password" autocomplete="current-password">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword" style="border-left: none; border-radius: 0 8px 8px 0; border-color: var(--border-color);">
                                <i class="mdi mdi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" checked>
                            <label class="form-check-label" for="remember" style="font-size: 0.875rem; color: var(--text-secondary);">
                                Remember me
                            </label>
                        </div>
                        <a href="<?= base_url('Forgot_password'); ?>" class="forgot-password-link">
                            Forgot password?
                        </a>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-login" type="submit">
                            <i class="mdi mdi-login me-2"></i> Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('mdi-eye');
                eyeIcon.classList.add('mdi-eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('mdi-eye-off');
                eyeIcon.classList.add('mdi-eye');
            }
        });
        
        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('emailaddress').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error',
                    text: 'Please fill in all fields',
                    icon: 'error'
                });
                return false;
            }
        });
    </script>
</body>
</html>