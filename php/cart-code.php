<?php
require_once "./db.php";

require_once "./vendor/autoload.php";

if (isset($_GET['delete'])){
    $No = $_GET['delete'];
    $tableNo = $_GET['tableNo'];

    $query = "DELETE FROM orders WHERE No = '$No'";
    $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));
    $resetIncrement = mysqli_multi_query($conn, $reset);
    header("location:./cart.php?tableNo=".$tableNo);
}  

if (isset($_GET['plus'])){
    $No = $_GET['plus'];   
    $tableNo = $_GET['tableNo'];

    // Get quantity
    $getQtyQuery = "SELECT Quantity FROM orders WHERE No = '$No'";
    $getQtySqli = mysqli_query($conn, $getQtyQuery);
    $getQty = mysqli_fetch_assoc($getQtySqli);
    $getQty = $getQty['Quantity'];

    $update = "UPDATE orders SET Quantity = Quantity + 1 WHERE No = '$No'";
    $result = mysqli_query($conn, $update) or die (mysqli_error($conn));
    header("location:./cart.php?tableNo=".$tableNo);
}  
else if (isset($_GET['minus'])){
    $No = $_GET['minus'];   
    $tableNo = $_GET['tableNo'];

    // if quantity is equal to 0, delete the row
    $getQtyQuery = "SELECT Quantity FROM orders WHERE No = '$No'";
    $getQtySqli = mysqli_query($conn, $getQtyQuery);
    $getQty = mysqli_fetch_assoc($getQtySqli);
    $getQty = $getQty['Quantity'];

    if ($getQty == 1){
        $query = "DELETE FROM orders WHERE No = '$No'";
        $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));
        $resetIncrement = mysqli_multi_query($conn, $reset);
        header("location:./cart.php?tableNo=".$tableNo);
    }
    else{
        $update = "UPDATE orders SET Quantity = Quantity - 1 WHERE No = '$No'";
        $result = mysqli_query($conn, $update) or die (mysqli_error($conn));


        header("location:./cart.php?tableNo=".$tableNo);
        header("location:./cart.php?tableNo=".$tableNo);
    }
}

// post request
if (isset($_POST['confirmOrder'])){
    $tableNo = $_GET['tableNo'];

    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '6b93243aa352bf9957fb',
        '33a0b3011b4db5a23624',
        '1319138',
        $options
      );
    
    $query = "UPDATE orders SET TotalPrice = food_Price * Quantity";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

    $query = "INSERT INTO requestorder SELECT * FROM orders WHERE TableNo = '$tableNo'";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

    $query = "DELETE FROM orders WHERE TableNo = '$tableNo'";
    $resultDelete = mysqli_query($conn, $query) or die (mysqli_error($conn));

    if($query)
    {
        $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);

    header("location:./empty.php");
}
?>