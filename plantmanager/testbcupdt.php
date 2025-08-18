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
$cnt=0;
/*$sql_arr_home5=mysqli_query($link,"select mpmain_barcode from tbl_mpmain where mpmain_date<='2019-02-28' AND mpmain_barcode LIKE 'TP%' order by mpmain_barcode asc") or die(mysqli_error($link));
$tot_arr_home5=mysqli_num_rows($sql_arr_home5);
while($row_arr_home5=mysqli_fetch_array($sql_arr_home5))
{
echo $sql="update tbl_mpmain set mpmain_barcode=REPLACE(mpmain_barcode,SUBSTRING(mpmain_barcode,0,2),'TZ') where mpmain_barcode='".$row_arr_home5['mpmain_barcode']."'"."<br/>";
}
exit;*/

$sql_arr_home=mysqli_query($link,"select distinct mpmain_barcode, mpmain_trid from tbl_mpmain where mpmain_date<='2019-02-28' AND mpmain_barcode LIKE 'TP%' and plantcode='$plantcode' order by mpmain_barcode asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql="update tbl_mpmain set mpmain_barcode=REPLACE(mpmain_barcode,SUBSTRING(mpmain_barcode,1,2),'TZ') where mpmain_barcode='".$row_arr_home25['mpmain_barcode']."' AND mpmain_date<='2019-02-28' AND mpmain_trid='".$row_arr_home25['mpmain_trid']."'";
		$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
		
		$sql2="update tbl_barcodes set bar_barcode=REPLACE(bar_barcode,SUBSTRING(bar_barcode,1,2),'TZ') where bar_barcode='".$row_arr_home25['mpmain_barcode']."' AND bar_trid='".$row_arr_home25['mpmain_trid']."'  ";
		$xc2=mysqli_query($link,$sql2) or die(mysqli_error($link));
	}
}
//echo $sbid;
 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>