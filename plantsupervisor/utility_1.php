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

function openslocpopprint(tid,tid1)
{
winHandle=window.open('utility_packaging.php?itmid='+tid+'&itmid1='+tid1,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openslocpopprint1(tid,tid1)
{
winHandle=window.open('barcodedisp.php?itmid='+tid+'&itmid1='+tid1,'WelCome','top=170,left=180,width=750,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openslocpopprint2(tid,tid1)
{
winHandle=window.open('allocbarcode.php?itmid='+tid+'&itmid1='+tid1,'WelCome','top=170,left=180,width=750,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
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

$sql_lotldgpack=mysqli_query($link,"Select * from tbl_lot_ldg_pack where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_lotldgpack=mysqli_num_rows($sql_lotldgpack);
$row_lotldgpack=mysqli_fetch_array($sql_lotldgpack);

$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$newlotno="";
if($tot_lotldg>0)
{
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_lotldg['lotldg_crop']."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
					
	$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_lotldg['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$row0=mysqli_fetch_array($quer0);
}
else if($tot_lotldgpack>0)
{
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_lotldgpack['lotldg_crop']."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
					
	$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_lotldgpack['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$row0=mysqli_fetch_array($quer0);
}

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
	<td width="264" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $crop;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading">&nbsp;Variety&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $variety;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td align="right"  valign="middle" class="tblheading">&nbsp;Lot No.&nbsp;</td><td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $lotno;?></td>
	<td align="right"  valign="middle" class="tblheading">&nbsp;GOT on Arrival&nbsp;</td><td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $got;?></td>
</tr>

  </table>	
  
  <?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' order by oldlot,tid desc limit 0,1") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) 
 {  
?><br />
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
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."' and actstatus='Active'"); 
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
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($trdate11=="00-00-0000")echo ""; else echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($trdate1=="00-00-0000")echo ""; else echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $sstat;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($trdate11=="00-00-0000")echo ""; else echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($trdate1=="00-00-0000")echo ""; else echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $sstat;?></td>
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
				
$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_lotldg['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
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
	<td width="126" align="left"  valign="middle" class="smalltbltext">&nbsp;Crop:&nbsp;</td>
	<td width="264" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $crop;?></td>
	<td width="132" align="left"  valign="middle" class="smalltbltext">&nbsp;Variety:&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $variety;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td align="left"  valign="middle" class="smalltbltext">&nbsp;Lot Details:&nbsp;</td><td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $lotno;;?></td>
	<td align="left"  valign="middle" class="smalltbltext">&nbsp;GOT Status on Arrival:&nbsp;</td><td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $got;?></td>
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
	<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="smalltbltext"><?php echo $docref;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="smalltbltext"><?php echo $docref;?></td>
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
	<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="smalltbltext"><?php echo $docref;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="80" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="83" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="smalltbltext"><?php echo $docref;?></td>
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
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate3=="00-00-0000")echo ""; else echo $tdate3;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $docref2;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate3=="00-00-0000")echo ""; else echo $tdate3;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $docref2;?></td>
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
$nob=0; $qty=0; $slocs=""; $slocs2=""; $srn=1;  $sups=""; $sqty=0; 
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
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0; 
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
$nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2=""; $srn=1;
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
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo "Pack";?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
</table><br />
<?php
$a=$lotno;
$zzz=implode(",", str_split($a));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
$baselot2=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26];
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where SUBSTRING(lotldg_lotno,1,13)='$abc' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where SUBSTRING(lotno,1,13)='$abc' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$mxlot=$abc2;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2;

$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $sstage=""; $crop=""; $variety="";
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where orlot='".$a."'  and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nob=$nob+$row_issuetbl['lotldg_balbags']; 
$qty=$qty+$row_issuetbl['lotldg_balqty'];
$sstage=$row_issuetbl['lotldg_sstage'];

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];

$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
	$trdate=$row_issuetbl['lotldg_qctestdate'];
	$trdate=explode("-",$trdate);
	$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
	$qcdttype="DOT";
}
else
{
	$zz=str_split($a);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				$softstatus=$row_softr['softrsub_srtyp'];
			}
		}
		//if($row_issuetbl['lotldg_got']=='UT' || $row_issuetbl['lotldg_got']=='RT')
		if($softstatus=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
					$softstatus=$row_softr2['softrsub_srtyp'];
				}
			}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
}
if($softstatus!="") 
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">SR/SSR Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="Light" height="20">
	<td width="105" align="center" valign="middle" class="tblheading" bgcolor="#92cef9">SR/SSR Type</td>
	<td width="104" align="center" valign="middle" class="tblheading"><?php echo ucwords($softstatus);?></td>
	<td width="110" align="center" valign="middle" class="tblheading" bgcolor="#92cef9">DoSR/DoSSR</td>
	<td width="109" align="center" valign="middle" class="tblheading"><?php echo $qcdot; ?></td>
</tr>

</table><br />

<?php
}
$lotnor=$lotno."R";
$lotnoc=$lotno."C";
$lotnop=$lotno."P";
$opstk=""; 
$sql_lot=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode' order by lotldg_id limit 0,1") or die(mysqli_error($link));
$tot_lot=mysqli_num_rows($sql_lot);
$row_lot=mysqli_fetch_array($sql_lot);
if($tot_lot>0)
{

	$sql_stock=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where orlot='".$lotno."' and lotldg_trtype='".$row_lot['lotldg_trtype']."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
	while($row_stock=mysqli_fetch_array($sql_stock))
	{
	$sql_stock1=mysqli_query($link,"select MIN(lotldg_id) from tbl_lot_ldg where orlot='".$lotno."' and lotldg_subbinid='".$row_stock['lotldg_subbinid']."' and lotldg_trtype='".$row_lot['lotldg_trtype']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stock1=mysqli_fetch_array($sql_stock1);
	
	$sql_stock12=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' and lotldg_id='".$row_stock1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stock12=mysqli_fetch_array($sql_stock12);
	
	$opstk=$opstk+$row_stock12['lotldg_balqty'];
	}
//$opstk=$row_lot['lotldg_balqty'];
}

if($tot_lot==0)
{
//echo "select * from tbl_lot_ldg_pack where orlot='".$lotno."' order by lotldg_id asc";
	$sql_lot=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$lotno."' and plantcode='$plantcode' order by lotdgp_id asc limit 0,1") or die(mysqli_error($link));
	$tot_lot=mysqli_num_rows($sql_lot);
	$row_lot=mysqli_fetch_array($sql_lot);
	$opstk=$row_lot['balqty'];
}
$discardqty=0; $totloss=0; $totbatch=0;
$sql_discard=mysqli_query($link,"select * from tbl_discard_sub where lotnumber='".$lotno."' and plantcode='$plantcode' order by did asc") or die(mysqli_error($link));
$tot_discard=mysqli_num_rows($sql_discard);
while($row_discard=mysqli_fetch_array($sql_discard))
{
	$discardqty=$discardqty+$row_discard['qty'];
}

$dryloss=0;
$sql_dryloss=mysqli_query($link,"select * from tbl_dryingsub where lotno='".$lotnor."' and plantcode='$plantcode' order by subtrid asc") or die(mysqli_error($link));
$tot_dryloss=mysqli_num_rows($sql_dryloss);
if($tot_dryloss==0)
{
	$sql_dryloss=mysqli_query($link,"select * from tbl_dryingsub where lotno='".$lotnoc."' and plantcode='$plantcode' order by subtrid asc") or die(mysqli_error($link));
}
while($row_dryloss=mysqli_fetch_array($sql_dryloss))
{
	$sql_dryloss1=mysqli_query($link,"select * from tbl_dryingsubsub where subtrid='".$row_dryloss['subtrid']."' and plantcode='$plantcode' order by subsubid asc") or die(mysqli_error($link));
	while($row_ryloss1=mysqli_fetch_array($sql_dryloss1))
	{
		$dryloss=$dryloss+$row_ryloss1['dryingloss'];
	}
}

$pakloss=0; $pakbatch=0;
$sql_pakloss=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipsub_orlot='".$lotno."' and plantcode='$plantcode' order by pnpslipsub_id asc") or die(mysqli_error($link));
//$tot_dryloss=mysqli_num_rows($sql_dryloss);
while($row_pakloss=mysqli_fetch_array($sql_pakloss))
{
	$dryloss=$dryloss+$row_pakloss['pnpslipsub_packloss']+$row_pakloss['pnpslipsub_packcc'];
	if($row_pakloss['pnpslipsub_packtype']=="P")
	{
		$pakbatch=$pakbatch+$row_pakloss['pnpslipsub_packqty'];
	}
}

$proloss=0; $probatch=0;
$sql_proloss=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_orlot='".$lotno."' and plantcode='$plantcode' order by proslipsub_id asc") or die(mysqli_error($link));
//$tot_dryloss=mysqli_num_rows($sql_dryloss);
while($row_proloss=mysqli_fetch_array($sql_proloss))
{
	$proloss=$proloss+$row_proloss['proslipsub_tlqty'];
	if($row_proloss['proslipsub_processtype']=="P")
	{
		$probatch=$probatch+$row_proloss['proslipsub_conqty'];
	}
}

$rvloss=0; $rvobatch=0;
$sql_rvloss=mysqli_query($link,"select * from tbl_revalidate where rv_lotno='".$lotnop."' and plantcode='$plantcode' order by rv_id asc") or die(mysqli_error($link));
//$tot_dryloss=mysqli_num_rows($sql_dryloss);
while($row_rvloss=mysqli_fetch_array($sql_rvloss))
{
	$rvloss=$rvloss+$row_rvloss['rv_qcnop'];
	if($row_rvloss['rv_rvtyp']=="partial")
	{
		$rvobatch=$rvobatch+$row_rvloss['rv_bqty'];
	}
}

$p2closs=0; $p2cbatch=0;
$sql_p2closs=mysqli_query($link,"select * from tbl_psunpp2c where unp_orlot='".$lotno."' and plantcode='$plantcode' order by unp_id asc") or die(mysqli_error($link));
$tot_p2closs=mysqli_num_rows($sql_p2closs);
while($row_p2closs=mysqli_fetch_array($sql_p2closs))
{
	$sql_p2closs1=mysqli_query($link,"select * from tbl_psunpp2c_sub where unp_id='".$row_p2closs['unp_id']."' and plantcode='$plantcode' order by unps_id asc") or die(mysqli_error($link));
	while($row_p2closs1=mysqli_fetch_array($sql_p2closs1))
	{
		//$p2closs=$p2closs+$row_p2closs1['dryingloss'];
		if($row_p2closs['unp_p2ctype']=="partial")
		{
			$p2cbatch=$p2cbatch+$row_p2closs1['unp_qty'];
		}
	}
}

$totloss=$dryloss+$pakloss+$proloss+$rvloss+$p2closs;
$totbatch=$pakbatch+$probatch+$rvobatch+$p2cbatch;
//echo "select * from tbl_lot_ldg where orlot='".$lotno."' and lotldg_trid!='".$row_lot['lotldg_trid']."' order by lotldg_id asc";
$totdispqty=0; $dispbulk=0; $disptdf=0; $stkoutdisp=0; $qtyremdisp=0;
$sql_lotldg=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
$tot_lotldg=mysqli_num_rows($sql_lotldg);
//$row_lotldg=mysqli_fetch_array($sql_lotldg);
while($row_lotldg=mysqli_fetch_array($sql_lotldg))
{
	if($row_lotldg['lotldg_trtype']=="Dispatch Bulk")
	{
		$dispbulk=$dispbulk+$row_lotldg['lotldg_trqty'];
	}
	if($row_lotldg['lotldg_trtype']=="Dispatch TDF")
	{
		$disptdf=$disptdf+$row_lotldg['lotldg_trqty'];
	}
	if($row_lotldg['lotldg_trtype']=="Stock Transfer Out")
	{
		$stkoutdisp=$stkoutdisp+$row_lotldg['lotldg_trqty'];
	}
	if($row_lotldg['lotldg_trtype']=="Qty-Rem")
	{
		$qtyremdisp=$qtyremdisp+$row_lotldg['lotldg_trqty'];
	}
}
//echo "select * from tbl_lot_ldg_pack where orlot='".$lotno."' and lotldg_id!='".$row_lot['lotldg_id']."' order by lotdgp_id asc";
$sql_lotldgpak=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$lotno."' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
$tot_lotldgpak=mysqli_num_rows($sql_lotldgpak);
//$row_lotldgpak=mysqli_fetch_array($sql_lotldgpak);
$dispqty=0; $dispbulk1=0; $disptdf1=0; $stkoutdisp1=0; $qtyremdisp1=0; 
while($row_lotldgpak=mysqli_fetch_array($sql_lotldgpak))
{
	if($row_lotldgpak['trtype']=="Dispatch")
	{
		$dispqty=$dispqty+$row_lotldgpak['tqty'];
	}
	if($row_lotldgpak['trtype']=="Dispatch Bulk")
	{
		$dispbulk1=$dispbulk1+$row_lotldgpak['tqty'];
	}
	if($row_lotldgpak['trtype']=="Dispatch TDF")
	{
		$disptdf1=$disptdf1+$row_lotldgpak['tqty'];
	}
	if($row_lotldgpak['trtype']=="Stock Transfer Out")
	{
		$stkoutdisp1=$stkoutdisp1+$row_lotldgpak['tqty'];
	}
	if($row_lotldgpak['trtype']=="Qty-Rem")
	{
		$qtyremdisp1=$qtyremdisp1+$row_lotldgpak['tqty'];
	}
}
$totdispqty=$dispbulk+$disptdf+$stkoutdisp+$qtyremdisp+$dispqty+$dispbulk1+$disptdf1+$stkoutdisp1+$qtyremdisp1;
//echo $lotnop;
$allocqty=0;
//echo "select distinct dallocs_id from tbl_dallocsub_sub where dallocss_lotno='".$lotnop."' order by dallocss_id asc";
$sql_allocss=mysqli_query($link,"select * from tbl_dallocsub_sub where dallocss_lotno='".$lotnop."' and plantcode='$plantcode' order by dallocss_id asc") or die(mysqli_error($link));
$alloups="";
while($row_allocss=mysqli_fetch_array($sql_allocss))
{
	if($row_allocss['dallocs_id']!=$allocssid)
	{
		$sql_allocs=mysqli_query($link,"select * from tbl_dalloc_sub where dallocs_id='".$row_allocss['dallocs_id']."' and dallocs_ups='".$row_allocss['dallocss_ups']."' and dallocs_dflg=0 and plantcode='$plantcode' order by dallocs_id asc") or die(mysqli_error($link));
		$tot_allocs=mysqli_num_rows($sql_allocs);
		$row_allocs=mysqli_fetch_array($sql_allocs);
		
		if($tot_allocs>0)
		{
			$sql_allocss2=mysqli_query($link,"select * from tbl_dallocsub_sub where dallocs_id='".$row_allocs['dallocs_id']."' and dallocss_ups='".$row_allocs['dallocs_ups']."' and dallocss_lotno='".$lotnop."' and plantcode='$plantcode' order by dallocss_id asc") or die(mysqli_error($link));
			while($row_allocss2=mysqli_fetch_array($sql_allocss2))
			{
				$allocqty=$allocqty+($row_allocss2['dallocss_qty']-$row_allocss2['dallocss_dispqty']);
			}
		}
	}
$allocssid=$row_allocss['dallocs_id'];
}
//echo $lotnop;
 $stkinhand=0;
 //echo "select distinct subbinid from tbl_lot_ldg_pack where lotno='".$lotnop."'";
$sql_stock=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$lotnop."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_stock=mysqli_num_rows($sql_stock);
if($tot_stock>0)
{
while($row_stock=mysqli_fetch_array($sql_stock))
{
//echo "select MAX(lotdgp_id) from tbl_lot_ldg_pack where lotno='".$lotnop."' and subbinid='".$row_stock['subbinid']."'";
	$sql_stock1=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where lotno='".$lotnop."' and subbinid='".$row_stock['subbinid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stock1=mysqli_fetch_array($sql_stock1);
	//echo "select * from tbl_lot_ldg_pack where lotno='".$lotnop."' and lotdgp_id='".$row_stock1[0]."'";
	$sql_stock12=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotno='".$lotnop."' and lotdgp_id='".$row_stock1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stock12=mysqli_fetch_array($sql_stock12);
	
	$stkinhand=$stkinhand+$row_stock12['balqty'];

}
}
else
{
	$sql_stock=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
	while($row_stock=mysqli_fetch_array($sql_stock))
	{
	$sql_stock1=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where orlot='".$lotno."' and lotldg_subbinid='".$row_stock['lotldg_subbinid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stock1=mysqli_fetch_array($sql_stock1);
	
	$sql_stock12=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' and lotldg_id='".$row_stock1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stock12=mysqli_fetch_array($sql_stock12);
	
	$stkinhand=$stkinhand+$row_stock12['lotldg_balqty'];
	}
}
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Lot Details</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="105" align="center" valign="middle" class="tblheading">Arrival Stock</td>
	<td width="104" align="center" valign="middle" class="tblheading">DPPR Loss</td>
	<td width="110" align="center" valign="middle" class="tblheading">Qty Discard</td>
	<td width="109" align="center" valign="middle" class="tblheading">Qty Batches</td>
	<td width="112" align="center" valign="middle" class="tblheading">Qty Dispatched</td>
	<td width="115" align="center" valign="middle" class="tblheading">Qty Allocated</td> 
	<td width="129" align="center" valign="middle" class="tblheading">Stock In Hand</td>
</tr>
<?php

?>	
<tr class="Light" height="20">
	<td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $opstk;?></td>
	<td width="104" align="center" valign="middle" class="smalltbltext"><?php echo $totloss;?></td>
	<td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $discardqty;?></td>
	<td width="109" align="center" valign="middle" class="smalltbltext"><?php echo $totbatch;?></td>
	<td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $totdispqty;?></td>
	<td width="115" align="center" valign="middle" class="smalltbltext"><?php echo $allocqty;?></td> 
	<td width="129" align="center" valign="middle" class="smalltbltext"><?php echo $stkinhand;?></td>
</tr>
<!--<?php

?>
<tr class="Dark" height="20">
	<td width="130" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $trdate11;?></td>
	<td width="150" align="center" valign="middle" class="smalltbltext"><?php echo $cc;?></td>
	<td width="130" align="center" valign="middle" class="smalltbltext"><?php echo $ac;?></td>
	<td width="130" align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td> 
	<td width="134" align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
</tr>-->
<?php

?>
</table>

<?php	
// }
//echo $lotno;
$lotno1="$lotno";
$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_tb1=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_whouse['arrival_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
$sql_tb2=mysqli_fetch_array($sql_tb1);

		 $arr_type=$sql_tb2['arrival_type'];

		$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot=""; $spcm=""; $spcf=""; $plotno=""; $pdnno="";$plotsize="";$vendor="";$vendorvariety="";$dcno=""; $prodgrade='';
		
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
					$prodgrade=$row_whouse['prodgrade'];
				}
				else if($arr_type=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tb2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tb2['lotvariety']."' and actstatus='Active'") or die(mysqli_error($link));
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
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tbl2['lotvariety']."' and actstatus='Active'") or die(mysqli_error($link));
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
				$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot=""; $spcm=""; $spcf=""; $plotno=""; $pdnno="";$plotsize="";$vendor="";$vendorvariety="";$dcno=""; $prodgrade='';
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
	<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<?php echo $tp;?></td>
</tr>
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">SP code Female&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $spcf;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">SP code Male&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $spcm;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Production Location&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $ploc;?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Production Personnel&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pper;?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Organiser&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $org;?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Farmer&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $far;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Plot No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $plotno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Stage&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $stage;?></td>
	<!--<td align="right" valign="middle" class="tblheading">Plot Size&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $plotsize;?></td>-->
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GI&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $gi;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Harvest Date&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate1;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PDN No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pdnno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PDN Date&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate2;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate3;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Arrival Date&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GOT on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PP&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $moist;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Production Grade&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $prodgrade;?></td>
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
	<td width="255" align="left" valign="middle" class="smalltbltext" >&nbsp;<?php echo $tp;?></td>
	<td width="132" align="right" valign="middle" bgcolor="#92cef9" class="tblheading">Arrival Date&nbsp;</td>
	<td width="268" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor Variety Name&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $vendorvariety;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor Lot No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $oldlot;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Stage&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dcno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate4;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC Status&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GOT Status&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PP&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $moist;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $germ;?></td>
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
	<td width="255" align="left" valign="middle" class="smalltbltext" >&nbsp;<?php echo $tp;?></td>
	<td width="132" align="right" valign="middle" bgcolor="#92cef9" class="tblheading">Arrival Date&nbsp;</td>
	<td width="268" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Unidentified Arrived In&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Location&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $ploc;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Vendor Lot No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $oldlot;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Stage&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dcno;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php if($trdate3!="" && $trdate3!="00-00-0000")echo $trdate3;?></td>
</tr>-->
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC Status&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GOT Status&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">PP&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $moist;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $germ;?></td>
</tr>-->
</table>
<?php } ?>

<?php
//$lotno1." - ";
$plotno=str_split($lotno1);
if($plotno[15]!=0)
{
$plotno1=$plotno[0].$plotno[1].$plotno[2].$plotno[3].$plotno[4].$plotno[5].$plotno[6].$plotno[7].$plotno[8].$plotno[9].$plotno[10].$plotno[11].$plotno[12].$plotno[13];
$plotno1=$plotno1."0"."0";
$plot=$plotno1;
	$pp=str_split($plot);
	$pcode=$pp[0];
	$ycode=$pp[1];
	$txtlot2=$pp[2].$pp[3].$pp[4].$pp[5].$pp[6];
	$stcode=$pp[8].$pp[9].$pp[10].$pp[11].$pp[12];
	$stcode2=$pp[14].$pp[15];
//$arrdate="";
//echo "select * from tblarrival_sub where orlot='".$plotno1."'";
$sql_whouse1=mysqli_query($link,"select * from tblarrival_sub where orlot='".$plotno1."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_whouse1=mysqli_fetch_array($sql_whouse1))
{
$sql_tb2=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_whouse1['arrival_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
$row_tb2=mysqli_fetch_array($sql_tb2);
	$arrdate=$row_tb2['arrival_date'];
	$tryear=substr($arrdate,0,4);
	$trmonth=substr($arrdate,5,2);
	$trday=substr($arrdate,8,2);
	$arrdate=$trday."-".$trmonth."-".$tryear;
	
	$sql_tb3=mysqli_query($link,"select * from tblarr_sloc where arr_id='".$row_whouse1['arrsub_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_tb3=mysqli_fetch_array($sql_tb3);
	
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Arrival - Parent Lot Details</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Arrival Date&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $arrdate;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">Parent Lot No.&nbsp;</td>
	<!--<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $plotno1;?></td>-->
	<td width="268" align="left" valign="middle" class="smalltbltext">&nbsp;<a href="utility_1.php?txtlot=<?php echo $txtlot;?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtstage=<?php echo $txtstage?>&txtlot1=<?php echo $txtlot1?>&pcode=<?php echo $pcode?>&txt=<?php echo $txt?>&txtlot2=<?php echo $txtlot2?>&txtlot=<?php echo $txtlot?>&txtlot3=<?php echo $txtlot3?>&reptyp=<?php echo $reptyp?>&txtlot4=<?php echo $txtlot4?>&ycodee=<?php echo $ycode?>&txtlo=<?php echo $txtlo?>&stcode=<?php echo $stcode?>&stcode2=<?php echo $stcode2?>"><?php echo $plotno1;?></a></td>
</tr>
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Parent NoB&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tb3['balbags'];?></td>
	<td width="132" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">Parent Qty&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tb3['balqty'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Prod. Location&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_whouse1['ploc'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Prod. Pers&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_whouse1['pper'];?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Org. Name&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_whouse1['organiser'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">GoT Status on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_whouse1['got1'];?></td>
</tr>
</table><br /><?php }}?>

<?php 
	//echo $lotno;
	//echo $lotno1;
	//echo "select * from tbl_salesrv_sub where salesrs_orlot='".$lotno1."'";
	//echo "select * from tbl_salesr_sub where salesrs_orlot='".$lotno1."'";
	$srdate=""; $srn=""; $pnm=""; $ups=""; $srqtydc=""; $srqtyver="";
	$sql_ssrv=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_orlot='".$lotno1."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_ssrv=mysqli_num_rows($sql_ssrv);
	$row_ssrv=mysqli_fetch_array($sql_ssrv);
	$sql_ssr=mysqli_query($link,"select * from tbl_salesr_sub where salesrs_orlot='".$lotno1."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_ssr=mysqli_num_rows($sql_ssr);
	$row_ssr=mysqli_fetch_array($sql_ssr);
	
	if($tot_ssrv>0)
	{
		$sql_ssrv_main=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$row_ssrv['salesr_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
		$row_ssrv_main=mysqli_fetch_array($sql_ssrv_main);
		$sql_party=mysqli_query($link,"SELECT * FROM tbl_partymaser WHERE p_id='".$row_ssrv_main['salesr_party']."'")or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);
		
		$srdate=$row_ssrv_main['salesr_date'];
		$srn=$row_ssrv_main['salesr_slrno'];
		$pnm=$row_party['business_name'];
		$ups=$row_ssrv['salesrs_ups'];
		$srqtydc=$row_ssrv['salesrs_qtydc'];
		$srqtyver=$row_ssrv['salesrs_qty'];
	}
	else if($tot_ssr>0)
	{
		//echo "select * from tbl_salesr where salesr_id='".$row_ssr['salesr_id']."'";
		$sql_ssr_main=mysqli_query($link,"select * from tbl_salesr where salesr_id='".$row_ssr['salesr_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
		$row_ssr_main=mysqli_fetch_array($sql_ssr_main);
		$sql_partysr=mysqli_query($link,"SELECT * FROM tbl_partymaser WHERE p_id='".$row_ssr_main['salesr_party']."'")or die(mysqli_error($link));
		$row_partysr=mysqli_fetch_array($sql_partysr);
		
		//$srdate=$row_ssr_main['salesr_date'];
		$srn=$row_ssr_main['salesr_dcno'];
		$pnm=$row_partysr['business_name'];
		$ups=$row_ssr['salesrs_ups'];
		$srqtydc=$row_ssr['salesrs_qtydc'];
		$srqtyver=$row_ssr['salesrs_qty'];
		
		$srdate=$row_ssr_main['salesr_date'];
		$tryear=substr($srdate,0,4);
		$trmonth=substr($srdate,5,2);
		$trday=substr($srdate,8,2);
		$srdate=$trday."-".$trmonth."-".$tryear;
	}
		$dq=explode(" ",$ups);
		$dqs=explode(".",$dq[0]);
		if($dqs[1]>0)
		$aqs=$dqs[0].".".$dqs[1];
		else
		$aqs=$dqs[0];
		$ups=$aqs." ".$dq[1];
		
	if($tot_ssrv>0 || $tot_ssr>0)
	{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Sales Return Arrival</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Sales Return Date&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $srdate;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">SRN No.&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $srn;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Party Name&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pnm;?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">UPS&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $ups;?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Qty As Per DC&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $srqtyver;?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Qty as Verified&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $srqtydc;?></td>
</tr>
</table><br /><?php }?>

<?php 
	$lotnoc=$lotno1."C";
	$lotnor=$lotno."R";
	//echo "select * from tbl_blends where blends_lotno='".$lotnoc."' and blends_sstatus=1 and blends_delflg=0";
	$sta="NO"; $newblendedlot="";
	$sql_blend=mysqli_query($link,"select * from tbl_blends where blends_lotno='".$lotnoc."' and blends_sstatus=1 and blends_delflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_blend=mysqli_num_rows($sql_blend);
	$row_blend=mysqli_fetch_array($sql_blend);
	if($tot_blend>0)
	{
		$sta="YES";
		$newblendedlot=$row_blend['blends_newlot'];
	}
	else
	{ 
		$sqlblend1=mysqli_query($link,"select * from tbl_blends where blends_lotno='".$lotno."' and blends_sstatus=1 and blends_delflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
		$totblend1=mysqli_num_rows($sqlblend1);
		$rowblend1=mysqli_fetch_array($sqlblend1);
		if($totblend1>0)
		{
			$sta="YES";
			$newblendedlot=$rowblend1['blends_newlot'];
		}
		else
		{
			//echo "select * from tbl_mergersub where mergers_lotno='".$lotno1."'";
			$sql_merg=mysqli_query($link,"select * from tbl_mergersub where mergers_lotno='".$lotno1."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_merg=mysqli_num_rows($sql_merg);
			$row_merg=mysqli_fetch_array($sql_merg);
			
			$sql_mergr=mysqli_query($link,"select * from tbl_mergersub where mergers_lotno='".$lotnor."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_mergr=mysqli_num_rows($sql_mergr);
			$row_mergr=mysqli_fetch_array($sql_mergr);
			
			$sql_mergc=mysqli_query($link,"select * from tbl_mergersub where mergers_lotno='".$lotnoc."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_mergc=mysqli_num_rows($sql_mergc);
			$row_mergc=mysqli_fetch_array($sql_mergc);
			
			$sqlblend1=mysqli_query($link,"select * from tbl_blends where blends_lotno='".$lotnor."' and blends_sstatus=1 and blends_delflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
			$totblend1=mysqli_num_rows($sqlblend1);
			$rowblend1=mysqli_fetch_array($sqlblend1);
			if($totblend1>0)
			{
				$sta="YES";
				$newblendedlot=$row_blend['blends_newlot'];
			}
			if($tot_merg>0)
			{
				$sql_mergm=mysqli_query($link,"select * from tbl_mergermain where mergerm_id='".$row_merg['mergerm_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_mergm=mysqli_fetch_array($sql_mergm);
				$sta="YES";
				$newblendedlot=$row_mergm['mergerm_newlot'];
			}
			else if($tot_mergr>0)
			{
				$sql_mergm=mysqli_query($link,"select * from tbl_mergermain where mergerm_id='".$row_mergr['mergerm_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_mergm=mysqli_fetch_array($sql_mergm);
				$sta="YES";
				$newblendedlot=$row_mergm['mergerm_newlot'];
			}
			else if($tot_mergc>0)
			{
				//echo "select * from tbl_mergermain where mergerm_id='".$row_mergc['mergerm_id']."'";
				$sql_mergm=mysqli_query($link,"select * from tbl_mergermain where mergerm_id='".$row_mergc['mergerm_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_mergm=mysqli_fetch_array($sql_mergm);
				$sta="YES";
				$newblendedlot=$row_mergm['mergerm_newlot'];
			}
		}
	}
		
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="subheading" style="color:#303918; " colspan="3">Blending Status</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Blending Status&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $sta;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">New Blended Lot No.&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $newblendedlot;?></td>
</tr>
<?php 
	//echo $lotnoc;
	$orlot=str_split($newblendedlot);
	$orlot1=$orlot[0].$orlot[1].$orlot[2].$orlot[3].$orlot[4].$orlot[5].$orlot[6].$orlot[7].$orlot[8].$orlot[9].$orlot[10].$orlot[11].$orlot[12].$orlot[13].$orlot[14].$orlot[15];
	//echo "select * from tbl_blends where blends_newlot='".$orlot1."'";
	$sql_blend1=mysqli_query($link,"select * from tbl_blends where blends_orlot='".$orlot1."' and blends_sstatus=1 and blends_delflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_blend1=mysqli_num_rows($sql_blend1);
	$sql_mergm2=mysqli_query($link,"select * from tbl_mergermain where mergerm_orlot='".$orlot1."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_mergm2=mysqli_num_rows($sql_mergm2);
	$row_mergm2=mysqli_fetch_array($sql_mergm2);
	if($tot_blend1>0)
	{
?>
<tr class="Light" height="20">
	<td align="center" class="tblheading" bgcolor="#92cef9" colspan="4">Constituent Lots In Blended Lot&nbsp;<?php echo "(".$tot_blend1.")"?></td>
</tr>
	<?php 
		$srno=1;
		while($row_blend1=mysqli_fetch_array($sql_blend1))
		{
		  
		if($srno%2==1)
		{
	?><tr class="Light" height="20">
			<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
			<?php if($lotnoc==$row_blend1['blends_lotno'] || $lotnor==$row_blend1['blends_lotno'])
			{?>
			<td width="255" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_blend1['blends_lotno'];?></td>
	<?php }
		else
		{?>
		<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_blend1['blends_lotno'];?></td>
		<?php 
		}
		}
	
		else
		{?>
		
			<td width="132" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
			<?php if($lotnoc==$row_blend1['blends_lotno'] || $lotnor==$row_blend1['blends_lotno'])
			{?>
			<td width="268" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_blend1['blends_lotno'];?></td>
	<?php }
		else
		{?>
		<td width="268" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_blend1['blends_lotno'];?></td>
		<?php 
		}
		?>
</tr>
<?php   }
$srno++;
}}

else if($tot_mergm2>0)
{
	$sql_mergs2=mysqli_query($link,"select distinct mergers_lotno from tbl_mergersub where mergerm_id='".$row_mergm2['mergerm_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_mergs2=mysqli_num_rows($sql_mergs2);
?>
<tr class="Light" height="20">
	<td align="center" class="tblheading" bgcolor="#92cef9" colspan="4">Constituent Lots In Blended Lot&nbsp;<?php echo "(".$tot_mergs2.")"?></td>
</tr>
	<?php 
		$srno=1;
		while($row_mergs2=mysqli_fetch_array($sql_mergs2))
		{
		  
		if($srno%2==1)
		{
	?><tr class="Light" height="20">
			<td width="85" height="30" align="right" valign="middle" bgcolor="#92cef9" class="tblheading">Lot No.<?php echo $srno;?>&nbsp;</td>
			<?php if($lotnoc==$row_mergs2['mergers_lotno'] || $lotnor==$row_mergs2['mergers_lotno'])
			{?>
			<td width="154" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_mergs2['mergers_lotno'];?></td>
	<?php }
		else
		{?>
		<td width="119" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_mergs2['mergers_lotno'];?></td>
		<?php 
		}
		}
	
		else
		{?>
		
			<td width="92" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
			<?php if($lotnoc==$row_mergs2['mergers_lotno'] || $lotnor==$row_mergs2['mergers_lotno'])
			{?>
			<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_mergs2['mergers_lotno'];?></td>
	<?php }
		else
		{?>
		<td width="188" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_mergs2['mergers_lotno'];?></td>
		<?php 
		}?>
</tr>
<?php   }
$srno++;
}}?>

</table><br />

<?php 
	//echo "select * from tbl_blends where blends_newlot='".$orlot1."'";
	$sql_blend1=mysqli_query($link,"select * from tbl_blends where blends_orlot='".$lotno1."' and blends_sstatus=1 and blends_delflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_blend1=mysqli_num_rows($sql_blend1);
	$sql_mergm2=mysqli_query($link,"select * from tbl_mergermain where mergerm_orlot='".$lotno1."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_mergm2=mysqli_num_rows($sql_mergm2);
	$row_mergm2=mysqli_fetch_array($sql_mergm2);
	if($tot_blend1>0)
	{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="subheading" style="color:#303918; " colspan="3">Blended Constituents</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="Light" height="20">
	<td align="center" class="tblheading" bgcolor="#92cef9" colspan="4">Constituent Lots In&nbsp;<?php echo $lotno1?>&nbsp;<?php echo "(".$tot_blend1.")"?></td>
</tr>
	<?php 
		$srno=1;
		while($row_blend1=mysqli_fetch_array($sql_blend1))
		{
		  
		if($srno%2==1)
		{
	?><tr class="Light" height="20">
			<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
			<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_blend1['blends_lotno'];?></td>
		<?php 
		
		}
	
		else
		{?>
		
			<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
			<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_blend1['blends_lotno'];?></td>
		
</tr>
<?php   }
$srno++;
}?></table>
<?php 
}


else if($tot_mergm2>0)
{
	$sql_mergs2=mysqli_query($link,"select distinct mergers_lotno from tbl_mergersub where mergerm_id='".$row_mergm2['mergerm_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_mergs2=mysqli_num_rows($sql_mergs2);
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="subheading" style="color:#303918; " colspan="3">Blended Constituents</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="Light" height="20">
	<td align="center" class="tblheading" bgcolor="#92cef9" colspan="4">Constituent Lots In&nbsp;<?php echo $lotno1?>&nbsp;<?php echo "(".$tot_mergs2.")"?></td>
</tr>
	<?php 
		$srno=1;
		while($row_mergs2=mysqli_fetch_array($sql_mergs2))
		{
		  
		if($srno%2==1)
		{
	?><tr class="Light" height="20">
			<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
		<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_mergs2['mergers_lotno'];?></td>
		<?php 
		}
	
		else
		{?>
		
			<td width="132" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Lot No.<?php echo $srno;?>&nbsp;</td>
			<td width="268" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_mergs2['mergers_lotno'];?></td>
</tr>
<?php   }
$srno++;
}?></table><br />
<?php }?>


<?php 
	//echo $lotno1;
	//echo "SELECT distinct lotldg_lotno FROM `tbl_lot_ldg` WHERE `lotldg_lotno`='".$lotno1."' and `lotldg_trtype`='DRYSUC'";
	$sql_dry=mysqli_query($link,"SELECT distinct lotldg_lotno FROM `tbl_lot_ldg` WHERE `orlot`='".$lotno1."' and `lotldg_trtype`='DRYSUC' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_dry=mysqli_num_rows($sql_dry);
	$row_dry=mysqli_fetch_array($sql_dry);
	if($tot_dry>0)
	{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="subheading" style="color:#303918; " colspan="3">Drying</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Drying Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Drying Slip No.</td>
	<td width="97" align="center" valign="middle" class="tblheading">Drying Machine Code</td>
	<td width="97" align="center" valign="middle" class="tblheading">Drying Operator</td>
	<td width="97" align="center" valign="middle" class="tblheading">Input For Drying</td> 
	<td width="99" align="center" valign="middle" class="tblheading">Output For Drying</td>
	<td width="99" align="center" valign="middle" class="tblheading">Drying Loss</td>
    <td width="99" align="center" valign="middle" class="tblheading">Drying Loss %</td>
</tr>
<?php
	//echo $row_dry['lotldg_lotno'];
	//echo "select * from tbl_dryingsub where lotno='".$row_dry['lotldg_lotno']."'";
	$sql_drys=mysqli_query($link,"select * from tbl_dryingsub where lotno='".$row_dry['lotldg_lotno']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$tot_drys=mysqli_num_rows($sql_drys);
	while($row_drys=mysqli_fetch_array($sql_drys))
	{
		$sql_drym=mysqli_query($link,"SELECT * FROM tbl_drying WHERE trid='".$row_drys['trid']."' and plantcode='$plantcode'")or die(mysqli_error($link));
		$row_drym=mysqli_fetch_array($sql_drym);
		
		$sql_dryss=mysqli_query($link,"SELECT * FROM tbl_dryingsubsub WHERE subtrid='".$row_drys['subtrid']."' and plantcode='$plantcode'")or die(mysqli_error($link));
		$row_dryss=mysqli_fetch_array($sql_dryss);
		
		$drydate=$row_drym['dryingdate'];
		$tryear=substr($drydate,0,4);
		$trmonth=substr($drydate,5,2);
		$trday=substr($drydate,8,2);
		$drydate=$trday."-".$trmonth."-".$tryear;
?>

<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $drydate;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_drym['drefno'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_drys['ddtype']." - ".$row_drys['ddid'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_drym['logid'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_dryss['oqty'];?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_dryss['nqty'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_dryss['dryingloss'];?></td>
    <td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_dryss['dlossper'];?></td>
</tr>
<?php }?>
</table><br /><?php }?>

<?php 
	//echo "select * from tbl_proslipsub where proslipsub_orlot='".$lotno1."'";
	$sql_pro=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_orlot='".$lotno1."' and plantcode='$plantcode' order by proslipsub_id asc") or die(mysqli_error($link));
	$tot_pro=mysqli_num_rows($sql_pro);
	$row_pro=mysqli_fetch_array($sql_pro);
	
	$sql_pro_main=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$row_pro['proslipmain_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_pro_main=mysqli_fetch_array($sql_pro_main);
	
	$sql_promac=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$row_pro_main['proslipmain_promachcode']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_promac=mysqli_fetch_array($sql_promac);
	
	$sql_proopr=mysqli_query($link,"select * from tbl_rm_proopr where proopr_id='".$row_pro_main['proslipmain_proopr']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_proopr=mysqli_fetch_array($sql_proopr);
	
	$sql_treat=mysqli_query($link,"select * from tbl_rm_treattype where treatt_type='".$row_pro_main['proslipmain_treattype']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_treat=mysqli_fetch_array($sql_treat);
	
	$prodate=$row_pro_main['proslipmain_date'];
	$tryear=substr($prodate,0,4);
	$trmonth=substr($prodate,5,2);
	$trday=substr($prodate,8,2);
	$prodate=$trday."-".$trmonth."-".$tryear;
	
	if($tot_pro>0)
	{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Processing</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Processing Date&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $prodate;?></td>
	<td width="135" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">Processing Slip No.&nbsp;</td>
	<td width="255" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pro_main['proslipmain_proslipno'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Processing Machine Code&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_promac['promac_type']." - ".$row_promac['promac_macid'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Processing Operator&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_proopr['proopr_code'];?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Input for Processing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pro['proslipsub_pqty'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Processed Output&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pro['proslipsub_conqty'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Processing Loss&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pro['proslipsub_tlqty'];?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Treatment Schema&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_treat['treatt_details'];?></td>
</tr>
</table><br /><?php }?>
<?php 
	$sql_repro=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_orlot='".$lotno1."' and proslipsub_id!='".$row_pro['proslipsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_repro=mysqli_num_rows($sql_repro);
	//$row_repro=mysqli_fetch_array($sql_repro);
	
	
	if($tot_repro>0)
	{
?>


<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="subheading" style="color:#303918; " colspan="3">Re-Proceessing</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Processing Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Processing Slip No.</td>
	<td width="97" align="center" valign="middle" class="tblheading">Processing Machine Code</td>
	<td width="97" align="center" valign="middle" class="tblheading">Processing Operator</td>
	<td width="97" align="center" valign="middle" class="tblheading">Input for Processing</td> 
	<td width="99" align="center" valign="middle" class="tblheading">Processed Output</td>
	<td width="99" align="center" valign="middle" class="tblheading">Processing Loss</td>
    <td width="99" align="center" valign="middle" class="tblheading">Treatment Schema</td>
</tr>
<?php
while($row_repro=mysqli_fetch_array($sql_repro))
{	$prosn=""; $prodate=""; $promac=""; $proopr=""; $proin=""; $proout=""; $proloss=""; $ts="";
	$sql_pro_main=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$row_pro['proslipmain_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_pro_main=mysqli_fetch_array($sql_pro_main);
	
	$sql_promac=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$row_pro_main['proslipmain_promachcode']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_promac=mysqli_fetch_array($sql_promac);
	
	$sql_proopr=mysqli_query($link,"select * from tbl_rm_proopr where proopr_id='".$row_pro_main['proslipmain_proopr']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_proopr=mysqli_fetch_array($sql_proopr);
	
	$sql_treat=mysqli_query($link,"select * from tbl_rm_treattype where treatt_type='".$row_pro_main['proslipmain_treattype']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_treat=mysqli_fetch_array($sql_treat);
	$prosn=$row_pro_main['proslipmain_proslipno'];
	//$prodate=$row_pro_main['proslipmain_date'];
	$promac=$row_promac['promac_type']." - ".$row_promac['promac_macid'];
	$proopr=$row_proopr['proopr_code'];
	$proin=$row_pro['proslipsub_pqty'];
	$proout=$row_pro['proslipsub_conqty'];
	$proloss=$row_pro['proslipsub_tlqty'];
	$ts=$row_treat['treatt_details'];
	
	$prodate=$row_pro_main['proslipmain_date'];
	$tryear=substr($prodate,0,4);
	$trmonth=substr($prodate,5,2);
	$trday=substr($prodate,8,2);
	$prodate=$trday."-".$trmonth."-".$tryear;
	
?>

<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $prodate;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $prosn;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $promac;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $proopr;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $proin;?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $proout;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $proloss;?></td>
    <td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $ts;?></td>
</tr>
<?php }?>
</table><br /><?php }?>

<?php 
	$lotp=$lotno1."P";
	//echo "select * from tbl_pnpslipsub where pnpslipsub_plotno='".$lotp."' ORDER BY pnpslipsub_id ASC";
	$sql_pnp=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipsub_plotno='".$lotp."' and plantcode='$plantcode' ORDER BY pnpslipsub_id ASC") or die(mysqli_error($link));
	$tot_pnp=mysqli_num_rows($sql_pnp);
	$row_pnp=mysqli_fetch_array($sql_pnp);
	$sql_pnpm=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_id='".$row_pnp['pnpslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_pnpm=mysqli_fetch_array($sql_pnpm);
	
	$sql_promac1=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$row_pnpm['pnpslipmain_promachcode']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_promac1=mysqli_fetch_array($sql_promac1);
	
	$sql_proopr1=mysqli_query($link,"select * from tbl_rm_proopr where proopr_id='".$row_pnpm['pnpslipmain_proopr']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_proopr1=mysqli_fetch_array($sql_proopr1);
	
	$packdate=$row_pnpm['pnpslipmain_dop'];
	$tryear=substr($packdate,0,4);
	$trmonth=substr($packdate,5,2);
	$trday=substr($packdate,8,2);
	$packdate=$trday."-".$trmonth."-".$tryear;
	
	$dot=$row_pnp['pnpslipsub_qcdot'];
	$tryear=substr($dot,0,4);
	$trmonth=substr($dot,5,2);
	$trday=substr($dot,8,2);
	$dot=$trday."-".$trmonth."-".$tryear;
	
	$dov=$row_pnp['pnpslipsub_valupto'];
	$tryear=substr($dov,0,4);
	$trmonth=substr($dov,5,2);
	$trday=substr($dov,8,2);
	$dov=$trday."-".$trmonth."-".$tryear;
	$pakups=$row_pnp['pnpslipsub_ups'];
	$dq=explode(" ",$pakups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$pakups=$aqs." ".$dq[1];
	
	if($tot_pnp>0)
	{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Packing</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Date&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packdate;?></td>
	<td width="135" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">Packing Slip No.&nbsp;</td>
	<td width="255" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnpm['pnpslipmain_proslipno'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Machine Code&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_promac1['promac_type']." - ".$row_promac1['promac_macid'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Operator&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_proopr1['proopr_code'];?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Input Qty Packing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_pickpqty'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Output Qty Packing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_packqty'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">UPS&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pakups;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">NoP&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_nop'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Loss&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_packloss'];?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Captive Consumtion&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_packcc'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Label No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_lblschar']."".$row_pnp['pnpslipsub_lblsno']." - ".$row_pnp['pnpslipsub_lbechar']."".$row_pnp['pnpslipsub_lbeno'];?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC Status On Packing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp['pnpslipsub_qc'];?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DoT&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dot;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DoV&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dov;?></td>
</tr>
</table><br /><?php }?>

<?php 
	//$lotp=$lotno1."P";
	//echo "select * from tbl_pnpslipsub where pnpslipsub_plotno='".$lotp."' ORDER BY pnpslipsub_id ASC";
	$sql_pnp1=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipsub_plotno='".$lotp."' and  pnpslipsub_id!='".$row_pnp['pnpslipsub_id']."' and plantcode='$plantcode' ORDER BY pnpslipsub_id ASC") or die(mysqli_error($link));
	$tot_pnp1=mysqli_num_rows($sql_pnp1);
	$row_pnp1=mysqli_fetch_array($sql_pnp1);
	$sql_pnpm1=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_id='".$row_pnp1['pnpslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_pnpm1=mysqli_fetch_array($sql_pnpm1);
	
	$sql_promac11=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$row_pnpm1['pnpslipmain_promachcode']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_promac11=mysqli_fetch_array($sql_promac11);
	
	$sql_proopr11=mysqli_query($link,"select * from tbl_rm_proopr where proopr_id='".$row_pnpm1['pnpslipmain_proopr']."' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row_proopr11=mysqli_fetch_array($sql_proopr11);
	
	$packdate=$row_pnpm1['pnpslipmain_dop'];
	$tryear=substr($packdate,0,4);
	$trmonth=substr($packdate,5,2);
	$trday=substr($packdate,8,2);
	$packdate=$trday."-".$trmonth."-".$tryear;
	
	$dot=$row_pnp1['pnpslipsub_qcdot'];
	$tryear=substr($dot,0,4);
	$trmonth=substr($dot,5,2);
	$trday=substr($dot,8,2);
	$dot=$trday."-".$trmonth."-".$tryear;
	
	$dov=$row_pnp1['pnpslipsub_valupto'];
	$tryear=substr($dov,0,4);
	$trmonth=substr($dov,5,2);
	$trday=substr($dov,8,2);
	$dov=$trday."-".$trmonth."-".$tryear;
	
	$pakups1=$row_pnp1['pnpslipsub_ups'];
	$dq=explode(" ",$pakups1);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$pakups1=$aqs." ".$dq[1];

	if($tot_pnp1>0)
	{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Re-Packing</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Date&nbsp;</td>
	<td width="255" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packdate;?></td>
	<td width="135" align="right"  valign="middle" class="tblheading" bgcolor="#92cef9">Packing Slip No.&nbsp;</td>
	<td width="255" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnpm1['pnpslipmain_proslipno'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Machine Code&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_promac11['promac_type']." - ".$row_promac11['promac_macid'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Operator&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_proopr11['proopr_code'];?></td>
</tr>
<tr class="Light" height="20">	
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Input Qty Packing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_pickpqty'];?></td>
    <td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Output Qty Packing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_packqty'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">UPS&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $pakups1;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">NoP&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_nop'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Packing Loss&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_packloss'];?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Captive Consumtion&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_packcc'];?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">Label No.&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_lblschar']."".$row_pnp1['pnpslipsub_lblsno']." - ".$row_pnp1['pnpslipsub_lbechar']."".$row_pnp1['pnpslipsub_lbeno'];?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">QC Status On Packing&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_pnp1['pnpslipsub_qc'];?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DoT&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dot;?></td>
	<td align="right" valign="middle" class="tblheading" bgcolor="#92cef9">DoV&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dov;?></td>
</tr>
</table><br /><?php }?>

<?php 
$lotnop=$lotno1."P";
//echo "select * from tbl_lot_ldg_pack where lotno='".$lotno12."' and trtype='PACKRV' and lotldg_rvflg=0 order by lotdgp_id asc";
$sql_packrv=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotno='".$lotnop."' and trtype='PACKRV' and lotldg_rvflg=0 and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
$tot_packrv=mysqli_num_rows($sql_packrv);
if($tot_packrv>0)
{

?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Re-Printing</td>
</tr>
</table>
  <!--<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">-->
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">S.No.</td>
	<td width="97" align="center" valign="middle" class="tblheading">Machine Code</td>
	<td width="97" align="center" valign="middle" class="tblheading">Operator</td>
	<td width="97" align="center" valign="middle" class="tblheading">Input Qty</td> 
	<td width="99" align="center" valign="middle" class="tblheading">Output Qty</td>
	<td width="99" align="center" valign="middle" class="tblheading">Loss</td>
    <td width="99" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="99" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="99" align="center" valign="middle" class="tblheading">Label No.</td>
	<td width="99" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="99" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="99" align="center" valign="middle" class="tblheading">DoV</td>
</tr>
<?php
while($row_packrv=mysqli_fetch_array($sql_packrv))
{
	$sql_rv=mysqli_query($link,"select * from tbl_revalidate where rv_id='".$row_packrv['lotldg_id']."' and rv_dorvp='".$row_packrv['lotldg_trdate']."' and rv_lotno='".$lotnop."' and plantcode='$plantcode' order by rv_id asc") or die(mysqli_error($link));
	$tot_rv=mysqli_num_rows($sql_rv);
	$row_rv=mysqli_fetch_array($sql_rv);
	
	$prups=$row_rv['rv_ups'];
	
	$dq=explode(" ",$prups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$prups=$aqs." ".$dq[1];
	
?>

<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_dorvp'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_rvpsrn'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php //echo $row_rv['rv_dorvp'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_logid'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_eqty'];?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_bqty'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_qcnop'];?></td>
    <td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $prups;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_bnop'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_slable']." TO ".$row_rv['rv_elable'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_qc'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_dot'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $row_rv['rv_valupto'];?></td>
</tr>
<?php }?>
</table><br /><?php }?>


<?php
//echo $lotno1;
$lotnop1=$lotno1."P";
$lotnop24=$lotno1."C";
$sql_packing=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipsub_orlot='".$lotno1."' and pnpslipsub_packtype='P' and plantcode='$plantcode' order by pnpslipsub_id asc") or die(mysqli_error($link));
$tot_packing=mysqli_num_rows($sql_packing);
//($row_packing=mysqli_fetch_array($sql_packing)

$sql_process=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_orlot='".$lotno1."' and proslipsub_processtype='P' and plantcode='$plantcode' order by proslipsub_id asc") or die(mysqli_error($link));
$tot_process=mysqli_num_rows($sql_process);
//$row_processing=mysqli_fetch_array($sql_processing)

$sql_reprint=mysqli_query($link,"select * from tbl_revalidate where rv_lotno='".$lotnop1."' and rv_rvtyp='partial' and plantcode='$plantcode' order by rv_id asc") or die(mysqli_error($link));
$tot_reprint=mysqli_num_rows($sql_reprint);
//$row_reprint=mysqli_fetch_array($sql_reprint)

$sql_p2c=mysqli_query($link,"select * from tbl_psunpp2c where unp_lotno='".$lotnop1."' and unp_p2ctype='partial' and plantcode='$plantcode' order by unp_id asc") or die(mysqli_error($link));
$tot_p2c=mysqli_num_rows($sql_p2c);
//$row_p2c=mysqli_fetch_array($sql_p2c)

$sql_ivt=mysqli_query($link,"select * from tbl_ivtsub where ivts_olotno='".$lotnop24."' and plantcode='$plantcode' order by ivts_id asc") or die(mysqli_error($link));
$tot_ivt=mysqli_num_rows($sql_ivt);
//$row_ivt=mysqli_fetch_array($sql_ivt)

$blot="";
if($tot_packing>0 || $tot_process>0 || $tot_reprint>0 || $tot_p2c>0 || $tot_ivt>0)
{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Batches</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="70" align="center" valign="middle" class="tblheading">Batch Lot No.</td>
	<td width="99" align="center" valign="middle" class="tblheading">Batch Creation Qty</td>
	<td width="97" align="center" valign="middle" class="tblheading">Batch Creation Date</td>
	<td width="97" align="center" valign="middle" class="tblheading">Batch Creation Reason</td>
</tr>

<?php
while($row_packing=mysqli_fetch_array($sql_packing))
{
	$pakdate="";
	$sql_pkmain=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_id='".$row_packing['pnpslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
//$tot_p2c=mysqli_num_rows($sql_p2c);
$row_pkmain=mysqli_fetch_array($sql_pkmain);
	$pakdate=$row_pkmain['pnpslipmain_dop'];
	$tryear=substr($pakdate,0,4);
	$trmonth=substr($pakdate,5,2);
	$trday=substr($pakdate,8,2);
	$pakdate=$trday."-".$trmonth."-".$tryear;
	$blot=$row_packing['pnpslipsub_plotno'];
	$blot1=$blot;
	$bb=str_split($blot1);
	$pcode=$bb[0];
	$ycode=$bb[1];
	$txtlot2=$bb[2].$bb[3].$bb[4].$bb[5].$bb[6];
	$stcode=$bb[8].$bb[9].$bb[10].$bb[11].$bb[12];
	$stcode2=$bb[14].$bb[15];
?>

<tr class="Light" height="20">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $blot?></td>-->
	<td width="70" align="center" valign="middle" class="smalltbltext"><a href="utility_1.php?txtlot=<?php echo $txtlot;?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtstage=<?php echo $txtstage?>&txtlot1=<?php echo $txtlot1?>&pcode=<?php echo $pcode?>&txt=<?php echo $txt?>&txtlot2=<?php echo $txtlot2?>&txtlot=<?php echo $txtlot?>&txtlot3=<?php echo $txtlot3?>&reptyp=<?php echo $reptyp?>&txtlot4=<?php echo $txtlot4?>&ycodee=<?php echo $ycode?>&txtlo=<?php echo $txtlo?>&stcode=<?php echo $stcode?>&stcode2=<?php echo $stcode2?>"><?php echo $blot;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_packing['pnpslipsub_packqty'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $pakdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "PACKING";?></td> 
<?php }?>

<?php
while($row_process=mysqli_fetch_array($sql_process))
{
	$prokdate="";
	$sql_prsmain=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$row_process['proslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
//$tot_p2c=mysqli_num_rows($sql_p2c);
$row_prsmain=mysqli_fetch_array($sql_prsmain);
	$prokdate=$row_prsmain['proslipmain_date'];
	$tryear=substr($prokdate,0,4);
	$trmonth=substr($prokdate,5,2);
	$trday=substr($prokdate,8,2);
	$prokdate=$trday."-".$trmonth."-".$tryear;
	$blot=$row_process['pnpslipsub_plotno'];
	$blot1=$blot;
	$bb=str_split($blot1);
	$pcode=$bb[0];
	$ycode=$bb[1];
	$txtlot2=$bb[2].$bb[3].$bb[4].$bb[5].$bb[6];
	$stcode=$bb[8].$bb[9].$bb[10].$bb[11].$bb[12];
	$stcode2=$bb[14].$bb[15];
?>

<tr class="Light" height="20">
	<!--<td width="70" height="22" align="center" valign="middle" class="smalltbltext"><?php echo $blot;?></td>-->
	<td width="70" align="center" valign="middle" class="smalltbltext"><a href="utility_1.php?txtlot=<?php echo $txtlot;?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtstage=<?php echo $txtstage?>&txtlot1=<?php echo $txtlot1?>&pcode=<?php echo $pcode?>&txt=<?php echo $txt?>&txtlot2=<?php echo $txtlot2?>&txtlot=<?php echo $txtlot?>&txtlot3=<?php echo $txtlot3?>&reptyp=<?php echo $reptyp?>&txtlot4=<?php echo $txtlot4?>&ycodee=<?php echo $ycode?>&txtlo=<?php echo $txtlo?>&stcode=<?php echo $stcode?>&stcode2=<?php echo $stcode2?>"><?php echo $blot;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_process['proslipsub_conqty'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $prokdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "Processing";?></td> 
</tr>
<?php }?>

<?php
while($row_reprint=mysqli_fetch_array($sql_reprint))
{
	$printdate="";
	$printdate=$row_reprint['rv_dorvp'];
	$tryear=substr($printdate,0,4);
	$trmonth=substr($printdate,5,2);
	$trday=substr($printdate,8,2);
	$printdate=$trday."-".$trmonth."-".$tryear;
	$blot=$row_reprint['rv_newlot'];
	$blot1=$blot;
	$bb=str_split($blot1);
	$pcode=$bb[0];
	$ycode=$bb[1];
	$txtlot2=$bb[2].$bb[3].$bb[4].$bb[5].$bb[6];
	$stcode=$bb[8].$bb[9].$bb[10].$bb[11].$bb[12];
	$stcode2=$bb[14].$bb[15];
?>
<tr class="Light" height="20">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $blot;?></td>-->
	<td width="70" align="center" valign="middle" class="smalltbltext"><a href="utility_1.php?txtlot=<?php echo $txtlot;?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtstage=<?php echo $txtstage?>&txtlot1=<?php echo $txtlot1?>&pcode=<?php echo $pcode?>&txt=<?php echo $txt?>&txtlot2=<?php echo $txtlot2?>&txtlot=<?php echo $txtlot?>&txtlot3=<?php echo $txtlot3?>&reptyp=<?php echo $reptyp?>&txtlot4=<?php echo $txtlot4?>&ycodee=<?php echo $ycode?>&txtlo=<?php echo $txtlo?>&stcode=<?php echo $stcode?>&stcode2=<?php echo $stcode2?>"><?php echo $blot;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_reprint['rv_eqty'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $printdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "Revalidate";?></td> 
</tr>
<?php }?>

<?php
while($row_p2c=mysqli_fetch_array($sql_p2c))
{
	$sql_p2cs=mysqli_query($link,"select * from tbl_psunpp2c_sub where unp_id='".$row_p2c['unp_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
//$tot_p2c=mysqli_num_rows($sql_p2c);
$row_p2cs=mysqli_fetch_array($sql_p2cs);
	$p2cdate="";
	$p2cdate=$row_p2c['unp_date'];
	$tryear=substr($p2cdate,0,4);
	$trmonth=substr($p2cdate,5,2);
	$trday=substr($p2cdate,8,2);
	$p2cdate=$trday."-".$trmonth."-".$tryear;
	$blot=$row_p2c['unp_newlotno'];
	$blot1=$blot;
	$bb=str_split($blot1);
	$pcode=$bb[0];
	$ycode=$bb[1];
	$txtlot2=$bb[2].$bb[3].$bb[4].$bb[5].$bb[6];
	$stcode=$bb[8].$bb[9].$bb[10].$bb[11].$bb[12];
	$stcode2=$bb[14].$bb[15];
?>

<tr class="Light" height="20">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $blot;?></td>-->
	<td width="70" align="center" valign="middle" class="smalltbltext"><a href="utility_1.php?txtlot=<?php echo $txtlot;?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtstage=<?php echo $txtstage?>&txtlot1=<?php echo $txtlot1?>&pcode=<?php echo $pcode?>&txt=<?php echo $txt?>&txtlot2=<?php echo $txtlot2?>&txtlot=<?php echo $txtlot?>&txtlot3=<?php echo $txtlot3?>&reptyp=<?php echo $reptyp?>&txtlot4=<?php echo $txtlot4?>&ycodee=<?php echo $ycode?>&txtlo=<?php echo $txtlo?>&stcode=<?php echo $stcode?>&stcode2=<?php echo $stcode2?>"><?php echo $blot;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $sql_p2cs['unp_qty'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $p2cdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "P2C";?></td> 
</tr>
<?php }?>
<?php
while($row_ivt=mysqli_fetch_array($sql_ivt))
{
	$sql_p2cs=mysqli_query($link,"select * from tbl_ivtmain where ivt_id='".$row_ivt['ivt_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	//$tot_p2c=mysqli_num_rows($sql_p2c);
	$row_p2cs=mysqli_fetch_array($sql_p2cs);
	$p2cdate="";
	$p2cdate=$row_p2cs['ivt_date'];
	$tryear=substr($p2cdate,0,4);
	$trmonth=substr($p2cdate,5,2);
	$trday=substr($p2cdate,8,2);
	$p2cdate=$trday."-".$trmonth."-".$tryear;
	$blot=$row_ivt['ivts_nlotno'];
	$blot1=$blot;
	$bb=str_split($blot1);
	$pcode=$bb[0];
	$ycode=$bb[1];
	$txtlot2=$bb[2].$bb[3].$bb[4].$bb[5].$bb[6];
	$stcode=$bb[8].$bb[9].$bb[10].$bb[11].$bb[12];
	$stcode2=$bb[14].$bb[15];
	
	$itemqry3=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_p2cs['ivt_trtovariety']."' and actstatus='Active'") or die(mysqli_error($link));
	$noticia_ver3 = mysqli_fetch_array($itemqry3);
?>

<tr class="Light" height="20">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $blot;?></td>-->
	<td width="70" align="center" valign="middle" class="smalltbltext"><a href="utility_1.php?txtlot=<?php echo $txtlot;?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtstage=<?php echo $txtstage?>&txtlot1=<?php echo $txtlot1?>&pcode=<?php echo $pcode?>&txt=<?php echo $txt?>&txtlot2=<?php echo $txtlot2?>&txtlot=<?php echo $txtlot?>&txtlot3=<?php echo $txtlot3?>&reptyp=<?php echo $reptyp?>&txtlot4=<?php echo $txtlot4?>&ycodee=<?php echo $ycode?>&txtlo=<?php echo $txtlo?>&stcode=<?php echo $stcode?>&stcode2=<?php echo $stcode2?>"><?php echo $blot;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_ivt['ivts_qty'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $p2cdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "IVT (".$noticia_ver3['popularname'].")";?></td> 
</tr>
<?php }?>
</table><br /><?php }?>


<?php 
$lotno12=$lotno1."P";
$nolp=0; $smc=0; $lmc=0; $mmc=0; $barcode=0; $nolpqty=0; $ups=""; $smcqty=0; $lmcqty=0; $mmcqty=0;
//echo "select * from tbl_lot_ldg_pack where lotno='".$lotno12."' and balnomp>0 order by lotdgp_id asc";
$sql_nolpqty=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotno='".$lotno12."' and balnomp>0 and plantcode='$plantcode' order by lotdgp_id asc LIMIT 0 , 1") or die(mysqli_error($link));
$tot_nolpqty=mysqli_num_rows($sql_nolpqty);
$row_nolpqty=mysqli_fetch_array($sql_nolpqty);
if($tot_nolpqty>0)
{
	$nolpqty=$row_nolpqty['balqty'];
	$ups=$row_nolpqty['packtype'];
}
$sql_pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotno='".$lotno12."' and balnomp>0 and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
while($row_pack=mysqli_fetch_array($sql_pack))
{
	if($row_pack['trtype']=="PACKSMC" || $row_pack['trtype']=="PNPSLIP" || $row_pack['trtype']=="PACKNMC")
	{
		$sql_smc=mysqli_query($link,"select * from tbl_mpmain where mpmain_trid='".$row_pack['lotldg_id']."' and mpmain_lotno='".$lotno12."' and plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_smc=mysqli_fetch_array($sql_smc))
		{
			$smc=$smc+1;
		}
		$nolpqty=$nolpqty-($row_pack['wtinmp']*$row_pack['balnomp']);
		$smcqty=$smcqty + $row_pack['tqty'];
	}
	
	else if($row_pack['trtype']=="PACKMMC")
	{
		//echo "select * from tbl_mpmain where mpmain_altrid='".$row_pack['lotldg_id']."' and mpmain_trtype='PACKMMC'";
		/*$sql_mmc=mysqli_query($link,"select * from tbl_mpmain where mpmain_altrid='".$row_pack['lotldg_id']."' and mpmain_trtype='PACKMMC'") or die(mysqli_error($link));
		$row_mmc=mysqli_fetch_array($sql_mmc);
		{
			$lotmmc=$row_mmc['mpmain_lotno'].",";
			$lot=explode(",",$lotmmc);
			$ltcount=count($lot);
			for($s=0; $s<=$ltcount; $s++)
			{
				if($lot[$s]==$lotno12)*/
				$mmc=$mmc+1;
			//}
		//}
		$nolpqty=$nolpqty-$row_pack['tqty'];
		$mmcqty=$mmcqty+$row_pack['tqty'];
	}
	
	else if($row_pack['trtype']=="PACKLMC" || $row_pack['trtype']=="PACKNLC")
	{
		/*$sql_lmc=mysqli_query($link,"select * from tbl_mpmain where mpmain_trid='".$row_pack['lotldg_id']."' and mpmain_trtype='PACKLMC'") or die(mysqli_error($link));
		while($row_lmc=mysqli_fetch_array($sql_lmc))
		{*/
			$lmc=$lmc+1;
		//}
		$nolpqty=$nolpqty-$row_pack['tqty'];
		$lmcqty=$lmcqty+$row_pack['tqty'];
	}
	
}
//echo $nolpqty;
	/*$dq=explode(" ",$ups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$ups=$aqs." ".$dq[1];*/
	if($ups!="")
	{
	$packtp2=explode(" ",$ups);
	$packtyp=$packtp2[0];
	//echo $packtp2[0]; 
	if($packtp2[1]=="Gms")
	{ 
		$ptp2=(1000/$packtp2[0]);
		$ptp1=($packtp2[0]/1000);
	}
	else
	{
		if($packtp2[0]<1)
		{
			$ptp2=(1000/$packtp2[0])/1000;
			$ptp1=($packtp2[0]/1000)*1000;
		}
		else
		{
			$ptp2=$packtp2[0];
			$ptp1=$packtp2[0];
		}
	}
	//echo $ptp2;
if($tot_nolpqty>0)
{
	if($packtp2[1]=="Gms")
	{
		$nolp=($ptp2*$nolpqty);
	}
	else
	{
		$nolp=($nolpqty/$ptp2);
	}
	//$nolp=(1000/$ups)*$nolpqty;
}	
}
$barcode=$smc+$mmc+$lmc;
if($smc>0 || $mmc>0 || $lmc>0)
{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Packaging</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">NoLP</td>
	<td width="99" align="center" valign="middle" class="tblheading">SMC</td>
	<td width="97" align="center" valign="middle" class="tblheading">LMC</td>
	<td width="97" align="center" valign="middle" class="tblheading">MMC</td>
	<td width="97" align="center" valign="middle" class="tblheading">Barcode</td> 
</tr>

<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo round($nolp);?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $smcqty;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $lmcqty;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $mmcqty;?></td>
	<!--<td width="97" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $lotno12;?>','<?php echo "PACKSMC";?>');"><?php echo $smc;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $lotno12;?>','<?php echo "PACKLMC";?>');"><?php echo $lmc;?></a></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $lotno12;?>','<?php echo "PACKMMC";?>');"><?php echo $mmc;?></a></td>-->
	<td width="97" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $lotno12;?>','<?php echo "ALL";?>');"><?php echo $barcode;?></a></td> 
</tr>
</table><br /><?php }?>

<?php
//echo $lotno12;
//echo "SELECT  * FROM tbl_dallocsub_sub where dallocss_lotno='".$lotno12."' order by dallocss_id asc";
$alqtymain=0;
$sql_alss=mysqli_query($link,"SELECT  * FROM tbl_dallocsub_sub where dallocss_lotno='".$lotno12."' and plantcode='$plantcode' order by dallocss_id asc") or die(mysqli_error($link));
//$tot_alss=mysqli_num_rows($sql_alss);
while($row_alss=mysqli_fetch_array($sql_alss))
{
	$alqtymain=$alqtymain+($row_alss['dallocss_qty']-$row_alss['dallocss_dispqty']);
}
if($alqtymain>0)
{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Allocation</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="70" align="center" valign="middle" class="tblheading">Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Party Type</td>
	<td width="99" align="center" valign="middle" class="tblheading">Allocation Type</td>
	<td width="97" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="97" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="97" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="99" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="97" align="center" valign="middle" class="tblheading">Barcode</td> 
</tr>

<?php
//echo "SELECT  DISTINCT `dallocs_id` FROM tbl_dallocsub_sub where dallocss_lotno='".$lotno12."' order by dallocss_id asc";
$sql_allocss=mysqli_query($link,"SELECT  DISTINCT `dallocs_id` FROM tbl_dallocsub_sub where dallocss_lotno='".$lotno12."' and plantcode='$plantcode' order by dallocss_id asc") or die(mysqli_error($link));
$tot_allocss=mysqli_num_rows($sql_allocss);
while($row_allocss=mysqli_fetch_array($sql_allocss))
{
	$sql_alsub=mysqli_query($link,"SELECT  * FROM tbl_dalloc_sub where dallocs_id='".$row_allocss['dallocs_id']."' and dallocs_dflg=0 and plantcode='$plantcode' order by dallocs_id asc") or die(mysqli_error($link));
	while($row_alsub=mysqli_fetch_array($sql_alsub))
	{
//echo "SELECT  * FROM tbl_dallocsub_sub where dallocs_id='".$row_allocss['dallocs_id']."' order by dallocs_id asc";
$aldate=""; $alptype=""; $alpname=""; $alups=""; $alqty=""; $alnomp=""; $albarcode="";
$sql_allocss1=mysqli_query($link,"SELECT  * FROM tbl_dallocsub_sub where dallocs_id='".$row_allocss['dallocs_id']."' and dallocss_lotno='".$lotno12."' and plantcode='$plantcode' order by dallocs_id asc") or die(mysqli_error($link));
$tot_allocss1=mysqli_num_rows($sql_allocss1);
while($row_allocss1=mysqli_fetch_array($sql_allocss1))
{
	$alqty=$alqty+($row_allocss1['dallocss_qty']-$row_allocss1['dallocss_dispqty']);
	$alnomp=$alnomp+(($row_allocss1['dallocss_qty']-$row_allocss1['dallocss_dispqty'])/$row_allocss1['dallocss_wtmp']);
	
	$alups=$row_allocss1['dallocss_ups'];
	$dq=explode(" ",$alups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$alups=$aqs." ".$dq[1];
	
	/*if($row_allocss1['dallocss_altype']=="barcodewise")
	{*/
	//echo "SELECT  * FROM tbl_dallocsub_sub3 where dallocss_id='".$row_allocss1['dallocss_id']."' and dallocss3_lotno='".$lotno12."' and dallocss3_dflg=0 order by dallocss3_id asc";
		$sql_allocbar=mysqli_query($link,"SELECT  * FROM tbl_dallocsub_sub3 where dallocss_id='".$row_allocss1['dallocss_id']."' and dallocss3_lotno='".$lotno12."' and dallocss3_dflg=0 and plantcode='$plantcode' order by dallocss3_id asc") or die(mysqli_error($link));
		$tot_allocbar=mysqli_num_rows($sql_allocbar);
		$row_allocbar=mysqli_fetch_array($sql_allocbar);
		$albarcode=$albarcode+$tot_allocbar;
	//}
	if($albarcode>0)
	{
		$sql_allocwh=mysqli_query($link,"SELECT  * FROM tbl_dallocsub_sub4 where dalloc_id='".$row_allocss1['dalloc_id']."' and plantcode='$plantcode' order by dallocss4_id asc") or die(mysqli_error($link));
		$tot_allocwh=mysqli_num_rows($sql_allocwh);
		if($tot_allocwh>0 && $alloctype!=$alloctype)
		{
			$alloctype="MWB";
		}
		else
		{
			$alloctype="WMWB";
		}
	}
	else
	{
		$alloctype="WMNB";
	}
	
	
	$sql_alloc=mysqli_query($link,"SELECT  * FROM tbl_dalloc where dalloc_id='".$row_allocss1['dalloc_id']."' and plantcode='$plantcode' order by dalloc_id asc") or die(mysqli_error($link));
$row_alloc=mysqli_fetch_array($sql_alloc);
//$aldate=$row_alloc['dalloc_date'];
	$aldate=$row_alloc['dalloc_date'];
	$tryear=substr($aldate,0,4);
	$trmonth=substr($aldate,5,2);
	$trday=substr($aldate,8,2);
	$aldate=$trday."-".$trmonth."-".$tryear;
	
$alptype=$row_alloc['dalloc_partytype'];

$sql_alparty=mysqli_query($link,"SELECT  * FROM tbl_partymaser where p_id='".$row_alloc['dalloc_party']."'") or die(mysqli_error($link));
//$tot_allocss1=mysqli_num_rows($sql_allocss1);
$row_alparty=mysqli_fetch_array($sql_alparty);
$alpname=$row_alparty['business_name'];
}
if($alqty>0)
{
?>

<tr class="Light" height="20">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $aldate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $alptype;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $alloctype;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $alpname;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $alups;?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $alqty;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo round($alnomp);?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint2('<?php echo $lotno12;?>','<?php echo $row_alloc['dalloc_id'];?>');"><?php if($albarcode>0){echo $albarcode;}?></a></td>
</tr>
<?php }}}?>
</table><br /><?php }?>

<?php 
$lotno13=$lotno1."C";
$lotno14=$lotno1."R";
//echo "select distinct lotldg_id from tbl_lot_ldg_pack where orlot='".$lotno1."' and (trtype='Qty-Rem' or trtype='Dispatch' or trtype='Dispatch TDF' or trtype='Stock Transfer Out' or trtype='Dispatch Bulk') order by lotldg_id asc";
$sql_pakdisp=mysqli_query($link,"select distinct lotldg_id from tbl_lot_ldg_pack where orlot='".$lotno1."' and (trtype='Qty-Rem' or trtype='Dispatch' or trtype='Dispatch TDF' or trtype='Stock Transfer Out' or trtype='Dispatch Bulk') and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
	$tot_pakdisp=mysqli_num_rows($sql_pakdisp);
	//echo "select distinct lotldg_trid from tbl_lot_ldg where orlot='".$lotno1."' and (lotldg_trtype='Qty-Rem' or lotldg_trtype='Dispatch' or lotldg_trtype='Dispatch TDF' or lotldg_trtype='Stock Transfer Out' or lotldg_trtype='Dispatch Bulk') and lotldg_id!='".$row_pakdisp['lotldg_id']."' order by lotldg_id asc";
	$sql_pakdisp1=mysqli_query($link,"select distinct lotldg_trid from tbl_lot_ldg where orlot='".$lotno1."' and (lotldg_trtype='Qty-Rem' or lotldg_trtype='Dispatch' or lotldg_trtype='Dispatch TDF' or lotldg_trtype='Stock Transfer Out' or lotldg_trtype='Dispatch Bulk') and lotldg_id!='".$row_pakdisp['lotldg_id']."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
	$tot_pakdisp1=mysqli_num_rows($sql_pakdisp1);
	//$row_pakdisp1=mysqli_fetch_array($sql_pakdisp1)
if($tot_pakdisp>0 || $tot_pakdisp1>0)
{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Dispatch</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="70" align="center" valign="middle" class="tblheading">Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Disp. Note No.</td>
	<td width="99" align="center" valign="middle" class="tblheading">Disp. Type</td>
	<td width="97" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="97" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="97" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="97" align="center" valign="middle" class="tblheading">Barcode</td> 
</tr>

<?php
while($row_pakdisp=mysqli_fetch_array($sql_pakdisp))
{
$dodc=""; $psdn=""; $disptype=""; $partyname=""; $dups=""; $dqty=0; $dbarcode=0;
$sql_packm=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$row_pakdisp['lotldg_id']."' and orlot='".$lotno1."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
while($row_packm=mysqli_fetch_array($sql_packm))
{
if($row_packm['trtype']=="Dispatch")
{
//echo "select * from tbl_disp where disp_id='".$row_packm['lotldg_id']."'";
$sql_disp=mysqli_query($link,"select * from tbl_disp where disp_id='".$row_packm['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_disp=mysqli_num_rows($sql_disp);
$row_disp=mysqli_fetch_array($sql_disp);
	
	$disptype=$row_disp['disp_partytype'];
	$barid=$row_disp['disp_id'];
	$sql_dparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_disp['disp_party']."'") or die(mysqli_error($link));
	$row_dparty=mysqli_fetch_array($sql_dparty);
	$partyname=$row_dparty['business_name'];
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_disp['disp_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	//$psdn=$row_param['code']."/"."SD"."/".$row_disp['disp_yearcode']."/".$row_code1['dnote_code'];
	if($ptype=="Dealer" || $ptype=="Export Buyer")
	$psdn=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."SD"."/".sprintf("%004d",$row_code1['dnote_code']);
	else
	$psdn=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."ST"."/".sprintf("%004d",$row_code1['dnote_code']);
	
	$dodc=$row_disp['disp_dodc'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$dqty=$dqty+$row_packm['tqty'];
	$dups=$row_packm['packtype'];
	
	/*$sql_disps=mysqli_query($link,"select * from tbl_dispsub_sub where disp_id='".$row_disp['disp_id']."' and dpss_lotno='".$lotno1."' order by dpss_id asc") or die(mysqli_error($link));
	while($row_disps=mysqli_fetch_array($sql_disp))
	{*/
		
		if($row_packm['nomp']>=1)
		{
			$dbarcode=$dbarcode+$row_packm['nomp'];
			//$dbarcode=$dbarcode+1;
		}
	//}
}
if($row_packm['trtype']=="Dispatch TDF")
{
	//echo "select * from tbl_dtdf where dtdf_id='".$row_pakdisp['lotldg_id']."'";
	$sql_disp=mysqli_query($link,"select * from tbl_dtdf where dtdf_id='".$row_pakdisp['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_disp);
	$row_disp=mysqli_fetch_array($sql_disp); 
	$barid=$row_disp['dtdf_id'];
	$partyname=$row_disp['dtdf_party'];
	/*$sql_dparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_disp['dtdf_party']."'") or die(mysqli_error($link));
	$row_dparty=mysqli_fetch_array($sql_dparty);
	//$partyname=$row_dparty['business_name'];*/
	
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_disp['dtdf_id']."' and dnote_trtype='Dispatch TDF Seed' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$psdn=$row_param['code']."/"."SD"."/".$row_disp['disp_yearcode']."/".sprintf("%004d",$row_code1['dnote_code']);
	
	//$row_disps=mysqli_fetch_array($sql_disps);
	//$dodc=$row_disp['disp_dodc'];
	$dodc=$row_disp['dtdf_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$sql_disps=mysqli_query($link,"select * from tbl_dtdf_sub where dtdf_id='".$row_disp['dtdf_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_disps=mysqli_fetch_array($sql_disps);
	$dups=$row_disps['dtdfs_ups'];
	
	//echo "select * from tbl_dtdfsub_sub where dbss_id='".$row_disp['dtdf_id']."' and dbss_lotno='".$lotno12."' order by dbss_id asc";
	$sql_dispss=mysqli_query($link,"select * from tbl_dtdfsub_sub where dtdf_id='".$row_disp['dtdf_id']."' and dbss_lotno='".$lotno12."' and plantcode='$plantcode' order by dbss_id asc") or die(mysqli_error($link));
	while($row_dispss=mysqli_fetch_array($sql_dispss))
	{
		$dqty=$dqty+$row_dispss['dbss_qty'];
		$disptype="Dispatch TDF";
		$sql_disps=mysqli_query($link,"select * from tbl_dtdf_sub where dtdfs_id='".$row_disps['dtdfs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$dups=$row_disps['dtdfs_ups'];
	}
}

if($row_packm['trtype']=="Stock Transfer Out")
{
	$sql_disp=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$row_pakdisp['lotldg_id']."' and lotno='".$lotno12."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_disp);
	while($row_disp=mysqli_fetch_array($sql_disp))
	{
		$dqty=$dqty+$row_disp['dbss_qty'];
		$dbarcode="Stock Transfer Out";
		$dups=$row_disp['packtype'];
	} 
	$disptype=$dbarcode;
	$sql_stout=mysqli_query($link,"select * from tbl_stoutm where stoutm_id='".$row_disp['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stout=mysqli_fetch_array($sql_stout);
	$sql_stparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_disp['lotldg_id']."'") or die(mysqli_error($link));
	$row_stparty=mysqli_fetch_array($sql_stparty);
	
	$partyname=$row_stparty['business_name'];
		
	$dodc=$sql_stout['stoutm_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_disp['stoutm_id']."' and dnote_trtype='Dispatch TDF Seed' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$psdn=$row_param['code']."/"."SD"."/".$row_disp['disp_yearcode']."/".sprintf("%004d",$row_code1['dnote_code']);
	
}

if($row_packm['trtype']=="Qty-Rem")
{
		$dqty=$dqty+$row_packm['tqty'];
		$dbarcode="Release";
		$disptype=$dbarcode;
		$dups=$row_packm['packtype']; 
	
	$sql_qty=mysqli_query($link,"select * from tbl_pswrem where pswrem_id='".$row_packm['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_qty=mysqli_fetch_array($sql_qty);
	$sql_stparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_qty['pswrem_id']."'") or die(mysqli_error($link));
	$row_stparty=mysqli_fetch_array($sql_stparty);
	$partyname=$row_stparty['business_name'];
			
	$dodc=$row_qty['pswrem_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$psdn="CR".$row_qty['pswrem_code']."/".$row_qty['yearcode']."/".$row_qty['logid'];	
}

if($row_packm['trtype']=="Dispatch Bulk")
{
	$sql_disp=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$row_pakdisp['lotldg_id']."' and lotno='".$lotno12."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_disp);
	while($row_disp=mysqli_fetch_array($sql_disp))
	{
		$dqty=$dqty+$row_disp['dbss_qty'];
		$dbarcode="Dispatch Bulk";
		$dups=$row_disp['packtype'];
	} 
	
	$sql_bulk=mysqli_query($link,"select * from tbl_dbulk where dbulk_id='".$row_disp['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_bulk=mysqli_fetch_array($sql_bulk);
	$sql_stparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_bulk['dbulk_party']."'") or die(mysqli_error($link));
	$row_stparty=mysqli_fetch_array($sql_stparty);
	$partyname=$row_stparty['business_name'];
			
	$dodc=$row_bulk['dbulk_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_disp['stoutm_id']."' and dnote_trtype='Dispatch Bulk Seed' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$psdn=$row_param['code']."/"."SD"."/".$row_bulk['dbulk_yearcode']."/".sprintf("%004d",$row_code1['dnote_code']);
	
	
						
}
}
	$dq=explode(" ",$dups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$dups=$aqs." ".$dq[1];
?>

<tr class="Light" height="20">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $dodc;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $psdn;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $partyname;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $dups;?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $dqty;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint1('<?php echo $lotno1;?>','<?php echo $barid;?>');"><?php if($dbarcode>0){echo $dbarcode;}?></a></td>
</tr>
<?php 
}

while($row_pakdisp1=mysqli_fetch_array($sql_pakdisp1))
{
$dodc=""; $psdn=""; $disptype=""; $partyname=""; $dups=""; $dqty=0; $dbarcode=0;
//echo "select * from tbl_lot_ldg where lotldg_trid='".$row_pakdisp1['lotldg_trid']."' and orlot='".$lotno1."' order by lotldg_id asc";
$sql_packl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trid='".$row_pakdisp1['lotldg_trid']."' and orlot='".$lotno1."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
while($row_packl=mysqli_fetch_array($sql_packl))
{
if($row_packl['lotldg_trtype']=="Dispatch TDF")
{
	$sql_disp=mysqli_query($link,"select * from tbl_dtdf where dtdf_id='".$row_packl['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_disp);
	$row_disp=mysqli_fetch_array($sql_disp); 
	
	$partyname=$row_disp['dtdf_party'];
	/*$sql_dparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_disp['dtdf_party']."'") or die(mysqli_error($link));
	$row_dparty=mysqli_fetch_array($sql_dparty);
	//$partyname=$row_dparty['business_name'];*/
	$disptype="Dispatch TDF";
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_disp['dtdf_id']."' and dnote_trtype='Dispatch TDF Seed' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$psdn=$row_param['code']."/"."SD"."/".$row_disp['disp_yearcode']."/".$row_code1['dnote_code'];
	
	//$row_disps=mysqli_fetch_array($sql_disps);
	//$dodc=$row_disp['disp_dodc'];
	$dodc=$row_disp['dtdf_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$sql_dispss=mysqli_query($link,"select * from tbl_dtdfsub_sub where dbss_id='".$row_disp['dtdf_id']."' and dbss_lotno='".$lotno12."' and plantcode='$plantcode' order by dbss_id asc") or die(mysqli_error($link));
	while($row_dispss=mysqli_fetch_array($sql_dispss))
	{
		//$dqty=$dqty+$row_dispss['dbss_qty'];
		$dbarcode="Dispatch TDF";
		$sql_disps=mysqli_query($link,"select * from tbl_dtdf_sub where dtdfs_id='".$row_disps['dtdfs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$dups=$row_disps['dtdfs_ups'];
	}
	$dqty=$dqty+$row_packl['lotldg_trqty'];
}

if($row_packl['lotldg_trtype']=="Stock Transfer Out")
{
	/*$sql_disp=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$sql_packl['lotldg_id']."' and lotno='".$lotno12."'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_disp);
	while($row_disp=mysqli_fetch_array($sql_disp))
	{*/
		$dqty=$dqty+$row_packl['lotldg_trqty'];
		$disptype="Stock Transfer Out";
		$dups=$row_packl['packtype'];
	//} 
	//echo "select * from tbl_stoutm where stoutm_id='".$row_packl['lotldg_trid']."'";
	$sql_stout=mysqli_query($link,"select * from tbl_stoutm where stoutm_id='".$row_packl['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_stout=mysqli_fetch_array($sql_stout);
	
	/*$sql_stouts=mysqli_query($link,"select * from tbl_stoutm where stoutm_id='".$row_packl['lotldg_trid']."'") or die(mysqli_error($link));
	$row_stouts=mysqli_fetch_array($sql_stouts);
	$dqty=$dqty+$row_stouts['stouts_qty'];*/
	
	$sql_stparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_stout['stoutm_plant']."'") or die(mysqli_error($link));
	$row_stparty=mysqli_fetch_array($sql_stparty);
	
	$partyname=$row_stparty['business_name'];
		
	$dodc=$row_stout['stoutm_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_packl['lotldg_trid']."' and dnote_trtype='Dispatch TDF Seed' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$psdn=$row_param['code']."/"."SD"."/".$row_disp['disp_yearcode']."/".$row_code1['dnote_code'];	
}

if($row_packl['lotldg_trtype']=="Qty-Rem")
{
	$dqty=$dqty+$row_packl['lotldg_trqty'];
	$disptype="Release";
	$dups=$row_packl['packtype'];
		
	$sql_qty=mysqli_query($link,"select * from tbl_rswrem where rswrem_id='".$row_packl['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_qty);
	$row_qty=mysqli_fetch_array($sql_qty);
	
	$dodc=$row_qty['rswrem_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	$psdn="CR".$row_qty['pswrem_code']."/".$row_qty['yearcode']."".$row_qty['logid'];
	
	if($tot_disp==0)
	{
		$sql_disp=mysqli_query($link,"select * from tbl_cswrem where rswrem_id='".$row_packl['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_disp=mysqli_num_rows($sql_disp);
		$row_disp=mysqli_fetch_array($sql_disp);
		
		$sql_stparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_disp['pswrem_id']."'") or die(mysqli_error($link));
		$row_stparty=mysqli_fetch_array($sql_stparty);
		$partyname=$row_stparty['business_name'];	
			
		$dodc=$row_disp['rswrem_date'];
		$tryear=substr($dodc,0,4);
		$trmonth=substr($dodc,5,2);
		$trday=substr($dodc,8,2);
		$dodc=$trday."-".$trmonth."-".$tryear;
		
		$psdn="CR".$row_disp['pswrem_code']."/".$row_disp['yearcode']."/".$row_disp['logid'];
	}	
}

if($row_packl['lotldg_trtype']=="Dispatch Bulk")
{
	/*$sql_disp=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$sql_packl['lotldg_id']."' and lotno='".$lotno12."'") or die(mysqli_error($link));
	$tot_disp=mysqli_num_rows($sql_disp);
	while($row_disp=mysqli_fetch_array($sql_disp))
	{*/
		$dqty=$dqty+$row_packl['lotldg_trqty'];
		$disptype="Dispatch Bulk";
		//$dups=$sql_packl['packtype'];
	//} 
	
	$sql_bulk=mysqli_query($link,"select * from tbl_dbulk where dbulk_id='".$row_packl['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_bulk=mysqli_fetch_array($sql_bulk);
	$sql_stparty=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_bulk['dbulk_party']."'") or die(mysqli_error($link));
	$row_stparty=mysqli_fetch_array($sql_stparty);
	$partyname=$row_stparty['business_name'];
			
	$dodc=$row_bulk['dbulk_date'];
	$tryear=substr($dodc,0,4);
	$trmonth=substr($dodc,5,2);
	$trday=substr($dodc,8,2);
	$dodc=$trday."-".$trmonth."-".$tryear;
	
	$sql_code1=mysqli_query($link,"SELECT * FROM tbl_dispnote where dnote_trid='".$row_packl['lotldg_trid']."' and dnote_trtype='Dispatch Bulk Seed' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($sql_code1);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$psdn=$row_param['code']."/"."SD"."/".$row_bulk['dbulk_yearcode']."/".$row_code1['dnote_code'];		
}
}
	$dq=explode(" ",$dups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$dups=$aqs." ".$dq[1];
?>

<tr class="Light" height="20">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $dodc;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $psdn;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $partyname;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $dups;?></td> 
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $dqty;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $dbarcode;?></td>
	<!--<td width="99" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint1('<?php echo $lotno1;?>','<?php echo "ALL";?>');"><?php echo $barcode;?></a></td>-->
</tr>
<?php
}
//}
//}
 ?>
</table><br /><?php }?>

<?php 
$sql_discs=mysqli_query($link,"select * from tbl_discard_sub where lotnumber='".$lotno1."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_discs=mysqli_num_rows($sql_discs);
	if($tot_discs>0)
	{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Discard</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Discard Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Discard Note</td>
	<td width="99" align="center" valign="middle" class="tblheading">Discard Type</td>
	<td width="97" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="99" align="center" valign="middle" class="tblheading">Stage</td>
	<!--<td width="97" align="center" valign="middle" class="tblheading">UPS</td>-->
	<td width="99" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="97" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php 
//echo "select * from tbl_discard_sub where lotnumber='".$lotno1."'";
$discdate=""; $discnote=""; $disctype=""; $discparty=""; $discstage=""; $discnop=""; $discqty="";

while($row_discs=mysqli_fetch_array($sql_discs))
{
  $sql_discss=mysqli_query($link,"select * from tbl_discard_sloc where discard_id='".$row_discs['did']."' and plantcode='$plantcode'") or die(mysqli_error($link));
  $row_discss=mysqli_fetch_array($sql_discss);
  
  $sql_disc=mysqli_query($link,"select * from tbl_discard where tid='".$row_discs['did_s']."' and plantcode='$plantcode'") or die(mysqli_error($link));
  $row_disc=mysqli_fetch_array($sql_disc);
  
  $discdate=$row_disc['tdate'];
  $discnote="MD".$row_disc['dd_code']."/".$row_disc['yearcode']."/".$row_disc['ncode'];
  $discparty=$row_disc['party_name'];
  $disctype=$row_discss['discard_type'];
  $discstage=$row_discss['sstage'];
  $discnop=$row_discss['ups_discard'];
  $discqty=$row_discss['qty_discard'];
  
?>
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo strrev($discdate);?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $discnote;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $disctype;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $discparty;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $discstage;?></td> 
	<!--<td width="99" align="center" valign="middle" class="smalltbltext"><?php ?></td>-->
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $discnop;?></td>
    <td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $discqty;?></td>
</tr>
<?php }?>
</table><?php }?>

<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
	<td valign="top" align="center"><a href="utility.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;</td>
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
