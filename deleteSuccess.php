<?php include_once('includes/dbconn.php'); //include the Connection to database ?>

<?php
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql="DELETE FROM success_stories WHERE id='".$id."' ";
$result=$conn->query($sql);
echo ("<script language='javascript'> window.alert('Deleted successfully')</script>");
echo "<meta http-equiv='refresh' content='0;url=viewsuccessstories.php'> ";
}
?>