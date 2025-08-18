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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - Inter Variety Transfer - IVTN</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<?php 


	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<HR width="750" align="center" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Inter Variety Transfer Note (IVTN)</font></td>
</tr>
</table><br />	  

   <?php
	$sql1=mysqli_query($link,"select * from tbl_ivtmain where ivt_id='".$pid."' and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; $erid=0;
	$t=mysqli_num_rows($sql1);
	
	$tdate=$row['ivt_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
	$code="VT".$row['ivt_code']."/".$row['ivt_yearid']."/".$row['ivt_logid'];	
	$code1="VT".$row['ivt_ncode']."/".$row['ivt_yearid']."/".$row['ivt_logid'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">IVT&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;IVTN No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>
</tr>
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['ivt_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Dark" height="25">
   <td width="202"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden"  class="tbltext" name="txtclass" value="<?php echo $noticia_class['cropid'];?>"  /></td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_pvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver = mysqli_fetch_array($itemqry);
?>            
<td align="right" valign="middle" class="tblheading">Production Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="vitem" >&nbsp;<?php echo $noticia_ver['popularname'];?><input type="hidden"  class="tbltext" name="txtitem" id="itm" value="<?php echo $noticia_ver['varietyid'];?>"  /></td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
  <?php 
$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trfromvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver2 = mysqli_fetch_array($itemqry2);

$itemqry3=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trtovariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver3 = mysqli_fetch_array($itemqry3);
?>            
	<td align="right" valign="middle" class="tblheading">Transfer From Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="frvitem">&nbsp;<?php echo $noticia_ver2['popularname'];?><input type="hidden"  class="tbltext" name="txtfritem" id="fritm" value="<?php echo $noticia_ver2['varietyid'];?>"  /></td>
<td align="right" valign="middle" class="tblheading">Transfer To Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="tovitem">&nbsp;<?php echo $noticia_ver3['popularname'];?><input type="hidden"  class="tbltext" name="txttoitem" id="toitm" value="<?php echo $noticia_ver3['varietyid'];?>"  /></td>
</tr>	
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
		<td align="center" valign="middle" class="smalltblheading" colspan="3">Original</td>
		<td width="6%" align="center" valign="middle" class="smalltblheading" rowspan="2">Entire / Partial</td>
		<td width="16%" align="center" valign="middle" class="smalltblheading" rowspan="2">New Lot No.</td>
		<td align="center" valign="middle" class="smalltblheading" colspan="2">Transfered</td>
		<td width="19%" align="center" valign="middle" class="smalltblheading" rowspan="2">SLOC</td>
		<td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
	</tr>
	<tr class="tblsubtitle">
		<td width="16%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="6%" align="center" valign="middle" class="smalltblheading">NoB</td>
		<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="7%" align="center" valign="middle" class="smalltblheading">NoB</td>
		<td width="9%" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="6%" align="center" valign="middle" class="smalltblheading">NoB</td>
		<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
	</tr>
<?php
$sr=1; $itmdchk=""; $totnob=0; $totqty=0;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_ivtsub where ivt_id='".$trid."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage='Condition';
$olotn=$row_eindent_sub['ivts_olotno'];
$lotn=$row_eindent_sub['ivts_nlotno'];
$onob=$row_eindent_sub['ivts_onob'];
$oqty=$row_eindent_sub['ivts_oqty'];
$ttntyp=$row_eindent_sub['ivts_trnall'];
if($ttntyp=="E")$ttntyp="Entire";
if($ttntyp=="P")$ttntyp="Partial";
$slups=0; $slqty=0; $sloc=""; 
$sql_tblissue=mysqli_query($link,"select * from tbl_ivtsub_sub2 where ivt_id='".$trid."' and ivts_id='".$row_eindent_sub['ivts_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ivtss2_nob'];
$slqty=$slqty+$row_tblissue['ivtss2_qty'];

$wareh=""; $binn=""; $subbinn="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tblissue['ivtss2_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tblissue['ivtss2_subbin']."' and binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($sloc!="")
$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
else
$sloc=$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
}
$bnob=$onob-$slups;
$bqty=$oqty-$slqty;
$totnob=$totnob+$slups; 
$totqty=$totqty+$slqty;
if($sr%2!=0)
{
?>		  
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $olotn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ttntyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?></td>
</tr>

<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $olotn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ttntyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?></td>
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
<tr class="Dark" height="20">
		<td align="right" valign="middle" class="tblheading" colspan="7">Total&nbsp;</td>
		<td align="center" valign="middle" class="smalltblheading"><?php echo $totqty;?>&nbsp;Kgs.</td>
		<td align="left" valign="middle" class="tbltext" colspan="3"></td>
	</tr>		  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
</table>
<br />
<br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="87" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="145"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="80" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="149" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="159" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="130" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
</table><br />

<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="cc_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>

</td></tr>
</table>

</body>
</html>
