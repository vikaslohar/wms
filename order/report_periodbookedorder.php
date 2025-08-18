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
		$sdate = $_POST['sdate'];
		$edate = $_POST['edate'];
		$txtstatesl = $_POST['txtstatesl'];
		$txtlocationsl = $_POST['txtlocationsl'];
		$txtparty = $_POST['txtparty'];
		$txtordertyp = $_POST['txtordertyp'];
		
		//exit;
		echo "<script>window.location='report_periodbookedorder1.php?sdate=$sdate&edate=$edate&txtstatesl=$txtstatesl&txtlocationsl=$txtlocationsl&txtparty=$txtparty&txtordertyp=$txtordertyp'</script>";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order - Report -Periodical Booked Order Report</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="party_bor.js"></script>
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
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

function locslchk(stateval)
{
	document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	document.frmaddDepartment.txtparty.selectedIndex=0;
	document.frmaddDepartment.txtlocationsl.options.length = 1;
	document.frmaddDepartment.txtparty.options.length = 1;
	showUser(stateval,'locations','location','','','','','','');
}

function stateslchk(valloc)
{
	if(document.frmaddDepartment.txtstatesl.value=="" || document.frmaddDepartment.txtstatesl.value=="ALL")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
		document.frmaddDepartment.txtparty.selectedIndex=0;
		document.frmaddDepartment.txtlocationsl.options.length = 1;
		document.frmaddDepartment.txtparty.options.length = 1;
	}
	else
	{
		document.frmaddDepartment.txtparty.selectedIndex=0;
		document.frmaddDepartment.txtparty.options.length = 1;
		var classval=document.frmaddDepartment.txtstatesl.value;
		showUser(classval,'selectparty','partychk1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}
function locchk()
{
	if(document.frmaddDepartment.txtlocationsl.value=="" || document.frmaddDepartment.txtlocationsl.value=="ALL")
	{
		alert("Please Select Location");
		document.frmaddDepartment.txtparty.selectedIndex=0;
		document.frmaddDepartment.txtparty.options.length = 1;
	}
}
function ortpchk()
{
	document.frmaddDepartment.txtcrop.selectedIndex=0;
	document.frmaddDepartment.txtvariety.selectedIndex=0;
	document.frmaddDepartment.txtups.selectedIndex=0;
	//document.frmaddDepartment.txtcrop.options.length = 1;
	document.frmaddDepartment.txtvariety.options.length = 1;
	document.frmaddDepartment.txtups.options.length = 1;
}
function modetchk(classval)
{
	showUser(classval,'vitem','crop1','','','','','');
}
function upssel(varval)
{
	var sdate=document.frmaddDepartment.sdate.value;
	var edate=document.frmaddDepartment.edate.value;
	var ortyp=document.frmaddDepartment.txtordertyp.value;
	showUser(varval,'upsitem','upsitmsel',ortyp,sdate,edate,'','');
}
function mySubmit()
{ 
	dt1=getDateObject(document.frmaddDepartment.cdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.edate.value,"-");
	if(dt2 > dt1)
	{
		alert("Please select Valid Date.");
		return false;
	}
	if(dt3 > dt1)
	{
		alert("Please select Valid Date.");
		return false;
	}
	if(dt2 > dt3)
	{
		alert("Please select Valid Date.");
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
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Periodical Booked Order Report</td>
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
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Periodical Booked Order Report</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <?php
 /*$code="";
$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
		<tr class="Dark" height="25">
		<td align="right" height="30" valign="middle" class="tblheading">Period From&nbsp;</td>
     <td align="left"  valign="middle" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000" >*</font></td>
           <td align="right" width="78" height="30" valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
           <td align="left"  valign="middle">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000" >*</font></td>
   </tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>		   
   <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtordertyp" style="width:170px;" onchange="ortpchk();">
<option value="ALL" selected>ALL</option>
<option value="sales">Sales</option>
<option value="branch">Branch and C&amp;F</option>
<option value="tdf">TDF</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="ALL" selected="selected">ALL</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
	
<tr class="Light" height="30">
<td width="137"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="283" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="ALL" selected>ALL</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="78"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext" id="selectparty">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="locchk()"  >
<option value="ALL" selected="selected">ALL</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
  

</table>

<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"></td>
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
