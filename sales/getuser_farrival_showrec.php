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
$tot_row=0;
$tot_arrsub=0;
$fg=0;
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' AND old='".$a."'") or die(mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_tbl_sub);

$lotqry=mysqli_query($link,"select * from tbllotimp where lotnumber='".$a."' and lottrtype='Fresh Seed with PDN'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

$crp="";$crp1="";
$sql_crp=mysqli_query($link,"select * from tblcrop where cropname='".$lot."'") or die(mysqli_error($link));
if($tot_crp=mysqli_num_rows($sql_crp)>0)
{
$row_crp=mysqli_fetch_array($sql_crp);
$crp=" and crop='".$row_crp['cropid']."'";
$crp1=" and crop!='".$row_crp['cropid']."'";
} 
if($row['lotvariety']!="")
{
	$variety=$row['lotvariety'];
}
else
{
 	$sql_spcd=mysqli_query($link,"select * from tblspcodes where spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."' $crp1 ") or die(mysqli_error($link));
	$ttop=mysqli_num_rows($sql_spcd);
	
	$sql_spc=mysqli_query($link,"select * from tblspcodes where spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."' $crp ") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($ttop > 0 && $xx == 0)$fg++;
	if($xx > 0)
	{
		$x=$row_spc['variety'];
		$z=$row_spc['crop'];
		$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."' and actstatus='Active'");
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

// echo $tot_row;
$vvr=$lot."-"."Coded";
if($variety=="")
{
$variety=$vvr;
}
 $oldlot=$row['lotoldlot'];	
 if($variety==$vvr)
{
$x=$variety;
}	

//echo $variety;
//echo $vvr;

if($tot_row > 0 && $tot_arrsub==0 && $fg==0)
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<!--<td width="205" align="right" valign="middle" class="tblheading">GRN No.&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="grn" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="0000" maxlength="10"/>&nbsp;</td>-->

<td width="131" align="right" valign="middle" class="tblheading">Organiser&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="organi" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['lotorganiser'];?>" maxlength="30"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
 <?php
	$pdndate2=$row['pdndate'];
	$pdntyear2=substr($pdndate2,0,4);
	$pdntmonth2=substr($pdndate2,5,2);
	$pdntday2=substr($pdndate2,8,2);
	$pdndate2=$pdntday2."-".$pdntmonth2."-".$pdntyear2;
?>

<td align="right"  valign="middle" class="tblheading">PDN No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtpdno" type="text" size="10" class="tbltext" tabindex=""    maxlength="10" onchange="pdchk();" onkeypress="return isNumberKey2(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['pdnno'];?>"/><input type="hidden" name="productiontype" value="<?php echo $row['prodtype'];?>" /></td>
	<td width="131" align="right" valign="middle" class="tblheading">PDN Date&nbsp;</td>
           <!-- <td width="171" align="left"  valign="middle">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" onclick="showCalendar('edate')" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->
			
			<td width="171" align="left"  valign="middle">&nbsp;<input name="txtpdndate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $pdndate2;?>" /></td>
           </tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">SP Code Female&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodef" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['lotspcodef'];?>">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">SP Code Male&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodem" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['lotspcodem'];?>" />&nbsp;</td>

<tr>
<tr class="Dark" height="30" id="crver">
<td width="205" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['lotcrop'];?>" maxlength="10"/>&nbsp;<input type="hidden" name="cid" value="<?php echo $lot;?>" /></td>

<td width="131" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $variety;?>" maxlength="10"/>&nbsp;<input type="hidden" name="vid" value="<?php echo $x;?>" /></td>
</tr>

<?php 
$prloc=mysqli_query($link,"select productionlocationid  , productionlocation  from tblproductionlocation order by productionlocationid ") or die(mysqli_error($link));
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Production Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['lotploc'];?>" maxlength="30"/>&nbsp;</td>
<?php 
$p=mysqli_query($link,"select productionpersonnelid , productionpersonnel from tblproductionpersonnel where plantcode='$plantcode' order by productionpersonnelid ") or die(mysqli_error($link));
?>
<td align="right"  valign="middle" class="tblheading">Production Personnel&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="personnel">&nbsp;<input name="txtprod" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['lotpper'];?>" maxlength="30"/></td>
</tr>
<?php 
$farmer=mysqli_query($link,"select farmerid , farmername from  tblfarmer order by farmerid ") or die(mysqli_error($link));
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Farmer&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="farm">&nbsp;<input name="txtfar" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['lotfarmer'];?>" maxlength="30"/></select>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Plot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtplot" type="text" size="10" class="tbltext" tabindex=""    maxlength="2"  readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['lotplotno'];?>" />	</td>
</tr>
<tr class="Light" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Geographic Index&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="gcode" type="text" size="2" class="tbltext" tabindex=""    maxlength="3" onchange="gichk(this.value);" onkeypress="return isNumberKey1(event)"/>&nbsp;<font color="#FF0000">*</font></td>
	<td align="right"  valign="middle" class="tblheading"> Harvest Date&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF"  />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	<!--<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->
  </tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;PDN</td>

<td align="left"  valign="middle" class="tblheading">&nbsp;Actual</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;Difference</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags (NoB)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="4" onchange="bagschk1();" onkeypress="return isNumberKey1(event)"/>&nbsp;<font color="#FF0000">*</font> </td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="4" onchange="bagschk2(this.value);" onkeypress="return isNumberKey1(event)"/>&nbsp;<font color="#FF0000">*</font></td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffnob" type="text" size="10" class="tbltext" tabindex=""    maxlength="10" style="background-color:#CCCCCC" readonly="true"  onkeypress="return isNumberKey1(event)"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcqty" type="text" size="9" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk1();" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font></td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactqty" type="text" size="9" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk2(this.value);" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font>	</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="9" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey(event)" />&nbsp;</td>
</tr>

<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk(this.value);" onkeypress="return isNumberKey(event)"/> 
%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" id="tvisualck" name="txtvisualck" style="width:110px;" onchange="clk3(this.value)">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>

<!--<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">QC Status &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtqc" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="UT" >UT</option>
	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >RT</option>
    
  </select>  <font color="#FF0000">*</font><input name="txtqc1" type="hidden" size="30" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="30"/></td>
  
</tr>
--><tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Generate QC Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qc2"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 <td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqc" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="UT" maxlength="20"/></td>
</tr>
<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">GS Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="gs1"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 </tr>
</table>

<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" > 
 <tr class="Light" height="30" style="border-color:#a8a09e">
<td align="right" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl_sub['remarks'];?>" ></td>
</tr>
</table>-->
<div id="transs" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="230" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT ) </td>
</tr>		   
		   <tr class="Light" height="30">
<td width="229" align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td width="325" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onchange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Auto GOT at Arrival Status&nbsp;<input name="autogotstatus" type="text" size="7" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $qctyp?>" /></td>
<td width="232" align="right"  valign="middle" class="tblheading">Generate GOT Sample&nbsp;</td>
 <td width="154" align="left"  valign="middle" class="tbltext">&nbsp;<?php if($variety==$vvr){?>  <input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else if($qctyp == "Mandatory"){?>
   <input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else { ?><input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" value="0" onclick="gensmpchk()" /><?php } ?><input type="hidden" name="gscheckbox" value="<?php if($qctyp == "Mandatory"){ echo "1";} if($variety==$vvr){ echo "1";}?>"  /></td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="gotstatus" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="20"/></td>
 </tr>

</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 


 <tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="307"  align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="sstage" style="width:120px;" onchange="sschk(this.value)" id="tmt">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
   <!-- <option value="Condition" >Condition</option>
	<option value="Packseed" >Pack</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<td width="148" align="right" valign="middle" class="tblheading">Seed Status&nbsp;</td>
<td width="256" align="left" valign="middle" class="tbltext">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
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
 <td align="left"  valign="middle" class="tblheading" colspan="3" >&nbsp;<input name="glotno" type="text" size="20" class="tblheading" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tp1?><?php echo $a?>/00000/00"  maxlength="20"/><input type="hidden" name="gln" value="<?php echo $tp1?><?php echo $a?>/00000/00" /><input type="hidden" name="gln1" value="<?php echo $tp1?><?php echo $a?>/00000/00" /></td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Storage Location (SLOC) </td>
</tr>
</table>


<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
    <td width="331" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="301" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  
</table>

</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details not displaying, reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot Number not Imported - Import lot from LotGen.</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already arrived - Check Lot Biography.</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. Lot number Crop mismatch - Check SP Code combination from Decode-SLOC search.</td>
</tr>
</table>
<?php
}
?>