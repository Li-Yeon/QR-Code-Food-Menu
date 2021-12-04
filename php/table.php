<?php
    require_once './db.php';

    // Category Query
    $categoryQuery = "SELECT * FROM category ORDER BY NO ASC";
    $ctQuery = mysqli_query($conn, $categoryQuery);

    // Food Query
    $foodQuery = "SELECT * FROM food ORDER BY NO ASC";
    $fdQuery = mysqli_query($conn, $foodQuery);

?>