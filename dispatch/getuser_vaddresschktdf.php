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
//echo $a;

if($b=="selectp")
{
	$sql_month=mysqli_query($link,"select * from tbl_partymaser where p_id='$a'")or die("Error:".mysqli_error($link));
	$row_month=mysqli_fetch_array($sql_month);
	
	$address=$row_month['address'];
	$city=$row_month['city']; 
	$state=$row_month['state'];
	$pincode=$row_month['pin'];
}
else
{
	$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$a."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
	$tt=mysqli_num_rows($sql_month2);
	$row_month2=mysqli_fetch_array($sql_month2);
	
	$address=$row_month2['orderm_partyaddress'];
	$city=$row_month2['orderm_partycity']; 
	$state=$row_month2['orderm_partystate'];
	$pincode=$row_month2['orderm_partypin'];
}

?><div align="justify" class="smalltbltext" style="padding:2px 5px 5px 5px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div>