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

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
}*/
	if(isset($_GET['b']))
	{
	$tid = $_GET['b'];	 
	}	

/*$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$b."'") or die(mysqli_error($link));
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
*/

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrsub_id='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['arrival_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

 $tdate1=$row_tbl_sub['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
$tdate12=$row_tbl_sub['testd'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row_tbl_sub['gotdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;

?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname  FROM tblcrop  order by cropname Asc"); 

?>


<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtcrop" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotcrop'];?>" readonly="true"/></td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="113" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="249" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtvariety" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotvariety'];?>"  readonly="true"/>
&nbsp;</td>
           </tr>

  
<tr class="Dark" height="25">
<td width="206" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  >&nbsp;<input name="sstage" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['sstage'];?>"  readonly="true"/>  	</td>
<td width="147" align="right"  valign="middle" class="tblheading">Seed Status&nbsp;</td>
    <td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext"  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
<tr class="Dark" height="25">
		  <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;ST Lot Number&nbsp;</td>
           <td width="250" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlotp22" type="text" size="25" class="tbltext" tabindex="" maxlength="25" onchange="itemcheck();" value="<?php echo $row_tbl_sub['lotno'];?>" style="background-color:#CCCCCC"  readonly="true"/>&nbsp;&nbsp;<div id="slck" style="display:none"><input name="slck1" type="hidden" class="tbltext" tabindex="" value="0" /></div>  </td>
		   <td align="right"  valign="middle" class="tblheading">  ST Date&nbsp;</td>
<td width="247" align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="dcdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"   style="background-color:#EFEFEF"  value="<?php echo $tdate1;?>" />&nbsp;</td>
</tr>
<?php
	$sql_pl=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
	$row_pl=mysqli_fetch_array($sql_pl);
	$pl=$row_pl['code'];
?>
          <tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch Total Bags&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" value="<?php echo $row_tbl_sub['qty1'];?>"  onchange="Bagsdcchk(this.value);"  style="background-color:#cccccc"   readonly="true"/>&nbsp;</td>
<?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>		
<td width="196" align="right"  valign="middle" class="tblheading" >Dispatch  Qty&nbsp;</td>
<td width="261" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagsdcchk1(this.value);"  value="<?php echo $dcq;?>"  onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC"   readonly="true"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Receive No. of Bags&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagschk1(this.value);" value="<?php echo $row_tbl_sub['act1'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>
<td align="right"  valign="middle" class="tblheading">Received Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="qtychk1(this.value);" value="<?php echo $ac;?>" onkeypress="return isNumberKey(event)"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Difference Bag&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagschk(this.value);" value="<?php echo $row_tbl_sub['diff1'];?>"  style="background-color:#CCCCCC" readonly="true" />&nbsp;&nbsp;</td>
<?php $diq=explode(".",$row_tbl_sub['diff']); if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];} ?>
<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" value="<?php echo $difq;?>" readonly="true" >&nbsp;&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Quality (QC)</td>
</tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">Quality Status&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtystat" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['qc'];?>" style="background-color:#CCCCCC" readonly="true">&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvisualck" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"  value="<?php echo $row_tbl_sub['vchk'];?>" style="background-color:#CCCCCC" readonly="true">&nbsp;</td>
</tr>
<tr class="Dark" height="25">
  <td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4"   value="<?php echo $row_tbl_sub['moisture'];?>" id="rn2" onchange="moschk(this.value);" style="background-color:#cccccc"  readonly="true"/></td>

   <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
   <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="4"  onkeypress="return isNumberKey1(event)"   value="<?php echo $row_tbl_sub['gemp'];?>"   readonly="true" style="background-color:#CCCCCC"/>%&nbsp;	</td>
   <!--<td align="right"  valign="middle" class="tblheading">QC Status &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtqc" style="width:100px;" onchange="visuchk(this.value)">
   <option <?php //if($row_tbl_sub['qcstatus']=="UT"){ echo "Selected";} ?> value="UT">UT</option>
	   <option <?php //if($row_tbl_sub['qcstatus']=="OK"){ echo "Selected";} ?> value="OK">OK</option>
	    <option <?php //if($row_tbl_sub['qcstatus']=="Fail"){ echo "Selected";} ?> value="Fail">Fail</option>
		 <option <?php //if($row_tbl_sub['qcstatus']=="RT"){ echo "Selected";} ?> value="RT">RT</option>
    
  </select>  <font color="#FF0000">*</font><input name="txtqc1" type="hidden" size="30" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="30"/></td>-->
</tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">Last Test Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="dcdate1" type="text" size="10" class="tbltext" tabindex="0" value="<?php echo $tdate12;?>" maxlength="10" style="background-color:#CCCCCC" readonly="true"/>&nbsp;</td>
</tr>
</table>
<div id="transs" style="display:<?php if($row_tbl_sub['vchk']=="Not-Acceptable"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="203" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="741" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtreason" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl_sub['remarks'];?>" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
<td width="206" align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td width="306" align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" name="txtgot" class="tbltext" size="10" maxlength="90" value="<?php echo $row_tbl_sub['got'];?>" style="background-color:#cccccc"  readonly="true">	</td>
  <td width="167" align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td width="261" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="gotstatus" class="tbltext" size="10" maxlength="90" value="<?php echo $row_tbl_sub['got1'];?>" style="background-color:#cccccc"  readonly="true"></td>
  </tr>
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
 <td width="206" align="right"  valign="middle" class="tblheading">Got Test Date&nbsp;</td>
<td width="738" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="dcdate12" type="text" size="10" class="tbltext" tabindex="0" value="<?php echo $tdate13;?>" maxlength="10" readonly="true"  style="background-color:#cccccc" />&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<?php
	$dt=$row_tbl_sub['leduration'];
	$dp2=$row_tbl_sub['leupto'];
	$dp1=$dp2[2]."-".$dp2[1]."-".$dp2[0];
 	$leupto=$dp1;
?>
 <td align="right"  valign="middle" class="tblheading">Life Expectancy (LE) Duration&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  >&nbsp;<input type="hidden" name="leduration" class="tbltext" value="<?php echo $dt;?>" /><?php echo $dt;?>&nbsp;Months</td>
 <td align="right"  valign="middle" class="tblheading">Life Expectancy (LE)&nbsp;</td>
  <td align="left"  valign="middle" class="tbltext" id="ledet" >&nbsp;<?php echo $leupto;?><input type="Hidden" name="leupto" id="leupto" class="tbltext" tabindex="0" readonly="true" value="<?php echo $leupto;?>" size="10" style="background-color:#CCCCCC" /></td>
</tr>
</table>



<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >

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
//$c=$row_tbl_sub['classification_id'];
//$f=$row_tbl_sub['item_id'];
//$ba=0;
//$up=0;
$sql_sub_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_id='".$a."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
$tot_sub_sloc=mysqli_num_rows($sql_sub_sloc);
/*$sql_sub_sloc1=mysqli_query($link,"select whid,binid,subbin from tblarr_sloc where arr_id='".$rid."' and qty_good=0 and ups_good=0") or die(mysqli_error($link));
echo $tot_sub_sloc1=mysqli_num_rows($sql_sub_sloc1);*/
$srno=1;
while($row_sub_sloc=mysqli_fetch_array($sql_sub_sloc))
{
$cnt++;
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sub_sloc['binid']."' and whid='".$row_sub_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."' and binid='".$row_sub_sloc['binid']."' and whid='".$row_sub_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

/*
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_sub_sloc['subbin']."' and lotldg_binid='".$row_sub_sloc['binid']."' and lotldg_whid='".$row_sub_sloc['whid']."' and lotldg_varietyid='".$f."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where stlg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
//echo $t=mysqli_num_rows($sql_issuetbl);
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$up=$row_issuetbl['lotldg_balbags'];
$ba=$row_issuetbl['lotldg_balqty'];
}
*/
$s_good_new=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_subbinid='".$row_sub_sloc['subbin']."' and lotldg_lotno='".$row_tbl_sub['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$r_good_new=mysqli_num_rows($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);
if($r_good_new > 0)
	{
	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issueg_new['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new['lotldg_binid']."' and lotldg_whid='".$row_issueg_new['lotldg_whid']."' and lotldg_lotno='".$row_tbl_sub['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1_new[0]."' and plantcode='$plantcode' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno_new=mysqli_num_rows($sql_issuetblg_new);
	
	
		$row_issuetblg_new=mysqli_fetch_array($sql_issuetblg_new);
		//echo $row_issuetblg_new['lotldg_trid'];
		
		if($row_issuetblg_new['lotldg_trtype']=="Fresh Seed with PDN")
		{
			$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new=mysqli_fetch_array($sql_crop_new);
			
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
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_sub_sloc['whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_sub_sloc['binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_sub_sloc['subbin'];?>" /></td>
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['bags'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php $dq=explode(".",$row_sub_sloc['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_sub_sloc['qty'];}?>					
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $dcq;?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_sub_sloc['rowid'];?>" />
  </tr>
  <?php
 }
 else
 {
 ?>
  <tr class="Dark" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_sub_sloc['whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_sub_sloc['binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_sub_sloc['subbin'];?>" /></td>
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['bags'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php $dq=explode(".",$row_sub_sloc['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_sub_sloc['qty'];}?>				
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $dcq;?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_sub_sloc['rowid'];?>" />
  </tr>
  <?php 
 }
 $srno++;
 } 
?>
<?php
$s_good_new11=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_tbl_sub['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$r_good_new11=mysqli_num_rows($s_good_new11);
while($row_issueg_new11=mysqli_fetch_array($s_good_new11))
{


	$sql_issueg1_new11=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issueg_new11['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new11['lotldg_binid']."' and lotldg_whid='".$row_issueg_new11['lotldg_whid']."' and lotldg_lotno='".$row_tbl_sub['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1_new11=mysqli_fetch_array($sql_issueg1_new11); 
	
	$sql_issuetblg_new11=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1_new11[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$totno_new11=mysqli_num_rows($sql_issuetblg_new11);
	$row_issuetblg_new11=mysqli_fetch_array($sql_issuetblg_new11);
	
	$sql_sub_sloc11=mysqli_query($link,"select * from tblarr_sloc where whid='".$row_issuetblg_new11['lotldg_whid']."' and binid='".$row_issuetblg_new11['lotldg_binid']."' and subbin='".$row_issuetblg_new11['lotldg_subbinid']."' and arr_id='".$a."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
$row_sub_sloc11=mysqli_fetch_array($sql_sub_sloc11);
$tot_sub_sloc11=mysqli_num_rows($sql_sub_sloc11);

if($tot_sub_sloc11==0)
{

	$cnt++;
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetblg_new11['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetblg_new11['lotldg_binid']."' and whid='".$row_issuetblg_new11['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetblg_new11['lotldg_subbinid']."' and binid='".$row_issuetblg_new11['lotldg_binid']."' and whid='".$row_issuetblg_new11['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];



$s_good_new=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_subbinid='".$row_issuetblg_new11['lotldg_subbinid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issueg_new['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new['lotldg_binid']."' and lotldg_whid='".$row_issueg_new['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1_new[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
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
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
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
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
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
 }
?>



  <?php
//echo $cnt;
if($cnt==0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
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
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
        <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
        <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
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
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
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
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
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
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
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
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
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
?>
</table>
<br />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>