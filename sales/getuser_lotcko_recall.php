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
if(isset($_GET['f']))
{
	$f = $_GET['f'];	 
}
if(isset($_GET['g']))
{
	$g = $_GET['g'];	 
}
if(isset($_GET['h']))
{
	$h = $_GET['h'];	 
}
if(isset($_GET['l']))
{
	$l = $_GET['l'];	 
}

$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND orlot='".$a."' and packtype='".$h."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_orlot='".$a."' and salesr_id='".$g."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 || $row_month==0)$sflg++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
if($row_month>0)
{
if($b!=$noticia33['cropid'])$val1++;
if($c!=$noticia_item43['varietyid'])$val1++;
}
if($val1>0)$val++;
if($val==0)
{

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$g."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$g."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
//$tid=$row_tbl_sub['salesr_id'];
//$subtid=$row_tbl_sub['salesr_id'];


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$b."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$c."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

	$wtmp="";$mptnop=""; $srnonew=0;
	$p1_array=explode(",",$noticia_item['gm']);
	$p1_array2=explode(",",$noticia_item['wtmp']);
	$p1_array3=explode(",",$noticia_item['mptnop']);
	$p1=array();
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			if($ups==$row_tbl_sub['salesrs_ups'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$row_tbl_sub['salesrs_ups']);
	$packtyp=$packtp[0]; 
	$ptp=""; $ptp1="";
	if($packtp[1]=="Gms")
	{ 
		$ptp=(1000/$packtp[0]);
		$ptp1=($packtp[0]/1000);
	}
	else
	{
		$ptp=$packtp[0];
		$ptp1=$packtp[0];
	}


?><table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?>
      <input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	
</tr>

<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_ups']!="" && $row_tbl_sub['salesrs_ups']!="--Select UPS-") {?><input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_ups'];?>"   /><?php } else { ?><?php if($row_tbl_sub['salesrs_upstype']!="Standard"){?><input type="text" class="tbltext" name="txtupsdc" id="txtupsdc" size="15" maxlength="15" onchange="verchk(this.value);" value="" /><?php } else { ?><select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
	<?php foreach($toup as $val) { if($val<>"") { 
	$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$upst=$row_var['ups']." ".$row_var['wt']; ?>
		<option <?php if($row_tbl_sub['salesrs_ups']==$upst) echo "selected";?> value="<?php echo $upst;?>" />   
		<?php echo $upst;?>
	<?php }} ?></select><?php } }?>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopd" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $row_tbl_sub['salesrs_nob'];?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_qty'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>
<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)" onchange="verchk();"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>-->
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="0" onkeypress="return isNumberKey(event)" onchange="upchk2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc3" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="nopschk(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="125" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc2" type="text" size="10" class="tbltext" tabindex="" maxlength="7" value="0" onkeypress="return isNumberKey1(event)" onchange="nopschk2(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc3" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
if($sflg==0)
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" value="" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" value="" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" value="" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select name="txtqcstatus" class="tbltext" style="size:70px">
<option value="" selected="selected">--Select--</option>
<option value="OK">OK</option>
<option value="Fail">Fail</option>
<option value="UT">UT</option>
<option value="RT">RT</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right" valign="middle" class="tblheading" >DoT&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" value="" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dot');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" value=""  />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" value=""  />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select name="txtpp" class="tbltext" style="size:80px"  >
 <option value="" selected="selected">-Select-</option>
 <option value="Acceptable">Acceptable</option> 
 <option value="Not-Acceptable">Not-Acceptable</option> 
 </select></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onchange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="qcsreq" style="width:80px;" onchange="qtchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="OK" >OK</option>
	<option value="UT" >UT</option>
	</select>&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgotstatus" value="" /></td>	
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dogt');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dop');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" value="" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dov');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;Cannot show Lot Details.</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;Reasons: 1. Lot not present in System(for current Plant application login)</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Lot not Packed(for current Plant application login)</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Crop/Variety mismatch for selected Lot with the verifying record</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Lot already received in this Transaction</td>
</tr>
</table>
<?php
}
?>