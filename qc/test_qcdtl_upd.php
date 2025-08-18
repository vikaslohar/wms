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
	
	
	$sql1="DELETE FROM `tbl_qctest` WHERE oldlot='' and lotno=''";
	$zz1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	
	
	// Stage Updation
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where (trstage='' or trstage IS NULL) order by tid asc") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	if($tot_arr_home >0) 
	{
		$sq="update tbl_qctest set trstage='Raw' WHERE SUBSTRING(lotno,17,1)='R' and (trstage='' or trstage IS NULL)";
		$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
		$sq1="update tbl_qctest set trstage='Condition' WHERE SUBSTRING(lotno,17,1)='C' and (trstage='' or trstage IS NULL)";
		$xc1=mysqli_query($link,$sq1) or die(mysqli_error($link));
		$sq2="update tbl_qctest set trstage='Pack' WHERE SUBSTRING(lotno,17,1)='P' and (trstage='' or trstage IS NULL)";
		$xc2=mysqli_query($link,$sq2) or die(mysqli_error($link));
	}
	// Lotno Updation
	$sql_arr_home2=mysqli_query($link,"select * from tbl_qctest where oldlot !='' and (lotno='' or lotno IS NULL) order by tid asc") or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
	if($tot_arr_home2 >0) 
	{
		while($row_arr_home=mysqli_fetch_array($sql_arr_home2))
		{
			$tid=$row_arr_home['tid'];
			$oltno=$row_arr_home['oldlot'];
			$sstage=$row_arr_home['trstage'];
			if($sstage=='Raw') {$ltno=$oltno."R";}
			else if($sstage=='Condition') {$ltno=$oltno."C";}
			else if($sstage=='Pack') {$ltno=$oltno."P";}
			else {$ltno=$oltno."R";}
			
			$sq="update tbl_qctest set lotno='$ltno' WHERE tid='$tid'";
			$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
		}
	}
	// Crop and Variety Updation
	$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where lotno!='' and (variety='' or variety IS NULL or crop='' or crop IS NULL) order by tid asc") or die(mysqli_error($link));
	$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
	if($tot_arr_home3 >0) 
	{
		while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
		{
			$tid=$row_arr_home3['tid'];
			$oltno=$row_arr_home3['oldlot'];
			$lotno=$row_arr_home3['lotno'];
			$sstage=$row_arr_home3['trstage'];
			if($sstage=='Raw') {$ltno=$oltno."R";}
			else if($sstage=='Condition') {$ltno=$oltno."C";}
			else if($sstage=='Pack') {$ltno=$oltno."P";}
			else {$ltno=$oltno."R";}
			
			$crp='';$ver='';
			if($sstage!='Pack')
			{
				$sqlarrhome=mysqli_query($link,"select * from tbl_lot_ldg where orlot='$oltno' order by lotldg_id asc") or die(mysqli_error($link));
				$totarrhome=mysqli_num_rows($sqlarrhome);
				if($totarrhome>0) 
				{
					$rowarrhome=mysqli_fetch_array($sqlarrhome);
					$crp=$rowarrhome['lotldg_crop'];
					$ver=$rowarrhome['lotldg_variety'];
				}
			}
			else
			{
				$sqlarrhome=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='$oltno' order by lotdgp_id asc") or die(mysqli_error($link));
				$totarrhome=mysqli_num_rows($sqlarrhome);
				if($totarrhome>0) 
				{
					$rowarrhome=mysqli_fetch_array($sqlarrhome);
					$crp=$rowarrhome['lotldg_crop'];
					$ver=$rowarrhome['lotldg_variety'];
				}
			}
			
			$sq="update tbl_qctest set crop='$crp', variety='$ver' WHERE tid='$tid'";
			$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
		}
	}
	
	// srdate Updation
	$sql_arr_home4=mysqli_query($link,"select * from tbl_qctest where srdate='0000-00-00' and (spdate!='0000-00-00' OR spdate IS NOT NULL) order by tid asc") or die(mysqli_error($link));
	$tot_arr_home4=mysqli_num_rows($sql_arr_home4);
	if($tot_arr_home4 >0) 
	{
		while($row_arr_home4=mysqli_fetch_array($sql_arr_home4))
		{
			$tid=$row_arr_home4['tid'];
			$spdate=$row_arr_home4['spdate'];
	
			$sq="update tbl_qctest set srdate='$spdate' WHERE tid='$tid'";
			$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
		}
	}
	// Yearcode Updation
	$sql_arr_home5=mysqli_query($link,"select * from tbl_qctest where yearid='' order by tid asc") or die(mysqli_error($link));
	$tot_arr_home5=mysqli_num_rows($sql_arr_home5);
	if($tot_arr_home5 >0) 
	{
		$sql1="update tbl_qctest set yearid='D' WHERE yearid='' and srdate>='2010-01-01' and srdate<='2010-12-31'";
		$zz1=mysqli_query($link,$sql1) or die(mysqli_error($link));
		$sql2="update tbl_qctest set yearid='N' WHERE yearid='' and srdate>='2011-01-01' and srdate<='2011-12-31'";
		$zz2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$sql3="update tbl_qctest set yearid='S' WHERE yearid='' and srdate>='2012-01-01' and srdate<='2012-12-31'";
		$zz3=mysqli_query($link,$sql3) or die(mysqli_error($link));
		$sql4="update tbl_qctest set yearid='A' WHERE yearid='' and srdate>='2013-01-01' and srdate<='2013-12-31'";
		$zz4=mysqli_query($link,$sql4) or die(mysqli_error($link));
		$sql5="update tbl_qctest set yearid='F' WHERE yearid='' and srdate>='2014-01-01' and srdate<='2014-12-31'";
		$zz5=mysqli_query($link,$sql5) or die(mysqli_error($link));
		$sql6="update tbl_qctest set yearid='P' WHERE yearid='' and srdate>='2015-01-01' and srdate<='2015-12-31'";
		$zz6=mysqli_query($link,$sql6) or die(mysqli_error($link));
		$sql7="update tbl_qctest set yearid='V' WHERE yearid='' and srdate>='2016-01-01' and srdate<='2016-12-31'";
		$zz7=mysqli_query($link,$sql7) or die(mysqli_error($link));
		$sql7="update tbl_qctest set yearid='I' WHERE yearid='' and srdate>='2017-01-01' and srdate<='2017-12-31'";
		$zz7=mysqli_query($link,$sql7) or die(mysqli_error($link));
		$sql7="update tbl_qctest set yearid='B' WHERE yearid='' and srdate>='2018-01-01' and srdate<='2018-12-31'";
		$zz7=mysqli_query($link,$sql7) or die(mysqli_error($link));
		$sql7="update tbl_qctest set yearid='X' WHERE yearid='' and srdate>='2019-01-01' and srdate<='2019-12-31'";
		$zz7=mysqli_query($link,$sql7) or die(mysqli_error($link));
 	}
	
	// Sample no Updation
	$sql_arr_home6=mysqli_query($link,"select * from tbl_qctest where yearid!='' and (sampleno='' or sampleno='0' or sampleno IS NULL) order by tid asc") or die(mysqli_error($link));
	$tot_arr_home6=mysqli_num_rows($sql_arr_home6);
	if($tot_arr_home6 >0) 
	{
		while($row_arr_home6=mysqli_fetch_array($sql_arr_home6))
		{
			$tid=$row_arr_home6['tid'];
			$oltno=$row_arr_home6['oldlot'];
			$yearid=$row_arr_home6['yearid'];
			$sstage=$row_arr_home6['trstage'];
			
			$sqlarrhome=mysqli_query($link,"SELECT Max(sampleno) FROM `tbl_qctest` WHERE yearid='$yearid' order by `tid` DESC") or die(mysqli_error($link));
			$rowarrhome=mysqli_fetch_array($sqlarrhome);
			$t=0;
			$smp=$rowarrhome[0];
			if($smp==0)
			{		
				$smp=1;
			}
			else
			{
				$smp=$smp+1;
			}
			$t=$smp;
			
			$sql_tbl_sub="update tbl_qctest set sampleno='$t' WHERE tid='$tid'";
			$zz=mysqli_query($link,$sql_tbl_sub) or die(mysqli_error($link));
		}
	}
	
	
	
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";
 ?>