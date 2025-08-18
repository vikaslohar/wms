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
	//$logid="OP1";
	require_once("../include/config.php");
	require_once("../include/connection.php");

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields
//$yearid_id="09-10";
if(isset($_GET['a']))
	{
	 $a = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
    $b = $_GET['b'];	 
	}
	/*if(isset($_GET['c']))
	{
	echo $c = $_GET['c'];	 
	}*/
	
$s_sub="delete from tblarrival_sub where arrsub_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$s_sub_sub="delete from tblarr_sloc where arr_id='".$b."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
?><?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$a."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row_tbl['arrival_id'];


if($tot_sub > 0)
$tid=$a;
else
$tid=0;

$arrival_id=$tid;

$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Trading' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<?php
if($tot > 0)
{
$row_tbl=mysqli_fetch_array($sql_tbl);
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
  $arrival_id=$row_tbl['arrival_id'];

?>
  <tr class="Light" height="30">
 <?php   

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='".$row_tbl['lotcrop']."' order by cropname Asc"); 
$row31=mysqli_fetch_array($quer3);
?>
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="294" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtcrop1" style="background-color:#CCCCCC"  onchange="modetchk(this.value)" value="<?php echo $row_tbl['lotcrop'];?>"  size="30" readonly="true" type="text">
&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtcrop" value="<?php echo $row31['cropid'];?>" /></td>
	   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='".$row_tbl['lotvariety']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
$noticia = mysqli_fetch_array($quer4);
?>
	<td width="133" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td width="285" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtvariety1" style="background-color:#CCCCCC" id="itm" value="<?php echo $row_tbl['lotvariety'];?>" size="30" readonly="true" type="text">
    <font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtvariety" value="<?php echo $noticia['varietyid'];?>" /></td>
  </tr>
          
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Vendor  Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvv" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"   value="<?php echo $row_tbl['vvariety'];?>" >&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">No. of Lots&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtlot2" class="tbltext"  style="width:100px;" tabindex="" onChange="sstschk()" >
<option value="" selected>--Select--</option>
          <option value="1" <?php if($row_tbl['nolot']==1) { echo "Selected";}?>>1</option>
          <option value="2" <?php if($row_tbl['nolot']==2) { echo "Selected";}?>>2</option>
          <option value="3" <?php if($row_tbl['nolot']==3) { echo "Selected";}?>>3</option>
          <option value="4" <?php if($row_tbl['nolot']==4) { echo "Selected";}?>>4</option>
          <option value="5" <?php if($row_tbl['nolot']==5) { echo "Selected";}?>>5</option>
          <option value="6" <?php if($row_tbl['nolot']==6) { echo "Selected";}?>>6</option>
          <option value="7" <?php if($row_tbl['nolot']==7) { echo "Selected";}?>>7</option>
          <option value="8" <?php if($row_tbl['nolot']==8) { echo "Selected";}?>>8</option>
          <option value="9" <?php if($row_tbl['nolot']==9) { echo "Selected";}?>>9</option>
          <option value="10" <?php if($row_tbl['nolot']==10) { echo "Selected";}?>>10</option>
          </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="228" align="right" valign="middle" class="tblheading">Seed Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<input  name="txtstage1" style="background-color:#CCCCCC" onChange="sschk1()" value="<?php echo $row_tbl['sstage'];?>" readonly="true" type="text" >
   &nbsp;<font color="#FF0000">*</font>	<input type="hidden" name="txtstage" value="<?php echo $row_tbl['sstage'];?>"/></td>


</tr></table>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 

  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="303" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
    <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="153" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="253" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
          
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Vendor  Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvv" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"  onChange="sstschk1()" >&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">No. of Lots&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtlot2" class="tbltext"  style="width:100px;" tabindex="" onChange="sstschk()" >
          <option value="">---Select ----</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="231" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtstage" style="width:170px;" onChange="sschk1()">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <!-- <option value="Condition" >Condition</option>
	<option value="Pack" >Pack</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<!--<td width="131" align="right" valign="middle" class="tblheading">Seed Status&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="sstatus" class="tbltext" readonly="readonly" style="background-color:#EAEAEA">&nbsp;<a href="Javascript:void(0);" onclick="select1();">Select</a><input type="hidden" name="destid" value="" /></td>-->
</tr></table>
<?php
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">

  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Trading' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">V. Lot No.</td>
	<td width="7%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td height="33" colspan="2" align="center" valign="middle" class="tblheading">AS Per DC </td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>

	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>

		  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type </td>
		 	
		   <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="6%" align="center" valign="middle" class="tblheading">Moist %</td>
      <td width="9%" align="center" valign="middle" class="tblheading">PP</td>
  </tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
	/*if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl['nolot'].",";
	}
	else
	{
		$itmdchk=$row_tbl['nolot'].",";
	}


$lotqry=mysqli_query($link,"select * from tbllotimp where lotnumber='".$a."'");
$row= mysqli_fetch_array($lotqry)or die (mysqli_error($link));

  $lot=$row['lotcrop'];	
 $variety=$row['lotvariety'];
  $oldlot=$row['lotoldlot'];		


$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
*/if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>	
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>
	  <?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>	
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
	<?php $aq1=explode(".",$row_tbl_sub['diff']); if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$row_tbl_sub['diff'];} ?>
    <td align="center" valign="middle" class="tblheading"><?php echo $as1;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Trading');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>	
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>
	  <?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>	
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
	<?php $aq1=explode(".",$row_tbl_sub['diff']); if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$row_tbl_sub['diff'];} ?>
    <td align="center" valign="middle" class="tblheading"><?php echo $as1;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Trading');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;Lot <span class="tblheading" style="border-color:#F1B01E">Number</span>&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E">&nbsp;<input name="txtlot1" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $mode;?>" onchange="ltchk(this.value);"  />
</span>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a>(After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
		  <br />
<div id="postingsubtable" style="display:block">
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</div>
