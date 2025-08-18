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


//  			main arrival table fields
if(isset($_GET['a']))
{
	$barcode = $_GET['a'];	 
}
$maintrid=trim($_POST['maintrid']);
$subtrid=trim($_POST['subtrid']);	
$type="NoP With Barcode";
?>


<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="13" align="center" class="tblheading">Unpackaged Barcode Status</td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="6%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
	<td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
	<td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Ups</td>
	<td width="6%" align="center" rowspan="2" valign="middle" class="tblheading">NoP</td>
	<td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Qty</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">Arrived</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">In Transit Loss</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
</tr>
<tr class="tblsubtitle">
	<td width="5%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Loss NoP</td>
	<td width="8%" align="center" valign="middle" class="tblheading">Loss Qty</td>
	<td width="11%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="15%" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php 
$srno=1;
$sql_barcode=mysqli_query($link,"select * from tbl_stlotimp_packsubsub where stlotimpps_barcode='".$barcode."' and plantcode='$plantcode' and stlotimpps_arrflg=0 ") or die(mysqli_error($link));
$tot_barcode=mysqli_num_rows($sql_barcode);
while($row_barcode=mysqli_fetch_array($sql_barcode))
{	
$sql_impsub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpps_id='".$row_barcode['stlotimpps_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_impsub=mysqli_num_rows($sql_impsub);
while($row_impsub=mysqli_fetch_array($sql_impsub))
{
	$crop=""; $variety=""; $lotno=""; $dispnop=""; $dispnomp=""; $dispqty=""; $recnop=""; $recnomp=""; $recqty=""; $balnop=""; $balnomp=""; $balqty=""; $qc=""; $pp=""; $moist="";$germ=""; $gottyp=""; $gotstatus="";	
	
$crop=$row_impsub['stlotimpp_crop']; 
$variety=$row_impsub['stlotimpp_variety']; 
$lotno=$row_impsub['stlotimpp_lotno']; 
$dispnop=$row_barcode['stlotimpps_nop']; 
$dispnomp=$row_impsub['stlotimpp_nomp']; 
$dispqty=$row_barcode['stlotimpps_qty']; 
$recnop=$row_impsub['stlotimpp_arrnop']; 
$recnomp=$row_impsub['stlotimpp_arrnomp']; 
$recqty=$row_impsub['stlotimpp_arrqty']; 
$balnop=$row_barcode['stlotimpps_nop']; 
$balnomp=$row_impsub['stlotimpp_balnomp']; 
$balqty=$row_barcode['stlotimpps_qty'];  
$qc=$row_impsub['stlotimpp_qc']; 
$ups=$row_impsub['stlotimpp_ups']; 
$moist=$row_impsub['stlotimpp_moist'];
$germ=$row_impsub['stlotimpp_germ']; 
$gottyp=$row_impsub['stlotimpp_gottype']; 
$gotstatus=$row_impsub['stlotimpp_got'];
$wtmp=$row_impsub['stlotimpp_wtmp']; 

$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));	
?>
<input type="hidden" name="wtmp" value="<?php echo $wtmp;?>" />
<tr class="Light" height="25">
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?><input type="hidden" name="txtlot1" value="<?php echo $lotno;?>" /></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $ups;?>
    <input type="hidden" name="ups" value="<?php echo $ups;?>" /></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $dispnop;?>
    <input type="hidden" name="txtnop" value="<?php echo $dispnop;?>" /></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $dispqty;?>
    <input type="hidden" name="txtqty" value="<?php echo $dispqty;?>" /></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtarrnop" id="txtarrnop" size="4" maxlength="4" class="smalltbltext" onchange="nopcal1(this.value)" value="" /></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtarrqty" id="txtarrqty" size="9" maxlength="9" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtlossnop" id="txtlossnop" size="4" maxlength="4" class="smalltbltext" onChange="lossnopcal1(this.value)" value="" /></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtlossqty" id="txtlossqty" size="9" maxlength="9" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="11%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtbalnop" id="txtbalnop" size="4" maxlength="4" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="15%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtbalqty" id="txtbalqty" size="9" maxlength="9" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php 
$srno++;
}
}
$subtbltot=0;
?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</table>
<br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Transit Loss Status</td>
</tr>
<tr class="Dark" height="25">
<td width="453"  align="right"  valign="middle" class="tblheading">Do you want to book transit loss for quantity not arrived (if any)?&nbsp;</td>
<td width="491" align="left"  valign="middle" class="tbltext">&nbsp;
  <select class="smalltbltext" id="lossbook" name="lossbook" style="width:130px;" >
<option value="" selected>--Select--</option>
<option value="No" >No</option>
<option value="Yes-Partial" >Yes-Partial</option>
<option value="Yes-Complete" >Yes-Full</option>
</select></td>

<!--<td width="230"  align="right"  valign="middle" class="tblheading">Full/Partial&nbsp;</td>
<td width="714" align="left"  valign="middle" class="tbltext">&nbsp;<select class="smalltbltext" id="txtlosstyp" name="txtlosstyp" style="width:130px;" onchange="intrloss1(this.value);" disabled="disabled" >
<option value="" selected>--Select--</option>
<option value="Partial" >Partial</option>
<option value="Full" >Full</option>
</select>
</td>--></tr>
</table><br />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0" style="display:inline;cursor:Pointer;" onClick="pform('<?php echo $type;?>');" />&nbsp;&nbsp;</td>
</tr>
</table>
