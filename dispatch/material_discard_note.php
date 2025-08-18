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

	
	$tp="MD";
	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
	
/*$a="IE";
	$sql_code="SELECT MAX(issue_code) FROM tblissue where issue_type='pindent' ORDER BY issue_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - MDN</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
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
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;CIN:&nbsp;<?php echo $row_param['cin'];?>&nbsp;&nbsp;Seed License No.:&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<HR width="750" align="center" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Material Discard Note (MDN)</font></td>
</tr>
</table><br />	  

   <?php
	$sql1=mysqli_query($link,"select * from tbl_discard where plantcode='".$plantcode."' and  tid='".$pid."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; $erid=0;
	$t=mysqli_num_rows($sql1);
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
	
	$code1="MD".$row['dd_code'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Discard&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;MDN No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "MD".$row['dd_code']."/".$row['yearcode']."/".$row['ncode'];?></td>
</tr>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Discard &nbsp;Instruction Ref. No.&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $row['drno'];?></td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="Top" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row['party_name'];?><br /><?php echo $row['address']." ".$row['address1']." ".$row['city']." ".$row['pin']." ".$row['state'];?><br />Ph: <?php echo $row['phoneno'];?></div></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">GSTIN&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><?php if($noticia['gstin']!="") { echo $noticia['gstin']; }?></td>
</tr>
<?php
if($row['tmode'] == "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo "Not Applicable"; ?></td>
</tr>
<?php
}
if($row['tmode'] != "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['tmode'];?></td>
</tr>
<?php
if($row['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['tname'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['lrno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['vno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row['pmode'] == "ToPay")
$pmode="To Pay";
else
$pmode=$row['pmode'];
echo $pmode;?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['cname'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['dcno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
}
?>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

			 <tr class="tblsubtitle" height="20">
              <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="28%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
              <td width="39%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  
                  <td colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
          </tr>
			<tr class="tblsubtitle">
			  <td width="9%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$srno=1; $totnob=0; $totqty=0;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_discard_sub where plantcode='".$plantcode."' and  did_s='".$pid."'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_eindent_sub['variety'];
}

if($trid > 0)
{
$sql_tblissue=mysqli_query($link,"select * from tbl_discard_sloc where plantcode='".$plantcode."' and  discard_trid='".$trid."' and discard_id='".$row_eindent_sub['did']."' and crop='".$row_eindent_sub['crop']."' and variety='".$row_eindent_sub['variety']."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; 
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_tblissue['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_tblissue['ups_discard'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_discard'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$balups+$row_tblissue['ups_discard'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";
$balqty=$balqty+$row_tblissue['qty_discard'];

if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysqli_query($link,"select * from tbl_stldg_damage where plantcode='".$plantcode."' and  stld_id='".$row_tblissue['discard_rowid']."'") or die(mysqli_error($link));
$row_stldg1=mysqli_fetch_array($sql_stldg1); 

$opups=$opups+$row_stldg1['stld_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stld_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['discard_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $erid=0;
}

$totnob=$totnob+$slups;
$totqty=$totqty+$slqty;
if($srno%2!=0)
{
?>		  
 <tr class="Light" height="20">
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			 <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['cropname'];?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $itemid;?></td>
    <td align="center" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['lotnumber']?></td>
             <td width="9%" align="center" valign="middle" class="tbltext"><?php echo $slups;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $slqty;?></td>
		  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />

<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			 <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['cropname'];?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $itemid;?></td>
    <td align="center" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['lotnumber']?></td>
             <td width="9%" align="center" valign="middle" class="tbltext"><?php echo $slups;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $slqty;?></td>
		  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
<?php 
}
$srno=$srno+1;	
}
if($totqty > 0)
{
?>	
<tr class="Dark" height="20">
<td width="8%" align="right" valign="middle" class="tbltext" colspan="4">Grand Total&nbsp;</td>
<td width="9%" align="center" valign="middle" class="tbltext"><?php echo $totnob;?></td>
<td width="8%" align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
?>		  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="127" align="right"  valign="middle" class="tblheading">&nbsp;Return Status&nbsp;</td>
<td width="617" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['rettyp'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="127" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"><div style="padding-left:3px"><?php echo $row['remarks'];?></div></td>
</tr>
</table>
</br>
<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="65" align="right"  valign="middle" class="tblheading">&nbsp;GST No.:&nbsp;</td>
<td width="139" align="left"  valign="middle" class="tbltext">&nbsp;<?php //echo $row_param['gstin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td width="176" align="left"  valign="middle" class="tbltext">&nbsp;</td>

<td width="119" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<?php //echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />-->


<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
--><br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
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
