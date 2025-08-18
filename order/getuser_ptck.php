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
	}require_once("../include/config.php");
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
$newa=$a;	
$a=$a-1;
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$b."' and actstatus='Active'")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$wtnopkg=explode(",",$row_month['wtnopkg']);
$wtmp=explode(",",$row_month['wtmp']);
$toup=explode(",",$row_month['gm']);
$val=$toup[$a];
$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."'") or die(mysqli_error($link));
$row_var=mysqli_fetch_array($sql_var);
$upst=$row_var['uom'];

?><input type="text" name="stdptval_<?php echo $newa;?>" id="stdptval_<?php echo $newa;?>" value="<?php if($c=="WBox"){ echo $wtnopkg[$a];} else if($c=="MPack"){ echo $wtmp[$a]; } else { echo $upst; }?>" size="2" readonly="true" style="background-color:#F0F0F0" />
