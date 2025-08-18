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
	
if(isset($_REQUEST['tid']))
	{
		$itmid = $_REQUEST['tid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	$tid=trim($_POST['tid']);
	$txtpp=trim($_POST['txtpp']);
	echo "<script>window.location='getuser_sts.php?tid=$tid&txtpp=$txtpp'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction-Qc Seed Testing slip</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="tid" value="<?php echo $itmid?>" type="hidden"> <br />
<br />

<table align="center" border="1" width="200" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
      <tr class="tblsubtitle" height="16">
        <td colspan="2"  align="center" class="tblheading">Select Number of Print</td>
      </tr>

      <tr class="Light" height="16">
        <td width="50%" align="right"  valign="middle" class="smalltblheading">&nbsp;No. of Slips&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading">&nbsp;<select class="tbltext" name="txtpp" style="width:40px;">
    <option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      </tr>

</table>

<br/>
<table width="200" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="center" colspan="3"><img src="../images/close_1.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/next.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="post_value();"/></td>
</tr>
</table>
</form>
