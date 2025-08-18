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

/*if(isset($_GET['a']))
	{
	$rid = $_GET['a'];	 
	}*/

if(isset($_REQUEST['b']))
	{
	$trid = $_REQUEST['b'];
	}


if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['salesr_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

	$tdate=$row_tbl['salesr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl_sub['salesrs_dot'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
?>
		<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
		
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="98" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row_tbl_sub['salesrs_crop']==$noticia['cropid']) echo "selected"; ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where cropname='".$row_tbl_sub['salesrs_crop']."' and actstatus='Active' order by popularname Asc"); 
?>
	<td width="107" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="211" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($row_tbl_sub['salesrs_variety']==$noticia_item['varietyid']) echo "selected"; ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="86" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" width="164" valign="middle" class="smalltblheading"  >&nbsp;<input type="hidden" id="txtstage" name="txtstage" value="Condition" />Condition</td>		
</tr>

<tr class="Light" height="30" >
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
   $zzz2=implode(",", str_split($row_tbl_sub['salesrs_newlot']));
   //print_r($zzz);
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc");

$lotch1=$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
$lotch2=$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$lotch3=$zzz[28].$zzz[30].$zzz[32];

$lotch1o=$zzz2[4].$zzz2[6].$zzz2[8].$zzz2[10].$zzz2[12];
$lotch2o=$zzz2[16].$zzz2[18].$zzz2[20].$zzz2[22].$zzz2[24];
$lotch3o=$zzz2[28].$zzz2[30];
?>	
<td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
	<td align="left" width="270" valign="middle" class="tblheading" >&nbsp;<select class="smalltbltext" name="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option <?php if($zzz[0]==$a) echo "selected"; ?> value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia1 = mysqli_fetch_array($quer5)) { ?>
    <option<?php if($zzz[0]==$noticia1['stcode']) echo "selected"; ?> value="<?php echo $noticia1['stcode'];?>" />  
    <?php echo $noticia1['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
   <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option <?php if($zzz[2]==$noticia['ycode']) echo "selected"; ?> value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)"  onchange="lot2chko();" value="<?php echo $lotch1;?>"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey24(event)"   value="<?php echo $lotch2;?>" onchange="stchko();" onblur="Javascript:this.value=this.value.toUpperCase()" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="3" class="smalltbltext" tabindex="0" maxlength="3"  value="<?php echo $lotch3;?>" onchange="stchko2();" onkeypress="return isNumberKey24(event)" onblur="Javascript:this.value=this.value.toUpperCase()" />&nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotchko"><input type="hidden" name="lotchecko" value="1" /></div></td>	
	   		 
           <td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $zzz2[0];?>" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $zzz2[2];?>" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();"  value="<?php echo $lotch1o;?>" /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $lotch2o;?>" onchange="stchk();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $lotch3o;?>" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotcheck"><input type="hidden" name="lotcheck1" value="0" /></div></td>
  
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);" value="<?php echo $row_tbl_sub['salesrs_nob'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"  >&nbsp;<input name="txtactqty" type="text" size="9" class="smalltbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);" value="<?php echo $row_tbl_sub['salesrs_qty'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6" >QC Information</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="qcstatus" style="width:100px;"  onchange="varchk(this.value);"  >
    <option value="" selected>--Select--</option>
  	<option <?php if($row_tbl_sub['salesrs_qc']=="OK") echo "selected"; ?> value="OK" >OK</option>
	<option <?php if($row_tbl_sub['salesrs_qc']=="Fail") echo "selected"; ?> value="Fail" >Fail</option>
	<option <?php if($row_tbl_sub['salesrs_qc']=="RT") echo "selected"; ?> value="RT" >Retest</option>
	<option <?php if($row_tbl_sub['salesrs_qc']=="UT") echo "selected"; ?> value="UT" >UT</option>
  </select>  <font color="#FF0000">*</font>	</td>
  
  <td align="right"  valign="middle" class="tblheading">Date of Test (DoT)&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input name="edate" id="edate1" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  value="<?php echo $tdate1;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('edate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
           </tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtpp" style="width:110px;" onchange="qcchk();">
    <option value="" selected>--Select--</option>
    <option <?php if($row_tbl_sub['salesrs_pp']=="Acceptable") echo "selected"; ?> value="Acceptable" >Acceptable</option>
    <option <?php if($row_tbl_sub['salesrs_pp']=="Not-Acceptable") echo "selected"; ?> value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="smalltbltext" tabindex="" onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" value="<?php echo $row_tbl_sub['salesrs_moist'];?>" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
 <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtgemp" id="txtgerm" type="text" size="1" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);" value="<?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?>" />%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	  
           </tr>
		   		   
	

		  
	   
</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="7" align="center" class="tblheading">Storage Location (SLOC) </td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC </td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
    <td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="98" align="center" valign="middle" class="tblheading">WH</td>
    <td width="84" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="103" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$sql_sub_sloc=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesrs_id='".$subtid."' order by salesrss_id") or die(mysqli_error($link));
$tot_sub_sloc=mysqli_num_rows($sql_sub_sloc);
$srno=1;
while($row_sub_sloc=mysqli_fetch_array($sql_sub_sloc))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from plantcode='$plantcode' AND tbl_warehouse where whid='".$row_sub_sloc['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_sub_sloc['salesrss_bin']."' and whid='".$row_sub_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_sub_sloc['salesrss_subbin']."' and binid='".$row_sub_sloc['salesrss_bin']."' and whid='".$row_sub_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

/*$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_sub_sloc['subbin']."' and lotldg_binid='".$row_sub_sloc['binid']."' and lotldg_whid='".$row_sub_sloc['whid']."' and lotldg_varietyid='".$f."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where stlg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
//echo $t=mysqli_num_rows($sql_issuetbl);
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$up=$row_issuetbl['lotldg_balbags'];
$ba=$row_issuetbl['lotldg_balqty'];
}
*/
$s_good_new=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_sub_sloc['subbin']."'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issueg_new['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new['lotldg_binid']."' and lotldg_whid='".$row_issueg_new['lotldg_whid']."'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issueg1_new[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
			$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
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
			$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
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
   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_wh']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_bin']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' and binid='".$row_sub_sloc['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
   <!-- <td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_sub_sloc['whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_sub_sloc['binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_sub_sloc['subbin'];?>" /></td>-->
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_qty'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="" />
  </tr>
  <?php
 }
 else
 {
 ?>
  <tr class="Dark" height="25">
   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_wh']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_bin']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' and binid='".$row_sub_sloc['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <!--<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_sub_sloc['whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_sub_sloc['binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_sub_sloc['subbin'];?>" /></td>-->
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_qty'];?>"  />
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

if($tot_sub_sloc==0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing1">&nbsp;
        <select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing1">&nbsp;
        <select class="smalltbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;
        <select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;
        <select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
else if($tot_sub_sloc==1)
{
?>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;
        <select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;
        <select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
?>
</table>
</div>
<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>