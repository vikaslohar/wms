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
if(isset($_GET['c']))
	{
 $c = $_GET['c'];	 
	}	
if($c==53)	
{	
	$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$c."' and varietyid!='$a' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
}
else if($a==3)	
{
	$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where (pvverid='".$b."' OR varietyid=13) and varietyid!='$a' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
}
else if($a==13)	
{
	$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where (pvverid='".$b."' OR varietyid=3) and varietyid!='$a' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
}
else
{
	$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where pvverid='".$b."' and varietyid!='$a' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
}
?>&nbsp;<select class="tbltext" name="txttoitem" id="toitm" style="width:170px;">
<option value="" selected>-Select PV/CV Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;