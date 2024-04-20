<?php
require_once('database.php');
require_once('session.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$uid = $_SESSION['walkin'];
date_default_timezone_set('America/Chicago');
$currentDate = date('Y-m-d');

$query = "select * from items";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([]);

if(isset($_POST['submit'])){
 $query1 = "insert into requests values(NULL,?,?,'1')";
 $stmt1 = $mysqli -> prepare($query1);
 $stmt1 -> execute([$uid,$currentDate]);

 $request_id = $mysqli->lastInsertId();
for($x=1;$x<=27;$x++){
 if(isset($_POST[$x]) && $_POST[$x] > 0){
  $qty = $_POST[$x];
  $query2 = "insert into itemrequests values(?,?,?)";
  $stmt2 = $mysqli -> prepare($query2);
 $stmt2 -> execute([$request_id,$x,$qty]);
 }
}
if($stmt1 and $stmt2){
 header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/internalpage.php");
}
}
?>
<link rel="stylesheet" href="home2.css">
<center><h1 style="color:white;">Food for x</h1></center>
<form action="walkin2.php" method = "post">
<?php
if($stmt){
 while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
  $description = $row['description'];
  //$quantity = $row['qty'];
  $id = $row['itemid'];
   echo '<center><p>'.$description.'<br/><input type="number" min = "0" max = "200" id="quantity" name="'.$id.'" value = "0" required></center>';

 }
}
echo '<center><input type = "submit" name ="submit" value = "Submit"></center>';
?>
</form>
