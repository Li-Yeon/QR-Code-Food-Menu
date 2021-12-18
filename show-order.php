<?php
// get request
if (isset($_GET['tableNo'])){
    $tableNo = $_GET['tableNo'];
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
  </div>
</nav>
</header>
<!-- End of Navbar -->

<!-- Content -->
<div class="container d-flex justify-content-center">

<div class="card mt-5" style="width: 22rem;">
  <img src="cashier-machine.png" class="mt-2" alt="..." style="width:150px;height:150px;display:block;margin-left:auto;margin-right:auto;">
  <div class="card-body">
    <p class="card-text fw-bold text-center"style="font-family: 'Roboto Condensed', sans-serif;">Show this to the cashier and pay then your order will be confirmed 🙂</p>
    <p class="card-text fw-bold text-center h4"style="font-family: 'Roboto Condensed', sans-serif;">Table No: <?php echo $tableNo?></p>
  </div>
</div>
</div>

<div class="mt-2 d-flex justify-content-center">
<a href="orderFood.php?tableNo=<?php echo $tableNo;?>"><button type="button" class="btn btn-success">Order Again!</button></a>
</div>


</body>
</html>