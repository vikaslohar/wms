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
	if($a=="Raw")
	{ $cd="R";}
	else if($a=="Condition")
	{ $cd="C";}
	else
	{ $cd="R";}
	if(date("Y")==$year1)$yer2=$year1;
	if(date("Y")==$year2)$yer2=$year2;
	$sql_lgenyr=mysqli_query($link,"select * from tbl_lgenyear where lgenyear='".$yer2."'") or die(mysqli_error($link));
	$row_lgenyr=mysqli_fetch_array($sql_lgenyr);
	$yer=$row_lgenyr['lgenyearcode'];
	if($yer=="")$yer=$yearid_id;
	
	$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters");
	$row_cls=mysqli_fetch_array($quer_cn);
	$tp1=$row_cls['code'];
	
	$sql_lotm=mysqli_query($link,"SELECT MAX(lotmgen_lot) FROM tbl_lotmgen  where lotmgen_yearcode='$yer'  ORDER BY lotmgen_yearcode DESC") or die(mysqli_error($link));
	$tot_lotm=mysqli_num_rows($sql_lotm);
	$tm_code=0;
	if($tot_lotm > 0)
	{
		$row_lotm=mysqli_fetch_array($sql_lotm);
		$tm_code=$row_lotm['0'];
		if($tm_code > 0 && $tm_code>=90207)
		$lot_code=$tm_code+1;
		else
		$lot_code=90208;
	}
	else
	{
		$lot_code=90208;
	}
	$lotnonew=$tp1.$yer.$lot_code."/00000/00".$cd;
	$lotnoornew=$tp1.$yer.$lot_code."/00000/00";
?>&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $lotnonew;?>" readonly="true" style="background-color:#CCCCCC" >&nbsp;<input type="hidden" name="orlot" value="<?php echo $lotnoornew;?>" />