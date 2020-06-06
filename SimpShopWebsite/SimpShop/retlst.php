<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
if(isset($_POST['AREAID']) && isset($_POST['ITEMID'])) {
    $areaid = $_POST['AREAID'];
    $itmid = $_POST['ITEMID'];
    $tablename = "area".$areaid;
    $sql_query = "SELECT * FROM $tablename";
    $result = $conn->query($sql_query);
    $array = array();
    if ($result->num_rows > 0) {
        echo "okay";
        while ($row = $result->fetch_assoc()) {
            $rid = $row['RID'];
            $subtablename = "itm" . $rid;
            $subsql_query = "SELECT * FROM $subtablename WHERE ITEMID=$itmid";
            $subresult = $conn->query($subsql_query);
            $subrow = $subresult->fetch_assoc();
            $subrow["RID"] = $rid;
            $subsql_query = "SELECT SNAME FROM MAINRET WHERE RID=$rid";
            $subsubresult = $conn->query($subsql_query);
            $subsubrow = $subsubresult->fetch_assoc();
            $subrow["NAME"] = $subsubrow['SNAME'];
            $array[] = $subrow;
        }

        echo json_encode($array);
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