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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$crop = $_POST['txtcrop'];
		$veriety = $_POST['txtvariety'];
		echo "<script>window.location='crop_ver_sr_report1.php?txtcrop=$crop&txtvariety=$veriety'</script>";	
	}

	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Viewer - Transaction - Sales Return</title>
<link href="../include/main_viewer.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


</head>
<script src="srcrrep.js"></script>
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

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function modetchk(classval)
{	
	showUser(classval,'vitem','vitem','','','','','');
}

function mySubmit()
{
if(document.frmaddDepartment.txtcrop.value=="")
{
alert("Please selct Crop");
return false;
}
if(document.frmaddDepartment.txtvariety.value=="")
{
alert("Please selct Variety");
return false;
}
return true;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_viewer.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/viewer_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" style="border-bottom:solid; border-bottom-color:#ef0388" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - Party Wise Sales Return Report</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >

<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
	 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>


<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#ef0388" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td align="center" class="tblheading">Party Wise Sales Return Report</td>
</tr>
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#ef0388" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop</td>
  <td align="right" class="tblheading">Variety&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#ef0388" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="109" height="24" align="Center" class="tblheading">S.No</td>
	<td width="110" align="Center" class="tblheading">Party Name</td>
	<td width="78" align="Center" class="tblheading">Location</td>
	<td width="82" align="Center" class="tblheading">Crop</td>
	<td width="109" align="Center" class="tblheading">Variety</td>
	<td width="149" align="Center" class="tblheading">Size</td>
	<td width="67" align="Center" class="tblheading">Qty Ok</td>
	<td width="128" align="Center" class="tblheading">Qty Fail</td>
	</tr>
<tr height="25">
	<td width="109" align="Center" class="tblheading">&nbsp;</td>
	<td width="110" align="Center" class="tblheading">&nbsp;</td>
	<td width="78" align="Center" class="tblheading">&nbsp;</td>
	<td width="82" align="Center" class="tblheading">&nbsp;</td>
	<td width="109" align="Center" class="tblheading">&nbsp;</td>
	<td width="149" align="Center" class="tblheading">&nbsp;</td>
	<td width="67" align="Center" class="tblheading">&nbsp;</td>
	<td width="128" align="Center" class="tblheading">&nbsp;</td>
</tr>
<tr height="25">
	<td width="109" align="Center" class="tblheading">&nbsp;</td>
	<td width="110" align="Center" class="tblheading">&nbsp;</td>
	<td width="78" align="Center" class="tblheading">&nbsp;</td>
	<td width="82" align="Center" class="tblheading">&nbsp;</td>
	<td width="109" align="Center" class="tblheading">&nbsp;</td>
	<td width="149" align="Center" class="tblheading">&nbsp;</td>
	<td width="67" align="Center" class="tblheading">&nbsp;</td>
	<td width="128" align="Center" class="tblheading">&nbsp;</td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="crop_ver_sr_report.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a></td>
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

  