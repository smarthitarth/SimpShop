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
   $cid = $_POST['CID'];
$carttable = "cart".$cid;
    $sql_query = "SELECT * FROM $carttable";
    $result = $conn->query($sql_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rid=$row['RID'];
            $iid=$row['IID'];
            $qty=$row['qty'];
            $prc=$row['price'];
            echo $cid." ";
            echo $rid." ";
            echo $qty." ";
            echo $prc." ";
            echo $iid." ";
            $t = time();
            $sql_query = "INSERT INTO ordlst (CID,RID,QTY,PRICE,TIMESTP,IID) VALUES ($cid,$rid,$qty,$prc,$t,$iid)";
            if($conn->query($sql_query))
            {
                echo "BOOM";
            }
            $sql_query = "SELECT OID FROM ordlst WHERE IID=$iid AND RID=$rid AND CID=$cid AND TIMESTP=$t";
            $sub1result = $conn->query($sql_query);
            $subrow = $sub1result->fetch_assoc();
            $OID = $subrow['OID'];
            echo $OID;
            $tablename = "ord".$cid;
            $sql_query = "INSERT INTO $tablename (OID) VALUES ($OID)";
            echo $conn->query($sql_query);
            $tablename = "inp".$rid;
            $sql_query = "INSERT INTO $tablename (OID) VALUES ($OID)";
            echo $conn->query($sql_query);
            $sql_query = "DELETE FROM $carttable";
            echo $conn->query($sql_query);
            echo "successOkay";
        }


    } else {
        echo "unsuccessful";
    }
}
else {
    echo "unsuccessful";
}
mysqli_close($conn);
?>