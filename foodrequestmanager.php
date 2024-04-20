<?php
require_once('database.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$query = "select distinct firstname,lastname,reqid,userid,date from requests inner join externalusers on requests.userid = externalusers.id where fulfilled
!= 1;
";
$stmt = $mysqli-> prepare($query);
$stmt -> execute();
?>
<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<center>
<table border-color =#ffff>
<thead>
<th>Recipient</th><th>Date</th><th>Complete</th>
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
 echo "<td><a href='fulfill.php?id=" . $row['userid'] ."&reqid=" . $row['reqid']."'style='color:blue '>Fulfill</a></td>";
}
?>
</tbody>
<style>
td,th{
color:black;
background-color:white;
}

</style>

