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

	
	$tp="MD";
	if(isset($_REQUEST['itmid']))
	{
	  $pid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['itmid1']))
	{
	  $ttype = $_REQUEST['itmid1'];
	}
	$lotno1=$pid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - MDN</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<table width="650" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<?php
$lotno12=$lotno1."P";
/*echo "select distinct lotldg_id from tbl_lot_ldg_pack where orlot='".$lotno1."' and (trtype='Qty-Rem' or trtype='Dispatch' or trtype='Dispatch TDF' or trtype='Stock Transfer Out' or trtype='Dispatch Bulk') order by lotldg_id asc";
$sql_pakdisp=mysqli_query($link,"select distinct lotldg_id from tbl_lot_ldg_pack where orlot='".$lotno1."' and trtype='Dispatch' order by lotldg_id asc") or die(mysqli_error($link));*/

?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Dispatched Barcodes</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="585" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="93" align="center" valign="middle" class="tblheading">Barcode</td>
	<td width="73" align="center" valign="middle" class="tblheading">Pack Type</td>
	<td width="98" align="center" valign="middle" class="tblheading">Gross Weight</td>
    <td width="90" align="center" valign="middle" class="tblheading">Net Weight</td>
	<td width="99" align="center" valign="middle" class="tblheading">Lot Net Weight</td>
	<td width="99" align="center" valign="middle" class="tblheading">UPS</td>  
</tr>
<?php
$srno=1;
//echo $ttype;
$sql_disp=mysqli_query($link,"select * from tbl_disp where disp_id='".$ttype."' AND plantcode='$plantcode' order by disp_id asc") or die(mysqli_error($link));
while($row_disp=mysqli_fetch_array($sql_disp))
{
	$sql_dispss=mysqli_query($link,"select * from tbl_dispsub_sub where disp_id='".$row_disp['disp_id']."' and dpss_lotno='".$lotno12."' AND plantcode='$plantcode' order by dpss_id asc") or die(mysqli_error($link));
	while($row_dispss=mysqli_fetch_array($sql_dispss))
	{
		$lotnetwt=0; $barcode=""; $bartype=""; $grwt=""; $netwt=""; $barups=""; $newups="";
		if($row_dispss['dpss_barcodetype']=="MMC")
		{
			$sql_dismmc=mysqli_query($link,"select * from tbl_dallocmmc where dmmc_barcode='".$row_dispss['dpss_barcode']."' and dmmc_lotno='".$lotno12."' AND plantcode='$plantcode' order by dmmc_id asc") or die(mysqli_error($link));
			while($row_dismmc=mysqli_fetch_array($sql_dismmc))
			{
				$lotnetwt=$lotnetwt+$row_dismmc['dmmc_qty'];
			}
		}
		else
		{
			$lotnetwt=$row_dispss['dpss_qty'];
		}
		 $barcode=$row_dispss['dpss_barcode'];
		 $bartype=$row_dispss['dpss_barcodetype'];
		 $grwt=$row_dispss['dpss_grosswt'];
		 $netwt=$row_dispss['dpss_qty'];
		 $barups=$row_dispss['dpss_ups'];
		 
		 $dq=explode(" ",$barups);
		 $dqs=explode(".",$dq[0]);
		 if($dqs[1]>0)
		 $aqs=$dqs[0].".".$dqs[1];
		 else
		 $aqs=$dqs[0];
		 $barups=$aqs." ".$dq[1];
		 
		 /*$zz=str_split($barups);
		 $upscount=count($zz);
		 for($s=0; $s<=$upscount; $s++)
		 {
		 	if($zz[$s]=".")
			$s=$upscount+1;
			else
			{
				$newups="".$zz[$s];
			}
		 }
		 echo $newups;*/
?> 
<tr class="Light" height="20">
	<td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="93" align="center" valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $bartype;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $grwt;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $netwt;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $lotnetwt;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $barups;?></td>
</tr>
<?php
$srno++;
}}?>
</table><br /><?php //}?>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
</form>
</td></tr>
</table>

</body>
</html>
