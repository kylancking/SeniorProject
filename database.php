<?php
class Database {
 private static $mysqli = null;
  public function __construct() {
    die('Init function error');
  }

  public static function dbConnect() {
	//try connecting to your database
	require_once("/home/kcking2/DBking.php");
	
	try{
		$mysqli = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, USERNAME, PASSWORD);
		//echo "Successful Connection";
	}
 	catch(PDOException $e){
		echo "Error!: ". $e->getMessage()."<br />";
		die("Could not connect to server".DBNAME."<br />");
	}
 
    return $mysqli;
  }

  public static function dbDisconnect() {
    $mysqli = null;
  }
}
?>
