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
	else
	{ 
	$b="";
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}	
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}		
	
	if($b!="")
	{
		if($b=="txtbing1")
		{
		$d="sbing1";
		$id="txtbing1";
		$nid="b1";
		}
		if($b=="txtbing2")
		{
		$d="sbing2";
		$id="txtbing2";
		$nid="b2";
		}
		if($b=="txtbing3")
		{
		$d="sbing3";
		$id="txtbing3";
		$nid="b3";
		}
		if($b=="txtbing4")
		{
		$d="sbind1";
		$id="txtbing4";
		$nid="b4";
		}
		if($b=="txtbing5")
		{
		$d="sbind2";
		$id="txtbing5";
		$nid="b5";
		}
		if($b=="txtbing6")
		{
		$d="sbind3";
		$id="txtbing6";
		$nid="b5";
		}
		if($b=="txtbing7")
		{
		$d="sbind3";
		$id="txtbing7";
		$nid="b5";
		}
		if($b=="txtbing8")
		{
		$d="sbind3";
		$id="txtbing8";
		$nid="b5";
		}
	}

$flag=0; 

if($f!="")
$sql_month=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and  whid='".$a."' and binid IN ($f) order by binname")or die("Error:".mysqli_error($link));
else
$sql_month=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and  whid='".$a."' order by binname")or die("Error:".mysqli_error($link));
?><select class="smalltbltext" id="<?php echo $id;?>" name="<?php echo $id;?>" style="width:60px;" onchange="bin(this.value,<?php echo $c?>);"   >
<option value="" selected>Bin</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>