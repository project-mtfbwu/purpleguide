<?php
$alerts_max = isset($important_alerts_max) ? (int) $important_alerts_max : 3;
$alerts_max_words = isset($important_alerts_max_words) ? (int) $important_alerts_max_words : 12;
$alerts = isset($important_alerts) ? $important_alerts : [];
$alerts_full = count($alerts) >= $alerts_max;
?>
<div class="row">
    <!-- Important Alerts Section -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-1">
                    <i class="mdi mdi-bell-ring mr-2"></i>Important Alerts
                </h4>
                <p class="text-muted mb-3">
                    Shown in the yellow alert box on the user's progress board.
                    Maximum <?= $alerts_max ?> alerts, <?= $alerts_max_words ?> words each.
                </p>

                <div class="mb-3">
                    <form id="addImportantAlertForm"
                          data-max="<?= $alerts_max ?>"
                          data-max-words="<?= $alerts_max_words ?>">
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <div class="form-group">
                            <textarea class="form-control" name="alert_text" id="importantAlertText" rows="2"
                                      placeholder="Enter alert (e.g. LOR is pending)" required
                                      <?= $alerts_full ? 'disabled' : '' ?>></textarea>
                            <small class="text-muted">
                                <span id="importantAlertWordCount">0</span>/<?= $alerts_max_words ?> words
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-2" id="addImportantAlertBtn"
                                <?= $alerts_full ? 'disabled' : '' ?>>
                            <i class="mdi mdi-plus"></i> Add Alert
                        </button>
                        <span id="importantAlertsLimitMsg" class="text-danger ml-2 <?= $alerts_full ? '' : 'd-none' ?>">
                            Limit of <?= $alerts_max ?> alerts reached. Delete one to add another.
                        </span>
                    </form>
                </div>

                <div id="importantAlertsList">
                    <?php if (count($alerts) > 0): ?>
                        <?php foreach ($alerts as $alert): ?>
                        <div class="card mb-2 important-alert-item" data-alert-id="<?= $alert->id ?>">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="text" class="form-control form-control-sm important-alert-text"
                                           value="<?= htmlspecialchars($alert->alert_text) ?>"
                                           data-alert-id="<?= $alert->id ?>"
                                           style="flex: 1;">
                                    <button type="button" class="btn btn-danger btn-sm delete-important-alert"
                                            data-alert-id="<?= $alert->id ?>">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info" id="importantAlertsEmpty">
                            <i class="mdi mdi-information"></i> No important alerts yet. Add one above.
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <strong>Alerts Used: <span id="importantAlertsCount"><?= count($alerts) ?></span>/<?= $alerts_max ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Queue Section -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">
                    <i class="mdi mdi-clipboard-check mr-2"></i>Review Queue
                </h4>
                
                <div class="mb-3">
                    <form id="addReviewQueueItemForm">
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <div class="form-group">
                            <textarea class="form-control" name="item_text" rows="2" 
                                      placeholder="Enter review queue item..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                            <i class="mdi mdi-plus"></i> Add Item
                        </button>
                    </form>
                </div>
                
                <div id="reviewQueueItemsList">
                    <?php if(isset($review_queue_items) && count($review_queue_items) > 0): ?>
                        <?php foreach($review_queue_items as $item): ?>
                        <div class="card mb-2 review-queue-item" data-item-id="<?= $item->id ?>">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input review-checkbox" 
                                               data-item-id="<?= $item->id ?>" 
                                               <?= $item->is_checked ? 'checked' : '' ?>>
                                    </div>
                                    <input type="text" class="form-control form-control-sm review-item-text" 
                                           value="<?= htmlspecialchars($item->item_text) ?>" 
                                           data-item-id="<?= $item->id ?>"
                                           style="flex: 1;">
                                    <button type="button" class="btn btn-danger btn-sm delete-review-item" 
                                            data-item-id="<?= $item->id ?>">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="mdi mdi-information"></i> No review queue items yet. Add an item above.
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-3">
                    <strong>Completed Count: <span id="reviewQueueCompletedCount">0</span></strong>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Counselor Notes Section -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">
                    <i class="mdi mdi-note-text mr-2"></i>Counselor Notes
                </h4>
                
                <div class="mb-3">
                    <form id="addCounselorNoteForm">
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <div class="form-group">
                            <textarea class="form-control" name="note_text" rows="3" 
                                      placeholder="Enter counselor note..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus"></i> Add Note
                        </button>
                    </form>
                </div>
                
                <div id="counselorNotesList" style="max-height: 500px; overflow-y: auto;">
                    <?php if(isset($counselor_notes) && count($counselor_notes) > 0): ?>
                        <?php $note_index = 1; ?>
                        <?php foreach($counselor_notes as $note): ?>
                        <div class="card mb-2 counselor-note-item" data-note-id="<?= $note->id ?>">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <img src="<?= base_url('assets/img/avatar-icon.png') ?>" 
                                             alt="Avatar" 
                                             style="width: 40px; height: 40px; border-radius: 50%;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge badge-secondary"><?= $note_index ?></span>
                                            <button type="button" class="btn btn-sm btn-outline-secondary edit-note-btn" 
                                                    data-note-id="<?= $note->id ?>"
                                                    data-note-text="<?= htmlspecialchars($note->note_text) ?>">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete-note-btn" 
                                                    data-note-id="<?= $note->id ?>">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                        <h5 class="note-text-display mb-0"><?= nl2br(htmlspecialchars($note->note_text)) ?></h5>
                                        <textarea class="form-control note-text-edit d-none" rows="3"><?= htmlspecialchars($note->note_text) ?></textarea>
                                        <small class="text-muted d-block mt-2">
                                            <i class="mdi mdi-clock-outline"></i>
                                            <?= date('d M Y, h:i A', strtotime($note->created_at)) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $note_index++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="mdi mdi-information"></i> No counselor notes yet. Add a note above.
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-3">
                    <strong>Total Notes: <span id="counselorNotesCount">0</span></strong>
                </div>
            </div>
        </div>
    </div>
</div>
