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
/*if(isset($_GET['b']))
{
	$b = $_GET['b'];	 
}*/

	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysqli_query($link,"select * from tbl_partymaser where p_id='$a'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

?><div align="justify" class="smalltbltext" style="padding:2px 5px 5px 5px"><?php echo $row_month['address'];?><?php if($row_month['city']!="") { echo ", ".$row_month['city']; }?>, <?php echo $row_month['state'];?></div>
