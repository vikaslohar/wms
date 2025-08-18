<?php
	session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['id']))
	{
	 $id = $_REQUEST['id'];
	}
	if(isset($_REQUEST['descid']))
	{
	 $descid = $_REQUEST['descid'];
	}

	
		if(isset($_POST['frm_action'])=='submit')
	{
		$cropid=trim($_POST['cropid']);
		$obsbreeder=trim($_POST['observationb']);
		$obsregulatory=trim($_POST['observationr']);
		$obsproduction=trim($_POST['observationp']);
		
		
		$sql_in="insert into tblvarietyprevillege(cropid,cropdescid,varietyid,observationvb,observationvr,observationvp) values(
											  '$cropid',
											  '$descid',
											  '$id',
											  '$obsbreeder',
											  '$obsregulatory',
											  '$obsproduction'
												)";										
		mysqli_query($link,$sql_in)or die(mysqli_error($link));
		{?>
			<script language='javascript' >
			window.opener.location.href=window.opener.location.href;	
			window.close();
			</script>
		<?php }
	}
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seedtrac-FSW Variety Master - Add Variety Observations</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../includes/wysiwyg_beta/wysiwyg.js"></script> 
<script>
function fillreg(form)
	{
	if(from1.same1.checked)
	{
	//alert("This will fill the Observation same as Breeder Observation in to Regulatory Observation.");
	var val=from1.observationb.value;
	from1.observationr.value=val;
	}
	else
	{
	from1.observationr.value="";
	}
	}
function fillpr(form)
	{
	if(from1.same2.checked)
	{
	//alert("This will fill the Observation same as Breeder Observation in to Production Observation.");
	var val1=from1.observationb.value;
	from1.observationp.value=val1;
	}
	else
	{
	from1.observationp.value="";
	}
	
	}
</script>
<script language="javascript" type="text/javascript">
function mySubmit()
{
	if (from1.observationb.value=="") 
	 {
		alert ("Please add Observation in Breeder");
		from1.observationb.focus();
		return false;
	  }
	  
	return true;
}
</script>
<link href="../includes/stylefirri.css" rel="stylesheet" type="text/css" />
</head>
<body topmargin="0" >
<table width="570" height="282"  border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="top">
   <form name="from1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <table width="570" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#ffffff" style="border-collapse:collapse">
	   <?php
	 $sql1=mysqli_query($link,"select * from tblvariety where varietyid='$id' and actstatus='Active'")or die(mysqli_error($link));
  	$row=mysqli_fetch_array($sql1);
	 $crop=$row['cropid'];
	 $sql_c=mysqli_query($link,"select cropname from tblcrop where cropid='$crop'")or die(mysqli_error($link));
	 $row_c=mysqli_fetch_array($sql_c);
	 $sql_d=mysqli_query($link,"select desctype from tblcropdesc where cropdescid='$descid'")or die(mysqli_error($link));
	 $row_d=mysqli_fetch_array($sql_d);
	 ?>
	 <input name="id" value="<?php echo $id?>" type="hidden"> 
	  <input name="cropid" value="<?php echo $crop?>" type="hidden"> 
<tr class="Dark" height="25">
  <td colspan="3" align="center" class="subheading" valign="middle">Variety Observations</td>
</tr>
 <tr class="Light" height="25">
<td width="230"  align="left" valign="middle" class="tbltext">&nbsp;Crop</td>
<td width="260" colspan="2" align="left" valign="middle" class="tbltext">&nbsp;<input type="text" name="crop" class="tbltext"  size="30" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_c['cropname'];?>" ></td></tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext">&nbsp;Popular Variety Name</td>
<td colspan="2" valign="middle" class="tbltext">&nbsp;<input type="text" name="foccode" class="tbltext"  size="30" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['popularname'];?>"  /></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext">&nbsp;Descriptor</td>
<td colspan="2" valign="middle" class="tbltext">&nbsp;<input type="text" name="descriptor" class="tbltext"  size="30" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_d['desctype'];?>" /></td>
</tr>
<tr class="Light" height="25">
<td height="25" valign="middle" class="tbltext">&nbsp;Observation Breeder </td>
<td height="25" colspan="2" valign="middle" class="tbltext">&nbsp;<textarea name="observationb" rows="3" cols="30" class="tbltext"  tabindex="2"></textarea></td>
</tr>
<tr class="Dark" height="25">
<td height="25" valign="middle" class="tbltext" width="260">&nbsp;Copy Observations Same as Breeder</td>
<td width="25" height="25" valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="same1" onClick="fillreg(form)" ></td><td width="321" height="25" valign="middle" class="tbltext" style="font-size:11px;">&nbsp;Checking this will loose original content (if any) of<br />
    &nbsp;Observations - Regulatory</td>
</tr>
<tr class="Light" height="25">
<td height="25" valign="middle" class="tbltext">&nbsp;Observation Regulatory</td>
<td height="25" colspan="2" valign="middle" class="tbltext">&nbsp;<textarea name="observationr" rows="3" cols="30" class="tbltext"  tabindex="2"></textarea></td>
</tr>
<tr class="Dark" height="25">
<td height="25" valign="middle" class="tbltext" width="260">&nbsp;Copy Observations Same as Breeder</td>
<td height="25" valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="same2" onClick="fillpr(form)" ></td>
<td width="321" height="25" valign="middle" class="tbltext" style="font-size:11px">&nbsp;Checking this will loose original content (if any) of<br />&nbsp;Observations - Marketing</td>
</tr>

<tr class="Light" height="25">
<td height="25" valign="middle" class="tbltext">&nbsp;Observation Marketing</td>
<td height="25" colspan="2" valign="middle" class="textbltexttfooter">&nbsp;<textarea name="observationp" rows="3" cols="30" class="tbltext" tabindex="2"></textarea></td>
</tr>

<tr><td  colspan="3">
<table cellpadding="5" cellspacing="5" border="0" width="590">
<tr >
<td align="center" colspan="3"><img src="../images/close_1.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:hand;"/></td>
</tr>
</table>
</td></tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
