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

if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}


$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrsub_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['arrival_id'];
$subtid=$a;
// $row_tbl_sub['party_id'];
$sql_tbl=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$tid."'") or die(mysqli_error($link));
$srno=1; $itmdchk="";
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
if($itmdchk!="")
{
$itmdchk=$itmdchk.$row_tbl['nolot'].",";
}
else
{
$itmdchk=$row_tbl['nolot'].",";
}

}
}
else
{
$itmdchk="";
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />

<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						?>
<tr class="Light" height="30">
<!--<td align="right"  valign="middle" class="tblheading"> Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtold" type="text" size="20" class="tbltext" tabindex="" maxlength="20" onkeypress="return isNumberKey(event)" onchange="qtychk(this.value);"   style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotno'];?>"  >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->
 <?php 
$quer3=mysqli_query($link,"SELECT cropid,cropname from tblcrop  order by cropname Asc"); 	
?>
<td width="228" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="279"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotcrop'];?>" maxlength="10"/>&nbsp;</td>
<td width="175" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotvariety'];?>" maxlength="10"/>&nbsp;</td>
</tr>
 <!--<tr class="Light" height="25">
           <td align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;As Per DC</td>

<td align="left"  valign="right" class="tblheading" colspan="3">&nbsp;As Per Actual</td>
</tr>-->
<tr class="Dark" height="30">
  
			  <td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
              <td width="243" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtdcnob" type="text" size="4" class="tbltext" tabindex=""    maxlength="4" onchange="bagschk1();" onkeypress="return isNumberKey1(event)"  value="<?php echo $row_tbl_sub['qty1'];?>" style="background-color:#CCCCCC"/>
    &nbsp;</td>
    
    <td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcqty" type="text" size="9" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk1();" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_sub['qty'];?>" /> Kgs.&nbsp;<font color="#FF0000">*</font></td>
  </tr>
  <?php if($b=="Fresh Seed Arrival with PDN")
  { ?>
   <tr class="Light" height="30">
    	<td width="191" align="right"  valign="middle" class="tblheading" >Location&nbsp;</td>
    <td width="251"  align="left"  valign="middle" class="tbltext"colspan="5">&nbsp;<input name="txtloc" type="text" size="10" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['ploc'];?>" /></td>
<?php
}
else if($b=="Trading Arrival")
{
 $quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Trading Vendor'"); 
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading"> Vendor Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<select class="tbltext" name="txtparty" style="width:230px;" >
<option value="" selected="selected">--Select Vendor--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl_sub['party_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
	<?php
	}
	elseif($b=="Stock Transfer-Plant")
	{
	?>
	<?php 
	$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer-Plant'"); 
	
?>
 <tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:230px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected="selected">--Select Vendor--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl_sub['party_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
	<?php
	}?>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality (QC) </td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"  value="<?php echo $row_tbl_sub['moisture'];?>" //> 
%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:120px;" onchange="visuchk()">
<option value="" selected>--Select--</option>
   <option <?php if($row_tbl_sub['vchk']=="Acceptable"){ echo "Selected";} ?> value="Acceptable">Acceptable</option>
	<option <?php if($row_tbl_sub['vchk']=="Not-Acceptable"){ echo "Selected";} ?>   value="Not-Acceptable" >Not- Acceptable</option>

     
  </select>  <font color="#FF0000">*</font>	</td>
</tr>

<tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">QC Status &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qc" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['qc'];?>"maxlength="10"/>
    </td>
	<td width="195" align="right"  valign="middle" class="tblheading">Seed Status&nbsp;</td>
<td width="230" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a>	</td>
  </tr>
  <tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">GS Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="gs1"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 </tr>
</table>

<div id="transs" style="display:<?php if($row_tbl_sub['vchk'] == "Not-Acceptable"){ echo "block";}else{ echo "none";} ?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="226" align="right" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="718" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl_sub['remarks'];?>" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
 <table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Grow Out Test (GOT )</td>
</tr>
<tr class="Dark" height="25">
    <td width="228" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="273"  align="left" valign="middle" class="tbltext"  >&nbsp;<select class="tbltext" name="txtstage" style="width:120px;" onChange="sschk(this.value)">
<option value="" selected>--Select--</option>
   <option <?php if($row_tbl_sub['sstage']=="Raw"){ echo "Selected";} ?> value="Raw">Raw</option>
    <!--<option <?php if($row_tbl_sub['sstage']=="Condition"){ echo "Selected";} ?> value="Condition">Condition</option>
     <option <?php if($row_tbl_sub['sstage']=="Pack"){ echo "Selected";} ?> value="Pack">Pack</option>  -->
    </select>&nbsp;<font color="#FF0000">*</font>	</td>
<td width="186" align="right"  valign="middle" class="tblheading">GOT Type &nbsp;</td>
<td width="253" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgot" type="text" size="10" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['got'];?>" />
   
  </select>  <font color="#FF0000">*</font>	</td>
  </tr>
<!-- <td align="right"  valign="middle" class="tblheading">Generate Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="4">&nbsp;<input name="qc1"  type="checkbox" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $qctyp?>" maxlength="10" /></td>

<tr class="Dark" height="25">
 
  
</tr>-->
<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$tp1=$row_cls['code'];
		
	/*$tp1="";
		if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
		else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}*/
?>
<?php
$cod="";
			if($f=="Raw"){$cod="R";}else if($f=="Condition "){$cod="C";}else{$cod="";}
			?>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" > Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtold" type="text" size="20" class="tblheading" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotno'];?>" maxlength="20"/><input type="hidden" name="gln" value="<?php echo $tp1?><?php echo $row_tbl_sub['old'];?>/00000/00" /><input type="hidden" name="gln1" value="<?php echo $tp1?><?php echo $row_tbl_sub['old'];?>/00000/00" /><input type="hidden" name="txtold1" value="<?php echo $row_tbl_sub['old'];?>" /></td>
<td width="186" align="right"  valign="middle" class="tblheading">GOT Status&nbsp;</td>
<td width="253" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgot1" type="text" size="10" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['got1'];?>" />
   
  </select>  <font color="#FF0000">*</font>	</td>
</tr>
</table>




<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="7" align="center" class="tblheading">Storage Location (SLOC) </td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC </td>
    <td width="339" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
    <td width="293" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">SuB Bin</td>
  </tr>
  <?php

//$c=$row_tbl_sub['classification_id'];
//$f=$row_tbl_sub['item_id'];
//$ba=0;
//$up=0;
$sql_sub_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_id='".$a."' order by arrsloc_id") or die(mysqli_error($link));
$tot_sub_sloc=mysqli_num_rows($sql_sub_sloc);
/*$sql_sub_sloc1=mysqli_query($link,"select whid,binid,subbin from tblarr_sloc where arr_id='".$rid."' and qty_good=0 and ups_good=0") or die(mysqli_error($link));
echo $tot_sub_sloc1=mysqli_num_rows($sql_sub_sloc1);*/
$srno=1;
while($row_sub_sloc=mysqli_fetch_array($sql_sub_sloc))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sub_sloc['binid']."' and whid='".$row_sub_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."' and binid='".$row_sub_sloc['binid']."' and whid='".$row_sub_sloc['whid']."'") or die(mysqli_error($link));
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
$s_good_new=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_subbinid='".$row_sub_sloc['subbin']."'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issueg_new['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new['lotldg_binid']."' and lotldg_whid='".$row_issueg_new['lotldg_whid']."'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1_new[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno_new=mysqli_num_rows($sql_issuetblg_new);
	
	if($totno_new > 0)
	{
		$row_issuetblg_new=mysqli_fetch_array($sql_issuetblg_new);
		if($row_issuetblg_new['lotldg_varietyid']=="Fresh Seed with PDN")
		{
		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
		$existview=$row_issuetblg_new['lotldg_crop'].", ".$row_issuetblg_new['lotldg_variety'].", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		
		}
		else
		{
		$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new=mysqli_fetch_array($sql_crop_new);
		
		$varchk=$row_crop_new['cropname']."-"."Coded";
		$varchk2=$row_crop_new['cropname']."-"."Unidentified";
		$varty="";
		if($row_issuetblg_new['lotldg_variety']!=$varchk && $row_issuetblg_new['lotldg_variety']!=$varchk2)
		{		
			$sql_variety_new=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
			$row_variety_new=mysqli_fetch_array($sql_variety_new);
			$varty=$row_variety_new['popularname'];
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
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$row_sub_sloc['whid']."'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where whid='".$row_sub_sloc['whid']."' and binid='".$row_sub_sloc['binid']."'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
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
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
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
 }
 ?>
  
      </table>
    </div></td>
  
</table>
<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>