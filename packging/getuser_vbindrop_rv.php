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
	
	//$d="";
	
	if($b!="")
	{
		if($b=="bing1")
		{
		$d="sbing1";
		$id="txtslbing1";
		$nid="b1";
		}
		if($b=="bing2")
		{
		$d="sbing2";
		$id="txtslbing2";
		$nid="b2";
		}
		if($b=="bing3")
		{
		$d="sbing3";
		$id="txtslbing3";
		$nid="b3";
		}
		if($b=="bing4")
		{
		$d="sbing4";
		$id="txtslbing4";
		$nid="b4";
		}
		if($b=="bing5")
		{
		$d="sbing5";
		$id="txtslbing5";
		$nid="b5";
		}
		if($b=="bing6")
		{
		$d="sbing6";
		$id="txtslbing6";
		$nid="b6";
		}
		if($b=="bing7")
		{
		$d="sbing7";
		$id="txtslbing7";
		$nid="b7";
		}
		if($b=="bing8")
		{
		$d="sbing8";
		$id="txtslbing8";
		$nid="b8";
		}
		if($b=="bind1")
		{
		$d="sbind1";
		$id="txtslbind1";
		$nid="b4";
		}
		if($b=="bind2")
		{
		$d="sbind2";
		$id="txtslbind2";
		$nid="b5";
		}
		if($b=="bind3")
		{
		$d="sbind3";
		$id="txtslbind3";
		$nid="b5";
		}
	}

	
$flag=0; 
//echo $a;
$sql_month=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and  whid='".$a."' order by binname")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);

?>
&nbsp;<select class="tbltext" id="<?php echo $nid;?>" name="<?php echo $id;?>" style="width:60px;" <?php if($b=="bing1"){?>onchange="bin(this.value,'1');"<?php }if($b=="bing2"){?>onchange="bin(this.value,'2');"<?php }if($b=="bing3"){?>onchange="bin(this.value,'3');"<?php }if($b=="bing4"){?>onchange="bin(this.value,'4');"<?php }if($b=="bing5"){?>onchange="bin(this.value,'5');"<?php }if($b=="bing6"){?>onchange="bin(this.value,'6');"<?php }if($b=="bing7"){?>onchange="bin(this.value,'7');"<?php }if($b=="bing8"){?>onchange="bin(this.value,'8');"<?php } ?>   >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;