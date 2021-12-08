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

        $target = "./images/".basename($_FILES['image']['name']);   
        $image = $_FILES['image']['name'];

        $insertFoodQuery = "INSERT INTO food (food_Name, food_Price, food_Category, Image) values ('$foodName', '$foodPrice', '$category', '$target')";
        $insertFoodSqli = mysqli_query($conn, $insertFoodQuery) or die (mysqli_error($conn));
        $reset = "ALTER TABLE food DROP No;ALTER TABLE food AUTO_INCREMENT = 1;ALTER TABLE food ADD No int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
        $resetIncrement = mysqli_multi_query($conn, $reset);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

        }
}

//Get Food Data
if (isset($_GET['edit'])){
    $idP = $_GET['edit'];
    $query = "SELECT * FROM food WHERE No = '$idP'";
    $getData = mysqli_query($conn, $query);
}  

//Update Product Details
if(isset($_POST['editFood']))
{
    $foodName=$_POST['foodname'];
    $foodPrice=$_POST['foodprice'];
    $category=$_POST['category'];

    $target = "./images/".basename($_FILES['image']['name']);   
    $image = $_FILES['image']['name'];

    if ($image == "") 
    {
    $update = "UPDATE food SET food_Name = '$foodName', food_Price = '$foodPrice', food_Category = '$category' WHERE No = '$idP'";
    }
    else
    {
        $update = "UPDATE food SET food_Name = '$foodName', food_Price = '$foodPrice', food_Category = '$category', Image = '$target' WHERE No = '$idP'";
    }

    $result = mysqli_query($conn, $update) or die (mysqli_error($conn)); 
    echo '<script>location.href="./foods.php"</script>';
}

//Delete Food
if (isset($_GET['delete'])){
    $No = $_GET['delete'];
    $query = "DELETE FROM food WHERE No = '$No'";
    $reset = "ALTER TABLE food DROP No;ALTER TABLE food AUTO_INCREMENT = 1;ALTER TABLE food ADD No int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
    $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));
    $resetIncrement = mysqli_multi_query($conn, $reset);
    echo '<script>location.href="./foods.php"</script>';
}  
?>