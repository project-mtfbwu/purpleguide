<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?= $item ? 'Edit' : 'Add' ?> Study Abroad Fact</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('Student_resources/study_abroad_facts') ?>">Study Abroad Facts</a></li>
                                <li class="breadcrumb-item active"><?= $item ? 'Edit' : 'Add' ?></li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($this->session->flashdata('error')) ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open(current_url()) ?>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-muted">(optional)</span></label>
                                <input type="text" name="title" class="form-control" value="<?= $item ? htmlspecialchars($item->title ?? '') : '' ?>" placeholder="Short headline for this slide, if needed" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fact content <span class="text-danger">*</span></label>
                                <p class="text-muted small mb-2">Use the editor for formatting, bullet lists, and multiple paragraphs or facts in one slide.</p>
                                <textarea id="fact_content_editor" name="fact_content" class="form-control" rows="12" placeholder="The fact text shown in the yellow carousel slide"><?php
                                    if ($item && isset($item->fact_content)) {
                                        echo $item->fact_content;
                                    }
                                ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Display order</label>
                                <input type="number" name="display_order" class="form-control" value="<?= $item ? (int)$item->display_order : 0 ?>" min="0" />
                                <small class="text-muted">Lower numbers appear earlier in the slider.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="<?= base_url('Student_resources/study_abroad_facts') ?>" class="btn btn-secondary">Cancel</a>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/libs/tinymce/tinymce.min.js') ?>"></script>
<script>
tinymce.init({
    selector: '#fact_content_editor',
    height: 360,
    menubar: false,
    plugins: 'autolink lists link charmap preview code',
    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link removeformat | code',
    content_style: 'body { font-family: system-ui, sans-serif; font-size: 15px; }',
    setup: function (editor) {
        editor.on('change keyup', function () { editor.save(); });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        });
    }
});
</script>
