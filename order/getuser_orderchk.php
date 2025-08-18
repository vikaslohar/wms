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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	 $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	 $b = $_GET['b'];	 
	}
	
if($a=="ordersearch")
{
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by yearsid desc"); 
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="377" align="right"  valign="middle" class="tblheading" >Order No.&nbsp;</td>
<td width="467" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlot" type="text" size="1" class="tbltext" tabindex="0" maxlength="2" value="OR" readonly="true" style="background-color:#EFEFEF"/>&nbsp;<input name="txtlot1" type="text" size="6" class="tbltext" tabindex="0" maxlength="5"/>&nbsp;<select class="tbltext" name="txtlot2" style="width:60px;" onchange="ornock(this.value);">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?>
  </select>&nbsp;<input type="hidden" name="orderno" class="tbltext" size="20" value="" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<?php
}
else if($a=="partysearch")
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="199" align="right"  valign="middle" class="tblheading" >Select Order Type&nbsp;</td>
<td width="177" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpartycat" style="width:80px;" onchange="partycatsl(this.value);">
    <option value="" selected="selected">--Select--</option>
	<option value="Sales">Sales</option>
	<option value="Stock Transfer">Stock Transfer</option>
	<option value="TDF">TDF</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading" >Fill Party Name&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="fillpartyname" class="tbltext" size="35" value="" <?php if($b=="Commercial") echo 'disabled'; ?> title="Fill the TDF Party Name to search which is not available in Party master" onchange="fillpartysl(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp; <input type="hidden" name="partyname" value="" /></td>
</tr>
<tr height="15"><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">Select Order Type to select Party in cases where party is listed under party master.</div></td><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">In case of TDF, where party is not present in party master. Specify Exact Party Name, here</div></td></tr>	
</table>
<div id="orderpsltyp" style="display:none"></div>
<div id="selectpartylocation"style="display:none" ></div>		   
<div id="selectparty"style="display:none" ></div>
<?php
}
else if($a=="datesearch")
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="25">
                  <td width="201" height="30" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
    <td width="175" align="left"  valign="middle"  >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
                  <td width="80" align="right"  valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
                  <td width="384"  colspan="8" align="left"  valign="middle">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDepartment.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
  </tr>
</table>
<?php
}
else
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" >Select Search Type</td>
</tr>
</table>
<?php
}
?>
