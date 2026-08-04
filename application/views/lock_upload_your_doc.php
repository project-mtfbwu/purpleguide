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
    <section class="pt-5 about-section half-section overlap-height position-relative overflow-hidden minus-5 mobile-doc-section">
        <div class="container overlap-gap-section p-0">
            <div class="row justify-content-md-center align-items-center">
                <div class="col-lg-7 d-flex gap-10 align-items-center">
                    <div class="w-300px d-flex align-items-center justify-content-end">
                        <h1 class="text-start text-black fnt-family fw-400 fs-50 lh-full pt-0">
                            upload <br />
                            your <br />
                            docs <br />
                        </h1>
                    </div>
                       <div class="yellow-box-style-3  w-300px position-relative">
						    <div class="lock-box-feed">
                     	 <img src="<?= base_url('assets/img/lock.png') ?>" data-no-retina="">
                         </div>
                        <div class="header-yellow-box-style-3"> <img src="./assets/img/bell.gif" width="" class="w-10" />
                            Important Alerts</div>
                        <ol>
                            <li>LOR is pending</li>
                            <li>Two UNIs have proved CAS!</li>
                            <li>Have to submit application by 28th June, 2025</li>
                        </ol>
                    </div>

                </div>
               
                </div>
            <div class="row justify-content-md-center mt-3">
                <div class="col-lg-6">
                    <p class="mb-0 text-black m-auto fs-19 lh-25 mobile-fs-14 mobile-lh-full">
                        <span class="fs-22 lh-28 d-block mb-1 fw-500">Make sure your file is under 5MB.</span>
                        We accept PDF, JPG, PNG, and MS Word formats. <br />
                        Hit upload when you’re ready.
                    </p>
                </div>
            </div>
            <div class="row justify-content-md-center mt-5">
                <div class="col-lg-11">
                   
                   
                   <!--Mobile View-->
					 <div class="position-relative">
					  <div class="lock-box-feed" style="border-radius : 10px; z-index: 100;">
                      <img src="<?= base_url('assets/img/lock.png') ?>" data-no-retina="">
                    </div>
                    <table class="w-100 desktop-none table border-none text-bold-table mobile-fs-14-table">
                        <thead>
                            <tr>
                                <th class="fnt-family fs-28 fw-500 w-40">Resource LIST</th>
                                <th class="fnt-family fs-28 fw-500 w-25">UPLOAD</th>
                            </tr>
                        </thead>
                        <tbody
                         <tr>
                            <td>
                               <span class="text-green"> Passport Front</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-approved">Approved</span>
                            </td>
                            <td>
                                  <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span class="text-red">Passport Back</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                               <span class="text-red">CV</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span class="text-red">LoR</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span class="">UG Marksheet - 1</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1">---</span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                          <tr>
                            <td>
                               <span class="text-red">UG Consolidated Marksheet</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                          <tr>
                            <td>
                               <span class="text-red">UG Provisional Certificate</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                          <tr>
                            <td>
                               <span class="text-red">UG Degree Certificate</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                          <tr>
                            <td>
                               <span class="text-red">SOP</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                          <tr>
                            <td>
                               <span class="text-red">12th Marksheet</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                          <tr>
                            <td>
                               <span class="text-red">10th Marksheet</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-InDraft">InDraft</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span class="text-green">PG Marksheet - 1</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-approved">Approved</span>
                            </td>
                            <td>
                                  <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span class="text-green">PG Consolidated Marksheet</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                               <span class="status-approved">Approved</span>
                            </td>
                            <td>
                                  <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span class="text-green">PG Provisional Certificate</span>
                            </td>
                            <td>
                                <span class="fs-12 lh-14 nowrap-1"> UPLOADED ON <span class="fs-14">24 April 2025</span></span>
                            </td>
                        </tr>
                         
                         <tr>
                            <td>
                               <span class="status-approved">Approved</span>
                            </td>
                            <td>
                                  <button type="button" class="btn btn-black-outline">view</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span>PG Degree Certificate</span>
                            </td>
                            <td>
                              <span class="text-red">PENDING</span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                             <span class="text-red"> -----</span>
                            </td>
                            <td>
                                  <button type="button" class="btn btn-black-upload">Upload</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span>pre-journey checklist</span>
                            </td>
                            <td>
                              <span class="text-red">----</span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                             <span class="text-red"> -----</span>
                            </td>
                            <td>
                                <span class="text-red"> -----</span>
                            </td>
                        </tr>
                        
                        </tbody>
                    </table>
		           
                   <!--Mobile View-->
                   
                   <!--Desktop View-->
			     
                    <table class="w-100 mobile-none table border-none text-bold-table">
                        <thead>
                            <tr>
                                <th class="fnt-family fs-28 fw-500 w-40">Resource Drop</th>
                                <th class="fnt-family fs-28 fw-500 w-25">uploaded on</th>
                                <th class="fnt-family fs-28 fw-500 w-25">qc status</th>
                                <th class="fnt-family fs-28 fw-500 w-10">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Passport Front</td>
                                <td>24 April 2025</td>
                                <td><span class="status-approved">Approved</span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>Passport Back</td>
                                <td>24 April 2025</td>
                                <td><span class="status-InDraft">InDraft</span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>CV</td>
                                <td>24 April 2025</td>
                                <td><span class="status-InDraft">InDraft</span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>LoR</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>UG Marksheet - 1</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>UG Provisional Certificate</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>UG Degree Certificate</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>SOP</td>
                                <td>24 April 2025</td>
                                <td><span class="status-approved">Approved</span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>12th Marksheet</td>
                                <td>24 April 2025</td>
                                <td><span class="status-InDraft">InDraft</span></td>
                                <td><button type="button" class="btn btn-black-outline">view</button></td>
                            </tr>
                            <tr>
                                <td>10th Marksheet</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>PG Marksheet - 1</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>PG Consolidated Marksheet</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>PG Provisional Certificate</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>PG Degree Certificate</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                            <tr>
                                <td>pre-journey checklist</td>
                                <td><span class="blank-dots"></span></td>
                                <td><span class="blank-dots"></span></td>
                                <td>
                                    <button type="button" class="btn btn-black-upload">Upload</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
			     
                   <!--Desktop View-->
                
                
                
                    <div class="w-50 mt-3" style="padding:10px">
                        <h5 class="mb-1 fs-25 lh-32 fw-500 text-black mobile-fs-14 mobile-lh-full mobile-pb-2">Additional documents, if we asked for them</h5>
                        <div class="upload-group-textare position-relative">
                            <textarea class="form-control p-2" placeholder="Enter the document name here"></textarea>
                            <button type="button" class="btn btn-black-upload">Upload</button>
                        </div>
                    </div>
				 </div>
                    <div class="row mt-7 align-items-center justify-content-md-center">
                        <div class="col-lg-12 col-md-10 position-relative md-mb-50px sm-mb-40px">
                            <figure class="position-relative m-0 text-center">
                                <img src="./assets/img/team-goal.png" alt="" data-bottom-top="transform: translateY(50px)"
                                     class="w-100 border-radius-6px">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>

    </div>




<?php $this->load->view('footer'); ?>
</body>

</html>