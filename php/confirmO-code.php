<?php
require_once "./db.php";
date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y/m/d');

//Get Category Info
$sql = "SELECT * FROM category ORDER BY No ASC";
$catResult = mysqli_query($conn, $sql) or die (mysqli_error($conn));

//Add Product
if(isset($_POST['addFood']))
{
        $foodCode =$_POST['foodcode'];
        $foodName=$_POST['foodname'];
        $foodPrice=$_POST['foodprice'];
        $category=$_POST['category'];
}


//Delete Food
if (isset($_GET['delete'])){

    $No = $_GET['delete'];
    $TableNo = $_GET['tableNo'];

    $query = "DELETE FROM requestorder WHERE No = '$No'";
    $reset = "ALTER TABLE requestorder DROP No;ALTER TABLE requestorder AUTO_INCREMENT = 1;ALTER TABLE requestorder ADD No int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
    $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));
    $resetIncrement = mysqli_multi_query($conn, $reset);
    header("location:./confirm-order.php?tableNo=".$TableNo);
}  

if (isset($_GET['paid'])){
    $TableNo = $_GET['paid'];

    // insert request order to confirm order table
    $query = "INSERT INTO confirmorder (TableNo, food_Code, food_Name, food_Price, Remarks, Quantity, TotalPrice, Date) SELECT TableNo, food_Code, food_Name, food_Price, Remarks, Quantity, TotalPrice, Date FROM requestorder WHERE TableNo = '$TableNo'";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

    // delete request order
    $query = "DELETE FROM requestorder WHERE TableNo = '$TableNo'";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

    // header back to confirm order
    header("location:./orders.php");
}  
?>