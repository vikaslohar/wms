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
$zzz=implode(",", str_split($a));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
$baselot2=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26];
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where  SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where  SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$mxlot=$abc2;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2;

$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $sstage=""; $crop=""; $variety="";



$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  orlot='".$a."'  and lotldg_balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
if($tot_row > 0)
{
	
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$a."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where  lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 

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
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($row_issuetbl['lotldg_got']=='UT' || $row_issuetbl['lotldg_got']=='RT')
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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
		$qcdttype="DOSF";
	}
	
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
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	$de=$de-1;
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}

if($qty>0 and $nob==0)$nob=1;
?>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Entered Lot-Batch Number Details<input type="hidden" name="lotnmo" value="<?php echo $a; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" /></td>
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
	<td width="85" align="right" class="smalltblheading">NoB&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $nob;?></td>
	<td width="75" align="right" class="smalltblheading">Qty&nbsp;</td>
	<td align="left" class="smalltblheading" colspan="3">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">Batch&nbsp;<br />
Conversion&nbsp;</td>
	<td align="left" class="smalltblheading" colspan="5">&nbsp;<input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="chkvalidity(this.value);" />&nbsp;Pick Entire&nbsp;&nbsp;<input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="chkvalidity(this.value);"  />&nbsp;Pick Partial</td>
</tr>
</table>
<br />
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="33%" align="right" class="smalltblheading">NEXT POSSIBLE - Batch Number&nbsp;</td>
	<td width="67%" align="left" class="smalltbltext">&nbsp;<input type="text" name="txtbatchno" id="txtbatchno" class="subheading" value="" size="16" readonly="true" style="background-color:#CCCCCC; color:#B90000; font-size:18px" />&nbsp;* Subject to immediate genration</td>
</tr>
</table>
<br />

<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="5">Lot - Related Batch Number Details</td>
</tr>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading">#</td>
	<td align="center" class="smalltblheading">Lot/Batch No.</td>
	<td align="center" class="smalltblheading">Stage/UPS</td>
	<td align="center" class="smalltblheading">NoB/NoP</td>
	<td align="center" class="smalltblheading">Qty</td>
</tr>
<?php
$sno=1;
$sq=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg WHERE  SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot' order by lotldg_id asc")or die("Error:".mysqli_error($link));
$totrow=mysqli_num_rows($sq);
if($totrow > 1)
$sq=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg WHERE  SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot' order by lotldg_id asc limit 1,1")or die("Error:".mysqli_error($link));
while($rowissue=mysqli_fetch_array($sq))
{ 
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg WHERE  SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot' and lotldg_lotno='".$rowissue['lotldg_lotno']."'")or die("Error:".mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
$nob=0; $qty=0; $sstage=""; $lotts="";
while($row_issue=mysqli_fetch_array($lotqry))
{ 
	$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot' and lotldg_lotno='".$rowissue['lotldg_lotno']."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
		
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where  lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nob=$nob+$row_issuetbl['lotldg_balbags']; 
		$qty=$qty+$row_issuetbl['lotldg_balqty'];
		$sstage=$row_issuetbl['lotldg_sstage'];
		$lotts=$row_issuetbl['orlot'];
	}
}
if($qty>0 and $nob==0)$nob=1;
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotts;?></td>
	<td align="center" class="smalltblheading"><?php echo $sstage;?></td>
	<td align="center" class="smalltblheading"><?php echo $nob;?></td>
	<td align="center" class="smalltblheading"><?php echo $qty;?></td>
</tr>
<?php
$sno++;}

$sq2=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack WHERE  SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot' order by lotdgp_id asc")or die("Error:".mysqli_error($link));
$totrow2=mysqli_num_rows($sq2);
if($totrow2 >= 1)
while($rowissue2=mysqli_fetch_array($sq2))
{ 
$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack WHERE  SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot' and lotno='".$rowissue2['lotno']."'")or die("Error:".mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
$nob=0; $qty=0; $sstage=""; $lotts=""; $upsz="";
while($row_issue=mysqli_fetch_array($lotqry))
{ 
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where  subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and SUBSTRING(orlot, 15, 2 ) = '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'  and lotno='".$rowissue2['lotno']."'") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
		
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where  lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nob=$nob+$row_issuetbl['balnop']; 
		$qty=$qty+$row_issuetbl['balqty'];
		$sstage=$row_issuetbl['lotldg_sstage'];
		$lotts=$row_issuetbl['orlot'];
		$upsz=$row_issuetbl['packtype'];
	}
}
if($qty>0 and $nob==0)$nob=1;
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotts;?></td>
	<td align="center" class="smalltblheading"><?php echo $sstage."  -  ".$upsz;?></td>
	<td align="center" class="smalltblheading"><?php echo $nob;?></td>
	<td align="center" class="smalltblheading"><?php echo $qty;?></td>
</tr>
<?php
$sno++;}
for($i=1; $i<=$mxlot; $i++)
{
$abc27=sprintf("%02d",$i);
$baselot32=$baselot2.$abc27;
$sq2=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg WHERE  orlot = '$baselot32' order by lotldg_id asc")or die("Error:".mysqli_error($link));
$totrow2=mysqli_num_rows($sq2);
if($totrow2 >= 1)
while($rowissue2=mysqli_fetch_array($sq2))
{ 
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg WHERE  orlot = '$baselot32' and lotldg_lotno='".$rowissue2['lotldg_lotno']."'")or die("Error:".mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
$nob=0; $qty=0; $sstage=""; $lotts=""; $upsz="";
while($row_issue=mysqli_fetch_array($lotqry))
{ 
	$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot = '$baselot32'  and lotldg_lotno='".$rowissue2['lotldg_lotno']."'") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
		
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nob=$nob+$row_issuetbl['lotldg_balbags']; 
		$qty=$qty+$row_issuetbl['lotldg_balqty'];
		$sstage=$row_issuetbl['lotldg_sstage'];
		$lotts=$row_issuetbl['orlot'];
	}
}
if($qty>0 and $nob==0)$nob=1;
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotts;?></td>
	<td align="center" class="smalltblheading"><?php echo $sstage?></td>
	<td align="center" class="smalltblheading"><?php echo $nob;?></td>
	<td align="center" class="smalltblheading"><?php echo $qty;?></td>
</tr>
<?php
$sno++;}

$abc27=sprintf("%02d",$i);
$baselot32=$baselot2.$abc27;
$sq2=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack WHERE  orlot = '$baselot32' order by lotdgp_id asc")or die("Error:".mysqli_error($link));
$totrow2=mysqli_num_rows($sq2);
if($totrow2 >= 1)
while($rowissue2=mysqli_fetch_array($sq2))
{ 
$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack WHERE orlot = '$baselot32' and lotno='".$rowissue2['lotno']."'")or die("Error:".mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
$nob=0; $qty=0; $sstage=""; $lotts=""; $upsz="";
while($row_issue=mysqli_fetch_array($lotqry))
{ 
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where  subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot = '$baselot32'  and lotno='".$rowissue2['lotno']."'") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
		
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nob=$nob+$row_issuetbl['balnop']; 
		$qty=$qty+$row_issuetbl['balqty'];
		$sstage=$row_issuetbl['lotldg_sstage'];
		$lotts=$row_issuetbl['orlot'];
		$upsz=$row_issuetbl['packtype'];
	}
}
if($qty>0 and $nob==0)$nob=1;
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotts;?></td>
	<td align="center" class="smalltblheading"><?php echo $sstage."  -  ".$upsz;?></td>
	<td align="center" class="smalltblheading"><?php echo $nob;?></td>
	<td align="center" class="smalltblheading"><?php echo $qty;?></td>
</tr>

<?php
$sno++;}}
?>
<tr class="light" height="25">
	<td align="center" class="smalltbltext" colspan="5">* Qty shown is Current stock in hand; if shown ZERO (0) means, Batch is currently not in warehouse i.e. dispatched/discarded etc.
</td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Details not found for the selected Lot Number</td>
</tr>
</table>
<?php
}
?>
