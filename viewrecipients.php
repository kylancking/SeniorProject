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

$query = "select id,username,concat(firstname,' ',lastname) as `name`,concat(street,' ',city,', ',state,' ',zip) as `address`,concat(substring(phonenumber,1,3),'-',substring(phonenumber,4,3),'-',substring(phonenumber,7)) as `number`,visits  from externalusers";
$stmt = $mysqli->prepare($query);
$stmt->execute();
?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='searchrec.php'>Search</a>
<a href='logout2.php'>Logout</a>

</div>
<link rel ="stylesheet" href="home2.css">

   <title>Employee Information</title>

<body>
        <center><h2 style="color:white;">Recipient Information</h2><center>
	<center>
<table bordercolor = "ffffff" border="5">
        <thead>
        <tr>
	<th>Username</th>
	<th>Name</th>
	<th>Address</th>
	<th>Phone Number</th>
	<th>Visits</th>

       	<?php if($_SESSION['privilege'] === 0){echo'<th>Delete</th>';} ?>


        </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
        <td><?= $row['username'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['number'] ?></td>
        <td><?= $row['visits'] ?></td>


	<td hidden><?= $row['id']?></td>
	<?php
        if($_SESSION['privilege'] === 0){
	echo "<td><a href='deleterec.php?id=".urlencode($row['id'])."' onclick=\"return confirm('Are you sure you want to delete?');\" style='color:red'>X</a></td>";
	}
        ?>
        </tr>
        <?php endwhile; ?>
        </tbody>
        </table>
	</center>
    </div>
</body>
<style>
td,th{
color:black;
background-color:white;
}
</style>

</html>
</div>
