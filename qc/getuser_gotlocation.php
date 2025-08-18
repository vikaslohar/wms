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
//echo "select loc_id, loc_name from tbl_gotlocation where state='".$a."' order by loc_name Asc";
$sql_month=mysqli_query($link,"select loc_id, loc_name from tbl_gotlocation where state='".$a."' and actstatus='Active' order by loc_name Asc")or die(mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?>&nbsp;<select class="tbltext" name="txtlocation" id="itmloc" style="width:100px;" >
<option value="" selected>Select</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['loc_id'];?>" />   
		<?php echo $noticia_item['loc_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;

