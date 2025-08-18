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

	//$logid="opr1";
	//$lgnid="OP1";
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw- Transaction-SLOC Updation</title>
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<?php
	$sql1=mysqli_query($link,"select * from tbl_sloc_psw where plantcode='$plantcode' and slid='".$pid."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$pid."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
	
$c=$row['crop'];
$f=$row['variety'];
$a=$row['lotno'];
	 ?>   
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation</td>
</tr>
 
<!--<tr class="Dark" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Transction ID&nbsp;</td>
           <td width="350" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "TSU".$row['code']."/".$yearid_id."/".$lgnid;?></td>
		   
		   <td width="129" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
		   </tr>-->
 <?php 
$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$c."'") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($quer3);
?>
		 <tr class="Light" height="25">
           <td width="158"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?></td>
         </tr>
<?php 
$itemqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$f."' and actstatus='Active'") or die(mysqli_error($link));
$t=mysqli_num_rows($itemqry1);
if($t > 0)
{
$row_itm=mysqli_fetch_array($itemqry1);
$var=$row_itm['popularname'];
}
else
{
$var=$f;
}
?> 
		<tr class="Dark" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
           <td align="left"  valign="middle"  id="item" class="tbltext" colspan="3">&nbsp;<?php echo $var;?></td>
         </tr>
		  <tr class="Light" height="25">
		  <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $a;?></td>
	      </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Original Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">UPS</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">NoP</td>
<td width="122" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotno='".$a."'") or die(mysqli_error($link));

$srno=1;
$totups=0; $totqty=0; $totnops=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$f."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$upssize=$row_issuetbl['packtype'];
$nop1=0; $nop2=0; $b1=0; $b2=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$packtp=explode(" ",$row_issuetbl['packtype']);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp2=(1000/$packtp[0]);
}
else
{
	$ptp2=$packtp[0];
}
$bl=($row_issuetbl['balqty']*100)/100;
$b2=(($wtinmp*$row_issuetbl['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;


if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp2*$penqty);
	}
	else
	{
		$nop1=($penqty/$ptp2);
	}
}
if($packtp[1]=="Gms")
{
	$nop2=($ptp2*$row_issuetbl['balqty']);
}
else
{
	$nop2=($row_issuetbl['balqty']/$ptp2);
}

$txtlot1=$a;
$txtvariety=$f;
$nop2;
$zz=str_split($txtlot1);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=$row_mps['mpmain_crop'];
		$verarr=$row_mps['mpmain_variety'];
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=$row_mps['mpmain_upssize'];
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nops=$nops+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=$row_mpl['mpmain_crop'];
		$verarr=$row_mpl['mpmain_variety'];
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=$row_mpl['mpmain_upssize'];
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopl=$nopl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
			}
		}
		
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$nopm+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtym=$qtym+($ptp*$noparr[$i]); $nompm=$nompm+$ct; 
			}
		}
		
	}
}

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=$row_mpns['mpmain_crop'];
		$verarr=$row_mpns['mpmain_variety'];
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=$row_mpns['mpmain_upssize'];
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopns=$nopns+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=$row_mpnl['mpmain_crop'];
		$verarr=$row_mpnl['mpmain_variety'];
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=$row_mpnl['mpmain_upssize'];
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopnl=$nopnl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$ct; 
			}
		}
		
	}
}
//echo $nops."  -  ".$nopl;
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 	
$qty=$row_issuetbl['balqty']-$totextqtys;
$nop1=$nop2-$totextpouches;
if($row_issuetbl['balqty']>0)
$nop1=$nop2-$totextpouches;
//$qty=$nob*$ptp2;



$totnops=$totnops+$nop1;
$totups=$totups+$row_issuetbl['balnomp'];
$totqty=$totqty+$row_issuetbl['balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upssize;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balnomp'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upssize;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balnomp'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balqty'];?></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totnops;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Changed Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">UPS</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">NoP</td>
<td width="122" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sr=1;
$totups=0; $totqty=0; $totnop=0;
$sql_sloc_sub=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$pid."' order by slocsubid") or die (mysqli_error($link));

while($row_sloc_sub=mysqli_fetch_array($sql_sloc_sub))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc_sub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc_sub['subbinid']."' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$wtinmp=$row_sloc_sub['wtinmp'];
$upspacktype=$row_sloc_sub['packtype'];
if($upspacktype=="")$upspacktype=$upssize;
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
}
$bl=($row_sloc_sub['balqty']*100)/100;
$b2=(($wtinmp*$row_sloc_sub['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

$totnop=$totnop+$row_sloc_sub['nop'];
$totups=$totups+$row_sloc_sub['balnomp'];
$totqty=$totqty+$row_sloc_sub['balqty'];

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upspacktype;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['nop'];?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balnomp'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balqty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upspacktype;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['nop'];?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balnomp'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balqty'];?></td>
</tr>
<?php
}
$sr++;
}
?>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totnop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
