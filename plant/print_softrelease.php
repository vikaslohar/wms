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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	$tid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction- Arrival From Fresh Seed</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
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
$sql_srmain=mysqli_query($link,"Select * from tbl_softr where softr_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_srmain=mysqli_num_rows($sql_srmain);
$row_srmain=mysqli_fetch_array($sql_srmain);

	$tdate=$row_srmain['softr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Soft Release</td>
</tr>

<tr class="Dark" height="30">
<td width="120" align="right" valign="middle" class="tblheading">Transaction Id&nbsp;</td>
<td width="242"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TSF".$row_srmain['softr_tcode']."/".$yearid_id."/".$lgnid;?></td>
<td width="106" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="272" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

 <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_srmain['softr_crop']."' order by cropname Asc")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($quer3);
?>
<td width="120" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="242" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia['cropname'];?></td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_srmain['softr_variety']."' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link)); 
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
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse">
<?php
	$crop = $row_srmain['softr_crop'];	 
	$variety = $row_srmain['softr_variety'];	 
	$type = $row_srmain['softr_typ'];	 
	$wh = $row_srmain['softr_wh'];	 
	$bin = $row_srmain['softr_bin'];	 
	$subbin = $row_srmain['softr_subbin'];	 

if($type=="sllot")	
{
$sql="SELECT distinct orlot FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'";
$sql2="SELECT distinct orlot FROM tbl_lot_ldg_pack WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'";
}
else
{
$sql="SELECT distinct orlot FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_whid='".$wh."' and lotldg_binid='".$bin."' and lotldg_subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='NUT' and lotldg_qc!='Fail' and lotldg_got!='Fail' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'";
$sql2="SELECT distinct orlot FROM tbl_lot_ldg_pack WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and whid='".$wh."' and binid='".$bin."' and subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='NUT' and lotldg_qc!='Fail' and lotldg_got!='Fail' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'";
}
$sql_qc=mysqli_query($link,$sql)or die(mysqli_error($link));
$sql_qc22=mysqli_query($link,$sql2)or die(mysqli_error($link));
$tt=mysqli_num_rows($sql_qc);
while($row_arr_home=mysqli_fetch_array($sql_qc))
{
	if($olt!="")
	$olt=$olt.",".$row_arr_home['orlot'];
	else
	$olt=$row_arr_home['orlot'];
}
while($row_arr_home22=mysqli_fetch_array($sql_qc22))
{
	if($olt!="")
	$olt=$olt.",".$row_arr_home22['orlot'];
	else
	$olt=$row_arr_home22['orlot'];
}
$countrec=0;

?>
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
$p_olt=explode(",",$olt);
//echo count($p_olt);
foreach($p_olt as $orlt)
{
if($orlt<>"")
{
$flg=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $stage="";	$sloc="";

/*$sql_qct=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home['orlot']."' and bflg=1 order by tid desc") or die(mysqli_error($link));
$tot_qct=mysqli_num_rows($sql_qct);
if($tot_qct==0)
{
$flg=1;
}*/
//echo $flg;
$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where  orlot='".$orlt."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_issue);
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$orlt."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
if($xxz=mysqli_num_rows($sql_issuetbl)>0)
{
//if($xxz==0)$flg=1;
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
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']); 
	if($row_issuetbl['lotldg_balqty'] > 0)
	{
		//if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		//{$flg=1;}
		if($tgot[0]=="GOT-R")
		{
			if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
			{$flg=1;}
			//if(($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT") && ($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT"))
			//{$flg=1;}
		}
	}
	//echo $tgot[0];
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

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_issuetbl['lotldg_balbags'];
$slqty=$slqty+$row_issuetbl['lotldg_balqty'];
 
/*if($stage!="")
$stage=$stage."<br/>".$row_issuetbl['lotldg_sstage'];
else*/
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
}
}
}
//echo $flg;
if($totqty>0 && $totnob==0)$totnob=1;

$sql_issue=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where orlot='".$orlt."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'") or die(mysqli_error($link));
if($zz=mysqli_num_rows($sql_issue)>0)
{
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$orlt."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT') and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
 $xxz=mysqli_num_rows($sql_issuetbl);
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$row_issuetbl['balqty']; 
	$totnob=$totnob+0; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']); 
	if($row_issuetbl['balqty'] > 0)
	{
		//if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		//{$flg=1;}
		if($tgot[0]=="GOT-R")
		{
			if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
			{$flg=1;}
			//if(($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT") && ($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT"))
			//{$flg=1;}
		}
	}
	//echo $tgot[0];
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

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+0;
$slqty=$row_issuetbl['balqty'];
 
/*if($stage!="")
$stage=$stage."<br/>".$row_issuetbl['lotldg_sstage'];
else*/
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
}
}
}
if($totqty<0)$totqty=0;
if($totqty==0)$flg++;
if($flg==0)
{
$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softr_id='".$tid."' and softrsub_lotno='".$orlt."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_srsub=mysqli_num_rows($sql_srsub);
if($tot_srsub > 0)
{
$row_srsub=mysqli_fetch_array($sql_srsub);
$countrec++;
if($srno%2!=0)
{
?>
<tr class="Light" height="30">
	<td width="18" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="96" align="center" valign="middle" class="tblheading"><?php echo $orlt;?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="66" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="195" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="87" align="center" valign="middle" class="tblheading"><?php echo ucwords($row_srsub['softrsub_srtyp']);?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
	<td width="18" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="96" align="center" valign="middle" class="tblheading"><?php echo $orlt;?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="66" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="195" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="87" align="center" valign="middle" class="tblheading"><?php echo ucwords($row_srsub['softrsub_srtyp']);?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
<?php
if($countrec==0)
{
?>
<tr class="Light" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="11">Record not fount</td>
</tr>
<?php
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
