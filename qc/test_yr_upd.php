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
 	
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";
 ?>