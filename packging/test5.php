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
	
	ini_set("memory_limit","80M");
	
$sql_arr_home2=mysqli_query($link,"SELECT unp_lotno, unp_orlot, unp_newlotno, unp_date FROM tbl_psunpp2c where plantcode='$plantcode' and unp_newlotno IN ('DA00043/00000/01C','DA00147/00000/03C','DA00147/00000/04C','DA01604/00000/01C','DA01604/00100/01C','DA06217/00070/01C','DA90054/00000/03C','DA90068/01376/01C','DD00634/00000/05C','DF00579/00000/01C','DF00656/01391/01C','DF01045/01390/01C','DF01114/00000/01C','DF01138/01392/01C','DF01233/00000/01C','DF01276/00000/06C','DF01288/00000/04C','DF01290/00000/02C','DF02114/00000/01C','DF02757/00000/01C','DF03596/00021/01C','DF04118/00000/01C','DF05168/00000/01C','DF05429/00000/12C','DF05429/00000/13C','DF05504/00000/15C','DF05504/00000/16C','DF05507/00000/24C','Df06117/00000/02C','Df06117/00000/03C','DF09561/00000/03C','DF09602/00000/01C','DF09945/00000/01C','DF09972/00000/01C','DF09982/00000/01C','DF10630/00000/02C','DF90077/00000/04C','DF90077/00000/05C','DF90077/00000/08C','DF90130/00000/01C','DF90203/00000/01C','DF90266/00000/03C','DF90284/00000/01C','DF90288/00000/01C','DF90289/00000/01C','DF90351/00000/02C','DK00016/00000/01C','DK00038/00000/03C','DK00038/00000/04C','DN05286/01330/01C','DN10417/00000/02C','DN10562/00280/01C','DP01681/00000/03C','DP01729/00000/03C','DP01731/00000/02C','DP01734/00000/01C','DP90276/00000/02C','DS00547/00000/01C','DS00753/01388/01C','DS00779/00845/01C','DS01101/00282/01C','DS02504/00000/01C','DS02765/00476/01C','DS03294/01449/01C','DS03294/01449/02C','DS90086/00000/06C','DS90288/00141/01C') order by unp_newlotno") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
$t=1;
//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$sqlvsriety2=mysqli_query($link,"Select max(tid) from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."'") or die(mysqli_error($link));
		$rowvariety2=mysqli_fetch_array($sqlvsriety2);
		$tot2=mysqli_num_rows($sqlvsriety2);
		if($tot2>0)
		{
			$sqlvsriety=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."' and tid='".$rowvariety2[0]."' and (qcstatus='UT' or qcstatus='RT') ") or die(mysqli_error($link));
			if($totvariety=mysqli_num_rows($sqlvsriety)>0)
			{
				$subtbltot=mysqli_fetch_array($sqlvsriety);
				//echo $t." ";
				//if($row_arr_home2['unp_date']>=$subtbltot['testdate'])
				{
				//echo "<br>";
				$zzz=implode(",", str_split($row_arr_home2['unp_newlotno']));
				$unp_orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
					
				$sql="insert into  tbl_qctest (spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity, state, yearid, logid, trstage, lotno, oldlot, plantcode) values('".$subtbltot['spdate']."','".$subtbltot['testdate']."','".$subtbltot['gotdate']."','".$subtbltot['dosdate']."','".$subtbltot['pp']."','".$subtbltot['moist']."','".$subtbltot['got']."','".$subtbltot['qc']."','".$subtbltot['variety']."','".$subtbltot['crop']."','".$subtbltot['gemp']."','".$subtbltot['srdate']."','".$subtbltot['qcstatus']."','".$subtbltot['gotstatus']."','".$subtbltot['sampleno']."','".$subtbltot['aflg']."','".$subtbltot['bflg']."','".$subtbltot['cflg']."','".$subtbltot['qcflg']."','".$subtbltot['gotflg']."','".$subtbltot['gsflg']."','".$subtbltot['gs']."','".$subtbltot['gotrefno']."','".$subtbltot['gotauth']."','".$subtbltot['doswdate']."','".$subtbltot['gotsmpdflg']."','".$subtbltot['stsno']."','".$subtbltot['qcrefno']."','".$subtbltot['genpurity']."','".$subtbltot['state']."','".$subtbltot['yearid']."','PK1','Condition','".$row_arr_home2['unp_newlotno']."','".$unp_orlot."', '$plantcode')";
				$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
				//echo "<br>";$t++;
				}
			}
			
			
			$sqlvsriety=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."' and tid='".$rowvariety2[0]."' and (qcstatus='OK' or qcstatus='Fail') ") or die(mysqli_error($link));
			if($totvariety=mysqli_num_rows($sqlvsriety)>0)
			{
				$subtbltot=mysqli_fetch_array($sqlvsriety);
				//echo $t." ";
				if($row_arr_home2['unp_date']>=$subtbltot['testdate'])
				{
				//echo "<br>";
				$zzz=implode(",", str_split($row_arr_home2['unp_newlotno']));
				$unp_orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
					
				$sql="update  tbl_lot_ldg set lotldg_qc='".$subtbltot['qcstatus']."' , lotldg_qctestdate='".$subtbltot['testdate']."' where orlot='".$unp_orlot."'";
				$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
				$sql2="update  tbl_lot_ldg_pack set lotldg_qc='".$subtbltot['qcstatus']."' , lotldg_qctestdate='".$subtbltot['testdate']."' where orlot='".$unp_orlot."'";
				$xc2=mysqli_query($link,$sql2) or die(mysqli_error($link));
				//echo "<br>";$t++;
				}
			}
			
			$sqlvsriety=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."' and tid='".$rowvariety2[0]."' and (qcstatus='OK' or qcstatus='Fail') ") or die(mysqli_error($link));
			if($totvariety=mysqli_num_rows($sqlvsriety)>0)
			{
				$subtbltot=mysqli_fetch_array($sqlvsriety);
				//echo $t." ";
				if($row_arr_home2['unp_date']<=$subtbltot['testdate'])
				{
				//echo "<br>";
				$zzz=implode(",", str_split($row_arr_home2['unp_newlotno']));
				$unp_orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
					
				$sql="update  tbl_lot_ldg set lotldg_qc='".$subtbltot['qcstatus']."' , lotldg_qctestdate='".$subtbltot['testdate']."' where orlot='".$unp_orlot."'";
				$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
				$sql2="update  tbl_lot_ldg_pack set lotldg_qc='".$subtbltot['qcstatus']."' , lotldg_qctestdate='".$subtbltot['testdate']."' where orlot='".$unp_orlot."'";
				$xc2=mysqli_query($link,$sql2) or die(mysqli_error($link));
				//echo "<br>";$t++;
				}
			}
			$sqlvsriety=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."' and tid='".$rowvariety2[0]."' and qcstatus='Abort' ") or die(mysqli_error($link));
			if($totvariety=mysqli_num_rows($sqlvsriety)>0)
			{
				$subtbltot=mysqli_fetch_array($sqlvsriety);
				
				$sqlvsriety23=mysqli_query($link,"Select tid from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."' and qcstatus!='UT' and qcstatus!='RT' order by tid desc LIMIT 1,1") or die(mysqli_error($link));
				$rowvariety23=mysqli_fetch_array($sqlvsriety23);
				//echo $rowvariety23[0];
				
				$sqlvsriety24=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['unp_orlot']."' and tid='".$rowvariety22[0]."'") or die(mysqli_error($link));
				$subtbltot24=mysqli_fetch_array($sqlvsriety24);
				//echo $t." ";
				//if($row_arr_home2['unp_date']>=$subtbltot['testdate'])
				{
				//echo "<br>";
				$zzz=implode(",", str_split($row_arr_home2['unp_newlotno']));
				$unp_orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
				
				$sql="update  tbl_lot_ldg set lotldg_qc='".$subtbltot24['qcstatus']."' , lotldg_qctestdate='".$subtbltot24['testdate']."' where orlot='".$unp_orlot."'";
				$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
				$sql2="update  tbl_lot_ldg_pack set lotldg_qc='".$subtbltot24['qcstatus']."' , lotldg_qctestdate='".$subtbltot24['testdate']."' where orlot='".$unp_orlot."'";
				$xc2=mysqli_query($link,$sql2) or die(mysqli_error($link));
					
				//echo "<br>";$t++;
				}
			}
		}
		else
		{
			$zzz=implode(",", str_split($row_arr_home2['unp_newlotno']));
			$unp_orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
			
			$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where plantcode='$plantcode' and yearid='".$yearid_id."' ORDER BY tid DESC";
			$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode1=$t_code1+1;
			}
			else
			{
				$ncode1=1;
			}
			$yrco=$yearid_id;
				
			$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and orlot='".$unp_orlot."' order by lotldg_id desc") or die(mysqli_error($link)); 
			$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
			
			$sql="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid, plantcode)values('".$row_issuetbl22['lotldg_vchk']."', '".$row_issuetbl22['lotldg_moisture']."', '".$row_issuetbl22['lotldg_got']."', '".$row_issuetbl22['lotldg_lotno']."', '".$row_arr_home2['unp_date']."', '".$row_issuetbl22['lotldg_crop']."', '".$row_issuetbl22['lotldg_variety']."', '$ncode1', 'Condition', 'UT', 'P/M/G',1,'$unp_orlot', '$yrco','$logid', '$plantcode')";
			$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
							
		}
		
	}
}
//echo $t;
 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>