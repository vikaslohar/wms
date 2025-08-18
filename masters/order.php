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

	
	if(isset($_REQUEST['tp']))
	{
	 $tp = $_REQUEST['tp'];
	}
	$status=trim($_POST['txtdate']);
	if(isset($_POST['frm_action'])=='submit')
	{
			 $sql_in1="Update tbl_user set	loginid='$login',
											password='$pass',
											where uid='$vid' and role='viewer' and scode='$scode'";	
	
	/*echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	*/
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction-Existing Lot selection</title>
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>

function post_value()
{
opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
opener.document.frmaddDepartment.txtlotnoid.value=document.from.foccode1.value;
self.close();
}

function clk(val, val1)
{
document.from.foccode.value=val;
document.from.foccode1.value=val1;
}

function ltchk()
{
		if(document.from1.c1.value=="")
				{
					alert("Please enter Lot No.");
					document.from1.c1.focus();
					return false;
				}
			if(document.from1.c1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.length<14)
				{
				alert("Lot No cannot be less than 14 digits alphanumaric with special character.");
				document.from1.c1.focus();
				return false;
				}
			if(!isChar_W(document.from1.c1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(1)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(2)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(3)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(4)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(5)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(6)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.charAt(7)!="/")
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(8)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(9)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(10)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(11)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(12)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(13)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
}

function lotchk()
{
		if(document.from1.c1.value=="")
				{
					alert("Please enter Lot No.");
					document.from1.c1.focus();
					return false;
				}
			if(document.from1.c1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.length<14)
				{
				alert("Lot No cannot be less than 14 digits alphanumaric with special character.");
				document.from1.c1.focus();
				return false;
				}
			if(!isChar_W(document.from1.c1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(1)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(2)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(3)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(4)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(5)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(6)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.charAt(7)!="/")
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(8)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(9)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(10)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(11)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(12)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(13)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
return true;
}
function mySubmit()
{
if(document.from.foccode.value=="")
{
alert("You must select Lot");
return false;
}
return true;
}	
	
			</script>
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Edit Form Auto suspension of order-Sales</td>
</tr>
  
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		
<?php 
$sql_tbl_sub=mysqli_query($link,"select * from tbl_susorderm where stlotimp_plantcode='$tp1' and stlotimp_impflg=0 and stlotimp_trflg=0 $sqq") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_tbl_sub);
?>
<br style="line-height:5px;" />

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td width="168"  align="left" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="226"  align="center" valign="middle" class="tblheading">&nbsp;<select class="tbltext" name="txtdate" style="width:80px;" onchange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="7" >7</option>
	<option value="8" >8</option>
	<option value="9" >9</option>
	<option value="10" >10</option>
	<option value="11" >11</option>
	<option value="12" >12</option>
   <option value="13" >13</option>
	<option value="14" >14</option>
	<option value="15" >15</option>
	<option value="16" >16</option>
	<option value="17" >17</option>
	<option value="18" >18</option>
	<option value="19" >19</option>
	<option value="20" >20</option>
	<option value="21" >21</option>
	<option value="22" >22</option>
	<option value="23" >23</option>
  <option value="24" >24</option>
  <option value="25" >25</option>
  <option value="26" >26</option>
	<option value="27" >27</option>
	<option value="28" >28</option>
  <option value="29" >29</option>
  <option value="30" >30</option>
																		
	</select><font color="#FF0000">*</font></td>
</tr>

<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" valign="middle" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="post_value();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
