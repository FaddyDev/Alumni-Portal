<?php include_once('includes/dbconn.php'); //include the Connection to database ?>
<?php require_once('includes/header.php'); //include the template top ?>
<div id="top">
   <div id="clockDisplay" class="clock">
   </div>
   
   <div id="session">
 <?php require_once('includes/session.php'); //include the session ?>
   </div>
   
   <div id="logout"> <?php echo "<form action='logout.php'> <input type='submit' id='logoutbtn' value='Log Out' /> </form>" ?> </div>
</div>
<div id="nav">
<?php require_once('includes/nav.php'); //include the nav ?>
</div>

<div id="container">

<div id="main">
<h1 align="center">Alumni Profile</h1>
<?php
$sql="SELECT * FROM alumni WHERE regno='".$_SESSION['loggedIn']."'";
$result=$conn->query($sql);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){
echo " 
<h2> Name:    ".$row["name"]." </h2>
<h2> Regno:   ".$row["regno"]." </h2>
<h2> IDNo:    ".$row["idno"]." </h2>
<h2> Course:  ".$row["course"]." </h2> 
<h2> Honours: ".$row["honours"]." </h2>
<h2> Completed on: ".$row["yoc"]." </h2>"; 
}
}
?>
</div>

<div id="side">
<form action="studenthome.php" method="post">
Uplolad profile pic: <input name="profpic" type="file" id="in" />
<input type="submit" name="submit" value="Upload" id="submit">
</form>
<img src="images/gallery/18.jpg" width="320" height="300"/>
</div>

</div>

<?php require_once('includes/footer.php'); //include footer template ?>

<?php
if (!empty($_POST)) {
function GetImageExtension($imagetype)
			 {
			 if(empty($imagetype)) return false;
			 switch($imagetype)
			 {
			 case 'image/bmp': return '.bmp';
			 case 'image/gif': return '.gif';
			 case 'image/jpeg': return '.jpg';
			 case 'image/png': return '.png';
			 default: return false;
			 }
			 }

if (!empty($_FILES["profpic"]["name"])) {
        
		
		$file_name=$_FILES["profpic"]["name"];
		$temp_name=$_FILES["profpic"]["tmp_name"];
		$imgtype=$_FILES["profpic"]["type"];
		$ext= GetImageExtension($imgtype);
		//$imagename=date("d-m-Y")."-".time().$ext;
		$imagename=$_SESSION['loggedIn'].$ext;
		$target_path = "uploads/profpics/".$imagename;

		
if(move_uploaded_file($temp_name, $target_path)) {

$sql = "update alumni set profpic='".$target_path."' WHERE regno='".$_SESSION['loggedIn']."' ";

$query=mysqli_query($conn,$sql);

if(!$query){die("Not submitted ".mysqli_error($conn));}
else{
echo ("<script language='javascript'> window.alert('Profile pic saved successfully')</script>");
echo "<meta http-equiv='refresh' content='0;url=studenthome.php'> ";}

 }else{
      echo ("<script language='javascript'> window.alert('Error')</script>");
     //exit("Error While uploading image on the server");
	 }
	 }
}
?>