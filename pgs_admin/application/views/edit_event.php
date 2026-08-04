<?php include('header.php') ?>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
        <script>
         <?php if ($this->session->flashdata('error')) {?> 
          var isi= <?php echo json_encode ($this->session->flashdata('error')) ?> ;   
          swal({
  title: "Error",
  text: isi,
  icon: "error",
});
    <?php } ?>
</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
              <script>
         <?php if ($this->session->flashdata('success')) {?> 
          var isi= <?php echo json_encode ($this->session->flashdata('success')) ?> ;   
          swal({
  title: "Success",
  text: isi,
  icon: "success",
});
    <?php } ?>
</script> 
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Event Details</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Event Details</li>
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
                                            <h4 class="card-title m-0"></h4>
                                            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                        </div>
                                            <form action="<?= base_url('Event/edit_event_data') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-3">Select Category*</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-control" name="cat_id" id="categorySelect" required>
                                                              <option value="">Select Category</option>
                                                                <?php
                                                                if ($cate && count($cate) > 0) {
                                                                    foreach ($cate as $cat) {  
                                                                ?>
                                                                    <option value="<?= $cat->id ?>" 
                                                                        <?= ($product->cat_id == $cat->id) ? 'selected' : '' ?>>
                                                                        <?= $cat->category_name ?>
                                                                    </option>
                                                                <?php 
                                                                    }  
                                                                }  
                                                                ?>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Event title</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="<?php echo  $product->product_name; ?>" id="example-text-input" name="prod_name"required>
                                                            <input class="form-control" type="hidden" value="<?php echo  $product->id; ?>" name="id">
                                                            <input type="hidden" name="event_id" value="<?= (int) ($product->id ?? 0) ?>">
                                                        </div>
                                                      </div>
                                                    </div>                                                                                                     
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Event sub title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" value="<?php echo  $product->prod_sub_name; ?>" name="prod_sub_name"required>
                                                        </div>
                                                      </div>
                                                    </div> 
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="col-md-3">Upload Event Image</label>
                                                            <div class="col-md-9">
                                                                <input type="hidden" name="existing_image1" value="<?= htmlspecialchars((string)($product->image1 ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                                                                <input class="form-control" type="file" value="<?= $product->image1; ?>"  name="prod_image1">
                                                                <img src="<?php $img = $product->image1? $product->image1:'doc-thumb-2.jpg' ; echo base_url('assets/images/').$img ?>" style="width:100px; height: 70px;" class="mt-2">
                                                            </div>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Start Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" value="<?php echo  $product->s_date; ?>" name="s_date"required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">End Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" value="<?php echo  $product->e_date; ?>" name="e_date"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Event Description*</h4>
                                                            <textarea name="description" id="myTextarea" class="form-control" required><?= $product->description ?></textarea>

                                                        </div>
                                                    </div>
                                                    </div>                                               
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Mode</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="<?= htmlspecialchars($product->mode ?? '') ?>" name="mode" required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Host</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="host" value="<?= htmlspecialchars($product->host ?? '') ?>" placeholder="e.g. #teamPGS">
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Top label</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="top_label" value="<?= htmlspecialchars($product->top_label ?? '') ?>" placeholder="e.g. Filling Fast">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Badge</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="badge" value="<?= htmlspecialchars($product->badge ?? '') ?>" placeholder="e.g. #inCampus">
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Author name</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="author_name" value="<?= htmlspecialchars($product->author_name ?? '') ?>">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Tags</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="tags" value="<?= htmlspecialchars($product->tags ?? '') ?>" placeholder="e.g. #UK #AUS">
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">Author bio</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="author_bio" rows="2"><?= htmlspecialchars($product->author_bio ?? '') ?></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">Who's It For?</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="who_is_it_for" rows="3"><?= htmlspecialchars($product->who_is_it_for ?? '') ?></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">Session topics</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="session_topics" rows="3"><?= htmlspecialchars($product->session_topics ?? '') ?></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">What We'll Cover in This Session</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="what_we_cover" rows="4" placeholder="One point per line"><?= htmlspecialchars($product->what_we_cover ?? '') ?></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Book URL</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="url" name="book_url" value="<?= htmlspecialchars($product->book_url ?? '') ?>">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Location note</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="location_note" value="<?= htmlspecialchars($product->location_note ?? '') ?>">
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4 mb-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5 class="mb-0">Facilitators</h5>
                                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addFacilitatorModal">
                                                            Add facilitator
                                                        </button>
                                                    </div>

                                                    <div class="table-responsive mt-3">
                                                        <?php if (empty($facilitators)): ?>
                                                            <div class="text-muted">No facilitators yet.</div>
                                                        <?php else: ?>
                                                            <table class="table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:80px">Image</th>
                                                                        <th>Name</th>
                                                                        <th>Position</th>
                                                                        <th>Details</th>
                                                                        <th style="width:90px">Order</th>
                                                                        <th style="width:160px">Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($facilitators as $f): ?>
                                                                        <tr>
                                                                            <td class="align-middle text-center">
                                                                                <?php if (!empty($f->image)): ?>
                                                                                    <img src="<?= base_url('assets/images/' . $f->image) ?>" alt="" style="max-height:50px; max-width:50px; object-fit:cover;">
                                                                                <?php else: ?>
                                                                                    <span class="text-muted">—</span>
                                                                                <?php endif; ?>
                                                                            </td>
                                                                            <td class="align-middle"><?= htmlspecialchars($f->name ?? '') ?></td>
                                                                            <td class="align-middle"><?= htmlspecialchars($f->position ?? '') ?></td>
                                                                            <td class="align-middle">
                                                                                <?= htmlspecialchars(strlen($f->details ?? '') > 80 ? substr($f->details ?? '', 0, 80) . '…' : ($f->details ?? '')) ?>
                                                                            </td>
                                                                            <td class="align-middle"><?= (int)($f->sort_order ?? 0) ?></td>
                                                                            <td class="align-middle">
                                                                                <a href="<?= base_url('Event/edit_facilitator/' . (int)$product->id . '/' . (int)$f->id) ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                                                                    Edit
                                                                                </a>
                                                                                <a href="<?= base_url('Event/delete_facilitator/' . (int)$product->id . '/' . (int)$f->id) ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this facilitator?');">
                                                                                    Delete
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <?php $website_base = rtrim((string) $this->config->item('website_base_url'), '/'); if ($website_base === '') $website_base = 'http://127.0.0.1:8002'; ?>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-outline-secondary"
                                                        formaction="<?= htmlspecialchars($website_base . '/preview/event') ?>"
                                                        formtarget="_blank"
                                                    >
                                                        Preview
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>

                                            <!-- Add Facilitator Modal (stays on this page) -->
                                            <div class="modal fade" id="addFacilitatorModal" tabindex="-1" role="dialog" aria-labelledby="addFacilitatorModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addFacilitatorModalLabel">Add Facilitator</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?= base_url('Event/save_facilitator') ?>" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="event_id" value="<?= (int)($product->id ?? 0) ?>">
                                                                <input type="hidden" name="redirect_to" value="<?= base_url('Event/edit_event/' . (int)($product->id ?? 0)) ?>">

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                            <input type="text" name="name" class="form-control" required placeholder="e.g. Anjay Nilmek">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Position</label>
                                                                            <input type="text" name="position" class="form-control" placeholder="e.g. Counsellor & student strategist">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Details / Bio</label>
                                                                    <textarea name="details" class="form-control" rows="3" placeholder="Short bio or description"></textarea>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Image</label>
                                                                            <input type="file" name="facilitator_image" class="form-control" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Sort order</label>
                                                                            <input type="number" name="sort_order" class="form-control" value="<?= !empty($facilitators) ? count($facilitators) : 0 ?>" min="0">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex justify-content-end">
                                                                    <button type="button" class="btn btn-secondary me-2" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save Facilitator</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2015 - 2020 &copy; Velonic theme by <a href="">Coderthemes</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>

        <!--tinymce js-->
        <script src="<?= base_url('assets/libs/tinymce/tinymce.min.js')?>"></script>
<script>
tinymce.init({
    selector: '#myTextarea',
    height: 250,
    plugins: 'autolink lists link image charmap print preview',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image|color'
});
</script>


        <?php include('footer.php') ?>