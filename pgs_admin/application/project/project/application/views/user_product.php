
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
<!--   <h4><a href="<?php echo base_url().'index.php/users/create_product';?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Create Product+</a></h4>
 -->  

 <a href="<?php echo base_url().'index.php/Users/logout' ?>" class="nav-link mininav-toggle"><i class="demo-pli-unlock fs-5 me-2"></i>
<span class="nav-label mininav-content ms-1">Logout</span></a>

<a class="btn btn-primary" href="<?php echo base_url().'index.php/Users/user_dashboard' ?>" role="button">View Cart</a>

        
  <div class="row row-cols-1 row-cols-md-3">
    <?php foreach($users as $user): ?>
      <form method="post" action="<?= base_url('index.php/users/add_cart') ?>"  class="">

  <div class="col mb-4">
    <div class="card h-100">
      <img src="<?= base_url("assets"); ?>" height="200px" width="100px" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $user['p_name'] ?></h5>
        <input type="hidden" name="p_id" value="<?php echo $user['p_id'] ?>">
        <input type="hidden" name="Price" value="<?php echo $user['Price'] ?>">
        
        <p class="card-text"><?php echo $user['description'] ?></p>
        <p class="card-text"><b>Price -  </b><?php echo $user['Price'] ?></p>


        <!-- <td><a href="<?php echo base_url().'index.php/users/edit/'.$user['p_id']?>" class="btn btn-primary">Edit.</a>
      </td>
        <td><a href="<?php echo base_url().'index.php/users/delete/'.$user['p_id']?>" class="btn btn-danger">Delete</a>
      </td> -->
        <input type="hidden" name="u_id" value="<?php echo $this->session->u_id ?>">
      </div>

<!--       <p class="card-text"><b>Total Price -  </b><?php echo $user['total_price'] ?></p>
      <input type="number" id="quantity" name="quantity" required><br>
 -->
      <div class="col mb-6">
        <input type="number" id="quantity" name="quantity" required><br>
        <!--       <input type="number" id="quantity" class="input-text" name="quantity" title="quantity" size="4" inputmode="numeric"> -->      
      <button type="submit" class="">Add to Cart</button></div>
     


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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>