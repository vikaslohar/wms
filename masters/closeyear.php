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
	
if(isset($_REQUEST['yrsid']))
	{
	$yrsid = $_REQUEST['yrsid'];
	}
	/*if(isset($_REQUEST['month']))
	{
	$month = $_REQUEST['month'];
	}*/
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$locdate=$_POST['ycode'];
		$yrid=trim($_POST['yrid']);
		
	$sql_yr2=mysqli_query($link,"update tblyears set years_flg=0, years_status='c' where yearsid='$yrsid'")or die("Error:".mysqli_error($link));
	
	$sql_yr3=mysqli_query($link,"update tblyears set ycode='$locdate', years_flg=1, years_status='a' where yearsid='$yrid'")or die("Error:".mysqli_error($link));
	
		/*$sql_in=mysqli_query($link,"update tblyears set  where yearsid='$yrid'")or die("Error:".mysqli_error($link));
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{*/
			echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";		
		//}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration- Master- Year cosing</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script src="farrival.js"></script>
<script language='javascript'>
function mySubmit()
{ 
if(document.from.yflg.value > 0)
{
alert("Duplicate Year Code");
return false;
}
if(document.from.ycode.value=="")
{
alert("Enter Year Code");
return false;
}
if(document.from.ycode.value.charCodeAt(0)==document.from.lcode.value.charCodeAt(0)+1)
{
alert("Sequencial Year Code not allowed");
return false;
}
return true;
}

			</script>
</head>
<body topmargin="0" >
<table width="370" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle" height="25">Year Closing</td>
</tr>
   
  <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	<input name="frm_action" value="submit" type="hidden"> 
	 <table  border="1" cellspacing="0" cellpadding="0" width="370" align="center" bordercolor="#ffffff" style="border-collapse:collapse">

 <?php
 	$quer3=mysqli_query($link,"select * from tblyears where yearsid='$yrsid'"); 
	$noticia3 = mysqli_fetch_array($quer3);
	$yr=$noticia3['year1'];
	$yrid=$yrsid+1;
	$yr1=$yr+1;
	/*$sql_yr2=mysqli_query($link,"update tblyears set years_flg=0, years_status='c' where yearsid='$yrsid'")or die("Error:".mysqli_error($link));
	
	$sql_yr3=mysqli_query($link,"update tblyears set years_flg=1, years_status='a' where yearsid='$yrid'")or die("Error:".mysqli_error($link));*/
?>
<tr class="Dark" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="2">Add the year code to close current year: <?php echo $yr;?><br /> and activate new year: <?php echo $yr1;?> </td>
</tr>
<?php
 	/*$quer31=mysqli_query($link,"select * from tblyears where yearsid='$yrsid'"); 
	$noticia31 = mysqli_fetch_array($quer31);
	$yr1=$noticia31['year_name'];
	$yrid1=$yrsid-1;
	*/
	
	$sql_yr21=mysqli_query($link,"select * from tblyears where yearsid='$yrsid'")or die("Error:".mysqli_error($link));
	$row_yr21=mysqli_fetch_array($sql_yr21);
	$lcode=$row_yr21['ycode'];
?>
<tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">Year Code&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input type="text" name="ycode" class="tbltext" size="1" maxlength="1" onBlur="javascript:this.value=this.value.toUpperCase();" onchange="showUser(this.value,'ycds','ycd');"  /></td>
</tr>

</table>
<div id="ycds"><input type="hidden" name="yflg" value="0" /></div>
<table cellpadding="5" cellspacing="5" border="0" width="370">
<tr >
<td align="center" colspan="3"><input type="image" src="../images/add.gif" alt="Generate" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/>&nbsp;&nbsp;<img src="../images/close_1.gif" alt="Close" border="0" style="display:inline;cursor:pointer;" onclick="javascript:window.close();"/><input type="hidden" name="lcode" value="<?php echo $lcode;?>" /><input type="hidden" name="yrid"  / value="<?php echo $yrid;?>" ></td>
</tr>
</table>
<!--<table cellpadding="5" cellspacing="5" border="0" width="370">
<tr >
<td align="center" colspan="3"><input type="image" src="../images/close_1.gif" alt="Close" border="0" style="display:inline;cursor:pointer;"/></td>
</tr>
</table>-->
</form>
</td></tr>
</table>

</body>
</html>
