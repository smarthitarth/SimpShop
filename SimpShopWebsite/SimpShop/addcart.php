<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
if(isset($_POST['cid']) &&  isset($_POST['rid']) && isset($_POST['price']) && isset($_POST['unit']) && isset($_POST['iid']) && isset($_POST['qty'])){
$cid=$_POST['cid'];
$rid=$_POST['rid'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$unit="".$_POST['unit'];
$iid=$_POST['iid'];
$tablename = "cart".$cid;
$sql_query = "INSERT INTO $tablename (RID, qty, price, IID, unit) VALUES ($rid, $qty, $price, $iid, '$unit')";
if ($conn->query($sql_query)) {
    echo "successOkay";
}
else{
    echo "unsuccessful";
}
}
else{
    echo "unsuccessful";
}
mysqli_close($conn);
?>