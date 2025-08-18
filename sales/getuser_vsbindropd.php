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
		if($b=="txtslsubbd1")
		{
		$d="Damage";
		$id="sbd1";
		}
		if($b=="txtslsubbd2")
		{
		$d="Damage";
		$id="sbd2";
		}
		
	}
	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $b;
$sql_monthdd=mysqli_query($link,"select sid, sname from tbldsubbin where plantcode='$plantcode' AND binid='".$a."' order by sid")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?>
&nbsp;<select class="tbltext" id="<?php echo $id;?>" name="<?php echo $b;?>" style="width:80px;" <?php if($b=="txtslsubbd1"){ ?>onchange="subbind1(this.value);"<?php }if($b=="txtslsubbd2"){ ?>onchange="subbind2(this.value);"<?php } ?>  >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbind1 = mysqli_fetch_array($sql_monthdd)) { ?>
		<option value="<?php echo $noticia_subbind1['sid'];?>" />   
		<?php echo $noticia_subbind1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;