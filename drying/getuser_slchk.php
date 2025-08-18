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
$flag=0;	
$sql_tt=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_lotno='".$a."'")or die("Error:".mysqli_error($link));
$tot=mysqli_num_rows($sql_tt);
$sql_issue1=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   lotno='".$a."'") or die(mysqli_error($link));
$tot1=mysqli_num_rows($sql_issue1);

if($tot > 0 || $tot1 > 0)
{$flag=1;} else {$flag=0;}
?><input name="slck1" type="hidden" value="<?php echo $flag;?>" />