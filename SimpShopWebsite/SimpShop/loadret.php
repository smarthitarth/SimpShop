<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}

if(isset($_POST['RID'])) {
    $table = "inp".$_POST['RID'];
    $sql_query = "SELECT * FROM $table";
    $result = $conn->query($sql_query);
    $array = array();
    if ($result->num_rows > 0) {
        echo "retfetchOkay";
        while ($row = $result->fetch_assoc()) {
            $oid = $row['OID'];
            $sql_query = "SELECT * FROM ordlst WHERE OID=$oid";
            $subresult = $conn->query($sql_query);
            $subrow = $subresult->fetch_assoc();
            $array[] = $subrow;
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