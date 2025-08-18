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
	if($a=="C" || $a=="C&F" || $a=="CandF")
	{
		$z="C&F";
	}

if($a!="Export Buyer")
{
	if($a=="C" || $a=="C&F" || $a=="CandF")
	{
		$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$b."' and classification='".$z."' order by business_name")or die(mysqli_error($link));
	}
	else
	{
		$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$b."' and classification='".$a."' order by business_name")or die(mysqli_error($link));
	}
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$b."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where  country='".$c."' and classification='".$a."' order by business_name")or die(mysqli_error($link));
}?>&nbsp;<select class="tbltext" id="itm1" name="txtstfp" style="width:220px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');" >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;

