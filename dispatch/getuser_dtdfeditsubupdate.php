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

	if(isset($_POST['txtid'])) { $txtid=$_POST['txtid']; }
	if(isset($_POST['date'])) { $date=$_POST['date']; }
	/*if(isset($_POST['dcdate'])) { $dcdate=$_POST['dcdate']; }
	if(isset($_POST['txtdcno'])) { $txtdcno=$_POST['txtdcno']; }*/
	if(isset($_POST['txtpp'])) { $txtpp=$_POST['txtpp']; }
	if(isset($_POST['txtstatesl'])) { $txtstatesl=$_POST['txtstatesl']; }
	if(isset($_POST['txtlocationsl'])) { $txtlocationsl=$_POST['txtlocationsl'];	}
	if(isset($_POST['locationname'])) { $locationname=$_POST['locationname']; }
	if(isset($_POST['txtstfp'])) { $txtstfp=$_POST['txtstfp']; }
	if(isset($_POST['txtstage'])) { $txtstage=$_POST['txtstage']; }
	if(isset($_POST['mchksel'])) { $mchksel=$_POST['mchksel']; }
	if(isset($_POST['ltchksel'])) { $ltchksel=$_POST['ltchksel']; }
	if(isset($_POST['sn'])) { $sn=$_POST['sn']; }
	if(isset($_POST['sno1'])) { $sno1=$_POST['sno1']; }
	if(isset($_POST['srno2'])) { $srno2=$_POST['srno2']; }
	
	if(isset($_POST['txt11'])) { $txt11=$_POST['txt11']; }
	if(isset($_POST['txttname'])) { $txttname=$_POST['txttname']; }
	if(isset($_POST['txtlrn'])) { $txtlrn=$_POST['txtlrn']; }
	if(isset($_POST['txtvn'])) { $txtvn=$_POST['txtvn']; }
	if(isset($_POST['txt13'])) { $txt13=$_POST['txt13']; }
	if(isset($_POST['txtcname'])) { $txtcname=$_POST['txtcname']; }
	if(isset($_POST['txtdc'])) { $txtdc=$_POST['txtdc']; }
	if(isset($_POST['txtpname'])) { $txtpname=$_POST['txtpname']; }
	
	if(isset($_POST['mchksel'])) { $mchksel=$_POST['mchksel']; }
	if(isset($_POST['ltchksel'])) { $ltchksel=$_POST['ltchksel']; }
	if(isset($_POST['sn'])) { $sn=$_POST['sn']; }
	if(isset($_POST['sno1'])) { $sno1=$_POST['sno1']; }
	if(isset($_POST['srno2'])) { $srno2=$_POST['srno2']; }
	if(isset($_POST['selcrp'])) { $selcrp=$_POST['selcrp']; }
	if(isset($_POST['selver'])) { $selver=$_POST['selver']; }
	if(isset($_POST['selord'])) { $selord=$_POST['selord']; }
	if(isset($_POST['lotsel'])) { $lotsel=$_POST['lotsel']; }
	
	$remarks=trim($_POST['txtremarks1']);
	$remarks=str_replace("&","and",$remarks);
				
	if(isset($_POST['maintrid'])) { $maintrid=$_POST['maintrid']; }
	if(isset($_POST['subtrid'])) { $subtrid=$_POST['subtrid']; }
	if(isset($_POST['subsubtrid'])) { $subsubtrid=$_POST['subsubtrid']; }

//frm_action=submit&txt11=&txt14=&txtid=3&logid=DP1&getdetflg=0&txtconchk=&txtptype=tdf&txtcountrysl=&txtcountryl=&rettype=&txtstage=Condition&date=18-03-2015&dcdate=18-03-2015&txtdcno=Test&txtpp=tdf&txtstatesl=Gujarat&txtlocationsl=63&locationname=63&txtstfp=461&adddchk=&ecrop1=Chilli&evariety1=VNR-38&eupstyp1=NST&eqty1=15&eordno1=OS2413%2FP%2FOB2&enoordno1=1&upstp1=NST&rnob1=1&rqty1=15.000&bnop1=0.000&sn=2&mchksel=1&sno1=3&ltchksel=1&txtolotno=DS08375%2F00000%2F00C&txtonob=1&txtoqty=20.8&extslwhg1=2&extslbing1=94&extslsubbg1=1862&txtextnob1=1&txtextqty1=20.800&recnobp1=1&recqtyp1=15.000&txtbalnobp1=1&txtbalqtyp1=5.800&srno2=1&maintrid=3&subtrid=3&subsubtrid=3

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

if($txtpp=="")$txtpp="TDF";	

//echo $tdate1.', '.$txtdcno.', '.$tdate2.', '.$txtpp.', '.$txtstatesl.', '.$locationname.', '.$txtstfp;
if($z1 == 0)
{
	$sql_main="insert into tbl_dtdf(dtdf_tcode, dtdf_date, dtdf_partytype, dtdf_state, dtdf_location, dtdf_party, dtdf_yearcode, dtdf_logid, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no, pname_byhand, dtdf_remarks,plantcode) values ('$txtid', '$tdate1', '$txtpp', '$txtstatesl', '$locationname', '$txtstfp', '$yearid_id', '$logid', '$txt11', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$remarks','$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
	$mainid=mysqli_insert_id($link);
	$j=$mchksel;
	if($mchksel!="")
	{
		$ecropx="ecrop".$j;
		$evarietyx="evariety".$j;
		$eupstypx="eupstyp".$j;
		$eqtyx="eqty".$j;
		$eordnox="eordno".$j;
		$enoordnox="enoordno".$j;
		$upstpx="upstp".$j;
		$rnobx="rnob".$j;
		$rqtyx="rqty".$j;
		$bnopx="bnop".$j;
		$selshx="selsh".$j;
		
		if(isset($_POST[$ecropx])) { $ecrop= $_POST[$ecropx]; }
		if(isset($_POST[$evarietyx])) { $evariety= $_POST[$evarietyx]; }
		if(isset($_POST[$eupstypx])) { $eupstyp= $_POST[$eupstypx]; }
		if(isset($_POST[$eqtyx])) { $eqty= $_POST[$eqtyx]; }
		if(isset($_POST[$eordnox])) { $eordno= $_POST[$eordnox]; }
		if(isset($_POST[$enoordnox])) { $enoordno= $_POST[$enoordnox]; }
		if(isset($_POST[$upstpx])) { $upstp= $_POST[$upstpx]; }
		if(isset($_POST[$rnobx])) { $rnob= $_POST[$rnobx]; }
		if(isset($_POST[$bnopx])) { $bnop= $_POST[$bnopx]; }
		if(isset($_POST[$rqtyx])) { $rqty= $_POST[$rqtyx]; }
		if(isset($_POST[$selshx])) { $selsh= $_POST[$selshx]; }
		$dq=explode(" ",$upstp);
		$diq=explode(".",$dq[0]);
		if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
		$upstp=$difq." ".$dq[1];
		if($subtrid==0)
		{
			
			$sql_subsub="insert into tbl_dtdf_sub (dtdf_id, dtdfs_crop, dtdfs_variety, dtdfs_noorders, dtdfs_ordno, dtdfs_upstype, dtdfs_ups, dtdfs_oqty, dtdfs_nob, dtdfs_qty, dtdfs_bqty, dtdfs_stage,plantcode) values ('$mainid', '$ecrop', '$evariety', '$enoordno', '$eordno', '$eupstyp', '$upstp', '$eqty', '$rnob', '$rqty', '$bnop', '$txtstage','$plantcode')";
			//$sql_subsub="insert into tbl_dtdf_sub (dtdf_id, dtdfs_crop, dtdfs_variety, dtdfs_noorders, dtdfs_ordno, dtdfs_upstype, dtdfs_ups, dtdfs_oqty, dtdfs_nob, dtdfs_qty, dtdfs_bqty) values ('$mainid', '$ecrop', '$evariety', '$enoordno', '$eordno', '$eupstyp', '$upstp', '$eqty', '$rnob', '$rqty', '$bnop')";
			if(mysqli_query($link,$sql_subsub) or die(mysqli_error($link)))
			{
				$sid=mysqli_insert_id($link);
			 
				if($ltchksel!="")
				{
					$txtolotnox="txtolotno";
					$txtonobx="txtonob";
					$txtoqtyx="txtoqty";
					$txtnupsx="txtnups";
					$txtnvarietyx="txtnvariety";
					
					
					if(isset($_POST[$txtolotnox])) { $txtolotno= $_POST[$txtolotnox]; }
					if(isset($_POST[$txtonobx])) { $txtonob= $_POST[$txtonobx]; }
					if(isset($_POST[$txtoqtyx])) { $txtoqty= $_POST[$txtoqtyx]; }
					if(isset($_POST[$txtnupsx])) { $txtnups= $_POST[$txtnupsx]; }
					if(isset($_POST[$txtnvarietyx])) { $txtnvariety= $_POST[$txtnvarietyx]; }
					$dq=explode(" ",$txtnups);
					$diq=explode(".",$dq[0]);
					if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
					$txtnups=$difq." ".$dq[1];					
					if($subsubtrid==0)
					{
						$sql_subsub2="insert into tbl_dtdfsub_sub (dtdf_id, dtdfs_id, dbss_lotno, dbss_onob, dbss_oqty,plantcode) values ('$mainid', '$sid', '$txtolotno', '$txtonob', '$txtoqty','$plantcode')";
						if(mysqli_query($link,$sql_subsub2) or die(mysqli_error($link)))
						{
							$ssid=mysqli_insert_id($link);
							$tonb=0; $toqt=0; $btonb=0; $btoqt=0;
							for($k=1; $k<=$srno2; $k++)
							{
								$extslwhgx="extslwhg".$k;
								$extslbingx="extslbing".$k;
								$extslsubbgx="extslsubbg".$k;
								$txtextnobx="txtextnob".$k;
								$txtextqtyx="txtextqty".$k;
								$recnobpx="recnobp".$k;
								$recqtypx="recqtyp".$k;
								$txtbalnobpx="txtbalnobp".$k;
								$txtbalqtypx="txtbalqtyp".$k;
								
								if(isset($_POST[$extslwhgx])) { $extslwhg= $_POST[$extslwhgx]; }
								if(isset($_POST[$extslbingx])) { $extslbing= $_POST[$extslbingx]; }
								if(isset($_POST[$extslsubbgx])) { $extslsubbg= $_POST[$extslsubbgx]; }
								if(isset($_POST[$txtextnobx])) { $txtextnob= $_POST[$txtextnobx]; }
								if(isset($_POST[$txtextqtyx])) { $txtextqty= $_POST[$txtextqtyx]; }
								if(isset($_POST[$recnobpx])) { $recnobp= $_POST[$recnobpx]; }
								if(isset($_POST[$recqtypx])) { $recqtyp= $_POST[$recqtypx]; }
								if(isset($_POST[$txtbalnobpx])) { $txtbalnobp= $_POST[$txtbalnobpx]; }
								if(isset($_POST[$txtbalqtypx])) { $txtbalqtyp= $_POST[$txtbalqtypx]; }
																
								if($recqtyp!="" || $recqtyp>0)
								{
									$tonb=$tonb+$recnobp; 
									$toqt=$toqt+$recqtyp;
									$sql_subsub3="insert into tbl_dtdfsub_sub2 (dtdf_id, dtdfs_id, dbss_is, dbsss_wh, dbsss_bin, dbsss_subbin, dbsss_onob, dbsss_oqty, dbsss_nob, dbsss_qty, dbsss_bnob, dbsss_bqty) values ('$mainid', '$sid', '$ssid', '$extslwhg', '$extslbing', '$extslsubbg', '$txtextnob', '$txtextqty', '$recnobp', '$recqtyp', '$txtbalnobp', '$txtbalqtyp')";
									mysqli_query($link,$sql_subsub3) or die(mysqli_error($link));
								}
							}
							$btonb=$txtonob-$tonb; 
							$btoqt=$txtoqty-$toqt;
							$sql_subsub4="update tbl_dtdfsub_sub set dbss_nob='$tonb', dbss_qty='$toqt', dbss_bnob='$btonb', dbss_bqty='$btoqt', dbss_mmcqty='$toqt' where dbss_id='$ssid'";
							$asdf4=mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));	
						}
					}
				}	
				$rn=0; $rq=0; $rbq=0; 
				$sq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid'") or die(mysqli_error($link));
				if($to=mysqli_num_rows($sq) > 0)
				{
					while($ro=mysqli_fetch_array($sq))
					{
						$rn=$rn+$ro['dbss_nob']; 
						$rq=$rq+$ro['dbss_qty']; 
					}
				}
				$rbq=$eqty-$rq;
				if($txtnvariety=="" || $txtnvariety=="undefined")$txtnvariety=$evariety; 
				$sql_subsub5="update tbl_dtdf_sub set dtdfs_nob='$rn', dtdfs_qty='$rq', dtdfs_bqty='$rbq', dtdfs_ups='$txtnups', dtdfs_nvariety='$txtnvariety' where dtdfs_id='$sid'";
				$asdf5=mysqli_query($link,$sql_subsub5) or die(mysqli_error($link));		 
			}
		}
	}

}
 $z1=$mainid;
}
else
{
	/*$sql_main="update tbl_stoutm set stoutm_fromplant='$pltcode', stoutm_toplant='$plantcode', stoutm_plant='$txtstfp', stoutm_ramarks='$txtremarks', stoutm_logid='$logid', stoutm_yearid='$yearid_id' where stoutm_id='$z1'";
	$asdf=mysqli_query($link,$sql_main) or die(mysqli_error($link));*/
	$mainid=$z1;
	$j=$mchksel;
	if($mchksel!="")
	{
		$ecropx="ecrop".$j;
		$evarietyx="evariety".$j;
		$eupstypx="eupstyp".$j;
		$eqtyx="eqty".$j;
		$eordnox="eordno".$j;
		$enoordnox="enoordno".$j;
		$upstpx="upstp".$j;
		$rnobx="rnob".$j;
		$rqtyx="rqty".$j;
		$bnopx="bnop".$j;
		$selshx="selsh".$j;
		
		if(isset($_POST[$ecropx])) { $ecrop= $_POST[$ecropx]; }
		if(isset($_POST[$evarietyx])) { $evariety= $_POST[$evarietyx]; }
		if(isset($_POST[$eupstypx])) { $eupstyp= $_POST[$eupstypx]; }
		if(isset($_POST[$eqtyx])) { $eqty= $_POST[$eqtyx]; }
		if(isset($_POST[$eordnox])) { $eordno= $_POST[$eordnox]; }
		if(isset($_POST[$enoordnox])) { $enoordno= $_POST[$enoordnox]; }
		if(isset($_POST[$upstpx])) { $upstp= $_POST[$upstpx]; }
		if(isset($_POST[$rnobx])) { $rnob= $_POST[$rnobx]; }
		if(isset($_POST[$bnopx])) { $bnop= $_POST[$bnopx]; }
		if(isset($_POST[$rqtyx])) { $rqty= $_POST[$rqtyx]; }
		if(isset($_POST[$selshx])) { $selsh= $_POST[$selshx]; }
		$dq=explode(" ",$upstp);
		$diq=explode(".",$dq[0]);
		if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
		$upstp=$difq." ".$dq[1];
		
		if($subtrid==0)
		{
			$sql_subsub="insert into tbl_dtdf_sub (dtdf_id, dtdfs_crop, dtdfs_variety, dtdfs_noorders, dtdfs_ordno, dtdfs_upstype, dtdfs_ups, dtdfs_oqty, dtdfs_nob, dtdfs_qty, dtdfs_bqty,plantcode) values ('$mainid', '$ecrop', '$evariety', '$enoordno', '$eordno', '$eupstyp', '$upstp', '$eqty', '$rnob', '$rqty', '$bnop','$plantcode')";
		}
		else
		{
			$on=0; $oq=0; $bq=0; 
			$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_id='$subtrid'") or die(mysqli_error($link));
			if($to=mysqli_num_rows($sq) > 0)
			{
				$ro=mysqli_fetch_array($sq);
				$on=$ro['dtdfs_nob']; 
				$oq=$ro['dtdfs_qty']; 
				$bq=$ro['dtdfs_bqty']; 
			}
			else
			{
				$on=$rnob; 
				$oq=$rqty; 
				$bq=$bnop; 
			}
			$sql_subsub="update tbl_dtdf_sub set dtdfs_nob='$on', dtdfs_qty='$oq', dtdfs_bqty='$bq' where dtdfs_id='$subtrid'";
		}		
			if(mysqli_query($link,$sql_subsub) or die(mysqli_error($link)))
			{
				if($subtrid==0)
				$sid=mysqli_insert_id($link);
				else
				$sid=$subtrid;
			 
				if($ltchksel!="")
				{
					$txtolotnox="txtolotno";
					$txtonobx="txtonob";
					$txtoqtyx="txtoqty";
					$txtnupsx="txtnups";
					$txtnvarietyx="txtnvariety";
					
					
					if(isset($_POST[$txtolotnox])) { $txtolotno= $_POST[$txtolotnox]; }
					if(isset($_POST[$txtonobx])) { $txtonob= $_POST[$txtonobx]; }
					if(isset($_POST[$txtoqtyx])) { $txtoqty= $_POST[$txtoqtyx]; }
					if(isset($_POST[$txtnupsx])) { $txtnups= $_POST[$txtnupsx]; }
					if(isset($_POST[$txtnvarietyx])) { $txtnvariety= $_POST[$txtnvarietyx]; }
					$dq=explode(" ",$txtnups);
					$diq=explode(".",$dq[0]);
					if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
					$txtnups=$difq." ".$dq[1];					
					if($subsubtrid==0)
					{
						$sql_subsub2="insert into tbl_dtdfsub_sub (dtdf_id, dtdfs_id, dbss_lotno, dbss_onob, dbss_oqty,plantcode) values ('$mainid', '$sid', '$txtolotno', '$txtonob', '$txtoqty','$plantcode')";
					}	
					else
					{
						$sql_subsub2="update  tbl_dtdfsub_sub set dtdf_id='$mainid', dtdfs_id='$sid', dbss_lotno='$txtolotno', dbss_onob='$txtonob', dbss_oqty='$txtoqty', dbss_mmcqty='$txtoqty' where dbss_id='$subsubtrid'";
					}	
						if(mysqli_query($link,$sql_subsub2) or die(mysqli_error($link)))
						{
							$ssid=mysqli_insert_id($link);
							if($subsubtrid==0)
							{
								$ssid=mysqli_insert_id($link);
							}
							else
							{
								$s_sub="delete from tbl_dtdfsub_sub2 where dbss_is='".$subsubtrid."' and dtdfs_id='".$sid."'";
								mysqli_query($link,$s_sub) or die(mysqli_error($link));
								$ssid=$subsubtrid;
							}
							
							$tonb=0; $toqt=0; $btonb=0; $btoqt=0;
							for($k=1; $k<=$srno2; $k++)
							{
								$extslwhgx="extslwhg".$k;
								$extslbingx="extslbing".$k;
								$extslsubbgx="extslsubbg".$k;
								$txtextnobx="txtextnob".$k;
								$txtextqtyx="txtextqty".$k;
								$recnobpx="recnobp".$k;
								$recqtypx="recqtyp".$k;
								$txtbalnobpx="txtbalnobp".$k;
								$txtbalqtypx="txtbalqtyp".$k;
								
								if(isset($_POST[$extslwhgx])) { $extslwhg= $_POST[$extslwhgx]; }
								if(isset($_POST[$extslbingx])) { $extslbing= $_POST[$extslbingx]; }
								if(isset($_POST[$extslsubbgx])) { $extslsubbg= $_POST[$extslsubbgx]; }
								if(isset($_POST[$txtextnobx])) { $txtextnob= $_POST[$txtextnobx]; }
								if(isset($_POST[$txtextqtyx])) { $txtextqty= $_POST[$txtextqtyx]; }
								if(isset($_POST[$recnobpx])) { $recnobp= $_POST[$recnobpx]; }
								if(isset($_POST[$recqtypx])) { $recqtyp= $_POST[$recqtypx]; }
								if(isset($_POST[$txtbalnobpx])) { $txtbalnobp= $_POST[$txtbalnobpx]; }
								if(isset($_POST[$txtbalqtypx])) { $txtbalqtyp= $_POST[$txtbalqtypx]; }
																
								if($recqtyp!="" || $recqtyp>0)
								{
									$tonb=$tonb+$recnobp; 
									$toqt=$toqt+$recqtyp;
									$sql_subsub3="insert into tbl_dtdfsub_sub2 (dtdf_id, dtdfs_id, dbss_is, dbsss_wh, dbsss_bin, dbsss_subbin, dbsss_onob, dbsss_oqty, dbsss_nob, dbsss_qty, dbsss_bnob, dbsss_bqty, dbsss_mmcqty) values ('$mainid', '$sid', '$ssid', '$extslwhg', '$extslbing', '$extslsubbg', '$txtextnob', '$txtextqty', '$recnobp', '$recqtyp', '$txtbalnobp', '$txtbalqtyp', '$recqtyp')";
									mysqli_query($link,$sql_subsub3) or die(mysqli_error($link));
								}
							}
							$btonb=$txtonob-$tonb; 
							$btoqt=$txtoqty-$toqt;
							$sql_subsub4="update tbl_dtdfsub_sub set dbss_nob='$tonb', dbss_qty='$toqt', dbss_bnob='$btonb', dbss_bqty='$btoqt', dbss_mmcqty='$toqt' where dbss_id='$ssid'";
							$asdf4=mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));	
						}
					//}	 
				}
				$rn=0; $rq=0; $rbq=0; 
				$sq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid'") or die(mysqli_error($link));
				if($to=mysqli_num_rows($sq) > 0)
				{
					while($ro=mysqli_fetch_array($sq))
					{
						$rn=$rn+$ro['dbss_nob']; 
						$rq=$rq+$ro['dbss_qty']; 
					}
				}
				//$rn=$rn+$on;
				//$rq=$rq+$oq;
				$rbq=$eqty-$rq;
				if($txtnvariety=="" || $txtnvariety=="undefined")$txtnvariety=$evariety; 
				$sql_subsub5="update tbl_dtdf_sub set dtdfs_nob='$rn', dtdfs_qty='$rq', dtdfs_bqty='$rbq', dtdfs_ups='$txtnups', dtdfs_nvariety='$txtnvariety' where dtdfs_id='$sid'";
				$asdf5=mysqli_query($link,$sql_subsub5) or die(mysqli_error($link));		 
			}
		//}
	}
}

$tid=$z1;


	$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dtdf_id'];

	$tdate=$row_tbl['dtdf_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dtdf_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$subtid=$subtrid;
	$subsubtid=0;
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch TDF</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dtdf_tcode']."/".$row_tbl['dtdf_yearcode']."/".$row_tbl['dtdf_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?><input name="dcdate" id="dcdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;</td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_dcno'];?><input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['dtdf_dcno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dtdf_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dtdf_partytype']; ?>"  />
</td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dtdf_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dtdf_state']; ?>" />
</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dtdf_state']."' and productionlocationid='".$row_tbl['dtdf_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dtdf_location']; ?>" />
</td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dtdf_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dtdf_location'];?>" />
</td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >-->
<?php
$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
	if($tt=mysqli_num_rows($quer33)>0)
	{
		$row33=mysqli_fetch_array($quer33);
		$name==$row33['business_name'];
		$address=$row33['address'];
		$city=$row33['city']; 
		$state=$row33['state'];
		$pincode=$row33['pin'];
	}
	else
	{
		$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
		$tt=mysqli_num_rows($sql_month2);
		$row_month2=mysqli_fetch_array($sql_month2);
		$name=$row_month2['orderm_partyname'];
		$address=$row_month2['orderm_partyaddress'];
		$city=$row_month2['orderm_partycity']; 
		$state=$row_month2['orderm_partystate'];
		$pincode=$row_month2['orderm_partypin'];
	}
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dtdf_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $name;?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dtdf_party'];?>"  />
<!--<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month24)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['dtdf_party']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
	</tr>
<?php
	
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>

<div id="orderdetails">
<?php
if($tt=mysqli_num_rows($quer33)>0)
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
else
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
//$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid
$ver="";
if($arrivalid!="")
{
	$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
	$totver2=mysqli_num_rows($sql_ver2);
	while($row_ver2=mysqli_fetch_array($sql_ver2))
	{
		if($ver!="")
			$ver=$ver.",".$row_ver2['order_sub_variety'];
		else
			$ver=$row_ver2['order_sub_variety'];
	}
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS Type</td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoP</td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">No. of Orders</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoB Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Select</td>
</tr>
<?php 

/*$arid=explode(",",$arrivalid);
foreach($arid as atrid)
{
if($atrid<>"")
{*/

$sn=1; $sn24=0; $sid=0; $dflg=0;
//if($arrivalid!="")
{
/*$sql_crp=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_crp);
while($row_crp=mysqli_fetch_array($sql_crp))
{
$sql_ver=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and orderm_id in($arrivalid) order by order_sub_variety") or die(mysqli_error($link));
$totver=mysqli_num_rows($sql_ver);
while($row_ver=mysqli_fetch_array($sql_ver))
{*/
//$sqlver=mysqli_query($link,"select distinct order_sub_ups_type from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and order_sub_variety='".$row_ver['order_sub_variety']."' and orderm_id in($arrivalid) order by order_sub_ups_type") or die(mysqli_error($link));
//$totv=mysqli_num_rows($sqlver);
//while($rowver=mysqli_fetch_array($sqlver))
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{
$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}

//$sqlmon=mysqli_query($link,"select * from tbl_order_sub where order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
//$totz=mysqli_num_rows($sqlmon);
//while($rowtblsub=mysqli_fetch_array($sqlmon))
//{
	$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid)  and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
	$totvs=mysqli_num_rows($sqlsloc);
	while($rowsloc=mysqli_fetch_array($sqlsloc))
	{
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
	$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_id")or die("Error:".mysqli_error($link));
	$totz=mysqli_num_rows($sqlmon);
	while($rowtblsub=mysqli_fetch_array($sqlmon))
	{
		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
		if($tot=mysqli_num_rows($sql_m) > 0)
		{
			while($row_m=mysqli_fetch_array($sql_m))
			{
				if($ordno!="")
				$ordno=$ordno.",".$row_m['orderm_porderno'];
				else
				$ordno=$row_m['orderm_porderno'];
				$nord++;
			}
		}
		$orxd=explode(",",$ordno);
		$tid240=array_keys(array_flip($orxd));
		$ordno=implode(",",$tid240);
		
		if($reptyp1=="hold")
	    {	
			if($rowtblsub['order_sub_hold_flag']!=0)
			$statussub=$rowtblsub['order_sub_hold_type'];	
		}
		else
		{
			$statussub="";
		}


		$variet=$row_dept4['popularname'];
		$upstyp=$rowtblsub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		/*if($crop!="")
		{
		$crop=$crop."<br>".$rowtblsub['order_sub_crop'];
		// $rowtblsub['lotcrop'];
		}
		else
		{*/
		$crop=$rowtblsub['order_sub_crop'];
		//}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		/*if($variety!="")
		{
		$variety=$variety."<br>".$rowtblsub['order_sub_variety'];
		}
		else
		{*/
		$variety=$rowtblsub['order_sub_variety'];	
		//}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		if($lotno!="")
		{
			$lotno=$lotno."<br>".$rowtblsub['lotno'];
		}
		else
		{
			$lotno=$rowtblsub['lotno'];
		}
		if($bags!="")
		{
			$bags=$bags."<br>".$acn;
		}
		else
		{
			$bags=$acn;
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}	
		if($qc!="")
		{
			$qc=$qc."<br>".$rowtblsub['qc'];
		}
		else
		{
			$qc=$rowtblsub['qc'];
		}
		if($got!="")
		{
			$got=$got."<br>".$rowtblsub['got'];
		}
		else
		{
			$got=$rowtblsub['got'];
		}
		if($stage!="")
		{
			$stage=$stage."<br>".$rowtblsub['order_sub_totbal_qty'];
		}
		else
		{
			$stage=$rowtblsub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
			$per=$per."<br>".$rowtblsub['pper'];
		}
		else
		{
			$per=$rowtblsub['pper'];
		}
		//echo $rowtblsub['order_sub_id'];

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";


	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($qt > 0 )	 
{
//echo $up1."  =  ".$rowsloc['order_sub_sub_ups']."<br/>";
$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		
$selups=$rowsloc['order_sub_sub_ups'];
$dq=explode(" ",$selups);
//if($upstyp=="ST")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_id='$subtid' and dtdfs_ups='".$selups."' and dtdfs_upstype='$upstyp' and dtdfs_flg!=1 and dtdf_id='$tid'") or die(mysqli_error($link));
else
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_flg!=1 and dtdfs_ups='".$selups."' and dtdfs_upstype='$upstyp' and dtdf_id='$tid'") or die(mysqli_error($link));
//$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_flg!=1 and dtdfs_ups='".$rowsloc['order_sub_sub_ups']."' and dtdf_id='$tid'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0;

if($to=mysqli_num_rows($sq) > 0)
{
$ro=mysqli_fetch_array($sq);
$nups=$ro['dtdfs_ups']; 
$nnob=$ro['dtdfs_nob']; 
$nqty=$ro['dtdfs_qty']; 
$nbqty=$ro['dtdfs_bqty'];
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['dtdfs_id'];
$sn24=$sn;
$dbsflg=$ro['dtdfs_flg'];

$sq23=mysqli_query($link,"Select distinct dbss_lotno from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$tid'") or die(mysqli_error($link));
$totre=mysqli_num_rows($sq23);
while($row23=mysqli_fetch_array($sq23))
{
	$nolots++;
}
$stageval=$ro['dtdfs_stage'];
$selups=$ro['dtdfs_ups'];

?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $ordno ?>"><?php echo $nord;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nups;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $nups;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nolots;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($nqty==0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $selups?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $selups?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
}
}
}
}
}
}
}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" /><input type="hidden" name="selcrp" value="" /><input type="hidden" name="selver" value="" /><input type="hidden" name="selord" value="" /><input type="hidden" name="selups" value="" />
</table>
</div>	
<br />

<div id="postingsubtable" style="display:block">
<table id="lottbl" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" /><input type="hidden" name="ltchksel" value="" />
<br />

<div id="postingsubsubtable" style="display:block">
<table id="lotdt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<table id="lotsldt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $sid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="bform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
