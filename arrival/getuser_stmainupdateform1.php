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


//  			main arrival table fields
if(isset($_REQUEST['a']))
{
	$a = $_REQUEST['a'];	 
}
 $maintrid=trim($_REQUEST['maintrid']);
 $subtid=trim($_REQUEST['subtrid']);
 $subsubtid=trim($_REQUEST['subsubtid']);
 
 $epid = trim($_REQUEST['ep_id']);
//exit;
	$remarks=trim($_REQUEST['txtremarks']);
	$txtarrlot=trim($_POST['txtarrlot']);
	$txtdcno=trim($_REQUEST['txtdcno']);
	$txt11=trim($_REQUEST['txt1']);
	$txtid=trim($_REQUEST['txtid']);
	$txtstfp=trim($_REQUEST['txtstfp']);
	$txtsttp=trim($_REQUEST['txtsttp']);
	$date=trim($_POST['date']);
	$txtcrop=trim($_REQUEST['txtcrop']);
	$txtvariety=trim($_REQUEST['txtvariety']);
	$barcode=trim($_REQUEST['barcode']);
	$dc=trim($_REQUEST['dcdate']);
	$remarks=str_replace("&","and",$remarks);
	$wh11=trim($_REQUEST['wh11']);
	$bin11=trim($_REQUEST['bin11']);
	$sbin11=trim($_REQUEST['sbin11']);
	$srno=trim($_REQUEST['srno']);
	$code1=trim($_REQUEST['transactionid']);
	$transactionid=trim($_REQUEST['tcode']);
	
	if($txt11=="Transport")
	{
	$txttname=trim($_REQUEST['txttname']);
	$txtlrn=trim($_REQUEST['txtlrn']);
	$txtvn=trim($_REQUEST['txtvn']);
	$txt13=trim($_REQUEST['txt13']);
	}
	else
	{
	$txttname="";
	$txtlrn="";
	$txtvn="";
	$txt14="";
	}
		
	if($txt11=="Courier")
	{
	$txtcname=trim($_REQUEST['txtcname']);
	$txtdc=trim($_REQUEST['txtdc']);
	}
	else
	{
	$txtcname="";
	$txtdc="";
	}
	if($txt11=="By Hand")
	{ 
	$txtpname=trim($_REQUEST['txtpname']);
	}
	else
	{
	$txtpname="";
	}
	$tdate=$date;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;	
if($tdate=="" || $tdate=="00-00-0000" || $tdate=="--")$tdate=date("Y-m-d");
	//frm_action=submit&txt11=By%20Hand&txt14=&txtid=1&logid=AR2&gln1=&transactionid=TAP1%2FI%2FAR2&date=23-08-2017&txtstfp=1&adddchk=&txt1=By%20Hand&txttname=&txtlrn=&txtvn=&txt13=Select&txtcname=&txtdc=&txtpname=sdfsdfsd&txtwhg1=10&vbin_1=131&vsubbin_1=2601&txtwhg1=WH&vbin_2=Bin&vsubbin_=SubBin&itmdchk=0&txtarrlot=DV91476%2F00000%2F00P%2CDV90518%2F00058%2F00P&arrbar=DP990117701%2CDP990117703%2CDP990117710%2CDI010003614%2CDI010003613%2CDI010003615&srno=3&arrtyp=packarr&txtlot1=&txtlotnoid=&barcode=DI010003615&brflg=&brchflg=0&delbarcode=&upkbarcode=&txtlot11=&txtlotnoid=&maintrid=0&subtrid=0&ep_id=5&txtremarks=
		
$z1=$maintrid;		
//echo "select * from tbl_stlotimp_packsubsub where stlotimpps_barcode='".$barcode."' and stlotimpps_arrflg=0 ";
//exit;
$sql_barcode=mysqli_query($link,"select * from tbl_stlotimp_packsubsub where stlotimpps_barcode='".$barcode."' and stlotimpps_arrflg=0 and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_barcode=mysqli_num_rows($sql_barcode);
while($row_barcode=mysqli_fetch_array($sql_barcode))
{		

	$sql_sub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpps_id='".$row_barcode['stlotimpps_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_sub);
	$row_sub=mysqli_fetch_array($sql_sub);
	
	$bartype=$row_barcode['stlotimpps_barcodetype'];
	$lotnop=$row_barcode['stlotimpps_nop'];
	$lotqty=$row_barcode['stlotimpps_qty'];
	$barqty=$row_barcode['stlotimpps_netwt'];
	$grswt=$row_barcode['stlotimpps_grosswt'];
	
	$crop=$row_sub['stlotimpp_crop'];
	$variety=$row_sub['stlotimpp_variety'];
	$lotno=$row_sub['stlotimpp_lotno'];
	
	$nop=$row_sub['stlotimpp_nop'];
	$loosenop=$row_sub['stlotimpp_loosenop'];
	$nomp=$row_sub['stlotimpp_nomp'];
	$qty=$row_sub['stlotimpp_qty'];
	
	$arrnop=$row_sub['stlotimpp_arrnop'];
	$arrnomp=$row_sub['stlotimpp_arrnomp'];
	$arrqty=$row_sub['stlotimpp_arrqty'];
	
	$arrnop=$arrnop+$row_barcode['stlotimpps_nop'];
	$arrnomp=$arrnomp+1;
	$arrqty=$arrqty+$row_barcode['stlotimpps_qty'];
	//$balloosenop=$loosenop;
	$balnop=$nop-$arrnop;
	$balnomp=$nomp-$arrnomp;
	$balqty=$qty-$arrqty;
	
	$qcpacktyp=$row_sub['stlotimpp_qcpacktype'];
	$pklable1=$row_sub['stlotimpp_lableno1'];
	$qcpackdate=$row_sub['stlotimpp_qcpackdate'];
	$qc=$row_sub['stlotimpp_qc'];
	$moist=$row_sub['stlotimpp_moist'];
	$germ=$row_sub['stlotimpp_germ'];
	$pp=$row_sub['stlotimpp_pp'];
	$gottype=$row_sub['stlotimpp_gottype'];
	$got=$row_sub['stlotimpp_got'];
	$ups=$row_sub['stlotimpp_ups'];
	$wtmp=$row_sub['stlotimpp_wtmp'];
	$srstatus=$row_sub['stlotimpp_srstatus'];
	$srtype=$row_sub['stlotimpp_srtype'];
	$ssrstatus=$row_sub['stlotimpp_ssrstatus'];
	$ssrtype=$row_sub['stlotimpp_ssrtype'];
	
	$dot=$row_sub['stlotimpp_dot'];
	$dogt=$row_sub['stlotimpp_dogt'];
	$dop=$row_sub['stlotimpp_dop'];
	$dov=$row_sub['stlotimpp_dov'];
	
	$wh=""; $bin=""; $sbin="";
	for($i=1;$i<$srno;$i++)
	{
		$txtarrlot1="txtlot_".$i;
		if(isset($_REQUEST[$txtarrlot1])) { $txtarrlot=$_REQUEST[$txtarrlot1]; }
		if($txtarrlot==$lotno)
		{ 
			if($sbin=="")
			{
				$whg="txtwhg_".$i;
				$vbin="vbin_".$i;
				$vsubbin="vsubbin_".$i;
				
				if(isset($_REQUEST[$whg])) { $wh=$_REQUEST[$whg]; }
				if(isset($_REQUEST[$vbin])) { $bin=$_REQUEST[$vbin]; }
				if(isset($_REQUEST[$vsubbin])) { $sbin=$_REQUEST[$vsubbin]; }
			}
		}
	}
	
	//echo $wh." - ".$bin." - ".$sbin;
	//echo $wh11." - ".$bin11." - ".$sbin11;
	//exit;
	$zzz=str_split($txtlotp);
	$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];
	
	$sql_main=mysqli_query($link,"select * from tbl_stlotimp_pack where stlotimpp_id='".$row_sub['stlotimpp_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$tot_main=mysqli_num_rows($sql_main);
	$row_main=mysqli_fetch_array($sql_main);
	$plantname=$row_main['stlotimpp_ssrtype'];
	$stdn=$row_main['stlotimpp_stdnno'];
	
	$stdndate=$row_main['stlotimpp_stdndate'];
	
if($z1 == 0)
{
	$sql_main="insert into tbl_arrpack (arrpack_yearcode, arrpack_tcode, arrpack_date, arrpack_stdn, arrpack_stdndate, arrpack_plantname, arrpack_plantcode, arrpack_tmode, arrpack_transname, arrpack_lrno, arrpack_vehno, arrpack_paymode, arrpack_couriername, arrpack_docketno, arrpack_pname, arrpack_remarks, arrpack_logid, stlotimpp_id, arrpack_arrtrflg, plantcode) values ('$yearid_id', '$transactionid', '$tdate', '$stdn', '$stdndate', '$plantname', '$txtstfp', '$txt11', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$txtremarks', '$logid', '$epid', '2', '$plantcode')";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);
		 
		$sql_sub="insert into tbl_arrpack_sub (arrpack_id, arrpacks_crop, arrpacks_variety, arrpacks_lotno, arrpacks_pklable1, arrpacks_ups, arrpacks_eloosenop, arrpacks_enop, arrpacks_enomp, arrpacks_eqty, arrpacks_nop, arrpacks_nomp, arrpacks_qty, arrpacks_balloosenop, arrpacks_balnop, arrpacks_balnomp, arrpacks_balqty, arrpacks_packqc, arrpacks_packqcdate, arrpacks_qcstatus, arrpacks_qcdot, arrpacks_pp, arrpacks_moist, arrpacks_germ, arrpacks_gotstatus, arrpacks_gotdate, arrpacks_dop, arrpacks_dov, arrpacks_wtmp, arrpacks_srtype, arrpacks_srstatus, arrpacks_ssrtype, arrpacks_ssrstatus, plantcode) values('$mainid', '$crop', '$variety', '$lotno', '$pklable1', '$ups', '$loosenop', '$nop', '$nomp', '$qty', '$arrnop', '$arrnomp', '$arrqty', '$balloosenop', '$balnop', '$balnomp', '$balqty', '$qcpacktyp', '$qcpackdate', '$qc', '$dot', '$pp', '$moist', '$germ', '$got', '$dogt', '$dop', '$dov', '$wtmp', '$srtype', '$srstatus', '$ssrtype', '$ssrstatus', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			
			$sql_sub_sub="insert into tbl_arrpack_subsub (arrpack_id, arrpacks_id, arrpackss_lotno, arrpackss_whid, arrpackss_binid, arrpackss_subbinid, arrpackss_nop, arrpackss_nomp, arrpackss_qty, arrpackss_status, plantcode) values('$mainid', '$subid', '$lotno', '$wh', '$bin', '$sbin',  '$arrnop', '$arrnomp', '$arrqty', '$balqty1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			$subsubid=mysqli_insert_id($link);
			
			$sql_sub_sub="insert into tbl_arrpack_barcode (arrpackss_id, arrpacks_id, arrpack_id, arrpackss2_lotno, arrpackss2_bartype, arrpackss2_barcode, arrpackss2_lotnop, arrpackss2_lotqty, arrpackss2_barqty, arrpackss2_grosswt, arrpackss2_arrflg, plantcode) values('$subsubid', '$subid', '$mainid', '$lotno', '$bartype', '$barcode',  '$lotnop', '$lotqty', '$barqty', '$grswt', '1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
		
		}
	}
	$sql_impsub="update tbl_stlotimp_pack_sub set stlotimpp_arrnop='$arrnop', stlotimpp_arrnomp='$arrnomp', stlotimpp_arrqty='$arrqty', stlotimpp_balnop='$balnop', stlotimpp_balnomp='$balnomp', stlotimpp_balqty='$balqty' where stlotimpp_id='$epid' and stlotimpp_lotno='".$lotno."' ";
	mysqli_query($link,$sql_impsub) or die(mysqli_error($link));
	$z1=$mainid; $subtid=$subid; $subsubtid=$subsubid;
}
else
{//echo "select * from tbl_arrpack_sub where arrpacks_lotno='".$lotno."' and arrpack_id='".$z1."' ";
	$sql_arrsub=mysqli_query($link,"select * from tbl_arrpack_sub where arrpacks_lotno='".$lotno."' and arrpack_id='".$z1."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$tot_arrsub=mysqli_num_rows($sql_arrsub);
	$row_arrsub=mysqli_fetch_array($sql_arrsub);
	$subtid=$row_arrsub['arrpacks_id'];
	if($tot_arrsub==0)
	{
		 $sql_sub="insert into tbl_arrpack_sub (arrpack_id, arrpacks_crop, arrpacks_variety, arrpacks_lotno, arrpacks_pklable1, arrpacks_ups, arrpacks_eloosenop, arrpacks_enop, arrpacks_enomp, arrpacks_eqty, arrpacks_nop, arrpacks_nomp, arrpacks_qty, arrpacks_balloosenop, arrpacks_balnop, arrpacks_balnomp, arrpacks_balqty, arrpacks_packqc, arrpacks_packqcdate, arrpacks_qcstatus, arrpacks_qcdot, arrpacks_pp, arrpacks_moist, arrpacks_germ, arrpacks_gotstatus, arrpacks_gotdate, arrpacks_dop, arrpacks_dov, arrpacks_wtmp, arrpacks_srtype, arrpacks_srstatus, arrpacks_ssrtype, arrpacks_ssrstatus, plantcode) values('$z1', '$crop', '$variety', '$lotno', '$pklable1', '$ups', '$loosenop', '$nop', '$nomp', '$qty', '$arrnop', '$arrnomp', '$arrqty', '$balloosenop', '$balnop', '$balnomp', '$balqty', '$qcpacktyp', '$qcpackdate', '$qc', '$dot', '$pp', '$moist', '$germ', '$got', '$dogt', '$dop', '$dov', '$wtmp', '$srtype', '$srstatus', '$ssrtype', '$ssrstatus', '$plantcode')";
		
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
		$subid=mysqli_insert_id($link);
		
		$sql_sub_sub="insert into tbl_arrpack_subsub (arrpack_id, arrpacks_id, arrpackss_lotno, arrpackss_whid, arrpackss_binid, arrpackss_subbinid, arrpackss_nop, arrpackss_nomp, arrpackss_qty, arrpackss_status, plantcode) values('$mainid', '$subid', '$lotno', '$wh', '$bin', '$sbin',  '$arrnop', '$arrnomp', '$arrqty', '$balqty1', '$plantcode')";
		mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
		$subsubid=mysqli_insert_id($link);
		$subtid=$subid;
	}	
	else
	{
		$sql_sub="update tbl_arrpack_sub set arrpacks_nop='$arrnop', arrpacks_nomp='$arrnomp', arrpacks_qty='$arrqty', arrpacks_balnop='$balnop', arrpacks_balqty='$balqty' where arrpacks_id='$subtid' ";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
//echo $sbin."==".$sbin11;
//exit;
		if($sbin==$sbin11)
		{
			$sql_sub_sub="update tbl_arrpack_subsub set arrpackss_nop='$arrnop', arrpackss_nomp='$arrnomp', arrpackss_qty='$arrqty' where arrpacks_id='".$subtid."'";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
		}
		else
		{
			$sql_sub_sub="insert into tbl_arrpack_subsub (arrpack_id, arrpacks_id, arrpackss_lotno, arrpackss_whid, arrpackss_binid, arrpackss_subbinid, arrpackss_nop, arrpackss_nomp, arrpackss_qty, arrpackss_status, plantcode) values('$z1', '$subtid', '$lotno', '$wh', '$bin', '$sbin', '$arrnop', '$arrnomp', '$arrqty', '$balqty1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			$subsubid=mysqli_insert_id($link);
		}
	}
	
	$sql_sub_sub="insert into tbl_arrpack_barcode (arrpackss_id, arrpacks_id, arrpack_id, arrpackss2_lotno, arrpackss2_bartype, arrpackss2_barcode, arrpackss2_lotnop, arrpackss2_lotqty, arrpackss2_barqty, arrpackss2_grosswt, arrpackss2_arrflg, plantcode) values('$subsubid', '$subtid', '$z1', '$lotno', '$bartype', '$barcode',  '$lotnop', '$lotqty', '$barqty', '$grswt', '1', '$plantcode')";
	mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
	
	$sql_impsub="update tbl_stlotimp_pack_sub set stlotimpp_arrnop='$arrnop', stlotimpp_arrnomp='$arrnomp', stlotimpp_arrqty='$arrqty', stlotimpp_balnop='$balnop', stlotimpp_balnomp='$balnomp', stlotimpp_balqty='$balqty' where stlotimpp_id='$epid' and stlotimpp_lotno='".$lotno."' ";
	mysqli_query($link,$sql_impsub) or die(mysqli_error($link));

}
}


$tid=$z1; 
?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"><span class="Subheading">Arrival Pack Seed Stock Transfer - Plant</span></td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font> indicates required field&nbsp;</td></tr>
<?php 
$sql_arr=mysqli_query($link,"select * from tbl_arrpack where arrpack_id='$tid' and arrpack_arrtrflg=0 ") or die(mysqli_error($link));
$tot_arr=mysqli_num_rows($sql_arr);
$row_arr=mysqli_fetch_array($sql_arr);
?>
 <tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAP".$row_arr['arrpack_tcode']."/".$yearid_id."/".$lgnid;?><input type="hidden" class="tbltext" name="transactionid" value="<?php echo $row_arr['arrpack_tcode'];?>" /> </td>

<td width="192" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<?php
//echo "select * from tbl_stlotimp_pack where stlotimpp_id='$epid' and stlotimpp_trflg!=1 ";
$sql_arr_home=mysqli_query($link,"select * from tbl_stlotimp_pack where stlotimpp_id='$epid' and stlotimpp_trflg!=1 and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_arr_home=mysqli_fetch_array($sql_arr_home);
//echo "SELECT p_id, business_name FROM tbl_partymaser where stcode='".$row_arr_home['stlotimpp_plantcode']."'";
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where stcode='".$row_arr_home['stlotimpp_plantcode']."'"); 
$noticia = mysqli_fetch_array($quer3);
?>
 <tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="tbltext" name="txtstfp" value="<?php echo $noticia['p_id'];?>" />   
		
</td>
  </tr>
<!--<td width="159" align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
<td width="228" align="left"  valign="middle" class="tbltext">&nbsp;
  <input name="txtsttp" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $plname.", ".$city1;?>" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<?php echo $noticia['address'];?>,<?php echo $noticia['city'];?>,<?php echo $noticia['state'];?><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<!--<tr class="Light" height="30">

	<td align="right"  valign="middle" class="tblheading">STN&nbsp;No.&nbsp;</td>
  <td width="228" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->
 
<?php 
$ptid=$row_arr['arrpack_id'];
//echo "SELECT * FROM tbl_arrpack where arrpack_id='".$tid."'";
$sql_transitmode=mysqli_query($link,"SELECT * FROM tbl_arrpack where arrpack_id='".$tid."' and plantcode='$plantcode'");
$row_transitmode = mysqli_fetch_array($sql_transitmode);
?>
<tr class="Light" height="25">
<td width="230" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" <?php if($row_transitmode['arrpack_tmode']=="Transport") echo "checked"; ?> />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" <?php if($row_transitmode['arrpack_tmode']=="Courier") echo "checked"; ?> />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_transitmode['arrpack_tmode']=="By Hand") echo "checked"; ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txt11" value="<?php echo $row_transitmode['arrpack_tmode'];?>" type="hidden"></td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_transitmode['arrpack_tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>; width:850">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td width="262" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input name="txttname" type="text" size="25" class="smalltbltext" tabindex="" maxlength="25" value="<?php echo $row_transitmode['arrpack_transname'];?>"></td>
<td width="193" align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="smalltbltext" tabindex=""  maxlength="15" value="<?php echo $row_transitmode['arrpack_lrno'];?>" ></td>
</tr>

<tr class="Light" height="25">
<td width="229" align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td width="262" align="left" valign="middle" class="smalltbltext" >&nbsp;
  <input name="txtvn" type="text" size="12" class="smalltbltext" tabindex="" maxlength="12" value="<?php echo $row_transitmode['arrpack_vehno'];?>" ></td>
<td width="193" align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txt13" style="width:70px;"  >
<option value="" selected="selected">Select</option>
<option <?php if($row_transitmode['arrpack_paymode']=="TBB")echo "Selected";?> value="TBB">TBB</option>
<option <?php if($row_transitmode['arrpack_paymode']=="To Pay")echo "Selected";?> value="To Pay" >To Pay</option>
<option <?php if($row_transitmode['arrpack_paymode']=="Paid")echo "Selected";?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_transitmode['arrpack_tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td width="263" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="txtcname" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20" value="<?php echo $row_transitmode['arrpack_couriername'];?>" ></td>
<td width="193" align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15" value="<?php echo $row_transitmode['arrpack_docketno'];?>" ></td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_transitmode['arrpack_tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td width="716" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="txtpname" type="text" size="30" class="smalltbltext" tabindex=""  maxlength="30" value="<?php echo $row_transitmode['arrpack_pname'];?>" ></td>
</tr>
</table>
</div>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
	<td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="6%" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
	<td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">Ups</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Dispatch</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Received</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
	<td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">QC</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">SLOC</td>
	<!--<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>-->
</tr>
<tr class="tblsubtitle">
	<td width="3%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="3%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="3%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="10%" align="center" valign="middle" class="tblheading">WH</td>
	<td width="10%" align="center" valign="middle" class="tblheading">Bin</td>
	<td width="10%" align="center" valign="middle" class="tblheading">SubBin</td>
	<td width="7%" align="center" valign="middle" class="tblheading"></td>
</tr>
<?php 
$srno=1; 
$sql_impsub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_impsub=mysqli_num_rows($sql_impsub);
while($row_impsub=mysqli_fetch_array($sql_impsub))
{
	$crop=""; $variety=""; $lotno=""; $dispnop=""; $dispnomp=""; $dispqty=""; $recnop=""; $recnomp=""; $recqty=""; $balnop=""; $balnomp=""; $balqty=""; $qc=""; $pp=""; $moist="";$germ=""; $gottyp=""; $gotstatus="";	
	
$crop=$row_impsub['stlotimpp_crop']; 
$variety=$row_impsub['stlotimpp_variety']; 
$lotno=$row_impsub['stlotimpp_lotno']; 
$dispnop=$row_impsub['stlotimpp_nop']; 
$dispnomp=$row_impsub['stlotimpp_nomp']; 
$dispqty=$row_impsub['stlotimpp_qty']; 
$recnop=$row_impsub['stlotimpp_arrnop']; 
$recnomp=$row_impsub['stlotimpp_arrnomp']; 
$recqty=$row_impsub['stlotimpp_arrqty']; 
$balnop=$row_impsub['stlotimpp_balnop']; 
$balnomp=$row_impsub['stlotimpp_balnomp']; 
$balqty=$row_impsub['stlotimpp_balqty']; 
$qc=$row_impsub['stlotimpp_qc']; 
$ups=$row_impsub['stlotimpp_ups']; 
$moist=$row_impsub['stlotimpp_moist'];
$germ=$row_impsub['stlotimpp_germ']; 
$gottyp=$row_impsub['stlotimpp_gottype']; 
$gotstatus=$row_impsub['stlotimpp_got'];

$wh1=""; $bin=""; $subbin="";
//echo "select * from tbl_arrpack_subsub where arrpack_id='".$tid."' and arrpackss_lotno='".$lotno."' ";
$sql_arrsloc=mysqli_query($link,"select * from tbl_arrpack_subsub where arrpack_id='".$tid."' and arrpackss_lotno='".$lotno."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_arrsloc=mysqli_num_rows($sql_impsub);
while($row_arrsloc=mysqli_fetch_array($sql_arrsloc))
{ $whid=$row_arrsloc['arrpackss_whid']; $binid=$row_arrsloc['arrpackss_binid']; $subbinid=$row_arrsloc['arrpackss_subbinid'];
	$whd1=mysqli_query($link,"select * from tbl_warehouse where whid='".$row_arrsloc['arrpackss_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
	$row_whd1=mysqli_fetch_array($whd1);
	
	$bin1=mysqli_query($link,"select * from tbl_bin where binid='".$row_arrsloc['arrpackss_binid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_bin1=mysqli_fetch_array($bin1);
	
	$subbin1=mysqli_query($link,"select * from tbl_subbin where sid='".$row_arrsloc['arrpackss_subbinid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_subbin1=mysqli_fetch_array($subbin1);
	
	if($wh1=="")
		$wh1=$row_whd1['perticulars'];
	/*else
		$wh1=$wh1."<br />".$row_whd1['perticulars'];*/
	
	if($bin=="") 
		 $bin=$row_bin1['binname'];
	
	 if($subbin=="")
		$subbin=$row_subbin1['sname'];
}

$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));	


?>

<tr class="Light" height="20">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?><input type="hidden" name="txtlot_<?php echo $srno;?>" value="<?php echo $lotno;?>" /></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $dispnop;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $dispnomp;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $dispqty;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $recnop;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $recnomp;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $recqty;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $balnop;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnomp;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="10%" align="left" valign="middle" class="smalltbltext" id="wh<?php echo $srno;?>">&nbsp;
	    <?php if($wh1!="") {echo $wh1;?>
	    <input type="hidden" name="txtwhg_<?php echo $srno?>" id="txtwhg_<?php echo $srno?>" value="<?php echo $whid?>" />
      <?php }else{?>
	  <select class="smalltbltext" id="txtwhg_<?php echo $srno?>" name="txtwhg_<?php echo $srno?>" style="width:70px;" onchange="wh(this.value,'<?php echo $srno?>');"  >
  <option value="" selected>WH</option>
	    <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
	    <option value="<?php echo $noticia_whd1['whid'];?>" >   
	      <?php echo $noticia_whd1['perticulars'];?></option>
	    <?php } ?>
    </select><?php }?></td><td width="10%" align="left" valign="middle" class="smalltbltext" id="bin<?php echo $srno;?>">&nbsp;<?php if($bin!="") {echo $bin;?><input type="hidden" name="vbin_<?php echo $srno;?>" id="vbin_<?php echo $srno;?>" value="<?php echo $binid?>" /><?php }else{?><select class="smalltbltext" id="vbin_<?php echo $srno;?>" name="vbin_<?php echo $srno;?>" style="width:60px;" onchange="bin2(this.value,'<?php echo $srno?>');" >
<option value="" selected>Bin</option>
		</select><?php }?></td>
		
	<td width="10%" align="left" valign="middle" class="smalltbltext" id="subbin<?php echo $srno;?>">&nbsp;<?php if($subbin!="") {echo $subbin;?><input type="hidden" name="vsubbin_<?php echo $srno;?>" id="vsubbin_<?php echo $srno;?>" value="<?php echo $subbinid?>" /><?php }else{?><select class="smalltbltext" id="vsubbin_<?php echo $srno;?>" name="vsubbin_<?php echo $srno;?>" style="width:60px;" onchange="bin5(this.value,<?php echo $srno?>);"  >
<option value="" selected>SubBin</option>
		</select><?php }?></td>
		
		<td width="7%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="newsloc('<?php echo $srno?>')">NEW SLOC</a></td>
</tr>
<?php
if($arrlot=="")
	$arrlot=$lotno;
else
	$arrlot=$arrlot.",".$lotno;	 
$srno++;
}
$subtbltot=0;
$arrbar="";
$sql_impbar=mysqli_query($link,"select * from tbl_stlotimp_packsubsub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
while($row_impbar=mysqli_fetch_array($sql_impbar))
{
	if($arrbar=="")
		$arrbar=$row_impbar['stlotimpps_barcode'];
	else
		$arrbar=$arrbar.",".$row_impbar['stlotimpps_barcode'];
}
?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
<input type="hidden" name="txtarrlot" value="<?php echo $arrlot;?>" />
<input type="hidden" name="arrbar" value="<?php echo $arrbar;?>" />
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
<br/>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Type</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
<td width="714" align="left"  valign="middle" class="tbltext">&nbsp;<select class="smalltbltext" id="arrtyp" name="arrtyp" style="width:130px;" onchange="packarr(this.value);" >
<option value="packarr" selected>Packaged Arrival</option>
<option value="unpackarr" >Un-Packaged Arrival</option>
</select></td>

<td width="230"  align="right"  valign="middle" class="tblheading">Sub Types&nbsp;</td>
<td width="714" align="left"  valign="middle" class="tbltext">&nbsp;<select class="smalltbltext" id="arrsubtyp" name="arrsubtyp" style="width:130px;" onchange="packarrsub(this.value);" disabled="disabled" >
<option value="" selected>--Select--</option>
<option value="NoP" >Expected NoP</option>
<option value="NoP With Barcode" >Arrived NoP With Barcode</option>
<option value="NoP Without Barcode" >Arrived NoP Without Barcode</option>
</select>
</td></tr>
</table><br />
<div id="upknop" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpopp();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table><br /></div>
<div id="get" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="12">Post Form</td>
</tr>
<tr class="Dark" height="25">
<td width="51"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td width="108" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="98" align="right"  valign="middle" class="tblheading">Planned Nop&nbsp;</td>
<td width="83" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="pnop" id="pnop" size="4" class="smalltbltext" tabindex="0" value="" readonly="true" style="background-color:#CCCCCC" /></td>

<td width="69"  align="right"  valign="middle" class="tblheading">Enter Nop&nbsp;</td>
<td width="59" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="arrnop" id="arrnop" size="4" class="smalltbltext" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td>
<td width="45" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="93" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="qty" id="qty" size="9" class="smalltbltext" tabindex="0" value="" readonly="true" style="background-color:#CCCCCC" /></td>

<td width="58" align="right"  valign="middle" class="tblheading">NoMP&nbsp;</td>
<td width="72" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="nomp" id="nomp" size="4" class="smalltbltext" tabindex="0" value="" readonly="true" style="background-color:#CCCCCC" /></td>
  
<td width="53" align="right"  valign="middle" class="tblheading">Barcde&nbsp;</td>
<td width="135" align="left"  valign="middle" class="smalltbltext">&nbsp;
&nbsp;
	  <select class="smalltbltext" id="txtwhg_<?php echo $srno?>" name="txtwhg1" style="width:110px;" onchange="wh(this.value,'<?php echo $srno?>');"  >
<option value="" selected>Select</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>
 </td>
</tr>
</table><br />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0" style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<div id="bardiv">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Arrival</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="sloccheck(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Arrival</td> </tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />
&nbsp;<font color="#FF0000"></font></td>
</tr>
</table><br /></div>

<div id="nopwbar" style="display:none">
<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Arrival</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />-->

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Unpackaging</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Unpackaged Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="upkbarcode" id="upkbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br /></div>

<div id="upknopnobar" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot11" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpopp1();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails1();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table><br />

<div id="upklotinfo">

</div>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="subsubtid" value="<?php echo $subsubtid;?>" />
<input type="hidden" name="ep_id" value="<?php echo $epid?>" />
<input type="hidden" name="wh11" value="<?php echo $wh?>" />
<input type="hidden" name="bin11" value="<?php echo $bin?>" />
<input type="hidden" name="sbin11" value="<?php echo $sbin?>" />