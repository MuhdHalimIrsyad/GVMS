<?php
    
    $host = "localhost"; 
    $user = "postgres"; 
    $pass = "hometown"; 
    $db = "gamified"; 
	
    $con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n" . pg_last_error());    

?>