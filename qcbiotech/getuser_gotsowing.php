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

if(isset($_GET['a']))
{
	$step = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$srno = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$crop = $_GET['c'];	 
}
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-TERRA : Sowing - Replication <?php echo $srno?></td>
</tr>
<tr class="Dark" height="25">
	<td width="278" align="center" valign="middle" class="tblheading">Date of Sowing</td>
	<td width="376" align="center" valign="middle" class="tblheading">Nursery Plot No. </td>
	<td width="288" align="center" valign="middle" class="tblheading"><?php if($crop=="Paddy Seed" || $crop=="Maize Seed" || $crop=="Pearl Millet"){?>No. of Rows<?php }else{?>No. of Seeds<?php }?></td>
</tr>
<?php $step="DNA";?>
<tr class="Dark" height="25">

<td width="278" align="center" valign="middle" class="smalltbltext"><input name="pdate" id="pdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('pdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	
<td width="376" align="center" valign="middle" class="smalltbltext"><input name="txtpoltno" id="txtpoltno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="chk('<?php echo $srno;?>')">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	
	<td width="288" align="center" valign="middle" class="smalltbltext"><?php if($crop=="Paddy Seed" || $crop=="Maize Seed" || $crop=="Pearl Millet"){?><select class="tbltext" name="txtnoseeds" id="txtnoseeds" style="width:100px;" onchange="chk1('<?php echo $srno;?>')">
    <option value="" selected>--Select--</option>
  	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
    <option value="4" >4</option>
	<option value="5" >5</option>
	<option value="6" >6</option>
	<option value="7" >7</option>
	<option value="8" >8</option>
	<option value="9" >9</option>
  </select><?php }else{?><input name="txtnoseeds" id="txtnoseeds" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="chk1('<?php echo $srno;?>')"><?php }?>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /></td>
</tr>
</table>