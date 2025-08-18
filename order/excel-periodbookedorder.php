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
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['txtordertyp'])) { $txtordertyp = $_REQUEST['txtordertyp']; }

	$sts="";
	
	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
	$tdate2=explode("-",$edate);
	$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];

$states=$txtstatesl; $loca="ALL"; $partee="ALL"; $crp="ALL"; $ver="ALL";
if($txtstatesl!="ALL")
{
	if($txtlocationsl!="ALL")
	{
		$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
		$noti = mysqli_fetch_array($sql_mon);
		$loca=$noti['productionlocation'];
	}
	if($txtparty!="ALL")
	{
		$sql_m=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."' order by business_name")or die(mysqli_error($link));
		$notic = mysqli_fetch_array($sql_m);
		$partee=$notic['business_name'];
	}
}	

$blank=""; $statearr=""; $locarr=""; $partyarr=""; $statearrc=""; $locarrc=""; $partyarrc=""; $crparr=""; $ortype="ALL"; $locarreb="";

if($txtordertyp=="sales")
{
	$ortype="Sales";
}
else if($txtordertyp=="branch")
{
	$ortype="Branch and C&F";
}
else if($txtordertyp=="tdf")
{
	$ortype="TDF";
}
else
{
	$ortype="ALL";
}
		
	$dh="Periodical_Booked_Order_Report_Period_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array("Periodical Booked Order Report");
	$filename=$dh.".xls";  
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");


	
		$datahead1= array("Period From ".$_REQUEST['sdate']." To ".$_REQUEST['edate']);
		$datahead2= array("Party Type ".$ortype." Party ".$partee);
		$datahead3= array("State ".$states." Location ".$loca);
		$datahead4= array("#","Date","Order No","Party Order Ref. No.","Party Type","Party Name","Location","State","Consignee Name/Location","Total Order Qty"); 
		
		$d=1;
$omid="";

$s="select distinct orderm_id from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and orderm_tflag=1 $sts ";

if($txtordertyp=="sales")
{
$s.=" and orderm_party_type IN ('Dealer','Bulk','Export Buyer') ";
}
else if($txtordertyp=="branch")
{
$s.=" and orderm_party_type IN ('C&F','Branch') ";
}
else if($txtordertyp=="tdf")
{
$s.=" and orderm_party_type IN ('TDF - Individual','') ";
}
else
{
$s.=" ";
}
$s.=" order by orderm_id desc ";
$sql_arrhome=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arrhome=mysqli_num_rows($sql_arrhome);

if($tot_arrhome > 0)
{ 
while($row_arrhome=mysqli_fetch_array($sql_arrhome))
{
if($omid!="")
$omid=$omid.", ".$row_arrhome['orderm_id'];
else
$omid=$row_arrhome['orderm_id'];
}
//echo $omid."<br />";
$omid1 = implode(",",array_values(array_unique(explode(",",$omid))));
$ormmid=explode(",",$omid1);
foreach($ormmid as $ormid)
{
if($ormid<>"")
{
if($txtstatesl=="ALL")
{
$s="select * from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
else
{
$s="select * from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='".$txtstatesl."' OR orderm_partystate='".$txtstatesl."' OR orderm_country='$txtstatesl') and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
if($txtlocationsl!="ALL")
{
	$s.=" and orderm_location='".$txtlocationsl."'";
}
$sql_arr_home=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home > 0)
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	$orno=""; $party="";  $partyflg=0; $optype='';
	
	if($row_arr_home['orderm_party_type']=='Dealer' || $row_arr_home['orderm_party_type']=='Bulk' || $row_arr_home['orderm_party_type']=='Export Buyer')
	$optyp='SON';
	else if($row_arr_home['orderm_party_type']=='C&F' || $row_arr_home['orderm_party_type']=='Branch')
	$optyp='TON';
	else if($row_arr_home['orderm_party_type']=='TDF - Individual' || $row_arr_home['orderm_party_type']=='' || $row_arr_home['orderm_party_type']==' ')
	$optyp='DON';
	else
	$optyp='';
	
	
	$partyid=$row_arr_home['orderm_party'];
	
	if($txtparty!="ALL" && $row_arr_home['orderm_party']==$txtparty)
	{
		$partyid=$txtparty;
	}
	else
	{
		$partyflg++;
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party'] > 0)
	$party=$row3['business_name'];
	else
	$party=$row_arr_home['orderm_partyname'];
	
	$partytype=$row_arr_home['orderm_party_type'];
	if($partytype=="")$partytype="TDF - Individual";
	//echo $row_arr_home['orderm_consigneeapp'];
	
	$orno=$row_arr_home['orderm_porderno'];
	$porrefno=$row_arr_home['orderm_partyrefno'];
	
$ssub="select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='$ormid' order by order_sub_crop, order_sub_variety";
$sql_subor=mysqli_query($link,$ssub) or die(mysqli_error($link));
$ttoott=mysqli_num_rows($sql_subor);
$flg=0; $orstatus=""; $oqty=0; $bqty=0; $upsize=""; $oqty1=""; $bqty1=""; $size1=""; $c=0; $oqt=0;
while($row_subor=mysqli_fetch_array($sql_subor))
{	
	$sqlsubsub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_arr_home['orderm_id']."' and order_sub_id='".$row_subor['order_sub_id']."' group by order_sub_sub_ups") or die(mysqli_error($link));
	while($rowsubsub=mysqli_fetch_array($sqlsubsub))
	{
		$oqty=$rowsubsub['order_sub_sub_qty'];
		$bqty=$rowsubsub['order_sub_subbal_qty'];

		if($bqty<0)	$bqty=0;
		if($row_subor['order_sub_totbal_qty']<=0)
		{$c=0;	$bqty=0;}
		
		if($oqty1!="") $oqty1=$oqty1+$oqty;
		else $oqty1=$oqty;
		
		if($bqty1!="") $bqty1=$bqty1+$bqty;
		else $bqty1=$bqty;
		
		$c=$c+$bqty;
		$oqt=$oqt+$oqty;
	}


if($txtstatesl=="ALL")
{
	if($row_arr_home['orderm_locstate']!="")
	$statee=$row_arr_home['orderm_locstate'];
	else
	$statee=$row_arr_home['orderm_partystate'];
}
else
{
	$statee=$txtstatesl;
}

if($row_arr_home['orderm_party_type']=="Export Buyer")
$statee=$row_arr_home['orderm_country'];

$locflg=0;
$locarr=explode(",",$locarr);
if($txtlocationsl=="ALL")
{
	if($row_arr_home['orderm_location']!="")
	$valoc=$row_arr_home['orderm_location'];
	else
	$valoc=$row_arr_home['orderm_partycity'];
}
else
{
	$valoc=$txtlocationsl;
}

if($row_arr_home['orderm_party_type']=="Export Buyer")
$valoc=$row3['city'];

if($oqty<=0)$locflg++;

if($txtparty!="ALL" && $partyflg>0)
$locflg=1;

if($locflg>0) 
$flg=1;
else
$flg=0;

	$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$valoc."' order by productionlocation")or die(mysqli_error($link));
	$noti = mysqli_fetch_array($sql_mon);
	if($tloc=mysqli_num_rows($sql_mon) > 0)
 	$loca=$noti['productionlocation'];
	else
	$loca=$valoc;

	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_subor['order_sub_crop']."' order by cropname Asc") or die(mysqli_error($link)); 
	$noticii = mysqli_fetch_array($quer);
	$crp1=$noticii['cropname'];

	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_subor['order_sub_variety']."'  order by popularname")or die(mysqli_error($link));
	$notici = mysqli_fetch_array($sql_mont);
	$ver1=$notici['popularname'];
	
	$consignee="";
	if($row_arr_home['orderm_consigneeapp']=="Yes")
	{
		$consignee=$row_arr_home['orderm_consigneename']."/".$row_arr_home['orderm_concity'];
	}
	else
	{
		$consignee=$party."/".$statee;
	}
}	

if($bqty<0)	$bqty=0;
if($flg==0) 
{
	$data1[$d]=array($d,$trdate,$orno,$porrefno,$partytype,$party,$loca,$statee,$consignee,$oqty1); 
	$d++;
}

}
}
}
}
}

echo implode($datahead) ;
echo "\n";
echo implode($datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
echo implode("\t", $datahead4) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}