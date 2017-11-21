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

$id = $_GET	['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql = "SELECT id, firstname, lastname,MoAM,MoPM,Comments,email FROM profile where id=\"" .$id."\"";
$result = $conn->query($sql);




if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        		$Comments = $row["Comments"] ;
				if($Comments){
        		    echo '<script type="text/javascript">var comments = '.$Comments.';',	
     'localStorage["week"] = JSON.stringify(' . $Comments .')',
     '</script>';
     
     $email = $row["email"];
	$tab = json_decode($Comments);;

	$_SESSION['MoAM']= $tab[0]->hours[0]->value;
	if($tab[0]->hours[0]->value == ""){$_SESSION['MoAM']="empty";}
	$_SESSION['MoPM']= $tab[0]->hours[1]->value;
	
	$_SESSION['TuAM']= $tab[1]->hours[0]->value;
	$_SESSION['TuPM']= $tab[1]->hours[1]->value;
	
	$_SESSION['WeAM']= $tab[2]->hours[0]->value;
	$_SESSION['WePM']= $tab[2]->hours[1]->value;
	
	$_SESSION['ThAM']= $tab[3]->hours[0]->value;
	$_SESSION['ThPM']= $tab[3]->hours[1]->value;
	
	$_SESSION['FrAM']= $tab[4]->hours[0]->value;
	$_SESSION['FrPM']= $tab[4]->hours[1]->value;
	

	
	$_SESSION['email'] = $email;
	$_SESSION['comments'] = $Comments;

}
	
	
	
	
	
	
    }



 


} 

$conn->close();






?>


