<?php
require_once("database.php");
require_once("session.php");
$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$reqid = $_GET['id'];

$query = "delete from itemrequests where reqid = ?";
$query2 = "delete from requests where reqid = ?";
$stmt = $mysqli ->prepare($query);
$stmt2 = $mysqli -> prepare($query2);
$stmt -> execute([$reqid]);
$stmt2 ->execute([$reqid]);

if($stmt && $stmt2){
 $_SESSION['message'] = "Request has been successfully deleted";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/priorfood.php");
}else{
 $_SESSION['message'] = "Request could not be deleted";
 header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/priorfood.php");

}
?>