<?php
require_once("database.php");
require_once("session.php");
require_once("functions.php");

//if (!isset($_SESSION["username"])) {
//    $_SESSION["message"] = "You must log in first";
//    header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home.php");
//}

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
<table>
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
	echo "<td><a href='deleteworker.php?id=".urlencode($row['username'])."' onclick=\"return confirm('Are you sure you want to delete?');\" style='color:red'>X</a></td>";
	if($row['typeid'] === 0){
	echo "<td><a href='demote.php?id=".urlencode($row['username'])."'>Demote</a></td>";
	}else{
	echo "<td><a href='promote.php?id=".urlencode($row['username'])."'>Promote</a></td>";	
	}
	?>
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
	</center>
</body>
<style>
td,th{
color:black;
background-color:white;
border: 1px green;
text-align: center;
}
table {
color: 5px color=white;
width: 60%
        }
</style>
</html>
</div>
