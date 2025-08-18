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
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Packaged Barcodes</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

		<tr class="tblsubtitle" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading">#</td>
			 <td width="11%" align="center" valign="middle" class="tblheading">Barcode</td>
			 <td width="9%" align="center" valign="middle" class="tblheading">Pack Type</td>
			 <td width="13%" align="center" valign="middle" class="tblheading">Gross Weight</td>
             <td width="12%" align="center" valign="middle" class="tblheading">Net Weight</td>
			 <td width="13%" align="center" valign="middle" class="tblheading">Lot Net Weight</td>
			 <td width="16%" align="center" valign="middle" class="tblheading">UPS</td> 
			 <td align="center" valign="middle" class="tblheading">Status</td>
         </tr>
<?php
if($ttype=="PACKSMC")
{
	$srno=1;
	//echo "select * from tbl_mpmain where mpmain_lotno='".$pid."' and mpmain_trtype='PACKSMC'";
	$sql_eindent_sub=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_lotno='".$pid."' and mpmain_trtype='PACKSMC'") or die(mysqli_error($link));
	while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
	{
		$barcode=""; $grwt=""; $netwt=""; $lotnetwt=""; $ups=""; $status="";
		if($row_eindent_sub['mpmain_dflg']==1){$status="Dispatch";}
		else if($row_eindent_sub['mpmain_dflg']==2){$status="Loaded";}
		else if($row_eindent_sub['mpmain_upflg']==1){$status="Unpackaged";}
		else if($row_eindent_sub['mpmain_alflg']==2){$status="Allocated";}
		//else{$status="Allocated";}
		$barcode=$row_eindent_sub['mpmain_barcode'];
		$sql_grwt=mysqli_query($link,"select * from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
		$row_grwt=mysqli_fetch_array($sql_grwt);
		
		$grwt=$row_grwt['bar_grosswt'];
		$netwt=$row_eindent_sub['mpmain_wtmp'];
		$lotnetwt=$row_eindent_sub['mpmain_wtmp'];
		$ups=$row_eindent_sub['mpmain_upssize'];
		
	?>		  
	 <tr class="Light" height="20">
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
		<td align="center" class="smalltbltext" valign="middle"><?php echo $barcode;?></td>
		<td align="center" class="smalltbltext" valign="middle"><?php echo "SMC";?></td>
		<td align="center" class="smalltbltext" valign="middle"><?php echo $grwt;?></td>
		<td align="center" class="smalltbltext" valign="middle"><?php echo $netwt;?></td>
		<td align="center" class="smalltbltext" valign="middle"><?php echo $lotnetwt;?></td>
		<td width="16%" align="center" valign="middle" class="tbltext"><?php echo $ups;?></td>
		<td width="21%" align="center" valign="middle" class="tbltext"><?php echo $status;?></td>
	</tr>
	<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
	<?php
	$srno=$srno+1;	
	}
}
else if($ttype=="ALL")
{
	$srno=1;
	//echo "select * from tbl_lot_ldg_pack where lotno='".$pid."' and (trtype='PNPSLIP' or trtype='PACKSMC' or trtype='PACKMMC' or trtype='PACKLMC') and balnomp>0";
	$sql_pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$pid."' and (trtype='PNPSLIP' or trtype='PACKSMC' or trtype='PACKMMC' or trtype='PACKLMC') and balnomp>0") or die(mysqli_error($link));
	
	while($row_pack=mysqli_fetch_array($sql_pack))
	{
		if($row_pack['trtype']=="PACKSMC" || $row_pack['trtype']=="PNPSLIP")
		{
		//echo "select * from tbl_mpmain where mpmain_trid='".$row_pack['lotldg_id']."' and mpmain_upssize='".$row_pack['packtype']."' and mpmain_trtype='PACKSMC'";
			$sql_eindent_sub=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trid='".$row_pack['lotldg_id']."' and mpmain_upssize='".$row_pack['packtype']."' and mpmain_trtype='PACKSMC'") or die(mysqli_error($link));
		while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
		{
			$barcode=""; $grwt=""; $netwt=""; $lotnetwt=""; $ups=""; $status="";
			if($row_eindent_sub['mpmain_dflg']==1){$status="Dispatch";}
			else if($row_eindent_sub['mpmain_dflg']==2){$status="Loaded";}
			else if($row_eindent_sub['mpmain_upflg']==1){$status="Unpackaged";}
			else if($row_eindent_sub['mpmain_alflg']==2){$status="Allocated";}
			else{$status="Available";}
			$barcode=$row_eindent_sub['mpmain_barcode'];
			//echo "select * from tbl_barcodes where bar_barcode='".$barcode."'";
			$sql_grwt=mysqli_query($link,"select * from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
			$row_grwt=mysqli_fetch_array($sql_grwt);
			$grwt=$row_grwt['bar_grosswt'];
			$netwt=$row_eindent_sub['mpmain_wtmp'];
			$lotnetwt=$row_eindent_sub['mpmain_wtmp'];
			$ups=$row_eindent_sub['mpmain_upssize'];
			
		?>		  
		 <tr class="Light" height="20">
			<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $barcode;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo "SMC";?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $grwt;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $netwt;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $lotnetwt;?></td>
			<td width="16%" align="center" valign="middle" class="tbltext"><?php echo $ups;?></td>
			<td width="21%" align="center" valign="middle" class="tbltext"><?php echo $status;?></td>
		</tr>
		<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
		<?php
		$srno=$srno+1;	
		}
		}
		else
		{
		$sql_eindent_sub=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trid='".$row_pack['lotldg_id']."' and mpmain_trtype='".$row_pack['trtype']."'") or die(mysqli_error($link));
		while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
		{
			$lotmmc=$row_eindent_sub['mpmain_lotno'].",";
			$ups2=$row_eindent_sub['mpmain_upssize'].",";
			$lot=explode(",",$lotmmc);
			$ups3=explode(",",$ups2);
			$ltcount=count($lot);
			for($s=0; $s<=$ltcount; $s++)
			{
			if($lot[$s]==$pid)
			{
			$barcode=""; $grwt=""; $netwt=""; $lotnetwt=""; $ups=""; $status=""; $ptype="";
			if($row_eindent_sub['mpmain_dflg']==1){$status="Dispatch";}
			else if($row_eindent_sub['mpmain_dflg']==2){$status="Loaded";}
			else if($row_eindent_sub['mpmain_upflg']==1){$status="Unpackaged";}
			else if($row_eindent_sub['mpmain_alflg']==2){$status="Allocated";}
			//else{$status="Allocated";}
			$barcode=$row_eindent_sub['mpmain_barcode'];
			$netwt=$row_eindent_sub['mpmain_wtmp'];
			$ups=$ups3[$s];
			//$ptype="SMC";
			if($row_eindent_sub['mpmain_trtype']=="PACKLMC")
			{
				$ptype="LMC";
				
				
			}
			else if($row_eindent_sub['mpmain_trtype']=="PACKMMC")
			{
				$ptype="MMC";
				$sql_mmcwt=mysqli_query($link,"select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='".$row_eindent_sub['mpmain_trid']."' and dmmc_lotno='".$pid."'") or die(mysqli_error($link));
				$row_mmcwt=mysqli_fetch_array($sql_mmcwt);
				$grwt=$row_mmcwt['dmmc_grosswt'];
				$netwt=$row_mmcwt['dmmc_wtmp'];
				$lotnetwt=$row_mmcwt['dmmc_qty'];
				
			}
			
		?>		  
		 <tr class="Light" height="20">
			<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $barcode;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $ptype;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $grwt;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $netwt;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $lotnetwt;?></td>
			<td width="13%" align="center" valign="middle" class="tbltext"><?php echo $ups;?></td>
			<td width="16%" align="center" valign="middle" class="tbltext"><?php echo $status;?></td>
		</tr>
		<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
		<?php
		$srno=$srno+1;	
		}
		}
		}
		}
	}
}
else
{
	$srno=1;
	echo "select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$pid."' and trtype='$ttype' and balnomp>0";
	$sql_pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$pid."' and trtype='$ttype' and balnomp>0") or die(mysqli_error($link));
	
	while($row_pack=mysqli_fetch_array($sql_pack))
	{
		$sql_eindent_sub=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trid='".$row_pack['lotldg_id']."' and mpmain_trtype='".$row_pack['trtype']."'") or die(mysqli_error($link));
		while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
		{
			$lotmmc=$row_eindent_sub['mpmain_lotno'].",";
			$ups2=$row_eindent_sub['mpmain_upssize'].",";
			$lot=explode(",",$lotmmc);
			$ups3=explode(",",$ups2);
			$ltcount=count($lot);
			for($s=0; $s<=$ltcount; $s++)
			{
			if($lot[$s]==$pid)
			{
				$barcode=""; $grwt=""; $netwt=""; $lotnetwt=""; $ups=""; $status="";
				if($row_eindent_sub['mpmain_dflg']==1){$status="Dispatch";}
				else if($row_eindent_sub['mpmain_dflg']==2){$status="Loaded";}
				else if($row_eindent_sub['mpmain_upflg']==1){$status="Unpackaged";}
				else if($row_eindent_sub['mpmain_alflg']==2){$status="Allocated";}
				$barcode=$row_eindent_sub['mpmain_barcode'];
				$netwt=$row_eindent_sub['mpmain_wtmp'];
				$ups=$ups3[$s];
				if($row_eindent_sub['mpmain_trtype']=="PACKLMC")
				{
					$ptype="LMC";
				}
				else if($row_eindent_sub['mpmain_trtype']=="PACKMMC")
				{
					$ptype="MMC";
					$sql_mmcwt=mysqli_query($link,"select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='".$row_eindent_sub['mpmain_trid']."' and dmmc_lotno='".$pid."'") or die(mysqli_error($link));
				$row_mmcwt=mysqli_fetch_array($sql_mmcwt);
				$grwt=$row_mmcwt['dmmc_grosswt'];
				$netwt=$row_mmcwt['dmmc_wtmp'];
				$lotnetwt=$row_mmcwt['dmmc_qty'];
				}
			
		?>		  
		 <tr class="Light" height="20">
			<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $barcode;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $ptype;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $grwt;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $netwt;?></td>
			<td align="center" class="smalltbltext" valign="middle"><?php echo $lotnetwt;?></td>
			<td width="13%" align="center" valign="middle" class="tbltext"><?php echo $ups;?></td>
			<td width="16%" align="center" valign="middle" class="tbltext"><?php echo $status;?></td>
		</tr>
		<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
		<?php
		$srno=$srno+1;	
		}
		}
		}
	}
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
</form>
</td></tr>
</table>

</body>
</html>
