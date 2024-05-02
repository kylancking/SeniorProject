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

$query = "select itemid,description,qty from items";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([]);
?>
<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='addfood.php'>Add Food</a>
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>
<center>
<table bordercolor = "ffffff" border="5">
<thead>
<th>Item</th><th>Quantity</th>
</thead>
<tbody>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

 echo "<tr>";
 echo "<td hidden>".$row['itemid']."</td>";
 echo "<td>".$row['description']."</td>";
 echo "<td>".$row['qty']."</td>";
 //echo "<td><a href='updateitem.php?id=" . $row['itemid'] ."'>Edit</a><td>";

}
?>
</tbody>
<style>
td,th{
color:black;
background-color:white;
}

</style>
