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
?>
<?php if($a=="Deorjhal"){?>
<input name="txtwhto" id="whitem" type="text" class="tbltext" value="WH-RO" style="background-color:#CCCCCC" readonly="true"  />
<?php }else{?>
<input name="txtwhto" id="whitem" type="text" class="tbltext" value="Deorjhal" style="background-color:#CCCCCC" readonly="true"  />
<?php }?>&nbsp;<font color="#FF0000">*</font>&nbsp;

