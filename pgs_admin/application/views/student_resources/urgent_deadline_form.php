<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?= $item ? 'Edit' : 'Add' ?> Urgent Deadline</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open(current_url()) ?>
                            <div class="mb-3">
                                <label class="form-label">Date text (e.g. July 15–31, 2025)</label>
                                <input type="text" name="date_text" class="form-control" value="<?= $item ? htmlspecialchars($item->date_text) : '' ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">What's Happening (description)</label>
                                <textarea name="description" class="form-control" rows="3" required><?= $item ? htmlspecialchars($item->description) : '' ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Display order</label>
                                <input type="number" name="display_order" class="form-control" value="<?= $item ? (int)$item->display_order : 0 ?>" />
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="<?= base_url('Student_resources/urgent_deadlines') ?>" class="btn btn-secondary">Cancel</a>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
