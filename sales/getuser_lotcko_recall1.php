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

if(isset($_GET['g']))
{
	$trrid = $_GET['g'];	 
}
$subtid=0;
$subsubtid=0;
if($f=="lotn")
{
?>
<?php
$ct=0;
$a=$a."P";
$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$a."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_newlot='".$a."' and salesr_id='".$g."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 && $row_month==0)$val++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
/*if($row_month>0)
{
if($b!=$noticia33['cropid'])$val1++;
if($c!=$noticia_item43['varietyid'])$val1++;
}*/
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


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
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
			if($ups==$rowmonth['packtype'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$rowmonth['packtype']);
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
	
$doot1=explode("-",$rowmonth['lotldg_qctestdate']);
$doot=$doot1[2]."-".$doot1[1]."-".$doot1[0];
if($doot=="--" || $doot=="00-00-0000" || $doot=="NULL")$doot="";
$goot1=explode("-",$rowmonth['lotldg_gottestdate']);
$goot=$goot1[2]."-".$goot1[1]."-".$goot1[0];
if($goot=="--" || $goot=="00-00-0000" || $goot=="NULL")$goot="";

$dop1=explode("-",$rowmonth['lotldg_dop']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
if($dop=="--" || $dop=="00-00-0000" || $dop=="NULL")$dop="";

$dov1=explode("-",$rowmonth['lotldg_valupto']);
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];
if($dov=="--" || $dov=="00-00-0000" || $dov=="NULL")$dov="";
	
$ct++;

?><table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?><input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	


<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
	
?>

<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['packtype'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Wt. in MP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtwtmp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $wtmp;?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">NoP in MP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtmptnop" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $mptnop;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)" onchange="verchk();"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>-->
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoMP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);" value="0"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="0" onkeypress="return isNumberKey(event)" onchange="upchk2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" value="0"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qc'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $doot;?>"  />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gemp'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_moisture'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_vchk'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_got'];?>" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgstat" value="<?php $gt=explode(" ",$rowmonth['lotldg_got1']); echo $gt[0];?>" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $goot;?>"  /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $dop;?>" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dov;?>"  /></td>
</tr>
</table>
<?php
}
else
{
require_once("../include/config1.php");
require_once("../include/connection1.php");

$a=$a."P";
$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$a."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_newlot='".$a."' and salesr_id='".$g."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 && $row_month==0)$val++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
/*if($row_month>0)
{
if($b!=$noticia33['cropid'])$val1++;
if($c!=$noticia_item43['varietyid'])$val1++;
}*/
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


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
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
			if($ups==$rowmonth['packtype'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$rowmonth['packtype']);
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

$doot1=explode("-",$rowmonth['lotldg_qctestdate']);
$doot=$doot1[2]."-".$doot1[1]."-".$doot1[0];
if($doot=="--" || $doot=="00-00-0000" || $doot=="NULL")$doot="";
$goot1=explode("-",$rowmonth['lotldg_gottestdate']);
$goot=$goot1[2]."-".$goot1[1]."-".$goot1[0];
if($goot=="--" || $goot=="00-00-0000" || $goot=="NULL")$goot="";

$dop1=explode("-",$rowmonth['lotldg_dop']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
if($dop=="--" || $dop=="00-00-0000" || $dop=="NULL")$dop="";

$dov1=explode("-",$rowmonth['lotldg_valupto']);
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];
if($dov=="--" || $dov=="00-00-0000" || $dov=="NULL")$dov="";
	
$ct++;

?>
<table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?>
      <input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	


<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
	
?>

<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['packtype'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Wt. in MP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtwtmp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $wtmp;?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">NoP in MP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtmptnop" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $mptnop;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)" onchange="verchk();"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>-->
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoMP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);" value="0"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="0" onkeypress="return isNumberKey(event)" onchange="upchk2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" value="0" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qc'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $doot;?>"  />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gemp'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_moisture'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_vchk'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_got'];?>" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgstat" value="<?php $gt=explode(" ",$rowmonth['lotldg_got1']); echo $gt[0];?>" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $goot;?>"  /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $dop;?>" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dov;?>"  /></td>
</tr>
</table>
<?php
}
}
if($ct==0)
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
}
else if($f=="barc")
{
?>
<?php
$stge="Pack";
$flgs=0; $tbflg=0; $srno=0;

$sql_bar=mysqli_query($link,"select * from tbl_barcodes where plantcode='$plantcode' AND bar_barcode='".$a."'")or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
$tot_bar=mysqli_num_rows($sql_bar);

$sql_srbar=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_barcode='".$a."'")or die(mysqli_error($link));
$row_srbar=mysqli_fetch_array($sql_srbar);
$tot_srbar=mysqli_num_rows($sql_srbar);

if($tot_bar > 0) $tbflg=1;


if($tbflg > 0)
{

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
$row_mpm=mysqli_fetch_array($sql_mpm);
$pctp=$row_mpm['mpmain_trtype'];		

if($pctp=="PACKSMC")$packtyp="SMC";
if($pctp=="PACKLMC")$packtyp="LMC";
if($pctp=="PACKMMC")$packtyp="MMC";

$dop1=explode("-",$row_mpm['mpmain_date']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="156" align="right" valign="middle" class="smalltblheading">Barcode&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $a?><input type="hidden" name="txtbarcode" value="<?php echo $a;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">Packtype&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packtyp?><input type="hidden" name="txtpacktype" value="<?php echo $packtyp;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">DoP&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dop?><input type="hidden" name="txtedop" value="<?php echo $dop;?>" /></td>
</tr>
</table><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
<td width="14" align="center" valign="middle" class="smalltblheading">#</td>
<td width="80" align="center" valign="middle" class="smalltblheading">Crop</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Variety</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Lot No.</td>
<td width="85" align="center" valign="middle" class="smalltblheading">UPS</td>
<td width="45" align="center" valign="middle" class="smalltblheading">NoP</td>
<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
<td width="40" align="center" valign="middle" class="smalltblheading">QC Stauts</td>
<td width="64" align="center" valign="middle" class="smalltblheading">DoT</td>
<td width="44" align="center" valign="middle" class="smalltblheading">Germ. %</td>
<td width="45" align="center" valign="middle" class="smalltblheading">Moist. %</td>
<td width="51" align="center" valign="middle" class="smalltblheading">PP</td>
<td width="70" align="center" valign="middle" class="smalltblheading">GOT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DGoT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DoV</td>
</tr>
<?php
if($tot_mpm > 0)
{

$llttnn=explode(",",$row_mpm['mpmain_lotno']);
$ccrrop=explode(",",$row_mpm['mpmain_crop']);
$verty=explode(",",$row_mpm['mpmain_variety']);
$upssze=explode(",",$row_mpm['mpmain_upssize']);
$ltnnop=explode(",",$row_mpm['mpmain_lotnop']);
$cnt=count($llttnn);
for($i=0; $i<$cnt; $i++)
{

$lotno=$llttnn[$i];

$crop=""; $variety=""; $slocs=""; $crid=0; $verid=0; $ups=""; $qty=0; $nop=0; $qc=""; $dot=""; $gemp=""; $moist=""; $pp=""; $gottyp=""; $got=""; $dgot=""; $dop=""; $dov="";
	
	$pckt=explode(" ",$upssze[$i]);
	if($pckt[1]=="Gms")
	{ 
		$ptp1=(($pckt[0]*$ltnnop[$i])/1000);
	}
	else
	{
		$ptp1=($pckt[0]*$ltnnop[$i]);
	}
	
	$ups=$upssze[$i];
	$nop=$ltnnop[$i];
	$qty=$ptp1;
	
	$zzz=implode(",", str_split($row_bar['bar_lotno']));
	$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";
	$lotqry=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
	$tot_row=mysqli_num_rows($lotqry);
	
	if($tot_row > 0)
	{
		while($row_issue=mysqli_fetch_array($lotqry))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."'") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{
				$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
				$noticia = mysqli_fetch_array($quer3);
				$crop=$noticia['cropname'];
				$crid=$row_issuetbl['lotldg_crop'];
				
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$variety=$noticia_item['popularname'];
				$verid=$row_issuetbl['lotldg_variety'];
				
				
				
				
				$qc=$row_issuetbl['lotldg_qc'];
				$dot1=explode("-",$row_issuetbl['lotldg_qctestdate']);
				$gemp=$row_issuetbl['lotldg_gemp'];
				$moist=$row_issuetbl['lotldg_moisture'];
				$pp=$row_issuetbl['lotldg_vchk'];
				$gottyp1=explode(" ",$row_issuetbl['lotldg_got1']);
				$got=$row_issuetbl['lotldg_got'];
				$dgot1=explode("-",$row_issuetbl['lotldg_gottestdate']);
				
				$dov1=explode("-",$row_issuetbl['lotldg_valupto']);
				 
				 $gottyp=$gottyp1[0];
				 $dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
				 $dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
				 
				 $dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

				if($slocs!="")$slocs=$slocs.",".$row_issuetbl['subbinid'];
				else $slocs=$row_issuetbl['subbinid'];
			}
		}
	}
}
$samplno="";
if($qc=="UT" || $qc=="RT")
{
$sql_qc=mysqli_query($link,"Select max(tid) from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
$row_qc=mysqli_fetch_array($sql_qc);

$sqlqc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."' and tid='".$row_qc[0]."'") or die(mysqli_error($link));
$rowqc=mysqli_fetch_array($sqlqc);
$samplno=$rowqc['sampno'];
}
	$srno++;			
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?><input type="hidden" name="txtcrop<?php echo $srno;?>" id="txtcrop_<?php echo $srno;?>" value="<?php echo $crid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?><input type="hidden" name="txtvariety<?php echo $srno;?>" id="txtvariety_<?php echo $srno;?>" value="<?php echo $verid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?><input type="hidden" name="txtelotn<?php echo $srno;?>" id="txtelotn_<?php echo $srno;?>" value="<?php echo $lotno;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?><input type="hidden" name="txteups<?php echo $srno;?>" id="txteups_<?php echo $srno;?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nop?><input type="hidden" name="txtenop<?php echo $srno;?>" id="txtenop_<?php echo $srno;?>" value="<?php echo $nop;?>" /></td>	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty?><input type="hidden" name="txteqty<?php echo $srno;?>" id="txteqty_<?php echo $srno;?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?><input type="hidden" name="txteqc<?php echo $srno;?>" id="txteqc_<?php echo $srno;?>" value="<?php echo $qc;?>" /><input type="hidden" name="smplno<?php echo $srno;?>" id="smplno_<?php echo $srno;?>" value="<?php echo $samplno?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?><input type="hidden" name="txtedot<?php echo $srno;?>" id="txtedot_<?php echo $srno;?>" value="<?php echo $dot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp?><input type="hidden" name="txtegerm<?php echo $srno;?>" id="txtegerm_<?php echo $srno;?>" value="<?php echo $gemp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?><input type="hidden" name="txtemoist<?php echo $srno;?>" id="txtemoist_<?php echo $srno;?>" value="<?php echo $moist;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp?><input type="hidden" name="txtepp<?php echo $srno;?>" id="txtepp_<?php echo $srno;?>" value="<?php echo $pp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gottyp." ".$got?><input type="hidden" name="txtegottyp<?php echo $srno;?>" id="txtegottyp_<?php echo $srno;?>" value="<?php echo $gottyp." ".$got?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dgot?><input type="hidden" name="txtedgot<?php echo $srno;?>" id="txtedgot_<?php echo $srno;?>" value="<?php echo $dgot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dov?><input type="hidden" name="txtedov<?php echo $srno;?>" id="txtedov_<?php echo $srno;?>" value="<?php echo $dov;?>" /></td>
</tr>
<?php
}
?>
</table>
<?php
}
else
{
require_once("../include/config1.php");
require_once("../include/connection1.php");

$sql_bar=mysqli_query($link,"select * from tbl_barcodes where plantcode='$plantcode' AND bar_barcode='".$a."'")or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
$tot_bar=mysqli_num_rows($sql_bar);
if($tot_bar > 0)
{

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
$row_mpm=mysqli_fetch_array($sql_mpm);
$pctp=$row_mpm['mpmain_trtype'];		

if($pctp=="PACKSMC")$packtyp="SMC";
if($pctp=="PACKLMC")$packtyp="LMC";
if($pctp=="PACKMMC")$packtyp="MMC";

$dop1=explode("-",$row_mpm['mpmain_date']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="156" align="right" valign="middle" class="smalltblheading">Barcode&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $a?><input type="hidden" name="txtbarcode" value="<?php echo $a;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">Packtype&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packtyp?><input type="hidden" name="txtpacktype" value="<?php echo $packtyp;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">DoP&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dop?><input type="hidden" name="txtedop" value="<?php echo $dop;?>" /></td>
</tr>
</table><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
<td width="14" align="center" valign="middle" class="smalltblheading">#</td>
<td width="80" align="center" valign="middle" class="smalltblheading">Crop</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Variety</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Lot No.</td>
<td width="85" align="center" valign="middle" class="smalltblheading">UPS</td>
<td width="45" align="center" valign="middle" class="smalltblheading">NoP</td>
<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
<td width="40" align="center" valign="middle" class="smalltblheading">QC Stauts</td>
<td width="64" align="center" valign="middle" class="smalltblheading">DoT</td>
<td width="44" align="center" valign="middle" class="smalltblheading">Germ. %</td>
<td width="45" align="center" valign="middle" class="smalltblheading">Moist. %</td>
<td width="51" align="center" valign="middle" class="smalltblheading">PP</td>
<td width="70" align="center" valign="middle" class="smalltblheading">GOT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DGoT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DoV</td>
</tr>
<?php
if($tot_mpm > 0)
{

$llttnn=explode(",",$row_mpm['mpmain_lotno']);
$ccrrop=explode(",",$row_mpm['mpmain_crop']);
$verty=explode(",",$row_mpm['mpmain_variety']);
$upssze=explode(",",$row_mpm['mpmain_upssize']);
$ltnnop=explode(",",$row_mpm['mpmain_lotnop']);
$cnt=count($llttnn);
for($i=0; $i<$cnt; $i++)
{

$lotno=$llttnn[$i];

$crop=""; $variety=""; $slocs=""; $crid=0; $verid=0; $ups=""; $qty=0; $nop=0; $qc=""; $dot=""; $gemp=""; $moist=""; $pp=""; $gottyp=""; $got=""; $dgot=""; $dop=""; $dov="";
	
	$pckt=explode(" ",$upssze[$i]);
	if($pckt[1]=="Gms")
	{ 
		$ptp1=(($pckt[0]*$ltnnop[$i])/1000);
	}
	else
	{
		$ptp1=($pckt[0]*$ltnnop[$i]);
	}
	
	$ups=$upssze[$i];
	$nop=$ltnnop[$i];
	$qty=$ptp1;
	
	$zzz=implode(",", str_split($row_bar['bar_lotno']));
	$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";
	$lotqry=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
	$tot_row=mysqli_num_rows($lotqry);
	
	if($tot_row > 0)
	{
		while($row_issue=mysqli_fetch_array($lotqry))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."'") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{
				$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
				$noticia = mysqli_fetch_array($quer3);
				$crop=$noticia['cropname'];
				$crid=$row_issuetbl['lotldg_crop'];
				
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$variety=$noticia_item['popularname'];
				$verid=$row_issuetbl['lotldg_variety'];
				
				
				
				
				$qc=$row_issuetbl['lotldg_qc'];
				$dot1=explode("-",$row_issuetbl['lotldg_qctestdate']);
				$gemp=$row_issuetbl['lotldg_gemp'];
				$moist=$row_issuetbl['lotldg_moisture'];
				$pp=$row_issuetbl['lotldg_vchk'];
				$gottyp1=explode(" ",$row_issuetbl['lotldg_got1']);
				$got=$row_issuetbl['lotldg_got'];
				$dgot1=explode("-",$row_issuetbl['lotldg_gottestdate']);
				
				$dov1=explode("-",$row_issuetbl['lotldg_valupto']);
				 
				 $gottyp=$gottyp1[0];
				 $dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
				 $dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
				 
				 $dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

				if($slocs!="")$slocs=$slocs.",".$row_issuetbl['subbinid'];
				else $slocs=$row_issuetbl['subbinid'];
			}
		}
	}
}
if($qc=="UT" || $qc=="RT")
{

$sql_qc=mysqli_query($link,"Select max(tid) from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
$row_qc=mysqli_fetch_array($sql_qc);

$sqlqc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."' and tid='".$row_qc[0]."'") or die(mysqli_error($link));
$rowqc=mysqli_fetch_array($sqlqc);
$samplno=$rowqc['sampno'];
}
	$srno++;			
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?><input type="hidden" name="txtcrop<?php echo $srno;?>" id="txtcrop_<?php echo $srno;?>" value="<?php echo $crid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?><input type="hidden" name="txtvariety<?php echo $srno;?>" id="txtvariety_<?php echo $srno;?>" value="<?php echo $verid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?><input type="hidden" name="txtelotn<?php echo $srno;?>" id="txtelotn_<?php echo $srno;?>" value="<?php echo $lotno;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?><input type="hidden" name="txteups<?php echo $srno;?>" id="txteups_<?php echo $srno;?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nop?><input type="hidden" name="txtenop<?php echo $srno;?>" id="txtenop_<?php echo $srno;?>" value="<?php echo $nop;?>" /></td>	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty?><input type="hidden" name="txteqty<?php echo $srno;?>" id="txteqty_<?php echo $srno;?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?><input type="hidden" name="txteqc<?php echo $srno;?>" id="txteqc_<?php echo $srno;?>" value="<?php echo $qc;?>" /><input type="hidden" name="smplno<?php echo $srno;?>" id="smplno_<?php echo $srno;?>" value="<?php echo $samplno?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?><input type="hidden" name="txtedot<?php echo $srno;?>" id="txtedot_<?php echo $srno;?>" value="<?php echo $dot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp?><input type="hidden" name="txtegerm<?php echo $srno;?>" id="txtegerm_<?php echo $srno;?>" value="<?php echo $gemp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?><input type="hidden" name="txtemoist<?php echo $srno;?>" id="txtemoist_<?php echo $srno;?>" value="<?php echo $moist;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp?><input type="hidden" name="txtepp<?php echo $srno;?>" id="txtepp_<?php echo $srno;?>" value="<?php echo $pp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gottyp." ".$got?><input type="hidden" name="txtegottyp<?php echo $srno;?>" id="txtegottyp_<?php echo $srno;?>" value="<?php echo $gottyp." ".$got?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dgot?><input type="hidden" name="txtedgot<?php echo $srno;?>" id="txtedgot_<?php echo $srno;?>" value="<?php echo $dgot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dov?><input type="hidden" name="txtedov<?php echo $srno;?>" id="txtedov_<?php echo $srno;?>" value="<?php echo $dov;?>" /></td>
</tr>
<?php
}
?>

</table>

<?php
}
else
{
?><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" ><font color="#FF0000"\>Barcode Not Generated</font></td>
</tr>
</table>
<?php
}
}
?>
<input type="hidden" name="srrno" value="<?php echo $srno?>" />
<?php
}
else
{
?>
<?php
}
?>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $trrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp;?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1;?>" /><input type="hidden" name="wtmp" id="wtmp" value="<?php echo $wtmp;?>" /><input type="hidden" name="wtnop" id="wtnop" value="" /><input type="hidden" name="otnop" value="<?php echo $otnop?>" /><input type="hidden" name="otqty" value="<?php echo $otqty?>" /><input type="hidden" name="ocrp" value="<?php echo $_REQUEST['c']?>" /><input type="hidden" name="overty" value="<?php echo $_REQUEST['f']?>" /><input type="hidden" name="oups" value="<?php echo $_REQUEST['g']?>" /><input type="hidden" name="sreciptyp" value="vernew" />