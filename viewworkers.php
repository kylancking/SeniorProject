<?php
require_once("database.php");
require_once('session.php');
if (($output = message()) !== null) {
	echo '<center><a style="color: white; background-color: #002147; padding: 5px 10px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 25px;">'.$output.'</a><center>';
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home2.php");
}
require_once("functions.php");

$username = $_SESSION['username'];
$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "select username,description,typeid  from users join utype where users.usertype=utype.typeid";
$stmt = $mysqli->prepare($query);
$stmt->execute();
?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>
<link rel ="stylesheet" href="home2.css">

    <title>Employee Information</title>

<body>
        <center><h2 style='color:white;'>Employee Information</h2><center>
	<center>
<table class="custom-table">
        <thead>
	<th>Username</th>
	<th>Role</th>
	<th>Delete</th>
	<th>Change Privilege</th>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
        <td><?= $row['username'] ?></td>
        <td><?= $row['description'] ?></td>
	<td hidden><?= $row['typeid']?></td>
	<?php
	if($row['username'] !== $username){
	echo "<td><a href='deleteworker.php?id=".urlencode($row['username'])."' onclick=\"return confirm('Are you sure you want to delete this worker?');\" style='color:red'>X</a></td>";
	}else{
	echo "<td>Cannot Delete Yourself</td>";
	}
	if($row['username'] !== $username){
	if($row['typeid'] === 0){
	echo "<td><a href='demote.php?id=".urlencode($row['username'])."'>Demote</a></td>";
	}else{
	echo "<td><a href='promote.php?id=".urlencode($row['username'])."'>Promote</a></td>";	
	}
	}else{
	echo "<td>Cannot Promote/Demote Yourself</td>";
	}
	?>
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
	</center>
</body>
<style>
.custom-table {
        border: 5px solid #ffffff;
    }
td,th{
color:black;
background-color:white;
text-align: center;
}
</style>
</html>
</div>
