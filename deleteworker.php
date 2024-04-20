<?php
require_once("database.php");
require_once("session.php");
if (($output = message()) !== null) {
	echo $output;
}

$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = $_GET['id'];

$query = "delete from users where username = ?";
$stmt = $mysqli ->prepare($query);
$stmt ->execute([$username]);
if($stmt){
  $_SESSION['message'] = "".$username." has been successfully deleted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/viewworkers.php");

}else{
  $_SESSION['message'] = "".$username." could not be deleted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/viewworkers.php");

}
?>