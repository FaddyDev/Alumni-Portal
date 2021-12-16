<?php
session_start();
unset($_SESSION['duration']);
unset($_SESSION['startTime']);
unset($_SESSION['loggedIn']);
unset($_SESSION['category']);
header('Location:index.php');
?>
