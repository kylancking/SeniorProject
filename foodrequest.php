<?php
require_once('database.php');
require_once('session.php');
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home.php");
}

$username = $_SESSION['username'];
$uid = $_SESSION['userid'];
date_default_timezone_set('America/Chicago');
$currentDate = date('Y-m-d');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "select itemid,description,qty from items order by description asc";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([]);
echo "<form method ='post'>";
?>
<div class="navbar">
<a href='externalpage.php'>Back to Home</a>
<a href='logout.php'>Logout</a>

</div>
<?php
echo "<center>";
echo "<h2><font color = 'white'>Request Food</font></h2>";
echo "<table>";
echo "<thead>";
echo "<tr><th><font color ='white' size = '+2'>Product</th><th><font color='white' size = '+2'>Need?</font></th></tr>";
echo "</thead>";
echo "<tbody>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
$value = $row['itemid'];
echo "<tr>";
echo "<td hidden>".$row['itemid']."</td>";
echo "<td><font color ='white'; size ='+2'>".$row['description']."</font></td>";
echo "<td><input type = 'checkbox' name = $value></td>";

echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>

 <input type ='submit' name = 'submit' value = 'Request'>
</form>
<?php
 //for($x = 1; $x<=$value; $x++){
 //if(isset($_POST[$x])){
 if(isset($_POST['submit'])){
 $query1 = "insert into requests values(NULL,?,?,'0')";
 $stmt1 = $mysqli -> prepare($query1);
 $stmt1 -> execute([$uid,$currentDate]);
}
 $request_id = $mysqli->lastInsertId();
 for($x=1;$x<=$value;$x++){
 if(isset($_POST[$x])){
  $query2 = "insert into itemrequests values(?,?,2)";
  $stmt2 = $mysqli -> prepare($query2);
  $stmt2 -> execute([$request_id,$x]);
 }
}
if($stmt1 && $stmt2){
 $_SESSION['message'] = "Request Successfully Made";
 header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/externalpage.php");

}
 //}
//}
?>
<link rel="stylesheet" href="home2.css">
