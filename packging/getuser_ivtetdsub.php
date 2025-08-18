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
	$subtid = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$tid = $_GET['b'];	 
}

$sql1=mysqli_query($link,"select * from tbl_ivtmain where plantcode='$plantcode' and ivt_id=$tid")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);

$sql_eindent_sub=mysqli_query($link,"select * from tbl_ivtsub where plantcode='$plantcode' and ivts_id=$subtid") or die(mysqli_error($link));
$row_eindent_sub=mysqli_fetch_array($sql_eindent_sub);
$oldlotn=$row_eindent_sub['ivts_olotno'];

?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Select Lot No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $oldlotn;?>" readonly="true" style="background-color:#CCCCCC" >&nbsp;<!--<a href="Javascript:void(0);" onclick="openslocpop();">Select</a>&nbsp;<font color="#FF0000">*</font>-->&nbsp;</td>

<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<!--<a href="Javascript:void(0);" onclick="getdetails();">Get Details</a>&nbsp;(After selection of lot, click on 'Get Details')--></td>
</tr>

</table>
<br />

<div id="maindiv" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >Selected Lot Details - Condition Seeds</td>
  </tr>
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
<td width="78" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="49" align="center" valign="middle" class="tblheading">NoB</td>
<td width="49" align="center" valign="middle" class="tblheading">Qty</td>
<td width="69" align="center" valign="middle" class="tblheading">QC Status</td>
<td width="72" align="center" valign="middle" class="tblheading">DoT</td>
<td width="83" align="center" valign="middle" class="tblheading">GOT Status</td>
<td width="78" align="center" valign="middle" class="tblheading">DoGT</td>
<td width="80" align="center" valign="middle" class="smalltblheading">Soft Release</td>
<td width="52" align="center" valign="middle" class="smalltblheading">Entire</td>
	<td width="52" align="center" valign="middle" class="smalltblheading">Partial</td>
	<td width="146" align="center" valign="middle" class="smalltblheading">New Lot No.</td>
</tr>
<?php
$dot=""; $qty=0; $qc=""; $got=""; $srstatus=""; $nob=0; $dogt=""; $wh=""; $bin=""; $subbin=""; $srflg=0; $srtyp="";
$sql_issue24=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_crop='".$row['ivt_crop']."' and lotldg_variety='".$row['ivt_pvariety']."' and lotldg_lotno='".$row_eindent_sub['ivts_olotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'") or die(mysqli_error($link));
 while($row_issue24=mysqli_fetch_array($sql_issue24))
 { 
$sql_issue=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue24['lotldg_subbinid']."' and lotldg_binid='".$row_issue24['lotldg_binid']."' and lotldg_whid='".$row_issue24['lotldg_whid']."' and lotldg_crop='".$row['ivt_crop']."' and lotldg_variety='".$row['ivt_pvariety']."' and lotldg_lotno='".$row_eindent_sub['ivts_olotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'") or die(mysqli_error($link));
$trtr=mysqli_num_rows($sql_issue);
$row_issue=mysqli_fetch_array($sql_issue);

$sql_issue1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue[0]."' and lotldg_variety='".$row['ivt_pvariety']."' and lotldg_lotno='".$row_eindent_sub['ivts_olotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
 
$cnt++;
$qc=$row_issue1['lotldg_qc']; 
$nob=$nob+$row_issue1['lotldg_balbags'];
$qty=$qty+$row_issue1['lotldg_balqty'];
$dot1=$row_issue1['lotldg_qctestdate'];
$gotstatus=$row_issue1['lotldg_got'];
$dogt1=$row_issue1['lotldg_gottestdate'];

$srflg=$row_issue1['lotldg_srflg'];
$srtyp=$row_issue1['lotldg_srtyp'];

$dot=explode("-",$dot1);
$dogt=explode("-",$dogt1);
$dot=$dot[2]."-".sprintf("%02d",$dot[1])."-".sprintf("%02d",$dot[0]);
$dogt=$dogt[2]."-".sprintf("%02d",$dogt[1])."-".sprintf("%02d",$dogt[0]);

/*$wh=$row_issue1['lotldg_gottestdate']; 
$bin=$row_issue1['lotldg_gottestdate']; 
$subbin=$row_issue1['lotldg_gottestdate'];*/
}
if($qc=="UT" || $qc=="RT")$dot="";
if($gotstatus=="UT" || $gotstatus=="RT")$dogt="";
 ?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['ivts_olotno'];?></td>
<td align="center" valign="middle" class="tbltext"><?php echo $nob;?><input type="hidden" name="enob" value="<?php echo $nob;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $qty;?><input type="hidden" name="eqty" value="<?php echo $qty;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $qc;?><input type="hidden" name="eqc" value="<?php echo $qc;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $dot;?><input type="hidden" name="edot" value="<?php echo $dot;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $gotstatus;?><input type="hidden" name="egot" value="<?php echo $gotstatus;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $dogt;?><input type="hidden" name="edogr" value="<?php echo $dogt;?>" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="srfet" id="srfet" value="<?php echo $srflg?>" <?php if($srflg==0) echo "disabled";?> <?php if($row_eindent_sub['ivts_srflg']>0) echo "checked";?> /><input type="hidden" name="srtyp" value="<?php echo $srtyp?>" /><input type="hidden" name="srflg" value="<?php echo $srflg?>" /></td>
<td width="52" align="center" valign="middle" class="smalltblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);" <?php if($row_eindent_sub['ivts_trnall']=="E") echo "checked";?> /></td>
	<td width="52" align="center" valign="middle" class="smalltblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);"  <?php if($row_eindent_sub['ivts_trnall']=="P") echo "checked";?> /></td>
	<td width="146" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="<?php echo $row_eindent_sub['ivts_nlotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
	<td width="56" align="center" valign="middle" class="smalltblheading" rowspan=2>WH</td>
    <td width="45" align="center" valign="middle" class="smalltblheading" rowspan=2>Bin</td>
	<td width="54" align="center" valign="middle" class="smalltblheading" rowspan=2>Subbin</td>
    <td width="56" align="center" valign="middle" class="smalltblheading" colspan=2>Available</td>
    <td width="45" align="center" valign="middle" class="smalltblheading" colspan=2>Transfered</td>
	<td width="54" align="center" valign="middle" class="smalltblheading" colspan=2>Balence</td>
</tr>
<tr class="tblsubtitle" height="25">
    <td width="61" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="61" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="61" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php 
 $totqty=0; $totnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row_eindent_sub['ivts_olotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_eindent_sub['ivts_olotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++; $tqty=0; $tnob=0; 
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;

$sql_tblissue=mysqli_query($link,"select * from tbl_ivtsub_sub where plantcode='$plantcode' and ivt_id='".$tid."' and ivts_id='".$row_eindent_sub['ivts_id']."' and ivtss_subbin='".$row_issuetbl['lotldg_subbinid']."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
$row_tblissue=mysqli_fetch_array($sql_tblissue);

$slups=$row_tblissue['ivtss_nob'];
$slqty=$row_tblissue['ivtss_qty'];
$balnob=$tnob-$slups;
$balqty=$tqty-$slqty;
  ?>
  <tr class="Light" height="25">
  <td width="56" align="center" valign="middle" class="smalltblheading" ><?php echo $wareh?></td>
    <td width="45" align="center" valign="middle" class="smalltblheading"><?php echo $binn?></td>
	<td width="54" align="center" valign="middle" class="smalltblheading"><?php echo $subbinn?><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>
    <td width="56" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtavlnob<?php echo $srno2?>" id="txtavlnob<?php echo $srno2?>" class="smalltbltext" value="<?php echo $tnob?>" size="6" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="45" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtavlqty<?php echo $srno2?>" id="txtavlqty<?php echo $srno2?>" class="smalltbltext" value="<?php echo $tqty?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="54" align="center" valign="middle" class="smalltblheading"><input type="text" name="txttrnob<?php echo $srno2?>" id="txttrnob<?php echo $srno2?>" class="smalltbltext" value="<?php echo $slups;?>" size="6" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)" onchange="nobchk(this.value,'<?php echo $srno2?>');" /></td>
   <td width="61" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txttrqty<?php echo $srno2?>" id="txttrqty<?php echo $srno2?>" class="smalltbltext" value="<?php echo $slqty;?>" size="9" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey1(event)" onchange="qtychk(this.value,'<?php echo $srno2?>');" /></td>
    <td width="78" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtbalnob<?php echo $srno2?>" id="txtbalnob<?php echo $srno2?>" class="smalltbltext" value="<?php echo $balnob;?>" size="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtbalqty<?php echo $srno2?>" id="txtbalqty<?php echo $srno2?>" class="smalltbltext" value="<?php echo $balqty;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
  </tr>
  <?php
  }
}
?> 
<input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value="<?php echo $row_eindent_sub['ivts_trnall'];?>"/> <input type="hidden" name="srno1" value="<?php echo $srno-1;?>"/><input type="hidden" name="srno2" value="<?php echo $srno2;?>" />
</table>


<br />
<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="left" valign="middle" class="tblheading" >&nbsp;Updated SLOC</td>
  </tr>
</table>
-->

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Subbin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
<?php
$srn=0;
$sql_tblissue=mysqli_query($link,"select * from tbl_ivtsub_sub2 where plantcode='$plantcode' and ivt_id='".$tid."' and ivts_id='".$row_eindent_sub['ivts_id']."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$srn++;
?>
  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" >WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tblissue['ivtss2_wh']==$noticia_whd1['whid']) echo "selected";?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tblissue['ivtss2_wh']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
<?php while($noticia_bind1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tblissue['ivtss2_bin']==$noticia_bind1['binid']) echo "selected";?> value="<?php echo $noticia_bind1['binid'];?>" />   
		<?php echo $noticia_bind1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$row_tblissue['ivtss2_wh']."' and binid='".$row_tblissue['ivtss2_bin']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" >Subbin</option>
<?php while($noticia_subbind1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_tblissue['ivtss2_subbin']==$noticia_subbind1['sid']) echo "selected";?> value="<?php echo $noticia_subbind1['sid'];?>" />   
		<?php echo $noticia_subbind1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob1" id="txtconslnob1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value,1);" value="<?php echo $row_tblissue['ivtss2_nob'];?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty1" id="txtconslqty1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="qtyf1(this.value,1);"  onkeypress="return isNumberKey1(event)" value="<?php echo $row_tblissue['ivtss2_qty'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
  </tr>
<?php
}
if($srn==0)
{
?>  
  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob1" id="txtconslnob1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value,1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty1" id="txtconslqty1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="qtyf1(this.value,1);"  onkeypress="return isNumberKey1(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
<tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey1(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
<?php
}
else if($srn==1)
{
?> 
<tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey1(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
<?php
}
else
{
}
?>   
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();"   /></td>
</tr>
</table>
<br />
</div>	
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />