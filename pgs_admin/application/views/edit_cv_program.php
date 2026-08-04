<?php include('header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script>
<?php if ($this->session->flashdata('error')) { ?>
    swal({ title: "Error", text: <?= json_encode($this->session->flashdata('error')) ?>, icon: "error" });
<?php } ?>
</script>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Program</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('Cv_programs') ?>">Programs</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title m-0">Edit Program</h4>
                                <a href="<?= base_url('Cv_programs') ?>" class="btn btn-secondary">Back</a>
                            </div>
                            <form action="<?= base_url('Cv_programs/edit_save') ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= (int)$program->id ?>">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($program->title) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short description</label>
                                    <textarea class="form-control" name="short_description" rows="2"><?= htmlspecialchars($program->short_description ?? '') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Who is it for?</label>
                                    <textarea class="form-control" name="who_is_it_for" rows="3"><?= htmlspecialchars($program->who_is_it_for ?? '') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Session topics</label>
                                    <textarea class="form-control" name="session_topics" rows="3"><?= htmlspecialchars($program->session_topics ?? '') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Program highlights (4 points)</label>
                                    <input type="text" class="form-control mb-2" name="highlight_1" value="<?= htmlspecialchars($program->highlight_1 ?? '') ?>" placeholder="Highlight 1">
                                    <input type="text" class="form-control mb-2" name="highlight_2" value="<?= htmlspecialchars($program->highlight_2 ?? '') ?>" placeholder="Highlight 2">
                                    <input type="text" class="form-control mb-2" name="highlight_3" value="<?= htmlspecialchars($program->highlight_3 ?? '') ?>" placeholder="Highlight 3">
                                    <input type="text" class="form-control mb-2" name="highlight_4" value="<?= htmlspecialchars($program->highlight_4 ?? '') ?>" placeholder="Highlight 4">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Brochure</label>
                                    <?php if (!empty($program->brochure)): ?>
                                        <div class="mb-2"><a href="<?= base_url('assets/images/' . $program->brochure) ?>" target="_blank" class="small">Current brochure</a>. Upload new to replace.</div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" name="brochure" accept=".pdf,.doc,.docx,image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">QR code</label>
                                    <?php if (!empty($program->qr_code)): ?>
                                        <div class="mb-2"><img src="<?= base_url('assets/images/' . $program->qr_code) ?>" alt="QR" style="max-width:80px;max-height:80px;"> Upload new to replace.</div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" name="qr_code" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <?php if (!empty($program->image)): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url('assets/images/' . $program->image) ?>" alt="" style="max-width: 80px; max-height: 80px; object-fit: contain;" onerror="this.style.display='none'">
                                            <span class="text-muted small d-block">Current image. Upload new to replace.</span>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tags</label>
                                    <input type="text" class="form-control" name="tags" value="<?= htmlspecialchars($program->tags ?? '') ?>" placeholder="#TEAMPGS #all">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Top label</label>
                                        <input type="text" class="form-control" name="top_label" value="<?= htmlspecialchars($program->top_label ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Badge text</label>
                                        <input type="text" class="form-control" name="badge_text" value="<?= htmlspecialchars($program->badge_text ?? '') ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Learn more URL</label>
                                        <input type="text" class="form-control" name="learn_more_url" value="<?= htmlspecialchars($program->learn_more_url ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Close date text</label>
                                        <input type="text" class="form-control" name="close_date_text" value="<?= htmlspecialchars($program->close_date_text ?? '') ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="most_wanted" id="most_wanted" value="1" <?= !empty($program->most_wanted) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="most_wanted">Most wanted program</label>
                                    </div>
                                    <small class="text-muted">Check to highlight this program as most wanted.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Display order</label>
                                    <input type="number" class="form-control" name="display_order" value="<?= (int)$program->display_order ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Program</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
