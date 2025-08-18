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
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}*/


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$tt=0;
$sql_qc=mysqli_query($link,"SELECT distinct(variety) FROM tbl_qctest WHERE plantcode='$plantcode' AND crop='".$a."' and variety NOT RLIKE '^[-+0-9.E]+$'");
$tt=mysqli_num_rows($sql_qc);

$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$a."' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?>&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" >
<option value="ALL" selected>ALL</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
	<?php while($noticia_item1 = mysqli_fetch_array($sql_qc)) { ?>
		<option value="<?php echo $noticia_item1['variety'];?>" />   
		<?php echo $noticia_item1['variety'];?>
		<?php } ?>
		
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;

