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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	 $vrid = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	 $ortp = $_GET['b'];	 
	}	
if(isset($_GET['c']))
	{
	 $stdt = $_GET['c'];	 
	}
if(isset($_GET['f']))
	{
	 $endt = $_GET['f'];	 
	}	
$tdate=explode("-",$stdt);
$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
$tdate2=explode("-",$endt);
$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];	

$s="select distinct orderm_id from tbl_orderm where orderm_date<='$edate' and orderm_date>='$sdate' and orderm_tflag=1 ";
if($ortp=="sales")
{
$s.=" and order_trtype='Order Sales' ";
}
else if($ortp=="stock")
{
$s.=" and order_trtype='Order Stock' ";
}
else if($ortp=="salesandstock")
{
$s.=" and (order_trtype='Order Sales' OR order_trtype='Order Stock') ";
}
else if($ortp=="tdf")
{
$s.=" and order_trtype='Order TDF' ";
}
else
{
$s.=" ";
}
$s.=" order by orderm_date asc";
$sql_arrhome=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arrhome=mysqli_num_rows($sql_arrhome);
$omid="";
if($tot_arrhome > 0)
{ 
while($row_arrhome=mysqli_fetch_array($sql_arrhome))
{
if($omid!="")
$omid=$omid.", ".$row_arrhome['orderm_id'];
else
$omid=$row_arrhome['orderm_id'];
}
}

$subid="";
$ormmid=explode(",",$omid);
foreach($ormmid as $ormid)
{
if($ormid<>"")
{
$ssub=mysqli_query($link,"select order_sub_id from tbl_order_sub where plantcode='$plantcode' and orderm_id='$ormid' and order_sub_variety='$vrid' order by  	order_sub_id") or die(mysqli_error($link));
while($row_ssub=mysqli_fetch_array($ssub))
{
if($subid!="")
$subid=$subid.", ".$row_ssub['order_sub_id'];
else
$subid=$row_ssub['order_sub_id'];
}
}
}
$list3=explode(",",$subid);
$subid=implode("','",$list3);
$subid="'$subid'";;
$size="";
$sqlsubsub=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='$plantcode' and order_sub_id IN($subid)") or die(mysqli_error($link));
$tt=mysqli_num_rows($sqlsubsub);
while($rowsubsub=mysqli_fetch_array($sqlsubsub))
{
if($size!="")
$size=$size.",".$rowsubsub['order_sub_sub_ups'];
else
$size=$rowsubsub['order_sub_sub_ups'];
}

$size2="";
$siz=explode(",",$size);
foreach($siz as $size1)
{
if($size1<>"")
{
$ups=$size1;
$upp=explode(" ", $ups);
$upc=floatval($upp[0]);
$ups=$upc." ".$upp[1];
if($size2!="")
$size2=$size2.",".$ups;
else
$size2=$ups;
}
}	
$size2=implode(",",array_values(array_unique(explode(",",$size2))));
?>&nbsp;<select class="tbltext" name="txtups" style="width:170px;" >
<option value="ALL" selected>ALL</option>
	<?php $siz=explode(",",$size2); foreach($siz as $size1) { if($size1<>"") { ?>
		<option value="<?php echo $size1;?>" />   
		<?php echo $size1;?>
		<?php }} ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;