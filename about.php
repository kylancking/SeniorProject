<?php
require_once('session.php');
if (($output = message()) !== null) {
	echo '<center><a style="color: white; background-color: #002147; padding: 5px 10px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 25px;">'.$output.'</a><center>';
}
if(isset($_SESSION['username']) && $_SESSION['username'] !== ""){
}else{
  $_SESSION['message'] = "You must be logged in to access this page";
  header("Location: https://turing.cs.olemiss.edu/~kcking2/SeniorProject/home.php");
}

?>
<link rel="stylesheet" href="home2.css">
<div class="navbar">
<a href='externalpage.php'>Back to Home</a>
<a href='logout.php'>Logout</a>

</div>

<div class="container">
<center><h1>About Us</h1></center>
<center><p><b>What is PantryPal?</b><br/>PantryPal is a pantry management system for both recipients and pantry workers. PantryPal simplifies the process of tracking visitor and inventory information.<br/>
<b>How many times can I visit?</b><br/>As of now, the pantry will only accept visits from the same household 3 times in a year. If you need more assistance please contact us and our benevolence committee
will meet with you to discuss options.<br/><b>What is the Church's Affiliation with the Pantry?</b><br/>
The church supplies workers, funds, donations, and the pantry building. Membership is not required to receive food, still we welcome anyone to join us!<br/>
<b>How Can I Get in Contact With Someone Regarding the Food Pantry?</b><br/>
Please Feel Free to Contact the Church's Office at (662) 562-6331 or Come Stop By During Our Operation Hours: Tuesday and Thursday 9-12pm<br/>
Alternate Times Can Be Arranged if needed<br/><b>What Other Resources Are Available?</b><br/>
There are several alternatives if we cannot provide for every need.<br/>
<u><a href="https://www.facebook.com/p/Hope-Ministries-Resale-store-Food-Pantry-100086004550783/">Hope Ministries</a></u><br/>110 Robinson St Senatobia, MS<br/>(662)562-4673<br/>
<u><a href="https://southernusa.salvationarmy.org/Memphis/">Salvation Army</a></u><br />2679 Kirby Whitten Rd Memphis, TN<br/>(901)531-1770
</center>
</p>
</div>



<style>
background-color:green;
body{
color:white;
width: 50%;

}
.container {
 background-color: white;
 padding: 20px;
 max-width: 70%;
 width: 1000px;
 border-radius: 10px;
 margin: 0 auto;
 }
 h1, p {
 color: black; /* Set text color to black */
 }
</style>
