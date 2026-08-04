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
  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
       <a class="navbar-brand" href="#"><h3>EDIT PRODUCT</h3></a>
    </nav>

<div class="container">

  
    <h2>Edit PRODUCT</h2>


    <form method="post" enctype="multipart/form-data" action="<?php echo base_url().'index.php/users/edit/'.$user['p_id']; ?>">
  <div class="form-group">
    <label for="text">Product Name</label>
    <input type="text" class="form-control" name="p_name"  value="<?php echo set_value('p_name',$user['p_name']);?>" aria-describedby="nameHelp">
    <?php echo form_error('p_name'); ?>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
        <input type="text" class="form-control"  name="description" value="<?php echo set_value('description',$user['description']);?>" aria-describedby="nameHelp">
   <?php echo form_error('description'); ?>
  </div>
<div class="form-group">
    <label for="text">Image</label>
    <input type="file" class="form-control" id="image" name="image" value="<?php echo set_value('image',$user['image']);?>" aria-describedby="nameHelp" >
        
  </div>


  <div class="form-group">
    <label for="text">Price</label>
    <input type="text" class="form-control" id="price" value="<?php echo set_value('Price',$user['Price']);?>"  name="price"  aria-describedby="nameHelp">
    <?php echo form_error('price'); ?>
      
  </div>
  
  <input type="submit" name="submit" class="btn btn-primary" value="Update Product"/>
  <a href="<?php echo base_url().'index.php/users/product';?>" class="btn btn-primary">Cancel</a>
</form>



</div>    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>