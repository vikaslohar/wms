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


$sql_month=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='".$b."' and lotldg_variety='".$a."'  order by packtype")or die(mysqli_error($link));
/*$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);*/

?>&nbsp;<select class="smalltbltext" name="txtups" id="txtups" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>Select</option>
	<?php  while($row_var=mysqli_fetch_array($sql_month)) {	?>
		<option value="<?php echo $row_var['packtype'];?>" />   
		<?php echo $row_var['packtype'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;