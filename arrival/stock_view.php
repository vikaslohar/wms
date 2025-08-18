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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['remarks']))
	{
	 $remarks = $_REQUEST['remarks'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival Transaction- Stock Transafer Plant</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Arrival Stock Transfer - Plant Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>
<!--<td align="right"  valign="middle" class="tblheading">  Stock Transfer Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate1?></td>
<td align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $plname.", ".$city1;?></td>-->
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?>&nbsp;</td>
</tr>
<!--<tr class="Light" height="30">
 
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>

 <?php
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

	<td align="right"  valign="middle" class="tblheading">Variety &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $rowvv['popularname'];?></td>
           </tr>
		   
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" >&nbsp;<?php echo $row_tbl['sstage'];?></td>
</tr>-->
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="6" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="207" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="207" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<!--<tr class="Dark" height="25">
           <td width="173"  align="right"  valign="middle" class="tblheading">&nbsp;No. of&nbsp;Lot&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $row_tbl['nolot'];?></td>
 </tr>
-->

<!--<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Date of Receipt &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate1?></td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>
<td align="right"  valign="middle" class="tblheading">STN No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?></td>
</tr>
--><?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">
<?php
$tid=$pid;
?>
  <?php
/*$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];*/

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
  <tr class="tblsubtitle" height="20">
    <td width="28" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="36" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
              <td width="65" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			 <td width="67" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Dispatch</td>
			    <td colspan="2" align="center" valign="middle" class="tblheading">Received</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Difference</td>
				<td width="38" rowspan="2" align="center" valign="middle" class="tblheading">Stage </td>
                <td width="43" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
				<td width="38" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
			   <td width="39" rowspan="2" align="center" valign="middle" class="tblheading">Moist %</td>
			   <td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Germ. %</td>
			    <td width="31" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status</td>
			    <td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
				<td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
          </tr>
			<tr class="tblsubtitle">
			  <td width="31" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="43" align="center" valign="middle" class="tblheading">Qty</td>
               <td width="30" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="37" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="43" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="46" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="31" align="center" valign="middle" class="tblheading">WH</td>
			   <td width="30" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="44" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
	if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
    <td width="65" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td width="67" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $dcn;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
	<td width="30" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="43" align="center" valign="middle" class="tblheading"><?php echo $difn;?></td>
    <td width="46" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
	<td width="38" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="38" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="44" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
	 <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>
	 <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	  <td width="30" align="center" valign="middle" class="tblheading"><?php echo $act1;?></td>
	     <td width="44" align="center" valign="middle" class="tblheading"><?php echo $act;?></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
    <td width="65" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td width="67" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $dcn;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
	<td width="30" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="43" align="center" valign="middle" class="tblheading"><?php echo $difn;?></td>
    <td width="46" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
	<td width="38" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="38" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="44" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
	 <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>
	 <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	  <td width="30" align="center" valign="middle" class="tblheading"><?php echo $act1;?></td>
	     <td width="44" align="center" valign="middle" class="tblheading"><?php echo $act;?></td>
  <?php
}
$srno++;
}
}

?>
<!--<tr class="Dark" height="30">
<td width="58" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="20">&nbsp;<?php echo $remarks;?></td>
</tr> 	--> 			  
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="Dark" height="30">
<td width="58" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="20">&nbsp;<?php echo $remarks;?></td>
</tr>
</table> 	
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
