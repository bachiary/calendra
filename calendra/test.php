
<?php
 
$fp = fsockopen("acs106.msavlab.adobe.com", 80, $errno, $errstr, 2);
 
if($fp) {
    echo("connexion ok");
} else {
    echo("connexion hs");
}
 
?>


