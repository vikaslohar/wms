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
	$interrarepl=trim($_POST['interrarepl']);
	$gotss_id=trim($_POST['gotssid']);
	$gots_id=trim($_POST['gotsid']);
	
	$dsowd=trim($_POST['dsowd']);
	$trd=trim($_POST['trd']);
	$seed=trim($_POST['noseeds']);
			  
	$bedno=trim($_POST['txtbedno']);
	$direction=trim($_POST['txtdirection']);
	$state=trim($_POST['txtstate']);
	$location=trim($_POST['txtlocation']);
	$plantpopn=trim($_POST['txtplantpopn']);
	$plot=trim($_POST['txtplot']);
	$range=trim($_POST['txtrange']);
	$tenno=trim($_POST['txttenno']);
	$tenper=trim($_POST['txttenper']);
	$redtipno=trim($_POST['txtredtipno']);
	$redtipper=trim($_POST['txtredtipper']);
	$fgrainno=trim($_POST['txtfgrainno']);
	$fgrainper=trim($_POST['txtfgrainper']);
	$otherno=trim($_POST['txtotherno']);
	$otherper=trim($_POST['txtotherper']);
	$alineno=trim($_POST['txtalineno']);
	$alineper=trim($_POST['txtalineper']);
	$outcrno=trim($_POST['txtoutcrno']);
	$outcrper=trim($_POST['txtoutcrper']);
	$blineno=trim($_POST['txtblineno']);
	$blineper=trim($_POST['txtblineper']);
	$lgrainno=trim($_POST['txtlgrainno']);
	$lgrainper=trim($_POST['txtlgrainper']);
	$fgrainno1=trim($_POST['txtfgrainno1']);
	$fgrainper1=trim($_POST['txtfgrainper1']);
	$bgrainno=trim($_POST['txtbgrainno']);
	$bgrainper=trim($_POST['txtbgrainper']);
	$tallno=trim($_POST['txttallno']);
	$tallper=trim($_POST['txttallper']);
	$lplantno=trim($_POST['txtlplantno']);
	$lplantper=trim($_POST['txtlplantper']);
	$totno=trim($_POST['txttotno']);
	$totper=trim($_POST['txttotper']);
	$totno=trim($_POST['txttotno']);
	$totper=trim($_POST['txttotper']);
	$genpurity=trim($_POST['txtgenpurity']);
	
	
	$obdate1=trim($_POST['obdate']);
	$ddate3=explode("-",$obdate1);
	$obdate=$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
	/*echo "insert into tbl_gottestsub_sub4(gottest_tid, gottests_id, gottestss_id, bedno, direction, state, gotlocation, plotno, prange, plantpopl, tentenno, tentenper, redtpno, redtpper, finegrainno, finegrainper, otherno, otherper, alineno, alineper, outcrno, outcrper, blineno, blineper, longgrainno, longgrainper, ootfinegrainno, ootfinegrainper, boldgrainno, boldgrainper, tallplantno, tallplantper, lateplantno, lateplantper, totalno, totalper, gottestss4_genpurity, gottestss4_doobr) values('$id', '$gots_id', '$gotss_id', '$bedno','$direction','$state', '$location','$plot','$range','$plantpopn','$tenno','$tenper','$redtipno','$redtipper','$fgrainno','$fgrainper','$otherno','$otherper','$alineno','$alineper','$outcrno','$outcrper','$blineno','$blineper','$lgrainno','$lgrainper','$fgrainno1','$fgrainper1','$bgrainno','$bgrainper','$tallno','$tallper','$lplantno','$lplantper','$genpurity','$obdate')";*/
	//exit;
	$sql_sub_sub2="insert into tbl_gottestsub_sub4(gottest_tid, gottests_id, gottestss_id, bedno, direction, state, gotlocation, plotno, prange, plantpopl, tentenno, tentenper, redtpno, redtpper, finegrainno, finegrainper, otherno, otherper, alineno, alineper, outcrno, outcrper, blineno, blineper, longgrainno, longgrainper, ootfinegrainno, ootfinegrainper, boldgrainno, boldgrainper, tallplantno, tallplantper, lateplantno, lateplantper, totalno, totalper, gottestss4_genpurity, gottestss4_doobr) values('$id','$gots_id','$gotss_id','$bedno','$direction','$state','$location','$plot','$range','$plantpopn','$tenno','$tenper','$redtipno','$redtipper','$fgrainno','$fgrainper','$otherno','$otherper','$alineno','$alineper','$outcrno','$outcrper','$blineno','$blineper','$lgrainno','$lgrainper','$fgrainno1','$fgrainper1','$bgrainno','$bgrainper','$tallno','$tallper','$lplantno','$lplantper','$totno','$totper','$genpurity','$obdate')";
	$row_sub_sub2=mysqli_query($link,$sql_sub_sub2)or die(mysqli_error($link));
	
	$sql_sub_sub="update tbl_gottest set gottest_resultflg=1 where gottest_tid=$id";
	$row_sub_sub=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
	
	echo "<script>window.location='add_got_data5.php?tid=$id&interrarepl=$interrarepl&interra=$txtinterra&dsowd=$dsowd&trd=$trd&seed=$seed&gotssid=$gotss_id&gotsid=$gots_id'</script>";
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
/*function dirchk()
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
function plot()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtplot.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtplot.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtstate.value=="")
 	{
		alert("Please Select State");
		document.frmaddDept.txtplot.value="";
		document.frmaddDept.txtstate.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtplot.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	return true;
}
function range()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtbedno.value=="")
 	{
		alert("Please enter Bed No.");
		document.frmaddDept.txtrange.value="";
		document.frmaddDept.txtbedno.focus();
		return false;
 	}
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		document.frmaddDept.txtrange.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtstate.value=="")
 	{
		alert("Please Select State");
		document.frmaddDept.txtrange.value="";
		document.frmaddDept.txtstate.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		document.frmaddDept.txtrange.value="";
		document.frmaddDept.txtlocation.focus();
		return false;
 	}
	if(document.frmaddDept.txtplot.value=="")
 	{
		alert("Please Select Plot No.");
		document.frmaddDept.txtrange.value="";
		document.frmaddDept.txtplot.focus();
		return false;
 	}
	return true;
}*/
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
function mySubmit()
{
	//alert("In Function...");
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please Insert Genetic Purity");
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	if(document.frmaddDept.obdate.value=="")
 	{
		alert("Select Observation Date");
		document.frmaddDept.obdate.focus();
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
function tencal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	//alert(tatalno);
	if(document.frmaddDept.txtplantpopn.value=="")
 	{
		alert("Please Insert Plant Population");
		document.frmaddDept.txtno.value="";
		document.frmaddDept.txtplantpopn.focus();
		return false;
 	}
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
		alert("You Can not keep blank 1010 No.");
		return false;
	}
}
function redtipcal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
		alert("You Can not keep blank Red Tip No.");
		return false;
	}
}
function fgraincal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
function othercal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
function alinecal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
function outcrosscal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
function sheddercal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
function lgraincal(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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
function fgraincal1(clasval)	
{
	var plantpop = document.frmaddDept.txtplantpopn.value;
	var tenno = document.frmaddDept.txttenno.value;
	var redtipno = document.frmaddDept.txtredtipno.value;
	var fgrainno = document.frmaddDept.txtfgrainno.value;
	var otherno = document.frmaddDept.txtotherno.value;
	var alineno = document.frmaddDept.txtalineno.value;
	var outcrno = document.frmaddDept.txtoutcrno.value;
	var blineno = document.frmaddDept.txtblineno.value;
	var lgrainno = document.frmaddDept.txtlgrainno.value;
	var fgrainno1 = document.frmaddDept.txtfgrainno1.value;
	var bgrainno = document.frmaddDept.txtbgrainno.value;
	var tallno = document.frmaddDept.txttallno.value;
	var lplantno = document.frmaddDept.txtlplantno.value;
	var tatalno = 0;
	//alert(fgrainno1);
	if(clasval!="")
	{
		if(tenno!="")
		{
			document.frmaddDept.txttenper.value=parseFloat(tenno)*100/parseFloat(plantpop);
			document.frmaddDept.txttenper.value=parseFloat(document.frmaddDept.txttenper.value).toFixed(3);
			tatalno=tatalno+parseInt(tenno);
		}
		else
		{
			alert("You Can not keep blank 1010 No.");
			return false;
		}
		if(redtipno!="")
		{
			document.frmaddDept.txtredtipper.value=parseFloat(redtipno)*100/parseFloat(plantpop);
			document.frmaddDept.txtredtipper.value=parseFloat(document.frmaddDept.txtredtipper.value).toFixed(3);
			tatalno=tatalno+parseInt(redtipno);
		}
		else
		{
			alert("You Can not keep blank Red Tip No.");
			return false;
		}
		if(fgrainno!="")
		{
			document.frmaddDept.txtfgrainper.value=parseFloat(fgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper.value=parseFloat(document.frmaddDept.txtfgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno);
		}
		if(otherno!="")
		{
			document.frmaddDept.txtotherper.value=parseFloat(otherno)*100/parseFloat(plantpop);
			document.frmaddDept.txtotherper.value=parseFloat(document.frmaddDept.txtotherper.value).toFixed(3);
			tatalno=tatalno+parseInt(otherno);
		}
		if(alineno!="")
		{
			document.frmaddDept.txtalineper.value=parseFloat(alineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtalineper.value=parseFloat(document.frmaddDept.txtalineper.value).toFixed(3);
			tatalno=tatalno+parseInt(alineno);
		}
		if(outcrno!="")
		{
			document.frmaddDept.txtoutcrper.value=parseFloat(outcrno)*100/parseFloat(plantpop);
			document.frmaddDept.txtoutcrper.value=parseFloat(document.frmaddDept.txtoutcrper.value).toFixed(3);
			tatalno=tatalno+parseInt(outcrno);
		}
		if(blineno!="")
		{
			document.frmaddDept.txtblineper.value=parseFloat(blineno)*100/parseFloat(plantpop);
			document.frmaddDept.txtblineper.value=parseFloat(document.frmaddDept.txtblineper.value).toFixed(3);
			tatalno=tatalno+parseInt(blineno);
		}
		if(lgrainno!="")
		{
			document.frmaddDept.txtlgrainper.value=parseFloat(lgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlgrainper.value=parseFloat(document.frmaddDept.txtlgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(lgrainno);
		}
		if(fgrainno1!="")
		{
			document.frmaddDept.txtfgrainper1.value=parseFloat(fgrainno1)*100/parseFloat(plantpop);
			document.frmaddDept.txtfgrainper1.value=parseFloat(document.frmaddDept.txtfgrainper1.value).toFixed(3);
			tatalno=tatalno+parseInt(fgrainno1);
		}
		if(bgrainno!="")
		{
			document.frmaddDept.txtbgrainper.value=parseFloat(bgrainno)*100/parseFloat(plantpop);
			document.frmaddDept.txtbgrainper.value=parseFloat(document.frmaddDept.txtbgrainper.value).toFixed(3);
			tatalno=tatalno+parseInt(bgrainno);
		}
		if(tallno!="")
		{
			document.frmaddDept.txttallper.value=parseFloat(tallno)*100/parseFloat(plantpop);
			document.frmaddDept.txttallper.value=parseFloat(document.frmaddDept.txttallper.value).toFixed(3);
			tatalno=tatalno+parseInt(tallno);
		}
		if(lplantno!="")
		{
			document.frmaddDept.txtlplantper.value=parseFloat(lplantno)*100/parseFloat(plantpop);
			document.frmaddDept.txtlplantper.value=parseFloat(document.frmaddDept.txtlplantper.value).toFixed(3);
			tatalno=tatalno+parseInt(lplantno);
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

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
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

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
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

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
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
<?php 
$srno1++;
}?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Plant Population&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;(No. of Plants)</td>
</tr>

<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="4">Early</td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">1010&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttenno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="tencal(this.value)" />&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttenper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Red Tip&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtredtipno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="redtipcal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtredtipper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Fine Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtfgrainno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtfgrainper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Other&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtotherno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="othercal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtotherper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="4">Sterile</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">A Line&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtalineno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="alinecal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtalineper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Out Cross&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoutcrno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="outcrosscal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtoutcrper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="4">Other Off Types</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">B Line/Shedder&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtblineno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="sheddercal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtblineper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Long Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlgrainno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="lgraincal(this.value)" />&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlgrainper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Fine Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtfgrainno1" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtfgrainper1" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Bold Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtbgrainno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtbgrainper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Tall Plants&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttallno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttallper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Late Plants&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlplantno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlplantper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>


<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>
<tr class="Light" height="25">
<td width="206" align="right" valign="middle" class="tblheading">Date of Observation&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="obdate" id="obdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="doobchk('obdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
</table>
  
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<a href="add_got_interra.php?tid=<?php echo $tid?>&interrarepl=<?php echo $interrarepl?>"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" /><input type="hidden" name="interrarepl" value="<?php echo $interrarepl?>" />&nbsp;&nbsp;</td>
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
