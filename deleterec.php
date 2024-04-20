<?php
require_once("database.php");
require_once("session.php");
if (($output = message()) !== null) {
	echo $output;
}

$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid = $_GET['id'];
$query = "delete from externalusers where id = ?";
$stmt = $mysqli ->prepare($query);
$query2 = "delete from requests where userid = ?";
$stmt2 = $mysqli ->prepare($query2);
$query3 = "delete from itemrequests where reqid in (select reqid from requests where userid = ?)";
$stmt3 = $mysqli ->prepare($query3);
$stmt3 ->execute([$userid]);
$stmt2 ->execute([$userid]);
$stmt ->execute([$userid]);
if($stmt){
  $_SESSION['message'] = "".$userid." has been successfully deleted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/viewrecipients.php");

}else{
  $_SESSION['message'] = "".$userid." could not be deleted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/viewrecipients.php");

}
?>