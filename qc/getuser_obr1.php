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
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-TERRA : Sowing - Replication <?php echo $srno?></td>
</tr>
<?php $step2="PCR";?>
<tr class="Dark" height="25">
	<td width="166" align="center" valign="middle" class="tblheading">Sample Reciept Date</td>
	<td width="167" align="center" valign="middle" class="tblheading">DNA Extraction Date</td>
	<td width="143" align="center" valign="middle" class="tblheading">DNA Extracted From</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">DNA Extraction Method</td>
	<td width="86" align="center" valign="middle" class="tblheading">Sample Age</td>
</tr>
<?php
$rdate=""; $exdate="";
$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottestss_id='".$gotssid."'")or die(mysqli_error($link));
$rowss1= mysqli_fetch_array($sql_ss1);

	$rdate=$rowss1['gottestss_samprecdate'];
	$tyear=substr($rdate,0,4);
	$tmonth=substr($rdate,5,2);
	$tday=substr($rdate,8,2);
	$rdate1=$tday."-".$tmonth."-".$tyear;
	
	$exdate=$rowss1['gottestss_dnaextdate'];
	$tyear=substr($exdate,0,4);
	$tmonth=substr($exdate,5,2);
	$tday=substr($exdate,8,2);
	$exdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="166" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="167" align="center" valign="middle" class="smalltbltext"><?php echo $exdate1;?></td>
	<td width="143" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
</tr>
</table><br />
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-TERRA : Transplanting - Replication <?php echo $srno?></td>
</tr>
<tr class="Dark" height="25">
	<td width="208" align="center" valign="middle" class="tblheading" rowspan="2">PCR Analysis Date</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Marker</td>
</tr>
<tr class="Dark" height="25">
	<td width="263" align="center" valign="middle" class="tblheading">Number</td>
	<td width="234" align="center" valign="middle" class="tblheading">Type</td>
	<td width="235" align="center" valign="middle" class="tblheading">Name</td>
</tr>
<?php
$pdate="";
$sql_ss2=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$gotssid."'")or die(mysqli_error($link));
$rowss2= mysqli_fetch_array($sql_ss2);

	$pdate=$rowss2['gottestss2_pcrdate'];
	$tyear=substr($pdate,0,4);
	$tmonth=substr($pdate,5,2);
	$tday=substr($pdate,8,2);
	$pdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="208" align="center" valign="middle" class="smalltbltext"><?php echo $pdate1?></td>
	<td width="263" align="center" valign="middle" class="smalltbltext"><?php echo $rowss2['gottestss2_mnumber'];?></td>
	<td width="234" align="center" valign="middle" class="smalltbltext"><?php echo $rowss2['gottestss2_mtype'];?></td>
	<td width="235" align="center" valign="middle" class="smalltbltext"><?php echo $rowss2['gottestss2_mname'];?></td>
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="15" align="center" class="tblheading" id="rephead2">IN-TERRA : Observation</td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Plant Population&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtplantpopn" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['plantpopln'];?>" onchange="plantpop()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;(No. of Plants)</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">1010&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttenno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="tencal(this.value)" />&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttenper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Red Tip&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtredtipno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="redtipcal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtredtipper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Fine Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtfgrainno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtfgrainper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Other&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtotherno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="othercal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtotherper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">A Line&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtalineno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="alinecal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtalineper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Out Cross&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoutcrno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="outcrosscal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtoutcrper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">B Line/Shedder&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtblineno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="sheddercal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtblineper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Long Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlgrainno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="lgraincal(this.value)" />&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlgrainper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Fine Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtfgrainno1" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtfgrainper1" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Bold Grain&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtbgrainno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtbgrainper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Tall Plants&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttallno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttallper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Late Plants&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlplantno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="fgraincal1(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlplantper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>


<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>
<tr class="Dark" height="25">
<td width="206" align="right" valign="middle" class="tblheading">Date of Observation&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="obdate" id="obdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="doobchk('obdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="gotidss" value="<?php echo $gotssid;?>" /></td>
</tr>
</table>