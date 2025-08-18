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
	$ltn = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$snid = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$tid = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	$tnb = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$tqt = $_GET['g'];	 
}
if(isset($_GET['l']))
{
	$esn = $_GET['l'];	 
}
if(isset($_GET['m']))
{
  $subtid = $_GET['m'];	 
}
if(isset($_GET['n']))
{
  $subsubtid = $_GET['n'];	 
}
if(isset($_GET['q']))
{
  $evert = $_GET['q'];	 
}

$sq2=mysqli_query($link,"Select * from tbl_dbulk_sub where plantcode='".$plantcode."' and dbulks_variety='$evert' and dbulk_id='$tid'") or die(mysqli_error($link));
$nups=""; $nvariety="";
if($to2=mysqli_num_rows($sq2) > 0)
{
	$ro2=mysqli_fetch_array($sq2);
	$nups=$ro2['dbulks_ups']; 
	$nvariety=$ro2['dbulks_nvariety']; 
	$ovariety=$ro2['dbulks_variety'];
	if($nvariety=="" || $nvariety=="undefined")$nvariety=$ovariety; 
}
if($nvariety=="")$nvariety=$evert;
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="277" align="center" class="smalltblheading">Lot No.</td>
	<td width="412" align="center" class="smalltblheading">Total NoB</td>
	<td width="253" align="center" class="smalltblheading">Total Qty</td>
	<td width="253" align="center" class="smalltblheading">UPS</td>
	<td width="253" align="center" class="smalltblheading">Variety</td>
</tr>

<tr class="Dark" height="30">
	<td align="center" valign="middle" class="tbltext"><?php echo $ltn;?><input type="hidden" name="txtolotno" value="<?php echo $ltn;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tnb?><input type="hidden" name="txtonob" value="<?php echo $tnb;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tqt?><input type="hidden" name="txtoqty" value="<?php echo $tqt;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="txtnups" class="tbltext" size="10" value="<?php echo $nups;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="txtnvariety" class="tbltext" size="20" value="<?php echo $nvariety;?>" /></td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Dispatch</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Dispatch </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_lotno='".$ltn."' and lotldg_balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$ltn."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++; $flg=0;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 
		
		$zz=explode(" ", $rowmonth3['lotldg_got1']);
		if($row_issuetbl['lotldg_got']=="BL")
		$flg++;
		if($row_issuetbl['lotldg_qc']=="BL")
		$flg++;
		if($zz[0]=="GOT-NR")
		{
			if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
			{
				$flg++; 
			}
		}
		else
		{
			if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
			{
				$flg++; 
			} 
		}
			
			
$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;
if($flg==0)
{
/*$sql_tbl_subsub=mysqli_query($link,"select * from tbl_proslipsubsub where proslipsub_id='".$row['proslipsub_id']."' and proslipmain_id='".$tid."'  and proslipsubsub_wh='".$row_issuetbl['lotldg_whid']."' and proslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and proslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);*/
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value=""  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="" /></td>
  </tr>
<?php
}
}
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>