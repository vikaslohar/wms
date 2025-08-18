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
	
	if(isset($_GET['txtslbing1']))
	{
	 $bid = $_GET['txtslbing1'];
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$sid = $_GET['txtslsubbg1'];
	}
	if(isset($_GET['txtslwhg1']))
	{
	 $whid = $_GET['txtslwhg1'];
	}
	
	if(isset($_GET['txtcrop']))
	{
	 $txtcrop = $_GET['txtcrop'];
	}
	if(isset($_GET['txtvariety']))
	{
	 $txtvariety = $_GET['txtvariety'];
	}
	if(isset($_GET['lotsltyp']))
	{
	 $lotsltyp = $_GET['lotsltyp'];
	}
	if(isset($_GET['txtlot1']))
	{
	 $txtlot1 = $_GET['txtlot1'];
	}
	
	if(isset($_GET['txtwh']))
	{
	 $txtwh = $_GET['txtwh'];
	}
	if(isset($_GET['txtbin']))
	{
	 $txtbin = $_GET['txtbin'];
	}
	
	if(isset($_GET['sltyp']))
	{
	 $sltyp = $_GET['sltyp'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW - Utility - SLOC Search</title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>

<body>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 
 <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
     <input name="txtslbing1" value="<?php echo $bid?>" type="hidden"> 
     <input name="txtslsubbg1" value="<?php echo $sid;?>" type="hidden"> 
     <input name="txtslwhg1" value="<?php echo $whid;?>" type="hidden"> 
	 <input name="txtcrop" value="<?php echo $txtcrop;?>" type="hidden"> 
     <input name="txtvariety" value="<?php echo $txtvariety;?>" type="hidden"> 
     <input name="frm_action" value="submit" type="hidden"> 
	 <br />

<?php
		
if($sltyp=="whwise")
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$bid."' and whid='".$whid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);

if($sid=='ALL')
{ 
$subbinn="ALL";
}
else
{
$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$sid."' and binid='".$bid."' and whid='".$whid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
}		
?>	 
   <table align="center" border="1" bordercolor="#e48324" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="2">&nbsp;&nbsp;Bin wise SLOC Search</td>
</tr>
 <tr class="tblsubtitle" height="30">
<td width="50%" align="left"  valign="middle" class="tblheading">&nbsp;&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $subbinn;?></td>
<td width="50%" align="right"  valign="middle" class="tblheading">Stage: Raw&nbsp;&nbsp;</td>
</tr>

  </table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#e48324" style="border-collapse:collapse">
  
<tr class="tblsubtitle" height="20">
              <td width="6%"align="center" valign="middle" class="tblheading">Subbin</td> 
			  <td width="14%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="16%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="6%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
              <td align="center" valign="middle" class="tblheading">QC status</td>
              <td align="center" valign="middle" class="tblheading">DoT</td>
              <td align="center" valign="middle" class="tblheading">Moist %</td>
              <td align="center" valign="middle" class="tblheading">Germ %</td>
              <td align="center" valign="middle" class="tblheading">GOT Status</td>
              <td align="center" valign="middle" class="tblheading">Seed Status</td>
</tr>
<?php
$srno=1;
 // $sid;
if($sid=='ALL')
{ 
  $sql_tb="select distinct(lotldg_subbinid) from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_subbinid";  
}
 else
{
$sql_tb="select distinct(lotldg_subbinid) from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$sid."' and plantcode='$plantcode' and lotldg_sstage='Raw' order by lotldg_subbinid";  
 }

  $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  

while($row_tbl=mysqli_fetch_array($sql_qry))
{ 
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and plantcode='$plantcode' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_sstage='Raw' group by lotldg_lotno order by lotldg_id desc") or die(mysqli_error($link));  
$t1=mysqli_num_rows($sql_tbl1);
while($row_tbl1=mysqli_fetch_array($sql_tbl1))
{

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_sstage='Raw' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$bid."' and whid='".$whid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

		  
	$lrole=$row_tbl_sub['arr_role'];
	$arrival_id=$row_tbl_sub['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus="";

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

				
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		$stage=$row_tbl_sub['lotldg_sstage'];
		$qc=$row_tbl_sub['lotldg_qc'];
		$moist=$row_tbl_sub['lotldg_moisture'];
		$gemp=$row_tbl_sub['lotldg_gemp'];
		$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
		$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
		$sststus=$row_tbl_sub['lotldg_sstatus'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($sststus!="")$sststus=$sststus."/"."S";
			else
			$sststus="S";
		}
		$trdate1=$row_tbl_sub['lotldg_qctestdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		$tot_variety=mysqli_num_rows($sql_variety);
		if($tot_variety>0)
		{
		$variet=$row_variety['popularname'];
		}
		else
		{
		$variet=$row_tbl_sub['lotldg_variety'];
		}	
if($gemp==0)$gemp="";
if($moist==0)$moist="";
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
		 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
         <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $variet;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $moist;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $sststus;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
		 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
         <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $variet;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $moist;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $sststus;?></td>
</tr>
        
	

<?php
}
 $srno++;
}
}
}
}
?></table>
<?php
}
else if($sltyp=="cvwise")
{

		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$txtcrop."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		$crop=$row_crop['cropname'];
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$txtvariety."'  and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		$tot_variety=mysqli_num_rows($sql_variety);
		if($tot_variety>0)
		{
		$variet=$row_variety['popularname'];
		}
		else
		{
		$variet=$txtvariety;
		}	
		
?>
<table align="center" border="1" bordercolor="#e48324" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="2">&nbsp;&nbsp;Product wise SLOC Search</td>
</tr>
 <tr class="tblsubtitle" height="30">
<td width="50%" align="left"  valign="middle" class="tblheading">Crop:&nbsp;<?php echo $crop;?>&nbsp;&nbsp;Variety:&nbsp;<?php echo $variet;?>&nbsp;&nbsp;</td>
<td width="50%" align="right"  valign="middle" class="tblheading">Stage: Raw&nbsp;&nbsp;</td>
</tr>

  </table>
    <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#e48324" style="border-collapse:collapse">
  
<tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="14%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="5%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
              <td align="left" valign="middle" class="tblheading">&nbsp;SLOC</td>
			  <td align="center" valign="middle" class="tblheading">QC status</td>
              <td align="center" valign="middle" class="tblheading">DoT</td>
              <td align="center" valign="middle" class="tblheading">Moist %</td>
              <td align="center" valign="middle" class="tblheading">Gemp %</td>
              <td align="center" valign="middle" class="tblheading">GOT Status</td>
              <td align="center" valign="middle" class="tblheading">Seed Status</td>
</tr>
<?php
$srno=1;
 // $sid;
if($lotsltyp=='all')
{ 
  $sql_tb="select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and plantcode='$plantcode' and lotldg_sstage='Raw' order by lotldg_id desc";  
}
else
{
	$sql_tb="select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and plantcode='$plantcode' and lotldg_lotno='".$txtlot1."' and lotldg_sstage='Raw' order by lotldg_id desc";  
}

  $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  

while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and plantcode='$plantcode' and lotldg_lotno='".$row_tbl['lotldg_lotno']."' and lotldg_sstage='Raw' group by lotldg_lotno order by lotldg_id desc") or die(mysqli_error($link));  
$t1=mysqli_num_rows($sql_tbl1);
while($row_tbl1=mysqli_fetch_array($sql_tbl1))
{

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_sstage='Raw' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and plantcode='$plantcode' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

		  
	$lrole=$row_tbl_sub['arr_role'];
	$arrival_id=$row_tbl_sub['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus="";
	/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{*/

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

				
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		$stage=$row_tbl_sub['lotldg_sstage'];
		$qc=$row_tbl_sub['lotldg_qc'];
		$moist=$row_tbl_sub['lotldg_moisture'];
		$gemp=$row_tbl_sub['lotldg_gemp'];
		$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
		$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
		$sststus=$row_tbl_sub['lotldg_sstatus'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($sststus!="")$sststus=$sststus."/"."S";
			else
			$sststus="S";
		}
		$trdate1=$row_tbl_sub1['lotldg_qctestdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
		if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_tbl_sub['lotldg_lotno']."' and plantcode='$plantcode'and lotldg_sstage='Raw' ") or die(mysqli_error($link));
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 //echo $row_tbl_sub['lotldg_lotno']." ".$row_issue['lotldg_subbinid']."<br>";
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and plantcode='$plantcode' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_sstage='Raw' and lotldg_lotno='".$row_tbl_sub['lotldg_lotno']."' order by lotldg_id desc") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_arr_home=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_sstage='Raw' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

$tot_arr_home=mysqli_num_rows($sql_arr_home);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; 

while($row_tbl_sub1=mysqli_fetch_array($sql_arr_home))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub1['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub1['lotldg_binid']."' and whid='".$row_tbl_sub1['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub1['lotldg_subbinid']."' and plantcode='$plantcode' and binid='".$row_tbl_sub1['lotldg_binid']."' and whid='".$row_tbl_sub1['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_tbl_sub1['lotldg_balbags'];
 $slqty=$row_tbl_sub1['lotldg_balqty'];
if($slocs!="")
$slocs=$slocs.", ".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
}
if($gemp==0)$gemp="";
if($moist==0)$moist="";			
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="34%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $slocs;?></td>
		 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $moist;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $sststus;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="34%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $slocs;?></td>
		 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $moist;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $sststus;?></td>
</tr>
        
	

<?php
}
 $srno++;
}
}
}
}
?></table>
<?php
}
else 
{
$whid1=$txtwh;
$bid1=$txtbin;
$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid1."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wh=$row_whouse1['perticulars'];

if($bid1!="ALL")
{
$sql_binn1=mysqli_query($link,"select binname from tbl_bin where binid='".$bid1."' and whid='".$whid1."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$bin=$row_binn1['binname'];
}
else
{
$bin=$bid1;
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="400" bordercolor="#F1B01E" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;SLOC Search - Empty Bin Search&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse1['perticulars'];?>/<?php echo $bin;?></td>
</tr>
 <?php
 $srno=1;

$cc="Empty";

if($bid1!="ALL")
{

?>
<tr class="tblsubtitle" height="20">
              <!--<td width="200" height="18" align="center" valign="middle" class="tblheading">#</td>-->
			  <td  align="center" valign="middle" class="tblheading">Sub Bin</td>
	    </tr>
<?php
$sql_subbinn2=mysqli_query($link,"select * from tbl_subbin where whid='".$whid1."' and binid='".$bid1."' and status='".$cc."' order by sname") or die(mysqli_error($link));
$T=mysqli_num_rows($sql_subbinn2);
while($row_subbinn2=mysqli_fetch_array($sql_subbinn2))
{
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
		<td align="center" valign="middle" class="tblheading"><?php echo $row_subbinn2['sname'];?></td>
	    </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td align="center" valign="middle" class="tblheading"><?php echo $row_subbinn2['sname'];?></td>
		</tr> 
<?php
}
$srno++;
}

}
else
{
?>
<tr class="tblsubtitle" height="20">
			  <td align="center" valign="middle" class="tblheading">Bin</td>
	    </tr>
<?php
$sql_subbinn111=mysqli_query($link,"select distinct(binid) from tbl_subbin where whid='".$whid1."' and plantcode='$plantcode' group by binid order by binid ") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_subbinn111);

while($rrr=mysqli_fetch_array($sql_subbinn111))
{
$sql_subbinn2=mysqli_query($link,"select * from tbl_subbin where whid='".$whid1."' and binid='".$rrr['binid']."' and plantcode='$plantcode' and status='".$cc."' order by binid") or die(mysqli_error($link));
$T=mysqli_num_rows($sql_subbinn2);
if($T==20)
{
$sql_binn11=mysqli_query($link,"select binname from tbl_bin where binid='".$rrr['binid']."' and plantcode='$plantcode' order by binname") or die(mysqli_error($link));
$row_binn11=mysqli_fetch_array($sql_binn11);
$bin1=$row_binn11['binname'];

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
		<td align="center" valign="middle" class="tblheading"><?php echo $bin1;?></td>
	    </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td align="center" valign="middle" class="tblheading"><?php echo $bin1;?></td>
		</tr> 
<?php
}
$srno++;
}
}
}
?> 
</table>
<?php
}
?>
<br/>		  
</form>

		  
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="slocreport.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">-->&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
</table>


</body>
</html>
