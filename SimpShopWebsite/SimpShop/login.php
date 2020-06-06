<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
if(isset($_POST['uname']) && isset($_POST['pword']) && isset($_POST['type']))
{
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
    $type = $_POST['type'];
    if($type=="ret")
    {
        $sql = "SELECT * FROM MAINRET WHERE  uname = $uname AND pword = $pword";
    }
    else
    {
        $sql = "SELECT * FROM MAINCUST WHERE  uname = $uname AND pword = $pword";
    }
    $result = $conn->query($sql);
    $array = array();
    if ($result->num_rows > 0) {
        echo "true";
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
        echo json_encode($array);
    }
    else {
        echo "false";
    }
}
else{
    echo "false";
}
mysqli_close($conn);
?>