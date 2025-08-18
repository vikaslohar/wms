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
			$printopt=$_POST['fet1'];
	if($printopt == "1" )
{
	echo "<script>window.location='../reportarrival/preport_plant.php'</script>";	
}	
if($printopt == "2" )
{
	echo "<script>window.location='../reportarrival/report_difference.php'</script>";	
}

if($printopt == "3" )
{
	echo "<script>window.location='../reportarrival/report_organiser.php'</script>";	
}
if($printopt<="4"){
echo "<script>window.location='../reportarrival/report_location.php'</script>";	
}
if($printopt<="5"){
echo "<script>window.location='../reportarrival/report_productionp.php'</script>";	
}
if($printopt<="6")
{
echo "<script>window.location='../reportarrival/report_crop.php'</script>";	
}
if($printopt<="7"){
echo "<script>window.location='../reportarrival/report_stock.php'</script>";
}
if($printopt<="8"){
echo "<script>window.location='../reportarrival/report_arrival.php'</script>";
}
if($printopt<="9"){
echo "<script>window.location='../reportarrival/report_variety.php'</script>";
}
if($printopt<="10"){
echo "<script>window.location='report_unidentified.php'</script>";
}
/*if($printopt<="11"){
echo "<script>window.location='report_parameter.php'</script>";
}*/
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying-Master Reports- Home</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  

function test1(fet11)
{
if (fet11!="")
{
document.frmaddDepartment.fet1.value=fet11;
}
}	
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
{
alert("Please select Report");
return false;
}
	return true;	 
}

 </SCRIPT>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0"bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
       <tr>
          <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
       </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - PM Reports</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="1" width="350" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="2" align="center" class="tblheading">&nbsp;Select - PM Reports</td>
</tr>
<tr class="Light" height="25">
<td width="39" align="right"  valign="left" class="tbltext">&nbsp;<input type="radio" name="fet" value="1" onClick="test1(this.value);" /></td>
    <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Consolidated&nbsp;Arrival&nbsp;Report</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="left" class="tbltext">&nbsp;<input type="radio" name="fet" value="2" onClick="test1(this.value);" /></td>
    <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Material&nbsp;Transit&nbsp;difference&nbsp;Report</td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="left" class="tbltext">&nbsp;<input type="radio" name="fet" value="3" onClick="test1(this.value);" /></td>
    <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Organiser&nbsp;Wise&nbsp;Report</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="4" onClick="test1(this.value);" /></td>
 <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Production&nbsp;Location&nbsp;Wise&nbsp;Reportr</td >
 </tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="5" onClick="test1(this.value);" /></td>
 <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Production&nbsp;Personnel&nbsp;Wise&nbsp;Report </td>  
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="6" onClick="test1(this.value);" /></td>
    <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Stock&nbsp;Transfer&nbsp;Crop&nbsp;Variety&nbsp;Repor</td>  
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="7" onClick="test1(this.value);" /></td>
 <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Stock&nbsp;Transfer&nbsp;Plant&nbsp;Wise&nbsp;Report</td>  
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="8" onClick="test1(this.value);" /></td>
  <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Trading&nbsp;Vendor&nbsp;Wise&nbsp;Report</td> 
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="9" onClick="test1(this.value);" /></td>
    <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Report </td>  
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="10" onClick="test1(this.value);" /></td>
    <td width="305" align="left"  valign="middle" class="tblheading">&nbsp;Unidentified Bags Report</td>  
</tr>

<!--<tr class="Light" height="25">
<td width="284" colspan="3" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="11" onClick="test1(this.value);" /></td>
    <td width="284" align="left"  valign="middle" class="tblheading">&nbsp;Parameters Master </td>  
</tr>-->
</table>

<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/next.gif" alt="next" OnClick="return mySubmit()" border="0" style="display:inline;cursor:pointer;">&nbsp;<input type="hidden" name="fet1" value="" /></td>	
</tr>
</table>

</form>
</td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>

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
