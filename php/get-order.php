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

// Distinct Tables
$distinctTableQuery = "SELECT * from requestorder GROUP BY TableNo;";
$distinctTable = mysqli_query($conn, $distinctTableQuery);
?>

<script src="./bootstrap/js/bootstrap.min.js"></script>

<div class="row mx-3">

<?php
while($rows=mysqli_fetch_assoc($distinctTable))
{
?>
<div class="card mx-3" style="width: 18rem;">
    <div class="card-header bg-dark text-white">
        Table <?php echo $rows['TableNo']; ?>
    </div>
    <ul class="list-group list-group-flush">                      
        <!--<li class="list-group-item">An item</li>-->
        <a href="confirm-order.php?tableNo=<?php echo $rows['TableNo'];?>" class="btn btn-primary stretched-link">Open Order</a>
    </ul>
</div>
<?php
}
?>

</div>
                </div>

<div class="modal" tabindex="-1" id="modal-opener">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Notification</h3>
      </div>
      <div class="modal-body">
        <p class= "h4">New Order from Customer!</p>
      </div>
    </div>
  </div>
</div>

<script>
    $("#modal-opener").modal('show');
    $('.modal-backdrop').remove(); 
</script>