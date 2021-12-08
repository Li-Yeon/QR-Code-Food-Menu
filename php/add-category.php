<?php
require_once "db.php";

//Get Category Info
$sql = "SELECT * FROM category ORDER BY No ASC";
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

//Get previous Category
$prevCat = "";

//Add Category
if(isset($_POST['addCategory']))
{
        $category=$_POST['category'];
        $insertCatQuery = "INSERT INTO category (Category) values ('$category')";
        $insertCatSqli = mysqli_query($conn, $insertCatQuery) or die (mysqli_error($conn));
}

//Delete Category
if (isset($_GET['delete'])){
    $No = $_GET['delete'];
    $query = "DELETE FROM category WHERE No = '$No'";
    $reset = "ALTER TABLE category DROP No;ALTER TABLE category AUTO_INCREMENT = 1;ALTER TABLE category ADD No int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
    $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));
    $resetIncrement = mysqli_multi_query($conn, $reset);
    echo '<script>location.href="./category.php"</script>';
}  

// Auto Fill Edit
if (isset($_GET['edit'])){
    $idP = $_GET['edit'];
    $query = "SELECT * FROM category WHERE No = '$idP'";

    $getData = mysqli_query($conn, $query);

    $queryPrevCatSqli = mysqli_query($conn, $query);
    $prevCat = mysqli_fetch_assoc($queryPrevCatSqli);
    $prevCat = $prevCat['Category'];
    $prevCat = preg_replace('/\s+/', '', $prevCat);
}  

// Edit Category
if(isset($_POST['editCategory']))
{
    $category=$_POST['category'];
    $update = "UPDATE category SET Category = '$category' WHERE No = '$idP'; UPDATE food SET food_Category = '$category' WHERE food_Category = '$prevCat'";
    $result = mysqli_multi_query($conn, $update); 
    echo '<script>location.href="./category.php"</script>';
}

?>