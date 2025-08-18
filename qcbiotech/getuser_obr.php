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
	<td width="282" align="center" valign="middle" class="tblheading">Date of Sowing</td>
	<td width="339" align="center" valign="middle" class="tblheading">Sowing Plot</td>
	<td width="321" align="center" valign="middle" class="tblheading">No. of Rows/No. of Seeds</td>
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
	<td width="282" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="339" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_swoingplot']?></td>
	<td width="321" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_noofrows'];?></td>
</tr>
</table><br />
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-TERRA : Transplanting - Replication <?php echo $srno?></td>
</tr>
<tr class="Dark" height="25">
	<td width="125" align="center" valign="middle" class="tblheading">Date of Transplant</td>
	<td width="128" align="center" valign="middle" class="tblheading">Transplant Plot</td>
	<td width="119" align="center" valign="middle" class="tblheading">Range</td>
	<td width="106" align="center" valign="middle" class="tblheading">No. of Rows</td>
	<td width="94" align="center" valign="middle" class="tblheading">Bed no.</td>
	<td width="120" align="center" valign="middle" class="tblheading">Direction</td>
	<td width="120" align="center" valign="middle" class="tblheading">State</td>
	<td width="120" align="center" valign="middle" class="tblheading">Location</td>
</tr>
<?php
$pdate="";
$sql_ss2=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$gotssid."'")or die(mysqli_error($link));
$rowss2= mysqli_fetch_array($sql_ss2);

	$pdate=$rowss1['gottestss_dateoftr'];
	$tyear=substr($pdate,0,4);
	$tmonth=substr($pdate,5,2);
	$tday=substr($pdate,8,2);
	$pdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
<td width="125" align="center" valign="middle" class="smalltbltext"><?php echo $pdate1?></td>

<td width="128" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_trplot']?></td>

<td width="119" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_range']?></td>

<td width="106" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_trrows']?></td>

<td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_bedno']?></td>

<td width="120" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_direction']?></td>
  
<td width="120" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_state']?></td>
  
<td width="120" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_gotlocation']?></td>
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
<td align="right"  valign="middle" class="tblheading">Male Plant&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="malepercal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">Female&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtno1" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="femalecal(this.value)">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtper1" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Tall Plant&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttallno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="tallcal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttallper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right" valign="middle" class="tblheading">OOF&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtoofno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="oofcal(this.value)" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtoofper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txttotno" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC">&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txttotper" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" readonly="true" style="background-color:#CCCCCC"/>  &nbsp;%</td>
</tr>
<tr class="Dark" height="25">
<td width="122" align="right" valign="middle" class="tblheading">Date of Observation&nbsp;</td>
<td width="223" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="obdate" id="obdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="doobchk('obdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="gotidss" value="<?php echo $gotssid;?>" /></td>
</tr>
</table>