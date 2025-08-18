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
	
		
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['txtcrop'])) { $txtcrop = $_REQUEST['txtcrop']; }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety = $_REQUEST['txtvariety']; }
	if(isset($_REQUEST['txtups'])) { $txtups = $_REQUEST['txtups']; }
	if(isset($_REQUEST['txtordertyp'])) { $txtordertyp = $_REQUEST['txtordertyp']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order-Report -Crop Wise report</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
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
var txtstatesl=document.frmaddDepartment.txtstatesl.value;
var txtlocationsl=document.frmaddDepartment.txtlocationsl.value;
var txtparty=document.frmaddDepartment.txtparty.value;
var txtcrop=document.frmaddDepartment.txtcrop.value;
var txtvariety=document.frmaddDepartment.txtvariety.value;
var txtordertyp=document.frmaddDepartment.txtordertyp.value;
var txtups=document.frmaddDepartment.txtups.value;
winHandle=window.open('report_crop2.php?sdate='+sdate+'&edate='+edate+'&txtstatesl='+txtstatesl+'&txtlocationsl='+txtlocationsl+'&txtparty='+txtparty+'&txtcrop='+txtcrop+'&txtvariety='+txtvariety+'&txtordertyp='+txtordertyp+'&txtups='+txtups,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25">&nbsp;Pending Order Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
  

	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	<input name="edate" value="<?php echo $edate;?>" type="hidden"> 
	<input name="txtstatesl" value="<?php echo $txtstatesl;?>" type="hidden"> 
	<input name="txtlocationsl" value="<?php echo $txtlocationsl;?>" type="hidden"> 
	<input name="txtparty" value="<?php echo $txtparty;?>" type="hidden"> 
	<input name="txtcrop" value="<?php echo $txtcrop;?>" type="hidden"> 
	<input name="txtvariety" value="<?php echo $txtvariety;?>" type="hidden"> 
	<input name="txtordertyp" value="<?php echo $txtordertyp;?>" type="hidden"> 
	<input name="txtups" value="<?php echo $txtups;?>" type="hidden"> 
	
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
<?php 
	
	$sts=" and orderm_dispatchflag!=1 and orderm_supflag=0 and orderm_cancelflag=0 ";
	
	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
	$tdate2=explode("-",$edate);
	$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];

$states=$txtstatesl; $loca="ALL"; $partee="ALL"; $crp="ALL"; $ver="ALL";
if($txtstatesl!="ALL")
{
	if($txtlocationsl!="ALL")
	{
		$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
		$noti = mysqli_fetch_array($sql_mon);
		$loca=$noti['productionlocation'];
	}
	if($txtparty!="ALL")
	{
		$sql_m=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."' order by business_name")or die(mysqli_error($link));
		$notic = mysqli_fetch_array($sql_m);
		$partee=$notic['business_name'];
	}
}	
if($txtcrop!="ALL")
{
	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
	$noticii = mysqli_fetch_array($quer);
	$crp=$noticii['cropname'];
}
if($txtvariety!="ALL")
{
	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' and actstatus='Active' order by popularname")or die(mysqli_error($link));

	$notici = mysqli_fetch_array($sql_mont);
	$ver=$notici['popularname'];
}


$blank=""; $statearr=""; $locarr=""; $partyarr=""; $statearrc=""; $locarrc=""; $partyarrc=""; $crparr=""; $ortype="ALL";

if($txtordertyp=="sales")
{
$ortype="Order Sales";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."'  and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."'  and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order Sales'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="stock")
{
$ortype="Order Stock Transfer";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="salesandstock")
{
$ortype="Order Sales and Order Stock Transfer";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="tdf")
{
$ortype="Order TDF";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
}
else
{
$ortype="ALL";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' order by orderm_date asc ") or die(mysqli_error($link));
}
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
<tr height="25">  
   <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="3">Period From: <?php echo $_GET['sdate'];?>&nbsp;&nbsp;To: <?php echo $_GET['edate'];?></td>
</tr>
<tr height="25">  
   <td valign="middle" align="left" class="subheading" style="color:#303918;" colspan="3">&nbsp;Order Type: <?php echo $ortype;?></td>
</tr>
<tr height="25">  
   <td width="42%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Crop: <?php echo $crp;?></td>
   <td width="34%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Variety: <?php echo $ver;?>&nbsp;</td>
    <td width="24%" valign="middle" align="right" class="subheading" style="color:#303918;">UPS: <?php echo $txtups;?>&nbsp;</td>
</tr>
<tr height="25">  
   <td width="42%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;State: <?php echo $states;?></td>
   <td width="34%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Location: <?php echo $loca;?></td>
   <td width="24%" valign="middle" align="right" class="subheading" style="color:#303918;">Party: <?php echo $partee;?>&nbsp;</td>
</tr>
</table>
<?php

while($rowstate=mysqli_fetch_array($sqlstate))
{
if($statearr!="")
$statearr=$statearr.",".$rowstate['orderm_locstate'];
else
$statearr=$rowstate['orderm_locstate'];
}

while($rowstate1=mysqli_fetch_array($sqlstate1))
{
if($statearr!="")
$statearr=$statearr.",".$rowstate1['orderm_partystate'];
else
$statearr=$rowstate1['orderm_partystate'];
}


while($rowloc=mysqli_fetch_array($sqlloc))
{
if($locarr!="")
$locarr=$locarr.",".$rowloc['orderm_location'];
else
$locarr=$rowloc['orderm_location'];
}

while($rowloc1=mysqli_fetch_array($sqlloc1))
{
if($locarrc!="")
$locarrc=$locarrc.",".$rowloc1['orderm_partycity'];
else
$locarrc=$rowloc1['orderm_partycity'];
}

while($rowpty=mysqli_fetch_array($sqlpty))
{
if($partyarr!="")
$partyarr=$partyarr.",".$rowpty['orderm_party'];
else
$partyarr=$rowpty['orderm_party'];
}

while($rowpty1=mysqli_fetch_array($sqlpty1))
{
if($partyarrc!="")
$partyarrc=$partyarrc.",".$rowpty1['orderm_partyname'];
else
$partyarrc=$rowpty1['orderm_partyname'];
}

$sqlcrp=mysqli_query($link,"select distinct cropid from tblcrop order by cropname asc ") or die(mysqli_error($link));
while($rowcrp=mysqli_fetch_array($sqlcrp))
{
if($crparr!="")
$crparr=$crparr.",".$rowcrp['cropid'];
else
$crparr=$rowcrp['cropid'];
}

$list3 = explode(",", implode(",",array_values(array_unique(explode(",",$statearr)))));
sort($list3);
$sstate=implode("','",$list3);
$zzz=array_values(array_unique(explode(",",$locarrc)));
$xx=array_values(array_unique(explode(",",$locarrc)));
$xz="";
foreach($xx as $valc)
{
if($valc<>"")
{
$query = mysqli_query($link,"SELECT `productionlocationid` FROM `tblproductionlocation` WHERE LOWER(`productionlocation`) = '".strtolower($valc)."'") or die(mysqli_error($link));
if($tot_s=mysqli_num_rows($query)>0)
{
if (($key = array_search($valc, $zzz)) !== false) {
    unset($zzz[$key]);
}
$row_s=mysqli_fetch_array($query);
if($xz!="")
$xz=$xz.",".$row_s['productionlocationid'];
else
$xz=$row_s['productionlocationid'];
}
}
}
$locarrc=implode(",",$zzz);

if($locarr!="")
$locarr=$locarr.",".$xz;
else
$locarr=$xz;
$locarr = implode(",",array_values(array_unique(explode(",",$locarr))));
$locarr.=",".$locarrc;
$sstate="'$sstate'";

$cpar="";
if($txtcrop=="ALL")
{
	$crpar=explode(",",$crparr);
	foreach($crpar as $cropval)
	{
		if($cropval<>"")
		{
			$sq=mysqli_query($link,"Select distinct order_sub_crop from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$cropval."' ") or die(mysqli_error($link));
			while($row_cp=mysqli_fetch_array($sq))
			{
				if($cpar!="")
					$cpar=$cpar.",".$row_cp['order_sub_crop'];
				else
					$cpar=$row_cp['order_sub_crop'];
			}
		}
	}
	$cpar=explode(",",$cpar);
}
else
{
$cpar=array($txtcrop);
}

//print_r($cpar);
//$crpar=explode(",",$cpar);
//print_r($crpar);
foreach($cpar as $cropval)
{
if($cropval<>"")
{

	$sqlcrp2=mysqli_query($link,"select * from tblcrop where cropid='".$cropval."' order by cropname asc ") or die(mysqli_error($link));
	$rowcrp2=mysqli_fetch_array($sqlcrp2);

	$sql=mysqli_query($link,"Select distinct orderm_id from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$cropval."' order by orderm_id") or die(mysqli_error($link));
	$tot_crpsub=mysqli_num_rows($sql);
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
<tr height="25">  
   <td valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Crop: <?php echo $rowcrp2['cropname'];?></td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td width="22"align="center" valign="middle" class="smalltblheading">#</td> 
	<td width="62" align="center" valign="middle" class="smalltblheading">Date</td>
    <td width="85" align="center" valign="middle" class="smalltblheading">Order No.</td>
	<td width="192" align="center" valign="middle" class="smalltblheading">Party Name</td>
	<td align="center" valign="middle" class="smalltblheading">Location</td>
	<td align="center" valign="middle" class="smalltblheading">State</td>
	<!--<td align="center" valign="middle" class="smalltblheading">Crop</td>-->
	<td align="center" valign="middle" class="smalltblheading">Variety</td>
	<td align="center" valign="middle" class="smalltblheading">Size</td>
	<td align="center" valign="middle" class="smalltblheading">Ordered Qty</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Qty</td>
	</tr>
<?php
$srno=1; 
while($row_crpsub=mysqli_fetch_array($sql))
{
	if($txtstatesl!="ALL")
	{
		$s="select * from tbl_orderm where orderm_date<='$edate' and orderm_date>='$sdate' and orderm_id='".$row_crpsub['orderm_id']."' and (orderm_locstate='$txtstatesl' OR orderm_partystate='$txtstatesl') and orderm_tflag=1 $sts ";
	}
	else
	{
		$s="select * from tbl_orderm where orderm_date<='$edate' and orderm_date>='$sdate' and orderm_id='".$row_crpsub['orderm_id']."' and orderm_tflag=1 $sts ";
	}
	if($txtordertyp=="sales")
	{
		$s.=" and order_trtype='Order Sales' ";
	}
	else if($txtordertyp=="stock")
	{
		$s.=" and order_trtype='Order Stock' ";
	}
	else if($txtordertyp=="salesandstock")
	{
		$s.=" and (order_trtype='Order Sales' OR order_trtype='Order Stock') ";
	}
	else if($txtordertyp=="tdf")
	{
		$s.=" and order_trtype='Order TDF' ";
	}
	else
	{
		$s.=" ";
	}
	$s.=" order by orderm_date asc ";

$sql_arr_home=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home > 0)
{ 

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	$orno=""; $party="";  $partyflg=0; 
	
	$partyid=$row_arr_home['orderm_party'];
	
	if($txtparty!="ALL" && $row_arr_home['orderm_party']==$txtparty)
	{
		$partyid=$txtparty;
	}
	else
	{
		$partyflg++;
	}
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party'] > 0)
	$party=$row3['business_name'];
	else
	$party=$row_arr_home['orderm_partyname'];
	
	$orno=$row_arr_home['orderm_porderno'];
	
	$ssub="select * from tbl_order_sub where orderm_id='$arrival_id' ";
	
	if($txtvariety!="ALL")
	{
		$ssub.=" and order_sub_crop='$cropval' and order_sub_variety='$txtvariety' order by order_sub_crop, order_sub_variety";
	}
	else
	{
		$ssub.=" and order_sub_crop='$cropval' order by order_sub_crop, order_sub_variety";
	}
$sql_subor=mysqli_query($link,$ssub) or die(mysqli_error($link));
$ttoott=mysqli_num_rows($sql_subor);

while($row_subor=mysqli_fetch_array($sql_subor))
{	
	$flg=0; $orstatus=""; $oqty=0; $bqty=0;
	$sqlsubsub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_subor['order_sub_id']."'") or die(mysqli_error($link));
	while($rowsubsub=mysqli_fetch_array($sqlsubsub))
	{
		$size=$rowsubsub['order_sub_sub_ups'];
		$ups=$size;
		$upp=explode(" ", $ups);
		$upc=floatval($upp[0]);
		$ups=$upc." ".$upp[1];
		$size=$ups;
		if($size==0)$size="";
		
		$oq=$rowsubsub['order_sub_sub_qty'];
		$bq=$rowsubsub['order_sub_subbal_qty'];
				
		if($txtups!="ALL")
		{
			if($size!="" && $size==$txtups)
			{
				$oqty=$oq;
				$bqty=$bq;
			}
			//else $flg=1;
		}
		else
		{
			$oqty=$oq;
			$bqty=$bq;
		}
		//echo $row_subor['order_sub_id']."  ".$orno."  =  ".$txtups."  -  ".$size."  >  ".$bqty."<br />";
		if($row_subor['order_sub_totbal_qty']<=0)
		{$bqty=0;}		
	
if($txtstatesl=="ALL")
{
	if($row_arr_home['orderm_locstate']!="")
	$statee=$row_arr_home['orderm_locstate'];
	else
	$statee=$row_arr_home['orderm_partystate'];
}
else
{
	$statee=$txtstatesl;
}

$locflg=0;
$locarr=explode(",",$locarr);
if($txtlocationsl=="ALL")
{
	if($row_arr_home['orderm_location']!="")
	$valoc=$row_arr_home['orderm_location'];
	else
	$valoc=$row_arr_home['orderm_partycity'];
	
	if (($key = array_search($valoc, $zzz)) !== false) 
	{
		$locflg++;
	}

}
else
{
	$valoc=$txtlocationsl;
	
	if (($key = array_search($valoc, $zzz)) !== false) 
	{
		$locflg++;
	}
}	

if($txtups!="ALL" && $txtups!=$size)
$locflg=1;

if($txtparty!="ALL" && $partyflg>0)
$locflg=1;

if($bqty==0)
$locflg=1;
if($locflg=="")$locflg=0;
//echo $locflg;
if($locflg>0) 
$flg=1;
else
$flg=0;

	$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$valoc."' order by productionlocation")or die(mysqli_error($link));
	$noti = mysqli_fetch_array($sql_mon);
	if($tloc=mysqli_num_rows($sql_mon) > 0)
	$loca=$noti['productionlocation'];
	else
	$loca=$valoc;

	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_subor['order_sub_crop']."' order by cropname Asc") or die(mysqli_error($link)); 
	$noticii = mysqli_fetch_array($quer);
	$crp1=$noticii['cropname'];

	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_subor['order_sub_variety']."' and actstatus='Active' order by popularname")or die(mysqli_error($link));
	$notici = mysqli_fetch_array($sql_mont);
	$ver1=$notici['popularname'];
	//echo $orno."  =  ".$ver1."  -  ".$bqty."<br />";
if($flg==0) 
{
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $orno?></td>
    <td width="192" align="center" valign="middle" class="smalltbltext"><?php echo $party?></td>
	<td width="87" align="center" valign="middle" class="smalltbltext"><?php echo $loca;?></td>
	<td width="84" align="center" valign="middle" class="smalltbltext"><?php echo $statee;?></td>
	<!--<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $crp1;?></td>-->
	<td width="114" align="center" valign="middle" class="smalltbltext"><?php echo $ver1;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $size;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?></td>
	</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $orno?></td>
    <td width="192" align="center" valign="middle" class="smalltbltext"><?php echo $party?></td>
	<td width="87" align="center" valign="middle" class="smalltbltext"><?php echo $loca;?></td>
	<td width="84" align="center" valign="middle" class="smalltbltext"><?php echo $statee;?></td>
	<!--<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $crp1;?></td>-->
	<td width="114" align="center" valign="middle" class="smalltbltext"><?php echo $ver1;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $size;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?></td>
	</tr>
<?php
}
$srno=$srno+1; 
}
}
}
}
}
}
if($srno==1)
{
?>
<tr height="25">  
   <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="10">No Pending Orders found</td>
</tr>
<?php
}
?>
</table>
<?php
}
}
?>

<table width="750" cellpadding="5" cellspacing="5" border="0" align="center" >
<tr >
<td height="49" align="center" valign="top"><a href="report_crop1.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
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
