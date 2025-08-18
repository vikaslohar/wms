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


$sql_month2=mysqli_query($link,"select distinct (packtype) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$b."' and lotldg_variety='".$a."' order by packtype Asc")or die(mysqli_error($link));
?>&nbsp;<select class="tbltext" name="txtups" id="itm" style="width:100px;" onchange="upschk(this.value);" >
<option value="" selected>--Select--</option>
	<?php while($noticia_item2 = mysqli_fetch_array($sql_month2)) { ?>
		<option value="<?php echo $noticia_item2['packtype'];?>" />   
		<?php echo $noticia_item2['packtype'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;

