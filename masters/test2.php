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
	
	ini_set("memory_limit","180M");

$sql_arr_home=mysqli_query($link,"Select * from tblvariety order by varietyid asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{	$mptnop=""; $srnonew=0;	
		$p1_array=explode(",",$row_arr_home['gm']);
		$p1_array2=explode(",",$row_arr_home['wtmp']);
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
			{
				$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
				$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
				$row12=mysqli_fetch_array($res);
				if($row12['wt']=="Gms")
				{	
					$wtmp=$p1_array2[$srnonew];
					$a=1000*$row12['uom'];
					$b=1000/$a;
					$c=$wtmp*$b;
				}
				else
				{
					$wtmp=$p1_array2[$srnonew];
					$b=$row12['uom'];
					$c=$wtmp/$b;
				}
				if($mptnop!=""){$mptnop=$mptnop.",".$c;}
				else {$mptnop=$c;}
				$srnonew++;
			}
		}
		//echo $row_arr_home['varietyid']." - ".$row_arr_home['popularname']." - ".$mptnop."<br />";
		$sql="update tblvariety set mptnop='$mptnop' where varietyid='".$row_arr_home['varietyid']."' and actstatus='Active'";
		$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
		//echo "<br />";
	}
}
 echo "<script>alert('Varieties Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
?>