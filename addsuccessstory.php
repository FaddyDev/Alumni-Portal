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
<fieldset><legend>Add Success Story</legend>
<form action="addsuccessstory.php" method="post" > 
                  <table>
				  <tr> <td>Reg No:</td> <td>
				  <select  name='regno' required>
                   <option value=''>--Select Regno--</option>
				   
				   <?php if($_SESSION['category']=='student'){ //use ur own regno
					echo " <option value='".$_SESSION['loggedIn']."'>".$_SESSION['loggedIn']."</option>";	}					   
											 
											 else{ 
				   
				  $sql="SELECT * FROM alumni ORDER BY id ASC";
                  $result=$conn->query($sql);
                  if($result->num_rows>0){
                  while($row=$result->fetch_assoc()){
				  echo " <option value='".$row["regno"]."'>".$row["regno"]."</option>";}
				  echo "</select>";
					 }
					 else{
					 //When table is empty
					 echo ("<script language='javascript'> window.alert('No Records Found')</script>");
					 if (isset($_SESSION['loggedIn'])){
   					 if($_SESSION['category']=='admin'){echo "<meta http-equiv='refresh' content='0;url=adminhome.php'> ";}
   					 else{echo "<meta http-equiv='refresh' content='0;url=studenthome.php'> ";}
					 }else{
					 echo "<meta http-equiv='refresh' content='0;url=index.php'> ";}
					 } }?> </td></tr>
 <tr> <td>Contacts:</td> <td> <input type="text"  id="in" placeholder="contacts" name="contacts" required/>
 </td></tr>
				  
				  <tr><td>Story:</td><td><textarea name='story' required/></textarea></td></tr>
					  
	<tr><td><input type="reset" size="10" value="Clear" id="submit" /></td><td><input type="submit" size="10" value="Save"id="submit" /></td></tr>
        </table></form></fieldset>
</div>

<div id="side">
<img src="images/gallery/03.jpg" width="320" height="312"/>
</div>

</div>

<?php require_once('includes/footer.php'); //include footer template ?>


<?php
if (!empty($_POST)) {
$regno = $_POST['regno'];
$contacts = $_POST['contacts'];
$story = $_POST['story'];

//Confirm that all fields are set
if(isset($regno) & isset($contacts) & isset($story) ) 
{
$regno=mysqli_real_escape_string($conn,$regno); 
$contacts=mysqli_real_escape_string($conn,$contacts); 
$story=mysqli_real_escape_string($conn,$story); 

//get name
        $name='';
        $sql="SELECT * FROM alumni WHERE regno='".$regno."' ";
        $result=$conn->query($sql);
         if($row1=$result->fetch_assoc()){$name=$row1["name"];} 

$sql = "insert into success_stories (regno,name,contacts,story)  values ( '".$regno."','".$name."','".$contacts."','".$story."')";
$query=mysqli_query($conn,$sql);

if(!$query){die("Not submitted ".mysqli_error($conn));}
else{
echo ("<script language='javascript'> window.alert('Success story saved successfully')</script>");
echo "<meta http-equiv='refresh' content='0;url=addsuccessstory.php'> ";}

}
else { 
echo ("<script language='javascript'> window.alert('Kindly fill all fields')</script>");
echo "<meta http-equiv='refresh' content='0;url=addsuccessstory.php'> ";}
}
?>
