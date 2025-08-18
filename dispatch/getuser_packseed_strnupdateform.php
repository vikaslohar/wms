<?php ob_start();session_start();
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

if(isset($_POST['txtid'])) { $txtid = $_POST['txtid']; }
if(isset($_POST['date'])) { $date = $_POST['date']; }
if(isset($_POST['txtstfp'])) { $txtstfp= $_POST['txtstfp']; }
if(isset($_POST['txtcrop'])) { $txtcrop = $_POST['txtcrop'];	}
if(isset($_POST['txtvariety'])) { $txtvariety = $_POST['txtvariety']; }
if(isset($_POST['txtstage'])) { $txtstage = $_POST['txtstage']; }
if(isset($_POST['txtlot1'])) { $txtlot1 = $_POST['txtlot1']; }
if(isset($_POST['sn'])) { $sn = $_POST['sn']; }
if(isset($_POST['txtremarks'])) { $txtremarks= $_POST['txtremarks']; }
$txtremarks=str_replace("&","and",$txtremarks);

if(isset($_POST['txt11'])) { $txt11=$_POST['txt11']; }
if(isset($_POST['txttname'])) { $txttname=$_POST['txttname']; }
if(isset($_POST['txtlrn'])) { $txtlrn=$_POST['txtlrn']; }
if(isset($_POST['txtvn'])) { $txtvn=$_POST['txtvn']; }
if(isset($_POST['txt13'])) { $txt13=$_POST['txt13']; }
if(isset($_POST['txtcname'])) { $txtcname=$_POST['txtcname']; }
if(isset($_POST['txtdc'])) { $txtdc=$_POST['txtdc']; }
if(isset($_POST['txtpname'])) { $txtpname=$_POST['txtpname']; }

if(isset($_REQUEST['enop'])) {  $enop=$_REQUEST['enop']; }
if(isset($_REQUEST['enomp'])) {  $enomp=$_REQUEST['enomp']; }
if(isset($_REQUEST['eqty'])) {  $eqty=$_REQUEST['eqty']; }

if(isset($_REQUEST['txtalnop'])) {  $alnop=$_REQUEST['txtalnop']; }
if(isset($_REQUEST['txtalnomp'])) {  $alnomp=$_REQUEST['txtalnomp']; }
if(isset($_REQUEST['txtalqty'])) {  $alqty=$_REQUEST['txtalqty']; }

if(isset($_REQUEST['txtavlnop'])) {  $avlnop=$_REQUEST['txtavlnop']; }
if(isset($_REQUEST['txtavlnomp'])) {  $avlnomp=$_REQUEST['txtavlnomp']; }
if(isset($_REQUEST['txtavlqty'])) {  $avlqty=$_REQUEST['txtavlqty']; }

if(isset($_POST['txttobenop'])) { $tobenop=$_POST['txttobenop']; }
if(isset($_POST['txttobenomp'])) { $tobenomp=$_POST['txttobenomp']; }
if(isset($_POST['txttobeqty'])) { $tobeqty=$_POST['txttobeqty']; }

if(isset($_REQUEST['loadgrswt'])) {  $loadgrswt=$_REQUEST['loadgrswt']; }
if(isset($_REQUEST['loadnop'])) {  $loadnop=$_REQUEST['loadnop']; }
if(isset($_REQUEST['loadnomp'])) {  $loadnomp=$_REQUEST['loadnomp']; }
if(isset($_REQUEST['loadqty'])) {  $loadqty=$_REQUEST['loadqty']; }

if(isset($_REQUEST['balnop'])) {  $balnop=$_REQUEST['balloadnop']; }
if(isset($_REQUEST['balnomp'])) {  $balnomp=$_REQUEST['balloadnomp']; }
if(isset($_REQUEST['balqty'])) {  $balqty=$_REQUEST['balloadqty']; }

if(isset($_REQUEST['balnop'])) {  $balstnop=$_REQUEST['balnop']; }
if(isset($_REQUEST['balnomp'])) {  $balstnomp=$_REQUEST['balnomp']; }
if(isset($_REQUEST['balqty'])) {  $balstqty=$_REQUEST['balqty']; }
	
if(isset($_POST['maintrid'])) { $maintrid= $_POST['maintrid']; }
if(isset($_POST['subtrid'])) { $subtrid= $_POST['subtrid']; }

//echo $subtrid;
	$z1=$maintrid;
		
	$tdate11=$date;
	$tday1=substr($tdate11,0,2);
	$tmonth1=substr($tdate11,3,2);
	$tyear1=substr($tdate11,6,4);
	$tdate1=$tyear1."-".$tmonth1."-".$tday1;
	
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$pltcode=$row_month['code'];
	
	$quer5=mysqli_query($link,"SELECT distinct stcode FROM tbl_partymaser where p_id='$txtstfp' order by stcode asc"); 
	$noticia2 = mysqli_fetch_array($quer5); 
	$plantcode=$noticia2['stcode'];
	
	$quer7=mysqli_query($link,"SELECT * FROM tbl_stoutspack where stoutsp_id='".$subtrid."' and stoutmp_id='".$maintrid."' and stoutsp_lotno='".$txtlot1."' "); 
	$tot7=mysqli_num_rows($quer7);
	if($tot7 > 0)
	{
		$noticia7 = mysqli_fetch_array($quer7); 
		$nopqty=0;
		$lodednomp=$noticia7['stoutsp_loadnomp'];
		$wtmp=$noticia7['stoutsp_wtmp'];
		$enop=$noticia7['stoutsp_avlnop'];
		$enomp=$noticia7['stoutsp_avlnomp'];
		$eqty=$noticia7['stoutsp_avlqty'];
		$eups=explode(" ",$noticia7['stoutsp_ups']);
		$lodqty=$lodednomp*$wtmp;	
		
		if($eups[1]=="Kgs")
		{
			$ptp=$eups[0];
		}
		else
		{
			$ptp=$eups[0]/1000;
		}
		$nopqty=$ptp*$tobenop;
		$totqty=$lodqty+$nopqty;
		$balqty=$eqty-$totqty;
		$balnop=$enop-$tobenop;
		$balnomp=$enomp-$lodednomp;
		if($balqty<=0)$balqty=0;
		if($balqty==0)
		{
			$balnop=0;
			$balnomp=0;
		}
		if($tobenop>0)
		{
			$sql_sub2="update tbl_stoutspack set stoutsp_tbnop='$tobenop', stoutsp_tbnomp='$tobenomp', stoutsp_tbqty='$tobeqty', stoutsp_subflg=1, stoutsp_loadnop='$tobenop', stoutsp_loadqty='$totqty', stoutsp_balnop='$balnop', stoutsp_balnomp='$balnomp', stoutsp_balqty='$balqty' where stoutmp_id='".$maintrid."' and stoutsp_id='".$subtrid."'";
			mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
		}
	}
	else
	{
	
	
	$sql_lable=mysqli_query($link,"SELECT * FROM tbl_lot_ldg_pack where lotno='".$txtlot1."' order by lotdgp_id desc limit 0,1");
	$row_lable=mysqli_fetch_array($sql_lable);
	
	$lable=$row_lable['packlabels'];
	$qcdate=$row_lable['lotldg_qctestdate'];
	$qcstatus=$row_lable['lotldg_qc'];
	$stage=$row_lable['packtype'];
	
	$qcpackdate="";
	if($row_lable['lotldg_rvflg']==1)
	{
		$sql_rv=mysqli_query($link,"SELECT * FROM tbl_revalidate where rv_newlot='".$txtlot1."'" );
		$row_rv=mysqli_fetch_array($sql_rv);
		$qcpackdate=$row_rv['rv_date'];
	}
	$sql_pnps=mysqli_query($link,"SELECT * FROM tbl_pnpslipsub where pnpslipsub_plotno='".$txtlot1."' order by pnpslipsub_id asc");
	$row_pnps=mysqli_fetch_array($sql_pnps);
	$qcpacktyp=$row_pnps['pnpslipsub_qcdttype'];
	
	if($qcpackdate=="" || $qcpackdate=="0000-00-00")
	$qcpackdate=$row_pnps['pnpslipsub_qcdot'];
	
	$sql_pp=mysqli_query($link,"SELECT * FROM tbl_qctest where oldlot='".$row_lable['orlot']."' order by tid desc limit 0,1");
	$row_pp=mysqli_fetch_array($sql_pp);
	$pp=$row_pp['pp'];
	$moist=$row_pp['moist'];
	$germ=$row_lable['lotldg_gemp'];
	
	$got1=$row_lable['lotldg_got1'];
	$gottype1=explode(" ",$got1);
	$gottype=$gottype1[0];
	$gotstatus=$row_lable['lotldg_got'];
	$gotdate=$row_lable['lotldg_gottestdate'];
	$wtmp=$row_lable['wtinmp'];
	$dop=$row_lable['lotldg_dop'];
	$dov=$row_lable['lotldg_valupto'];
	
	
	$srstatus="No"; $srstatus2="No";
	if($row_lable['lotldg_srflg']==1)
	{
		$sql_softrs=mysqli_query($link,"SELECT * FROM tbl_softr_sub where softrsub_lotno='".$row_lable['orlot']."' order by softrsub_id desc limit 0,1");
		$row_softrs=mysqli_fetch_array($sql_softrs);
		$srstatus="Yes";
		$srtyp=$row_softrs['softrsub_srtyp'];
		
		$sql_softrs2=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 where softrsub_lotno='".$row_lable['orlot']."' order by softrsub_id desc limit 0,1");
		$row_softrs2=mysqli_fetch_array($sql_softrs2);
		$srstatus2="Yes";
		$srtyp2=$row_softrs2['softrsub_srtyp'];
	}
	//exit;
		$z1=$maintrid;
			
		$tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
		$tdate12=$date;
		$tday2=substr($tdate12,0,2);
		$tmonth2=substr($tdate12,3,2);
		$tyear2=substr($tdate12,6,4);
		$tdate2=$tyear2."-".$tmonth2."-".$tday2;
		//echo $barcode;
		
	
		$sql_sub="insert into tbl_stoutspack (stoutmp_id, stoutsp_crop, stoutsp_variety, stoutsp_ups, stoutsp_lotno, stoutsp_lable1, stoutsp_enop, stoutsp_enomp, stoutsp_eqty, stoutsp_avlnop, stoutsp_avlnomp, stoutsp_avlqty, stoutsp_tbnop, stoutsp_tbnomp, stoutsp_tbqty, stoutsp_loadgrswt, stoutsp_loadnomp, stoutsp_loadqty, stoutsp_balnop, stoutsp_balnomp, stoutsp_balqty, stoutsp_qcpacktype, stoutsp_qcpackdate, stoutsp_qcstatus, stoutsp_qcdate, stoutsp_pp, stoutsp_moist, stoutsp_germ, stoutsp_gottype,stoutsp_gotstatus, stoutsp_gotdate, stoutsp_wtmp, stoutsp_dop, stoutsp_dov, stoutsp_srstatus, stoutsp_srtype, stoutsp_ssrstatus, stoutsp_ssrtype, stoutsp_loosenop,plantcode) values ('$maintrid', '$txtcrop', '$txtvariety', '$stage', '".$txtlot1."', '$lable', '$enop', '$enomp', '$eqty', '$avlnop', '$avlnomp', '$avlqty','$tobenop', '$tobenomp', '$tobeqty', '$loadgrswt', '$loadnomp', '$loadqty','$balnop','$balnomp','$balqty','$qcpacktyp','$qcpackdate','$qcstatus','$qcdate','$pp','$moist','$germ','$gottype','$gotstatus','$gotdate','$wtmp','$dop','$dov','$srstatus','$srtyp','$srstatus2','$srtyp2','$enop','$plantcode')";
		//exit;
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{ 
			$sid=mysqli_insert_id($link);
			$quer77=mysqli_query($link,"SELECT * FROM tbl_stoutspack where stoutsp_id='".$sid."' and stoutmp_id='".$maintrid."' and stoutsp_lotno='".$txtlot1."' "); 
			$tot77=mysqli_num_rows($quer77);
			if($tot77 > 0)
			{
				$noticia77 = mysqli_fetch_array($quer77); 
				$nopqty=0;
				$lodednomp=$noticia7['stoutsp_loadnomp'];
				$wtmp=$noticia7['stoutsp_wtmp'];
				$enop=$noticia7['stoutsp_avlnop'];
				$enomp=$noticia7['stoutsp_avlnomp'];
				$eqty=$noticia7['stoutsp_avlqty'];
				$eups=explode(" ",$noticia7['stoutsp_ups']);
				$lodqty=$lodednomp*$wtmp;	
				
				if($eups[1]=="Kgs")
				{
					$ptp=$eups[0];
				}
				else
				{
					$ptp=$eups[0]/1000;
				}
				$nopqty=$ptp*$tobenop;
				$totqty=$lodqty+$nopqty;
				$balqty=$eqty-$totqty;
				$balnop=$enop-$tobenop;
				$balnomp=$enomp-$lodednomp;
				if($balqty<=0)$balqty=0;
				if($balqty==0)
				{
					$balnop=0;
					$balnomp=0;
				}
				if($tobenop>0)
				{
					$sql_sub2="  tbl_stoutspack set stoutsp_tbnop='$tobenop', stoutsp_tbnomp='$tobenomp', stoutsp_tbqty='$tobeqty', stoutsp_subflg=1, stoutsp_loadnop='$tobenop', stoutsp_loadqty='$totqty', stoutsp_balnop='$balnop', stoutsp_balnomp='$balnomp', stoutsp_balqty='$balqty' where stoutmp_id='".$maintrid."' and stoutsp_id='".$sid."'";
					mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
				}
			}
		}
	}
?>	

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="25" align="center" class="smalltblheading">#</td>
	<td width="131" align="center" class="smalltblheading">Crop</td>
	<td width="199" align="center" class="smalltblheading">Variety</td>
	<td width="165" align="center" class="smalltblheading">Lot No.</td>
	<td width="85" align="center" class="smalltblheading">UPS</td>
	<td width="71" align="center" class="smalltblheading">NoP</td>
	<td width="71" align="center" class="smalltblheading">NoMP</td>
	<td width="82" align="center" class="smalltblheading">Qty</td>
	<td width="74" align="center" class="smalltblheading">Edit</td>
	<!--<td width="72" align="center" class="smalltblheading">Delete</td>-->
</tr>
<?php 
$srno=1;
$sql_sub=mysqli_query($link,"Select * from tbl_stoutspack where stoutmp_id='$maintrid' and stoutsp_subflg=1 order by stoutsp_id asc") or die(mysqli_error($link));
if($tot_sub=mysqli_num_rows($sql_sub) > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stoutsp_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$crop=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stoutsp_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variety=$noticia_item['popularname'];

$lotn=$row_sub['stoutsp_lotno'];
$stgw=$row_sub['stoutsp_ups'];
$nop=$row_sub['stoutsp_loadnop'];
$nomp=$row_sub['stoutsp_loadnomp'];
$qtys=$row_sub['stoutsp_loadqty'];

if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nop;?></td>
	<td align="center" class="smalltblheading"><?php echo $nomp;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $maintrid?>,<?php echo $row_sub['stoutsp_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nop;?></td>
	<td align="center" class="smalltblheading"><?php echo $nomp;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $maintrid?>,<?php echo $row_sub['stoutsp_id'];?>);" /></td>
</tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />
<div id="edittable">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Form</td>
</tr>

<?php
$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>
  <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia33 = mysqli_fetch_array($quer33)) { ?>
		<option value="<?php echo $noticia33['cropid'];?>" />   
		<?php echo $noticia33['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext"  id="itm" name="txtvariety" style="width:170px;" onChange="modetchk1(this.value);" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
	</tr>
 <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext" id="upstp">&nbsp;<select class="tbltext" name="txtstage" style="width:100px;" onChange="verchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<!--<option value="Raw">Raw</option>
<option value="Condition">Condition</option>-->
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading">Select Lot Nos.&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a>&nbsp;<font color="#FF0000">*</font></td>
	</tr>
</table>
<br />

<div id="showlots"></div>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Loading</td></tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Loading (Unloading)</td> </tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />&nbsp;<font color="#FF0000">*  Deleted Barcode will be stored back to its original SLOC Bin</font></td></tr>
</table><br />
<input type="hidden" name="maintrid" value="<?php echo $maintrid;?>" /><input type="hidden" name="subtrid" value="0" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>