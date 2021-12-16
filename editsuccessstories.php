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
<?php
//Just ensuring that we only continue if the user is logged in
if (isset($_SESSION['loggedIn']) ) 
{
if(isset($_GET['edit']))
{
$id=$_GET['edit'];
           $_SESSION['id']=$id;
$sql="SELECT * FROM success_stories WHERE id='".$id."' ";
$result=$conn->query($sql);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){ ?>
<?php if($_SESSION['category']=='student'){
     if($row["regno"]!=$_SESSION['loggedIn']){echo ("<script language='javascript'> window.alert('Not your story')</script>");
                                               echo "<meta http-equiv='refresh' content='0;url=viewsuccessstories.php'> ";}
											   
											   }?>
<fieldset><legend>Edit Success Story</legend>
<form action="editsuccessstories.php" method="post" > 
                  <table>
				  <tr> <td>Reg No:</td> <td>
				  <select  name='regno' <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> required>
				 <?php $sql="SELECT * FROM alumni ORDER BY id ASC";
                  $result=$conn->query($sql);
                  if($result->num_rows>0){
				  echo " <option value='".$row["regno"]."'>".$row["regno"]."</option>";
                  while($row1=$result->fetch_assoc()){
				  echo " <option value='".$row1["regno"]."'>".$row1["regno"]."</option>";}
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
					 } ?> 
					 </td></tr>
  <tr> <td>Contacts:</td> <td> <input type="text" value="<?php echo "".$row["contacts"]."";?>" id="in" placeholder="contacts" name="contacts" required/>
 </td></tr>
				  
				  <tr><td>Story:</td><td><textarea name='story' required/><?php echo "".$row["story"]."";}?></textarea></td></tr>
					  
	<tr><td><input type="reset" size="10" value="Clear" id="submit" /></td><td><input type="submit" size="10" value="Save"id="submit" /></td></tr>
        </table></form></fieldset>
		
		<?php
} 
else{
//When table is empty
echo ("<script language='javascript'> window.alert('No Records')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewsuccessstories.php'> ";}
}

}
else{
//When session is not set, go to home page directly
echo "<meta http-equiv='refresh' content='0;url=index.php'> ";}
?>
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
         if($row1=$result->fetch_assoc()){$name=$row1["name"]; }
		 
$sql = "update success_stories set regno='".$regno."',name='".$name."',contacts='".$contacts."',story='".$story."' WHERE id='".$_SESSION['id']."' ";
$query=mysqli_query($conn,$sql);

if(!$query){die("Not submitted ".mysqli_error($conn));}
else{
echo ("<script language='javascript'> window.alert('Success story saved successfully')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewsuccessstories.php'> ";}

}
else { 
echo ("<script language='javascript'> window.alert('Kindly fill all fields')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewsuccessstories.php'> ";}
}
?>
