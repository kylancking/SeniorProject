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
?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>
<?php
$query = "select distinct firstname,lastname,reqid,userid,date from requests inner join externalusers on requests.userid = externalusers.id where fulfilled
= 1;
";
$stmt = $mysqli-> prepare($query);
$stmt -> execute();
?>
<link rel="stylesheet" href="home2.css">

<center>
<table bordercolor = "ffffff" border="5">
<thead>
<th>Recipient</th><th>Date</th><th></th>
</thead>
<tbody>
<?php
$reqid = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 echo "<tr>";
 echo "<td hidden>".$row['reqid']."</td>";

 echo "<td hidden>".$row['userid']."</td>";
 echo "<td>".$row['firstname'].' '.$row['lastname']."</td>";
 echo "<td>".$row['date']."</td>";
 echo "<td><a href='viewrequestworker.php?id=" . $row['reqid'] ."'style='color:blue'>View Request</a></td>";

}
?>
</tbody>
<style>
td,th{
color:black;
background-color:white;
}

</style>

