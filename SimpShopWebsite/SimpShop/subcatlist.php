<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}

if(isset($_POST['CATID'])) {
    $table = "c".$_POST['CATID'];
    $sql_query = "SELECT * FROM $table";
    $result = $conn->query($sql_query);
    $array = array();
    if ($result->num_rows > 0) {
        echo "subcat2okay";
        while ($row = $result->fetch_assoc()) {
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