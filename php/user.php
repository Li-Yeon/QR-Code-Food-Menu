<?php
require_once "../db.php";
session_start();
$currentUser = $_SESSION['Admin'];
$getCurrentUserQuery = "SELECT Name from users WHERE Username=" . "'" . $currentUser . "'";
$getCurrentUserSqli = mysqli_query($conn, $getCurrentUserQuery);
$getCurrentUser = mysqli_fetch_assoc($getCurrentUserSqli);
$getCurrentUser = $getCurrentUser['Name'];


//Delete User
if (isset($_GET['delete'])){
    $No = $_GET['delete'];
    $query = "DELETE FROM users WHERE No = '$No'";
    $reset = "ALTER TABLE users DROP No;ALTER TABLE users AUTO_INCREMENT = 1;ALTER TABLE users ADD No int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
    $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));
    $resetIncrement = mysqli_multi_query($conn, $reset);
    echo '<script>location.href="../users.php"</script>';
}  


?>