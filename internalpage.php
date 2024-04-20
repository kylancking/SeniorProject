<?php
require_once('session.php');
if (($output = message()) !== null) {
	echo $output;
}

if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home2.php");
}

?>


<link rel="stylesheet" href="home2.css"> 
<form method = "post">
<div class="navbar">
  <a href="inventory.php">View Inventory</a>
  <a href="foodrequestmanager.php">Open Requests</a>
  <a href="closedrequests.php">Closed Requests</a>
  <a href="walkin.php">Walkin</a>
  <?php
  if($_SESSION['privilege'] === 0){
  echo '<a href="addworker.php">Add a Worker</a>';
  echo '<a href="viewworkers.php">View Workers</a>';
  }
  ?>
  <a href="viewrecipients.php">View Recipients</a>
  <a href="logout2.php">Logout</a>


</div>
<!-- <center><input type="submit" style="height:30px;width:150px" name="submit1" value="View Inventory"><br/><br/><input type="submit" style="height:30px;width:150px" name="submit2" value="View Food Requests"><br/><br/><input type="submit" style="height:30px;width:150px" name="submit3" value="View Closed Requests"><br/><br/><input type="submit" style="height:30px;width:150px" name="submit4" value="Walkin Visitor"><br/><input type="submit" style="height:30px;width:150px" name="submit5" value="Add Worker"><br/><input type="submit" style="height:30px;width:150px" name="submit6" value="View Workers"></center> -->
</form>

<br/><br/><br/>
<center><img src="PantryPal_copy.jpg" alt="Logo" width = "300" height = "300" class="bordered-image"></center>

<style>
.navbar a{
  padding: 14px 30px;

}
</style>