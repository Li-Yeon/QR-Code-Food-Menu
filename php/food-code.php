<?php

require_once "./db.php";
//Get Category Info
$sql = "SELECT * FROM category ORDER BY No ASC";
$catResult = mysqli_query($conn, $sql) or die (mysqli_error($conn));

//Add Product
if(isset($_POST['addFood']))
{
        $foodName=$_POST['foodname'];
        $foodPrice=$_POST['foodprice'];
        $category=$_POST['category'];
        $image = $_FILES['image']['name'];

        $target = "./images/".basename($_FILES['image']['name']);   

        $insertFoodQuery = "INSERT INTO food (food_Name, food_Price, food_Category, food_Image) values ('$foodName', '$foodPrice', '$category', '$image')";
        $insertFoodSqli = mysqli_query($conn, $insertFoodQuery) or die (mysqli_error($conn));
        $reset = "ALTER TABLE food DROP No;ALTER TABLE food AUTO_INCREMENT = 1;ALTER TABLE food ADD No int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
        $resetIncrement = mysqli_multi_query($conn, $reset);

}
?>