<?php
// configuration
    $dbhost = "localhost";
    $dbname	= "pcm";
    $dbuser	= "root";
    $dbpass	= "root";
     
    // database connection
    
	try {
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		//$dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		exit;
	}
?>
