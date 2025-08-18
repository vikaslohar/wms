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
     
	if(isset($_REQUEST['pid']))
	{
		$itmid = $_REQUEST['pid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw - Transaction - Packaged Seed Release - BRN</title>
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<table width="780" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<?php
 $tid=$itmid;

$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];

	$tdate=$row_tbl['pswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['pswrem_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate2=$tday1."-".$tmonth1."-".$tyear1;
	
$sql_param=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);	
?>
<table align="center" border="1" width="780" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>
	
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<HR />
<tr height="20">
  <td colspan="6" align="center" class="Mainheading">Barcode Release Note (BRN)</td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "CR".$row_tbl['pswrem_code']."/".$row_tbl['yearcode']."/".$row_tbl['logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pswrem_dcno'];?>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['pswrem_ptype'];?></td>
</tr>
<?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['pswrem_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
if($row_tbl['pswrem_ptype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" width="234" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pswrem_state'];?></td>
<td align="right" width="172" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" width="229" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['pswrem_country'];?></td>
</tr>
<?php
}
?>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['pswrem_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3"><div style="padding-bottom:0px; padding-left:5px; padding-right:5px; padding-top:0px;"><?php echo $row3['address'];?><?php if($row3['city']!=""){ echo ", ".$row3['city'];}?> - <?php echo $row3['state'];?><?php if($row_tbl['pswrem_country']!=""){ echo ", ".$row_tbl['pswrem_country'];}?></div></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td align="center" valign="middle" class="tblheading" colspan="12">Barcode Details</td>
</tr>	
<tr class="light" height="20">
	<td align="center" valign="middle" class="tblheading" width="120">BC as per Excel</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_totrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC avbl for release</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_remrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC already released</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_relrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC not is system</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_nosrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC Invalid</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_invrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC duplicate</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_duprec'];?></td>
</tr>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#0BC5F4" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_bar where plantcode='$plantcode' pswrem_id='".$arrival_id."' order by barcodes") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="104" align="center" valign="middle" class="tblheading">Barcode</td>
	<td width="50" align="center" valign="middle" class="tblheading">Pack Type</td>
	<td width="105" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="115" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="91" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="118" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="65" align="center" valign="middle" class="tblheading">Lot Qty</td>
	<td width="65" align="center" valign="middle" class="tblheading">Qty Removed</td>
</tr>
<?php
$srno=1;
if($subtbltot > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	$lotno=""; $qty=""; $totqty=0; $crop=""; $variety=""; $lotno=""; $ups=""; $packtyp="";
	  
	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$row_tbl_sub['barcodes']."'") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	
	$pty=$row_tbl_sub['mptype'];
	if($pty=="PACKSMC")
	$packtyp="SMC";
	if($pty=="PACKLMC")
	$packtyp="LMC";
	if($pty=="PACKMMC")
	$packtyp="MMC";
		
	if($pty=="PACKSMC")
	{
		
		$lotno=$row_tbl_sub['mplotno'];
		$qty=$row_tbl_sub['mpwtmp'];
		$totqty=$row_tbl_sub['mpwtmp'];
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}
	else
	{
	
		$lotn=explode(",",$row_barcode1['mpmain_lotno']);
		foreach($lotn as $ltn)
		{
			if($ltn<>"")
			{
				if($lotno!="")
					$lotno=$lotno."<br/>".$ltn;
				else
					$lotno=$ltn;
			}
		}
		$ltnp=explode(",",$row_barcode1['mpmain_lotnop']);
		foreach($ltnp as $ltnop)
		{
			if($ltnop<>"")
			{
				$xc=explode(" ",$row_barcode1['mpmain_upssize']);
				if($xc[1]=="Gms")
				{
					$ptp=$xc[0]/1000;
				}
				else
				{
					$ptp=$xc[0];
				}
				$qt=$ptp*$ltnop;
				
				if($qty!="")
					$qty=$qty."<br/>".$qt;
				else
					$qty=$qt;
			}
		}
		$totqty=$row_tbl_sub['mpwtmp'];
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['barcodes'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $packtyp;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $variety;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['mpups'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $qty;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['barcodes'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $packtyp;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $variety;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['mpups'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $qty;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
  </tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />



<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
