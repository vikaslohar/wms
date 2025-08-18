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
<?php $step1="PCR";?>
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
	<td width="166" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?><input name="recdate" type="hidden" value="<?php echo $rdate1;?>"/></td>
	<td width="167" align="center" valign="middle" class="smalltbltext"><?php echo $exdate1;?><input name="dnaextdate" type="hidden" value="<?php echo $exdate1;?>" /></td>
	<td width="143" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
</tr>
</table><br />
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-SITU : PCR Analysis</td>
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
<tr class="Light" height="25">
	<td width="208" align="center" valign="middle" class="smalltbltext"><input name="pcrdate" id="pcrdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" onchange="pcrdate()"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('pcrdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	
	<td width="263" align="center" valign="middle" class="smalltbltext"><select class="tbltext" name="txtmarkerno" style="width:100px;" onchange="markerno()">
<option value="" selected>--Select--</option>
<option value="Single">Single</option>
<option value="Multiplex">Multiplex</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
	<td width="234" align="center" valign="middle" class="smalltbltext"><select class="tbltext" name="txtmarkertype" style="width:100px;" onchange="markertype()">
<option value="" selected>--Select--</option>
<option value="SSR">SSR</option>
<option value="SNP">SNP</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
	<td width="235" align="center" valign="middle" class="smalltbltext"><input name="txtmarkername" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="markername()">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="gotidss" value="<?php echo $gotssid;?>" /></td>
</tr>
</table>