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

	if(isset($_REQUEST['lotno']))
	{
		$lotno = $_REQUEST['lotno'];
	}
	if(isset($_REQUEST['ups']))
	{
		$ups = $_REQUEST['ups'];
	}
	if(isset($_REQUEST['crop']))
	{
		$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['variety']))
	{
		$variety = $_REQUEST['variety'];
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
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  	<form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	<input name="frm_action" value="submit" type="hidden"> 
<?php
$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;

$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_balqty > 0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=explode(",", $row_mps['mpmain_crop']);
		$verarr=explode(",", $row_mps['mpmain_variety']);
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=explode(",", $row_mps['mpmain_upssize']);
		$noparr=explode(",", $row_mps['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($lotno==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nops=$nops+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtys=$ptp*$nops; $nomps=$nomps+$ct; 
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_balqty > 0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=explode(",", $row_mpl['mpmain_crop']);
		$verarr=explode(",", $row_mpl['mpmain_variety']);
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpl['mpmain_upssize']);
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($lotno==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopl=$nopl+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtyl=$ptp*$nopl; $nompl=$nompL+$ct; 
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_balqty > 0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($lotno==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$nopm+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtym=$ptp*$nopm; $nompm=$nompm+$ct; 
	}
}

?>
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Packaged Details</td>
</tr>
<tr class="Light" height="30">
	<td width="25%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
	<td width="25%" align="center" valign="middle" class="smalltblheading">SMC</td>
	<td width="25%"  align="center" valign="middle" class="smalltblheading">LMC</td>
	<td width="25%" align="center" valign="middle" class="smalltblheading">MMC</td>
</tr>
<tr class="Light" height="30">
	<td width="25%" align="center" valign="middle" class="smalltblheading">Qty in Kgs.</td>
	<td width="25%" align="center" valign="middle" class="smalltblheading"><?php echo $qtys;?></td>
	<td width="25%"  align="center" valign="middle" class="smalltblheading"><?php echo $qtyl;?></td>
	<td width="25%" align="center" valign="middle" class="smalltblheading"><?php echo $qtym;?></td>
</tr>
<tr class="Light" height="30">
	<td width="25%" align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="25%" align="center" valign="middle" class="smalltblheading"><?php echo $nomps;?></td>
	<td width="25%"  align="center" valign="middle" class="smalltblheading"><?php echo $nompl;?></td>
	<td width="25%" align="center" valign="middle" class="smalltblheading"><?php echo $nompm;?></td>
</tr>
<tr class="Light" height="30">
	<td width="25%" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="25%" align="center" valign="middle" class="smalltblheading"><?php echo $nops;?></td>
	<td width="25%"  align="center" valign="middle" class="smalltblheading"><?php echo $nopl;?></td>
	<td width="25%" align="center" valign="middle" class="smalltblheading"><?php echo $nopm;?></td>
</tr>
</table>

<table align="center" cellpadding="5" cellspacing="5" border="0" width="550">
<tr >
<td align="right"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
