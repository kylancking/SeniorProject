<?php
require_once('database.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userid = $_GET['id'];
$requestid = $_GET['reqid'];
//$query = "select firstname,lastname,userid,reqid,description,quantity from itemrequests natural join items natural join requests join externalusers on
//externalusers.id=requests.userid";
$query = "select userid,reqid,itemid,description,quantity from itemrequests natural join items natural join requests where userid = ? and reqid = ?";
$query2 = "select * from items order by description asc";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([$userid,$requestid]);
$stmt2 = $mysqli -> prepare($query2);
$stmt2 -> execute();

if(isset($_POST['submit'])){
$uid = $_POST['uid'];
$requestid = $_POST['requestid'];
 for($x = 1; $x<=27;$x++){
 $qty = $_POST[$x];
 $query3 = "update items set qty = IF(qty>=?-1, qty-?,0) where itemid = ?";
 $stmt3 = $mysqli ->prepare($query3);
 $stmt3 -> execute([$qty,$qty,$x]);

 $query5 = "update itemrequests set quantity = ? where reqid = ? and itemid = ?";
 $stmt5 = $mysqli -> prepare($query5);
 $stmt5 -> execute([$qty,$requestid,$x]);

}

 $query6 = "update externalusers set visits = visits+1 where id = ?";
 $stmt6 = $mysqli-> prepare($query6);
 $stmt6 -> execute([$uid]);

 $query4 = "update requests set fulfilled = 1 where reqid = ?";
 $stmt4 = $mysqli -> prepare($query4);
 $stmt4 -> execute([$requestid]);
 
 

 if($stmt3 and $stmt4){
    header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/foodrequestmanager.php");
 }else{
  echo "Not enough inventory to fulfill!";
 }
}
?>

<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='foodrequestmanager.php'>Back to Open Requests</a>
<a href='logout2.php'>Logout</a>
</div>
<center><h1 style="color:white;"> Fulfill Food Requests</h1></center>
<form action="fulfill.php" method = "post">
<input type="hidden" name="requestid" value="<?= $requestid ?>">
<input type="hidden" name="uid" value="<?= $userid ?>">
<?php
 $requesteditems = [];

if($stmt){
 //$quantities = [];
 while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
  $requestedItems[$row['itemid']] = $row['quantity'];
 }
 while($row2 = $stmt2 ->fetch(PDO::FETCH_ASSOC)){
     $rowuserid = $row2['userid'];
     $itemid = $row2['itemid'];
     $quantity = array_key_exists($itemid, $requestedItems) ? $requestedItems[$itemid] : 0;
     $description = $row2['description'];
     echo '<center><p style="color:white; font-size: larger;">'.$description.'<br/><input type="number" min = "0" max = "200" id="quantity" name="'.$itemid.'" value = "'.$quantity.'" required></center>';
 }

}
echo '<center><input type = "submit" name ="submit" value = "Fulfill Request"></center>';
?>
</form>
