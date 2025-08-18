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
	
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }

	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
	$tdate2=explode("-",$edate);
	$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];
		
	$dh="Release_Order_Report_Period_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array("Release Order Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	$cnt=1;
$sql_arr_home=mysqli_query($link,"select * from tbl_orderrelease where plantcode='$plantcode' and orel_date<='$edate' and orel_date>='$sdate' and orel_flg=1 order by orel_date asc ") or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

	
		$datahead1= array("Period From ".$_REQUEST['sdate']." To ".$_REQUEST['edate']);
		$datahead2= array("#","Date","Order No","Party Name","Order Release Type","Current Order Status"); 
		
		$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orel_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['orel_logid'];
	$arrival_id=$row_arr_home['orel_ordermid'];
	$oid=$row_arr_home['orel_id'];
	$orreltyp=$row_arr_home['orel_type'];
	
	$orno=""; $party=""; 
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='$arrival_id'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl_sub['orderm_party']."'"); 
	$totpr=mysqli_num_rows($quer3);
	$row3=mysqli_fetch_array($quer3);
	
	$orno=$row_tbl_sub['orderm_porderno'];
	if($totpr > 0)
	$party=$row3['business_name'];
	else
	$party=$row_tbl_sub['orderm_partyname'];
	
	$balqty=0; $qt=0; $rqt=0; $bqt=0;
	$sql_tblsub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbl_tot=mysqli_num_rows($sql_tblsub);
	while($row_tblsub=mysqli_fetch_array($sql_tblsub))
	{
		$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
		while($row_sloc=mysqli_fetch_array($sql_sloc))
		{
			$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
			if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
			$qt=$qt+$qt1;
			
			$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where plantcode='$plantcode' and orelsub_ordermsubsubid='".$row_sloc['order_sub_sub_id']."' and orel_id='$oid'")or die(mysqli_error($link));
			$tot_orrelss=mysqli_num_rows($sql_orrelss);
			$row_orrelss=mysqli_fetch_array($sql_orrelss);
			
			$rqt=$rqt+$row_orrelss['orelsubsub_relqty'];
			$bqt=$bqt+($row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty']);
		}
	
	}
	 $extqty=$qt; 
	 $relqty=$rqt; 
	 $balqty=$bqt;
	 if($balqty>0) {$status="Balance";}
	 else { $status="Complete"; }
		if($tot_arr_home > 0)
		{ 
		$data1[$d]=array($d,$trdate,$orno,$party,$orreltyp,$status); 
		$d++;
		}
}

		echo implode($datahead) ;
		echo "\n";
		echo implode($datahead1) ;
		echo "\n";
		echo implode("\t", $datahead2) ;
		echo "\n";
		foreach($data1 as $row1)
		 { 
			echo implode("\t", array_values($row1))."\n"; 
		 }