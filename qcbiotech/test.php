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
	
$sql_arr_home=mysqli_query($link,"select distinct(oldlot) from tbl_qctest where sampleno=0  order by oldlot asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		 $smpno=""; $tid=""; $smpnor="";
		$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home['oldlot']."' and sampleno=0  order by oldlot asc") or die(mysqli_error($link));
		$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
		//echo "select max(tid) from tbl_qctest where oldlot='".$row_arr_home['oldlot']."' and tid < '".$row_arr_home2[0]."' order by oldlot asc";
		$sql_tbl_sub2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home['oldlot']."' and tid < '".$row_arr_home2[0]."' order by oldlot asc") or die(mysqli_error($link));
		$tot=mysqli_num_rows($sql_tbl_sub2);
		if($tot > 0)
		{
			$subtbltot2=mysqli_fetch_array($sql_tbl_sub2);
			$ttid=$subtbltot2[0];
		}
		else
		{
			$sql_tbl_sub23=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home['oldlot']."' and tid<='".$row_arr_home2[0]."' order by oldlot asc") or die(mysqli_error($link));
			$subtbltot23=mysqli_fetch_array($sql_tbl_sub23);
			$ttid=$subtbltot23[0];
		}
		//echo $ttid."  =  ".$row_arr_home2[0]."<br />";
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home['oldlot']."' and tid='".$ttid."' order by oldlot asc") or die(mysqli_error($link));
		while($subtbltot=mysqli_fetch_array($sql_tbl_sub))
		{ $t++; 
			
			$sql_arr_home24=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home['oldlot']."' and sampleno=0 and tid='".$row_arr_home2[0]."'  order by oldlot asc") or die(mysqli_error($link));
			$row_arr_home24=mysqli_fetch_array($sql_arr_home24);
			$stage="";
			$zzz=implode(",", str_split($row_arr_home24['lotno']));
			if($zzz[32]=="R")$stage="Raw";if($zzz[32]=="C")$stage="Condition";if($zzz[32]=="P")$stage="Pack";
		
			$sql="update tbl_qctest set spdate='".$subtbltot['spdate']."', testdate='".$subtbltot['testdate']."', gotdate='".$subtbltot['gotdate']."', dosdate='".$subtbltot['dosdate']."', pp='".$subtbltot['pp']."', moist='".$subtbltot['moist']."', got='".$subtbltot['got']."', qc='".$subtbltot['qc']."', variety='".$subtbltot['variety']."', crop='".$subtbltot['crop']."', gemp='".$subtbltot['gemp']."', srdate='".$subtbltot['srdate']."', qcstatus='".$subtbltot['qcstatus']."', gotstatus='".$subtbltot['gotstatus']."', sampleno='".$subtbltot['sampleno']."', aflg='".$subtbltot['aflg']."', bflg='".$subtbltot['bflg']."', cflg='".$subtbltot['cflg']."', qcflg='".$subtbltot['qcflg']."', gotflg='".$subtbltot['gotflg']."', gsflg='".$subtbltot['gsflg']."', gs='".$subtbltot['gs']."', gotrefno='".$subtbltot['gotrefno']."', gotauth='".$subtbltot['gotauth']."', doswdate='".$subtbltot['doswdate']."', gotsmpdflg='".$subtbltot['gotsmpdflg']."', stsno='".$subtbltot['stsno']."', qcrefno='".$subtbltot['qcrefno']."', genpurity='".$subtbltot['genpurity']."', state='".$subtbltot['state']."', yearid='".$subtbltot['yearid']."', logid='PR1', trstage='$stage' where tid='".$row_arr_home2[0]."' and sampleno=0 ";
			$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
			//echo $row_arr_home['oldlot']." - ".$t." - ".$smpnor." - ".$smpno." - ".$tid."<br>";
			//echo "<br />".$t;echo "<br />";
		}
	}
	
}
 echo "<script>alert('Sample No Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>