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
	$b = $_GET['b'];	 
}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$b."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$c."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$variet=$row_variety['popularname'];

$tot_row=0;
$lotqry=mysqli_query($link,"select * from tbllotimp where lotnumber='".$a."' and lotcrop='".$crop."' and lotvariety='".$variet."'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

 
 if($row['lotvariety']!="")
 {
 	$variety=$row['lotvariety'];
 	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$variety."' and actstatus='Active' and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$qctyp=$row11['opt'];
	$i=$row11['varietyid'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($xx > 0)
	{
	$x=$row_spc['variety'];
	$z=$row_spc['crop'];
	$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."' and actstatus='Active' and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$variety=$row11['popularname'];
	$qctyp=$row11['opt'];
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	}
 }
	
$s_sub="delete from tblarrival_sub where arrsub_id='".$b."' and plantcode='$plantcode'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$s_sub_sub="delete from tblarr_sloc where arr_id='".$b."' and plantcode='$plantcode'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
?>
<?php
if($tot_sub > 0)
$tid=$a;
else
$tid=0;

$arrival_id=$tid;
?>
<?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Maize Dry Arrival' and plantcode='$plantcode' and arrival_id='".$tid."'") or die(mysqli_error($link));

 $tot=mysqli_num_rows($sql_tbl);		
//$arrival_id=$row_tbl['arrival_code'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<?php
if($tot > 0)
{
$row_tbl=mysqli_fetch_array($sql_tbl);
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add  Arrival Maize-Dried Seed</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="192" align="right" valign="middle" class="tblheading">&nbsp;Date &nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;
  <input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
 <!--<tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="txtstfp1" type="text" size="40" class="tbltext" tabindex="" maxlength="40" value="<?php echo $row31['business_name'];?>"  style="background-color:#CCCCCC" readonly="true"/>  <font color="#FF0000">*</font>&nbsp;<input type="hidden" name="adddchk" value="<?php echo $row31['stcode'];?>" /></td><input type="hidden" name="txtstfp" value="<?php echo $row_tbl['party_id'];?>" />
	</tr>-->
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
			$code=$row_cls['code'];
?>
<!--<td width="159" align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
<td width="228" align="left"  valign="middle" class="tbltext">&nbsp;
  <input name="txtsttp" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $plname.", ".$city1;?>" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
	<!--	  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address']?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?></td>
</tr>
<tr class="Light" height="30">

	<td align="right"  valign="middle" class="tblheading">STN&nbsp;No.&nbsp;</td>
  <td width="228" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>-->
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="6"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<div id="trans" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="206" valign="middle" class="tblheading" >&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="21" class="tbltext" tabindex="" maxlength="20" value="<?php echo $row_tbl['trans_name'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="172" align="right"  valign="middle" class="tblheading" style="border-color:#F1B01E">Lorry Receipt No.&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex="" value="<?php echo $row_tbl['trans_lorryrepno'];?>"  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="206" valign="middle" class="tblheading" >&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="327" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" >&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:100px;" onchange="clk1(this.value);"  > 
<option value="">--Select Mode--</option>
<option <?php if($row_tbl['trans_paymode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="To Pay"){ echo "Selected";} ?> value="To Pay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>"  >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="206" valign="middle" class="tblheading" >&nbsp;Courier Name&nbsp;</td>
<td align="left" width="327" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="172" valign="middle" class="tblheading" s>&nbsp;Docket No.&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 </table>
 </div>
<div id="byhand" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="206" valign="middle" class="tblheading" >&nbsp;Name of Person&nbsp;</td>
<td width="738" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['pname_byhand'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else
{

?>
<?php
$row_tbl1=mysqli_fetch_array($sql_tbl);
/*$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Maize Dry Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_code'];*/
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add  Arrival Stock Transfer Plant</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl1['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="192" align="right" valign="middle" class="tblheading">&nbsp;Date &nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;
  <input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer-Plant'"); 
?>
 <!--<tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtstfp" style="width:220px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');" >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>-->
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
			$code=$row_cls['code'];
?>
<!--<td width="159" align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
<td width="228" align="left"  valign="middle" class="tbltext">&nbsp;
  <input name="txtsttp" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $plname.", ".$city1;?>" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<!--<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;</td>
</tr>
<tr class="Light" height="30">

	<td align="right"  valign="middle" class="tblheading">STN&nbsp;No.&nbsp;</td>
  <td width="228" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>-->
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="trans"  style="display:none; width:850">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="229" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txttname" type="text" size="21" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="129" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="278" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Dark" height="25">
<td align="right" width="229" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="304" valign="middle" class="tbltext">&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="To Pay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:none; width:850" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="229" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="304" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="130" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="277" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table></div>
<div id="byhand"  style="display:none; width:850">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="228" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="716" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="31" class="tbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<?php
}
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">

			 <tr class="tblsubtitle" height="20">
              <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="32" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
              <td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			 <td width="55" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Dispatch</td>
			    <td colspan="2" align="center" valign="middle" class="tblheading">Received</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Difference</td>
				 <td width="35" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
                <td width="48" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
				<td width="22" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
			   <td width="43" rowspan="2" align="center" valign="middle" class="tblheading">Moist %</td>
			   <td width="42" rowspan="2" align="center" valign="middle" class="tblheading">Germ. %</td>
			    <td width="46" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type</td>
			    <td width="50" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
				<td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
                  <td width="30" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="60" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td width="36" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="34" align="center" valign="middle" class="tblheading">Qty</td>
               <td width="39" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="33" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="46" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="43" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="89" align="center" valign="middle" class="tblheading">WH</td>
			   <td width="37" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="23" align="center" valign="middle" class="tblheading">Qty</td>
               
  </tr>
<?php
$srno=1;
  $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
	if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="32" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?>&nbsp;</td>
    <td width="44" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="36" align="center" valign="middle" class="tblheading"><?php echo $dcn;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
 	<td width="39" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
    <td width="33" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="46" align="center" valign="middle" class="tblheading"><?php echo $difn;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
	<td width="35" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="22" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="42" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>	
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td width="37" align="center" valign="middle" class="tblheading"><?php echo $act1;?></td>
	<td width="23" align="center" valign="middle" class="tblheading"><?php echo $act;?></td>
	<td width="30" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 	<td width="60" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Maize Dry Arrival');"   /></td>
 </tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="32" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?>&nbsp;</td>
    <td width="44" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="36" align="center" valign="middle" class="tblheading"><?php echo $dcn;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
 	<td width="39" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
    <td width="33" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="46" align="center" valign="middle" class="tblheading"><?php echo $difn;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
	<td width="35" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="22" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="42" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>
 	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td width="37" align="center" valign="middle" class="tblheading"><?php echo $act1;?></td>
	<td width="23" align="center" valign="middle" class="tblheading"><?php echo $act;?></td>
	<td width="30" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 	<td width="60" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Maize Dry Arrival');"   /></td>
 </tr> 
<?php
}
$srno++;
}
}
?> 
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" /> 			  
</table>
		 <br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpopp();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get details')</td>
</tr>
</table>
<br />
<div id="postingsubtable" style="display:block">
 <input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>