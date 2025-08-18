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
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
{
	$b = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$a = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$state = $_GET['c'];	 
}
else
{
	$state = "ALL";	 
}
//echo $state;
	if($a=="C" || $a=="C&F" || $a=="CandF")
	{
		$a="C&F";
	}

if($a!="ALL")
{
	if($a!="Export Buyer")
	{
		if($b!="ALL")
		{
			if($state!="ALL")
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$b."' and classification='".$a."' and state='".$state."' order by business_name")or die(mysqli_error($link));
			else
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$b."' and classification='".$a."' order by business_name")or die(mysqli_error($link));
		}
		else
		{
			if($state!="ALL")
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='".$a."' and state='".$state."' order by business_name")or die(mysqli_error($link));
			else
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='".$a."' order by business_name")or die(mysqli_error($link));
		}
	}
	else
	{
		if($b!="ALL")
		{
			$sql_month123=mysqli_query($link,"select * from tblcountry where country='".$b."'")or die(mysqli_error($link));
			$noticia123 = mysqli_fetch_array($sql_month123);
			$c=$noticia123['c_id'];
			$sql_month=mysqli_query($link,"select * from tbl_partymaser where country='".$c."' and classification='".$a."' order by business_name")or die(mysqli_error($link));
		}
		else
		{
			$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='".$a."' order by business_name")or die(mysqli_error($link));
		}
	}
}
else
{
	if($a!="Export Buyer")
	{
		if($b!="ALL")
		{
			if($state!="ALL")
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$b."' and state='".$state."' order by business_name")or die(mysqli_error($link));
			else
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$b."' order by business_name")or die(mysqli_error($link));
		}
		else
		{
			if($state!="ALL")
				$sql_month=mysqli_query($link,"select * from tbl_partymaser where state='".$state."' order by business_name")or die(mysqli_error($link));
			else
				$sql_month=mysqli_query($link,"select * from tbl_partymaser order by business_name")or die(mysqli_error($link));
		}
	}
	else
	{
		if($b!="ALL")
		{
			$sql_month123=mysqli_query($link,"select * from tblcountry where country='".$b."'")or die(mysqli_error($link));
			$noticia123 = mysqli_fetch_array($sql_month123);
			$c=$noticia123['c_id'];
			$sql_month=mysqli_query($link,"select * from tbl_partymaser where country='".$c."' order by business_name")or die(mysqli_error($link));
		}
		else
		{
			$sql_month=mysqli_query($link,"select * from tbl_partymaser order by business_name")or die(mysqli_error($link));
		}
	}
}

?>&nbsp;<select class="smalltbltext" id="party" name="txtparty" style="width:170px;" >
<option value="ALL" selected="selected">--ALL--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;