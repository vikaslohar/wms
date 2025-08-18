<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	}require_once("../../include/config.php");
	require_once("../../include/connection.php");

if(isset($_GET['a']))
	{
 $a = $_GET['a'];	 
	}
$sql_qc=mysqli_query($link,"SELECT * FROM tblcrop WHERE cropid='".$a."'");
$tt=mysqli_fetch_array($sql_qc);

$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$a."' order by popularname Asc")or die(mysqli_error($link));
?><table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="219" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="425" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" onchange="varchk(this.value);">
<option value="" selected>--Select--</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['popularname'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="cropname" value="<?php echo $tt['cropname'];?>" />
<input type="hidden" name="varietyname" value="" />
</table>
