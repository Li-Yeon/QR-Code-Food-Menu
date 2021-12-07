<?php
session_start();
require_once "db.php";
require_once "php/table.php";
if(isset($_SESSION['Admin']))
    {

    }
    else
    {
        echo '<script>alert("You must login first!");</script>';
        echo '<script>location.href="./admin/login.php";</script>';
        exit();
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>