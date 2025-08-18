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


//  			main arrival table fields
if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
$barcode=trim($_GET['barcode']);	
$srno=trim($_GET['srno']);

$slocchkflg=0;

$sql_barcode=mysqli_query($link,"select * from tbl_stlotimp_packsubsub where stlotimpps_barcode='".$barcode."' and plantcode='$plantcode' and stlotimpps_arrflg=0 ") or die(mysqli_error($link));
$tot_barcode=mysqli_num_rows($sql_barcode);
while($row_barcode=mysqli_fetch_array($sql_barcode))
{	
$sql_impsub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpps_id='".$row_barcode['stlotimpps_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_impsub=mysqli_num_rows($sql_impsub);
while($row_impsub=mysqli_fetch_array($sql_impsub))
{
	$lotno=$row_impsub['stlotimpp_lotno']; 
	
	for($i=1;$i<$srno;$i++)
	{
		$txtarrlot1="txtlot_".$i;
		if(isset($_GET[$txtarrlot1])) { $txtarrlot=$_GET[$txtarrlot1]; }
		if($txtarrlot==$lotno)
		{ 
			$whg="txtwhg_".$i;
			$vbin="vbin_".$i;
			$vsubbin="vsubbin_".$i;
			
			if(isset($_GET[$whg])) { $wh=$_GET[$whg]; }
			if(isset($_GET[$vbin])) { $bin=$_GET[$vbin]; }
			if(isset($_GET[$vsubbin])) { $sbin=$_GET[$vsubbin]; }
			if($wh= "" && $bin=="" && $sbin=="") $slocchkflg++;
		}
	}
}
?>
<input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="<?php echo $slocchkflg;?>" />


