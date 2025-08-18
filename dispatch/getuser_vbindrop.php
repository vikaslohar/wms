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
	$a = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$b = $_GET['b'];	 
}
else
{ 
	$b="";
}
if(isset($_GET['c']))
{
	$c = $_GET['c'];	 
}	
//$d="";
	
	if($b!="")
	{
		if($b=="bingn1")
		{
			$d="txtbing1";
			$id="txtbing1";
			$nid="txtbing1";
		}
		else if($b=="bingn2")
		{
			$d="txtbing2";
			$id="txtbing2";
			$nid="txtbing2";
		}
		else if($b=="bingn3")
		{
			$d="txtbing3";
			$id="txtbing3";
			$nid="txtbing3";
		}
		else if($b=="bingn4")
		{
			$d="txtbing4";
			$id="txtbing4";
			$nid="txtbing4";
		}
		else if($b=="bingn5")
		{
			$d="txtbing5";
			$id="txtbing5";
			$nid="txtbing5";
		}
		else
		{
			$d="txtbing1";
			$id="txtbing1";
			$nid="txtbing1";
		}
	}
	else
	{
		$d="txtbing1";
		$id="txtbing1";
		$nid="txtbing1";
	}


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' and  whid='".$a."' order by binname")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);
?><select class="smalltbltext" id="<?php echo $nid;?>" name="<?php echo $id;?>" style="width:60px;" <?php if($b=="bingn1"){?>onchange="bin(this.value,<?php echo $c?>);"<?php }if($b=="bingn2"){?>onchange="bin(this.value,<?php echo $c?>);"<?php }if($b=="bingn3"){?>onchange="bin(this.value,<?php echo $c?>);"<?php }if($b=="bingn4"){?>onchange="bin(this.value,<?php echo $c?>);"<?php }if($b=="bingn5"){?>onchange="bin(this.value,<?php echo $c?>);"<?php } ?>   >
<option value="" selected>Bin</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;