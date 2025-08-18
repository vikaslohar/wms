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
	
	$sqltblsub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipsub_id='".$a."'") or die(mysqli_error($link));
	$rowtblsub=mysqli_fetch_array($sqltblsub);
  	$tottblsub=mysqli_num_rows($sqltblsub);
	
	$tid=$rowtblsub['pnpslipmain_id'];
	$subtid=$a;

	$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	
	$tot=mysqli_num_rows($sql_tbl);		
	$arrival_id=$row_tbl['pnpslipmain_id'];

	$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['pnpslipmain_dop'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
?>



<?php
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
	$row=mysqli_fetch_array($sql_tbl_sub);
  	$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $row['pnpslipsub_lotno'];?>" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;</td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block">
<?php

$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row['pnpslipsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nob=$nob+$row_issuetbl['lotldg_balbags']; 
$qty=$qty+$row_issuetbl['lotldg_balqty'];
$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
	$trdate=$row_issuetbl['lotldg_qctestdate'];
	$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
	$qcdttype="DOT";
}
//else
{
	$zz=str_split($row['pnpslipsub_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	//if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
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
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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
if($qcdot1=="00-00-0000" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="00-00-0000" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

$tdt="";
$sql_qcs=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='$ltno' and qcstatus='OK' order by tid desc Limit 0,2") or die(mysqli_error($link));
if($tot_qcs=mysqli_num_rows($sql_qcs)>=2)
{
	while($row_qcs=mysqli_fetch_array($sql_qcs))
	{
		if($tdt!="")
		$tdt=$tdt.",".$row_qcs['testdate'];
		else
		$tdt=$row_qcs['testdate'];
	}
}
$tdt1=""; $tdt2="";

$tdt=explode(",",$tdt);
$tdt1=$tdt[0];
$tdt2=$tdt[1];

if($qcdot1!="")
{
	$crdate=date("d-m-Y");
	$now = strtotime($qcdot1); // or your date as well
	$your_date = strtotime($crdate);
	$datediff2 = (($your_date - $now)/(60*60*24));
}
else
$datediff2 = 0;
//echo $qcdot2;
if($datediff2>15)	
{
	$qcdot2="";
}
else
{
	if($tdt2!="")
	{
		if($qcdot2!="" && $qcdot1!="")
		{
			$tdte2=explode("-",$qcdot2);
			$m=$tdte2[1];
			$de=$tdte2[0];
			$y=$tdte2[2];
		  	$tdte2=$y."-".$m."-".$de;
			
			$start_ts = strtotime($tdt2);
			$end_ts = strtotime($tdt1);
			$user_ts = strtotime($tdte2);
			
			if(!(($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			{
				$qcdot2="";
			}
		}
	}
}


if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";
$dp1="";$dp2="";$dp3="";$dp4="";$dp5="";$dp6="";
if($qcdot1!="")
{
	$trdate2=explode("-",$qcdot1);
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
if($qcdot2!="")
{
	$trdate2=explode("-",$qcdot2);
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
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp4=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp4="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp5=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp5="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp6=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp6="";}
}
}	

	$tdate4=$row['pnpslipsub_valupto'];
	$tyear4=substr($tdate4,0,4);
	$tmonth4=substr($tdate4,5,2);
	$tday4=substr($tdate4,8,2);
	$tdate4=$tday4."-".$tmonth4."-".$tyear4;
	
	$tdate5=$row_tbl['pnpslipmain_dop'];
	$tyear5=substr($tdate5,0,4);
	$tmonth5=substr($tdate5,5,2);
	$tday5=substr($tdate5,8,2);
	$tdate5=$tday5."-".$tmonth5."-".$tyear5;
	
	$now = strtotime($tdate5); // or your date as well
    $your_date = strtotime($tdate4);
    $datediff = (($your_date - $now)/(60*60*24));

?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="111" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="70" align="center" valign="middle" class="smalltblheading" >Total NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="81" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<td width="139" align="center" valign="middle" class="smalltblheading">Process Entire</td>
	<td width="140" align="center" valign="middle" class="smalltblheading">Process Partial</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >Processed Lot No.</td>
   <!--<td width="121" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="112" align="center" valign="middle" class="smalltblheading">Qty</td>-->
  </tr>

  <tr class="Light" height="25">
    <td width="149" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_lotno'];?><input type="hidden" name="softstatus" value="<?php echo $row['pnpslipsub_sstatus'];?>" /></td>
    <td width="98" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_onob'];?><input type="hidden" name="txtonob" value="<?php echo $row['pnpslipsub_onob'];?>" /></td>
    <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_oqty'];?><input type="hidden" name="txtoqty" value="<?php echo $row['pnpslipsub_oqty'];?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $row['pnpslipsub_qc'];?><input type="hidden" name="qcstatus" value="<?php echo $row['pnpslipsub_qc'];?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot1;?><input type="hidden" name="qcdot1" value="<?php echo $qcdot1;?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot2;?><input type="hidden" name="qcdot2" value="<?php echo $qcdot2;?>" />
	<input type="hidden" name="qctestdate" value="<?php echo $tdate3;?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="dp4" value="<?php echo $dp4;?>" /><input type="hidden" name="dp5" value="<?php echo $dp5;?>" /><input type="hidden" name="dp6" value="<?php echo $dp6;?>" /><input type="hidden" name="qcdttype" value="<?php echo $row['pnpslipsub_qcdttype'];?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" disabled="disabled" >
	<?php if($row['pnpslipsub_qcdttype']==""){ ?>
	<option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
	<?php }	?>
	<?php if($row['pnpslipsub_qcdttype']!=""){ ?>
	<option value="DoT" <?php if($qcdot1!="" && $row['pnpslipsub_qcdttype']=="DoT") echo "selected"; ?> >DoT</option>
	<option value="DoSF" <?php if($qcdot2!="" && $row['pnpslipsub_qcdttype']=="DoSF") echo "selected"; ?> >DoSF</option>
	<?php }	?>
	</select>
	</td>
	<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" id="protyp" value="E" onclick="prochktyp(this.value)" class="smalltbltext" <?php if($row['pnpslipsub_processtype']=="E") echo "checked"; ?> disabled="disabled"  /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" value="P" id="protyp" onclick="prochktyp(this.value)" class="smalltbltext" <?php if($row['pnpslipsub_processtype']=="P") echo "checked"; ?> disabled="disabled"  /></td>
	<td width="163" align="center" valign="middle" class="smalltblheading" id="cltno" ><input type="text" name="txtclotno" id="txtclotno" class="smalltbltext" value="<?php echo $row['pnpslipsub_clotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
   <!--<td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtnob" id="txtnob" class="smalltbltext" value="" size="8" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="txtqty" class="smalltbltext" value="" size="8" /></td>-->
  </tr> <input name="protype" value="<?php echo $row['pnpslipsub_processtype'];?>" type="hidden"> 
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Processing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Processing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row['pnpslipsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
{ 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ $srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub where plantcode='$plantcode' and pnpslipsub_id='".$row['pnpslipsub_id']."' and pnpslipmain_id='".$tid."'  and pnpslipsubsub_wh='".$row_issuetbl['lotldg_whid']."' and pnpslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and pnpslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value="<?php echo $row['pnpslipsub_pnob'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  value="<?php echo $row['pnpslipsub_pqty'];?>" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['pnpslipsub_bnob'];?>" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['pnpslipsub_bqty'];?>" /></td>
  </tr>
 <?php
  }
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Processing Details</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Condition Seed</td>
    <td width="180" rowspan="2" align="center" valign="middle" class="smalltblheading">Remnant (RM)</td>
	<td width="237" rowspan="2" align="center" valign="middle" class="smalltblheading">Inert Material (IM)</td>
    <td width="237" rowspan="2" align="center" valign="middle" class="smalltblheading">Processing Loss (PL)</td>
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Total Cond. Loss</td>
  </tr>
  <tr class="tblsubtitle" >
    <td align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="121" align="center" valign="middle" class="smalltblheading" >Qty</td>
    <td width="112" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>

  <tr class="Light" height="25">
    <td width="86" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconnob" class="smalltbltext" value="<?php echo $row['pnpslipsub_connob'];?>" size="8" onchange="chkpronob()"  /></td>
    <td width="100" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconqty" class="smalltbltext" value="<?php echo $row['pnpslipsub_conqty'];?>" size="8" onchange="chkproqty()"  /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconrem" class="smalltbltext" value="<?php echo $row['pnpslipsub_rm'];?>" size="8" onchange="chkconqty()"  /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconim" class="smalltbltext" value="<?php echo $row['pnpslipsub_im'];?>" size="8" onchange="chkrm()"  /></td>
    <td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconpl" class="smalltbltext" value="<?php if($row_tbl['pnpslipmain_stage']=="Raw") echo $row['pnpslipsub_pl']; else echo $row['pnpslipsub_rpl'];?>" size="8" onchange="chkim(this.value)"  /></td>
    <td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtconloss" class="smalltbltext" value="<?php echo $row['pnpslipsub_tlqty'];?>" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconper" class="smalltbltext" value="<?php echo $row['pnpslipsub_tlper'];?>" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
  </tr>
</table>

<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Packing Details</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="165" align="center" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="220" align="center" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial&nbsp;</td>
<td width="156" align="center" valign="middle" class="tblheading">Packed Lot No.&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row['pnpslipsub_valperiod'];?><input type="hidden" name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" value="<?php echo $row['pnpslipsub_valperiod'];?>"  />&nbsp;Months</td>
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;<input type="text" name="validityupto" id="validityupto" value="<?php echo $tdate4;?>" size="15" readonly="true" style="background-color:#CCCCCC"  /></td>
<td width="220" align="center" valign="middle" class="tblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="<?php echo $datediff;?>" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);" <?php if($row['pnpslipsub_packtype']=="E") echo "checked"; ?> disabled="disabled"  /></td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);" disabled="disabled"  /></td>
<td width="156" align="center" valign="middle" class="tblheading" id="pltno"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="<?php echo $row['pnpslipsub_plotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<!--<tr class="tblsubtitle" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext">&nbsp;</td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext">&nbsp; &nbsp;&nbsp;<b>Validity Days</b> </td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading">
</tr>-->
<input type="hidden" name="pcktype" id="pcktype" value="<?php echo $row['pnpslipsub_packtype'];?>" />
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>-->
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
	<td align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td align="center" valign="middle" class="smalltblheading">Captive Consumption</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Packing</td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance Condition</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="86" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="111" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="92" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="avlnobpck" id="avlnobpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_availpnob'];?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="avlqtypck" id="avlqtypck" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_availpqty'];?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="pfpchk(this.value)" value="<?php echo $row['pnpslipsub_pickpqty'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="<?php echo $row['pnpslipsub_packloss'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)" value="<?php echo $row['pnpslipsub_packcc'];?>"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" value="<?php echo $row['pnpslipsub_packqty'];?>"  style="background-color:#CCCCCC"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="balcnob" id="balcnob" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_balcnob'];?>"  /></td>
   <td  align="center"  valign="middle" class="smalltbltext"><input name="balcqty" id="balcqty" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['pnpslipsub_balcqty'];?>"  />&nbsp;</td>
</tr>  
</table>
<br />
<div id="conditionsloc" style="display: <?php if($row['pnpslipsub_packtype']=="P") echo "block"; else echo "none"; ?>">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Updated SLOC</td>
  </tr>
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Sub Bin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php
$srno3=1;

$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipsub_id='".$row['pnpslipsub_id']."' and pnpslipmain_id='".$tid."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$rowsubsub2=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{ 
?>
  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno3?>" name="txtslwhg<?php echo $srno3?>" style="width:70px;" onchange="wh<?php echo $srno3?>(this.value,<?php echo $srno3?>);" disabled="disabled"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_wh']==$noticia_whd1['whid']) echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub2['pnpslipsubsub_wh']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno3?>"><select class="smalltbltext" name="txtslbing<?php echo $srno3?>" style="width:60px;" onchange="bin<?php echo $srno3?>(this.value,<?php echo $srno3?>);" disabled="disabled" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub2['pnpslipsubsub_bin']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno3?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno3?>" id="txtslsubbg<?php echo $srno3?>" style="width:60px;" onchange="subbin<?php echo $srno3?>(this.value,<?php echo $srno3?>);" disabled="disabled"  >
<option value="" selected>Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_tbl_subsub2['pnpslipsubsub_subbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno3?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $srno3?>" id="txtconslnob<?php echo $srno3?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno3?>);" value="<?php echo $row_tbl_subsub2['pnpslipsubsub_pnob'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $srno3?>" id="txtconslqty<?php echo $srno3?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno3?>);"  onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_subsub2['pnpslipsubsub_pqty'];?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
  </tr>
<?php
$srno3++;
}
?>
</table><br />
</div>


<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="12">Packing Details</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading">Select</td>
<td align="center" valign="middle" class="tblheading">UPS</td>
<td align="center" valign="middle" class="tblheading">Total Quantity</td>
<td align="center" valign="middle" class="tblheading">Max No. of Pouches</td>
<td align="center" valign="middle" class="tblheading">Convert to MP</td>
<td align="center" valign="middle" class="tblheading">Max. No. of MP</td>
<td align="center" valign="middle" class="tblheading">No. of MP</td>
<td align="center" valign="middle" class="tblheading">No. of Pouches</td>
<td align="center" valign="middle" class="tblheading">Balance Pouches</td>
<!--<td align="center" valign="middle" class="tblheading">Barcode Labels</td>-->
</tr>

<?php
$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row['pnpslipsub_plotno']."' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=0; $srnonew=0;
//echo $rowvariety['varietyid'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
$p1=array();
foreach($p1_array as $val1)
{
if($val1<>"")
{
$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$row12=mysqli_fetch_array($res);
//echo $row12['ups']; echo "  -  ";
//echo $row12['wt']; echo "<br/>";
$wtmp=$p1_array2[$srnonew];
$mptnop=$p1_array3[$srnonew];
if($row12['uid']==$row['pnpslipsub_upsid'])
{
$sno++;		
?>

<tr class="Light" height="25">
<td width="49" align="center" valign="middle" class="tbltext"><input type="radio" name="fet" onClick="clk('<?php echo $sno?>',<?php echo $row12['uid'];?>);" id="fetchk_<?php echo $sno?>" value="<?php echo $row12['uid'];?>" <?php if($row12['uid']==$row['pnpslipsub_upsid']) echo "checked"; ?> disabled="disabled"/><?php if($row12['uid']==$row['pnpslipsub_upsid']) {?><input type="hidden" name="upssize" value="<?php echo $sno;?>" /><?php } ?></td>
<td width="79" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row12['ups']." ".$row12['wt'];?><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $row12['uom'];?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $row12['ups']." ".$row12['wt'];?>" /></td>
<td width="81" align="center" valign="middle" class="tbltext"><input type="text" name="packqty_<?php echo $sno?>" id="packqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_packqty']; else echo ""; ?>" onkeypress="return isNumberKey(event)" onchange="chktotpouches(this.value, <?php echo $sno?>)" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="96" align="center" valign="middle" class="tbltext"><input type="text" name="nopc_<?php echo $sno?>" id="nopc_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid']) echo $row['pnpslipsub_nop']; else echo ""; ?>" readonly="true" style="background-color:#CCCCCC"/></td>
<td width="53" align="center" valign="middle" class="tbltext"><input type="checkbox" name="mpck_<?php echo $sno?>" id="mpck_<?php echo $sno?>" class="tbltext" value="Yes" onchange="mpchk(this.value, <?php echo $sno;?>)" <?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo "checked"; else echo "disabled"; ?> disabled="disabled" checked="checked"  /></td>
<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo $row['pnpslipsub_nomp']; else echo ""; ?>"   onchange="balnopcheck(this.value, <?php echo $sno?>)" /><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>

<td width="135" align="center" valign="middle" class="tbltext"><input type="text" name="lodednomp_<?php echo $sno?>" id="lodednomp_<?php echo $sno?>" size="5" maxlength="7"  class="tbltext" value="<?php echo $tot_barcnomp;?>" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="114" align="center" valign="middle" class="tbltext"><input type="text" name="pouches_<?php echo $sno?>" id="pouches_<?php echo $sno?>" size="5"  maxlength="7" class="tbltext" value="<?php echo $row['pnpslipsub_pnop'];?>"  onkeypress="return isNumberKey1(event)" onchange="poucheschk(this.value,<?php echo $sno?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") echo $row['pnpslipsub_balpouch']; else echo ""; ?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<!--<td width="61" align="center" valign="middle" class="tbltext" id="dtail_<?php echo $sno;?>"><?php if($row12['uid']==$row['pnpslipsub_upsid'] && $row['pnpslipsub_convtomp']=="Yes") {?><a href="Javascript:void(0)" onclick="detailspop('edit')">Attach</a><?php }else{ ?>Attach<?php } ?></td>-->
</tr>
<?php	
}	
}
$srnonew++;
}
?>

<?php
$abrc="";
$s_sub3=mysqli_query($link,"select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' and bar_lotno='".$row['pnpslipsub_plotno']."' and bar_logid='".$logid."' and bar_psrn='".$row_tbl['pnpslipmain_proslipno']."'") or die(mysqli_error($link));
$zxcvb=mysqli_num_rows($s_sub3);
while($row_sub3=mysqli_fetch_array($s_sub3))
{
	$sa24=$row_sub3['bar_barcodes'];
	if($abrc!="")
		$abrc=$abrc.","."'$sa24'";
	else
		$abrc="'$sa24'";
}
	
	$b=0;
	if($abrc!="")
	{
	$sqlbtsls=mysqli_query($link,"select distinct(btsl_id) from tbl_btslsub where plantcode='$plantcode' and btslsub_barcode IN ($abrc) order by btslsub_id asc") or die(mysqli_error($link));
	$b=mysqli_num_rows($sqlbtsls);
	}
?>

<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="<?php echo $row['pnpslipsub_nobarcodes'];?>" /><input type="hidden" name="upsidno" value="<?php echo $row['pnpslipsub_upsid'];?>" /><input type="hidden" name="nopks" value="<?php echo $row['pnpslipsub_balpouch'];?>" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="<?php echo $b;?>" />
<input type="hidden" class="smalltblheading" size="7" name="extbpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" class="smalltblheading" size="7" name="linkpch" value="0" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" class="smalltblheading" size="7" name="bpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC; color:#FF0000" />
</table>
<?php
$sql_barc=mysqli_query($link,"SELECT * FROM tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipmain_id='$tid' and pnpslipbar_logid='$logid'" ) or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($sql_barc);
if($numofrecords>0)
{
$row_barc=mysqli_fetch_array($sql_barc);

$tdate11=explode("-",$row_barc['pnpslipbar_wtdate']);
$dobg=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
	
	
?>

<?php } ?>  
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="6">Select SLOC</td>
</tr>
<?php
$slsrn=1; $wh1=""; $bin=""; $subbin="";
	$whid=$row_barc['pnpslipbar_whid']; $binid=$row_barc['pnpslipbar_binid']; $subbinid=$row_barc['pnpslipbar_subbinid'];
	
	$whd1=mysqli_query($link,"select * from tbl_warehouse where plantcode='$plantcode' and whid='".$row_barc['pnpslipbar_whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whd1=mysqli_fetch_array($whd1);
	
	$bin1=mysqli_query($link,"select * from tbl_bin where plantcode='$plantcode' and binid='".$row_barc['pnpslipbar_binid']."' ") or die(mysqli_error($link));
	$row_bin1=mysqli_fetch_array($bin1);
	
	$subbin1=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' and sid='".$row_barc['pnpslipbar_subbinid']."' ") or die(mysqli_error($link));
	$row_subbin1=mysqli_fetch_array($subbin1);
	
	if($wh1=="")
		$wh1=$row_whd1['perticulars'];
	else
		$wh1=$wh1."<br />".$row_whd1['perticulars'];
	
	if($bin=="") 
		 $bin=$row_bin1['binname'];
	else
		 $bin=$bin."<br />".$row_bin1['binname'];
	
	 if($subbin=="")
		$subbin=$row_subbin1['sname'];
	 else
		$subbin=$subbin."<br />".$row_subbin1['sname'];
$totslqty=0;
	$sql_barc2=mysqli_query($link,"SELECT * FROM tbl_pnpslipbarcode whereplantcode='$plantcode' and pnpslipmain_id='$tid' order by pnpslipbar_id desc" ) or die("Error: " . mysqli_error($link));
	$numofrecords2=mysqli_num_rows($sql_barc2);
	$row_barc2=mysqli_fetch_array($sql_barc2);	
	$totslqty=$totslqty+($row_barc2['pnpslipbar_wtmp']*$numofrecords2);
	$xups=$row_barc2['pnpslipbar_ups'];
	
	$sql_ups=mysqli_query($link,"select * from tblups where CONCAT(ups,' ',wt)='".$row_barc['pnpslipbar_ups']."'") or die(mysqli_error($link));
	$row_ups=mysqli_fetch_array($sql_ups);
	$totslqty=$totslqty+($row_ups['uom']*$row_barc2['pnpslipbar_nop']);
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading">WH</td>
	<td align="center" valign="middle" class="tblheading">Bin</td>
	<td align="center" valign="middle" class="tblheading">Sub-Bin</td>
	<td align="center" valign="middle" class="tblheading">NoP</td>
	<td align="center" valign="middle" class="tblheading">NoMP</td>
	<td align="center" valign="middle" class="tblheading">Qty</td>
	
</tr>
<tr class="Dark" height="25">
<td width="10%" align="left" valign="middle" class="smalltbltext" id="wh<?php echo $slsrn;?>">&nbsp;<?php if($wh1!=""){ echo $wh1;?><input type="hidden" name="txtwhg<?php echo $slsrn;?>" id="txtwhg_<?php echo $slsrn?>" value="<?php echo $whid;?>"  /><?php } else {?><select class="smalltbltext" id="txtwhg_<?php echo $slsrn?>" name="txtwhg1" style="width:70px;" onchange="wh(this.value,'<?php echo $slsrn?>');"  >
<option value="" selected>WH</option>
	<?php $whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));	while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select><?php }?></td>
	
	<td width="10%" align="left" valign="middle" class="smalltbltext" id="bin<?php echo $slsrn;?>">&nbsp;<?php if($bin!=""){ echo $bin;?><input type="hidden" name="vbin_<?php echo $slsrn;?>" id="vbin_<?php echo $slsrn?>" value="<?php echo $binid;?>"  /><?php } else {?>
	  <select class="smalltbltext" id="vbin_<?php echo $slsrn;?>" name="vbin_<?php echo $slsrn;?>" style="width:60px;" onchange="bin(this.value,'<?php echo $slsrn?>');" >
<option value="" selected>Bin</option>
	</select><?php }?></td>
		
		<td width="10%" align="left" valign="middle" class="smalltbltext" id="subbin<?php echo $slsrn;?>">&nbsp;<?php if($subbin!=""){echo $subbin;?><input type="hidden"  id="vsubbin_<?php echo $slsrn;?>" name="vsubbin_<?php echo $slsrn;?>" value="<?php echo $subbinid;?>"  /><?php } else {?>
		  <select class="smalltbltext" id="vsubbin_<?php echo $slsrn;?>" name="vsubbin_<?php echo $slsrn;?>" style="width:60px;" >
<option value="" selected>SubBin</option>
	</select><?php }?></td>
	<td width="21%" align="center" valign="middle" class="smalltbltext" colspan="3" id="slocr1"><table align="center" border="0" width="100%" cellspacing="0" cellpadding="0"  style="border-collapse:collapse" >
<tr height="25">
		<td width="7%" align="center" valign="middle" class="smalltbltext"><input type="text" name="slnop_<?php echo $slsrn?>" id="slnop_<?php echo $slsrn?>" size="4" maxlength="6" class="tbltext" value="<?php echo $row_barc2['pnpslipbar_nop'];?>" /></td>
		<td width="7%" align="center" valign="middle" class="smalltbltext"><input type="text" name="slnomp_<?php echo $slsrn?>" id="slnomp_<?php echo $slsrn?>" size="4" maxlength="6" class="tbltext" value="<?php echo $numofrecords2;?>" readonly="" style="background-color:#CCCCCC" /></td>
		<td width="7%" align="center" valign="middle" class="smalltbltext"><input type="text" name="slqt_<?php echo $slsrn?>" id="slqt_<?php echo $slsrn?>" size="4" maxlength="6" class="tbltext" value="<?php echo $totslqty;?>" readonly="" style="background-color:#CCCCCC" /></td>
		</tr></table></td>
		
</tr>
<input type="hidden" name="slsrn" id="slsrn" value="<?php echo $slsrn?>" />
</table>

<div id="slsync">
<?php /*if($row['pnpslipsub_nomp'] > 0) {?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right" width="502" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="slocssyn" onclick="openslocsyn(this.value)" <?php if($row['pnpslipsub_sltyp']=="slocssyn") echo "checked"; else echo "disabled";?> /></td><td width="462" align="left" valign="middle" class="tblheading">&nbsp;SLOC Synchronization</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="link1sloc" onclick="openslocsyn(this.value)" <?php if($row['pnpslipsub_sltyp']=="link1sloc") echo "checked"; else echo "disabled"; ?> /></td><td align="left" valign="middle" class="tblheading">&nbsp;Linking Barcodes to 1 SLOC</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="linkmosloc" onclick="openslocsyn(this.value)" <?php if($row['pnpslipsub_sltyp']=="linkmosloc") echo "checked"; else echo "disabled"; ?> /></td><td align="left" valign="middle" class="tblheading">&nbsp;Linking Barcodes to 2 or more SLOC</td>
</tr>
<input type="hidden" name="slocssyncs24" value="<?php echo $row['pnpslipsub_sltyp'];?>" />
</table>
<?php }*/ ?>
<div id="slocsync"></div>

<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0" style="display:inline;cursor:Pointer;" onclick="updateform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />