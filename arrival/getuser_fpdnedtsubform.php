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



$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrsub_id='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['arrival_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$pdate=$row_tbl_sub['pdndate'];
	$pyear=substr($pdate,0,4);
	$pmonth=substr($pdate,5,2);
	$pday=substr($pdate,8,2);
	$pdate=$pday."-".$pmonth."-".$pyear;
	
	$hdate=$row_tbl_sub['harvestdate'];
	$hyear=substr($hdate,0,4);
	$hmonth=substr($hdate,5,2);
	$hday=substr($hdate,8,2);
	$hdate=$hday."-".$hmonth."-".$hyear;
	
	$hdate2=$row_tbl_sub['leupto'];
	$hyear2=substr($hdate2,0,4);
	$hmonth2=substr($hdate2,5,2);
	$hday2=substr($hdate2,8,2);
	$leupto=$hday2."-".$hmonth2."-".$hyear2;
	

$sql_spc=mysqli_query($link,"select * from tblspcodes where spcodem='".$row_tbl_sub['spcodem']."' and spcodef='".$row_tbl_sub['spcodef']."'") or die(mysqli_error($link));
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
	$dt=$row11['leduration'];
	//$leupto='';
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	//$leupto='';
	$dt='';
	}
	
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<!--<td width="228" align="right" valign="middle" class="tblheading">GRN No.&nbsp;</td>
<td width="279"  align="left" valign="middle" class="tbltext">&nbsp;<input name="grn" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="0000" maxlength="10"/>  &nbsp;</td>-->

<td width="175" align="right" valign="middle" class="tblheading">Organiser&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="organi" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['organiser'];?>" maxlength="30"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">PDN No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtpdno" type="text" size="10" class="tbltext" tabindex=""    maxlength="10" onchange="pdchk();" onkeypress="return isNumberKey2(event)" value="<?php echo $row_tbl_sub['pdnno'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="175" align="right" valign="middle" class="tblheading">PDN Date&nbsp;</td>
            <td width="258" align="left"  valign="middle">&nbsp;<input name="txtpdndate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $pdate;?>"  style="background-color:#CCCCCC"/>&nbsp;</td>
  </tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">SP Code Female&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodef" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['spcodef'];?>"></td>
<td align="right"  valign="middle" class="tblheading">SP Code Male&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodem" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['spcodem'];?>" />&nbsp;</td>
</tr>
<tr class="Dark" height="30" id="crver">
<td width="228" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="279"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotcrop'];?>" maxlength="10"/>&nbsp;<input type="hidden" name="cid" value="<?php echo $lot;?>" /></td>

<td width="175" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotvariety'];?>" maxlength="10"/>&nbsp;<input type="hidden" name="vid" value="<?php echo $x;?>" /></td>
</tr>

<?php 
$prloc=mysqli_query($link,"select productionlocationid  , productionlocation  from tblproductionlocation order by productionlocationid ") or die(mysqli_error($link));
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Production Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['ploc'];?>" maxlength="30"/>&nbsp;</td>
<?php 
$p=mysqli_query($link,"select productionpersonnelid , productionpersonnel from tblproductionpersonnel order by productionpersonnelid ") or die(mysqli_error($link));
?>
<td align="right"  valign="middle" class="tblheading">Production Personnel&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="personnel">&nbsp;<input name="txtprod" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['pper'];?>" maxlength="30"/>&nbsp;</td>
</tr>
<?php 
$farmer=mysqli_query($link,"select farmerid , farmername from  tblfarmer order by farmerid ") or die(mysqli_error($link));
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Farmer&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="farm">&nbsp;<input name="txtfar" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['farmer'];?>" maxlength="30"/>&nbsp;
</select></td>

<td align="right"  valign="middle" class="tblheading">Plot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtplot" type="text" size="10" class="tbltext" tabindex=""    maxlength="2"  readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['plotno'];?>" />	</td>
</tr>
<tr class="Light" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Geographic Index&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="gcode" type="text" size="2" class="tbltext" tabindex=""    maxlength="3" onchange="gichk(this.value);" value="<?php echo $row_tbl_sub['gi'];?>" onkeypress="return isNumberKey1(event)"/>&nbsp;<font color="#FF0000">*</font></td>
	<td align="right"  valign="middle" class="tblheading"> Harvest Date&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $hdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;PDN</td>

<td align="left"  valign="middle" class="tblheading">&nbsp;Actual</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;Difference	</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags(NoB)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="3" onchange="bagschk1();" onkeypress="return isNumberKey1(event)" value="<?php echo $row_tbl_sub['qty1'];?>"/>&nbsp;<font color="#FF0000">*</font> </td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="3" onchange="bagschk2(this.value);" onkeypress="return isNumberKey1(event)" value="<?php echo $row_tbl_sub['act1'];?>"/>&nbsp;<font color="#FF0000">*</font></td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffnob" type="text" size="10" class="tbltext" tabindex=""    maxlength="10" style="background-color:#CCCCCC" readonly="true"  onkeypress="return isNumberKey1(event)" value="<?php echo $row_tbl_sub['diff1'];?>"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Quantitiy&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk1();" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_sub['qty'];?>"/>&nbsp;<font color="#FF0000">*</font></td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk2(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_sub['act'];?>"/>&nbsp;<font color="#FF0000">*</font>	&nbsp;&nbsp;Tare Weight&nbsp;<input name="txttareqty" type="text" size="7" class="tbltext" tabindex=""  value="<?php echo $row_tbl_sub['tarewt'];?>"   maxlength="9" onchange="qtychk3();" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font></td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="9" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_sub['diff'];?>" />&nbsp;</td>
</tr>

<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" id="txtmoist" name="txtmoist" style="width:110px;" onchange="moischk(this.value)">
 <option <?php if($row_tbl_sub['moisture']=="Acceptable"){ echo "Selected";} ?> value="Acceptable">Acceptable</option>
	<option <?php if($row_tbl_sub['moisture']=="Not-Acceptable"){ echo "Selected";} ?>   value="Not-Acceptable" >Not- Acceptable</option>  </select>  <font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" id="tvisualck" name="txtvisualck" style="width:110px;" onchange="clk3(this.value)">
 <option <?php if($row_tbl_sub['vchk']=="Acceptable"){ echo "Selected";} ?> value="Acceptable">Acceptable</option>
	<option <?php if($row_tbl_sub['vchk']=="Not-Acceptable"){ echo "Selected";} ?>   value="Not-Acceptable" >Not- Acceptable</option>  </select>  <font color="#FF0000">*</font>	</td>
</tr>

<!--<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">QC Status &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtqc" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="UT" <?php if($row_tbl_sub['qc']=="UT"){ echo "Selected";} ?> >UT</option>
	<option value="OK" <?php if($row_tbl_sub['qc']=="OK"){ echo "Selected";} ?> >OK</option>
	<option value="Fail" <?php if($row_tbl_sub['qc']=="Fail"){ echo "Selected";} ?> >Fail</option>
	<option value="RT" <?php if($row_tbl_sub['qc']=="RT"){ echo "Selected";} ?> >RT</option>
    
  </select>  <font color="#FF0000">*</font><input name="txtqc1" type="hidden" size="30" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['qc'];?>" maxlength="30"/></td>
</tr>-->
<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Generate Qc Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qc2"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"/></td>
 <td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqc" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['qc'];?>" maxlength="20"/></td>
</tr>
<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">GS Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="gs1"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 </tr>
 
<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Life Expectancy (LE) Duration&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  >&nbsp;<select name="leduration" class="tbltext" tabindex="0" style="width:40px;" onchange="showledur(this.value)"  > 
 <option value="">Select</option>
 <?php for($i=$dt; $i>0; $i--) {?>
 <option <?php if($row_tbl_sub['leduration']==$i)echo "Selected";?> value="<?php echo $i;?>" ><?php echo $i;?></option>
 <?php } ?>

 </select>&nbsp;Months</td>
 <td align="right"  valign="middle" class="tblheading">Life Expectancy (LE)&nbsp;</td>
  <td align="left"  valign="middle" class="tbltext" id="ledet" >&nbsp;<input type="text" name="leupto" id="leupto" class="tbltext" tabindex="0" readonly="true" value="<?php echo $leupto;?>" size="10" style="background-color:#CCCCCC" />&nbsp;&nbsp;From Harvest Date</td>
</tr>
</table>
<div id="transs" style="display:<?php if($row_tbl_sub['vchk'] == "Not-Acceptable"){ echo "block";}else{ echo "none";} ?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="228" align="right" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="716" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl_sub['remarks'];?>" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
		   <tr class="Light" height="30">
<td width="229" align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td width="339" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onchange="gotchk(this.value)">
<option <?php if($row_tbl_sub['got']=="GOT-R"){ echo "Selected";} ?> value="GOT-R">GOT-R</option>
  <option <?php if($row_tbl_sub['got']=="GOT-NR"){ echo "Selected";} ?> value="GOT-NR">GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Auto GOT at Arrival Status&nbsp;<input name="autogotstatus" type="text" size="7" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $qctyp?>" /></td>
<td width="208" align="right"  valign="middle" class="tblheading">Generate GOT Sample&nbsp;</td>
 <td width="164" align="left"  valign="middle" class="tbltext" >&nbsp;<?php if($qctyp == "Mandatory" || $qctyp == ""){?>
   <input name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else { if($row_tbl_sub['got']=="GOT-R"){?><input name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else { ?><input name="gotsample"  type="checkbox" <?php if($row_tbl_sub['sample']=="1"){ echo "checked";}  ?> class="tbltext" tabindex="0" value="<?php if($row_tbl_sub['sample']=="1"){ echo "1";} else { echo "0";} ?>" onclick="gensmpchk()" /><?php }} ?><input type="hidden" name="gscheckbox" value="<?php echo $row_tbl_sub['sample'];?>"  /></td>
</tr>
<tr class="Dark" height="25">
  <td align="right"  valign="middle" class="tblheading">GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="gotstatus" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['got1'];?>" maxlength="20"/></td>

</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 

 <tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="280"  align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="sstage" style="width:120px;" onchange="sschk(this.value)" id="tmt">
    <option value="" selected>--Select--</option>
    <option value="Raw" <?php if($row_tbl_sub['sstage']=="Raw"){ echo "Selected";} ?> >Raw</option>
   <!-- <option value="Condition" <?php if($row_tbl_sub['sstage']=="Condition"){ echo "Selected";} ?> >Condition</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<td width="173" align="right" valign="middle" class="tblheading">Seed Status&nbsp;</td>
<td width="258" align="left" valign="middle" class="tblheading">&nbsp;<input name="sstatus" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
</tr>
<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$tp1=$row_cls['code'];
		
	/*$tp1="";
		if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
		else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}*/
?>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
 <td align="left"  valign="middle" class="tblheading" >&nbsp;<input name="glotno" type="text" size="20" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotno'];?>" maxlength="20"/><input type="hidden" name="gln" value="<?php echo $tp1?>/<?php echo $row_tbl_sub['old'];?>/00000/00" /></td>
  <td width="173" align="right" valign="middle" class="tblheading">Production Grade&nbsp;</td>
<td width="258" align="left" valign="middle" class="tblheading">&nbsp;<select name="prodctiongrade"  style="width:80px;" class="tbltext" tabindex="" >
<option <?php if($row_tbl_sub['prodgrade']=="A"){ echo "Selected";} ?> value="A">A</option>
<option <?php if($row_tbl_sub['prodgrade']=="B"){ echo "Selected";} ?>  value="B">B</option>
<option <?php if($row_tbl_sub['prodgrade']=="C"){ echo "Selected";} ?>  value="C">C</option>
<option <?php if($row_tbl_sub['prodgrade']=="D"){ echo "Selected";} ?>  value="D">D</option>
<option <?php if($row_tbl_sub['prodgrade']=="GOT"){ echo "Selected";} ?>  value="GOT">GOT</option>
<option <?php if($row_tbl_sub['prodgrade']=="NA"){ echo "Selected";} ?>  value="NA">NA</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="7" align="center" class="tblheading">Storage Location (SLOC) </td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC </td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
    <td width="294" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="98" align="center" valign="middle" class="tblheading">WH</td>
    <td width="84" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="103" align="center" valign="middle" class="tblheading">SuB Bin</td>
  </tr>
  <?php

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

/*$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_sub_sloc['subbin']."' and lotldg_binid='".$row_sub_sloc['binid']."' and lotldg_whid='".$row_sub_sloc['whid']."' and lotldg_varietyid='".$f."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where stlg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
//echo $t=mysqli_num_rows($sql_issuetbl);
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$up=$row_issuetbl['lotldg_balbags'];
$ba=$row_issuetbl['lotldg_balqty'];
}
*/
$s_good_new=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_subbinid='".$row_sub_sloc['subbin']."' and plantcode='$plantcode'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issueg_new['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new['lotldg_binid']."' and lotldg_whid='".$row_issueg_new['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1_new[0]."' and plantcode='$plantcode' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
  
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['whid']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$row_sub_sloc['whid']."' and plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where whid='".$row_sub_sloc['whid']."' and binid='".$row_sub_sloc['binid']."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
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
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="tbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['bags'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['qty'];?>"  />
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
  
    
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['whid']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$row_sub_sloc['whid']."' and plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where whid='".$row_sub_sloc['whid']."' and binid='".$row_sub_sloc['binid']."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
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
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="tbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['bags'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['qty'];?>"  />
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
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>