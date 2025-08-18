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
<title>Stores- Transaction- Material Discard Note</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
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
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  

   <?php
	$sql1=mysqli_query($link,"select * from tbl_ivtmain where plantcode='$plantcode' and ivt_id=$pid")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);
$tid=$pid;
$subtid=0;
 
$tdate=$row['ivt_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;

$code="TVT".$row['ivt_tcode']."/".$row['ivt_yearid']."/".$row['ivt_logid'];	
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Add Inter Variety Transfer</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
           <td width="202" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID&nbsp;</td>
           <td width="268"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code?></td>
		   
		   <td width="183" height="24"  align="right"  valign="middle" class="tblheading">IVT&nbsp;Date&nbsp;</td>
           <td width="287" align="left"  valign="middle">&nbsp;<?php echo $tdate;?><input name="txtdate" type="hidden" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>" /></td>
</tr>
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['ivt_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Dark" height="25">
   <td width="202"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden"  class="tbltext" name="txtclass" value="<?php echo $noticia_class['cropid'];?>"  /></td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_pvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver = mysqli_fetch_array($itemqry);
?>            
<td align="right" valign="middle" class="tblheading">Production Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="vitem" >&nbsp;<?php echo $noticia_ver['popularname'];?><input type="hidden"  class="tbltext" name="txtitem" id="itm" value="<?php echo $noticia_ver['varietyid'];?>"  /></td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
  <?php 
$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trfromvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver2 = mysqli_fetch_array($itemqry2);

$itemqry3=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trtovariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver3 = mysqli_fetch_array($itemqry3);
?>            
	<td align="right" valign="middle" class="tblheading">Transfer From - Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="frvitem">&nbsp;<?php echo $noticia_ver2['popularname'];?><input type="hidden"  class="tbltext" name="txtfritem" id="fritm" value="<?php echo $noticia_ver2['varietyid'];?>"  /></td>
<td align="right" valign="middle" class="tblheading">Transfer To - Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="tovitem">&nbsp;<?php echo $noticia_ver3['popularname'];?><input type="hidden"  class="tbltext" name="txttoitem" id="toitm" value="<?php echo $noticia_ver3['varietyid'];?>"  /></td>
</tr>		
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
<td width="1%" align="center" valign="middle" class="tblheading">Inter Variety Transfer Lots(N)</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
	<td width="1%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Original Lot No.</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Entire/Partial</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">New Lot No.</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="9%" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<!--<td width="3%" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Delete</td>-->
</tr>

<?php
$sr=1;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_ivtsub where plantcode='$plantcode' and ivt_id=$tid") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage='Condition';
$olotn=$row_eindent_sub['ivts_olotno'];
$lotn=$row_eindent_sub['ivts_nlotno'];
$onob=$row_eindent_sub['ivts_onob'];
$oqty=$row_eindent_sub['ivts_oqty'];
$ttntyp=$row_eindent_sub['ivts_trnall'];
if($ttntyp=="E")$ttntyp="Entire";
if($ttntyp=="P")$ttntyp="Partial";
$slups=0; $slqty=0; $sloc=""; 
$sql_tblissue=mysqli_query($link,"select * from tbl_ivtsub_sub2 where plantcode='$plantcode' and ivt_id='".$tid."' and ivts_id='".$row_eindent_sub['ivts_id']."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ivtss2_nob'];
$slqty=$slqty+$row_tblissue['ivtss2_qty'];

$wareh=""; $binn=""; $subbinn="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tblissue['ivtss2_wh']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tblissue['ivtss2_subbin']."' and binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($sloc!="")
$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
else
$sloc=$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
}

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $onob;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $oqty;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $ttntyp;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $sloc;?></td>
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $onob;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $oqty;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $ttntyp;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $sloc;?></td>
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>-->
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
