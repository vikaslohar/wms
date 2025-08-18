<?php
/*	session_start();
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
	}*/
	
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
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$g = $_GET['g'];	 
	}
if($g=="checked")
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<tr>	
<?php

$sql_whouse1=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$b."' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars'];

$sql_binn1=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$c."' and whid='".$b."'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname'];

$sql_subbinn1=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$f."' and binid='".$c."' and whid='".$b."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];
?>

<td width="96" align="center"  valign="middle" class="smalltbltext"><?php echo $wareh1;?><input type="hidden" class="smalltbltext" id="txtslwhg<?php echo $a?>" name="txtslwhg<?php echo $a?>" value="<?php echo $b;?>"  >
</td>
<td width="109" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $a?>"><?php echo $binn1;?><input type="hidden" class="smalltbltext" name="txtslbing<?php echo $a?>" id="txtslbing<?php echo $a?>" value="<?php echo $c;?>" >
</td>
<td width="89" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $a?>"><?php echo $subbinn1;?><input type="hidden" class="smalltbltext" name="txtslsubbg<?php echo $a?>" id="txtslsubbg<?php echo $a?>" value="<?php echo $f;?>"  >
</td>
</tr>
</table>
<?php
}
else
{
$srno2=$a;
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<tr>	
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldrywarehouse  where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>

<td width="96" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno2?>" name="txtslwhg<?php echo $srno2?>" style="width:70px;" onchange="wh<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldrybin where plantcode='".$plantcode."' and   plantcode = $plantcode order by binname") or die(mysqli_error($link));
?>

<td width="109" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno2?>"><select class="smalltbltext" name="txtslbing<?php echo $srno2?>" style="width:60px;" onchange="bin<?php echo $srno2?>(this.value,<?php echo $srno2?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbldrysubbin where plantcode='".$plantcode."' and   plantcode = $plantcode order by sname") or die(mysqli_error($link));
?>	

<td width="89" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno2?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno2?>" id="txtslsubbg<?php echo $srno2?>" style="width:60px;" onchange="subbin<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  </tr>
</table>
<?php } ?>