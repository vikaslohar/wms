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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$b = $_GET['b'];	 
}


$sql_month=mysqli_query($link,"select distinct salesrs_ups from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$b."' and salesrs_variety='".$a."' and salesrs_rettype='P2P' and salesrs_rvflg=0 order by salesrs_ups")or die(mysqli_error($link));
/*$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);*/

?>&nbsp;<select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
	<?php  while($row_var=mysqli_fetch_array($sql_month)) {	?>
		<option value="<?php echo $row_var['salesrs_ups'];?>" />   
		<?php echo $row_var['salesrs_ups'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;