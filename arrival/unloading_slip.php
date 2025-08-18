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

	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Arrival-Transaction- Unloading Slip</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tblarrival_unld where arrival_id='".$tid."'") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl)){		
$arrival_id=$row_tbl['arrival_id'];
$truckno=$row_tbl['trans_vehno'];

$sql_class12=mysqli_query($link,"select COUNT(*) from tblarrsub_sub_unld where arrival_id='".$arrival_id."' ") or die(mysqli_error($link));
$row_class12=mysqli_fetch_array($sql_class12);

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Raw Seed Unloading Sheet</font></td>
</tr>
</table><br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">Date of Arrival&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tdate;?></td>
 <td width="121" align="right" valign="middle" class="tblheading">RSUS No.&nbsp;</td>
<td width="219" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrival_code'];?></td>
</tr>
 <tr class="Light" height="20">
<td width="187" align="right" valign="middle" class="tblheading">Truck No.&nbsp;</td>
<td width="263"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $truckno;?></td>

<td width="121" align="right" valign="middle" class="tblheading">Dispatch Location&nbsp;</td>
<td width="219" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['disploc'];?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="20">
<td align="right" width="187" valign="middle" class="tblheading">Pass in No.&nbsp;</td>
<td align="left" width="263" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['passinno'];?></td>
 <td width="121" align="right" valign="middle" class="tblheading">Total Bags&nbsp;</td>
<td width="219" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_class12[0]?></td>
</tr>
</table>

<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
//echo $arrival_id;
$totaldcbag=0; $totactbag=0; $totdiffbag=0; $totalgrqty=0; $totalnetqty=0; $totaltareqty=0;
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub_unld where arrival_id='".$arrival_id."'") or die(mysqli_error($link));

?>
			<tr class="tblsubtitle" height="20">
			<td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Crop</td>
             <td align="center" valign="middle" class="smalltblheading" width="10%" rowspan="2">Lot No</td>
			 <td align="center" valign="middle" class="smalltblheading" width="3%" colspan="3">No. of Bags</td>
             <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Moist</td>
			 <td align="center" valign="middle" class="smalltblheading" colspan="10" width="58%" rowspan="2">
			 <table border="1" align="center" cellspacing="0" cellpadding="0" style="border-collapse:collapse" width="450" height="100%">
				<tr class="tblsubtitle" height="100%" style="width:450px;">
             <td align="center" valign="middle" class="smalltblheading" colspan="10">Bag Qty</td>
			 </tr>
				<tr class="tblsubtitle" height="100%" style="width:450px;">
				  <td align="center" valign="middle" class="smalltblheading" width="10">1</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">2</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">3</td>
				  <td align="center" valign="middle" class="smalltblheading" width="9.9">4</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">5</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">6</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">7</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">8</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">9</td>
				  <td align="center" valign="middle" class="smalltblheading" width="10">10</td>
			    </tr>
			 </table></td>
             <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Total Qty.</td>
             <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Tare Qty.</td>
             <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Net Qty.</td>
             <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Remarks</td>
		  </tr>
		  
		  <tr class="tblsubtitle" height="20">
			 <td align="center" valign="middle" class="smalltblheading" >DC</td>
			 <td align="center" valign="middle" class="smalltblheading" >Act.</td>
			 <td align="center" valign="middle" class="smalltblheading" >Diff.</td>
		  </tr>
			
<?php
$srno=1; $srn=0;
$total_tbl=mysqli_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{ 
$sql_class=mysqli_query($link,"select grosswt from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' ") or die(mysqli_error($link));
$tot_ss=mysqli_num_rows($sql_class);
$cnt=1;

$tot_ss1=ceil($tot_ss/10);
$sql_class1=mysqli_query($link,"select sum( grosswt ) , sum( tarewt ) , sum( netwt ) from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' ") or die(mysqli_error($link));
$row_class1=mysqli_fetch_array($sql_class1);
$lotno=$row_tbl_sub['lotno'];

if($row_tbl_sub['moisture']=="Acceptable")
	$moist="AC";
if($row_tbl_sub['moisture']=="Not-Acceptable")
	$moist="NAC";
	
$totalqty=$row_class1[0];
$tareqty=$row_class1[1];
$netqty=$row_class1[2];

$dcbag=$row_tbl_sub['act1'];
$bagdiff=$tot_ss-$dcbag;
$crop=$row_tbl_sub['lotcrop'];
//echo $cnt." -- ";
if($tot_ss>0){
?>	
<tr class="Light" height="20">
 			 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $crop;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="10%"><?php echo $lotno;?></td>
             <td align="center" valign="middle" class="smalltbltext" width="3%"><?php echo $dcbag;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="3%"><?php echo $tot_ss;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="3%"><?php echo $bagdiff;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $moist;?></td>
			 <td align="center" valign="middle" class="smalltbltext" colspan="10" width="58%">
			 <table border="1" align="center" cellspacing="0" cellpadding="0" style="border-collapse:collapse" width="450" height="100%">
			
			 <?php
			 while($cnt<=$tot_ss1)
			 {?>
			 <tr class="Light" height="100%" style="width:450px;">
			 <?php
			 if($cnt==1)
			 $start=0;
			 else
			 $start=(($cnt-1)*10);
			 
			 $end=10;
			 
			 //echo "select grosswt from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' LIMIT $start,$end <br />";
			 $bagarray1 = array();
			 $sql_class2=mysqli_query($link,"select arrsubsub_id,grosswt from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' LIMIT $start,$end") or die(mysqli_error($link));
			$tot_ss2=mysqli_num_rows($sql_class2);
			
			$forcnt=10-$tot_ss2; 
			while($row_class2=mysqli_fetch_array($sql_class2))
			{
				/*if($bagarray == "")
				{
					$bagarray = $bagarray.",".$row_class2['grosswt'];
				}*/
				array_push($bagarray1,$row_class2['grosswt']);
			}
			
			//$bagarray1=explode(",",$bagarray);
			$rowcnt=count($bagarray1);
			
			if($rowcnt==1){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==2){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==3){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==4){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==5){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[4];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==6){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[4];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[5];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==7){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[4];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[5];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[6];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==8){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[4];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[5];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[6];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[7];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==9){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[4];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[5];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[6];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[7];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[8];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"></td>
			<?php	
			}
			if($rowcnt==10){
			?>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[0];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[1];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[2];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[3];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[4];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[5];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[6];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[7];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[8];?></td>
			<td align="center" valign="middle" class="smalltblheading" width="10"><?php echo $bagarray1[9];?></td>
			<?php	
			}
			?>
			 </tr>
			 <?php
			 $cnt++;}?></table></td>
			 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $totalqty;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $tareqty;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $netqty;?></td>
			 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $remarks;?></td>
</tr>
<?php
$srno++;
}
else
{
?>
<tr class="Light" height="20">
	 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $crop;?></td>
	 <td align="center" valign="middle" class="smalltbltext" width="10%"><?php echo $lotno;?></td>
	 <td align="center" valign="middle" class="smalltbltext" width="3%"><?php echo $dcbag;?></td>
	 <td align="center" valign="middle" class="smalltbltext" width="3%"><?php echo $tot_ss;?></td>
	 <td align="center" valign="middle" class="smalltbltext" width="3%"><?php echo $bagdiff;?></td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $moist;?></td>
	 <td align="center" valign="middle" class="smalltbltext" colspan="10" width="58%">
	<table border="1" align="center" cellspacing="0" cellpadding="0" style="border-collapse:collapse" width="100%">
	<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	<td align="center" valign="middle" class="smalltbltext" width="10%"></td>
	</tr></table></td>
	<td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $totalqty;?></td>
	<td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $tareqty;?></td>
	<td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $netqty;?></td>
	<td align="center" valign="middle" class="smalltbltext" width="5%"><?php echo $remarks;?></td>
</tr> 
<?php
}

$totaldcbag=$totaldcbag+$dcbag; 
$totactbag=$totactbag+$tot_ss; 
$totdiffbag=$totdiffbag+$bagdiff;

$totalgrqty=$totalgrqty+$totalqty; 
$totalnetqty=$totalnetqty+$netqty; 
$totaltareqty=$totaltareqty+$tareqty;

}
}
}
?> 

<tr class="Light" height="20">
	 <td align="right" valign="middle" class="tblheading" width="5%" colspan="2">Total&nbsp;</td>
	 <td align="center" valign="middle" class="tbltext" width="3%"><?php echo $totaldcbag;?></td>
	 <td align="center" valign="middle" class="tbltext" width="3%"><?php echo $totactbag;?></td>
	 <td align="center" valign="middle" class="tbltext" width="3%"><?php echo $totdiffbag;?></td>
	 <td align="center" valign="middle" class="tbltext" colspan="11"></td>
	<td align="center" valign="middle" class="tbltext" width="5%"><?php echo $totalgrqty;?></td>
	<td align="center" valign="middle" class="tbltext" width="5%"><?php echo $totaltareqty;?></td>
	<td align="center" valign="middle" class="tbltext" width="5%"><?php echo $totalnetqty;?></td>
	<td align="center" valign="middle" class="tbltext" width="5%"><?php echo $remarks;?></td>
</tr> 
			  
</table>
<br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="40">
<td width="127" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table>


<br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="150" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Unloading Person&nbsp;</td>
<td width="250" align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="100" align="right" valign="middle" class="smalltblheading">Checked By&nbsp;</td>
<td width="250" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" ><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
