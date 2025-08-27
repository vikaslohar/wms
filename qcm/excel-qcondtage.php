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
	
	 //$pid = $_GET['pid'];	
	 $edate = $_REQUEST['edate'];
	 $itemid = $_REQUEST['txtcrop'];
	 $vv= $_REQUEST['txtvariety'];
	 $result = $_REQUEST['result'];
 	 $dotage = $_REQUEST['dotage'];
	 $seedstage = $_REQUEST['sstage'];
	 $durtyp = $_REQUEST['durtyp'];
	 $fillagetyp = $_REQUEST['fillagetyp'];
	 $totdays = $_REQUEST['totdays'];
	
	$t=explode("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	
	$reslt="";
 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 
	
	$qry="select distinct lotldg_variety from tbl_lot_ldg where lotldg_qctestdate<='".$edate."' and lotldg_crop='".$itemid."' ";
	
	
	if($vv!="ALL")
	{
		$qry.=" and lotldg_variety='".$vv."' ";
	}
	if($result!="ALL")	
	{
		$qry.=" and lotldg_qc='".$result."' ";
		$reslt=" and lotldg_qc='".$result."' ";
	}
	if($seedstage!="ALL")
	{
		$qry.=" and lotldg_sstage='".$seedstage."' ";
		$reslt=" and lotldg_sstage='".$seedstage."' ";
	}
	$qry.=" order by lotldg_variety asc,lotldg_qctestdate asc ";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	if($durtyp=="dsel")
	{
		$durations="ALL";
		if($dotage=="less45")
		$durations="Less than 45 days";
		if($dotage=="45-90")
		$durations="In-between 45 to 90 days";
		if($dotage=="more90")
		$durations="More than 90 days";
	}
	else if($durtyp=="dfill")
	{
		if($fillagetyp=="less")
		$durations="Less than $totdays days";
		if($fillagetyp=="equalto")
		$durations="Equal to $totdays days";
		if($fillagetyp=="more")
		$durations="More than $totdays days";
	}
	else
	{
		$durations="";
	}
 	 
	$dh="QC_Test_Ageing_Status_Report:".$tlp."_As_on_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead1 = array("QC Test Ageing Status Report As on Date: ",$_REQUEST['edate']);
	$datahead6 = array("Duration since last QC Test: ",$durations);
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
 $cnt24=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
	$row_dept=mysqli_fetch_array($quer2);
	$cropname=$row_dept['cropname'];
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home1['lotldg_variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	$tt=$rowvv['popularname'];
	$tot=mysqli_num_rows($quer3);	
	if($tot==0)
	{
		$vvrt=$vv;
	}
	else
	{
		$vvrt=$tt;
	}
	$cont=0;
	$sql_arr_home244=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_qctestdate<='$edate' and lotldg_crop='".$itemid."'  and lotldg_variety='".$row_arr_home1['lotldg_variety']."' $reslt order by lotldg_variety asc, lotldg_qctestdate asc ") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_arr_home244);
	while($row_arr_home244=mysqli_fetch_array($sql_arr_home244))
	{
		//if($seedstage!="Pack")
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home244['lotldg_lotno']."' order by lotldg_subbinid") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{$total_tbl=0;
				$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home244['lotldg_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
				
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 ")or die(mysqli_error($link));
				$total_tbl=mysqli_num_rows($sql1);
				if($total_tbl > 0)
				{
					$flg=0;$qty=0;
					$row_tbl_sub=mysqli_fetch_array($sql1);
					$qty=$row_tbl_sub['lotldg_balqty'];
					$qcresult=$row_tbl_sub['lotldg_qc'];
					if($result!="ALL" && $result!=$qcresult)$flg++;	
					if($qcresult=="NUT")$flg++;	
					if(($qcresult=="OK") && $qty==0)$flg++;
					if($flg==0){$cont++;}
					
				}
			}
		}
		//else
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$row_arr_home244['lotldg_lotno']."' order by subbinid") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{$total_tbl=0;
				$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home244['lotldg_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
				
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 ")or die(mysqli_error($link));
				$total_tbl=mysqli_num_rows($sql1);
				if($total_tbl > 0)
				{
					$flg=0;$qty=0;
					$row_tbl_sub=mysqli_fetch_array($sql1);
					$qty=$row_tbl_sub['balqty'];
					$qcresult=$row_tbl_sub['lotldg_qc'];
					if($result!="ALL" && $result!=$qcresult)$flg++;	
					if($qcresult=="NUT")$flg++;	
					if(($qcresult=="OK") && $qty==0)$flg++;
					if($flg==0){$cont++;}
				}
			}
		}
		
	}

if($cont > 0)
{

 	$datahead2[$cnt24] = array("Crop - " ,$cropname , " "," ", " ","Variety - " ,$vvrt);
	 $datatitle2[$cnt24] = array("#","Lot No. ","NoB","Qty","Germination %","DOT","No. of Days since DoT","QC Status","DOGR","GOT Status","SLOC");
$d=1;

$sql_arr_home2=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_qctestdate<='$edate' and lotldg_crop='".$itemid."'  and lotldg_variety='".$row_arr_home1['lotldg_variety']."' $reslt order by lotldg_variety asc, lotldg_qctestdate asc ") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{

$sql_arr_home3=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where lotldg_qctestdate<='".$edate."' and lotldg_crop='".$itemid."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_lotno='".$row_arr_home2['lotldg_lotno']."' $reslt order by lotldg_variety asc, lotldg_qctestdate asc  ") or die(mysqli_error($link));
$row_arr_home3=mysqli_fetch_array($sql_arr_home3);

$sql_arr_home=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_arr_home3[0]."'") or die(mysqli_error($link));

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_qctestdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['lotldg_id'];
	
//echo $row_arr_home2['lotno']."<br />";	
	
	$flg=0;		
	$sups=0; $sqty=0; $sstage=""; $sloc="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home2['lotldg_lotno']."'  order by lotldg_subbinid") or die(mysqli_error($link));
if(	 $t=mysqli_num_rows($sql_tbl_sub1) > 0)
{
	while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{	 
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home2['lotldg_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo "  ".$row_tbl1[0]."  ";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);

$slups=0; $slqty=0;
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$row_tbl_sub['lotldg_balbags'];
	$slqty=$row_tbl_sub['lotldg_balqty'];
	
	$sups=$sups+$row_tbl_sub['lotldg_balbags'];
	$sqty=$sqty+$row_tbl_sub['lotldg_balqty'];
	
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	if($row_tbl_sub['lotldg_got']!="" && $row_tbl_sub['lotldg_got']!="NULL" && $row_tbl_sub['lotldg_got']!=" ")
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	else
	$gotresult=$gorr[0]." ".$gorr[1];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_tbl_sub['lotldg_balbags'];
 $slqty=$row_tbl_sub['lotldg_balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

$lotno=$row_arr_home['lotldg_lotno'];
$sstage=$row_arr_home['lotldg_sstage'];
if($got=="")
$got=$row_arr_home['lotldg_moisture'];
if($stage=="")
$stage=$row_arr_home['lotldg_gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['lotldg_qc'];

//echo $slups;


		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotldg_crop'];
		}
		else
		{
		 $crop=$row_arr_home['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotldg_variety'];
		}
		else
		{
		$variety=$row_arr_home['lotldg_variety'];	
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
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
}	
}
}
else
{
	$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$row_arr_home2['lotldg_lotno']."'  order by subbinid") or die(mysqli_error($link));
	while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{	 
	
	$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home2['lotldg_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo "  ".$row_tbl1[0]."  ";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);

$slups=0; $slqty=0;
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$row_tbl_sub['balnop'];
	$slqty=$row_tbl_sub['balqty'];
	
	$sups=$sups+$row_tbl_sub['balnop'];
	$sqty=$sqty+$row_tbl_sub['balqty'];
	
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	if($row_tbl_sub['lotldg_got']!="" && $row_tbl_sub['lotldg_got']!="NULL" && $row_tbl_sub['lotldg_got']!=" ")
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	else
	$gotresult=$gorr[0]." ".$gorr[1];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['binid']."' and whid='".$row_tbl_sub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['subbinid']."' and binid='".$row_tbl_sub['binid']."' and whid='".$row_tbl_sub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_tbl_sub['balnop'];
 $slqty=$row_tbl_sub['balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

$lotno=$row_arr_home['lotldg_lotno'];
$sstage=$row_arr_home['trstage'];
if($got=="")
$got=$row_arr_home['lotldg_moisture'];
if($stage=="")
$stage=$row_arr_home['lotldg_gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['lotldg_qc'];

//echo $slups;


		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotldg_crop'];
		}
		else
		{
		 $crop=$row_arr_home['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotldg_variety'];
		}
		else
		{
		$variety=$row_arr_home['lotldg_variety'];	
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
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
}	
}
}
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['lotldg_variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['lotldg_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  

    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($result!="ALL" && $result!=$qcresult)$flg++;	
if($qcresult=="NUT")$flg++;	
if(($qcresult=="OK" || $qcresult=="Fail") && $qty==0)$flg++;

$trdate6=explode("-", $edate);
$tryear=$trdate6[0];
$trmonth=$trdate6[1];
$trday=$trdate6[2];
$trdate240=$tryear."-".$trmonth."-".$trday;

if($durtyp=="dfill")
{
	if($fillagetyp=="less")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']<$dt2)$flg++;
		}
	}
	else if($fillagetyp=="equalto")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']!=$dt2)$flg++;
		}
	}
	else if($fillagetyp=="more")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']>$dt2)$flg++;
		}
	}
	else
	{
	}
}
else
{
	if($dotage!="ALL" && $dotage=="less45")
	{
	$dt=45;
	if($trdate!="")
	{
	$m=$trmonth;
	$de=$trday;
	$y=$tryear;
	$dt22=$dt;
	if($dt!="")
	{
	for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
	}
	else
	$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
	if($row_arr_home['lotldg_qctestdate']<=$dt2)$flg++;
	}
	}
	else if($dotage!="ALL" && $dotage=="45-90")
	{
		$dt=45;
		$dt6=90;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		if($trdate!="")
		{
			$trdate5=explode("-", $edate);
			$tryear5=$trdate5[0];
			$trmonth5=$trdate5[1];
			$trday5=$trdate5[2];
			
			$m5=$trmonth5;
			$de5=$trday5;
			$y5=$tryear5;
			$dt222=$dt6;
			if($dt6!="")
			{
				for($j=1; $j<$dt222; $j++) { $dt24=date('Y-m-d',mktime(0,0,0,$m5,($de5-$j),$y5)); } 
			}
			else
			$dt24="";
		}
		//echo $dt2;
		if($dt2!="" && $dt24!="")
		{
			if($row_arr_home['lotldg_qctestdate']>=$dt2 || $row_arr_home['lotldg_qctestdate']<$dt24)$flg++;
		}
	}
	else if($dotage!="ALL" && $dotage=="more90")
	{
		$dt=90;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']>=$dt2)$flg++;
		}
	}
	else
	{
	}
}
//echo $dt2;
$diff = abs(strtotime($trdate240) - strtotime($row_arr_home['lotldg_qctestdate']));

//$years = floor($diff / (365*60*60*24));
//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor($diff / (60*60*24));

//printf("%d days\n", $days);
//echo $row_arr_home['lotldg_qctestdate']."  -  ".$dt2."  -  ".$dt24."<br />";
$days=$days;
$gotres=explode(" ", $gotresult);
if($gotres[1]=="Fail")$flg=1;	
$cropp=$row31['cropname'];
if($tot_arr_home > 0)			
{
if($flg==0)
{
$data1[$cnt24][$d]=array($d,$lotno,$bags,$qty,$stage,$trdate,$days,$qcresult,$trdate1,$gotresult,$sloc); 
$d++;
//}
}
}
}
}
$cnt24++;
}
}
//},$per,$sstatus
//echo $cnt24;

# coading ends here............
/**/
echo implode($datahead1) ;
echo "\n";

echo implode($datahead6) ;
echo "\n";
for($i=1; $i<$cnt24; $i++)
{
echo implode($datahead2[$i]) ;
echo "\n";
echo implode("\t", $datatitle2[$i]) ;
echo "\n";
foreach($data1[$i] as $row1)
{ 
 	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}
}
#echo implode("\t", $datatitle3) ;