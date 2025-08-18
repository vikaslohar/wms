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
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail')";

	if($crop!="ALL")
	{	
	$qry.="and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	$dat=date("d-m-Y");		
	
	$dh="Crop_Variety_wise_Substandard_Pack_Seed_Report ".$dat;
	$datahead = array("Crop Variety wise Substandard Pack Seed Report  ".$dat);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

		$cnt=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail')") or die(mysqli_error($link));
 $tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	
	
		$d=1;
	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_rr['lotldg_variety'];
		}
				$ccnt=0;
$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."'  and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail') and balqty > 0 group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotno='".$row_arhome['lotno']."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail')  and balqty > 0 group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and lotno='".$row_arhome['lotno']."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_is1[0]."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail') and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$ccnt++;
}
}
}
//echo $ccnt;
if($ccnt > 0)
{
$totalbags=0; $totalqty=0;
		$datahead1[$cnt] = array("Crop:$crop     Variety:$variety");
	$datahead2[$cnt] = array("#","Lot No.","Qty","Qc Status","Moisture %","Germination %","DOT","GOT Status","Genetic Purity %","DOGR","Seed Status"); 

	if($slchk=="yes") 
	{	
	array_push($datahead2[$cnt],"SLOC"); 
	}
	
 
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail')  and balqty > 0 group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt1=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr="";
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotno='".$row_arr_home['lotno']."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail')  and balqty > 0 group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and lotldg_sstage='Pack' and (lotldg_qc='Fail' OR lotldg_got='Fail') and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_issuetbl['lotdgp_id']."<BR>";
  $cnt1++;
	$totqty=$totqty+$row_issuetbl['balqty']; 
	//$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$genpp=$row_issuetbl['lotldg_genpurity']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	$lotn=$row_issuetbl['lotno']; 
	if($row_issuetbl['lotldg_srflg'] > 0)
	{
		if($totsst!="")$totsst=$totsst."/"."S";
		else
		$totsst="S";
	}
	if($txtdot=="")
	{
	$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
								$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
	}
	
	if($dogr=="")
	{
	$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
								$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
	}
	
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";
	
	if($dogr=="00-00-0000" || $dogr=="--")
	$dogr="";
	if($totgemp==0 || $totgemp=="") $totgemp="";
	
	if($genpp=="0.00" || $genpp=="NULL")$genpp="";
	


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

//$slups=$row_issuetbl['lotldg_balbags'];
 $slqty=$row_issuetbl['balqty'];
// $aq1=explode(".",$slups);
//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
//$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
}
}
}
//echo $cnt;
if($cnt1>0)
{
$totalqty=$totalqty+$totqty; 
//$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";

$datahead2[$cnt] = array("#","Lot No.","Qty","SLOC","Qc Status","Moisture %","Germination %","DOT","GOT Status","Genetic Purity %","DOGR","Seed Status"); 

$data1[$cnt][$d]=array($d,$lotn,$totqty,$sloc,$totqc,$totmost,$totgemp,$txtdot,$totgot,$genpp,$dogr,$totsst);
$d++;
}
$datahead3[$cnt] = array("","Total",$totalqty,"","","","","","","","",""); 
}
//}
$cnt++;
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
 	echo implode("\t", $datahead3[$i]) ;
	echo "\n";
}
	