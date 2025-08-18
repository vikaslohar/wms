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
	
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$sdate = $_REQUEST['sdate'];
	 	$edate = $_REQUEST['edate'];
		$txtpmcode=$_REQUEST['txtpmcode'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing - Report - Organiser wise Processing Status Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<SCRIPT language="JavaScript">

function openprint()
{
var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var pmc=document.frmaddDepartment.txtpmcode.value;
winHandle=window.open('report_orgw_prostatus5.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate+'&txtpmcode='+pmc,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <?php
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$txtpmcode=$_REQUEST['txtpmcode'];
		
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
function dateDiff($start, $end) 
{
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);
}
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Organiser wise Processing Status Report - As on Date: <?php echo date("d-m-Y");?></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="txtpmcode" value="<?php echo $txtpmcode;?>" type="hidden">  
		 <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" style="border-collapse:collapse">
   	<!--<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Processing Period of Lot(s) From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
  <tr class="Dark" height="25" >
	 <td align="left" width="40%" class="subheading" style="color:#303918; ">&nbsp;Organiser: <?php echo $txtpmcode;?></td>
	 <td align="left" width="30%" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
  </table><br />

<?php
	$sql2="select * from tbl_proslipmain where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$sql2.=" and proslipmain_crop='".$crop."'";
	}
	if($variety!="ALL")
	{	
		$sql2.=" and proslipmain_variety='".$variety."' ";
	}		
		 $sql2.=" order by proslipmain_date asc";
		 
	$sql_rr222=mysqli_query($link,$sql2) or die(mysqli_error($link));
	$tot_rr222=mysqli_num_rows($sql_rr222);

if($tot_rr222>0)
{
if($crop!="ALL" && $variety!="ALL")
{	
	$qry24="select distinct lotcrop from tblarrival_sub where organiser='".$txtpmcode."' and lotcrop='".$crp."' and lotvariety='".$ver."'  and sstage='Raw' and plantcode='$plantcode' order by lotcrop";
}
else if($crop!="ALL" && $variety=="ALL")
{
	$qry24="select distinct lotcrop from tblarrival_sub where organiser='".$txtpmcode."' and lotcrop='".$crp."' and sstage='Raw' and plantcode='$plantcode' order by lotcrop";
}
else
{
	$qry24="select distinct lotcrop from tblarrival_sub where organiser='".$txtpmcode."' and sstage='Raw' and plantcode='$plantcode' order by lotcrop";
}	
	
	$sql_arr_home24=mysqli_query($link,$qry24) or die(mysqli_error($link));
	$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
	
while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
{

if($variety!="ALL")
{
	$qry23="select distinct lotvariety from tblarrival_sub where organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$ver."' and sstage='Raw' and plantcode='$plantcode' order by lotvariety";
}
else
{
	$qry23="select distinct lotvariety from tblarrival_sub where organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and sstage='Raw' and plantcode='$plantcode' order by lotvariety";
}	
	
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	$tot_arr_home23=mysqli_num_rows($sql_arr_home23);
	
while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
{	
$arid='';
	$qry2="select arrival_id from tblarrival_sub where organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' and plantcode='$plantcode'";
	
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
if($arid!='')
$arid=$arid.",".$row_arr_home2['arrival_id'];
else
$arid=$row_arr_home2['arrival_id'];
}
if($arid!='')
{
?>
<br />
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" style="border-collapse:collapse">
	<tr class="Dark" height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $row_arr_home24['lotcrop'];?></td>
    <td align="right" width="50%" class="subheading" style="color:#303918; ">Variety: <?php echo $row_arr_home23['lotvariety'];?>&nbsp;</td>
  	</tr>
</table>
<?php

	$qry="select arrival_id, arrival_date, yearcode from tblarrival where  arrival_type='Fresh Seed with PDN' and arrtrflag=1 and arrival_id IN($arid) and plantcode='$plantcode'";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
  <td width="59" align="center" valign="middle" class="smalltblheading" >Date of Arrival</td>
  <td width="35" align="center" valign="middle" class="smalltblheading" >Days</td>
            <td width="70" align="center" valign="middle" class="smalltblheading" >FRN No.</td>
            <td width="50" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
			<td width="98"  align="center" valign="middle" class="smalltblheading" >Prod. Location</td>
			<td width="98" align="center" valign="middle" class="smalltblheading">Prod. Personel</td>
			 <td width="124" align="center" valign="middle" class="smalltblheading">Farmer</td>
			 <td width="56"  align="center" valign="middle" class="smalltblheading" >PDN Qty</td>
			 <td width="57" align="center" valign="middle" class="smalltblheading" >Arrival Qty</td>
			 <td width="57" align="center" valign="middle" class="smalltblheading">Raw<br />Seed Qty</td>
			 <td width="57" align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
			 <td width="50"  align="center" valign="middle" class="smalltblheading" >Cond. Loss (RM + IM)</td>
             <td width="64"  align="center" valign="middle" class="smalltblheading" >GOT Result</td>
             <td width="65"  align="center" valign="middle" class="smalltblheading" >DOGR</td>
             </tr>

<?php
$cnt=0;$srno=1;

if($tot_arr_home > 0)
{	
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

	$sql_rr=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_arr_home1['arrival_id']."' and organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' and plantcode='$plantcode' order by orlot asc") or die(mysqli_error($link));

$tot_rr=mysqli_num_rows($sql_rr);
if($tot_rr > 0)
{
while($row_rr=mysqli_fetch_array($sql_rr))
{
$lgt=explode("/",$row_rr['orlot']);
$lotno1=$lgt[0];
$lotno=$row_rr['lotno'];
$ploc=$row_rr['ploc'];
$pper=$row_rr['pper'];
$farmer=$row_rr['farmer'];

$ycode=$row_arr_home1['yearcode'];

$frn="FRN/".$ycode."/".$row_rr['ncode'];

$ax1=explode(".",$row_rr['qty']);
if($ax1[1]==000){$pqty=$ax1[0];}else{$pqty=$row_rr['qty'];}
$ax2=explode(".",$row_rr['act']);
if($ax2[1]==000){$arrqty=$ax2[0];}else{$arrqty=$row_rr['act'];}			
/*$pqty=$row_rr['qty'];
$arrqty=$row_rr['act'];*/
$tqty=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $row_issue1[0];
$sql_issuetbl1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
while($row_issuetbl1=mysqli_fetch_array($sql_issuetbl1))
{ 
$tqty=$tqty+$row_issuetbl1['lotldg_balqty']; 
$gotr1=explode(" ", $row_issuetbl1['lotldg_got1']); 
$gotr=$gotr1[0]." ".$row_issuetbl1['lotldg_got']; 

	$trdate=$row_issuetbl1['lotldg_gottestdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="--" || $trdate=="00-00-0000")$trdate="";
$dogr=$trdate; 
}
}
$rswqty=$tqty; 


	$sql_crp23=mysqli_query($link,"select * from tblcrop where cropname='".$row_rr['lotcrop']."'") or die(mysqli_error($link));
	$row_crp23=mysqli_fetch_array($sql_crp23);
	$crp23=$row_crp23['cropid'];

	$sql_var23=mysqli_query($link,"select * from tblvariety where popularname='".$row_rr['lotvariety']."' ") or die(mysqli_error($link));
	$row_var23=mysqli_fetch_array($sql_var23);
	$ver23=$row_var23['varietyid'];
		
		 
$cswqty=""; $tplqty="";  $flg=0;
$sql="select * from tbl_proslipmain where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$sql.=" and proslipmain_crop='".$crp23."'";
	}
	if($variety!="ALL")
	{	
		$sql.=" and proslipmain_variety='".$ver23."'";
	}		
		 $sql.="  and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_date asc";
		 
	$sql_rr22=mysqli_query($link,$sql) or die(mysqli_error($link));
	if($tot_rr22=mysqli_num_rows($sql_rr22)>0)
	{ 
//$sql_rr22=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_crop='".$crp23."' and proslipmain_variety='".$ver23."' and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_id asc") or die(mysqli_error($link));

//$tot_rr22=mysqli_num_rows($sql_rr22);
while($row_rr22=mysqli_fetch_array($sql_rr22))
{
	$sql_issuetbl=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$row_rr22['proslipmain_id']."' and proslipsub_lotno='".$lotno."' and plantcode='$plantcode' order by proslipsub_lotno asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
	if($t > 0)
	{ $rmqty1=0;$imqty1=0;$flg++;
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{ 
			$an2=explode(".",$row_issuetbl['proslipsub_conqty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$row_issuetbl['proslipsub_conqty'];}
			
			$aq3=explode(".",$row_issuetbl['proslipsub_rm']);
			if($aq3[1]==000){$rmqty1=$aq3[0];}else{$rmqty1=$row_issuetbl['proslipsub_rm'];}
			
			$an3=explode(".",$row_issuetbl['proslipsub_im']);
			if($an3[1]==000){$imqty1=$an3[0];}else{$imqty1=$row_issuetbl['proslipsub_im'];}
		
			$tplqty=$rmqty1+$imqty1;
			$cswqty=$cqty1;
		}
	}
}
}
//echo $cswqty;
	$trdate1=$row_arr_home1['arrival_date'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;

$start1 = $row_arr_home1['arrival_date'];
$end1 = date("Y-m-d");
$diff=dateDiff($start1, $end1);

//echo $flg;
if($flg>0)
{
$cnt++;
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="59" align="center" valign="middle" class="smallesttbltext"><?php echo $trdate1;?></td>
	<td width="35" align="center" valign="middle" class="smallesttbltext"><?php echo $diff;?></td>
	<td width="70" align="center" valign="middle" class="smallesttbltext"><?php echo $frn;?></td>
	<td width="50" align="center" valign="middle" class="smallesttbltext"><?php echo $lotno1;?></td>
	<td align="center" valign="middle" class="smallesttbltext"><?php echo $ploc;?></td>
    <td align="center" valign="middle" class="smallesttbltext"><?php echo $pper?></td>
    <td align="center" valign="middle" class="smallesttbltext"><?php echo $farmer?></td>
    <td align="center" valign="middle" class="smallesttbltext"><?php echo $pqty?></td>
	<td align="center" valign="middle" class="smallesttbltext"><?php echo $arrqty;?></td>
    <td align="center" valign="middle" class="smallesttbltext"><?php echo $rswqty;?></td>
    <td align="center" valign="middle" class="smallesttbltext"><?php echo $cswqty;?></td>
	<td align="center" valign="middle" class="smallesttbltext"><?php echo $tplqty?></td>
	<td align="center" valign="middle" class="smallesttbltext"><?php echo $gotr?></td>
    <td align="center" valign="middle" class="smallesttbltext"><?php echo $dogr?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
  <td width="59" align="center" valign="middle" class="smallesttbltext"><?php echo $trdate1;?></td>
  <td width="35" align="center" valign="middle" class="smallesttbltext"><?php echo $diff;?></td>
			<td width="70" align="center" valign="middle" class="smallesttbltext"><?php echo $frn;?></td>
			<td width="50" align="center" valign="middle" class="smallesttbltext"><?php echo $lotno1;?></td>
		   	<td align="center" valign="middle" class="smallesttbltext"><?php echo $ploc;?></td>
          	<td align="center" valign="middle" class="smallesttbltext"><?php echo $pper?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $farmer?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $pqty?></td>
		   	<td align="center" valign="middle" class="smallesttbltext"><?php echo $arrqty;?></td>
           	<td align="center" valign="middle" class="smallesttbltext"><?php echo $rswqty;?></td>
           	<td align="center" valign="middle" class="smallesttbltext"><?php echo $cswqty;?></td>
			<td align="center" valign="middle" class="smallesttbltext"><?php echo $tplqty?></td>
		  	<td align="center" valign="middle" class="smallesttbltext"><?php echo $gotr?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $dogr?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
?>
</table>
<?php
}
if($cnt==0)
{
?>		  		
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="Dark" height="20">
<td align="center" valign="middle" class="smalltblheading" >Record not Found</td>
</tr>
</table>
<?php
}}}}
?>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td  align="center" valign="middle"><a href="report_orgw_prostatus3.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />&nbsp;&nbsp;<a href="excel-owpsr6.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtpmcode=<?php echo $_REQUEST['txtpmcode'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a></td>
</tr>
</table>
</td><td ></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
