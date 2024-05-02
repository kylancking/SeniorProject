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


if(isset($_POST['submit'])){
 $username = $_POST['username'];
 $password = $_POST['password'];
 $role = $_POST['role'];
 $encrypt = password_encrypt($password);
 if($role === '0'){
 $query = "select * from users where username = ?";
}else{
 $query = "select * from externalusers where username = ?";
}
 $stmt = $mysqli -> prepare($query);
 $stmt -> execute([$username]);
 if($stmt -> rowCount() === 1){
  if($role === '0'){
   $query2 = "update users set hashed_password = ? where username = ?";
   $stmt2 = $mysqli->prepare($query2);
   $stmt2 -> execute([$encrypt,$username]);
  }else{
   $query2 = "update externalusers set hashed_password = ? where username = ?";
   $stmt2 = $mysqli->prepare($query2);
   $stmt2 -> execute([$encrypt,$username]);
  }//row count  
  if($stmt2){
   header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/internalpage.php");
   $_SESSION['message'] = "User Password Updated";
 }else{
  $_SESSION['message'] = "Password Could Not Be Updated";
 }
 
}else{
 $_SESSION['message'] = "No User Found";
}
}//submit

?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<link rel="stylesheet" href="home2.css">

<center><h1 style="color:white;">Update User Password</h1></center>
<form action="changepassword.php" method = "post">

<center><label for="username" style="color: white; font-size: larger;">Username: </label>
</br>
<input type="text" name="username" pattern="[a-zA-Z0-9]+" title="Please enter alphanumeric characters only" required></center>
<center><label for="password"style="color: white; font-size: larger;">Password: </label>
</br>
<input type="password" name="password" required></center>
<center><label for="role"style="color: white; font-size: larger;">Role: </label>
<select id="role" name="role">
            <option value="0">Internal</option>
            <option value="1">External</option>
        </select>


<center><input type = "submit" name="submit" value="Update"></center>


</form>