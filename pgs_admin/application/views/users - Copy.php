<?php  include('header.php') ?>

<style>
.card,
.card-body,
.container-fluid,
.main-content {
  overflow: visible !important;  /* allow modal to escape */
}

.modal-backdrop {
  z-index: 99998 !important;
}
.modal {
  z-index: 99999 !important;
  position: fixed !important;  /* make sure modal is fixed to viewport */
  top: 0;
  left: 0;
}
</style>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Users</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> View Users</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <!-- <h4 class="card-title">View Users</h4> -->
                                      
                                    <!-- <form class="form-inline" action="<?= base_url('Enquiries/enquiry_view') ?>" method="post">
                                      <div class="row">

                                                <div class="col-md-6 mt-3 mb-3">                    
                                                    <div class="mb-6 row">
                                                      <div class="col-md-4">
                                                        <label class="col-md-12 col-form-label">Select Category</label>
                                                        <div class="col-md-12">
                                                            <select class="form-select" name="cat_id" id="categorySelect" >
                                                              <option value="">Select Category</option>
                                                                <?php
                                                                  if ($cate && count($cate) > 0) {
                                                                    foreach ($cate as $cat) {  ?>
                                                                     <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                                <?php }  }  ?>
                                                            </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                      <label class="col-md-12 col-form-label">Start Date</label>
                                                      <div class="col-md-12">
                                                            <input type="date" class="form-control" name='sdate'>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                      <label class="col-md-12 col-form-label">End Date</label>
                                                      <div class="col-md-12">
                                                            <input type="date" class="form-control" name="edate">
  
                                                      </div>
                                                    </div>
                                                </div>
                                                
                                         </div> 
    
                                        <div class="col-md-3 mt-5 mb-3">
                                            <div class="mt-2 mb-3 row">
                                            <input type="submit" class="btn btn-primary col-md-3   " name="sbmt" value="Submit">&nbsp
                                             <button  class="btn btn-danger col-md-3   " name="sbmt"  value="submit"><a href="<?= base_url('Enquiries/enquiry_view') ?>" style="color:white;">Reset</a></button>
                                         </div>
                                     </div>
                                    </form> -->
                                        <!-- Your table -->
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>    
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Country of Citizenship</th>
                                                    <th>Create Date</th>
                                                    <th>View Details</th>
                                                </tr>
                                            </thead>
                                            <tbody style="background-color:black;color:white;">
                                                <?php if(isset($product) && count($product) > 0){ foreach($product as $row){ ?>     
                                                <tr class="bg-info">
                                                    <td><?= $row->name; ?></td>
                                                    <td><?= $row->email; ?></td>
                                                    <td><?= $row->dial_code; ?> <?= $row->number; ?>
                                                    <td><?= $row->country_name; ?></td>
                                                    <!-- <td>
                                                        <?php 
                                                            $fullText = strip_tags($row->message);
                                                            $shortenedText = substr($fullText, 0, 15);
                                                            echo $shortenedText;
                                        
                                                            if (strlen($fullText) > 15) {
                                                                echo " ...<br>";
                                                                ?>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#message<?= $row->id; ?>">Read More</a>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td> -->
                                                    <td><?= !empty($row->created_at) ? date('d/m/Y', strtotime($row->created_at)) : ''; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-outline-success btn-sm edit" href="<?= base_url('Users/user_details/').$row->id ?>" title="Details">
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>

        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        
                        <!-- <?php foreach($product as $row){ ?>
                        <div class="modal fade" id="message<?= $row->id; ?>" tabindex="-1" aria-labelledby="messageLabel<?= $row->id; ?>" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="messageLabel<?= $row->id; ?>">Message</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <textarea class="form-control" rows="8" readonly><?= strip_tags($row->message); ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php } ?> -->

                    
                        
        <div class="rightbar-overlay"></div>

   <?php  $this->load->view('footer'); ?>
   
         
















