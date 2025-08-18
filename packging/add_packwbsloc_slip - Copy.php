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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
			
		if(isset($_POST['protype'])) { $protype = $_POST['protype']; } 
		if(isset($_POST['txtid'])) { $txtid = $_POST['txtid']; }
		if(isset($_POST['date'])) { $date = $_POST['date']; }
		if(isset($_POST['dopc'])) { $dopc = $_POST['dopc']; }
		if(isset($_POST['txtpsrn'])) { $txtpsrn= $_POST['txtpsrn']; }
		if(isset($_POST['txtcrop'])) { $txtcrop = $_POST['txtcrop'];	}
		if(isset($_POST['txtvariety'])) { $txtvariety = $_POST['txtvariety']; }
		if(isset($_POST['txtstage'])) { $txtstage = $_POST['txtstage']; }
		if(isset($_POST['txtpromech'])) { $txtpromech = $_POST['txtpromech']; }
		if(isset($_POST['txtoprname'])) { $txtoprname= $_POST['txtoprname']; }
		if(isset($_POST['txttreattyp'])) { $txttreattyp = $_POST['txttreattyp']; }
		if(isset($_POST['txtlot1'])) { $txtlot1 = $_POST['txtlot1']; }
		
		if(isset($_POST['softstatus'])) { $softstatus = $_POST['softstatus']; }
		
		if(isset($_POST['pdnum'])) { $pdnum = $_POST['pdnum']; }
		if(isset($_POST['txtonob'])) { $txtonob = $_POST['txtonob']; }
		if(isset($_POST['txtoqty'])) { $txtoqty = $_POST['txtoqty']; }
		if(isset($_POST['protyp'])) { $protyp = $_POST['protyp']; }
		
		
		if(isset($_POST['txtplotno'])) { $txtplotno = $_POST['txtplotno']; }
		
		if(isset($_POST['srno2'])) { $srno2 = $_POST['srno2']; }
		
		if(isset($_POST['txtpacktype'])) { $txtpacktype = $_POST['txtpacktype']; }
		
		/*if($srno2==2)
		{
		if(isset($_POST['extslwhg2'])) { $extslwhg2 = $_POST['extslwhg2']; }
		if(isset($_POST['extslbing2'])) { $extslbing2 = $_POST['extslbing2']; }
		if(isset($_POST['extslsubbg2'])) { $extslsubbg2 = $_POST['extslsubbg2']; }
		if(isset($_POST['txtextnob2'])) { $txtextnob2 = $_POST['txtextnob2']; }
		if(isset($_POST['txtextqty2'])) { $txtextqty2 = $_POST['txtextqty2']; }
		if(isset($_POST['recnobp2'])) { $recnobp2 = $_POST['recnobp2']; }
		if(isset($_POST['recqtyp2'])) { $recqtyp2 = $_POST['recqtyp2']; }
		if(isset($_POST['txtbalnobp2'])) { $txtbalnobp2 = $_POST['txtbalnobp2']; }
		if(isset($_POST['txtbalqtyp2'])) { $txtbalqtyp2 = $_POST['txtbalqtyp2']; }
		}*/
		
		if(isset($_POST['txtconnob'])) { $txtconnob = $_POST['txtconnob'];	}
		if(isset($_POST['txtconqty'])) { $txtconqty = $_POST['txtconqty']; }
		if(isset($_POST['txtconrem'])) { $txtconrem = $_POST['txtconrem']; }
		if(isset($_POST['txtconim'])) { $txtconim = $_POST['txtconim']; }
		if(isset($_POST['txtconpl'])) { $txtconpl = $_POST['txtconpl']; }
		if(isset($_POST['txtconloss'])) { $txtconloss= $_POST['txtconloss']; }
		if(isset($_POST['txtconper'])) { $txtconper= $_POST['txtconper']; }
		
		if(isset($_POST['txtslwhg1'])) { $txtslwhg1= $_POST['txtslwhg1']; }
		if(isset($_POST['txtslbing1'])) { $txtslbing1= $_POST['txtslbing1']; }
		if(isset($_POST['txtslsubbg1'])) { $txtslsubbg1= $_POST['txtslsubbg1']; }
		if(isset($_POST['txtconslnob1'])) { $txtconslnob1= $_POST['txtconslnob1']; }
		if(isset($_POST['txtconslqty1'])) { $txtconslqty1= $_POST['txtconslqty1']; }
		if(isset($_POST['txtslwhg2'])) { $txtslwhg2= $_POST['txtslwhg2']; }
		if(isset($_POST['txtslbing2'])) { $txtslbing2= $_POST['txtslbing2']; }
		if(isset($_POST['txtslsubbg2'])) { $txtslsubbg2= $_POST['txtslsubbg2']; }
		if(isset($_POST['txtconslnob2'])) { $txtconslnob2= $_POST['txtconslnob2']; }
		if(isset($_POST['txtconslqty2'])) { $txtconslqty2= $_POST['txtconslqty2']; }
		
		if(isset($_POST['paceptyp'])) { $paceptyp= $_POST['paceptyp']; }
		if(isset($_POST['pcktype'])) { $pcktype= $_POST['pcktype']; }
		if(isset($_POST['avlnobpck'])) { $avlnobpck= $_POST['avlnobpck']; }
		if(isset($_POST['avlqtypck'])) { $avlqtypck= $_POST['avlqtypck']; }
		if(isset($_POST['picqtyp'])) { $picqtyp= $_POST['picqtyp']; }
		if(isset($_POST['pckloss'])) { $pckloss= $_POST['pckloss']; }
		if(isset($_POST['ccloss'])) { $ccloss= $_POST['ccloss']; }
		if(isset($_POST['balpck'])) { $balpck= $_POST['balpck']; }
		if(isset($_POST['balcnob'])) { $balcnob= $_POST['balcnob']; }
		if(isset($_POST['balcqty'])) { $balcqty= $_POST['balcqty']; }
		if(isset($_POST['qcstatus'])) { $qcstatus= $_POST['qcstatus']; }
		if(isset($_POST['qctestdate'])) { $qctestdate= $_POST['qctestdate']; }
		if(isset($_POST['validityperiod'])) { $validityperiod= $_POST['validityperiod']; }
		if(isset($_POST['validityupto'])) { $validityupto= $_POST['validityupto']; }
		if(isset($_POST['qcdttype'])) { $qcdttype= $_POST['qcdttype']; }
		
		if(isset($_POST['fet'])) { $fet= $_POST['fet']; }
		if(isset($_POST['upsidno'])) { $upsidno= $_POST['upsidno']; }
		if(isset($_POST['upssize'])) { $upssize= $_POST['upssize']; }
		if(isset($_POST['sno'])) { $sno= $_POST['sno']; }
		if(isset($_POST['nopks'])) { $nopks= $_POST['nopks']; }
		if(isset($_POST['sno3'])) { $sno3= $_POST['sno3']; }
		if(isset($_POST['slocssyncs24'])) { $slocssyncs24= $_POST['slocssyncs24']; }
		if($txtpacktype=="Non-standard") {$upssize=1;}
		
		for ($i=1; $i<=$sno; $i++)
		{
			if($upssize==$i)
			{
				$wtnopkgx="wtnopkg_".$i;
				$nopinwbx="nopinwb_".$i;
				$wbwtsx="wbwts_".$i;
				$nowbinmpx="nowbinmp_".$i;
				$wtmpx="wtmp_".$i;
				$upsvalx="upsval_".$i;
				$upssizetypx="upssizetyp_".$i;
				
				
				if(isset($_POST[$wtnopkgx])) {  $wtnopkg= $_POST[$wtnopkgx]; }
				if(isset($_POST[$nopinwbx])) { $nopinwb= $_POST[$nopinwbx]; }
				if(isset($_POST[$wbwtsx])) { $wbwts= $_POST[$wbwtsx]; }
				if(isset($_POST[$nowbinmpx])) { $nowbinmp= $_POST[$nowbinmpx]; }
				if(isset($_POST[$wtmpx])) { $wtmp= $_POST[$wtmpx]; }
				if(isset($_POST[$upsvalx])) {  $upsval= $_POST[$upsvalx]; }
				if(isset($_POST[$upssizetypx])) {  $upssizetyp= $_POST[$upssizetypx]; }
				 $upsname=$upsval." ".$upssizetyp;
			}
		}
		
		
		$noofpcks=$nopks;
		
		if(isset($_POST['detmpbno'])) { $detmpbno= $_POST['detmpbno']; }
		if(isset($_POST['txtremarks'])) { $txtremarks= $_POST['txtremarks']; }
			
		if(isset($_POST['maintrid'])) { $maintrid= $_POST['maintrid']; }
		if(isset($_POST['subtrid'])) { $subtrid= $_POST['subtrid']; }
			
		//frm_action=submit&txtid=1&date=16-08-2013&dopc=16-08-2013&txtpsrn=gfhgfdh&txtcrop=28&txtvariety=15&txtstage=Condition&txtpromech=5&txtoprname=2&txttreattyp=00007&itmdchk=0&txtlot1=DA02167%2F00000%2F00C&maintrid=0&subtrid=0&softstatus=&txtonob=13&txtoqty=374&qcstatus=OK&qctestdate=17-06-2013&dp1=16-09-2013&dp2=16-12-2013&dp3=16-03-2014&qcdttype=DOT&protype=&validityperiod=9&validityupto=16-03-2014&valdays=212&paceptyp=E&pcktype=E&extslwhg1=1&extslbing1=69&extslsubbg1=1361&txtextnob1=13&txtextqty1=374&recqtyp1=374&txtbalnobp1=0&txtbalqtyp1=0&srno2=1&picqtyp=374&pckloss=2&ccloss=2&balpck=370&txtslwhg1=WH&txtslbing1=Bin&txtslsubbg1=Subbin&txtconslnob1=&txtconslqty1=&txtslwhg2=WH&txtslbing2=Bin&txtslsubbg2=Subbin&txtconslnob2=&txtconslqty2=&fet=2&wtnopkg_1=0.010&upsname_1=10.000%20Gms&nopc_1=37000&domcs_1=A&lbls_1=1&domce_1=A&lble_1=37001&nomp_1=&wtmp_1=6&wtnop_1=600&nowb_1=&wtnopkg_2=0.025&upsname_2=25.000%20Gms&wtmp_2=10&wtnop_2=400&nowb_2=&wtnopkg_3=0.050&upsname_3=50.000%20Gms&wtmp_3=10&wtnop_3=200&nowb_3=&wtnopkg_4=0.100&upsname_4=100.000%20Gms&wtmp_4=10&wtnop_4=100&nowb_4=&sno=5&detmpbno=&upsidno=2&upssize=1&nopks=&singlebar=&rangebar=&mobar=&txtwhg1=1&txtbing1=21&txtsubbg1=418&existview1=Empty&nopmpcs_1=&noppchs_1=37000&noptpchs_1=37000&noptqtys_1=370&txtwhg2=WH&txtbing2=Bin&txtsubbg2=Subbin&nopmpcs_2=&noppchs_2=&noptpchs_2=&noptqtys_2=&txtwhg3=WH&txtbing3=Bin&txtsubbg3=Subbin&nopmpcs_3=&noppchs_3=&noptpchs_3=&noptqtys_3=&txtwhg4=WH&txtbing4=Bin&txtsubbg4=Subbin&nopmpcs_4=&noppchs_4=&noptpchs_4=&noptqtys_4=&txtwhg5=WH&txtbing5=Bin&txtsubbg5=Subbin&nopmpcs_5=&noppchs_5=&noptpchs_5=&noptqtys_5=&txtwhg6=WH&txtbing6=Bin&txtsubbg6=Subbin&nopmpcs_6=&noppchs_6=&noptpchs_6=&noptqtys_6=&txtwhg7=WH&txtbing7=Bin&txtsubbg7=Subbin&nopmpcs_7=&noppchs_7=&noptpchs_7=&noptqtys_7=&txtwhg8=WH&txtbing8=Bin&txtsubbg8=Subbin&nopmpcs_8=&noppchs_8=&noptpchs_8=&noptqtys_8=&txtremarks=test
		if($txtpacktype=="Standard")
		{$ttype="Packing Slip";}
		else if($txtpacktype=="Non-standard")
		{$ttype="NST Packing Slip";}
		else
		{$ttype="Packing Slip";}
		$pl=$txtconpl;
		$rpl=$txtconpl;
		
		 $zz=str_split($txtlot1);
		 $orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
			$z1=$maintrid;
				
				$tdate11=explode("-",$date);
				$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
				
				$tdate12=explode("-",$dopc);
				$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
				
				$tdate13=explode("-",$validityupto);
				$tdate3=$tdate13[2]."-".$tdate13[1]."-".$tdate13[0];
				
				$tdate14=explode("-",$qctestdate);
				$tdate4=$tdate14[2]."-".$tdate14[1]."-".$tdate14[0];
				
				$pnob=$recnobp1+$recnobp2;
				$pqty=$recqtyp1+$recqtyp2;
				
				$sql_sel="select * from tblups where uid='".$upsidno."' order by uom Asc";
				$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
				$row12=mysqli_fetch_array($res);
				if($txtpacktype=="Standard")
				{$upss=$row12['ups']." ".$row12['wt'];}
				else
				{ $upss=$upsname;}
		$tbaln=0; $tbalq=0; $taln=0; $talq=0;
		if($z1 == 0)
		{
		   $sql_main="insert into tbl_pnpslipmain(pnpslipmain_code, pnpslipmain_date, pnpslipmain_proslipno,  pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_stage, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_ttype, logid, yearid, plantcode, pnpslipmain_trtype) values ('$txtid','$tdate1','$txtpsrn','$txtcrop','$txtvariety','$txtstage', '$txtpromech', '$txtoprname', '$txttreattyp', '$ttype', '$logid', '$yearid_id', '$plantcode',  'wb')";
		if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
		{
		$mainid=mysqli_insert_id($link);
		
		 $sql_sub="insert into tbl_pnpslipsub (pnpslipsub_lotno, pnpslipmain_id, pnpslipsub_onob, pnpslipsub_oqty, pnpslipsub_processtype, pnpslipsub_pnob, pnpslipsub_pqty,  pnpslipsub_connob, pnpslipsub_conqty, pnpslipsub_rm, pnpslipsub_im, pnpslipsub_pl, pnpslipsub_rpl, pnpslipsub_tlqty, pnpslipsub_tlper, pnpslipsub_packtype, pnpslipsub_availpnob, pnpslipsub_availpqty, pnpslipsub_pickpqty, pnpslipsub_packloss, pnpslipsub_packcc, pnpslipsub_packqty, pnpslipsub_balcnob, pnpslipsub_balcqty, pnpslipsub_ups, pnpslipsub_upsid, pnpslipsub_remarks, pnpslipsub_sstatus, pnpslipsub_orlot, pnpslipsub_valperiod, pnpslipsub_valupto, pnpslipsub_qc, pnpslipsub_qcdot, pnpslipsub_qcdttype, pnpslipsub_sltyp, pnpslipsub_plotno, plantcode, pnpslipsub_wtmp, pnpslipsub_wbinmp, pnpslipsub_wbnop, pnpslipsub_wbwt) values ('$txtlot1', '$mainid', '$txtonob', '$txtoqty', '$protyp', '$pnob', '$pqty', '$txtconnob', '$txtconqty', '$txtconrem', '$txtconim', '$pl', '$rpl', '$txtconloss', '$txtconper', '$pcktype', '$avlnobpck', '$avlqtypck', '$picqtyp', '$pckloss', '$ccloss', '$balpck', '$balcnob', '$balcqty', '$upss', '$upsidno', '$txtremarks', '$softstatus', '$orlot', '$validityperiod', '$tdate3', '$qcstatus', '$tdate4', '$qcdttype', '$slocssyncs24', '$txtplotno', '$plantcode', '$wtmp', '$nowbinmp', '$nopinwb', '$wbwts')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$suid=mysqli_insert_id($link);
			//$tbaln=0; $tbalq=0; $taln=0; $talq=0;
			for ($i=1; $i<=$srno2; $i++)
			{
				$extslwhgx="extslwhg".$i;
				$extslbingx="extslbing".$i;
				$extslsubbgx="extslsubbg".$i;
				$txtextnobx="txtextnob".$i;
				$txtextqtyx="txtextqty".$i;
				$recnobpx="recnobp".$i;
				$recqtypx="recqtyp".$i;
				$txtbalnobpx="txtbalnobp".$i;
				$txtbalqtypx="txtbalqtyp".$i;
				if(isset($_POST[$extslwhgx])) { $extslwhg1 = $_POST[$extslwhgx]; }
				if(isset($_POST[$extslbingx])) { $extslbing1 = $_POST[$extslbingx]; }
				if(isset($_POST[$extslsubbgx])) { $extslsubbg1 = $_POST[$extslsubbgx]; }
				if(isset($_POST[$txtextnobx])) { $txtextnob1 = $_POST[$txtextnobx]; }
				if(isset($_POST[$txtextqtyx])) { $txtextqty1 = $_POST[$txtextqtyx]; }
				if(isset($_POST[$recnobpx])) { $recnobp1 = $_POST[$recnobpx]; }
				if(isset($_POST[$recqtypx])) { $recqtyp1 = $_POST[$recqtypx]; }
				if(isset($_POST[$txtbalnobpx])) { $txtbalnobp1 = $_POST[$txtbalnobpx]; }
				if(isset($_POST[$txtbalqtypx])) { $txtbalqtyp1 = $_POST[$txtbalqtypx]; }
				
				$tbaln=$tbaln+$txtbalnobp1;
				$tbalq=$tbalq+$txtbalqtyp1;
				
				$taln=$taln+$recnobp1;
				$talq=$talq+$recqtyp1;
				
				if($recqtyp1!='' && $recqtyp1>0)
				{
					$sql_subsub="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtextnob1', '$txtextqty1', '$recnobp1', '$recqtyp1', '$txtbalnobp1', '$txtbalqtyp1', '$plantcode')";
					mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
				}
				/*if($srno2==2 && $recqtyp2!="" && $recqtyp2>0)
				{
					$sql_subsub1="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty) values ('$suid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtextnob2', '$txtextqty2', '$recnobp2', '$recqtyp2', '$txtbalnobp2', '$txtbalqtyp2')";
					mysqli_query($link,$sql_subsub1) or die(mysqli_error($link));*/
			}
			
			$sql_pnpsubbal="update tbl_pnpslipsub set pnpslipsub_bnob='$tbaln', pnpslipsub_bqty='$tbalq', pnpslipsub_availpnob='$taln', pnpslipsub_availpqty='$talq', pnpslipsub_pickpqty='$talq' where pnpslipsub_id='$suid' ";
			mysqli_query($link,$sql_pnpsubbal) or die(mysqli_error($link));
			
			if($txtconslqty1!="")
			{
			$sql_subsub2="insert into tbl_pnpslipsubsub2 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '0', '0', '$txtconslnob1', '$txtconslqty1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
			mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));
			}
			if($txtconslqty2!="")
			{
				$sql_subsub3="insert into tbl_pnpslipsubsub2 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '0', '0', '$txtconslnob2', '$txtconslqty2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
				mysqli_query($link,$sql_subsub3) or die(mysqli_error($link));
			}
			
		}
		}
		 $z1=$mainid;
		}
		//exit;
		
		$p_id=$z1;
		echo "<script>window.location='add_packslipwbsloc_preview.php?p_id=$p_id'</script>";	
	}

	$sql_code="SELECT MAX(pnpslipmain_code) FROM tbl_pnpslipmain where pnpslipmain_ttype='Packing Slip' and yearid='$yearid_id'  ORDER BY pnpslipmain_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TPS".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TPS".$code."/".$yearid_id."/".$lgnid;
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing slip</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="packingslipwb.js"></script>
<script src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function isNumberKey(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}
	  
function qtychk1(qtyval1,srno)
{
		var sbin="txtbalnobp"+srno;
		var nob="txtextnob"+srno;
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}	
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("NoB entered for Packing can be Equal to or Less than Existing NoB in Bin");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1);
	}
}

function Bagschk1(qtyval1,srno)
{
	var actnob="txtbalnobp"+srno;
	var sbin="txtbalqtyp"+srno;
	var nob="txtextqty"+srno;
	/*if(document.getElementById(actnob).value=="")
	{
		alert("Please enter NoB");
		var actqty="recqtyp"+srno;
		document.getElementById(actqty).value="";
		return false;
	}
	else*/ 
	if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("Qty entered for Packing can be Equal to or Less than Existing Qty in Bin");
		var actnob="recqtyp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=Math.round((parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1))*100)/100;
		
		var q1="";
		var q2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		
		document.getElementById('picqtyp').value=qtyg;
		document.getElementById('balpck').value=qtyg;
		document.getElementById(actnob).value="";
		document.getElementById(actnob).readOnly=false;
		document.getElementById(actnob).style.backgroundColor="#FFFFFF";
	}
}

function pform()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Packing Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	
		var q1="";
		var q2="";
		var g="";
		var g2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		g=document.frmaddDepartment.txtextqty1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
			g2=document.frmaddDepartment.txtextqty2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		
		if(parseFloat(qtyd)<parseFloat(qtyg))
		{
		alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
		return false;
		f=1;
		}	
	}
	
	if(f==1)
	{
		return false;
	}
	else
	{	
		/*var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			if(document.getElementById(acc).value!="")
			{ycc++;}
			else
			{ 
				if(document.getElementById('mpck_'+[l]).checked == true)
				{
					xcc++;
				} 
			}
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==x)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				f=1;
				return false;
			}
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
			}
		}*/
		
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//showUser(a,'postingtable','mform','','','','','');
		//showUser(a,'postingsubtable','mform','','','','','');
		}  
	}
}

function pformedtup()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	
		var q1="";
		var q2="";
		var g="";
		var g2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		g=document.frmaddDepartment.txtextqty1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
			g2=document.frmaddDepartment.txtextqty2.value;
		}
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		
		if(parseFloat(qtyd)<parseFloat(qtyg))
		{
		alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
		f=1;
		return false;
		}	
	}
	
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			if(document.getElementById(acc).value!="")
			{ycc++;}
			else
			{ 
				if(document.getElementById('mpck_'+[l]).checked == true)
				{
					xcc++;
				} 
			}
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==x)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				f=1;
				return false;
			}
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
			}
		}
		
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}

function modetchk(classval)
{
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		 alert("Please Select Packing Slip Reference Number");
		 document.frmaddDepartment.txtpsrn.focus();
		 document.frmaddDepartment.txtcrop.selectedIndex=0;
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		showUser(classval,'vitem','item','','','','','');
	}
}

function modetchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop");
		 document.frmaddDepartment.txtvariety.selectedIndex=0;
		 document.frmaddDepartment.txtcrop.focus();
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function openslocpop()
{
if(document.frmaddDepartment.txtoprname.value=="")
{
 alert("Please Select Operator Name");
 return false;
}
else if(document.frmaddDepartment.txttreattyp.value=="")
{
 alert("Please Select Treatment Schema");
 return false;
}
else if(document.frmaddDepartment.txtpacktype.value=="")
{
 alert("Please Select Pack Type");
 return false;
}
else
{
document.getElementById("postingsubsubtable").innerHTML="";
document.frmaddDepartment.txtlot1.value="";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;
var tid=document.frmaddDepartment.maintrid.value;
var dop=document.frmaddDepartment.dopc.value;
//alert(variety);
winHandle=window.open('getuser_packslipwb_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid+'&dop='+dop,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function openslocpop1()
{
if(document.frmaddDepartment.qc.value=="")
{
 alert("Please Select QC.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
var itm=document.frmaddDepartment.sstatus.value;
winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

}

function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
}

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','1','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','2','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtconslnob1.value!="")
		var Bagsv1=document.frmaddDepartment.txtconslnob1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtconslqty1.value!="")
		var qtyv1=document.frmaddDepartment.txtconslqty1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		document.frmaddDepartment.txtslbing2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtconslnob2.value!="")
		var Bagsv2=document.frmaddDepartment.txtconslnob2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtconslqty2.value!="")
		var qtyv2=document.frmaddDepartment.txtconslqty2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function qtyf1(qtyval, sval)
{
	var sbbin="txtconslnob"+sval;
	var nobb="txtconslqty"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagsf1(Bags1val, sval)
{
	var sbbin="sb"+sval;
	var nobb="txtconslnob"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}

function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}
function getdetails(stage)
{
/*if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
if(document.frmaddDepartment.txt1.value=="")
	{
 alert("Please Select Mode Of Transit.");
 document.frmaddDepartment.txt1.focus();
}*/

var get=document.frmaddDepartment.txtlot1.value;
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;


if(document.frmaddDepartment.txtlot1.value=="")
				{
					alert("Please enter Lot No.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(document.frmaddDepartment.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot1.focus();
				return false;
				}
				/*else{
				alert(" Please Enter Corret Lot No.");
				}*/
		var crop=document.frmaddDepartment.txtcrop.value;
        var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
		var dsrn="";
		var stage=document.frmaddDepartment.txtstage.value;
		var txtpacktype=document.frmaddDepartment.txtpacktype.value;
		//alert(tid);
		//alert(lotid);
		
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage,txtpacktype);
				//showUser(get,'postingsubtable','get',crop,variety,stage,'','');
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Packing Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	
		var q1="";
		var q2="";
		var g="";
		var g2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		g=document.frmaddDepartment.txtextqty1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
			g2=document.frmaddDepartment.txtextqty2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		
		if(parseFloat(qtyd)<parseFloat(qtyg))
		{
			alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
			return false;
			f=1;
		}	
	}
	else
	{
		if(document.frmaddDepartment.recqtyp1.value=="")
		{
			alert("Please check. Total Quantity Picked for Packing cannot be Blank");
			return false;
			f=1;
		}
	}
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		if(document.frmaddDepartment.sno.value==0)
		{
			alert("Please check. Standard Window Box not available for the selected Variety");
			return false;
			f=1;
		}
		else
		{
			if(document.frmaddDepartment.txtpktype.value=="Standard")
			{
				var ycc=0; var xcc=0;
				for(var l=1; l<=zzz; l++)
				{
					if(document.getElementById('fetchk_'+[l]).checked == true)
					{
						xcc++;
					} 
				}
				if(xcc==0)
				{
					alert("Please select UPS for Pack Seed");
					f=1;
					return false;
				}
			}
			else
			{
				var ycc=0; var xcc=0;
				for(var l=1; l<=zzz; l++)
				{
					if(document.getElementById('upsname_'+[l]).value!="")
					{
						xcc++;
					} 
					if(xcc==0)
					{
						alert("Please select UPS for Pack Seed");
						f=1;
						return false;
					}
					var xcc=0;
					if(document.getElementById('wbwts_'+[l]).value!="")
					{
						xcc++;
					} 
					if(xcc==0)
					{
						alert("Please enter NoP in WB");
						f=1;
						return false;
					}
					var xcc=0;
					if(document.getElementById('nomp_'+[l]).value!="")
					{
						xcc++;
					} 
					if(xcc==0)
					{
						alert("Please enter MP Weight");
						f=1;
						return false;
					}
					var xcc=0;
					if(document.getElementById('nowbinmp_'+[l]).value!="")
					{
						xcc++;
					} 
					if(xcc==0)
					{
						alert("Please enter MP Weight");
						f=1;
						return false;
					}
				}
				
			}
		}
	/*	if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==x)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				f=1;
				return false;
			}
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
			}
		}*/
		
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		return true;
		//showUser(a,'postingtable','mform','','','','','');
		//showUser(a,'postingsubtable','mform','','','','','');
		}  
	}
	
	/*if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;*/	 
}

function prochktyp(protypval)
{
	dt1=getDateObject(document.frmaddDepartment.dopc.value,"-");
	dt2=getDateObject(document.frmaddDepartment.qctestdate.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of QC Test (DoT) cannot be more than Date of Packing.");
		for( var i=0; i<document.frmaddDepartment.protyp.length; i++)
		{
			document.getElementById('protyp').checked=false;
		}
		document.frmaddDepartment.protype.value="";
		return false;
	}
	else if(document.frmaddDepartment.qcdtyp.value=="")
	{
		alert("QC Date Type cannot be blank.");
		for( var i=0; i<document.frmaddDepartment.protyp.length; i++)
		{
			document.getElementById('protyp').checked=false;
		}
		document.frmaddDepartment.protype.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.protype.value=protypval;
		if(protypval!="")
		{
			if(protypval=="E")
			{
				document.getElementById('recnobp1').value=document.frmaddDepartment.txtextnob1.value;
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value=0;
				document.getElementById('recqtyp1').value=document.frmaddDepartment.txtextqty1.value;
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value=0;
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value=document.frmaddDepartment.txtextnob2.value;
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value=0;
					document.getElementById('recqtyp2').value=document.frmaddDepartment.txtextqty2.value;
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value=0;
				}
				
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
			}
			else if(protypval=="P")
			{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=false;
				document.getElementById('recnobp1').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=false;
				document.getElementById('recqtyp1').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=false;
					document.getElementById('recnobp2').style.backgroundColor="#FFFFFF";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=false;
					document.getElementById('recqtyp2').style.backgroundColor="#FFFFFF";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
			}
			else
			{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
			}
		}
		else
		{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
		}
		document.getElementById('avlqtypck').value="";
		//alert(document.frmaddDepartment.paceptyp.length);
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
			//var fet="paceptyp"+q;
			document.getElementById("paceptyp").checked=false;
		}
			
		document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').value="";
		document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		document.getElementById('pcktype').value="";
		/*
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Fill";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}*/
		/*document.getElementById('slsync').innerHTML="";*/
		/*document.getElementById('txtwhg1').value="";
		document.getElementById('txtbing1').value="";
		document.getElementById('txtsubbg1').value="";
		document.getElementById('txtwhg2').value="";
		document.getElementById('txtbing2').value="";
		document.getElementById('txtsubbg2').value="";
		document.getElementById('txtwhg3').value="";
		document.getElementById('txtbing3').value="";
		document.getElementById('txtsubbg3').value="";
		document.getElementById('txtwhg4').value="";
		document.getElementById('txtbing4').value="";
		document.getElementById('txtsubbg4').value="";
		document.getElementById('txtwhg5').value="";
		document.getElementById('txtbing5').value="";
		document.getElementById('txtsubbg5').value="";
		document.getElementById('txtwhg6').value="";
		document.getElementById('txtbing6').value="";
		document.getElementById('txtsubbg6').value="";
		document.getElementById('txtwhg7').value="";
		document.getElementById('txtbing7').value="";
		document.getElementById('txtsubbg7').value="";
		document.getElementById('txtwhg8').value="";
		document.getElementById('txtbing8').value="";
		document.getElementById('txtsubbg8').value="";
		
		document.getElementById('nopmpcs_1').readOnly=true;
		document.getElementById('nopmpcs_1').value="";
		document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_2').readOnly=true;
		document.getElementById('nopmpcs_2').value="";
		document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_3').readOnly=true;
		document.getElementById('nopmpcs_3').value="";
		document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_4').readOnly=true;
		document.getElementById('nopmpcs_4').value="";
		document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_5').readOnly=true;
		document.getElementById('nopmpcs_5').value="";
		document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_6').readOnly=true;
		document.getElementById('nopmpcs_6').value="";
		document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_7').readOnly=true;
		document.getElementById('nopmpcs_7').value="";
		document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_8').readOnly=true;
		document.getElementById('nopmpcs_8').value="";
		document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noppchs_1').readOnly=true;
		document.getElementById('noppchs_1').value="";
		document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_2').readOnly=true;
		document.getElementById('noppchs_2').value="";
		document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_3').readOnly=true;
		document.getElementById('noppchs_3').value="";
		document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_4').readOnly=true;
		document.getElementById('noppchs_4').value="";
		document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_5').readOnly=true;
		document.getElementById('noppchs_5').value="";
		document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_6').readOnly=true;
		document.getElementById('noppchs_6').value="";
		document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_7').readOnly=true;
		document.getElementById('noppchs_7').value="";
		document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_8').readOnly=true;
		document.getElementById('noppchs_8').value="";
		document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptpchs_1').readOnly=true;
		document.getElementById('noptpchs_1').value="";
		document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_2').readOnly=true;
		document.getElementById('noptpchs_2').value="";
		document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_3').readOnly=true;
		document.getElementById('noptpchs_3').value="";
		document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_4').readOnly=true;
		document.getElementById('noptpchs_4').value="";
		document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_5').readOnly=true;
		document.getElementById('noptpchs_5').value="";
		document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_6').readOnly=true;
		document.getElementById('noptpchs_6').value="";
		document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_7').readOnly=true;
		document.getElementById('noptpchs_7').value="";
		document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_8').readOnly=true;
		document.getElementById('noptpchs_8').value="";
		document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptqtys_1').readOnly=true;
		document.getElementById('noptqtys_1').value="";
		document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_2').readOnly=true;
		document.getElementById('noptqtys_2').value="";
		document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_3').readOnly=true;
		document.getElementById('noptqtys_3').value="";
		document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_4').readOnly=true;
		document.getElementById('noptqtys_4').value="";
		document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_5').readOnly=true;
		document.getElementById('noptqtys_5').value="";
		document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_6').readOnly=true;
		document.getElementById('noptqtys_6').value="";
		document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_7').readOnly=true;
		document.getElementById('noptqtys_7').value="";
		document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_8').readOnly=true;
		document.getElementById('noptqtys_8').value="";
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
	}
}

function chkpronob(nobval)
{
	if(document.frmaddDepartment.srno2.value==2)
	{
		if(document.getElementById('recqtyp1').value=="" && document.getElementById('recqtyp2').value=="")
		{
			alert("Enter Packing Qty");
			return false;
		}
	}
	else
	{
		if(document.getElementById('recqtyp1').value=="")
		{
			alert("Enter Packing Qty");
			return false;
		}
	}
	if(nobval!="")
	document.getElementById('avlnobpck').value=nobval;
	else
	document.getElementById('avlnobpck').value="";
}

function chkproqty(qtyval)
{
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Enter Condition Seed NoB");
		document.frmaddDepartment.txtconqty.value="";
		return false;
	}
	else
	{
		document.getElementById('avlqtypck').value=qtyval;
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
		//var fet="paceptyp"+q;
		document.getElementById("paceptyp").checked=false;
		}
		
		document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').value="";
		document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		document.getElementById('pcktype').value="";
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			//var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			//document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			//var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			//document.getElementById(det).innerHTML="Fill";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
		/*document.getElementById('slsync').innerHTML="";*/
		/*document.getElementById('txtwhg1').value="";
		document.getElementById('txtbing1').value="";
		document.getElementById('txtsubbg1').value="";
		document.getElementById('txtwhg2').value="";
		document.getElementById('txtbing2').value="";
		document.getElementById('txtsubbg2').value="";
		document.getElementById('txtwhg3').value="";
		document.getElementById('txtbing3').value="";
		document.getElementById('txtsubbg3').value="";
		document.getElementById('txtwhg4').value="";
		document.getElementById('txtbing4').value="";
		document.getElementById('txtsubbg4').value="";
		document.getElementById('txtwhg5').value="";
		document.getElementById('txtbing5').value="";
		document.getElementById('txtsubbg5').value="";
		document.getElementById('txtwhg6').value="";
		document.getElementById('txtbing6').value="";
		document.getElementById('txtsubbg6').value="";
		document.getElementById('txtwhg7').value="";
		document.getElementById('txtbing7').value="";
		document.getElementById('txtsubbg7').value="";
		document.getElementById('txtwhg8').value="";
		document.getElementById('txtbing8').value="";
		document.getElementById('txtsubbg8').value="";
		
		document.getElementById('nopmpcs_1').readOnly=true;
		document.getElementById('nopmpcs_1').value="";
		document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_2').readOnly=true;
		document.getElementById('nopmpcs_2').value="";
		document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_3').readOnly=true;
		document.getElementById('nopmpcs_3').value="";
		document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_4').readOnly=true;
		document.getElementById('nopmpcs_4').value="";
		document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_5').readOnly=true;
		document.getElementById('nopmpcs_5').value="";
		document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_6').readOnly=true;
		document.getElementById('nopmpcs_6').value="";
		document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_7').readOnly=true;
		document.getElementById('nopmpcs_7').value="";
		document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_8').readOnly=true;
		document.getElementById('nopmpcs_8').value="";
		document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noppchs_1').readOnly=true;
		document.getElementById('noppchs_1').value="";
		document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_2').readOnly=true;
		document.getElementById('noppchs_2').value="";
		document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_3').readOnly=true;
		document.getElementById('noppchs_3').value="";
		document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_4').readOnly=true;
		document.getElementById('noppchs_4').value="";
		document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_5').readOnly=true;
		document.getElementById('noppchs_5').value="";
		document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_6').readOnly=true;
		document.getElementById('noppchs_6').value="";
		document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_7').readOnly=true;
		document.getElementById('noppchs_7').value="";
		document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_8').readOnly=true;
		document.getElementById('noppchs_8').value="";
		document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptpchs_1').readOnly=true;
		document.getElementById('noptpchs_1').value="";
		document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_2').readOnly=true;
		document.getElementById('noptpchs_2').value="";
		document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_3').readOnly=true;
		document.getElementById('noptpchs_3').value="";
		document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_4').readOnly=true;
		document.getElementById('noptpchs_4').value="";
		document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_5').readOnly=true;
		document.getElementById('noptpchs_5').value="";
		document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_6').readOnly=true;
		document.getElementById('noptpchs_6').value="";
		document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_7').readOnly=true;
		document.getElementById('noptpchs_7').value="";
		document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_8').readOnly=true;
		document.getElementById('noptpchs_8').value="";
		document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptqtys_1').readOnly=true;
		document.getElementById('noptqtys_1').value="";
		document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_2').readOnly=true;
		document.getElementById('noptqtys_2').value="";
		document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_3').readOnly=true;
		document.getElementById('noptqtys_3').value="";
		document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_4').readOnly=true;
		document.getElementById('noptqtys_4').value="";
		document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_5').readOnly=true;
		document.getElementById('noptqtys_5').value="";
		document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_6').readOnly=true;
		document.getElementById('noptqtys_6').value="";
		document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_7').readOnly=true;
		document.getElementById('noptqtys_7').value="";
		document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_8').readOnly=true;
		document.getElementById('noptqtys_8').value="";
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
	}
}
function chkconqty()
{
	var abc=0;
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Enter Condition Seed Qty");
		document.frmaddDepartment.txtconrem.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	if(document.frmaddDepartment.srno2.value==2)
	{
		abc=parseFloat(document.getElementById('recqtyp1').value)+ parseFloat(document.getElementById('recqtyp2').value);
	}
	else
	{
		abc=parseFloat(document.getElementById('recqtyp1').value);
	}	
	if(parseFloat(document.frmaddDepartment.txtconqty.value)> abc)
	{
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Packing");
		document.frmaddDepartment.txtconrem.value="";
		return false;
	}
}
function chkrm()
{
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Enter Remnant (RM)");
		document.frmaddDepartment.txtconim.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
}

function chkim(plval)
{
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Enter Inert Material (IM)");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	var tpl=parseFloat(document.frmaddDepartment.txtconrem.value)+parseFloat(document.frmaddDepartment.txtconim.value)+parseFloat(plval);
	var plper=parseFloat(document.getElementById('recqtyp1').value);
	if(document.frmaddDepartment.srno2.value==2)
	{
		plper=parseFloat(plper)+parseFloat(document.getElementById('recqtyp2').value);
	}
	
	//alert(tpl);
	//alert(document.frmaddDepartment.txtconqty.value);
	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.txtconqty.value);
	//alert((Math.round(totalval*1000)/1000));
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Packing is not eual to sum total of Condition Seed & Total Condition Loss");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconpl.focus();
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	document.frmaddDepartment.txtconloss.value=tpl;
	var vaal=parseFloat(document.frmaddDepartment.txtconloss.value)/parseFloat(plper)*100;
	document.frmaddDepartment.txtconper.value=Math.round((vaal)*100)/100;
	}
	}
}

function sschk1()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtstage.selectedIndex=0;
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function sschk2()
{
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Select Stage");
		document.frmaddDepartment.txtpromech.selectedIndex=0;
		document.frmaddDepartment.txtstage.focus();
		return false;
	}
}

function sschk3()
{
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Select Processing Machine Code");
		document.frmaddDepartment.txtoprname.selectedIndex=0;
		document.frmaddDepartment.txtpromech.focus();
		return false;
	}
}

function sschk4()
{
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Select Operator");
		document.frmaddDepartment.txttreattyp.selectedIndex=0;
		document.frmaddDepartment.txtoprname.focus();
		return false;
	}
}

function mpchk(val1, val12)
{
	if(document.getElementById('lble_'+[val12]).value=="")
	{
		alert("Please enter Label No.");
		document.getElementById('mpck_'+[val12]).checked=false
		document.getElementById('lble_'+[val12]).focus()
		return false;
	}
	else
	{
		if(document.getElementById('mpck_'+[val12]).checked == true)
		{
			document.getElementById('nomp_'+[val12]).readOnly=false;
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#ffffff";
			//alert(document.getElementById('packqty_'+[val12]).value);
			//alert(document.getElementById('wtmp_'+[val12]).value);
			document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
			
			var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
			//alert(document.getElementById('nopc_'+[val12]).value);
			//alert(balnop);
			document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
			document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
			//document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
			
			/*document.getElementById('slsync').innerHTML="";*/
			/*document.getElementById('txtwhg1').value="";
			document.getElementById('txtbing1').value="";
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtwhg8').value="";
			document.getElementById('txtbing8').value="";
			document.getElementById('txtsubbg8').value="";
			
			document.getElementById('nopmpcs_1').readOnly=true;
			document.getElementById('nopmpcs_1').value="";
			document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_2').readOnly=true;
			document.getElementById('nopmpcs_2').value="";
			document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_3').readOnly=true;
			document.getElementById('nopmpcs_3').value="";
			document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_4').readOnly=true;
			document.getElementById('nopmpcs_4').value="";
			document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_5').readOnly=true;
			document.getElementById('nopmpcs_5').value="";
			document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_6').readOnly=true;
			document.getElementById('nopmpcs_6').value="";
			document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_7').readOnly=true;
			document.getElementById('nopmpcs_7').value="";
			document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_8').readOnly=true;
			document.getElementById('nopmpcs_8').value="";
			document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noppchs_1').readOnly=true;
			document.getElementById('noppchs_1').value="";
			document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_2').readOnly=true;
			document.getElementById('noppchs_2').value="";
			document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_3').readOnly=true;
			document.getElementById('noppchs_3').value="";
			document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_4').readOnly=true;
			document.getElementById('noppchs_4').value="";
			document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_5').readOnly=true;
			document.getElementById('noppchs_5').value="";
			document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_6').readOnly=true;
			document.getElementById('noppchs_6').value="";
			document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_7').readOnly=true;
			document.getElementById('noppchs_7').value="";
			document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_8').readOnly=true;
			document.getElementById('noppchs_8').value="";
			document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptpchs_1').readOnly=true;
			document.getElementById('noptpchs_1').value="";
			document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_2').readOnly=true;
			document.getElementById('noptpchs_2').value="";
			document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_3').readOnly=true;
			document.getElementById('noptpchs_3').value="";
			document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_4').readOnly=true;
			document.getElementById('noptpchs_4').value="";
			document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_5').readOnly=true;
			document.getElementById('noptpchs_5').value="";
			document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_6').readOnly=true;
			document.getElementById('noptpchs_6').value="";
			document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_7').readOnly=true;
			document.getElementById('noptpchs_7').value="";
			document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_8').readOnly=true;
			document.getElementById('noptpchs_8').value="";
			document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptqtys_1').readOnly=true;
			document.getElementById('noptqtys_1').value="";
			document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_2').readOnly=true;
			document.getElementById('noptqtys_2').value="";
			document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_3').readOnly=true;
			document.getElementById('noptqtys_3').value="";
			document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_4').readOnly=true;
			document.getElementById('noptqtys_4').value="";
			document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_5').readOnly=true;
			document.getElementById('noptqtys_5').value="";
			document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_6').readOnly=true;
			document.getElementById('noptqtys_6').value="";
			document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_7').readOnly=true;
			document.getElementById('noptqtys_7').value="";
			document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_8').readOnly=true;
			document.getElementById('noptqtys_8').value="";
			document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
		}
		else
		{
			document.getElementById('nomp_'+[val12]).readOnly=true;
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			document.frmaddDepartment.detmpbno.value="";
			
			/*document.getElementById('slsync').innerHTML="";*/
			/*document.getElementById('txtwhg1').value="";
			document.getElementById('txtbing1').value="";
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtwhg8').value="";
			document.getElementById('txtbing8').value="";
			document.getElementById('txtsubbg8').value="";
			
			document.getElementById('nopmpcs_1').readOnly=true;
			document.getElementById('nopmpcs_1').value="";
			document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_2').readOnly=true;
			document.getElementById('nopmpcs_2').value="";
			document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_3').readOnly=true;
			document.getElementById('nopmpcs_3').value="";
			document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_4').readOnly=true;
			document.getElementById('nopmpcs_4').value="";
			document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_5').readOnly=true;
			document.getElementById('nopmpcs_5').value="";
			document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_6').readOnly=true;
			document.getElementById('nopmpcs_6').value="";
			document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_7').readOnly=true;
			document.getElementById('nopmpcs_7').value="";
			document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_8').readOnly=true;
			document.getElementById('nopmpcs_8').value="";
			document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noppchs_1').readOnly=true;
			document.getElementById('noppchs_1').value="";
			document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_2').readOnly=true;
			document.getElementById('noppchs_2').value="";
			document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_3').readOnly=true;
			document.getElementById('noppchs_3').value="";
			document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_4').readOnly=true;
			document.getElementById('noppchs_4').value="";
			document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_5').readOnly=true;
			document.getElementById('noppchs_5').value="";
			document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_6').readOnly=true;
			document.getElementById('noppchs_6').value="";
			document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_7').readOnly=true;
			document.getElementById('noppchs_7').value="";
			document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_8').readOnly=true;
			document.getElementById('noppchs_8').value="";
			document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptpchs_1').readOnly=true;
			document.getElementById('noptpchs_1').value="";
			document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_2').readOnly=true;
			document.getElementById('noptpchs_2').value="";
			document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_3').readOnly=true;
			document.getElementById('noptpchs_3').value="";
			document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_4').readOnly=true;
			document.getElementById('noptpchs_4').value="";
			document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_5').readOnly=true;
			document.getElementById('noptpchs_5').value="";
			document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_6').readOnly=true;
			document.getElementById('noptpchs_6').value="";
			document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_7').readOnly=true;
			document.getElementById('noptpchs_7').value="";
			document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_8').readOnly=true;
			document.getElementById('noptpchs_8').value="";
			document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptqtys_1').readOnly=true;
			document.getElementById('noptqtys_1').value="";
			document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_2').readOnly=true;
			document.getElementById('noptqtys_2').value="";
			document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_3').readOnly=true;
			document.getElementById('noptqtys_3').value="";
			document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_4').readOnly=true;
			document.getElementById('noptqtys_4').value="";
			document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_5').readOnly=true;
			document.getElementById('noptqtys_5').value="";
			document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_6').readOnly=true;
			document.getElementById('noptqtys_6').value="";
			document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_7').readOnly=true;
			document.getElementById('noptqtys_7').value="";
			document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_8').readOnly=true;
			document.getElementById('noptqtys_8').value="";
			document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
		}
	}
}

function balnopcheck(balval, val12)
{
	var bv=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
	//alert(bv);
	//alert(balval);
	if(parseInt(balval) > parseInt(bv))
	{
		alert("No. of Master Pack cannot be greater than "+bv);
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else
	{
		var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
		document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
		document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
	}
}
function pcksel(pkselval)
{ //alert(pkselval);
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		for( var i=0; i<document.frmaddDepartment.paceptyp.length; i++)
		{
			document.getElementById('paceptyp').checked=false;
		}
		document.frmaddDepartment.pcktype.value="";
		return false;
	}
	else
	{
		if(pkselval=="P")
		{
			document.getElementById('txtbalnobp1').value="";
			document.getElementById('recqtyp1').value="";
			document.getElementById('recqtyp1').readOnly=false;
			document.getElementById('recqtyp1').style.backgroundColor="#FFFFFF";
			document.getElementById('txtbalqtyp1').value="";
			for (var i=2; i<=document.frmaddDepartment.srno2.value;i++)
			{
				document.getElementById('txtbalnobp'+[i]).value="";
				document.getElementById('recqtyp'+[i]).value="";
				document.getElementById('recqtyp'+[i]).readOnly=false;
				document.getElementById('recqtyp'+[i]).style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalqtyp'+[i]).value="";
			}
			document.getElementById('picqtyp').value="";
			document.getElementById('balpck').value="";
			var sltn=document.frmaddDepartment.txtlot1.value;
			showUser(sltn,'pltno','pltnonew','','','','','');
		}
		else
		{
			var sltn=document.frmaddDepartment.txtlot1.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"P";
			document.frmaddDepartment.txtplotno.value=cltn;
			document.getElementById('txtbalnobp1').value=0;
			document.getElementById('recqtyp1').value=document.getElementById('txtextqty1').value;
			document.getElementById('recqtyp1').readOnly=true;
			document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp1').value=0;
			var val2=0.00;
			for (var i=2; i<=document.frmaddDepartment.srno2.value;i++)
			{
				document.getElementById('txtbalnobp'+[i]).value=0;
				document.getElementById('recqtyp'+[i]).value=document.getElementById('txtextqty'+[i]).value;
				document.getElementById('recqtyp'+[i]).readOnly=true;
				document.getElementById('recqtyp'+[i]).style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp'+[i]).value=0;
				val2=parseFloat(val2)+parseFloat(document.getElementById('txtextqty'+[i]).value);
			}
			document.getElementById('picqtyp').value=parseFloat(document.getElementById('txtextqty1').value)+parseFloat(val2);
			document.getElementById('picqtyp').readOnly=true;
			document.getElementById('picqtyp').style.backgroundColor="#cccccc";
			var pckloss=document.getElementById('pckloss').value;
			var ccloss=document.getElementById('ccloss').value;
			if(pckloss=="")pckloss=0;
			if(ccloss=="")ccloss=0;
			document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(pckloss)+parseFloat(ccloss))
		}
		document.getElementById('pcktype').value=pkselval;
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			//var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			//document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			//var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Fill";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
		/*document.getElementById('slsync').innerHTML="";*/
		/*document.getElementById('txtwhg1').value="";
		document.getElementById('txtbing1').value="";
		document.getElementById('txtsubbg1').value="";
		document.getElementById('txtwhg2').value="";
		document.getElementById('txtbing2').value="";
		document.getElementById('txtsubbg2').value="";
		document.getElementById('txtwhg3').value="";
		document.getElementById('txtbing3').value="";
		document.getElementById('txtsubbg3').value="";
		document.getElementById('txtwhg4').value="";
		document.getElementById('txtbing4').value="";
		document.getElementById('txtsubbg4').value="";
		document.getElementById('txtwhg5').value="";
		document.getElementById('txtbing5').value="";
		document.getElementById('txtsubbg5').value="";
		document.getElementById('txtwhg6').value="";
		document.getElementById('txtbing6').value="";
		document.getElementById('txtsubbg6').value="";
		document.getElementById('txtwhg7').value="";
		document.getElementById('txtbing7').value="";
		document.getElementById('txtsubbg7').value="";
		document.getElementById('txtwhg8').value="";
		document.getElementById('txtbing8').value="";
		document.getElementById('txtsubbg8').value="";
		
		document.getElementById('nopmpcs_1').readOnly=true;
		document.getElementById('nopmpcs_1').value="";
		document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_2').readOnly=true;
		document.getElementById('nopmpcs_2').value="";
		document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_3').readOnly=true;
		document.getElementById('nopmpcs_3').value="";
		document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_4').readOnly=true;
		document.getElementById('nopmpcs_4').value="";
		document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_5').readOnly=true;
		document.getElementById('nopmpcs_5').value="";
		document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_6').readOnly=true;
		document.getElementById('nopmpcs_6').value="";
		document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_7').readOnly=true;
		document.getElementById('nopmpcs_7').value="";
		document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_8').readOnly=true;
		document.getElementById('nopmpcs_8').value="";
		document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noppchs_1').readOnly=true;
		document.getElementById('noppchs_1').value="";
		document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_2').readOnly=true;
		document.getElementById('noppchs_2').value="";
		document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_3').readOnly=true;
		document.getElementById('noppchs_3').value="";
		document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_4').readOnly=true;
		document.getElementById('noppchs_4').value="";
		document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_5').readOnly=true;
		document.getElementById('noppchs_5').value="";
		document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_6').readOnly=true;
		document.getElementById('noppchs_6').value="";
		document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_7').readOnly=true;
		document.getElementById('noppchs_7').value="";
		document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_8').readOnly=true;
		document.getElementById('noppchs_8').value="";
		document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptpchs_1').readOnly=true;
		document.getElementById('noptpchs_1').value="";
		document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_2').readOnly=true;
		document.getElementById('noptpchs_2').value="";
		document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_3').readOnly=true;
		document.getElementById('noptpchs_3').value="";
		document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_4').readOnly=true;
		document.getElementById('noptpchs_4').value="";
		document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_5').readOnly=true;
		document.getElementById('noptpchs_5').value="";
		document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_6').readOnly=true;
		document.getElementById('noptpchs_6').value="";
		document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_7').readOnly=true;
		document.getElementById('noptpchs_7').value="";
		document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_8').readOnly=true;
		document.getElementById('noptpchs_8').value="";
		document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptqtys_1').readOnly=true;
		document.getElementById('noptqtys_1').value="";
		document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_2').readOnly=true;
		document.getElementById('noptqtys_2').value="";
		document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_3').readOnly=true;
		document.getElementById('noptqtys_3').value="";
		document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_4').readOnly=true;
		document.getElementById('noptqtys_4').value="";
		document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_5').readOnly=true;
		document.getElementById('noptqtys_5').value="";
		document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_6').readOnly=true;
		document.getElementById('noptqtys_6').value="";
		document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_7').readOnly=true;
		document.getElementById('noptqtys_7').value="";
		document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_8').readOnly=true;
		document.getElementById('noptqtys_8').value="";
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
	}
}

function chktotpouches(qtyval, qtyno)
{
	if(parseFloat(document.frmaddDepartment.balpck.value)!=parseFloat(qtyval))
	{
		alert("Please check. Quantity selected for packing and Quantity entered in Pack Seed is not matching");
		var packqty="packqty_"+qtyno;
		var nopc="nopc_"+qtyno;
		var domcs="domcs_"+qtyno;
		var lbls="lbls_"+qtyno;
		var domce="domce_"+qtyno;
		var lble="lble_"+qtyno;
		var mpck="mpck_"+qtyno;
		var nomp="nomp_"+qtyno;
		var noofpacks="noofpacks_"+qtyno;
		var detmpbno="detmpbno";
		
		document.getElementById(packqty).value="";
		document.getElementById(nopc).value="";
		document.getElementById(domcs).value="";
		document.getElementById(lbls).value="";
		document.getElementById(domce).value="";
		document.getElementById(lble).value="";
		document.getElementById(mpck).value="";
		document.getElementById(nomp).value="";
		document.getElementById(noofpacks).value="";
		document.getElementById(detmpbno).value="";
		return false;
	}
	else
	{
	var wtnop="wtnopkg_"+qtyno;
	var z="nopc_"+qtyno;
	var ds="noofpacks_"+qtyno;
	var zx=(parseFloat(qtyval)/parseFloat(document.getElementById(wtnop).value));
	document.getElementById(z).value=parseInt(zx);
	document.getElementById(ds).value=parseInt(zx);
	}
}

function domcchk(val1, val2)
{
	var x="domce_"+val2;
	var nopc="nopc_"+val2;
	var domcs="domcs_"+val2;
	if(document.getElementById(nopc).value=="" || document.getElementById(nopc).value==0)
	{
		alert("No. of Pouches cannot be Blank");
		document.getElementById(domcs).value="";
		document.getElementById(domcs).selectedIndex=0;
		document.getElementById(x).value="";
		return false
	}
	else
	{
		if(val1!="")
		{
			document.getElementById(x).value=val1;
		}
		else
		{
			document.getElementById(x).value="";
		}
	}
}

function domchk(dval)
{
	var x="domcs_"+dval;
	if(document.getElementById(x).value=="")
	{
		alert("Please select Label character");
		return false;
	}
}

function domchk1(lbval, dval)
{
	var x="lbls_"+dval;
	var tx="lble_"+dval;
	if(document.getElementById(x).value=="")
	{
		alert("Please enter Label number");
		document.getElementById(tx).focus();
		return false;
	}
	else
	{
		var z="nopc_"+dval;
		var xx="lble_"+dval;
		if(parseInt(lbval)-parseInt(document.getElementById(x).value)<parseInt(document.getElementById(z).value))
		{
			alert("Total Label nos. are not matching with No. of Pouches");
			document.getElementById(xx).value="";
			return false;
		}
	}
}

function pfpchk(pfpval)
{
	document.getElementById('balcqty').value=parseFloat(document.getElementById('avlqtypck').value)-parseFloat(pfpval);
	if(document.getElementById('balcqty').value<=0)
	{
		document.getElementById('balcqty').value=0;
		document.getElementById('balcnob').value=0;
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		//var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		//document.getElementById(det).innerHTML="Fill";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
	/*document.getElementById('slsync').innerHTML="";*/
	/*document.getElementById('txtwhg1').value="";
	document.getElementById('txtbing1').value="";
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtwhg8').value="";
	document.getElementById('txtbing8').value="";
	document.getElementById('txtsubbg8').value="";
	
	document.getElementById('nopmpcs_1').readOnly=true;
	document.getElementById('nopmpcs_1').value="";
	document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_2').readOnly=true;
	document.getElementById('nopmpcs_2').value="";
	document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_3').readOnly=true;
	document.getElementById('nopmpcs_3').value="";
	document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_4').readOnly=true;
	document.getElementById('nopmpcs_4').value="";
	document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_5').readOnly=true;
	document.getElementById('nopmpcs_5').value="";
	document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_6').readOnly=true;
	document.getElementById('nopmpcs_6').value="";
	document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_7').readOnly=true;
	document.getElementById('nopmpcs_7').value="";
	document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_8').readOnly=true;
	document.getElementById('nopmpcs_8').value="";
	document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noppchs_1').readOnly=true;
	document.getElementById('noppchs_1').value="";
	document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_2').readOnly=true;
	document.getElementById('noppchs_2').value="";
	document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_3').readOnly=true;
	document.getElementById('noppchs_3').value="";
	document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_4').readOnly=true;
	document.getElementById('noppchs_4').value="";
	document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_5').readOnly=true;
	document.getElementById('noppchs_5').value="";
	document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_6').readOnly=true;
	document.getElementById('noppchs_6').value="";
	document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_7').readOnly=true;
	document.getElementById('noppchs_7').value="";
	document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_8').readOnly=true;
	document.getElementById('noppchs_8').value="";
	document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptpchs_1').readOnly=true;
	document.getElementById('noptpchs_1').value="";
	document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_2').readOnly=true;
	document.getElementById('noptpchs_2').value="";
	document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_3').readOnly=true;
	document.getElementById('noptpchs_3').value="";
	document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_4').readOnly=true;
	document.getElementById('noptpchs_4').value="";
	document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_5').readOnly=true;
	document.getElementById('noptpchs_5').value="";
	document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_6').readOnly=true;
	document.getElementById('noptpchs_6').value="";
	document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_7').readOnly=true;
	document.getElementById('noptpchs_7').value="";
	document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_8').readOnly=true;
	document.getElementById('noptpchs_8').value="";
	document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptqtys_1').readOnly=true;
	document.getElementById('noptqtys_1').value="";
	document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_2').readOnly=true;
	document.getElementById('noptqtys_2').value="";
	document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_3').readOnly=true;
	document.getElementById('noptqtys_3').value="";
	document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_4').readOnly=true;
	document.getElementById('noptqtys_4').value="";
	document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_5').readOnly=true;
	document.getElementById('noptqtys_5').value="";
	document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_6').readOnly=true;
	document.getElementById('noptqtys_6').value="";
	document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_7').readOnly=true;
	document.getElementById('noptqtys_7').value="";
	document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_8').readOnly=true;
	document.getElementById('noptqtys_8').value="";
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
}
function pfpchk1(pfpval)
{
	if(document.getElementById('picqtyp').value=="" || document.getElementById('picqtyp').value==0)
	{
		alert("Quantity Picked for Packing cannot be blank or Zero");
		document.getElementById('pckloss').value="";
		return false;
	}
	else
	{
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('ccloss').value)+parseFloat(pfpval));
		document.getElementById('balpck').value=parseFloat(document.getElementById('balpck').value).toFixed(3);
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		//var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Fill";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
	/*document.getElementById('slsync').innerHTML="";*/
	/*document.getElementById('txtwhg1').value="";
	document.getElementById('txtbing1').value="";
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtwhg8').value="";
	document.getElementById('txtbing8').value="";
	document.getElementById('txtsubbg8').value="";
	
	document.getElementById('nopmpcs_1').readOnly=true;
	document.getElementById('nopmpcs_1').value="";
	document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_2').readOnly=true;
	document.getElementById('nopmpcs_2').value="";
	document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_3').readOnly=true;
	document.getElementById('nopmpcs_3').value="";
	document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_4').readOnly=true;
	document.getElementById('nopmpcs_4').value="";
	document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_5').readOnly=true;
	document.getElementById('nopmpcs_5').value="";
	document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_6').readOnly=true;
	document.getElementById('nopmpcs_6').value="";
	document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_7').readOnly=true;
	document.getElementById('nopmpcs_7').value="";
	document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_8').readOnly=true;
	document.getElementById('nopmpcs_8').value="";
	document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noppchs_1').readOnly=true;
	document.getElementById('noppchs_1').value="";
	document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_2').readOnly=true;
	document.getElementById('noppchs_2').value="";
	document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_3').readOnly=true;
	document.getElementById('noppchs_3').value="";
	document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_4').readOnly=true;
	document.getElementById('noppchs_4').value="";
	document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_5').readOnly=true;
	document.getElementById('noppchs_5').value="";
	document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_6').readOnly=true;
	document.getElementById('noppchs_6').value="";
	document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_7').readOnly=true;
	document.getElementById('noppchs_7').value="";
	document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_8').readOnly=true;
	document.getElementById('noppchs_8').value="";
	document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptpchs_1').readOnly=true;
	document.getElementById('noptpchs_1').value="";
	document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_2').readOnly=true;
	document.getElementById('noptpchs_2').value="";
	document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_3').readOnly=true;
	document.getElementById('noptpchs_3').value="";
	document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_4').readOnly=true;
	document.getElementById('noptpchs_4').value="";
	document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_5').readOnly=true;
	document.getElementById('noptpchs_5').value="";
	document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_6').readOnly=true;
	document.getElementById('noptpchs_6').value="";
	document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_7').readOnly=true;
	document.getElementById('noptpchs_7').value="";
	document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_8').readOnly=true;
	document.getElementById('noptpchs_8').value="";
	document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptqtys_1').readOnly=true;
	document.getElementById('noptqtys_1').value="";
	document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_2').readOnly=true;
	document.getElementById('noptqtys_2').value="";
	document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_3').readOnly=true;
	document.getElementById('noptqtys_3').value="";
	document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_4').readOnly=true;
	document.getElementById('noptqtys_4').value="";
	document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_5').readOnly=true;
	document.getElementById('noptqtys_5').value="";
	document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_6').readOnly=true;
	document.getElementById('noptqtys_6').value="";
	document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_7').readOnly=true;
	document.getElementById('noptqtys_7').value="";
	document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_8').readOnly=true;
	document.getElementById('noptqtys_8').value="";
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
}
function plchk1(pfpval)
{
	if(document.getElementById('pckloss').value=="")
	{
		alert("Packing Loss cannot be blank");
		document.getElementById('ccloss').value="";
		return false;
	}
	else
	{
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('pckloss').value)+parseFloat(pfpval));
		document.getElementById('balpck').value=parseFloat(document.getElementById('balpck').value).toFixed(3);
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		//var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Fill";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
	
	/*document.getElementById('slsync').innerHTML="";*/
	/*document.getElementById('txtwhg1').value="";
	document.getElementById('txtbing1').value="";
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtwhg8').value="";
	document.getElementById('txtbing8').value="";
	document.getElementById('txtsubbg8').value="";
	
	document.getElementById('nopmpcs_1').readOnly=true;
	document.getElementById('nopmpcs_1').value="";
	document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_2').readOnly=true;
	document.getElementById('nopmpcs_2').value="";
	document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_3').readOnly=true;
	document.getElementById('nopmpcs_3').value="";
	document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_4').readOnly=true;
	document.getElementById('nopmpcs_4').value="";
	document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_5').readOnly=true;
	document.getElementById('nopmpcs_5').value="";
	document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_6').readOnly=true;
	document.getElementById('nopmpcs_6').value="";
	document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_7').readOnly=true;
	document.getElementById('nopmpcs_7').value="";
	document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_8').readOnly=true;
	document.getElementById('nopmpcs_8').value="";
	document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noppchs_1').readOnly=true;
	document.getElementById('noppchs_1').value="";
	document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_2').readOnly=true;
	document.getElementById('noppchs_2').value="";
	document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_3').readOnly=true;
	document.getElementById('noppchs_3').value="";
	document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_4').readOnly=true;
	document.getElementById('noppchs_4').value="";
	document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_5').readOnly=true;
	document.getElementById('noppchs_5').value="";
	document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_6').readOnly=true;
	document.getElementById('noppchs_6').value="";
	document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_7').readOnly=true;
	document.getElementById('noppchs_7').value="";
	document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_8').readOnly=true;
	document.getElementById('noppchs_8').value="";
	document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptpchs_1').readOnly=true;
	document.getElementById('noptpchs_1').value="";
	document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_2').readOnly=true;
	document.getElementById('noptpchs_2').value="";
	document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_3').readOnly=true;
	document.getElementById('noptpchs_3').value="";
	document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_4').readOnly=true;
	document.getElementById('noptpchs_4').value="";
	document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_5').readOnly=true;
	document.getElementById('noptpchs_5').value="";
	document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_6').readOnly=true;
	document.getElementById('noptpchs_6').value="";
	document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_7').readOnly=true;
	document.getElementById('noptpchs_7').value="";
	document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_8').readOnly=true;
	document.getElementById('noptpchs_8').value="";
	document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptqtys_1').readOnly=true;
	document.getElementById('noptqtys_1').value="";
	document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_2').readOnly=true;
	document.getElementById('noptqtys_2').value="";
	document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_3').readOnly=true;
	document.getElementById('noptqtys_3').value="";
	document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_4').readOnly=true;
	document.getElementById('noptqtys_4').value="";
	document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_5').readOnly=true;
	document.getElementById('noptqtys_5').value="";
	document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_6').readOnly=true;
	document.getElementById('noptqtys_6').value="";
	document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_7').readOnly=true;
	document.getElementById('noptqtys_7').value="";
	document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_8').readOnly=true;
	document.getElementById('noptqtys_8').value="";
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
}
function clk(snoval,upsid)
{
	//alert(snoval);
	var sno=document.frmaddDepartment.sno.value;
	//alert(sno);
	if(document.frmaddDepartment.picqtyp.value=="")
	{
		alert("Picked for packing Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else if(document.frmaddDepartment.pchccqty.value=="")
	{
		alert("Pouch Captive Consumption Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else
	{
		if(snoval>0)
		{
			var upsname="upsname_"+snoval;
			document.frmaddDepartment.upssize.value=snoval;
			document.frmaddDepartment.upsidno.value=upsid;
		}
	}
}

function detailspop(dval2)
{
//alert(dval2);
	var sno=document.frmaddDepartment.sno.value;
	var dval=0;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		if(document.getElementById(fet).checked==true)
		dval=i;
	}
	//alert(dval);
	if(dval>0)
	{
		var tx="lble_"+dval;
		if(document.getElementById(tx).value=="")
		{
			alert("Please enter Label number");
			document.getElementById(tx).focus();
			return false;
		}
		else
		{
			var mpck="mpck_"+dval;
			var nomp="nomp_"+dval;
			if(document.getElementById(mpck).checked==true)
			{
				var totnomp=document.getElementById(nomp).value;
				var tid=document.frmaddDepartment.maintrid.value;
				var subtid=document.frmaddDepartment.subtrid.value;
				var lotno=document.frmaddDepartment.txtplotno.value;
				var txtpsrn=document.frmaddDepartment.txtpsrn.value;
				//alert(variety);
				if(dval2=="edit")
				{ 
				winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
				if(winHandle==null){
				alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
				}
				else
				{
				if(document.frmaddDepartment.detmpbno.value!="" && document.frmaddDepartment.detmpbno.value > 0)
				{
				winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
				if(winHandle==null){
				alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
				}
				else
				{
				winHandle=window.open('getuser_pronpslip_barcode_sel.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
				if(winHandle==null){
				alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
				}
				}
			}
		}
	}
}

function wh(wh1val, whno)
{ 	//alert(wh1val);
	//alert(whno);
	if(whno==1)
	{
		var z=0; var xs=0;
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="nopc_"+i;
			if(document.getElementById(fet).value=="")
			{z++;}
			else
			{xs=i;}
		}
		
		if(z==sno)
		{
			alert("Please select UPS");
			return false;
		}
		if(xs!=0)
		{ //alert(xs);
			var fet="nomp_"+xs;
			//alert(document.getElementById(fet).value);
			//alert(document.frmaddDepartment.detmpbno.value);
			if(document.getElementById(fet).value!="")
			{
				if(document.getElementById(fet).value!=document.frmaddDepartment.detmpbno.value)
				{
					alert("Barcode Labels are not matching with No. of Master Pack");
					return false;
				}
			}
		}
	}
	else
	{
		var whn=whno-1;
		var tqty="noptqtys_"+whn;
		var tqty1="txtwhg"+whno;
		if(document.getElementById(tqty).value=="")
		{
			alert("Please enter Master Pack/Pouches details in previous Bin");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
	}
	var bin="bingn"+whno;
	showUser(wh1val,bin,'whnew',bin,whno,'','','');
}

function bin(bin2val, binno)
{
	var whc="txtwhg"+binno;
	var sbin="sbingn"+binno;
	var binc="txtsubbg"+binno;
	if(document.getElementById(whc).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		showUser(bin2val,sbin,'binnew',binc,binno,'','','');
	}
}

function subbin(subbin2val, subbinno)
{	
	var binc="txtbing"+subbinno;
	if(document.getElementById(binc).value=="")
	{	
		alert("Please select Bin");
		return false;
	}
	else
	{
		var itemv=document.frmaddDepartment.txtvariety.value;
		var slocnogood="Pack";
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1="";
		var qtyv1="";
		var ssbin="slocr"+subbinno;
		var bins="txtsubbg"+subbinno;
		showUser(subbin2val,ssbin,'subbinnew',itemv,bins,slocnogood,subbinno,subbinno,trid);
		setTimeout(function() { sloccomment(subbinno); },800);
	}
}

function sloccomment(rval)
{
	//alert(rval);
	var mp="nopmpcs_"+rval;
	var p="noppchs_"+rval;
	var tp="noptpchs_"+rval;
	var tq="noptqtys_"+rval;
	var existview="existview"+rval;
	var trflg="trflg"+rval;
	var tpflg="tpflg"+rval;
	var tflg="tflg"+rval;
	var tpmflg="tpmflg"+rval;
	if(document.getElementById(existview).value=="")
	{
		setTimeout(function() { sloccomment(rval); },800);
	}
	else if((document.getElementById(trflg).value!="" && document.getElementById(tpflg).value!="" && document.getElementById(tflg).value!="" && document.getElementById(tpmflg).value!="") && (document.getElementById(trflg).value==0 && document.getElementById(tpflg).value==0 && document.getElementById(tflg).value==0 && document.getElementById(tpmflg).value==0))
	{
		if(document.frmaddDepartment.detmpbno.value!="" || document.frmaddDepartment.detmpbno.value > 0)
		{
			document.getElementById(mp).value="";
			document.getElementById(mp).readOnly=false;
			document.getElementById(mp).style.backgroundColor="#ffffff";
		}
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=false;
		document.getElementById(p).style.backgroundColor="#ffffff";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
	}
	else
	{
		document.getElementById(mp).value="";
		document.getElementById(mp).readOnly=true;
		document.getElementById(mp).style.backgroundColor="#cccccc";
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=true;
		document.getElementById(p).style.backgroundColor="#cccccc";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
		alert("Please select different Sub Bin");
		return false;
	}
}
function pacsbinchk(mpval, mpno)
{
	if(document.getElementById('txtsubbg'+[mpno]).value=="")
	{
		alert("Please Select Subbin first");
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
			}
		}
		if(document.getElementById('noppchs_'+[mpno]).value!="")
		{
		document.getElementById('noptpchs_'+[mpno]).value=parseInt(d)+parseInt(document.getElementById('noppchs_'+[mpno]).value);
		document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(npwt)*parseFloat(document.getElementById('noppchs_'+[mpno]).value))+(parseFloat(mpval)*parseFloat(dd));
		document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
		else
		{
		document.getElementById('noptpchs_'+[mpno]).value=parseInt(d);
		document.getElementById('noptqtys_'+[mpno]).value=parseFloat(mpval)*parseFloat(dd);
		document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
	}
}

function pacpchchk(pchval, pchno)
{
	if(document.getElementById('txtsubbg'+[pchno]).value=="")
	{
		alert("Please Select Subbin first");
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		var mpval=document.getElementById('nopmpcs_'+[pchno]).value;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
			}
		}
		if(mpval!="")
		{
		document.getElementById('noptpchs_'+[pchno]).value=parseInt(d)+parseInt(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(npwt)*parseFloat(pchval))+(parseFloat(mpval)*parseFloat(dd));
		document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		else
		{
		document.getElementById('noptpchs_'+[pchno]).value=parseInt(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=parseFloat(npwt)*parseFloat(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		document.frmaddDepartment.linkpch.value=parseInt(document.frmaddDepartment.linkpch.value)+parseInt(pchval);
		
		document.frmaddDepartment.bpch.value=parseInt(document.frmaddDepartment.extbpch.value)-parseInt(document.frmaddDepartment.linkpch.value);
		//if(parseInt(document.frmaddDepartment.linkpch.value) > parseInt(document.frmaddDepartment.extbpch.value))document.frmaddDepartment.linkpch.value=0;
	}
}
function openpackdetails(subtid,tid)
{
winHandle=window.open('packdetails_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 

function dateDiff(dateEarlier, dateLater) 
{
	var x=dateEarlier.split("-");
	var y=dateLater.split("-");
	dateEarlier=new Date(x[2],x[1]-1,x[0]);
	dateLater=new Date(y[2],y[1]-1,y[0]);
	var one_day=1000*60*60*24
    return (  Math.round((dateLater.getTime()-dateEarlier.getTime())/one_day)  );
}


function chkvalidity(valval)
{
	/*if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Enter Processing Loss");
		document.frmaddDepartment.txtconpl.focus();
		return false;
	}
	else
	{*/
	if(valval!="")
	{
		dt1=getDateObject(document.frmaddDepartment.date.value,"-");
		dt2=getDateObject(document.frmaddDepartment.dp1.value,"-");
		dt3=getDateObject(document.frmaddDepartment.dp2.value,"-");
		dt4=getDateObject(document.frmaddDepartment.dp3.value,"-");
		dt5=getDateObject(document.frmaddDepartment.dp4.value,"-");
		dt6=getDateObject(document.frmaddDepartment.dp5.value,"-");
		dt7=getDateObject(document.frmaddDepartment.dp6.value,"-");
		if(document.frmaddDepartment.qcdtyp.value=="DoT")
		{
			if(valval==3)
			{
				if(dt2 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp1.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp1.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt3 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp2.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp2.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt4 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp3.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp3.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
		}
		else if(document.frmaddDepartment.qcdtyp.value=="DoSF")
		{
			if(valval==3)
			{
				if(dt5 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp4.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp4.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt6 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp5.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp5.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt7 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp6.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp6.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
		}
		else
		{
			document.frmaddDepartment.validityupto.value="";
			document.frmaddDepartment.valdays.value="";
		}
	}
	else
	{
		document.frmaddDepartment.validityupto.value="";
		document.frmaddDepartment.valdays.value="";
	}
	//}
}
function datesel(dopc)
{
	document.getElementById("postingsubsubtable").innerHTML="";
	document.frmaddDepartment.txtlot1.value="";
	showCalendar(dopc);
}

function openprintsubbin(subid, bid, wid, lid)
{
var itm="";
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function packagingdetails(lotno, ups)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	winHandle=window.open('lotpackaging_details.php?lotno='+lotno+'&ups='+ups+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocsyn(tval)
{
	if(document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0)
	{
		alert("Please attach Barcodes First");
		return false;
	}
	else
	{
		document.frmaddDepartment.slocssyncs24.value=tval;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var lotno=document.frmaddDepartment.txtplotno.value;
		var txtpsrn=document.frmaddDepartment.txtpsrn.value;
		var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
		var ups=document.frmaddDepartment.upsidno.value;
		var sno=document.frmaddDepartment.sno.value;
		var bpch=0;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var noofpacks="noofpacks_"+i;
				bpch=document.getElementById(noofpacks).value;
			}
		}
		//alert(slocssyncs);
		showUser(lotno,'slocsync','slocsyncshow',txtpsrn,crop,variety,slocssyncs,ups,bpch);
		//alert("HI");
		/*winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }*/
	}
}
function bcsyncchk()
{
	if(document.frmaddDepartment.mobar.value!="" || document.frmaddDepartment.mobar.value > 0) 
	{
		document.getElementById("slsync").innerHTML="";
		var v1="synchn";
		var mobar=document.frmaddDepartment.mobar.value;
		showUser(v1,'slsync','slsynchk',mobar,'','','','');
	}
	else
	{
		document.getElementById("slsync").innerHTML="";
		var v1="nosynchn";
		var mobar=document.frmaddDepartment.mobar.value;
		showUser(v1,'slsync','slsynchk',mobar,'','','','');
	}
}
function showbarc(barcval)
{
	winHandle=window.open('lot_barcodes.php?barcval='+barcval,'WelCome','top=170,left=180,width=200,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function balbclink(barcval)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	var lotno=document.frmaddDepartment.txtplotno.value;
	var txtpsrn=document.frmaddDepartment.txtpsrn.value;
	var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
	
	winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&slocssyncs='+slocssyncs,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function cnonzchk(nobval, snval)
{
	var txtbalnobp="txtbalnobp"+snval;
	var txtbalqtyp="txtbalqtyp"+snval;
	if(parseFloat(document.getElementById(txtbalqtyp).value) > 0 && parseInt(document.getElementById(txtbalnobp).value)==0)
	{
		alert("NoB cannot be Zero");
		document.getElementById(txtbalnobp).value="";
		document.getElementById(txtbalnobp).focus();
		return false;
	}
}

function qctpchk(qtval)
{
	document.frmaddDepartment.qcdttype.value=qtval;
	document.frmaddDepartment.validityupto.value="";
	document.frmaddDepartment.valdays.value="";
	document.frmaddDepartment.validityperiod.value="";
	document.frmaddDepartment.validityperiod.selectedIndex=0;
	
	if(qtval=="")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot1.value;
	else if(qtval=="")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot2.value;
	else
		document.frmaddDepartment.qctestdate.value="";
}

function ptselect(ptval)
{
	document.frmaddDepartment.txtpacktype.value=ptval;
}




function upck(upval, snoval)
{
	var upsval="upsval_"+snoval;
	if(document.frmaddDepartment.picqtyp.value=="")
	{
		alert("Picked for packing Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else if(document.frmaddDepartment.pchccqty.value=="")
	{
		alert("Pouch Captive Consumption Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else
	{
		
		var upssizetyp="upssizetyp_"+snoval;
		var upsname="upsname_"+snoval;
		var packqty="packqty_"+snoval;
		var nopc="nopc_"+snoval;
		var nopinwb="nopinwb_"+snoval;
		var wbwts="wbwts_"+snoval;
		var mpwts="mpwts_"+snoval;
		var nomp="nomp_"+snoval;
		var nowbinmp="nowbinmp_"+snoval;
		
		
		document.getElementById(nopinwb).value="";
		document.getElementById(wbwts).value="";
		document.getElementById(mpwts).value="";
		document.getElementById(nomp).value="";
		document.getElementById(nowbinmp).value="";
		
		var wtnopkg="wtnopkg_"+snoval;
		if(document.getElementById(upsval).value=="")
		{
			alert("Please enter UPS");
			document.getElementById(upssizetyp).value="";
			document.getElementById(upsname).value="";
			document.getElementById(nopc).value="";
			document.getElementById(nopinwb).value="";
			document.getElementById(wbwts).value="";
			//document.getElementById(mpck).checked=false;
			document.getElementById(mpwts).value="";
			document.getElementById(nomp).value="";
			document.getElementById(wtnopkg).value="";
			document.getElementById(nowbinmp).value="";
			//document.frmaddDepartment.extbpch.value=0;
			document.getElementById(upsval).focus();
			return false;
		}
		else if(parseFloat(document.getElementById(upsval).value)<1)
		{
			alert("UPS cannot be Zero(0) or less i.e. 0.1 not allowed");
			document.getElementById(upssizetyp).value="";
			document.getElementById(upsname).value="";
			document.getElementById(nopc).value="";
			document.getElementById(nopinwb).value="";
			document.getElementById(wbwts).value="";
			//document.getElementById(mpck).checked=false;
			document.getElementById(mpwts).value="";
			document.getElementById(nomp).value="";
			document.getElementById(wtnopkg).value="";
			document.getElementById(nowbinmp).value="";
			//document.frmaddDepartment.extbpch.value=0;
			document.getElementById(upsval).focus();
			return false;
		}
		else
		{
			var z="000";
			var val=upval.split(".");
			//alert(val.length);
			//alert(val);
			if(val.length>1)
			{
			if(val[1]<=0 || val[1]=="undefined")
				z="000";
			else
				z=val[1];
			}
			
			//alert(z);
			var d=val[0]+"."+z;
			d=parseFloat(d).toFixed(3);
			//alert(d);
			document.getElementById(upsval).value=d;
			
			
			if(document.getElementById(upssizetyp).value!="")
			{
				document.getElementById(upsval).value=parseFloat(document.getElementById(upsval).value).toFixed(3);
				document.getElementById(upsname).value=document.getElementById(upsval).value+" "+document.getElementById(upssizetyp).value;
				
				var needle=document.getElementById(upsname).value;
				var haystack=document.frmaddDepartment.polup.value.split(",");
				var length = haystack.length;
				var r=0;
				for(var i = 0; i < length; i++) 
				{
					if(haystack[i] == needle) r++;
				}
				
				document.getElementById(packqty).value=parseFloat(document.getElementById('balpck').value);
				
				var pt="";
				if(upval=="Gms")
				{
					pt=(1000/parseFloat(document.getElementById(upsval).value));
					document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)*parseFloat(pt);
					document.getElementById(wtnopkg).value=document.getElementById(upsval).value/1000;
					//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
				}
				else
				{
					pt=document.getElementById(upsval).value;
					document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)/parseFloat(pt);
					document.getElementById(wtnopkg).value=document.getElementById(upsval).value;
					//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
				}
				
				var nps=document.getElementById(nopc).value.split(".");
				if(parseFloat(nps[1]) > 0)
				{
					alert("Check Qty. entered. Quantity entered is not convertible into whole number of pouches, as per given UPS.");
					document.getElementById(upssizetyp).value="";
					document.getElementById(upsname).value="";
					document.getElementById(nopc).value="";
					document.getElementById(nopinwb).value="";
					document.getElementById(wbwts).value="";
					document.getElementById(mpck).checked=false;
					document.getElementById(mpwts).value="";
					document.getElementById(nomp).value="";
					document.getElementById(wtnopkg).value="";
					document.getElementById(nowbinmp).value="";
					//document.frmaddDepartment.extbpch.value=0;
					document.getElementById(upsval).focus();
					return false;
				}
				
				
			}
		}
	}
}
function updmerg(upval, snoval)
{
	var upsval="upsval_"+snoval;
	var upssizetyp="upssizetyp_"+snoval;
	var upsname="upsname_"+snoval;
	var packqty="packqty_"+snoval;
	var nopc="nopc_"+snoval;
	var nopinwb="nopinwb_"+snoval;
	var wbwts="wbwts_"+snoval;
	var mpwts="mpwts_"+snoval;
	var nomp="nomp_"+snoval;
	var nowbinmp="nowbinmp_"+snoval;
	
	
	document.getElementById(nopinwb).value="";
	document.getElementById(wbwts).value="";
	document.getElementById(mpwts).value="";
	document.getElementById(nomp).value="";
	//document.getElementById(wtnopkg).value="";
	document.getElementById(nowbinmp).value="";
	
	var wtnopkg="wtnopkg_"+snoval;
	if(document.getElementById(upsval).value=="")
	{
		alert("Please enter UPS");
		document.getElementById(upssizetyp).value="";
		document.getElementById(upsname).value="";
		document.getElementById(nopc).value="";
		document.getElementById(nopinwb).value="";
		document.getElementById(wbwts).value="";
		document.getElementById(mpck).checked=false;
		document.getElementById(mpwts).value="";
		document.getElementById(nomp).value="";
		document.getElementById(wtnopkg).value="";
		document.getElementById(nowbinmp).value="";
		document.getElementById(upsval).focus();
		return false;
	}
	else
	{
		document.getElementById(upsval).value=parseFloat(document.getElementById(upsval).value).toFixed(3);
		document.getElementById(upsname).value=document.getElementById(upsval).value+" "+document.getElementById(upssizetyp).value;
				
		var needle=document.getElementById(upsname).value;
		var haystack=document.frmaddDepartment.polup.value.split(",");
		var length = haystack.length;
		
		var r=0;
		for(var i = 0; i < length; i++) 
		{
			if(haystack[i] == needle) r++;
		}
			
		document.getElementById(packqty).value=parseFloat(document.getElementById('balpck').value);
		var pt="";
		if(upval=="Gms")
		{
			pt=(1000/parseFloat(document.getElementById(upsval).value));
			document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)*parseFloat(pt);
			document.getElementById(wtnopkg).value=document.getElementById(upsval).value/1000;
			//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
		}
		else
		{
			pt=document.getElementById(upsval).value;
			document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)/parseFloat(pt);
			document.getElementById(wtnopkg).value=document.getElementById(upsval).value;
			//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
		}
		document.getElementById(nopc).value=parseFloat(document.getElementById(nopc).value).toFixed(3);
		var nps=document.getElementById(nopc).value.split(".");
		document.getElementById(nopc).value=parseInt(document.getElementById(nopc).value);
		if(parseFloat(nps[1]) > 0)
		{
			alert("Check Qty. entered. Quantity entered is not convertible into whole number of pouches, as per given UPS.");
			document.getElementById(upssizetyp).value="";
			document.getElementById(upsname).value="";
			document.getElementById(nopc).value="";
			document.getElementById(nopinwb).value="";
			document.getElementById(wbwts).value="";
			document.getElementById(mpck).checked=false;
			document.getElementById(mpwts).value="";
			document.getElementById(nomp).value="";
			document.getElementById(wtnopkg).value="";
			document.getElementById(nowbinmp).value="";
			document.getElementById(upsval).focus();
			return false;
		}
		
		
	}
}

function calnopinwb(nopwbval)
{
	//alert(nopwbval);
	var snoval=1;
	var upsval="upsval_"+snoval;
	var upssizetyp="upssizetyp_"+snoval;
	var upsname="upsname_"+snoval;
	var packqty="packqty_"+snoval;
	var nopc="nopc_"+snoval;
	var nopinwb="nopinwb_"+snoval;
	var wbwts="wbwts_"+snoval;
	var mpwts="mpwts_"+snoval;
	var nomp="nomp_"+snoval;
	var nowbinmp="nowbinmp_"+snoval;
	
	//alert(document.getElementById(upsval).value);
	//alert(document.getElementById(upssizetyp).value);
	//alert(document.getElementById(packqty).value);
	
	if(document.getElementById(upssizetyp).value=="Gms")
	{
		document.getElementById(wbwts).value=parseFloat(document.getElementById(upsval).value)*parseFloat(nopwbval);
		document.getElementById(wbwts).value=parseFloat(document.getElementById(wbwts).value)/1000;
	}
	else
	{
		document.getElementById(wbwts).value=parseFloat(document.getElementById(upsval).value)*parseFloat(nopwbval);
	}
	if(document.getElementById(mpwts).value!="")
	{
		document.getElementById(nowbinmp).value=parseFloat(document.getElementById(mpwts).value)/parseFloat(document.getElementById(wbwts).value);
		//document.getElementById(wbwts).value=parseFloat(document.getElementById(wbwts).value)/1000;
	}
	
}

function bnpchk(val1, val12)
{
	document.getElementById('nowbinmp_'+[val12]).value='';
	document.getElementById('nomp_'+[val12]).value='';
	if(document.getElementById('mpwts_'+[val12]).value != "")
	{
		document.getElementById('mpwts_'+[val12]).readOnly=false;
		document.getElementById('mpwts_'+[val12]).style.backgroundColor="#ffffff";
			
		var upsval="upsval_"+val12;
		var upssizetyp="upssizetyp_"+val12;
		var mpwts="mpwts_"+val12;
		if(document.getElementById(upssizetyp).value=="Gms")
		{
			var n=document.getElementById(upsval).value;
			var cx=document.getElementById(upsval).value/1000;
		}
		else
		{
			var n=document.getElementById(upsval).value*1000;
			var cx=document.getElementById(upsval).value;
		}
		var needle=document.getElementById(mpwts).value;
		var haystack=document.frmaddDepartment.polwtmp.value.split(",");
		var needle1=document.getElementById(upsval).value+' '+document.getElementById(upssizetyp).value;
		var haystack1=document.frmaddDepartment.polup.value.split(",");
		var length = haystack.length;
		var r=0;
		for(var i = 0; i < length; i++) 
		{
			if(haystack1[i] == needle1)
			{
			if(haystack[i] == needle) r++;
			}
		}
		
		if(r > 0)
		{
			alert("Standard Master Pack Size is available for the entered UPS");
			document.getElementById('mpwts_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nowbinmp_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			//document.frmaddDepartment.detmpbno.value="";
			return false;
		}	
		
		var nop=parseFloat(val1)*parseFloat(1000/n);
		var wtm=parseFloat(cx)*parseFloat(nop);
		var nzzz=Math.round(nop*100)/100;
		var zz=nzzz+'';
		var zzz=zz.split(".");
		if(zzz[1] > 0)
		{
			alert("Enter Valid Wt. in Master Pack.\nPouch can not be fractional")
			document.getElementById('mpwts_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nowbinmp_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			//document.frmaddDepartment.detmpbno.value="";
			return false;
		}
		else
		{
			document.getElementById('wtnop_'+[val12]).value=nop;
			document.getElementById('wtmp_'+[val12]).value=wtm;
			document.getElementById('wtnopkg_'+[val12]).value=cx;
		}
		
		document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
		
		document.getElementById('nowbinmp_'+[val12]).value=parseFloat(document.getElementById('mpwts_'+[val12]).value)/parseFloat(document.getElementById('wbwts_'+[val12]).value);
		
		var val=document.getElementById('nowbinmp_'+[val12]).value.split(".");
		//alert(val.length);
		//alert(val);
		if(val.length>1)
		{
			alert("Total Window Box in 1 Master Pack cannot be in decimals");
			document.getElementById('mpwts_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nowbinmp_'+[val12]).value="";
		}
		//var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
		
		//document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
		//document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
		//document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
		//document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
		//document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
	}
	else
	{
		//document.getElementById('nomp_'+[val12]).readOnly=true;
		//document.getElementById('nomp_'+[val12]).value="";
		//document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
		document.getElementById('nomp_'+[val12]).value="";
		document.getElementById('nowbinmp_'+[val12]).value="";
		//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
		//document.frmaddDepartment.detmpbno.value="";
	}
}

</script>

<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Packing slip (Window Box)&nbsp;<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >

<?php
   $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];
$trtype=$row_tbl['pnpslipmain_ttype'];
$trtyp='ST';
if($trtype=="NST Packing Slip"){$trtyp='NST';}

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
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Packing Slip (Window Box) - SLOC Updation </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Indent&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="157" align="right"  valign="middle" class="smalltblheading">Packing Slip Ref./indent No.&nbsp;</td>
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

</table><br />


<?php
$arrival_id;
$sqltblsub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbl_tot=mysqli_num_rows($sqltblsub);
$rowtblsub=mysqli_fetch_array($sqltblsub);
$subtid=0;
?>

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="120" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Pack Type&nbsp;</td>
<td align="left" width="273" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<?php if($row_tbl['pnpslipmain_ttype']!="NST Packing Slip") {echo "Standard";} else {echo "Non-standard";}?><input type="hidden" name="txtpacktype" value="<?php if($row_tbl['pnpslipmain_ttype']!="NST Packing Slip") {echo "Standard";} else {echo "Non-standard";}?>" /></td>
<td align="right" width="93" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="200" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<?php echo $rowtblsub['pnpslipsub_lotno']?>
  <input name="txtlot1" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $rowtblsub['pnpslipsub_lotno']?>" readonly="true" style="background-color:#CCCCCC" ></td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block">



















<?php

$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row['pnpslipsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
 while($row_issue=mysqli_fetch_array($lotqry))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

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
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
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
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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

$tdt="";
$sql_qcs=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='$ltno' and qcstatus='OK' order by tid desc Limit 0,2") or die(mysqli_error($link));
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

$crdate=date("d-m-Y");
$now = strtotime($qcdot1); // or your date as well
$your_date = strtotime($crdate);
$datediff2 = (($your_date - $now)/(60*60*24));
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
    <td width="149" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="98" align="center" valign="middle" class="smalltblheading" >Total NoB</td>
    <td width="113" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="113" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="113" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="113" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<!--<td width="253" align="center" valign="middle" class="smalltblheading">Process Entire</td>
	<td width="225" align="center" valign="middle" class="smalltblheading">Process Partial</td>
   <td width="121" align="center" valign="middle" class="smalltblheading" >NoB</td>
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
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" >
	<?php if($row['pnpslipsub_qcdttype']==""){ ?>
	<option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
	<?php }	?>
	<?php if($row['pnpslipsub_qcdttype']!=""){ ?>
	<option value="DoT" <?php if($qcdot1!="" && $row['pnpslipsub_qcdttype']=="DoT") echo "selected"; ?> >DoT</option>
	<option value="DoSF" <?php if($qcdot2!="" && $row['pnpslipsub_qcdttype']=="DoSF") echo "selected"; ?> >DoSF</option>
	<?php }	?>
	</select>
	</td>
	<!--<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" id="protyp" value="E" onclick="prochktyp(this.value)" class="smalltbltext" <?php if($row['pnpslipsub_processtype']=="E") echo "checked"; ?>  /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" value="P" id="protyp" onclick="prochktyp(this.value)" class="smalltbltext" <?php if($row['pnpslipsub_processtype']=="P") echo "checked"; ?>  /></td>
   <td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtnob" id="txtnob" class="smalltbltext" value="" size="8" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="txtqty" class="smalltbltext" value="" size="8" /></td>-->
  </tr> <input name="protype" value="<?php echo $row['pnpslipsub_processtype'];?>" type="hidden"> 
</table>
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
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);" <?php if($row['pnpslipsub_packtype']=="E") echo "checked"; ?>  /></td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);" <?php if($row['pnpslipsub_packtype']=="P") echo "checked"; ?>  /></td>
<td width="156" align="center" valign="middle" class="tblheading" id="pltno"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="<?php echo $row['pnpslipsub_plotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<!--<tr class="tblsubtitle" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext">&nbsp;</td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext">&nbsp; &nbsp;&nbsp;<b>Validity Days</b> </td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial</td>
</tr>-->
<input type="hidden" name="pcktype" id="pcktype" value="<?php echo $row['pnpslipsub_packtype'];?>" />
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <!--<td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>-->
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row['pnpslipsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
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
	
<!-- <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value="<?php echo $row['pnpslipsub_pnob'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>-->

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  value="<?php echo $row['pnpslipsub_pickpqty'];?>" <?php if($row['pnpslipsub_packtype']=="E") echo "readonly='true' style='background-color:#CCCCCC'";?> />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['pnpslipsub_bnob'];?>" onchange="cnonzchk(this.value, <?php echo $srno2?>)" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['pnpslipsub_bqty'];?>" /></td>
  </tr>
 <?php
  }
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>

<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
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
    <td width="86" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconnob" class="smalltbltext" value="<?php echo $row['pnpslipsub_connob'];?>" size="8" onchange="chkpronob()" /></td>
    <td width="100" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconqty" class="smalltbltext" value="<?php echo $row['pnpslipsub_conqty'];?>" size="8" onchange="chkproqty()" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconrem" class="smalltbltext" value="<?php echo $row['pnpslipsub_rm'];?>" size="8" onchange="chkconqty()" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconim" class="smalltbltext" value="<?php echo $row['pnpslipsub_im'];?>" size="8" onchange="chkrm()" /></td>
    <td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconpl" class="smalltbltext" value="<?php if($row_tbl['pnpslipmain_stage']=="Raw") echo $row['pnpslipsub_pl']; else echo $row['pnpslipsub_rpl'];?>" size="8" onchange="chkim(this.value)" /></td>
    <td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtconloss" class="smalltbltext" value="<?php echo $row['pnpslipsub_tlqty'];?>" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconper" class="smalltbltext" value="<?php echo $row['pnpslipsub_tlper'];?>" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
  </tr>
</table>-->

<br />
<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Packing Details</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="">Select</option>
<option <?php if($row['pnpslipsub_valperiod']=="3") echo "Selected";?> value="3" >3</option>
<option <?php if($row['pnpslipsub_valperiod']=="6") echo "Selected";?> value="6" >6</option>
<option <?php if($row['pnpslipsub_valperiod']=="9") echo "Selected";?> value="9" >9</option>
</select>&nbsp;Months</td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext">&nbsp;<input type="text" name="validityupto" id="validityupto" value="<?php echo $tdate4;?>" size="15" readonly="true" style="background-color:#CCCCCC"  /> &nbsp;&nbsp;<b>Validity Days</b> <input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="<?php echo $datediff;?>" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);" <?php if($row['pnpslipsub_packtype']=="E") echo "checked"; ?>  />Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);" <?php if($row['pnpslipsub_packtype']=="P") echo "checked"; ?>  />Pack Partial</td><input type="hidden" name="pcktype" id="pcktype" value="<?php echo $row['pnpslipsub_packtype'];?>" />
</tr>

</table>-->
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>-->
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
	<td align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td align="center" valign="middle" class="smalltblheading">Captive Consumption</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Packing</td>
    <!--<td align="center" valign="middle" class="smalltblheading" colspan="2">Balance Condition</td>-->
  </tr>
  <!--<tr class="tblsubtitle">
    <td width="86" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="111" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="92" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>-->
  <tr class="Light" height="25">  
 <!-- <td  align="center"  valign="middle" class="smalltbltext" ><input name="avlnobpck" id="avlnobpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_availpnob'];?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="avlqtypck" id="avlqtypck" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_availpqty'];?>"  />&nbsp;</td>-->
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="pfpchk(this.value)" value="<?php echo $row['pnpslipsub_pickpqty'];?>" <?php if($row['pnpslipsub_packtype']=="E") echo "readonly='true' style='background-color:#CCCCCC'";?>  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="<?php echo $row['pnpslipsub_packloss'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)" value="<?php echo $row['pnpslipsub_packcc'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" value="<?php echo $row['pnpslipsub_packqty'];?>"  style="background-color:#CCCCCC"  />&nbsp;</td>
  <!--<td  align="center"  valign="middle" class="smalltbltext"><input name="balcnob" id="balcnob" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_balcnob'];?>"  /></td>
   <td  align="center"  valign="middle" class="smalltbltext"><input name="balcqty" id="balcqty" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_balcqty'];?>"  />&nbsp;</td>-->
</tr>  
</table>
<br />
<!--<div id="conditionsloc" style="display: <?php if($row['pnpslipsub_packtype']=="P") echo "block"; else echo "none"; ?>">
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
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno3?>" name="txtslwhg<?php echo $srno3?>" style="width:70px;" onchange="wh<?php echo $srno3?>(this.value,<?php echo $srno3?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_wh']==$noticia_whd1['whid']) echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub2['pnpslipsubsub_wh']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno3?>"><select class="smalltbltext" name="txtslbing<?php echo $srno3?>" style="width:60px;" onchange="bin<?php echo $srno3?>(this.value,<?php echo $srno3?>);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub2['pnpslipsubsub_bin']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno3?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno3?>" id="txtslsubbg<?php echo $srno3?>" style="width:60px;" onchange="subbin<?php echo $srno3?>(this.value,<?php echo $srno3?>);"  >
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
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $srno3?>" id="txtconslnob<?php echo $srno3?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno3?>);" value="<?php echo $row_tbl_subsub2['pnpslipsubsub_pnob'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $srno3?>" id="txtconslqty<?php echo $srno3?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno3?>);"  onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_subsub2['pnpslipsubsub_pqty'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
  </tr>
<?php
$srno3++;
}
if($srno3==1)
{
?>
  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob1" id="txtconslnob1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty1" id="txtconslqty1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,1);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
    <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
  <?php
  }
  else if($srno3==2)
  {
  ?>
    </tr>
    <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
  <?php
  }
  else
  {
  }
  ?>
  
</table><br />
</div>-->


<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Select Pack Seed SLOC</td>
  </tr>
</table>-->

<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="174" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="168" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="174" align="center" valign="middle" class="smalltblheading">Sub Bin</td>
	<td width="324" align="center" valign="middle" class="smalltblheading">Comment </td>
	
  </tr>

  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 

  </tr>
    <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr>
    <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr>
     <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr>
     <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr>
     <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr>
     <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr>
     <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;</td>
 </tr>
  </table>
   </div>
 </td> 
  </tr> 
</table>-->


<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="12">Packing - Packaging Details</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading">Select</td>
<td align="center" valign="middle" class="tblheading">UPS</td>
<td align="center" valign="middle" class="tblheading">Quantity</td>
<td align="center" valign="middle" class="tblheading">No. of Pouches</td>
<td colspan="2" align="center" valign="middle" class="tblheading">Label No.</td>
<td align="center" valign="middle" class="tblheading">Convert to MP</td>
<td align="center" valign="middle" class="tblheading">No. of MP</td>
<td align="center" valign="middle" class="tblheading">Balance Pouches</td>
<td align="center" valign="middle" class="tblheading">Barcode Labels</td>
</tr>

<?php
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
if($row12['wt']=="Gms")
{ 
	$ptp=(1000/$row12['ups']);
	$ptp1=($row12['ups']/1000);
}
else
{
	$ptp=$row12['ups'];
	$ptp1=$row12['ups'];
}
//echo $ptp."  =>  ".$ptp1."  -  ";
if($row12['wt']=="Gms")
{
	$mmmpt=$ptp*$wtmp;
}
else
{
	$mmmpt=$wtmp/$ptp;
}

if($mptnop!=$mmmpt)$mptnop=$mmmpt;
$sno++;	
?>

<tr class="Light" height="25">
<td width="49" align="center" valign="middle" class="tbltext"><input type="radio" name="fet" onClick="clk('<?php echo $sno?>',<?php echo $row12['uid'];?>);" id="fetchk_<?php echo $sno?>" value="<?php echo $row12['uid'];?>" <?php if($row12['uid']==$row['pnpslipsub_upsid']) echo "checked"; ?>/><?php if($row12['uid']==$row['pnpslipsub_upsid']) {?><input type="hidden" name="upssize" value="<?php echo $sno;?>" /><?php } ?></td>
<td width="79" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row12['ups']." ".$row12['wt'];?><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $row12['uom'];?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $row12['ups']." ".$row12['wt'];?>" /></td>
<td width="81" align="center" valign="middle" class="tbltext"><input type="text" name="packqty_<?php echo $sno?>" id="packqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_packqty']; else echo ""; ?>" onkeypress="return isNumberKey(event)" onchange="chktotpouches(this.value, <?php echo $sno?>)" disabled="disabled" <?php if($row['pnpslipsub_packtype']=="E") echo "readonly='true' style='background-color:#CCCCCC'";?> />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="96" align="center" valign="middle" class="tbltext"><input type="text" name="nopc_<?php echo $sno?>" id="nopc_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_nop']; else echo ""; ?>" readonly="true" style="background-color:#CCCCCC"/></td>
<td width="135" align="center" valign="middle" class="tbltext"><?php $quer3=mysqli_query($link,"SELECT dom_mcode FROM tbl_rm_dommac  order by dom_mcode Asc"); ?>
  <select class="smalltbltext" <?php if($row12['uid']!=$row['pnpslipsub_upsid']) echo "disabled";?> name="domcs_<?php echo $sno?>" id="domcs_<?php echo $sno?>" style="width:40px;" onchange="domcchk(this.value, <?php echo $sno?>)"> <option value="" >Select</option> <?php while($noticia = mysqli_fetch_array($quer3)) { ?> <option <?php if($row12['uid']==$row['pnpslipsub_upsid']) { if($noticia['dom_mcode']==$row['pnpslipsub_lblschar']) echo "selected";} else echo "disabled";?> value="<?php echo $noticia['dom_mcode'];?>" /><?php echo $noticia['dom_mcode'];?><?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="text" name="lbls_<?php echo $sno?>" id="lbls_<?php echo $sno?>" size="5" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_lblsno']; else echo ""; ?>"  onkeypress="return isNumberKey1(event)" onchange="domchk(<?php echo $sno?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="114" align="center" valign="middle" class="tbltext"><input type="text" name="domce_<?php echo $sno?>" id="domce_<?php echo $sno?>" class="tbltext" size="1" maxlength="1" readonly="true" style="background-color:#CCCCCC" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_lbechar']; else echo ""; ?>" />&nbsp;<input type="text" name="lble_<?php echo $sno?>" id="lble_<?php echo $sno?>" size="5"  maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_lbeno']; else echo ""; ?>"  onkeypress="return isNumberKey1(event)" onchange="domchk1(this.value, <?php echo $sno?>)" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="53" align="center" valign="middle" class="tbltext"><input type="checkbox" name="mpck_<?php echo $sno?>" id="mpck_<?php echo $sno?>" class="tbltext" value="Yes" onchange="mpchk(this.value, <?php echo $sno;?>)" <?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo "checked";  ?>  /></td>
<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo $row['pnpslipsub_nomp']; else echo ""; ?>"  readonly="true" style="background-color:#CCCCCC" onchange="balnopcheck(this.value, <?php echo $sno?>)"/><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>
<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo $row['pnpslipsub_balpouch']; else echo ""; ?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="61" align="center" valign="middle" class="tbltext" id="dtail_<?php echo $sno;?>"><?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") {?><a href="Javascript:void(0)" onclick="detailspop('edit')">Details</a><?php }else{ ?>Fill<?php } ?></td>
</tr>
<?php	
		
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
	//echo $abrc;
	$totbtsls=0; $b=0;
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
</table>
<div id="slsync">

<div id="slocsync">
<?php
	$abc=""; $abcdef="";
	$sql_barcode2=mysqli_query($link,"select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' and bar_lotno='".$row['pnpslipsub_plotno']."' and bar_logid='".$logid."' and bar_psrn='".$row_tbl['pnpslipmain_proslipno']."'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			$bc=$row_barcode2['bar_barcodes'];
			if($abc!="")
			$abc=$abc.","."'$bc'";
			else
			$abc="'$bc'";
			/*if($nobcd!="")
			$nobcd=$nobcd.",".$bc;
			else
			$nobcd=$bc;*/
		}
	}
//echo $abc;
	//print_r($nm1);
$conts=0;
if($abc!="")
{
$xyz=explode(",",$abc);	
$conts=count($xyz);	
}
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">SLOC</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="160" align="center" valign="middle" class="tblheading">WH</td>
<td width="106" align="center" valign="middle" class="tblheading">Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Comments</td>
<td width="162" align="center" valign="middle" class="tblheading">Master Packs</td>
<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
</tr>
<?php
$sno3=0; $a=$row['packagingsub_id'];  $totnompbarlink=0; $aval1=array();  $bpch=0; $tbpch=0;
$sql_tbl_subsub3=mysqli_query($link,"select * from tbl_pnpslipsubsub3 where plantcode='$plantcode' and pnpslipsub_id='".$row['pnpslipsub_id']."' and pnpslipmain_id='".$tid."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
$sno3=$sno3+1;
$nobcd="";
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_btslmain where plantcode='$plantcode' and btsl_subbin='".$row_tbl_subsub3['pnpslipsubsub_subbin']."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_barcode IN ($abc)") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$brcod=$rowbarcsub['btslsub_barcode'];
			if($nobcd!="")
			$nobcd=$nobcd.",".$brcod;
			else
			$nobcd=$brcod;
			array_push($aval1,$brcod);
		}
	$totnompbar=$totnompbar+$subtbltotbar;
	}
	$totnompbar=$row_tbl_subsub3['pnpslipsubsub_nomp'];
	//$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	$tbpch=$tbpch+$row_tbl_subsub3['pnpslipsubsub_pouches'];
?>
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sno3;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tbl_subsub3['pnpslipsubsub_wh']==$noticia_whd1['whid']) echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub3['pnpslipsubsub_wh']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sno3;?>);" >
<option value="" >Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tbl_subsub3['pnpslipsubsub_bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub3['pnpslipsubsub_bin']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" style="width:60px;" onchange="subbin(this.value,<?php echo $sno3;?>);"  >
<option value="" >Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_tbl_subsub3['pnpslipsubsub_subbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr<?php echo $sno3;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview<?php echo $sno3?>" id="existview<?php echo $sno3?>" class="tbltext" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php if($totnompbar>0) { ?><a href="Javascript:void(0);" onclick="showbarc('<?php echo $nobcd;?>');"><?php echo $totnompbar;?></a><?php } else { echo $totnompbar; }?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /><!--<input type="text" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_nomp'];?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)" <?php if($row['pnpslipsub_convtomp']!="Yes") echo "readonly='true' style='background-color:#CCCCCC'";?>  />--></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_pouches'];?>" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_totpouches'];?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_totqty'];?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>

<?php
}
if($row['pnpslipsub_convtomp']=="Yes")
$obpch=$row['pnpslipsub_balpouch'];
else
$obpch=$row['pnpslipsub_nop'];
$bpch=$obpch-$tbpch;
?>
<?php
if(($conts-$totnompbarlink)>0) { if($ardiff=="") $ardiff=$abcdef; }

//if(($conts-$totnompbarlink)==0 && $bpch > 0) 
{
?>
<?php
if($sno3==0)
{
?>
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg1" name="txtwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing1" id="txtbing1" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg1" id="txtsubbg1" style="width:60px;" onchange="subbin(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>

<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg2" name="txtwhg2" style="width:70px;" onchange="wh(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn2"><select class="smalltbltext" name="txtbing2" id="txtbing2" style="width:60px;" onchange="bin(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn2"><select class="smalltbltext" name="txtsubbg2" id="txtsubbg2" style="width:60px;" onchange="subbin(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==1)
{
?>
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg2" name="txtwhg2" style="width:70px;" onchange="wh(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn2"><select class="smalltbltext" name="txtbing2" id="txtbing2" style="width:60px;" onchange="bin(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn2"><select class="smalltbltext" name="txtsubbg2" id="txtsubbg2" style="width:60px;" onchange="subbin(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==2)
{
?>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>

<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==3)
{
?>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>

	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==4)
{
?>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==5)
{
?>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==6)
{
?>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==7)
{
?>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
}
?>
<input type="hidden" name="sno3" value="<?php echo $sno3;?>" /><input type="hidden" name="slocseldet" value="" />
</table>


























 </div>
</div></div><br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="100" maxlength="100" value="<?php echo $row['pnpslipsub_remarks'];?>" ></td>
</tr>
</table>
<br />
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_packslipwb.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>


</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  
