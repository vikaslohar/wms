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

//frm_action=submit&txtid=1&date=05-12-2018&dopc=05-12-2018&txtpsrn=Test&txtcrop=51&txtvariety=559&txtstage=Raw&txtpromech=15&txtoprname=13&txttreattyp=none&itmdchk=0&txtlot1=DV07746%2F00000%2F00R&maintrid=0&subtrid=0&softstatus=&txtonob=2&txtoqty=91.5&qcstatus=OK&qcdot1=17-07-2018&qcdot2=&qctestdate=17-07-2018&dp1=16-10-2018&dp2=16-01-2019&dp3=16-04-2019&dp4=&dp5=&dp6=&qcdttype=DoT&protyp=E&txtclotno=DV07746%2F00000%2F00C&protype=E&extslwhg1=15&extslbing1=625&extslsubbg1=12489&txtextnob1=2&txtextqty1=91.500&recnobp1=2&recqtyp1=91.500&txtbalnobp1=0&txtbalqtyp1=0&srno2=1&txtconnob=2&txtconqty=91.5&txtconrem=0&txtconim=0&txtconpl=0&txtconloss=0&txtconper=0.000&validityperiod=9&validityupto=16-04-2019&valdays=132&paceptyp=E&txtplotno=DV07746%2F00000%2F00P&pcktype=E&avlnobpck=2&avlqtypck=91.5&picqtyp=91.5&pckloss=0&ccloss=0&balpck=91.5&balcnob=0&balcqty=0&txtslwhg1=WH&txtslbing1=Bin&txtslsubbg1=Subbin&txtconslnob1=&txtconslqty1=&txtslwhg2=WH&txtslbing2=Bin&txtslsubbg2=Subbin&txtconslnob2=&txtconslqty2=&fet=4&wtnopkg_1=0.050&upsname_1=50.000%20Gms&nopc_1=1830&mpck_1=Yes&nomp_1=13&wtmp_1=7&wtnop_1=140&lodednomp_1=&pouches_1=&nowb_1=&wtnopkg_2=0.100&upsname_2=100.000%20Gms&wtmp_2=10&wtnop_2=100&lodednomp_2=&pouches_2=&nowb_2=&wtnopkg_3=0.250&upsname_3=250.000%20Gms&wtmp_3=15&wtnop_3=60&lodednomp_3=&pouches_3=&nowb_3=&wtnopkg_4=0.500&upsname_4=500.000%20Gms&wtmp_4=20&wtnop_4=40&lodednomp_4=&pouches_4=&nowb_4=&sno=4&detmpbno=&upsidno=4&upssize=1&nopks=10&singlebar=&rangebar=&mobar=&extbpch=10&linkpch=0&bpch=10&txtremarks=

//extqty	proconqty1 procrm1 procim1 procpl1 proctplqt1 proctplper1 packloss1 packcc1 packqty1 totlotnomp1 totbalpch1  npups pnpwtmp pnpuom srno
if(isset($_GET['extqty'])) { $extqty = $_GET['extqty'];	}
if(isset($_GET['txtconnob'])) { $txtconnob = $_GET['txtconnob'];	}
if(isset($_GET['proconqty1'])) { $txtconqty = $_GET['proconqty1']; }
if(isset($_GET['procrm1'])) { $txtconrem = $_GET['procrm1']; }
if(isset($_GET['procim1'])) { $txtconim = $_GET['procim1']; }
if(isset($_GET['procpl1'])) { $txtconpl = $_GET['procpl1']; }
if(isset($_GET['proctplqt1'])) { $txtconloss= $_GET['proctplqt1']; }
if(isset($_GET['proctplper1'])) { $txtconper= $_GET['proctplper1']; }

if(isset($_GET['txtconnob'])) { $avlnobpck= $_GET['txtconnob']; }
if(isset($_GET['proconqty1'])) { $avlqtypck= $_GET['proconqty1']; }
if(isset($_GET['proconqty1'])) { $picqtyp= $_GET['proconqty1']; }
if(isset($_GET['packloss1'])) { $pckloss= $_GET['packloss1']; }
if(isset($_GET['packcc1'])) { $ccloss= $_GET['packcc1']; }
if(isset($_GET['packqty1'])) { $balpck= $_GET['packqty1']; }
if(isset($_GET['totlotnomp1'])) { $totlotnomp1= $_GET['totlotnomp1']; }
if(isset($_GET['totbalpch1'])) { $totbalpch1= $_GET['totbalpch1']; }
if(isset($_GET['pnplotno'])) { $pnplotno= $_GET['pnplotno']; }
if(isset($_GET['totlotbar1'])) { $totlotbar1= $_GET['totlotbar1']; }


$balcnob=0;
$balcqty=0;
$pouches=$totbalpch1;
$noofpcks=$totbalpch1;
$nopc=0;


if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }


$ttype="Online Processing and Packing Slip";
$pl=$txtconpl;
$rpl=$txtconpl;

$z1=$maintrid;

if($z1 > 0)
{
	$mainid=$z1;
	$sql_sub="UPDATE tbl_pnpslipsub  SET  pnpslipsub_connob='$txtconnob', pnpslipsub_conqty='$txtconqty', pnpslipsub_rm='$txtconrem', pnpslipsub_im='$txtconim', pnpslipsub_pl='$pl', pnpslipsub_rpl='$rpl', pnpslipsub_tlqty='$txtconloss', pnpslipsub_tlper='$txtconper', pnpslipsub_availpnob='$avlnobpck', pnpslipsub_availpqty='$avlqtypck', pnpslipsub_pickpqty='$picqtyp', pnpslipsub_packloss='$pckloss', pnpslipsub_packcc='$ccloss', pnpslipsub_packqty='$balpck', pnpslipsub_balcnob='$balcnob', pnpslipsub_balcqty='$balcqty', pnpslipsub_qty='$packqty', pnpslipsub_nop='$nopc', pnpslipsub_pnop='$pouches', pnpslipsub_balpouch='$noofpcks', pnpslipsub_nomp='$totlotnomp1', pnpslipsub_nobarcodes='$totlotbar1'  where  pnpslipmain_id='$mainid' and pnpslipsub_lotno='$pnplotno'";
	if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
	{
	}
	$z1=$mainid;
}

?>
<?php  
$tid=$z1;
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
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Online Processing Slip Preview</td>
</tr>
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
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
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
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
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
	<td width="18" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="106" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="47" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="63" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="37" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
	<td width="37"  rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>
	<td width="37" align="center" valign="middle" class="smalltblheading"  rowspan="2">IM </td>
	<td width="37"  rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
	<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
	<!--<td width="107" colspan="3" rowspan="2" align="center" valign="middle" class="smalltblheading">CSW SLOC</td>-->
	<td colspan="7" align="center" valign="middle" class="smalltblheading">Pack Details</td>
	<!--<td width="54" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>-->
	<td width="54" rowspan="2" align="center" valign="middle" class="smalltblheading">Update</td>
</tr>
<tr class="tblsubtitle">
	<td width="47" align="center" valign="middle" class="smalltblheading">NoB </td>
	<td width="63" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="53" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="31" align="center" valign="middle" class="smalltblheading">%</td>
	<td width="56" align="center" valign="middle" class="smalltblheading">Pack Loss</td>
	<td width="48" align="center" valign="middle" class="smalltblheading">CC</td>
	<td width="49" align="center" valign="middle" class="smalltblheading">Pack Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="57" align="center" valign="middle" class="smalltblheading">Barcodes</td>
	<td width="57" align="center" valign="middle" class="smalltblheading">Bal. Pouches</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">Details</td>
</tr>
  <?php
 
$srno=1;  $slcnt=0;
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
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub3 where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['pnpslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['pnpslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['pnpslipsubsub_bqty'];}

if($sloc1!=""){
$sloc1=$sloc1."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc1=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}

$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);


$pnplotno=$row_tbl_sub['pnpslipsub_lotno'];
$pnpnob=$row_tbl_sub['pnpslipsub_pnob'];
$pnpqty=$row_tbl_sub['pnpslipsub_pqty'];
$pnpprocesstype=$row_tbl_sub['pnpslipsub_processtype'];
$pnpconnob=$row_tbl_sub['pnpslipsub_connob'];
$pnpconqty=$row_tbl_sub['pnpslipsub_conqty'];
$pnprm=$row_tbl_sub['pnpslipsub_rm'];
$pnpim=$row_tbl_sub['pnpslipsub_im'];
$pnppl=$row_tbl_sub['pnpslipsub_pl'];
$pnptlqty=$row_tbl_sub['pnpslipsub_tlqty'];
$pnptlper=$row_tbl_sub['pnpslipsub_tlper'];
$pnpnomp=$row_tbl_sub['pnpslipsub_nomp'];
$pnpwtmp=$row_tbl_sub['pnpslipsub_wtmp'];
$pnpups=$row_tbl_sub['pnpslipsub_ups'];
$pnppackloss=$row_tbl_sub['pnpslipsub_packloss'];
$pnpcc=$row_tbl_sub['pnpslipsub_packcc'];

$sql_ups=mysqli_query($link,"select * from tblups where CONCAT(ups,' ',wt)='".$pnpups."'") or die(mysqli_error($link));
$row_ups=mysqli_fetch_array($sql_ups);
$pnpuom=$row_ups['uom'];


$diq=explode(".",$pnpconqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnpconqty;}
$pnpconqty=$difq;
$diq=explode(".",$pnprm);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnprm;}
$pnprm=$difq;
$diq=explode(".",$pnpim);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnpim;}
$pnpim=$difq;
$diq=explode(".",$pnppl);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnppl;}
$pnppl=$difq;
$diq=explode(".",$pnptlqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnptlqty;}
$pnptlqty=$difq;
$diq=explode(".",$pnppackloss);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnppackloss;}
$pnppackloss=$difq;
$diq=explode(".",$pnpcc);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnpcc;}
$pnpcc=$difq;

$balpch=0;

$pnppackqty=$pnpconqty-($pnppackloss+$pnpcc);

$ltnomp=$pnppackqty/$pnpwtmp;
$ltnomp=intval($ltnomp);
$totnompqty=$ltnomp*$pnpwtmp;
$toblqty=$pnppackqty-$totnompqty;
$balpch=$toblqty*$pnpuom;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnplotno;?><input type="hidden" name="pnplotno" id="pnplotno_<?php echo $srno;?>" value="<?php echo $pnplotno;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpqty;?><input type="hidden" name="extqty" id="extqty_<?php echo $srno;?>" value="<?php echo $pnpqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpprocesstype;?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $pnpconnob;?><input type="hidden" name="txtconnob" id="txtconnob_<?php echo $srno;?>" value="<?php echo $pnpconnob;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><input type="text" name="proconqty<?php echo $srno;?>" id="proconqty_<?php echo $srno;?>" size="3" value="<?php echo $pnpconqty;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><input type="text" name="procrm<?php echo $srno;?>" id="procrm_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnprm;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="chkconqty(this.value);" /></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><input type="text" name="procim<?php echo $srno;?>" id="procim_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnpim;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="chkrm(this.value);" /></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><input type="text" name="procpl<?php echo $srno;?>" id="procpl_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnppl;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="chkim(this.value);" /></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><input type="text" name="proctplqt<?php echo $srno;?>" id="proctplqt_<?php echo $srno;?>" size="3"  value="<?php echo $pnptlqty;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><input type="text" name="proctplper<?php echo $srno;?>" id="proctplper_<?php echo $srno;?>" size="3"  value="<?php echo $pnptlper;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><input type="text" name="packloss<?php echo $srno;?>" id="packloss_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnppackloss;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);"  /></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><input type="text" name="packcc<?php echo $srno;?>" id="packcc_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnpcc;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="plchk1(this.value);" /></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><input type="text" name="packqty<?php echo $srno;?>" id="packqty_<?php echo $srno;?>" size="3"  value="<?php echo $pnppackqty;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><input type="text" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" size="3"  value="<?php echo $pnpnomp;?>" class="smalltbltext" onchange="chknomp(this.value);" /></td>
	<td width="57" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openbarcodedetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)"><?php echo $tot_barcnomp;?></a><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" class="smalltbltext" /></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><input type="text" name="totbalpch<?php echo $srno;?>" id="totbalpch_<?php echo $srno;?>" size="3"  value="<?php echo $balpch;?>" readonly="true" style="background-color:#CCCCCC" class="smalltbltext" /></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<!--<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>-->
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="updatelossnqty(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">Update</a><input type="hidden" name="pnpups" id="pnpups_<?php echo $srno;?>" value="<?php echo $pnpups;?>" /><input type="hidden" name="pnpwtmp" id="pnpwtmp_<?php echo $srno;?>" value="<?php echo $pnpwtmp;?>" /><input type="hidden" name="pnpuom" id="pnpuom_<?php echo $srno;?>" value="<?php echo $pnpuom;?>" /><input type="hidden" name="totmaxnomp" id="totmaxnomp_<?php echo $srno;?>" value="<?php echo $pnpnomp;?>" /></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnplotno;?><input type="hidden" name="pnplotno" id="pnplotno_<?php echo $srno;?>" value="<?php echo $pnplotno;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpqty;?><input type="hidden" name="extqty" id="extqty_<?php echo $srno;?>" value="<?php echo $pnpqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpprocesstype;?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $pnpconnob;?><input type="hidden" name="txtconnob" id="txtconnob_<?php echo $srno;?>" value="<?php echo $pnpconnob;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><input type="text" name="proconqty<?php echo $srno;?>" id="proconqty_<?php echo $srno;?>" size="3" value="<?php echo $pnpconqty;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><input type="text" name="procrm<?php echo $srno;?>" id="procrm_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnprm;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="chkconqty(this.value);" /></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><input type="text" name="procim<?php echo $srno;?>" id="procim_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnpim;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="chkrm(this.value);" /></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><input type="text" name="procpl<?php echo $srno;?>" id="procpl_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnppl;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="chkim(this.value);" /></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><input type="text" name="proctplqt<?php echo $srno;?>" id="proctplqt_<?php echo $srno;?>" size="3"  value="<?php echo $pnptlqty;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><input type="text" name="proctplper<?php echo $srno;?>" id="proctplper_<?php echo $srno;?>" size="3"  value="<?php echo $pnptlper;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><input type="text" name="packloss<?php echo $srno;?>" id="packloss_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnppackloss;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);"  /></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><input type="text" name="packcc<?php echo $srno;?>" id="packcc_<?php echo $srno;?>" size="3" maxlength="6" value="<?php echo $pnpcc;?>" class="smalltbltext"  onkeypress="return isNumberKey(event)" onchange="plchk1(this.value);" /></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><input type="text" name="packqty<?php echo $srno;?>" id="packqty_<?php echo $srno;?>" size="3"  value="<?php echo $pnppackqty;?>" class="smalltbltext" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><input type="text" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" size="3"  value="<?php echo $pnpnomp;?>" class="smalltbltext" onchange="chknomp(this.value);" /></td>
	<td width="57" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openbarcodedetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)"><?php echo $tot_barcnomp;?></a><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" class="smalltbltext" /></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><input type="text" name="totbalpch<?php echo $srno;?>" id="totbalpch_<?php echo $srno;?>" size="3"  value="<?php echo $balpch;?>" readonly="true" style="background-color:#CCCCCC" class="smalltbltext" /></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<!--<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>-->
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="updatelossnqty(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">Update</a><input type="hidden" name="pnpups" id="pnpups_<?php echo $srno;?>" value="<?php echo $pnpups;?>" /><input type="hidden" name="pnpwtmp" id="pnpwtmp_<?php echo $srno;?>" value="<?php echo $pnpwtmp;?>" /><input type="hidden" name="pnpuom" id="pnpuom_<?php echo $srno;?>" value="<?php echo $pnpuom;?>" /><input type="hidden" name="totmaxnomp" id="totmaxnomp_<?php echo $srno;?>" value="<?php echo $pnpnomp;?>" /></td>
</tr>
 <?php
}
$srno++;
}
}
?>
<input type="hidden" name="srno" value="<?php echo $srno; ?>" /><input type="hidden" name="slcnt" value="<?php echo $slcnt; ?>" />
</table><br />

<div id="postingsubtable" style="display:block">
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>