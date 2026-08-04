
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
    <!-- <h4><a href="#" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Create Product+</a></h4> -->



<div class="container">
  <div class="welcome">Welcome</div>
  <h4><a href="<?php echo base_url().'index.php/users/create_product';?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Create Product+</a></h4>
  

 <a href="<?php echo base_url().'index.php/Users/logout' ?>" class="nav-link mininav-toggle"><i class="demo-pli-unlock fs-5 me-2"></i>
<span class="nav-label mininav-content ms-1">Logout</span></a>


        
  <div class="row row-cols-1 row-cols-md-3">
    <?php foreach($users as $user): ?>
      <form method="post" action="<?= base_url('index.php/users/add_cart') ?>"  class="">

  <div class="col mb-4">
    <div class="card h-100">
      <img src="<?= base_url("assets/images/").$user['image']; ?>" height="200px" width="100px" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $user['p_name'] ?></h5>
        <input type="hidden" name="p_id" value="<?php echo $user['p_id'] ?>">
        
        <p class="card-text"><?php echo $user['description'] ?></p>
        <p class="card-text"><b>Price -  </b><?php echo $user['Price'] ?></p>
        <td><a href="<?php echo base_url().'index.php/users/edit/'.$user['p_id']?>" class="btn btn-primary">Edit.</a>
      </td>
        <td><a href="<?php echo base_url().'index.php/users/delete/'.$user['p_id']?>" class="btn btn-danger">Delete</a>
      </td>
        <input type="hidden" name="u_id" value="<?php echo $this->session->u_id ?>">
      </div>

<!--       <div class="col mb-6">
        <input type="number" id="quantity" name="quantity" required><br>
              <input type="number" id="quantity" class="input-text" name="quantity" title="quantity" size="4" inputmode="numeric">      
      <button type="submit" class="">Add to Cart</button></div>
 -->     


    </div>
  </div>
    </form>

  <?php endforeach; ?>
  </div>
<?= $this->pagination->create_links(); ?> 
   
</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>