<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	$plantcode=$_SESSION['plantcode'];
	$plantcode1=$_SESSION['plantcode1'];
	$plantcode2=$_SESSION['plantcode2'];
	$plantcode3=$_SESSION['plantcode3'];
	$plantcode4=$_SESSION['plantcode4'];
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	if(isset($_GET['tp']))
	{
		$a = $_GET['tp'];	 
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<!--<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>-->
<!--- Calender code --->
<body>
<?php
$sql_gea=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss2_id='".$a."' ")or die(mysqli_error($link));
$row_gea=mysqli_fetch_array($sql_gea);
 $image1=$row_gea['gottestss2_image'];
 $image2=$row_gea['gottestss2_image2'];
 $image3=$row_gea['gottestss2_image3'];
 $image4=$row_gea['gottestss2_image4'];

 /*$path=$row_gea['gottestss2_image']; 

$imagename=explode("/",$path);  

echo $imagename[2]; */

?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">Gel Images</td>
</tr>
<tr class="Dark" height="25">
	<td width="166" align="center" valign="middle" class="tblheading">Image 1</td>
	<td width="167" align="center" valign="middle" class="tblheading">Image 2</td>
</tr>
<tr class="Light" height="25">
	<td width="166" align="center" valign="middle" class="smalltbltext"><img alt='#' src="<?php echo $image1;?>" height="300" /></td>
	<td width="167" align="center" valign="middle" class="smalltbltext"><img alt="#" src="<?php echo $image2;?>" height="300"/></td>
</tr>
<tr class="Dark" height="25">
	<td width="166" align="center" valign="middle" class="tblheading">Image 3</td>
	<td width="167" align="center" valign="middle" class="tblheading">Image 4</td>
</tr>
<tr class="Light" height="25">
	<td width="166" align="center" valign="middle" class="smalltbltext"><img alt='#' src="<?php echo $image3;?>" height="300" /></td>
	<td width="167" align="center" valign="middle" class="smalltbltext"><img alt='#' src="<?php echo $image4;?>" height="300"/></td>
</tr>
</table>
</body>
</html>
