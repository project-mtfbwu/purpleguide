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
                        <h4 class="page-title">Add Program</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('Cv_programs') ?>">Programs</a></li>
                                <li class="breadcrumb-item active">Add</li>
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
                                <h4 class="card-title m-0">New Program Card</h4>
                                <a href="<?= base_url('Cv_programs') ?>" class="btn btn-secondary">Back</a>
                            </div>
                            <form action="<?= base_url('Cv_programs/add_save') ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="e.g. SOP GUIDANCE PROGRAM" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short description</label>
                                    <textarea class="form-control" name="short_description" rows="2" placeholder="Build a top-tier SOP in 3 days..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Who is it for?</label>
                                    <textarea class="form-control" name="who_is_it_for" rows="3" placeholder="e.g. Medical students, MBBS grads..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Session topics (one per line or comma-separated)</label>
                                    <textarea class="form-control" name="session_topics" rows="3" placeholder="Topic 1&#10;Topic 2"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Program highlights (4 points)</label>
                                    <input type="text" class="form-control mb-2" name="highlight_1" placeholder="Highlight 1">
                                    <input type="text" class="form-control mb-2" name="highlight_2" placeholder="Highlight 2">
                                    <input type="text" class="form-control mb-2" name="highlight_3" placeholder="Highlight 3">
                                    <input type="text" class="form-control mb-2" name="highlight_4" placeholder="Highlight 4">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Brochure (PDF or document)</label>
                                    <input type="file" class="form-control" name="brochure" accept=".pdf,.doc,.docx,image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">QR code (image)</label>
                                    <input type="file" class="form-control" name="qr_code" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tags (comma or space separated, e.g. #TEAMPGS #all)</label>
                                    <input type="text" class="form-control" name="tags" placeholder="#TEAMPGS #all">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Top label (e.g. Last 10 Spots)</label>
                                        <input type="text" class="form-control" name="top_label" placeholder="Last 10 Spots">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Badge text (e.g. Start Free)</label>
                                        <input type="text" class="form-control" name="badge_text" placeholder="Start Free">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Learn more URL</label>
                                        <input type="text" class="form-control" name="learn_more_url" placeholder="https://...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Close date text (e.g. Closes On June 30)</label>
                                        <input type="text" class="form-control" name="close_date_text" placeholder="Closes On June 30">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="most_wanted" id="most_wanted" value="1">
                                        <label class="form-check-label" for="most_wanted">Most wanted program</label>
                                    </div>
                                    <small class="text-muted">Off by default; check to highlight this program as most wanted.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Display order</label>
                                    <input type="number" class="form-control" name="display_order" value="0">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Program</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
