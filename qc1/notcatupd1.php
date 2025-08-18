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
	
$sql_arr_home=mysqli_query($link,"select agriimpss_qrcode, agriimpss_company from tbl_agriimportsub_sub where agriimpmain_id>2 order by agriimpss_qrcode asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$qcode=$row_arr_home25['agriimpss_qrcode'];
		$comp=$row_arr_home25['agriimpss_company'];
		
		$catcode2=mysqli_query($link,"select * from tbl_agriimportsub2 where qrcodenorth='$qcode' OR qrcodesouth='$qcode' OR qrcodeeast='$qcode' OR qrcodewest='$qcode' OR qrcodenorth2='$qcode' OR qrcodesouth2='$qcode' OR qrcodeeast2='$qcode' OR qrcodewest2='$qcode'  OR qrcodenorth3='$qcode' OR qrcodesouth3='$qcode' OR qrcodeeast3='$qcode' OR qrcodewest3='$qcode' OR qrcodenorth4='$qcode' OR qrcodesouth4='$qcode' OR qrcodeeast4='$qcode' OR qrcodewest4='$qcode' ") or die(mysqli_error($link));
		$arr_catcode2=mysqli_fetch_array($catcode2);
			
echo	$sql="UPDATE tbl_agriimportsub2 SET 
    `companynorth` = CASE WHEN `qrcodenorth` = '$qcode' THEN '$comp' ELSE `companynorth` END, 
    `companynorth2` = CASE WHEN `qrcodenorth2` = '$qcode' THEN '$comp' ELSE `companynorth2` END, 
    `companynorth3` = CASE WHEN `qrcodenorth3` = '$qcode' THEN '$comp' ELSE `companynorth3` END, 
    `companynorth4` = CASE WHEN `qrcodenorth4` = '$qcode' THEN '$comp' ELSE `companynorth4` END, 
    `companysouth` = CASE WHEN `qrcodesouth` = '$qcode' THEN '$comp' ELSE `companysouth` END, 
    `companysouth2` = CASE WHEN `qrcodesouth2` = '$qcode' THEN '$comp' ELSE `companysouth2` END, 
    `companysouth3` = CASE WHEN `qrcodesouth3` = '$qcode' THEN '$comp' ELSE `companysouth3` END, 
    `companysouth4` = CASE WHEN `qrcodesouth4` = '$qcode' THEN '$comp' ELSE `companysouth4` END, 
    `companyeast` = CASE WHEN `qrcodeeast` = '$qcode' THEN '$comp' ELSE `companyeast` END, 
    `companyeast2` = CASE WHEN `qrcodeeast2` = '$qcode' THEN '$comp' ELSE `companyeast2` END, 
    `companyeast3` = CASE WHEN `qrcodeeast3` = '$qcode' THEN '$comp' ELSE `companyeast3` END, 
    `companyeast4` = CASE WHEN `qrcodeeast4` = '$qcode' THEN '$comp' ELSE `companyeast4` END, 
    `companywest` = CASE WHEN `qrcodewest` = '$qcode' THEN '$comp' ELSE `companywest` END, 
    `companywest2` = CASE WHEN `qrcodewest2` = '$qcode' THEN '$comp' ELSE `companywest2` END, 
    `companywest3` = CASE WHEN `qrcodewest3` = '$qcode' THEN '$comp' ELSE `companywest3` END, 
    `companywest4` = CASE WHEN `qrcodewest4` = '$qcode' THEN '$comp' ELSE `companywest4` END";		
		$xc=mysqli_query($link,$sql) or die(mysqli_error($link));	
		$t++;
		echo "<br />";
	}
}
echo $t; exit;
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>