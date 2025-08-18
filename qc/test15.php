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
	
	$sql="SELECT * FROM `tbl_lot_ldg` WHERE `orlot` IN ('DI00492/00000/01', 'DI00493/00000/01', 'DI01945/00000/01', 'DI00936/00000/01', 'DI00935/00000/01') and lotldg_trtype='PROSLIPSUC' ORDER BY `orlot` ASC";
	//$sql.=" order by dosdate asc, oldlot asc ";
	
	$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	if($tot_arr_home > 0)
	{
		while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
		{
			
			$sqlmax2="select max(sampleno) from tbl_qctest where yearid='I' order by tid desc";
			$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
			$tot_max2=mysqli_num_rows($sql_max2);
			$row_arr_home3=mysqli_fetch_array($sql_max2);
			
			$sampno=$row_arr_home3[0]+1;
			$nwlotn=str_split($row_arr_home2['orlot']);
			$nwlotno=$nwlotn[0].$nwlotn[1].$nwlotn[2].$nwlotn[3].$nwlotn[4].$nwlotn[5].$nwlotn[6]."/".$nwlotn[8].$nwlotn[9].$nwlotn[10].$nwlotn[11].$nwlotn[12]."/00";
	
			$sqlmax23="select * from tbl_qctest where oldlot='".$nwlotno."' order by tid desc";
			$sql_max23=mysqli_query($link,$sqlmax23) or die(mysqli_error($link));
			$tot_max23=mysqli_num_rows($sql_max23);
			$row_qc=mysqli_fetch_array($sql_max23);
			
			
			$sql_sub_sub="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno) values('".$row_qc['spdate']."','0000-00-00','".$row_qc['pp']."','".$row_qc['moist']."','UT','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_arr_home2['lotldg_trdate']."','RT','".$sampno."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','0','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."',' ','".$row_arr_home2['lotldg_lotno']."','".$row_arr_home2['orlot']."','".$row_qc['yearid']."','".$row_qc['logid']."', '".$row_qc['state']."', '".$row_arr_home2['lotldg_sstage']."','".$row_qc['sampno']."')";
			
			
			//$sql_tbl_sub="update tbl_qctest set qc='UT', variety='452', crop='24', srdate='".$row_arr_home2['lotldg_trdate']."', trstage='Condition', sampleno='$sampno', state='P/M/G', yearid='I' WHERE oldlot='".$row_arr_home2['orlot']."' ";
			$zz=mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				
		}
	}
	//exit;
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>