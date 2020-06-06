<?php
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if($conn->connect_error ) {
    die('Could not connect: ' . $conn->connect_error);
}
if(isset($_POST['uname']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['pword']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['areaid'])) {
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pword = $_POST['pword'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $areaid = $_POST['areaid'];
    $sql_query = "INSERT INTO MAINCUST (UNAME, FNAME, LNAME, CREDIT, PWORD, EMAIL, ADDRESS, AREAID) VALUES ($uname, '$fname', '$lname',0, '$pword','$email','$address',$areaid)";
    if ($conn->query($sql_query)) {
        echo "signupOkay";
        $sql_query = "SELECT * FROM MAINCUST WHERE UNAME=$uname AND PWORD=$pword";
        $result = $conn->query($sql_query);
        $array = array();
        $cid;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array[] = $row;
                $cid = $row["CID"];
            }
            echo json_encode($array);
            $ordname = "ord".$cid;
            $sql_query = "CREATE TABLE $ordname (OID INT(8) NOT NULL, FOREIGN KEY (OID) REFERENCES ordlst(OID))";
            if($conn->query($sql_query))
            {   $ordname = "cart".$cid;
                $sql_query="CREATE TABLE $ordname (cartID int(5) unsigned auto_increment primary key, RID int(6) not null, qty BIGINT(20) not null, price BIGINT(20) not null, IID BIGINT(12) not null, unit varchar(45) not null) auto_increment=10000";
                if($conn->query($sql_query)) {
                    echo "ordpreped";
                }
            }

        }

    }
    else{
        echo "unsuccessful";
    }

}
else
{
    echo "unsuccessful";
}
mysqli_close($conn);
?>