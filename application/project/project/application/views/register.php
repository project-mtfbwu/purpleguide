<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container">
    <?php 
    $msg = $this->session->flashdata('msg');
    if($msg != "") {
        echo "<div class='alert alert-success'>$msg</div>";
    }
     ?>
    <h1>Register Here</h1>
    <p>Please Fill Your Details</p>

    <form method="post" name="registerForm" id="registerForm" action="<?php base_url().'index.php/project/register' ?>">
  <div class="form-group">
    <label for="name">First Name</label>
    <input type="text" name="first_name" id="first_name" class="form-control"  placeholder="First_name" value="<?php echo set_value('first_name')?>" >
  </div>
  <?php echo form_error('first_name'); ?>
  <div class="form-group">
    <label for="name">Last Name</label>
    <input type="text" name="last_name" id="last_name" class="form-control"  placeholder="Last_name" value="<?php echo set_value('last_name')?>">
  </div>
  <?php echo form_error('last_name'); ?>
  <div class="form-group">
    <label for="name">Email</label>
    <input type="text" name="email" id="email" class="form-control"  placeholder="Email" value="<?php echo set_value('email')?>" >
  </div>
  <?php echo form_error('email'); ?>
  <div class="form-group">
    <label for="name">Phone</label>
    <input type="text" name="phone" id="phone" class="form-control"  placeholder="Phone" value="<?php echo set_value('phone')?>" >
  </div>
  <?php echo form_error('phone'); ?>
  <div class="form-group">
    <label for="name">Password</label>
    <input type="password" name="password" id="password" class="form-control"  placeholder="Password" value="<?php echo set_value('password')?>">
  </div>
  <?php echo form_error('password'); ?>
  <div class="form-group">
  <button class="btn btn-block btn-primary">Register Now</button>
  </div>
</form>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>