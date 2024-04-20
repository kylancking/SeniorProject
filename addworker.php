<?php
require_once('database.php');
require_once('functions.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if(isset($_POST['submit'])){
 $username = $_POST['username'];
 $password = $_POST['password'];
 $role = $_POST['role'];
 $encrypt = password_encrypt($password);

 $query = "select * from users where username = ?";
 $stmt = $mysqli -> prepare($query);
 $stmt -> execute([$username]);
 if($stmt -> rowCount() < 1){
  $query2 = "insert into users values (?,?,?)";
  $stmt2 = $mysqli-> prepare($query2);
  $stmt2 -> execute([$username,$encrypt,$role]);
  if($stmt2){
   header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/internalpage.php");
   $_SESSION['message'] = "User ".$username." Created";
  }
 }else{
  echo "Account Already Created";
 }
 
}

?>
<div class="navbar">
<a href='internalpage.php'>Back to Home</a>
<a href='logout2.php'>Logout</a>

</div>

<link rel="stylesheet" href="home2.css">

<center><h1 style="color:white;"> Create Worker Account</h1></center>
<form action="addworker.php" method = "post">

<center><label for="username" style="color: white; font-size: larger;">Username: </label>
</br>
<input type="text" name="username" pattern="[a-zA-Z0-9]+" title="Please enter alphanumeric characters only" required></center>
<center><label for="password"style="color: white; font-size: larger;">Password: </label>
</br>
<input type="password" name="password" required></center>
<center><label for="role"style="color: white; font-size: larger;">Role: </label>
<select id="role" name="role">
            <option value="0">Admin</option>
            <option value="1">Worker</option>
        </select>


<center><input type = "submit" name="submit" value="Create"></center>


</form>