<?php
require_once('database.php');
require_once('functions.php');
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
//$uname = $_SESSION['username'];

if(isset($_POST['submit'])){
 $phone = $_POST['phone'];
 $user = $_POST['username'];
 $pass = $_POST['password'];
 $first = $_POST['first'];
 $last = $_POST['last'];
 $street = $_POST['street'];
 $city = $_POST['city'];
 $state = $_POST['state'];
 $zip = $_POST['zip'];
 $encrypt = password_encrypt($pass);

 $query = "select * from externalusers where street = ? OR username = ?";
 $stmt = $mysqli -> prepare($query);
 $stmt -> execute([$street,$user]);
 if($stmt -> rowCount() < 1){
  $query2 = "insert into externalusers values (NULL,?,?,?,?,?,?,?,?,?,0)";
  $stmt2 = $mysqli-> prepare($query2);
  $stmt2 -> execute([$user,$encrypt,$first,$last,$phone,$street,$city,$state,$zip]);
  if($stmt2){
 $request_id = $mysqli->lastInsertId();

   $_SESSION['walkin'] = $request_id;
   //$_SESSION['username'] = $uname;
   header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/walkin2.php");
  }
 }else{
  $_SESSION['message'] = "Account Already Created";
   header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/walkin.php");
 }
 
}
?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<link rel="stylesheet" href="home2.css">

<center><h1 style="color:white;"> Create Account</h1></center>
<form action="walkin.php" method = "post">
<center><label for="username" style="color: white; font-size: larger;">Username: </label>
</br>
<input type="text" name="username" required></center>
<center><label for="password"style="color: white; font-size: larger;">Password: </label>
</br>
<input type="password" name="password" required></center>
<center><label for="first"style="color: white; font-size: larger;">First Name: </label>
</br>
<input type="text" name="first" required></center>
<center><label for="last"style="color: white; font-size: larger;">Last Name: </label>
</br>
<input type="text" name="last" required></center>
<center><label for="phone"style="color: white; font-size: larger;">Phone Number (No Dashes): </label>
</br>
<input type="text" name="phone" pattern="[0-9]{10}" title="Please only input numerical digits in format xxx-xxx-xxxx" required></center>

<center><label for="street"style="color: white; font-size: larger;">Street: </label>
</br>
<input type="text" name="street" required></center>
<center><label for="city"style="color: white; font-size: larger;">City: </label>
</br>
<input type="text" name="city" required></center>
<center><label for="state"  style="color: white; font-size: larger;">State: </label>
</br>
<input type="text" name="state" pattern="[A-Z]{2}" required></center>
<center><label for="zip"style="color: white; font-size: larger;">Zip Code: </label>
</br>
<input type="text" name="zip" pattern="[0-9]{5}" title="Please only input numerical digits in format xxxxx" required></center>
<center><input type = "submit" name="submit" value="Create"></center>


</form>
?>