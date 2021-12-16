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
$sql="SELECT * FROM alumni WHERE id='".$id."' ";
$result=$conn->query($sql);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){ ?>
<fieldset><legend>Edit Alumni</legend>
<form action="editAlumni.php" method="post" > 
 <table>
<tr> <td>Reg No:</td> <td><input type="text" value="<?php echo "".$row["regno"]."";?>" <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> id="in" name="regno"  required/></td>

                           <td>
                            Name:
                        </td>
                        <td>
                            <input type="text" value="<?php echo "".$row["name"]."";?>" <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> id="in" name="name" required/>
                        </td></tr>
 <tr> <td>I.D. No:</td> <td> <input type="text"  id="in" value="<?php echo "".$row["idno"]."";?>" <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> name="id" onKeyPress="return numbersonly(event)" required/></td> 
					
                        <td>Course:</td><td><select  name="course" <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> required>
                  	<?php echo "<option value=".$row["course"].">".$row["course"]."</option>"; ?>
                  	 		<option value="IT">IT</option>
							<option value="BBIT">BBIT</option>
				</select></td> </tr>
				  
				  <tr><td>Honours:</td><td><select  name="honours" <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> required>
				  <?php echo "<option value=".$row["honours"].">".$row["honours"]."</option>"; ?>
				  <option value='First Class'>First Class</option>
				  <option value='2nd Upper'>2nd Upper</option>
				  <option value='2nd Lower'>2nd Lower</option>
				  <option value='Pass'>Pass</option>
							 </select></td>  
						
						  <td>Year Of Completion:</td><td><select  name="yoc" <?php if($_SESSION['category']!='admin'){echo "readonly=''";}?> required>
				  <?php echo "<option value=".$row["yoc"].">".$row["yoc"]."</option>";} ?><script>
  var myDate = new Date();
  var year = myDate.getFullYear();
  for(var i = 2000; i < year; i++){
	  document.write('<option value="'+i+'">'+i+'</option>');
  }
  </script>
							 </select></td>
						</tr>
					  <tr>
					  <td>
                        </td>
						
                        <td>
                           <input type="reset" size="10" value="Clear" id="submit" />
                        </td>
					
                        <td>
                            <input type="submit" size="10" value="Save"id="submit" />
                        </td>
                    </tr>
        </table></form></fieldset>
<?php
} 
else{
//When table is empty
echo ("<script language='javascript'> window.alert('No Records')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewAlumni.php'> ";}
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
$name = $_POST['name'];
$id = $_POST['id'];
$course = $_POST['course'];
$honours = $_POST['honours'];
$yoc = $_POST['yoc'];


//Confirm that all fields are set
if(isset($regno) & isset($name) & isset($id) & isset($course) & isset($honours) & isset($yoc) ) 
{
$regno=mysqli_real_escape_string($conn,$regno); 
$name=mysqli_real_escape_string($conn,$name); 
$id=mysqli_real_escape_string($conn,$id); 
$course=mysqli_real_escape_string($conn,$course); 
$honours=mysqli_real_escape_string($conn,$honours); 
$yoc=mysqli_real_escape_string($conn,$yoc);

$sql = "update alumni set regno='".$regno."',name='".$name."',idno='".$id."',course='".$course."',honours='".$honours."',yoc='".$yoc."' WHERE id='".$_SESSION['id']."' ";

$query=mysqli_query($conn,$sql);

if(!$query){die("Not submitted ".mysqli_error($conn));}
else{
echo ("<script language='javascript'> window.alert('Alumni details saved successfully')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewAlumni.php'> ";}

}
else { 
echo ("<script language='javascript'> window.alert('Kindly fill all fields')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewAlumni.php'> ";}
}
?>

