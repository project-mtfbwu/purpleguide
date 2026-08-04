<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">
                    <i class="mdi mdi-comment-multiple mr-2"></i>User Comments
                </h4>
                
                <?php if(isset($comments) && count($comments) > 0): ?>
                    <div class="comments-list">
                        <?php foreach($comments as $comment): ?>
                        <div class="card mb-3 comment-card" data-comment-id="<?= $comment->id ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1">
                                            <i class="mdi mdi-account-circle mr-2"></i>
                                            <?= htmlspecialchars($user->name ?? 'User') ?>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="mdi mdi-clock-outline"></i>
                                            <?= date('d M Y, h:i A', strtotime($comment->created_at)) ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="comment-text mb-3" style="padding: 10px; background: #f8f9fa; border-radius: 4px;">
                                    <?= nl2br(htmlspecialchars($comment->comment_text)) ?>
                                </div>
                                
                                <?php if(!empty($comment->admin_reply)): ?>
                                <div class="admin-reply-box mb-2" style="padding: 15px; background: #e3f2fd; border-left: 3px solid #2196F3; border-radius: 4px;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <strong style="color: #1976D2;">
                                            <i class="mdi mdi-account-tie mr-2"></i>Admin Reply:
                                        </strong>
                                        <?php if($comment->replied_at): ?>
                                        <small class="text-muted">
                                            <?= date('d M Y, h:i A', strtotime($comment->replied_at)) ?>
                                        </small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="admin-reply-text">
                                        <?= nl2br(htmlspecialchars($comment->admin_reply)) ?>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="no-reply mb-2" style="padding: 10px; background: #fff3cd; border-left: 3px solid #ffc107; border-radius: 4px;">
                                    <small class="text-muted">
                                        <i class="mdi mdi-alert-circle-outline"></i> No reply yet
                                    </small>
                                </div>
                                <?php endif; ?>
                                
                                <form class="reply-form mt-3" data-comment-id="<?= $comment->id ?>">
                                    <div class="form-group mb-2">
                                        <textarea class="form-control reply-textarea" name="reply_text" rows="3" 
                                                  placeholder="Type your reply here..." required><?= !empty($comment->admin_reply) ? htmlspecialchars($comment->admin_reply) : '' ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-send"></i> 
                                        <?= !empty($comment->admin_reply) ? 'Update Reply' : 'Send Reply' ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center">
                        <i class="mdi mdi-information" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2">No comments from this user yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
