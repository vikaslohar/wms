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
	$tid=$a;
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_qctest where tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['sampleno'];
	$olotno2=$row_ck2['lotno'];
	$yearid2=$row_ck2['yearid'];
	//echo "select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc";
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
	{
		$id=trim($_POST['tid']);
		$txtinsitu=trim($_POST['insitu']);
		$txtinterra=trim($_POST['interra']);
		echo "<script>window.location='add_got_data2.php?tid=$id&insitu=$txtinsitu&interra=$txtinterra'</script>";
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
	alert(document.frmaddDept.pdate1.value);
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
	if(document.frmaddDept.txtbedno.value=="")
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
 	}
	return true;
}
function doobchk()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtdirection.value=="")
 	{
		alert("Please Select Direction");
		//document.frmaddDept.txtplantpopn.value="";
		document.frmaddDept.txtdirection.focus();
		return false;
 	}
	if(document.frmaddDept.txtlocation.value=="")
 	{
		alert("Please Select GOT Location");
		//document.frmaddDept.txtplantpopn.value="";
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
	//alert("In Function...");
	if(document.frmaddDept.insiturepl.value=="" && document.frmaddDept.interrarepl.value=="")
	{
		alert("Select atleast 1 type...");
		//document.frmaddDept.result.value="";
		document.frmaddDept.insiturepl.focus();
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
	      <td width="940" height="25">&nbsp;Transaction - Molecular Marker Analysis</td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

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
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >Molecular Marker Analysis Data</td>
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

?>
<tr class="Dark" height="30">
<td width="208" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="277" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="189" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
<td width="266" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="208" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td> 

<td width="189" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampl" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sap;?>" maxlength="20"/>&nbsp;</td>
</tr>
</table>  
<br/>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<?php 
if($insitu=="yes")
{
?>
<tr class="Dark" height="30">
<td width="176" align="right"  valign="middle" class="tblheading">IN SITU&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="insitu" id="insitu" type="checkbox" class="tbltext" onchange="upschk1();" value="" checked="checked" disabled="disabled"/></td>
<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $insiturepl?></td>
</tr>
<?php 
}
if($interra=="yes")
{
?>		  
<tr class="Dark" height="30">
<td width="176" align="right"  valign="middle" class="tblheading">IN TERRA&nbsp;</td>
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
	<td colspan="12" align="center" class="tblheading" ><?php echo $type." Replication no.".$srno;?></td>
</tr>
<tr class="Dark" height="25">
<td width="34" align="center" valign="middle" class="tblheading">Repl. No.</td>
 <td width="99" align="center" valign="middle" class="tblheading">Sample Reciept Date</td>
 <td width="96" align="center" valign="middle" class="tblheading">DNA Extracted From</td>
 <td width="118" align="center" valign="middle" class="tblheading">DNA Extraction Date</td>
 <td width="116" align="center" valign="middle" class="tblheading">PCR Analysis Date</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">DNA Extraction Method</td>
 <td width="92" align="center" valign="middle" class="tblheading">Sample Age</td>
 <td width="69" align="center" valign="middle" class="tblheading">Observation</td>
 <td width="31" align="center" valign="middle" class="tblheading">Abort</td>
 <td width="111" align="center" valign="middle" class="tblheading">Remarks</td>
</tr>
<tr class="Dark" height="20">
<td width="34" align="center" valign="middle" class="smalltbltext"></td>
 <td width="99" align="center" valign="middle" class="smalltbltext"></td>
 <td width="96" align="center" valign="middle" class="smalltbltext"></td>
 <td width="118" align="center" valign="middle" class="smalltbltext"></td>
 <td width="116" align="center" valign="middle" class="smalltbltext"></td>
 <td width="84" align="center" valign="middle" class="smalltbltext"></td>
 <td width="76" align="center" valign="middle" class="smalltbltext"></td>
 <td width="92" align="center" valign="middle" class="smalltbltext"></td>
 <td width="69" align="center" valign="middle" class="smalltbltext"></td>
 <td width="31" align="center" valign="middle" class="smalltbltext"></td>
  <td width="111" align="center" valign="middle" class="smalltbltext"></td>
<!-- <td width="162" align="center" valign="middle" class="smalltbltext"></td>-->
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="15" align="center" class="tblheading" >Obsevations</td>
          </tr>
<tr class="Dark" height="30">
<td width="19" align="center" valign="middle" class="tblheading">#</td>
 <td width="58" align="center" valign="middle" class="tblheading">Marker</td>
 <td width="51" align="center" valign="middle" class="tblheading">GEA Date</td>
 <td width="70" align="center" valign="middle" class="tblheading">State</td>
 <td width="85" align="center" valign="middle" class="tblheading">Location</td>
 <td width="77" align="center" valign="middle" class="tblheading">Sample Size</td>
  <td width="70" align="center" valign="middle" class="tblheading">Amplified samples</td>
  <td width="71" align="center" valign="middle" class="tblheading">Samples not Amplified</td>
 <td width="48" align="center" valign="middle" class="tblheading">Male</td>
 <td width="47" align="center" valign="middle" class="tblheading">Female</td>
 <td width="49" align="center" valign="middle" class="tblheading">OOF</td>
  <td width="63" align="center" valign="middle" class="tblheading">Outcross</td>
 <td width="62" align="center" valign="middle" class="tblheading">Total</td>
 <td width="58" align="center" valign="middle" class="tblheading">Genetic Purity</td>
 <td width="90" align="center" valign="middle" class="tblheading">Date of Observation</td>
</tr>
<tr class="Dark" height="25">
	<td width="19"align="center" valign="middle" class="smalltbltext"></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"></td>
	<td width="51" align="center" valign="middle" class="smalltbltext"></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"></td>
	<td width="85"align="center" valign="middle" class="smalltbltext"></td>
	<td width="77"align="center" valign="middle" class="smalltbltext"></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"></td>
	<td width="71" align="center" valign="middle" class="smalltbltext"></td>
	<td width="48"align="center" valign="middle" class="smalltbltext"></td>
	<td width="47"align="center" valign="middle" class="smalltbltext"></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"></td>
	<td width="71" align="center" valign="middle" class="smalltbltext"></td>
	<td width="48"align="center" valign="middle" class="smalltbltext"></td>
	<td width="47"align="center" valign="middle" class="smalltbltext"></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"></td>
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
<td width="178" align="right" valign="middle" class="tblheading">Marker&nbsp;</td>
<td width="377" align="left" valign="middle" class="tbltext">&nbsp;No.&nbsp;
  <input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  >&nbsp;Type:&nbsp;<input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  >&nbsp;Name:&nbsp;<input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  ></td>

<td width="207"  align="right"  valign="middle" class="tblheading">Gel Electrophorasis Analysis Date&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;
  <input name="obdate" id="obdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="doobchk('obdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<?php
$sql_st=mysqli_query($link,"select state_id, state_name from tbl_state") or die(mysqli_error($link));
//$row_gotloc=mysqli_fetch_array($sql_gotloc);
?><td align="right" valign="middle" class="tblheading">State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstate" style="width:100px;" onchange="loc(this.value)">
    <option value="" selected>--Select--</option>
	<?php while($row_gotloc=mysqli_fetch_array($sql_st)){?>
  	<option value="<?php echo $row_gotloc['state_id'];?>" ><?php echo $row_gotloc['state_name'];?></option>
	<?php }?>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
<?php
$sql_gotloc=mysqli_query($link,"select * from tbl_gotlocation") or die(mysqli_error($link));
//$row_gotloc=mysqli_fetch_array($sql_gotloc);
?>
<td align="right" valign="middle" class="tblheading">GOT Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="itmloc">&nbsp;<select class="tbltext" name="txtlocation" style="width:100px;" onchange="locchk()">
    <option value="" selected>--Select--</option>
	<?php while($row_gotloc=mysqli_fetch_array($sql_gotloc)){?>
  	<option value="<?php echo $row_gotloc['loc_name'];?>" ><?php echo $row_gotloc['loc_name'];?></option>
	<?php }?>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Sample Size&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;(No. of Plants)</td>

<td align="right" valign="middle" class="tblheading">Samples not Amplified&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font></td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Amplified samples&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font></td>
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

<td align="right" valign="middle" class="tblheading">Outcross&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoofno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="oofcal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtoofper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>

<tr class="Dark" height="25">
<td width="178" align="right" valign="middle" class="tblheading">Base Pair Size&nbsp;</td>
<td width="377" align="left" valign="middle" class="tbltext">&nbsp;Male.&nbsp;
  <input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  >&nbsp;Female:&nbsp;<input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  >&nbsp;Hybrid:&nbsp;<input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['bedno'];?>"  ></td>
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
  <input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" />&nbsp;&nbsp;</td>
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
