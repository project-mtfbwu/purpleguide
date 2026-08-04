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
                                            <form action="<?= base_url('Event/add_event_data') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-3">Select Category*</label>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-control" name="cat_id" id="categorySelect" required>
                                                              <option value="">Select Category</option>
                                                                <?php
                                                                  if ($cate && count($cate) > 0) {
                                                                    foreach ($cate as $cat) {  ?>
                                                                     <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                                <?php }  }  ?>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Event title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="prod_name"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Event sub title*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="prod_sub_name"required>
                                                        </div>
                                                      </div>
                                                    </div>                         
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="col-md-3">Upload Event Image*</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" type="file" name="banner_image" required>
                                                            </div>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Start Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" name="s_date"required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                      <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">End Date*</spam> </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="datetime-local" id="example-text-input" name="e_date"required>
                                                        </div>
                                                      </div>
                                                    </div>                                                 
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Event Description*</h4>
                                                            <textarea name="pro_desc" id="myTextarea" class="form-control" ></textarea>
                                                        </div>
                                                    </div>
                                                    </div>                                               
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label for="example-text-input" class="col-md-3 col-form-label">Mode</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="example-text-input" name="mode" placeholder="e.g. Online / In-person" required>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Host</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="host" placeholder="e.g. #teamPGS">
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Top label</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="top_label" placeholder="e.g. Filling Fast">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Badge</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="badge" placeholder="e.g. #inCampus">
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-2">Tags</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" type="text" name="tags" placeholder="e.g. #UK #AUS">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-2 col-form-label">Facilitators</label>
                                                            <div class="col-md-10">
                                                                <p class="text-muted mb-2">Add facilitators for this event. The first facilitator auto-fills event author fields.</p>

                                                                <div id="facilitators-container">
                                                                    <div class="facilitator-block mb-3 p-3 border rounded">
                                                                        <div class="row">
                                                                            <div class="col-6 form-group">
                                                                                <div class="mb-3 row">
                                                                                    <label class="col-md-3 col-form-label">Name</label>
                                                                                    <div class="col-md-9">
                                                                                        <input class="form-control" type="text" name="facilitator_name[]" placeholder="e.g. Anjay Nilmek" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6 form-group">
                                                                                <div class="mb-3 row">
                                                                                    <label class="col-md-3 col-form-label">Position</label>
                                                                                    <div class="col-md-9">
                                                                                        <input class="form-control" type="text" name="facilitator_position[]" placeholder="e.g. Counsellor & student strategist">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-12 form-group">
                                                                                <div class="mb-3 row">
                                                                                    <label class="col-md-2 col-form-label">Details / Bio</label>
                                                                                    <div class="col-md-10">
                                                                                        <textarea name="facilitator_details[]" class="form-control" rows="2" placeholder="Short bio or description"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-6 form-group">
                                                                                <div class="mb-3 row">
                                                                                    <label class="col-md-3 col-form-label">Image</label>
                                                                                    <div class="col-md-9">
                                                                                        <input type="file" name="facilitator_image[]" class="form-control" accept="image/*">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6 form-group">
                                                                                <div class="mb-3 row">
                                                                                    <label class="col-md-3 col-form-label">Sort order</label>
                                                                                    <div class="col-md-9">
                                                                                        <input type="number" name="facilitator_sort_order[]" class="form-control" value="0" min="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <button type="button" id="add-facilitator-btn" class="btn btn-outline-primary btn-sm">Add another facilitator</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    (function () {
                                                        var addBtn = document.getElementById('add-facilitator-btn');
                                                        var container = document.getElementById('facilitators-container');
                                                        if (!addBtn || !container) return;

                                                        addBtn.addEventListener('click', function () {
                                                            var blocks = container.getElementsByClassName('facilitator-block');
                                                            if (!blocks.length) return;

                                                            var clone = blocks[0].cloneNode(true);

                                                            // Clear input/textarea values in the cloned block
                                                            var inputs = clone.querySelectorAll('input');
                                                            inputs.forEach(function (inp) {
                                                                if (inp.type === 'file') {
                                                                    inp.value = '';
                                                                } else {
                                                                    inp.value = '';
                                                                }
                                                            });
                                                            var textareas = clone.querySelectorAll('textarea');
                                                            textareas.forEach(function (t) { t.value = ''; });

                                                            // Remove required attribute from the cloned name field
                                                            var nameInput = clone.querySelector('input[name="facilitator_name[]"]');
                                                            if (nameInput) nameInput.required = false;

                                                            // Default sort order to next index
                                                            var sortInput = clone.querySelector('input[name="facilitator_sort_order[]"]');
                                                            if (sortInput) sortInput.value = blocks.length;

                                                            container.appendChild(clone);
                                                        });
                                                    })();
                                                </script>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">Who's It For?</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="who_is_it_for" rows="3" placeholder="Who's It For section text"></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">Session topics</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="session_topics" rows="3" placeholder="One topic per line"></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-12 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-2">What We'll Cover in This Session</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="what_we_cover" rows="4" placeholder="One point per line (shown as numbered list on the event page)"></textarea>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="row" form-group>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Book URL</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="url" name="book_url" placeholder="Book Your Seat / Learn More link">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="mb-3 row">
                                                        <label class="col-md-3">Location note</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="location_note" placeholder="e.g. Live on Zoom | You'll get the link after signing up">
                                                        </div>
                                                      </div>
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
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                            </form>
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