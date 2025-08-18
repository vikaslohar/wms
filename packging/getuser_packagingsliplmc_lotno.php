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

	if(isset($_REQUEST['crop']))
	{
		$crop = $_REQUEST['crop'];
	}
	
	if(isset($_REQUEST['variety']))
	{
		$variety = $_REQUEST['variety'];
	}
	if(isset($_REQUEST['stage']))
	{
		$stage = $_REQUEST['stage'];
	}
	
	$tp=$stage;
	
	if(isset($_REQUEST['tid']))
	{
		$tid = $_REQUEST['tid'];
	}
	if(isset($_REQUEST['dop']))
	{
		$dop = $_REQUEST['dop'];
	}
	if(isset($_REQUEST['ups']))
	{
		$ups = $_REQUEST['ups'];
	}
	if(isset($_REQUEST['sqq']))
	{
		$sqq = $_REQUEST['sqq'];
	}
	else
	{
		$sqq="";
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	/*echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	*/
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script language='javascript'>

function post_value()
{
	opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
	opener.document.frmaddDepartment.txtlot2.value=document.from.foccode1.value;
	self.close();
}

function clk(val)
{
//document.from.foccode.value=val;
}


function mySubmit()
{
	var cnt=0;
	document.from.foccode.value ="";
	document.from.foccode1.value ="";
	if(document.from.srno.value>2)
	{
		for (var i = 0; i < document.from.loc.length; i++) 
		{          
			if(document.from.loc[i].checked == true)
			{
				cnt++;
				if(document.from.foccode.value =="")
				{
					document.from.foccode.value=document.from.loc[i].value;
				}
				else
				{
					document.from.foccode.value = document.from.foccode.value +','+document.from.loc[i].value;
				}
				if(document.from.foccode1.value =="")
				{
					document.from.foccode1.value=document.from.loc[i].value;
				}
				else
				{
					document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.loc[i].value;
				}
			}
		}
	}
	else
	{
		if(document.from.loc.checked == true)
		{
			cnt++;
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.loc.value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.loc.value;
			}
			if(document.from.foccode1.value =="")
				{
					document.from.foccode1.value=document.from.loc.value;
				}
				else
				{
					document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.loc.value;
				}
		}
	}
	if(document.from.foccode.value=="")
	{
		alert("You must select Lots");
		return false;
	}
	if(cnt<2)
	{
		alert("You must select 2 or more Lots");
		return false;
	}
	return true;
}	
</script>
			
</head>
<body topmargin="0" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >

   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
<?php 
if($sqq!="")
{
$sss=" and lotno='".$sqq."'";
}
else
$sss="";

$arrlots="";
/*		$sql_tbl_sub=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$tid."'") or die(mysqli_error($link));
		 $tot_arrsub=mysqli_num_rows($sql_tbl_sub);
		if($tot_arrsub > 0)
		{
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($arrlots!="")
				{
					$arrlots=$arrlots.",".$row_tbl_sub['proslipsub_lotno'];
				}
				else
				{
					  $arrlots=$row_tbl_sub['proslipsub_lotno'];
				}
			}
		}*/
$qr="select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='".$stage."' and packtype='$ups' $sss  order by lotdgp_id desc";
$sql_tbl_sub=mysqli_query($link,$qr)or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
?><br />

<table border="0" width="400" cellspacing="0" cellpadding="0">
<tr >
<td align="right" valign="baseline"><img src="../images/back.gif" border="0" onClick="window.close()" style="vertical-align:baseline" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer; vertical-align:baseline" onclick="return mySubmit();"/>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Select Lot </td>
</tr>
<tr class="Dark" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Lot Number</td>
</tr>
<?php
if($tot_row > 0)
{
$srno=1;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{
$nsflg=0; //echo $row['lotno']."<br />";
$sql_issueg2=mysqli_query($link,"select min(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row['lotno']."'") or die(mysqli_error($link));
$row_issueg2=mysqli_fetch_array($sql_issueg2); 
$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg2[0]."'") or die(mysqli_error($link)); 
$totnog2=mysqli_num_rows($sql_issuetblg2);
while($row24=mysqli_fetch_array($sql_issuetblg2))
{	
	if($row24['trtype']=="NSTPNPSLIP")$nsflg++;
}
$flg=0; $flg1=0; $extnob=0; $extqty=0;
$sql_issueg21=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row['lotno']."'") or die(mysqli_error($link));
while($row_issueg21=mysqli_fetch_array($sql_issueg21))
{
$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row['lotno']."' and subbinid='".$row_issueg21['subbinid']."'") or die(mysqli_error($link));
$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
$totnog=mysqli_num_rows($sql_issuetblg);
if($totnog > 0)
{
while($row_24=mysqli_fetch_array($sql_issuetblg))
{				
				

if($row_24['lotldg_sstatus']!="")
{
	$ss=explode("/", $row_24['lotldg_sstatus']);
	$z=count($ss);
	for($i=0; $i<$z; $i++)
	{
	if($ss[$i]=="R") $flg++;
	if($ss[$i]=="Q") $flg++;
	}
}

/*$parray=explode(",", $arrlots);
foreach($parray as $val)
{
	if($val<>"")
	{
		if($row_24['lotno']==$val)
		{
			$flg++;
		}
	}
}*/

if($row_24['lotldg_dispflg']==1)
{
	$flg++;
}
if($row_24['lotldg_rvflg']>0)
{
	$flg++;
}
if($row_24['lotldg_spremflg']>0)
{
	$flg++;
}

if($row_24['lotldg_got']=="Fail" || $row_24['lotldg_qc']=="Fail")
$flg++; 
if($row_24['lotldg_got']=="BL")
$flg++;
if($row_24['lotldg_qc']=="BL")
$flg++;

$nop1=0;
$wtinmp=$row_24['wtinmp'];
$upspacktype=$row_24['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
	$ptp1=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
	$ptp1=$packtp[0];
}
$penqty=(($row_24['balqty'])-($wtinmp*$row_24['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}



$a=$row_24['lotno'];
$c=$row_24['lotldg_variety'];
$ups=$row_24['packtype'];
$extqty=$extqty+$row_24['balqty'];
$extnob=$extqty*$ptp;
$lotno=$a;
}
}
}

/*$zz=explode(" ", $row_24['lotldg_got1']);

if($zz[0]=="GOT-NR")
{
	/*if(($row['lotldg_got']=="UT" || $row['lotldg_got']=="RT") && $row['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if(($row_24['lotldg_qc']=="UT" || $row_24['lotldg_qc']=="RT") && $row_24['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row_24['lotldg_srflg']!=0 && $row_24['lotldg_srtyp']!="pack")
	{
		$flg++; 
	}
	if($row_24['lotldg_got']=="Fail" || $row_24['lotldg_qc']=="Fail")
	{
		$flg++; 
	}
}
else
{
	if(($row_24['lotldg_got']=="UT" || $row_24['lotldg_got']=="RT") && $row_24['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row_24['lotldg_got']=="OK" && ($row_24['lotldg_qc']=="UT" || $row_24['lotldg_qc']=="RT") && $row_24['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row_24['lotldg_srflg']!=0 && $row_24['lotldg_srtyp']!="pack")
	{
		$flg++; 
	}
	if($row_24['lotldg_got']=="Fail" || $row_24['lotldg_qc']=="Fail")
	{
		$flg++; 
	} 
}*/

$zzz=implode(",", str_split($row_24['lotno']));
$lot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];

$sql_arrsub=mysqli_query($link,"Select arrival_id from tblarrival_sub where plantcode='$plantcode' and orlot='".$lot."'") or die (mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_arrsub);
if($tot_arrsub > 0)
{
$row_arrsub=mysqli_fetch_array($sql_arrsub);

$sql_arr=mysqli_query($link,"Select arrival_date from tblarrival where plantcode='$plantcode' and arrival_id='".$row_arrsub[0]."'") or die (mysqli_error($link));
$row_arr=mysqli_fetch_array($sql_arr);

	$tdate5=$row_arr[0];
	$tyear5=substr($tdate5,0,4);
	$tmonth5=substr($tdate5,5,2);
	$tday5=substr($tdate5,8,2);
	$tdate5=$tday5."-".$tmonth5."-".$tyear5;
	
	$now = strtotime($tdate5); // or your date as well
    $your_date = strtotime($dop);
	if($your_date<$now)$flg++;
}
	$tdate5="";
	$tdate5=$row_24['lotldg_qctestdate'];
	$tyear5=substr($tdate5,0,4);
	$tmonth5=substr($tdate5,5,2);
	$tday5=substr($tdate5,8,2);
	$tdate5=$tday5."-".$tmonth5."-".$tyear5;
	if($tdate5=="--" || $tdate5=="0000-00-00" || $tdate5=="NULL" || $tdate5=="- -")$tdate5="";
	
	if($tdate5!="")
	{
		$now = strtotime($tdate5); // or your date as well
		$your_date = strtotime($dop);
		if($your_date<$now)
		{
			$sql_srf=mysqli_query($link,"select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='$lot'") or die(mysqli_error($link));
			if($tot_srf=mysqli_num_rows($sql_srf) > 0)
			{
				$row_srf=mysqli_fetch_array($sql_srf);
				$sql_srf2=mysqli_query($link,"select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_srf[0]."'") or die(mysqli_error($link));
				$row_srf2=mysqli_fetch_array($sql_srf2);
				$tdate15="";
				$tdate15=$row_srf2['softr_date'];
				$tyear15=substr($tdate15,0,4);
				$tmonth15=substr($tdate15,5,2);
				$tday15=substr($tdate15,8,2);
				$tdate15=$tday15."-".$tmonth15."-".$tyear15;
				if($tdate15=="--" || $tdate15=="0000-00-00" || $tdate15=="NULL" || $tdate15=="- -")$tdate15="";
				
				if($tdate15!="")
				{
					$now2 = strtotime($tdate15); // or your date as well
					$your_date2 = strtotime($dop);
					if($your_date2>$now2)$flg++;
				}
				else
				{
					$flg++;
				}
			}
			else
			{
				$flg++;
			}
		}
	}
	
	/*$tdate6="";
	$tdate6=$row_24['lotldg_gottestdate '];
	$tyear6=substr($tdate6,0,4);
	$tmonth6=substr($tdate6,5,2);
	$tday6=substr($tdate6,8,2);
	$tdate6=$tday6."-".$tmonth6."-".$tyear6;
	if($tdate6=="--" || $tdate6=="0000-00-00" || $tdate6=="NULL" || $tdate6=="- -")$tdate6="";
	
	if($tdate6!="")
	{
		$now = strtotime($tdate6); // or your date as well
		$your_date = strtotime($dop);
		if($your_date<$now)$flg++;
	}*/




$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
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
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$lotno' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$nompnl+$ct; 
			}
		}
		
	}
}
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;	
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+qtynl;	
$qty=$extqty-$totextqtys;
$nob=$extnob-$totextpouches;
//$qty=$nob*$ptp1;
//echo $a."  -  ".$nob."  -  ".$qty."  -  ".$flg."<br/>";
if($nob==0)$flg++;
if($qty==0)$flg++;	
if($nsflg>0)$flg++;	
//echo $flg;
if($flg==0)
{
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" value="<?php echo $row['lotno'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotno'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" value="<?php echo $row['lotno'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotno'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
}
}
}
else
{
?>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot numbers not found reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot numbers not Imported</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number not Generated using this Crop and Variety.</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. QC and/or GOT result is pending for the Lot number(s).</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. Seed is Reserved for the Lot number(s).</td>
</tr>
<?php
}
//echo $srno;
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="right"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/>&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
