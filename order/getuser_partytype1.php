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
if($a=="Order Sales")
{
$sql_month=mysqli_query($link,"select Distinct classification ,p_id from tbl_partymaser where classification='Dealer' or classification='Bulk'  order by business_name")or die(mysqli_error($link));
}
else if($a=="Order Stock")
{
$sql_month=mysqli_query($link,"select Distinct classification ,p_id from tbl_partymaser where classification='C&F' order by business_name")or die(mysqli_error($link));
}
else if($a=="TDF - Individual")
{
$sql_month=mysqli_query($link,"select Distinct classification ,p_id from tbl_partymaser where classification='TDF - Individual' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='".$a."' order by business_name")or die(mysqli_error($link));
}
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>