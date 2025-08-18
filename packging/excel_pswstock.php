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
	$slchk = $_REQUEST['slchk'];
	$txtupsdc = $_REQUEST['txtupsdc'];
	$txtqcsts = $_REQUEST['txtqcsts'];
		
	$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where balqty > 0 ";

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
	if($txtupsdc!="ALL")
	{	
		$qry.=" and packtype='$txtupsdc' ";
	}
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	$dat=date("d-m-Y");		
	
	$dh="Pack_Seed_Stock_Report ".$dat;
	$datahead = array("Pack Seed Stock Report  ".$dat);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

		$cnt=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

if($txtupsdc!="ALL")
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' order by lotdgp_id desc") or die(mysqli_error($link));
}
else
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' order by lotdgp_id desc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

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
if($txtupsdc!="ALL")
{
$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$txtupsdc."' order by packtype asc") or die(mysqli_error($link));
}
else
{
$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' order by packtype asc") or die(mysqli_error($link));
}
$tot_rr24=mysqli_num_rows($sql_rr24);
while($row_rr24=mysqli_fetch_array($sql_rr24))
{
		
$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr24['packtype']."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row_arhome['lotno']."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr24['packtype']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and lotno='".$row_arhome['lotno']."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr24['packtype']."'  order by lotdgp_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
$row_istblp=mysqli_fetch_array($sql_istbl);

if($row_istblp['balqty'] > 0)
{
$ccnt++;
}
}
}
}

if($ccnt > 0)
{
$totalbags=0; $totalqty=0;
	$datahead1[$cnt] = array("Crop:$crop     Variety:$variety     UPS:$txtupsdc     Pack QC Status:$txtqcsts");
	$datahead2[$cnt] = array("#","Lot No.","Size","NoMP","Qty","Pack QC status","Pack DoT","Latest QC status","Latest DoT","Germ %","DoV","Validity (in Days)","SLOC"); 
	
 
if($txtupsdc!="ALL")
{
$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$txtupsdc."' order by packtype asc") or die(mysqli_error($link));
}
else
{
$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' order by packtype asc") or die(mysqli_error($link));
}
$tot_rr2=mysqli_num_rows($sql_rr2);
while($row_rr2=mysqli_fetch_array($sql_rr2))
{
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0; $cnt=0; $oqcsts=""; $odot=""; $txtdov=""; $validity="";
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $txtdot="";	$sloc="";
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row_arr_home['lotno']."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."'  order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
  	if($row_issuetbl['balqty']>0)
	{
		$cnt++;
		$totqty=$totqty+$row_issuetbl['balqty']; 
		$totnob=$totnob+$row_issuetbl['balnomp']; 
		if($totnob<0) $totnob=0;
		if($totqty<0) $totqty=0;
	
		$totqc=$row_issuetbl['lotldg_qc']; 
		$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
		$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
		$totmost=$row_issuetbl['lotldg_moisture']; 
		$totgemp=$row_issuetbl['lotldg_gemp']; 
		$totsst=$row_issuetbl['lotldg_sstatus']; 
		
		$upspacktype=$row_issuetbl['packtype'];
		$upspacktype=trim($upspacktype);
		$packtp=explode(" ",$upspacktype);
		$packt=trim($packtp[0]);
		$packtyp=explode(".",$packt); 
					
		if($packtyp[1]=="000")
		$upssize=$packtyp[0]." ".$packtp[1];
		else
		$upssize=$packtp[0]." ".$packtp[1];
		
		if($row_issuetbl['lotldg_srflg'] > 0)
		{
			if($totsst!="")$totsst=$totsst."/"."S";
			else
			$totsst="S";
		}
		if($txtdot=="")
		{
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$txtdot=$rday."-".$rmonth."-".$ryear;
		}
		if($txtdot=="00-00-0000" || $txtdot=="--")$txtdot="";
		
		if($txtdov=="")
		{
			$rdate=$row_issuetbl['lotldg_valupto'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$txtdov=$rday."-".$rmonth."-".$ryear;
		}
		if($txtdov=="00-00-0000" || $txtdov=="--")$txtdov="";
		
		if($validity=="")
		{
			$diff = (strtotime($row_issuetbl['lotldg_valupto']) - strtotime($dt));
			$validity = floor($diff / (60*60*24));
		}
		
		if($totgemp==0 || $totgemp=="") $totgemp="";
		
	
	
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$slups=$row_issuetbl['balnomp'];
		$slqty=$row_issuetbl['balqty'];
		$aq1=explode(".",$slups);
		if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
		
		$an1=explode(".",$slqty);
		if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
		$slups=$ac1;
		$slqty=$acn1;
		if($slups<0) $slups=0;
		if($slqty<0) $slqty=0;
			
		if($sloc!="")
		$sloc=$sloc.",".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
		else
		$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
	}
}
}
}

$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipsub_plotno='".$row_arr_home['lotno']."' ") or die(mysqli_error($link));
$tot_pnp=mysqli_num_rows($sql_pnp);
$row_pnp=mysqli_fetch_array($sql_pnp);
$oqcsts=$row_pnp['pnpslipsub_qcdttype'];
if($oqcsts=="DOT" || $oqcsts=="DoT")$oqcsts="OK";

$rdate=$row_pnp['pnpslipsub_qcdot'];
$ryear=substr($rdate,0,4);
$rmonth=substr($rdate,5,2);
$rday=substr($rdate,8,2);
$odot=$rday."-".$rmonth."-".$ryear;

$sql_pnp24=mysqli_query($link,"Select MAX(rv_id) from tbl_revalidate where plantcode='$plantcode' and rv_newlot='".$row_arr_home['lotno']."' ") or die(mysqli_error($link));
$tot_pnp24=mysqli_num_rows($sql_pnp24);
$row_pnp24=mysqli_fetch_array($sql_pnp24);

$sql_pnp2=mysqli_query($link,"Select * from tbl_revalidate where plantcode='$plantcode' and rv_newlot='".$row_arr_home['lotno']."' and rv_id='".$row_pnp24[0]."' ") or die(mysqli_error($link));
$tot_pnp2=mysqli_num_rows($sql_pnp2);
$row_pnp2=mysqli_fetch_array($sql_pnp2);
if($tot_pnp2>0)
{
	$oqcsts="RV";
	
	$rdate=$row_pnp2['rv_dot'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$odot=$rday."-".$rmonth."-".$ryear;
}	
if($odot=="00-00-0000" || $odot=="--")	$odot="";

if($txtqcsts!="Both")
{
	if($txtqcsts=="DoT" && $oqcsts=="DoSF")$cnt=0;
	if($txtqcsts=="DoSF" && ($oqcsts=="DOT" || $oqcsts=="DoT"))$cnt=0;
	if($txtqcsts=="DoSF" && $oqcsts=="RV")$cnt=0;
}
//echo $cnt;
if($cnt>0)
{
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($totqc=="RT"){$txtdot=""; $totgemp="";}
if($txtdov=="")$validity="";
$lotn=$row_arr_home['lotno'];
$datahead2[$cnt] = array("#","Lot No.","Size","NoMP","Qty","Pack QC status","Pack DoT","Latest QC status","Latest DoT","Germ %","DoV","Validity (in Days)","SLOC"); 
$data1[$cnt][$d]=array($d,$lotn,$upssize,$totnob,$totqty,$oqcsts,$odot,$totqc,$txtdot,$totgemp,$txtdov,$validity,$sloc); 
//array_push($data1[$cnt][$d],$totqc,$totmost,$totgemp,$txtdot,$totgot,$totsst);
$d++;
}
if($ccnt > 0)
{
$datahead3[$cnt] = array("","","Total",$totalbags,$totalqty,"","","","","","","",""); 
}
}

}
}
}$cnt++;
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
	