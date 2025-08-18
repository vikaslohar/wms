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

//echo $a;
$val=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   orlot='".$a."' and lotldg_sstage='Condition'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);

$sql_month1=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   orlot='".$a."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($row_month > 0)
{
	$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where plantcode='".$plantcode."' and orlot='".$row_month['orlot']."' and lotldg_sstage='Condition'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   orlot='".$row_month['orlot']."' and lotldg_sstage='Condition' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
			
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$rowmonth2[0]."' and lotldg_sstage='Condition' and lotldg_balqty > 0")or die("Error:".mysqli_error($link));
		$rowmonth3=mysqli_num_rows($sqlmonth3);
		if($rowmonth3>0)
		$val++;
	}
}
//echo $val;
//if($row_month > 0 || $row_month1 > 0)$val++;
?><input type="hidden" name="lotcheck1" value="<?php echo $val;?>" />