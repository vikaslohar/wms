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
		if($b=="2")
		{
		$d="txtslsubbing2";
		$id="txtslsubbing2";
		}
		if($b=="4")
		{
		$d="txtslsubbing24";
		$id="txtslsubbing24";
		}
	}
$sql_month=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$a."' order by sname")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?>
&nbsp;<select class="tbltext" id="<?php echo $id;?>" name="<?php echo $d;?>" style="width:80px;" <?php if($b=="2"){ ?>onchange="subbin2(this.value);"<?php }if($b=="4"){ ?>onchange="subbin4(this.value);"<?php } ?>  >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;