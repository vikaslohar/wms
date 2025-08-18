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

$flag=0; 
$add="";$tott=0;
if($b=="TDF")
$sql_month=mysqli_query($link,"select * from tbl_partymaser where business_name='$a'")or die("Error:".mysqli_error($link));
else
$sql_month=mysqli_query($link,"select * from tbl_partymaser where p_id='$a'")or die("Error:".mysqli_error($link));
$tott=mysqli_num_rows($sql_month);
if($tott > 0)
{
$row_month=mysqli_fetch_array($sql_month);
$add=$row_month['address']; if($row_month['city']!="") { $add=$add.", ".$row_month['city']; } $add=$add.", ".$row_month['state'];
}
else
{
$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$a' and orderm_dispatchflag!=1 order by orderm_party")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$add=$row_month['orderm_partyaddress']; if($row_month['orderm_partycity']!="") { $add=$add.", ".$row_month['orderm_partycity']; } $add=$add.", ".$row_month['orderm_partystate'];
}
?><td align="left"  valign="middle" class="tbltext" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $add;?></div></td>
