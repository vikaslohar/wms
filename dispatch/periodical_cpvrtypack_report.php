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
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtupsdc=trim($_POST['txtupsdc']);	
		$vcreqsel=trim($_POST['vcreqsel']);	
		$durtyp = $_POST['durtyp'];
		$dotage = $_POST['dotage'];
		$fillagetyp = $_POST['fillagetyp'];
		$totdays = $_POST['totdays'];

		echo "<script>window.location='periodical_cpvrtypack_report1.php?txtcrop=$txtcrop&txtvariety=$txtvariety&txtupsdc=$txtupsdc&vcreqsel=$vcreqsel&dotage=$dotage&durtyp=$durtyp&fillagetyp=$fillagetyp&totdays=$totdays'</script>";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch-Report - Crop Variety Wise Packed Seed Report As on <?php echo date("d-m-Y");?></title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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

function vcrsel(vcrtyp)
{
	if(vcrtyp=="yes")
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="none";
		document.getElementById('filltbl').style.display="none";
		document.getElementById('seltvcr').style.display="block";
		document.frmaddDepartment.durtyp.value='';
	}
	else
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="none";
		document.getElementById('filltbl').style.display="none";
		document.getElementById('seltvcr').style.display="none";
		document.frmaddDepartment.durtyp.value='';
	}
	document.frmaddDepartment.vcreqsel.value=vcrtyp;
}

function durtypsel(durtyp)
{
	if(durtyp=="dsel")
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="block";
		document.getElementById('filltbl').style.display="none";
	}
	else if(durtyp=="dfill")
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="none";
		document.getElementById('filltbl').style.display="block";
	}
	else
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="none";
		document.getElementById('filltbl').style.display="none";
	}
	document.frmaddDepartment.durtyp.value=durtyp;
}
function mySubmit()
{ 
	/*dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date.");
	return false;
	}*/
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please selecy Crop");
		document.frmaddDepartment.txtcrop.value;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please selecy Variety");
		document.frmaddDepartment.txtupsdc.value;
		return false;
	}
	if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please selecy UPS");
		document.frmaddDepartment.txtupsdc.value;
		return false;
	}
	return true;	 
}
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Crop Variety Wise Packed Seed Report As on <?php echo date("d-m-Y");?></td>
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
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading" >Crop Variety Wise Packed Seed Report As on <?php echo date("d-m-Y");?></td>
                </tr>
                <tr height="15">
                  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where croptype='Field Crop' order by cropname Asc"); 
?>                 </tr>
            
 <tr class="Light" height="25">
<td width="272" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="272" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value)">
<option value="ALL" selected>--ALL--</option>
<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
                </tr>
                <tr class="Light" height="25">
                   
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="ALL" selected>--ALL--</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                </tr>
				
				<tr class="Light" height="25">
                  
	<td align="right"  valign="middle" class="tblheading" >UPS&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="upsdc" name="txtupsdc" style="width:170px;" >
<option value="ALL" selected>--ALL--</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                </tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading" >Validity Check Require&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="valchkreq" class="tbltext" value="yes" onclick="vcrsel(this.value)" />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="valchkreq" class="tbltext" value="no" onclick="vcrsel(this.value)" checked="checked" />&nbsp;No<input type="hidden" name="vcreqsel" value="no" /></td>
           </tr>
				
 </table>
 
 <div id="seltvcr" style="display:none">
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >		   	   
<tr class="Light" height="30">
	<td width="272" align="right"  valign="middle" class="tblheading" >Validity Check&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="duration" class="tbltext" value="dsel" onclick="durtypsel(this.value)" />&nbsp;Select&nbsp;&nbsp;<input type="radio" name="duration" class="tbltext" value="dfill" onclick="durtypsel(this.value)" />&nbsp;Fill<input type="hidden" name="durtyp" value="" /></td>
           </tr>
</table>
</div>
 
<div id="seltbl" style="display:none">
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >		   	   
<tr class="Light" height="30">
	<td width="272" align="right"  valign="middle" class="tblheading" >Select Duration&nbsp;</td>
 <td width="272" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="dotage" id="dotage" style="width:100px;" >
    <option value="ALL" selected>--ALL--</option>
  	<option value="less1" >Less than 1 Month</option>
	<option value="1" >1 Month and More</option>
	<option value="2" >2 Months and More</option>
	<option value="3" >3 Months and More</option>
	<option value="4" >4 Months and More</option>
	<option value="5" >5 Months and More</option>
	<option value="6" >6 Months and More</option>
	<option value="7" >7 Months and More</option>
	<option value="more8" >8 Months and More</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>		   
</table>
</div>
<div id="filltbl" style="display:none">
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >		   	   
<tr class="Light" height="30">
	<td width="272" align="right"  valign="middle" class="tblheading" >Select Duration&nbsp;&nbsp;&nbsp;<select class="tbltext" name="fillagetyp" id="fillagetyp" style="width:100px;" >
	<option value="" selected="selected" >-Select-</option>
  	<option value="less" >Less than</option>
	<option value="equalto" >Equal to</option>
	<option value="more" >More than</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 <td width="272" align="left"  valign="middle" class="tbltext">&nbsp;&nbsp;<input type="text" name="totdays" class="tbltext" size="3" maxlength="3" value="" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;days</td>
</tr>		   
</table>
</div>
<br />
 <table align="center" border="0" cellspacing="0" cellpadding="0" width="550" bordercolor="#378b8b" style="border-collapse:collapse">
<tr >
	<td align="left" class="smalltbltext" style="color:#303918;"><font color="#FF0000"><b>Note:</b></font> 1. This is NOT a Consolidated Stock Report but As On Date Stock position of specific crops</td>
</tr>
<tr >
	<td align="left" class="smalltbltext" style="color:#303918;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. This report will be generated for only Field Crop</td>
</tr>
<tr >
	<td align="left" class="smalltbltext" style="color:#303918;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3. Lots are accumulated irrespective of their QC status (RT/OK/UT), except for QC FAIL status</td>
</tr>
</table>
<table width="550" align="center" cellpadding="5" cellspacing="5" border="0" >
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
