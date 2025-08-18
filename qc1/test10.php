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
$cnt=0;	
$sql_arr_home=mysqli_query($link,"SELECT oldlot, lotno, sampleno, yearid, qcflg, plantcode FROM tbl_qctest WHERE `yearid`='M' and sampleno>0 GROUP BY sampleno HAVING COUNT(`sampleno`) > 1 order by tid ASC") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{ 
		$qcresult="Yes";
		if($row_arr_home['qcflg']==0){$qcresult="No";}
				
		$sql_arrhome=mysqli_query($link,"SELECT * FROM tbl_qctest WHERE `yearid`='M' and sampleno='".$row_arr_home['sampleno']."' and oldlot!='".$row_arr_home['oldlot']."' group by oldlot ") or die(mysqli_error($link));
		$tot_arrhome=mysqli_num_rows($sql_arrhome);
		if($tot_arrhome >0) 
		{
			while($row_arrhome=mysqli_fetch_array($sql_arrhome))
			{ 
				$qcresult2="Yes";
				if($row_arrhome['qcflg']==0){$qcresult2="No";}
				
				echo $row_arr_home['lotno']."=".$qcresult."=".$row_arr_home['plantcode'].$row_arr_home['yearid'].sprintf("%000006d",$row_arr_home['sampleno'])."=".$row_arrhome['tid']."=".$row_arrhome['lotno']."=".$qcresult2."=".$row_arrhome['plantcode'].$row_arrhome['yearid'].sprintf("%000006d",$row_arrhome['sampleno']);
				echo "<BR>";
			}
		}	
		//echo $sql_tbl_sub="update tbl_qctest set sampleno='$t' WHERE tid='".$row_arr_home['tid']."'";
		//echo "<BR>";
		//$zz=mysqli_query($link,$sql_tbl_sub) or die(mysqli_error($link));
		$cnt++;
	}
	echo $cnt;
}
?>
