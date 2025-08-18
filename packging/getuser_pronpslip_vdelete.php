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
	
$s_sub="delete from tbl_pnpslipsub where pnpslipsub_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));

$s_sub1="delete from tbl_pnpslipsubsub where pnpslipsub_id='".$b."'";
mysqli_query($link,$s_sub1) or die(mysqli_error($link));

$s_sub2="delete from tbl_pnpslipsubsub2 where pnpslipsub_id='".$b."'";
mysqli_query($link,$s_sub2) or die(mysqli_error($link));

$s_sub3="delete from tbl_pnpslipsubsub3 where pnpslipsub_id='".$b."'";
mysqli_query($link,$s_sub2) or die(mysqli_error($link));

$s_sub_sub4="delete from tbl_pnpslipbarcode where pnpslipsub_id='".$b."'";
mysqli_query($link,$s_sub_sub4) or die(mysqli_error($link));
	
$sql_t_sub=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);

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

$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

	$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['pnpslipmain_dop'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
$subtid=0;
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Online Processing and Packing Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Processing &amp; Packing&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="157" align="right"  valign="middle" class="smalltblheading">Packing Slip Ref. No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="152" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="166" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="107" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" />   &nbsp;</td>
	
  </tr>
  <?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' and promac_id='".$row_tbl['pnpslipmain_promachcode']."' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_id='".$row_tbl['pnpslipmain_proopr']."'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 		   
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtpromech" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtoprname" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="vtblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txttreattyp" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
  </tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="101" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <!--<td width="10%" align="center" valign="middle" class="smalltblheading" colspan="2">Raw Seed </td>-->
	 <td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="60" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	 <td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
     <td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>

	 	 <td align="center" valign="middle" class="smalltblheading"  rowspan="2">IM </td>
<td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
		  <!--/*<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">QC Status </td>	 
		   <td width="12%" rowspan="3" align="center" valign="middle" class="smalltblheading">GOT Type </td>*/-->
    <td width="108" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">CSW SLOC</td>
	<td width="108" colspan="3" align="center" valign="middle" class="smalltblheading">Pack Details</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    <td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
    <td width="39" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
  </tr>
   <tr class="tblsubtitle">
    
     <!--<td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="smalltblheading">%</td>-->
     <td width="45" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="4%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="2%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>-->
	    <td width="51" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="30" align="center" valign="middle" class="smalltblheading">%</td>
      <td width="54" align="center" valign="middle" class="smalltblheading">NoMP</td>
      <td width="54" align="center" valign="middle" class="smalltblheading">Barcodes</td>
      <td width="108" align="center" valign="middle" class="smalltblheading">Details</td>
  </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['pnpslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['pnpslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['pnpslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/
$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlper'];?></td>
	<td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nomp'];?><input type="hidden" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['pnpslipsub_nomp'];?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openbarcodedetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)"><?php echo $tot_barcnomp;?></a><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="30" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlper'];?></td>
	<td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nomp'];?><input type="hidden" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['pnpslipsub_nomp'];?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openbarcodedetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)"><?php echo $tot_barcnomp;?></a><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="30" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block"><input name="protype" value="" type="hidden"></div> </div>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Online Processing and Packing Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <tr class="Light" height="30">
<td width="90" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="88"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="35" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="90" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
<td width="169" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Processgin &amp; Packing&nbsp;</td>
<td width="95" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="138" align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td width="127" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>


<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 

  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="145" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>

	<td width="95" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="182" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		<td width="137" align="right" valign="middle" class="smalltblheading">Seed Stage&nbsp;</td>
<td width="144"  align="left" valign="middle" class="smalltbltext"  >&nbsp;<select class="smalltbltext" name="txtstage" style="width:80px;" onChange="sschk1()">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <option value="Condition" >Condition</option>
	 <!--<option value="Pack" >Pack</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
  </tr>
<?php
$sql_sel12="select * from tbl_rm_promac order by promac_type,promac_macid";
$res12=mysqli_query($link,$sql_sel12) or die (mysqli_error($link));
$total12=mysqli_num_rows($res12);
?> 		   
<tr class="Light" height="30">
<td width="133" align="right" valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
<td  align="left" valign="middle" class="smalltbltext"  >&nbsp;<select class="smalltbltext" name="txtpromech" style="width:120px;" onChange="sschk2()">
    <option value="" selected>--Select--</option>
    <?php while($noticia_item12 = mysqli_fetch_array($res1)) { $num2=$noticia_item12['promac_mac'].$noticia_item12['promac_macid'];?>
		<option value="<?php echo $noticia_item12['promac_id'];?>" />   
		<?php echo $num2;?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
<?php
$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' order by proopr_name") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
?>
<td width="95" align="right" valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
<td width="182" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtoprname" style="width:150px;" onChange="sschk3()">
    <option value="" selected>--Select--</option>
   <?php while($row_popr = mysqli_fetch_array($query_popr)) { ?>
		<option value="<?php echo $row_popr['proopr_id'];?>" />   
		<?php echo $row_popr['proopr_fname'];?> <?php echo $row_popr['proopr_lname']?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
<?php
$sql_sel="select * from tbl_rm_treattype order by treatt_type";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$total=mysqli_num_rows($res);
?>  
<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<select class="smalltbltext" name="txttreattyp" style="width:120px;" onChange="sschk4()">
    <option value="none" selected>None</option>
 <?php while($noticia_item = mysqli_fetch_array($res)) { ?>
		<option value="<?php echo $noticia_item['treatt_type'];?>" />   
		<?php echo $noticia_item['treatt_type'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" colspan="5">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="15" onchange="vendorchk1();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>-->
</table>


<br />
  

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="15" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="86" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <!--<td width="10%" align="center" valign="middle" class="smalltblheading" colspan="2">Raw Seed </td>-->
	 <td width="42" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	 <td width="32" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
     <td width="45"  rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>

	 	 <td width="23"  rowspan="2" align="center" valign="middle" class="smalltblheading">IM </td>
<td width="44"  rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
		  <!--/*<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">QC Status </td>	 
		   <td width="12%" rowspan="3" align="center" valign="middle" class="smalltblheading">GOT Type </td>*/-->
    <td width="95" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">CSW SLOC</td>
	<td colspan="3" align="center" valign="middle" class="smalltblheading">Pack Details</td>
	<td width="54" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    <td width="24" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
    <td width="52" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
  </tr>
   <tr class="tblsubtitle">
    
     <!--<td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="smalltblheading">%</td>-->
     <td width="43" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="4%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="2%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>-->
	    <td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="26" align="center" valign="middle" class="smalltblheading">%</td>
      <td width="51" align="center" valign="middle" class="smalltblheading">NoMP</td>
      <td width="62" align="center" valign="middle" class="smalltblheading">Barcodes</td>
      <td width="83" align="center" valign="middle" class="smalltblheading">Details</td>
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