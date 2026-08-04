<?php 
$current = strtolower($this->uri->segment(1) ?? ''); 
?>

<header>
        <!-- start navigation -->
        <nav class="navbar navbar-expand-lg header-light header-transparent bg-white">
            <div class="container-fluid">
                <div class="col-auto col-lg-2 me-lg-0 me-auto">
                    <a class="navbar-brand" href="<?= base_url('Home') ?>">
                        <img src="<?= base_url('assets/img/logo.webp') ?>" data-at2x="<?= base_url('assets/img/logo.webp') ?>" alt="" class="default-logo">
                        <img src="<?= base_url('assets/img/logo.webp') ?>" data-at2x="<?= base_url('assets/img/logo.webp') ?>" alt="" class="alt-logo">
                        <img src="<?= base_url('assets/img/logo.webp') ?>" data-at2x="<?= base_url('assets/img/logo.webp') ?>" alt="" class="mobile-logo">
                    </a>
                </div>
                <div class="col-auto menu-order position-static">
                    <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="<?= base_url('Home') ?>" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="<?= base_url('About') ?>" class="nav-link">About</a></li>
                            <li class="nav-item dropdown dropdown-with-icon <?= ($current == 'services') ? 'active' : '' ?>">
                                <a href="<?= base_url('Services') ?>" class="nav-link">Services</a>
                                <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                     <li>
                                        <a href="<?= base_url('Services') ?>"><i
                                                class="feather icon-feather-users"></i>
                                            <div class="submenu-icon-content">
                                                <span>AIRPORT PICK-UP</span>
                                                <p>RELIABLE LOCAL TRANSPORTATION</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Services') ?>"><i
                                                class="feather icon-feather-briefcase"></i>
                                            <div class="submenu-icon-content">
                                                <span>STUDENT JOBS</span>
                                                <p>EARN AND ENHANCE PROFESSIONALISM</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Services') ?>"><i
                                                class="feather icon-feather-box"></i>
                                            <div class="submenu-icon-content">
                                                <span>INSURANCE</span>
                                                <p>SAFEGUARDING YOUR JOURNEY</p>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= base_url('Services') ?>">
                                          <i
                                                class="feather icon-feather-briefcase"></i>
                                            <div class="submenu-icon-content">
                                                <span>EDUCATION LOAN</span>
                                                <p>EARN AND ENHANCE PROFESSIONALISM</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="<?= base_url('News_events') ?>" class="nav-link">News & Events</a></li>
                            <li class="nav-item"><a href="<?= base_url('Blog') ?>" class="nav-link">Blog</a></li>
                            <li class="nav-item"><a href="<?= base_url('Gallery') ?>" class="nav-link">Gallery</a></li>
                            <li class="nav-item"><a href="<?= base_url('Contact') ?>" class="nav-link">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto col-lg-2 text-end">
                    <div class="header-icon">
                        <div class="header-social-icon icon">
                            <a href="http://www.facebook.com" target="_blank"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="http://www.instagram.com" target="_blank"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
    </header>