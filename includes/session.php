<?php
//Confirming that the user is logged in
session_start();
if (!(isset($_SESSION['loggedIn']))) 
{
	echo ("<script language='javascript'> window.alert('You are not Logged In,Please Log In to continue')</script>");
echo "<meta http-equiv='refresh' content='0;url=index.php'> ";}
else{

$duration=$_SESSION['duration'];
$startTime=$_SESSION['startTime'];

//If the difference btwn the current time and the session start time exceeds the duration, it means the users stayed idle for long, destroy session
if((time()-$startTime)>$duration){
unset($_SESSION['duration']);
unset($_SESSION['startTime']);
unset($_SESSION['loggedIn']);

echo ("<script language='javascript'> window.alert('Your session has expired, please log in again')</script>");
if($_SESSION['category']=='admin'){echo "<meta http-equiv='refresh' content='0;url=admin.php'> ";}
else{echo "<meta http-equiv='refresh' content='0;url=index.php'> ";}
}
else{
//keep updating the startime with the current time
$_SESSION['startTime']=time(); 
echo "You are logged in as <font color='white'>".$_SESSION['loggedIn']."</font>.";

// echo "<script type='text/javascript'> CountDown(10,'session')<//script> ";
}
}

?>