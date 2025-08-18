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

	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW - Transaction-Drying Slip</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
<script language='javascript'>

	
			</script>
</head>
<body topmargin="0" >
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <?php
 $tid=$itmid;

$sql_tbl=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['proslipmain_id'];

$tdate=$row_tbl['proslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;?>
	

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Processing Slip Preview</td>
</tr>
 <tr class="Dark" height="30">
<td width="134" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID&nbsp;</td>
<td width="144"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['proslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="95" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="182" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>

<td width="137" align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['proslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['proslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="133" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="145" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['proslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="95" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="182" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="137" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['proslipmain_stage'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where promac_id='".$row_tbl['proslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row_tbl['proslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['proslipmain_treattype']?>" /></td>
	</tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="100" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
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
    <td width="107" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="54" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
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
	    <td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="30" align="center" valign="middle" class="smalltblheading">%</td>
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
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_proslipsubsub2 where proslipsub_id='".$row_tbl_sub['proslipsub_id']."' and proslipmain_id='".$arrival_id."' and plantcode='$plantcode' order by proslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['proslipsubsub_bin']."' and whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['proslipsubsub_subbin']."' and binid='".$row_tbl_subsub['proslipsubsub_bin']."' and whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['proslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['proslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['proslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlper'];?></td>
	<td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['proslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['proslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['proslipsub_remarks'];?>">Details</a><?php } ?></td>
        </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlper'];?></td>
	<td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['proslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['proslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['proslipsub_remarks'];?>">Details</a><?php } ?></td>
        </tr>
  <?php
}
$srno++;
}
}
?>
</table><br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
