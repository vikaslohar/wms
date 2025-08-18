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
	$c = $_GET['c'];	 
}
if(isset($_GET['f']))
{
	$f = $_GET['f'];	 
}

$id="w".$b;
$wtpd="";

//$path="file:///e:/Packing/$a.txt";
$path="file:///d:/Packing/$a.txt";
if(file_exists($path)){
if($myfile=fopen($path, "r+"))
{
	// or die("File does not exist or Unable to open file!"); 
	$wtpd=trim(fgets($myfile)); 
	fclose($myfile);
}
else
{
	$wtpd="";
}
}else{$wtpd="";}
if($wtpd<=$c && $wtpd>=$f)$wtpd='';
$sql__barc=mysqli_query($link,"SELECT pnpslipbar_grosswt FROM tbl_pnpslipbarcode where plantcode='$plantcode' order by pnpslipbar_id desc" ) or die("Error: " . mysqli_error($link));
$to__barc=mysqli_num_rows($sql__barc);
$row__barc=mysqli_fetch_array($sql__barc);
$lastbarcodewt=$row__barc['pnpslipbar_grosswt'];
//echo $wtpd;
//unlink('file:///e:Packing/WT.txt');
?>&nbsp;<input name="weight" id="<?php echo $id?>" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" onchange="chkwtws(this.value, '1');" readonly="true" style="background-color:#CCCCCC" value="<?php echo $wtpd?>"  /><span id="wtwsdelete<?php echo $b;?>" style="display:none"></span>