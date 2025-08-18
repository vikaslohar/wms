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

$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;?>
	

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Packing Details</td>
</tr>


</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="18" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="63" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">Pack E/P</td>
	<td width="49" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty for Packing</td>
	<td width="38" rowspan="2" align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td align="center" rowspan="2" valign="middle" class="smalltblheading">CC</td>
	<td width="47"  rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="72"  rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="48" rowspan="2" align="center" valign="middle" class="smalltblheading">Total No. of Pchs</td>
	<td width="72" rowspan="2" align="center" valign="middle" class="smalltblheading">Label Nos.</td>	 
	<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of MP</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">Total No. of WB</td>
	<td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Loose WB</td>
	<td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Loose Pchs</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">Validity Upto</td>
	<td align="center" valign="middle" class="smalltblheading">PSW SLOC</td>
</tr>
<tr class="tblsubtitle">
    
	<td width="262" align="center" valign="middle" class="smalltblheading">SLOC | MP | Loose Pchs | Total Pchs | Total Qty</td>
  </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub3 where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nomp=$row_tbl_subsub['pnpslipsubsub_nomp']; 
$nop=$row_tbl_subsub['pnpslipsubsub_pouches']; 
$totp=$row_tbl_subsub['pnpslipsubsub_totpouches']; 

$diq=explode(".",$row_tbl_subsub['pnpslipsubsub_totqty']);
if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_tbl_subsub['pnpslipsubsub_totqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}

}	

	$tdate4=$row_tbl_sub['pnpslipsub_valupto'];
	$tyear4=substr($tdate4,0,4);
	$tmonth4=substr($tdate4,5,2);
	$tday4=substr($tdate4,8,2);
	$tdate4=$tday4."-".$tmonth4."-".$tyear4;
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/

$totnomp=0; $totwb=0; $totnop=0; $loosewb=0;

$sql_wbm=mysqli_query($link,"select distinct wb_mpbarcode from tbl_wbqrcode where wb_pnptrid='".$row_tbl['pnpslipmain_id']."' and wb_mpbarcode!='' and wb_mpbarcode IS NOT NULL ") or die(mysqli_error($link));
while($row_wbm=mysqli_fetch_array($sql_wbm))
{
	$totnomp=$totnomp+1;
}
$sql_wbs=mysqli_query($link,"select wb_nop, wb_mpqlinkflg from tbl_wbqrcode where wb_pnptrid='".$row_tbl['pnpslipmain_id']."' ") or die(mysqli_error($link));
while($row_wbs=mysqli_fetch_array($sql_wbs))
{
	$totwb=$totwb+1;
	$totnop=$totnop+$row_wbs['wb_nop'];
	if($row_wbs['wb_mpqlinkflg']==0) {$loosewb=$loosewb+1;}
}

if($row_tbl['pnpslipmain_trtype']!='wb'){$totnomp=$row_tbl_sub['pnpslipsub_nomp'];}

$labelnos=$row_tbl_sub['pnpslipsub_lblschar'].$row_tbl_sub['pnpslipsub_lblsno']." -- ".$row_tbl_sub['pnpslipsub_lbechar'].$row_tbl_sub['pnpslipsub_lbeno'];;

if($row_tbl_sub['pnpslipsub_elabelno']!='' && $row_tbl_sub['pnpslipsub_elabelno']!=NULL){$labelnos=$row_tbl_sub['pnpslipsub_slabelno']." -- ".$row_tbl_sub['pnpslipsub_elabelno'];}

if($row_tbl_sub['pnpslipsub_convtomp']=="Yes") $loosepouches=$row_tbl_sub['pnpslipsub_balpouch']; else $loosepouches=$row_tbl_sub['pnpslipsub_nop'];

if($row_tbl['pnpslipmain_trtype']='wb'){$loosepouches=$row_tbl_sub['pnpslipsub_loosepouches'];}


if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_plotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packtype'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pickpqty'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packloss'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packcc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_ups'];?></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nop'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $labelnos;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totwb;?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $loosewb;?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $loosepouches;?></td>
	<td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $totnomp;?></td>
	<td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $tdate4;?></td>
	<td width="262" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_plotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packtype'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pickpqty'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packloss'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packcc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_ups'];?></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nop'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $labelnos;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totwb;?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $loosewb;?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $loosepouches;?></td>
	<td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $totnomp;?></td>
	<td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $tdate4;?></td>
	<td width="262" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
</tr>
  <?php
}
$srno++;
}
}
?>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="970">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
