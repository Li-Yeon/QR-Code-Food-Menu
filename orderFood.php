<?php
$serverName = "localhost";
$username = "nabalu";
$password = "T3MU6:7h+ieHt2";
$dbName = "nabalu_qr-demo";

$serverNameLocal = "localhost";
$usernameLocal = "root";
$passwordLocal = "";
$dbNameLocal = "qr-demo";

//$conn = mysqli_connect($serverName, $username, $password, $dbName);
$conn = mysqli_connect($serverNameLocal, $usernameLocal, $passwordLocal, $dbNameLocal);

// Food Query
$foodQuery = "SELECT * FROM food ORDER BY NO ASC";
$fdQuery = mysqli_query($conn, $foodQuery);

// Category Query
$categoryQuery = "SELECT * FROM category ORDER BY NO ASC";
$ctQuery = mysqli_query($conn, $categoryQuery);


require_once "php/order.php";
if(isset($_GET['tableNo']))
{
    // Cart Query
    $tableNo = $_GET['tableNo'];
    $cartQuery = "SELECT COUNT(*) AS 'TotalCart' FROM orders WHERE TableNo='$tableNo'";
    $cartSqli = mysqli_query($conn, $cartQuery);
    $totalCart = mysqli_fetch_assoc($cartSqli);
    $totalCart = $totalCart['TotalCart'];
}
else
{
  header("location:./error404.php");
}
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
          <a class="nav-link text-dark position-relative" href="cart.php?tableNo=<?php echo $_GET['tableNo']?>">
              <i class="fas fa-utensils fa-lg"></i>
              <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $totalCart?></span>
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

<?php
while($rows=mysqli_fetch_assoc($ctQuery))
{
?>
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    <?php echo $rows['Category'];?>
  </label> 
</div>
<?php
}
?>

</div>

<!-- Content -->
<div class="container">
    <div class="row pt-5 pb-2">
    <?php
    while($rows=mysqli_fetch_assoc($fdQuery))
    {
    ?>
        <div class="col-sm d-flex justify-content-center pb-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $rows['Image'];?>" class="card-img-top" alt="" style="height: 150px;" >
                <div class="card-body">
                <h5 class="card-title"><?php echo $rows['food_Name'];?></h5>
                <p class="card-text"><span class="fw-bold"><?php echo $rows['food_Code'];?></span><br>RM<?php echo $rows['food_Price'];?></p>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rows['food_Code'];?>">
                Add To Cart <i class="fas fa-arrow-circle-right"></i>
                </button>

<form action="php/order.php?orderFood=<?php echo $_GET['tableNo']?>" method="post">
<!-- Food Remarks -->
<div class="modal fade" id="exampleModal<?php echo $rows['food_Code'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <label class="form-label">E.g. Add Cheese, No Mushroom</label>
      <textarea class="form-control" rows="3" name="remarks"></textarea>
      <input type="hidden" class="form-control" name="foodCode" value="<?php echo $rows['food_Code'];?>">

      <div class="mt-2">
        <label class="form-label fw-bold">Quantity</label>
         <input type="number" class="form-control" name="qty" value = "1" style="width:15%; text-align:center;" min="1">                                   
       </div>  
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-warning" name="addToCart">Add To Cart <i class="fas fa-arrow-circle-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Food Remarks -->   
</form>

                </div>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
</div>

</body>
</html>