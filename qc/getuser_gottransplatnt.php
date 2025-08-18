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
	$a = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$srno = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$gotssid = $_GET['c'];	 
}
if(isset($_GET['f']))
{
	$crop = $_GET['f'];	 
}
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-TERRA : Sowing - Replication <?php echo $srno?></td>
</tr>
<?php $step1="PCR";?>
<tr class="Dark" height="25">
	<td width="282" align="center" valign="middle" class="tblheading">Date of Sowing</td>
	<td width="339" align="center" valign="middle" class="tblheading">Sowing Plot</td>
	<td width="321" align="center" valign="middle" class="tblheading"><?php if($crop=="Paddy Seed" || $crop=="Maize Seed" || $crop=="Pearl Millet"){?>No. of Rows<?php }else{?>No. of Seeds<?php }?></td>
</tr>
<?php
$rdate=""; $exdate="";
$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottestss_id='".$gotssid."'")or die(mysqli_error($link));
$rowss1= mysqli_fetch_array($sql_ss1);

	$sdate=$rowss1['gottestss_doswdate'];
	$tyear=substr($sdate,0,4);
	$tmonth=substr($sdate,5,2);
	$tday=substr($sdate,8,2);
	$sdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="282" align="center" valign="middle" class="smalltbltext"><input name="pdate" id="pdate" type="text" size="10" class="tbltext" tabindex="0" value="<?php echo $sdate1;?>" readonly="true" style="background-color:#EFEFEF"/></td>
	
	<td width="339" align="center" valign="middle" class="smalltbltext"><input name="txtpoltno" id="txtpoltno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $rowss1['gottestss_swoingplot']?>" readonly="true" style="background-color:#EFEFEF"></td>
	
	<td width="321" align="center" valign="middle" class="smalltbltext"><input name="txtnoseeds" id="txtnoseeds" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $rowss1['gottestss_noofrows'];?>" readonly="true" style="background-color:#EFEFEF"></td>
</tr>
</table><br />
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-TERRA : Transplanting </td>
</tr>
<tr class="Dark" height="25">
	<td width="116" align="center" valign="middle" class="tblheading">Date of Transplant</td>
	<td width="91" align="center" valign="middle" class="tblheading">Transplant Plot</td>
	<td width="87" align="center" valign="middle" class="tblheading">Range</td>
	<td width="95" align="center" valign="middle" class="tblheading">No. of Rows</td>
	<td width="94" align="center" valign="middle" class="tblheading">Bed no.</td>
	<td width="118" align="center" valign="middle" class="tblheading">Direction</td>
	<td width="119" align="center" valign="middle" class="tblheading">State</td>
	<td width="116" align="center" valign="middle" class="tblheading">Location</td>
	<td width="94" align="center" valign="middle" class="tblheading">No. of Plants</td>
</tr>
<tr class="Light" height="20">
<td width="116" align="center" valign="middle" class="smalltbltext"><input name="trdate" id="trdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('trdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txttrplot" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="markername()">&nbsp;<font color="#FF0000">*</font></td>

<td width="87" align="center" valign="middle" class="smalltbltext"><input name="txtrange" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="rangechk()">&nbsp;<font color="#FF0000">*</font></td>

<td width="95" align="center" valign="middle" class="smalltbltext"><input name="txttrrows" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="trrows()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="94" align="center" valign="middle" class="smalltbltext"><input name="txtbedno" type="text" size="10" class="tbltext" tabindex=""  maxlength="20" value="" onchange="bedno()"  >&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="118" align="center" valign="middle" class="smalltbltext"><select class="tbltext" name="txtdirection" style="width:100px;" onchange="dirchk()">
    <option value="" selected>--Select--</option>
	<option value="N-S" >N-S</option>
	<option value="S-N" >S-N</option>
	<option value="E-W" >E-W</option>
	<option value="W-E" >W-E</option>
	<option value="N-S-N" >N-S-N</option>
	<option value="S-N-S" >S-N-S</option>
	<option value="E-W-E" >E-W-E</option>
	<option value="W-E-W" >W-E-W</option>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
  <?php
$sql_st=mysqli_query($link,"select state_id, state_name from tbl_state") or die(mysqli_error($link));
//$row_gotloc=mysqli_fetch_array($sql_gotloc);
?>
<td width="119" align="center" valign="middle" class="smalltbltext"><select class="tbltext" name="txtstate" style="width:100px;" onchange="loc(this.value)">
    <option value="" selected>--Select--</option>
	<?php while($row_gotloc=mysqli_fetch_array($sql_st)){?>
  	<option value="<?php echo $row_gotloc['state_id'];?>" ><?php echo $row_gotloc['state_name'];?></option>
	<?php }?>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
  
<td width="116" align="center" valign="middle" class="smalltbltext" id="itmloc"><select class="tbltext" name="txtlocation" style="width:100px;" onchange="locchk()">
    <option value="" selected>--Select--</option>
	<?php while($row_gotloc=mysqli_fetch_array($sql_gotloc)){?>
  	<option value="<?php echo $row_gotloc['loc_name'];?>" ><?php echo $row_gotloc['loc_name'];?></option>
	<?php }?>
  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
  <td width="94" align="center" valign="middle" class="smalltbltext"><input name="txtnoofplants" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="gotidss" value="<?php echo $gotssid;?>" /></td>
</tr>
</table>