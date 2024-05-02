<?php
require_once('database.php');
require_once('session.php');
if (($output = message()) !== null) {
	echo '<center><a style="color: white; background-color: #002147; padding: 5px 10px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 25px;">'.$output.'</a><center>';
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home2.php");
}

$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "select * from items";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([]);

if(isset($_POST['submit'])){
 for($x = 1; $x<=27;$x++){
  $qty = $_POST[$x];
  $query2 = "update items set qty = ? where itemid = ?";
  $stmt2 = $mysqli -> prepare($query2);
  $stmt2 -> execute([$qty,$x]);
 }
 if($stmt2){
   header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/inventory.php");
 }
}
?>
<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='inventory.php'>Back to Inventory</a>
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<center><h1 style="color:white;"> Update Food Counts</h1></center>
<form action="addfood.php" method = "post">
<?php
if($stmt){
 while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
  $description = $row['description'];
  $quantity = $row['qty'];
  $id = $row['itemid'];
   echo '<center><p style="color:white; font-size: 20px;">'.$description.'<br/><input type="number" min = "0" max = "200" id="quantity" name="'.$id.'" value = "'.$quantity.'" required></center>';

 }
}
echo '<center><input type = "submit" name ="submit" value = "Submit"></center>';
?>
</form>
