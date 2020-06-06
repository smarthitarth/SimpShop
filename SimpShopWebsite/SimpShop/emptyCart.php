<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
if(isset($_POST['CID'])){
    $cid=$_POST['CID'];
    echo $cid;
    $tablename = "cart".$cid;
    echo $tablename;
    $sql_query = "DELETE FROM $tablename";
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