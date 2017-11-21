

<?php
/***********************************************************************
| Adobe Consulting Team work
|
| By using this software, you acknowledge having read this license agreement
| and agree to be bound thereby.
|
 ***********************************************************************/
 


$servername = "localhost";
$username = "benjagol";
$password = "Montpel#2015";
$dbname = "calendra";


$local = $_GET	['local'];
$id = $_GET	['id'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$val = "<script>localStorage.getItem('week');</script>"; 



$sql="UPDATE profile set Comments = '".$local	."' where id =" .$id;


$result = $conn->query($sql);




if ($result) {
echo "&#10003; Save in SQL";
      
} else {
    echo "0 results";
}



$conn->close();



?>


