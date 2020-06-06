<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}

if(isset($_POST['SUBCATID'])) {
    $table = "i".$_POST['SUBCATID'];
    echo $table;
    $sql_query = "SELECT * FROM $table";
    echo $sql_query;
    $result = $conn->query($sql_query);
    $array = array();
    if ($result->num_rows > 0) {
        echo "itemokay";
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