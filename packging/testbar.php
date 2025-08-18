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
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
	$barlotslist="";
	$sql_btslm=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='23' order by btslsub_id asc") or die(mysqli_error($link));
	while($row_btslm=mysqli_fetch_array($sql_btslm))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btslm['btslsub_barcode'];
		else
			$barlotslist=$row_btslm['btslsub_barcode'];
	}
$zxc=explode(",", $barlotslist);
foreach($zxc as $barc)
{
if($barc<>"")
{
$barc="*$barc*";
?>

<tr class="Light">
<td width="648" align="left" valign="middle" class="tbltext">&nbsp;<font face="Free 3 of 9" style="font-size:65px"><?php echo $barc;?></font></td>
</tr>
<tr class="Light">
<td width="648" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $barc;?></td>
</tr>
<?php
}
}
?>
</table>
</body>
</html>
