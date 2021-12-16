<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” 
http://www.w3.org/TR/xhtml/DTD/xhtml-strict.dtd>
<html>
<head>
<title>DeKUT Alumni</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/scripts.js"></script>
<!-- Add Dropzone -->
<link rel="stylesheet" type="text/css" href="css/dropzone.css" />
<script type="text/javascript" src="js/dropzone.js"></script>

<script type="text/javascript">
function confirm_delete_alumni(id)
{
 if(confirm('This record will be deleted parmanently.\n Are you sure you want to continue?'))
 {
  window.location.href='deleteAlumni.php?del='+id;
 }
 else{window.location.href='viewAlumni.php';}
}



function confirm_delete_success(id)
{
 if(confirm('This record will be deleted parmanently.\n Are you sure you want to continue?'))
 {
  window.location.href='deleteSuccess.php?del='+id;
 }
 else{window.location.href='viewsuccessstories.php';}
}

</script>
<script type="text/javascript">
function reloadPage()
{
 window.location.href='#.php';
}
</script>
</head>
<body onLoad="renderTime();" oncontextmenu="return false">

<div id="header">
DeKUT ALUMNI
</div>

