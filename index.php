<?php
session_start();
require_once "db.php";
require_once "php/table.php";
?>

<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2a31f79a6d.js" crossorigin="anonymous"></script>

    <title>Menu</title>
</head>
<body>

<!-- Navbar -->
<header class="header">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="container-fluid">
    <a class="navbar-brand ps-5" href="#">NABALU <span class ="text-warning">FOOD</span></a>

    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item pe-5">
          <a class="nav-link text-dark position-relative" href="#">
              <i class="fas fa-utensils fa-lg"></i>
              <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </a>
        </li>
    </ul>
  </div>
</nav>
</header>
<!-- End of Navbar -->

<!-- Checkboxes --> 

<div class="container pt-4 px-md-5 px-sm-4 px-5">
<h5>Categories</h5>
<form method="GET" action="">
<button type="submit">Search</button>
<?php
foreach($ctQuery as $category)
{
  $checked = [];
  if(isset($_GET['category']))
  {
    $checked = $_GET['category'];
  }
?>
<div class="form-check">
  <input class="form-check-input" type="checkbox" name="category[]" value="<?=$category['No'];?>"
    <?php if(in_array($category['No'], $checked)){echo "checked"; } ?>>
    <?=$category['Category'];?>
    
</div>
<?php
}
?>
</form>
</div>

<!-- Content -->
<div class="container">

    <div class="row pt-5 pb-2">

    <?php
    if(isset($_GET['category']))
    {
      $categorychecked = [];
      $categorychecked = $_GET['category'];
      foreach($categorychecked as $foodrow)
      {
        $foods = "SELECT * FROM food WHERE Category_No IN ($foodrow)";
        $foodsQuery = mysqli_query($conn, $foods);
        foreach($foodsQuery as $food) :
          ?>
            <div class="col-sm d-flex justify-content-center pb-3">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $food['Image'];?>" class="card-img-top" alt="" style="height: 150px;object-fit: contain;" >
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $food['food_Name'];?></h5>
                    <p class="card-text">RM<?php echo $food['food_Price'];?></p>
                    <a href="#" class="btn btn-success">Add To Cart <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
          <?php
        endforeach;
      }
    }
    else
    {
      foreach($fdQuery as $food) :
      ?>
          <div class="col-sm d-flex justify-content-center pb-3">
              <div class="card" style="width: 18rem;">
                  <img src="<?php echo $food['Image'];?>" class="card-img-top" alt="" style="height: 150px;object-fit: contain;" >
                  <div class="card-body">
                  <h5 class="card-title"><?php echo $food['food_Name'];?></h5>
                  <p class="card-text">RM<?php echo $food['food_Price'];?></p>
                  <a href="#" class="btn btn-success">Add To Cart <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
          </div>
      <?php
      endforeach;
    }
    ?>
    </div>


</div>

</body>
</html>