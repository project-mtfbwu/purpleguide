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
    <h3>Hello, world!</h3>

    <div class="container">
      <a href="<?php echo base_url().'index.php/Users/logout' ?>" class="nav-link mininav-toggle"><i class="demo-pli-unlock fs-5 me-2"></i>
<span class="nav-label mininav-content ms-1">Logout</span></a>

<?php foreach ($orderData as  $val) : ?>
      <div class="card mb-3" style="max-width: 100%;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?= base_url("assets/images/").$val['image']; ?>" height="200px" width="100px" class="card-img-top" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $val['p_name'] ?></h5>
              <h5 class="card-title">Product-id <?= $val['p_id'] ?></h5>
              
              <p class="card-text"><b>Price - <?= $val['Price'] ?></b></p>
              <p class="card-text"><b>Quantity - <?= $val['quantity'] ?></b></p>
              <p class="card-text"><b>Total Price - <?= $val['total_price'] ?></b></p>
              <p class="card-text"></p>
             
            </div>
          </div>
        </div>
      </div>
<?php endforeach; ?>
<?php foreach ($tdata as  $vall) : ?>
              <p class="card-text"><h4><b>Total Price    --     (<?= $vall['u'] ?> items) <?= $vall['t'] ?></b></h4></p>
<?php endforeach; ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>