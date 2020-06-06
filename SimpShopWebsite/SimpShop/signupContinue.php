<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

$uname = 7894210;
$email = "k";

if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
if(isset($_POST['uname']) && isset($_POST['email']))
{
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $sql_query = "SELECT * FROM MAINCUST WHERE UNAME='$uname' OR EMAIL='$email'";
    $result = $conn->query($sql_query);
    $array = array();
    if( $result->num_rows>0 ) {
        echo "duplicate";
    }
    else
    {
        echo "dupokay";
        $sql_query = "SELECT * FROM ZONELST";
        $result = $conn->query($sql_query);
        if( $result->num_rows>0 ) {
            while ($row = $result->fetch_assoc()) {
                $array[] = $row;
            }
            echo json_encode($array);
        }
    }
}
else
{
    echo "unsuccessful";
}
mysqli_close($conn);
?>