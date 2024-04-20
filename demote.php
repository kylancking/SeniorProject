<?php
require_once("database.php");
require_once("session.php");
if (($output = message()) !== null) {
	echo $output;
}

$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = $_GET['id'];

$query = "update users set usertype = 1 where username = ?";
$stmt = $mysqli ->prepare($query);
$stmt ->execute([$username]);
if($stmt){
  $_SESSION['message'] = "".$username." has been successfully demoted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/viewworkers.php");

}else{
  $_SESSION['message'] = "".$username." could not be demoted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/viewworkers.php");

}
?>