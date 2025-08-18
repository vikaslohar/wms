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
$z=explode(" ", $a);
$x=$z[0];
$y=$z[1];
$tnompsinmp="";
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$b."' and actstatus='Active' order by varietyid Asc")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$parray=explode(",", $row_month['gm']);
$zarray=explode(",", $row_month['mptnop']);
$zarray2=explode(",", $row_month['wtmp']);
$ccont=count($parray);
for($i=0; $i<$ccont; $i++) 
{ 
	$sql_ups=mysqli_query($link,"Select * from tblups where uid='".$parray[$i]."' and ups='$x' and wt='$y'") or die(mysqli_error($link));
	if($tttt=mysqli_num_rows($sql_ups) > 0)
	{	
		$row12=mysqli_fetch_array($sql_ups);
		
		$tnompsinmp=$zarray[$i];
		$wtmp=$zarray2[$i];
		
		//$wtmp=$p1_array2[$srnonew];
	 	$mptnop=$zarray[$i];
		
		if($row12['wt']=="Gms")
		{ 
			$ptp=(1000/$row12['ups']);
			$ptp1=($row12['ups']/1000);
		}
		else
		{
			$ptp=$row12['ups'];
			$ptp1=$row12['ups'];
		}
		//echo $ptp."  =>  ".$ptp1."  = ".$wtmp;
		$mmmpt=$ptp*$wtmp;
		if($mptnop!=$mmmpt)$mptnop=$mmmpt;
		
//echo $mptnop;
	}
} 
?>&nbsp;<?php echo $mptnop;?> - <?php echo $wtmp;?>&nbsp;Kgs.