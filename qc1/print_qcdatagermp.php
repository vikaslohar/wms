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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
				$txt11=$_REQUEST['txt11'];
				$txtcrop=$_REQUEST['txtcrop'];
				$txtvariety=$_REQUEST['txtvariety'];
				$cvslchb=$_REQUEST['cvslchb'];
				$wh=$_REQUEST['wh'];

	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report - QC Sample Pending List</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input type="hidden" name="cnt" value="0" />
		  <input name="txt" value="" type="hidden"> 
		</br>		</br>
<?php
if($txt11 == "cvsloc")
{
//$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where crop='".$txtcrop."' and variety='".$txtvariety."' and aflg=0 and bflg=0 and cflg=0  order by sampleno desc") or die(mysqli_error($link));
if($cvslchb=="cvslocwise")
{
$sql_home=mysqli_query($link,"select distinct orlot from tbl_lot_ldg where lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' group by orlot order by lotldg_whid, lotldg_binid, lotldg_subbinid asc ") or die(mysqli_error($link));
}
else
{
$sql_home=mysqli_query($link,"select distinct orlot from tbl_lot_ldg where lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' group by orlot ") or die(mysqli_error($link));
}
$t=mysqli_num_rows($sql_home);
//echo $tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer32=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$txtcrop."'"); 
	$row32=mysqli_fetch_array($quer32);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$txtvariety."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$txtvariety;
	 }
	 else
	 {
	  $vv=$tt;
	  }
//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 
?>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;QC Sample Pending List</td><td align="right" class="tblheading">Crop - <?php echo $row32['cropname'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety - <?php echo $vv;?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="24" height="19"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="63" align="center" valign="middle" class="smalltblheading">DOSR</td>
	<td width="90" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="125" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="81" align="center" valign="middle" class="smalltblheading">Lot No.</td> 
	<td width="54" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="322" align="center" valign="middle" class="smalltblheading">Stage, NoB/Qty, SLOC</td>
	<td width="42" align="center" valign="middle" class="smalltblheading">QC Tests </td>
	<td width="31" align="center" valign="middle" class="smalltblheading">Opr Code</td>
	<td align="center" valign="middle" class="smalltblheading">Sample No. </td>
</tr>
<?php
$srno=1;
if($t >0) 
 { 
while($row_home=mysqli_fetch_array($sql_home))
{

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where crop='".$txtcrop."' and variety='".$txtvariety."' and oldlot='".$row_home['orlot']."' and aflg=0 and bflg=0 and cflg=0  order by sampleno desc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$smp=$row_arr_home['yearid'];
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $stage=""; $got=""; $qc=""; 
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		$lotno=$row_tbl_sub1['oldlot'];
	$details=""; $totqty=0;
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

$sql_tblsub1=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where orlot='".$lotno."' order by orlot") or die(mysqli_error($link));
	$t_tblsub1=mysqli_num_rows($sql_tblsub1);
while($rowtbl22=mysqli_fetch_array($sql_tblsub1))
{
/*$ddss=$rowtbl22['lotldg_sstage'];
	$p_array=explode(",", $row_tbl_sub1['trstage']); 
	foreach($p_array as $val)
	{ 
		if($val<>"")
		{ 
			if($val==$rowtbl22['lotldg_sstage'])
			{ 
			$ddss="<b>".$rowtbl22['lotldg_sstage']."</b>";
			}
		}
	}
	
if($details!="")
$details=$details.$ddss;
else
$details=$ddss; */
$bags=0; $qty=0; $slocs="";
$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."' group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
{ $ac=0; $acn=0; $gd=""; $slups=0;$slqty=0;
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);

while($row_tbl=mysqli_fetch_array($sql1))
{	
//$lotldg_trid=$row_tbl['lotldg_trid'];

$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; 

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl['lotldg_balbags'];
 
$an24=explode(".",$row_tbl['lotldg_balqty']);
if($an24[1]==000){$acn24=$an[0];}else{$acn24=$row_tbl['lotldg_balqty'];}
$slqty=$slqty+$acn24;

if($slocs!="")
$slocs=$slocs.", ".$wareh.$binn.$subbinn." | ".$ac." | ".$acn;
else
$slocs=$wareh.$binn.$subbinn." | ".$ac." | ".$acn;
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
		$bags=$bags+$ac;
		$qty=$qty+$acn;
$totqty=$totqty+$qty;
}
}
$stage=$row_tbl_sub1['logid'];
$pp=$row_tbl_sub1['state'];	

$ddss=$rowtbl22['lotldg_sstage'];
	$p_array=explode(",", $row_tbl_sub1['trstage']); 
	foreach($p_array as $val)
	{ 
		if($val<>"")
		{ 
			if($val==$rowtbl22['lotldg_sstage'])
			{ 
			$ddss="<b>".$rowtbl22['lotldg_sstage']."</b>";
			}
		}
	}
if($qty > 0)	
{
if($details!="")
$details=$details.$ddss;
else
$details=$ddss; 

	$details=$details.", ".$bags." | ".$qty.", ".$slocs."<br/>";
}
}
}
}

if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="63" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>  
	<td width="322" align="center" valign="middle" class="smalltbltext"><?php echo $details;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $smp?><?php echo sprintf("%000006d",$qc1);?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="63" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>  
	<td width="322" align="center" valign="middle" class="smalltbltext"><?php echo $details;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $smp?><?php echo sprintf("%000006d",$qc1);?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
if($srno==1)
{
?>
<tr class="Light" height="20">
	<td height="19"align="center" valign="middle" class="tblheading" colspan="11">No Records Found</td>
</tr>
<?php
}
?>
</table>
<?php
}
else if($txt11 == "sloc")
{


$sql_home=mysqli_query($link,"select distinct orlot from tbl_lot_ldg where lotldg_whid='".$wh."' group by orlot order by lotldg_whid, lotldg_binid, lotldg_subbinid asc ") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_home);
//echo $tot_arr_home=mysqli_num_rows($sql_arr_home);

$sql_arr=mysqli_query($link,"select * from tbl_warehouse where whid='".$wh."'") or die(mysqli_error($link));
$row_arr=mysqli_fetch_array($sql_arr);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 

?>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;QC Sample Pending List</td><td align="right" class="tblheading">Warehouse - <?php echo $row_arr['perticulars'];?>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="24" height="19"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="63" align="center" valign="middle" class="smalltblheading">DOSR</td>
	<td width="90" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="125" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="81" align="center" valign="middle" class="smalltblheading">Lot No.</td> 
	<td width="54" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="322" align="center" valign="middle" class="smalltblheading">Stage, NoB/Qty, SLOC</td>
	<td width="42" align="center" valign="middle" class="smalltblheading">QC Tests </td>
	<td width="31" align="center" valign="middle" class="smalltblheading">Opr Code</td>
	<td align="center" valign="middle" class="smalltblheading">Sample No. </td>
</tr>
<?php

$srno=1;
 if($t >0) 
 { 
while($row_home=mysqli_fetch_array($sql_home))
{

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_home['orlot']."' and aflg=0 and bflg=0 and cflg=0  order by sampleno desc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$smp=$row_arr_home['yearid'];
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $stage=""; $got=""; $qc=""; 
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		$lotno=$row_tbl_sub1['oldlot'];
	$details="";$totqty=0;
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

$sql_tblsub1=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where orlot='".$lotno."' order by orlot") or die(mysqli_error($link));
	$t_tblsub1=mysqli_num_rows($sql_tblsub1);
while($rowtbl22=mysqli_fetch_array($sql_tblsub1))
{
/*$ddss=$rowtbl22['lotldg_sstage'];
	$p_array=explode(",", $row_tbl_sub1['trstage']); 
	foreach($p_array as $val)
	{ 
		if($val<>"")
		{ 
			if($val==$rowtbl22['lotldg_sstage'])
			{ 
			$ddss="<b>".$rowtbl22['lotldg_sstage']."</b>";
			}
		}
	}
	
if($details!="")
$details=$details.$ddss;
else
$details=$ddss; */
$bags=0; $qty=0; 
$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."' group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
{ $ac=0; $acn=0;$slocs=""; $gd=""; $slups=0;$slqty=0;
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);

while($row_tbl=mysqli_fetch_array($sql1))
{	
//$lotldg_trid=$row_tbl['lotldg_trid'];

$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0;$slqty=0;

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl['lotldg_balbags'];
 
$an24=explode(".",$row_tbl['lotldg_balqty']);
if($an24[1]==000){$acn24=$an[0];}else{$acn24=$row_tbl['lotldg_balqty'];}
$slqty=$slqty+$acn24;

if($slocs!="")
$slocs=$slocs.", ".$wareh.$binn.$subbinn." | ".$ac." | ".$acn;
else
$slocs=$wareh.$binn.$subbinn." | ".$ac." | ".$acn;	
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$bags=$bags+$ac;
		$qty=$qty+$acn;
$totqty=$totqty+$qty;

}
}
$stage=$row_tbl_sub1['logid'];
$pp=$row_tbl_sub1['state'];	

		
$ddss=$rowtbl22['lotldg_sstage'];
	$p_array=explode(",", $row_tbl_sub1['trstage']); 
	foreach($p_array as $val)
	{ 
		if($val<>"")
		{ 
			if($val==$rowtbl22['lotldg_sstage'])
			{ 
			$ddss="<b>".$rowtbl22['lotldg_sstage']."</b>";
			}
		}
	}
if($qty > 0)	
{
if($details!="")
$details=$details.$ddss;
else
$details=$ddss; 

	$details=$details.", ".$bags." | ".$qty.", ".$slocs."<br/>";
}
}
}
}

if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="63" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>  
	<td width="322" align="center" valign="middle" class="smalltbltext"><?php echo $details;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $smp?><?php echo sprintf("%000006d",$qc1);?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="63" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>  
	<td width="322" align="center" valign="middle" class="smalltbltext"><?php echo $details;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $smp?><?php echo sprintf("%000006d",$qc1);?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
if($srno==1)
{
?>
<tr class="Light" height="20">
	<td height="19"align="center" valign="middle" class="tblheading" colspan="11">No Records Found</td>
</tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<?php
}
?>	  
		<br/>
<table cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>  </table>
</form>
</td></tr>
</table>

</body>
</html>
