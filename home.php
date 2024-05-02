<?php
require_once('session.php');

require_once('database.php');
require_once('functions.php');

$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['submit2'])){
 header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/createuser.php");
}

if(isset($_POST['submit'])){
 if(isset($_POST['username']) && $_POST['username'] !== "" && isset($_POST['password']) && $_POST['password'] !== ""){
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $query = "Select * from externalusers where username = ?";
  $stmt = $mysqli->prepare($query);
  $stmt -> execute([$username]);
  if($stmt){
   $row = $stmt -> fetch();
   
   if(password_check($password,$row["hashed_password"])){
    $_SESSION['username'] = $username;
          $_SESSION['userid'] = $row['id'];
      header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/externalpage.php");
   }else{
    $_SESSION['message'] = "Password Incorrect";
   }//end if password === row
  }//end if stmt

 }else{
  $_SESSION['message'] = "Username/Password not Submitted";
 }//end if password and user submitted
 

}//check if form submitted




?>
<link rel="stylesheet" href="home2.css">

<center><h1 style=color:white; size=larger;>Recipient Login</h1></center>
<center><img src="PantryPal_copy.jpg" alt="Logo" width = "300" height = "300" class="bordered-image"></center>
<br>
<br>
<form action="home.php" method = "post">
<center><label for="username" style=color:white;>Username: </label>
<input type="text" name="username"></center>
<center><label for="password" style=color:white;>Password: </label>
<input type="password" name="password"></center>
<center><input type="submit" name="submit" value="Submit"></center>
<center><input type="submit" name="submit2" value="Create Account"></center>
<?php if (($output = message()) !== null) {
	echo '<center><a style="color: white; background-color: #002147; padding: 5px 10px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 25px;">'.$output.'</a><center>';
}?>


</form>
<br/><br/><br/>
<center><a href='home2.php'>Workers Sign in Here</a></center>
