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

//Add Cart
if (isset($_POST['addToCart'])){
    $tableNo = $_GET['orderFood'];
    $foodCode = $_POST['foodCode'];
    $remarks = $_POST['remarks'];
    $qty = $_POST['qty'];

    // Food Query
    $foodQuery = "SELECT * FROM food ORDER BY NO ASC";
    $fdQuery = mysqli_query($conn, $foodQuery);

    //Check if Food Already Exist in Table
    $checkFDQuery = "SELECT IFNULL( (SELECT food_Code FROM orders WHERE food_Code = '$foodCode' AND TableNo = '$tableNo' LIMIT 1) ,'Null') As 'foodCode'";
    $checkFDSqli = mysqli_query($conn, $checkFDQuery);
    $checkFD = mysqli_fetch_assoc($checkFDSqli);
    $checkFD = $checkFD['foodCode'];

    if ($checkFD == "Null")
    {
        $getFDCode = "SELECT * FROM food WHERE food_Code = '$foodCode'";
        $getFDCodeSqli = mysqli_query($conn, $getFDCode);

        while ($row = mysqli_fetch_row($getFDCodeSqli)) {
            $foodName = $row[2];
            $foodPrice = $row[3];
            $Image = $row[5];
        }

        $insertCartQuery = "INSERT INTO orders (TableNo, food_Code, food_Name, food_Price, Image, Remarks, Quantity) VALUES ('$tableNo', '$foodCode', '$foodName', '$foodPrice', '$Image', '$remarks', '$qty')";
        $insertCartSqli = mysqli_query($conn, $insertCartQuery) or die (mysqli_error($conn));
        header("location:../orderFood.php?tableNo=".$tableNo);
    }
    else
    {
        if($remarks == "")
        {
            $updateCartQtyQuery = "UPDATE orders SET Quantity = Quantity + '$qty' WHERE food_Code = '$foodCode' AND TableNo = '$tableNo' AND Remarks = ''";
            $updateCartQtyResult = mysqli_query($conn, $updateCartQtyQuery) or die (mysqli_error($conn));
            header("location:../orderFood.php?tableNo=".$tableNo);
        }
        else
        {
            $getFDCode = "SELECT * FROM food WHERE food_Code = '$foodCode'";
            $getFDCodeSqli = mysqli_query($conn, $getFDCode);
    
            while ($row = mysqli_fetch_row($getFDCodeSqli)) {
                $foodName = $row[2];
                $foodPrice = $row[3];
                $Image = $row[5];
            }

            $insertCartQuery = "INSERT INTO orders (TableNo, food_Code, food_Name, food_Price, Image, Remarks, Quantity) VALUES ('$tableNo', '$foodCode', '$foodName', '$foodPrice', '$Image', '$remarks', '$qty')";
            $insertCartSqli = mysqli_query($conn, $insertCartQuery) or die (mysqli_error($conn));
            header("location:../orderFood.php?tableNo=".$tableNo);
        }
    }
} 

?>