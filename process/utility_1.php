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
		$stcode2=trim($_REQUEST['stcode2']);
		$ycode=trim($_REQUEST['ycodee']);
		$txtlot4=trim($_REQUEST['txtlot4']);
		
		//$zz=str_split($txtlot1);
		//print_r($zz);
		 $newlot1=$txtlot1;
		//$newlot1=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
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
<title>Plant-Report - Production Personnel Report</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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
          <td valign="top"><?php require_once("../include/arr_process.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/process_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >Utility - Lot Query</td>
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
$zzz=implode(",", str_split($lotno));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];


$sql_lotldg=mysqli_query($link,"Select * from tbl_lot_ldg where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_lotldg=mysqli_num_rows($sql_lotldg);
$row_lotldg=mysqli_fetch_array($sql_lotldg);

$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_lotldg['lotldg_crop']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
				
$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_lotldg['lotldg_variety']."'") or die(mysqli_error($link));
$row0=mysqli_fetch_array($quer0);

$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$rswqty=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where orlot='".$lotno."' and lotldg_sstage='Raw' and plantcode='$plantcode'") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$row_lotldg['lotldg_variety']."' and orlot='".$lotno."' and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_balqty desc") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
//$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' ") or die(mysqli_error($link)); 
//echo $row_issue1[0];		
$sql_lotldg2=mysqli_query($link,"Select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_sstage='Raw' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_lotldg2=mysqli_num_rows($sql_lotldg2);
while($row_lotldg2=mysqli_fetch_array($sql_lotldg2))
{
$rswqty=$rswqty+$row_lotldg2['lotldg_balqty'];
}
}

$crop=$row_class['cropname'];
$variety=$row0['popularname'];
$got=$row_whouse['got1'];
?>			
		<table align="center" border="1" bordercolor="#adad11" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
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
<tr class="tblsubtitle" height="20">
	<td align="right"  valign="middle" class="tblheading">&nbsp;Arival Quantity&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $row_whouse['act'];?></td>
	<td align="right"  valign="middle" class="tblheading">&nbsp;Raw Seed in Hand&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $rswqty;?></td>
</tr>
  </table>	
  
<?php

 $sql_prslp_home=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_orlot='".$lotno."' and plantcode='$plantcode' order by proslipsub_orlot, proslipsub_id desc") or die(mysqli_error($link));
 $tot_prslp_home=mysqli_num_rows($sql_prslp_home);
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Processing Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Raw Seed</td>
	<td width="97" align="center" valign="middle" class="tblheading">Condition Seed</td>
	<td width="97" align="center" valign="middle" class="tblheading">RM</td>
	<td width="97" align="center" valign="middle" class="tblheading">IM</td> 
	<td width="99" align="center" valign="middle" class="tblheading">PL</td>
	<td width="99" align="center" valign="middle" class="tblheading">TPL</td>
    <td width="99" align="center" valign="middle" class="tblheading">PSRN</td>
    <td width="99" align="center" valign="middle" class="tblheading">PMC</td>
    <td width="99" align="center" valign="middle" class="tblheading">TS</td>
    <td width="99" align="center" valign="middle" class="tblheading">Operator Name</td>
    <td width="99" align="center" valign="middle" class="tblheading">SRS</td>
</tr>
<?php
 if($tot_prslp_home >0) 
 {  
$srno=1;

while($row_tbl_sub1=mysqli_fetch_array($sql_prslp_home))
{	

	$quer3=mysqli_query($link,"SELECT * FROM tbl_proslipmain where proslipmain_id='".$row_tbl_sub1['proslipmain_id']."' and plantcode='$plantcode'"); 
	$row3=mysqli_fetch_array($quer3);

	$trdate1=$row3['proslipmain_date'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;	
	
$sql_sel1="select * from tbl_rm_promac where promac_id='".$row3['proslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row3['proslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);

if($row3['proslipmain_stage']=="Raw")
{
if($srno%2!=0)
{
?>	
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_oqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_conqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_rm'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_im'];?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_pl'];?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_tlqty'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_proslipno'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $num;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_treattype'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_sstatus'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_oqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_conqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_rm'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_im'];?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_pl'];?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_tlqty'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_proslipno'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $num;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_treattype'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_sstatus'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<br />
<?php
 $sql_prslp_home2=mysqli_query($link,"select * from tbl_proslipsub where SUBSTRING(proslipsub_orlot,1,13)='".$abc."' and plantcode='$plantcode' order by proslipsub_orlot,proslipsub_id desc") or die(mysqli_error($link));
 $tot_prslp_home2=mysqli_num_rows($sql_prslp_home2);
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Re-processing Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">Date</td>
	<td width="99" align="center" valign="middle" class="tblheading">Condition Seed</td>
	<td width="97" align="center" valign="middle" class="tblheading">Re-condition Seed</td>
	<td width="97" align="center" valign="middle" class="tblheading">RM</td>
	<td width="97" align="center" valign="middle" class="tblheading">IM</td> 
	<td width="99" align="center" valign="middle" class="tblheading">PL</td>
	<td width="99" align="center" valign="middle" class="tblheading">TPL</td>
    <td width="99" align="center" valign="middle" class="tblheading">PSRN</td>
    <td width="99" align="center" valign="middle" class="tblheading">PMC</td>
    <td width="99" align="center" valign="middle" class="tblheading">TS</td>
    <td width="99" align="center" valign="middle" class="tblheading">Operator Name</td>
    <td width="99" align="center" valign="middle" class="tblheading">SRS</td>
</tr>
<?php
 if($tot_prslp_home2 >0) 
 {  
$srno=1;

while($row_tbl_sub1=mysqli_fetch_array($sql_prslp_home2))
{	

	$quer3=mysqli_query($link,"SELECT * FROM tbl_proslipmain where proslipmain_id='".$row_tbl_sub1['proslipmain_id']."' and plantcode='$plantcode'"); 
	$row3=mysqli_fetch_array($quer3);

	$trdate1=$row3['proslipmain_date'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;	
	
$sql_sel1="select * from tbl_rm_promac where promac_id='".$row3['proslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row3['proslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);

if($row3['proslipmain_stage']=="Condition")
{
if($srno%2!=0)
{
?>	
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_oqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_conqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_rm'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_im'];?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_pl'];?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_tlqty'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_proslipno'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $num;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_treattype'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_sstatus'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_oqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_conqty'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_rm'];?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_im'];?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_pl'];?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_tlqty'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_proslipno'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $num;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row3['proslipmain_treattype'];?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['proslipsub_sstatus'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<br />
<?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' order by lotno,tid desc limit 0,1") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) 
 {  
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Quality Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">

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
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."'"); 
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
$moist=$row_tbl['lotldg_moisture'];
$pp=$row_tbl['lotldg_vchk'];	
$gemp=$row_tbl['lotldg_gemp'];
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


$aq=explode(".",$row_tbl['lotldg_moisture']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_moisture'];}

	$trdate1=$row_tbl['lotldg_gottestdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;	
	
	$trdate11=$row_tbl['lotldg_qctestdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$trdate11=$trday."-".$trmonth."-".$tryear;	
$qc=$row_tbl['lotldg_qc'];
$gggg=explode("-", $row_tbl['lotldg_got1']);
$zzz=explode(" ",$gggg[1]);
$got=$zzz[0]." ".$row_tbl['lotldg_got'];

if($srno%2!=0)
{
?>	
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $sstat;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $sstat;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Quantity Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="136" align="center" valign="middle" class="tblheading" rowspan="2">Stage</td>
	<td width="139" align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
	<td width="159" align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">SLOC</td>
</tr>
<tr class="tblsubtitle" height="20">
	
	<td width="135" align="center" valign="middle" class="tblheading">Bin 1</td> 
	<td width="119" align="center" valign="middle" class="tblheading">Bin 2</td>
</tr>
<?php
$srno=1; $totalnob=0; $totalqty=0;
$sql_tbl_sub=mysqli_query($link,"select distinct(lotldg_sstage) from tbl_lot_ldg where SUBSTRING(orlot,1,13)='".$abc."' and plantcode='$plantcode'")or die(mysqli_error($link));
$ct1=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$nob=0; $qty=0;  $slocs=""; $slocs2=""; $srn=1;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE SUBSTRING(orlot,1,13)='".$abc."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and plantcode='$plantcode'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0;

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE SUBSTRING(orlot,1,13)='".$abc."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."' and plantcode='$plantcode' order by lotldg_id desc");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and plantcode='$plantcode'")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
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
if($srn==1) 
{
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
else
{
if($slocs2!="")
$slocs2=$slocs2.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs2=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}

$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
$totalnob=$totalnob+$ac; 
$totalqty=$totalqty+$acn;
if($acn==0){$slocs=''; $slocs2='';}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs2;?></td> 
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs2;?></td> 
</tr>
<?php
}
$srno=$srno+1;
}
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="tblheading">Total</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totalnob;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
	<td align="center" valign="middle" class="tblheading" colspan="2">&nbsp;</td> 
</tr>

</table>
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
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where orlot='".$a."'  and lotldg_balqty > 0") or die(mysqli_error($link));
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
		if($row_issuetbl['lotldg_got']=='UT' || $row_issuetbl['lotldg_got']=='RT')
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

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="Light" height="20">
	<td width="105" align="center" valign="middle" class="tblheading" bgcolor="#d2d29a">SR/SSR Type</td>
	<td width="104" align="center" valign="middle" class="tblheading"><?php echo ucwords($softstatus);?></td>
	<td width="110" align="center" valign="middle" class="tblheading" bgcolor="#d2d29a">DoSR/DoSSR</td>
	<td width="109" align="center" valign="middle" class="tblheading"><?php echo $qcdot; ?></td>
</tr>

</table>

<?php
}

}
?>
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
