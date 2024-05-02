<?php
require_once('database.php');
require_once('session.php');
if (($output = message()) !== null) {
	echo '<center><a style="color: white; background-color: #002147; padding: 5px 10px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 25px;">'.$output.'</a><center>';
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home.php");
}
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<div class="navbar">
<a href='externalpage.php'>Back to Home</a>
<a href='logout.php'>Logout</a>

</div>
<?php
if (($output = message()) !== null) {
	echo'<center><a style="color:white;">'.$output.'</a></center>';
}
?>
<?php
$userid = $_SESSION['userid'];
$query = "select distinct firstname, lastname,reqid,userid,date,fulfilled from requests inner join externalusers on requests.userid=externalusers.id where id = ?;
";
$stmt = $mysqli-> prepare($query);
$stmt -> execute([$userid]);
?>
<link rel="stylesheet" href="home2.css">

<center>
<table bordercolor = "ffffff" border="5">
<thead>
<th>Request Number</th><th>Date</th><th>Fulfilled</th><th>View</th><th>Delete</th>
</thead>
<tbody>
<?php
$reqid = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 if($row['fulfilled'] === 0){
  $fulfill = "Not Fulfilled Yet";
 }else{
  $fulfill = "Request Has Been Fulfilled";
 }

 echo "<tr>";
 echo "<td hidden>".$row['reqid']."</td>";

 echo "<td hidden>".$row['userid']."</td>";
 echo "<td>".$row['reqid']."</td>";
 echo "<td>".$row['date']."</td>";
 echo "<td>".$fulfill."</td>";
 echo "<td><a href='viewrequest.php?id=" . $row['reqid'] ."'style='color:blue'>View Request</a></td>";
 if($row['fulfilled'] === 0){
 echo "<td><a href='deletereq.php?id=" . $row['reqid'] ."' onclick=\"return confirm('Are you sure you want to delete your food request?');\"style='color:red'>X</a></td>";
 }else{
 echo "<td>Request Cannot Be Deleted</td>";
 }




}
?>
</tbody>
<style>
td,th{
color:black;
background-color:white;
text-align: center;
}

</style>
