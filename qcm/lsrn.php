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
	$pid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>QC Manager-Transaction Soft Release - LSRN</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_softr where softr_id='".$tid."'") or die(mysqli_error($link));
$row_srmain=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_srmain['softr_id'];


	$tdate=$row_srmain['softr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Lot Soft Release Note (LSRN)</font></td>
</tr>
</table><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 

 <tr class="Dark" height="30">
<td width="178" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="195"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SF".$row_srmain['softr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="164" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="203" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_srmain['softr_crop']."' order by cropname Asc")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($quer3);
?>
<td width="178" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia['cropname'];?></td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_srmain['softr_variety']."' order by popularname Asc")or die(mysqli_error($link)); 
$noticia4 = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia4['popularname'];?></td>
  </tr>

<?php
/*
?>  
  <tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading" colspan="2">Display List Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="2">&nbsp;<?php if($row_srmain['softr_typ']=="sllot"){ echo "Complete Lot List";} else { echo "Sub Bin wise Lot List";}?></td>
</tr>
<?php
if($row_srmain['softr_typ']=="slbin")
{
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whid='".$row_srmain['softr_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where binid='".$row_srmain['softr_bin']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where sid='".$row_srmain['softr_subbin']."' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
$slocdetails=$noticia_whd1['perticulars']."/".$noticia_bing1['binname']."/".$noticia_subbing1['sname'];
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading" colspan="2">SLOC Details&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2">&nbsp;<?php echo $slocdetails;?></td>
</tr>
<?php
}
*/
?>
</table>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="24%" align="left" rowspan="2" valign="left" class="tblheading">&nbsp;&nbsp;</td>
</tr>
</table>

<?php
	$crop = $row_srmain['softr_crop'];	 
	$variety = $row_srmain['softr_variety'];	 
	$type = $row_srmain['softr_typ'];	 
	$wh = $row_srmain['softr_wh'];	 
	$bin = $row_srmain['softr_bin'];	 
	$subbin = $row_srmain['softr_subbin'];	 

$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softr_id='".$tid."'") or die(mysqli_error($link));
$tot_srsub=mysqli_num_rows($sql_srsub);
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">
<tr class="tblsubtitle" height="30">
	<td width="18" align="center" valign="middle" class="tblheading">#</td>
	<td width="96" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="51" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="66" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="70" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="57" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="56" align="center" valign="middle" class="tblheading">Germ %</td>
	<td width="75" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td width="195" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="87" align="center" valign="middle" class="tblheading">Soft Release</td>
</tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_srsub))
{

$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $stage="";	$sloc="";

$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  orlot='".$row_arr_home['softrsub_lotno']."'  and lotldg_balqty > 0  ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$row_arr_home['softrsub_lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0  and (lotldg_got='UT' OR lotldg_got='RT' OR lotldg_qc='UT' OR lotldg_qc='RT')") or die(mysqli_error($link)); 


 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_issuetbl['lotldg_balbags'];
 $slqty=$slqty+$row_issuetbl['lotldg_balqty'];
 
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
}

$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_arr_home['softrsub_lotno']."'  and balqty > 0  ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_arr_home['softrsub_lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0  and (lotldg_got='UT' OR lotldg_got='RT' OR lotldg_qc='UT' OR lotldg_qc='RT')") or die(mysqli_error($link)); 


 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$row_issuetbl['balqty']; 
	//$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

//$slups=$slups+$row_issuetbl['lotldg_balbags'];
 $slqty=$row_issuetbl['balqty'];
 
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
}

if($srno%2!=0)
{
?>
<tr class="Light" height="30">
	<td width="18" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="96" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['softrsub_lotno'];?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="66" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="195" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="87" align="center" valign="middle" class="tblheading"><?php echo ucwords($row_arr_home['softrsub_srtyp']);?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
	<td width="18" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="96" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['softrsub_lotno'];?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="66" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="195" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="87" align="center" valign="middle" class="tblheading"><?php echo ucwords($row_arr_home['softrsub_srtyp']);?></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
<?php
if($tot_srsub==0)
{
?>
<tr class="Light" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="11">Record not fount</td>
</tr>
<?php
}
?>
</table>
<br />
<br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />--></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
