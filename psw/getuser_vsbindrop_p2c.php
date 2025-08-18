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
	$c="Empty";
if($b!="")
	{
		if($b=="txtslsubbg1")
		{
		$d="Good";
		$id="sb1";
		}
		if($b=="txtslsubbg2")
		{
		$d="Good";
		$id="sb2";
		}
		if($b=="txtslsubbg3")
		{
		$d="Good";
		$id="sb3";
		}
		if($b=="txtslsubbg4")
		{
		$d="Good";
		$id="sb4";
		}
		if($b=="txtslsubbg5")
		{
		$d="Good";
		$id="sb5";
		}
		if($b=="txtslsubbg6")
		{
		$d="Good";
		$id="sb6";
		}
		if($b=="txtslsubbg7")
		{
		$d="Good";
		$id="sb7";
		}
		if($b=="txtslsubbg8")
		{
		$d="Good";
		$id="sb8";
		}
		if($b=="txtslsubbd1")
		{
		$d="Damage";
		$id="sb4";
		}
		if($b=="txtslsubbd2")
		{
		$d="Damage";
		$id="sb5";
		}
		
	}
	
$sql_month=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$a."' order by sid")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?>
&nbsp;<select class="tbltext" id="<?php echo $id;?>" name="<?php echo $b;?>" style="width:80px;" <?php if($b=="txtslsubbg1"){ ?>onchange="subbin(this.value,'1');"<?php }if($b=="txtslsubbg2"){ ?>onchange="subbin(this.value,'2');"<?php } ?>  >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;