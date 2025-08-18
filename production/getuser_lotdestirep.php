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
$x="";
//echo "select Distinct ploc from tblarrival_sub where lotstate='".$a."' and ploc!='$x' order by ploc Asc";
$sql_month=mysqli_query($link,"select Distinct ploc from tblarrival_sub where lotstate='".$a."' and ploc!='$x' and plantcode='$plantcode' order by ploc Asc")or die(mysqli_error($link));
?>&nbsp;<select class="tbltext" name="txtclass" id="txtclass" style="width:170px;" onchange="showorganiser(this.value);" >
<option value="ALL" selected>--ALL--</option>
<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
<option value="<?php echo $noticia_item['ploc'];?>" />   
<?php echo $noticia_item['ploc'];?>
<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;

