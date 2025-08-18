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
		
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$dotage = $_REQUEST['dotage'];
		
	$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	if($dotage=="less45")
		$durations="Less than 45 days";
	if($dotage=="more45")
		$durations="More than 45 days";
	
	$crop1=$crop;
	$variety1=$variety;
	
	$dat=date("d-m-Y");		
	
	$dh="Sales_Return_Quality_Report";
	$datahead = array("Sales Return Quality Report as on Date - ".date("d-m-Y"));
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	$datahead1 = array("Crop: ",$crp,"Variety: ",$ver,"QC Test Duration: ",$durations);

$cont=0; $veriet="";

	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trtype='Sales Return' and lotldg_balqty > 0";

	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	
	
	if($tot_arr_home>0)
	{
		while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
		{ 
			$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."'  and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_balqty > 0 group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' order by lotldg_id asc ") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$flg=0;$qty=0;
							$qty=$row_issuetbl['lotldg_balqty'];
							$qcresult=$row_issuetbl['lotldg_qc'];
							$gotresult=$row_issuetbl['lotldg_got'];
							if($qcresult!="OK")$flg++;	
							if($gotresult=="Fail")$flg++;	
							if(($qcresult=="OK") && $qty==0)$flg++;
							
							$trdate2=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$trdate=$trday."-".$trmonth."-".$tryear;
							if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
							
							$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;
							
							if($dotage=="less45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt2="";
								}
								//echo $dt2;
								if($dt2!="")
								{
									if($trdate2<$dt2)$flg++;
								}
							}
							else if($dotage=="more45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt24="";
								}
								//echo $dt2;
								if($dt24!="")
								{
									if($trdate2>=$dt24)$flg++;
								}
							}
							else
							{
							}
							if($flg==0)
							{
								if($veriet!="")
								$veriet=$veriet.",".$row_issuetbl['lotldg_variety'];
								else
								$veriet=$row_issuetbl['lotldg_variety'];
								$cont++;
							}
							
						}
					}
				}
			}
		}
	}
	
	$qry2="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' AND trtype='Sales Return' and balqty > 0";

	if($crop!="ALL")
	{	
	$qry2.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
	$qry2.=" and lotldg_variety='$variety' ";
	}
	
	$qry2.=" group by lotldg_crop, lotldg_variety";
	$sql_arr_home12=mysqli_query($link,$qry2) or die(mysqli_error($link));
 	$tot_arr_home2=mysqli_num_rows($sql_arr_home12);
	
	
	
	if($tot_arr_home>0)
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
		{ 
			$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND  lotldg_crop='".$row_arr_home12['lotldg_crop']."' and lotldg_variety='".$row_arr_home12['lotldg_variety']."' and balqty > 0 and trtype='Sales Return' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0 group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$flg=0;$qty=0;
							$qty=$row_issuetbl['balqty'];
							$qcresult=$row_issuetbl['lotldg_qc'];
							$gotresult=$row_issuetbl['lotldg_got'];
							if($qcresult!="OK")$flg++;	
							if($gotresult=="Fail")$flg++;	
							if(($qcresult=="OK") && $qty==0)$flg++;
							
							$trdate2=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$trdate=$trday."-".$trmonth."-".$tryear;
							if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
							
							$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;
							
							if($dotage=="less45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt2="";
								}
								//echo $dt2;
								if($dt2!="")
								{
									if($trdate2<$dt2)$flg++;
								}
							}
							else if($dotage=="more45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt24="";
								}
								//echo $dt2;
								if($dt24!="")
								{
									if($trdate2>=$dt24)$flg++;
								}
							}
							else
							{
							}
							if($flg==0)
							{
								if($veriet!="")
								$veriet=$veriet.",".$row_issuetbl['lotldg_variety'];
								else
								$veriet=$row_issuetbl['lotldg_variety'];
								$cont++;
							}
							
						}
					}
				}
			}
		}
	}
//echo $veriet;
$variet=explode(",",$veriet);
$variet = array_unique($variet); 
sort($variet);
$cnt=1;
if($cont > 0)
{
	foreach($variet as $verval)
	{
		if($verval <> "")
		{
			$d=1; $totalbags=0; $totalqty=0;
			$quer4=mysqli_query($link,"SELECT popularname, cropname FROM tblvariety  where varietyid='".$verval."'"); 
			$noticia_item = mysqli_fetch_array($quer4);
			$varietyn=$noticia_item['popularname'];
			
			$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$noticia_item['cropname']."'");
			$noticia = mysqli_fetch_array($quer3);
			$cropn=$noticia['cropname'];
		 
			$datahead2[$cnt] = array("Crop:$cropn     Variety:$varietyn");
			$datahead3[$cnt] = array("#","Lot No.","Stage","UPS","NoP/NoB","Qty (In Kgs.)","SLOC","Qc Status","DOT","Duration from DoT","GOT Status"); 
					
			$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$noticia_item['cropname']."' and lotldg_variety='".$verval."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{
				$flg=0; $sups=0; $sqty=0; $sstage=""; $sloc="";
				$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $ups=""; $qcresult="";
				$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_balqty > 0  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  order by lotldg_id asc ") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
							
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0  order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{	$slups=0; $slqty=0;
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$slups=$row_issuetbl['lotldg_balbags'];
							$slqty=$row_issuetbl['lotldg_balqty'];
								
							$sups=$sups+$row_issuetbl['lotldg_balbags'];
							$sqty=$sqty+$row_issuetbl['lotldg_balqty'];
								
							$qcresult=$row_issuetbl['lotldg_qc'];
							$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
							if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
								$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
							else
								$gotresult=$gorr[0]." ".$gorr[1];
								
							$stage=$row_issuetbl['lotldg_sstage'];
							
							$aq=explode(".",$slqty);
							if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
							
							$an=explode(".",$slups);
							if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
								
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_subbinn=mysqli_fetch_array($sql_subbinn);
							$subbinn=$row_subbinn['sname'];
							
							$slups=$row_issuetbl['lotldg_balbags'];
							$slqty=$row_issuetbl['lotldg_balqty'];
							$aq1=explode(".",$slups);
							if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
							
							$an1=explode(".",$slqty);
							if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
							$slups=$ac1;
							$slqty=$acn1;
							if($sloc!="")
							$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty.",";
							else
							$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty.",";
							
							$lotno=$row_arr_home['lotldg_lotno'];
							$sstage=$row_arr_home['lotldg_sstage'];
							if($got=="")
							$got=$row_arr_home['lotldg_moisture'];
							if($stage=="")
							$stage=$row_arr_home['lotldg_gemp'];
							
							if($qcresult=="")
							$qcresult=$row_arr_home['lotldg_qc'];
							
							if($bags!="")
							{
							$bags=$bags.",".$acn;
							}
							else
							{
							$bags=$acn;
							}
							if($qty!="")
							{
							$qty=$qty.",".$ac;
							}
							else
							{
							$qty=$ac;
							}
							
							$trdate2=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$trdate=$trday."-".$trmonth."-".$tryear;
							if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
						
						}
					}
				}
			
				$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;
				
				if($dotage=="less45")
				{
					$dt=45;
					if($trdate!="")
					{
						$m=$trmonth;
						$de=$trday;
						$y=$tryear;
						$dt22=$dt;
						if($dt!="")
						{
							for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
						}
						else
						$dt2="";
					}
					//echo $dt2;
					if($dt2!="")
					{
						if($trdate2<$dt2)$flg++;
					}
				}
				else if($dotage=="more45")
				{
					$dt=45;
					if($trdate!="")
					{
						$m=$trmonth;
						$de=$trday;
						$y=$tryear;
						$dt22=$dt;
						if($dt!="")
						{
							for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
						}
						else
						$dt24="";
					}
					//echo $dt2;
					if($dt24!="")
					{
						if($trdate2>=$dt24)$flg++;
					}
				}
				else
				{
				}
				
				$diff = abs(strtotime($trdate240) - strtotime($trdate));
				$days = floor($diff / (60*60*24));
				$days=$days;
				$gotres=explode(" ", $gotresult);
				if($gotres[1]=="Fail")$flg=1;
				if($qcresult!="OK")$flg=1;
				if($flg==0)
				{
					$totalqty=$totalqty+$qty; 
					$totalbags=$totalbags+$bags;
					$data1[$cnt][$d]=array($d,$lotno,$stage,$ups,$bags,$qty,$sloc,$qcresult,$trdate,$days,$gotresult);
					$d++;
				}
			}
		
			$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$noticia_item['cropname']."' and lotldg_variety='".$verval."' and balqty > 0 and trtype='Sales Return' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$flg=0;	$sups=0; $sqty=0; $sstage=""; $sloc="";
				$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $ups=""; $qcresult="";
				$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0  group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
							
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0  order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{	$slups=0; $slqty=0;
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$slups=$row_issuetbl['balnop'];
							$slqty=$row_issuetbl['balqty'];
								
							$sups=$sups+$row_issuetbl['balnop'];
							$sqty=$sqty+$row_issuetbl['balqty'];
								
							$qcresult=$row_issuetbl['lotldg_qc'];
							$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
							if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
								$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
							else
								$gotresult=$gorr[0]." ".$gorr[1];
								
							$stage=$row_issuetbl['lotldg_sstage'];
							
							$aq=explode(".",$slqty);
							if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
							
							$an=explode(".",$slups);
							if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
								
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
							$row_subbinn=mysqli_fetch_array($sql_subbinn);
							$subbinn=$row_subbinn['sname'];
							
							$slups=$row_issuetbl['balnop'];
							$slqty=$row_issuetbl['balqty'];
							$aq1=explode(".",$slups);
							if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
							
							$an1=explode(".",$slqty);
							if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
							$slups=$ac1;
							$slqty=$acn1;
							if($sloc!="")
							$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty.",";
							else
							$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty.",";
							
							$lotno=$row_arr_home['lotno'];
							$sstage=$row_arr_home['lotldg_sstage'];
							if($got=="")
							$got=$row_arr_home['lotldg_moisture'];
							if($stage=="")
							$stage=$row_arr_home['lotldg_gemp'];
							
							if($qcresult=="")
							$qcresult=$row_arr_home['lotldg_qc'];
							
							if($bags!="")
							{
							$bags=$bags.",".$acn;
							}
							else
							{
							$bags=$acn;
							}
							if($qty!="")
							{
							$qty=$qty.",".$ac;
							}
							else
							{
							$qty=$ac;
							}
							
							$trdate2=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$trdate=$trday."-".$trmonth."-".$tryear;
							if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
						
						}
					}
				}
			
				$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;
				
				if($dotage=="less45")
				{
					$dt=45;
					if($trdate!="")
					{
						$m=$trmonth;
						$de=$trday;
						$y=$tryear;
						$dt22=$dt;
						if($dt!="")
						{
							for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
						}
						else
						$dt2="";
					}
					//echo $dt2;
					if($dt2!="")
					{
						if($trdate2<$dt2)$flg++;
					}
				}
				else if($dotage=="more45")
				{
					$dt=45;
					if($trdate!="")
					{
						$m=$trmonth;
						$de=$trday;
						$y=$tryear;
						$dt22=$dt;
						if($dt!="")
						{
							for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
						}
						else
						$dt24="";
					}
					//echo $dt2;
					if($dt24!="")
					{
						if($trdate2>=$dt24)$flg++;
					}
				}
				else
				{
				}
				
				$diff = abs(strtotime($trdate240) - strtotime($trdate));
				$days = floor($diff / (60*60*24));
				$days=$days;
				$gotres=explode(" ", $gotresult);
				if($gotres[1]=="Fail")$flg=1;
				if($qcresult!="OK")$flg=1;
				if($flg==0)
				{
					$totalqty=$totalqty+$qty; 
					$totalbags=$totalbags+$bags;
					$data1[$cnt][$d]=array($d,$lotno,$stage,$ups,$bags,$qty,$sloc,$qcresult,$trdate,$days,$gotresult);
					$d++;
				}
			}
			$datahead4[$cnt] = array("","","","Total",$totalbags,$totalqty,"","","","",""); 
		$cnt++;
		}
	}
}
echo implode($datahead) ;
echo "\n";
echo implode("\t", $datahead1) ;
echo "\n";
for($i=1; $i<$cnt; $i++)
{
	echo implode($datahead2[$i]) ;
	echo "\n";
	echo implode("\t", $datahead3[$i]) ;
	echo "\n";
	foreach($data1[$i] as $row1)
	{ 
		echo implode("\t", array_values($row1))."\n"; 
	}
	echo implode("\t", $datahead4[$i]) ;
	echo "\n";
}
	