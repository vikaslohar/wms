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

if(isset($_REQUEST['a']))
{
	$a = $_REQUEST['a'];	 
}
$barcode=trim($_REQUEST['barcode']);
$srno=trim($_REQUEST['srno']);
$slocchkflg=0;
//echo "select * from tbl_stlotimp_packsubsub where stlotimpps_barcode='".$barcode."' and stlotimpps_arrflg=0 ";
$sql_barcode=mysqli_query($link,"select * from tbl_stlotimp_packsubsub where stlotimpps_barcode='".$barcode."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_barcode=mysqli_num_rows($sql_barcode);
while($row_barcode=mysqli_fetch_array($sql_barcode))
{		
	//echo "select * from tbl_stlotimp_pack_sub where stlotimpps_id='".$row_barcode['stlotimpps_id']."' ";
	$sql_sub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpps_id='".$row_barcode['stlotimpps_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_sub);
	$row_sub=mysqli_fetch_array($sql_sub);
	$lotno=$row_sub['stlotimpp_lotno'];
	
	$wh=""; $bin=""; $sbin="";
	for($i=1;$i<$srno;$i++)
	{
		$txtarrlot1="txtlot_".$i;
		if(isset($_REQUEST[$txtarrlot1])) { $txtarrlot=$_REQUEST[$txtarrlot1]; }
		//echo $txtarrlot." - ".$lotno."     ";
		if($txtarrlot==$lotno)
		{ 
			$whg="txtwhg_".$i;
			$vbin="vbin_".$i;
			$vsubbin="vsubbin_".$i;
			
			if(isset($_REQUEST[$whg])) { $wh=$_REQUEST[$whg]; }
			if(isset($_REQUEST[$vbin])) { $bin=$_REQUEST[$vbin]; }
			if(isset($_REQUEST[$vsubbin])) { $sbin=$_REQUEST[$vsubbin]; }
			if($sbin=="" || $sbin=="SubBin") $slocchkflg=1; 
			//echo $sbin." - ".$slocchkflg."<br />";
		}
	}
}
$sql_barcode=mysqli_query($link,"select * from tbl_arrpack_barcode where arrpackss2_barcode='".$barcode."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_barcode=mysqli_num_rows($sql_barcode);
if($tot_barcode>0) $slocchkflg=2;
//echo $sbin." - ".$slocchkflg;
?>
<input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="<?php echo $slocchkflg;?>" />