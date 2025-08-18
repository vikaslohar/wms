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

$tot_row=0;
$lotqry=mysqli_query($link,"select * from tbl_stlotimp where stlotimp_id ='".$c."'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['stlotimp_crop'];	

 
 if($row['stlotimp_variety']!="")
 {
  $variety=$row['stlotimp_variety'];
 }
 
 $tdate1=$row['stlotimp_ddate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
$tdate12=$row['stlotimp_ltdate'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row['stlotimp_gtdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;
	
if($tot_row > 0)
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtcrop" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['stlotimp_crop'];?>"/></td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="113" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="249" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtvariety" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['stlotimp_variety'];?>"/>
&nbsp;</td>
  </tr>

 <tr class="Dark" height="25">
<td width="206" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  >&nbsp;<input name="sstage" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['stlotimp_stage'];?>"/>
  	</td>
<td width="147" align="right"  valign="middle" class="tblheading">Seed Status&nbsp;</td>
    <td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
<!--<td width="206" align="right" valign="middle" class="tblheading">Seed Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtstage" style="width:170px;" onChange="sschk1()">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <option value="Condition" >Condition</option>
	  </select>&nbsp;<font color="#FF0000">*</font>	</td>-->
	 <?php
	  $sql_pl=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	  $row_pl=mysqli_fetch_array($sql_pl);
	  $pl=$row_pl['code'];
	  ?>
 <tr class="Light" height="25">
           <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;ST Lot Number&nbsp;</td>
    <td width="250" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlotp22" type="text" size="15" class="tbltext" tabindex="" maxlength="14" style="background-color:#CCCCCC"  value="<?php echo $row['stlotimp_lotno'];?>"   readonly="true"/>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">  ST Date&nbsp;</td>
<td width="247" align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="dcdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"   style="background-color:#EFEFEF"  value="<?php echo $tdate1;?>" />&nbsp;</td>
 </tr>
 
        <tr class="Dark" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch NoB &nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsdcchk(this.value);"  value="<?php echo $row['stlotimp_nob'];?>" style="background-color:#CCCCCC" readonly="true" /></a>&nbsp;&nbsp;</td>
		
<td width="197" align="right"  valign="middle" class="tblheading" >Dispatch  Qty&nbsp;</td>
<td width="212" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $row['stlotimp_qty'];?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Actual NoB &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagschk1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Actual Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="qtychk1(this.value);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Difference NoB &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" />  &nbsp;&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="3" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" >&nbsp;&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Quality (QC)</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Quality Status &nbsp;</td>
<td width="260" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtystat" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row['stlotimp_qcstatus'];?>" style="background-color:#CCCCCC" readonly="true">&nbsp;</td>
		<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtvisualck" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['stlotimp_pp'];?>" style="background-color:#CCCCCC" readonly="true">&nbsp;</td>
		</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext"    maxlength="4"   value="<?php echo $row['stlotimp_moisture'];?>" style="background-color:#cccccc"  readonly="true"/> 
%&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="2"    onchange="mm(this.value)"  value="<?php echo $row['stlotimp_germination'];?>" style="background-color:#cccccc"  readonly="true"/> 
%&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">Last Test Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="dcdate1" type="text" size="10" class="tbltext" tabindex="0"  maxlength="10" readonly="true"  style="background-color:#cccccc"  value="<?php echo $tdate12;?>"/>&nbsp;</td>
</tr>
</table>
<div id="transs" style="display:<?php if($row['stlotimp_pp']=="Not-Acceptable"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="739" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtreason" class="tbltext" size="100" maxlength="90" value="<?php echo $row['stlotimp_reason'];?>"  readonly="true">&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
<td width="207" align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
 <td width="272" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtgot" class="tbltext" size="10" maxlength="90" value="<?php echo $row['stlotimp_gottype'];?>" style="background-color:#cccccc"   readonly="true">
 </td>

<td width="193" align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td width="268" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="gotstatus" class="tbltext" size="10" maxlength="90" value="<?php echo $row['stlotimp_gotstatus'];?>" style="background-color:#cccccc"  readonly="true" ></td>
  </tr>
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
 <td width="207" align="right"  valign="middle" class="tblheading">Got Test Date&nbsp;</td>
 <td width="737" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="dcdate12" type="text" size="10" class="tbltext" tabindex="0"  maxlength="10" readonly="true"  style="background-color:#cccccc"  value="<?php echo $tdate13;?>"/>&nbsp;&nbsp;&nbsp;</td>
</tr></table>
<div id="subsubdivgood" style="display:block">
<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" > 
 <tr class="Light" height="30" style="border-color:#adad11">
<td align="right" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl_sub['remarks'];?>" ></td>
</tr>
</table>-->
<div id="transs" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="230" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >

  <tr class="tblsubtitle" height="20">
    <td colspan="9" align="center" class="tblheading">Storage Location (SLOC) </td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC </td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
    <td width="292" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">SuB Bin</td>
  </tr>
  <?php
$cnt=0; 

$s_good_new11=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_lotno='".$row['stlotimp_lotno']."'") or die(mysqli_error($link));
//echo $r_good_new=mysqli_num_rows($s_good_new11);
while($row_issueg_new11=mysqli_fetch_array($s_good_new11))
{


	$sql_issueg1_new11=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$row_issueg_new11['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new11['lotldg_binid']."' and lotldg_whid='".$row_issueg_new11['lotldg_whid']."' and lotldg_lotno='".$row['stlotimp_lotno']."'") or die(mysqli_error($link));
	$row_issueg1_new11=mysqli_fetch_array($sql_issueg1_new11); 
	//echo $row_issueg1_new11[0]."  ";
	$sql_issuetblg_new11=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$row_issueg1_new11[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno_new11=mysqli_num_rows($sql_issuetblg_new11);
	
	
	if($tot_sub_sloc>0)
	{
		$tot_sub_sloc11++;
	}
	else
	{
		$tot_sub_sloc11=0;
	}
//echo $tot_sub_sloc11;
if($tot_sub_sloc11>0)
{
	$row_issuetblg_new11=mysqli_fetch_array($sql_issuetblg_new11);
	$cnt++;
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_issuetblg_new11['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_issuetblg_new11['lotldg_binid']."' and whid='".$row_issuetblg_new11['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_issuetblg_new11['lotldg_subbinid']."' and binid='".$row_issuetblg_new11['lotldg_binid']."' and whid='".$row_issuetblg_new11['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$row_issueg1_new11[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno_new=mysqli_num_rows($sql_issuetblg_new);
	
	if($totno_new > 0)
	{
		$row_issuetblg_new=mysqli_fetch_array($sql_issuetblg_new);
		if($row_issuetblg_new['lotldg_trtype']=="Fresh Seed with PDN")
		{
			$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
			$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new=mysqli_fetch_array($sql_crop_new);
			
			$varchk=$row_crop_new['cropname']."-"."Coded";
			$varty="";
			if($row_issuetblg_new['lotldg_variety']!=$varchk)
			{		
				$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
				$row_variety=mysqli_fetch_array($sql_veriety);
				$varty=$row_variety['popularname'];
			}
			else
			{
				$varty=$row_issuetblg_new['lotldg_variety'];
			}	
	
			$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		
		}
		else
		{
			$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new=mysqli_fetch_array($sql_crop_new);
			
			$varchk=$row_crop_new['cropname']."-"."Coded";
			$varty="";
			if($row_issuetblg_new['lotldg_variety']!=$varchk)
			{		
				$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
				$row_variety=mysqli_fetch_array($sql_veriety);
				$varty=$row_variety['popularname'];
			}
			else
			{
			$varty=$row_issuetblg_new['lotldg_variety'];
			}	
	
			$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
			$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		}
	
	}
	else
	{
		$existview="Empty";
	}

if($srno%2!=0)
{

?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_subbinid'];?>" /></td>
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value=""  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value=""  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_id'];?>" />
  </tr>
  <?php
 }
 else
 {
 ?>
  <tr class="Dark" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_subbinid'];?>" /></td>
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value=""  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value=""  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_issuetblg_new11['lotldg_id'];?>" />
  </tr>
  <?php 
 }
 $srno++;
 } 
// echo $cnt;
 }
?>



  <?php
//echo $cnt;
if($cnt==0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
        <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
        <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
else if($cnt==1)
{
?>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
?>
</table>
<br />

<?php $tid=$b; ?>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details cannot display reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot number not Imported</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already arrived.</td>
</tr>
</table>
<?php
}
?>