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
	if(isset($_REQUEST['txtptyp'])) { $txtptyp = $_REQUEST['txtptyp']; }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['txtpartycat1'])) { $txtpartycat1=trim($_REQUEST['txtpartycat1']); }
	if(isset($_REQUEST['fillpartyname1'])) { $fillpartyname1=trim($_REQUEST['fillpartyname1']); }
	if(isset($_REQUEST['partyname'])) { $partyname = $_REQUEST['partyname']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['reptyp1'])) { $reptyp1 = $_REQUEST['reptyp1']; }
	if($txtpp=="CandF")
	{
	$txtpp="C&F";
	}
	if($txtpp=="C")
	{
	$txtpp="C&F";
	}
	$partyname_org=$partyname;

	if($reptyp1=="hold")
	    {	
			$aa="";
			$aa1="";
		}
		else
		{
			$aa=" and order_sub_hold_flag=0";
			$aa1=" and orderm_holdflag=0";
		}

		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
	$dh="Party_wise_Compiled_Pending_Order_Report_as_on_".$_REQUEST['sdate'];
	$datahead = array("Party wise Compiled Pending Order Report as on ".$_REQUEST['sdate']);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	$cnt=1;
if($fillpartyname1!="")
{
$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$fillpartyname1' and order_trtype='Order TDF' and  orderm_date<='$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

	
		$datahead1[$cnt] = array("Party Name:",$fillpartyname1);
		$datahead2[$cnt] = array("#","Order No","Order Date","Crop","Variety","UPS","Qty","NoP","Total Qty"); 
		if($reptyp1=="hold")
		{	
			array_push($datahead2[$cnt],"Status");
		}
		$d=1;
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			$trdate=$row_arr_home['orderm_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$trdate=$trday."-".$trmonth."-".$tryear;
				
			$loc1="";
			$arrival_id=$row_arr_home['orderm_id'];
			if($loc1!="")
			{
				$loc1=$loc1.", ".$row_arr_home['orderm_porderno'];
			}
			else
			{
				$loc1=$row_arr_home['orderm_porderno'];
			}
			
			$status=""; $statussub=""; $status1="";
			if($reptyp1=="hold")
			{	
				if($row_arr_home['orderm_holdflag']!=0)
				$status1=$row_arr_home['orderm_holdtype'];	
			}
			else
			{
				$status1="";
			}
					
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			$s_id=$sql_tbl_sub['orderm_id'];
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
			 
				$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";
			
				if($reptyp1=="hold")
				{	
					if($row_tbl_sub['order_sub_hold_flag']!=0)
					$statussub=$row_tbl_sub['order_sub_hold_type'];	
				}
				else
				{
					$statussub="";
				}
		
				$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
				$row_dept5=mysqli_fetch_array($quer5);
				$cro=$row_dept5['cropname'];

				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety'"); 
				$row_dept4=mysqli_fetch_array($quer4);
				$variet=$row_dept4['popularname'];
				
		$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
		while($row_sloc=mysqli_fetch_array($sql_sloc))
		{
			$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
			
			$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
			if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
			
			if($qt!="")
			$qt=$qt.", ".$qt1;
			else
			$qt=$qt1;
			if($sstatus!="")
			{
				$sstatus=$sstatus.", ".$row_sloc['order_sub_sub_nop'];
			}
			else
			{
				$sstatus=$row_sloc['order_sub_sub_nop'];
			}
			if($sstatus==0){
	 
	 $sstatus="";
	 }
		 }
			 
			if($status1=="")
			 $status=$statussub;
			 else
			 $status=$status1;
	 	$or=$row_arr_home['orderm_porderno'];
		$tr=$row_arr_home['order_trtype'];	
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		
		 if($tot_arr_home > 0)
		{ 
		if($stage > 0)	 
		{
		$data1[$cnt][$d]=array($d,$trdate,$tr,$or,$cro,$variet,$up,$qt,$sstatus,$stage); 
		if($reptyp1=="hold")
		{	
			array_push($data1[$cnt][$d],$status);
		}
		$d++;
		}
		}
		}
		}
}	 
else
{
	if($txtparty !="ALL")
	{
		if($txtptyp=="TDF - Individual")
		{ 
			$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
		else
		{
			if($txt11 != "TDF")
			{
				if($txtpp !="Export Buyer")
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_party_type='$txtpp' and orderm_location='$txtlocationsl'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
				if($txtpp !="Export Buyer")
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_party_type='$txtpp' and orderm_location='$txtlocationsl'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
		}
	
	$tot_arr_home=mysqli_num_rows($sql_arr_home);

		$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser where p_id='$txtparty'"); 
		$row3=mysqli_fetch_array($quer3);
		$party=$row3['business_name'];
	
		$datahead1[$cnt] = array("Party Name:",$party);
		$datahead2[$cnt] = array("#","Order No","Order Date","Crop","Variety","UPS","Qty","NoP","Total Qty"); 
		if($reptyp1=="hold")
		{	
			array_push($datahead2[$cnt],"Status");
		}
		$d=1;
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			$trdate=$row_arr_home['orderm_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$trdate=$trday."-".$trmonth."-".$tryear;
				
			$loc1="";
			$arrival_id=$row_arr_home['orderm_id'];
			if($loc1!="")
			{
				$loc1=$loc1.", ".$row_arr_home['orderm_porderno'];
			}
			else
			{
				$loc1=$row_arr_home['orderm_porderno'];
			}
			
			$status=""; $statussub=""; $status1="";
			if($reptyp1=="hold")
			{	
				if($row_arr_home['orderm_holdflag']!=0)
				$status1=$row_arr_home['orderm_holdtype'];	
			}
			else
			{
				$status1="";
			}
					
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			$s_id=$sql_tbl_sub['orderm_id'];
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
			 
				$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";
			
				if($reptyp1=="hold")
				{	
					if($row_tbl_sub['order_sub_hold_flag']!=0)
					$statussub=$row_tbl_sub['order_sub_hold_type'];	
				}
				else
				{
					$statussub="";
				}
		
				$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
				$row_dept5=mysqli_fetch_array($quer5);
				$cro=$row_dept5['cropname'];

				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety'"); 
				$row_dept4=mysqli_fetch_array($quer4);
				$variet=$row_dept4['popularname'];
				
		$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
		while($row_sloc=mysqli_fetch_array($sql_sloc))
		{
			$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";			
			$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
			if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
			
			if($qt!="")
			$qt=$qt.", ".$qt1;
			else
			$qt=$qt1;
			if($sstatus!="")
			{
				$sstatus=$sstatus.", ".$row_sloc['order_sub_sub_nop'];
			}
			else
			{
				$sstatus=$row_sloc['order_sub_sub_nop'];
			}
			if($sstatus==0){
	 
	 $sstatus="";
	 }
		 }
			 
			if($status1=="")
			 $status=$statussub;
			 else
			 $status=$status1;
	 	$or=$row_arr_home['orderm_porderno'];
		$tr=$row_arr_home['order_trtype'];	
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		
		 if($tot_arr_home > 0)
		{
		if($stage > 0)	 
		{ 
			$data1[$cnt][$d]=array($d,$trdate,$tr,$or,$cro,$variet,$up,$qt,$sstatus,$stage); 
			if($reptyp1=="hold")
			{	
				array_push($data1[$cnt][$d],$status);
			}
			$d++;
		}
		}
		}
		}
		
	}
	else
	{
		if($txtptyp=="TDF - Individual")
		{ 
		if($txtlocationsl !="ALL")
		{
				$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_location='$txtlocationsl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
		else
		{
			$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_locstate='$txtstatesl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
	}
	else
	{
		if($txt11 != "TDF")
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
		else
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
	}



$tot_arr_home22=mysqli_num_rows($sql_arr_home22);
if($tot_arr_home22 > 0)
{
while($row_22=mysqli_fetch_array($sql_arr_home22))
{

if($txtptyp=="TDF - Individual")
	{ 
		if($txtlocationsl !="ALL")
		{
				$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_location='$txtlocationsl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
		else
		{
			$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_locstate='$txtstatesl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
	}
	else
	{
		if($txt11 != "TDF")
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
		else
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
	}
	
	$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser where p_id='".$row_22['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$party=$row3['business_name'];
	
		$datahead1[$cnt] = array("Party Name:",$party);
		$datahead2[$cnt] = array("#","Order No","Order Date","Crop","Variety","UPS","Qty","NoP","Total Qty"); 
		if($reptyp1=="hold")
		{	
			array_push($datahead2[$cnt],"Status");
		}
		$d=1;
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			$trdate=$row_arr_home['orderm_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$trdate=$trday."-".$trmonth."-".$tryear;
				
			$loc1="";
			$arrival_id=$row_arr_home['orderm_id'];
			if($loc1!="")
			{
				$loc1=$loc1.", ".$row_arr_home['orderm_porderno'];
			}
			else
			{
				$loc1=$row_arr_home['orderm_porderno'];
			}
			
			$status=""; $statussub=""; $status1="";
			if($reptyp1=="hold")
			{	
				if($row_arr_home['orderm_holdflag']!=0)
				$status1=$row_arr_home['orderm_holdtype'];	
			}
			else
			{
				$status1="";
			}
					
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			$s_id=$sql_tbl_sub['orderm_id'];
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
			 
				$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";
			
				if($reptyp1=="hold")
				{	
					if($row_tbl_sub['order_sub_hold_flag']!=0)
					$statussub=$row_tbl_sub['order_sub_hold_type'];	
				}
				else
				{
					$statussub="";
				}
		
				$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'"); 
				$row_dept5=mysqli_fetch_array($quer5);
				$cro=$row_dept5['cropname'];

				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."'"); 
				$row_dept4=mysqli_fetch_array($quer4);
				$variet=$row_dept4['popularname'];
				
		$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
		while($row_sloc=mysqli_fetch_array($sql_sloc))
		{
			$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
			
			$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
			if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
			
			if($qt!="")
			$qt=$qt.", ".$qt1;
			else
			$qt=$qt1;
			if($sstatus!="")
			{
				$sstatus=$sstatus.", ".$row_sloc['order_sub_sub_nop'];
			}
			else
			{
				$sstatus=$row_sloc['order_sub_sub_nop'];
			}
			if($sstatus==0){
	 
	 $sstatus="";
	 }
		 }
			if($status1=="")
			 $status=$statussub;
			 else
			 $status=$status1;
	 	$or=$row_arr_home['orderm_porderno'];
		$tr=$row_arr_home['order_trtype'];	
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		
		 if($tot_arr_home > 0)
		{ 
		if($stage > 0)	 
		{
			$data1[$cnt][$d]=array($d,$or,$trdate,$cro,$variet,$up,$qt,$sstatus,$stage); 
			if($reptyp1=="hold")
			{	
				array_push($data1[$cnt][$d],$status);
			}
			$d++;
		}
		}
		}
		}
$cnt++;
}
}
}
}
		echo implode($datahead) ;
		echo "\n";
for($i=1; $i<$cnt; $i++)
{
		echo implode($datahead1[$i]) ;
		echo "\n";
		echo implode("\t", $datahead2[$i]) ;
		echo "\n";
		foreach($data1[$i] as $row1)
		 { 
			echo implode("\t", array_values($row1))."\n"; 
		 }
}		 