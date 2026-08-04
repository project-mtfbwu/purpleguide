<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <title>PGS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- favicon icon -->
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendors.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/icon.min.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css')?>" />
    <link rel="stylesheet" href="<?= base_url('assets/demos/marketing/marketing.css')?>" />
    
    <style>
        @media (max-width: 767px) {
    .avatar-box, .search-box  {
        flex-direction: column;
        gap: 0px !important;
        display: none;
    }
    .pt-200 {
    padding-bottom: 100px !important;
   }
}
    </style>
</head>

<body data-mobile-nav-style="classic" class="custom-cursor">
    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->
    <!-- start header -->
    <?php $this->load->view('header'); ?>
    <!-- end header -->
    
    <?php $this->load->view('sidebar'); ?>
    <!-- user section -->
   

    <div class="wrapper-content">

        <section class="pt-0 minus-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div
                            class="overflow-hidden d-flex gap-5 justify-content-center align-items-center content-404  position-relative pt-200">
                            <div>
                                <h1 class="mb-0 fs-30 text-black fnt-family-1">That didn’t load!</h1>
                                <h6 class="mb-1 fs-18 text-black fnt-family-1">Link’s broken.</h6>
                                <h6 class="mb-1 fs-18 text-black fnt-family-1">Can’t seem to find that page.</h6>
                                <a href="index.html" class="text-black-underline text-black fw-500 fnt-family-1">[Back
                                    to #PGS home]</a>
                            </div>
                            <img src="./assets/img/dragan.png" alt="dragan" width="210px" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    
    <?php $this->load->view('footer'); ?>
    
    
</body>

</html>