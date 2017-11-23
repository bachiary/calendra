<?php
/***********************************************************************
| Adobe Consulting Team work
|
| By using this software, you acknowledge having read this license agreement
| and agree to be bound thereby.
|
 ***********************************************************************/





// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "SELECT id, firstname, Comments FROM profile order by id";
$result = $conn->query($sql);
$count = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      
		
		if($count>0){$persons = $persons . ",{\"id\": " . $row["id"] .", \"name\": \"" .$row["firstname"]. "\"}";}
		else{$persons = "[{\"id\": " . $row["id"] .", \"name\": \"" .$row["firstname"]. "\"}";}
        $count = $count+1;
                
    $tab = json_decode($row["Comments"]);;

    

	if($_SESSION['email']!=$row["email"]){

	$_SESSION['MoAMAll']= $_SESSION['MoAMAll']." ".$tab[0]->hours[0]->value;
	$_SESSION['MoPMAll']= $_SESSION['MoPMAll']." ".$tab[0]->hours[1]->value;
	
	$_SESSION['TuAMAll']= $_SESSION['TuAMAll']." ".$tab[1]->hours[0]->value;
	$_SESSION['TuPMAll']= $_SESSION['TuPMAll']." ".$tab[1]->hours[1]->value;
	
	$_SESSION['WeAMAll']= $_SESSION['WeAMAll']." ".$tab[2]->hours[0]->value;
	$_SESSION['WePMAll']= $_SESSION['WePMAll']." ".$tab[2]->hours[1]->value;
	
	$_SESSION['ThAMAll']= $_SESSION['ThAMAll']." ".$tab[3]->hours[0]->value;
	$_SESSION['ThPMAll']= $_SESSION['ThPMAll']." ".$tab[3]->hours[1]->value;
	
	$_SESSION['FrAMAll']= $_SESSION['FrAMAll']." ".$tab[4]->hours[0]->value;
	$_SESSION['FrPMAll']= $_SESSION['FrPMAll']." ".$tab[4]->hours[1]->value;
	}


    }

	$Comments = $_SESSION['MoAM'];
	
	    echo '<script type="text/javascript">',	
     'localStorage["email"] = "'.$_SESSION['email'].'"',
     '</script>';
     
   
     
     
	    echo '<script type="text/javascript">',	
     'localStorage["team"] = JSON.stringify([[{value: "'.$_SESSION['MoAMAll'].'"},{value: "'.$_SESSION['MoPMAll'].'"}],[{value: "'.$_SESSION['TuAMAll'].'"},{value: "'.$_SESSION['TuPMAll'].'"}],[{value: "'.$_SESSION['WeAMAll'].'"},{value: "'.$_SESSION['WePMAll'].'"}],[{value: "'.$_SESSION['ThAMAll'].'"},{value: "'.$_SESSION['ThPMAll'].'"}],[{value: "'.$_SESSION['FrAMAll'].'"},{value: "'.$_SESSION['FrPMAll'].'"}]])',
     '</script>';
     

	
    echo '<script type="text/javascript">',	
     'localStorage["persons"] = JSON.stringify(' . $persons .'])',
     '</script>';


} 

$conn->close();






?>
