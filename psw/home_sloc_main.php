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
		$sltyp=trim($_POST['sltyp']);
			
		if($sltyp=="lotwise")
		{
		echo "<script>window.location='home_sloc.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else if($sltyp=="barwise")
		{
		echo "<script>window.location='home_sloc4.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else if($sltyp=="upswise")
		{
		echo "<script>window.location='home_sloc1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else if($sltyp=="binwise")
		{
		echo "<script>window.location='home_sloc2.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else if($sltyp=="sbinwise")
		{
		echo "<script>window.location='home_sloc3.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='home_sloc_main.php'</script>";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW- Transaction - Sloc Update -  Home</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
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
<script language="javascript" type="text/javascript">

function sltypchk(sltp)
{
	document.frmaddDept.sltyp.value=sltp;
}

function mySubmit()
{	
	if(document.frmaddDept.sltyp.value=="")
	{
		alert("Please select SLOC Updation Type");
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
          <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - SLOC Updation</td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input type="hidden" name="sltyp" value="" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>




<!--- Table Place Holder --->


  <br />


<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Select SLOC Updation Type</td>
</tr>
<tr class="Light" height="20">
	<td width="50%"align="right" valign="middle" class="tblheading"><input type="radio" name="sloctyp" value="lotwise" onclick="sltypchk(this.value)" />&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;Lot wise SLOC Updation</td>
</tr>

<tr class="Light" height="20">
	<td width="50%"align="right" valign="middle" class="tblheading"><input type="radio" name="sloctyp" value="upswise" onclick="sltypchk(this.value)" />&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;UPS wise SLOC Updation</td>
</tr>
<tr class="Light" height="20">
	<td width="50%"align="right" valign="middle" class="tblheading"><input type="radio" name="sloctyp" value="binwise" onclick="sltypchk(this.value)" />&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;Bin wise SLOC Updation</td>
</tr>
<tr class="Light" height="20">
	<td width="50%"align="right" valign="middle" class="tblheading"><input type="radio" name="sloctyp" value="sbinwise" onclick="sltypchk(this.value)" />&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;Sub-Bin wise SLOC Updation</td>
</tr>
<tr class="Light" height="20">
	<td width="50%"align="right" valign="middle" class="tblheading"><input type="radio" name="sloctyp" value="barwise" onclick="sltypchk(this.value)" />&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;WH-RO SLOC Updation</td>
</tr>
          </table>
<table align="center" width="500" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" /></td>
</tr>
</table>

</td><td width="30"></td>
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
