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

	$tp ="Pack";

	if(isset($_REQUEST['crop']))
	{
	$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['variety']))
	{
	$variety = $_REQUEST['variety'];
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
	
	if(isset($_POST['sub']))
	{
	
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
<title>Packaging - Transaction - Lot Selection</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script language='javascript'>
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function post_value()
{
	/*if(document.from.foccode2.value>0)
	{
		if(confirm("You are releasing the Lot having QC/GOT status as FAIL.\nDo you wish to continue?")==true)
		{
			opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
			opener.spmchk(document.from.foccode.value);
			self.close();
		}
		else
		{
			return false;
		}
	}
	else
	{*/
		opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
		//opener.spmchk(document.from.foccode.value);
		self.close();
	//}
}

function clk(val,val1,val2)
{
document.from.foccode.value=val;
document.from.foccode1.value=val1;
document.from.foccode2.value=val2;
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
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8+"C";
	window.location='getuser_p2c_lotno.php?crop='+val3+'&variety='+val4+'&sqq='+txtlot1;
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
 
   <?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
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
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  />
	   <b>P</b>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> -->
    </form>
 </td></tr></table>
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		</br>
<?php 

if($sqq!="")
{
$sss=" and lotno='".$sqq."'";
}
else
$sss="";
$qr="select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$ups."' $sss   group by lotno order by lotdgp_id desc";

$sql_tbl_sub1=mysqli_query($link,$qr) or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub1);
?>
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
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Lot </td>


</tr>
<?php
if($tot_row > 0)
{
$srno=1; $ltnon="";
while ($row1=mysqli_fetch_array($sql_tbl_sub1))
{
//echo $row1['lotdgp_id'];
$qr1="select * from tbl_lot_ldg_pack where  plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$ups."' and lotdgp_id='".$row1[0]."'";

$sql_tbl_sub=mysqli_query($link,$qr1) or die(mysqli_error($link));
while ($row=mysqli_fetch_array($sql_tbl_sub))
{
$flg=0; $flg1=0;
if($row['lotldg_sstatus']!="")
{
	$ss=explode("/", $row['lotldg_sstatus']);
	$z=count($ss);
	for($i=0; $i<$z; $i++)
	{
	if($ss[$i]=="R") $flg++;
	}
}

if($row['lotldg_alflg']>0)
{
	$flg++;
	if($ltnon!="")
		$ltnon=$ltnon.",".$row['lotno'];
	else
		$ltnon=$row['lotno'];	
}

if($row['lotldg_dispflg']==1)
{
	$flg++;
	/*if($ltnon!="")
		$ltnon=$ltnon.",".$row['lotno'];
	else
		$ltnon=$row['lotno'];*/	
}
//echo $flg;
if($row['lotldg_rvflg']>0)
{
	$flg++;
	if($ltnon!="")
		$ltnon=$ltnon.",".$row['lotno'];
	else
		$ltnon=$row['lotno'];	
}
if($row['lotldg_spremflg']>0)
{
	$flg++;
	if($ltnon!="")
		$ltnon=$ltnon.",".$row['lotno'];
	else
		$ltnon=$row['lotno'];	
}

//$zz=explode(" ", $row['lotldg_got1']);
//echo $row['lotldg_qc'];
if(($row['lotldg_qc']=="UT" || $row['lotldg_qc']=="RT"))
{
	$flg++; 
	if($ltnon!="")
		$ltnon=$ltnon.",".$row['lotno'];
	else
		$ltnon=$row['lotno'];
}
if($row['lotldg_got']=="Fail" || $row['lotldg_qc']=="Fail")
{
	$flg++; 
	/*if($ltnon!="")
		$ltnon=$ltnon.",".$row['lotno'];
	else
		$ltnon=$row['lotno'];	*/
} 	

/*if($zz[0]=="GOT-NR")
{
	if(($row['lotldg_got']=="UT" || $row['lotldg_got']=="RT") && $row['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if(($row['lotldg_qc']=="UT" || $row['lotldg_qc']=="RT") && $row['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row['lotldg_got']=="Fail" || $row['lotldg_qc']=="Fail")
	{
		$flg++; 
	}
}
else
{
	if(($row['lotldg_got']=="UT" || $row['lotldg_got']=="RT") && $row['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row['lotldg_got']=="OK" && ($row['lotldg_qc']=="UT" || $row['lotldg_qc']=="RT") && $row['lotldg_srflg']==0)
	{
		$flg++; 
	}
	if($row['lotldg_got']=="Fail" || $row['lotldg_qc']=="Fail")
	{
		$flg++; 
	} 
}*/

//echo $row['lotno']."<br/>";
$ccnt=0; $nop=0; $qty=0; $nomp=0;
$sql_is=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row['lotno']."' and packtype='".$ups."' group by subbinid, binid order by lotdgp_id asc") or die(mysqli_error($link));
$xt=mysqli_num_rows($sql_is);
 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and lotno='".$row['lotno']."' order by lotdgp_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 
//echo $row_is1[0]."  ";
$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
while($row_istbl=mysqli_fetch_array($sql_istbl))
{
$ccnt++;
$nop1=0; $ptp1=0;
$wtinmp=$row_istbl['wtinmp'];
$upspacktype=$row_istbl['packtype'];
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
if($row_istbl['balnomp']>0)
$penqty=(($row_istbl['balqty'])-($wtinmp*$row_istbl['balnomp']));
else
$penqty=$row_istbl['balqty'];
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

$nop=$nop+$nop1; 
$nomp=$nomp+$row_istbl['balnomp'];
$qty=$qty+$row_istbl['balqty'];
}
}
}
//echo $row['lotno']."  =  ".$nop."  =  ".$nomp."  =  ".$qty."  =  ".$flg."<br />";
if($nop==0)
{
$flg++;
}
if($nomp>0)
{
$flg++;
if($ltnon!="")
$ltnon=$ltnon.",".$row['lotno'];
else
$ltnon=$row['lotno'];
}
//echo $trid;
/*if($trid!="" && $trid > 0)
{
$sqltbl=mysqli_query($link,"select * from tbl_pswrem where pswrem_id='".$trid."'") or die(mysqli_error($link));
$rowtbl=mysqli_fetch_array($sqltbl);
$tot=mysqli_num_rows($sqltbl);		
$arrival_id=$rowtbl['pswrem_id'];

$sqltblsub=mysqli_query($link,"select * from tbl_pswrem_sub where pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sqltblsub);
while($rowtblsub=mysqli_fetch_array($sqltblsub))
{
//echo $rowtblsub['lotnumber']."-".$row['lotno'];
if($rowtblsub['lotnumber']==$row['lotno'])
{
$flg++;
}
}
}*/
//echo $ccnt."  =-=  ".$row['lotno'];
if($ccnt==0)
{
$flg++;
}
//echo "-".$flg."<br>";

if($flg==0)
{
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotno'];?>" onclick="clk(this.value,'<?php echo $row['lotno'];?>','<?php echo $flg1?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotno'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotno'];?>" onclick="clk(this.value,'<?php echo $row['lotno'];?>','<?php echo $flg1?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotno'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
}
else
{
/*if($ltnon!="")
$ltnon=$ltnon.",".$row['lotno'];
else
$ltnon=$row['lotno'];*/
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
  <td colspan="4" align="left" class="tblheading">&nbsp;4. Seed is Reserved for the Lot number(s).</td>
</tr>
<?php
}
?>
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
<input type="hidden" name="foccode2" value="" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
<?php
if($ltnon!="")
{
?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
<td width="44" align="right" valign="middle" class="tblheading">&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Non-Selectable Lots </td>
</tr>
<?php
$lntn=explode(",",$ltnon);
foreach($lntn as $ltval)
{
if($ltval <> "")
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext">&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $ltval;?></td>
</tr>
<?php
}
}
?>  
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Above Lot numbers cannot be Selected reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. QC result is pending for the Lot number(s).</td>
</tr>
<!--<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. QC result is FAIL for the Lot number(s).</td>
</tr>-->
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number(s) already under Re-Printing.</td>
</tr>
<!--<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. Lot number(s) already Dispatched.</td>
</tr>-->
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. Lot number(s) already Allocated.</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;4. Master Packs are present with Lot number(s).</td>
</tr>
</table>
<?php
}
?>

</form>
</td></tr>
</table>

</body>
</html>
