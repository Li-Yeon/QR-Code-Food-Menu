<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/qr-alpha/db.php';

if(isset($_POST['Login'])) 
  {
    $username=$_POST['username'];
    $password=($_POST['password']);
    $_SESSION['Admin'] = $username;

    loginUser($conn, $username, $password);
  }
  else
  {
    header("location:../admin.php");
    exit();
  }

function loginUser($conn, $username, $password)
  {
    $uidExists = uidExists($conn, $username);

    if($uidExists === false){
        header("location:../admin/login.php?error=wronglogin");
        exit();
    }
    
    $passwordHashed = $uidExists["Password"];
    $checkPassword = password_verify($password , $passwordHashed);

    if($checkPassword === false){
        header("location:../admin/login.php?error=wronglogin");
        exit();
    }
    else if($checkPassword === true){
            session_start();            
            header("location:../admin.php");
    }
}

function uidExists($conn, $username){
    $sql = "SELECT * FROM users WHERE Username = ?;"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location:../admin/login.php?error=statementfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
