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

if($logid=="" && $lgnod!="") $logid=$lgnid;
if($logid=="" && $lgnod=="") $logid='DP1';
if($yearid_id=="")
{
	$sq_yr=mysqli_query($link,"Select * from tbl_lgenyear where plantcode='".$plantcode."' order by lgenyearid desc") or Die(mysqli_error($link));
	$row_yr=mysqli_fetch_array($sq_yr);
	$yearid_id=$row_yr['lgenyearcode'];
}

//frm_action=submit&txt14=&txtid=51&logid=DP1&plantcodes=D&yearcodes=I&code1=TDS51%2FI%2FDP1&date=03-07-2017&txttoplant=401&txt1=Transport&txt11=Transport&txttname=dasdsad&txtlrn=qweqw2323&txtvn=3242&txt13=TBB&txtcname=&txtdc=&txtpname=&txtcrop=51&txtvariety=528&txtstage=100.000%20Gms&txtlot1=DI90298%2F00000%2F00P&ups=100.000&upstyp=Gms&wtmp=&enop=68&enomp=64&eqty=646.8&txtalnop=0&txtalnomp=0&txtalqty=&txtavlnop=64&txtavlnomp=64&txtavlqty=646.8&txttobenop=10&txttobenomp=1&txttobeqty=10&loadnop=68&loadnomp=68&enob=&balloadnop=68&balloadnomp=68&balloadqty=68&balnop=NaN&balnomp=63&balqty=636.800&sn=2&barcode=DI010007092&delbarcode=&maintrid=0&subtrid=0&txtremarks=

if(isset($_REQUEST['code1'])) {  $code1=$_REQUEST['code1']; }
if(isset($_REQUEST['date'])) {  $date=$_REQUEST['date']; }

if(isset($_REQUEST['txttoplant'])) {  $toplant=$_REQUEST['txttoplant']; }

if(isset($_REQUEST['enop'])) {  $enop=$_REQUEST['enop']; }
if(isset($_REQUEST['enomp'])) {  $enomp=$_REQUEST['enomp']; }
if(isset($_REQUEST['eqty'])) {  $eqty=$_REQUEST['eqty']; }

if(isset($_REQUEST['txtalnop'])) {  $alnop=$_REQUEST['txtalnop']; }
if(isset($_REQUEST['txtalnomp'])) {  $alnomp=$_REQUEST['txtalnomp']; }
if(isset($_REQUEST['txtalqty'])) {  $alqty=$_REQUEST['txtalqty']; }

if(isset($_REQUEST['txtavlnop'])) {  $avlnop=$_REQUEST['txtavlnop']; }
if(isset($_REQUEST['txtavlnomp'])) {  $avlnomp=$_REQUEST['txtavlnomp']; }
if(isset($_REQUEST['txtavlqty'])) {  $avlqty=$_REQUEST['txtavlqty']; }

if(isset($_REQUEST['txttobenop'])) {  $tobenop=$_REQUEST['txttobenop']; }
if(isset($_REQUEST['txttobenomp'])) {  $tobenomp=$_REQUEST['txttobenomp']; }
if(isset($_REQUEST['txttobeqty'])) {  $tobeqty=$_REQUEST['txttobeqty']; }

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

if(isset($_REQUEST['txt1'])) {  $modeoftransit=$_REQUEST['txt1'];	}
if(isset($_REQUEST['txttname'])) {  $tname=$_REQUEST['txttname']; }
if(isset($_REQUEST['txtlrn'])) {  $lrn=$_REQUEST['txtlrn']; }
if(isset($_REQUEST['txtvn'])) {  $vehicleno=$_REQUEST['txtvn']; }
if(isset($_REQUEST['txt13'])) {  $paymode=$_REQUEST['txt13']; }
if(isset($_REQUEST['barcode'])) {  $barcode=$_REQUEST['barcode']; }
if(isset($_REQUEST['delbarcode'])) {  $delbarcode=$_REQUEST['delbarcode']; }
if(isset($_REQUEST['sn'])) { $sn=$_REQUEST['sn']; }
if(isset($_REQUEST['sno1'])) { $sno1=$_REQUEST['sno1']; }
if(isset($_REQUEST['srno2'])) { $srno2=$_REQUEST['srno2']; }

if(isset($_REQUEST['txt11'])) { $txt11=$_REQUEST['txt11']; }
if(isset($_REQUEST['txtcname'])) { $cname=$_REQUEST['txtcname']; }
if(isset($_REQUEST['txtdc'])) { $dcno=$_REQUEST['txtdc']; }
if(isset($_REQUEST['txtpname'])) { $pname=$_REQUEST['txtpname']; }

if(isset($_REQUEST['txtcrop'])) {  $txtcrop=$_REQUEST['txtcrop']; }
if(isset($_REQUEST['txtvariety'])) {  $txtvariety=$_REQUEST['txtvariety']; }
if(isset($_REQUEST['txtstage'])) {  $stage=$_REQUEST['txtstage']; }
if(isset($_REQUEST['txtlot1'])) {  $txtlot1=$_REQUEST['txtlot1']; }
if(isset($_REQUEST['txtlonomp'])) {  $txtlonomp=$_REQUEST['txtlonomp']; }
if(isset($_REQUEST['txtorblnomp'])) {  $txtorblnomp=$_REQUEST['txtorblnomp']; }


if(isset($_REQUEST['brflg'])) { $brflg=$_REQUEST['brflg']; }
if(isset($_REQUEST['brchflg'])) { $brchflg=$_REQUEST['brchflg']; }

$remarks=trim($_REQUEST['txtremarks1']);
$remarks=str_replace("&","and",$remarks);
			
if(isset($_REQUEST['maintrid'])) {  $maintrid=$_REQUEST['maintrid']; }
if(isset($_REQUEST['subtrid'])) {  $subtrid=$_REQUEST['subtrid']; }
//exit;
if(isset($_REQUEST['subsubtrid'])) { $subsubtrid=$_REQUEST['subsubtrid']; }

$sql_para=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' "); 
$row_para=mysqli_fetch_array($sql_para);
$frmplantcode=$row_para['code'];
//echo "SELECT * FROM tbl_partymaser  where classification='Stock Transfer-Plant' and p_id='".$toplant."' order by classification";
$quer=mysqli_query($link,"SELECT * FROM tbl_partymaser  where classification='Stock Transfer-Plant' and p_id='".$toplant."' order by classification");
$row_quer = mysqli_fetch_array($quer);
$toplantcode=$row_quer['stcode'];
$plantname=$row_quer['business_name'];

$sql_lable=mysqli_query($link,"SELECT * FROM tbl_lot_ldg_pack  where plantcode='".$plantcode."' and lotno='".$txtlot1."' order by lotdgp_id desc limit 0,1");
$row_lable=mysqli_fetch_array($sql_lable);

$lable=$row_lable['packlabels'];
$qcdate=$row_lable['lotldg_qctestdate'];
$qcstatus=$row_lable['lotldg_qc'];

$qcpackdate="";
if($row_lable['lotldg_rvflg']==1)
{
	$sql_rv=mysqli_query($link,"SELECT * FROM tbl_revalidate where plantcode='".$plantcode."' and rv_newlot='".$txtlot1."'" );
	$row_rv=mysqli_fetch_array($sql_rv);
	$qcpackdate=$row_rv['rv_date'];
}
$sql_pnps=mysqli_query($link,"SELECT * FROM tbl_pnpslipsub where plantcode='".$plantcode."' and pnpslipsub_plotno='".$txtlot1."' order by pnpslipsub_id asc");
$row_pnps=mysqli_fetch_array($sql_pnps);
$qcpacktyp=$row_pnps['pnpslipsub_qcdttype'];

if($qcpackdate=="" || $qcpackdate=="0000-00-00")
$qcpackdate=$row_pnps['pnpslipsub_qcdot'];

$sql_pp=mysqli_query($link,"SELECT * FROM tbl_qctest where plantcode='".$plantcode."' and oldlot='".$row_lable['orlot']."' order by tid desc limit 0,1");
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
	$sql_softrs=mysqli_query($link,"SELECT * FROM tbl_softr_sub where plantcode='".$plantcode."' and softrsub_lotno='".$row_lable['orlot']."' order by softrsub_id desc limit 0,1");
	$row_softrs=mysqli_fetch_array($sql_softrs);
	$srstatus="Yes";
	$srtyp=$row_softrs['softrsub_srtyp'];
	
	$sql_softrs2=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 where plantcode='".$plantcode."' and softrsub_lotno='".$row_lable['orlot']."' order by softrsub_id desc limit 0,1");
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
	
	$sql_batype=mysqli_query($link,"SELECT * FROM tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$barcode."' ");
	$row_batype=mysqli_fetch_array($sql_batype);
	
	$lot=$row_batype['mpmain_lotno'];
	$lots=explode(",",$lot);
	$lotscnt=count($lots);
	
	if($row_batype['mpmain_trtype']=="PACKSMC")
	$bartyp="SMC";
	if($row_batype['mpmain_trtype']=="PACKNMC")
	$bartyp="NMC";
	if($row_batype['mpmain_trtype']=="PACKLMC")
	$bartyp="LMC";
	if($row_batype['mpmain_trtype']=="PACKNLC")
	$bartyp="NLC";
	
	$lotsnop=$row_batype['mpmain_mptnop'];
	if($lotsnop==0)
	{
		$up1=$row_batype['mpmain_upssize'];
		$zx=explode(" ",$up1);
		if($zx[1]=="Gms")
		{ 
			$ptp=(1000/$zx[0]);
			$ptp1=($zx[0]/1000);
			$lotsnop=$ptp*$row_batype['mpmain_upssize'];
		}
		else
		{
			if($zx[0]<1)
			{
				$ptp=(1000/$zx[0])/1000;
				$ptp1=($zx[0]/1000)*1000;
				$lotsnop=$ptp*$row_batype['mpmain_upssize'];
			}
			else
			{
				$ptp=$packtp2[0];
				$ptp1=$packtp2[0];
				$lotsnop=$ptp/$row_batype['mpmain_upssize'];
			}
			
		}
	}
	$stage=$row_batype['mpmain_upssize'];
	$lotsnop=explode(",",$lotsnop);
	
	$stage1=explode(" ",$stage);
	$stage11=$stage1[0];
	$stage12=$stage1[1];
	
if($z1 == 0)
{
	$sql_main="insert into tbl_stoutmpack(stoutmp_date, stoutmp_tcode, stoutmp_code, stoutmp_fromplant, stoutmp_toplant, stoutmp_plantid, stoutmp_plantname, stoutmp_remarks, stoutmp_tflg, stoutmp_logid, stoutmp_yearid, stoutmp_tmode, stoutmp_name, stoutmp_tname, stoutmp_lorryrepno, stoutmp_tvehno, stoutmp_paymode, stoutmp_couriername, stoutmp_docketno, stoutmp_pnamebyhand,plantcode) values ('$tdate1', '$txtid', '$txtid', '$frmplantcode', '$toplantcode', '$toplant', '$plantname', '$remarks', '2', '$logid', '$yearid_id', '$modeoftransit', '$txtcname', '$tname', '$lrn', '$vehicleno', '$paymode', '$cname', '$dcno', '$pname','$plantcode')";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);
		if($subtrid==0)
		{
			for($i=0; $i<$lotscnt; $i++)
			{
				$sql_sub="insert into tbl_stoutspack (stoutmp_id, stoutsp_crop, stoutsp_variety, stoutsp_ups, stoutsp_lotno, stoutsp_lable1, stoutsp_enop, stoutsp_enomp, stoutsp_eqty, stoutsp_avlnop, stoutsp_avlnomp, stoutsp_avlqty, stoutsp_tbnop, stoutsp_tbnomp, stoutsp_tbqty, stoutsp_loadgrswt, stoutsp_loadnomp, stoutsp_loadqty, stoutsp_balnop, stoutsp_balnomp, stoutsp_balqty, stoutsp_qcpacktype, stoutsp_qcpackdate, stoutsp_qcstatus, stoutsp_qcdate, stoutsp_pp, stoutsp_moist, stoutsp_germ, stoutsp_gottype,stoutsp_gotstatus, stoutsp_gotdate, stoutsp_wtmp, stoutsp_dop, stoutsp_dov, stoutsp_srstatus, stoutsp_srtype, stoutsp_ssrstatus, stoutsp_ssrtype, stoutsp_loosenop,plantcode) values ('$mainid', '$txtcrop', '$txtvariety', '$stage', '".$lots[$i]."', '$lable', '$enop', '$enomp', '$eqty', '$avlnop', '$avlnomp', '$avlqty','$tobenop', '$tobenomp', '$tobeqty', '$loadgrswt', '$loadnomp', '$loadqty','$balnop','$balnomp','$balqty','$qcpacktyp','$qcpackdate','$qcstatus','$qcdate','$pp','$moist','$germ','$gottype','$gotstatus','$gotdate','$wtmp','$dop','$dov','$srstatus','$srtyp','$srstatus2','$srtyp2','$enop','$plantcode')";
				if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
				{
					$sid=mysqli_insert_id($link);
					if($barcode!="")
					{
						if($stage12=="Gms")
							$qty=$stage11/1000*$lotsnop[$i];
						if($stage12=="Kgs")
							$qty=$stage11*$lotsnop[$i];
						
						$sql_lotqty=mysqli_query($link,"SELECT * FROM tbl_barcodes where plantcode='".$plantcode."' and bar_lotno='".$lots[$i]."' and bar_barcode='".$barcode."'") or die(mysqli_error($link));
						$row_lotqty=mysqli_fetch_array($sql_lotqty);
						$grswt1=$row_lotqty['bar_grosswt'];
						
						$sql_subsub="insert into tbl_stoutsspack (stoutmp_id, stoutsp_id, stoutssp_barcode, stoutssp_barcodetype, stoutssp_lotno, stoutssp_ups, stoutssp_lotnop, stoutssp_lotqty, stoutssp_nop, stoutssp_qty, stoutssp_grosswt,plantcode) values ('$mainid', '$sid', '$barcode', '$bartyp', '".$lots[$i]."', '$stage', '".$lotsnop[$i]."', '$qty', '".$lotsnop[$i]."', '$qty','$grswt1','$plantcode')";
						mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
						
						$sql_loadqty=mysqli_query($link,"SELECT * FROM tbl_stoutsspack where plantcode='".$plantcode."' and stoutssp_lotno='".$lots[$i]."' and stoutsp_id='".$sid."'") or die(mysqli_error($link));
						$loadnomp=mysqli_num_rows($sql_loadqty);
						$loadqty=0; $grswt=0;
						while($row_loadqty=mysqli_fetch_array($sql_loadqty))
						{
							$loadqty=$loadqty+$row_loadqty['stoutssp_lotqty'];
							$grswt=$grswt+$row_loadqty['stoutssp_grosswt'];
						}
						
						if($stage12=="Gms")
							$looseqty=$stage11/1000*$tobenop;
						if($stage12=="Kgs")
							$looseqty=$stage11*$tobenop;
							
						$balnomp=$tobenomp-$loadnomp;
						$balqty=$tobeqty-$looseqty-$loadqty;
						$balnop=$tobenop-$tobenop;
						$loadqty=$loadqty+$looseqty;
						
						$sql_sub2="update tbl_stoutspack set stoutsp_tbnop='$tobenop', stoutsp_tbnomp='$tobenomp', stoutsp_tbqty='$tobeqty', stoutsp_loadgrswt='$grswt', stoutsp_loadnop='$tobenop', stoutsp_loadnomp='$loadnomp', stoutsp_loadqty='$loadqty', stoutsp_balnop='$balnop', stoutsp_balnomp='$balnomp', stoutsp_balqty='$balqty' where stoutsp_lotno='".$lots[$i]."' and stoutsp_id='".$sid."'";
						mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
						
						$sql_mpmain="update tbl_mpmain set mpmain_dflg=2 where mpmain_barcode='$barcode'";
						mysqli_query($link,$sql_mpmain) or die(mysqli_error($link));
					}
				}	
			}
		}
	}
$maintrid=$mainid; 
}
else
{
	$maintrid=$z1;
	$sql_main="update tbl_stoutmpack set stoutmp_tmode='$modeoftransit', stoutmp_name='$txtcname', stoutmp_tname='$tname', stoutmp_lorryrepno='$lrn', stoutmp_tvehno='$vehicleno', stoutmp_paymode='$paymode', stoutmp_couriername='$cname', stoutmp_docketno='$dcno', stoutmp_pnamebyhand='$pname' where stoutmp_id='$z1'";
	mysqli_query($link,$sql_main) or die(mysqli_error($link));
	
	
	for($i=0; $i<$lotscnt; $i++)
	{
		$sql_lotchk=mysqli_query($link,"SELECT * FROM tbl_stoutspack where plantcode='".$plantcode."' and stoutsp_lotno='".$lots[$i]."' and stoutmp_id='".$z1."'");
		$num_lotchk=mysqli_num_rows($sql_lotchk);
		$row_lotchk=mysqli_fetch_array($sql_lotchk);
		if($num_lotchk>0)
		{
			$sid=$row_lotchk['stoutsp_id'];
			if($barcode!="")
			{
				$qty=$stage11/1000*$lotsnop[$i];
						
				$sql_lotqty=mysqli_query($link,"SELECT * FROM tbl_barcodes where plantcode='".$plantcode."' and bar_lotno='".$lots[$i]."' and bar_barcode='".$barcode."'");
				$row_lotqty=mysqli_fetch_array($sql_lotqty);
				$grswt1=$row_lotqty['bar_grosswt'];
						
				$sql_subsub="insert into tbl_stoutsspack (stoutmp_id, stoutsp_id, stoutssp_barcode, stoutssp_barcodetype, stoutssp_lotno, stoutssp_ups, stoutssp_lotnop, stoutssp_lotqty, stoutssp_nop, stoutssp_qty, stoutssp_grosswt,plantcode) values ('$z1', '$sid', '$barcode', '$bartyp', '".$lots[$i]."', '$stage', '".$lotsnop[$i]."', '$qty', '".$lotsnop[$i]."', '$qty','$grswt1','$plantcode')";
				mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
						
				$sql_loadqty=mysqli_query($link,"SELECT * FROM tbl_stoutsspack where plantcode='".$plantcode."' and stoutssp_lotno='".$lots[$i]."' and stoutsp_id='".$sid."'") or die(mysqli_error($link));
				$loadnomp=mysqli_num_rows($sql_loadqty);
				$loadqty=0; $grswt=0;
				while($row_loadqty=mysqli_fetch_array($sql_loadqty))
				{
					$loadqty=$loadqty+$row_loadqty['stoutssp_lotqty'];
					$grswt=$grswt+$row_loadqty['stoutssp_grosswt'];
				}
				if($stage12=="Gms")
					$looseqty=$stage11/1000*$tobenop;
				if($stage12=="Kgs")
					$looseqty=$stage11*$tobenop;
							
				$balnomp=$tobenomp-$loadnomp;
				$balqty=$tobeqty-$looseqty-$loadqty;
				$balnop=$tobenop-$tobenop;
				$loadqty=$loadqty+$looseqty;
				
				$sql_sub2="update tbl_stoutspack set stoutsp_tbnop='$tobenop', stoutsp_tbnomp='$tobenomp', stoutsp_tbqty='$tobeqty', stoutsp_loadgrswt='$grswt', stoutsp_loadnop='$tobenop', stoutsp_loadnomp='$loadnomp', stoutsp_loadqty='$loadqty', stoutsp_balnop='$balnop', stoutsp_balnomp='$balnomp', stoutsp_balqty='$balqty' where stoutsp_lotno='".$lots[$i]."' and stoutsp_id='".$sid."'";
				mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
						
				$sql_mpmain="update tbl_mpmain set mpmain_dflg=2 where mpmain_barcode='$barcode'";
				mysqli_query($link,$sql_mpmain) or die(mysqli_error($link));
			}
		}
		else
		{
			$sql_sub="insert into tbl_stoutspack (stoutmp_id, stoutsp_crop, stoutsp_variety, stoutsp_ups, stoutsp_lotno, stoutsp_lable1, stoutsp_enop, stoutsp_enomp, stoutsp_eqty, stoutsp_avlnop, stoutsp_avlnomp, stoutsp_avlqty, stoutsp_tbnop, stoutsp_tbnomp, stoutsp_tbqty, stoutsp_loadgrswt, stoutsp_loadnomp, stoutsp_loadqty, stoutsp_balnop, stoutsp_balnomp, stoutsp_balqty, stoutsp_qcpacktype, stoutsp_qcpackdate, stoutsp_qcstatus, stoutsp_qcdate, stoutsp_pp, stoutsp_moist, stoutsp_germ, stoutsp_gottype,stoutsp_gotstatus, stoutsp_gotdate, stoutsp_wtmp, stoutsp_dop, stoutsp_dov, stoutsp_srstatus, stoutsp_srtype, stoutsp_ssrstatus, stoutsp_ssrtype, stoutsp_loosenop,plantcode) values ('$z1', '$txtcrop', '$txtvariety', '$stage', '$txtlot1', '$lable', '$enop', '$enomp', '$eqty', '$avlnop', '$avlnomp', '$avlqty','$tobenop', '$tobenomp', '$tobeqty', '$loadgrswt', '$loadnomp', '$loadqty','$balnop','$balnomp','$balqty','$qcpacktyp','$qcpackdate','$qcstatus','$qcdate','$pp','$moist','$germ','$gottype','$gotstatus','$gotdate','$wtmp','$dop','$dov','$srstatus','$srtyp','$srstatus2','$srtyp2','$enop','$plantcode')";
			
			if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
			{
				$sid=mysqli_insert_id($link);
				if($barcode!="")
				{
					$qty=$stage11/1000*$lotsnop[$i];
						
				$sql_lotqty=mysqli_query($link,"SELECT * FROM tbl_barcodes where plantcode='".$plantcode."' and bar_lotno='".$lots[$i]."' and bar_barcode='".$barcode."'") or die(mysqli_error($link));
				$row_lotqty=mysqli_fetch_array($sql_lotqty);
				$grswt1=$row_lotqty['bar_grosswt'];
						
				$sql_subsub="insert into tbl_stoutsspack (stoutmp_id, stoutsp_id, stoutssp_barcode, stoutssp_barcodetype, stoutssp_lotno, stoutssp_ups, stoutssp_lotnop, stoutssp_lotqty, stoutssp_nop, stoutssp_qty, stoutssp_grosswt,plantcode) values ('$z1', '$sid', '$barcode', '$bartyp', '".$lots[$i]."', '$stage', '".$lotsnop[$i]."', '$qty', '".$lotsnop[$i]."', '$qty','$grswt1','$plantcode')";
				mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
						
				$sql_loadqty=mysqli_query($link,"SELECT * FROM tbl_stoutsspack where plantcode='".$plantcode."' and stoutssp_lotno='".$lots[$i]."' and stoutsp_id='".$sid."'") or die(mysqli_error($link));
				$loadnomp=mysqli_num_rows($sql_loadqty);
				$loadqty=0; $grswt=0;
				while($row_loadqty=mysqli_fetch_array($sql_loadqty))
				{
					$loadqty=$loadqty+$row_loadqty['stoutssp_lotqty'];
					$grswt=$grswt+$row_loadqty['stoutssp_grosswt'];
				}
				if($stage12=="Gms")
					$looseqty=$stage11/1000*$tobenop;
				if($stage12=="Kgs")
					$looseqty=$stage11*$tobenop;
							
				$balnomp=$tobenomp-$loadnomp;
				$balqty=$tobeqty-$looseqty-$loadqty;	
				$balnop=$tobenop-$tobenop;
				$loadqty=$loadqty+$looseqty;
					
				$sql_sub2="update tbl_stoutspack set stoutsp_tbnop='$tobenop', stoutsp_tbnomp='$tobenomp', stoutsp_tbqty='$tobeqty', stoutsp_loadgrswt='$grswt', stoutsp_loadnop='$tobenop', stoutsp_loadnomp='$loadnomp', stoutsp_loadqty='$loadqty', stoutsp_balnop='$balnop', stoutsp_balnomp='$balnomp', stoutsp_balqty='$balqty' where stoutsp_lotno='".$lots[$i]."' and stoutsp_id='".$sid."'";
				mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
						
				$sql_mpmain="update tbl_mpmain set mpmain_dflg=2 where mpmain_barcode='$barcode'";
				mysqli_query($link,$sql_mpmain) or die(mysqli_error($link));
				
				}
			}
		}	
	}
}	

?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Stock Transfer - Plant</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<input name="code1" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $code1;?>" maxlength="20"/></td>

<td width="191" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<?php 
/*$quer=mysqli_query($link,"SELECT * FROM tbl_partymaser where classification='Stock Transfer-Plant' and p_id='".$toplant."' order by classification");
$row_quer = mysqli_fetch_array($quer);*/

?>
<tr class="Dark" height="30">
<td width="158"  align="right"  valign="middle" class="tblheading">Plant Name&nbsp;</td>
<td  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $row_quer['business_name'];?><input type="hidden" name="txttoplant" value="<?php echo $toplant;?>"/></td>
</tr>

<tr class="Dark" height="30">
<td width="158" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><?php echo $row_quer['address'];?><?php if($row_quer['city']!="") { echo ", ".$row_quer['city']; }?>, <?php echo $row_quer['state'];?></td>
</tr>
<?php 
$sql_transitmode=mysqli_query($link,"SELECT * FROM tbl_stoutmpack where plantcode='".$plantcode."' and stoutmp_id='".$maintrid."'");
$row_transitmode = mysqli_fetch_array($sql_transitmode);
?>
<tr class="Light" height="25">
<td width="230" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" <?php if($row_transitmode['stoutmp_tmode']=="Transport") echo "checked"; ?> />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" <?php if($row_transitmode['stoutmp_tmode']=="Courier") echo "checked"; ?> />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_transitmode['stoutmp_tmode']=="By Hand") echo "checked"; ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txt11" value="<?php echo $row_transitmode['stoutmp_tmode'];?>" type="hidden"> </td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_transitmode['stoutmp_tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="239" align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td width="253" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input name="txttname" type="text" size="25" class="smalltbltext" tabindex="" maxlength="25" value="<?php echo $row_transitmode['stoutmp_tname'];?>"></td>
<td width="192" align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="smalltbltext" tabindex=""  maxlength="15" value="<?php echo $row_transitmode['stoutmp_lorryrepno'];?>" ></td>
</tr>

<tr class="Light" height="25">
<td width="239" align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td width="253" align="left" valign="middle" class="smalltbltext" >&nbsp;
  <input name="txtvn" type="text" size="12" class="smalltbltext" tabindex="" maxlength="12" value="<?php echo $row_transitmode['stoutmp_tvehno'];?>" ></td>
<td width="192" align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txt13" style="width:70px;"  >
<option value="" selected="selected">Select</option>
<option <?php if($row_transitmode['stoutmp_paymode']=="TBB")echo "Selected";?> value="TBB">TBB</option>
<option <?php if($row_transitmode['stoutmp_paymode']=="To Pay")echo "Selected";?> value="To Pay" >To Pay</option>
<option <?php if($row_transitmode['stoutmp_paymode']=="Paid")echo "Selected";?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_transitmode['stoutmp_tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="239" align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td width="253" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="txtcname" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20" value="<?php echo $row_transitmode['stoutmp_couriername'];?>" ></td>
<td width="192" align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15" value="<?php echo $row_transitmode['stoutmp_docketno'];?>" ></td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_transitmode['stoutmp_tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="239" align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td width="705" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="txtpname" type="text" size="30" class="smalltbltext" tabindex=""  maxlength="30" value="<?php echo $row_transitmode['stoutmp_pnamebyhand'];?>" ></td>
</tr>
</table>
</div>
<br />
<div id="postingsubtable" style="display:block">

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
$sql_sub=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and stoutmp_id='$maintrid' and stoutsp_subflg=1 order by stoutsp_id asc") or die(mysqli_error($link));
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
$quer33=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."'"); 
$row_quer33 = mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
	<td width="144" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
	<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_quer33['cropid']?><input name="txtcrop" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $txtcrop?>" readonly="true" style="background-color:#CCCCCC" ></td>
	<td width="122" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
	<td width="347" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $row_quer33['popularname']?><input name="txtvariety" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $txtvariety?>" readonly="true" style="background-color:#CCCCCC" ></td>	
</tr>

<tr class="Dark" height="30">
	<td width="144" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext" id="upstp">&nbsp;<?php echo $stage?><input name="txtstage" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $stage?>" readonly="true" style="background-color:#CCCCCC" ></td>

	<td width="122" align="right"  valign="middle" class="tblheading">Select Lot Nos.&nbsp;</td>
	<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtlot1?><input name="txtlot1" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $txtlot1?>" readonly="true" style="background-color:#CCCCCC" ></td>	
</tr>
</table>
<br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="22" align="center" class="tblheading">Lot No. &nbsp;<?php echo $txtlot1." - Stock"?></td>
</tr> 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="3">Existing</td>
	<td align="center" class="smalltblheading" colspan="3">Allocated</td>
	<td align="center" class="smalltblheading" colspan="3">Available</td>
	<td align="center" class="smalltblheading" colspan="3">To be Dispatch</td>
	<td width="57" align="center" class="smalltblheading" rowspan="2">Loaded NoP</td>
	<td width="57" align="center" class="smalltblheading" rowspan="2">Loaded NoMP</td>
	<td width="55" align="center" class="smalltblheading" rowspan="2">Loaded Qty</td>
	<td width="52" align="center" class="smalltblheading" rowspan="2">Gross Wt.</td>
	<td align="center" class="smalltblheading" colspan="3">Balance To be Loaded</td>
	<td align="center" class="smalltblheading" colspan="3">Balance in Stock</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="32" align="center" class="smalltblheading">NoP</td>
	<td width="44" align="center" class="smalltblheading">NoMP</td>
	<td width="31" align="center" class="smalltblheading">Qty</td>
	<td width="32" align="center" class="smalltblheading">NoP</td>
	<td width="44" align="center" class="smalltblheading">NoMP</td>
	<td width="31" align="center" class="smalltblheading">Qty</td>
	<td width="29" align="center" class="smalltblheading">NoP</td>
	<td width="44" align="center" class="smalltblheading">NoMP</td>
	<td width="31" align="center" class="smalltblheading">Qty</td>
	<td width="45" align="center" class="smalltblheading">NoP</td>
	<td width="55" align="center" class="smalltblheading">NoMP</td>
	<td width="55" align="center" class="smalltblheading">Qty</td>
	<td width="43" align="center" class="smalltblheading">NoP</td>
	<td width="57" align="center" class="smalltblheading">NoMP</td>
	<td width="44" align="center" class="smalltblheading">Qty</td>
	<td width="42" align="center" class="smalltblheading">NoP</td>
	<td width="43" align="center" class="smalltblheading">NoMP</td>
	<td width="40" align="center" class="smalltblheading">Qty</td>
</tr>
<input type="hidden" name="ups" value="<?php echo $ups[0];?>" />
<input type="hidden" name="upstyp" value="<?php echo $ups[1];?>" />
<?php 
$sn=1;
//echo "select cropid, cropname from tblcrop where cropid='".$b."' order by cropname";
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$txtcrop."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$cro=$noticia_class['cropname'];
//echo "select varietyid, popularname from tblvariety where varietyid='".$c."'";
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variet=$noticia_item['popularname'];

$elotn=explode(",",$txtlot1);
foreach($elotn as $ltno)
{
if($ltno<>"")
{
//echo $g;
$nomp=0; $totnob=""; $qtynob=""; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $gotyp=""; $got=""; $dogt=""; $pp=""; $moist=""; $alqty=""; $alnomp=""; $alnob=""; $avlqty=""; $avlnomp=""; 
$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='".$txtcrop."' and lotno='".$ltno."' and lotldg_variety='".$txtvariety."' and packtype='".$stage."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$txtcrop."' and lotno='".$ltno."' and lotldg_variety='".$txtvariety."' and packtype='".$stage."' order by lotdgp_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			//$qc=$row_issuetbl['lotldg_qc']; 
			//$germ=$row_issuetbl['lotldg_gemp']; 
			//$pp=$row_issuetbl['lotldg_vchk']; 
			//$moist=$row_issuetbl['lotldg_moisture']; 
			$alqty=$row_issuetbl['lotldg_alqtys'];
			$alnomp=$row_issuetbl['lotldg_alnomps'];
			
			$alqty1=$alqty -($alnomp*$row_issuetbl['wtinmp']);
			
			$ups=explode(" ",$stage);
			
			if($ups[1]=="Gms")
				$alnob=($alqty1*1000)/$ups[0];
			if($ups[1]=="Kgs")
				$alnob=$alqty1/$ups[0];	
			
			
			$got1=explode(" ",$row_issuetbl['lotldg_got1']);
			$gotyp=$got1[0];
			$got2=$row_issuetbl['lotldg_got'];
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['balqty']; 
			$nomp=$nomp+$row_issuetbl['balnomp'];
			$qtynob=$totqty-($row_issuetbl['wtinmp']*$nomp);
			
			if($ups[1]=="Gms")
				$totnob=($qtynob*1000)/$ups[0];
			if($ups[1]=="Kgs")
				$totnob=$qtynob/$ups[0];	
			
			$avlqty=$totqty-$alqty; 
			$avlnomp=$nomp-$alnomp; 
			
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$dot=$rday."-".$rmonth."-".$ryear;
			
			$rgdate=$row_issuetbl['lotldg_gottestdate'];
			$rgyear=substr($rgdate,0,4);
			$rgmonth=substr($rgdate,5,2);
			$rgday=substr($rgdate,8,2);
			$dogt=$rgday."-".$rgmonth."-".$rgyear;
						
			if($dot=="00-00-0000" || $dot=="--")$dot="";	
			if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
			
			if($qc=="RT" || $qc=="UT")$dot="";
			if($got2=="RT" || $got2=="UT")$dogt="";
			
			if($germ<=0)$germ="";
			if($moist<=0)$moist="";
			
			$wtinmp=$row_issuetbl['wtinmp'];
		}	
	}
}

if($totqty > 0)	 
{
?>
<input type="hidden" name="wtmp" value="<?php echo $wtinmp;?>" />
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?><input type="hidden" name="enop" value="<?php echo $totnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nomp?><input type="hidden" name="enomp" value="<?php echo $nomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?><input type="hidden" name="eqty" value="<?php echo $totqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $alnob;?><input type="hidden" name="txtalnop" value="<?php echo $alnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $alnomp;?><input type="hidden" name="txtalnomp" value="<?php echo $alnomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $alqty;?><input type="hidden" name="txtalqty" value="<?php echo $alqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlnomp?><input type="hidden" name="txtavlnomp" id="eltno_<?php echo $sn;?>" value="<?php echo $ltno;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlqty?><input type="hidden" name="txtavlqty" id="estage_<?php echo $sn;?>" value="<?php echo $g;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="txttobenop" id="txttobenop" value="<?php echo $tobenop?>" onchange="stocknop(this.value)"/></td>    
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="3" name="txttobenomp" id="txttobenomp" value="<?php echo $tobenomp?>" onchange="stocknomp(this.value)" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="7" name="txttobeqty" id="txttobeqty" value="<?php echo $tobeqty?>" onchange="stockqty(this.value)" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $tobenop;?><input type="hidden" size="3" name="loadnop" id="enob_<?php echo $sn;?>" value="<?php echo $loadnop;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $loadnomp;?><input type="hidden" size="3" name="loadnomp" id="enob_<?php echo $sn;?>" value="<?php echo $loadnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $loadqty;?><input type="hidden" size="7" name="loadqty" id="eqty_<?php echo $sn;?>" value="<?php echo $loadqty;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="loadgrswt" id="enob_<?php echo $sn;?>" value="<?php echo $totnob;?>" /></td>
	
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $balnop;?><input type="hidden" name="balloadnop" value="<?php echo $totnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $balnomp;?><input type="hidden" name="balloadnomp" value="<?php echo $totqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $balqty;?><input type="hidden" name="balloadqty" value="<?php echo $totqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balnop" id="balnop" value="<?php echo $balstnop;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balnomp" id="balnomp" value="<?php echo $balstnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balqty" id="balqty" value="<?php echo $balstqty;?>" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
$sn++;
}
}
}

?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" />
</table><br />

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Lot wise Loading IN-Progress View</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="28" align="center" class="smalltblheading">#</td>
	<td width="99" align="center" class="smalltblheading">Crop</td>
	<td width="134" align="center" class="smalltblheading">Variety</td>
	<td width="92" align="center" class="smalltblheading">UPS</td>
	<td width="117" align="center" class="smalltblheading">Lot No.</td>
	<td width="74" align="center" class="smalltblheading">QC Status</td>
	<td width="79" align="center" class="smalltblheading">DoT</td>
	<td width="89" align="center" class="smalltblheading">DoV</td>
	<td width="54" align="center" class="smalltblheading">NoMP</td>
	<td width="82" align="center" class="smalltblheading">Qty</td>
	<td width="102" align="center" class="smalltblheading">Barcodes</td>
</tr>
</table>
<?php
$sno2=0; $totrec=0; $bchnflg=0;
//echo "Select * from tbl_stoutspack where stoutmp_id='$maintrid'";
$sq2=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and stoutmp_id='$maintrid'") or die(mysqli_error($link));
$totrec=mysqli_num_rows($sq2);
?>
<div id="table-wrapper" style=" <?php if($totrec<=4) {?>height:auto; width:945px; overflow:hidden;<?php } else{?>height:101px; width:970px; overflow:auto;<?php } ?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse;" > 
<?php
if($totrec=mysqli_num_rows($sq2) > 0)
{
	while($ro2=mysqli_fetch_array($sq2))
	{
		$lot2=$ro2['stoutsp_lotno']; 
		$nompt=0; $nqty2=0; $barc="";
		$sq3=mysqli_query($link,"Select * from tbl_stoutsspack where plantcode='".$plantcode."' and stoutssp_lotno='$lot2' and stoutmp_id='$maintrid'") or die(mysqli_error($link));
		while($ro3=mysqli_fetch_array($sq3))
		{
			$nompt=$nompt+1;
			$nqty2=$nqty2+$ro3['stoutssp_lotqty'];
			if($barc!="") 
				$barc=$barc.",".$ro3['stoutssp_barcode'];
			else
				$barc=$ro3['stoutssp_barcode'];
		}
		
		$crps=$ro2['stoutsp_crop']; 
		$vers=$ro2['stoutsp_variety']; 
		$upss=$ro2['stoutsp_ups']; 
		$dovs=$ro2['stoutsp_dov']; 
		$qcss=$ro2['stoutsp_qcstatus']; 
		$dots=$ro2['stoutsp_qcdate']; 
		
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vts=$row_dept4['popularname'];
		
		$tdate=$dovs;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dov=$tday."-".$tmonth."-".$tyear;
		
		$tdate=$dots;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dot=$tday."-".$tmonth."-".$tyear;
		
$sno2++;	 $bchnflg++;	
?>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext"><?php echo $sno2;?></td>
	<td width="97" align="center" class="smalltbltext"><?php echo $cps;?></td>
	<td width="131" align="center" class="smalltbltext"><?php echo $vts;?></td>
	<td width="90" align="center" class="smalltbltext"><?php echo $upss;?></td>
	<td width="115" align="center" class="smalltbltext"><?php echo $lot2;?></td>
	<td width="73" align="center" class="smalltbltext"><?php echo $qcss;?></td>
	<td width="80" align="center" class="smalltbltext"><?php echo $dot;?></td>
	<td width="87" align="center" class="smalltbltext"><?php echo $dov;?></td>
	<td width="53" align="center" class="smalltbltext"><?php echo $nompt;?></td>
	<td width="80" align="center" class="smalltbltext"><?php echo $nqty2;?></td>
	<td width="92" align="center" class="smalltbltext"><?php if($barc!=""){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $barc;?>')">Details</a><?php } ?></td>
</tr>
<?php

}
}
?>
</table><input type="hidden" name="totbarcs" value="<?php echo $barc;?>" /></div><br />
<input type="hidden" name="totbarcs" value="<?php echo $barc;?>" />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Latest Barcode View</td>
</tr>
<tr class="Light" height="25">
	<!--<td width="20" align="center" class="smalltblheading">#</td>-->
	<td width="96" align="center" class="smalltblheading">Barcode</td>
	<td width="96" align="center" class="smalltblheading">Crop</td>
	<td width="130" align="center" class="smalltblheading">Variety</td>
	<td width="89" align="center" class="smalltblheading">UPS</td>
	<td width="102" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="67" align="center" class="smalltblheading">QC Status</td>
	<td width="90" align="center" class="smalltblheading">DoT</td>
	<td width="90" align="center" class="smalltblheading">DoV</td>
	<td width="80" align="center" class="smalltblheading">Net Weight</td>
	<td width="88" align="center" class="smalltblheading">Gross Weight</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php 
$sno=1;
$sq6=mysqli_query($link,"Select * from tbl_stoutsspack where plantcode='".$plantcode."' and stoutmp_id='$maintrid' and stoutssp_barcode='$barcode'") or die(mysqli_error($link));
if($to6=mysqli_num_rows($sq6) > 0)
{
while($ro6=mysqli_fetch_array($sq6))
{
	$sq=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and stoutsp_id='".$ro6['stoutsp_id']."' ") or die(mysqli_error($link));
	$ro=mysqli_fetch_array($sq);
	
	$lot6=$ro6['stoutssp_lotno']; 
	$crps2=$ro['stoutsp_crop']; 
	$vers2=$ro['stoutsp_variety']; 
	$upss2=$ro6['stoutssp_ups']; 
	$dovs2=$ro['stoutsp_dov']; 
	$qcss2=$ro['stoutsp_qcstatus']; 
	//$dots2=$ro6['dpss_dot']; 
	$grwts2=$ro6['stoutssp_grosswt']; 
	$nqty6=$ro6['stoutssp_qty'];
	
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cps2=$row_dept5['cropname'];
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$vts2=$row_dept4['popularname'];
		
	$tdate=$dovs2;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dov2=$tday."-".$tmonth."-".$tyear;
	
	$tdate=$dots2;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dot2=$tday."-".$tmonth."-".$tyear;
	
	
?>
<tr class="Dark" height="30">
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cps2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vts2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upss2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lot6?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcss2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
$sno++;
}
}

if($brflg!=0)
{
	if($brflg==1)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: Barcode not present in System";
	if($brflg==2)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: Barcode already Dispatched";
	if($brflg==3)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: Barcode already Loaded in current OR other Operator's Transaction";
	if($brflg==4)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: Variety not matching with Selected Line Item in Consolidated Pending Orders";
	if($brflg==5)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: UPS not matching with Selected Line Item in Consolidated Pending Orders";
	if($brflg==6)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: This Lot's current QC/GOT Status is FAIL";
	if($brflg==7)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: This Lot's current QC/GOT Status is UT and Soft Release is not activated";
	if($brflg==8)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date";
	if($brflg==9)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: This Barcode is already Unpackaged";
	if($brflg==10)
	$msgs="Barcode $barcode cannot be Dispatched. Reason: Lot is under Reserve Status";
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading" colspan="11"><font color="#FF0000"><?php echo $msgs;?></td>
</tr>
<?php
}
?>
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="light">
  <td align="center" class="tblheading"><font size="+4" color="<?php if($brflg>0){ echo '#FF0000'; } else if($to6==0){ echo '#FF0000'; } else { if($bchnflg%2==0) echo '#0000FF'; else echo '#009900';}?>"><?php echo $barcode;?></font></td>
</tr>
</table><br />
<input type="hidden" name="totbarcs" value="<?php echo $barc;?>" />
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
<input type="hidden" name="maintrid" value="<?php echo $maintrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $sid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="70" align="right" valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="774" align="left" valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="120" ></td>
</tr>
</table>

