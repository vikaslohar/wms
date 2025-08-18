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

	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - SP Cycle Inventory - SPCIN</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<?php 
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<HR width="750" align="center" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">SP Cycle Inventory Note (SPCIN)</font></td>
</tr>
</table><br />	  

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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">SPCI&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;SPCI No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "CI".$row['ci_code']."/".$row['ci_yearcode']."/".$row['ci_logid'];?></td>
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
</tr>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
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

</br>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="40" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="164" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="176" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="119" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />

<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
--><br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="87" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="145"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="80" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="149" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="159" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="130" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>

	    </table><br />

<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="cc_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
