<?php
require_once "db.php";
if(isset($_GET['tableNo']))
{
    // Cart Query
    $tableNo = $_GET['tableNo'];
    $cartQuery = "SELECT * FROM orders WHERE TableNo='$tableNo'";
    $cartSqli = mysqli_query($conn, $cartQuery);
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

    <link rel="stylesheet" href="cart.css">

    <title>Menu</title>
</head>

<body>
<!-- Navbar -->
<header class="header">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="container-fluid">
    <a class="navbar-brand ps-5" href="">NABALU <span class ="text-warning">FOOD</span></a>

    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item pe-5">
        </li>
    </ul>
  </div>
</nav>
</header>
<!-- End of Navbar -->    

<!-- Container Div-->
<div class="container-fluid m-1">
    
    <a class="link-warning" href="orderFood.php?tableNo=<?php echo $_GET['tableNo']?>"><h4 class ="mt-3" style="font-family: 'Roboto Condensed', sans-serif;">Continue Ordering</h4></a>
    <h3 class ="mt-3" style="font-family: 'Roboto Condensed', sans-serif;">Food Cart</h3>

<!-- Card-->    
<?php
    while($rows=mysqli_fetch_assoc($cartSqli))
    {
?>
  <div class="card mb-2">
        <div class="row no-gutters">
            <div class="col-auto">
                <img src="<?php echo $rows['Image'];?>" class="img-fluid" alt="" style="width:200px; height:150px;">
            </div>
            <div class="col">
                <div class="card-block mt-3">
                    <h4 class="card-title"><?php echo $rows['food_Name'];?></h4>
                    <p class="card-text fw-bold">RM<?php echo $rows['food_Price'];?></p>
                    <div class="d-flex">
                    <input type="number" class="form-control" name="qty" value = "<?php echo $rows['Quantity'];?>" style="text-align:center;" min="1">     
                    <a href="#" class="btn btn-danger">Remove</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer w-100 text-muted">
        <p class="card-text"><?php if($rows['Remarks'] == ""){echo '<small class="text-muted">No Remarks</small>';}else{echo '<small class="text-muted">'.$rows['Remarks'].'</small>';};?></p>
        </div>
  </div>
<?php
    }
?>
<!-- Card-->    
<hr>
<div class="card">
  <div class="card-body">
    <h5 style="font-family: 'Roboto Condensed', sans-serif;" class="mb-4 fw-bold"><span style="position:absolute; right: 35px;">RM</span></h5>
    <h4 style="font-family: 'Roboto Condensed', sans-serif;">Service Tax <span style="position:absolute; right: 30px;">3.50</span></h4>
    <h4 style="font-family: 'Roboto Condensed', sans-serif;">Subtotal <span style="position:absolute; right: 30px;">56.75</span></h4>

  </div>
</div>




</div>
<!-- Container Div-->

</body>
</html>