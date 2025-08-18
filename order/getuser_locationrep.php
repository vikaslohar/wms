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

$sql_month=mysqli_query($link,"select * from tblproductionlocation where state='".$a."' order by productionlocation")or die(mysqli_error($link));
?>&nbsp;<select class="tbltext" id="locsl" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value);" >
<option value="ALL" selected="selected">ALL</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['productionlocationid'];?>" />   
		<?php echo $noticia['productionlocation'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;