<?php
require_once('database.php');
require_once('functions.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if(isset($_POST['submit'])){

}

?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<link rel="stylesheet" href="home2.css">

<center><h1 style="color:white;">Search by Values</h1></center>
<form action="query1.php" method = "get">

<center><label for="username" style="color: white; font-size: larger;">Username: </label>
</br>
<input type="text" name="username"></center>
<center><label for="first"style="color: white; font-size: larger;">First Name: </label>
</br>
<input type="text" name="first"></center>
<center><label for="last" style="color: white; font-size: larger;">Last Name: </label>
</br>
<input type="text" name="last"></center>
<center><label for="city"style="color: white; font-size: larger;">City: </label>
</br>
<input type="text" name="city"></center>
<center><label for="state" style="color: white; font-size: larger;">State: </label>
</br>
<input type="text" name="state"></center>
<center><label for="city"style="color: white; font-size: larger;">Zip: </label>
</br>
<input type="text" name="zip"></center>
<center><label for="visits"style="color: white; font-size: larger;">Visits: </label>
</br>
<input type="text" name="visits"></center>



<center><input type = "submit" name="submit" value="Search"></center>


</form>