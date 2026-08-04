<?php include('header.php') ?>

<style>
/* Strict tab isolation: only the pane with .show is visible (Bootstrap 5) */
#dashboardTabContent .tab-pane { display: none !important; }
#dashboardTabContent .tab-pane.show { display: block !important; }
</style>

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

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <h4 class="page-title mb-1">
                                    <i class="mdi mdi-view-dashboard me-2"></i>
                                    Manage Dashboard: <?= htmlspecialchars($user->name ?? 'User') ?>
                                </h4>
                                <p class="mb-0">Configure dashboard data for this premium user</p>
                            </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>Users/premium_dashboard_list">Premium Dashboard</a></li>
                                    <li class="breadcrumb-item active">Manage</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="modern-card">
                        <div class="modern-card-body p-0">
                            <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard-content" role="tab" aria-controls="dashboard-content" aria-selected="true">
                                        <i class="mdi mdi-view-dashboard me-2"></i> Dashboard Data
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="comments-tab" data-bs-toggle="tab" href="#comments-content" role="tab" aria-controls="comments-content" aria-selected="false" data-tab="comments">
                                        <i class="mdi mdi-comment-multiple me-2"></i> Comments
                                        <span class="badge bg-primary ms-1" id="comments-tab-badge" style="display: none;">0</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="review-notes-tab" data-bs-toggle="tab" href="#review-notes-content" role="tab" aria-controls="review-notes-content" aria-selected="false" data-tab="review_notes">
                                        <i class="mdi mdi-clipboard-text me-2"></i> Review & Notes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="kanban-tab" data-bs-toggle="tab" href="#kanban-content" role="tab" aria-controls="kanban-content" aria-selected="false" data-tab="kanban">
                                        <i class="mdi mdi-view-column me-2"></i> Kanban Board
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tab Content -->
            <div class="tab-content" id="dashboardTabContent">
                <!-- Dashboard Data Tab -->
                <div class="tab-pane fade show active" id="dashboard-content" role="tabpanel" aria-labelledby="dashboard-tab">
            <form action="<?= base_url('Users/save_premium_dashboard') ?>" method="POST" id="dashboardForm" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?= $user->id ?>">
                
                <!-- Quick Dashboard Overview Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <h4 class="mb-0" style="font-weight: 600; color: var(--text-primary);">
                                    <i class="mdi mdi-speedometer me-2 text-primary"></i>Quick Dashboard Overview
                                </h4>
                                <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Manage key dashboard metrics</p>
                            </div>
                            <div class="modern-card-body">
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Uni Applied</label>
                                            <input type="number" class="form-control" name="uni_applied" 
                                                value="<?= isset($dashboard) ? $dashboard->uni_applied : 0 ?>" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Offers Received</label>
                                            <input type="number" class="form-control" name="offers_received" 
                                                value="<?= isset($dashboard) ? $dashboard->offers_received : 0 ?>" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Tuition Receipt Uploaded</label>
                                            <div class="custom-control custom-switch mt-2">
                                                <input type="checkbox" class="custom-control-input" id="tuition_receipt" 
                                                    name="tuition_receipt_uploaded" value="1" 
                                                    <?= (isset($dashboard) && $dashboard->tuition_receipt_uploaded) ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="tuition_receipt">Yes/No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Visa Applied</label>
                                            <div class="custom-control custom-switch mt-2">
                                                <input type="checkbox" class="custom-control-input" id="visa_applied" 
                                                    name="visa_applied" value="1" 
                                                    <?= (isset($dashboard) && $dashboard->visa_applied) ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="visa_applied">Yes/No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finalized Universities Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-0" style="font-weight: 600; color: var(--text-primary);">
                                            <i class="mdi mdi-school me-2 text-primary"></i>Finalized Universities
                                        </h4>
                                        <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Manage university shortlist</p>
                                    </div>
                                    <button type="button" class="btn btn-modern btn-primary btn-sm" id="addUniversity">
                                        <i class="mdi mdi-plus me-1"></i> Add University
                                    </button>
                                </div>
                            </div>
                            <div class="modern-card-body">
                                
                                <input type="hidden" name="finalized_uni_count" id="finalized_uni_count" 
                                    value="<?= isset($dashboard) ? $dashboard->finalized_uni_count : 0 ?>">
                                
                                <div id="universitiesContainer">
                                        <?php
                                        $universities_list = isset($universities_list) ? $universities_list : [];
                                        if (isset($universities) && count($universities) > 0):
                                            foreach ($universities as $index => $uni):
                                                $sel_id = isset($uni->university_id) ? $uni->university_id : null;
                                        ?>
                                        <div class="row mb-3 university-row">
                                            <div class="col-md-5">
                                                <select class="form-select" name="uni_id[]" required>
                                                    <option value="">-- Select University --</option>
                                                    <?php foreach ($universities_list as $ul): ?>
                                                    <option value="<?= (int)$ul->id ?>" <?= ($sel_id && $sel_id == $ul->id) || (!$sel_id && $uni->university_name === $ul->name) ? 'selected' : '' ?>><?= htmlspecialchars($ul->name) ?><?= !empty($ul->location) ? ' (' . htmlspecialchars($ul->location) . ')' : '' ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if(!empty($uni->image)): ?>
                                                        <div class="mr-2">
                                                            <img src="<?= base_url('../assets/images/' . $uni->image) ?>" alt="Logo" style="max-width: 50px; max-height: 50px; object-fit: contain; border: 1px solid #ddd; padding: 2px; border-radius: 4px;" onerror="this.style.display='none'">
                                                        </div>
                                                        <input type="hidden" name="existing_uni_image[]" value="<?= htmlspecialchars($uni->image) ?>">
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control-file" name="uni_image[]" accept="image/*">
                                                    <small class="text-muted">Optional logo override</small>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-university"><i class="mdi mdi-delete"></i></button>
                                            </div>
                                        </div>
                                        <?php endforeach;
                                        endif; ?>
                                </div>
                                <?php if (empty($universities_list)): ?>
                                <div class="alert alert-warning small mb-0">
                                    <i class="mdi mdi-information"></i> No universities in the list yet. <a href="<?= base_url('Universities/add') ?>">Add universities</a> in <a href="<?= base_url('Universities') ?>">University Management</a> first, then choose from that list here.
                                </div>
                                <?php else: ?>
                                <div class="text-muted small mt-2">
                                    <i class="mdi mdi-information"></i> Choose from the list only. Add more in <a href="<?= base_url('Universities') ?>">University Management</a>. Optional: upload logo override per row.
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Currently Working On Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-0" style="font-weight: 600; color: var(--text-primary);">
                                            <i class="mdi mdi-briefcase me-2 text-primary"></i>You are Currently Working On
                                        </h4>
                                        <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Track current tasks</p>
                                    </div>
                                    <button type="button" class="btn btn-modern btn-primary btn-sm" id="addCurrentTask">
                                        <i class="mdi mdi-plus me-1"></i> Add Task
                                    </button>
                                </div>
                            </div>
                            <div class="modern-card-body">
                                <div id="currentTasksContainer">
                                    <?php 
                                    $current_tasks = [];
                                    if(isset($dashboard) && $dashboard->currently_working_on) {
                                        $current_tasks = json_decode($dashboard->currently_working_on, true);
                                    }
                                    if(empty($current_tasks)) {
                                        $current_tasks = [''];
                                    }
                                    foreach($current_tasks as $task): ?>
                                    <div class="row mb-2 current-task-row">
                                        <div class="col-md-11">
                                            <input type="text" class="form-control" name="currently_working_on[]" 
                                                placeholder="Task description" value="<?= htmlspecialchars($task) ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger btn-sm remove-current-task">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Future Tasks Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-0" style="font-weight: 600; color: var(--text-primary);">
                                            <i class="mdi mdi-calendar-clock me-2 text-primary"></i>Future Task Preview
                                        </h4>
                                        <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Upcoming tasks</p>
                                    </div>
                                    <button type="button" class="btn btn-modern btn-primary btn-sm" id="addFutureTask">
                                        <i class="mdi mdi-plus me-1"></i> Add Task
                                    </button>
                                </div>
                            </div>
                            <div class="modern-card-body">
                                <div id="futureTasksContainer">
                                    <?php 
                                    $future_tasks = [];
                                    if(isset($dashboard) && $dashboard->future_tasks) {
                                        $future_tasks = json_decode($dashboard->future_tasks, true);
                                    }
                                    if(empty($future_tasks)) {
                                        $future_tasks = [''];
                                    }
                                    foreach($future_tasks as $task): ?>
                                    <div class="row mb-2 future-task-row">
                                        <div class="col-md-11">
                                            <input type="text" class="form-control" name="future_tasks[]" 
                                                placeholder="Task description" value="<?= htmlspecialchars($task) ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger btn-sm remove-future-task">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Where You Stand Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <h4 class="mb-0" style="font-weight: 600; color: var(--text-primary);">
                                    <i class="mdi mdi-chart-line me-2 text-primary"></i>Where You Stand
                                </h4>
                                <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Progress tracking and metrics</p>
                            </div>
                            <div class="modern-card-body">
                                <!-- Onboarding Percentage -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Onboarding Percentage (%)</label>
                                            <input type="number" class="form-control" name="onboarding_percentage" 
                                                value="<?= isset($dashboard) && isset($dashboard->onboarding_percentage) ? $dashboard->onboarding_percentage : 14 ?>" 
                                                min="0" max="100" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Onboarding Checklist -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5 class="mb-3">Onboarding Checklist</h5>
                                        <div id="onboardingChecklistContainer">
                                            <?php 
                                            $checklist_items = [
                                                'Profile Setup Complete',
                                                'University Shortlist Discussed',
                                                'SOP Discussion Done',
                                                'IELTS/GRE Status Confirmed',
                                                'Resume Uploaded',
                                                'LOR Briefed',
                                                'Loan & Finance Discussed'
                                            ];
                                            
                                            $saved_checklist = [];
                                            if(isset($dashboard) && $dashboard->onboarding_checklist) {
                                                $saved_checklist = json_decode($dashboard->onboarding_checklist, true);
                                            }
                                            
                                            foreach($checklist_items as $index => $item): 
                                                $checked = false;
                                                if(isset($saved_checklist[$index])) {
                                                    $checked = $saved_checklist[$index]['checked'] ?? false;
                                                }
                                            ?>
                                            <div class="row mb-2 checklist-item-row">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="checklist_item[]" 
                                                        value="<?= htmlspecialchars($item) ?>" readonly>
                                                    <input type="hidden" name="checklist_checkbox[]" value="0">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="custom-control custom-switch mt-2">
                                                        <input type="checkbox" class="custom-control-input checklist-checkbox" 
                                                            id="checklist_<?= $index ?>" 
                                                            name="checklist_checkbox[]" value="1"
                                                            <?= $checked ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="checklist_<?= $index ?>">Complete</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Feedback Session -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Feedback Session Title</label>
                                            <input type="text" class="form-control" name="feedback_session_title" 
                                                value="<?= isset($dashboard) && isset($dashboard->feedback_session_title) ? htmlspecialchars($dashboard->feedback_session_title) : 'June feedback session' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5 class="mb-3">Feedback Session Items</h5>
                                        <div id="feedbackSessionContainer">
                                            <?php 
                                            $feedback_items = [];
                                            if(isset($dashboard) && $dashboard->feedback_session_items) {
                                                $feedback_items = json_decode($dashboard->feedback_session_items, true);
                                            }
                                            if(empty($feedback_items)) {
                                                $feedback_items = [['text' => 'One-on-One Session Booked', 'checked' => false]];
                                            }
                                            foreach($feedback_items as $index => $item): ?>
                                            <div class="row mb-2 feedback-item-row">
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-sm" name="feedback_item_text[]" 
                                                        placeholder="Feedback item" value="<?= htmlspecialchars($item['text'] ?? '') ?>">
                                                    <input type="hidden" name="feedback_checkbox[]" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-switch mt-2">
                                                        <input type="checkbox" class="custom-control-input feedback-checkbox" 
                                                            id="feedback_<?= $index ?>" 
                                                            name="feedback_checkbox[]" value="1"
                                                            <?= (isset($item['checked']) && $item['checked']) ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="feedback_<?= $index ?>">Complete</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm remove-feedback-item" title="Delete">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="addFeedbackItem">
                                            <i class="mdi mdi-plus"></i> Add Item
                                        </button>
                                    </div>
                                </div>

                                <!-- Documents Tracker -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0">Documents Tracker</h5>
                                            <button type="button" class="btn btn-modern btn-primary btn-sm" id="addDocument">
                                                <i class="mdi mdi-plus me-1"></i> Add Document
                                            </button>
                                        </div>
                                        <div id="documentsTrackerContainer">
                                            <?php 
                                            $default_documents = [
                                                'SOP Drafts Uploaded' => 10,
                                                'LORs Uploaded' => 3,
                                                'Degree Certificate Uploaded' => 3,
                                                'Graduation Transcript' => 3,
                                                'Passport Front/Back' => 3,
                                                'Loan Documents If Applied' => 3,
                                                'Other Documents' => 3
                                            ];
                                            
                                            $saved_documents = [];
                                            if(isset($dashboard) && $dashboard->documents_tracker) {
                                                $saved_documents = json_decode($dashboard->documents_tracker, true);
                                            }
                                            
                                            // If we have saved documents, use those; otherwise use defaults
                                            if(!empty($saved_documents)) {
                                                foreach($saved_documents as $doc_name => $doc_data): 
                                                    $count = isset($doc_data['count']) ? $doc_data['count'] : 0;
                                            ?>
                                            <div class="row mb-2 document-row">
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control" name="doc_count[]" 
                                                        value="<?= $count ?>" min="0" placeholder="Count">
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="doc_name[]" 
                                                        value="<?= htmlspecialchars($doc_name) ?>" placeholder="Document name" required>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger btn-sm remove-document">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php 
                                                endforeach;
                                            } else {
                                                // Use default documents
                                                foreach($default_documents as $doc_name => $default_count): 
                                                    $count = $default_count;
                                            ?>
                                            <div class="row mb-2 document-row">
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control" name="doc_count[]" 
                                                        value="<?= $count ?>" min="0" placeholder="Count">
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="doc_name[]" 
                                                        value="<?= htmlspecialchars($doc_name) ?>" placeholder="Document name" required>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger btn-sm remove-document">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php endforeach; 
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Uni Shortlist -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5 class="mb-3">Uni Shortlist</h5>
                                        <div id="uniShortlistContainer">
                                            <?php 
                                            $shortlist_items = [];
                                            if(isset($dashboard) && $dashboard->uni_shortlist) {
                                                $shortlist_items = json_decode($dashboard->uni_shortlist, true);
                                            }
                                            if(empty($shortlist_items)) {
                                                $shortlist_items = [
                                                    ['name' => 'USA - Stream Choice 1', 'count' => 3],
                                                    ['name' => 'USA- Stream Choice 3', 'count' => 3]
                                                ];
                                            }
                                            foreach($shortlist_items as $index => $item): ?>
                                            <div class="row mb-2 shortlist-row">
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="shortlist_count[]" 
                                                        value="<?= isset($item['count']) ? $item['count'] : 0 ?>" min="0" placeholder="Count">
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="shortlist_name[]" 
                                                        value="<?= htmlspecialchars($item['name'] ?? '') ?>" placeholder="Shortlist name">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger btn-sm remove-shortlist">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="addShortlist">
                                            <i class="mdi mdi-plus"></i> Add Shortlist Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url('Users/premium_dashboard_list') ?>" class="btn btn-modern btn-secondary">
                                        <i class="mdi mdi-arrow-left me-1"></i> Back to List
                                    </a>
                                    <button type="submit" class="btn btn-modern btn-primary btn-lg">
                                        <i class="mdi mdi-content-save me-2"></i> Save Dashboard Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                </div>
                
                <!-- Comments Tab (lazy-loaded on first click, then cached) -->
                <div class="tab-pane fade" id="comments-content" role="tabpanel" aria-labelledby="comments-tab">
                    <div id="comments-tab-body" class="tab-lazy-content" data-tab="comments">
                        <div class="tab-loading-placeholder text-center py-5">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2 text-muted mb-0">Loading comments...</p>
                        </div>
                    </div>
                </div>
                
                <!-- Review & Notes Tab (lazy-loaded on first click, then cached) -->
                <div class="tab-pane fade" id="review-notes-content" role="tabpanel" aria-labelledby="review-notes-tab">
                    <div id="review-notes-tab-body" class="tab-lazy-content" data-tab="review_notes">
                        <div class="tab-loading-placeholder text-center py-5">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2 text-muted mb-0">Loading review & notes...</p>
                        </div>
                    </div>
                </div>
                
                <!-- Kanban Board Tab (lazy-loaded on first click, then cached) -->
                <div class="tab-pane fade" id="kanban-content" role="tabpanel" aria-labelledby="kanban-tab">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKanbanCardModal">
                                <i class="mdi mdi-plus"></i> Add Card
                            </button>
                        </div>
                    </div>
                    
                    <!-- Kanban styling aligned with frontend -->
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
                    <link rel="stylesheet" href="<?= base_url('assets/css/admin-kanban-frontend.css') ?>">
                    
                    <style>
                        .kanban-column {
                            padding: 0;
                            background: transparent;
                        }
                        .kanban-card {
                            position: relative;
                        }
                        .kanban-card:hover .card-actions {
                            display: block !important;
                        }
                        .card-actions {
                            background: rgba(255, 255, 255, 0.95);
                            border-radius: 4px;
                            padding: 2px;
                            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                        }
                        .card-actions .btn {
                            margin: 0 1px;
                        }
                        /* Loader overlay */
                        #kanbanLoader {
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: rgba(255, 255, 255, 0.9);
                            display: none;
                            align-items: center;
                            justify-content: center;
                            z-index: 1000;
                            border-radius: 8px;
                        }
                        #kanbanLoader.show {
                            display: flex;
                        }
                        #kanbanLoader .spinner-border {
                            width: 3rem;
                            height: 3rem;
                            border-width: 0.3em;
                        }
                        #kanbanBoardContainer {
                            position: relative;
                        }
                    </style>
                    
                    <div id="kanbanBoardContainer">
                        <div id="kanbanLoader" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <?php include('kanban_board_partial.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Kanban Card Modal -->
<div class="modal fade" id="addKanbanCardModal" tabindex="-1" aria-labelledby="addKanbanCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKanbanCardModalLabel">Add Kanban Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addKanbanCardForm">
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?= $user->id ?>">
                    <div class="form-group">
                        <label>Section</label>
                        <select class="form-control" name="section" required>
                            <option value="journey_map">Journey Map</option>
                            <option value="in_progress">In Progress</option>
                            <option value="draft_phase">Draft Phase</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Card Color</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" id="add_card_color" class="form-control form-control-color p-1" value="#4a90d9" style="width: 3rem; height: 2.25rem; cursor: pointer;">
                            <input type="hidden" name="card_type" id="add_card_type" value="#4a90d9">
                            <span id="add_card_color_hex" class="text-muted small">#4a90d9</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Card title">
                    </div>
                    <div class="form-group">
                        <label>Description Type</label>
                        <select class="form-control" name="description_type" id="descriptionTypeSelect">
                            <option value="text">Text</option>
                            <option value="list">List (Bullet Points)</option>
                        </select>
                    </div>
                    <div class="form-group" id="textDescriptionGroup">
                        <label>Description (Text)</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Card description"></textarea>
                    </div>
                    <div class="form-group" id="listDescriptionGroup" style="display: none;">
                        <label>Description (List Items - one per line)</label>
                        <textarea class="form-control" name="description_list" rows="5" placeholder="Enter list items, one per line"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tag (e.g., Important)</label>
                        <input type="text" class="form-control" name="tag" placeholder="Optional tag">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Card</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Kanban Card Modal -->
<div class="modal fade" id="editKanbanCardModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kanban Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKanbanCardForm">
                <div class="modal-body">
                    <input type="hidden" name="card_id" id="edit_card_id">
                    <div class="form-group">
                        <label>Section</label>
                        <select class="form-control" name="section" id="edit_section" required>
                            <option value="journey_map">Journey Map</option>
                            <option value="in_progress">In Progress</option>
                            <option value="draft_phase">Draft Phase</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Card Color</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" id="edit_card_color" class="form-control form-control-color p-1" value="#4a90d9" style="width: 3rem; height: 2.25rem; cursor: pointer;">
                            <input type="hidden" name="card_type" id="edit_card_type" value="#4a90d9">
                            <span id="edit_card_color_hex" class="text-muted small">#4a90d9</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" id="edit_title" placeholder="Card title">
                    </div>
                    <div class="form-group">
                        <label>Description Type</label>
                        <select class="form-control" name="description_type" id="edit_descriptionTypeSelect">
                            <option value="text">Text</option>
                            <option value="list">List (Bullet Points)</option>
                        </select>
                    </div>
                    <div class="form-group" id="edit_textDescriptionGroup">
                        <label>Description (Text)</label>
                        <textarea class="form-control" name="description" id="edit_description" rows="3" placeholder="Card description"></textarea>
                    </div>
                    <div class="form-group" id="edit_listDescriptionGroup" style="display: none;">
                        <label>Description (List Items - one per line)</label>
                        <textarea class="form-control" name="description_list" id="edit_description_list" rows="5" placeholder="Enter list items, one per line"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tag (e.g., Important)</label>
                        <input type="text" class="form-control" name="tag" id="edit_tag" placeholder="Optional tag">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Card</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php') ?>

<script>
$(document).ready(function() {
    var userId = <?= $user->id ?>;
    var baseUrl = '<?= base_url() ?>';
    
    // Bootstrap modal helper - handles both BS4 (from vendor.min.js) and BS5 
    function hideModal(modalId) {
        var el = document.getElementById(modalId);
        if (!el) return;
        
        // Method 1: Try jQuery .modal() (works if vendor.min.js includes BS4 jQuery plugin)
        try {
            if ($.fn.modal) {
                $('#' + modalId).modal('hide');
                return;
            }
        } catch(e) {}
        
        // Method 2: Try Bootstrap 5 native API
        try {
            if (window.bootstrap && bootstrap.Modal) {
                var m = bootstrap.Modal.getInstance(el) || bootstrap.Modal.getOrCreateInstance(el);
                if (m) { m.hide(); return; }
            }
        } catch(e) {}
        
        // Method 3: Force close via DOM
        $(el).removeClass('show').css('display', 'none').attr('aria-hidden', 'true');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css({'overflow': '', 'padding-right': ''});
    }
    function showModal(modalId) {
        var el = document.getElementById(modalId);
        if (!el) return;
        
        try {
            if ($.fn.modal) {
                $('#' + modalId).modal('show');
                return;
            }
        } catch(e) {}
        
        try {
            if (window.bootstrap && bootstrap.Modal) {
                var m = bootstrap.Modal.getOrCreateInstance(el);
                m.show();
                return;
            }
        } catch(e) {}
    }
    
    // Cache for lazy-loaded tab content (so data doesn't reload every time we click the tab)
    var tabCache = { comments: null, review_notes: null, kanban: null };
    
    // Initialize Bootstrap 5 tabs (native API so panes show/hide correctly)
    (function initTabs() {
        var tabContent = document.getElementById('dashboardTabContent');
        var tabLinks = document.querySelectorAll('#dashboardTabs a[data-bs-toggle="tab"]');
        tabLinks.forEach(function(tabEl) {
            tabEl.addEventListener('click', function(e) {
                e.preventDefault();
                var href = this.getAttribute('href');
                if (!href || href === '#') return;
                var paneId = href.replace('#', '');
                var pane = document.getElementById(paneId);
                if (!pane) return;
                // Hide all panes, show this one (ensures strict isolation)
                if (tabContent) {
                    tabContent.querySelectorAll('.tab-pane').forEach(function(p) {
                        p.classList.remove('show', 'active');
                    });
                }
                pane.classList.add('show', 'active');
                document.querySelectorAll('#dashboardTabs .nav-link').forEach(function(n) { n.classList.remove('active'); });
                this.classList.add('active');
                // Trigger shown.bs.tab for lazy-load
                $(this).trigger('shown.bs.tab');
            });
        });
    })();
    
    // Lazy-load tab content on first show, then use cache
    $('#dashboardTabs').on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function (e) {
        var tab = $(e.target).data('tab');
        if (!tab) return;
        
        if (tab === 'comments') {
            if (tabCache.comments !== null) return; // already loaded
            var $body = $('#comments-tab-body');
            $.ajax({
                url: baseUrl + 'Users/ajax_tab_comments',
                type: 'GET',
                data: { user_id: userId },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        $body.html(res.html);
                        tabCache.comments = res.html;
                        if (res.comments_count > 0) {
                            $('#comments-tab-badge').text(res.comments_count).show();
                        }
                    } else {
                        $body.html('<div class="alert alert-danger">' + (res.message || 'Failed to load comments') + '</div>');
                    }
                },
                error: function() {
                    $body.html('<div class="alert alert-danger">Failed to load comments. Please try again.</div>');
                }
            });
        } else if (tab === 'review_notes') {
            if (tabCache.review_notes !== null) return;
            var $body = $('#review-notes-tab-body');
            $.ajax({
                url: baseUrl + 'Users/ajax_tab_review_notes',
                type: 'GET',
                data: { user_id: userId },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        $body.html(res.html);
                        tabCache.review_notes = res.html;
                        if (typeof updateReviewQueueCount === 'function') updateReviewQueueCount();
                        if (typeof updateCounselorNotesCount === 'function') updateCounselorNotesCount();
                        if (typeof refreshImportantAlertsState === 'function') refreshImportantAlertsState();
                    } else {
                        $body.html('<div class="alert alert-danger">' + (res.message || 'Failed to load') + '</div>');
                    }
                },
                error: function() {
                    $body.html('<div class="alert alert-danger">Failed to load review & notes. Please try again.</div>');
                }
            });
        } else if (tab === 'kanban') {
            // Kanban board is fully rendered on initial page load.
            // We only use AJAX (reloadKanbanBoard) after add/edit/delete to refresh it.
            return;
        }
    });
    
    // Universities list for "Add University" dropdown (from University Management)
    var universitiesListForSelect = <?= isset($universities_list) && is_array($universities_list) ? json_encode(array_map(function($u) { return ['id' => (int)$u->id, 'name' => $u->name, 'location' => isset($u->location) ? $u->location : '']; }, $universities_list)) : '[]' ?>;
    
    // Add University
    $('#addUniversity').on('click', function() {
        var opts = '<option value="">-- Select University --</option>';
        for (var i = 0; i < universitiesListForSelect.length; i++) {
            var u = universitiesListForSelect[i];
            opts += '<option value="' + u.id + '">' + (u.name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;') + (u.location ? ' (' + (u.location || '').replace(/</g, '&lt;').replace(/>/g, '&gt;') + ')' : '') + '</option>';
        }
        var html = '<div class="row mb-3 university-row">' +
            '<div class="col-md-5"><select class="form-select" name="uni_id[]" required>' + opts + '</select></div>' +
            '<div class="col-md-5"><div class="d-flex align-items-center gap-2">' +
            '<input type="file" class="form-control-file" name="uni_image[]" accept="image/*">' +
            '<small class="text-muted">Optional logo override</small></div></div>' +
            '<div class="col-md-2"><button type="button" class="btn btn-danger btn-sm remove-university"><i class="mdi mdi-delete"></i></button></div>' +
            '</div>';
        $('#universitiesContainer').append(html);
        updateUniCount();
    });
    
    // Remove University
    $(document).on('click', '.remove-university', function() {
        $(this).closest('.university-row').remove();
        updateUniCount();
    });
    
    // Update University Count
    function updateUniCount() {
        var count = $('#universitiesContainer .university-row').length;
        $('#finalized_uni_count').val(count);
    }
    
    // Add Current Task
    $('#addCurrentTask').on('click', function() {
        var html = '<div class="row mb-2 current-task-row">' +
            '<div class="col-md-11">' +
            '<input type="text" class="form-control" name="currently_working_on[]" placeholder="Task description">' +
            '</div>' +
            '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger btn-sm remove-current-task"><i class="mdi mdi-delete"></i></button>' +
            '</div>' +
            '</div>';
        $('#currentTasksContainer').append(html);
    });
    
    // Remove Current Task
    $(document).on('click', '.remove-current-task', function() {
        $(this).closest('.current-task-row').remove();
    });
    
    // Add Future Task
    $('#addFutureTask').on('click', function() {
        var html = '<div class="row mb-2 future-task-row">' +
            '<div class="col-md-11">' +
            '<input type="text" class="form-control" name="future_tasks[]" placeholder="Task description">' +
            '</div>' +
            '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger btn-sm remove-future-task"><i class="mdi mdi-delete"></i></button>' +
            '</div>' +
            '</div>';
        $('#futureTasksContainer').append(html);
    });
    
    // Remove Future Task
    $(document).on('click', '.remove-future-task', function() {
        $(this).closest('.future-task-row').remove();
    });
    
    // Add Feedback Item
    $('#addFeedbackItem').on('click', function() {
        var index = $('#feedbackSessionContainer .feedback-item-row').length;
        var html = '<div class="row mb-2 feedback-item-row">' +
            '<div class="col-md-7">' +
            '<input type="text" class="form-control form-control-sm" name="feedback_item_text[]" placeholder="Feedback item">' +
            '<input type="hidden" name="feedback_checkbox[]" value="0">' +
            '</div>' +
            '<div class="col-md-3">' +
            '<div class="custom-control custom-switch mt-2">' +
            '<input type="checkbox" class="custom-control-input feedback-checkbox" id="feedback_' + index + '" name="feedback_checkbox[]" value="1">' +
            '<label class="custom-control-label" for="feedback_' + index + '">Complete</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<button type="button" class="btn btn-danger btn-sm remove-feedback-item" title="Delete">' +
            '<i class="mdi mdi-delete"></i>' +
            '</button>' +
            '</div>' +
            '</div>';
        $('#feedbackSessionContainer').append(html);
    });
    
    // Remove Feedback Item
    $(document).on('click', '.remove-feedback-item', function() {
        $(this).closest('.feedback-item-row').remove();
    });
    
    // Add Shortlist Item
    $('#addShortlist').on('click', function() {
        var html = '<div class="row mb-2 shortlist-row">' +
            '<div class="col-md-3">' +
            '<input type="number" class="form-control" name="shortlist_count[]" value="0" min="0" placeholder="Count">' +
            '</div>' +
            '<div class="col-md-8">' +
            '<input type="text" class="form-control" name="shortlist_name[]" placeholder="Shortlist name">' +
            '</div>' +
            '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger btn-sm remove-shortlist"><i class="mdi mdi-delete"></i></button>' +
            '</div>' +
            '</div>';
        $('#uniShortlistContainer').append(html);
    });
    
    // Remove Shortlist Item
    $(document).on('click', '.remove-shortlist', function() {
        $(this).closest('.shortlist-row').remove();
    });
    
    // Add Document
    $('#addDocument').on('click', function() {
        var html = '<div class="row mb-2 document-row">' +
            '<div class="col-md-2">' +
            '<input type="number" class="form-control" name="doc_count[]" value="0" min="0" placeholder="Count">' +
            '</div>' +
            '<div class="col-md-9">' +
            '<input type="text" class="form-control" name="doc_name[]" placeholder="Document name" required>' +
            '</div>' +
            '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger btn-sm remove-document"><i class="mdi mdi-delete"></i></button>' +
            '</div>' +
            '</div>';
        $('#documentsTrackerContainer').append(html);
    });
    
    // Remove Document
    $(document).on('click', '.remove-document', function() {
        $(this).closest('.document-row').remove();
    });
    
    
    // Initialize count
    updateUniCount();
    
    // Handle checkbox changes to update hidden inputs
    $(document).on('change', '.checklist-checkbox', function() {
        var $hidden = $(this).closest('.checklist-item-row').find('input[type="hidden"][name="checklist_checkbox[]"]');
        if($(this).is(':checked')) {
            $hidden.val('1');
        } else {
            $hidden.val('0');
        }
    });
    
    $(document).on('change', '.feedback-checkbox', function() {
        var $hidden = $(this).closest('.feedback-item-row').find('input[type="hidden"][name="feedback_checkbox[]"]');
        if($(this).is(':checked')) {
            $hidden.val('1');
        } else {
            $hidden.val('0');
        }
    });
    
    // Initialize checkbox states on page load
    $('.checklist-checkbox').each(function() {
        var $hidden = $(this).closest('.checklist-item-row').find('input[type="hidden"][name="checklist_checkbox[]"]');
        if($(this).is(':checked')) {
            $hidden.val('1');
        } else {
            $hidden.val('0');
        }
    });
    
    $('.feedback-checkbox').each(function() {
        var $hidden = $(this).closest('.feedback-item-row').find('input[type="hidden"][name="feedback_checkbox[]"]');
        if($(this).is(':checked')) {
            $hidden.val('1');
        } else {
            $hidden.val('0');
        }
    });
    
    // Handle comment reply submission
    $(document).on('submit', '.reply-form', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var commentId = form.data('comment-id');
        var replyText = form.find('.reply-textarea').val().trim();
        var submitBtn = form.find('button[type="submit"]');
        var originalText = submitBtn.html();
        
        if (!replyText) {
            Swal.fire({
                title: 'Error',
                text: 'Please enter a reply',
                icon: 'error'
            });
            return;
        }
        
        submitBtn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Sending...');
        
        $.ajax({
            url: '<?= base_url("Users/reply_to_comment") ?>',
            type: 'POST',
            data: {
                comment_id: commentId,
                reply_text: replyText
            },
            dataType: 'json',
            success: function(response) {
                submitBtn.prop('disabled', false).html(originalText);
                
                if(response && response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Reply sent successfully',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to send reply',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                submitBtn.prop('disabled', false).html(originalText);
                console.error('Reply error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while sending reply',
                    icon: 'error'
                });
            }
        });
    });
    
    // Important Alerts Management (userId already set at top)
    var IMPORTANT_ALERTS_MAX = 3;
    var IMPORTANT_ALERTS_MAX_WORDS = 12;

    function countWords(text) {
        var t = (text || '').trim();
        return t ? t.split(/\s+/).length : 0;
    }

    // Keep the add form, counter and limit warning in sync with how many alerts exist.
    function refreshImportantAlertsState() {
        var count = $('.important-alert-item').length;
        var full = count >= IMPORTANT_ALERTS_MAX;
        $('#importantAlertsCount').text(count);
        $('#importantAlertText').prop('disabled', full);
        $('#addImportantAlertBtn').prop('disabled', full);
        $('#importantAlertsLimitMsg').toggleClass('d-none', !full);
        if (count > 0) {
            $('#importantAlertsEmpty').remove();
        }
    }

    $(document).on('input', '#importantAlertText', function() {
        var words = countWords($(this).val());
        $('#importantAlertWordCount')
            .text(words)
            .css('color', words > IMPORTANT_ALERTS_MAX_WORDS ? '#f1556c' : '');
    });

    $(document).on('submit', '#addImportantAlertForm', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $text = $form.find('textarea[name="alert_text"]');
        var alertText = $text.val().trim();

        if (!alertText) {
            Swal.fire({ title: 'Error!', text: 'Please enter alert text', icon: 'error' });
            return;
        }
        if (countWords(alertText) > IMPORTANT_ALERTS_MAX_WORDS) {
            Swal.fire({ title: 'Too long!', text: 'Alert must be ' + IMPORTANT_ALERTS_MAX_WORDS + ' words or fewer', icon: 'error' });
            return;
        }
        if ($('.important-alert-item').length >= IMPORTANT_ALERTS_MAX) {
            Swal.fire({ title: 'Limit reached', text: 'Only ' + IMPORTANT_ALERTS_MAX + ' alerts allowed. Delete one first.', icon: 'warning' });
            return;
        }

        var $btn = $('#addImportantAlertBtn');
        $btn.prop('disabled', true);

        $.ajax({
            url: '<?= base_url("Users/add_important_alert") ?>',
            type: 'POST',
            data: { user_id: userId, alert_text: alertText },
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    var html = '<div class="card mb-2 important-alert-item" data-alert-id="' + response.id + '">' +
                        '<div class="card-body p-2">' +
                        '<div class="d-flex align-items-center gap-3">' +
                        '<input type="text" class="form-control form-control-sm important-alert-text" value="' +
                        $('<div>').text(alertText).html() + '" data-alert-id="' + response.id + '" style="flex: 1;">' +
                        '<button type="button" class="btn btn-danger btn-sm delete-important-alert" data-alert-id="' + response.id + '">' +
                        '<i class="mdi mdi-delete"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('#importantAlertsList').append(html);
                    $text.val('');
                    $('#importantAlertWordCount').text('0').css('color', '');
                    if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                } else {
                    Swal.fire({ title: 'Error!', text: (response && response.message) || 'Failed to add alert', icon: 'error' });
                }
                refreshImportantAlertsState();
            },
            error: function() {
                Swal.fire({ title: 'Error!', text: 'An error occurred while adding the alert', icon: 'error' });
                refreshImportantAlertsState();
            }
        });
    });

    // Save alert text on blur
    $(document).on('blur', '.important-alert-text', function() {
        var $input = $(this);
        var alertId = $input.data('alert-id');
        var alertText = $input.val().trim();
        var original = $input.data('original-text');

        if (original !== undefined && original === alertText) {
            return;
        }
        if (!alertText) {
            Swal.fire({ title: 'Error!', text: 'Alert text cannot be empty', icon: 'error' });
            if (original !== undefined) $input.val(original);
            return;
        }
        if (countWords(alertText) > IMPORTANT_ALERTS_MAX_WORDS) {
            Swal.fire({ title: 'Too long!', text: 'Alert must be ' + IMPORTANT_ALERTS_MAX_WORDS + ' words or fewer', icon: 'error' });
            if (original !== undefined) $input.val(original);
            return;
        }

        $.ajax({
            url: '<?= base_url("Users/update_important_alert") ?>',
            type: 'POST',
            data: { alert_id: alertId, alert_text: alertText },
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    $input.data('original-text', alertText);
                    if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                } else {
                    Swal.fire({ title: 'Error!', text: (response && response.message) || 'Failed to update alert', icon: 'error' });
                    if (original !== undefined) $input.val(original);
                }
            },
            error: function() {
                Swal.fire({ title: 'Error!', text: 'An error occurred while updating the alert', icon: 'error' });
            }
        });
    });

    $(document).on('focus', '.important-alert-text', function() {
        $(this).data('original-text', $(this).val().trim());
    });

    $(document).on('click', '.delete-important-alert', function() {
        var alertId = $(this).data('alert-id');
        var $item = $(this).closest('.important-alert-item');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This alert will be removed from the user\'s progress board.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result) {
            if (!result.value) return;

            $.ajax({
                url: '<?= base_url("Users/delete_important_alert") ?>',
                type: 'POST',
                data: { alert_id: alertId },
                dataType: 'json',
                success: function(response) {
                    if (response && response.success) {
                        $item.remove();
                        if ($('.important-alert-item').length === 0) {
                            $('#importantAlertsList').html('<div class="alert alert-info" id="importantAlertsEmpty">' +
                                '<i class="mdi mdi-information"></i> No important alerts yet. Add one above.</div>');
                        }
                        if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                        refreshImportantAlertsState();
                    } else {
                        Swal.fire({ title: 'Error!', text: (response && response.message) || 'Failed to delete alert', icon: 'error' });
                    }
                },
                error: function() {
                    Swal.fire({ title: 'Error!', text: 'An error occurred while deleting the alert', icon: 'error' });
                }
            });
        });
    });

    // Review Queue Management (userId already set at top)
    // Update completed count
    function updateReviewQueueCount() {
        var checkedCount = $('.review-checkbox:checked').length;
        $('#reviewQueueCompletedCount').text(checkedCount);
    }
    
    // Initialize count
    updateReviewQueueCount();
    
    // Add Review Queue Item (form submit, same pattern as Counselor Notes – no popup)
    $(document).on('submit', '#addReviewQueueItemForm', function(e) {
        e.preventDefault();
        var $form = $(this);
        var itemText = $form.find('textarea[name="item_text"]').val().trim();
        if (!itemText) {
            Swal.fire({ title: 'Error!', text: 'Please enter item text', icon: 'error' });
            return;
        }
        var $btn = $form.find('button[type="submit"]');
        $btn.prop('disabled', true);
        $.ajax({
            url: '<?= base_url("Users/add_review_queue_item") ?>',
            type: 'POST',
            data: {
                user_id: $form.find('input[name="user_id"]').val(),
                item_text: itemText
            },
            dataType: 'json',
            success: function(response) {
                $btn.prop('disabled', false);
                if (response && response.success) {
                    var html = '<div class="card mb-2 review-queue-item" data-item-id="' + response.id + '">' +
                        '<div class="card-body p-2">' +
                        '<div class="d-flex align-items-center gap-3">' +
                        '<div class="form-check">' +
                        '<input type="checkbox" class="form-check-input review-checkbox" data-item-id="' + response.id + '">' +
                        '</div>' +
                        '<input type="text" class="form-control form-control-sm review-item-text" value="' + 
                        $('<div>').text(itemText).html() + '" data-item-id="' + response.id + '" style="flex: 1;">' +
                        '<button type="button" class="btn btn-danger btn-sm delete-review-item" data-item-id="' + response.id + '">' +
                        '<i class="mdi mdi-delete"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    if ($('#reviewQueueItemsList .alert-info').length) {
                        $('#reviewQueueItemsList').html(html);
                    } else {
                        $('#reviewQueueItemsList').append(html);
                    }
                    $form.find('textarea[name="item_text"]').val('');
                    if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                    updateReviewQueueCount();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Item added successfully',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: (response && response.message) ? response.message : 'Failed to add item',
                        icon: 'error'
                    });
                }
            },
            error: function() {
                $btn.prop('disabled', false);
                Swal.fire({ title: 'Error!', text: 'An error occurred', icon: 'error' });
            }
        });
        return false;
    });
    
    // Update Review Queue Item Text
    $(document).on('blur', '.review-item-text', function() {
        var itemId = $(this).data('item-id');
        var itemText = $(this).val().trim();
        
        if (!itemText) {
            Swal.fire({
                title: 'Error!',
                text: 'Item text cannot be empty',
                icon: 'error'
            });
            return;
        }
        
        $.ajax({
            url: '<?= base_url("Users/update_review_queue_item") ?>',
            type: 'POST',
            data: {
                item_id: itemId,
                item_text: itemText
            },
            dataType: 'json',
            success: function(response) {
                if (!response.success) {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update item',
                        icon: 'error'
                    });
                }
            }
        });
    });
    
    // Toggle Review Queue Item Checkbox
    $(document).on('change', '.review-checkbox', function() {
        var itemId = $(this).data('item-id');
        var isChecked = $(this).is(':checked') ? 1 : 0;
        
        $.ajax({
            url: '<?= base_url("Users/update_review_queue_item") ?>',
            type: 'POST',
            data: {
                item_id: itemId,
                is_checked: isChecked
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    updateReviewQueueCount();
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update item',
                        icon: 'error'
                    });
                }
            }
        });
    });
    
    // Delete Review Queue Item
    $(document).on('click', '.delete-review-item', function() {
        var itemId = $(this).data('item-id');
        var $item = $(this).closest('.review-queue-item');
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the review queue item',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                    url: '<?= base_url("Users/delete_review_queue_item") ?>',
                                    type: 'POST',
                                    data: {
                                        item_id: itemId
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            $item.remove();
                                            updateReviewQueueCount();
                                            if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                                            if ($('#reviewQueueItemsList .review-queue-item').length === 0) {
                                $('#reviewQueueItemsList').html(
                                    '<div class="alert alert-info">' +
                                    '<i class="mdi mdi-information"></i> No review queue items yet. Add an item above.' +
                                    '</div>'
                                );
                            }
                            
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Item deleted successfully',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Failed to delete item',
                                icon: 'error'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
    
    // Counselor Notes Management
    function updateCounselorNotesCount() {
        var count = $('.counselor-note-item').length;
        $('#counselorNotesCount').text(count);
    }
    
    // Initialize count
    updateCounselorNotesCount();
    
    // Add Counselor Note (delegated so it works after lazy-loaded tab content)
    $(document).on('submit', '#addCounselorNoteForm', function(e) {
        e.preventDefault();
        var noteText = $('textarea[name="note_text"]', this).val().trim();
        
        if (!noteText) {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter a note',
                icon: 'error'
            });
            return;
        }
        
        $.ajax({
            url: '<?= base_url("Users/add_counselor_note") ?>',
            type: 'POST',
            data: {
                user_id: userId,
                note_text: noteText
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var noteIndex = $('.counselor-note-item').length + 1;
                    var html = '<div class="card mb-2 counselor-note-item" data-note-id="' + response.id + '">' +
                        '<div class="card-body p-3">' +
                        '<div class="d-flex align-items-start gap-3">' +
                        '<div class="flex-shrink-0">' +
                        '<img src="<?= base_url("assets/img/avatar-icon.png") ?>" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%;">' +
                        '</div>' +
                        '<div class="flex-grow-1">' +
                        '<div class="d-flex justify-content-between align-items-start mb-2">' +
                        '<span class="badge badge-secondary">' + noteIndex + '</span>' +
                        '<button type="button" class="btn btn-sm btn-outline-secondary edit-note-btn" data-note-id="' + response.id + '" data-note-text="' + 
                        $('<div>').text(noteText).html() + '">' +
                        '<i class="mdi mdi-pencil"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-sm btn-danger delete-note-btn" data-note-id="' + response.id + '">' +
                        '<i class="mdi mdi-delete"></i>' +
                        '</button>' +
                        '</div>' +
                        '<h5 class="note-text-display mb-0">' + $('<div>').text(noteText).html().replace(/\n/g, '<br>') + '</h5>' +
                        '<textarea class="form-control note-text-edit d-none" rows="3">' + $('<div>').text(noteText).html() + '</textarea>' +
                        '<small class="text-muted d-block mt-2">' +
                        '<i class="mdi mdi-clock-outline"></i> Just now' +
                        '</small>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    
                    if ($('#counselorNotesList .alert-info').length) {
                        $('#counselorNotesList').html(html);
                    } else {
                        $('#counselorNotesList').prepend(html);
                    }
                    if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                    $('textarea[name="note_text"]', '#addCounselorNoteForm').val('');
                    updateCounselorNotesCount();
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Note added successfully',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to add note',
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred',
                    icon: 'error'
                });
            }
        });
    });
    
    // Edit Counselor Note
    $(document).on('click', '.edit-note-btn', function() {
        var $item = $(this).closest('.counselor-note-item');
        var $display = $item.find('.note-text-display');
        var $edit = $item.find('.note-text-edit');
        var $btn = $(this);
        
        if ($display.hasClass('d-none')) {
            // Cancel edit
            $display.removeClass('d-none');
            $edit.addClass('d-none');
            $btn.html('<i class="mdi mdi-pencil"></i>');
        } else {
            // Start edit
            $display.addClass('d-none');
            $edit.removeClass('d-none');
            $btn.html('<i class="mdi mdi-check"></i>');
        }
    });
    
    // Save Counselor Note Edit
    $(document).on('blur', '.note-text-edit', function() {
        var $item = $(this).closest('.counselor-note-item');
        var noteId = $item.data('note-id');
        var noteText = $(this).val().trim();
        var $display = $item.find('.note-text-display');
        var $edit = $item.find('.note-text-edit');
        var $btn = $item.find('.edit-note-btn');
        
        if (!noteText) {
            Swal.fire({
                title: 'Error!',
                text: 'Note text cannot be empty',
                icon: 'error'
            });
            return;
        }
        
        $.ajax({
            url: '<?= base_url("Users/update_counselor_note") ?>',
            type: 'POST',
            data: {
                note_id: noteId,
                note_text: noteText
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $display.html($('<div>').text(noteText).html().replace(/\n/g, '<br>'));
                    $display.removeClass('d-none');
                    $edit.addClass('d-none');
                    $btn.html('<i class="mdi mdi-pencil"></i>');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update note',
                        icon: 'error'
                    });
                }
            }
        });
    });
    
    // Delete Counselor Note
    $(document).on('click', '.delete-note-btn', function() {
        var noteId = $(this).data('note-id');
        var $item = $(this).closest('.counselor-note-item');
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the counselor note',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("Users/delete_counselor_note") ?>',
                    type: 'POST',
                    data: {
                        note_id: noteId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $item.remove();
                            updateCounselorNotesCount();
                            
                            // Update note numbers
                            $('.counselor-note-item').each(function(index) {
                                $(this).find('.badge').text(index + 1);
                            });
                            
                            if ($('.counselor-note-item').length === 0) {
                                $('#counselorNotesList').html(
                                    '<div class="alert alert-info">' +
                                    '<i class="mdi mdi-information"></i> No counselor notes yet. Add a note above.' +
                                    '</div>'
                                );
                            }
                            if (typeof tabCache !== 'undefined') tabCache.review_notes = null;
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Note deleted successfully',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Failed to delete note',
                                icon: 'error'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
    
    // Kanban Board Management
    // Show/hide card actions on hover
    $(document).on('mouseenter', '.kanban-card', function() {
        $(this).find('.card-actions').css('display', 'block');
    }).on('mouseleave', '.kanban-card', function() {
        $(this).find('.card-actions').css('display', 'none');
    });
    
    // Description type toggle
    $('#descriptionTypeSelect').on('change', function() {
        if($(this).val() == 'list') {
            $('#textDescriptionGroup').hide();
            $('#listDescriptionGroup').show();
        } else {
            $('#textDescriptionGroup').show();
            $('#listDescriptionGroup').hide();
        }
    });
    
    // Add card: color picker sync
    $('#add_card_color').on('input change', function() {
        var hex = $(this).val();
        $('#add_card_type').val(hex);
        $('#add_card_color_hex').text(hex);
    });
    
    // Edit card: color picker sync
    $('#edit_card_color').on('input change', function() {
        var hex = $(this).val();
        $('#edit_card_type').val(hex);
        $('#edit_card_color_hex').text(hex);
    });
    
    // Function to render kanban card HTML (card_type can be hex color or legacy class)
    function renderKanbanCard(card) {
        var isHex = card.card_type && /^#[0-9A-Fa-f]{6}$/.test(card.card_type);
        var innerClass = 'card-sm mb-3';
        var innerStyle = '';
        if (isHex) {
            innerStyle = 'background-color:' + card.card_type + '; color:#fff; border-radius:8px; padding:12px;';
        } else {
            innerClass = card.card_type + ' ' + innerClass;
        }
        var cardHtml = '<div class="kanban-card mb-3" data-card-id="' + card.id + '" draggable="true" style="cursor: move; position: relative;">';
        cardHtml += '<div class="' + innerClass + '" data-card-type="' + escapeHtml(card.card_type || '') + '"' + (innerStyle ? ' style="' + innerStyle + '"' : '') + '>';
        
        // Title and Tag
        if(card.title || card.tag) {
            cardHtml += '<div class="d-flex justify-content-space mb-2">';
            if(card.title) {
                cardHtml += '<h6 class="mb-0 fs-14 fw-700">' + escapeHtml(card.title) + '</h6>';
            }
            if(card.tag) {
                cardHtml += '<span class="highlight-tag">' + escapeHtml(card.tag) + '</span>';
            }
            cardHtml += '</div>';
        }
        
        // Description
        if(card.description) {
            if(card.description_type == 'list') {
                var listItems = typeof card.description === 'string' ? JSON.parse(card.description) : card.description;
                if(!Array.isArray(listItems)) {
                    listItems = card.description.split('\n');
                }
                cardHtml += '<ul>';
                for(var i = 0; i < listItems.length; i++) {
                    if(listItems[i].trim()) {
                        cardHtml += '<li>' + escapeHtml(listItems[i].trim()) + '</li>';
                    }
                }
                cardHtml += '</ul>';
            } else {
                cardHtml += '<p class="mb-0 fs-12 lh-12 fw-400">' + escapeHtml(card.description).replace(/\n/g, '<br>') + '</p>';
            }
        }
        
        cardHtml += '</div>';
        
        // Admin Actions
        cardHtml += '<div class="card-actions" style="position: absolute; top: 5px; right: 5px; display: none; z-index: 10;">';
        cardHtml += '<button type="button" class="btn btn-xs btn-primary edit-kanban-card" data-card-id="' + card.id + '" style="padding: 2px 6px; font-size: 11px;">';
        cardHtml += '<i class="mdi mdi-pencil"></i>';
        cardHtml += '</button>';
        cardHtml += '<button type="button" class="btn btn-xs btn-danger delete-kanban-card" data-card-id="' + card.id + '" style="padding: 2px 6px; font-size: 11px;">';
        cardHtml += '<i class="mdi mdi-delete"></i>';
        cardHtml += '</button>';
        cardHtml += '</div>';
        cardHtml += '</div>';
        
        return cardHtml;
    }
    
    // Helper function to escape HTML
    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text ? text.replace(/[&<>"']/g, function(m) { return map[m]; }) : '';
    }
    
    // Helper function to reload kanban board
    function reloadKanbanBoard(userId) {
        $('#kanbanLoader').addClass('show');
        
        $.ajax({
            url: '<?= base_url("Users/fetch_kanban_board") ?>',
            type: 'POST',
            data: {
                user_id: userId
            },
            success: function(responseRaw) {
                var response;
                try {
                    response = (typeof responseRaw === 'string') ? JSON.parse(responseRaw) : responseRaw;
                } catch(e) {
                    // Try to extract JSON from mixed HTML/JSON response
                    try {
                        var jsonStr = responseRaw.match(/\{[\s\S]*"success"\s*:[\s\S]*\}/);
                        if (jsonStr) response = JSON.parse(jsonStr[0]);
                    } catch(e2) {}
                }
                
                if(response && response.success && response.html) {
                    // The partial includes the #kanbanBoard wrapper div itself,
                    // so replace the entire element to avoid nesting duplicates
                    var $oldBoard = $('#kanbanBoard');
                    if ($oldBoard.length) {
                        $oldBoard.replaceWith(response.html);
                    } else {
                        // If #kanbanBoard doesn't exist anymore, put it in the container
                        $('#kanbanBoardContainer').append(response.html);
                    }
                    $('#kanbanLoader').removeClass('show');
                    if (typeof tabCache !== 'undefined') tabCache.kanban = response.html;
                } else {
                    $('#kanbanLoader').removeClass('show');
                    console.error('Kanban reload failed:', responseRaw);
                }
            },
            error: function(xhr) {
                $('#kanbanLoader').removeClass('show');
                console.error('Kanban reload AJAX error:', xhr.status, xhr.responseText);
            }
        });
    }
    
    // Add Kanban Card (delegated so it always fires)
    $(document).on('submit', '#addKanbanCardForm', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $form = $(this);
        var formData = {
            user_id: $form.find('input[name="user_id"]').val(),
            section: $form.find('select[name="section"]').val(),
            card_type: $form.find('input[name="card_type"]').val() || '#4a90d9',
            title: $form.find('input[name="title"]').val(),
            description_type: $form.find('#descriptionTypeSelect').val() || 'text',
            tag: $form.find('input[name="tag"]').val(),
            image_url: $form.find('input[name="image_url"]').val()
        };

        if (formData.description_type === 'list') {
            var listItems = $form.find('textarea[name="description_list"]').val()
                .split('\n')
                .filter(function(item) { return item.trim(); });
            formData.description = JSON.stringify(listItems);
        } else {
            formData.description = $form.find('textarea[name="description"]').val();
        }

        var $btn = $form.find('button[type="submit"]');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Adding...');

        $.ajax({
            url: '<?= base_url("Users/add_kanban_card") ?>',
            type: 'POST',
            data: formData,
            success: function(responseRaw) {
                $btn.prop('disabled', false).html('Add Card');

                var response;
                try {
                    response = (typeof responseRaw === 'string') ? JSON.parse(responseRaw) : responseRaw;
                } catch(e) {
                    try {
                        var m = responseRaw.match(/\{[^{}]*"success"\s*:\s*true[^{}]*\}/);
                        if (m) response = JSON.parse(m[0]);
                    } catch(e2) {}
                }

                if (response && response.success) {
                    // Reset form
                    $form[0].reset();
                    $form.find('#descriptionTypeSelect').val('text').trigger('change');
                    $('#add_card_color').val('#4a90d9');
                    $('#add_card_type').val('#4a90d9');
                    $('#add_card_color_hex').text('#4a90d9');

                    // Close modal - use unified helper
                    hideModal('addKanbanCardModal');

                    // Reload board
                    reloadKanbanBoard(formData.user_id);

                    Swal.fire({
                        title: 'Success!',
                        text: 'Card added successfully',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    var errMsg = (response && response.message) ? response.message : 'Failed to add card';
                    Swal.fire({
                        title: 'Error!',
                        text: errMsg,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                $btn.prop('disabled', false).html('Add Card');

                // Check if the card was actually saved despite the error
                // (common with CI returning HTML mixed with JSON)
                var responseText = xhr.responseText || '';
                var wasSuccessful = false;
                
                try {
                    // Try to extract JSON from response even if it has extra content
                    var jsonMatch = responseText.match(/\{[^{}]*"success"\s*:\s*true[^{}]*\}/);
                    if (jsonMatch) {
                        wasSuccessful = true;
                    }
                } catch(e) {}

                if (wasSuccessful) {
                    // Card was saved but response wasn't clean JSON
                    $form[0].reset();
                    $form.find('#descriptionTypeSelect').val('text').trigger('change');
                    $('#add_card_color').val('#4a90d9');
                    $('#add_card_type').val('#4a90d9');
                    $('#add_card_color_hex').text('#4a90d9');

                    hideModal('addKanbanCardModal');

                    reloadKanbanBoard(formData.user_id);

                    Swal.fire({
                        title: 'Success!',
                        text: 'Card added successfully',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    var msg = 'Could not add card. ';
                    if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
                        msg += xhr.responseJSON.message;
                    } else {
                        msg += 'Please try again.';
                    }

                    Swal.fire({
                        title: 'Error!',
                        text: msg,
                        icon: 'error'
                    });
                }
            }
        });

        return false;
    });
    
    // Edit Kanban Card - description type toggle for edit modal
    $('#edit_descriptionTypeSelect').on('change', function() {
        if($(this).val() == 'list') {
            $('#edit_textDescriptionGroup').hide();
            $('#edit_listDescriptionGroup').show();
        } else {
            $('#edit_textDescriptionGroup').show();
            $('#edit_listDescriptionGroup').hide();
        }
    });
    
    // Card type change - show/hide image URL for edit modal
    // Edit Kanban Card
    $(document).on('click', '.edit-kanban-card', function() {
        var cardId = $(this).data('card-id');
        var $card = $(this).closest('.kanban-card');
        var $cardContent = $card.find('.card-sm, .pink-box-card, .green-box-card, .purple-box-card, .bg-black, .green-bg, .card-sm-img').first();
        
        // Get current section from parent column
        var $column = $card.closest('.kanban-column');
        var currentSection = $column.data('section');
        
        // Card type/color: from data-card-type (hex or legacy class)
        var cardType = $cardContent.attr('data-card-type') || $cardContent.data('card-type') || '#4a90d9';
        
        var title = $cardContent.find('h6').first().text().trim() || '';
        var tag = $cardContent.find('.highlight-tag').text().trim() || '';
        
        // Get description
        var description = '';
        var descriptionType = 'text';
        if($cardContent.find('ul').length > 0) {
            descriptionType = 'list';
            var listItems = [];
            $cardContent.find('ul li').each(function() {
                listItems.push($(this).text().trim());
            });
            description = listItems.join('\n');
        } else {
            description = $cardContent.find('p').text().trim() || '';
        }
        
        // Populate edit modal
        $('#edit_card_id').val(cardId);
        $('#edit_section').val(currentSection);
        // Color picker: if cardType is hex use it, else default
        var isHex = /^#[0-9A-Fa-f]{6}$/.test(cardType);
        var editColor = isHex ? cardType : '#4a90d9';
        $('#edit_card_color').val(editColor);
        $('#edit_card_type').val(editColor);
        $('#edit_card_color_hex').text(editColor);
        $('#edit_title').val(title);
        $('#edit_tag').val(tag);
        $('#edit_descriptionTypeSelect').val(descriptionType);
        
        if(descriptionType == 'list') {
            $('#edit_textDescriptionGroup').hide();
            $('#edit_listDescriptionGroup').show();
            $('#edit_description_list').val(description);
        } else {
            $('#edit_textDescriptionGroup').show();
            $('#edit_listDescriptionGroup').hide();
            $('#edit_description').val(description);
        }
        
        showModal('editKanbanCardModal');
    });
    
    // Update Kanban Card
    $('#editKanbanCardForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var cardId = $('#edit_card_id').val();
        var formData = {
            card_id: cardId,
            section: $('#edit_section').val(),
            card_type: $('#edit_card_type').val() || '#4a90d9',
            title: $('#edit_title').val(),
            description_type: $('#edit_descriptionTypeSelect').val(),
            tag: $('#edit_tag').val(),
            image_url: ''
        };
        
        if($('#edit_descriptionTypeSelect').val() == 'list') {
            var listItems = $('#edit_description_list').val().split('\n').filter(item => item.trim());
            formData.description = JSON.stringify(listItems);
        } else {
            formData.description = $('#edit_description').val();
        }
        
        $.ajax({
            url: '<?= base_url("Users/update_kanban_card") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var uid = $('input[name="user_id"]').first().val();
                    reloadKanbanBoard(uid);
                    hideModal('editKanbanCardModal');
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Card updated successfully',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update card',
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred',
                    icon: 'error'
                });
            }
        });
    });
    
    // Delete Kanban Card
    $(document).on('click', '.delete-kanban-card', function() {
        var cardId = $(this).data('card-id');
        var $card = $(this).closest('.kanban-card');
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the card',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("Users/delete_kanban_card") ?>',
                    type: 'POST',
                    data: { card_id: cardId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Get user_id from hidden input
                            var userId = $('input[name="user_id"]').first().val();
                            
                            // Reload kanban board
                            reloadKanbanBoard(userId);
                            
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Card deleted successfully',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Failed to delete card',
                                icon: 'error'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
    
    // Drag and Drop functionality
    let draggedCard = null;
    let draggedCardOrder = null;
    
    $(document).on('dragstart', '.kanban-card', function(e) {
        draggedCard = $(this);
        draggedCardOrder = $(this).index();
        $(this).addClass('dragging');
        e.originalEvent.dataTransfer.effectAllowed = 'move';
    });
    
    $(document).on('dragend', '.kanban-card', function() {
        $(this).removeClass('dragging');
        draggedCard = null;
        draggedCardOrder = null;
    });
    
    $(document).on('dragover', '.kanban-column', function(e) {
        e.preventDefault();
        e.originalEvent.dataTransfer.dropEffect = 'move';
        $(this).addClass('drag-over');
    });
    
    $(document).on('dragleave', '.kanban-column', function() {
        $(this).removeClass('drag-over');
    });
    
    $(document).on('drop', '.kanban-column', function(e) {
        e.preventDefault();
        $(this).removeClass('drag-over');
        
        if (!draggedCard) return;
        
        var newSection = $(this).data('section');
        var cardId = draggedCard.data('card-id');
        var newOrder = $(this).children('.kanban-card').length;
        
        // Move card visually
        draggedCard.detach().appendTo($(this));
        
        // Update order for all cards in new section
        $(this).find('.kanban-card').each(function(index) {
            $(this).data('order', index);
        });
        
        // Update in database
        $.ajax({
            url: '<?= base_url("Users/update_kanban_card_order") ?>',
            type: 'POST',
            data: {
                card_id: cardId,
                section: newSection,
                display_order: newOrder
            },
            dataType: 'json',
            success: function(response) {
                if (!response.success) {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Failed to update card position',
                        icon: 'error'
                    });
                    location.reload();
                } else {
                    // Reload from server so stage timestamp appears immediately.
                    // This is needed because drag/drop only moves existing DOM nodes.
                    reloadKanbanBoard(userId);
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update card position',
                    icon: 'error'
                });
                location.reload();
            }
        });
    });
    
    // Add CSS for drag and drop
    $('<style>').prop('type', 'text/css').html(`
        .kanban-card.dragging {
            opacity: 0.5;
        }
        .kanban-column.drag-over {
            background-color: #f0f0f0;
            border: 2px dashed #007bff;
        }
        .kanban-card {
            transition: all 0.2s ease;
        }
        .kanban-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    `).appendTo('head');
});
</script>