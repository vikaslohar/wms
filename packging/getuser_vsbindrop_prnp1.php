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
	//$c="Empty";
	//echo $b;

	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $b;
$sql_month=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and  binid='".$a."' order by sname")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?><select class="smalltbltext" id="<?php echo $b;?>" name="<?php echo $b;?>" style="width:60px;" onchange="subbin(this.value,<?php echo $c?>);" >
<option value="" selected>Subbin</option>
	<?php while($noticia_subbing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;