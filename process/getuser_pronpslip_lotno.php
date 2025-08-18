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
<title>Processing - Transaction - Processing and Packing Slip</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script language='javascript'>

function post_value()
{
opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
self.close();
}

function clk(val)
{
document.from.foccode.value=val;
}



function slocshow()
{
	if(document.from1.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		//document.from1.txtlot2.value="";
		document.from1.stcode.value="00000";
		return false;
	}
}

function ycodchk()
{
		document.from1.txtlot2.value="";
		document.from1.stcode.value="00000";
}

function lot2chk()
{
	if(document.from1.ycodee.value=="")
	{
		alert("Invalid Lot Number");
		document.from1.txtlot2.value="";
		document.from1.stcode.value="00000";
		return false;
	}
	else
	{
		document.from1.stcode.value="00000";
	}
}
function lotchk()
{	
	val2=document.from1.ycodee.value;
	val5=document.from1.txtlot2.value;
	val6=document.from1.stcode.value;
	val7=document.from1.pcode.value;
	val8=document.from1.stcode2.value;
	var f=0;
	if(val7=="")
	{
		alert("Please Select Plant code");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
	if(val8=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
	if(f==1)
	{
	return false;
	}
	else
	{
	val3=document.from1.crop.value;
	val4=document.from1.variety.value;
	val2=document.from1.ycodee.value;
	val5=document.from1.txtlot2.value;
	val6=document.from1.stcode.value;
	val7=document.from1.pcode.value;
	val8=document.from1.stcode2.value;
	var stage=document.from1.stage.value;
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
	if(stage=="Raw")txtlot1=txtlot1+"R";
	if(stage=="Condition")txtlot1=txtlot1+"C";
	if(stage=="Pack")txtlot1=txtlot1+"P";
	window.location='getuser_proslip_lotno.php?crop='+val3+'&variety='+val4+'&sqq='+txtlot1+'&stage='+stage;
	return true;	
	}
}	

function mySubmit()
{
if(document.from.foccode.value=="")
{
alert("You must select Lot");
return false;
}
return true;
}	
</script>
			
</head>
<body topmargin="0" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Search Lot Number</td>
</tr>
  <tr class="Light" height="25">
<td colspan="4" align="center" valign="middle"><table border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="middle" >
 <form name="from1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="lotchk();" >
 <input type="hidden" name="crop" value="<?php echo $crop?>" />
  <input type="hidden" name="variety" value="<?php echo $variety?>" />
  <input type="hidden" name="stage" value="<?php echo $stage?>" />
 
   <?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 

   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>
 <select class="tbltext" name="pcode" style="width:40px;">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00" />
	   <?php if($stage=="Raw"){?><b>R</b><?php } else if($stage=="Condition"){?><b>C</b><?php } else if($stage=="Pack"){?><b>P</b><?php } else{?> <?php }?>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> -->
    </form>
 </td></tr></table>
</td>
</tr>
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
<?php 
if($sqq!="")
{
$sss=" and lotldg_lotno='".$sqq."'";
}
else
$sss="";


$arrlots="";
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
		 $tot_arrsub=mysqli_num_rows($sql_tbl_sub);
		if($tot_arrsub > 0)
		{
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($arrlots!="")
				{
					$arrlots=$arrlots.",".$row_tbl_sub['pnpslipsub_lotno'];
				}
				else
				{
					  $arrlots=$row_tbl_sub['pnpslipsub_lotno'];
				}
			}
		}
		$sql_tbl_main=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_tflag!=1 and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_arrmain=mysqli_num_rows($sql_tbl_main);
		if($tot_arrmain > 0)
		{
			while($row_tbl_main=mysqli_fetch_array($sql_tbl_main))
			{
				$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$row_tbl_main['pnpslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$tot_arrsub=mysqli_num_rows($sql_tbl_sub);
				if($tot_arrsub > 0)
				{
					while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
					{
						if($arrlots!="")
						{
							$arrlots=$arrlots.",".$row_tbl_sub['pnpslipsub_lotno'];
						}
						else
						{
							  $arrlots=$row_tbl_sub['pnpslipsub_lotno'];
						}
					}
				}
			}
		}
$qr="select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='".$stage."' and lotldg_mergerflg=0 $sss and plantcode='$plantcode' order by lotldg_id desc";
$sql_tbl_sub=mysqli_query($link,$qr) or die(mysqli_error($link));

//$aaaass="select distinct(lotldg_lotno)  from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='".$stage."' and lotldg_balqty > 0 $sss order by lotldg_id desc";			
$sql_tbl_sub=mysqli_query($link,$qr)or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
?><br />

<table border="0" width="400" cellspacing="0" cellpadding="0">
<tr >
<td align="right" valign="baseline"><img src="../images/back.gif" border="0" onClick="window.close()" style="vertical-align:baseline" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer; vertical-align:baseline" onclick="return mySubmit();"/>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="3" align="center" class="tblheading">Select Lot </td>
</tr>
<tr class="Dark" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Qty (in Kgs.)</td>
</tr>
<?php
if($tot_row > 0)
{
$srno=1;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row['lotldg_lotno']."'  and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
if($tot_row > 0)
{
$nob=0; $qty=0;
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$qty=$qty+$row_issuetbl['lotldg_balqty'];
}
}
}
if($qty > 0)
{
$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_lotno='".$row['lotldg_lotno']."' and lotldg_mergerflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_mergerflg=0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
$totnog=mysqli_num_rows($sql_issuetblg);
if($totnog > 0)
{
while($row_24=mysqli_fetch_array($sql_issuetblg))
{				
				
$flg=0; $flg1=0;
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

$parray=explode(",", $arrlots);
foreach($parray as $val)
{
	if($val<>"")
	{
		if($row_24['lotldg_lotno']==$val)
		{
		$flg++;
		}
	}
}

$zz=explode(" ", $row_24['lotldg_got1']);
if($row_24['lotldg_got']=="Fail" || $row_24['lotldg_qc']=="Fail")
$flg++; 
if($row_24['lotldg_got']=="BL")
$flg++;
if($row_24['lotldg_qc']=="BL")
$flg++;
if($zz[0]=="GOT-NR")
{
	/*if(($row['lotldg_got']=="UT" || $row['lotldg_got']=="RT") && $row['lotldg_srflg']==0)
	{
		$flg++; 
	}*/
	if(($row_24['lotldg_qc']=="UT" || $row_24['lotldg_qc']=="RT") && $row_24['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row_24['lotldg_srflg']!=0 && $row_24['lotldg_srtyp']!="pack" && $row_24['lotldg_srtyp']!="dispatch")
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
	if($row_24['lotldg_srflg']!=0 && $row_24['lotldg_srtyp']!="pack" && $row_24['lotldg_srtyp']!="dispatch")
	{
		$flg++; 
	}
	if($row_24['lotldg_got']=="Fail" || $row_24['lotldg_qc']=="Fail")
	{
		$flg++; 
	} 
}

$zzz=implode(",", str_split($row_24['lotldg_lotno']));
$lot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$sql_arrsub=mysqli_query($link,"Select arrival_id from tblarrival_sub where orlot='".$lot."' and plantcode='$plantcode'") or die (mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_arrsub);
if($tot_arrsub > 0)
{
$row_arrsub=mysqli_fetch_array($sql_arrsub);

$sql_arr=mysqli_query($link,"Select arrival_date from tblarrival where arrival_id='".$row_arrsub[0]."' and plantcode='$plantcode'") or die (mysqli_error($link));
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
			$sql_srf=mysqli_query($link,"select max(softr_id) from tbl_softr_sub where softrsub_lotno='$lot' and plantcode='$plantcode'") or die(mysqli_error($link));
			if($tot_srf=mysqli_num_rows($sql_srf) > 0)
			{
				$row_srf=mysqli_fetch_array($sql_srf);
				$sql_srf2=mysqli_query($link,"select * from tbl_softr where softr_id='".$row_srf[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
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
	
	$oflsub=mysqli_query($link,"select pnpslipsub_id from tbl_oflpnpslipsub where pnpslipsub_lotno='".$row_24['lotldg_lotno']."' and pnpslipsub_availpqty=$qty and pnpslipsub_syncflg=1") or die(mysqli_error($link));
	if($tot_oflsub=mysqli_num_rows($oflsub)>0)
	{
		$flg++;
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
	
//echo $flg;
if($flg==0)
{
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row_24['lotldg_lotno'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_24['lotldg_lotno'];?></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $qty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row_24['lotldg_lotno'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_24['lotldg_lotno'];?></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $qty;?></td>
</tr>     
<?php
}
 $srno=$srno+1;
}
}
}
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
?>
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
