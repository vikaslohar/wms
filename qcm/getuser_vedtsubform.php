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
	}require_once("../include/config.php");
	require_once("../include/connection.php");


if(isset($_GET['a']))
	{
   $a = $_GET['a'];	 
	}
	
		
$sql_tbl_sub=mysqli_query($link,"select * from tbl_qcgen1 where arrsub_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
 //$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
   $tid=$row_tbl_sub['arrival_id'];
  // $row_tbl_sub['stage'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_qcgen where arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
// $arrival_id=$row_tbl['arrival_id'];
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<!--<tr class="Light" height="30">
<td width="143" align="right" valign="middle" class="tblheading">Seed Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtstage" style="width:150px;">
    <option value="" selected>--Select--</option>
	   <option <?php //if($row_tbl_sub['stage']=="Raw"){ echo "Selected";} ?> value="Raw" > Raw</option>
    <option  <?php //if($row_tbl_sub['stage']=="Condition"){ echo "Selected";} ?> value="Condition" > Condition</option>
      <option <?php //if($row_tbl_sub['stage']=="Pack"){ echo "Selected";} ?> value="Pack"  >Pack  </option>  
    </select>&nbsp;<font color="#FF0000">*</font></td>

</tr>-->
	<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />

	 <?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];


 $quer3=mysqli_query($link,"SELECT cropid,cropname from tblcrop  order by cropname Asc"); 	

?>	
	
<tr class="Light" height="30">

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:150px;"  onchange="modetchk(this.value)">
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['cropid']==$row_tbl_sub['crop']){ echo "Selected";} ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	  <?php
	  //echo $row_tbl_sub['crop'];
$sql_qc=mysqli_query($link,"SELECT distinct(variety) FROM tbl_qcgen1 WHERE crop='".$row_tbl_sub['crop']."' and variety NOT RLIKE '^[-+0-9.E]+$'") or die(mysqli_error($link)); 
$tt=mysqli_num_rows($sql_qc);

$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$row_tbl_sub['crop']."' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" >
	<option value="" selected>--Select Variety--</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia_item['varietyid']==$row_tbl_sub['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item['varietyid'];?>" />
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
	<?php while($noticia_item1 = mysqli_fetch_array($sql_qc)) { ?>
		<option <?php if($noticia_item1['variety']==$row_tbl_sub['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item1['variety'];?>" />
		<?php echo $noticia_item1['variety'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

  </tr>			<?php $tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";} else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						?>
<tr class="Light" height="30">
<td width="143" align="right"  valign="middle" class="tblheading"> Lot No.&nbsp;</td>
<td width="214" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex="" maxlength="20" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  value="<?php echo $row_tbl_sub['lotno'];?>"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="qcrsl" value="<?php echo $row_tbl_sub['qcr'];?>" /><input type="hidden" name="gotrsl" value="<?php echo $row_tbl_sub['gotr'];?>" /></td>
 <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" <?php if($row_tbl_sub['pp']=="P"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0"  value="P" onclick="clk(this.value);"/>PP   
   &nbsp;<input type="hidden" name="chk1" value="<?php echo $row_tbl_sub['pp'];?>" />
  <input name="txt12" <?php if($row_tbl_sub['moist']=="M"){ echo "checked";}  ?>   type="checkbox" class="tbltext" tabindex="0"  value="M"onclick="clk(this.value);" /> <input type="hidden" name="chk2" value="<?php echo $row_tbl_sub['moist'];?>" /> 
    Moisture % 
    &nbsp;<input name="txt14" <?php if($row_tbl_sub['gemp']=="G"){ echo "checked";}  ?> <?php if($row_tbl_sub['qcr']!="OK"){ echo "disabled";}  ?> type="checkbox" class="tbltext" tabindex="0"  value="G" onclick="clk(this.value);"/><input type="hidden" name="chk3" value="<?php echo $row_tbl_sub['gemp'];?>" />
    Gem % 
    &nbsp;<input name="txt16" <?php if($row_tbl_sub['got']=="T"){ echo "checked";}  ?> <?php if($row_tbl_sub['gotr']!="OK"){ echo "disabled";}  ?> type="checkbox" class="tbltext" tabindex="0"  value="T" onclick="clk(this.value);"/><input type="hidden" name="chk4" value="<?php echo $row_tbl_sub['got'];?>" />
GoT <font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
<div id="lotdetails">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Select Stage</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">Select</td>
  <td align="center" class="tblheading">Stage</td>
  <td align="center" class="tblheading">NoB</td>
  <td align="center" class="tblheading">Qty</td>
  <td align="center" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1; $cntt=0;
$sql_tbl_sub1=mysqli_query($link,"select distinct(lotldg_sstage) from tbl_lot_ldg where orlot='".$row_tbl_sub['lotno']."'")or die(mysqli_error($link));
$ct1=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
{
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; 
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE orlot='".$row_tbl_sub['lotno']."' and lotldg_sstage='".$row_tbl_sub1['lotldg_sstage']."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$row_tbl_sub['lotno']."' and lotldg_sstage='".$row_tbl_sub1['lotldg_sstage']."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_month['lotldg_balbags'];
 $slqty=$row_month['lotldg_balqty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$nob=$nob+$slups;
$qty=$qty+$slqty;
}
}
}

$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
if($nob > 0)
{
$cntt++;
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
  <td align="center" class="tblheading"><input type="checkbox" name="optsel" value="<?php echo $row_tbl_sub1['lotldg_sstage'];?>" <?php $p_array=explode(",", $row_tbl_sub['stage']); foreach($p_array as $val){ if($val<>""){ if($val == $row_tbl_sub1['lotldg_sstage']) echo "checked";}}?> onclick="optsl(this.value);" /></td>
  <td align="center" class="tblheading"><?php echo $row_tbl_sub1['lotldg_sstage'];?></td>
  <td align="center" class="tblheading"><?php echo $ac;?></td>
  <td align="center" class="tblheading"><?php echo $acn;?></td>
  <td align="center" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
  <td align="center" class="tblheading"><input type="checkbox" name="optsel" value="<?php echo $row_tbl_sub1['lotldg_sstage'];?>" <?php $p_array=explode(",", $row_tbl_sub['stage']); foreach($p_array as $val){ if($val<>""){ if($val == $row_tbl_sub1['lotldg_sstage']) echo "checked";}}?> onclick="optsl(this.value);" /></td>
  <td align="center" class="tblheading"><?php echo $row_tbl_sub1['lotldg_sstage'];?></td>
  <td align="center" class="tblheading"><?php echo $ac;?></td>
  <td align="center" class="tblheading"><?php echo $acn;?></td>
  <td align="center" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
if($cntt==0)
{
?>
<tr class="light" height="20">
  <td colspan="5" align="left" class="tblheading">&nbsp;Lot number not found reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="5" align="left" class="tblheading">&nbsp;1. Lot number Dispatched/Released completely.</td>
</tr>
<?php
}
?>
<input type="hidden" name="txtstage" value="" /><input type="hidden" name="srno" value="<?php echo $srno;?>" /><input type="hidden" name="cntt" value="<?php echo $cntt?>" />
</table>
</div>

<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />




<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>