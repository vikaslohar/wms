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
	 $tid = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	 $vrids = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	 $upids = trim($_GET['g']);	 
}
if(isset($_GET['l']))
{
	 $itmno = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	 $eupstpy = $_GET['m'];	 
}
//exit;
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$vrids' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];

$verids=$vrids;
$upsids=$upids;
$flg=0;

$quer1=mysqli_query($link,"SELECT * FROM tbl_stoutsspack where plantcode = '$plantcode' and stoutmp_id='$b' and stoutssp_barcode='".$a."'"); 
$total=mysqli_num_rows($quer1);
$row_dept1=mysqli_fetch_array($quer1);
if($total>0)$flg=1;

?>
<input type="hidden" name="brflg" value="<?php echo $flg;?>" /><input type="hidden" name="brchflg" value="1" /><input type="hidden" name="totbarcs" value="<?php echo $barc;?>" /><input type="hidden" name="maintrid" value="<?php echo $b;?>" /><input type="hidden" name="subtrid" value="<?php echo $c;?>" />