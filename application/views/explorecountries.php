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
		.pointer-img
		{
			    position: absolute;
    right: 44px;
    width: 118px;
    top: 56px;
		}
		@media (max-width: 767px) {
		.pointer-img {
    position: absolute;
    right: 44px;
    width: 118px;
    top: 119px;
}
		}
		.btn-green-btn {
    background-color: #009C70 !important;
    color: white !important;
    border-radius: 10px;
    font-size: 19px !important;
    position: relative;
    z-index: 1000;
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
    <div class="wrapper-content">

    <!-- AboutUs -->
    <section class="pt-0 about-section half-section overlap-height position-relative minus-5 mobile-board-2">
        <div class="container overlap-gap-section p-0">
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="w-75 m-auto text-center">
                        <h1 class="text-black fw-500 fs-36 pt-0 mb-1 lh-40">Get Into Your Dream University
                            Abroad with a Structured Workflow</h1>
                        <p class="mb-0 lh-20 fs-16">Boost Your Chances of Selection 3X with Smart, Informed University
                            Picks
                        </p>
                        <h6 class="mb-0 text-black fs-16 mt-0">For Medical, STEM, and More—We’ve Got You Covered
                        </h6>

                        <button type="button" class="btn btn-purple mt-1 bg-black-btn fs-11 mt-1 mb-0">Set Up a Quick
                            Call</button>
                        <p class="mb-0 fs-12 lh-15 mt-1">Clear All Your Doubts in 30 Minutes, Figure out your scholarship
                            path.</p>

                    </div>

                </div>

            </div>
              </div>
    </section>

    <section class="pt-0 pb-0 overlap-height position-relative mobile-section-step-1">
        <div class="w-725px m-auto overlap-gap-section p-0">
            <div class="d-flex gap-5 justify-content-center mobile-wrap">
                <div class="w-520px">
                    <div class="card-box-img bg-black">
                        <div class="fit-object-cover-1 "
                            >
                            <img src="./assets/img/music.png" />
                        </div>
                        <div class="pt-3 d-flex justify-content-space align-items-start px-3 mobile-wrap" style="    position: relative;
    overflow: hidden;">
                            <div
                                >
                                <h4 class="fnt-family mb-1 fs-50 text-white">study in </h4>
                                <h4 class="mb-0 fs-75 text-white lh-65 d-flex gap-3 mobile-br-none mobile-fs-50">
                                    <span class="fnt-family">united <br />
                                        kingdom
                                    </span>
                                </h4>
                            </div>
                            <div class="mobile-pb-30">
                                <a href="<?= base_url('countriesuk') ?>" type="button" class="btn btn-green-btn fs-16 mobile-fs-14">
                                    UK 101: What to Know
                                </a>
								<img src="<?= base_url('assets/img/pointer.webp') ?>" alt="" class="pointer-img" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-20">
                    <div class="vs-box-set text-center"
                        >
                        <h1 class="fnt-family fs-86 text-black mb-10 overflow-hidden" data-country="united<br>states" data-href="<?= base_url('countriesusa') ?>"><span>USA</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-10 overflow-hidden" data-country="united<br>kingdom" data-href="<?= base_url('countriesuk') ?>"><span class="bg-purple px-3">UK</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-10 overflow-hidden" data-country="new<br>zealand" data-href="<?= base_url('countriesnz') ?>"><span>nz</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-10 overflow-hidden" data-country="australia" data-href="<?= base_url('countriesaus') ?>"><span>aus</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-10 overflow-hidden" data-country="canada" data-href="<?= base_url('countriescanada') ?>"><span>CAN</span></h1>
                    </div>
                </div>
            </div>
            </div>
    </section>


    <section class="pt-0 mobile-box-explore">
        <div class="w-875px m-auto">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="purple-gray-box">

                        <div class="d-flex align-items-start gap-3 position-relative">
                            <div class="w-148px 225px mobile-w-50">
                                <div class="card-box-border">
                                    <div class="icon-box-position">
                                        <img src="./assets/img/list-check.png" />
                                    </div>
                                    <div class="bg-light-box mt-10">
                                        <h6>Smart
                                            shortlisting</h6>
                                        <h6>+</h6>
                                        <h6>Profile deep-dive</h6>
                                    </div>
                                </div>
                                 <div class="card-box-border d-flex gap-3 justify-content-start desktop-none mobile-wrap">
                                    <div class="icon-box-position">
                                        <img src="./assets/img/user-edit.png" />
                                    </div>
                                    <div class="bg-light-box">
                                        <h6>Fast-tracked<br />
                                            applications</h6>
                                        <h6>+</h6>
                                        <h6>Result-driven SOP</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="w-230px mobile-none">
                                <div class="card-box-border d-flex gap-3 justify-content-start">
                                    <div class="icon-box-position">
                                        <img src="./assets/img/user-edit.png" />
                                    </div>
                                    <div class="bg-light-box">
                                        <h6>Fast-tracked<br />
                                            applications</h6>
                                        <h6>+</h6>
                                        <h6>Result-driven SOP</h6>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="w-40 mobile-w-50">
                                <h6 class="mb-0 text-black fs-14 lh-16 fw-600">Simple, clear, useful</h6>
                                <p class="fw-400 text-black fs-14 lh-full mobile-fs-14" style="color:#000000A6">Using our experience, feedback from students
                                    who made it, and insights from thousandsmobile-fs-14of real
                                    applications—we’ve built an approach that puts
                                    you, the student, at the center ❤️</p>

                                    <!--Mobile List View -->
                                     <ul class="w-100 p-0 m-0 flot-section-top pl-2 desktop-none">
                                        <li class="text-black fs-16 mobile-fs-14 lh-20 mobile-lh-full mb-2 d-flex gap-2 align-items-center"><span
                                                class="green-box-dot"></span><span class="mobile-w-90">Recommended QBanks, review books.</span></li>
                                        <li class="text-black fs-16 mobile-fs-14 lh-20 mobile-lh-full mb-2 d-flex gap-2 align-items-center"><span
                                                class="green-box-dot"></span><span class="mobile-w-90">Suggested mocks for your stage.</span></li>
                                        <li class="text-black fs-16 mobile-fs-14 lh-20 mobile-lh-full mb-2 d-flex gap-2 align-items-center"><span
                                                class="green-box-dot"></span><span class="mobile-w-90">Clinical Rotation Package</span></li>
                                    </ul>


                                <div class="bg-pink box-flot-banner">
                                    <h1  class="fnt-family text-black fs-28 w-65 m-auto pt-10 lh-28">explore <br />
                                        more<br />
                                        below</h1>
                                    <i class="bi bi-arrow-down-circle-fill fs-40 text-black position-absolute ms-22-flot-8"></i>
                                    <div  class="box-object-fit-10">
                                        <img src="./assets/img/degree-with-girl.png" />
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-start gap-3 position-relative mobile-none">
                            <div class="w-148px 225px" ></div>
                          <ul class="w-100 p-0 m-0 flot-section-top pl-2 desktop-none">
                                    <li class="text-black fs-16 lh-20 mb-2 d-flex gap-2 align-items-center"><span
                                            class="green-box-dot"></span>Recommended QBanks, review books.</li>
                                    <li class="text-black fs-16 lh-20 mb-2 d-flex gap-2 align-items-center"><span
                                            class="green-box-dot"></span>Suggested mocks for your stage.</li>
                                    <li class="text-black fs-16 lh-20 mb-2 d-flex gap-2 align-items-center"><span
                                            class="green-box-dot"></span>Clinical Rotation Package</li>
                                </ul>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


     <section class="pt-15 overlap-height position-relative pb-2 mobile-explore-2">
        <div class="w-821px mobile-w-full m-auto overlap-gap-section p-0 mobile-section-step-1">
            <div class="d-flex justify-content-center gap-10 mobile-wrap">

                <div class="w-520px mobile-w-full">
                    <div class="card-box-img bg-black">
                        <div class="fit-object-cover-1">
                            <img src="./assets/img/music.png" />
                        </div>
                        <div class="pt-3 d-flex justify-content-space align-items-start px-3 mobile-wrap" style="    position: relative;
    overflow: hidden;">
                            <div class="mobile-w-full">
                                <h4 class="fnt-family mb-1 fs-50 text-white">study in </h4>
                                <h4 class="fs-75 text-white lh-65 d-flex gap-3 pb-20 mobile-pb-0 mobile-mb-0 mobile-fs-50">
                                    <span class="fnt-family">Mauritius
                                    </span>
                                </h4>
                            </div>
                            <div class="mobile-pb-30">
                                <a href="<?= base_url('countriesmauritius') ?>" type="button" class="btn btn-green-btn mobile-fs-14">
                                    UK 101: What to Know
                                </a>
								<img src="<?= base_url('assets/img/pointer.webp') ?>" alt="" class="pointer-img" />
								
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-25 mobile-w-95 mobile-fs-32">
                    <div class="vs-box-set text-center"
                        >
                        <h1 class="fnt-family fs-86 text-black mb-8 overflow-hidden" data-country="germany" data-href="<?= base_url('countriesgermany') ?>"><span>ger</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-8 overflow-hidden" data-country="france" data-href="<?= base_url('countriesfrance') ?>"><span>fra</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-8 overflow-hidden" data-country="mauritius" data-href="<?= base_url('countriesmauritius') ?>"><span class="bg-purple px-3">mur</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-8 overflow-hidden" data-country="europe" data-href="<?= base_url('countrieseurope') ?>"><span>europe</span></h1>
                        <h1 class="fnt-family fs-86 text-black mb-8 overflow-hidden" data-country="others" data-href="<?= base_url('countriesothers') ?>"><span>others</span></h1>
                    </div>
                </div>

            </div>
            </div>
    </section>

    
  <section class="pt-0 pb-0 mobile-box-explore">
        <div class="w-875px m-auto">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="purple-gray-box">

                        <div class="d-flex align-items-start gap-3 position-relative">
                            <div class="w-148px 225px mobile-w-50" >
                                <div class="card-box-border">
                                    <div class="icon-box-position">
                                        <img src="./assets/img/list-check.png" />
                                    </div>
                                    <div class="bg-light-box mt-10">
                                        <h6>Smart
                                            shortlisting</h6>
                                        <h6>+</h6>
                                        <h6>Profile deep-dive</h6>
                                    </div>
                                </div>
                                 <div class="card-box-border d-flex gap-3 justify-content-start desktop-none mobile-wrap">
                                    <div class="icon-box-position">
                                        <img src="./assets/img/user-edit.png" />
                                    </div>
                                    <div class="bg-light-box">
                                        <h6>Fast-tracked<br />
                                            applications</h6>
                                        <h6>+</h6>
                                        <h6>Result-driven SOP</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="w-230px mobile-none">
                                <div class="card-box-border d-flex gap-3 justify-content-start">
                                    <div class="icon-box-position">
                                        <img src="./assets/img/user-edit.png" />
                                    </div>
                                    <div class="bg-light-box">
                                        <h6>Fast-tracked<br />
                                            applications</h6>
                                        <h6>+</h6>
                                        <h6>Result-driven SOP</h6>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="w-40 w-40 mobile-w-50 mobile-pt-4">
                                <h6 class="mb-0 text-black fs-14 lh-16 fw-600">Simple, clear, useful</h6>
                                <p class="fw-400 text-black fs-14 lh-full" style="color:#000000A6">Using our experience, feedback from students
                                    who made it, and insights from thousands of real
                                    applications—we’ve built an approach that puts
                                    you, the student, at the center ❤️</p>
                                    
                                     <!--Mobile List View -->
                                     <ul class="w-100 p-0 m-0 flot-section-top pl-2 desktop-none">
                                        <li class="text-black fs-16 mobile-fs-14 lh-20 mobile-lh-full mb-2 d-flex gap-2 align-items-center"><span
                                                class="green-box-dot"></span><span class="mobile-w-90">Recommended QBanks, review books.</span></li>
                                        <li class="text-black fs-16 mobile-fs-14 lh-20 mobile-lh-full mb-2 d-flex gap-2 align-items-center"><span
                                                class="green-box-dot"></span><span class="mobile-w-90">Suggested mocks for your stage.</span></li>
                                        <li class="text-black fs-16 mobile-fs-14 lh-20 mobile-lh-full mb-2 d-flex gap-2 align-items-center"><span
                                                class="green-box-dot"></span><span class="mobile-w-90">Clinical Rotation Package</span></li>
                                    </ul>


                                <!--<div class="bg-pink box-flot-banner">-->
                                <!--    <h1  class="fnt-family text-black fs-28 w-65 m-auto pt-10 lh-28">explore <br />-->
                                <!--        more<br />-->
                                <!--        below</h1>-->
                                <!--    <i class="bi bi-arrow-down-circle-fill fs-40 text-black position-absolute ms-22-flot-8"></i>-->
                                <!--    <div  class="box-object-fit-10">-->
                                <!--        <img src="./assets/img/degree-with-girl.png" />-->
                                <!--    </div>-->

                                <!--</div>-->
                            </div>

                        </div>
                        <div class="d-flex align-items-start gap-3 position-relative mobile-none">
                            <div class="w-148px 225px" ></div>
                          <ul class="w-100 p-0 m-0 flot-section-top pl-2">
                                    <li class="text-black fs-16 lh-20 mb-2 d-flex gap-2 align-items-center"><span
                                            class="green-box-dot"></span>Recommended QBanks, review books.</li>
                                    <li class="text-black fs-16 lh-20 mb-2 d-flex gap-2 align-items-center"><span
                                            class="green-box-dot"></span>Suggested mocks for your stage.</li>
                                    <li class="text-black fs-16 lh-20 mb-2 d-flex gap-2 align-items-center"><span
                                            class="green-box-dot"></span>Clinical Rotation Package</li>
                                </ul>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

   <section class="partner-container">
            <div class="">
                <div class="row p-0 justify-content-center">
                    <div class="w-903px p-0">
                        <div class="card-box-gray-1 border-radius-10px mobile-bg-gray">
                            <div class=" w-698px m-auto mobile-w-60 mobile-m-auto">
                                <h5 class="text-black mb-0 fs-19 lh-19 mb-1 fw-500 mobile-fs-14">Discover Top Universities in Every Country — With
                                    Scholarships & Fee Waivers</h5>
                                <h6 class="text-black fs-17 lh-22 mb-0 mobile-fs-14 mobile-lh-full">Explore our global university tie-ups and map out your
                                    perfect path — we’re here to guide you.</h6>
                                    
                                <span class="text-black fs-12 fw-500 mobile-fs-12 mobile-heading-college">Your College Journey Starts Here</span>
                                <h5 class="text-black mb-0 fs-17 fw-500 mt-2 d-flex wrap gap-4 mobile-fs-12 mobile-gap-0 mobile-lh-16"><span>500+ University
                                        Tie-ups</span><span>20+ years experienced Mentors</span><span>Current Student as
                                        Mentors</span></h5>
                            </div>
                            <div class="top-partners-style mt-5">
                                <div class="flex-wrap d-flex w-698px m-auto align-items-center justify-content-center" style="gap:17px;">
                                    <div class="client-box-top"><img src="./assets/img/partner-1.png" alt="top-client">
                                    </div> 
                                    <div class="client-box-top"><img src="./assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-9.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-1.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-9.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-1.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-9.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-1.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-2.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-3.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-4.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-5.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-6.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-7.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-8.png" alt="top-client">
                                    </div>
                                    <div class="client-box-top"><img src="./assets/img/partner-9.png" alt="top-client">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 mobile-mt-10">
                                <h5 class="fnt-family fs-38 text-black d-flex justify-content-center mb-8 mobile-fs-24 mobile-lh-25 mobile-mb-0 mobile-w-60 mobile-auto mobile-text-start mobile-pb-2 mobile-br-none">Medicine.
                                    engineering.
                                    Allied <br />Health. masters.management</h5>
                            </div>
                            <div class="d-flex gap-3 align-items-center justify-content-center mobile-wrap">
                                <h5 class="text-black w-35 fs-28 fw-400 lh-35 mobile-lh-16 mobile-fs-14 mobile-w-60 mobile-auto  mobile-pb-2">
                                    Connect with our
                                    expert today and
                                    kickstart your
                                    study abroad journey!</h5>
                                <div class="box-white-card w-470px mobile-box-winner">

                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <div class="position-relative">
                                            <div class="bg-white border-radius-10px lh-35 py-1 d-inline-block w-186px text-center border-radius-10">
                                                <span class="text-black fs-28 fw-300 lh-35">+</span>&nbsp;&nbsp;<span
                                                    class="text-black fs-28 ">MBA</span>
                                            </div>
                                            <div class="floting-plus-icon">
                                                <i class="bi bi-plus-circle"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3">
                                            <div class="yellow-border-box">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <div class="arrow-yellow-bg">
                                                <span
                                                    class="d-flex gap-2 bg-yellow mb-4 px-3 py-1 text-black border-radius-10px w-90px"><i
                                                        class="bi bi-arrow-right-circle-fill fs-14"></i><span
                                                        class="fnt-family fs-16">USMLE</span></span>
                                                <span
                                                    class="d-flex gap-2 bg-yellow mb-4 px-3 py-1 text-black border-radius-10px w-90px"><i
                                                        class="bi bi-arrow-right-circle-fill fs-14"></i><span
                                                        class="fnt-family fs-16">PLAB</span></span>
                                                <span
                                                    class="d-flex gap-2 bg-yellow mb-4 px-3 py-1 text-black border-radius-10px w-90px"><i
                                                        class="bi bi-arrow-right-circle-fill fs-14"></i><span
                                                        class="fnt-family fs-16">AMC</span></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 align-items-center justify-content-center mobile-wrap mobile-space-evenly mobile-pb-2 mobile-pt-2">
                                        <div class="green-box-radius  border-radius-20px ">
                                            <h6 class="fnt-family text-white fs-16 lh-15 text-center fw-400 mb-0">
                                                Scholarship
                                                + Fee Waiver
                                            </h6>
                                        </div>
                                        <div class="desktop-none">
                                             <div class="d-flex gap-1 align-items-center">
                                                <h4 class="mb-0 text-black fs-19 fw-700 lh-19 d-flex nowrap mt-2">98%</h4>
                                                <span class="h-20px d-block bg-black" style="width: 1px;"></span>
                                                <h6 class="text-black fs-11 lh-16 mb-0 nowrap fw-700"><span
                                                        class="text-uppercase"><b>VISA SUCESS RATE</b></span></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 w-70 mobile-w-75">
                                            <div class="bg-purple d-flex gap-2 align-items-center p-1">
                                                <h5
                                                    class="mb-0 w-80px fs-17 mb-0 lh-16 fw-600 text-uppercase text-black bg-white" style="    width: 45px !important;">
                                                    Engi<br/>
                                                    neer<br/>
                                                    ing</h5>
                                                <h6 class="mb-0 w-80 mb-0 fs-10 lh-12 text-white">Computer Science / AI
                                                    /
                                                    Data Science
                                                    Software & Web Development <br/>
                                                    Mechanical / Electrical / Civil / Aerospace</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4 align-items-start gap-3">
                                        <div class="w-55 d-flex gap-2 align-items-center">
                                            <h4 class="mb-0 text-black fs-38 fw-700 d-flex nowrap mt-2 lh-19 mobile-nowrap mobile-fs-28">95%</h4>
                                            <span class="h-25px d-block bg-black" style="width: 3px;"></span>
                                            <h6 class="text-black fs-11 lh-full mb-0 fw-400"><span
                                                    class="text-uppercase"><b>offer
                                                        letter</b></span>—delivered in
                                                less than 4 weeks with our
                                                tie-up universities.</h6>
                                        </div>
                                        <div class="w-40 mobile-w-60">
                                            <div class="bg-light-blue border-radius-4px mb-4">
                                                <h6 class="text-black fs-9 lh-12 p-2 mb-2">Physiotherapy / Nursing
                                                    Speech &
                                                    Language Therapy Clinical Embryology</h6>
                                            </div>
                                            <div class="d-flex gap-1 align-items-center mobile-none">
                                                <h4 class="mb-0 text-black fs-19 fw-700 lh-19 d-flex nowrap mt-2">98%</h4>
                                                <span class="h-20px d-block bg-black" style="width: 1px;"></span>
                                                <h6 class="text-black fs-11 lh-16 mb-0 nowrap fw-700"><span
                                                        class="text-uppercase"><b>VISA SUCESS RATE</b></span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    <section class="position-relative pb-100 mobile-aboutus">
                <div class="w-903px p-0 m-auto p-0 pb-100">
                    <div class="row align-items-center justify-content-center d-flex gap-5">
                        <div
                            class="position-relative bg-gray w-504px bg-very-light-green xl-p-4 md-p-50px sm-p-30px border-radius-10px px-5">
                          <div class="mb-10px">
                        <div class="mt-10 mt-10 mobile-px-4">
                           <h2 class="mb-1 text-uppercase fnt-bab text-black fs-38 mobile-br-none mobile-fs-20 mobile-lh-20 mobile-w-60" style="">
                                       Need a detailed expense <br>
                                        breakdown for your <br>
                                        journey?
                                    </h2>
                            
                            <a href="#" style="padding: 8px 30px;"
                             onclick="return window.ppOpenModal();"
                                class="mb-2  mobile-px-3 btn btn-small-large border-radius-10px btn-base-color btn-rounded btn-switch-text d-inline-block me-20px sm-me-10px align-middle left-icon mt-5px">
                                <span>
                                    <span class="btn-double-text ls-minus-05px fs-15" data-text="get to know #pgs">Request it here</span>
                                </span>
                            </a>
                            
                            <p class="text-black mt-3 mb-3" style="">—
                                        we’ll send it straight to
                                        your
                                        inbox.</p>

                            <p class="text-black fs-16 lh-19 mt-6 mb-30 mobile-fs-14 mobile-pb-30">
                                        Whether you're just getting
                                        started or
                                        planning ahead for all three
                                        steps,
                                        knowing the
                                        costs involved can help you
                                        make better
                                        decisions. From registration
                                        fees and
                                        travel
                                        expenses to prep materials
                                        and clinical
                                        rotations — we’ve mapped out
                                        the full
                                        journey.
                                        Just drop a request and get
                                        a clear
                                        picture of what to expect,
                                        without
                                        surprises.
                            </p>
                        </div>

                        <figure class="about-floting-img m-0 text-center">
                            <img src="./assets/img/doctor.png" alt="" class="border-radius-6px">
                        </figure>


                    </div>
                        </div>

                        <div class="w-336px">
                            <figure class="request-img-box text-center">
                                <img src="./assets/img/insta-girl.png" alt class="border-radius-6px" data-no-retina>
                            </figure>
                        </div>
                    </div>
                </div>
            </section>

    <section class="pt-0 mobile-pgs-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11 m-auto">
                        <div class="d-flex align-items-center justify-content-center m-d-flex">
                            <div class="w-20 new-black-m">
                                <h5 class="mb-0 bg-black text_purple_bg">
                                    #PGS
                                </h5>
                                <p class="text-black fs-15 mb-0">#StudentSupportHub</p>
                            </div>
                            <div class="w-40">
                                <h6 class="mb-2 text-black d-flex gap-2 fs-20 fw-500"><span
                                        class="w-20 ml-3 px-1 bg-yellow fs-18 d-inline-block">Call
                                        Us </span>
                                    <img src="./assets/img/phone.png" width="20px">
                                    91 95665 66298
                                </h6>
                                <h6 class="mb-2 text-black d-flex gap-2 fs-20 fw-500"><span
                                        class="w-20 ml-3 px-1 bg-yellow fs-18 d-inline-block">Email
                                        Us</span>
                                    <img src="./assets/img/phone.png" width="20px">
                                    connect@purpleguid.study
                                </h6>
                            </div>
                            <div class="w-15">
                                <p class="text-black font-style-italic fs-15 lh-20">Reach
                                    out on our helpline for fast
                                    bookings, expert advice, and
                                    answers to
                                    all your study
                                    abroad questions. We’ve also
                                    got
                                    dedicated mentor groups for
                                    medical and
                                    non-medical
                                    courses—so you’re always
                                    connected to
                                    the right people.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
         </div>

    <?php $this->load->view('partials/testimonials'); ?>
   



  <div id="applicantPremiumModal" class="mobile-applicant pgs-modal premium-modal-overlay modal-pgsamc" style="display: none;" onclick="if(event.target===this){window.applicatModalCloseModal();}">
        <div class="premium-modal-container purple-modal d-flex">
            <!-- LEFT PANEL -->
            <div class="panel-left">
                <button class="close-btn desktop-none" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal();">✕</button>
                <div class="brand-row">
                    <div class="brand-title">#PGS</div>
                    <div class="heart-badge">
                        <img src="<?= base_url('assets/img/heart.gif') ?>" />
                    </div>
                </div>
                <div class="sub-label fnt-family">FINANCIAL BLUEPRINT</div>
                <p class="tagline lh-18ppx">Planning to study abroad? Know your real costs first.</p>

                <div class="boost-wrap">
                    <div class="mobile-none" style="margin : 0  0 0 auto">
                        <img src="<?= base_url('assets/img/arrow-modal.png') ?>" style="width: 95px;margin-left: -10px;" />
                        <span class="w-full d-block fs-16 text-white lh-18">get the <br />boost <br /> your <br /> deserves</span>
                    </div>
                    <div class="mb-4">
                        <img src="<?= base_url('assets/img/bump.png') ?>" />
                    </div>
                    <div class="desktop-none">
                        <p class="mb-0 fs-14 lh-20 fw-400 text-white">get the boost your <br /> PREP deserves</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="panel-right">
                <button class="close-btn mobile-none" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal();">✕</button>

                <div id="formContent">
                    <div class="field-group">
                        <div class="field">
                            <input type="text" id="nameInput" placeholder="Enter Name *" autocomplete="name" requried>
                        </div>
                        <div class="field">
                            <input type="email" id="emailInput" placeholder="Email *" autocomplete="email" requried>
                        </div>
                        <div class="field">
                            <input type="tel" id="phoneInput" placeholder="Phone (Whatsapp number preffered)" autocomplete="tel">
                        </div>
                    </div>

                    
                    <br />

                    <div>
                        <p class="section-label mb-2">What describes you best?</p>
                        <div class="d-flex gap-3">
                            <button type="button" class="modal-btn-pgs"
                                onclick="if(event.target === this){ window.applicantPremiumOpen2(); } else { window.applicatModalCloseModal2(); }">
                                Shortlisting countries
                            </button>
                            <img src="<?= base_url('assets/img/arrow-btn.png') ?>" style="width : 26px; height :26px" />
                        </div>
                    </div>

                    <div class="cta-row mt-5">
                        <button class="cta-btn" id="ctaBtn" onclick="if(event.target === this){ window.applicantPremiumOpen2(); } else { window.applicatModalCloseModal2(); }">
                           GET MY EXPENSE CHECKLIST
                            <span class="arrow">←</span>
                        </button>
                    </div>
                </div>

                <!-- SUCCESS STATE -->
                <div class="success-msg" id="successMsg">
                    <div class="checkmark">🎉</div>
                    <h3>You're all set!</h3>
                    <p>Your personalised checklist is on its way.<br>Check your inbox soon.</p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="applicantPremiumModal2" class="pgs-modal premium-modal-overlay modal-pgsamc-2" style="display: none; background: transparent" onclick="if(event.target===this){window.applicatModalCloseModal2();}">
        <div class="premium-modal-container purple-modal d-flex bg-white pgs-modal-2" style="border-radius: 20px !important">
            <button class="close-btn" id="closeBtn" aria-label="Close" onclick="return window.applicatCloseModal2();">✕</button>

            <div class="text-center">
                <h5 class="fw-700 fs-48 text-black"><img src="<?= base_url('assets/img/check-12.png') ?>" style="width : 50px" />you’re in</h5>
                <img src="<?= base_url('assets/img/okk.png') ?>" class="w-50%" />
                <h5 class="fw-400 fs-24 fnt-family text-black mobile-bottom-50">
                    Your study abroad expense <br /> checklist is on its way.
                </h5>
            </div>
            <div class="w-180px">
               <div style="background : #150035" class="p-3 mt-4">
                    <p class="fs-13 lh-15 text-white mb-4">Need to sort out the study journey?</p>
                    <p class="fs-13 lh-15 text-white mb-4">Book a free 15min clarity call</p>
                </div>
            </div>
            <div>
                <img src="<?= base_url('assets/img/heart.gif') ?>" class="mobile-none" style="width: 50px;border-radius: 10px;margin: 0 0 0 auto;display: block;" />
              
            </div>
        </div>
    </div>

    

   <!-- Footer -->
 <?php $this->load->view('footer'); ?>
  
  <script>
    // PurplePremium modal/apply logic (single source of truth for this page).
    window.ppOpenModal = function() {
        var el = document.getElementById('applicantPremiumModal');
        if (!el) return false;
        el.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        return false;
    };
    window.applicatCloseModal = function() {
        var el = document.getElementById('applicantPremiumModal');
        if (!el) return false;
        el.style.display = 'none';
        document.body.style.overflow = '';
        return false;
    };
</script>

<script>
    // PurplePremium modal/apply logic (single source of truth for this page).
    window.applicantPremiumOpen2 = function() {
        var el = document.getElementById('applicantPremiumModal2');
        if (!el) return false;
        el.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        return false;
    };
    window.applicatCloseModal2 = function() {
        var el = document.getElementById('applicantPremiumModal2');
        if (!el) return false;
        el.style.display = 'none';
        document.body.style.overflow = '';
        return false;
    };
</script>

<script>
    // Country switcher: click a code in .vs-box-set to update the black box heading,
    // move the purple highlight, and point the green "101" button at that country's page.
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.vs-box-set').forEach(function (box) {
            // The black box heading + "101" button sit in the same flex row as this code list.
            var row = box.closest('.d-flex');
            var headingSpan = row ? row.querySelector('.fs-75.text-white.lh-65 .fnt-family') : null;
            var ctaBtn = row ? row.querySelector('.btn-green-btn') : null;
            var codes = box.querySelectorAll('h1');

            function selectCode(h1) {
                // Move the purple highlight to this code.
                codes.forEach(function (other) {
                    var s = other.querySelector('span');
                    if (s) s.classList.remove('bg-purple');
                });
                var span = h1.querySelector('span');
                if (span) span.classList.add('bg-purple');

                // Update the black box text (data-country may contain a <br>).
                if (headingSpan) {
                    headingSpan.innerHTML = h1.getAttribute('data-country') ||
                        (span ? span.textContent : h1.textContent);
                }

                // Point the green "101" button at this country's page.
                if (ctaBtn) {
                    var href = h1.getAttribute('data-href');
                    if (href) ctaBtn.setAttribute('href', href);
                }
            }

            codes.forEach(function (h1) {
                h1.style.cursor = 'pointer';
                h1.addEventListener('click', function () { selectCode(h1); });
            });

            // Initialise from the code highlighted by default (or the first one).
            var preset = box.querySelector('h1 span.bg-purple');
            var initial = preset ? preset.closest('h1') : codes[0];
            if (initial) selectCode(initial);
        });
    });
</script>
</body>

</html>