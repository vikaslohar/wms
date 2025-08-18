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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate=trim($_POST['sdate']);
		$edate=trim($_POST['edate']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtupsdc=trim($_POST['txtupsdc']);	
		$withreprint=trim($_POST['withreprint']);
		$txtplant = $_REQUEST['txtplant'];	
		//exit;
		if($sdate!="")
		{
			echo "<script>window.location='report_packingperiod1.php?sdate=$sdate&edate=$edate&txtcrop=$txtcrop&txtvariety=$txtvariety&txtupsdc=$txtupsdc&withreprint=$withreprint&txtplant=$txtplant'</script>";
		}
		else
		{?>
		 <script>
		  alert("Please Select Date");
		  </script>
		<?php }
		
	}
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant Manager - Report - Periodical Packing Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschkrep.js"></script>
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

function modetchk(classval)
{	
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1(classval)
{	
	showUser(classval,'vitem2','itemups','','','','','');
}

function verchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please selecy Variety");
		document.frmaddDepartment.txtupsdc.value;
		return false;
	}
}

function mySubmit()
{ 
	dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date.");
	return false;
	}

	return true;	 
}
function wtriprt(rptval)
{
	if(document.frmaddDepartment.withrpt.checked==true)
		document.frmaddDepartment.withreprint.value=rptval;
	else
		document.frmaddDepartment.withreprint.value="no";
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

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Periodical Packed Seed Activity Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading" >Periodical Packing Report</td>
                </tr>
                <tr height="15">
                  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>
                <tr class="Dark" height="25">
                  <td width="131" align="right"  valign="middle" class="tblheading">&nbsp;Period&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
                 <td width="139" align="left"  valign="middle" class="tblheading">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a></td>
                
				
                  <td width="100" align="right"  valign="middle" class="tblheading">&nbsp;To Date&nbsp;</td>
                  <td width="170" align="left"  valign="middle" class="tblheading">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a></td>
                </tr>
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>            
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" colspan="2">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value)">
<option value="ALL" selected>--ALL--</option>
<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
                </tr>
                <tr class="Light" height="25">
                   
	<td align="right"  valign="middle" class="tblheading" colspan="2" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem" colspan="2">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="ALL" selected>--ALL--</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                </tr>
				
				<tr class="Light" height="25">
                  
	<td align="right"  valign="middle" class="tblheading" colspan="2" >UPS&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem2" colspan="2">&nbsp;<select class="tbltext" id="upsdc" name="txtupsdc" style="width:170px;" >
<option value="ALL" selected>--ALL--</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="25">
	<td align="right"  valign="middle" class="tblheading" colspan="2">Plant&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<select class="tbltext" name="txtplant" style="width:170px;" >
		<option value="ALL" selected>ALL</option>
		<option value="Boriya">Boriya</option>
		<option value="Deorjhal">Deorjhal</option>
		<option value="Bandamailaram">Bandamailaram</option> 
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
				
<tr class="Light" height="25">
	<td align="right"  valign="middle" class="tblheading" colspan="2" >With Re-Printing&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem2" colspan="2">&nbsp;<input type="checkbox" name="withrpt" value="yes"  onclick="wtriprt(this.value)" /><input type="hidden" name="withreprint" value="no" /></td>
                </tr>
 </table><br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="550" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr >
	<td align="left" class="smalltbltext" style="color:#303918;"><font color="#FF0000"><b>Note:</b></font> 1. This is NOT a Stock Report</td>
</tr>
<tr >
	<td align="left" class="smalltbltext" style="color:#303918;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. This report will be generated for only Packing Activity for the selected period</td>
</tr>
<tr >
	<td align="left" class="smalltbltext" style="color:#303918;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3. Lots are accumulated irrespective of their QC status (RT/OK/UT/FAIL)</td>
</tr>
</table>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"><input type="hidden" name="txtinv" /><input type="hidden" name="flagcode" value=""/><input type="hidden" name="fet1" value="" /></td>
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