<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">#univMeet Dates</h4>
                    </div>
                </div>
            </div>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= htmlspecialchars($this->session->flashdata('success')) ?></div>
            <?php endif; ?>
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger"><?= validation_errors() ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted mb-4">These values control the course and two date boxes shown next to <strong>#univMeet</strong> before the search box on the Student Resources page and in the sidebar.</p>
                            <?= form_open(current_url()) ?>
                            <?php
                                $selected_course_id = set_value('course_id', isset($current['course_id']) ? $current['course_id'] : '');
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="course_id" class="form-label">Course</label>
                                        <select id="course_id" name="course_id" class="form-select form-control" required>
                                            <option value="">Select Course</option>
                                            <?php if (!empty($courses)): ?>
                                                <?php foreach ($courses as $course): ?>
                                                    <option value="<?= (int) $course->id ?>" <?= ((string) $selected_course_id === (string) $course->id) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($course->product_name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slot1_date" class="form-label">First date (number)</label>
                                        <input type="text" id="slot1_date" name="slot1_date" class="form-control" value="<?= set_value('slot1_date', isset($current['slot1_date']) ? $current['slot1_date'] : '31') ?>" placeholder="e.g. 31" />
                                        <small class="text-muted">Example: <code>31</code></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slot1_month" class="form-label">First date label</label>
                                        <input type="text" id="slot1_month" name="slot1_month" class="form-control" value="<?= set_value('slot1_month', isset($current['slot1_month']) ? $current['slot1_month'] : 'Dec 25') ?>" placeholder="e.g. Dec 25" />
                                        <small class="text-muted">Example: <code>Dec 25</code></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slot2_date" class="form-label">Second date (number)</label>
                                        <input type="text" id="slot2_date" name="slot2_date" class="form-control" value="<?= set_value('slot2_date', isset($current['slot2_date']) ? $current['slot2_date'] : '31') ?>" placeholder="e.g. 31" />
                                        <small class="text-muted">Example: <code>31</code></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slot2_month" class="form-label">Second date label</label>
                                        <input type="text" id="slot2_month" name="slot2_month" class="form-control" value="<?= set_value('slot2_month', isset($current['slot2_month']) ? $current['slot2_month'] : 'Dec 25') ?>" placeholder="e.g. Dec 25" />
                                        <small class="text-muted">Example: <code>Dec 25</code></small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save details</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
