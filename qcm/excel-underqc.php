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
	
	$sdate1 = $_REQUEST['sdate'];
		$qcti = $_REQUEST['qcti'];
		$rvalt = $_REQUEST['rvalt'];
		$cid = $_REQUEST['cid'];
		$itemid = $_REQUEST['itemid'];	
		
		$tdate=$sdate1;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
		
	
	$vv_var=$itemid;

if($cid=="ALL" && $itemid=="ALL")	
{
	if($qcti=="rt")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='RT' and  srdate <='$sdate' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
	else if($qcti=="ut")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='UT' and srdate <='$sdate' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where srdate <='$sdate' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
}
else if($cid!="ALL" && $itemid=="ALL")	
{
	if($qcti=="rt")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='RT' and  srdate <= '$sdate' and crop='$cid' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
	else if($qcti=="ut")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='UT' and srdate <= '$sdate' and  qcflg=0 and crop='$cid' and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where srdate <='$sdate' and crop='$cid' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
}
else if($cid!="ALL" && $itemid!="ALL")	
{
	if($qcti=="rt")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='RT' and  srdate <= '$sdate' and crop='$cid' and variety='$vv_var' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
	else  if($qcti=="ut")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='UT' and srdate <= '$sdate' and qcflg=0 and crop='$cid' and variety='$vv_var' and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where srdate <='$sdate' and crop='$cid' and variety='$vv_var' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
	}
}

$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$dh="QC_Pending_Report".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("QC_Pending_Report_As_on_Date",$_REQUEST['sdate']);

	$data1 = array();
	
function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	   
	    # file name for download $filename = "Order Details.xls";
		
	    $filename=$dh.".xls";  
	   //exit;
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel");
		 //$datatitle1 = array("Preliminary QC");
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","NoB","Qty","DOSR","DOSC","EDOR","Sample No");
$d=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
if($cid!="ALL" && $itemid=="ALL")	
{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' and crop='$cid' order by tid desc ") or die(mysqli_error($link));
}
else if($cid!="ALL" && $itemid!="ALL")	
{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' and crop='$cid' and variety='$itemid' order by tid desc ") or die(mysqli_error($link));
}
else
{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' order by tid desc ") or die(mysqli_error($link));
}
$row_arr_home3=mysqli_fetch_array($sql_arr_home2);

$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where tid ='".$row_arr_home3[0]."' and sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' order by spdate asc ") or die(mysqli_error($link));
while($row_arr_home=mysqli_fetch_array($sql_arr_home3))
{	

	$flgg=0;
	$trdate=$row_arr_home['spdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	if($trdate=="" || $trdate=="--")$trdate="";


	$trdate1=$row_arr_home['srdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	if($trdate1=="" || $trdate1=="--")$trdate1="";
	
	$trdatet=$row_arr_home['testdate'];
	$tryeart=substr($trdatet,0,4);
	$trmontht=substr($trdatet,5,2);
	$trdayt=substr($trdatet,8,2);
	$trdatet=$trdayt."-".$trmontht."-".$tryeart;
	
	if($trdatet=="" || $trdatet=="--")$trdatet="";
			
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	 $lotno=$row_arr_home['lotno'];
	$sstatus=$row_arr_home['qcstatus'];
	if($sstatus=="")$sstatus="UT";
	
	$slqty=0; $slups=0;
	 $sql_sloc=mysqli_query($link,"select lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='$lotno' and lotldg_trdate<='".$sdate."'  group by lotldg_subbinid order by lotldg_lotno") or die(mysqli_error($link));
	 $tot=mysqli_num_rows($sql_sloc);
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$sql_sloc1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_sloc['lotldg_subbinid']."' and lotldg_lotno='$lotno' and lotldg_trdate<='".$sdate."' order by lotldg_lotno ") or die(mysqli_error($link));
	$row_sloc1=mysqli_fetch_array($sql_sloc1);
	$tot1=mysqli_num_rows($sql_sloc1);
	if($tot1 > 0)
	{
	$sql_sloc2=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_sloc1[0]."'") or die(mysqli_error($link));
	while($row_sloc2=mysqli_fetch_array($sql_sloc2))
	{
	$slqty=$slqty+$row_sloc2['lotldg_balqty'];
	$slups=$slups+$row_sloc2['lotldg_balbags'];
	}
	}
	}
	

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		
		}
		else
		{
		$crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
		}
		
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_arr_home['qc'];
		}
		else
		{
		$qc=$row_arr_home['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['got'];
		}
		else
		{
		$got=$row_arr_home['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		
		
	
	$dt=""; $dt1=date("Y-m-d"); 
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 	$quer333=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
		$row313=mysqli_fetch_array($quer333);
		$m= date("m");
		$de= date("d");
		$y= date("Y");
		$dt=$row313['expdt'];
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
	 }
	 else
	 {
	  $vv=$tt;
		$m= date("m");
		$de= date("d");
		$y= date("Y");
		$dt=$rowvv['expdt'];
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
	  }
	if($dt==0) $dt="";
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	
	
$rflg=0;$dt2="";$dt22="";
if($qcti=="rt")
{
	$rflg=1; 
	if($dt1!="")
	{
		$m=$trmontht;
		$de=$trdayt;
		$y=$tryeart;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
		}
		else
		$dt2="";
	}
	else
	$dt2="";
}
else if($qcti=="ut" && $rvalt=="all")
{
		$rflg=1; 
		if($dt1!="")
		{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
}
else if($qcti=="ut" && $rvalt=="edorm")
{
		if($dt1!="")
		{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
	if($dt2!="" && $row_arr_home['spdate']<=$dt2)
	{ 
	$rflg=1;
	}
}
else if($qcti=="both" && $rvalt=="all")
{
	if($row_arr_home['qcstatus']=="RT")
	{
		$rflg=1; 
		if($dt1!="")
		{
				$m=$trmontht;
				$de=$trdayt;
				$y=$tryeart;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
	}
	else
	{
		$rflg=1; 
		if($dt1!="")
		{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
	}
}
else if($qcti=="both" && $rvalt=="edorm")
{ 
	if($row_arr_home['qcstatus']=="RT")
	{
		
			if($dt1!="")
			{ 
				$m=$trmontht;
				$de=$trdayt;
				$y=$tryeart;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
			}
			else
			$dt2="";
		if($dt2!="" && $row_arr_home['testdate']<=$dt2)
		{ 
		$rflg=1;	
		} 
	}
	else
	{
		
			if($dt1!="")
			{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
			}
			else
			$dt2="";
			
		if($dt2!="" && $row_arr_home['spdate']<=$dt2)
		{
		$rflg=1;	
		}
	}
}
$d=date("Y-m-d");
if(($trdate=="" || $trdate=="--") || ($rvalt=="edorm" && $dt2>=$d))$rflg=0;
	$trdate12=$dt2;
	$tryear12=substr($trdate12,0,4);
	$trmonth12=substr($trdate12,5,2);
	$trday12=substr($trdate12,8,2);
	$trdate12=$trday12."-".$trmonth12."-".$tryear12;
	
	if($trdate12=="" || $trdate12=="--")$trdate12="";
	if($trdate=="")$trdate12="";
			
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code']; $qc1=$row_arr_home['sampleno'];
$cropp=$row31['cropname'];
$smpno=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$qc1);
$lotno1=$row_arr_home['oldlot'];
if($slqty<=0) $slqty=0;
if($slqty==0) $slups=0;

if($sstatus=="UT" && $trdatet!="")
$flgg++;
//if($tot_arr_home > 0)
{ 
if($rflg > 0)
{
if($flgg==0)			
{
$data1[$d]=array($d,$cropp,$vv,$lotno1,$slups,$slqty,$sstatus,$trdate1,$trdate,$trdate12,$smpno); 
$d++;
}
}
}
}
}
# coading ends here............
/*echo implode($datahead1) ;
echo "\n";*/

echo implode($datahead2) ;
echo "\n";

/*echo implode("\t", $datatitle1) ;
echo "\n";*/
/*echo implode("\t", $datatitle3) ;
echo "\n";*/

echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;