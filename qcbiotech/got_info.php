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
$tid=$a;
	$otid2="";
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
	$a=$otid2;
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
	$totalno= $_POST['txttotalno'];
	$totalper= $_POST['txttotalper'];
	$doobr= $_POST['txtdoobr'];
	//if($result=="BL")$purity='';
	
	$tdate22=explode("-",$e);
	$tdate=$tdate22[2]."-".$tdate22[1]."-".$tdate22[0];
	
	$ddate=explode("-",$dos);
	$doswdate=$ddate[2]."-".$ddate[1]."-".$ddate[0];
	//exit;
	
	$xamp=str_split($samp);
	$plcode=$xamp[0];
	$yrcd=$xamp[1];
	$smpcode=$xamp[2].$xamp[3].$xamp[4].$xamp[5].$xamp[6].$xamp[7];
	
	
	$sql_ck1=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='$smpcode' and yearid='$yrcd'") or die(mysqli_error($link));
	$row_ck1=mysqli_fetch_array($sql_ck1);
	$sql_ck=mysqli_query($link,"select * from tbl_qctest where tid='".$row_ck1[0]."'") or die(mysqli_error($link));
	while($row_ck=mysqli_fetch_array($sql_ck))
	{
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
		
		$sql_sub_sub12="update tbl_qctest set doswdate='$doswdate', dotransplant='$dotr', bedno='$bedno', direction='$direction',  gotlocation='$gotloc', plantpopln='$plantpop', maleno='$maleno', maleper='$maleper', femalepno='$femaleno', femaleper='$femaleper', oofno='$oofno', oofper='$oofper', totalno='$totalno', totalper='$totalper', doobr='$doobr', gotstatus='$result', gotdate='$tdate', genpurity='$purity', gotflg=1 where tid='".$row_ck1[0]."'";
		mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
		$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_genpurity='$purity' where orlot='$oldlot22'";
		$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
		$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_genpurity='$purity' where orlot='$oldlot22'";
		$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	}	
	//exit;//echo "<script>window.location='home_result.php'
	echo "<script>window.opener.location.href = window.opener.location.href; self.close();</script>";		
}						

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
function doobchk()
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
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtplantpopn.focus();
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
	//alert(document.frmaddDept.result.value);
	/*if(document.frmaddDept.txtloc.value=="")
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
 	}*/
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
	/*if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}*/
	/*if(document.frmaddDept.pdate1.value=="")
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
 	}*/
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
 /*if(document.frmaddDept.txtbedno.value=="")
 {
	alert("Please Insert the Bed No.");
	document.frmaddDept.txtbedno.focus();
	f=1;
	return false;
 }*/
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
 if(document.frmaddDept.result.value=="")
	{
		alert("Please Select GOT Result");
		document.frmaddDept.result.focus();
		f=1;
		return false;
	}	
	if((document.frmaddDept.result.value=="OK" || document.frmaddDept.result.value=="Fail") && document.frmaddDept.txtgenpurity.value=="")
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
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>99 && document.frmaddDept.result.value=="Fail"))
	{
		alert("Cannot update GOT Result as FAIL for Genetic Purity % more than 99");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDept.txttotal.value=="")
	{
		alert("Please Enter  GOT Result Authorised BY");
		document.frmaddDept.txttotal.focus();
		f=1;
		return false;
	}		
	
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

$quer3=mysqli_query($link,"SELECT * FROM tbl_qctest where tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['lotno'];
$oldlot=$noticia['oldlot'];

$sql_month=mysqli_query($link,"select * from tbl_qctest where lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);

$sql_spcode=mysqli_query($link,"select * from tblarrival_sub where orlot='".$row['gottest_oldlot']."'") or die(mysqli_error($link));
$row_spcode=mysqli_fetch_array($sql_spcode);
$grade=$row['grade'];

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


		<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
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

<td width="175" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampl" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sap;?>" maxlength="20"/>&nbsp;</td>        
</tr> 

<tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Male&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtspcodem" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodem'];?>" maxlength="10"/>&nbsp;</td>
	
	<td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Female&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtspcodef" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodef'];?>" maxlength="10"/>&nbsp;</td>
</tr>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;Grade&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtspcodem" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $grade;?>" maxlength="10"/>&nbsp;</td>
  </tr>

</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<?php
$sql_s=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."'") or die(mysqli_error($link));
while($rows=mysqli_fetch_array($sql_s))
{
	if($rows['gottests_type']=="IN-SITU")
	{
	?>		  
		<tr class="Dark" height="30">
		<td width="176" height="32" align="right"  valign="middle" class="tblheading">IN-SITU&nbsp;</td>
		<td width="216" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="" checked="checked" disabled="disabled"/></td>
		<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
			<td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $rows['gottests_noofrefl']?></td>
		</tr>
	<?php 
	}
	if($rows['gottests_type']=="IN-TERRA")
	{
	?>		  
		<tr class="Dark" height="30">
		<td width="176" height="32" align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
		<td width="216" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="" checked="checked" disabled="disabled"/></td>
		<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
			<td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $rows['gottests_noofrefl']?></td>
		</tr>
	<?php 
	}
}
	?>		   
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-SITU : DNA - Replication <?php echo $srno?></td>
</tr>
<?php $step2="PCR";?>
<tr class="Dark" height="25">
	<td width="166" align="center" valign="middle" class="tblheading">Sample Reciept Date</td>
	<td width="167" align="center" valign="middle" class="tblheading">DNA Extraction Date</td>
	<td width="143" align="center" valign="middle" class="tblheading">DNA Extracted From</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">DNA Extraction Method</td>
	<td width="86" align="center" valign="middle" class="tblheading">Sample Age</td>
</tr>
<?php
$sql_s1=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$rows1=mysqli_fetch_array($sql_s1);

$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows1['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
while($rowss1= mysqli_fetch_array($sql_ss1))
{
	$rdate=""; $exdate="";

	$rdate=$rowss1['gottestss_samprecdate'];
	$tyear=substr($rdate,0,4);
	$tmonth=substr($rdate,5,2);
	$tday=substr($rdate,8,2);
	$rdate1=$tday."-".$tmonth."-".$tyear;
	
	$exdate=$rowss1['gottestss_dnaextdate'];
	$tyear=substr($exdate,0,4);
	$tmonth=substr($exdate,5,2);
	$tday=substr($exdate,8,2);
	$exdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="166" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="167" align="center" valign="middle" class="smalltbltext"><?php echo $exdate1;?></td>
	<td width="143" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
</tr>
<?php
}
?>
</table><br />
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-SITU : PCR Analysis</td>
</tr>
<tr class="Dark" height="25">
	<td width="208" align="center" valign="middle" class="tblheading" rowspan="2">PCR Analysis Date</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Marker</td>
</tr>
<tr class="Dark" height="25">
	<td width="263" align="center" valign="middle" class="tblheading">Number</td>
	<td width="234" align="center" valign="middle" class="tblheading">Type</td>
	<td width="235" align="center" valign="middle" class="tblheading">Name</td>
</tr>
<?php

$sql_s2=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$rows2=mysqli_fetch_array($sql_s2);

$sql_ss2=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows2['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
while($rowss2= mysqli_fetch_array($sql_ss2))
{

$sql_sss=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$rowss2['gottestss_id']."'")or die(mysqli_error($link));
$rowsss= mysqli_fetch_array($sql_sss);
$pdate="";
	$pdate=$rowsss['gottestss2_pcrdate'];
	$tyear=substr($pdate,0,4);
	$tmonth=substr($pdate,5,2);
	$tday=substr($pdate,8,2);
	$pdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="208" align="center" valign="middle" class="smalltbltext"><?php echo $pdate1?></td>
	<td width="263" align="center" valign="middle" class="smalltbltext"><?php echo $rowsss['gottestss2_mnumber'];?></td>
	<td width="234" align="center" valign="middle" class="smalltbltext"><?php echo $rowsss['gottestss2_mtype'];?></td>
	<td width="235" align="center" valign="middle" class="smalltbltext"><?php echo $rowsss['gottestss2_mname'];?></td>
</tr>
<?php }?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="18" align="center" class="tblheading" id="rephead">IN-SITU : GEA</td>
</tr>
<?php $step2="PCR";?>
<tr class="Dark" height="25">
	<td width="36" align="center" valign="middle" class="tblheading" rowspan="2">GEA Date</td>
	<td width="51" align="center" valign="middle" class="tblheading" rowspan="2">Sample Size</td>
	<td width="57" align="center" valign="middle" class="tblheading" rowspan="2">Samples Not Amplified</td>
	<td width="58" align="center" valign="middle" class="tblheading" rowspan="2">Amplified Samples</td>
	<td width="37" align="center" valign="middle" class="tblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Male No.&nbsp;<?php }else{?>Desi Type No.&nbsp;<?php }?></td>
	<td width="30" align="center" valign="middle" class="tblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Male %&nbsp;<?php }else{?>Desi Type %&nbsp;<?php }?></td>
	<td width="61" align="center" valign="middle" class="tblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Female No.&nbsp;<?php }else{?>Branching No.&nbsp;<?php }?></td>
	<td width="61" align="center" valign="middle" class="tblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Female %&nbsp;<?php }else{?>Branching %&nbsp;<?php }?></td>
	<td width="56" align="center" valign="middle" class="tblheading" rowspan="2">Outcross No.</td>
	<td width="56" align="center" valign="middle" class="tblheading" rowspan="2">Outcross %</td>
	<td width="27" align="center" valign="middle" class="tblheading" rowspan="2">OOF No.</td>
	<td width="33" align="center" valign="middle" class="tblheading" rowspan="2">OOF %</td>
	<td width="53" align="center" valign="middle" class="tblheading" rowspan="2">Total No.</td>
	<td width="43" align="center" valign="middle" class="tblheading" rowspan="2">Total %</td>
	<td width="54" align="center" valign="middle" class="tblheading" rowspan="2">Genetic Purity % </td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Base Pair Size</td>
</tr>
<tr class="Dark" height="25">
	<td width="68" align="center" valign="middle" class="tblheading">Male</td>
	<td width="67" align="center" valign="middle" class="tblheading">Female</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Hybrid</td>
</tr>
<?php
$sql_s1=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$rows1=mysqli_fetch_array($sql_s1);

$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows1['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
while($rowss1= mysqli_fetch_array($sql_ss1))
{
	$rdate=""; $exdate="";

	$rdate=$rowss1['gottestss_samprecdate'];
	$tyear=substr($rdate,0,4);
	$tmonth=substr($rdate,5,2);
	$tday=substr($rdate,8,2);
	$rdate1=$tday."-".$tmonth."-".$tyear;
	
	$exdate=$rowss1['gottestss_dnaextdate'];
	$tyear=substr($exdate,0,4);
	$tmonth=substr($exdate,5,2);
	$tday=substr($exdate,8,2);
	$exdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $exdate1;?></td>
	<td width="57" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
	<td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $exdate1;?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td width="27" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="33" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="67" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
	<td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
</tr>
<?php
}
?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-TERRA : Sowing</td>
</tr>
<?php $step1="PCR";?>
<tr class="Dark" height="25">
	<td width="282" align="center" valign="middle" class="tblheading">Date of Sowing</td>
	<td width="339" align="center" valign="middle" class="tblheading">Sowing Plot</td>
	<td width="321" align="center" valign="middle" class="tblheading"><?php if($crop=="Paddy Seed" || $crop=="Maize Seed" || $crop=="Pearl Millet"){?>No. of Rows<?php }else{?>No. of Seeds<?php }?></td>
</tr>
<?php
$rdate=""; $exdate="";
$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottestss_id='".$gotssid."'")or die(mysqli_error($link));
$rowss1= mysqli_fetch_array($sql_ss1);

	$sdate=$rowss1['gottestss_doswdate'];
	$tyear=substr($sdate,0,4);
	$tmonth=substr($sdate,5,2);
	$tday=substr($sdate,8,2);
	$sdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="282" align="center" valign="middle" class="smalltbltext"><?php echo $sdate1;?></td>
	
	<td width="339" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_swoingplot']?></td>
	
	<td width="321" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_noofrows'];?></td>
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-TERRA : Transplanting </td>
</tr>
<tr class="Dark" height="25">
	<td width="116" align="center" valign="middle" class="tblheading">Date of Transplant</td>
	<td width="91" align="center" valign="middle" class="tblheading">Transplant Plot</td>
	<td width="87" align="center" valign="middle" class="tblheading">Range</td>
	<td width="95" align="center" valign="middle" class="tblheading">No. of Rows</td>
	<td width="94" align="center" valign="middle" class="tblheading">Bed no.</td>
	<td width="118" align="center" valign="middle" class="tblheading">Direction</td>
	<td width="119" align="center" valign="middle" class="tblheading">State</td>
	<td width="116" align="center" valign="middle" class="tblheading">Location</td>
	<td width="94" align="center" valign="middle" class="tblheading">No. of Plants</td>
</tr>
<tr class="Light" height="20">
	<td width="116" align="center" valign="middle" class="smalltbltext"></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"></td>
	<td width="87" align="center" valign="middle" class="smalltbltext"></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"></td>
	<td width="94" align="center" valign="middle" class="smalltbltext"></td>
	<td width="118" align="center" valign="middle" class="smalltbltext"></td>
	<td width="119" align="center" valign="middle" class="smalltbltext"></td>
	<td width="116" align="center" valign="middle" class="smalltbltext" id="itmloc"></td>
	<td width="94" align="center" valign="middle" class="smalltbltext"></td>
</tr>
</table><br />
<?php 
if($crop!="Maize Seed" || $crop!="Pearl Millet" || $crop!="Paddy Seed")
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" >Obsevations</td>
</tr>
<tr class="Dark" height="30">
<td width="17" align="center" valign="middle" class="tblheading">#</td>
<td width="74" align="center" valign="middle" class="tblheading">Plant Population</td>
 <td width="72" align="center" valign="middle" class="tblheading">Male/Desi Type No.</td>
  <td width="58" align="center" valign="middle" class="tblheading">Male/Desi Type %</td>
 <td width="102" align="center" valign="middle" class="tblheading">Female/Branching</td>
  <td width="117" align="center" valign="middle" class="tblheading">Female/Branching %</td>
 <td width="34" align="center" valign="middle" class="tblheading">OOF</td>
  <td width="43" align="center" valign="middle" class="tblheading">OOF %</td>
 <td width="31" align="center" valign="middle" class="tblheading">Total</td>
   <td width="45" align="center" valign="middle" class="tblheading">Total %</td>
 <td width="56" align="center" valign="middle" class="tblheading">Genetic Purity %</td>
 <td width="75" align="center" valign="middle" class="tblheading">Date of Observation</td>
</tr>

<tr class="Light" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="74"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_plantpopln'];?></td>
	<td width="72"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_maleno'];?></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_maleper'];?></td>
	<td width="102" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_femaleno'];?></td>
	<td width="117" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_femaleper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_oofno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_oofper'];?></td>
	<td width="31"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_totno'];?></td>
	<td width="45"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_totper'];?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_genpurity'];?></td>
	<td width="75" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate1;?></td>
</tr>
<tr class="Light" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="74"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_plantpopln'];?></td>
	<td width="72"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_maleno'];?></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_maleper'];?></td>
	<td width="102" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_femaleno'];?></td>
	<td width="117" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_femaleper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_oofno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_oofper'];?></td>
	<td width="31"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_totno'];?></td>
	<td width="45"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_totper'];?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss3_genpurity'];?></td>
	<td width="75" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate1;?></td>
</tr>
</table><br />
<?php
} 
if($crop=="Maize Seed" || $crop=="Pearl Millet")
{
?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="14" align="center" class="tblheading" >Obsevations</td>
</tr>
<tr class="Dark" height="30">
<td width="17" align="center" valign="middle" class="tblheading">#</td>
<td width="74" align="center" valign="middle" class="tblheading">Plant Population</td>
 <td width="72" align="center" valign="middle" class="tblheading">Male/Desi Type No.</td>
  <td width="58" align="center" valign="middle" class="tblheading">Male/Desi Type %</td>
 <td width="102" align="center" valign="middle" class="tblheading">Female/Branching</td>
  <td width="117" align="center" valign="middle" class="tblheading">Female/Branching %</td>
   <td width="34" align="center" valign="middle" class="tblheading">Tall Plant</td>
  <td width="43" align="center" valign="middle" class="tblheading">Tall Plant %</td>
 <td width="34" align="center" valign="middle" class="tblheading">OOF</td>
  <td width="43" align="center" valign="middle" class="tblheading">OOF %</td>
 <td width="31" align="center" valign="middle" class="tblheading">Total</td>
   <td width="45" align="center" valign="middle" class="tblheading">Total %</td>
 <td width="56" align="center" valign="middle" class="tblheading">Genetic Purity %</td>
 <td width="75" align="center" valign="middle" class="tblheading">Date of Observation</td>
</tr>
<tr class="Dark" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="74"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['plantpopl'];?></td>
	<td width="72"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['maleno'];?></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['maleper'];?></td>
	<td width="102" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['femaleno'];?></td>
	<td width="117" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['femaleper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tallplantno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tallplantper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['oofno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['oofper'];?></td>
	<td width="31"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['totalno'];?></td>
	<td width="45"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['totalper'];?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss4_genpurity'];?></td>
	<td width="79" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="74"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['plantpopl'];?></td>
	<td width="72"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['maleno'];?></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['maleper'];?></td>
	<td width="102" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['femaleno'];?></td>
	<td width="117" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['femaleper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tallplantno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tallplantper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['oofno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['oofper'];?></td>
	<td width="31"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['totalno'];?></td>
	<td width="45"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['totalper'];?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss4_genpurity'];?></td>
	<td width="79" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
</table><br />
<?php 
} 
if($crop=="Paddy Seed")
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="22" align="center" class="tblheading" >Obsevations</td>
</tr>

<tr class="Dark" height="30">
<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
 <td width="64" align="center" valign="middle" class="tblheading" rowspan="2">Plant Population</td>
 <td width="37" align="center" valign="middle" class="tblheading" colspan="4">Early</td>
 <td width="32" align="center" valign="middle" class="tblheading" colspan="2">Sterile</td>
 <td width="35" align="center" valign="middle" class="tblheading" colspan="6">Other Off Types</td>
  <td width="39" align="center" valign="middle" class="tblheading" rowspan="2">Total</td>
 <td width="52" align="center" valign="middle" class="tblheading" rowspan="2">Genetic Purity</td>
 <td width="69" align="center" valign="middle" class="tblheading" rowspan="2">Date of Observation</td>
</tr>
<tr class="Dark" height="30">
 <td width="37" align="center" valign="middle" class="tblheading">1010</td>
 <td width="38" align="center" valign="middle" class="tblheading">Red Tip</td>
 <td width="48" align="center" valign="middle" class="tblheading">Early Fine Grain</td>
 <td width="37" align="center" valign="middle" class="tblheading">Other</td>
 <td width="32" align="center" valign="middle" class="tblheading">A Line</td>
 <td width="35" align="center" valign="middle" class="tblheading">Out Cross</td>
 <td width="30" align="center" valign="middle" class="tblheading">B Line</td>
 <td width="35" align="center" valign="middle" class="tblheading">Long Grain</td>
 <td width="37" align="center" valign="middle" class="tblheading">Fine Grain</td>
 <td width="39" align="center" valign="middle" class="tblheading">Bold Grain</td>
 <td width="39" align="center" valign="middle" class="tblheading">Tall Plants</td>
 <td width="41" align="center" valign="middle" class="tblheading">Late Plants</td>
</tr>
<tr class="Light" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="64"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['plantpopl'];?></td>
	<td width="37"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tentenno'];?></td>
	<td width="38" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['redtpno'];?></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['finegrainno'];?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['otherno'];?></td>
	<td width="32"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['alineno'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['outcrno'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['blineno'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['longgrainno'];?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['ootfinegrainno'];?></td>
	<td width="39" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['boldgrainno'];?></td>
	<td width="39" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tallplantno'];?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['lateplantno'];?></td>
	<td width="39"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['totalno'];?></td>
	<td width="52"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss4_genpurity'];?></td>
	<td width="69" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
<tr class="Light" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="64"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['plantpopl'];?></td>
	<td width="37"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tentenno'];?></td>
	<td width="38" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['redtpno'];?></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['finegrainno'];?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['otherno'];?></td>
	<td width="32"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['alineno'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['outcrno'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['blineno'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['longgrainno'];?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['ootfinegrainno'];?></td>
	<td width="39" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['boldgrainno'];?></td>
	<td width="39" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['tallplantno'];?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['lateplantno'];?></td>
	<td width="39"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['totalno'];?></td>
	<td width="52"align="center" valign="middle" class="smalltbltext"><?php echo $rowss3['gottestss4_genpurity'];?></td>
	<td width="69" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
</table><br />
<?php 
}
?>
<input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
<input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;<!--<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />-->&nbsp;&nbsp;<input type="hidden" name="txtsamp" value="<?php echo $sampl?>" /></td>
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
