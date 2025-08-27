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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
if(isset($_GET['tid']))
{
	$a = $_GET['tid'];	 
}
	/*$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_qctest where tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['sampleno'];
	$olotno2=$row_ck2['lotno'];
	$yearid2=$row_ck2['yearid'];
	
	$sql_ck23=mysqli_query($link,"select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc") or die(mysqli_error($link));
	$zxzx=mysqli_num_rows($sql_ck23);
	if($zxzx > 0)
	{
	$row_ck23=mysqli_fetch_array($sql_ck23);
	$otid2=$row_ck23['tid'];
	}
	if($otid2!="")
	$a=$otid2;*/
if(isset($_POST['frm_action'])=='submit')
{ //exit;
	$dos= trim($_POST['pdate1']);
	$dcdate= trim($_POST['dcdate']);
	$loc = trim($_POST['txtloc']);
	$txtnop = trim($_POST['txtnop']);
	$txtnot = trim($_POST['txtnot']);
	$purity = trim($_POST['txtgenpurity']);
	$txtst = trim($_POST['txtst']);
	$txtod = trim($_POST['txtod']);
	$txtvar = trim($_POST['txtvar']);
	$txtsterile = trim($_POST['txtsterile']);
	$txtother = trim($_POST['txtother']);
	$total= trim($_POST['txttotal']);
	$remarks =trim( $_POST['txtremarks']);	 
	$result= trim($_POST['result']);	 
	$e = $_POST['sdate'];
	$got = $_POST['got'];		
	$txtlot = $_POST['txtlot'];		
	$stage = $_POST['stage'];		
	$oldlot = $_POST['oldlot'];		
	//txtgenpurity
	$samp= $_POST['txtsamp'];
	
	$dotr= $_POST['trdate'];
	$bedno= $_POST['txtbedno'];
	$plantpop= $_POST['txtplantpop'];
	$direction= $_POST['txtdirection'];
	$gotloc= $_POST['txtlocation'];
	
	$maleno= $_POST['txtno'];
	$maleper= $_POST['txtper'];
	$femaleno= $_POST['txtno1'];
	$femaleper= $_POST['txtper1'];
	$oofno= $_POST['txtoofno'];
	$oofper= $_POST['txtoofper'];
	$totalno= $_POST['txttotno'];
	$totalper= $_POST['txttotper'];
	$doobr= $_POST['obdate'];
	$retest= $_POST['retest'];
	$gotflg=0;
	if($retest=="yes")$gotflg=1;
	/*$maleno1=$row_ck['maleno'];
	$maleper1=$row_ck['maleper'];
	$femaleno1=$row_ck['femalepno'];
	$femaleper1=$row_ck['femaleper'];
	$oofno=$row_ck['oofno'];
	$oofper1=$row_ck['oofper'];
	$totalno1=$row_ck['totalno'];
	$totalper1=$row_ck['totalper'];
	$doobr1=$row_ck['doobr'];
	$remarks1=$row_ck['remarks'];*/
	
	//if($result=="BL")$purity='';
	
	$tdate22=explode("-",$e);
	$tdate=$tdate22[2]."-".$tdate22[1]."-".$tdate22[0];
	
	$ddate=explode("-",$dos);
	$doswdate=$ddate[2]."-".$ddate[1]."-".$ddate[0];
	//exit;
	$ddate1=explode("-",$dotr);
	$dotr=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
	
	$ddate12=explode("-",$doobr);
	$doobr=$ddate12[2]."-".$ddate12[1]."-".$ddate12[0];
	
	$xamp=str_split($samp);
	$plcode=$xamp[0];
	$yrcd=$xamp[1];
	$smpcode=$xamp[2].$xamp[3].$xamp[4].$xamp[5].$xamp[6].$xamp[7];
	
	
	$sql_ck=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='$smpcode' and yearid='$yrcd'") or die(mysqli_error($link));
	$row_ck=mysqli_fetch_array($sql_ck);
	/*{
		$ores=$row_ck['gotstatus'];
		$osamp22=$row_ck['sampleno'];
		$olotno22=$row_ck['lotno'];
		$yearid22=$row_ck['yearid'];
		$oldlot22=$row_ck['oldlot'];
		
		$olot=$row_ck['lotno'];
		$crp=$row_ck['crop'];
		$ver=$row_ck['variety'];
		$srdt=$row_ck['srdate'];
		$spdt=$row_ck['spdate'];
		$smpno=$row_ck['sampleno'];
		$stats=$row_ck['state'];
		$oqc=$row_ck['qc'];
		$stge=$row_ck['trstage'];
		$opp=$row_ck['pp'];
		$omt=$row_ck['moist'];
		$ogmp=$row_ck['gemp'];
		$oqcst=$row_ck['qcstatus'];
		$oqtdt=$row_ck['testdate'];
		//$oref=$row_ck['qcrefno'];
		$ogotdate=$row_ck['gotdate'];
		$odosdate=$row_ck['dosdate'];
		$ogot=$row_ck['got'];
		$ogotstatus=$row_ck['gotstatus'];
		$oaflg=$row_ck['aflg'];
		$obflg=$row_ck['bflg'];
		$ocflg=$row_ck['cflg'];
		$oqcflg=$row_ck['qcflg'];
		$ogotflg=$row_ck['gotflg'];
		$ogsflg=$row_ck['gsflg'];
		$ogs=$row_ck['gs'];
		$ogotrefno=$row_ck['gotrefno'];
		$ogotauth=$row_ck['gotauth'];
		$odoswdate=$row_ck['doswdate'];
		$ogotsmpdflg=$row_ck['gotsmpdflg'];
		$ostsno=$row_ck['stsno'];
		$oqcrefno=$row_ck['qcrefno'];
		$yearid=$row_ck['yearid'];
		$opurity=$row_ck['genpurity'];
		
		$dotr1=$row_ck['dotransplant'];
		$bedno1=$row_ck['bedno'];
		$plantpop1=$row_ck['plantpopln'];
		$direction1=$row_ck['direction'];
		$gotloc1=$row_ck['gotlocation'];
		
		$maleno1=$row_ck['maleno'];
		$maleper1=$row_ck['maleper'];
		$femaleno1=$row_ck['femalepno'];
		$femaleper1=$row_ck['femaleper'];
		$oofno1=$row_ck['oofno'];
		$oofper1=$row_ck['oofper'];
		$totalno1=$row_ck['totalno'];
		$totalper1=$row_ck['totalper'];
		$doobr1=$row_ck['doobr'];
		$remarks1=$row_ck['remarks'];*/
		
		
		$sql_sub_sub12="update tbl_qctest set doswdate='$doswdate', dotransplant='$dotr', bedno='$bedno', direction='$direction',  gotlocation='$gotloc', plantpopln='$plantpop', maleno='$maleno', maleper='$maleper', femaleno='$femaleno', femaleper='$femaleper', oofno='$oofno', oofper='$oofper', totalno='$totalno', totalper='$totalper', doobr='$doobr', genpurity='$purity' where tid='".$row_ck[0]."'";
		mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
	//}	
	//exit;//echo "<script>window.location='home_result.php',gotflg=$gotflg
	echo "<script>window.opener.location.href = window.opener.location.href; self.close();</script>";		
}	
//}							

$sql_code="SELECT MAX(arid) FROM tbl_got_update ORDER BY arid DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
		//}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}?>
		
	<!--echo "<script>//window.opener.location.href = window.opener.location.href; self.close();</script>";	-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction-GOT Result Updation</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style></head>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script src="samp.js"></script>
<script type="text/javascript">

/*function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.pdate,dt,document.frmaddDept.pdate, "dd-mmm-yyyy", xind, yind);
	}
	
function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate1,dt,document.frmaddDept.sdate1, "dd-mmm-yyyy", xind, yind);
	}	*/

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  	
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;
	var dtObject;
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
function doschk(date)
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtbedno.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	else
	{
		showCalendar(date);
	}
	
} 	
function chk()
{
	alert("Hiii...");
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtbedno.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtbedno.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	return true;
}
function dotchk(dotdate)
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.trdate.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	else if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.trdate.value="";
		document.frmaddDept.pdate1.focus();
		return false;
 	}
	else
	{
		showCalendar(dotdate);
	}
	
}
function dirchk()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.pdate1.focus();
		return false;
 	}
	return true;
}
function locchk()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	return true;
}
function plantpop()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	return true;
}
function doobchk(dotdate)
{
	//alert("Hiii...");
	/*if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}*/
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(document.frmaddDept.txtno.value=="")
	{
		alert("Please Insert Male no.");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtno.focus();
		return false;
 	}
	if(document.frmaddDept.txtno1.value=="")
	{
		alert("Please Insert Female no.");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtno1.focus();
		return false;
 	}
	if(document.frmaddDept.txtoofno.value=="")
	{
		alert("Please Insert OOF no.");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.oofno.focus();
		return false;
 	}
	else
	{
		showCalendar(dotdate);
	}
	return true;
}
function gotres()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.result.value="";
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	return true;
}
function resdate(rdate)
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.result.value="";
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(document.frmaddDept.result.value=="")
 	{
		alert("Please Select GOT Result");
		//document.frmaddDept.result.value="";
		document.frmaddDept.result.focus();
		return false;
 	}
	else
	{
		showCalendar(rdate);
	}
	return true;
}
function authorised()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.pdate1.value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.result.value="";
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(document.frmaddDept.result.value=="")
 	{
		alert("Please Select the GOT Result");
		//document.frmaddDept.result.value="";
		document.frmaddDept.result.focus();
		return false;
 	}
	if(document.frmaddDept.sdate.value=="")
 	{
		alert("Please Select GOT Result Date");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.sdate.focus();
		return false;
 	}
	return true;
}
function mySubmit()
{
	var dt1=getDateObject(document.frmaddDept.pdate1.value,"-");
	var dt2=getDateObject(document.frmaddDept.sdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.dosdate.value!="--")
	var dt4=getDateObject(document.frmaddDept.dosdate.value,"-");
	else
	var dt4=getDateObject(document.frmaddDept.doscdate.value,"-");
	
	var dt5=getDateObject(document.frmaddDept.obdate.value,"-");
	
	
	var f=0;
	//alert(dt1);alert(dt2);alert(dt3);alert(dt4);
	alert(dt4);
	if(dt1 > dt3)
	{
	alert("Date of Sowing cannot be more or equal to todays date.");
	f=1;
	return false;
	}
	if(dt1 < dt4)
	{
	alert("Date of Sowing can be more than Date of Sample Dispatch (DOSD).");
	f=1;
	return false;
	}
	if(dt1 == dt2)
	{
	alert("Please check. Date of Sowing and Date of GOT Result cannot be same");
	f=1;
	return false;
	}
	if(dt2 <= dt1)
	{
	alert("Please check. Date of GOT Result cannot be less than or equal to Date of Sowing");
	f=1;
	return false;
	}
	if(dt2 > dt3)
	{
	alert("Please check. Date of GOT Result cannot be more than Today");
	f=1;
	return false;
	}
	
 if(document.frmaddDept.txtloc.value=="")
 {
	alert("Please enter GOT Doc. Ref No.");
	document.frmaddDept.txtloc.focus();
	f=1;
	return false;
 }	
 if(document.frmaddDept.txtno.value=="")
	{
		alert("Please Insert Male no.");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtno.focus();
		return false;
 	}
	if(document.frmaddDept.txtno1.value=="")
	{
		alert("Please Insert Female no.");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtno1.focus();
		return false;
 	}
	if(document.frmaddDept.txtoofno.value=="")
	{
		alert("Please Insert OOF no.");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtoofno.focus();
		return false;
 	}
 if(document.frmaddDept.txtdirection.value=="")
 {
	alert("Please Select the Direction");
	document.frmaddDept.txtdirection.focus();
	f=1;
	return false;
 }	
 if(document.frmaddDept.txtlocation.value=="")
 {
	alert("Please Select Location");
	document.frmaddDept.txtlocation.focus();
	f=1;
	return false;
 }
 if(document.frmaddDept.txtplantpopn.value=="")
 {
	alert("Please Insert Plant Population");
	document.frmaddDept.txtplantpopn.focus();
	f=1;
	return false;
 }
	if(document.frmaddDept.txtgenpurity.value=="")
	{
		alert("Please enter Genetic Purity %");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>100 || document.frmaddDept.txtgenpurity.value<0))
	{
		alert("Invalid Genetic Purity %. Value cannot be more than 100");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}
	 /*if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>99 && document.frmaddDept.result.value=="Fail"))
	{
		alert("Cannot update GOT Result as FAIL for Genetic Purity % more than 99");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}*/		
	/*if(document.frmaddDept.txttotal.value=="")
	{
		alert("Please Enter  GOT Result Authorised BY");
		document.frmaddDept.txttotal.focus();
		f=1;
		return false;
	}*/		
	
	if(f==0)
	{
		if(document.frmaddDept.result.value=="Fail")
		{
			if(confirm('You  are selecting \nGOT Result: FAIL \nLot Number: '+document.frmaddDept.txtlot.value+'\nDo you wish to continue?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
		}
		else if(document.frmaddDept.result.value=="RT")
		{
		//document.frmaddDept.pdate1.value=="";
		document.frmaddDept.txtloc.value=="";
		document.frmaddDept.txttotal.value=="";

			if(confirm('You  are selecting \nGOT Result: RETEST \nLot Number: '+document.frmaddDept.txtlot.value+'\nIf GOT Result Retest is selected then Values cannot be filled\nDo you wish to continue?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
		}
		else
		{
			if(confirm('You  are selecting \nGOT Result: '+document.frmaddDept.result.value+'\nLot Number: '+document.frmaddDept.txtlot.value+'\nDo you wish to continue?')==true)
			return true;
			else
			return false;
		}
	}
	else
	{
	return false;
	}	
}	

function genchk(genval)	
{
 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>100 || document.frmaddDept.txtgenpurity.value<0))
	{
		alert("Invalid Genetic Purity %. Value cannot be more than 100");
		document.frmaddDept.txtgenpurity.focus();
		//f=1;
		return false;
	}
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>99 && document.frmaddDept.result.value=="Fail"))
	{
		alert("Cannot update GOT Result as FAIL for Genetic Purity % more than 99");
		document.frmaddDept.txtgenpurity.focus();
		//f=1;
		return false;
	}		
}
function malepercal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var maleno = document.frmaddDept.txtno.value;
	var femaleno = document.frmaddDept.txtno1.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	//alert(tatalno);
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(clasval);
		}
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(femaleno);
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(oofno);
		}
		//alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
	}
	else
	{
		alert("You Can not keep blank Male No.");
		return false;
	}
}
function femalecal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var maleno = document.frmaddDept.txtno.value;
	var femaleno = document.frmaddDept.txtno1.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(clasval);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(femaleno);
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(oofno);
		}
		alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
	}
	else
	{
		alert("You Can not keep blank Female No.");
		return false;
	}
}
function oofcal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var maleno = document.frmaddDept.txtno.value;
	var femaleno = document.frmaddDept.txtno1.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(clasval);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(femaleno);
		}
		else
		{
			alert("You Can not keep blank Female No.");
			return false;
		}	
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			tatalno=tatalno+parseInt(oofno);
		}
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
	}
	else
	{
		alert("You Can not keep blank Female No.");
		return false;
	}
}
function retest1(clasval)	
{
	showUser(clasval,'retestdiv','gotretest','','','','',''); 	
}
</script>

<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
		</br>		</br>
		<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
//echo "SELECT * FROM tbl_qctest where tid='".$a."' ";
$quer3=mysqli_query($link,"SELECT * FROM tbl_qctest where tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['lotno'];
$oldlot=$noticia['oldlot'];
//echo "select * from tbl_qctest where lotno='".$a."'";
$sql_month=mysqli_query($link,"select * from tbl_qctest where lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['sampleno'];
 $sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
  $tp22=$row['trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>


		<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >GOT Data and Result Update</td>
          </tr>

		           
		  <!-- /*</table>
		   <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > */-->
		 
 
  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtstfp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>"onchange="upschk(this.value);" id="itm"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"style="background-color:#CCCCCC" readonly="true" value="<?php echo $variety;?>"/>
      &nbsp;</td>
           </tr>
		   <tr class="Dark" height="25">
            <td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $a?>"/>&nbsp;<input type="hidden" name="oldlot" value="<?php echo $oldlot;?>" /></td>
			  
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtstage" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp22?>"/>&nbsp;</td>
           </tr>
	 <!--
 

<td align="right"  valign="middle" class="tblheading">Sample No.  &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="txtstfp2" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" value="<?php echo $tp1?><?php echo $yearid_id?>/00000<?php echo $qc1?><?php echo $sap;?>"/>  &nbsp;</td>
  </tr>-->
		<?php  
	$tdates=$row['srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear;
	
	$sowdate=$row['doswdate'];
	$tyear=substr($sowdate,0,4);
	$tmonth=substr($sowdate,5,2);
	$tday=substr($sowdate,8,2);
	$sowdate=$tday."-".$tmonth."-".$tyear;
	
	$transdate=$row['dotransplant'];
	$tyear=substr($transdate,0,4);
	$tmonth=substr($transdate,5,2);
	$tday=substr($transdate,8,2);
	$transdate=$tday."-".$tmonth."-".$tyear; 
	

?>
<tr class="Dark" height="30">
<td width="196" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="196" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
<td width="173" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
          </tr>
		   <tr class="Dark" height="30">


<td width="196" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td>
<!--<td align="right"  valign="middle" class="tblheading">GOT Doc Ref No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td> -->           
</tr>
  
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Date of Sowing&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="pdate1" id="pdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $sowdate;?>" style="background-color:#EFEFEF"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('pdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	          
<td align="right" valign="middle" class="tblheading">Date of Transplant&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="trdate" id="trdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $transdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('trdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Bed No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  >&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td  align="right"  valign="middle" class="tblheading">Direction&nbsp;</td><td align="left" valign="middle" class="tbltext" id="direction">&nbsp;<select class="tbltext" name="txtdirection" style="width:100px;" onchange="dirchk()">
    <option value="<?php echo $row['direction'];?>" selected><?php echo $row['direction'];?></option>
  	<option value="East" >East</option>
	<option value="West" >West</option>
	<option value="North" >North</option>
    <option value="South" >South</option>
	<option value="E-W" >E-W</option>
	<option value="E-N" >E-N</option>
	<option value="E-S" >E-S</option>
	<option value="W-E" >W-E</option>
	<option value="W-N" >W-N</option>
	<option value="W-S" >W-S</option>
	<option value="N-E" >N-E</option>
	<option value="N-W" >N-W</option>
	<option value="N-S" >N-S</option>
	<option value="S-E" >S-E</option>
	<option value="S-W" >S-W</option>
	<option value="S-N" >S-N</option>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">GOT Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtlocation" style="width:100px;" >
    <option value="<?php echo $row['gotlocation'];?>" selected><?php echo $row['gotlocation'];?></option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
    <option value="BL" >BL</option>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
<td align="right" valign="middle" class="tblheading">Plant Population&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;(No. of Plants)</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading"><?php if($crop!="Cluster Bean"){?>Male&nbsp;<?php }else{?>Desi Type&nbsp;<?php }?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="malepercal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading"><?php if($crop!="Cluster Bean"){?>Female&nbsp;<?php }else{?>Branching&nbsp;<?php }?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtno1" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="femalecal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtper1" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">OOF&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoofno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="oofcal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtoofper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;
  <input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>

<td width="154" align="right" valign="middle" class="tblheading">Date of Observation&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="obdate" id="obdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="doobchk('obdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading" colspan="2">Retest&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;Yes&nbsp;<input name="retest" id="retest" type="radio" size="10" class="tbltext" tabindex="0" value="yes" onclick="retest1(this.value)"/>&nbsp;No&nbsp;<input name="retest" id="retest" type="radio" size="10" class="tbltext" tabindex="0" value="no" checked="checked"/></td>
</tr>
</table>
<div id="retestdiv">
<!--<input type="hidden" name="sdate" value="" >-->
<input type="hidden" name="txtloc" value="" > 
</div>

<input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
<input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
</tr>
</table>-->
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;<input type="hidden" name="txtsamp" value="<?php echo $sampl?>" /></td>
</tr>
</table>		
<!--<table cellpadding="5" cellspacing="5" border="0" width="750">
    <tr >
      <td align="center" colspan="3"><img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;
        <input name="submit" type="image" style="display:inline;cursor:pointer;"onclick="return mySubmit();" src="../images/preview.gif" alt="Submit Value" border="0"/>
        <input type="hidden" name="txtsamp" value="<?php echo $sampl?>" /></td>
    </tr>
  </table>-->
</form>
</td></tr>
</table>

</body>
</html>
