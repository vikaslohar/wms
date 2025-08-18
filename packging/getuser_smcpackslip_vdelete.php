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
	
	$s_sub="delete from tbl_packagingsub_sub where packagingsubsub_id='".$b."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$s_sub1="delete from tbl_packagingsub_sub2 where packagingsubsub_id='".$b."'";
	mysqli_query($link,$s_sub1) or die(mysqli_error($link));
	
	$s_sub2="select * from tbl_packagingsub_sub where packaging_id='".$a."'";
	mysqli_query($link,$s_sub2) or die(mysqli_error($link));
	if($t=mysqli_num_rows($s_sub2) == 0)
	{
		$s_sub3="delete from tbl_packaging where packaging_id='".$a."'";
		mysqli_query($link,$s_sub2) or die(mysqli_error($link));
		$s_sub3="delete from tbl_packaging_sub where packaging_id='".$a."'";
		mysqli_query($link,$s_sub2) or die(mysqli_error($link));
	}
	$sql_t_sub=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$a."'") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_t_sub);
	
?>
<?php
if($tot_sub > 0)
{
 	$tid=$a;
}
else
{
	$tid=0;
}

if($tid > 0) 
{
	$sql_tbl=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	
	$tot=mysqli_num_rows($sql_tbl);		
	$arrival_id=$row_tbl['packaging_id'];

	$tdate=$row_tbl['packaging_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['packaging_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$sql_tblsub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
$subtid=0;
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Packaging Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="25%"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>

<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['packaging_slipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tblsub['packagingsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="25%" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tblsub['packagingsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="25%" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
</tr>	
<input type="hidden" name="txtstage" value="Pack" />
</table>
<br />

<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="1%" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" rowspan="2" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="9%" rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="11%" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of MP</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td align="center" valign="middle" class="smalltblheading">PSW SLOC</td>
	<td width="8%" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
	<td width="3%" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>
<tr class="tblsubtitle">
	<td width="262" align="center" valign="middle" class="smalltblheading">SLOC | MP | Loose Pchs | Total Pchs | Total Qty</td>
</tr>  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$lotno=""; $exqty=""; $expch=""; $upss=""; $nomps=""; $nopchs=""; $blpch=""; $nobarc="";
$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{
$lotno=$row_tbl_subsub2['packagingsubsub_lotno']; 
$exqty=$row_tbl_subsub2['packagingsubsub_extqty']; 
$expch=$row_tbl_subsub2['packagingsubsub_extnop']; 
$upss=$row_tbl_subsub2['packagingsubsub_upssize']; 
$nomps=$row_tbl_subsub2['packagingsubsub_nomp']; 
$remarks=$row_tbl_subsub2['packagingsub_remarks']; 
$blpch=$row_tbl_subsub2['packagingsubsub_balpch']; 
$nobarc=$row_tbl_subsub2['packagingsubsub_barcodes']; 

$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_lotno='$lotno' and packagingsubsub_upssize='$upss' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['packagingsubsub_subbin']."' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nomp=$row_tbl_subsub['packagingsubsub_nomp']; 
$nop=$row_tbl_subsub['packagingsubsub_nopch']; 
$totp=$row_tbl_subsub['packagingsubsub_totpch']; 

$diq=explode(".",$row_tbl_subsub['packagingsubsub_totqty']);
if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_tbl_subsub['packagingsubsub_totqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
}	

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
</tr>
  <?php
}
$srno++;
}
}
}
?>
</table><br />

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"></div></div>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Packaging Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="25%"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1?></td>

<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction Date&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="datesel('dopc')" tabindex="6"><img src="../images/cal.gif" border="0" align="absmiddle" /></a>&nbsp;<font color="#FF0000">*</font></td>
<td width="25%" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>

	<td align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
<input type="hidden" name="txtstage" value="Pack" />
</table>


<br />
  

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="1%" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" rowspan="2" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="9%" rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="11%" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of MP</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td align="center" valign="middle" class="smalltblheading">PSW SLOC</td>
	<td width="8%" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
	<td width="3%" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>
<tr class="tblsubtitle">
	<td width="262" align="center" valign="middle" class="smalltblheading">SLOC | MP | Loose Pchs | Total Pchs | Total Qty</td>
</tr>
<?php
	$total_tbl=0;
?>
<input type="hidden" name="itmdchk" value="<?php echo $total_tbl;?>" /> 
</table>
		  <br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"> </div>
</div></div>
<?php
}
?>