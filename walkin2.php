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

$uid = $_SESSION['walkin'];
date_default_timezone_set('America/Chicago');
$currentDate = date('Y-m-d');

$query = "select * from items";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([]);

if(isset($_POST['submit'])){
 $boolean = true;
 for($x = 1; $x<=27;$x++){
 $qty = $_POST[$x];
 $queryqty = "select qty from items where itemid = ?";
 $stmtqty = $mysqli ->prepare($queryqty);
 $stmtqty-> execute([$x]);
 $row = $stmtqty->fetch(PDO::FETCH_ASSOC);
 $available = $row['qty'];
 if($available < $qty){
 $boolean = false;
 header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/walkin2.php");
   $_SESSION['message'] = "Not Enough Inventory To Fulfill!";
 }
 }//end for
 if($boolean === true){
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

 $query3 = "update items set qty = IF(qty>=?, qty-?,qty) where itemid = ?";
 $stmt3 = $mysqli ->prepare($query3);
 $stmt3 -> execute([$qty,$qty,$x]);
 $row = $stmt3->rowCount();
 
 $query4 = "update externalusers set visits = visits+1 where id = ?";
 $stmt4 = $mysqli-> prepare($query4);
 $stmt4 -> execute([$uid]);
}//if
}//for
 header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/closedrequests.php");

}//if true

}//submit

?>
<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<center><h1 style="color:white;">Food Given</h1></center>
<form action="walkin2.php" method = "post">
<?php
if($stmt){
 while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
  $description = $row['description'];
  //$quantity = $row['qty'];
  $id = $row['itemid'];
   echo '<center><p style="color:white; font-size: larger;">'.$description.'<br/><input type="number" min = "0" max = "200" id="quantity" name="'.$id.'" value = "0" required></center>';

 }
}
echo '<center><input type = "submit" name ="submit" value = "Submit"></center>';
?>
</form>

