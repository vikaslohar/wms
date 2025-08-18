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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	
	if(isset($_GET['txtlot1']))
	{
    $txtlot1 = $_GET['txtlot1'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw - Utility - Lot Biography</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>

<body>
<table width="550" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="txtlot1" value="<?php echo $txtlot1;?>" />	 
	  <br />
<?php
$zz=str_split($txtlot1);
		//print_r($zz);
$newlot1=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
?>
<table align="center" border="1" bordercolor="#0BC5F4" cellspacing="0" cellpadding="0" width="550" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
<td  align="center"  valign="middle" class="tblheading" colspan="2"><font size="+1">Lot Biography</font></td>
</tr>

<tr class="tblsubtitle" height="20">
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;&nbsp;Lot No:&nbsp;<?php echo $newlot1;?></td>
<td width="199" align="right"  valign="middle" class="tblheading">Stage:&nbsp;Pack&nbsp;&nbsp;</td>
</tr>
  </table>
<?php
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$txtlot1."' ") or die(mysqli_error($link));
$tot_ttt=mysqli_num_rows($sql_issue);
if($tot_ttt > 0)
{
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$txtlot1."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_arr_home=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
		
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home >0) 
{    
$srno=1;
$crop=""; $variety=""; $lotno=""; $bags=0; $qty=0; $got=""; $qc=""; $moist=""; $gemp=""; $got=""; $sststus="";
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; 

while($row_tbl_sub1=mysqli_fetch_array($sql_arr_home))
{
		
$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and orlot='".$row_tbl_sub1['orlot']."'") or die(mysqli_error($link));
$row_arr_sub=mysqli_fetch_array($sql_arr_sub);
//$tot=mysqli_num_rows($sql_tbl);		

$sql_arr=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_id='".$row_arr_sub['arrival_id']."'") or die(mysqli_error($link));
$row_arr=mysqli_fetch_array($sql_arr);

	$trdate=$row_arr['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_tbl_sub1['lotldg_qctestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$crop=$row31['cropname']; 
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['lotldg_variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['lotldg_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

$aq=explode(".",$row_tbl_sub1['balnomp']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub1['balnomp'];}

$an=explode(".",$row_tbl_sub1['balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub1['balqty'];}

$bags=$bags+$ac;
$qty=$qty+$acn;
$qc=$row_tbl_sub1['lotldg_qc'];
$moist=$row_tbl_sub1['lotldg_moisture'];
$gemp=$row_tbl_sub1['lotldg_gemp'];
$got11=explode(" ",$row_tbl_sub1['lotldg_got1']);
$got=$got11[0]." ".$row_tbl_sub1['lotldg_got'];
$sststus=$row_tbl_sub1['lotldg_sstatus'];
if($row_tbl_sub1['lotldg_srflg'] > 0)
{
	if($sststus!="")$sststus=$sststus."/"."S";
	else
	$sststus="S";
}
if($gemp==0)$gemp="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_sub1['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_sub1['binid']."' and whid='".$row_tbl_sub1['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_sub1['subbinid']."' and binid='".$row_tbl_sub1['binid']."' and whid='".$row_tbl_sub1['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl_sub1['balnomp'];
 $slqty=$slqty+$row_tbl_sub1['balqty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
}
}


		
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where plantcode='$plantcode' and oldlot='$newlot1' order by oldlot,tid desc limit 0,1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_tbl_sub1=mysqli_fetch_array($sql_arr_home);
$moist=$row_tbl_sub1['moist'];
//$pp=$row_tbl['lotldg_vchk'];	
$gemp=$row_tbl_sub1['gemp'];

$trdate11=$row_tbl_sub1['testdate'];
$tryear=substr($trdate11,0,4);
$trmonth=substr($trdate11,5,2);
$trday=substr($trdate11,8,2);
$trdate11=$trday."-".$trmonth."-".$tryear;	

$qc=$row_tbl_sub1['qcstatus'];

if($acn==0)$slocs="";
?>   
<table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#0BC5F4" style="border-collapse:collapse">

   <tr class="Dark" height="20">
     <td width="272" height="19" align="right" valign="middle" class="tblheading">Date of Arrival&nbsp;&nbsp;</td>
	  <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $trdate;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Crop&nbsp;&nbsp;</td>
	 <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $crop;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Variety&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $vv;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">NoB&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $ac;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Qty&nbsp;&nbsp;</td>
	  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $acn;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">SLOC&nbsp;&nbsp;</td>
	 <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $slocs;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">QC Status<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $qc;?></td>
   </tr>
   <tr class="Light" height="20">
     <td align="right" valign="middle" class="tblheading">DoT&nbsp;&nbsp;</td>
	 <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $trdate11?></td>
   </tr>
   <tr class="Dark" height="20">
     <td align="right" valign="middle" class="tblheading">Moisture %&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $moist;?></td>
   </tr>
   <tr class="Light" height="20">
     <td align="right" valign="middle" class="tblheading">Germination %&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $gemp;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td align="right" valign="middle" class="tblheading">GOT Status&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $got;?></td>
   </tr>
   <tr class="Light" height="20">
     <td align="right" valign="middle" class="tblheading">Seed Status&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $sststus;?></td>
   </tr>
</table>
&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;Latest QC result shown here, irrespective of stock being in any stage or dispatched
<?php
}
else
{
?>
<table align="center" border="1" bordercolor="#0BC5F4" cellspacing="0" cellpadding="0" width="550" style="border-collapse:collapse">
  <tr class="light" height="20">
<td  align="center"  valign="middle" class="tblheading" colspan="2">Lot not present.</td>
</tr>
  </table>
<?php
}
?>
</form>

		  
<table align="center" width="550" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">&nbsp;--><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table></td><td width="30"></td>
</tr>
</table>


</body>
</html>
