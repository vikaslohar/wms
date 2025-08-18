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

if(isset($_GET['dobg'])) { $dobg= $_GET['dobg']; }
if(isset($_GET['operatorcode'])) { $operatorcode= $_GET['operatorcode']; }
if(isset($_GET['wtmaccode'])) { $wtmaccode= $_GET['wtmaccode']; }
if(isset($_GET['wtrangefr'])) { $wtrangefr= $_GET['wtrangefr']; }
if(isset($_GET['wtrangeto'])) { $wtrangeto= $_GET['wtrangeto']; }
if(isset($_GET['barcode'])) { $barcode= $_GET['barcode']; }
if(isset($_GET['weight'])) { $weight= $_GET['weight']; }
	
if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }


if(isset($_GET['domcs_1'])) { $domcs_1= $_GET['domcs_1']; }
if(isset($_GET['lbls_1'])) { $lbls_1= $_GET['lbls_1']; }
if(isset($_GET['domce_1'])) { $domce_1= $_GET['domce_1']; }
if(isset($_GET['lble_1'])) { $lble_1= $_GET['lble_1']; }
if(isset($_GET['domcs_2'])) { $domcs_2= $_GET['domcs_2']; }
if(isset($_GET['lbls_2'])) { $lbls_2= $_GET['lbls_2']; }
if(isset($_GET['domce_2'])) { $domce_2= $_GET['domce_2']; }
if(isset($_GET['lble_2'])) { $lble_2= $_GET['lble_2']; }

if(isset($_GET['txtwhg1'])) { $txtwhg1= $_GET['txtwhg1']; }
if(isset($_GET['vbin_1'])) { $vbin_1= $_GET['vbin_1']; }
if(isset($_GET['vsubbin_1'])) { $vsubbin_1= $_GET['vsubbin_1']; }
if(isset($_GET['slnop_1'])) { $slnop_1= $_GET['slnop_1']; }

$noofpacksx="noofpacks_1";
if(isset($_GET[$noofpacksx])) { $noofpcks= $_GET[$noofpacksx]; }
$pouchesx="pouches_1";
if(isset($_GET[$pouchesx])) { $pouches= $_GET[$pouchesx]; }

$ttype="Online Processing and Packing Slip";
$pl=$txtconpl;
$rpl=$txtconpl;

	$z1=$maintrid;
		
	$tdate11=explode("-",$dobg);
	$dobg=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
	
$barcode='';	
$sqltbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and  pnpslipmain_id='".$maintrid."'") or die(mysqli_error($link));
$rowtbl=mysqli_fetch_array($sqltbl);

$sqltblsub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and  pnpslipmain_id='".$maintrid."'") or die(mysqli_error($link));
$rowsubtbl=mysqli_fetch_array($sqltblsub);
$sid=$rowsubtbl['pnpslipsub_id'];
$txtplotno=$rowsubtbl['pnpslipsub_plotno']; 
$upssize=$rowsubtbl['pnpslipsub_ups'];
$pnpwtmp=$rowsubtbl['pnpslipsub_wtmp'];

$quervar=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$rowtbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticiaitem = mysqli_fetch_array($quervar);



?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<?php  
$tid=$maintrid;

$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and  pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
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
	
	$tdate13=explode("-",$rowsubtb['pnpslipsub_valupto']);
	$tdate3=$tdate13[2]."-".$tdate13[1]."-".$tdate13[0];
	
	$tdate14=explode("-",$rowsubtbl['pnpslipsub_qcdot']);
	$tdate4=$tdate14[2]."-".$tdate14[1]."-".$tdate14[0];

	
		
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
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" /> &nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' and  promac_id='".$row_tbl['pnpslipmain_promachcode']."' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and  proopr_id='".$row_tbl['pnpslipmain_proopr']."'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtpromech" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtoprname" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txttreattyp" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
  </tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and  pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
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
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and  pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and  whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and  binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and  sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
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
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and  pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
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

<?php
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and  pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
	$row=mysqli_fetch_array($sql_tbl_sub);
  	$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $row['pnpslipsub_lotno'];?>" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;</td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block">
<?php

$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_lotno='".$row['pnpslipsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nob=$nob+$row_issuetbl['lotldg_balbags']; 
$qty=$qty+$row_issuetbl['lotldg_balqty'];
$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
	$trdate=$row_issuetbl['lotldg_qctestdate'];
	$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
	$qcdttype="DOT";
}
//else
{
	$zz=str_split($row['pnpslipsub_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	//if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='$plantcode' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";
if($qcdot1=="00-00-0000" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="00-00-0000" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

$tdt="";
$sql_qcs=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and  oldlot='$ltno' and qcstatus='OK' order by tid desc Limit 0,2") or die(mysqli_error($link));
if($tot_qcs=mysqli_num_rows($sql_qcs)>=2)
{
	while($row_qcs=mysqli_fetch_array($sql_qcs))
	{
		if($tdt!="")
		$tdt=$tdt.",".$row_qcs['testdate'];
		else
		$tdt=$row_qcs['testdate'];
	}
}
$tdt1=""; $tdt2="";

$tdt=explode(",",$tdt);
$tdt1=$tdt[0];
$tdt2=$tdt[1];

if($qcdot1!="")
{
	$crdate=date("d-m-Y");
	$now = strtotime($qcdot1); // or your date as well
	$your_date = strtotime($crdate);
	$datediff2 = (($your_date - $now)/(60*60*24));
}
else
$datediff2 = 0;
//echo $qcdot2;
if($datediff2>15)	
{
	$qcdot2="";
}
else
{
	if($tdt2!="")
	{
		if($qcdot2!="" && $qcdot1!="")
		{
			$tdte2=explode("-",$qcdot2);
			$m=$tdte2[1];
			$de=$tdte2[0];
			$y=$tdte2[2];
		  	$tdte2=$y."-".$m."-".$de;
			
			$start_ts = strtotime($tdt2);
			$end_ts = strtotime($tdt1);
			$user_ts = strtotime($tdte2);
			
			if(!(($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			{
				$qcdot2="";
			}
		}
	}
}


if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";
$dp1="";$dp2="";$dp3="";$dp4="";$dp5="";$dp6="";
if($qcdot1!="")
{
	$trdate2=explode("-",$qcdot1);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
if($qcdot2!="")
{
	$trdate2=explode("-",$qcdot2);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp4=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp4="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp5=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp5="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp6=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp6="";}
}
}	
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="111" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="70" align="center" valign="middle" class="smalltblheading" >Total NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="81" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<td width="139" align="center" valign="middle" class="smalltblheading">Process Entire</td>
	<td width="140" align="center" valign="middle" class="smalltblheading">Process Partial</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >Processed Lot No.</td>
   <!--<td width="121" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="112" align="center" valign="middle" class="smalltblheading">Qty</td>-->
  </tr>

  <tr class="Light" height="25">
    <td width="149" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_lotno'];?><input type="hidden" name="softstatus" value="<?php echo $row['pnpslipsub_sstatus'];?>" /></td>
    <td width="98" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_onob'];?><input type="hidden" name="txtonob" value="<?php echo $row['pnpslipsub_onob'];?>" /></td>
    <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_oqty'];?><input type="hidden" name="txtoqty" value="<?php echo $row['pnpslipsub_oqty'];?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_qc'];?><input type="hidden" name="qcstatus" value="<?php echo $row['pnpslipsub_qc'];?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot1;?><input type="hidden" name="qcdot1" value="<?php echo $qcdot1;?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot2;?><input type="hidden" name="qcdot2" value="<?php echo $qcdot2;?>" />
	<input type="hidden" name="qctestdate" value="<?php echo $tdate3;?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="dp4" value="<?php echo $dp4;?>" /><input type="hidden" name="dp5" value="<?php echo $dp5;?>" /><input type="hidden" name="dp6" value="<?php echo $dp6;?>" /><input type="hidden" name="qcdttype" value="<?php echo $row['pnpslipsub_qcdttype'];?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" disabled="disabled" >
	<?php if($row['pnpslipsub_qcdttype']==""){ ?>
	<option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
	<?php }	?>
	<?php if($row['pnpslipsub_qcdttype']!=""){ ?>
	<option value="DoT" <?php if($qcdot1!="" && $row['pnpslipsub_qcdttype']=="DoT") echo "selected"; ?> >DoT</option>
	<option value="DoSF" <?php if($qcdot2!="" && $row['pnpslipsub_qcdttype']=="DoSF") echo "selected"; ?> >DoSF</option>
	<?php }	?>
	</select>
	</td>
	<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" id="protyp" value="E" onclick="prochktyp(this.value)" class="smalltbltext" <?php if($row['pnpslipsub_processtype']=="E") echo "checked"; ?> disabled="disabled"  /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" value="P" id="protyp" onclick="prochktyp(this.value)" class="smalltbltext" <?php if($row['pnpslipsub_processtype']=="P") echo "checked"; ?> disabled="disabled"  /></td>
	<td width="163" align="center" valign="middle" class="smalltblheading" id="cltno" ><input type="text" name="txtclotno" id="txtclotno" class="smalltbltext" value="<?php echo $row['pnpslipsub_clotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
   <!--<td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtnob" id="txtnob" class="smalltbltext" value="" size="8" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="txtqty" class="smalltbltext" value="" size="8" /></td>-->
  </tr> <input name="protype" value="<?php echo $row['pnpslipsub_processtype'];?>" type="hidden"> 
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Processing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Processing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_lotno='".$row['pnpslipsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
{ 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ $srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and  whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and  binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub where plantcode='$plantcode' and pnpslipsub_id='".$row['pnpslipsub_id']."' and pnpslipmain_id='".$tid."'  and pnpslipsubsub_wh='".$row_issuetbl['lotldg_whid']."' and pnpslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and pnpslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value="<?php echo $row['pnpslipsub_pnob'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  value="<?php echo $row['pnpslipsub_pqty'];?>" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['pnpslipsub_bnob'];?>" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['pnpslipsub_bqty'];?>" /></td>
  </tr>
 <?php
  }
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Processing Details</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Condition Seed</td>
    <td width="180" rowspan="2" align="center" valign="middle" class="smalltblheading">Remnant (RM)</td>
	<td width="237" rowspan="2" align="center" valign="middle" class="smalltblheading">Inert Material (IM)</td>
    <td width="237" rowspan="2" align="center" valign="middle" class="smalltblheading">Processing Loss (PL)</td>
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Total Cond. Loss</td>
  </tr>
  <tr class="tblsubtitle" >
    <td align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="121" align="center" valign="middle" class="smalltblheading" >Qty</td>
    <td width="112" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>

  <tr class="Light" height="25">
    <td width="86" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconnob" class="smalltbltext" value="<?php echo $row['pnpslipsub_connob'];?>" size="8" onchange="chkpronob()" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="100" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconqty" class="smalltbltext" value="<?php echo $row['pnpslipsub_conqty'];?>" size="8" onchange="chkproqty()" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconrem" class="smalltbltext" value="<?php echo $row['pnpslipsub_rm'];?>" size="8" onchange="chkconqty()" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconim" class="smalltbltext" value="<?php echo $row['pnpslipsub_im'];?>" size="8" onchange="chkrm()" readonly="true" style="background-color:#CCCCCC" /></td>
    <td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconpl" class="smalltbltext" value="<?php if($row_tbl['pnpslipmain_stage']=="Raw") echo $row['pnpslipsub_pl']; else echo $row['pnpslipsub_rpl'];?>" size="8" onchange="chkim(this.value)" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtconloss" class="smalltbltext" value="<?php echo $row['pnpslipsub_tlqty'];?>" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconper" class="smalltbltext" value="<?php echo $row['pnpslipsub_tlper'];?>" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
  </tr>
</table>

<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Packing Details</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="165" align="center" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="220" align="center" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial&nbsp;</td>
<td width="156" align="center" valign="middle" class="tblheading">Packed Lot No.&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="">Select</option>
<option <?php if($row['pnpslipsub_valperiod']=="9") echo "Selected";?> value="9" >9</option>
<option <?php if($row['pnpslipsub_valperiod']=="6") echo "Selected";?> value="6" >6</option>
<option <?php if($row['pnpslipsub_valperiod']=="3") echo "Selected";?> value="3" >3</option>
</select>&nbsp;Months</td>
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;<input type="text" name="validityupto" id="validityupto" value="<?php echo $tdate4;?>" size="15" readonly="true" style="background-color:#CCCCCC"  /></td>
<td width="220" align="center" valign="middle" class="tblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="<?php echo $datediff;?>" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);" <?php if($row['pnpslipsub_packtype']=="E") echo "checked"; ?> disabled="disabled"  /></td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);" disabled="disabled"  /></td>
<td width="156" align="center" valign="middle" class="tblheading" id="pltno"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="<?php echo $row['pnpslipsub_plotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<!--<tr class="tblsubtitle" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext">&nbsp;</td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext">&nbsp; &nbsp;&nbsp;<b>Validity Days</b> </td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading">
</tr>-->
<input type="hidden" name="pcktype" id="pcktype" value="<?php echo $row['pnpslipsub_packtype'];?>" />
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>-->
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
	<td align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td align="center" valign="middle" class="smalltblheading">Captive Consumption</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Packing</td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance Condition</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="86" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="111" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="92" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="avlnobpck" id="avlnobpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_availpnob'];?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="avlqtypck" id="avlqtypck" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_availpqty'];?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="pfpchk(this.value)" value="<?php echo $row['pnpslipsub_pickpqty'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="<?php echo $row['pnpslipsub_packloss'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)" value="<?php echo $row['pnpslipsub_packcc'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" value="<?php echo $row['pnpslipsub_packqty'];?>"  style="background-color:#CCCCCC"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="balcnob" id="balcnob" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_balcnob'];?>"  /></td>
   <td  align="center"  valign="middle" class="smalltbltext"><input name="balcqty" id="balcqty" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_balcqty'];?>"  />&nbsp;</td>
</tr>  
</table>
<br />
<div id="conditionsloc" style="display: <?php if($row['pnpslipsub_packtype']=="P") echo "block"; else echo "none"; ?>">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Updated SLOC</td>
  </tr>
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Sub Bin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php
$srno3=1;

$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipsub_id='".$row['pnpslipsub_id']."' and pnpslipmain_id='".$tid."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$rowsubsub2=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{ 
?>
  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno3?>" name="txtslwhg<?php echo $srno3?>" style="width:70px;" onchange="wh<?php echo $srno3?>(this.value,<?php echo $srno3?>);" disabled="disabled"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_wh']==$noticia_whd1['whid']) echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub2['pnpslipsubsub_wh']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno3?>"><select class="smalltbltext" name="txtslbing<?php echo $srno3?>" style="width:60px;" onchange="bin<?php echo $srno3?>(this.value,<?php echo $srno3?>);" disabled="disabled" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub2['pnpslipsubsub_bin']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno3?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno3?>" id="txtslsubbg<?php echo $srno3?>" style="width:60px;" onchange="subbin<?php echo $srno3?>(this.value,<?php echo $srno3?>);" disabled="disabled"  >
<option value="" selected>Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_subbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno3?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $srno3?>" id="txtconslnob<?php echo $srno3?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno3?>);" value="<?php echo $row_tbl_subsub2['pnpslipsubsub_pnob'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $srno3?>" id="txtconslqty<?php echo $srno3?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno3?>);"  onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_subsub2['pnpslipsubsub_pqty'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
  </tr>
<?php
$srno3++;
}
?>
</table><br />
</div>


<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="12">Packing Details</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading">Select</td>
<td align="center" valign="middle" class="tblheading">UPS</td>
<td align="center" valign="middle" class="tblheading">Total Quantity</td>
<td align="center" valign="middle" class="tblheading">Max No. of Pouches</td>
<td align="center" valign="middle" class="tblheading">Convert to MP</td>
<td align="center" valign="middle" class="tblheading">Max. No. of MP</td>
<td align="center" valign="middle" class="tblheading">No. of MP</td>
<td align="center" valign="middle" class="tblheading">No. of Pouches</td>
<td align="center" valign="middle" class="tblheading">Balance Pouches</td>
<!--<td align="center" valign="middle" class="tblheading">Barcode Labels</td>-->
</tr>

<?php
$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row['pnpslipsub_plotno']."' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=0; $srnonew=0;
//echo $rowvariety['varietyid'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
$p1=array();
foreach($p1_array as $val1)
{
if($val1<>"")
{
$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$row12=mysqli_fetch_array($res);
//echo $row12['ups']; echo "  -  ";
//echo $row12['wt']; echo "<br/>";
$wtmp=$p1_array2[$srnonew];
$mptnop=$p1_array3[$srnonew];
if($row12['uid']==$row['pnpslipsub_upsid'])
{
$sno++;		
?>

<tr class="Light" height="25">
<td width="49" align="center" valign="middle" class="tbltext"><input type="radio" name="fet" onClick="clk('<?php echo $sno?>',<?php echo $row12['uid'];?>);" id="fetchk_<?php echo $sno?>" value="<?php echo $row12['uid'];?>" <?php if($row12['uid']==$row['pnpslipsub_upsid']) echo "checked"; ?> disabled="disabled"/><?php if($row12['uid']==$row['pnpslipsub_upsid']) {?><input type="hidden" name="upssize" value="<?php echo $sno;?>" /><?php } ?></td>
<td width="79" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row12['ups']." ".$row12['wt'];?><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $row12['uom'];?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $row12['ups']." ".$row12['wt'];?>" /></td>
<td width="81" align="center" valign="middle" class="tbltext"><input type="text" name="packqty_<?php echo $sno?>" id="packqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_packqty']; else echo ""; ?>" onkeypress="return isNumberKey(event)" onchange="chktotpouches(this.value, <?php echo $sno?>)" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="96" align="center" valign="middle" class="tbltext"><input type="text" name="nopc_<?php echo $sno?>" id="nopc_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_nop']; else echo ""; ?>" readonly="true" style="background-color:#CCCCCC"/></td>
<td width="53" align="center" valign="middle" class="tbltext"><input type="checkbox" name="mpck_<?php echo $sno?>" id="mpck_<?php echo $sno?>" class="tbltext" value="Yes" onchange="mpchk(this.value, <?php echo $sno;?>)" <?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo "checked"; else echo "disabled"; ?> disabled="disabled" checked="checked"  /></td>
<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo $row['pnpslipsub_nomp']; else echo ""; ?>"  onchange="balnopcheck(this.value, <?php echo $sno?>)"/><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>

<td width="135" align="center" valign="middle" class="tbltext"><input type="text" name="lodednomp_<?php echo $sno?>" id="lodednomp_<?php echo $sno?>" size="5" maxlength="7"  class="tbltext" value="<?php echo $tot_barcnomp;?>" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="114" align="center" valign="middle" class="tbltext"><input type="text" name="pouches_<?php echo $sno?>" id="pouches_<?php echo $sno?>" size="5"  maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_pnop'];?>"  onkeypress="return isNumberKey1(event)" onchange="poucheschk(this.value,<?php echo $sno?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo $row['pnpslipsub_balpouch']; else echo ""; ?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<!--<td width="61" align="center" valign="middle" class="tbltext" id="dtail_<?php echo $sno;?>"><?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") {?><a href="Javascript:void(0)" onclick="detailspop('edit')">Attach</a><?php }else{ ?>Attach<?php } ?></td>-->
</tr>
<?php	
}	
}
$srnonew++;
}
?>

<?php
$abrc="";
$s_sub3=mysqli_query($link,"select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' and bar_lotno='".$row['pnpslipsub_plotno']."' and bar_logid='".$logid."' and bar_psrn='".$row_tbl['pnpslipmain_proslipno']."'") or die(mysqli_error($link));
$zxcvb=mysqli_num_rows($s_sub3);
while($row_sub3=mysqli_fetch_array($s_sub3))
{
	$sa24=$row_sub3['bar_barcodes'];
	if($abrc!="")
		$abrc=$abrc.","."'$sa24'";
	else
		$abrc="'$sa24'";
}
	
	$b=0;
	if($abrc!="")
	{
	$sqlbtsls=mysqli_query($link,"select distinct(btsl_id) from tbl_btslsub where plantcode='$plantcode' and btslsub_barcode IN ($abrc) order by btslsub_id asc") or die(mysqli_error($link));
	$b=mysqli_num_rows($sqlbtsls);
	}
?>

<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="<?php echo $row['pnpslipsub_nobarcodes'];?>" /><input type="hidden" name="upsidno" value="<?php echo $row['pnpslipsub_upsid'];?>" /><input type="hidden" name="nopks" value="<?php echo $row['pnpslipsub_balpouch'];?>" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="<?php echo $b;?>" />
<input type="hidden" class="smalltblheading" size="7" name="extbpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" class="smalltblheading" size="7" name="linkpch" value="0" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" class="smalltblheading" size="7" name="bpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC; color:#FF0000" />
</table>
<?php
$sql_barc=mysqli_query($link,"SELECT * FROM tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipmain_id='$tid' and pnpslipbar_logid='$logid' order by pnpslipbar_id desc" ) or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($sql_barc);
$row_barc=mysqli_fetch_array($sql_barc);

$tdate11=explode("-",$row_barc['pnpslipbar_wtdate']);
$dobg=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
	
	
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" colspan="12">Barcodes Weighing Details</td>
  </tr>
  <tr class="light" height="25">
    <td width="169" align="right" valign="middle" class="tblheading">Weighing Date&nbsp;</td>
    <td width="134" align="left" valign="middle" class="tblheading">&nbsp;
        <input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#ECECEC" />
      &nbsp;</td>
    <td width="190" align="right" valign="middle" class="tblheading">Weighing Machine Operator&nbsp;</td>
    <td width="159" align="left" valign="middle" class="tblheading">&nbsp;
        <input type="text"  name="operatorcode" class="tbltext"  size="20" value="<?php echo $row_barc['pnpslipbar_wtmopr'];?>" readonly="true" style="background-color:#CCCCCC"  /></td>
    <td width="141" align="right" valign="middle" class="tblheading">Weighing Machine&nbsp;</td>
    <td width="163" align="left" valign="middle" class="tblheading">&nbsp;
        <input type="text" name="wtmaccode" class="tbltext" size="20" value="<?php echo $row_barc['pnpslipbar_wtmcode'];?>" readonly="true" style="background-color:#CCCCCC"  /></td>
  </tr>
  <tr class="light" height="25">
    <td align="right" valign="middle" class="tblheading">Gross Weight Range&nbsp;</td>
    <td align="left" valign="middle" class="tblheading" colspan="5">&nbsp;Min.&nbsp;&nbsp;
        <input type="text" name="wtrangefr" class="tbltext" value="<?php echo $row_barc['pnpslipbar_wtgrfr'];?>" size="4" maxlength="6"  />
      &nbsp;&nbsp;Max.&nbsp;&nbsp;
      <input type="text" name="wtrangeto" class="tbltext" value="<?php echo $row_barc['pnpslipbar_wtgrto'];?>" size="4" maxlength="6"  />
      &nbsp;in Kgs.</td>
  </tr>
<!--  <tr class="light" height="25">
    <td align="right" valign="middle" class="tblheading">Label No. 1&nbsp;</td>
    <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row['pnpslipsub_lblschar'].$row['pnpslipsub_lblsno'];?><input type="hidden" name="domcs_1" id="domcs_1" value="<?php echo $row['pnpslipsub_lblschar'];?>"  /><input type="hidden" name="lbls_1" id="lbls_1" size="5" maxlength="7" disabled="disabled" class="tbltext" value="<?php echo $row['pnpslipsub_lblsno'];?>" onkeypress="return isNumberKey1(event)" onchange="domchk(1);"  /></td>
    <td width="114" align="center" valign="middle" class="tbltext"><?php echo $row['pnpslipsub_lbechar'].$row['pnpslipsub_lbeno'];?><input type="hidden" name="domce_1" id="domce_1" class="tbltext" size="1" maxlength="1" readonly="true" disabled="disabled" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_lbechar'];?>" /><input type="hidden" name="lble_1" id="lble_1" size="5"  disabled="disabled"maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_lbeno'];?>"  onkeypress="return isNumberKey1(event)" onchange="domchk1(this.value, 1)" /></td>
	  <td align="right" valign="middle" class="tblheading">Label No. 2&nbsp;</td>
    <td align="left" valign="middle" class="tblheading"><?php echo $row['pnpslipsub_lblschar2'].$row['pnpslipsub_lblsno2'];?><input type="hidden" name="domcs_2" id="domcs_2" value="<?php echo $row['pnpslipsub_lblschar2'];?>" /><input type="hidden" name="lbls_2" id="lbls_2" size="5" maxlength="7" disabled="disabled" class="tbltext" value="<?php echo $row['pnpslipsub_lblsno2'];?>" onkeypress="return isNumberKey1(event)" onchange="domchk(2);"  /></td>
    <td width="114" align="center" valign="middle" class="tbltext"><?php echo $row['pnpslipsub_lbechar2'].$row['pnpslipsub_lbeno2'];?><input type="hidden" name="domce_2" id="domce_2" class="tbltext" size="1" maxlength="1" readonly="true" disabled="disabled" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_lbechar2'];?>" /><input type="hidden" name="lble_2" id="lble_2" size="5"  disabled="disabled"maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_lbeno2'];?>"  onkeypress="return isNumberKey1(event)" onchange="domchk1(this.value, 2)" /></td>
  </tr>
 --> 
  
<tr class="light" height="25">
    <td align="right" valign="middle" class="tblheading">Label No. 1&nbsp;</td>
    <td align="left" valign="middle" class="tblheading">&nbsp;<?php $quer3=mysqli_query($link,"SELECT dom_mcode FROM tbl_rm_dommac where plantcode='$plantcode' order by dom_mcode Asc"); ?>
        <select class="smalltbltext" name="domcs_1" id="domcs_1" style="width:40px;" onchange="domcchk(this.value, 1)">
          <option value="" selected>Select</option>
          <?php while($noticia = mysqli_fetch_array($quer3)) { ?>
          <option <?php if($row['pnpslipsub_lblschar']==$noticia['dom_mcode']) echo "Selected";?> value="<?php echo $noticia['dom_mcode'];?>" />  
          <?php echo $noticia['dom_mcode'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="text" name="lbls_1" id="lbls_1" size="5" maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_lblsno'];?>" onkeypress="return isNumberKey1(event)" onchange="domchk(1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
    <td width="114" align="center" valign="middle" class="tbltext"><input type="text" name="domce_1" id="domce_1" class="tbltext" size="1" maxlength="1" readonly="true" disabled="disabled" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_lbechar'];?>" />&nbsp;<input type="text" name="lble_1" id="lble_1" size="5"  maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_lbeno'];?>"  onkeypress="return isNumberKey1(event)" onchange="domchk1(this.value, 1)" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	  <td align="right" valign="middle" class="tblheading">Label No. 2&nbsp;</td>
    <td align="left" valign="middle" class="tblheading">&nbsp;<?php $quer33=mysqli_query($link,"SELECT dom_mcode FROM tbl_rm_dommac where plantcode='$plantcode' order by dom_mcode Asc"); ?>
        <select class="smalltbltext" name="domcs_2" id="domcs_2" style="width:40px;" onchange="domcchk(this.value, 2)">
          <option value="" selected>Select</option>
          <?php while($noticia3 = mysqli_fetch_array($quer33)) { ?>
          <option <?php if($row['pnpslipsub_lbechar2']==$noticia3['dom_mcode']) echo "Selected";?>  value="<?php echo $noticia3['dom_mcode'];?>" />  
          <?php echo $noticia3['dom_mcode'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="text" name="lbls_2" id="lbls_2" size="5" maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_lblsno2'];?>" onkeypress="return isNumberKey1(event)" onchange="domchk(2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
    <td width="114" align="center" valign="middle" class="tbltext"><input type="text" name="domce_2" id="domce_2" class="tbltext" size="1" maxlength="1" readonly="true" disabled="disabled" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_lbechar2'];?>" />&nbsp;<input type="text" name="lble_2" id="lble_2" size="5"  maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_lbeno2'];?>"  onkeypress="return isNumberKey1(event)" onchange="domchk1(this.value, 2)" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  
  
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="2">Select SLOC</td>
</tr>
<?php
$slsrn=1; $wh1=""; $bin=""; $subbin="";

	$whid=$row_barc['pnpslipbar_whid']; $binid=$row_barc['pnpslipbar_binid']; $subbinid=$row_barc['pnpslipbar_subbinid'];
	
	$whd1=mysqli_query($link,"select * from tbl_warehouse where plantcode='$plantcode' and whid='".$row_barc['pnpslipbar_whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whd1=mysqli_fetch_array($whd1);
	
	$bin1=mysqli_query($link,"select * from tbl_bin where plantcode='$plantcode' and binid='".$row_barc['pnpslipbar_binid']."' ") or die(mysqli_error($link));
	$row_bin1=mysqli_fetch_array($bin1);
	
	$subbin1=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' and sid='".$row_barc['pnpslipbar_subbinid']."' ") or die(mysqli_error($link));
	$row_subbin1=mysqli_fetch_array($subbin1);
	
	if($wh1=="")
		$wh1=$row_whd1['perticulars'];
	else
		$wh1=$wh1."<br />".$row_whd1['perticulars'];
	
	if($bin=="") 
		 $bin=$row_bin1['binname'];
	else
		 $bin=$bin."<br />".$row_bin1['binname'];
	
	 if($subbin=="")
		$subbin=$row_subbin1['sname'];
	 else
		$subbin=$subbin."<br />".$row_subbin1['sname'];
$totslqty=0;
	$sql_barc2=mysqli_query($link,"SELECT * FROM tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipmain_id='$tid' order by pnpslipbar_id desc" ) or die("Error: " . mysqli_error($link));
	$numofrecords2=mysqli_num_rows($sql_barc2);
	$row_barc2=mysqli_fetch_array($sql_barc2);	
	$totslqty=$totslqty+($row_barc2['pnpslipbar_wtmp']*$numofrecords2);
	$xups=$row_barc2['pnpslipbar_ups'];
	
	$sql_ups=mysqli_query($link,"select * from tblups where CONCAT(ups,' ',wt)='".$row_barc['pnpslipbar_ups']."'") or die(mysqli_error($link));
	$row_ups=mysqli_fetch_array($sql_ups);
	$totslqty=$totslqty+($row_ups['uom']*$row_barc2['pnpslipbar_nop']);
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading">WH</td>
	<td align="center" valign="middle" class="tblheading">Bin</td>
	<td align="center" valign="middle" class="tblheading">Sub-Bin</td>
	<td align="center" valign="middle" class="tblheading">NoP</td>
	<td align="center" valign="middle" class="tblheading">NoMP</td>
	<td align="center" valign="middle" class="tblheading">Qty</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td width="10%" align="left" valign="middle" class="smalltbltext" id="wh<?php echo $slsrn;?>">&nbsp;<?php if($wh1!=""){ echo $wh1;?><input type="hidden" name="txtwhg<?php echo $slsrn;?>" id="txtwhg_<?php echo $slsrn?>" value="<?php echo $whid;?>"  /><?php } else {?><select class="smalltbltext" id="txtwhg_<?php echo $slsrn?>" name="txtwhg1" style="width:70px;" onchange="wh(this.value,'<?php echo $slsrn?>');"  >
<option value="" selected>WH</option>
	<?php $whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and order by perticulars") or die(mysqli_error($link));	while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select><?php }?></td>
	
	<td width="10%" align="left" valign="middle" class="smalltbltext" id="bin<?php echo $slsrn;?>">&nbsp;<?php if($bin!=""){ echo $bin;?><input type="hidden" name="vbin_<?php echo $slsrn;?>" id="vbin_<?php echo $slsrn?>" value="<?php echo $binid;?>"  /><?php } else {?>
	  <select class="smalltbltext" id="vbin_<?php echo $slsrn;?>" name="vbin_<?php echo $slsrn;?>" style="width:60px;" onchange="bin(this.value,'<?php echo $slsrn?>');" >
<option value="" selected>Bin</option>
	</select><?php }?></td>
		
		<td width="10%" align="left" valign="middle" class="smalltbltext" id="subbin<?php echo $slsrn;?>">&nbsp;<?php if($subbin!=""){echo $subbin;?><input type="hidden"  id="vsubbin_<?php echo $slsrn;?>" name="vsubbin_<?php echo $slsrn;?>" value="<?php echo $subbinid;?>"  /><?php } else {?>
		  <select class="smalltbltext" id="vsubbin_<?php echo $slsrn;?>" name="vsubbin_<?php echo $slsrn;?>" style="width:60px;" >
<option value="" selected>SubBin</option>
	</select><?php }?></td>
	<td width="21%" align="center" valign="middle" class="smalltbltext" colspan="3" id="slocr1"><table align="center" border="0" width="100%" cellspacing="0" cellpadding="0"  style="border-collapse:collapse" >
<tr height="25">
		<td width="7%" align="center" valign="middle" class="smalltbltext"><input type="text" name="slnop_<?php echo $slsrn?>" id="slnop_<?php echo $slsrn?>" size="4" maxlength="6" class="tbltext" value="<?php echo $row_barc2['pnpslipbar_nop'];?>" /></td>
		<td width="7%" align="center" valign="middle" class="smalltbltext"><input type="text" name="slnomp_<?php echo $slsrn?>" id="slnomp_<?php echo $slsrn?>" size="4" maxlength="6" class="tbltext" value="<?php echo $numofrecords2;?>" readonly="" style="background-color:#CCCCCC" /></td>
		<td width="7%" align="center" valign="middle" class="smalltbltext"><input type="text" name="slqt_<?php echo $slsrn?>" id="slqt_<?php $slsrn;?>" size="4" maxlength="6" class="tbltext" value="<?php echo $totslqty;?>" readonly="" style="background-color:#CCCCCC" /></td>
		</tr></table></td>
		<td width="7%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="newsloc('<?php echo $slsrn?>')">NEW SLOC</a></td>
</tr>
<input type="hidden" name="slsrn" id="slsrn" value="<?php echo $slsrn?>" />
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="2">Enter Barcodes</td>
</tr>

<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading">Barcodes</td>
	<td align="center" valign="middle" class="tblheading">Weight</td>
</tr>
<tr class="Dark" height="25">
<td width="50%" align="center" valign="middle" class="tblheading" ><input type="text" name="barcode" id="m1" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,1);" onkeypress="return isNumberKey24(event)" value="" onblur="javascript:this.value=this.value.toUpperCase();"  /><span id="wtbar1" style="display:none"><input type="hidden" name="barcvaldchk" id="barcvaldchk1" value="" /></span><input type="hidden" name="lastbarcodewt" value="<?php echo $weight;?>" /></td>
<td width="50%" align="center" valign="middle" class="tblheading" id="wtws1"><input type="text" name="weight" id="w1" class="tbltext" size="6" maxlength="6" onchange="chkmlt1(this.value,1);" onkeypress="return isNumberKey1(event)" value=""  readonly="true" style="background-color:#CCCCCC"  /><span id="wtwsdelete1" style="display:none"></span></td>

</tr>
</table>
<?php
$bchnflg=0;
$sqlbarc=mysqli_query($link,"SELECT pnpslipbar_barcode FROM tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_barcode='$barcode' order by pnpslipbar_id desc" ) or die("Error: " . mysqli_error($link));
$to6=mysqli_num_rows($sqlbarc);

$sqlbarc2=mysqli_query($link,"SELECT pnpslipbar_barcode FROM tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipmain_id='$arrival_id' order by pnpslipbar_id desc" ) or die("Error: " . mysqli_error($link));
$to62=mysqli_num_rows($sqlbarc2);
while($rowbarc2=mysqli_fetch_array($sqlbarc2))
{
$bchnflg++;
}
?>
<table align="center" border="0" width="970" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="light">
  <td align="center" class="tblheading"><font size="+4" color="<?php if($to60 > 0 && $to61 > 0){ echo '#FF0000'; } else if($to6==0){ echo '#FF0000'; } else { if($bchnflg%2==0) echo '#0000FF'; else echo '#009900';}?>"><?php echo $barcode;?></font></td>
</tr>
</table>
<div id="slsync">
<?php /*if($row['pnpslipsub_nomp'] > 0) {?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right" width="502" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="slocssyn" onclick="openslocsyn(this.value)" <?php if($row['pnpslipsub_sltyp']=="slocssyn") echo "checked"; else echo "disabled";?> /></td><td width="462" align="left" valign="middle" class="tblheading">&nbsp;SLOC Synchronization</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="link1sloc" onclick="openslocsyn(this.value)" <?php if($row['pnpslipsub_sltyp']=="link1sloc") echo "checked"; else echo "disabled"; ?> /></td><td align="left" valign="middle" class="tblheading">&nbsp;Linking Barcodes to 1 SLOC</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="linkmosloc" onclick="openslocsyn(this.value)" <?php if($row['pnpslipsub_sltyp']=="linkmosloc") echo "checked"; else echo "disabled"; ?> /></td><td align="left" valign="middle" class="tblheading">&nbsp;Linking Barcodes to 2 or more SLOC</td>
</tr>
<input type="hidden" name="slocssyncs24" value="<?php echo $row['pnpslipsub_sltyp'];?>" />
</table>
<?php }*/ ?>
<div id="slocsync"></div>

<!--<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0" style="display:inline;cursor:Pointer;" onclick="nxtpform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
</div></div>