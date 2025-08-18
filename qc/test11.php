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
	
	$sql="select distinct(sampleno) from tbl_qctest where (state='P/M/G/T' or state='T')";
	$sql.=" order by dosdate asc, oldlot asc ";
	
	$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	if($tot_arr_home > 0)
	{
		while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
		{
			$tid=""; $fg=0;
			$sqlmax2="select tid, gotsmpdflg, oldlot from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and (state='P/M/G/T' or state='T')";
			$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
			$tot_max2=mysqli_num_rows($sql_max2);
			while($row_arr_home3=mysqli_fetch_array($sql_max2))
			{
				if($row_arr_home3['gotsmpdflg']==0)
				{
					$tid=$row_arr_home3['tid'];
					
					$lotno=""; $flg=0;
					$sql_dtchk=mysqli_query($link,"select lotno from tbl_gotqc where arrtrflag=1 order by arrival_id asc") or die(mysqli_error($link));
					$tot_dtchk=mysqli_num_rows($sql_dtchk);
					while($row_dtchk=mysqli_fetch_array($sql_dtchk))
					{
						$lid=explode(",",$row_dtchk['lotno']);
						foreach($lid as $fid)
						{
							if($fid <> "")
							{
								if($fid==$tid)
								{	
									/*$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$tid."' ") or die(mysqli_error($link));
									$tot_max=mysqli_num_rows($sql_max);
									$rowarrhome=mysqli_fetch_array($sql_max);*/
									$lotno=$row_arr_home3['oldlot'];
									$flg++;
									echo $lotno."  -  ".$flg."<br />";
								}
							}	
						}
					}
					//if($flg>0)
				}
			}
		}
	}
?>