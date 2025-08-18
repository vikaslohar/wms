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


if(isset($_GET['q']))
{
	$a = $_GET['q'];	 
}
if(isset($_GET['b']))
{
 	$extarr = $_GET['b'];	 
}
if(isset($_GET['a']))
{
	$tno = $_GET['a'];	 
}
if(isset($_GET['d']))
{
	$totno = $_GET['d'];	 
}
if(isset($_GET['f']))
{
	$newbarno = $_GET['f'];	 
}

/*$zzx=array();
$xs=explode(",",$newbarno);
$sn=$tno-1;
for ($i=0; $i<sizeof($xs); $i++) {	if($i!=$sn) { array_push($zzx,$xs[$i]); }}*/
$extarr=explode(",",$extarr);
$newbarno=explode(",",$newbarno);
$flg=0;
	if(in_array($a,$extarr))
	{ $flg++;}
	if(in_array($a,$newbarno))
	{ $flg++;}
	$sql_barcode=mysqli_query($link,"Select bar_barcode from tbl_barcodes where bar_barcode='$a' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_barcode=mysqli_num_rows($sql_barcode);
	$sql_barcode22=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_barcodes='$a' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_barcode22=mysqli_num_rows($sql_barcode22);
	if($tot_barcode > 0 || $tot_barcode22 > 0)
	{ $flg++;}
?>	
<input type='text' name='confbarcodes<?php echo $tno?>' id='confbarcodes<?php echo $tno?>' onkeyup='searchbarcode(this.value,<?php echo $tno?>)' onkeypress='return isNumberKey(event)' onblur="chkbalbar(<?php echo $tno?>)" size='10' maxlength='9' class='tbltext' value='<?php if($flg==0) echo $a; else echo '';?>'><input type="hidden" name="totbarok<?php echo $tno?>" id="totbarok<?php echo $tno?>" value="<?php echo $flg;?>" /><?php if($flg > 0){?><font color='#FF0000' >* </font><?php } ?>
