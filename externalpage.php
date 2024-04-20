<?php
require_once('session.php');
if (($output = message()) !== null) {
	echo $output;
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home.php");
}
require_once('database.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$user = $_SESSION['username'];
$userid = $_SESSION['userid'];

$query = "Select * from externalusers where username = ?";
$stmt = $mysqli->prepare($query);
$stmt -> execute([$user]);
if($stmt){
 $row = $stmt -> fetch();
 echo ". You have visited the food pantry ";
 echo $row['visits'];
 echo " times!";
}



?>
<div class="navbar">
<a href='foodrequest.php'>Request Food</a>
<a href='about.php'>About Us</a>
<a href='priorfood.php'>View Prior Food Requests</a>
<?php echo"<a href='editrec.php?id=$userid'>Edit Info</a>";?>
<a href='logout.php'>Logout</a>
</div>

<link rel="stylesheet" href="home2.css">
<center><img src="PantryPal_copy.jpg" alt="Logo" width = "300" height = "300" class="bordered-image"></center>

<?php


?>