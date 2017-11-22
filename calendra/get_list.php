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


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "SELECT id, firstname, lastname,MoAM,MoPM,Comments,email FROM profile order by id";
$result = $conn->query($sql);
$count = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      
		
		if($count>0){$persons = $persons . ",{\"id\": " . $row["id"] .", \"name\": \"" .$row["firstname"]. "\"}";}
		else{$persons = "[{\"id\": " . $row["id"] .", \"name\": \"" .$row["firstname"]. "\"}";}
        $count = $count+1;
                
    $tab = json_decode($row["Comments"]);;

	$_SESSION['MoAM']= $_SESSION['MoAM']." ".$tab[0]->hours[0]->value;
	$_SESSION['MoPM']= $_SESSION['MoPM']." ".$tab[0]->hours[1]->value;
	
	$_SESSION['TuAM']= $_SESSION['TuAM']." ".$tab[1]->hours[0]->value;
	$_SESSION['TuPM']= $_SESSION['TuPM']." ".$tab[1]->hours[1]->value;
	
	$_SESSION['WeAM']= $_SESSION['WeAM']." ".$tab[2]->hours[0]->value;
	$_SESSION['WePM']= $_SESSION['WePM']." ".$tab[2]->hours[1]->value;
	
	$_SESSION['ThAM']= $_SESSION['ThAM']." ".$tab[3]->hours[0]->value;
	$_SESSION['ThPM']= $_SESSION['ThPM']." ".$tab[3]->hours[1]->value;
	
	$_SESSION['FrAM']= $_SESSION['FrAM']." ".$tab[4]->hours[0]->value;
	$_SESSION['FrPM']= $_SESSION['FrPM']." ".$tab[4]->hours[1]->value;
	

    }

	$Comments = $_SESSION['MoAM'];
	
	    echo '<script type="text/javascript">',	
     'localStorage["week2"] = "'.$_SESSION['MoAM'].'"',
     '</script>';
     
	
    echo '<script type="text/javascript">',	
     'localStorage["persons"] = JSON.stringify(' . $persons .'])',
     '</script>';


} 

$conn->close();






?>
