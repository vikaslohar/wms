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
		$pid = $_REQUEST['itmid'];
	}
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_stoutmpack where plantcode='".$plantcode."' and stoutmp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['stoutmp_id'];
$ptype=$row_tbl['disp_partytype'];

$ntitle="Stock Transfer Dispatch Note (PSTON)";
$ntyps="PSTON";

	

	$tdate=$row_tbl['stoutmp_ddate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['stoutmp_date'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;

$sql23="select * from tbluser where plantcode='".$plantcode."' and scode='".$row_tbl['stoutmp_logid']."'";
$row_23=mysqli_query($link,$sql23) or die(mysqli_error($link));
$totalrow23= mysqli_num_rows($row_23);
$ObjRS23= mysqli_fetch_array($row_23);

$username=$ObjRS23['loginid'];
$emp_id = $ObjRS23['password']; 

		
$sql_opr=mysqli_query($link,"select * from tblopr where plantcode='".$plantcode."' and login='$username' and BinARY pass like '".$emp_id."'") or die(mysqli_error($link));
$row_opr=mysqli_fetch_array($sql_opr);
$logname=$row_opr['name'];

$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
	
$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and dnote_trid='$tid' ";
$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
$row_code1=mysqli_fetch_array($res_code1);

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);


$code1=$row_param['code']."/"."SD"."/".$row_tbl['stoutmp_yearid']."/".$row_code1['dnote_code'];
	
$ordernos=""; $porefno="";  $veri=""; $ordernos2="";
$sql_arrssub=mysqli_query($link,"select distinct stoutsp_variety from tbl_stoutspack where plantcode='".$plantcode."' and stoutmp_id='".$pid."'") or die(mysqli_error($link));
$a_arrssub=mysqli_num_rows($sql_arrssub);
while($row_arrssub=mysqli_fetch_array($sql_arrssub))
{	
	if($veri!="")
	$veri=$veri.",".$row_arrssub['stoutsp_variety'];
	else
	$veri=$row_arrssub['stoutsp_variety'];
}		


$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['stoutmp_plantid']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
$country="";
if($noticia['classification']=="Export Buyer") 
{
	$sql_month2=mysqli_query($link,"select * from tblcountry where c_id='".$noticia['country']."' order by country")or die(mysqli_error($link));
	$noticia2 = mysqli_fetch_array($sql_month2);
	$country=$noticia2['country'];
}

echo $noticia['business_name'];
 if($noticia['city']!="") { echo " ".$noticia['city']; }
 echo $noticia['address'];
  if($noticia['city']!="") { echo ", ".$noticia['city']; }
   echo $noticia['state'];
   if($noticia['pin']!="" && $noticia['pin']>0) { echo " - ".$noticia['pin']."."; }
    if($noticia['classification']=="Export Buyer") { echo " (".$country.")"; }
	 if($noticia['phone']!="" && $noticia['phone']>0) { echo " Ph - 0".$noticia['std']."-".$noticia['phone']; }
	  if($noticia['mob']!="" && $noticia['mob']>0) { echo " M - ".$noticia['mob']; }
	  
 echo $row_tbl['stoutmp_tmode'];
 
if($row_tbl['stoutmp_tmode'] == "Transport")
{

 echo $row_tbl['stoutmp_tname'];
 echo $row_tbl['stoutmp_lorryrepno'];
 echo $row_tbl['stoutmp_tvehno'];
 echo $row_tbl['stoutmp_paymode'];
 
}
else if($row_tbl['stoutmp_tmode'] == "Courier")
{

 echo $row_tbl['stoutmp_couriername'];
 
 echo $row_tbl['stoutmp_docketno'];
 
}
else 
{

 echo $row_tbl['stoutmp_pnamebyhand'];
 
}


$vid="";
//echo "select distinct stoutsp_variety from tbl_stoutspack where stoutmp_id='$tid' and stoutsp_subflg=1 order by stoutsp_crop ASC, stoutsp_variety asc";
$sqlarrhome=mysqli_query($link,"select distinct stoutsp_variety from tbl_stoutspack where plantcode='".$plantcode."' and stoutmp_id='$tid' and stoutsp_subflg=1 order by stoutsp_crop ASC, stoutsp_variety asc") or die(mysqli_error($link));
$totarrhome=mysqli_num_rows($sqlarrhome);

	/*if($vid!="")
	$vid=$vid.",".$rowarrhome['stoutsp_variety'];
	else
	$vid=$row_var['stoutsp_variety'];
}*/


$sn=1; $totnomp=0; $totqty=0; $tnopc=0; $tnopb=0;
$vids=explode(",", $vid);
while($rowarrhome=mysqli_fetch_array($sqlarrhome))
{
	$nvariety=""; $lotno1=""; $nups=""; $nob=0; $qty=0; $tnob=0; $tqty=0; $bartyp=""; $dov=""; $dot=""; $loosenop=0;
	
	$sql_arr_home3=mysqli_query($link,"select distinct stoutsp_lotno from tbl_stoutspack where plantcode='".$plantcode."' and stoutmp_id='$tid' and stoutsp_variety='".$rowarrhome['stoutsp_variety']."' order by stoutsp_id asc") or die(mysqli_error($link));
	$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
	while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
	{
		$nnob1=0; $nqty1=0; $nob1=0; $qty1=0; $tnomp=0;  $nnob2=0; $nqty2=0; $nobtp=""; $bartyp1="";
		$sql_sub=mysqli_query($link,"Select * from tbl_stoutsspack where plantcode='".$plantcode."' and stoutssp_lotno='".$row_arr_home3['stoutsp_lotno']."' and stoutmp_id='$tid' and (stoutssp_barcodetype='SMC' or stoutssp_barcodetype='NMC')") or die(mysqli_error($link));
		$zxc=mysqli_num_rows($sql_sub);
		while($row_sub=mysqli_fetch_array($sql_sub))
		{
			$nob1++;
			$qty1=$qty1+$row_sub['stoutssp_qty'];	
			
			if($bartyp1=="")
				$bartyp1=$row_sub['stoutssp_barcodetype'];
		}
		
		$sql_ups=mysqli_query($link,"select * from tbl_stoutspack where plantcode='".$plantcode."' and stoutsp_lotno='".$row_arr_home3['stoutsp_lotno']."' and stoutmp_id='$tid'") or die(mysqli_error($link));
		$row_ups=mysqli_fetch_array($sql_ups);
		if($nups=="")
			$nups=$row_ups['stoutsp_ups'];
		else
			$nups=$nups."<br/>".$row_ups['stoutsp_ups'];
		
		$dot1=$row_ups['stoutsp_qcpackdate'];
		$tryear=substr($dot1,0,4);
		$trmonth=substr($dot1,5,2);
		$trday=substr($dot1,8,2);
		$dot2=$trday."-".$trmonth."-".$tryear;
		
		if($dot=="")
			$dot=$dot2;
		else
			$dot=$dot."<br/>".$dot2;
		
		$dov1=$row_ups['stoutsp_dov'];
		$tryear=substr($dov1,0,4);
		$trmonth=substr($dov1,5,2);
		$trday=substr($dov1,8,2);
		$dov2=$trday."-".$trmonth."-".$tryear;
		
		if($dov=="")
			$dov=$dov2;
		else
			$dov=$dov."<br/>".$dov2;
			
		if($loosenop==0)
			$loosenop=$row_ups['stoutsp_loadnop'];
		else
			$loosenop=$loosenop."<br/>".$row_ups['stoutsp_loadnop'];
		
		$sql_cropvar=mysqli_query($link,"select cropid, popularname from tblvariety where varietyid='".$rowarrhome['stoutsp_variety']."' ") or die(mysqli_error($link));
		$row_cropvar=mysqli_fetch_array($sql_cropvar);
		$crop=$row_cropvar['cropid'];
		$nvariety=$row_cropvar['popularname'];
		
		if($bartyp1=="SMC")
		{
			$packtp=explode(" ",$nups);
			$srnonew=0; $uom="";
			$p1_array=explode(",",$row_cropvar['gm']);
			$p1_array2=explode(",",$row_cropvar['mtype']);
			foreach($p1_array as $val1)
			{
				if($val1<>"")
				{
					$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
					$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
					if($row1234=mysqli_num_rows($res)>0)
					{
						$nobtyp=$p1_array2[$srnonew];
						if($nobtyp=="Carton")
						{
							$tnopc=$tnopc+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/C";
							else
								$bartyp=$bartyp1."/C";
						}
						else if($nobtyp=="Bag")
						{
							$tnopb=$tnopb+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/B";
							else
								$bartyp=$bartyp1."/B";
						}
						else
						{
							$tnopc=$tnopc+$nmp;
						}
					}
				}
				$srnonew++;
			}
		}
		else
		{
			$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and bar_barcode='".$roo['dpss_barcode']."'") or die(mysqli_error($link));
			$totbarcode=mysqli_num_rows($sqlbarcode);
			$rowbarcode=mysqli_fetch_array($sqlbarcode);
			$nobtyp=$rowbarcode['mpmain_mptype'];
			if($nobtyp=="Carton")
			{
				$tnopc=$tnopc+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/C";
				else
					$bartyp=$bartyp1."/C";
			}
			else if($nobtyp=="Bag")
			{
				$tnopb=$tnopb+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/B";
				else
					$bartyp=$bartyp1."/B";
			}
			else
			{$tnopc=$tnopc+$nmp;}
		}
		/*if($bartyp!="")
			$bartyp=$bartyp."<br/>".$bartyp1;
		else
			$bartyp=$bartyp1;*/
		
		
		if($lotno1=="")
			$lotno1=$row_arr_home3['stoutsp_lotno'];
		else
			$lotno1=$lotno1."<br/>".$row_arr_home3['stoutsp_lotno'];
			
		if($nob==0)
			$nob=$nob1;
		else
			$nob=$nob."<br/>".$nob1;
			
		if($qty==0)
			$qty=$qty1;
		else
			$qty=$qty."<br/>".$qty1;
		
		$tnob=$tnob+$nob1; 
		$tqty=$tqty+$qty1;
	}

 echo $sn;
 echo $crop
 echo $nvariety
 echo $nups;
 echo $lotno1;
 echo $dot;
 echo $dov;
 echo $bartyp;
 echo $loosenop;
 echo $nob;
 echo $qty;
 echo $tnob;
 echo $tqty;
 
$sn++;
$totnomp=$totnomp+$tnob;
$totqty=$totqty+$tqty;	
}


$sql_sub=mysqli_query($link,"Select distinct stoutssp_barcode from tbl_stoutsspack where plantcode='".$plantcode."' and stoutmp_id='$tid' and stoutssp_barcodetype!='SMC' and stoutssp_barcodetype!='NMC'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
$barcodes=$row_sub['stoutssp_barcode'];
if($barcodes!="")
{
	$upsval=""; $lotval=""; $dotval=""; $dovval=""; $lotqty=""; $barqty=""; $nnob1=""; $nnob2=0; $crop=""; $var="";
	$sql_sub1=mysqli_query($link,"Select * from tbl_stoutsspack where plantcode='".$plantcode."' and stoutssp_barcode='".$row_sub['stoutssp_barcode']."'stoutmp_id='$tid' and stoutssp_barcodetype!='SMC' and stoutssp_barcodetype!='NMC'") or die(mysqli_error($link));
	while($row_sub1=mysqli_fetch_array($sql_sub1))
	{
		if($lotval=="")
			$lotval=$row_sub1['stoutssp_lotno'];
		else
			$lotval=$lotval."<br/>".$row_sub1['stoutssp_lotno'];
			
		if($lotqty=="")
			$lotqty=$row_sub1['stoutssp_lotqty'];
		else
			$lotqty=$lotqty."<br/>".$row_sub1['stoutssp_lotqty'];
			
		if($barqty=="")
			$barqty=$row_sub1['stoutssp_qty'];
			
		if($nnob2==0)
			$nnob2++;
		if($nnob1=="")
			$nnob1=$nnob2;
		else
			$nnob1=$nnob1."<br/>".$nnob2;
			
		if($upsval=="")
			$upsval=$row_sub1['stoutssp_ups'];
		else
			$upsval=$upsval."<br/>".$row_sub1['stoutssp_ups'];
		
		$sql_sub11=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and stoutsp_id='".$row_sub1['stoutsp_id']."' ") or die(mysqli_error($link));
		$row_sub11=mysqli_fetch_array($sql_sub11);
		
		$dot1=$row_sub11['stoutsp_qcpackdate'];
		$tryear=substr($dot1,0,4);
		$trmonth=substr($dot1,5,2);
		$trday=substr($dot1,8,2);
		$dot=$trday."-".$trmonth."-".$tryear;
		
		$dov1=$row_sub11['stoutsp_dov'];
		$tryear=substr($dov1,0,4);
		$trmonth=substr($dov1,5,2);
		$trday=substr($dov1,8,2);
		$dov=$trday."-".$trmonth."-".$tryear;	
		
		if($dotval=="")
			$dotval=$dot;
		else
			$dotval=$dotval."<br/>".$dot;
			
		if($dovval=="")
			$dovval=$dov;
		else
			$dovval=$dovval."<br/>".$dov;
			
		$sql_cropvar1=mysqli_query($link,"select cropid, popularname from tblvariety where varietyid='".$row_sub11['stoutsp_qcpackdate']."' ") or die(mysqli_error($link));
		$row_cropvar1=mysqli_fetch_array($sql_cropvar1);
			
		if($crop=="")
			$crop=$row_cropvar1['cropid'];
		else
			$crop=$crop."<br/>".$row_cropvar1['cropid'];
		
		if($var=="")
			$var=$row_cropvar1['popularname'];
		else
			$var=$var."<br/>".$row_cropvar1['popularname'];
			
			
		if($bartyp1=="SMC")
		{
			$packtp=explode(" ",$upsval);
			$srnonew=0; $uom="";
			$p1_array=explode(",",$row_cropvar1['gm']);
			$p1_array2=explode(",",$row_cropvar1['mtype']);
			foreach($p1_array as $val1)
			{
				if($val1<>"")
				{
					$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
					$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
					if($row1234=mysqli_num_rows($res)>0)
					{
						$nobtyp=$p1_array2[$srnonew];
						if($nobtyp=="Carton")
						{
							$tnopc=$tnopc+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/C";
							else
								$bartyp=$bartyp1."/C";
						}
						else if($nobtyp=="Bag")
						{
							$tnopb=$tnopb+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/B";
							else
								$bartyp=$bartyp1."/B";
						}
						else
						{
							$tnopc=$tnopc+$nmp;
						}
					}
				}
				$srnonew++;
			}
		}
		else
		{
			$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and bar_barcode='".$roo['dpss_barcode']."'") or die(mysqli_error($link));
			$totbarcode=mysqli_num_rows($sqlbarcode);
			$rowbarcode=mysqli_fetch_array($sqlbarcode);
			$nobtyp=$rowbarcode['mpmain_mptype'];
			if($nobtyp=="Carton")
			{
				$tnopc=$tnopc+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/C";
				else
					$bartyp=$bartyp1."/C";
			}
			else if($nobtyp=="Bag")
			{
				$tnopb=$tnopb+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/B";
				else
					$bartyp=$bartyp1."/B";
			}
			else
			{$tnopc=$tnopc+$nmp;}
		}
		
	}

echo $sn;
echo $crop
echo $var
echo $upsval;
echo $lotval;
echo $dotval;
echo $dovval;
echo $nobtp;
echo $nnob1;
echo $lotqty;
echo $nnob2;
echo $barqty;

$sn++;
}
$totnomp=$totnomp+$nnob2;
$totqty=$totqty+$barqty;	
}	


echo $row_tbl['disp_remarks'];
?>