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

	if(isset($_REQUEST['itmid']))
	{
		$itmid = $_REQUEST['itmid'];
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
	$tid=$itmid;
	
	$sql_tbl=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	
	$tot=mysqli_num_rows($sql_tbl);		
	$arrival_id=$row_tbl['packaging_id'];

	$tdate=$row_tbl['packaging_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['packaging_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$sql_tblsub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
$subtid=0;
?>
	

<table align="center" border="1" width="852" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
	<td colspan="8" align="center" class="tblheading">Add Packaging Slip - MMC - Print Preview</td>
</tr>
<tr height="15">
	<td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>

<tr class="Light" height="30">
	<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
	<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>
	
	<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
	<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
	<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['packaging_slipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
$upsize=""; $tonops=0;
$sql_tbl_sub24=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
while($subtbltot24=mysqli_fetch_array($sql_tbl_sub24))
{
	$upsize=$subtbltot24['packagingsubsub_upssize'];
	$tonops=$tonops+$subtbltot24['packagingsubsub_nop'];
}
$sql_bar=mysqli_query($link,"select  * from tbl_barcodestmp where plantcode='$plantcode' and bar_tid='".$arrival_id."' and bar_subid='".$row_tblsub['packagingsub_id']."' and bar_logid='".$row_tbl['packaging_logid']."' and bar_psrn='".$row_tbl['packaging_slipno']."'") or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
?>
<tr class="Light" height="30">
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Barcode&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltblheading" id="barserch">&nbsp;<input type="text" name="barcode" class="tbltext" size="10" maxlength="9" value="<?php echo $row_bar['bar_barcodes'];?>" onblur="barcheck(this.value)" onkeyup="searchbarcode(this.value)" onkeypress="return isNumberKey24(event)"  readonly="true"  style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="bardupchk" value="0" /></td>
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Gross MMC Weight&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltblheading">&nbsp;<input type="text" name="weight" id="w" class="tbltext" size="6" maxlength="6" onchange="chkmlt1(this.value);" onkeypress="return isNumberKey1(event)" value="<?php echo $row_bar['bar_grosswt'];?>"  readonly="true"  style="background-color:#CCCCCC"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>		

</table>
<br />
<?php
	$ptp=0;
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="852" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="79" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="130" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="115" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="95" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">Existing Pchs</td>
	<td width="75" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
    <td width="80" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="65" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Remarks</td>
	<td width="27" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="39" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>
<?php
$srno=1; 
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$lotno=""; $exqty=""; $expch=""; $upss=""; $nomps=""; $nopchs=""; $blpch=""; $nobarc="";
$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{
	$lotno=$row_tbl_subsub2['packagingsubsub_lotno']; 
	$exqty=$row_tbl_subsub2['packagingsubsub_extqty']; 
	$expch=$row_tbl_subsub2['packagingsubsub_extnop']; 
	$upss=$row_tbl_subsub2['packagingsubsub_upssize']; 
	$nomps=1; 
	$nopchs=$row_tbl_subsub2['packagingsubsub_nop']; 
	$remarks=$row_tbl_subsub2['packagingsubsub_remarks']; 
	$blpch=$row_tbl_subsub2['packagingsubsub_balpch']; 
	$nobarc=1; 
	
	$upspacktype=$upss;
	$packtp=explode(" ",$upspacktype);
	if($packtp[1]=="Gms")
	{ 
		$ptp=(($packtp[0]*$nopchs)/1000);
	}
	else
	{
		$ptp=$packtp[0]*$nopchs;
	}
	$totpcqty=$totpcqty+$ptp;
	
	$difq="";$difq1="";
	$sloc=""; $sloc1=""; $cnt++; 
	
	$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_upssize='$upss' order by packagingsubsub_id asc") or die(mysqli_error($link));
	$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
	while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
	{
	
		$lnt=explode(",",$row_tbl_subsub['packagingsubsub_lotno']);
		foreach($lnt as $lntno)
		{
			if($lntno<>"" && $lntno==$lotno)
			{
			
			 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
			
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
			
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['packagingsubsub_subbin']."' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
			
			$nomp=$row_tbl_subsub['packagingsubsub_nomp']; 
			$nop=$row_tbl_subsub['packagingsubsub_nopch']; 
			$totp=$row_tbl_subsub['packagingsubsub_totpch']; 
			
			$diq=explode(".",$row_tbl_subsub['packagingsubsub_totqty']);
			if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_tbl_subsub['packagingsubsub_totqty'];}
			
			if($sloc!=""){
			$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
			else{
			$sloc=$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
			}	
		}
	}
	
	$sql_crop=mysqli_query($link,"Select * from  tblcrop where cropid='".$row_tbl_sub['packagingsub_crop']."'") or die(mysqli_error($link));
	$row_crop=mysqli_fetch_array($sql_crop);
	
	$sql_variety=mysqli_query($link,"Select * from  tblvariety where varietyid='".$row_tbl_sub['packagingsub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_variety);
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crop['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_variety['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $nopchs;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crop['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_variety['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $nopchs;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
</tr>
<?php
}
$srno++;
}
}
}
?>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
