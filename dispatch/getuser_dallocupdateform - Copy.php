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
	if(isset($_POST['totnewsloc'])) { $totnewsloc=$_POST['totnewsloc']; }
	if(isset($_POST['newsloc'])) { $newsloc=$_POST['newsloc']; }
	if(isset($_POST['binshifting'])) { $binshifting=$_POST['binshifting']; }
	if(isset($_POST['nslval'])) { $nslval=$_POST['nslval']; }
	if(isset($_POST['sln'])) { $sln=$_POST['sln']; }
	if(isset($_POST['tsln'])) { $tsln=$_POST['tsln']; }
	
	if(isset($_POST['maintrid'])) { $maintrid=$_POST['maintrid']; }
	if(isset($_POST['subtrid'])) { $subtrid=$_POST['subtrid']; }
	if(isset($_POST['subsubtrid'])) { $subsubtrid=$_POST['subsubtrid']; }

	//frm_action=submit&txt14=&txtid=1551&logid=DP1&getdetflg=0&txtconchk=&txtptype=Dealer&txtcountrysl=&txtcountryl=&rettype=&extdcno=&plantcodes=&yearcodes=&date=01-06-2015&txtdcno=test&txtpp=Dealer&txtstatesl=Orissa&txtlocationsl=519&locationname=519&txtstfp=799&ecrop1=Maize&evariety1=4226&eupstyp1=ST&eups1=1.000%20Kgs&enop1=3000&eqty1=2160&eordno1=OS201%2F15-16%2FOB2&rnob1=&rnob1=&rqty1=&bnop1=2160&selsh=1&mchksel=1&txtornos=OS201%2F15-16%2FOB2&txtveridno=491&txtupsnos=1.000%20Kgs&txteqty=2160&sn=2&totbarcs=&txtecrop=Maize&txtevariety=4226&txteupstyp=ST&txteups=1.000%20Kgs&txtenop=3000&txteoqty=2160&txteordno=OS201%2F15-16%2FOB2&txtornomp=72&txtnomp=0&txtlonomp=0&txttlonomp=72&txtorblnomp=2160&ewtmp=30&emptnop=30&allctyp=lotwise&allocationtype=lotwise&barcode=&lsearch=&txttblwhg1=WH&bsearch=&lotsel=DP90348%2F00000%2F00P&sno1=9&ltchksel=8&txtolotno=DP90348%2F00000%2F00P&txtonob=210&txtoqty=6300&txtnups=1.000%20Kgs&extslwhg1=1&extslbing1=62&extslsubbg1=1223&txtextnob1=210&txtextqty1=6300&recnobp1=72&recqtyp1=2160&txtbalnobp1=138&txtbalqtyp1=4140.000&srno2=1&binshift=yes&binshifting=yes&nslval=0&txtwhg1=1&txtbing1=1&bnnomps_1=&bnqtys_1=&txtwhg2=WH&txtbing2=Bin&bnnomps_2=&bnqtys_2=&txtwhg3=WH&txtbing3=Bin&bnnomps_3=&bnqtys_3=&txtwhg4=WH&txtbing4=Bin&bnnomps_4=&bnqtys_4=&txtwhg5=WH&txtbing5=Bin&bnnomps_5=&bnqtys_5=&sln=5&tsln=1&totnewsloc=0&newsloc=&maintrid=&subtrid=&subsubtrid=&maintrid=OS201%2F15-16%2FOB2&totnewsloc=0&maintrid=0&subtrid=0&subsubtrid=0&newsloc=


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
	
		
if($z1 == 0)
{
	$sql_main="insert into tbl_dalloc(dalloc_tcode, dalloc_date, dalloc_partytype, dalloc_state, dalloc_location, dalloc_party, dalloc_yearcode, dalloc_logid,plantcode) values ('$txtid', '$tdate1', '$txtpp', '$txtstatesl', '$locationname', '$txtstfp', '$yearid_id', '$logid','$plantcode')";
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
			$eupsx="eups".$j;
			$selshx="selsh".$j;
			$txtornompx="txtornomp";
			$txtnompx="txtnomp";
			$txtlonompx="txtlonomp";
			$txttlonompx="txttlonomp";
			$txtorblnompx="txtorblnomp";
			
			if(isset($_POST[$ecropx])) { $ecrop= $_POST[$ecropx]; }
			if(isset($_POST[$evarietyx])) { $evariety= $_POST[$evarietyx]; }
			if(isset($_POST[$enoordnox])) { $enoordno= $_POST[$enoordnox]; }
			if(isset($_POST[$eordnox])) { $eordno= $_POST[$eordnox]; }
			if(isset($_POST[$eupstypx])) { $eupstyp= $_POST[$eupstypx]; }
			if(isset($_POST[$eupsx])) { $eups= $_POST[$eupsx]; }
			if(isset($_POST[$enopx])) { $enop= $_POST[$enopx]; }
			if(isset($_POST[$eqtyx])) { $eqty= $_POST[$eqtyx]; }
			if(isset($_POST[$txtornompx])) { $txtornomp= $_POST[$txtornompx]; }
			if(isset($_POST[$txtnompx])) { $txtnomp= $_POST[$txtnompx]; }
			if(isset($_POST[$txtlonompx])) { $txtlonomp= $_POST[$txtlonompx]; }
			if(isset($_POST[$txttlonompx])) { $txttlonomp= $_POST[$txttlonompx]; }
			if(isset($_POST[$txtorblnompx])) { $txtorblnomp= $_POST[$txtorblnompx]; }
			if(isset($_POST[$selshx])) { $selsh= $_POST[$selshx]; }
			
			$rlnop=0;
			$blnop=0;
			
			if($subtrid==0)
			{
				$sql_subsub="insert into tbl_dalloc_sub (dalloc_id, dallocs_crop, dallocs_variety, dallocs_noorders, dallocs_ordno, dallocs_upstype, dallocs_ups, dallocs_onop, dallocs_onomp, dallocs_oqty, dallocs_nop, dallocs_nomp, dallocs_qty, dallocs_bnop, dallocs_bnomp, dallocs_bqty,plantcode) values ('$mainid', '$ecrop', '$evariety', '$enoordno', '$eordno', '$eupstyp', '$eups', '$enop', '$txtornomp', '$eqty', '$rlnop', '$txtnomp', '$txtlonomp', '$blnop', '$txttlonomp', '$txtorblnomp','$plantcode')";
				if(mysqli_query($link,$sql_subsub) or die(mysqli_error($link)))
				{
					$sid=mysqli_insert_id($link);
				 
					if($ltchksel!="")
					{
						$txtolotnox="txtolotno";
						$txtonobx="txtonob";
						$txtoqtyx="txtoqty";
						$txtnupsx="txtnups";
						$ewtmpx="ewtmp";
						$emptnopx="emptnop";
						$allocationtypex="allocationtype";
						
						if(isset($_POST[$txtolotnox])) { $txtolotno= $_POST[$txtolotnox]; }
						if(isset($_POST[$txtonobx])) { $txtonob= $_POST[$txtonobx]; }
						if(isset($_POST[$txtoqtyx])) { $txtoqty= $_POST[$txtoqtyx]; }
						if(isset($_POST[$txtnupsx])) { $txtnups= $_POST[$txtnupsx]; }
						if(isset($_POST[$ewtmpx])) { $ewtmp= $_POST[$ewtmpx]; }
						if(isset($_POST[$emptnopx])) { $emptnop= $_POST[$emptnopx]; }
						if(isset($_POST[$allocationtypex])) { $allocationtype= $_POST[$allocationtypex]; }
											
						if($subsubtrid==0)
						{
							$sql_subsub2="insert into tbl_dallocsub_sub (dalloc_id, dallocs_id, dallocss_altype, dallocss_lotno, dallocss_enomp, dallocss_eqty, dallocss_ups, dallocss_wtmp, dallocss_mptnop,plantcode) values ('$mainid', '$sid', '$allocationtype', '$txtolotno', '$txtonob', '$txtoqty', '$txtnups', '$ewtmp', '$emptnop','$plantcode')";
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
										
										$sql_subsub3="insert into tbl_dallocsub_sub2 (dalloc_id, dallocs_id, dallocss_id, dallocss2_lotno, dallocss2_wh, dallocss2_bin, dallocss2_subbin, dallocss2_enomp, dallocss2_eqty, dallocss2_nomp, dallocss2_qty, dallocss2_bnomp, dallocss2_bqty,plantcode) values ('$mainid', '$sid', '$ssid', '$txtolotno', '$extslwhg', '$extslbing', '$extslsubbg', '$txtextnob', '$txtextqty', '$recnobp', '$recqtyp', '$txtbalnobp', '$txtbalqtyp','$plantcode')";
										if(mysqli_query($link,$sql_subsub3) or die(mysqli_error($link)))
										{
											$sssid=mysqli_insert_id($link);
											if($txtbalqtyp==0)
											{
												$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$txtolotno' and packtype='$txtnups' and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
												$tot_lot2=mysqli_num_rows($sql_lot2);
												$row_lot2=mysqli_fetch_array($sql_lot2);
												
												$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
												$tot_lot=mysqli_num_rows($sql_lot);
												$row_lot=mysqli_fetch_array($sql_lot);
												
												$barcdss=$row_lot['barcodes'].",";
												$barcdsc=explode(",",$barcdss);
												foreach($barcdsc as $barcode)
												{
													if($barcode<>"")	
													{
														$sqlbar1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and mpmain_altrid=0") or die(mysqli_error($link));
														if($totbar1=mysqli_num_rows($sqlbar1) > 0)
														{
															$rowbar1=mysqli_fetch_array($sqlbar1);
															$barwt=$rowbar1['mpmain_wtmp'];
															
															$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
															$totbarcode=mysqli_num_rows($sqlbarcode);
															$rowbarcode=mysqli_fetch_array($sqlbarcode);
															$grweight=$rowbarcode['bar_grosswt'];
															
															$sql_subsub4="insert into tbl_dallocsub_sub3 (dalloc_id, dallocs_id, dallocss_id, dallocss2_id, dallocss3_barcode, dallocss3_weight, dallocss3_grossweight,plantcode) values ('$mainid', '$sid', '$ssid', '$sssid', '$barwt', '$grweight','$plantcode')";
															mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
															
														}	
													}
												}		
											}
										}
									}
								}
								
								$btonb=$txtonob-$tonb; 
								$btoqt=$txtoqty-$toqt;
								$sql_subsub4="update tbl_dallocsub_sub set dallocss_nomp='$tonb', dallocss_qty='$toqt', dallocss_bnomp='$btonb', dallocss_bqty='$btoqt' where dallocss_id='$ssid'";
								$asdf4=mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));	
							}
						}
					}	
					
					$rn=0; $rq=0; $rbq=0; $rbn=0;
					$sq=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid'") or die(mysqli_error($link));
					if($to=mysqli_num_rows($sq) > 0)
					{
						while($ro=mysqli_fetch_array($sq))
						{
							$rn=$rn+$ro['dallocss_nomp']; 
							$rq=$rq+$ro['dallocss_qty']; 
						}
					}
					
					$rbn=$txtornomp-$rn;
					$rbq=$eqty-$rq;
					$sql_subsub5="update tbl_dalloc_sub set dallocss_nomp='$rn', dallocss_qty='$rq', dallocss_bnomp='$rbn', dallocs_bqty='$rbq' where dallocs_id='$sid'";
					$asdf5=mysqli_query($link,$sql_subsub5) or die(mysqli_error($link));		
					
					if($binshifting=="yes")
					{
						if($newsloc!="")
						{
							$k=$tsln+1;
							$txtwhgx="txtwhg".$k;
							$txtbingx="txtbing".$k;
							$bnnompsx="bnnomps_".$k;
							$bnqtysx="bnqtys_".$k;
							if(isset($_POST[$txtwhgx])) { $txtwhg= $_POST[$txtwhgx]; }
							if(isset($_POST[$txtbingx])) { $txtbing= $_POST[$txtbingx]; }
							if(isset($_POST[$bnnompsx])) { $bnnomps= $_POST[$bnnompsx]; }
							if(isset($_POST[$bnqtysx])) { $bnqtys= $_POST[$bnqtysx]; }
							$sql_sub4="Insert into tbl_dallocsub_sub4 (dalloc_id, dallocss4_wh, dallocss4_bin, dallocss4_nomp, dallocss4_qty,plantcode) values('$mainid', '$txtwhg', '$txtbing', '$bnnomps', '$bnqtys','$plantcode')";
							$aweds=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
						}
						else
						{
							$k=$tsln;
							
							$txtwhgx="txtwhg".$k;
							$txtbingx="txtbing".$k;
							$bnnompsx="bnnomps_".$k;
							$bnqtysx="bnqtys_".$k;
							if(isset($_POST[$txtwhgx])) { $txtwhg= $_POST[$txtwhgx]; }
							if(isset($_POST[$txtbingx])) { $txtbing= $_POST[$txtbingx]; }
							if(isset($_POST[$bnnompsx])) { $bnnomps= $_POST[$bnnompsx]; }
							if(isset($_POST[$bnqtysx])) { $bnqtys= $_POST[$bnqtysx]; }
											
							$nslnp=$rn; $nslnq=$rq;
							$sq41=mysqli_query($link,"Select * from tbl_dallocsub_sub4 where plantcode='".$plantcode."' and  dalloc_id='$mainid' and dallocss4_wh='$txtwhg' and dallocss4_bin='$txtbing'") or die(mysqli_error($link));
							if($to41=mysqli_num_rows($sq41) > 0)
							{
								while($ro41=mysqli_fetch_array($sq41))
								{
									$nslnp=$nslnp+$ro41['dallocss4_nomp']; 
									$nslnq=$nslnq+$ro41['dallocss4_qty']; 
								}
							}
							
							$sql_sub4="update tbl_dallocsub_sub4 set dallocss4_nomp='$nslnp', dallocss4_qty='$nslnq' where dalloc_id='$mainid'and dallocss4_wh='$txtwhg' and dallocss4_bin='$txtbing'";
							$aweds=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
						}
					 }
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
		$eupsx="eups".$j;
		$selshx="selsh".$j;
		$txtornompx="txtornomp";
		$txtnompx="txtnomp";
		$txtlonompx="txtlonomp";
		$txttlonompx="txttlonomp";
		$txtorblnompx="txtorblnomp";
		
		if(isset($_POST[$ecropx])) { $ecrop= $_POST[$ecropx]; }
		if(isset($_POST[$evarietyx])) { $evariety= $_POST[$evarietyx]; }
		if(isset($_POST[$enoordnox])) { $enoordno= $_POST[$enoordnox]; }
		if(isset($_POST[$eordnox])) { $eordno= $_POST[$eordnox]; }
		if(isset($_POST[$eupstypx])) { $eupstyp= $_POST[$eupstypx]; }
		if(isset($_POST[$eupsx])) { $eups= $_POST[$eupsx]; }
		if(isset($_POST[$enopx])) { $enop= $_POST[$enopx]; }
		if(isset($_POST[$eqtyx])) { $eqty= $_POST[$eqtyx]; }
		if(isset($_POST[$txtornompx])) { $txtornomp= $_POST[$txtornompx]; }
		if(isset($_POST[$txtnompx])) { $txtnomp= $_POST[$txtnompx]; }
		if(isset($_POST[$txtlonompx])) { $txtlonomp= $_POST[$txtlonompx]; }
		if(isset($_POST[$txttlonompx])) { $txttlonomp= $_POST[$txttlonompx]; }
		if(isset($_POST[$txtorblnompx])) { $txtorblnomp= $_POST[$txtorblnompx]; }
		if(isset($_POST[$selshx])) { $selsh= $_POST[$selshx]; }
		
		$rlnop=0;
		$blnop=0;
		
		if($subtrid==0)
		{
			$sql_subsub="insert into tbl_dalloc_sub (dalloc_id, dallocs_crop, dallocs_variety, dallocs_noorders, dallocs_ordno, dallocs_upstype, dallocs_ups, dallocs_onop, dallocs_onomp, dallocs_oqty, dallocs_nop, dallocs_nomp, dallocs_qty, dallocs_bnop, dallocs_bnomp, dallocs_bqty,plantcode) values ('$mainid', '$ecrop', '$evariety', '$enoordno', '$eordno', '$eupstyp', '$eups', '$enop', '$txtornomp', '$eqty', '$rlnop', '$txtnomp', '$txtlonomp', '$blnop', '$txttlonomp', '$txtorblnomp','$plantcode')";
			if(mysqli_query($link,$sql_subsub) or die(mysqli_error($link)))
			{
				$sid=mysqli_insert_id($link);
				 
				if($ltchksel!="")
				{
					$txtolotnox="txtolotno";
					$txtonobx="txtonob";
					$txtoqtyx="txtoqty";
					$txtnupsx="txtnups";
					$ewtmpx="ewtmp";
					$emptnopx="emptnop";
					$allocationtypex="allocationtype";
					
					if(isset($_POST[$txtolotnox])) { $txtolotno= $_POST[$txtolotnox]; }
					if(isset($_POST[$txtonobx])) { $txtonob= $_POST[$txtonobx]; }
					if(isset($_POST[$txtoqtyx])) { $txtoqty= $_POST[$txtoqtyx]; }
					if(isset($_POST[$txtnupsx])) { $txtnups= $_POST[$txtnupsx]; }
					if(isset($_POST[$ewtmpx])) { $ewtmp= $_POST[$ewtmpx]; }
					if(isset($_POST[$emptnopx])) { $emptnop= $_POST[$emptnopx]; }
					if(isset($_POST[$allocationtypex])) { $allocationtype= $_POST[$allocationtypex]; }
											
					if($subsubtrid==0)
					{
						$sql_subsub2="insert into tbl_dallocsub_sub (dalloc_id, dallocs_id, dallocss_altype, dallocss_lotno, dallocss_enomp, dallocss_eqty, dallocss_ups, dallocss_wtmp, dallocss_mptnop,plantcode) values ('$mainid', '$sid', '$allocationtype', '$txtolotno', '$txtonob', '$txtoqty', '$txtnups', '$ewtmp', '$emptnop','$plantcode')";
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
									
									$sql_subsub3="insert into tbl_dallocsub_sub2 (dalloc_id, dallocs_id, dallocss_id, dallocss2_lotno, dallocss2_wh, dallocss2_bin, dallocss2_subbin, dallocss2_enomp, dallocss2_eqty, dallocss2_nomp, dallocss2_qty, dallocss2_bnomp, dallocss2_bqty,plantcode) values ('$mainid', '$sid', '$ssid', '$txtolotno', '$extslwhg', '$extslbing', '$extslsubbg', '$txtextnob', '$txtextqty', '$recnobp', '$recqtyp', '$txtbalnobp', '$txtbalqtyp','$plantcode')";
									if(mysqli_query($link,$sql_subsub3) or die(mysqli_error($link)))
									{
										$sssid=mysqli_insert_id($link);
										if($txtbalqtyp==0)
										{
											$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$txtolotno' and packtype='$txtnups' and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
											$tot_lot2=mysqli_num_rows($sql_lot2);
											$row_lot2=mysqli_fetch_array($sql_lot2);
												
											$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
											$tot_lot=mysqli_num_rows($sql_lot);
											$row_lot=mysqli_fetch_array($sql_lot);
												
											$barcdss=$row_lot['barcodes'].",";
											$barcdsc=explode(",",$barcdss);
											foreach($barcdsc as $barcode)
											{
												if($barcode<>"")	
												{
													$sqlbar1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and mpmain_altrid=0") or die(mysqli_error($link));
													if($totbar1=mysqli_num_rows($sqlbar1) > 0)
													{
														$rowbar1=mysqli_fetch_array($sqlbar1);
														$barwt=$rowbar1['mpmain_wtmp'];
														
														$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
														$totbarcode=mysqli_num_rows($sqlbarcode);
														$rowbarcode=mysqli_fetch_array($sqlbarcode);
														$grweight=$rowbarcode['bar_grosswt'];
														
														$sql_subsub4="insert into tbl_dallocsub_sub3 (dalloc_id, dallocs_id, dallocss_id, dallocss2_id, dallocss3_barcode, dallocss3_weight, dallocss3_grossweight,plantcode) values ('$mainid', '$sid', '$ssid', '$sssid', '$barwt', '$grweight','$plantcode')";
														mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
															
													}	
												}
											}		
										}
									}
								}
							}
								
							$btonb=$txtonob-$tonb; 
							$btoqt=$txtoqty-$toqt;
							$sql_subsub4="update tbl_dallocsub_sub set dallocss_nomp='$tonb', dallocss_qty='$toqt', dallocss_bnomp='$btonb', dallocss_bqty='$btoqt' where dallocss_id='$ssid'";
							$asdf4=mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));	
						}
					}
				}	
					
				$rn=0; $rq=0; $rbq=0; $rbn=0;
				$sq=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid'") or die(mysqli_error($link));
				if($to=mysqli_num_rows($sq) > 0)
				{
					while($ro=mysqli_fetch_array($sq))
					{
						$rn=$rn+$ro['dallocss_nomp']; 
						$rq=$rq+$ro['dallocss_qty']; 
					}
				}
				
				$rbn=$txtornomp-$rn;
				$rbq=$eqty-$rq;
				$sql_subsub5="update tbl_dalloc_sub set dallocss_nomp='$rn', dallocss_qty='$rq', dallocss_bnomp='$rbn', dallocs_bqty='$rbq' where dallocs_id='$sid'";
				$asdf5=mysqli_query($link,$sql_subsub5) or die(mysqli_error($link));		
					
				if($binshifting=="yes")
				{
					if($newsloc!="")
					{
						$k=$tsln+1;
						$txtwhgx="txtwhg".$k;
						$txtbingx="txtbing".$k;
						$bnnompsx="bnnomps_".$k;
						$bnqtysx="bnqtys_".$k;
						if(isset($_POST[$txtwhgx])) { $txtwhg= $_POST[$txtwhgx]; }
						if(isset($_POST[$txtbingx])) { $txtbing= $_POST[$txtbingx]; }
						if(isset($_POST[$bnnompsx])) { $bnnomps= $_POST[$bnnompsx]; }
						if(isset($_POST[$bnqtysx])) { $bnqtys= $_POST[$bnqtysx]; }
						$sql_sub4="Insert into tbl_dallocsub_sub4 (dalloc_id, dallocss4_wh, dallocss4_bin, dallocss4_nomp, dallocss4_qty,plantcode) values('$mainid', '$txtwhg', '$txtbing', '$bnnomps', '$bnqtys','$plantcode')";
						$aweds=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
					}
					else
					{
						$k=$tsln;
						
						$txtwhgx="txtwhg".$k;
						$txtbingx="txtbing".$k;
						$bnnompsx="bnnomps_".$k;
						$bnqtysx="bnqtys_".$k;
						if(isset($_POST[$txtwhgx])) { $txtwhg= $_POST[$txtwhgx]; }
						if(isset($_POST[$txtbingx])) { $txtbing= $_POST[$txtbingx]; }
						if(isset($_POST[$bnnompsx])) { $bnnomps= $_POST[$bnnompsx]; }
						if(isset($_POST[$bnqtysx])) { $bnqtys= $_POST[$bnqtysx]; }
										
						$nslnp=$rn; $nslnq=$rq;
						$sq41=mysqli_query($link,"Select * from tbl_dallocsub_sub4 where plantcode='".$plantcode."' and  dalloc_id='$mainid' and dallocss4_wh='$txtwhg' and dallocss4_bin='$txtbing'") or die(mysqli_error($link));
						if($to41=mysqli_num_rows($sq41) > 0)
						{
							while($ro41=mysqli_fetch_array($sq41))
							{
								$nslnp=$nslnp+$ro41['dallocss4_nomp']; 
								$nslnq=$nslnq+$ro41['dallocss4_qty']; 
							}
						}
						
						$sql_sub4="update tbl_dallocsub_sub4 set dallocss4_nomp='$nslnp', dallocss4_qty='$nslnq' where dalloc_id='$mainid'and dallocss4_wh='$txtwhg' and dallocss4_bin='$txtbing'";
						$aweds=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
					}
				}
			}
		}
	}
	
}

$tid=$z1;


	$sql_tbl=mysqli_query($link,"select * from tbl_dbulk where dalloc_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dalloc_id'];

	$tdate=$row_tbl['dalloc_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dalloc_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$subtid=$subtrid;
	$subsubtid=$subsubtrid;

?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Allocation</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dalloc_tcode']."/".$row_tbl['dalloc_yearcode']."/".$row_tbl['dalloc_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dalloc_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dalloc_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dalloc_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dalloc_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dalloc_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dalloc_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dalloc_state']."' and productionlocationid='".$row_tbl['dalloc_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dalloc_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dalloc_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dalloc_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dalloc_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dalloc_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dalloc_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dalloc_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dalloc_party'];?>"  /></td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dalloc_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>

</table>
</div>
<br />

<div id="orderdetails">
<?php

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='".$row_tbl['dalloc_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."'")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid;

$ver="";
if($arrivalid!="")
{
	$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) order by order_sub_variety") or die(mysqli_error($link));
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
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Order No</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoMP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcodes</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Dispatched</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>
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
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $nord=0; $ordno="";
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_ups_type='No' order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_id='".$rowtblsub['orderm_id']."'")or die("Error:".mysqli_error($link));
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

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
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
}
if($qt > 0 && $upstyp=="NST")	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		

if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_id='$subtid' and dallocs_flg!=1 and dalloc_id='$tid'") or die(mysqli_error($link));
else
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_flg!=1 and dalloc_id='$tid'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0;

if($to=mysqli_num_rows($sq) > 0)
{
$ro=mysqli_fetch_array($sq);
$nups=$ro['dallocs_ups']; 
$nnob=$ro['dallocs_nob']; 
$nqty=$ro['dallocs_qty']; 
$nbqty=$ro['dallocs_bqty'];
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['dallocs_id'];
$sn24=$sn;
$dbsflg=$ro['dallocs_flg'];

$sq23=mysqli_query($link,"Select distinct dallocss_lotno from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
$totre=mysqli_num_rows($sq23);
while($row23=mysqli_fetch_array($sq23))
{
	$nolots++;
}


?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $ordno ?>"><?php echo $nord;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nups;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $nups;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nolots;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($nbqty>0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
}
}
}
}
}
//}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" />
</table>
</div>	
<br />
<div id="showorsel">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="13" align="center" class="tblheading">Loading IN-Progress</td>
</tr>
<tr class="Dark" height="30">
	<td width="67" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="100" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<!--<td width="150" align="center"  valign="middle" class="smalltblheading">PSDN Variety</td>-->
	<td width="40" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Ordered NoMP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">NoMP Allocated</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Qty Allocated</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Balance Ordered NoMP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Balance Ordered Qty</td>
</tr>
<?php
//echo $upids;
$orn1=$orn.","; $ctn=0; $sid=0;
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $nord=0; $ordno="";
$ordx=explode(",",$orn1);
$ordnx="";
foreach($ordx as $odx)
{
if($odx<>"")
{
$ctn++;
$od="'$odx'";
if($ordnx!="")
$ordnx=$ordnx.",".$od;
else
$ordnx=$od;
}
}
$arrivalid=""; 
if($a!="")
{
	if($cnt>1)
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_porderno in($ordnx) and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' order by orderm_id")or die("Error:".mysqli_error($link));
	else if($ctn==1)
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_porderno=$ordnx and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' order by orderm_id")or die("Error:".mysqli_error($link));
	else
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' order by orderm_id")or die("Error:".mysqli_error($link));
	$t=mysqli_num_rows($sqlmonth);
	
	
	while($rowtbl=mysqli_fetch_array($sqlmonth))
	{
			if($arrivalid!="")
			$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
			else
			$arrivalid=$rowtbl['orderm_id'];
	}
}
$ar=explode(",",$arrivalid);
$acr=count($ar);
$orsid="";
if($acr>1)
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$vrids."' and orderm_id in($arrivalid) order by order_sub_variety")or die("Error:".mysqli_error($link));
else
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$vrids."' and orderm_id='$arrivalid' order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}
//$ar1=explode(",",$orsid);
//count $acr1=count($ar1);
//if($acr1>1)
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_sub_ups='".$upids."' order by order_sub_sub_ups") or die(mysqli_error($link));
//else
//$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where orderm_id in($arrivalid) and order_sub_id='$orsid' and order_sub_sub_ups='".$upids."' order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_sub_ups='".$upids."' order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$vrids."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

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
		
	$crop=$rowtblsub['order_sub_crop'];
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cro=$row_dept5['cropname'];
	$variety=$rowtblsub['order_sub_variety'];	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$variet=$row_dept4['popularname'];
		
		
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$upids."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
		$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
		$dq=explode(".",$zz[0]);
		$xfd=count($dq);
		if($upstyp=="NST")
		{
			//$dq[1]="000";
			if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
		}
		else
		{
			if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
		}
		 $up1=$qt1." ".$zz[1];
		
		if($up!="")
			$up=$up."<br/>".$up1;
		else
			$up=$up1;
	
		$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
		if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
		
		$qt=$qt+$qt1;
		if($sstatus!="")
		{
			$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
		}
		else
		{
			$sstatus=$row_sloc['order_sub_sub_nop'];
		}
	}
	
if($qt > 0)	 
{

$zx=explode(" ",$up1);

$sql_sel="select * from tblups where wt='".$zx[1]."' and ups='".$zx[0]."' order by uom Asc";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$row1234=mysqli_num_rows($res);
$row12=mysqli_fetch_array($res);
$uid=$row12['uid'];

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$vrids."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$srnonew=0;
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
foreach($p1_array as $val1)
{
	if($val1<>"")
	{
		if($val1==$uid)
		{
			$wtmp=$p1_array2[$srnonew];
			$mptnop=$p1_array3[$srnonew];
		}
	}
	$srnonew++;
}	
$mpno=floor($qt/$wtmp);
$totre=0; $nolots=0;
$sq=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='$cro' and disps_variety='$variet' and disps_flg!=1 and disp_id='$tid'") or die(mysqli_error($link));
if($to=mysqli_num_rows($sq) > 0)
{
	$ro=mysqli_fetch_array($sq);
	$sid=$ro['disps_id'];
	$sq23=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
	}
}
?>

<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cro?><input type="hidden" name="txtecrop" id="txtecrop" value="<?php echo $cro;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variet?><input type="hidden" name="txtevariety" id="txtevariety" value="<?php echo $variet;?>" /></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="20" class="smalltbltext" maxlength="30" name="txtpvariety" id="txtpvariety" value="<?php echo $variet;?>" /></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upstyp?><input type="hidden" name="txteupstyp" id="txteupstyp" value="<?php echo $upstyp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $up1?><input type="hidden" name="txteups" id="txteups" value="<?php echo $up1;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sstatus;?><input type="hidden" name="txtenop" id="txtenop" value="<?php echo $sstatus;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qt;?><input type="hidden" name="txteqty" id="txteqty" value="<?php echo $qt;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nolots;?><input type="hidden" name="txteordno" id="txteordno" value="<?php echo $orn;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" name="txtornomp" size="5" id="txtornomp" value="<?php echo $mpno;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" maxlength="5" name="txtnomp" id="txtnomp" value="" onchange="nompchk(this.value);" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtlonomp" id="txtlonomp" value="0" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txttlonomp" id="txttlonomp" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtorblnomp" id="txtorblnomp" value="" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
}
}
}
?>
</table>
</div>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Allocation Type</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Allocation type&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext"><input type="radio" name="allctyp" class="tbltext" value="lotwise" onClick="alloctype(this.value);" />&nbsp;Pick to Allocate&nbsp;&nbsp;<input type="radio" name="allctyp" class="tbltext" value="barcodewise" onClick="alloctype(this.value);" />&nbsp;Scan to Allocate&nbsp;<font color="#FF0000" >*</font>&nbsp;<input type="hidden" name="allocationtype" value="" /></td></tr>
</table>
<br />

<div id="barcwise" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Enter Barcode</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>

</table><br />
<div id="barupdetails" ></div>
</div>
<div id="lotnwise" style="display:none"></div>

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="112" align="center" class="smalltblheading">Crop</td>
	<td width="165" align="center" class="smalltblheading">Variety</td>
	<td width="105" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="65" align="center" class="smalltblheading">UPS</td>-->
	<td width="60" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="83" align="center" class="smalltblheading">DoT</td>
	<td width="187" align="center" class="smalltblheading">SLOC</td>
	<td width="66" align="center" class="smalltblheading">Select</td>
</tr>
<?php 
$sno1=1;
//if($dflg==0)
{
$sql_month=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='Condition'")or die("Error:".mysqli_error($link));
while($row_month=mysqli_fetch_array($sql_month))
{
$flg=0;
$lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; 

	$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='Condition' and lotldg_lotno='".$row_month['lotldg_lotno']."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='Condition' and lotldg_lotno='".$row_month['lotldg_lotno']."' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$rowmonth3['lotldg_balbags']; 
			$qty=$rowmonth3['lotldg_balqty'];
			
			$qc=$rowmonth3['lotldg_qc'];
			
			$trdate=$rowmonth3['lotldg_qctestdate'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$rowmonth3['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$rowmonth3['lotldg_subbinid']."' and binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				
				
				$diq=explode(".",$nob);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
				$nob=$difq;
				$diq=explode(".",$qty);
				if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
				$qty=$difq1;
				
				$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
				
				if($sloc=="")
				$sloc=$slocs;
				else
				$sloc=$sloc."<br />".$slocs;
				
				$totqty=$totqty+$qty; 
				$totnob=$totnob+$nob;
			}
			
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
		
			if($zz[0]=="GOT-NR")
			{
				if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				if(($rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="OK" && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
			
			if($vflg > 0) $flg++;
		}
	}
	
	if($totqty==0)$flg++;
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crpnm."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$vernm."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$lotno=$row_month['lotldg_lotno'];
//echo $flg;	
$subtid=$sid;
$llttn=""; $xcltn=array();
$sqq=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$subtid'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
if($llttn!="")
$llttn=$llttn.",".$roo['dallocss_lotno'];
else
$llttn=$roo['dallocss_lotno'];
}
if($llttn!="")
{
	$xcltn=explode(",",$llttn);
}

//if(!in_array($lotno,$xcltn))
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php if(!in_array($lotno,$xcltn)){?><input type="radio" name="lotsel" value="<?php echo $lotno?>" onchange="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $snoval;?>,'<?php echo $variety?>','<?php echo $upsids?>')" /><?php } else { ?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrec('<?php echo $lotno;?>',<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $variety?>')" /><?php } ?></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
}
?>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" /><input type="hidden" name="ltchksel" value="" />
</table>
<br />

<div id="postingsubsubtable" style="display:block">
<br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td width="50%" align="right" class="tblheading">Bin Shifting&nbsp;</td>
  <td align="left" class="tblheading"><input type="radio" name="binshift" value="yes" onclick="selnslsts(this.value);" />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="binshift" value="no" onclick="selnslsts(this.value);" />&nbsp;No</td>
</tr>
<input type="hidden" name="binshifting" value="" /><input type="hidden" name="nslval" value="<?php echo $tot4;?>"  />
</table>
<div id="shownsloc" style="display:<?php if($tot4>0) echo "block"; else echo "none";?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">SLOC Details</td>
</tr>
<tr class="Light" height="25">
	<td width="40" align="center" class="smalltblheading">#</td>
	<td width="243" align="center" class="smalltblheading">WH</td>
	<td width="270" align="center" class="smalltblheading">Bin</td>
  	<td width="190" align="center" class="smalltblheading">NoMP</td>
 	<td width="195" align="center" class="smalltblheading">Qty</td>
</tr>
<?php
if($tot4>0)
{
$sln=0;
while($ro4=mysqli_fetch_array($sq4))
{
$sln++;
?>
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
}
else
{
$sln=1;
?>
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php 
} 
?>
</table>
<?php
$tsln=$sln;
while($sln<5)
{
$sln++;
?>
<div id="nwslocs<?php echo $sln;?>" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."'  order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
</table>
</div>
<?php 
}
?>
<input type="hidden" name="sln" value="<?php echo $sln;?>"  /><input type="hidden" name="tsln" value="<?php echo $tsln;?>"  />
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="7" align="right" class="tblheading"><?php if($tsln<5) {?><a href="Javascript:void(0);" onclick="addnewsl(<?php echo $tsln+1;?>)">ADD New Bin...</a>&nbsp;<?php } ?></td>
</tr>
</table>
<input type="hidden" name="totnewsloc" value="0" /><input type="hidden" name="newsloc" value="" />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="bform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
</div>