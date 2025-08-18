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
	
		$reptyp=trim($_REQUEST['reptyp']);
		$txt=trim($_REQUEST['txt']);
		$txtlot=trim($_REQUEST['txtlot']);
		$txtlot1=trim($_REQUEST['txtlot1']);
		$txtlot2=trim($_REQUEST['txtlot2']);
		$txtlot3=trim($_REQUEST['txtlot3']);
		$txtlo=trim($_REQUEST['txtlo']);
		$pcode=trim($_REQUEST['pcode']);
		$txtcrop=trim($_REQUEST['txtcrop']);
		$txtvariety=trim($_REQUEST['txtvariety']);
		$txtstage=trim($_REQUEST['txtstage']);
		$stcode=trim($_REQUEST['stcode']);
		$ycode=trim($_REQUEST['ycodee']);
		$txtlot4=trim($_REQUEST['txtlot4']);
		$stcode2=trim($_REQUEST['stcode2']);
		
		$zz=str_split($txtlot1);
		//print_r($zz);
		$newlot1=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
		if($reptyp=="lotno")
		$lotno=$pcode.$ycode.$txtlot2."/".$stcode."/".$stcode2;	
		else
		$lotno=$newlot1;
		
	if(isset($_POST['frm_action'])=='submit')
	{exit;
		/*$reptyp=trim($_POST['reptyp']);
		$txt=trim($_POST['txt']);
		$txtlot=trim($_POST['txtlot']);
		$txtlot1=trim($_POST['txtlot1']);
		$txtlot2=trim($_POST['txtlot2']);
		$txtlot3=trim($_POST['txtlot3']);
		$txtlo=trim($_POST['txtlo']);
		$pcode=trim($_POST['pcode']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtstage=trim($_POST['txtstage']);
		$stcode=trim($_POST['stcode']);
		$ycode=trim($_POST['ycodee']);
		$txtlot4=trim($_POST['txtlot4']);
		
		echo $lotno=$pcode.$ycode.$txtlot2."/".$stcode;	
		exit;
		echo "<script>window.location='utility1.php?txtlot=$txtlot&txtcrop=$txtcrop&txtvariety=$txtvariety&txtstage=$txtstage&txtlot1=$txtlot1&pcode=$pcode&txt=$txt&txtlot2=$txtlot2&txtlot=$txtlot&txtlot3=$txtlot3&reptyp=$reptyp&txtlot4=$txtlot4&ycodee=$ycode&txtlo=$txtlo&stcode=$stcode'</script>";*/
	
		
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant-Utility - Lot Biography</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading.js"></script>
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

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	
function modetchk(classval)
{
	//alert(classval);
	showUser(classval,'vitem','item','','','','','');
	//document.frmaddDepartment.txtlot1.value==""
	}

	function openslocpop()
{
if(document.frmaddDepartment.txtcrop.value=="")
{
 alert("Please Select Crop.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
//var itm="Raw Seed";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;

winHandle=window.open('getuser_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=150,left=160,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function typchk(opt)
{
document.frmaddDepartment.txt11.value=opt;
		if(opt!="")
	{
		if(opt=="select")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			//document.getElementById('byhand').style.display="none";
		
		}
		else if(opt=="lotno")
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			//document.getElementById('byhand').style.display="none";
			
		}	
		else 
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			//document.getElementById('byhand').style.display="block";
	}
	}
}

function mySubmit()
{	
//alert(document.frmaddDepartment.reptyp.value);
	var maintyp=document.frmaddDepartment.reptyp.value=document.frmaddDepartment.txt11.value;
	if(maintyp=="")
	{
		alert("Please Select Option");
		return false;
	}
	if(maintyp=="select")
		{
			val1=document.frmaddDepartment.txtcrop.value;
			val2=document.frmaddDepartment.txtvariety.value;
			val4=document.frmaddDepartment.txtstage.value;
			val5=document.frmaddDepartment.txtlot1.value;
			val3="";
			if(val1=="")
			{
				alert("Please Select Crop");
				return false;
			}
			if(val2=="")
			{
				alert("Please Select Variety");
				return false;
			}
			if(val4=="")
			{
				alert("Please Select Stage");
				return false;
			}
			if(val5=="")
			{
				alert("Please Select Lot No.");
				return false;
			}
		}
		if(maintyp=="lotno")
		{
		val2=document.frmaddDepartment.ycodee.value;
		val5=document.frmaddDepartment.txtlot2.value;
		val6=document.frmaddDepartment.stcode.value;
		val7=document.frmaddDepartment.pcode.value;
		var f=0;
		if(val7=="")
		{
			alert("Please Select Plant code");
			return false;
		}
		if(val2=="")
		{
			alert("Please Select Year Code");
			return false;
		}	
		if(val5=="")
		{
			alert("Please Enter Lot No.");
			return false;
		}
		if(val5.length < 5)
		{
			alert("Invalid Lot No.");
			return false;
		}
		if(val6=="")
		{
			alert("Please Enter Lot No.");
			return false;
		}
		if(val6.length < 5)
		{
			alert("Invalid Lot No.");
			return false;
		} 
	}
return true;
}

function spmchk(val)
{

}

function closepop()
{
	document.getElementById("qclcycle").style.display="none";
}
function openpop()
{
	document.getElementById("qclcycle").style.display="block";
}
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >Utility - Lot Biography</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
          <tr height="7">
            <td height="7"></td>
          </tr>
          <tr>
            <td width="30"></td>
            <td>
<?php

$sql_lotldg=mysqli_query($link,"Select * from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_lotldg=mysqli_num_rows($sql_lotldg);
$row_lotldg=mysqli_fetch_array($sql_lotldg);

$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_lotldg['lotldg_crop']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
				
$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_lotldg['lotldg_variety']."'") or die(mysqli_error($link));
$row0=mysqli_fetch_array($quer0);

$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);


$crop=$row_class['cropname'];
$variety=$row0['popularname'];
$got=$row_whouse['got1'];
?>			
		<table align="center" border="1" bordercolor="#2e81c1" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<!--<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading"><font size="+1">Lot Biography</font> </td>
</tr>-->
<tr class="tblsubtitle" height="20">
	<td width="126" align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
	<td width="264" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading">&nbsp;Variety&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td align="right"  valign="middle" class="tblheading">&nbsp;Lot No.&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $lotno;;?></td>
	<td align="right"  valign="middle" class="tblheading">&nbsp;GOT on Arrival&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>

  </table>	
  
  <?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' order by oldlot,tid desc limit 0,1") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) 
 {  
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Quality Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="99" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="97" align="center" valign="middle" class="tblheading">PP</td>
	<td width="97" align="center" valign="middle" class="tblheading">Moist%</td>
	<td width="97" align="center" valign="middle" class="tblheading">Germ%</td> 
	<td width="99" align="center" valign="middle" class="tblheading">GOT Status </td>
	<td width="99" align="center" valign="middle" class="tblheading">DOGR</td>
    <td width="99" align="center" valign="middle" class="tblheading">Seed Status</td>
</tr>
<?php
$srno=1;
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstat="";	
	while($row_tbl_sub1=mysqli_fetch_array($sql_arr_home))
	{	

		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
	
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
		
	$sql_tbl12=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl12=mysqli_fetch_array($sql_tbl12);
	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' and lotldg_id='".$row_tbl12[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$moist=$row_tbl_sub1['moist'];
$pp=$row_tbl['lotldg_vchk'];	
$gemp=$row_tbl_sub1['gemp'];
$sstat=$row_tbl['lotldg_sstatus'];
if($row_tbl['lotldg_srflg'] > 0)
{
	if($sstat!="")$sstat=$sstat."/"."S";
	else
	$sstat="S";
}
if($gemp==0) $gemp="";

if($pp=="Acceptable")
{
$cc="Acc";
}
else if($pp=="Not-Acceptable")
{
$cc="Nac";
}


$aq=explode(".",$row_tbl_sub1['moist']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub1['moist'];}

	$trdate1=$row_tbl['lotldg_gottestdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;	
	
	$trdate11=$row_tbl_sub1['testdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$trdate11=$trday."-".$trmonth."-".$tryear;	
$qc=$row_tbl_sub1['qcstatus'];
$zzz=explode(" ", $row_tbl['lotldg_got1']);
//$zzz=explode(" ",$gggg[0]);
$got=$zzz[0]." ".$row_tbl['lotldg_got'];

$sqltbl12=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$rowtbl12=mysqli_fetch_array($sqltbl12);
	 
$sqltbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$lotno."' and lotdgp_id='".$rowtbl12[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$rowtbl=mysqli_fetch_array($sqltbl);

	$trdate12=$rowtbl['lotldg_qctestdate'];
	$tryear=substr($trdate12,0,4);
	$trmonth=substr($trdate12,5,2);
	$trday=substr($trdate12,8,2);
	$trdate112=$trday."-".$trmonth."-".$tryear;	
	
	$diff = (strtotime($trdate112) - strtotime($trdate11));
//if($diff > 0)$trdate11=$trdate112;
if($srno%2!=0)
{
?>	
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php if($trdate11=="00-00-0000")echo ""; else echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php if($trdate1=="00-00-0000")echo ""; else echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $sstat;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php if($trdate11=="00-00-0000")echo ""; else echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php if($trdate1=="00-00-0000")echo ""; else echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $sstat;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="right" class="subheading" style="color:#303918; " colspan="3"><a href="Javascript:void(0);" onclick="openpop();">QC Life Cycle</a></td>
</tr>
</table>
<div id="qclcycle" style="display:none">
<?php
$sql_lotldg=mysqli_query($link,"Select * from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
$row_lotldg=mysqli_fetch_array($sql_lotldg);

$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_lotldg['lotldg_crop']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
				
$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_lotldg['lotldg_variety']."' ") or die(mysqli_error($link));
$row0=mysqli_fetch_array($quer0);

$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);


$crop=$row_class['cropname'];
$variety=$row0['popularname'];
$got=$row_whouse['got1'];
?>
<table align="center" border="0" bordercolor="#2e81c1" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr class="light" height="25">
  <td colspan="4" align="center" class="subheading">QC Life Cycle</td>
</tr>
</table>
<!--<table align="center" border="1" bordercolor="#2e81c1" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="126" align="left"  valign="middle" class="tblheading">&nbsp;Crop:&nbsp;</td>
	<td width="264" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
	<td width="132" align="left"  valign="middle" class="tblheading">&nbsp;Variety:&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td align="left"  valign="middle" class="tblheading">&nbsp;Lot Details:&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $lotno;;?></td>
	<td align="left"  valign="middle" class="tblheading">&nbsp;GOT Status on Arrival:&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>

  </table>	-->
<?php

$dt="";
$sql_tbl333=mysqli_query($link,"select * from tbl_qctest where oldlot='".$lotno."' and plantcode='$plantcode' group by testdate order by testdate desc, tid desc") or die(mysqli_error($link));
$tot333=mysqli_num_rows($sql_tbl333);
while($row_tbl333=mysqli_fetch_array($sql_tbl333))
{
if($dt!="")
$dt=$dt.",".$row_tbl333['srdate'];
else
$dt=$row_tbl333['srdate'];
}
$sql_pp333=mysqli_query($link,"select * from tbl_pmupdate where lotno='".$lotno."' and plantcode='$plantcode' order by pmup_id desc") or die(mysqli_error($link));
$tot_pp333=mysqli_num_rows($sql_pp333);
while($row_pp333=mysqli_fetch_array($sql_pp333))
{
if($dt!="")
$dt=$dt.",".$row_pp333['pmup_date'];
else
$dt=$row_pp333['pmup_date'];
}
$d1=explode(",",$dt);
$dt1=array_unique($d1);
rsort($dt1);
//print_r($dt1);
$sql_tbl2=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' group by gotdate  order by tid desc") or die(mysqli_error($link));

?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="center" class="subheading" style="color:#303918; ">QC Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="76" align="center" valign="middle" class="tblheading">#</td>
	<td width="82" align="center" valign="middle" class="tblheading">DOSR</td>
	<td width="80" align="center" valign="middle" class="tblheading">DOSC</td>
	<td width="83" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="81" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="63" align="center" valign="middle" class="tblheading">PP</td> 
	<td width="73" align="center" valign="middle" class="tblheading">Moist%</td>
	<td width="70" align="center" valign="middle" class="tblheading">Germ%</td>
	<td width="122" align="center" valign="middle" class="tblheading">Doc. Ref. No.</td>
</tr>
  <?php
$srno=1;
  foreach ($dt1 as $dval) 
  {
  if($dval<>"")
  {
  $sql_tbl=mysqli_query($link,"select * from tbl_qctest where oldlot='".$lotno."' and srdate='".$dval."' and plantcode='$plantcode' group by testdate order by srdate desc, tid desc") or die(mysqli_error($link));
$tot1=mysqli_num_rows($sql_tbl);
 
 $sql_pp=mysqli_query($link,"select * from tbl_pmupdate where lotno='".$lotno."' and pmup_date='".$dval."' and plantcode='$plantcode' order by pmup_date desc") or die(mysqli_error($link));
$tot2=mysqli_num_rows($sql_pp);
 

 
if($tot1 > 0)	
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{
$tdate=$row_tbl_sub['srdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl_sub['spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl_sub['testdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$lot11=$row_tbl_sub['qcstatus'];
		$qc=$row_tbl_sub['pp'];
		$got=$row_tbl_sub['moist'];
		$stage=$row_tbl_sub['gemp'];
		
		$docref=$row_tbl_sub['qcrefno'];
if($stage==0) $stage="";
$cnt=0;	
$arr=explode("/", $row_tbl_sub['state']);	
foreach($arr as $arr1)
{
if($arr1=="G")$cnt=1;
}
if($cnt == 1)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>	
<?php
}
$srno=$srno+1;
}
}
}
if($tot2>0)
{
while($row_pp=mysqli_fetch_array($sql_pp))
{
	$tdate="";
	$tdate1="";
	$tdate2=$row_pp['pmup_date'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	$lot11="";
	$qc=$row_pp['pp'];
	$got=$row_pp['moist'];
	$stage="";
	$docref="PPM Update";
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>	
<?php
}
$srno=$srno+1;
}
}

}
}
?>	
</table>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="center" class="subheading" style="color:#303918; ">GOT Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">#</td>
	<td width="99" align="center" valign="middle" class="tblheading">DOSR</td>
	<td width="97" align="center" valign="middle" class="tblheading">DOSC</td>
	<td width="97" align="center" valign="middle" class="tblheading">DOSD</td>
	<td width="97" align="center" valign="middle" class="tblheading">DOGR</td>
	<td width="97" align="center" valign="middle" class="tblheading">GOT Status</td> 
    <td width="97" align="center" valign="middle" class="tblheading">Doc. Ref. No.</td>
</tr>
  <?php
$srno=1;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl2))
{
$tdate=$row_tbl_sub['srdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl_sub['spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl_sub['gotdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$tdate3=$row_tbl_sub['dosdate'];
	$tyear3=substr($tdate3,0,4);
	$tmonth3=substr($tdate3,5,2);
	$tday3=substr($tdate3,8,2);
	$tdate3=$tday3."-".$tmonth3."-".$tyear3;
	if($row_tbl_sub['dosdate']=="")$tdate3="--";
	
	$z=explode(" ", $row_lotldg['lotldg_got1']);
	
	$lot22=$z[0]." ".$row_lotldg['lotldg_got'];
	$docref2=$row_tbl_sub['gotrefno'];
$cnt=0;	
$arr=explode("/", $row_tbl_sub['state']);	
foreach($arr as $arr1)
{
if($arr1=="T")$cnt++;
}
if($cnt == 1)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate3=="00-00-0000")echo ""; else echo $tdate3;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="tblheading"><?php echo $docref2;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate3=="00-00-0000")echo ""; else echo $tdate3;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="tblheading"><?php echo $docref2;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
//}
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="right" class="subheading" style="color:#303918; " colspan="3"><a href="Javascript:void(0);" onclick="closepop();">Close</a></td>
</tr>
</table>
</div>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Quantity Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="99" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="97" align="center" valign="middle" class="tblheading">Qty</td>
	<td align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1;
$sql_tbl_sub=mysqli_query($link,"select distinct(lotldg_sstage) from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode'")or die(mysqli_error($link));
$ct1=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2=""; $srn=1;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and plantcode='$plantcode'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'  and lotldg_binid='".$row_qc_sub['lotldg_binid']."'  and lotldg_whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty>0 and plantcode='$plantcode'")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_qc_sub['lotldg_binid']."' and whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_qc_sub['lotldg_subbinid']."' and binid='".$row_qc_sub['lotldg_binid']."' and whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_month['lotldg_balbags'];
 $slqty=$row_month['lotldg_balqty'];

$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}

$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2=""; $srn=1;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE orlot='".$lotno."' and plantcode='$plantcode'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE orlot='".$lotno."' and subbinid='".$row_qc_sub['subbinid']."'  and binid='".$row_qc_sub['binid']."'  and whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and balqty>0 and plantcode='$plantcode'")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_qc_sub['binid']."' and whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_qc_sub['subbinid']."' and binid='".$row_qc_sub['binid']."' and whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slqty=$row_month['balqty'];
 //$slqty="";

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slqty;

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

//$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}
$ac="";

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo "Pack";?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr>
</table>
<?php	
// }
$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_tb1=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_whouse['arrival_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
$sql_tb2=mysqli_fetch_array($sql_tb1);

		 $arr_type=$sql_tb2['arrival_type'];

		$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot=""; $spcm=""; $spcf=""; $plotno=""; $pdnno="";$plotsize="";$vendor="";$vendorvariety="";$dcno="";
		
				if($arr_type=="Fresh Seed with PDN")
				{
					$crop=$row_whouse['lotcrop'];
					$tp="Fresh Seed with PDN";
					$org=$row_whouse['organiser'];
					$far=$row_whouse['farmer'];
					$variety=$row_whouse['lotvariety'];
					$ploc=$row_whouse['ploc'];
					$pper=$row_whouse['pper'];
					$stage=$row_whouse['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got=$row_whouse['got1'];
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$gi=$row_whouse['gi'];
					$vchk=$row_whouse['vchk'];
					$spcm=$row_whouse['spcodem'];
					$spcf=$row_whouse['spcodef'];
					$plotno=$row_whouse['plotno'];
					$plotsize=$row_whouse['plotsize'];
					$pdnno=$row_whouse['pdnno'];
				}
				else if($arr_type=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tb2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tb2['lotvariety']."' ") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
					
					$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$sql_tb2['party_id']."'") or die(mysqli_error($link));
					$tot_party=mysqli_num_rows($sql_party);
					if($tot_party > 0)
					{
					$row_party=mysqli_fetch_array($sql_party);
					
					$vendor=$row_party['business_name']."<br/>".$row_party['address'].", ".$row_party['city'].", ".$row_party['state']." - ".$row_party['pin'];
					}
					
					$vendorvariety=$sql_tb2['vvariety'];
					$dcno=$sql_tb2['dcno'];
					
					$crop=$sql_tb2['lotcrop'];
					$variety=$sql_tb2['lotvariety'];
					$stage=$sql_tb2['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got=$row_whouse['got1'];
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$vchk=$row_whouse['vchk'];
					$oldlot = $row_whouse['lotoldlot'];
				}
				else if($arr_type=="Unidentified")
				{
					$tp="Unidentified";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tbl2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tbl2['lotvariety']."' ") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
					
					$vendor=$sql_tb2['type'];
					$ploc=$row_whouse['ploc'];
					$crop=$sql_tbl2['lotcrop'];
					$variety=$sql_tbl2['lotvariety'];
					$stage=$row_whouse['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got=$row_whouse['got1'];
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$vchk=$row_whouse['vchk'];
					$oldlot = $row_whouse['lotoldlot'];
				}
				else
				{
				$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot=""; $spcm=""; $spcf=""; $plotno=""; $pdnno="";$plotsize="";$vendor="";$vendorvariety="";$dcno="";
				}
				
$germ=$row_whouse['gemp'];

if($vchk=="Acceptable"){$vchk="Acc";}
if($vchk=="Not-Acceptable"){$vchk="NAcc";}
$pp=$vchk;
	$trdate=$sql_tb2['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_whouse['harvestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_whouse['pdndate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
	
	$trdate3=$sql_tb2['dc_date'];
	$tryear3=substr($trdate3,0,4);
	$trmonth3=substr($trdate3,5,2);
	$trday3=substr($trdate3,8,2);
	$trdate3=$trday3."-".$trmonth3."-".$tryear3;
	
	$trdate4=$sql_tb2['dc_date'];
	$tryear4=substr($trdate4,0,4);
	$trmonth4=substr($trdate4,5,2);
	$trday4=substr($trdate4,8,2);
	$trdate4=$trday4."-".$trmonth4."-".$tryear4;
	
	$nob=0; $qty=0;
	$sql_tbl=mysqli_query($link,"select * from tblarr_sloc where arr_id='".$row_whouse['arrsub_id']."' and arr_tr_id='".$row_whouse['arrival_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));

	while($row_arr=mysqli_fetch_array($sql_tbl))
	{ 
	$nob=$nob+$row_arr['bags'];
	$qty=$qty+$row_arr['qty'];
	}
	
?><br />


<?php if($arr_type=="Fresh Seed with PDN") {?>
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Arrival Status-Fresh Seed with PDN</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Arrival Type&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3" >&nbsp;<?php echo $tp;?></td>
</tr>
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">SP code Female&nbsp;</td>
	<td width="255" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $spcf;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">SP code Male&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $spcm;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Production Location&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $ploc;?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Production Personnel&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pper;?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Organiser&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $org;?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Farmer&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $far;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Plot No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $plotno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
	<!--<td align="right" valign="middle" class="tblheading">Plot Size&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $plotsize;?></td>-->
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GI&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $gi;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Harvest Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate1;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PDN No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pdnno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PDN Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate2;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate3;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Arrival Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GOT on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>

</table>
<?php } ?>
<?php if($arr_type=="Trading") {?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Arrival Status-Trading Arrival</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Arrival Type&nbsp;</td>
	<td width="255" align="left" valign="middle" class="tblheading" >&nbsp;<?php echo $tp;?></td>
	<td width="132" align="right" valign="middle" bgcolor="#92cef9" class="tblheading">Arrival Date&nbsp;</td>
	<td width="268" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor Variety Name&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendorvariety;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor Lot No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $oldlot;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dcno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate4;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GOT Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $germ;?></td>
</tr>-->


</table>
<?php } ?>
<?php if($arr_type=="Unidentified") {?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Arrival Status-Unidentified Arrival</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Arrival Type&nbsp;</td>
	<td width="255" align="left" valign="middle" class="tblheading" >&nbsp;<?php echo $tp;?></td>
	<td width="132" align="right" valign="middle" bgcolor="#92cef9" class="tblheading">Arrival Date&nbsp;</td>
	<td width="268" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Unidentified Arrived In&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Location&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $ploc;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor Lot No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $oldlot;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dcno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php if($trdate3!="" && $trdate3!="00-00-0000")echo $trdate3;?></td>
</tr>-->
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GOT Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $germ;?></td>
</tr>-->


</table>
<?php } ?>
<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
	<td valign="top" align="center"><a href="utility.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;
</tr>
</table>

</td>
            <td ></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
	    <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	  </form>	  </td>
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
