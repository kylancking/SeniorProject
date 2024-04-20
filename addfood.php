<?php
require_once('database.php');
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
<center><h1 style="color:white;"> Update Food Counts</h1></center>
<form action="addfood.php" method = "post">
<?php
if($stmt){
 while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
  $description = $row['description'];
  $quantity = $row['qty'];
  $id = $row['itemid'];
   echo '<center><p>'.$description.'<br/><input type="number" min = "0" max = "200" id="quantity" name="'.$id.'" value = "'.$quantity.'" required></center>';

 }
}
echo '<center><input type = "submit" name ="submit" value = "Submit"></center>';
?>
</form>
