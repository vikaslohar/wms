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
<title>Processing - Report - Periodical Processing Report</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('report_daily2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate+'&txtpmcode='+pmc,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_process.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
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
	$qry="select Distinct (proslipmain_crop), proslipmain_variety from tbl_proslipmain where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' and plantcode='$plantcode'";
	
	if($crop!="ALL")
	{	
	$qry.="and proslipmain_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and proslipmain_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtpmcode!="ALL")
	{	
	$qry.="and proslipmain_promachcode='$txtpmcode' ";
	}
	
	$qry.=" and proslipmain_tflag=1 group by proslipmain_crop, proslipmain_variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	 $tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25">&nbsp;Periodical Processing Report</td>
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

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   	<!--<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Dark" height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>
<?php

?>	
<!--<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variety;?></td>
  	</tr>
</table> 	--> 
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="70" align="center" valign="middle" class="smalltblheading" rowspan="2">Date</td>
			<td width="70" align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
			<td width="70" align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
			<td width="115"  align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
			<td rowspan="2"  align="center" valign="middle" class="smalltblheading">E/P</td>
			<td colspan="2"  align="center" valign="middle" class="smalltblheading">Raw Seed</td>
			 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed</td>
			 <td  align="center" valign="middle" class="smalltblheading" colspan="2">Remnant (RM)</td>
			 <td align="center" valign="middle" class="smalltblheading" colspan="2">Inert Matter (IM)</td>
			 <td align="center" valign="middle" class="smalltblheading" colspan="2">Processing Loss (PL/RPL)</td>
			 <td align="center" valign="middle" class="smalltblheading" colspan="2">Total Condition Loss</td>
			 <td width="56"  align="center" valign="middle" class="smalltblheading" rowspan="2">Proc. Mach. Code</td>
             <td width="55"  align="center" valign="middle" class="smalltblheading" rowspan="2">Proc. Slip No.</td>
             <td width="55"  align="center" valign="middle" class="smalltblheading" rowspan="2">Treat. Schema</td>
             <td width="55"  align="center" valign="middle" class="smalltblheading" rowspan="2">Opr Code</td>
			 <td width="25"  align="center" valign="middle" class="smalltblheading" rowspan="2">Prod. Grade</td>
</tr>
 <tr class="tblsubtitle">
   <!--/* <td width="7%" align="center" valign="middle" class="smalltbltext">NoB</td>
    <td width="8%" align="center" valign="middle" class="smalltbltext">Qty</td>
     <td width="7%" align="center" valign="middle" class="smalltbltext">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltbltext">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltbltext">NoB </td>*/-->
    <td width="50" align="center" valign="middle" class="smalltblheading">NoB</td>
	  <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="50" align="center" valign="middle" class="smalltblheading">NoB</td>
      <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	    <td width="40" align="center" valign="middle" class="smalltblheading">%</td>
	   <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	    <td width="40" align="center" valign="middle" class="smalltblheading">%</td>
		<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	    <td width="40" align="center" valign="middle" class="smalltblheading">%</td>
		<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	    <td width="40" align="center" valign="middle" class="smalltblheading">%</td>
              </tr>
<?php


if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

	
if($txtpmcode!="ALL")
{	
$sql_rr=mysqli_query($link,"select distinct proslipmain_variety from tbl_proslipmain where proslipmain_crop='".$row_arr_home1['proslipmain_crop']."' and proslipmain_variety='".$row_arr_home1['proslipmain_variety']."' and proslipmain_promachcode='$txtpmcode'  and proslipmain_date<='$edate' and proslipmain_date>='$sdate' and proslipmain_tflag=1 and plantcode='$plantcode' order by proslipmain_id asc") or die(mysqli_error($link));
}
else
{
$sql_rr=mysqli_query($link,"select distinct proslipmain_variety from tbl_proslipmain where proslipmain_crop='".$row_arr_home1['proslipmain_crop']."' and proslipmain_variety='".$row_arr_home1['proslipmain_variety']."' and proslipmain_date<='$edate' and proslipmain_date>='$sdate' and proslipmain_tflag=1 and plantcode='$plantcode' order by proslipmain_id asc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);

if($txtpmcode!="ALL")
{	
$sqlrr=mysqli_query($link,"select distinct pnpslipmain_variety from tbl_pnpslipmain where pnpslipmain_crop='".$row_arr_home1['proslipmain_crop']."' and pnpslipmain_variety='".$row_arr_home1['proslipmain_variety']."' and pnpslipmain_promachcode='$txtpmcode' and pnpslipmain_date<='$edate' and pnpslipmain_date>='$sdate' and pnpslipmain_tflag=1 and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
}
else
{
$sqlrr=mysqli_query($link,"select distinct pnpslipmain_variety from tbl_pnpslipmain where pnpslipmain_crop='".$row_arr_home1['proslipmain_crop']."' and pnpslipmain_variety='".$row_arr_home1['proslipmain_variety']."' and pnpslipmain_date<='$edate' and pnpslipmain_date>='$sdate' and pnpslipmain_tflag=1 and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
}
$totrr=mysqli_num_rows($sqlrr);
if($tot_rr > 0 || $totrr > 0)
{

$totenob=0; $toteqty=0; $totpnob=0; $totpqty=0; $totrmqty=0; $totimqty=0; $totplqty=0; $tottplqty=0;	
while($row_rr=mysqli_fetch_array($sql_rr))
{
	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['proslipmain_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	 $crop=$row31['cropname'];	
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['proslipmain_variety']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
	$rowvv=mysqli_fetch_array($sql_variety);
	$variety=$rowvv['popularname'];
	}
	else
	{
	$variety=$row_rr['proslipmain_variety'];
	}
	
// 		Table code for crop & variety wise lot numbers
//$srno=1; $lotno=""; $enob=""; $eqty=""; $pnob=""; $pqty=""; $rmqty=""; $rmper=""; $imqty=""; $imper=""; $plqty=""; $plper=""; $tplqty=""; $tplper=""; $pmc=""; $psn=""; $treats=""; $oprname="";
$srno=1; $lotno=""; $enob=""; $eqty=""; $pnob=""; $pqty=""; $rmqty1=""; $rmper1=""; $imqty1=""; $imper1=""; $plqty1=""; $plper1=""; $tplqty=""; $tplper=""; $pmc=""; $psn=""; $treats=""; $oprname="";
if($txtpmcode!="ALL")
{	
$sql_rr22=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_variety='".$row_rr['proslipmain_variety']."' and proslipmain_date<='$edate' and proslipmain_date>='$sdate' and proslipmain_tflag=1 and proslipmain_promachcode='$txtpmcode' and plantcode='$plantcode' order by proslipmain_id asc") or die(mysqli_error($link));
}
else
{
$sql_rr22=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_variety='".$row_rr['proslipmain_variety']."' and proslipmain_date<='$edate' and proslipmain_date>='$sdate' and proslipmain_tflag=1 and plantcode='$plantcode' order by proslipmain_id asc") or die(mysqli_error($link));
}
$tot_rr22=mysqli_num_rows($sql_rr22);
while($row_rr22=mysqli_fetch_array($sql_rr22))
{

	$rdate=$row_rr22['proslipmain_date'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$trdate=$rday."-".$rmonth."-".$ryear;
	
	$sql_sel1="select * from tbl_rm_promac where promac_id='".$row_rr22['proslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
	$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
	$noticia_item1 = mysqli_fetch_array($res1);  
	$pmc=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];
	
	$treats=$row_rr22['proslipmain_treattype'];
	
	$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row_rr22['proslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
	$row_popr=mysqli_fetch_array($query_popr);
	$oprname=$row_popr['proopr_code'];
	
	 $psn=$row_rr22['proslipmain_proslipno'];


$sql_issuetbl=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$row_rr22['proslipmain_id']."' and plantcode='$plantcode' order by proslipsub_lotno asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 

$lotno=$row_issuetbl['proslipsub_lotno'];
$enp=$row_issuetbl['proslipsub_processtype'];

$aq=explode(".",$row_issuetbl['proslipsub_pnob']);
if($aq[1]==000){$onob1=$aq[0];}else{$onob1=$row_issuetbl['proslipsub_pnob'];}

$an=explode(".",$row_issuetbl['proslipsub_pqty']);
if($an[1]==000){$oqty1=$an[0];}else{$oqty1=$row_issuetbl['proslipsub_pqty'];}

$aq2=explode(".",$row_issuetbl['proslipsub_connob']);
if($aq2[1]==000){$cnob1=$aq2[0];}else{$cnob1=$row_issuetbl['proslipsub_connob'];}

$an2=explode(".",$row_issuetbl['proslipsub_conqty']);
if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$row_issuetbl['proslipsub_conqty'];}

$aq3=explode(".",$row_issuetbl['proslipsub_rm']);
if($aq3[1]==000){$rmqty1=$aq3[0];}else{$rmqty1=$row_issuetbl['proslipsub_rm'];}

$an3=explode(".",$row_issuetbl['proslipsub_im']);
if($an3[1]==000){$imqty1=$an3[0];}else{$imqty1=$row_issuetbl['proslipsub_im'];}

if($row_issuetbl['proslipsub_pl']>0)
{
$an4=explode(".",$row_issuetbl['proslipsub_pl']);
if($an4[1]==000){$plqty1=$an4[0];}else{$plqty1=$row_issuetbl['proslipsub_pl'];}
}
else
{
$an4=explode(".",$row_issuetbl['proslipsub_rpl']);
if($an4[1]==000){$plqty1=$an4[0];}else{$plqty1=$row_issuetbl['proslipsub_rpl'];}
}

$an5=explode(".",$row_issuetbl['proslipsub_tlqty']);
if($an5[1]==000){$tplqty1=$an5[0];}else{$tplqty1=$row_issuetbl['proslipsub_tlqty'];}
	
	$totenob=$totenob+$onob1; 
	$toteqty=$toteqty+$oqty1;
	$totpnob=$totpnob+$cnob1;
	$totpqty=$totpqty+$cqty1;
	
	$totrmqty=$totrmqty+$rmqty1;
	$totimqty=$totimqty+$imqty1;
	$totplqty=$totplqty+$plqty1;
	$tottplqty=$tottplqty+$tplqty1;
	
	$tplper=$row_issuetbl['proslipsub_tlper'];
	if($oqty1>0)
	{
	$rmper=round((($rmqty1/$oqty1)*100),2);
	$imper=round((($imqty1/$oqty1)*100),2);
	$plper=round((($plqty1/$oqty1)*100),2);
	}
	$zz=str_split($lotno);
	//print_r($zz);
	$newlot1=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
	
	$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where SUBSTRING(orlot,1,7)='".$newlot1."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_arr_sub=mysqli_fetch_array($sql_arr_sub);
	$prodgrade=$row_arr_sub['prodgrade'];
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
    		<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $enp?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqty1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $cnob1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $imqty1?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $imper?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $plqty1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $plper;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $pmc?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $psn?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $treats;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $oprname;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $prodgrade;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
    		<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $enp?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqty1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $cnob1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $imqty1?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $imper?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $plqty1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $plper;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $pmc?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $psn?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $treats;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $oprname;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $prodgrade;?></td>
</tr>

<?php
}
$srno=$srno++;
}
}
}
}
//}

while($rowrr=mysqli_fetch_array($sqlrr))
{
$srno=1; $lotno=""; $enob=""; $eqty=""; $pnob=""; $pqty=""; $rmqty1=""; $rmper1=""; $imqty1=""; $imper1=""; $plqty1=""; $plper1=""; $tplqty=""; $tplper=""; $pmc=""; $psn=""; $treats=""; $oprname="";

 
if($txtpmcode!="ALL")
{	
$sql_rr22=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_variety='".$rowrr['pnpslipmain_variety']."' and pnpslipmain_date<='$edate' and pnpslipmain_date>='$sdate' and pnpslipmain_tflag=1 and pnpslipmain_promachcode='$txtpmcode' and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
}
else
{
$sql_rr22=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_variety='".$rowrr['pnpslipmain_variety']."' and pnpslipmain_date<='$edate' and pnpslipmain_date>='$sdate' and pnpslipmain_tflag=1 and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
}
$tot_rr22=mysqli_num_rows($sql_rr22);
while($row_rr22=mysqli_fetch_array($sql_rr22))
{

	$rdate=$row_rr22['pnpslipmain_date'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$trdate=$rday."-".$rmonth."-".$ryear;
	
	$sql_sel1="select * from tbl_rm_promac where promac_id='".$row_rr22['pnpslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
	$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
	$noticia_item1 = mysqli_fetch_array($res1);  
	$pmc=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];
	
	$treats=$row_rr22['pnpslipmain_treattype'];
	
	$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row_rr22['pnpslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
	$row_popr=mysqli_fetch_array($query_popr);
	$oprname=$row_popr['proopr_code'];
	
	 $psn=$row_rr22['pnpslipmain_proslipno'];


$sql_issuetbl=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$row_rr22['pnpslipmain_id']."' and pnpslipsub_conqty>0 and plantcode='$plantcode' order by pnpslipsub_lotno asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 

$lotno=$row_issuetbl['pnpslipsub_lotno'];
$enp=$row_issuetbl['pnpslipsub_packtype'];

$aq=explode(".",$row_issuetbl['pnpslipsub_pnob']);
if($aq[1]==000){$onob1=$aq[0];}else{$onob1=$row_issuetbl['pnpslipsub_pnob'];}

$an=explode(".",$row_issuetbl['pnpslipsub_pqty']);
if($an[1]==000){$oqty1=$an[0];}else{$oqty1=$row_issuetbl['pnpslipsub_pqty'];}

$aq2=explode(".",$row_issuetbl['pnpslipsub_connob']);
if($aq2[1]==000){$cnob1=$aq2[0];}else{$cnob1=$row_issuetbl['pnpslipsub_connob'];}

$an2=explode(".",$row_issuetbl['pnpslipsub_conqty']);
if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$row_issuetbl['pnpslipsub_conqty'];}

$aq3=explode(".",$row_issuetbl['pnpslipsub_rm']);
if($aq3[1]==000){$rmqty1=$aq3[0];}else{$rmqty1=$row_issuetbl['pnpslipsub_rm'];}

$an3=explode(".",$row_issuetbl['pnpslipsub_im']);
if($an3[1]==000){$imqty1=$an3[0];}else{$imqty1=$row_issuetbl['pnpslipsub_im'];}

if($row_issuetbl['pnpslipsub_pl']>0)
{
$an4=explode(".",$row_issuetbl['pnpslipsub_pl']);
if($an4[1]==000){$plqty1=$an4[0];}else{$plqty1=$row_issuetbl['pnpslipsub_pl'];}
}
else
{
$an4=explode(".",$row_issuetbl['pnpslipsub_rpl']);
if($an4[1]==000){$plqty1=$an4[0];}else{$plqty1=$row_issuetbl['pnpslipsub_rpl'];}
}

$an5=explode(".",$row_issuetbl['pnpslipsub_tlqty']);
if($an5[1]==000){$tplqty1=$an5[0];}else{$tplqty1=$row_issuetbl['pnpslipsub_tlqty'];}
	
	$totenob=$totenob+$onob1; 
	$toteqty=$toteqty+$oqty1;
	$totpnob=$totpnob+$cnob1;
	$totpqty=$totpqty+$cqty1;
	
	$totrmqty=$totrmqty+$rmqty1;
	$totimqty=$totimqty+$imqty1;
	$totplqty=$totplqty+$plqty1;
	$tottplqty=$tottplqty+$tplqty1;
	
	$tplper=$row_issuetbl['pnpslipsub_tlper'];
	if($oqty1>0)
	{
	$rmper=round((($rmqty1/$oqty1)*100),2);
	$imper=round((($imqty1/$oqty1)*100),2);
	$plper=round((($plqty1/$oqty1)*100),2);
	}
	$zz=str_split($lotno);
	//print_r($zz);
	$newlot1=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
	
	$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where SUBSTRING(orlot,1,7)='".$newlot1."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_arr_sub=mysqli_fetch_array($sql_arr_sub);
	$prodgrade=$row_arr_sub['prodgrade'];
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
    		<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $enp?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqty1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $cnob1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $imqty1?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $imper?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $plqty1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $plper;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $pmc?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $psn?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $treats;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $oprname;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $prodgrade;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
    		<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $enp?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqty1?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $cnob1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $imqty1?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $imper?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $plqty1?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $plper;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplqty1;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $pmc?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $psn?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $treats;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $oprname;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $prodgrade;?></td>
</tr>

<?php
}
$srno=$srno++;
}
}
}
}
//}
?>
<tr class="Light">
			<td colspan="4" align="center" valign="middle" class="smalltblheading">Total</td>
		   	<td align="center" valign="middle" class="smalltblheading"><?php echo $totenob?></td>
         	<td align="center" valign="middle" class="smalltblheading"><?php echo $toteqty?></td>
         	<td align="center" valign="middle" class="smalltblheading"><?php echo $totpnob?></td>
		   	<td align="center" valign="middle" class="smalltblheading"><?php echo $totpqty;?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totrmqty;?></td>
           	<td align="center" valign="middle" class="smalltblheading">&nbsp;</td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totimqty?></td>
		  	<td align="center" valign="middle" class="smalltblheading">&nbsp;</td>
         	<td align="center" valign="middle" class="smalltblheading"><?php echo $totplqty?></td>
		   	<td align="center" valign="middle" class="smalltblheading">&nbsp;</td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $tottplqty;?></td>
           	<td align="center" valign="middle" class="smalltblheading">&nbsp;</td>
			<td align="center" valign="middle" class="smalltblheading" colspan="5">&nbsp;</td>
</tr>
          	
<?php
}
}
}
?>		</table>  		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td  align="center" valign="middle"><a href="report_daily.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
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
