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

	if(isset($_GET['a']))
	{
  		$a = $_GET['a'];	 
	}
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where orlot='".$a."'  and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $sstage=""; $crop=""; $variety="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nob=$nob+$row_issuetbl['lotldg_balbags']; 
$qty=$qty+$row_issuetbl['lotldg_balqty'];
$sstage=$row_issuetbl['lotldg_sstage'];

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];

$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
$trdate=$row_issuetbl['lotldg_qctestdate'];
$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
$qcdttype="DOT";
}
else
{
	$zz=str_split($a);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
		$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
		//echo $row_softr_sub[0];
		$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_softr=mysqli_num_rows($sql_softr);
		$row_softr=mysqli_fetch_array($sql_softr);
		if($tot_softr > 0)
		{
		$trdate=$row_softr['softr_date'];
		$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
		if($qcdot2=="")
		{
		$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
		if($tot_softr_sub2 > 0)
		{
		$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
		//echo $row_softr_sub2[0];
		$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_softr2=mysqli_num_rows($sql_softr2);
		$row_softr2=mysqli_fetch_array($sql_softr2);
		if($tot_softr2 > 0)
		{
		$trdate=$row_softr2['softr_date'];
		$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";
if($qcdot!="")
{
	$trdate2=explode("-",$qcdot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
		$m=$trdate2[1];
		$de=$trdate2[2];
		$y=$trdate2[0];
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
?>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">Crop&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
	<td width="75" align="right" class="smalltblheading">Variety&nbsp;</td>
	<td width="166" align="left" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
	<td width="115" align="right" class="smalltblheading">Stage&nbsp;</td>
	<td width="100" align="left" class="smalltblheading">&nbsp;<?php echo $sstage;?></td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">QC Status&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $qc;?></td>
	<td width="75" align="right" class="smalltblheading"><?php echo $qcdttype?>&nbsp;</td>
	<td width="166" align="left" class="smalltblheading">&nbsp;<?php echo $qcdot;?><input type="hidden" name="qctestdate" value="<?php echo $qcdot;?>" /><input type="hidden" name="qctdate" value="<?php echo $qcdot;?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="qcdttype" value="<?php echo $qcdttype;?>" /></td>
	<td width="115" align="right" class="smalltblheading">Soft Release Status&nbsp;</td>
	<td width="100" align="left" class="smalltblheading">&nbsp;<?php if($qcdttype=="DOT") echo "Not Applicable"; else if($qcdttype=="DOSF" && $qcdot!="") echo "Activated"; else if($qcdttype=="DOSF" && $qcdot=="") echo "Not Activated"; else echo "";?></td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">Validity Period&nbsp;</td>
	<td align="left" class="smalltblheading" colspan="5">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="3" >3</option>
<option value="6" >6</option>
<option value="9" >9</option>
</select>&nbsp;Months</td>
</tr>
</table>
<br />
<div id="dovdetails">
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
<tr class="Light" height="30">
	<td width="90" align="right" class="smalltblheading">Valid upto&nbsp;</td>
	<td width="180" align="left" class="smalltblheading">&nbsp;<input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="15" readonly="true" style="background-color:#ECECEC"  /></td>
	<td width="90" align="right" class="smalltblheading">Validity Days&nbsp;</td>
	<td width="180" align="left" class="smalltblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From <?php echo $qcdttype?></td>
</tr>
</table>
</div>
<?php
}
else
{
?>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Details not found for the selected Lot Number</td>
</tr>
</table>
<?php
}
?>