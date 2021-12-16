<?php include_once('includes/dbconn.php'); //include the Connection to database ?>
<?php require_once('includes/header.php'); //include the template top ?>

<div id="top">
   <div id="clockDisplay" class="clock">
   </div>
   
   <div id="session">
 <?php  require_once('includes/session.php'); //include the session ?>
   </div>
   
   <div id="logout"> <?php echo "<form action='logout.php'> <input type='submit' id='logoutbtn' value='Log Out' /> </form>" ?> </div>
</div>
<div id="nav">
<?php require_once('includes/nav.php'); //include the nav ?>
</div>

<div id="container">

<div id="views">
<?php
$sql="SELECT * FROM success_stories ORDER BY id DESC";
$result=$conn->query($sql);
if($result->num_rows>0){
//Set up table and table heading
echo " <table border='2' id='userstable' cellpadding='5'><tr>  <th>Name</th> <th>Contacts</th> <th>Story</th>"; if (isset($_SESSION['loggedIn'])){ echo "<th colspan='2' '></th>";} echo "</tr>";
//Getting case details from database and display them on table in web page
while($row=$result->fetch_assoc()){
echo "<tr>
<td> ".$row["name"]."</td>
<td> ".$row["contacts"]." </td>
<td> ".$row["story"]." </td>"; 

if (isset($_SESSION['loggedIn'])){ echo "<td>  <a href='editsuccessstories.php?edit=$row[id]'>Edit</a></td>
<td>  <a href='javascript:confirm_delete_success($row[id])'>Delete</a></td>";}

 echo "</tr>";}
echo "</table> ";

}
else{
//When case table is empty
echo ("<script language='javascript'> window.alert('No Records Found')</script>");
if (isset($_SESSION['loggedIn'])){
   if($_SESSION['category']=='admin'){echo "<meta http-equiv='refresh' content='0;url=adminhome.php'> ";}
   else{echo "<meta http-equiv='refresh' content='0;url=studenthome.php'> ";}
}else{
echo "<meta http-equiv='refresh' content='0;url=index.php'> ";}
}
?>
</div>
</div>

<?php require_once('includes/footer.php'); //include footer template ?>
