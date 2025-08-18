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
		if($b=="bind1")
		{
		$d="sbind1";
		$id="txtslbind1";
		$nid="bd1";
		}
		if($b=="bind2")
		{
		$d="sbind2";
		$id="txtslbind2";
		$nid="bd2";
		}
	}


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_monthd=mysqli_query($link,"select binid, binname from tbldbin where plantcode='$plantcode' AND whid='".$a."' order by binname")or die("Error:".mysqli_error($link));
//$row_month=mysqli_fetch_array($sql_month);

?>
&nbsp;<select class="tbltext" id="<?php echo $nid;?>" name="<?php echo $id;?>" style="width:60px;" <?php if($b=="bind1"){?>onchange="bind1(this.value);"<?php }if($b=="bind2"){?>onchange="bind2(this.value);" <?php } ?>  >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bind1 = mysqli_fetch_array($sql_monthd)) { ?>
		<option value="<?php echo $noticia_bind1['binid'];?>" />   
		<?php echo $noticia_bind1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;