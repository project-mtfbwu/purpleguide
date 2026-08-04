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
        /* Fix button text overflow in document upload table */
        table .btn-black-outline,
        table .btn-black-upload {
            width: auto !important;
            min-width: 90px;
            padding: 0px 12px !important;
            white-space: nowrap;
            overflow: visible;
            text-overflow: clip;
            font-size: 16px !important;
            height: auto !important;
            min-height: 27px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        table .btn-black-upload {
            min-width: 100px;
        }
        
        table .d-flex.gap-2 {
            flex-wrap: wrap;
            gap: 8px;
        }
        @media (max-width: 767px) {
    .text-bold-table td {
        font-size: 15px !important;
        line-height: 20px !important;
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

    <div class="wrapper-content">
    <!-- AboutUs -->
    <section id="documents" class="pt-5 about-section half-section overlap-height position-relative overflow-hidden minus-5 mobile-doc-section" style="scroll-margin-top: 140px;">
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
                       <div class="yellow-box-style-3  w-300px">
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
                    <p class="mb-0 text-black m-auto fs-19 lh-25">
                        <span class="fs-22 lh-28 d-block mb-1 fw-500">Make sure your file is under 5MB.</span>
                        We accept PDF, JPG, PNG, and MS Word formats. <br />
                        Hit upload when you’re ready.
                    </p>
                </div>
            </div>
            <div class="row justify-content-md-center mt-5">
                <div class="col-lg-11">
                    <!-- Flash Messages -->
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" role="alert" style="margin-bottom: 20px; padding: 12px 16px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
                            <?= $this->session->flashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger" role="alert" style="margin-bottom: 20px; padding: 12px 16px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                    <table class="w-100 table border-none text-bold-table" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th class="fnt-family fs-28 fw-500 w-40">Resource Drop</th>
                                <th class="fnt-family fs-28 fw-500 w-25">uploaded on</th>
                                <th class="fnt-family fs-28 fw-500 w-25">qc status</th>
                                <th class="fnt-family fs-28 fw-500 w-10">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Create a map of existing documents by type
                            $documents_map = [];
                            if(isset($documents) && count($documents) > 0) {
                                foreach($documents as $doc) {
                                    $key = !empty($doc->document_name) ? $doc->document_name : $doc->document_type;
                                    if(!isset($documents_map[$doc->document_type])) {
                                        $documents_map[$doc->document_type] = [];
                                    }
                                    $documents_map[$doc->document_type][] = $doc;
                                }
                            }
                            
                            // Display standard documents
                            foreach($standard_documents as $doc_type): 
                                $existing_docs = isset($documents_map[$doc_type]) ? $documents_map[$doc_type] : [];
                                $latest_doc = !empty($existing_docs) ? $existing_docs[0] : null; // Get most recent
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($doc_type) ?></td>
                                <td>
                                    <?php if($latest_doc): ?>
                                        <?= date('d M Y', strtotime($latest_doc->uploaded_at)) ?>
                                    <?php else: ?>
                                        <span class="blank-dots"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($latest_doc): 
                                        $status_class = '';
                                        $status_text = ucfirst($latest_doc->qc_status);
                                        switch($latest_doc->qc_status) {
                                            case 'approved':
                                                $status_class = 'status-approved';
                                                break;
                                            case 'rejected':
                                                $status_class = 'status-rejected';
                                                break;
                                            case 'indraft':
                                                $status_class = 'status-InDraft';
                                                break;
                                            default:
                                                $status_class = 'status-pending';
                                        }
                                    ?>
                                        <span class="<?= $status_class ?>"><?= $status_text ?></span>
                                    <?php else: ?>
                                        <span class="blank-dots"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($latest_doc): ?>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-black-outline view-document" 
                                                    data-file="<?= base_url($latest_doc->file_path) ?>"
                                                    data-type="<?= htmlspecialchars($latest_doc->file_type) ?>">View</button>
                                            <button type="button" class="btn btn-black-upload upload-document-btn" 
                                                    data-doc-type="<?= htmlspecialchars($doc_type) ?>">Re-upload</button>
                                        </div>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-black-upload upload-document-btn" 
                                                data-doc-type="<?= htmlspecialchars($doc_type) ?>">Upload</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="w-50 mt-3">
                        <h5 class="mb-1 fs-25 lh-30 fw-500 text-black">Additional documents, if we asked for them</h5>
                    </div>
                    <?php
                    $additional_doc_types = isset($additional_document_types) ? $additional_document_types : [];
                    $additional_doc_types_list = $additional_doc_types;
                    $additional_docs = [];
                    if(isset($documents) && count($documents) > 0) {
                        foreach($documents as $doc) {
                            if (!empty($doc->document_name) && !in_array($doc->document_type, $standard_documents) && !in_array($doc->document_type, $additional_doc_types_list)) {
                                $additional_docs[] = $doc;
                            }
                        }
                    }
                    $has_additional_rows = count($additional_doc_types) > 0 || count($additional_docs) > 0;
                    if ($has_additional_rows):
                    ?>
                    <table class="w-100 table border-none text-bold-table mt-3">
                        <thead>
                            <tr>
                                <th class="fnt-family fs-28 fw-500 ">Resource Drop</th>
                                <th class="fnt-family fs-28 fw-500 w-25">uploaded on</th>
                                <th class="fnt-family fs-28 fw-500 w-25">qc status</th>
                                <th class="fnt-family fs-28 fw-500 w-10">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Admin-requested document types (from admin user_documents page) -->
                            <?php foreach ($additional_doc_types as $doc_type): 
                                $existing_docs = isset($documents_map[$doc_type]) ? $documents_map[$doc_type] : [];
                                $latest_doc = !empty($existing_docs) ? $existing_docs[0] : null;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($doc_type) ?></td>
                                <td>
                                    <?php if($latest_doc): ?>
                                        <?= date('d M Y', strtotime($latest_doc->uploaded_at)) ?>
                                    <?php else: ?>
                                        <span class="blank-dots"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($latest_doc): 
                                        $status_class = '';
                                        $status_text = ucfirst($latest_doc->qc_status);
                                        switch($latest_doc->qc_status) {
                                            case 'approved': $status_class = 'status-approved'; break;
                                            case 'rejected': $status_class = 'status-rejected'; break;
                                            case 'indraft': $status_class = 'status-InDraft'; break;
                                            default: $status_class = 'status-pending';
                                        }
                                    ?>
                                        <span class="<?= $status_class ?>"><?= $status_text ?></span>
                                    <?php else: ?>
                                        <span class="blank-dots"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($latest_doc): ?>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-black-outline view-document" 
                                                    data-file="<?= base_url($latest_doc->file_path) ?>"
                                                    data-type="<?= htmlspecialchars($latest_doc->file_type) ?>">View</button>
                                            <button type="button" class="btn btn-black-upload upload-document-btn" 
                                                    data-doc-type="<?= htmlspecialchars($doc_type) ?>">Re-upload</button>
                                        </div>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-black-upload upload-document-btn" 
                                                data-doc-type="<?= htmlspecialchars($doc_type) ?>">Upload</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <!-- User free-form additional uploads -->
                            <?php foreach($additional_docs as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc->document_name ?: $doc->document_type) ?></td>
                                <td><?= date('d M Y', strtotime($doc->uploaded_at)) ?></td>
                                <td>
                                    <?php 
                                    $status_class = '';
                                    $status_text = ucfirst($doc->qc_status);
                                    switch($doc->qc_status) {
                                        case 'approved': $status_class = 'status-approved'; break;
                                        case 'rejected': $status_class = 'status-rejected'; break;
                                        case 'indraft': $status_class = 'status-InDraft'; break;
                                        default: $status_class = 'status-pending';
                                    }
                                    ?>
                                    <span class="<?= $status_class ?>"><?= $status_text ?></span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-black-outline view-document" 
                                            data-file="<?= base_url($doc->file_path) ?>"
                                            data-type="<?= htmlspecialchars($doc->file_type) ?>">View</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
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




<!-- Footer -->
    <!-- Footer -->
<div class="footer-bg">
    <section class="footer">
        <div class="flot-img">
            <img src="./assets/img/top.png" />
        </div>
        <!-- <footer> -->
        <div class="container pt-5 pb-8">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <div class="card-bg-pruple text-center w-210px">
                        <h4 class="mb-0 fs-20 lh-full mt-7">Currently studying? Become a mentor <br/> and help students.</h4>
                        <button type="button" class="btn btn-join">Join The Team!</button>
                    </div>
                </div>
                <div class="col-lg-5 offset-1">
                    <div class="yellow-bg">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-2">
                        <img src="./assets/img/mail.png" width="25px"> hello@purpleguide.study
                    </div>
                    <div class="yellow-bg mt-3">
                        General Enquiries
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 mb-3">
                        <img src="./assets/img/mail.png" width="25px"> connect@purpleguide.study
                    </div>
                    <div class="social-flex mt-5 mb-3 d-flex align-items-center gap-3">
                        <img src="./assets/img/right.png" />
                        <h6 class="mb-0 text-white fs-20">Our Socials</h6>
                        <div class="social-img d-flex align-items-center gap-3">
                            <a href="#">
                                <img src="./assets/img/instagram.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/facebook.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/threads.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/youtube.png">
                            </a>
                            <a href="#">
                                <img src="./assets/img/linkdln.png">
                            </a>
                        </div>
                        <img src="./assets/img/left.png" />
                    </div>
                    
                    <div class="terms-content mt-6">
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Privacy Policy</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Terms & Conditions</a>
                        <a href="#" class="d-block fs-20 fw-500 mt-1 text-white">Refund Policy</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fs-14 lh-full mb-5 text-white">
                        <span class="fs-15"> For</span><br />
                        Feedback, <br /> Escalations <br /> & Complaints
                    </div>
                    <div class="d-flex gap-2 fs-20 text-white mt-2 align-items-start">
                        <img src="./assets/img/mail.png" width="25px">
                        <div>
                            <span class="" style="white-space:nowrap;">hey@purpleguide.study</span>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">We’re a project-first team, and we try to sort out
                                complaints within 7 business days.
                                Good vibes or tough love: your feedback actually helps us level up.</p>
                            <p class="fs-14 fw-400 mb-0 mt-4 lh-full">All emails sent to this address will stay
                                anonymous—unless we spot any signs of misuse or suspicious activity.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- </footer> -->
    </section>

    <section class="copyrght">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center">
                        <h4 class="w-20 text-white">#PGS</h4>
                        <div class="d-flex align-items-center gap-4">
                            <h4 class="text-white fs-24  fw-700 lh-28">(For Mentors) Help Students Choose <br/>
                                Smarter – Earn with Our Referral Program</h4>
                            <a href="<?= base_url('unitieup')?>" class="text-white fw-700 fs-24 lh-28">(For Universities) Give Your Students a <br/>
                                Global Edge – Partner with #PGS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/vendors.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    
    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Document</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close" id="closeUploadModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadDocumentForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="document_type" id="modal_doc_type">
                        <div class="form-group">
                            <label>Document Type</label>
                            <input type="text" class="form-control" id="modal_doc_type_display" readonly>
                        </div>
                        <div class="form-group">
                            <label>Select File (PDF, DOC, DOCX, JPG, PNG - Max 5MB)</label>
                            <input type="file" class="form-control" name="document_file" id="modal_doc_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal" id="cancelUploadModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitUploadBtn">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- View Document Modal -->
    <div class="modal fade" id="viewDocumentModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDocumentModalLabel">View Document</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close" id="closeViewModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="documentViewer">
                    <iframe id="documentFrame" src="" style="width: 100%; height: 600px; border: none;"></iframe>
                </div>
                <div class="modal-footer">
                    <a href="#" id="downloadDocumentLink" class="btn btn-primary" download>Download</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal" id="closeViewModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    $(document).ready(function() {
        // Initialize Bootstrap modals - support both Bootstrap 4 and 5
        var uploadModal = null;
        var viewModal = null;
        var useBootstrap5 = false;
        
        // Check if Bootstrap 5 is available
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            try {
                uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'), {});
                viewModal = new bootstrap.Modal(document.getElementById('viewDocumentModal'), {});
                useBootstrap5 = true;
            } catch(e) {
                console.log('Bootstrap 5 modal initialization failed, using jQuery');
            }
        }
        
        // Function to close upload modal
        function closeUploadModal() {
            if (useBootstrap5 && uploadModal) {
                uploadModal.hide();
            } else {
                $('#uploadModal').modal('hide');
                // Also remove backdrop if it exists
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
            }
        }
        
        // Function to close view modal
        function closeViewModal() {
            if (useBootstrap5 && viewModal) {
                viewModal.hide();
            } else {
                $('#viewDocumentModal').modal('hide');
                // Also remove backdrop if it exists
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
            }
        }
        
        // Manual close button handlers - use event delegation
        $(document).on('click', '#closeUploadModal, #cancelUploadModal', function(e) {
            e.preventDefault();
            closeUploadModal();
        });
        
        $(document).on('click', '#closeViewModal, #closeViewModalBtn', function(e) {
            e.preventDefault();
            closeViewModal();
        });
        
        // Also handle data-dismiss and data-bs-dismiss attributes
        $(document).on('click', '[data-dismiss="modal"], [data-bs-dismiss="modal"]', function(e) {
            e.preventDefault();
            var modalId = $(this).closest('.modal').attr('id');
            if (modalId === 'uploadModal') {
                closeUploadModal();
            } else if (modalId === 'viewDocumentModal') {
                closeViewModal();
            }
        });
        
        // Open upload modal
        $(document).on('click', '.upload-document-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Get document type from data attribute
            var docType = $(this).attr('data-doc-type') || $(this).data('doc-type');
            
            if (!docType) {
                console.error('Document type not found');
                alert('Error: Document type not specified');
                return;
            }
            
            // Clear file input first
            $('#modal_doc_file').val('');
            
            // Set document type values
            $('#modal_doc_type').val(docType);
            $('#modal_doc_type_display').val(docType);
            
            // Reset form (this won't clear programmatically set values if done after)
            $('#uploadDocumentForm')[0].reset();
            
            // Set document type again after reset to ensure it persists
            $('#modal_doc_type').val(docType);
            $('#modal_doc_type_display').val(docType);
            
            console.log('Opening modal for document type:', docType);
            console.log('Modal doc type value:', $('#modal_doc_type').val());
            console.log('Modal display value:', $('#modal_doc_type_display').val());
            
            if (useBootstrap5 && uploadModal) {
                uploadModal.show();
            } else {
                $('#uploadModal').modal('show');
            }
        });
        
        // Handle standard document upload
        $('#uploadDocumentForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            var submitBtn = $('#submitUploadBtn');
            var originalText = submitBtn.text();
            
            submitBtn.prop('disabled', true).text('Uploading...');
            
            $.ajax({
                url: '<?= base_url("Upload_your_doc/upload_document") ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    submitBtn.prop('disabled', false).text(originalText);
                    
                    if(response && response.success) {
                        closeUploadModal();
                        // Reload page immediately to show the uploaded document
                        location.reload();
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'Failed to upload document',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    submitBtn.prop('disabled', false).text(originalText);
                    
                    console.error('Upload error:', status, error);
                    console.error('Response:', xhr.responseText);
                    
                    var errorMsg = 'An error occurred while uploading the document';
                    try {
                        var errorResponse = JSON.parse(xhr.responseText);
                        if(errorResponse.message) {
                            errorMsg = errorResponse.message;
                        }
                    } catch(e) {
                        if(xhr.responseText) {
                            errorMsg = xhr.responseText.substring(0, 200);
                        }
                    }
                    
                    Swal.fire({
                        title: 'Error!',
                        text: errorMsg,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        
        // View document
        $(document).on('click', '.view-document', function() {
            var fileUrl = $(this).data('file');
            var fileType = $(this).data('type');
            
            $('#documentFrame').attr('src', fileUrl);
            $('#downloadDocumentLink').attr('href', fileUrl);
            
            if (viewModal) {
                viewModal.show();
            } else {
                $('#viewDocumentModal').modal('show');
            }
        });
    });
    </script>
    
       <script>
        const drawer = document.getElementById("drawer");
        const overlay = document.getElementById("overlay");
    
        function openDrawer() {
          drawer.classList.add("active");
          overlay.classList.add("active");
        }
    
        function closeDrawer() {
          drawer.classList.remove("active");
          overlay.classList.remove("active");
        }
      </script>
      
</body>

</html>