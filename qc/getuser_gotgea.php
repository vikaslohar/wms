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
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-SITU : DNA - Replication <?php echo $srno?></td>
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
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-SITU : PCR Analysis - Replication <?php echo $srno?></td>
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
	<td width="208" align="center" valign="middle" class="smalltbltext"><?php echo $pdate1?><input name="pcrdate" type="hidden" value="<?php echo $pdate1?>" /></td>
	<td width="263" align="center" valign="middle" class="smalltbltext"><?php echo $rowss2['gottestss2_mnumber'];?></td>
	<td width="234" align="center" valign="middle" class="smalltbltext"><?php echo $rowss2['gottestss2_mtype'];?></td>
	<td width="235" align="center" valign="middle" class="smalltbltext"><?php echo $rowss2['gottestss2_mname'];?></td>
</tr>
</table><br />
<input name="replid" type="hidden" value="<?php echo $gotssid?>" />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="15" align="center" class="tblheading" id="rephead2">IN-SITU : Gel Electrophorasis Analysis</td>
</tr>
<tr class="Dark" height="25">
<td width="223"  align="right"  valign="middle" class="tblheading">Gel Electrophorasis Analysis Date&nbsp;</td>
<td width="245" align="left" valign="middle" class="tbltext">&nbsp;<input name="gdate" id="gdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('gdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="210" align="right" valign="middle" class="tblheading">Sample Size&nbsp;</td>
<td width="262" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampsize" type="text" size="10" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="sampsize()">&nbsp;&nbsp;<font color="#FF0000">*</font></td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Samples Not Amplified&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampnotamp" type="text" size="10" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="sampnotamp()" />  &nbsp;&nbsp;<font color="#FF0000">*</font></td>

<td align="right" valign="middle" class="tblheading">Amplified Samples&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtampsamp" type="text" size="10" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="ampsamp()" readonly="true" style="background-color:#CCCCCC">&nbsp;&nbsp;<font color="#FF0000">*</font></td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading"><?php if($crop!="Cluster Bean"){?>Male&nbsp;<?php }else{?>Desi Type&nbsp;<?php }?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtmaleno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="malepercal(this.value)">&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtmaleper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading"><?php if($crop!="Cluster Bean"){?>Female&nbsp;<?php }else{?>Branching&nbsp;<?php }?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtfemaleno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="femalecal(this.value)">&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtfemaleper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Outcross&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoutcrno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="outcrcal(this.value)" >&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtoutcrper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">OOF&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoofno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="oofcal(this.value)" >&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txtoofper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;Number&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>

<tr class="Dark" height="25">
<td width="223" align="right" valign="middle" class="tblheading">Base Pair Size&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;Male&nbsp;<input name="txtmale" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC"></td>
<td align="left" valign="middle" class="tbltext">&nbsp;Female&nbsp;<input name="txtfemale" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC"></td>
<td align="left" valign="middle" class="tbltext">&nbsp;Hybrid&nbsp;<input name="txthybrid" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="" readonly="true" style="background-color:#CCCCCC"></td>
</tr>

<tr class="Dark" height="25">
<td width="223" align="right" valign="middle" class="tblheading">Gel Image1&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="file" value="" name="image" onclick="imageck()">&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="25">
<td width="223" align="right" valign="middle" class="tblheading">Gel Image2&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="file" value="" name="image2" onclick="imageck2()"></td>
</tr>
<tr class="Dark" height="25">
<td width="223" align="right" valign="middle" class="tblheading">Gel Image3&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="file" value="" name="image3" onclick="imageck3()"></td>
</tr>
<tr class="Dark" height="25">
<td width="223" align="right" valign="middle" class="tblheading">Gel Image4&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="file" value="" name="image4" onclick="imageck4()"></td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="gotidss" value="<?php echo $gotssid;?>" /></td>
</tr>
</table>