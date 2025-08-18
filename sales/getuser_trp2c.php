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
//echo $a;

$sql_arrival=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$crop."' and salesrs_variety='".$variety."' and salesrs_rettype='P2P' and salesrs_rvflg=0 and salesrs_ups='$upss' and salesrs_newlot='$lotn'") or die(mysqli_error($link));
$row_arrival=mysqli_fetch_array($sql_arrival);

$dot="";
if($row_arrival['salesrs_dot']!="")
{
$dt=explode("-",$row_arrival['salesrs_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_arrival['salesrs_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_arrival['salesrs_got']." ".$row_arrival['salesrs_got1'];

//echo $row_arrival['salesrs_typ'];

$nop="";$qty="";$ewh="";$ebin="";$esbin="";
//if($row_arrival['salesrs_typ']=="verrec")
//{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	/*else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}*/
else if($row_arrival['salesrs_typ']=="vernew")
{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}
else
{
	$nop=$row_arrival['salesrs_nobdc'];
	$qty=$row_arrival['salesrs_qtydc'];
	$ewh=$row_arrival['salesrs_wh'];
	$ebin=$row_arrival['salesrs_bin'];
	$esbin=$row_arrival['salesrs_subbin'];
}
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<input name="txtenop" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nop;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txteqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $qty;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;<input type="hidden" name="ewh" value="<?php echo $ewh;?>" /><input type="hidden" name="ebin" value="<?php echo $ebin;?>" /><input type="hidden" name="esbin" value="<?php echo $esbin;?>" /></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txteqc" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $row_arrival['salesrs_qc'];?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtedot" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dot;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtegot" type="text" size="15" class="tbltext" tabindex=""   maxlength="15" onkeypress="return isNumberKey1(event)" value="<?php echo $got;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtedogt" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dogt;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<input type="hidden" name="orlot" value="<?php echo $row_arrival['salesrs_orlot'];?>" />
</table>
<br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">SLOC Details</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,'1');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,'1');" >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,'1');"  >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td align="right" width="44"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'1');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="40"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'1');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,'2');" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,'2');"  >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,'2');" >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="83" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'2');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="40" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'2');" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

</table>