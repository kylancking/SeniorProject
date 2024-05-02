<?php
require_once('session.php');
if (($output = message()) !== null) {
	echo '<center><a style="color: white; background-color: #002147; padding: 5px 10px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 25px;">'.$output.'</a><center>';
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home.php");
}

$reqid = $_GET['id'];
require_once('database.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requestid = $_GET['reqid'];
$query = "select itemid,reqid,description,quantity from requests natural join itemrequests natural join items where reqid = ?";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([$reqid]);
?>
<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='externalpage.php'>Back to Home</a>
<a href='priorfood.php'>Back to Requests</a>
<a href='logout.php'>Logout</a>

</div>

<?php echo'<center><h1 style="color:white;">Request ID '.$reqid.'</h1></center>'; ?>

<center>
<table bordercolor = "ffffff" border="5">
<thead>
<th>Items Given</th><th>Quantity</th>
</thead>
<tbody>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 echo "<tr>";
 echo "<td>".$row['description']."</td>";
 echo "<td>".$row['quantity']."</td>";
}
?>
</tbody>
<style>

td,th{
color:black;
background-color:white;
border: 1px green;
text-align: center;
}

</style>