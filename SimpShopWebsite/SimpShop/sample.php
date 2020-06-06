<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
$uname = 7894210;
$fname = " sd44d";
$lname = "sdc5";
$credit = 45;
$pword = "5";
$email = "k";
$address = "s";
$areaid = 7841;
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
echo 'Connected successfully';
$sql_query = "SELECT * FROM MAINCUST WHERE UNAME='$uname' OR EMAIL='$email'";
$result = $conn->query($sql_query);
if( $result->num_rows>0 ) {
    echo "Already registered";
}
else
{
    echo "Okay";
}
$zoneid = 101;
$zonename = "zone".$zoneid;
echo $zoneid;
$sql_query = "SELECT * FROM $zonename";
$result = $conn->query($sql_query);
if( $result->num_rows>0 ) {
    while($row = $result->fetch_assoc()) {
        echo "subid: " . $row["SUBID"]. " - Name: " . $row["AREAID"]. " " . $row["AREANAME"]. "<br>";
    }
}
else
{
    echo "failed";
}
//$sql_query = "INSERT INTO MAINCUST (UNAME, FNAME, LNAME, CREDIT, PWORD, EMAIL, ADDRESS, AREAID) VALUES ($uname, '$fname', '$lname', $credit, '$pword','$email','$address',$areaid)";
//if( $conn->query($sql_query)!==TRUE ) {
//    die('Could not enter data: ' . $conn->error);
//}

//echo "Entered data successfully\n";
mysqli_close($conn);
?>