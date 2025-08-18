<?php
ob_start();
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
	if(isset($_REQUEST['txtcrop'])) { $txtcrop = $_REQUEST['txtcrop']; }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety = $_REQUEST['txtvariety']; }
	if(isset($_REQUEST['txtups'])) { $txtups = $_REQUEST['txtups']; }
	if(isset($_REQUEST['txtordertyp'])) { $txtordertyp = $_REQUEST['txtordertyp']; }
	if(isset($_REQUEST['txtordersts'])) { $txtordersts = $_REQUEST['txtordersts']; }

	$sts="";
	if($txtordersts=="pending") $sts=" and orderm_dispatchflag!=1 and orderm_supflag=0 and orderm_cancelflag=0 ";
	if($txtordersts=="dispatch") $sts=" and orderm_dispatchflag=1 ";
	if($txtordersts=="suspend") $sts=" and orderm_supflag=1 ";
	if($txtordersts=="cancel") $sts=" and orderm_cancelflag=1 ";
	
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
if($txtcrop!="ALL")
{
	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
	$noticii = mysqli_fetch_array($quer);
	$crp=$noticii['cropname'];
}
if($txtvariety!="ALL")
{
	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' and actstatus='Active' order by popularname")or die(mysqli_error($link));

	$notici = mysqli_fetch_array($sql_mont);
	$ver=$notici['popularname'];
}


$blank=""; $statearr=""; $locarr=""; $partyarr=""; $statearrc=""; $locarrc=""; $partyarrc=""; $crparr=""; $ortype="ALL"; $locarreb="";

if($txtordertyp=="sales")
{
$ortype="Order Sales";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."'  and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."'  and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order Sales'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="stock")
{
$ortype="Order Stock Transfer";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="salesandstock")
{
$ortype="Order Sales and Order Stock Transfer";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="tdf")
{
$ortype="Order TDF";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order TDF' order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
}
else
{
$ortype="ALL";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' order by orderm_date asc ") or die(mysqli_error($link));
}

		
	$dh="Booked_Order_Status_Report_Period_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array("Booked Order Status Report");
	$filename=$dh.".xls";  
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");


while($rowstate=mysqli_fetch_array($sqlstate))
{
if($statearr!="")
$statearr=$statearr.",".$rowstate['orderm_locstate'];
else
$statearr=$rowstate['orderm_locstate'];
}

while($rowstate1=mysqli_fetch_array($sqlstate1))
{
if($statearr!="")
$statearr=$statearr.",".$rowstate1['orderm_partystate'];
else
$statearr=$rowstate1['orderm_partystate'];
}


while($rowloc=mysqli_fetch_array($sqlloc))
{
if($locarr!="")
$locarr=$locarr.",".$rowloc['orderm_location'];
else
$locarr=$rowloc['orderm_location'];
}

while($rowloc1=mysqli_fetch_array($sqlloc1))
{
if($locarrc!="")
$locarrc=$locarrc.",".$rowloc1['orderm_partycity'];
else
$locarrc=$rowloc1['orderm_partycity'];
}


while($rowloc2=mysqli_fetch_array($sqlloc2))
{
if($statearr!="")
$statearr=$statearr.",".$rowloc2['orderm_country'];
else
$statearr=$rowloc2['orderm_country'];
}

while($rowpty=mysqli_fetch_array($sqlpty))
{
if($partyarr!="")
$partyarr=$partyarr.",".$rowpty['orderm_party'];
else
$partyarr=$rowpty['orderm_party'];
}

while($rowpty1=mysqli_fetch_array($sqlpty1))
{
if($partyarrc!="")
$partyarrc=$partyarrc.",".$rowpty1['orderm_partyname'];
else
$partyarrc=$rowpty1['orderm_partyname'];
}

$sqlcrp=mysqli_query($link,"select distinct cropid from tblcrop order by cropname asc ") or die(mysqli_error($link));
while($rowcrp=mysqli_fetch_array($sqlcrp))
{
if($crparr!="")
$crparr=$crparr.",".$rowcrp['cropid'];
else
$crparr=$rowcrp['cropid'];
}

$list3 = explode(",", implode(",",array_values(array_unique(explode(",",$statearr)))));
sort($list3);
$sstate=implode("','",$list3);
$zzz=array_values(array_unique(explode(",",$locarrc)));
$xx=array_values(array_unique(explode(",",$locarrc)));
$xz="";
foreach($xx as $valc)
{
if($valc<>"")
{
$query = mysqli_query($link,"SELECT `productionlocationid` FROM `tblproductionlocation` WHERE LOWER(`productionlocation`) = '".strtolower($valc)."'") or die(mysqli_error($link));
if($tot_s=mysqli_num_rows($query)>0)
{
if (($key = array_search($valc, $zzz)) !== false) {
    unset($zzz[$key]);
}
$row_s=mysqli_fetch_array($query);
if($xz!="")
$xz=$xz.",".$row_s['productionlocationid'];
else
$xz=$row_s['productionlocationid'];
}
}
}
$locarrc=implode(",",$zzz);
if($locarr!="")
$locarr=$locarr.",".$xz;
else
$locarr=$xz;

$locarr = implode(",",array_values(array_unique(explode(",",$locarr))));
$locarr.=",".$locarrc;
$sstate="'$sstate'";
	
		$datahead1= array("Period From ".$_REQUEST['sdate']." To ".$_REQUEST['edate']);
		$datahead2= array("Order Type ".$ortype." Crop ".$crp." Variety ".$ver." UPS ".$_REQUEST['txtups']);
		$datahead3= array("State ".$states." Location ".$loca." Party ".$partee);
		$datahead4= array("#","Date","Order No","Party Order Ref. No.","Party Type","Party Name","Location","State","Crop","Variety","Size","Standard Type (ST/NST)","Ordered Qty","Balance Qty","Status"); 
		
		$d=1;
if($txtstatesl!="ALL")
{
	$list3=array($txtstatesl);
}
foreach($list3 as $stval)
{
if($stval<>"")
{
$omid="";

$s="select distinct orderm_id from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='$stval' OR orderm_partystate='$stval' OR orderm_country='$stval') and orderm_tflag=1 $sts ";

if($txtordertyp=="sales")
{
$s.=" and order_trtype='Order Sales' ";
}
else if($txtordertyp=="stock")
{
$s.=" and order_trtype='Order Stock' ";
}
else if($txtordertyp=="salesandstock")
{
$s.=" and (order_trtype='Order Sales' OR order_trtype='Order Stock') ";
}
else if($txtordertyp=="tdf")
{
$s.=" and order_trtype='Order TDF' ";
}
else
{
$s.=" ";
}
$s.=" order by orderm_locstate asc, orderm_partystate asc ";
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
$omid1 = implode(",",array_values(array_unique(explode(",",$omid))));
$ormmid=explode(",",$omid);
foreach($ormmid as $ormid)
{
if($ormid<>"")
{
if($txtstatesl=="ALL")
{
$s="select * from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='$stval' OR orderm_partystate='$stval' OR orderm_country='$stval') and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
else
{
$s="select * from tbl_orderm where plantcode='$plantcode' and  orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='".$txtstatesl."' OR orderm_partystate='".$txtstatesl."' OR orderm_country='$stval') and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
$sql_arr_home=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	$orno=""; $party="";  $partyflg=0; 
	
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
	
	$orno=$row_arr_home['orderm_porderno'];
	$porrefno=$row_arr_home['orderm_partyrefno'];
	if($row_arr_home['orderm_party_type']!="")
	{$partytype=$row_arr_home['orderm_party_type'];}
	else
	{$partytype="TDF";}
	
	$ssub="select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='$ormid' ";
if($txtcrop!="ALL")
{
	if($txtvariety!="ALL")
	{
		$ssub.=" and order_sub_crop='$txtcrop' and order_sub_variety='$txtvariety' order by order_sub_crop, order_sub_variety";
	}
	else
	{
		$ssub.=" and order_sub_crop='$txtcrop' order by order_sub_crop, order_sub_variety";
	}
}
$sql_subor=mysqli_query($link,$ssub) or die(mysqli_error($link));
$ttoott=mysqli_num_rows($sql_subor);
$flg=0; $orstatus=""; 
while($row_subor=mysqli_fetch_array($sql_subor))
{	
	$oqty=0; $bqty=0; $upsize=""; $oqty1=""; $bqty1=""; $size1=""; $c=0; $oqt=0;
	$sqlsubsub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_arr_home['orderm_id']."' and order_sub_id='".$row_subor['order_sub_id']."' group by order_sub_sub_ups") or die(mysqli_error($link));
	while($rowsubsub=mysqli_fetch_array($sqlsubsub))
	{
		$size=$rowsubsub['order_sub_sub_ups'];
		if($row_subor['order_sub_ups_type']=="Yes")
		{$stnst="ST";}
		else
		{$stnst="NST";}
		if($size1=="")$size1=$size;
		$ups=$size;
		$upp=explode(" ", $ups);
		$upc=floatval($upp[0]);
		$ups=$upc." ".$upp[1];
		$size=$ups;
		if($size==0)$size="";
		
		if($txtups!="ALL")
		{
			if($size!="" && $size==$txtups)
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}
			else
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}	
		}
		else
		{
			if($size!="" && $size==$size1)
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}
			else
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}	
		}
		if($bqty<0)	$bqty=0;
		
		if($row_subor['order_sub_totbal_qty']<=0)
		{$c=0;	$bqty=0;}
		
		//if($upsize!="") $upsize=$upsize.", ".$size;
		//else 
		$upsize=$size;
		
		//if($oqty1!="") $oqty1=$oqty1.", ".$oqty;
		//else 
		$oqty1=$oqty;
		
		//if($bqty1!="") $bqty1=$bqty1.", ".$bqty;
		//else 
		$bqty1=$bqty;
		
		$size1=$size;
		$c=$bqty;
		$oqt=$oqty;
	
	
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
	
	/*if (($key = array_search($valoc, $zzz)) !== false) 
	{
		$locflg++;
	}*/

}
else
{
	$valoc=$txtlocationsl;
	
	/*if (($key = array_search($valoc, $zzz)) !== false) 
	{
		$locflg++;
	}*/
}
if($row_arr_home['orderm_party_type']=="Export Buyer")
//$valoc=$row3['city'];
$valoc=$row_arr_home['orderm_partycity'];	
if($oqty<=0)$locflg++;
if($txtups!="ALL" && $txtups!=$size)
$locflg=1;

if($txtparty!="ALL" && $partyflg>0)
$locflg=1;

if($locflg>0) 
$flg=1;
else
$flg=0;
	
if($row_arr_home['orderm_dispatchflag']==1 && $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0)
$orstatus="Dispatched";
else if($row_arr_home['orderm_dispatchflag']==2 && $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0)
$orstatus="Part Dispatched";
else if($bqty==0 && $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0)
$orstatus="Dispatched";
else if($row_arr_home['orderm_cancelflag']==1)
$orstatus="Canceled";
else if($row_arr_home['orderm_supflag']==1)
{
	if($c==$oqt)
	$orstatus="Suspended";
	else if($c==0)
	$orstatus="Dispatched";
	else if($c<$oqt && $c>0)
	$orstatus="Part Dispatched"." - "."Suspended";
	else
	$orstatus="Suspended";
}
else
$orstatus="Pending";

	$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$valoc."' order by productionlocation")or die(mysqli_error($link));
	$noti = mysqli_fetch_array($sql_mon);
	if($tloc=mysqli_num_rows($sql_mon) > 0)
	$loca=$noti['productionlocation'];
	else
	$loca=$valoc;

	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_subor['order_sub_crop']."' order by cropname Asc") or die(mysqli_error($link)); 
	$noticii = mysqli_fetch_array($quer);
	$crp1=$noticii['cropname'];

	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_subor['order_sub_variety']."' and actstatus='Active' order by popularname")or die(mysqli_error($link));
	$notici = mysqli_fetch_array($sql_mont);
	$ver1=$notici['popularname'];
	
if($bqty<0)	$bqty=0;
if($c==0 && $orstatus=="Part Dispatched")$orstatus="Dispatched";
if($bqty==0)$orstatus="Dispatched";
		if($tot_arr_home > 0)
		{ 
		if($flg==0) 
		{
		$data1[$d]=array($d,$trdate,$orno,$porrefno,$partytype,$party,$loca,$statee,$crp1,$ver1,$upsize,$stnst,$oqty1,$bqty1,$orstatus); 
		$d++;
		}
		}
}
}
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
