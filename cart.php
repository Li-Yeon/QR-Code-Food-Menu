<?php
require_once "db.php";
require_once "php/table.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title> Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.cssS">
</head>
<body>
    
<div class="container">
    <h1>Shopping Cart</h1>
    <div class="cart">
        <div class="products">
            <div class="product">
                <img src="images/nasi_goreng.jpg" alt="">
                <div class="product-info">
                        <h3 class="product-name">Nasi Goreng</h3>
                        <h2 class="product-price">RM 7.50</h2>
                        <h2 class="product-offer">50%</h2>
                        <p class="product-quantity">Qnt: <input value="1"name="">
                        <p class="product-remove">
                           <i class="fa fa-times" aria-hidden="true"></i>
                           <span class="remove">Remove</span>
                        </p>
                    </div>
            </div>
            <div class="product">
                <img src="images/nasi_goreng_s.jpg" alt="">
                <div class="product-info">
                        <h3 class="product-name">Nasi Goreng Seafood</h3>
                        <h2 class="product-price">RM 7.50</h2>
                        <h2 class="product-offer">50%</h2>
                        <p class="product-quantity">Qnt: <input value="1"name="">
                        <p class="product-remove">
                           <i class="fa fa-times" aria-hidden="true"></i>
                           <span class="remove">Remove</span>
                        </p>
                    </div>
            </div>
        </div>
        <div class="cart-total">
            <p>
                <span>Total Price</span>
                <span>RM 15.00</span>
            </p>
            <p>
                <span>Number of Items</span>
                <span>2</span>
            </p>
            <p>
                <span>You Save</span>
                <span>RM 5.00</span>
            </p>
            <a href="#">Proceed to Checkout</a>
        </div>
    </div>
</div>

</body>
</html>