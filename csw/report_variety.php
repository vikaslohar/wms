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
		$age = $_REQUEST['txtage'];		
		echo "<script>window.location='report_variety1.php?age=$age'</script>";
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW - Unidentified Stock  Report</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
</head>
<script src="stock.js"></script>
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

function mySubmit()
{ 
if(document.frmaddDepartment.txtcrop.value == "")
{
alert("Please select Crop");
return false;
}
	return true;	 
}
function modetchk(classval)
{	//alert("hi");
			showUser(classval,'vitem','item','','','','','');
}

</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Coded Condition Seed Report </td>
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
            <td><table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">Coded Condition Seed Report</td>
                </tr>
                <tr height="15">
                  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>
                <?php
 /*$code="";
$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
              <!--  <tr class="Dark" height="25">
                  <td width="131" height="30" align="right" valign="middle" class="tblheading">&nbsp;Period&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
                  <td width="162" align="left"  valign="middle" >&nbsp;
                    <input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
                  <td width="80" align="right"  valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
                  <td width="191" align="left"  valign="middle" >&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDepartment.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
                </tr>
                <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <tr class="Light" height="25">
<td align="right" width="50%" height="30" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td align="left"  valign="middle" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"></font></td>
                </tr>-->
                               
<!----><tr class="Light" height="25">
	<td align="right"  valign="middle" class="tblheading" >Coded Seed&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtage" style="width:170px;" >
<option value="ALL" selected>--ALL--</option>
<option value="morethan60">--More than 60 Days--</option>
<!--<option value="more90">--More Than 90 Days--</option>-->
</select>&nbsp;</td>
</tr>				
             

              </table>
                <table width="600" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" />
                        <input type="hidden" name="txtinv" />
                      <input type="hidden" name="flagcode" value=""/>
                      <input type="hidden" name="flagcode1" value=""/></td>
                  </tr>
              </table></td>
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
