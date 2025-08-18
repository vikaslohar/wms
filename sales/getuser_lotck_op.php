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
	$b = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
	$b = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
	$b = $_GET['g'];	 
	}
	
$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$b' order by code asc");
$to=mysqli_num_rows($quer6);

$val=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$a."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);

$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where salesrs_newlot='".$a."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($row_month > 0 || $row_month1 > 0)$val++;
if($to==0 && $val==0)$val=0;
?><input type="hidden" name="lotcheck1" value="<?php echo $val;?>" />
