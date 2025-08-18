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
	
	ini_set("memory_limit","800M");
	
	$connnew = mysqli_connect("localhost","wfuser","P1o5RSOloG8jCAN8") or die("Error:".mysqli_error($connnew));
	$dbnew = mysqli_select_db($connnew,"wmsfocusdb") or die("Error:".mysqli_error($connnew));
	
	$qdate="2022-03-01"; $cnt=0;
	
	$sql_arr=mysqli_query($link,"select * from tblarrival where arrival_date>='".$qdate."' ") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
		$trdate=$row_arr['arrival_date'];
		$tdate=date("Y-m-d");
		$pid=$row_arr['arrival_id'];
		
		$sqlarrsub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$pid."'") or die(mysqli_error($link));
		$totarrsub=mysqli_num_rows($sqlarrsub);
		while($row_arrsub=mysqli_fetch_array($sqlarrsub))
		{	
			
			$wfsloc='';
			$sql_arrsub_sub=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$pid."' and arr_id='".$row_arrsub['arrsub_id']."'") or die(mysqli_error($link));
			while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
			{
				$whid=$row_arrsub_sub['whid'];
				$binid=$row_arrsub_sub['binid'];
				$subbinid=$row_arrsub_sub['subbin'];
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars']."/";
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$binid."' and whid='".$whid."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname']."/";
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$subbinid."' and binid='".$binid."' and whid='".$whid."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				if($wfsloc!="")
				$wfsloc=$wfsloc.", ".$wareh.$binn.$subbinn;
				else
				$wfsloc=$wareh.$binn.$subbinn;
			}
			
			
			$sql_lotimp=mysqli_query($link,"select * from tbllotimp where lotnumber='".$row_arrsub['old']."'") or die(mysqli_error($link)); 
			$row_lotimp=mysqli_fetch_array($sql_lotimp);
			$farmerid=$row_lotimp['farmer_id'];
			$agreementid=$row_lotimp['agreement_id'];
			
	echo 		$sql_focusdb="insert into tbl_frn (wffrn_arrid, wffrn_docno, wffrn_date, wffrn_vendorac, wffrn_businessentity, wffrn_warehouse, wffrn_narration, wffrn_vehicleno, wffrn_lrno, wffrn_lrdate, wffrn_crop, wffrn_item, wffrn_unit, wffrn_pdnqty, wffrn_qty, wffrn_diffqty, wffrn_batch, wffrn_frnno) values('$pid','".$row_arr['dcno']."', '".$trdate."', '".$farmerid."', '".$row_arrsub['farmer']."', '".$wfsloc."', '".$row_arr['arrival_type']."', '".$row_arr['trans_vehno']."', '".$row_arr['trans_lorryrepno']."', '".$row_arr['disp_date']."', '".$row_arrsub['lotcrop']."', '".$row_arrsub['lotvariety']."', 'Kgs.', '".$row_arrsub['qty']."', '".$row_arrsub['act']."', '".$row_arrsub['diff']."', '".$row_arrsub['orlot']."', '".$row_arrsub['ncode']."')";
	echo "<br />";
			//if($focusdb_xz=mysqli_query($connnew,$sql_focusdb) or die(mysqli_error($connnew)))
			{
			//	$wfid=mysqli_insert_id($connnew);$cnt++;
			}
		}
	}			

echo $cnt;
?>