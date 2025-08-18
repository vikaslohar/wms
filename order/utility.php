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

	if(isset($_POST['frm_action'])=='Submit')
	{
			  				
		 	$txtlot1=trim($_POST['txtlot1']);
		 	/*$variety=trim($_POST['txtvariety']);
		  	$org=trim($_POST['txtorganizer']);
		   	$farmer=trim($_POST['txtfarmer']);
			$sdate=trim($_POST['sdate']);
			$edate=trim($_POST['edate']);*/
			echo "<script>window.location='utility1.php?txtlot1=$txtlot1'</script>";	
			}
			
		
		
	
//}
//}
//}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Utility Lot Biography</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
<script src="../include/validation.js"></script>
 <SCRIPT language="JavaScript">

function mySubmit()
{
if(document.frmaddDepartment.txtlot1.value!="") 
				{
						  
				if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
				{
					alert("Lot No.cannot start with a Space!");
					return false;
					document.frmaddDepartment.txtlot1.focus();
				} 
		   
				if(document.frmaddDepartment.txtlot1.value.length < 5)
				{
				alert("Lot No. can be of 14 alphanumric digits e.g. GK00015/00000R");
				return false;
				document.frmaddDepartment.txtlot1.focus();
				}
		   
				if(document.frmaddDepartment.txtlot1.value!="") 
				 {
		  
					if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
					{
					alert("Lot No. can be of14 alphanumric digits e.g. GK00015/00000R");
					document.frmaddDepartment.txtlot1.focus();
					return false;
					} 
				 
					if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(1)))
					{
					alert("Lot No. can be of 14 alphanumric digits e.g. GK00015/00000R");
					document.frmaddDepartment.txtlot1.focus();
					return false;
					}  
			   
						
						}}  
					}
					</script>


<body>

<!-- actual page start--->	
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="600"  style="border-collapse:collapse">
<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Lot Biography </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
</table>
			
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#cc30cc" style="border-collapse:collapse">
		   <tr class="Light" height="25">
		  <td width="188"  align="right"  valign="middle" class="tblheading">&nbsp;Lot Number&nbsp; </td>                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<input name="txtlot1" type="text" size="15" class="tbltext" tabindex="0" maxlength="14"/>
           &nbsp;<font color="#FF0000">*</font>&nbsp;OR</td>
		   </tr>
		   <tr class="Light" height="25">
		  <td width="188"  align="right"  valign="middle" class="tblheading">&nbsp;Party Name&nbsp; </td>                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<input name="txtlot1" type="text" size="15" class="tbltext" tabindex="0" maxlength="14"/>
           &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>

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
		  
