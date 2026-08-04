<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?= $item ? 'Edit' : 'Add' ?> Key Date</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open(current_url()) ?>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?= $item ? htmlspecialchars($item->title) : '' ?>" required />
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Day (e.g. 28th)</label>
                                    <input type="text" name="date_day" class="form-control" value="<?= $item ? htmlspecialchars($item->date_day) : '' ?>" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Month (e.g. august)</label>
                                    <input type="text" name="date_month" class="form-control" value="<?= $item ? htmlspecialchars($item->date_month) : '' ?>" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year (e.g. 2025)</label>
                                    <input type="text" name="date_year" class="form-control" value="<?= $item ? htmlspecialchars($item->date_year) : '' ?>" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Month label (for grouping: aug, sep, etc.)</label>
                                <input type="text" name="month_label" class="form-control" value="<?= $item ? htmlspecialchars($item->month_label) : '' ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link URL</label>
                                <input type="url" name="link" class="form-control" value="<?= $item ? htmlspecialchars($item->link) : '' ?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tags (e.g. #UK #Engineering #Scholarship)</label>
                                <input type="text" name="tags" class="form-control" value="<?= $item ? htmlspecialchars($item->tags) : '' ?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Display order</label>
                                <input type="number" name="display_order" class="form-control" value="<?= $item ? (int)$item->display_order : 0 ?>" />
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="<?= base_url('Student_resources/key_dates') ?>" class="btn btn-secondary">Cancel</a>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
