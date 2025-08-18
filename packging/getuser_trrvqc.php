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
	$lotn = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
	$crop = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	$variety = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
	$upss = $_GET['f'];	 
	}
//echo $a;  PNPSLIP

$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

$nop=0; $qty=0; $qc=""; $dot=""; $got=""; $dogt=""; 
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
	$ptp1=($packtp[0]/1000);
}
else
{
	if($packtp[0]<1)
	{
		$ptp=(1000/$packtp[0])/1000;
		$ptp1=($packtp[0]/1000)*1000;
	}
	else
	{
		$ptp=$packtp[0];
		$ptp1=$packtp[0];
	}
	//$ptp=$packtp[0];
	//$ptp1=$packtp[0];
}
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp*$penqty);
	}
	else
	{
		if($packtp[0]<1)
			$nop1=($penqty*$ptp);
		else
			$nop1=($penqty/$ptp);
		//$nop2=($row_issuetbl['balqty']/$ptp2);
	}
	//$nop1=($ptp*$penqty);
}

$nop=$nop+$nop1; 
$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$qty+$row_issuetbl['balqty'];

$qc=$row_issuetbl['lotldg_qc'];
$orlot=$row_issuetbl['orlot'];

$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];

$dgt=explode("-",$row_issuetbl['lotldg_gottestdate']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$gt=explode(" ",$row_issuetbl['lotldg_got1']);
$got=$gt[0]." ".$row_issuetbl['lotldg_got'];

if($dot=="00-00-0000" || $dot=="--" || $dot=="- -")$dot="";
if($dogt=="00-00-0000" || $dogt=="--" || $dogt=="- -")$dogt="";
}
}
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<input name="txtenop" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nop;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right" width="236" valign="middle" class="tblheading">NoMP&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txtenomp" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nomp;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txteqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $qty;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txteqc" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $qc;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtedot" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dot;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtegot" type="text" size="15" class="tbltext" tabindex=""   maxlength="15" onkeypress="return isNumberKey1(event)" value="<?php echo $got;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtedogt" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dogt;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
</table>
