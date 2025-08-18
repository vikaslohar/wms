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
		$crop=trim($_POST['txtcrop']);
		$sig=trim($_POST['txtsig']);
		$sig1=trim($_POST['txtsig1']);
		$txtsmp=trim($_POST['txtsmp']);		
		$expdt=trim($_POST['expdt']);		
		$txtseedsize=trim($_POST['txtseedsize']);		
		$txtnosior=trim($_POST['txtnosior']);		
		
	$query=mysqli_query($link,"SELECT * FROM tblcrop where cropname='$crop'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Crop is already present");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblcrop(cropname, sig, sig1, expdt, smp, seedsize, nosior) values('$crop', '$sig', '$sig1', '$expdt', '$txtsmp', '$txtseedsize', '$txtnosior')";
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_crop.php?print=add'</script>";	
		}
		}
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administration - Crop Master -Add Crop</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function onloadfocus()
	{
	document.frmaddcrop.txtcrop.focus();
	}
 
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 32 && charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

//return true;
}
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }


function f1(val)
{
	if(document.frmaddcrop.txtcrop.value=="")
	{
	alert("Define Name  of the Crop");
	 document.frmaddcrop.txtcropshort.value="";
	 document.frmaddcrop.txtcrop.focus();
	 return false;
	}
	}
	function f2(val)
{
	if(document.frmaddcrop.txtcropshort.value=="")
	{
	alert("Add Crop Code. ");
	 document.frmaddcrop.txtscicrop.value="";
	 document.frmaddcrop.txtcropshort.focus();
	 return false;
	}
}


function mySubmit()
{
	document.frmaddcrop.txtcrop.value=ucwords_w(document.frmaddcrop.txtcrop.value.toLowerCase())

	if(document.frmaddcrop.txtcrop.value=="")
	{
	alert("Please Enter Crop Name ");
	document.frmaddcrop.txtcrop.focus();
	return false;
	}
	if(document.frmaddcrop.txtcrop.value.charCodeAt() == 32)
	{
	alert("Crop Name cannot start with space.");
	document.frmaddcrop.txtcrop.focus();
	return false;
	}
    if (document.frmaddcrop.txtsig.value=="") 
	  {
		alert ("Please add SIG (OP)");
		document.frmaddcrop.txtsig.focus();
		return false;
	  } 
	if (document.frmaddcrop.txtsig1.value=="") 
	  {
		alert ("Please add SIG (Hybrid)");
		document.frmaddcrop.txtsig1.focus();
		return false;
	  } 
	  
	  if (document.frmaddcrop.expdt.value=="") 
	  {
		alert ("Please add EDOR");
		document.frmaddcrop.expdt.focus();
		return false;
	  } 
	  if (document.frmaddcrop.txtsmp.value=="") 
	  {
		alert ("Please add Standard Moisture %");
		document.frmaddcrop.txtsmp.focus();
		return false;
	  } 
	  if (document.frmaddcrop.txtseedsize.value=="") 
	  {
		alert ("Please Select Size of Seed");
		document.frmaddcrop.txtseedsize.focus();
		return false;
	  } 
	  if (document.frmaddcrop.txtnosior.value=="") 
	  {
		alert ("Please Select No of Seed in 1 Replication");
		document.frmaddcrop.txtnosior.focus();
		return false;
	  } 
	 return true;
}

</SCRIPT>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()">
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
	  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Crop Master - Add </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	   
	  <form name="frmaddcrop" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('You are adding:\nCrop :  '+document.frmaddcrop.txtcrop.value+'\nSIG: ' +document.frmaddcrop.txtsig.value);" onReset="onloadfocus();"> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="499" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1"style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading">Add a NEW Crop </td>
</tr>
<tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">Crop Name &nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<input name="txtcrop" type="text" size="30" class="tbltext" tabindex="0" maxlength="30" onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());"  onkeypress="return isCharKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">SIG (OP)&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<input name="txtsig" type="text" size="2" class="tbltext" tabindex="0" maxlength="2"  onkeypress="return isNumberKey(event)"  />
%&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">SIG (Hybrid)&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<input name="txtsig1" type="text" size="2" class="tbltext" tabindex="0" maxlength="2"  onkeypress="return isNumberKey(event)"  />
%&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td rowspan="2" align="right" valign="middle" class="tblheading">&nbsp;Expected Days of QC Result (EDOR)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="expdt" type="text" size="1" class="tbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="2" />&nbsp;<font color="#FF0000" >*</font>&nbsp;From Date of Sample Collection</td>
</tr>	
<tr class="Light" height="25">
<td align="left" valign="middle" class="smalltblheading">&nbsp;Applicable only for Unidentified &amp; Coded Seed</td>
</tr>
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">Standard Moisture %&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<input name="txtsmp" type="text" size="4" class="tbltext" tabindex="0" maxlength="5"  onkeypress="return isNumberKey1(event)"  />
%&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>	

<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">Size of Seed&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<select name="txtseedsize" style="size:150px" class="tbltext">
<option selected="selected" value="">--Select--</option>
<option value="Big">Big</option>
<option value="Medium">Medium</option>
<option value="Small">Small</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>	

<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">No of Seed in 1 Replication - SGT&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<select name="txtnosior" style="size:150px" class="tbltext">
<option selected="selected" value="">--Select--</option>
<option value="50">50</option>
<option value="100">100</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>	
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">No of Seed in 1 Replication - FGT&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<select name="txtnosiorfgt" style="size:150px" class="tbltext">
<option selected="selected" value="">--Select--</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>		 
</table>


<table align="center" width="509" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td width="489" align="center" valign="top"><a href="home_crop.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="javascript:document.frmaddcrop.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:pointer;"></a>&nbsp;
  <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:pointer;"></td>
</tr>
</table>
</td>
<td width="30"></td>
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
