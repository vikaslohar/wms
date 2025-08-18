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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - SP Cycle Inventory Print Preview</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
   <?php
	$tid=$pid;
	$trid=$pid;
	
	$sql1=mysqli_query($link,"select * from tbl_ci where ci_id='$tid' and plantcode='$plantcode'")or die(mysqli_error($link));
	$row=mysqli_fetch_array($sql1);
	
	$tdate=$row['ci_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">SP Cycle Inventory</td>
</tr>
 

<tr class="Dark" height="25">
           <td width="200" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
            <td width="415"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TCI".$row['ci_tcode']."/".$row['ci_yearcode']."/".$row['ci_logid'];?></td>
		   
		   <td width="64" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="161" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
		   </tr>
<?php 
$classqry=mysqli_query($link,"select * from tblcrop where cropid='".$row['ci_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Light" height="25">
   <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td width="268" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $noticia_class['cropid'];?>" />&nbsp;<font color="#FF0000">*</font></td>

<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ci_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item = mysqli_fetch_array($itemqry);
?>            
         
<td width="102" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="317" align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" /></td>
</tr><input type="hidden" name="itmdchk" value="" />

<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<!-- <tr class="Light" height="25">
            <td width="153" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
   
	<option value="<?php echo $a;?>" selected ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  onchange="slocshow2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After entry of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /><input type="hidden" name="txtlot1" value="" /></td>	 
         </tr>-->	
</table>
</br>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">SP Cycle Inventory Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Old Lot No.</td>
	<td width="143" align="center" class="smalltblheading">New Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="73" align="center" class="smalltblheading">Edit</td>
	<td width="72" align="center" class="smalltblheading">Delete</td>-->
</tr>
<?php
$sr=1;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_cisub where ci_id='$tid' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage=$row_eindent_sub['cisub_stage'];
$lotn=$row_eindent_sub['cisub_newlotno'];
$olotn=$row_eindent_sub['cisub_lotno'];
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['cisub_crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
$classid=$noticia_class['cropname'];

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['cisub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_eindent_sub['cisub_variety'];
}
$slups=0; $slqty=0; 
$sql_tblissue=mysqli_query($link,"select * from tbl_cisub_sub where ci_id='".$trid."' and cisub_id='".$row_eindent_sub['cisub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ciss_nob'];
$slqty=$slqty+$row_tblissue['ciss_qty'];
}

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $classid;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $itemid;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $stage;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['cisub_id'];?>,<?php echo $row_eindent_sub['ci_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ci_id'];?>,<?php echo $row_eindent_sub['cisub_id'];?>);" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $classid;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $itemid;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $stage;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['cisub_id'];?>,<?php echo $row_eindent_sub['ci_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ci_id'];?>,<?php echo $row_eindent_sub['cisub_id'];?>);" /></td>-->
</tr>
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />

<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</td></tr>
</table>

</body>
</html>
