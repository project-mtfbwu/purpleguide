<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    // Wait for SweetAlert2 to load before showing flash messages
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

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="page-title mb-1">
                                    <i class="mdi mdi-file-document mr-2" style="color: #6366f1;"></i>
                                    User Documents: <?= isset($product) ? htmlspecialchars($product->name) : 'User' ?>
                                </h4>
                                <p class="text-muted mb-0" style="font-size: 0.875rem;">View and manage uploaded documents</p>
                            </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Users/users_list">Users</a></li>
                                    <li class="breadcrumb-item active">Documents</li>
                                </ol>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <?php if (!isset($product) || !$product): ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <h5>User Not Found</h5>
                        <p>The user you are looking for does not exist.</p>
                        <a href="<?= base_url('Users/users_list') ?>" class="btn btn-primary">Back to Users List</a>
                    </div>
                </div>
            </div>
            <?php else: ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h4 class="header-title mb-1">Uploaded Documents</h4>
                                    <p class="text-muted mb-0" style="font-size: 0.875rem;">
                                        Total: <?= isset($documents) ? count($documents) : 0 ?> documents
                                    </p>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?= base_url('Users/download_user_docs_zip/'.(int)$product->id) ?>" class="btn btn-primary">
                                        <i class="mdi mdi-archive"></i> Download all docs
                                    </a>
                                    <a href="<?= base_url('Users/users_list') ?>" class="btn btn-outline-primary">
                                        <i class="mdi mdi-arrow-left"></i> Back to List
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Additional document types: admin adds doc names that appear on user's upload_your_doc page -->
                            <div class="mb-4 p-3 border rounded bg-light">
                                <h5 class="mb-2"><i class="mdi mdi-file-plus mr-2"></i>Additional document types for upload page</h5>
                                <p class="text-muted small mb-3">Add document names that will appear in the list on the user's <strong>Upload your docs</strong> page so they can upload these documents.</p>
                                <form id="addDocTypeForm" class="form-inline mb-3">
                                    <input type="hidden" name="user_id" value="<?= isset($product) ? (int)$product->id : 0 ?>">
                                    <div class="input-group me-2 mb-2" style="max-width: 320px;">
                                        <input type="text" class="form-control" name="doc_name" placeholder="e.g. IELTS Scorecard, Financial Proof" required>
                                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i> Add</button>
                                    </div>
                                </form>
                                <div id="additionalDocTypesList">
                                    <?php if (!empty($additional_doc_types)): ?>
                                        <ul class="list-group list-group-flush">
                                            <?php foreach ($additional_doc_types as $adt): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                <span><?= htmlspecialchars($adt->doc_name) ?></span>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-doc-type" data-id="<?= (int)$adt->id ?>"><i class="mdi mdi-delete"></i></button>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-muted mb-0 small">No additional types yet. Add one above.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php 
                            // Group documents by type
                            $documents_by_type = [];
                            if(isset($documents) && count($documents) > 0) {
                                foreach($documents as $doc) {
                                    $type = $doc->document_type;
                                    if(!isset($documents_by_type[$type])) {
                                        $documents_by_type[$type] = [];
                                    }
                                    $documents_by_type[$type][] = $doc;
                                }
                            }
                            
                            // Display standard documents first
                            foreach($standard_documents as $doc_type): 
                                $type_docs = isset($documents_by_type[$doc_type]) ? $documents_by_type[$doc_type] : [];
                                $latest_doc = !empty($type_docs) ? $type_docs[0] : null;
                            ?>
                            <div class="row mb-3 border-bottom pb-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold"><?= htmlspecialchars($doc_type) ?></label>
                                </div>
                                <div class="col-md-9">
                                    <?php if($latest_doc): ?>
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <?php 
                                                $file_ext = strtolower(pathinfo($latest_doc->file_name, PATHINFO_EXTENSION));
                                                $is_image = in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif']);
                                                $is_pdf = $file_ext == 'pdf';
                                                $file_url = base_url($latest_doc->file_path);
                                                $file_url = str_replace('pgs_admin', '', base_url($latest_doc->file_path));
                                                ?>
                                                
                                                <?php if($is_image): ?>
                                                    <img src="<?= $file_url ?>" alt="Document" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" onerror="this.style.display='none'">
                                                <?php elseif($is_pdf): ?>
                                                    <embed src="<?= $file_url ?>" type="application/pdf" width="100px" height="80px" />
                                                <?php else: ?>
                                                    <div class="document-icon" style="width: 100px; height: 80px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; background: #f5f5f5;">
                                                        <i class="mdi mdi-file-document" style="font-size: 2rem; color: #666;"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="mb-2">
                                                    <strong>File:</strong> <?= htmlspecialchars($latest_doc->file_name) ?><br>
                                                    <strong>Uploaded:</strong> <?= date('d M Y, h:i A', strtotime($latest_doc->uploaded_at)) ?><br>
                                                    <strong>Size:</strong> <?= number_format($latest_doc->file_size / 1024, 2) ?> KB
                                                </div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <select class="form-control form-control-sm status-select" style="width: auto; display: inline-block;" data-doc-id="<?= $latest_doc->id ?>">
                                                        <option value="pending" <?= $latest_doc->qc_status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="approved" <?= $latest_doc->qc_status == 'approved' ? 'selected' : '' ?>>Verified</option>
                                                        <option value="rejected" <?= $latest_doc->qc_status == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                                        <option value="indraft" <?= $latest_doc->qc_status == 'indraft' ? 'selected' : '' ?>>In Draft</option>
                                                    </select>
                                                    <a href="<?= $file_url ?>" target="_blank" class="btn btn-primary btn-sm">
                                                        <i class="mdi mdi-eye"></i> View
                                                    </a>
                                                    <a href="<?= $file_url ?>" download class="btn btn-outline-primary btn-sm">
                                                        <i class="mdi mdi-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">No document uploaded</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <!-- Additional Documents -->
                            <?php 
                            $additional_docs = [];
                            if(isset($documents) && count($documents) > 0) {
                                foreach($documents as $doc) {
                                    if(!empty($doc->document_name) || !in_array($doc->document_type, $standard_documents)) {
                                        $additional_docs[] = $doc;
                                    }
                                }
                            }
                            
                            if(!empty($additional_docs)): 
                            ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Additional Documents</h5>
                                    <?php foreach($additional_docs as $doc): ?>
                                    <div class="row mb-3 border-bottom pb-3">
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">
                                                <?= htmlspecialchars($doc->document_name ?: $doc->document_type) ?>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="d-flex align-items-center gap-3">
                                                <div>
                                                    <?php 
                                                    $file_ext = strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                                                    $is_image = in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif']);
                                                    $is_pdf = $file_ext == 'pdf';
                                                    $file_url = base_url($doc->file_path);
                                                    ?>
                                                    
                                                    <?php if($is_image): ?>
                                                        <img src="<?= $file_url ?>" alt="Document" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" onerror="this.style.display='none'">
                                                    <?php elseif($is_pdf): ?>
                                                        <embed src="<?= $file_url ?>" type="application/pdf" width="100px" height="80px" />
                                                    <?php else: ?>
                                                        <div class="document-icon" style="width: 100px; height: 80px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; background: #f5f5f5;">
                                                            <i class="mdi mdi-file-document" style="font-size: 2rem; color: #666;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="mb-2">
                                                        <strong>File:</strong> <?= htmlspecialchars($doc->file_name) ?><br>
                                                        <strong>Uploaded:</strong> <?= date('d M Y, h:i A', strtotime($doc->uploaded_at)) ?><br>
                                                        <strong>Size:</strong> <?= number_format($doc->file_size / 1024, 2) ?> KB
                                                    </div>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <select class="form-control form-control-sm status-select" style="width: auto; display: inline-block;" data-doc-id="<?= $doc->id ?>">
                                                            <option value="pending" <?= $doc->qc_status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                            <option value="approved" <?= $doc->qc_status == 'approved' ? 'selected' : '' ?>>Verified</option>
                                                            <option value="rejected" <?= $doc->qc_status == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                                            <option value="indraft" <?= $doc->qc_status == 'indraft' ? 'selected' : '' ?>>In Draft</option>
                                                        </select>
                                                        <a href="<?= $file_url ?>" target="_blank" class="btn btn-primary btn-sm">
                                                            <i class="mdi mdi-eye"></i> View
                                                        </a>
                                                        <a href="<?= $file_url ?>" download class="btn btn-outline-primary btn-sm">
                                                            <i class="mdi mdi-download"></i> Download
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if(empty($documents) || count($documents) == 0): ?>
                            <div class="alert alert-info text-center">
                                <i class="mdi mdi-information" style="font-size: 2rem;"></i>
                                <p class="mb-0 mt-2">No documents uploaded yet for this user.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('footer.php') ?>

<script>
$(document).ready(function() {
    var baseUrl = '<?= base_url() ?>';
    
    // Add additional document type
    $('#addDocTypeForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var user_id = $form.find('input[name="user_id"]').val();
        var doc_name = $form.find('input[name="doc_name"]').val().trim();
        if (!doc_name) return;
        $form.find('button[type="submit"]').prop('disabled', true);
        $.ajax({
            url: baseUrl + 'Users/add_user_document_type',
            type: 'POST',
            data: { user_id: user_id, doc_name: doc_name },
            dataType: 'json',
            success: function(res) {
                $form.find('button[type="submit"]').prop('disabled', false);
                $form.find('input[name="doc_name"]').val('');
                if (res && res.success) {
                    var $list = $('#additionalDocTypesList');
                    if ($list.find('.list-group').length === 0) {
                        $list.html('<ul class="list-group list-group-flush"></ul>');
                    }
                    $list.find('.list-group').append(
                        '<li class="list-group-item d-flex justify-content-between align-items-center py-2">' +
                        '<span>' + $('<div>').text(doc_name).html() + '</span>' +
                        '<button type="button" class="btn btn-sm btn-outline-danger delete-doc-type" data-id="' + res.id + '"><i class="mdi mdi-delete"></i></button>' +
                        '</li>'
                    );
                    Swal.fire({ title: 'Added', text: 'Document type will appear on user\'s upload page', icon: 'success', timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ title: 'Error', text: (res && res.message) ? res.message : 'Failed to add', icon: 'error' });
                }
            },
            error: function() {
                $form.find('button[type="submit"]').prop('disabled', false);
                Swal.fire({ title: 'Error', text: 'Request failed', icon: 'error' });
            }
        });
        return false;
    });
    
    // Delete additional document type
    $(document).on('click', '.delete-doc-type', function() {
        var id = $(this).data('id');
        var $li = $(this).closest('li');
        $.ajax({
            url: baseUrl + 'Users/delete_user_document_type',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(res) {
                if (res && res.success) {
                    $li.remove();
                    if ($('#additionalDocTypesList .list-group-item').length === 0) {
                        $('#additionalDocTypesList').html('<p class="text-muted mb-0 small">No additional types yet. Add one above.</p>');
                    }
                }
            }
        });
    });
    
    // Update document status via dropdown
    $(document).on('change', '.status-select', function() {
        var docId = $(this).data('doc-id');
        var status = $(this).val();
        var $select = $(this);
        var originalValue = $select.data('original-value') || $select.find('option:selected').val();
        
        // Store original value if not stored
        if(!$select.data('original-value')) {
            $select.data('original-value', originalValue);
        }
        
        // Disable dropdown during update
        $select.prop('disabled', true);
        
        $.ajax({
            url: '<?= base_url("Users/update_document_status") ?>',
            type: 'POST',
            data: {
                document_id: docId,
                status: status
            },
            dataType: 'json',
            success: function(response) {
                $select.prop('disabled', false);
                
                if(response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Status updated successfully',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $select.data('original-value', status);
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update status',
                        icon: 'error'
                    });
                    $select.val(originalValue);
                }
            },
            error: function() {
                $select.prop('disabled', false);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while updating status',
                    icon: 'error'
                });
                $select.val(originalValue);
            }
        });
    });
});
</script>
