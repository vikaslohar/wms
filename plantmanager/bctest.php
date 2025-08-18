<?
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
		exit;	
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant Manager - Transaction - BC Test</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="bctest.js"></script>
<script src="../include/validation.js"></script>
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

function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function chkbar(mltval,mltno)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbc"+mltno;
	document.getElementById(txtbarcode).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(flg==0)
	{
		var bardet="wtpdn"+mltno;
		showUser(mltval,bardet,'bcwtpdn',mltno,'','','','','','','');
		setTimeout(function(){if(mltno!=10)	{ var txtbar="txtwtws"+mltno; document.getElementById(txtbar).focus(); }}, 200);
	}
}
function nxtfcschk(mltno)
{
	if(mltno!=10)
	{
		var txtbarcode="txtwtws"+mltno+1;
		document.getElementById(txtbarcode).focus();
	}
}
function chkwtws(mltval,mltno)
{
	if(mltval!="")
	{
		//alert(mltno);
		//var z=mltval.split("");
		//var x=0;
		var mltn=parseInt(mltno)+1;
		/*for(var i=3; i<z.length-2; i++)
		{
			x=x+z[i];
		}*/
		//alert(x);
		//x=parseFloat(x);
		//alert(x);
		/*var txtbarc="txtacwt"+mltno;
		var txtbrc="txtdiffwt"+mltno;*/
		var txtbr="txtwtpdn"+mltno;
		var txtbar="txtbc"+mltn; 
		//alert(txtbar);
		/*document.getElementById(txtbarc).value=parseFloat(x);
		document.getElementById(txtbrc).value=Math.round((parseFloat(x)-parseFloat(document.getElementById(txtbr).value))*1000)/1000;
		if(document.getElementById(txtbrc).value=='NaN')document.getElementById(txtbrc).value="";*/
		setTimeout(function(){if(mltno!=10)	{ document.getElementById(txtbar).focus(); }}, 200);
	}
	else
	{
		return false;
	}
}
function myReset()
{
	//document.frmaddDepartment.reset();
	var frm_elements = document.frmaddDepartment.elements;
	for (i = 0; i < frm_elements.length; i++)
	{
		field_type = frm_elements[i].type.toLowerCase();
		switch (field_type)
		{
		case "text":
		case "password":
		case "textarea":
		case "hidden":
			frm_elements[i].value = "";
			break;
		case "radio":
		case "checkbox":
			if (frm_elements[i].checked)
			{
				frm_elements[i].checked = false;
			}
			break;
		case "select-one":
		case "select-multi":
			frm_elements[i].selectedIndex = -1;
			break;
		default:
			break;
		}
	}
	document.getElementById('txtbc1').focus();
}
function onloadfocus()
{
	document.getElementById('txtbc1').focus();
}
</script>


<body onload="onloadfocus();">
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
          <td valign="top"><? require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline"><!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Barcode Test</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<? $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
</br>
<?
$sql_opr=mysqli_query($link,"select * from tblopr where id='".$loginid."' AND plantcode='$plantcode'") or die(mysqli_error($link));
	$row_opr=mysqli_fetch_array($sql_opr);

	$trvflag=$row_opr['trvflag'];
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Barcode Test</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#4ea1e1" style="border-collapse:collapse;">
<tr class="tblsubtitle" height="25">
<td align="center" class="tblheading">#</td>
<td align="center" class="tblheading">Barcode</td>
<td align="center" class="tblheading">Weight in MP</td>
<td align="center" class="tblheading">Weight as per WS</td>
<!--<td align="center" class="tblheading">Actual Weight</td>
<td align="center" class="tblheading">Difference</td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">1</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc1" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '1');" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn1"><input name="txtwtpdn" id="txtwtpdn1" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="" /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws1" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '1');" value=""  />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt1" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value="" /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt1" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value="" /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">2</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc2" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '2');" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn2"><input name="txtwtpdn" id="txtwtpdn2" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="" /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws2" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value ,'2');"  value="" />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt2" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value="" /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt2" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value="" /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">3</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc3" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '3');" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn3"><input name="txtwtpdn" id="txtwtpdn3" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="" /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws3" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '3');" value=""  />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt3" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value="" /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt3" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value="" /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">4</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc4" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '4');" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn4"><input name="txtwtpdn" id="txtwtpdn4" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="" /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws4" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '4');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt4" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt4" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">5</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc5" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '5');" onBlur="nxtfcschk('5')" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn5"><input name="txtwtpdn" id="txtwtpdn5" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value=""  /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws5" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '5');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt5" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt5" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">6</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc6" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '6');" onBlur="nxtfcschk('6')" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn6"><input name="txtwtpdn" id="txtwtpdn6" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value=""  /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws6" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '6');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt6" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt6" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">7</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc7" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '7');" onBlur="nxtfcschk('7')" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn7"><input name="txtwtpdn" id="txtwtpdn7" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value=""  /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws7" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '7');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt7" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt7" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">8</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc8" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '8');" onBlur="nxtfcschk('8')" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn8"><input name="txtwtpdn" id="txtwtpdn8" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value=""  /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws8" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '8');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt8" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt8" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">9</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc9" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '9');" onBlur="nxtfcschk('9')" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn9"><input name="txtwtpdn" id="txtwtpdn9" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value=""  /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws9" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '9');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt9" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt9" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
<tr class="Light" height="25">
	<td width="34"  align="center"  valign="middle" class="tblheading">10</td>                              
	<td width="122" align="center"  valign="middle"><input name="txtbc" id="txtbc10" type="text" size="11" class="tbltext" tabindex="0" maxlength="11" onchange="chkbar(this.value, '10');" onBlur="nxtfcschk('10')" value="" />&nbsp;<font color="#FF0000">*</font></td>
	<td width="135"  align="center"  valign="middle" class="tblheading" id="wtpdn10"><input name="txtwtpdn" id="txtwtpdn10" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value=""  /></td>                               
	<td width="147" align="center"  valign="middle">&nbsp;<input name="txtwtws" id="txtwtws10" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" onchange="chkwtws(this.value, '10');" value=""   />&nbsp;<font color="#FF0000">*</font></td>
	<!--<td width="108" align="center"  valign="middle"><input name="txtacwt" id="txtacwt10" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>
	<td width="90" align="center"  valign="middle"><input name="txtdiffwt" id="txtdiffwt10" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"  readonly="true" style="background-color:#CCCCCC" value=""  /></td>-->
</tr>
</table>
<br />

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><img src="../images/reset.gif" alt="Submit Value" onClick="return myReset();"  border="0" style="cursor:pointer;" /></td>
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

  