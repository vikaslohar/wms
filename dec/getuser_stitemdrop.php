<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
//echo $b;
//echo $c;
$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$a."' and actstatus='Active' and vertype='PV' order by popularname Asc")or die(mysqli_error($link));

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$a."'") or die(mysqli_error($link));
$tot_crop=mysqli_num_rows($sql_crop);
$row_crop=mysqli_fetch_array($sql_crop);
	//echo $row_crop['cropname'];				
$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where spcodef='".$b."' and spcodem='".$c."' and lotcrop!='".$row_crop['cropname']."' ") or die(mysqli_error($link));
$tot_arr_sub=mysqli_num_rows($sql_arr_sub);
$row_tbl_sub=mysqli_fetch_array($sql_arr_sub);
if($tot_arr_sub == 0)
{
?>&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;
<?php
}
else
{
?>
<div style="padding:5px;0px;0px;0px" class="smalltblheading">Crop: <font color="#FF0000"><?php echo $row_tbl_sub['lotcrop'];?></font> with above SP Codes are already Present.</div><input type="hidden" name="txtvariety" value="" />
<?php
}
?>