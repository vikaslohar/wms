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
		$snid = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
		$ltnno = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
		$subtid = $_GET['c'];	 
	}
	if(isset($_GET['h']))
	{
		$tid = $_GET['h'];	 
	}
	if(isset($_GET['g']))
	{
		$eupsval = $_GET['g'];	 
	}
	if(isset($_GET['l']))
	{
		$evert = $_GET['l'];	 
	}
	if(isset($_GET['m']))
	{
		$tnb = $_GET['m'];	 
	}
	if(isset($_GET['n']))
	{
		$tqt = $_GET['n'];	 
	}
	if(isset($_GET['q']))
	{
		$ssid = $_GET['q'];	 
	}
	
$nups=""; $nvariety="";
$sq2=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_id='$subtid' and dtdf_id='$tid' and dtdfs_stage='Pack'") or die(mysqli_error($link));
if($to2=mysqli_num_rows($sq2) > 0)
{
	$ro2=mysqli_fetch_array($sq2);
	$nups=$ro2['dtdfs_ups']; 
	$nvariety=$ro2['dtdfs_variety']; 
}

if($nvariety=="")$nvariety=$evert;
if($nups=="")$nups=$eupsval;

if($ltnno!="")
{
$snlo=0;

$ltnno=$ltnno.",";
$lltn=explode(",", $ltnno);
foreach($lltn as $ltn)
{
if($ltn<>"")
{
	$snlo++;

$mmqty=0; $tnb=0;
$sq3=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$subtid' and dtdf_id='$tid' and dbss_lotno='$ltn' and dbss_nob>0") or die(mysqli_error($link));
$totre3=mysqli_num_rows($sq3);
while($row3=mysqli_fetch_array($sq3))
{
	$xc=explode(" ",$row3['dbss_ups']);
	if($xc[1]=="Gms")
	{
		$ptp=$xc[0]/1000;
	}
	else
	{
		$ptp=$xc[0];
	}
	$qt=$row3['dbss_mmcqty'];
	$mmqty=$mmqty+$qt;
	$tnb=$tnb+$row3['dbss_nob'];
	$ssid=$row3['dbss_id'];
}

$mq=0;	 $bnlp=0; $tq=0;
$sqmmc1=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dtdfs_id='$subtid' and dmmc_lotno='$ltn' and dmmc_flg=2") or die(mysqli_error($link));
$totmmc1=mysqli_num_rows($sqmmc1);
while($rowmmc1=mysqli_fetch_array($sqmmc1))
{
	$mq=$mq+$rowmmc1['dmmc_bqty'];
	$tq=$tq+$rowmmc1['dmmc_qty'];
	$bnlp=$bnlp+$rowmmc1['dmmc_bnolp'];
}
//echo $mq."  -  ".$mmqty;
//if($mq==$mmqty)	$mmqty=0;
if($mq==$mmqty)	{$mmqty=0;}
else
{
if($mq>0)
$mmqty=$mq;
}
if($tq>0)
{
$tnb=$bnlp;
$tqt=$mq;
}	
?>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="277" align="center" class="smalltblheading">Lot No.</td>
	<td width="412" align="center" class="smalltblheading">Total NoLP</td>
	<td width="253" align="center" class="smalltblheading">Total Qty</td>
	<td width="253" align="center" class="smalltblheading">UPS</td>
</tr>
<tr class="Dark" height="30">
	<td align="center" valign="middle" class="tbltext"><?php echo $ltn;?><input type="hidden" name="txtolotno<?php echo $snlo?>" id="txtolotno<?php echo $snlo?>" value="<?php echo $ltn;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tnb?><input type="hidden" name="txtonob<?php echo $snlo?>" id="txtonob<?php echo $snlo?>" value="<?php echo $tnb;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tqt?><input type="hidden" name="txtoqty<?php echo $snlo?>" id="txtoqty<?php echo $snlo?>" value="<?php echo $tqt;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $nups;?><input type="hidden" name="txtnups<?php echo $snlo?>" id="txtnups<?php echo $snlo?>" class="tbltext" size="10" value="<?php echo $nups;?>" /></td>
</tr>

</table>
<?php 
$srno2=0;
//if($eseltyp=="lotsel")
//{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Allocate</td>
	<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">Allocate Full</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Allocate</td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoLP</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <!--<td width="125" align="center" valign="middle" class="smalltblheading">NoMP</td>-->
	<td width="125" align="center" valign="middle" class="smalltblheading">NoLP</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoLP</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
<?php
$totqty=0; $totnob=0; $tqty=0; $tnob=0;
$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='".$ltn."' and balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$ltn."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 	
	
 	/*$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnomp']; */

	$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0; $tnob=0; $tqty=0;
	
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sloc=$wareh."/".$binn."/".$subbinn;
	
	
//echo "select * from tbl_dtdfsub_sub2 where dallocss2_lotno='".$ltn."' and dtdf_id='$tid' and dtdfs_id='$subtid' and dbss_id='$ssid'";	
$sql_dlsub_sub=mysqli_query($link,"select * from tbl_dtdfsub_sub2 where plantcode='".$plantcode."' and dtdf_id='$tid' and dtdfs_id='$subtid' and dbss_is='$ssid'") or die(mysqli_error($link));
$row_dllsub_sub=mysqli_fetch_array($sql_dlsub_sub);	

$xc=explode(" ",$nups);
if($xc[1]=="Gms")
{
	$ptp=$xc[0]/1000;
}
else
{
	$ptp=$xc[0];
}
$qt=$row_dllsub_sub['dbsss_mmcqty'];
$tnob=$row_dllsub_sub['dbsss_nob']; 
$tqty=$qt; 
//echo $ptp." - ".$row_dllsub_sub['dallocss2_nolp'];
$mq=0;	 $bnlp=0; $tq=0;
$sqmmc1=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dtdfs_id='$subtid' and dmmc_lotno='$ltn' and dmmc_flg=2") or die(mysqli_error($link));
$totmmc1=mysqli_num_rows($sqmmc1);
while($rowmmc1=mysqli_fetch_array($sqmmc1))
{
	$mq=$mq+$rowmmc1['dmmc_bqty'];
	$tq=$tq+$rowmmc1['dmmc_qty'];
	$bnlp=$bnlp+$rowmmc1['dmmc_bnolp'];
}
//echo $mq."  -  ".$mmqty;
//if($mq==$mmqty)	$mmqty=0;
if($mq==$mmqty)	{$mmqty=0;}
else
{
if($mq>0)
$mmqty=$mq;
}
if($tq>0)
{
$tnob=$bnlp;
$tqty=$mq;
}	
$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
if($tnob<0)$tnob=0;
	
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;	

if($tqty>0)
{
$srno2++;
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?><?php echo $snlo?>" id="extslwhg<?php echo $srno2?><?php echo $snlo?>" value="<?php echo $row_issuetbl['whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?><?php echo $snlo?>" id="extslbing<?php echo $srno2?><?php echo $snlo?>" value="<?php echo $row_issuetbl['binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?><?php echo $snlo?>" id="extslsubbg<?php echo $srno2?><?php echo $snlo?>" value="<?php echo $row_issuetbl['subbinid'];?>" /></td>
    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?><?php echo $snlo?>" id="txtextnob<?php echo $srno2?><?php echo $snlo?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?><?php echo $snlo?>" id="txtextqty<?php echo $srno2?><?php echo $snlo?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="allocfull<?php echo $srno2?><?php echo $snlo?>" id="allocfull<?php echo $srno2?><?php echo $snlo?>" type="checkbox" class="smalltbltext" tabindex="" value="<?php echo $srno2?>" onclick="alcfull(<?php echo $srno2?>,<?php echo $snlo?>)"  /></td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnolbp<?php echo $srno2?><?php echo $snlo?>" id="recnolbp<?php echo $srno2?><?php echo $snlo?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onchange="qtychk1(this.value,<?php echo $srno2?>,<?php echo $snlo?>);" value=""  onkeypress="return isNumberKey1(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?><?php echo $snlo?>" id="recqtyp<?php echo $srno2?><?php echo $snlo?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>,<?php echo $snlo?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?><?php echo $snlo?>" id="txtbalnobp<?php echo $srno2?><?php echo $snlo?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="" style="background-color:#CCCCCC" readonly="true" /></td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?><?php echo $snlo?>" id="txtbalqtyp<?php echo $srno2?><?php echo $snlo?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="" /></td>
</tr>
<?php
}
}
}
?>
</table>
<input type="hidden" name="srno2<?php echo $snlo?>" id="srno2_<?php echo $snlo?>" value="<?php echo $srno2?>" />
<?php
}
}
?>

<input type="hidden" name="snlo" value="<?php echo $snlo?>" />
<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" id="postbutn" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>