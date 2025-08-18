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
	$crop = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	 $variet = $_GET['c'];	 
	}

if(isset($_GET['f']))
	{
	 $f = $_GET['f'];	
	} 
/*	}
$sql_crop=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   sstage='".$d."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$stage=$row_crop['sstage'];
*/
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$tot_crop=mysqli_num_rows($sql_crop);
if($tot_crop > 0)
{ $crop=$row_crop['cropname'];}
// $crop; 
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variet."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$tot_variety=mysqli_num_rows($sql_variety);
if($tot_variety > 0)
{ $variet=$row_variety['popularname'];}


$tot_row=0;
$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$a."' and lotcrop='".$crop."' and lotvariety='".$variet."'and lottrtype='Trading'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
 $tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

 
 if($row['lotvariety']!="")
 {
 	$variety=$row['lotvariety'];
 	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$variet."' and actstatus='Active' and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$qctyp=$row11['opt'];
	$i=$row11['varietyid'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where  spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
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
// echo $tot_row;
 $oldlot=$row['lotoldlot'];		
if($tot_row > 0)
{
?>
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>


<?php 

$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$a."'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);


  $lot=$row['lotcrop'];	
 $variety=$row['lotvariety'];
  $oldlot=$row['lotoldlot'];		
?>
 
<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$tp1=$row_cls['code'];
		
	/*$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}*/
						?>
<!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $lot;?>" maxlength="10"/>&nbsp;<font color="#FF0000">*</font>	</td>

<td width="131" align="right" valign="middle" class="tblheading">Variety</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $variety;?>" maxlength="20"/>&nbsp;<font color="#FF0000">*</font></td>
</tr>-->
<?php
$cod="";
			if($f=="Raw"){$cod="R";}else if($f=="Condition"){$cod="C";}else{$cod="";}
			?>
<tr class="Light" height="30">
<td width="185" align="right"  valign="middle" class="tblheading"> Lot No.&nbsp;</td>
<td width="344" align="left"  valign="middle" class="tblheading" >&nbsp;<input name="txtold" type="text" size="20" class="tblheading" tabindex="" maxlength="20"  style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp1?><?php echo $a?>/00000/00<?php echo $cod?>"/>&nbsp;&nbsp;</td>
<input type="hidden" name="gln1" value="<?php echo $tp1?><?php echo $a?>/00000/00" />
<td width="197" align="right" valign="middle" class="tblheading">Vendor Lot No.&nbsp;</td>
<td width="214" align="left" valign="middle" class="tbltext">&nbsp;
  <input name="txtold1" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $oldlot;?>" maxlength="20"/>&nbsp;</td>
</tr>

 <tr class="Dark" height="25">
           <td align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;As Per&nbsp;DC</td>

<td align="left"  valign="middle" class="tblheading">&nbsp;As Per&nbsp;Actual</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;Difference	</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags (NoB)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="4" onchange="bagschk1(this.value);" onkeypress="return isNumberKey1(event)"/>&nbsp;<font color="#FF0000">*</font> </td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="4" onchange="bagschk2(this.value);" onkeypress="return isNumberKey1(event)"/>  &nbsp;<font color="#FF0000">*</font></td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffnob" type="text" size="10" class="tbltext" tabindex=""    maxlength="9" style="background-color:#CCCCCC" readonly="true"  onkeypress="return isNumberKey(event)"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcqty" type="text" size="9" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk1(this.value);" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font></td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactqty" type="text" size="9" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk2(this.value);" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font>	</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="9" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey(event)" />&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading"> Quality (QC)</td>
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
<div id="transs" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="757" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>		   
		   <tr class="Light" height="30">
<td width="188" align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td width="341" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onchange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Auto GOT at Arrival Status&nbsp;<input name="autogotstatus" type="text" size="7" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $qctyp?>" /></td>
<td width="222" align="right"  valign="middle" class="tblheading">Generate GOT Sample&nbsp;</td>
 <td width="189" align="left"  valign="middle" class="tbltext">&nbsp;<?php if($qctyp == "Mandatory"){?>
   <input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else { ?><input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" value="0" onclick="gensmpchk()" /><?php } ?><input type="hidden" name="gscheckbox" value="<?php if($qctyp == "Mandatory"){ echo "1";}?>"  /></td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="gotstatus" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="20"/></td>
 <td width="222" align="right" valign="middle" class="tblheading">Seed Status&nbsp;</td>
<td width="189" align="left" valign="middle" class="tbltext">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
 </tr>

</table>

<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
    <td width="353" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="279" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  
</table>
<br />
<?php
//}
?>
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
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
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. Lot number not Generated using this Crop and Variety.</td>
</tr>
</table>
<?php
}
?>