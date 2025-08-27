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
	if(isset($_GET['srno']))
	{
		$srno = $_GET['srno'];	 
	}
	if(isset($_GET['type']))
	{
		$type = $_GET['type'];	 
	}
	if(isset($_GET['insiturepl']))
	{
		$insiturepl = $_GET['insiturepl'];	 
	}
	if(isset($_GET['interrarepl']))
	{
		$interrarepl = $_GET['interrarepl'];	 
	}
	if(isset($_GET['dsowd']))
	{
		$dsowd = $_GET['dsowd'];	 
	}
	if(isset($_GET['trd']))
	{
		$trd = $_GET['trd'];	 
	}
	if(isset($_GET['seed']))
	{
		$seed = $_GET['seed'];	 
	}
	if(isset($_REQUEST['gotssid']))
	{
		$gotssid = $_REQUEST['gotssid'];	 
	}
	if(isset($_REQUEST['gotsid']))
	{
		$gotsid = $_REQUEST['gotsid'];	 
	}
	
	$tid=$a;
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['gottest_sampleno'];
	$olotno2=$row_ck2['gottest_lotno'];
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
		
if(isset($_POST['frm_action'])=='submit')
{
	$id=trim($_POST['tid']);
	$txtinsitu=trim($_POST['insitu']);
	$txtinterra=trim($_POST['interra']);
	$gotss_id=trim($_POST['gotssid']);
	$gots_id=trim($_POST['gotsid']);
	$interrarepl=trim($_POST['interrarepl']);
	
	$dsowd=trim($_POST['dsowd']);
	$trd=trim($_POST['trd']);
	$seed=trim($_POST['noseeds']);
			  
	$bedno=trim($_POST['txtbedno']);
	$direction=trim($_POST['txtdirection']);
	$state=trim($_POST['txtstate']);
	$location=trim($_POST['txtlocation']);
	$plantpopn=trim($_POST['txtplantpopn']);
	$maleno=trim($_POST['txtno']);
	$maleper=trim($_POST['txtper']);
	$femaleno=trim($_POST['txtno1']);
	$femaleper=trim($_POST['txtper1']);
	$tallno=trim($_POST['txttallno']);
	$tallper=trim($_POST['txttallper']);
	$oofno=trim($_POST['txtoofno']);
	$oofper=trim($_POST['txtoofper']);
	$totno=trim($_POST['txttotno']);
	$totper=trim($_POST['txttotper']);
	$genpurity=trim($_POST['txtgenpurity']);
	
	$obdate1=trim($_POST['obdate']);
	$ddate3=explode("-",$obdate1);
	$obdate=$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
	/*echo "insert into tbl_gottestsub_sub4(gottest_tid, gottests_id, gottestss_id, bedno, direction, state, gotlocation,  plantpopln, maleno, maleper, femaleno, femaleper, tallplantno, tallplantper, oofno, oofper, totalno, totalper, gottestss4_genpurity, gottestss4_doobr) values('$id', '$gots_id', '$gotss_id', '$bedno','$direction','$state', '$location','$plantpopn','$maleno','$maleper','$femaleno','$femaleper','$tallno','$tallper','$oofno','$oofper','$totno','$totper','$genpurity','$obdate')";
	exit;*/
		$sql_sub_sub2="insert into tbl_gottestsub_sub4(gottest_tid, gottests_id, gottestss_id, bedno, direction, state, gotlocation,  plantpopl, maleno, maleper, femaleno, femaleper, tallplantno, tallplantper, oofno, oofper, totalno, totalper, gottestss4_genpurity, gottestss4_doobr) values('$id', '$gots_id', '$gotss_id', '$bedno','$direction','$state', '$location','$plantpopn','$maleno','$maleper','$femaleno','$femaleper','$tallno','$tallper','$oofno','$oofper','$totno','$totper','$genpurity','$obdate')";
		$row_sub_sub2=mysqli_query($link,$sql_sub_sub2)or die(mysqli_error($link));
		
		$sql_sub_sub="update tbl_gottest set gottest_resultflg=1 where gottest_tid=$id";
		$row_sub_sub=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
	
	echo "<script>window.location='add_got_data4.php?tid=$id&interrarepl=$interrarepl&interra=$txtinterra&dsowd=$dsowd&trd=$trd&seed=$seed&gotssid=$gotss_id&gotsid=$gots_id'</script>";
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
<script src="samp.js"></script>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
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
	//alert("Hiii...");
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
	//alert(document.frmaddDept.pdate1.value);
	/*if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.trdate.value="";
		document.frmaddDept.txtloc.focus();
		return false;
 	}*/
	if(document.frmaddDept.pdate1.value=="")
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
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtdirection.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	return true;
}
function locchk()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtlocation.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtstate.value=="")
 	{
		alert("Please Select State");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtstate.focus();
		return false;
 	}
	return true;
}
function plantpop()
{
	//alert("Hiii...");
	/*if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please Enter Bed No.");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtstate.value=="")
 	{
		alert("Please Select State");
		document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtstate.focus();
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
 	}*/
	return true;
}
function doobchk(dotdate)
{
	//alert("Hiii...");
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
function authorised()
{
	//alert("Hiii...");
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
function mySubmit()
{
	//alert("In Submit...");
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(document.frmaddDept.txtno.value=="")
 	{
		alert("Please Insert Male Plant");
		document.frmaddDept.txtno.focus();
		return false;
 	}
	if(document.frmaddDept.txtno1.value=="")
 	{
		alert("Please Insert Female Plant");
		document.frmaddDept.txtno1.focus();
		return false;
 	}
	if(document.frmaddDept.txttallno.value=="")
 	{
		alert("Please Insert Tall Plant");
		document.frmaddDept.txttallno.focus();
		return false;
 	}
	if(document.frmaddDept.txtoofno.value=="")
 	{
		alert("Please Insert OOF");
		document.frmaddDept.txtoofno.focus();
		return false;
 	}
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please Insert Genetic Purity");
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	return true;
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
	var tallno = document.frmaddDept.txttallno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	//alert(tatalno);
	/*if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please Enter Bed No.");
		document.frmaddDept.txtno.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtno.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtno.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}*/
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.txtno.value="";
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper.value=parseFloat(document.frmaddDept.txtper.value).toFixed(3);
			tatalno=tatalno+parseInt(maleno);
		}
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper1.value=parseFloat(document.frmaddDept.txtper1.value).toFixed(3);
			tatalno=tatalno+parseInt(femaleno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}		
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoofper.value=parseFloat(document.frmaddDept.txtoofper.value).toFixed(3);
			tatalno=tatalno+parseInt(oofno);
		}
		//alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txttotper.value=parseFloat(document.frmaddDept.txttotper.value).toFixed(3);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
		document.frmaddDept.txtgenpurity.value=parseFloat(document.frmaddDept.txtgenpurity.value).toFixed(3);
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
	var tallno = document.frmaddDept.txttallno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper.value=parseFloat(document.frmaddDept.txtper.value).toFixed(3);
			tatalno=tatalno+parseInt(maleno);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper1.value=parseFloat(document.frmaddDept.txtper1.value).toFixed(3);
			tatalno=tatalno+parseInt(femaleno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoofper.value=parseFloat(document.frmaddDept.txtoofper.value).toFixed(3);
			tatalno=tatalno+parseInt(oofno);
		}
		//alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txttotper.value=parseFloat(document.frmaddDept.txttotper.value).toFixed(3);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
		document.frmaddDept.txtgenpurity.value=parseFloat(document.frmaddDept.txtgenpurity.value).toFixed(3);
	}
	else
	{
		alert("You Can not keep blank Female No.");
		return false;
	}
}
function tallcal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var maleno = document.frmaddDept.txtno.value;
	var femaleno = document.frmaddDept.txtno1.value;
	var tallno = document.frmaddDept.txttallno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper.value=parseFloat(document.frmaddDept.txtper.value).toFixed(3);
			tatalno=tatalno+parseInt(maleno);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper1.value=parseFloat(document.frmaddDept.txtper1.value).toFixed(3);
			tatalno=tatalno+parseInt(femaleno);
		}
		else
		{
			alert("You Can not keep blank Female No.");
			return false;
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoofper.value=parseFloat(document.frmaddDept.txtoofper.value).toFixed(3);
			tatalno=tatalno+parseInt(oofno);
		}
		//alert(tatalno);
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txttotper.value=parseFloat(document.frmaddDept.txttotper.value).toFixed(3);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
		document.frmaddDept.txtgenpurity.value=parseFloat(document.frmaddDept.txtgenpurity.value).toFixed(3);
	}
	else
	{
		alert("You Can not keep blank Tall Plants No.");
		return false;
	}
}
function oofcal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var maleno = document.frmaddDept.txtno.value;
	var femaleno = document.frmaddDept.txtno1.value;
	var tallno = document.frmaddDept.txttallno.value;
	var oofno = document.frmaddDept.txtoofno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(maleno!="")
		{
			document.frmaddDept.txtper.value=parseFloat(maleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper.value=parseFloat(document.frmaddDept.txtper.value).toFixed(3);
			tatalno=tatalno+parseInt(maleno);
		}
		else
		{
			alert("You Can not keep blank Male No.");
			return false;
		}	
		if(femaleno!="")
		{
			document.frmaddDept.txtper1.value=parseFloat(femaleno)*100/parseFloat(plantpop);
			document.frmaddDept.txtper1.value=parseFloat(document.frmaddDept.txtper1.value).toFixed(3);
			tatalno=tatalno+parseInt(femaleno);
		}
		else
		{
			alert("You Can not keep blank Female No.");
			return false;
		}	
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		else
		{
			alert("You Can not keep blank Tall Plants No.");
			return false;
		}
		if(oofno!="")
		{
			document.frmaddDept.txtoofper.value=parseFloat(oofno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoofper.value=parseFloat(document.frmaddDept.txtoofper.value).toFixed(3);
			tatalno=tatalno+parseInt(oofno);
		}
		document.frmaddDept.txttotno.value=parseInt(tatalno);
		document.frmaddDept.txttotper.value=parseInt(tatalno)*100/parseFloat(plantpop);
		document.frmaddDept.txttotper.value=parseFloat(document.frmaddDept.txttotper.value).toFixed(3);
		document.frmaddDept.txtgenpurity.value=100 - (document.frmaddDept.txttotper.value);
		document.frmaddDept.txtgenpurity.value=parseFloat(document.frmaddDept.txtgenpurity.value).toFixed(3);
	}
	else
	{
		alert("You Can not keep blank OOF No.");
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
function loc(clasval)
{
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please Enter Bed No.");
		document.frmaddDept.txtstate.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	else if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtstate.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	else
	{
		showUser(clasval,'itmloc','gotloc','','','','','');
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
	      <td width="940" height="25">&nbsp;Transaction - GOT Result Update </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="gotssid" value="<?php echo $gotssid;?>" type="hidden">
	 <input name="gotsid" value="<?php echo $gotsid;?>" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$quer3=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['gottest_lotno'];
$oldlot=$noticia['gottest_oldlot'];
//echo "select * from tbl_qctest where lotno='".$a."'";
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
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
<td width="125" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
<td width="223" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
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
  
</table>  
<br/>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<?php 
if($type=="IN TERRA")
{
?>		  
<tr class="Dark" height="30">
<td width="176" align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="" checked="checked" disabled="disabled"/></td>
<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $interrarepl?></td>
</tr>
<?php 
}
?>		   
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="7" align="center" class="tblheading" >IN-TERRA : Sowing - Replication&nbsp;<?php echo $srno;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="282" align="center" valign="middle" class="tblheading">Date of Sowing</td>
	<td width="339" align="center" valign="middle" class="tblheading">Sowing Plot</td>
	<td width="321" align="center" valign="middle" class="tblheading">No. of Rows</td>
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

<tr class="Dark" height="25">
<td width="282" align="center" valign="middle" class="smalltbltext"><input name="pdate" id="pdate" type="text" size="10" class="tbltext" tabindex="0" value="<?php echo $sdate1;?>" readonly="true" style="background-color:#EFEFEF"/></td>
	
	<td width="339" align="center" valign="middle" class="smalltbltext"><input name="txtpoltno" id="txtpoltno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $rowss1['gottestss_swoingplot']?>" readonly="true" style="background-color:#EFEFEF"></td>
	
	<td width="321" align="center" valign="middle" class="smalltbltext"><input name="txtnoseeds" id="txtnoseeds" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $rowss1['gottestss_noofrows'];?>" readonly="true" style="background-color:#EFEFEF"></td>
</tr>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-TERRA : Transplanting - Replication <?php echo $srno?></td>
</tr>
<tr class="Dark" height="25">
	<td width="112" align="center" valign="middle" class="tblheading">Date of Transplant</td>
	<td width="106" align="center" valign="middle" class="tblheading">Transplant Plot</td>
	<td width="81" align="center" valign="middle" class="tblheading">Range</td>
	<td width="80" align="center" valign="middle" class="tblheading">No. of Rows</td>
	<td width="70" align="center" valign="middle" class="tblheading">Bed no.</td>
	<td width="96" align="center" valign="middle" class="tblheading">Direction</td>
	<td width="89" align="center" valign="middle" class="tblheading">State</td>
	<td width="98" align="center" valign="middle" class="tblheading">Location</td>
</tr>
<?php
$pdate="";
$sql_ss2=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$gotssid."'")or die(mysqli_error($link));
$rowss2= mysqli_fetch_array($sql_ss2);

$sql_loc=mysqli_query($link,"select * from tbl_gotlocation where loc_id='".$rowss1['gottestss_gotlocation']."'")or die(mysqli_error($link));
$rowloc=mysqli_fetch_array($sql_loc);

$sql_state=mysqli_query($link,"select * from tbl_state where state_id='".$rowss1['gottestss_state']."'")or die(mysqli_error($link));
$rowstate=mysqli_fetch_array($sql_state);

	$pdate=$rowss1['gottestss_dateoftr'];
	$tyear=substr($pdate,0,4);
	$tmonth=substr($pdate,5,2);
	$tday=substr($pdate,8,2);
	$pdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
<td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $pdate1?></td>

<td width="106" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_trplot']?></td>

<td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_range']?></td>

<td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_trrows']?></td>

<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_bedno']?></td>

<td width="96" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_direction']?></td>
  
<td width="89" align="center" valign="middle" class="smalltbltext"><?php echo $rowstate['state_name']?></td>
  
<td width="98" align="center" valign="middle" class="smalltbltext"><?php echo $rowloc['loc_name']?></td>
</tr>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
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
<?php
$sql_ss3=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottestss_id='".$gotssid."' order by gottestss4_id asc")or die(mysqli_error($link));
//$rowss= mysqli_fetch_array($sql_ss);
$srno1=1;
while($rowss3=mysqli_fetch_array($sql_ss3))
{ 


	$obrdate=$rowss3['gottestss4_doobr'];
	$tyear=substr($obrdate,0,4);
	$tmonth=substr($obrdate,5,2);
	$tday=substr($obrdate,8,2);
	$obrdate=$tday."-".$tmonth."-".$tyear; 
?>
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
<?php 
$srno1++;
}?>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Plant Population&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;(No. of Plants)</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">Male Plant&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="malepercal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Female&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtno1" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="femalecal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtper1" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Tall Plant&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttallno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="tallcal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttallper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">OOF&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoofno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="oofcal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtoofper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>
<tr class="Dark" height="25">
<td width="122" align="right" valign="middle" class="tblheading">Date of Observation&nbsp;</td>
<td width="223" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="obdate" id="obdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="doobchk('obdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
</table>
  
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<a href="add_got_interra.php?tid=<?php echo $tid?>&interrarepl=<?php echo $interrarepl?>"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />
<input type="hidden" name="tid" value="<?php echo $tid?>" />
<input type="hidden" name="interrarepl" value="<?php echo $interrarepl?>" />&nbsp;&nbsp;</td>
</tr>
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
