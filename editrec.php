<?php
require_once('database.php');
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$uid = $_GET['id'];
$query = "select * from externalusers where id = ?";
$stmt = $mysqli -> prepare($query);
$stmt -> execute([$uid]);

if(isset($_POST['submit'])){
$add = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];


  $query2 = "update externalusers set street = ?,city = ?,state = ?,zip = ?,phonenumber = ? where id = ?";
  $stmt2 = $mysqli -> prepare($query2);
  $stmt2 -> execute([$add,$city,$state,$zip,$phone,$uid]);
 if($stmt2){
   header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/externalpage.php");

 }
}

?>
<link rel="stylesheet" href="home2.css">
<center><h1 style="color:white;"> Update User Information</h1></center>
<form action="editrec.php" method = "post">
<?php
if($stmt){
 while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
  $address = $row['street'];
  $city = $row['city'];
  $state = $row['state'];
  $zip = $row['zip'];
  $phone = $row['phonenumber'];

  $id = $row['id'];
  // echo '<center><p>'.$description.'<br/><input type="number" min = "0" max = "200" id="quantity" name="'.$id.'" value = "'.$quantity.'" required></center>';
   echo '<center><p style="color:white; font-size:larger;">Address<br/><input type="text" id="address" name="address" value = "'.$address.'" required></center>';
   echo '<center><p style="color:white; font-size:larger;">City<br/><input type="text" id="city" name="city" value = "'.$city.'" required></center>';
   echo '<center><p style="color:white; font-size:larger;">State<br/><input type="text" id="state" name="state" value = "'.$state.'" required></center>';
   echo '<center><p style="color:white; font-size:larger;">Zip<br/><input type="text"pattern="[0-9]{5}" title="Please only input numerical digits in format xxxxx"  id="zip" name="zip" value = "'.$zip.'" required></center>';
   echo '<center><p style="color:white; font-size:larger;">Phone<br/><input type="text" pattern="[0-9]{10}" title="Please only input numerical digits in format xxx-xxx-xxxx" id="phone" name="phone" value = "'.$phone.'" required></center>';

 }
}
echo '<center><input type = "submit" name ="submit" value = "Submit"></center>';
?>
</form>
