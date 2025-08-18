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

	if(isset($_REQUEST['barcval']))
	{
		$barcval = $_REQUEST['barcval'];
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<script language='javascript'>

</script>
</head>
<body topmargin="0" >
<table width="100" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  	<form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	<input name="frm_action" value="submit" type="hidden"> 
<?php
$xyz=explode(",",$barcval);	
$conts=count($xyz);	
?>

<table align="center" border="1" width="100" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading">Barcodes</td>
</tr>

<?php
foreach($xyz as $sbinval)
{
if($sbinval<>"")
{ 

?>
<tr class="light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $sbinval;?></td>
</tr>
<?php
}
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="100">
<tr >
<td align="right"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
