<ul>
<?php if (isset($_SESSION['loggedIn'])){ 
   if($_SESSION['category']=='admin'){ ?>
  <li><a href="adminhome.php">Add Alumni</a></li>
  <li><a href="viewalumni.php">Alumni</a></li>
  <li><a href="addsuccessstory.php">Add Success Stories</a></li>
  <li><a href="viewsuccessstories.php">Success Stories</a></li>
  
  <?php }else{?>
  <li><a href="studenthome.php">Profile</a></li>
  <li><a href="viewalumni.php">Alumni</a></li>
  <li><a href="addsuccessstory.php">Add Success Stories</a></li>
  <li><a href="viewsuccessstories.php">Success Stories</a></li>
  <?php }
    }else{?>
	<li><a href="index.php">Home</a></li>
  <li><a href="publicviewalumni.php">Alumni</a></li>
  <li><a href="publicviewsuccessstories.php">Success Stories</a></li>
	<?php }?>
	<li><a href="https://www.dkut.com">Main Site</a></li>
    <li><a href="contacts.php">Contacts</a></li>
</ul>