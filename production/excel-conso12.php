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
	
	 $sdate = $_GET['sdate'];
	 $edate = $_GET['edate'];
	 $itemid = $_GET['txtcrop'];
     $loc = $_GET['txtvariety'];
	 $typ = $_GET['txtvisualck'];
 	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;

	$tdate=$edate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;

	if($typ=="Trading"){$typ1="Trading Arrival";$typ2="Trading_Arrival";}
	else if($typ=="Fresh Seed with PDN"){$typ1="Fresh Seed Arrival with PDN ";$typ2="Fresh_Seed_Arrival_with_PDN";}
	
	$dh="Consolidated_Arrival_".$typ2."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("Consolidated Arrival:Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
	
	$filename=$dh.".xls";  
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	$data1 = array();
	
$crop1="ALL";	 
if($itemid=="ALL")
{
	$sql_arrsubcrop=mysqli_query($link,"select distinct lotcrop from tblarrival_sub where  plantcode='$plantcode' order by lotcrop asc") or die(mysqli_error($link));
}
else
{
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop1=$row_class['cropname'];	
	$sql_arrsubcrop=mysqli_query($link,"select distinct lotcrop from tblarrival_sub where lotcrop='".$crop1."' and plantcode='$plantcode' order by lotcrop asc") or die(mysqli_error($link));
}
$tot_arrsubcrop=mysqli_num_rows($sql_arrsubcrop);
if($tot_arrsubcrop > 0)	
{
	$s=0; 
	while($row_arrsubcrop=mysqli_fetch_array($sql_arrsubcrop))
	{
		$cnt=0;$crop="";
		$sql_subvar=mysqli_query($link,"select arrival_id from tblarrival_sub where lotcrop='".$row_arrsubcrop['lotcrop']."' and plantcode='$plantcode' order by lotvariety") or die(mysqli_error($link));
		while($row_subvar=mysqli_fetch_array($sql_subvar))
		{
			$sql_arr=mysqli_query($link,"select arrival_id from tblarrival where arrival_id='".$row_subvar['arrival_id']."' and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and plantcode='$plantcode' order by arrival_id") or die(mysqli_error($link));
			if($tot_arr=mysqli_num_rows($sql_arr)>0)
			$cnt++;
		}
		$crop=$row_arrsubcrop['lotcrop'];
		if($cnt>0)
		{
			$d=1; $s++;
			$datahead1[$s] = array($typ1,  "Crop:",  $crop);
			# file name for download $filename = "Order Details.xls";
			$datatitle3[$s] = array("#","Variety","Stage","Total Qty","Qty:GOT-R","Qty:GOT-NR");
			if($loc!="ALL" && $itemid!="ALL")
			{
				$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$loc."' ") or die(mysqli_error($link));
				$row_vit=mysqli_fetch_array($sql_vit);
				$vit=$row_vit['popularname'];
				
				$sql_arrsubvar=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$row_arrsubcrop['lotcrop']."' and plantcode='$plantcode' and lotvariety='".$vit."' group by lotvariety, sstage") or die(mysqli_error($link));
			}
			else
			{
				$sql_arrsubvar=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$row_arrsubcrop['lotcrop']."' and plantcode='$plantcode' group by lotvariety, sstage") or die(mysqli_error($link));
			}	
			$tot_arrsubvar=mysqli_num_rows($sql_arrsubvar);
			
			while($row_arrsubvar=mysqli_fetch_array($sql_arrsubvar))
			{
				$totqty=0; $gotrqty=0; $gotnrqty=0; $variety=""; $stage="";
				$sql_var=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$row_arrsubcrop['lotcrop']."' and lotvariety='".$row_arrsubvar['lotvariety']."' and sstage='".$row_arrsubvar['sstage']."' and plantcode='$plantcode' order by lotvariety asc") or die(mysqli_error($link));
				while($row_var=mysqli_fetch_array($sql_var))
				{
					$sql_arrmain=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_var['arrival_id']."' and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and plantcode='$plantcode' order by lotvariety") or die(mysqli_error($link));
					$tot_arrmain=mysqli_num_rows($sql_arrmain);
					$row_arrmain=mysqli_fetch_array($sql_arrmain);
					if($tot_arrmain>0)
					{	
						$totqty=$totqty+$row_var['act'];
						if($row_var['got']=="GOT-R")
						{
							$gotrqty=$gotrqty+$row_var['act'];
						}
						if($row_var['got']=="GOT-NR")
						{
							$gotnrqty=$gotnrqty+$row_var['act'];
						}
					}
					$variety=$row_arrsubvar[1];
					$stage=$row_arrsubvar[0];
				}
				if($totqty>0)
				{
					$data1[$s][$d]=array($d,$variety,$stage,$totqty,$gotrqty,$gotnrqty); 
					$d++;
				}
			}
		}
	}
}
# coading ends here............
echo implode($datahead2) ;
echo "\n";
for($i=1; $i<=$s; $i++)
{
echo implode("\t", $datahead1[$i]) ;
echo "\n";
echo implode("\t", $datatitle3[$i]) ;
echo "\n";

	foreach($data1[$i] as $row1)
	{ 
		#array_walk($row1, 'cleanData'); 
		echo implode("\t", array_values($row1))."\n"; 
	}
}