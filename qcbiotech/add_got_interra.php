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
	if(isset($_GET['tid']))
	{
		$a = $_GET['tid'];	 
	}
	if(isset($_GET['insitu']))
	{
		$insitu = $_GET['insitu'];	 
	}
	if(isset($_GET['interra']))
	{
		$interra = $_GET['interra'];	 
	}
	if(isset($_GET['insiturepl']))
	{
		$insiturepl = $_GET['insiturepl'];	 
	}
	if(isset($_GET['interrarepl']))
	{
		$interrarepl = $_GET['interrarepl'];	 
	}
	if(isset($_GET['ssid']))
	{
		$ssid = $_GET['ssid'];	 
	}
	if($ssid!="")
	{
		$sql_abort=mysqli_query($link,"update tbl_gottestsub_sub set gottestss_abortflg=1 where gottestss_id=$ssid")or die(mysqli_error($link));
	}
	
	$tid=$a;
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['sampleno'];
	$olotno2=$row_ck2['lotno'];
	$yearid2=$row_ck2['yearid'];
	//echo "select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc";
	$sql_ck23=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='$olotno2' and gottest_sampleno='$osamp2' and yearid='$yearid2' order by gottest_tid desc") or die(mysqli_error($link));
	$zxzx=mysqli_num_rows($sql_ck23);
	if($zxzx > 0)
	{
	$row_ck23=mysqli_fetch_array($sql_ck23);
	$otid2=$row_ck23['tid'];
	}
	if($otid2!="")
	$a=$otid2;
	
	if($insitu=="yes") $type11="IN-TERRA";
	$sql_sub1=mysqli_query($link,"SELECT * FROM `tbl_gottestsub` where gottest_tid=$tid and gottests_type='IN-TERRA'")or die(mysqli_error($link));
	$row_sub1=mysqli_fetch_array($sql_sub1);
	$tot=mysqli_num_rows($sql_sub1);
	$gots_id=$row_sub1['gottests_id'];
	
	/*if($tot==0)
	{
		$sql_sub="insert into tbl_gottestsub(gottest_tid, gottests_type,gottests_noofrefl) values('$tid','$type11', '$insiturepl')";
		$row_sub=mysqli_query($link,$sql_sub)or die(mysqli_error($link));
		$row=mysqli_fetch_array($row_sub);
		$gots_id=$row['gottests_id'];
	}*/
		
if(isset($_POST['frm_action'])=='submit')
{
	$id=trim($_POST['tid']);
	$interra=trim($_POST['interra']);
	$srno=trim($_POST['srno']);
	$interrarepl=trim($_POST['interrarepl']);
	$gotss_id=trim($_POST['gotidss']);
	
	$step=trim($_POST['step']);
	//exit;
	$recdate1=trim($_POST['recdate']);
	$ddate=explode("-",$recdate1);
	$recdate=$ddate[2]."-".$ddate[1]."-".$ddate[0];
	
	$sowingdate1=trim($_POST['pdate']);
	$ddate1=explode("-",$sowingdate1);
	$sowingdate=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
	$poltno=trim($_POST['txtpoltno']);
	$noseeds=trim($_POST['txtnoseeds']);
	
	$trdate1=trim($_POST['trdate']);
	$ddate2=explode("-",$trdate1);
	$trdate=$ddate2[2]."-".$ddate2[1]."-".$ddate2[0];
	$trplot=trim($_POST['txttrplot']);
	$range=trim($_POST['txtrange']);
	$trrows=trim($_POST['txttrrows']);
	$bedno=trim($_POST['txtbedno']);
	$direction=trim($_POST['txtdirection']);
	$state=trim($_POST['txtstate']);
	$location=trim($_POST['txtlocation']);
	$plantpopn=trim($_POST['txtnoofplants']);
	 
	$gdate1=trim($_POST['gdate']);
	$ddate3=explode("-",$gdate1);
	$gdate=$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
	
	$sampsize=trim($_POST['txtsampsize']);
	$sampnotamp=trim($_POST['txtsampnotamp']);
	$ampsamp=trim($_POST['txtampsamp']);
	$maleno=trim($_POST['txtmaleno']);
	$maleper=trim($_POST['txtmaleper']);
	$femaleno=trim($_POST['txtfemaleno']);
	$femaleper=trim($_POST['txtfemaleper']);
	$outcrno=trim($_POST['txtoutcrno']);
	$outcrper=trim($_POST['txtoutcrper']);
	$oofno=trim($_POST['txtoofno']);
	$oofper=trim($_POST['txtoofper']);
	$totno=trim($_POST['txttotno']);
	$totper=trim($_POST['txttotper']);
	$genpurity=trim($_POST['txtgenpurity']);
	$male=trim($_POST['txtmale']);
	$female=trim($_POST['txtfemale']);
	$hybrid=trim($_POST['txthybrid']);
	//echo $image=trim($_POST['txtimage']);
	$image=$_FILES['image']['name'];
	if($image<>"")
	{
		echo $imagepath="../Uploadimage/$image";
		copy($_FILES['image']['tmp_name'], $imagepath);
	}
	
	//exit;
	if($step=="DNA")
	{
		$sql_sub_sub="insert into tbl_gottestsub_sub(gottest_tid, gottests_id, replno, gottestss_doswdate, gottestss_swoingplot, gottestss_noofrows,dnaflg) values('$id','$gots_id', '$srno', '$sowingdate','$poltno','$noseeds','1')";
		$row_sub_sub=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
	}
	if($step=="PCR")
	{
		$sql_sub_sub1="update tbl_gottestsub_sub set gottestss_dateoftr='$trdate', gottestss_trplot='$trplot', gottestss_range='$range', gottestss_trrows='$trrows', gottestss_bedno='$bedno', gottestss_direction='$direction', gottestss_state='$state', gottestss_gotlocation='$location', gottestss_plantpopln='$plantpopn', pcrflg='1' where gottestss_id='$gotss_id'";
		$row_sub_sub1=mysqli_query($link,$sql_sub_sub1)or die(mysqli_error($link));
		//exit;
	}
	if($step=="GEA")
	{
		/*echo "update tbl_gottestsub_sub2 set gottestss2_gelelctdate='$gdate', gottestss2_samplesize='$sampsize', gottestss2_sampnotamp='$sampnotamp', gottestss2_sampamp='$ampsamp', gottestss2_maleno='$maleno', gottestss2_maleper='$maleper', gottestss2_femaleno='$femaleno', gottestss2_femaleper='$femaleper', gottestss2_outcrossno='$outcrno', gottestss2_outcrossper='$outcrper', gottestss2_oofno='$oofno', gottestss2_oofper='$oofper', gottestss2_totno='$totno', gottestss2_totper='$totper', gottestss2_genpurity='$genpurity', gottestss2_image='$imagepath' where gottestss_id=$gotss_id";
		exit;*/
		$sql_sub_sub2="update tbl_gottestsub_sub2 set gottestss2_gelelctdate='$gdate', gottestss2_samplesize='$sampsize', gottestss2_sampnotamp='$sampnotamp', gottestss2_sampamp='$ampsamp', gottestss2_maleno='$maleno', gottestss2_maleper='$maleper', gottestss2_femaleno='$femaleno', gottestss2_femaleper='$femaleper', gottestss2_outcrossno='$outcrno', gottestss2_outcrossper='$outcrper', gottestss2_oofno='$oofno', gottestss2_oofper='$oofper', gottestss2_totno='$totno', gottestss2_totper='$totper', gottestss2_genpurity='$genpurity', gottestss2_image='$imagepath' where gottestss_id=$gotss_id";
		$row_sub_sub2=mysqli_query($link,$sql_sub_sub2)or die(mysqli_error($link));
		
		$sql_sub_sub22="update tbl_gottestsub_sub set geaflg=1, gottestss_completeflg=1 where gottestss_id=$gotss_id";
		$row_sub_sub22=mysqli_query($link,$sql_sub_sub22)or die(mysqli_error($link));
		
		$sql_sub_sub="update tbl_gottest set gottest_resultflg=1 where gottest_tid=$id";
		$row_sub_sub=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
		
	}
	echo "<script>window.location='add_got_interra.php?tid=$id&interra=$interra&interrarepl=$interrarepl'</script>";
}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script src="samp.js"></script>

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
function chk1()
{
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(dt2 > dt3)
	{
		alert("Sowing Date cannot be more than todays date");
		document.frmaddDept.txtpoltno.value="";
		document.frmaddDept.pdate.focus();
		return false;
	}
	if(document.frmaddDept.txtpoltno.value=="")
	{
		alert("Please enter the nursery plot no.");
		document.frmaddDept.txtnoseeds.value="";
		document.frmaddDept.txtpoltno.focus();
		return false;
	}
}
function datediff(date2, date4)
{
	var diff = abs(strtotime(date2) - strtotime(date4));
	var years = floor(diff / (365*60*60*24));
	var months = floor((diff - years * 365*60*60*24) / (30*60*60*24));
	var days = floor((diff - years * 365*60*60*24 - months*30*60*60*24)/ (60*60*24));
	alert(years);alert(months);alert(days);
	return (days);
	//return Math.round((date2-date4)/(1000*60*60*24));
}
function chk()
{
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	var dt1=getDateObject(document.frmaddDept.dosdate.value,"-");
	var dt4=getDateObject(document.frmaddDept.dateofsowing.value,"-");
	
	//var difference = datediff(document.frmaddDept.pdate.value,document.frmaddDept.dateofsowing.value);
	//$diff1 = abs(strtotime($dt1) < strtotime($dt2));
	var difference = Math.round((dt2-dt4)/(1000*60*60*24));
	//difference=parseInt(difference);
	//alert(difference);
	if(document.frmaddDept.dateofsowing.value!="")
	{
		if(difference>10)
		{
			alert("Invalid Sowing Date : Difference between two replications can not be more than 10 days");
			document.frmaddDept.txtpoltno.value="";
			document.frmaddDept.pdate.focus();
			return false;
		}
	}
	if(dt1 > dt2)
	{
		alert("Invalid Sowing Date : Sowing Date can be equal to or more than Date of Sample Dispatch date");
		document.frmaddDept.txtpoltno.value="";
		document.frmaddDept.pdate.focus();
		return false;
	}
	if(dt2 > dt3)
	{
		alert("Sowing Date cannot be more than todays date");
		document.frmaddDept.txtpoltno.value="";
		document.frmaddDept.pdate.focus();
		return false;
	}
}
function rangechk()
{
	var crop = document.frmaddDept.txtstfp.value;
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.txtrange.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(document.frmaddDept.txttrplot.value=="")
		{
			alert("Please Enter Transplant Plot");
			document.frmaddDept.txtrange.value="";
			document.frmaddDept.txttrplot.focus();
			return false;
		}
	}
}
function trrows()
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.dnaextdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
	}
	return true;
}
function bedno()
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.dnaextdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
	}
	return true;
}
function dirchk()
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.dnaextdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
	}
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	return true;
}
function loc(clasval)
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.dnaextdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
	}
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please enter Direction");
		document.frmaddDept.txtstate.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	else
	{
		showUser(clasval,'itmloc','gotloc','','','','','');
	}
}
function locchk()
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.dnaextdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
	}
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtstate.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtstate.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtstate.focus();
		return false;
 	}
	return true;
}	
function plantpop()
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.trdate.value!="")
	{
		if(dt1 < dt2)
		{
			alert("Transplanting Date Should Be Less Than Sowing Date");
			document.frmaddDept.trdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
		if(dt1 > dt3)
		{
			alert("Transplanting Date cannot be more than todays date");
			document.frmaddDept.dnaextdate.value="";
			document.frmaddDept.trdate.focus();
			return false;
		}
	}
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtstate.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtstate.value=="")
 	{
		alert("Please Select State");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtstate.focus();
		return false;
 	}
	return true;
}
function markertype()
{
	
}
function markername()
{
	var dt1=getDateObject(document.frmaddDept.trdate.value,"-");
	var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	//alert(dt1);
	//alert(dt2);
	if(document.frmaddDept.trdate.value=="")
	{
		alert("Please Insert The Transplanting Date");
		document.frmaddDept.txttrplot.value="";
		document.frmaddDept.trdate.focus();
		return false;
	}
	if(dt1 < dt2)
	{
		alert("Transplanting Date Should Be Greater Than Sowing Date");
		document.frmaddDept.txttrplot.value="";
		document.frmaddDept.trdate.focus();
		return false;
	}
	if(dt1 > dt3)
	{
		alert("Transplanting Date cannot be Greater than todays date");
		document.frmaddDept.txttrplot.value="";
		document.frmaddDept.trdate.focus();
		return false;
	}
}
function sampsize()
{
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	var dt4=getDateObject(document.frmaddDept.pcrdate.value,"-");
	var dt5=getDateObject(document.frmaddDept.gdate.value,"-");
	if(dt5 < dt4)
 	{
		alert("Gel Electrophorasis Analysis Date should be greater than or equal to PCR Analysis Date");
		document.frmaddDept.txtsampsize.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(dt5 > dt3)
 	{
		alert("Gel Electrophorasis Analysis Date cannot be more than todays date");
		document.frmaddDept.txtsampsize.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.gdate.value=="")
 	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.txtsampsize.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value==0)
 	{
		alert("Sample size should be more than zero");
		document.frmaddDept.txtsampsize.value="";
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value > 999)
 	{
		alert("Sample size should be less than 999");
		document.frmaddDept.txtsampsize.value="";
		return false;
 	}
}
function sampnotamp()
{
	var samp=document.frmaddDept.txtsampsize.value;
	var ampnot=document.frmaddDept.txtsampnotamp.value;
	if(document.frmaddDept.gdate.value=="")
 	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.txtsampnotamp.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value=="")
 	{
		alert("Please Enter Sample Size");
		document.frmaddDept.txtsampnotamp.value="";
		document.frmaddDept.txtsampsize.focus();
		return false;
 	}
	if(parseInt(samp) <= parseInt(ampnot))
 	{
		alert("Sample Not Amplified should be less than Sample Size");
		document.frmaddDept.txtsampnotamp.value="";
		return false;
 	}
	else
	{
		document.frmaddDept.txtampsamp.value=parseInt(samp)-parseInt(ampnot);
	}
}	
function malepercal(clasval)	
{
	var ampsamp = document.frmaddDept.txtampsamp.value;
	var maleno = document.frmaddDept.txtmaleno.value;
	var femaleno = document.frmaddDept.txtfemaleno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	//alert(tatalno);
	if(document.frmaddDept.gdate.value=="")
 	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.txmaletno.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value=="")
 	{
		alert("Please Enter Sample Size");
		document.frmaddDept.txmaletno.value="";
		document.frmaddDept.txtsampsize.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampnotamp.value=="")
 	{
		alert("Please Sample Not Amplified");
		document.frmaddDept.txmaletno.value="";
		document.frmaddDept.txtsampnotamp.focus();
		return false;
 	}
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtmaleper.value=parseFloat(maleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(clasval);
		}
		if(femaleno!="")
		{
			document.frmaddDept.txtfemaleper.value=parseFloat(femaleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(femaleno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(oofno);
		}
		//alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(ampsamp);
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
	var ampsamp = document.frmaddDept.txtampsamp.value;
	var maleno = document.frmaddDept.txtmaleno.value;
	var femaleno = document.frmaddDept.txtfemaleno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	
	if(document.frmaddDept.gdate.value=="")
 	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.txtfemaleno.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value=="")
 	{
		alert("Please Enter Sample Size");
		document.frmaddDept.txtfemaleno.value="";
		document.frmaddDept.txtsampsize.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampnotamp.value=="")
 	{
		alert("Please Sample Not Amplified");
		document.frmaddDept.txtfemaleno.value="";
		document.frmaddDept.txtsampnotamp.focus();
		return false;
 	}
	
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtmaleper.value=parseFloat(maleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(maleno);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtfemaleper.value=parseFloat(femaleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(femaleno);
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(oofno);
		}
		//alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(ampsamp);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
	}
	else
	{
		alert("You Can not keep blank Female No.");
		return false;
	}
}
function outcrcal(clasval)	
{
	var ampsamp = document.frmaddDept.txtampsamp.value;
	var maleno = document.frmaddDept.txtmaleno.value;
	var femaleno = document.frmaddDept.txtfemaleno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	
	if(document.frmaddDept.gdate.value=="")
 	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.txtoutcrno.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value=="")
 	{
		alert("Please Enter Sample Size");
		document.frmaddDept.txtoutcrno.value="";
		document.frmaddDept.txtsampsize.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampnotamp.value=="")
 	{
		alert("Please Sample Not Amplified");
		document.frmaddDept.txtoutcrno.value="";
		document.frmaddDept.txtsampnotamp.focus();
		return false;
 	}
	
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtmaleper.value=parseFloat(maleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(maleno);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtfemaleper.value=parseFloat(femaleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(femaleno);
		}
		else
		{
			alert("You Can not keep blank Female No.");
			return false;
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(outcrno);
		}	
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(oofno);
		}
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(ampsamp);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
	}
	else
	{
		alert("You Can not keep blank Outcross No.");
		return false;
	}
}
function oofcal(clasval)	
{
	var ampsamp = document.frmaddDept.txtampsamp.value;
	var maleno = document.frmaddDept.txtmaleno.value;
	var femaleno = document.frmaddDept.txtfemaleno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	
	if(document.frmaddDept.gdate.value=="")
 	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.txtoofno.value="";
		document.frmaddDept.gdate.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampsize.value=="")
 	{
		alert("Please Enter Sample Size");
		document.frmaddDept.txtoofno.value="";
		document.frmaddDept.txtsampsize.focus();
		return false;
 	}
	if(document.frmaddDept.txtsampnotamp.value=="")
 	{
		alert("Please Sample Not Amplified");
		document.frmaddDept.txtoofno.value="";
		document.frmaddDept.txtsampnotamp.focus();
		return false;
 	}
	
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtmaleper.value=parseFloat(maleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(maleno);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtfemaleper.value=parseFloat(femaleno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(femaleno);
		}
		else
		{
			alert("You Can not keep blank Female No.");
			return false;
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(outcrno);
		}	
		else
		{
			alert("You Can not keep blank Outcross No.");
			return false;
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(ampsamp);
			tatalno=tatalno+parseInt(oofno);
		}
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(ampsamp);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
	}
	else
	{
		alert("You Can not keep blank Oof Type No.");
		return false;
	}
}
function upschk1()
{
	//alert("Hi...");
	if(document.getElementById('insitu').checked == true)
	{
		document.getElementById('insiturepl').disabled=false;
		document.frmaddDept.insitu.value="yes";
	}
	else
	{
		document.getElementById('insiturepl').disabled=true;
		document.frmaddDept.insitu.value="no";
	}
}
function upschk11()
{
	if(document.getElementById('interra').checked == true)
	{
		document.getElementById('interrarepl').disabled=false;
		document.frmaddDept.interra.value="yes";
	}
	else
	{
		document.getElementById('interrarepl').disabled=true;
		document.frmaddDept.interra.value="no";
	}
}
function dnachk(clasval,srno)
{
	var crop=document.frmaddDept.txtstfp.value;
	document.getElementById('dnadiv').style.display="Block";
	document.getElementById('geldiv').style.display="none";
	document.getElementById('pcrdiv').style.display="none";
	//document.getElementById('rephead').innerHTML="IN-SITU : DNA - Replication "+srno;
	document.frmaddDept.step.value="DNA";
	showUser(clasval,'dnadiv','gotsowing',srno,crop,'','','');
}
function pcrchk(clasval,srno,gotidss)
{	
	var crop=document.frmaddDept.txtstfp.value;
	document.getElementById('pcrdiv').style.display="Block";
	document.getElementById('dnadiv').style.display="none";
	document.getElementById('geldiv').style.display="none";
	/*document.getElementById('rephead').innerHTML="IN-SITU : DNA - Replication "+srno;
	document.getElementById('rephead1').innerHTML="IN-SITU : PCR Analysis - Replication "+srno;*/
	document.frmaddDept.step.value="PCR";
	showUser(clasval,'pcrdiv','gottransplatnt',srno,gotidss,crop,'','');
}
function geachk(clasval,srno,gotssid,gotsid)
{
	var crop = document.frmaddDept.txtstfp.value;
	var id = document.frmaddDept.tid.value;
	var interrarepl = document.frmaddDept.interrarepl.value;
	//alert(srno);alert(id);alert(interrarepl);
	if(crop == "Maize Seed" || crop == "Pearl Millet")
	{
		window.location.href='add_got_data4.php?tid='+id+'&interrarepl='+interrarepl+'&gotssid='+gotssid+'&gotsid='+gotsid+'&srno='+srno;
	}
	else if(crop == "Paddy Seed")
	{
		window.location.href='add_got_data5.php?tid='+id+'&interrarepl='+interrarepl+'&gotssid='+gotssid+'&gotsid='+gotsid+'&srno='+srno;
	}
	else
	{
		window.location.href='add_got_data3.php?tid='+id+'&interrarepl='+interrarepl+'&gotssid='+gotssid+'&gotsid='+gotsid+'&srno='+srno;
	}
}
function imageck()
{
	if(document.frmaddDept.gdate.value=="")
	{
		alert("Please Select Gel Electrophorasis Analysis Date");
		document.frmaddDept.gdate.focus();
		return false;
	}
	if(document.frmaddDept.txtsampsize.value=="")
	{
		alert("Please Enter Sample Size");
		document.frmaddDept.txtsampsize.focus();
		return false;
	}
	if(document.frmaddDept.txtsampnotamp.value=="")
	{
		alert("Please Enter Sample Not Amplified");
		document.frmaddDept.txtsampnotamp.focus();
		return false;
	}
	if(document.frmaddDept.txtgenpurity.value=="")
	{
		alert("Please Enter Genetic Purity");
		document.frmaddDept.txtgenpurity.focus();
		return false;
	}
}
function mySubmit()
{
//alert(document.frmaddDept.step.value);
	if(document.frmaddDept.step.value=="DNA")
	{
		if(document.frmaddDept.pdate.value=="")
		{
			alert("Please Select the Sowing Date");
			document.frmaddDept.pdate.focus();
			return false;
		}
		if(document.frmaddDept.txtpoltno.value=="")
		{
			alert("Please Enter Sowing/Nursery Plot No.");
			document.frmaddDept.txtpoltno.focus();
			return false;
		}
		if(document.frmaddDept.txtnoseeds.value=="")
		{
			alert("Please Enter No.of Rows/Seeds");
			document.frmaddDept.txtnoseeds.focus();
			return false;
		}
	}
	if(document.frmaddDept.step.value=="PCR")
	{
		if(document.frmaddDept.txtrange.value=="")
		{
			alert("Please Enter the Range");
			document.frmaddDept.txtrange.focus();
			return false;
		}
		if(document.frmaddDept.txttrrows.value=="")
		{
			alert("Please Enter No. of rows");
			document.frmaddDept.txttrrows.focus();
			return false;
		}
		if(document.frmaddDept.txtbedno.value=="")
		{
			alert("Please Enter Bed No.");
			document.frmaddDept.txtbedno.focus();
			return false;
		}
		if(document.frmaddDept.txtdirection.value=="")
		{
			alert("Please Select Direction");
			document.frmaddDept.txtdirection.focus();
			return false;
		}
		if(document.frmaddDept.txtstate.value=="")
		{
			alert("Please Select State");
			document.frmaddDept.txtstate.focus();
			return false;
		}
		if(document.frmaddDept.txtlocation.value=="")
		{
			alert("Please Select Got Location");
			document.frmaddDept.txtlocation.focus();
			return false;
		}
		if(document.frmaddDept.txtnoofplants.value=="")
		{
			alert("Please Enter No. of Plants");
			document.frmaddDept.txtnoofplants.focus();
			return false;
		}
		/*if(document.frmaddDept.txtnoofplants.value>document.frmaddDept.txtnoseeds.value)
		{
			alert("No. of plants should be less than or equal to No. of seeds");
			document.frmaddDept.txtnoofplants.focus();
			return false;
		}*/
	}
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Result Update</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt" value="" type="hidden">
	 <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" /> 
	 <input type="hidden" name="interrarepl" value="<?php echo $interrarepl;?>" /> 
	 <input type="hidden" name="interra" value="<?php echo $interra;?>" />
	 
	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
//echo "SELECT * FROM tbl_gottest where gottest_tid='".$a."' ";
$quer3=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['gottest_lotno'];
$oldlot=$noticia['gottest_oldlot'];
//echo "select * from tbl_gottest where gottest_lotno='".$a."'";
$sql_month=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);

$sql_spcode=mysqli_query($link,"select * from tblarrival_sub where orlot='".$row['gottest_oldlot']."'") or die(mysqli_error($link));
$row_spcode=mysqli_fetch_array($sql_spcode);
$grade=$row['grade'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['gottest_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['gottest_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['gottest_sampleno'];
$sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
$tp22=$row['gottest_trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >GOT Data and Result Update</td>
          </tr>
  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtstfp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>"onchange="upschk(this.value);" id="itm"/>  &nbsp;</td>
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
<?php  
	$tdates=$row['gottest_srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['gottest_dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 

?>
<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="217" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="125" align="right" valign="middle" class="tblheading">DOSC&nbsp;</td>
<td width="223" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td> 

<td width="175" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampl" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sampl;?>" maxlength="20"/>&nbsp;</td>
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

</table><br/>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="207" align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
<td width="261" align="left"  valign="middle" class="tbltext">&nbsp;<input name="insitu" id="insitu" type="checkbox" class="tbltext" onchange="upschk1();" value="" checked="checked" disabled="disabled"/></td>
<td width="206" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td width="266" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $interrarepl?></td>
</tr>
	   
</table><br />

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="12" align="center" class="tblheading" >IN-TERRA Replications</td>
          </tr>
<tr class="Dark" height="25">
	<td width="72" align="center" valign="middle" class="tblheading">Replication</td>
	<td width="56" align="center" valign="middle" class="tblheading">Sowing</td>
	<td width="85" align="center" valign="middle" class="tblheading">Transplanting</td>
	<td width="77" align="center" valign="middle" class="tblheading">Observation</td>
	<td width="98" align="center" valign="middle" class="tblheading">Abort</td>
</tr>
<?php 
/*$step="DNA";
$step1="PCR";
$step2="GEA";*/
$abort=0;
$srno=1;
$cnt=$interrarepl;

$sql_s=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-TERRA' order by gottests_id asc")or die(mysqli_error($link));
$rows=mysqli_fetch_array($sql_s);

$sql_subsub=mysqli_query($link,"SELECT * FROM tbl_gottestsub_sub where gottests_id=$gots_id order by gottestss_id desc limit 0,1")or die(mysqli_error($link));
$row_subsub=mysqli_fetch_array($sql_subsub);

$tdatee1=$row_subsub['gottestss_doswdate'];
	$tyear=substr($tdatee1,0,4);
	$tmonth=substr($tdatee1,5,2);
	$tday=substr($tdatee1,8,2);
	$dateofsowing=$tday."-".$tmonth."-".$tyear; 

$sql_ss=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
//$rowss= mysqli_fetch_array($sql_ss);
while($rowss=mysqli_fetch_array($sql_ss))
{ 
?>
<tr class="Light" height="25">
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php if($rowss['dnaflg']==0 && $rowss['gottestss_abortflg']==0){?><a href="Javascript:void(0)" onclick="dnachk('<?php echo $step?>','<?php echo $srno?>')">Update</a><?php }else{ echo "Update";}?></td>
	
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php if($rowss['dnaflg']==1 && $rowss['pcrflg']==0 && $rowss['gottestss_abortflg']==0){?><a href="Javascript:void(0)" onclick="pcrchk('<?php echo $step1?>','<?php echo $srno?>','<?php echo $rowss['gottestss_id']?>')">Update</a><?php }else{ echo "Update";}?></td>
	
	<td width="77" align="center" valign="middle" class="smalltbltext"><?php if($rowss['pcrflg']==1 && $rowss['geaflg']==0 && $rowss['gottestss_abortflg']==0){?><a href="Javascript:void(0)" onclick="geachk('<?php echo $step2?>','<?php echo $srno?>','<?php echo $rowss['gottestss_id']?>','<?php echo $rows['gottests_id']?>')">Update</a><?php }else{ echo "Update";}?></td>
	
	<td width="98" align="center" valign="middle" class="smalltbltext"><?php if($rowss['gottestss_abortflg']==1){echo "Aborted";}else if($rowss['gottestss_completeflg']==1){ echo "Completed"; }else{?><a href="add_got_interra.php?tid=<?php echo $tid?>&insitu=yes&insiturepl=<?php echo $insiturepl;?>&ssid=<?php echo $rowss['gottestss_id']?>"><img src="../images/abort2.gif" border="0"style="display:inline;cursor:pointer;" /></a><?php }?></td>
</tr>
<?php 
$srno++;
}
while($cnt>=$srno)
{
?>
<tr class="Light" height="25">
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="dnachk('<?php echo $step?>','<?php echo $srno?>')">Update</a></td>
	<td width="85" align="center" valign="middle" class="smalltbltext">Update</td>
	<td width="77" align="center" valign="middle" class="smalltbltext">Update</td>
	<td width="98" align="center" valign="middle" class="smalltbltext"></td>
	<!--<td width="131" align="center" valign="middle" class="smalltbltext"><?php if($rowss['gottestss_abortflg']==1){echo "Aborted";}else if($rowss['gottestss_completeflg']==1){ echo "Completed"; }else{?><a href="add_got_insitu.php?tid=<?php echo $tid?>&insitu=yes&insiturepl=<?php echo $insiturepl;?>&ssid=<?php echo $rowss['gottestss_id']?>"><img src="../images/abort.gif" border="0"style="display:inline;cursor:pointer;" /></a><?php }?></td>-->
</tr>
<?php 
//$cnt--;
$srno++; 
}?>	
</table><br /><input type="hidden" name="dateofsowing" value="<?php echo $dateofsowing;?>" />

<div id="dnadiv">	

</div> <br />
<div id="pcrdiv">

</div>

<div id="geldiv" style="display:none">

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-SITU : DNA</td>
</tr>
<tr class="Dark" height="25">
	<td width="166" align="center" valign="middle" class="tblheading">Sample Reciept Date</td>
	<td width="167" align="center" valign="middle" class="tblheading">DNA Extraction Date</td>
	<td width="143" align="center" valign="middle" class="tblheading">DNA Extracted From</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">DNA Extraction Method</td>
	<td width="86" align="center" valign="middle" class="tblheading">Sample Age</td>
</tr>
<tr class="Light" height="25">
	<td width="166" align="center" valign="middle" class="smalltbltext"></td>
	<td width="167" align="center" valign="middle" class="smalltbltext"></td>
	<td width="143" align="center" valign="middle" class="smalltbltext"></td>
	<td align="center" valign="middle" class="smalltbltext"></td>
	<td align="center" valign="middle" class="smalltbltext"></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"></td>
</tr>
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
<tr class="Light" height="25">
	<td width="208" align="center" valign="middle" class="smalltbltext"></td>
	<td width="263" align="center" valign="middle" class="smalltbltext"></td>
	<td width="234" align="center" valign="middle" class="smalltbltext"></td>
	<td width="235" align="center" valign="middle" class="smalltbltext"></td>
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="15" align="center" class="tblheading" id="rephead2">IN-SITU : Gel Electrophorasis Analysis</td>
</tr>
<tr class="Dark" height="25">
<td width="207"  align="right"  valign="middle" class="tblheading">Gel Electrophorasis Analysis Date&nbsp;</td>
<td width="261" align="left" valign="middle" class="tbltext">&nbsp;<input name="gdate" id="gdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('gdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="210" align="right" valign="middle" class="tblheading">Sample Size&nbsp;</td>
<td width="262" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampsize" type="text" size="10" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="sampsize()">&nbsp;&nbsp;<font color="#FF0000">*</font></td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Samples Not Amplified&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampnotamp" type="text" size="10" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="sampnotamp()" />  &nbsp;&nbsp;<font color="#FF0000">*</font></td>

<td align="right" valign="middle" class="tblheading">Amplified Samples&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtampsamp" type="text" size="10" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="ampsamp()" readonly="true" style="background-color:#CCCCCC">&nbsp;&nbsp;<font color="#FF0000">*</font></td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading"><?php if($crop!="Cluster Bean"){?>Male&nbsp;<?php }else{?>Desi Type&nbsp;<?php }?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtmaleno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="malepercal(this.value)">&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtmaleper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading"><?php if($crop!="Cluster Bean"){?>Female&nbsp;<?php }else{?>Branching&nbsp;<?php }?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtfemaleno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="femalecal(this.value)">&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtfemaleper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Outcross&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoutcrno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="outcrcal(this.value)" >&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtoutcrper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">OOF&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoofno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="oofcal(this.value)" >&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtoofper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>

<tr class="Dark" height="25">
<td width="207" align="right" valign="middle" class="tblheading">Base Pair Size&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;Male&nbsp;<input name="txtmale" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC"></td>
<td align="left" valign="middle" class="tbltext">&nbsp;Female&nbsp;<input name="txtfemale" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC"></td>
<td align="left" valign="middle" class="tbltext">&nbsp;Hybrid&nbsp;<input name="txthybrid" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC"></td>
</tr>

<tr class="Dark" height="25">
<td width="207" align="right" valign="middle" class="tblheading">Image&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtimage" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC">&nbsp;<input type="button" src="images/upload.gif" value="Browse" name="Upload">&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<input type="hidden" name="tid" value="<?php echo $tid?>" /><input type="hidden" name="step" value="" /><input type="hidden" name="srno" value="<?php echo $srno;?>" />
<!--<div id="posting" style="display:none">
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" /><input type="hidden" name="step" value="<?php echo $step2;?>" /><input type="hidden" name="srno" value="<?php echo $srno;?>" /></td>
</tr>
</table>
</div>-->
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_got_data1.php?tid=<?php echo $tid?>"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a><!--<img src="../images/back.gif" border="0"/>&nbsp;-->
<!--<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" />&nbsp;&nbsp;</td>--></tr>
</table>
</form>	  </td>
	  </tr>
	  </table>
		  
		  
<!-- actual page end--->		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table>
      </td>
  </tr>
</table>
</body>
</html>
