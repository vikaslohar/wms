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

if(isset($_GET['a']))
	{
	 $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
	$g = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
	 $h = $_GET['h'];	 
	}
	if(isset($_GET['l']))
	{
	 $l = $_GET['l'];	 
	}
	if(isset($_GET['p']))
	{
	 $p = $_GET['p'];	 
	}

$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$b' order by code asc");
$to=mysqli_num_rows($quer6);
//echo "select * from tbl_lot_ldg where orlot='".$a."' and lotldg_variety='".$p."' ";
$val=0;
if($p!='')
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$a."' and lotldg_variety='".$p."' ")or die("Error:".mysqli_error($link));
else
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$a."'")or die("Error:".mysqli_error($link));
$row_th=mysqli_num_rows($sql_month);
if($p!='')
$sql_month1=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$a."' and lotldg_variety='".$p."' ")or die("Error:".mysqli_error($link));
else
$sql_month1=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$a."'")or die("Error:".mysqli_error($link));
$row_th1=mysqli_num_rows($sql_month1);

$lotupschk="";
if($row_th1 > 0)
{
	$sql_mth1=mysqli_query($link,"select distinct(packtype) from tbl_lot_ldg_pack where  orlot='".$a."'")or die("Error:".mysqli_error($link));
	while($row_pack=mysqli_fetch_array($sql_mth1))
	{
		if($lotupschk!="")
		$lotupschk=$lotupschk.",".$row_pack['packtype'];
		else
		$lotupschk=$row_pack['packtype'];
	}
}
if($row_th>0 || $row_th1>0)$val++;
if($to==0 && $val==0)$val=1;
?><input type="hidden" name="lotchecko" value="<?php echo $val;?>" /><input type="hidden" name="lotupschko" value="<?php echo $lotupschk;?>" />
