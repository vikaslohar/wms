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
	if(isset($_GET['b']))
	{
	 	$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	 	$c = $_GET['c'];	 
	}
	if(isset($_GET['h']))
	{
	  	$h= $_GET['h'];	 
	}
	if(isset($_GET['g']))
	{
	  	$g = $_GET['g'];	 
	}
	if(isset($_GET['f']))
	{
	  	$f = $_GET['f'];	 
	}
	if(isset($_GET['l']))
	{
	  	$stge = $_GET['l'];	 
	}
	if(isset($_GET['m']))
	{
	  	$txtpktp = $_GET['m'];	 
	}

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$c."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$p1arry=explode(",",$rowvariety['gm']);
$p1arry2=explode(",",$rowvariety['wtmp']);
$polup=""; $polwtmp=""; $g=0;
foreach($p1arry as $val1)
{
	if($val1<>"")
	{
		$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
		$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
		$row12=mysqli_fetch_array($res);
		$uupps=$row12['ups']." ".$row12['wt'];
		if($polup!="")
			$polup=$polup.",".$uupps;
		else
			$polup=$uupps;
		
		if($polwtmp!="")
			$polwtmp=$polwtmp.",".$p1arry2[$g];
		else
			$polwtmp=$p1arry2[$g];	
	}
	$g++;
}

		
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$a."'  and lotldg_balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$a."' ") or die(mysqli_error($link));
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
	$zz=str_split($a);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	//if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
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
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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
//echo $tdt;
$tdt=explode(",",$tdt);
$tdt1=$tdt[0];
$tdt2=$tdt[1];
if($tdt1==$tdt2)$tdt1='';
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
	if($tdt1!="" && $tdt2!="")
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
			
			//if((($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			if((($user_ts <= $start_ts) || ($user_ts >= $end_ts)))
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
		if($m==5 && ($de==28 || $de==29 || $de==30 || $de==31)){$mon=2; } else {$mon=0; }
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
		if($mon==2) {$dps="01"."-"."02"."-".$dp[0];  $lastday = date('t',strtotime($dps)); $dp3=$lastday."-"."02"."-".$dp[0];}
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
		if($m==5 && ($de==28 || $de==29 || $de==30 || $de==31)){$mon=2; } else {$mon=0; }
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp6=$dp[2]."-".$dp[1]."-".$dp[0];} 
		if($mon==2) {$dps="01"."-"."02"."-".$dp[0];  $lastday = date('t',strtotime($dps)); $dp6=$lastday."-"."02"."-".$dp[0];}
	}
	else
	{$dp6="";}
}

		
?>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td width="149" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="98" align="center" valign="middle" class="smalltblheading" >Total NoB</td>
    <td width="113" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="113" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="113" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="113" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<!--<td width="253" align="center" valign="middle" class="smalltblheading">Process Entire</td>
	<td width="225" align="center" valign="middle" class="smalltblheading">Process Partial</td>
   <td width="121" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="112" align="center" valign="middle" class="smalltblheading">Qty</td>-->
  </tr>

  <tr class="Light" height="25">
    <td width="149" align="center" valign="middle" class="smalltblheading"><?php echo $a;?><input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /><input type="hidden" name="polup" value="<?php echo $polup;?>" /><input type="hidden" name="polwtmp" value="<?php echo $polwtmp;?>" /></td>
    <td width="98" align="center" valign="middle" class="smalltblheading"><?php echo $nob;?><input type="hidden" name="txtonob" value="<?php echo $nob;?>" /></td>
    <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qty;?><input type="hidden" name="txtoqty" value="<?php echo $qty;?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qc;?><input type="hidden" name="qcstatus" value="<?php echo $qc;?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot1;?><input type="hidden" name="qcdot1" value="<?php echo $qcdot1;?>" /></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot2;?><input type="hidden" name="qcdot2" value="<?php echo $qcdot2;?>" />
	  <input type="hidden" name="qctestdate" value="<?php if($qcdot1!="") echo $qcdot1; else if($qcdot1=="" && $qcdot2!="") echo $qcdot2; else echo "";?>" />
	  <input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="dp4" value="<?php echo $dp4;?>" /><input type="hidden" name="dp5" value="<?php echo $dp5;?>" /><input type="hidden" name="dp6" value="<?php echo $dp6;?>" /><input type="hidden" name="qcdttype" value="<?php if($qcdot1!="") echo "DoT"; else if($qcdot1=="" && $qcdot2!="") echo "DoSF"; else ""; ?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" >
	<?php if($qcdot1=="" && $qcdot2==""){ ?>
	<option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
	<?php }	?>
	<?php if($qcdot1!="" || $qcdot2!=""){ ?>
	<option value="DoT" <?php if($qcdot1!="") echo "selected"; ?> >DoT</option>
	<option value="DoSF" <?php if($qcdot1=="" && $qcdot2!="") echo "selected"; ?> >DoSF</option>
	<?php }	?>
	</select>	</td>
	<!--<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" id="protyp" value="E" onclick="prochktyp(this.value)" class="smalltbltext" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="radio" name="protyp" id="protyp" value="P" onclick="prochktyp(this.value)" class="smalltbltext" /></td>
   <td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtnob" id="txtnob" class="smalltbltext" value="" size="8" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="txtqty" class="smalltbltext" value="" size="8" /></td>-->
  </tr> <input name="protype" value="" type="hidden"> 
</table>
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
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="9" >9</option>
<option value="6" >6</option>
<option value="3" >3</option>
</select>&nbsp;Months</td>
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;<input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="15" readonly="true" style="background-color:#ECECEC"  /></td>
<td width="220" align="center" valign="middle" class="tblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp1" value="E" onclick="pcksel(this.value);" /></td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp2" value="P" onclick="pcksel(this.value);"  /></td>
<td width="156" align="center" valign="middle" class="tblheading" id="pltno"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<!--<tr class="Light" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="3" >3</option>
<option value="6" >6</option>
<option value="9" >9</option>
</select>&nbsp;Months</td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext">&nbsp;<input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="15" readonly="true" style="background-color:#ECECEC"  /> &nbsp;&nbsp;<b>Validity Days</b> <input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);" />Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);"  />Pack Partial</td>
</tr>-->
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
   <!-- <td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>-->
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$a."'  and lotldg_balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$a."' ") or die(mysqli_error($link));
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
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <!--<td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true"  onchange="qtychk1(this.value,<?php echo $srno2?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>-->

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" onchange="cnonzchk(this.value, <?php echo $srno2?>)" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" /></td>
  </tr>
 <?php
  }
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>-->
	<td width="20%" align="center" valign="middle" class="smalltblheading">Picked for Packing Qty</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">Pouch CC Qty (Gms.)</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">Packing Loss Qty</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">Captive Consumption Qty</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">Balance Packing Qty</td>
   <!-- <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance Condition</td>-->
  </tr>
  <!--<tr class="tblsubtitle">
    <td width="86" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="111" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="92" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>-->
  <tr class="Light" height="25">  
  <!--<td  align="center"  valign="middle" class="smalltbltext" ><input name="avlnobpck" id="avlnobpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="avlqtypck" id="avlqtypck" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;</td>-->
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="pfpchk(this.value)" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pchccqty" id="pchccqty" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" value=""   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)" value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true"   style="background-color:#CCCCCC"  />&nbsp;</td>
  <!--<td  align="center"  valign="middle" class="smalltbltext"><input name="balcnob" id="balcnob" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  /></td>
   <td  align="center"  valign="middle" class="smalltbltext"><input name="balcqty" id="balcqty" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;</td>-->
</tr>  
</table>

<br />
<div id="conditionsloc" style="display:none">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Condition Seed SLOC</td>
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

  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob1" id="txtconslnob1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty1" id="txtconslqty1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,1);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
    <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
  
</table><br />
</div>

<?php
if($txtpktp!="Standard")
{
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="12">Packing - Packaging Details</td>
</tr>
<tr class="tblsubtitle" height="25">
<!--<td align="center" valign="middle" class="tblheading">Select</td>-->
<td align="center" valign="middle" class="tblheading">UPS</td>
<td align="center" valign="middle" class="tblheading">Quantity</td>
<td align="center" valign="middle" class="tblheading">No. of Pouches</td>
<td align="center" valign="middle" class="tblheading">NoP in WB</td>
<td align="center" valign="middle" class="tblheading">WB Weight (Kgs)</td>
<td align="center" valign="middle" class="tblheading">MP Weight (Kgs)</td>
<td align="center" valign="middle" class="tblheading">No. of MP</td>
<td align="center" valign="middle" class="tblheading">No. of WB in MP</td>
<!--<td align="center" valign="middle" class="tblheading">Barcode Labels</td>-->
</tr>
<?php
$sno=1; $srnonew=0;
?>
<tr class="Light" height="25">
<!--<td width="49" align="center" valign="middle" class="tbltext"><input type="radio" name="fet" onClick="clk('<?php echo $sno?>',<?php echo $row12['uid'];?>);" id="fetchk_<?php echo $sno?>" value="<?php echo $row12['uid'];?>"/></td>-->
<td width="155" align="center" valign="middle" class="tbltext">&nbsp;<input type="text" size="6" maxlength="6" name="upsval_<?php echo $sno?>" id="upsval_<?php echo $sno?>" value="" onkeypress="return isNumberKey(event)" onchange="upck(this.value,'1')"  />&nbsp;<select name="upssizetyp_<?php echo $sno?>" id="upssizetyp_<?php echo $sno?>" style="size:50px" onchange="updmerg(this.value,'1');">
<option selected="selected" value="">Select</option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="" /></td>
<td width="90" align="center" valign="middle" class="tbltext"><input type="text" name="packqty_<?php echo $sno?>" id="packqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC" onchange="chktotpouches(this.value, <?php echo $sno?>)" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="85" align="center" valign="middle" class="tbltext"><input type="text" name="nopc_<?php echo $sno?>" id="nopc_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<!--<td width="130" align="center" valign="middle" class="tbltext"><?php $quer3=mysqli_query($link,"SELECT dom_mcode FROM tbl_rm_dommac  order by dom_mcode Asc"); ?>
  <select class="smalltbltext" disabled="disabled" name="domcs_<?php echo $sno?>" id="domcs_<?php echo $sno?>" style="width:40px;" onchange="domcchk(this.value, <?php echo $sno?>)"> <option value="" selected>Select</option> <?php while($noticia = mysqli_fetch_array($quer3)) { ?> <option value="<?php echo $noticia['dom_mcode'];?>" /><?php echo $noticia['dom_mcode'];?><?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="text" name="lbls_<?php echo $sno?>" id="lbls_<?php echo $sno?>" size="5" maxlength="7" disabled="disabled" class="tbltext" value="" onkeypress="return isNumberKey1(event)" onchange="domchk(<?php echo $sno?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="110" align="center" valign="middle" class="tbltext"><input type="text" name="domce_<?php echo $sno?>" id="domce_<?php echo $sno?>" class="tbltext" size="1" maxlength="1" readonly="true" disabled="disabled" style="background-color:#CCCCCC" value="" />&nbsp;<input type="text" name="lble_<?php echo $sno?>" id="lble_<?php echo $sno?>" size="5"  disabled="disabled"maxlength="7" class="tbltext" value=""  onkeypress="return isNumberKey1(event)" onchange="domchk1(this.value, <?php echo $sno?>)" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>-->
<td width="55" align="center" valign="middle" class="tbltext"><input type="text" name="nopinwb_<?php echo $sno?>" id="nopinwb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value=""  onchange="calnopinwb(this.value)" onkeypress="return isNumberKey1(event)"  /></td>
<td width="85" align="center" valign="middle" class="tbltext"><input type="text" name="wbwts_<?php echo $sno?>" id="wbwts_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value=""  readonly="true" style="background-color:#CCCCCC" /></td>
<td width="85" align="center" valign="middle" class="tbltext"><input type="text" name="mpwts_<?php echo $sno?>" id="mpwts_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value=""   onchange="bnpchk(this.value, <?php echo $sno?>)"/><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" onkeypress="return isNumberKey(event)" /><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="" /></td>
<td width="85" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="68" align="center" valign="middle" class="tbltext" ><input type="text" name="nowbinmp_<?php echo $sno?>" id="nowbinmp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value=""  readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php	
		
//}
$srnonew++;
//}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="upssize" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
</table>
<?php
}
else
{
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="12">Packing - Packaging Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td align="center" valign="middle" class="tblheading">Select</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;UPS</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;NoP in WB</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;WB Weight (Kgs)</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;No. of WB in MP</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;MP Weight (Kgs)</td>
</tr>

<?php
$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$c."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=0; $srnonew=0; $wbcnt=0;
//echo $rowvariety['varietyid'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
$p1_array4=explode(",",$rowvariety['wtnop']);
$p1_array5=explode(",",$rowvariety['wtnopkg']);
$p1_array6=explode(",",$rowvariety['nowb']);
foreach($p1_array4 as $wcnt)
{
	if($wcnt<>"")
	{
		$wbcnt++;
	}
}

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
$wbnop=$p1_array4[$srnonew];
$wtwb=$p1_array5[$srnonew];
$mptnowb=$p1_array6[$srnonew];

if($row12['wt']=="Gms")
{ 
	$ptp=(1000/$row12['ups']);
	$ptp1=($row12['ups']/1000);
}
else
{
	$ptp=$row12['ups'];
	$ptp1=$row12['ups'];
}
//echo $ptp."  =>  ".$ptp1."  -  ";
if($row12['wt']=="Gms")
{
	$mmmpt=$ptp*$wtmp;
}
else
{
	$mmmpt=$wtmp/$ptp;
}
if($mptnop!=$mmmpt)$mptnop=$mmmpt;

if($wbnop>0)
{
if($wbcnt>0)
{
$sno++;	
?>

<tr class="Light" height="25">
<td width="77" align="center" valign="middle" class="tbltext"><input type="radio" name="fet" onClick="clk('<?php echo $sno?>',<?php echo $row12['uid'];?>);" id="fetchk_<?php echo $sno?>" value="<?php echo $row12['uid'];?>"/><input type="hidden" name="upname_<?php echo $sno?>" id="upname_<?php echo $sno?>" value="<?php echo $row12['ups']." ".$row12['wt'];?>" /></td>
<td width="887" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row12['ups']." ".$row12['wt'];?></td>
<td width="887" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $wbnop;?><input type="hidden" name="nopinwb_<?php echo $sno?>" id="nopinwb_<?php echo $sno?>"  class="tbltext" value="<?php echo $wbnop;?>"  /></td>
<td width="887" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $wtwb;?><input type="hidden" name="wbwts_<?php echo $sno?>" id="wbwts_<?php echo $sno?>" class="tbltext" value="<?php echo $wtwb;?>"   /></td>
<td width="887" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $mptnowb;?><input type="hidden" name="nowbinmp_<?php echo $sno?>" id="nowbinmp_<?php echo $sno?>" class="tbltext" value="<?php echo $mptnowb;?>"   /></td>
<td width="887" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $wtmp;?><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" />  <input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $row12['uom'];?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $row12['ups']." ".$row12['wt'];?>" /></td>
</tr>
<?php	
}
}		
}
$srnonew++;
}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="upssize" value="" /><input type="hidden" name="nopks" value="" /><input type="hidden" name="upsize" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
</table><br />
<?php
}
?><br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
	<td width="20%" align="center" valign="middle" class="smalltblheading">MRP per UPS</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">MRP per Gms.</td>
  </tr>
<tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="mrpups" id="mrpups" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="mrpconv(this.value)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="mrpgms" id="mrpgms" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" readonly="true"  style="background-color:#CCCCCC" value=""   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr> 
</table><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="120" maxlength="120" ></td>
</tr>
</table>
<br />
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<!--<img src="../images/Post.gif" border="0" style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;--></td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="light" height="25">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details cannot display reasons:</td>
</tr>
<tr class="light" height="25">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot number not Imported</td>
</tr>
<tr class="light" height="25">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already Processed.</td>
</tr>
</table>
<?php
}
?>
