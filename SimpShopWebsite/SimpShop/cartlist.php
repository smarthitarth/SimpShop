<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}

if(isset($_POST['CID'])) {

    $carttable = "cart".$_POST['CID'];
    $sql_query = "SELECT * FROM $carttable";
    $result = $conn->query($sql_query);
    $array = array();
    if ($result->num_rows > 0) {
        echo "cartfetchOkay";
        while ($row = $result->fetch_assoc()) {
            $rid=$row['RID'];
            $iid=$row['IID'];
            $sql_query = "SELECT SNAME FROM MAINRET WHERE RID=$rid";
            $sub1result = $conn->query($sql_query);
            $subrow = $sub1result->fetch_assoc();
            $row['RNAME'] = $subrow['SNAME'];
            $itemtable = "c".substr($iid,0,6);
            $sql_query = "SELECT NAME FROM $itemtable WHERE ITEMID=$iid";
            $sub1result = $conn->query($sql_query);
            $subrow = $sub1result->fetch_assoc();
            $row['INAME'] = $subrow['NAME'];
            $array[] = $row;
        }
        echo json_encode($array);

    } else {
        echo "unsuccessful";
    }
}
else {
    echo "unsuccessful";
}
mysqli_close($conn);
?>