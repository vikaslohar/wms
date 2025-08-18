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
	
	if($b!="")
	{
		if($b=="1")
		{
		$id="txtslbing";
		$nid="txtslbing";
		}
		if($b=="2")
		{
		$id="txtslbing2";
		$nid="txtslbing2";
		}
		if($b=="3")
		{
		$id="txtslbing222";
		$nid="txtslbing222";
		}
		if($b=="4")
		{
		$id="txtslbing24";
		$nid="txtslbing24";
		}
	}
$sql_month=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and whid='".$a."' order by binname")or die("Error:".mysqli_error($link));
?>
&nbsp;<select class="tbltext" id="<?php echo $nid;?>" name="<?php echo $id;?>" style="width:80px;" <?php if($b=="1"){?>onchange="bin1(this.value);"<?php }if($b=="2"){?>onchange="bin2(this.value);"<?php }if($b=="3"){?>onchange="bin3(this.value);"<?php }if($b=="4"){?>onchange="bin4(this.value);"<?php } ?>   >
<option value="ALL" selected>--ALL--</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;