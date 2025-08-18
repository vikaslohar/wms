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
	
	$z=0;
	$sql_issue1=mysqli_query($link,"select mpmain_barcode, mpmain_crop, mpmain_variety, mpmain_wtmp, mpmain_upssize from tbl_mpmain where mpmain_date>='2023-01-01' and  mpmain_date<='2023-12-28' and mpmain_trtype='PACKMMC' order by mpmain_id desc") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
		$barcode=$row_issue1['mpmain_barcode'];
		$wtmp=$row_issue1['mpmain_wtmp'];
		$cp=''; $vt='';	$ups='';
		$crp=$row_issue1['mpmain_crop'].",";
		$ver=$row_issue1['mpmain_variety'].",";
		$upss=$row_issue1['mpmain_upssize'].",";
		$crp=explode(",",$crp);
		$ver=explode(",",$ver);
		$upss=explode(",",$upss);
		foreach($crp as $crps)
		{
			if($crps<>"")
			{
				$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crps."'"); 
				$row_dept5=mysqli_fetch_array($quer5);
				if($cp!=""){$cp=$cp.",".$row_dept5['cropname'];} else {$cp=$row_dept5['cropname'];}
			}
		}
		foreach($ver as $vers)
		{
			if($vers<>"")
			{
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$vers."'"); 
				$row_dept4=mysqli_fetch_array($quer4);
				if($vt!=""){$vt=$vt.",".$row_dept4['popularname']; } else {$vt=$row_dept4['popularname'];}		
			}
		}		
		foreach($upss as $upsss)
		{
			if($upsss<>"")
			{
				if($ups!=""){$ups=$ups.",".$upsss; } else {$ups=$upsss;}		
			}
		}		
		echo $barcode." =  ".$cp."  =  ".$vt."  =  ".$ups."  =  ".$wtmp."<br />";
		$z++;
				
	}
	echo $z;
	/*echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";*/
?>
