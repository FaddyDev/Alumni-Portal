<?php include_once('includes/dbconn.php'); //include the Connection to database ?>
<?php require_once('includes/header.php'); //include the template top ?>
<div id="top">
   <div id="clockDisplay" class="clock">
   </div>
   <div id="session">
   </div>
   <div id="logout"></div>
</div>
<div id="nav">
<?php require_once('includes/nav.php'); //include the nav ?>
</div>

<div id="container">

<div id="main">
<img src="images/gallery/03.jpg" height="99%" width="99%" border="1" alt="DeKUT"/>
</div>

<div id="side">
<fieldset><legend>Alumni Login</legend>
<form action="index.php" method="post"><table>
<tr><td>Username:</td> <td><input type="text" name="username" id="log" placeholder="Enter Your Reg number"  required /></td></tr>
<tr><td>Password:</td> <td><input type="password" name="pass" id="log" placeholder="Enter Your I.D. number"  required/></td></tr>
<tr> <td><input type="reset" name="submit" value="Clear" id="submit"></td> <td><input type="submit" name="submit" value="Log In" id="submit"></td>				
</tr></table></form>
</fieldset>
<img src="images/gallery/18.jpg" width="320" height="312"/>
</div>

</div>

<?php require_once('includes/footer.php'); //include footer template ?>


<?php
if (!empty($_POST)) {
$usernm=$_POST['username'];
$pass=$_POST['pass'];

//Confirm that all fields are set
if(isset($usernm) & isset($pass) ) 
{
$sql="SELECT COUNT(*) FROM alumni WHERE(regno='".$usernm."' AND idno='".$pass."') ";
$query=mysqli_query($conn,$sql);
$result=mysqli_fetch_array($query);

if($result[0]>0){

session_start();
//session will stay alive for 180 seconds (3 mins)  if user stays idle
$duration=1800;
$_SESSION['duration']=$duration;
$_SESSION['startTime']=time();  //Get the current time
$_SESSION['loggedIn']=$usernm;
$_SESSION['category']='student';

header('Location:studenthome.php');

}
else{
echo ("<script language='javascript'> window.alert('Login failed, check username and password then try again')</script>");
echo "<meta http-equiv='refresh' content='0;url=index.php'> ";
}

}
else { 
echo ("<script language='javascript'> window.alert('Kindly fill all fields')</script>");
echo "<meta http-equiv='refresh' content='0;url=index.php'> ";}
}
?>