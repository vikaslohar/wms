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
	
	ini_set("memory_limit","100M");
	
$sql_arr_home=mysqli_query($link,"select distinct(oldlot) from tbl_qctest where srdate<='2014-09-30'  order by lotno asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 	$t=1; $dt="2014-09-30";
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_arr_home23=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where oldlot='".$row_arr_home25['oldlot']."' order by tid asc") or die(mysqli_error($link));
		while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
		{
			$sql_tbl_sub24=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home25['oldlot']."' and sampleno='".$row_arr_home23['sampleno']."' and trstage!='Pack' order by tid desc") or die(mysqli_error($link));
			$subtbltot24=mysqli_fetch_array($sql_tbl_sub24);
			
			$sql_tbl_sub21=mysqli_query($link,"select * from tbl_qctest where tid='".$subtbltot24[0]."' and oldlot='".$row_arr_home25['oldlot']."' and sampleno='".$row_arr_home23['sampleno']."' and srdate<='$dt' and (qcstatus='UT' OR qcstatus='RT') and trstage!='Pack' order by tid asc") or die(mysqli_error($link));
			while($subtbltot21=mysqli_fetch_array($sql_tbl_sub21))
			{ 	
				$totqty=0; $c=0;
				$genp=80;
				$pp="Acceptable";
				$most=8;
				$dot="2014-09-30";
				$qcsts="OK";
				$qcref="DM-300914";
				
				if(($subtbltot21['qcstatus']=="UT" || $subtbltot21['qcstatus']=="RT") && ($subtbltot21['srdate']<=$dt) && ($subtbltot21['trstage']!="Pack"))
				{
					$sql_issue2=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where orlot='".$row_arr_home25['oldlot']."' ") or die(mysqli_error($link));
					while($row_issue2=mysqli_fetch_array($sql_issue2))
					{ 
						$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$row_arr_home25['oldlot']."' and lotldg_sstage='".$row_issue2['lotldg_sstage']."' ") or die(mysqli_error($link));
						while($row_issue=mysqli_fetch_array($sql_issue))
						{ 
							$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$row_arr_home25['oldlot']."' and lotldg_sstage='".$row_issue2['lotldg_sstage']."' ") or die(mysqli_error($link));
							$row_issue1=mysqli_fetch_array($sql_issue1); 
							$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
							while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
							{ 
								if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT")
								$c++;
								
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
							}
						}
						//echo $totqty."  ";
					}
					if($totqty==0)
					{
						$sql="update tbl_lot_ldg set lotldg_qc='".$qcsts."', lotldg_qctestdate='".$dot."', lotldg_gemp='".$genp."', lotldg_moisture='".$most."' where orlot='".$row_arr_home25['oldlot']."' and lotldg_qc!='OK' and lotldg_qc!='Fail'";
						$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
						
						$sql21="update tbl_qctest set qcstatus='".$qcsts."', testdate='".$dot."', pp='".$pp."', moist='".$most."', gemp='".$genp."', qcrefno='".$qcref."', qcflg=1  where oldlot='".$row_arr_home25['oldlot']."' and tid='".$subtbltot24[0]."'";
						$xc21=mysqli_query($link,$sql21) or die(mysqli_error($link));
						
						//echo $t."  ".$row_arr_home25['oldlot'];
						//echo "<br />";
						$t++;
					}
				}
			}
		}
	}
}
 echo "<script>alert('Result Updated......$t')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>