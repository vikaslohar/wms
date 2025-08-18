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
	$baryrcode=$_SESSION['baryrcode'];
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");

	if(isset($_POST['frm_action'])=='Submit')
	{
		$txtlot2= trim($_POST['txtlot2']);	
	 	$txtlot2=$txtlot2;

		echo "<script>window.location='utility_bs1.php?txtlot1=$txtlot2'</script>";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW - Utility - Barcode Details</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
<script src="../include/validation.js"></script>
 <SCRIPT language="JavaScript">
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function lot2chk()
{
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Invalid Barcode");
		document.frmaddDepartment.txtlot2.value="";
		return false;
	}
	if(document.frmaddDepartment.txtlot2.value.length<9)
	{
		alert("Invalid Barcode. Barcode cannot be less than 9 digit");
		document.frmaddDepartment.txtlot2.value="";
		return false;
	}
	else
	{
		var x=document.frmaddDepartment.txtlot2.value.split("");
		var z=document.frmaddDepartment.txtlot2.value.split("");
		var a=z[0]+z[1];
		//var valt=z[2]+z[3]+z[4]+z[5]+z[6]+z[7]+z[8];
		//mltn++;
		if(parseInt(document.from.baryrcode.value)!=parseInt(a))
		{
			alert("Invalid Barcode");
			document.frmaddDepartment.txtlot2.value="";
			return false;
		}
	}
}

function mySubmit()
{
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Invalid Barcode");
		document.frmaddDepartment.txtlot2.value="";
		return false;
	}
	return true;
}
function onloadfocus()
{
document.frmaddDepartment.txtlot2.focus();
}
</script>


<body onload="onloadfocus();">

<!-- actual page start--->	
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="600"  style="border-collapse:collapse">
<br />

<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	
	  <input type="hidden" name="baryrcode" value="<?php echo $baryrcode;?>" /> 
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#477bff" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Barcode Search</td>
</tr>
<tr height="15"><td colspan="2" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
</table>
			
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#477bff" style="border-collapse:collapse">
<tr class="Light" height="25">
	<td width="50%"  align="right"  valign="middle" class="tblheading">&nbsp;Barcode&nbsp; </td>                        
	<td align="left"  valign="middle">&nbsp;<input name="txtlot2" type="text" size="9" class="tbltext"  maxlength="9" onkeypress="return isNumberKey(event)" onchange="lot2chk();"  /><font color="#FF0000">*</font>&nbsp;</td></tr>

</table>
  
<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="typ" value="" /></td>
</tr>
</table>
</form> 
</td>
</tr>
</table>
		  
