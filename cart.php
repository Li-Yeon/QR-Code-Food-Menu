<?php
require_once "db.php";
require_once "php/cart-code.php";
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
    
    <div class="continue-order mt-3">
    <a class="link-warning" href="orderFood.php?tableNo=<?php echo $_GET['tableNo']?>"><span style="font-family: 'Roboto Condensed', sans-serif;" class="h3">Continue Ordering</span></a>
    </div>

    <h3 class ="mt-3" style="font-family: 'Roboto Condensed', sans-serif;">Food Cart</h3>

<!-- Card-->    
<?php
    while($rows=mysqli_fetch_assoc($cartSqli))
    {
?>
  <div class="card mb-2">
        <div class="row no-gutters">
            <div class="col-auto">
                <img src="<?php echo $rows['Image'];?>" class="img-fluid" alt="" style="width:200px; height:160px;">
            </div>
            <div class="col">
                <div class="card-block mt-3 cart-items">
                    <a href="cart.php?tableNo=<?php echo $tableNo?>&delete=<?php echo $rows['No'];?>" style="position:absolute; right: 20px; color:red;"onclick="return confirm('Confirm remove food?');"><i class="fas fa-trash"></i></a>
                    <h4 class="card-title"><?php echo $rows['food_Name'];?></h4>
                    <p class="card-text fw-bold cart-price">RM<?php echo $rows['food_Price'];?></p>
                    <div class="d-flex">
                    <a href="cart.php?tableNo=<?php echo $tableNo?>&minus=<?php echo $rows['No'];?>" class="btn btn-danger">-</a>
                    <input type="number" class="form-control cart-quantity-input w-50 mx-1" id="quantity" value = "<?php echo $rows['Quantity'];?>" style="text-align:center;" min="1" readonly>     
                    <a href="cart.php?tableNo=<?php echo $tableNo?>&plus=<?php echo $rows['No'];?>" class="btn btn-success">+</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer w-100 text-muted d-flex">
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
    <h4 style="font-family: 'Roboto Condensed', sans-serif;">Service Tax <span style="position:absolute; right: 30px;">0</span></h4>
    <h4 style="font-family: 'Roboto Condensed', sans-serif;">Subtotal <span style="position:absolute; right: 30px;" class="cart-total-price"></span></h4>
  </div>
</div>
<form method="POST">
<button type="submit" class="btn btn-success mt-3 mb-3 w-100 btn-lg" name="confirmOrder">Confirm Order</button>
</form>
</div>
<!-- Container Div-->
</body>
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
  } else {
    ready()
  }
  function ready()
  {
    updateCartTotal();
    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
      var input = quantityInputs[i]
      input.addEventListener('change', quantityChanged)
    }
    
  }

function quantityChanged(event)
{
  var input = event.target;
  if(isNaN(input.value) || input.value <= 0)
  {
    input.value = 1;
  }
  updateCartTotal();
}

function updateCartTotal(){
  var cartRows = document.getElementsByClassName('cart-items')
  var total = 0;
  for(var i = 0; i < cartRows.length; i++){
    var cartRow = cartRows[i];
    var priceElement = cartRow.getElementsByClassName('cart-price')[0];
    var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0];
    var price = parseFloat(priceElement.innerText.replace('RM',''));
    var quantity = quantityElement.value;
    total = total + (price * quantity);
  }
total = Math.round(total * 100) / 100;
document.getElementsByClassName('cart-total-price')[0].innerText = 'RM' + total;
}


</script>

</html>