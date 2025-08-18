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
$pcode=''; $plcode=''; $ycode=''; $pnpslipsub_lblno=0; $labelno='';
$sql_plant=mysqli_query($link,"SELECT plantcode, plantcode1  FROM tbluser WHERE scode='".$logid."'")or die(mysqli_error($link));
$tot_plant=mysqli_num_rows($sql_plant);
$row_plant=mysqli_fetch_array($sql_plant);
$pcode=$row_plant['plantcode']; 
$plcode=$row_plant['plantcode1']; 

$sql_yrc=mysqli_query($link,"SELECT ycode, years, year1, baryrcode  FROM tblyears WHERE years_flg != 0 and years_status='a' ")or die(mysqli_error($link));
$tot_yrc=mysqli_num_rows($sql_yrc);
$row_yrc=mysqli_fetch_array($sql_yrc);
$ycode=$row_yrc['ycode']; 

$lblchar=$plcode.$a.$ycode; 

$sq_sub=mysqli_query($link,"SELECT MAX(pnpslipsub_maxlabel) FROM tbl_pnpslipsub WHERE pnpslipsub_lblchar1='$lblchar'")or die(mysqli_error($link));
$t_sub=mysqli_num_rows($sq_sub);
$ro_sub=mysqli_fetch_array($sq_sub);
//echo $ro_sub[0];
$sql_sub=mysqli_query($link,"SELECT MAX(CAST(SUBSTRING(label, 4) AS UNSIGNED)) AS max_number
FROM (
    SELECT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(pnpslipsub_elabelno, ',', n.n), ',', -1)) AS label
    FROM tbl_pnpslipsub
    JOIN (
        SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5
        UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10
    ) n ON CHAR_LENGTH(pnpslipsub_elabelno)
         -CHAR_LENGTH(REPLACE(pnpslipsub_elabelno, ',', '')) >= n.n - 1
) AS split_labels
WHERE label LIKE '$lblchar%' ")or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
$row_sub=mysqli_fetch_array($sql_sub);
$pnpslipsub_lblno=$row_sub['max_number'];
if($ycode=='R')
{
	if($pnpslipsub_lblno<1000000)
	{
		$pnpslipsub_lblno=1000000;
	}
}
	
if($pnpslipsub_lblno==0){$pnpslipsub_lblno=1;} else {$pnpslipsub_lblno=$pnpslipsub_lblno+1;}
$pnpslipsub_lblno=sprintf('%07d', $pnpslipsub_lblno);
//$labelno=$lblchar.$pnpslipsub_lblno;
$labelno=$lblchar.$pnpslipsub_lblno;

?>&nbsp;<?php echo $labelno;?><input type="hidden" name="txtpacklblnos" value="<?php echo $labelno;?>" >