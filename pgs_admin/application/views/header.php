<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> PGS | Pgs Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets\images\favicon.ico">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        
        <!-- Material Design Icons (for compatibility) -->
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
        
        <!-- DataTables Bootstrap 5 -->
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css" rel="stylesheet">

        <!-- Ricksaw Css-->
        <link href="<?php echo base_url();?>assets\libs\rickshaw\rickshaw.min.css" rel="stylesheet" type="text/css">

        <!-- App css (keeping for sidebar compatibility) -->
        <link href="<?php echo base_url();?>assets\css\icons.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">
        
        <!-- Modern Admin CSS -->
        <link href="<?php echo base_url();?>assets\css\modern-admin.css" rel="stylesheet" type="text/css">
        
        <!-- Google Fonts - Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    </head>

    <body>
        <div id="wrapper">            
            <!-- Modern Header/Navbar -->
            <div class="navbar-custom">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <!-- Logo and Menu Toggle -->
                    <div class="d-flex align-items-center">
                        <button class="button-menu-mobile me-3" id="sidebar-toggle">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <?php 
                        $logoPath = FCPATH . 'assets/images/logo-sm.png';
                        if(file_exists($logoPath)): 
                        ?>
                        <a href="<?php echo base_url();?>Dashboard" class="navbar-logo text-decoration-none ms-2">
                            <img src="<?php echo base_url();?>assets/images/logo-sm.png" alt="Logo" height="32">
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- User Menu -->
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="userDropdown">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar">
                                        <?= strtoupper(substr($this->session->userdata('name'), 0, 1)) ?>
                                    </div>
                                    <span class="user-name-text">
                                       <?= $this->session->userdata('name') ?>
                                    </span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="userDropdown">
                                <div class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-small">
                                            <?= strtoupper(substr($this->session->userdata('name'), 0, 1)) ?>
                                        </div>
                                        <div class="ms-2 flex-grow-1" style="min-width: 0;">
                                            <div class="fw-600" style="font-size: 0.875rem; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $this->session->userdata('name') ?></div>
                                            <div class="text-muted" style="font-size: 0.75rem;">Administrator</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('Users/logout') ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout-variant"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Modern Sidebar -->
            <div class="left-side-menu" id="left-side-menu">
                <div class="slimscroll-menu">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <?php
                            $adminRole = strtolower(trim((string) $this->session->userdata('admin_role')));
                            if ($adminRole === 'superadmin') $adminRole = 'super_admin';
                        ?>
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="<?php echo base_url();?>Dashboard" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-account-group"></i>
                                    <span>Users</span>
                                    <i class="mdi mdi-chevron-right menu-arrow-icon"></i>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="<?php echo base_url();?>Users/users_list"><i class="mdi mdi-account-multiple me-2"></i>Users List</a></li>
                                    <?php if ($adminRole !== 'mentor'): ?>
                                    <li><a href="<?php echo base_url();?>Users/premium_applications"><i class="mdi mdi-star-circle me-2"></i>PurplePremium Applications</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo base_url();?>Users/premium_dashboard_list"><i class="mdi mdi-view-dashboard me-2"></i>Premium Dashboard</a></li>
                                    <li><a href="<?php echo base_url();?>Users/logs"><i class="mdi mdi-file-document-outline me-2"></i>Logs</a></li>
                                </ul>
                            </li>
                            <?php if ($adminRole === 'super_admin'): ?>
                            <li>
                                <a href="<?php echo base_url();?>Admins" class="waves-effect">
                                    <i class="mdi mdi-shield-account"></i>
                                    <span>Admins</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-calendar-multiple"></i>
                                    <span>Event Management</span>
                                    <i class="mdi mdi-chevron-right menu-arrow-icon"></i>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="<?php echo base_url();?>Event_category"><i class="mdi mdi-folder-multiple me-2"></i>Event Category</a></li>
                                    <li><a href="<?php echo base_url();?>Event/event_view"><i class="mdi mdi-calendar-check me-2"></i>Events</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-book-open-variant"></i>
                                    <span>Courses Management</span>
                                    <i class="mdi mdi-chevron-right menu-arrow-icon"></i>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="<?php echo base_url();?>Course_category"><i class="mdi mdi-folder-multiple me-2"></i>Courses Category</a></li>
                                    <li><a href="<?php echo base_url();?>Courses/course_view"><i class="mdi mdi-book-open-page-variant me-2"></i>Courses</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Universities" class="waves-effect">
                                    <i class="mdi mdi-school"></i>
                                    <span>University Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Cv_programs" class="waves-effect">
                                    <i class="mdi mdi-book-open-page-variant"></i>
                                    <span>Discover Our Programs</span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo base_url();?>Study_journey_enquiries/index" class="waves-effect">
                                    <i class="mdi mdi-airplane-takeoff"></i>
                                    <span>Study abroad journey</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Univmeet" class="waves-effect">
                                    <i class="mdi mdi-calendar-today"></i>
                                    <span>#univMeet Dates</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-school"></i>
                                    <span>Student Resources</span>
                                    <i class="mdi mdi-chevron-right menu-arrow-icon"></i>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="<?php echo base_url();?>Student_resources/key_dates"><i class="mdi mdi-calendar me-2"></i>Key Dates</a></li>
                                    <li><a href="<?php echo base_url();?>Student_resources/urgent_deadlines"><i class="mdi mdi-alert me-2"></i>Urgent Deadlines</a></li>
                                    <li><a href="<?php echo base_url();?>Student_resources/subscribers"><i class="mdi mdi-email me-2"></i>Subscribers</a></li>
                                    <li><a href="<?php echo base_url();?>Student_resources/settings"><i class="mdi mdi-cog me-2"></i>Settings</a></li>
                                    <li><a href="<?php echo base_url();?>Student_resources/pgs_stats"><i class="mdi mdi-chart-bar me-2"></i>PGS Stats</a></li>
                                    <li><a href="<?php echo base_url();?>Student_resources/study_abroad_facts"><i class="mdi mdi-lightbulb-on-outline me-2"></i>Study Abroad Facts</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Faq" class="waves-effect">
                                    <i class="mdi mdi-help-circle"></i>
                                    <span>FAQs</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Testimonial" class="waves-effect">
                                    <i class="mdi mdi-comment-text-multiple"></i>
                                    <span>Testimonials</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-account-group"></i>
                                    <span>About Page</span>
                                    <i class="mdi mdi-chevron-right menu-arrow-icon"></i>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="<?php echo base_url();?>About_page/founder"><i class="mdi mdi-account-tie me-2"></i>Meet The Founder</a></li>
                                    <li><a href="<?php echo base_url();?>About_page/advisory"><i class="mdi mdi-account-multiple me-2"></i>Advisory Team</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Weekly_wall" class="waves-effect">
                                    <i class="mdi mdi-tag-multiple"></i>
                                    <span>Weekly Wall</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Highlights" class="waves-effect">
                                    <i class="mdi mdi-star"></i>
                                    <span>Highlights</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Privacy_policy" class="waves-effect">
                                    <i class="mdi mdi-shield-lock"></i>
                                    <span>Privacy Policy</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Terms_conditions" class="waves-effect">
                                    <i class="mdi mdi-file-document"></i>
                                    <span>Terms Conditions</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Refund_policy" class="waves-effect">
                                    <i class="mdi mdi-undo"></i>
                                    <span>Refund Policy</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Social_media" class="waves-effect">
                                    <i class="mdi mdi-share-variant"></i>
                                    <span>Social Media Links</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Enquiries/enquiry_view" class="waves-effect">
                                    <i class="mdi mdi-email-multiple"></i>
                                    <span>Enquiries</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Modal_submissions/index" class="waves-effect">
                                    <i class="mdi mdi-inbox-multiple"></i>
                                    <span>Modal Submissions</span>
                                </a>
                            </li>
                           
                            <li>
                                <a href="<?php echo base_url();?>Marquee" class="waves-effect">
                                    <i class="mdi mdi-format-text-variant"></i>
                                    <span>Marquee</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Premium_meetup" class="waves-effect">
                                    <i class="mdi mdi-calendar-text"></i>
                                    <span>Premium Meetup Card</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Premium_video" class="waves-effect">
                                    <i class="mdi mdi-video"></i>
                                    <span>Premium Hero Video</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Premium_modals" class="waves-effect">
                                    <i class="mdi mdi-window-restore"></i>
                                    <span>Premium Modals</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>Profile" class="waves-effect">
                                    <i class="mdi mdi-account"></i>
                                    <span>Profile</span>
                                </a>
                            </li>



                

                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
