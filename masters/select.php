<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['gm']))
	{
	$gm = $_REQUEST['gm'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Expro-Select Zone Head</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
function test(foccode,emp)
{
if (foccode!="")
{
document.from.gm.value=gm;
//document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.gm.checked=true)
{
opener.document.frmaddDept.gm.value = document.from.empname.value;
//opener.document.frmaddDept.empi.value = document.from.foccode.value;

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	
	
			</script>
</head>
<body topmargin="0" >
<table width="370" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Select UPS Allocation </td>
</tr>
  <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <table  border="1" cellspacing="0" cellpadding="0" width="370" align="center" bordercolor="#ffffff" style="border-collapse:collapse">

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading">#</td>
<td  align="left" valign="middle" class="tblheading">&nbsp;Options</td>
</tr>
 
<tr class="Dark" height="25">
<td width="112"><input type="checkbox" name="gm" value="5gm"   onChange="f1(this.value);"/>&nbsp;</td> 
    <td width="212" valign="middle" class="tblheading">&nbsp;5GM</td>
    <td width="107"><input type="checkbox" name="gm" value="50gm"   onChange="f1(this.value);"/>&nbsp;</td> 
    <td width="209" valign="middle" class="tblheading">&nbsp;50GM</td>
   
  </tr>
  <tr>
    <td width="112"><input type="checkbox" name="gm" value="10gm"   onChange="f1(this.value);"/></td> 
    <td width="212" valign="middle" class="tblheading">&nbsp;10GM</td>
    <td width="107"><input type="checkbox" name="gm" value="100gm"   onChange="f1(this.value);"/>&nbsp;</td> 
    <td width="209" valign="middle" class="tblheading">&nbsp;100GM</td>
</tr>
<input type="hidden" name="foccode" value="" /><input type="hidden" name="empname" value="" />
</table>

<table cellpadding="5" cellspacing="5" border="0" width="370">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:hand;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
