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

	if(isset($_REQUEST['b']))
	{
	$trid = $_REQUEST['b'];
	}
	if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	if(isset($_GET['c']))
	{
	$typ = $_GET['c'];	 
	}
		
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$trid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;
$subtid=0;
$subsubtid=0;

	$tdate24=$row_tbl['salesr_date'];
	$tyear=substr($tdate24,0,4);
	$tmonth=substr($tdate24,5,2);
	$tday=substr($tdate24,8,2);
	$dogtdate=$tday."-".$tmonth."-".$tyear;


$sql_srnsr=mysqli_query($link,"select MAX(srnsr_tcode) from tbl_salesrv_nsr where plantcode='$plantcode' AND srnsr_yearcode='$yearid_id' order by srnsr_tcode desc") or die(mysqli_error($link));
$tot_srnsr=mysqli_num_rows($sql_srnsr);
$row_srnsr=mysqli_fetch_array($sql_srnsr);
if($tot_srnsr>0)
{
	if($row_srnsr[0]=="" || $row_srnsr[0]==0)
	{$nlt=90001;}
	else {$nlt=$row_srnsr[0]+1;}
}
else
{
	$nlt=90001;
}
$ltnn2=sprintf("%00005d",($nlt));


if($typ=="verrec")
{
$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['salesr_id'];
$subtid=$a;


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
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

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<input type="hidden" name="tpys" value="add" />
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
?>
<tr class="tblsubtitle" height="20">
	<td width="24" align="center" valign="middle" class="tblheading">#</td>
	<td width="171" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="283" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="142" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="173" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="163" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
</tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="right" class="tblheading" width="50%">Sales Return Item as per DC &amp; in matching UPS, found during verification&nbsp;</td>
  <td align="left" class="tblheading">&nbsp;<input type="radio" name="sritmrec" id="sritmrec" value="Yes" onclick="sritrecchk(this.value);" />Yes&nbsp;&nbsp;<input type="radio" name="sritmrec" id="sritmrec" value="No" onclick="sritrecchk(this.value);" />No</td>
</tr>
</table>
<div id="postverrec" style="display:none">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>			
</tr>
<input type="hidden" name="itmdchk" value="" />
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
$row_month=mysqli_fetch_array($quer6);
$a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="258" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="pcodeo" id="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onchange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $ltnn;?>" onchange="stchk();" readonly="true" style="background-color:#ECECEC" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />&nbsp;<font color="#FF0000">*</font>&nbsp;<span id="lotnewsr" class="smalltbltext" style="color:#FF0000"></span><div id="lotchko"><input type="hidden" name="lotchecko" value="0" /><input type="hidden" name="lotupschko" value="" /></div></td>	
</tr>
	
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Date of Validity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="dovdate" id="dovdate" type="text" size="10" class="tbltext" tabindex="" maxlength="10" readonly="true" style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dovdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >Select Return Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select class="tbltext" name="txtsrtyp" style="width:80px;" onchange="srtchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="P2C" >P2C</option>
	<option value="P2P" >P2P</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">SR Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="rettype" type="text" size="20" class="tbltext" tabindex=""  readonly="true" style="background-color:#CCCCCC" value="Sales Return - "   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">As per DC</td>
</tr>
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
<td align="right"  valign="middle" class="tblheading">Total NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopd" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $row_tbl_sub['salesrs_nob'];?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Total Qty&nbsp;</td>
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
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgstat" size="10" value="GOT-NR" readonly="true" style="background-color:#CCCCCC"  /></td>
 <td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="tbltext" name="qcsreq" size="5" style="background-color:#CCCCCC" readonly="true" value="OK"  /><input type="hidden" name="qcrequest" value="GOT-NR OK" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="<?php echo $dogtdate;?>" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<input type="hidden" name="tpys" value="add" />
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Light" height="30">
<?php 
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
    <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked" />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)" />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>		
</tr>
<input type="hidden" name="itmdchk" value="" />
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="258" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="pcodeo" id="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onchange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $ltnn;?>" onchange="stchk();" readonly="true" style="background-color:#ECECEC" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />&nbsp;<font color="#FF0000">*</font>&nbsp;<span id="lotnewsr" class="smalltbltext" style="color:#FF0000; padding:0,0,0,0;"></span><div id="lotchko"><input type="hidden" name="lotchecko" value="0" /><input type="hidden" name="lotupschko" value="" /></div></td>	
</tr>
<!--<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">As per DC</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="208" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopd" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="60" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="165" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>-->
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Date of Validity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="dovdate" id="dovdate" type="text" size="10" class="tbltext" tabindex="" maxlength="10" readonly="true" style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dovdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >Select Return Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="txtsrtyp" style="width:80px;" onchange="srtchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="P2C" >P2C</option>
	<option value="P2P" >P2P</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">SR Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="rettype" type="text" size="20" class="tbltext" tabindex=""  readonly="true" style="background-color:#CCCCCC" value="Sales Return - "   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="upschd">&nbsp;<select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Total NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopd" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="" onkeypress="return isNumberKey(event)" onchange="upschks(this.value)"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Total Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="tnopchks(this.value)"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value,'add');"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="0" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" onchange="upchk2(this.value,'add');"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc3" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="nopschk(this.value,'add');" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="125" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc2" type="text" size="10" class="tbltext" tabindex="" maxlength="7" value="0" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" onchange="nopschk2(this.value,'add');" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc3" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgstat" size="10" value="GOT-NR" readonly="true" style="background-color:#CCCCCC"  /></td>
 <td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="tbltext" name="qcsreq" size="5" style="background-color:#CCCCCC" readonly="true" value="OK"  /><input type="hidden" name="qcrequest" value="GOT-NR OK" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="<?php echo $dogtdate;?>" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>
<?php
}
?>
<div id="subsubdivgood" style="display:block"></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp;?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1;?>" /><input type="hidden" name="wtmp" id="wtmp" value="<?php echo $wtmp;?>" /><input type="hidden" name="wtnop" id="wtnop" value="<?php echo $mptnop;?>" /><input type="hidden" name="ltnn" id="ltnn" value="<?php echo $ltnn;?>" /><input type="hidden" name="ltnn2" id="ltnn2" value="<?php echo $ltnn2;?>" /><input type="hidden" name="ltncode" value="<?php echo $nlt;?>" /><input type="hidden" name="ltnflg" value="0" /><input type="hidden" name="sritmrecsts" value="" /><input type="hidden" name="srptcvtype" value="<?php echo $typ;?>" />