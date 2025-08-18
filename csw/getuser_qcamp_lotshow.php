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
if(isset($_GET['f']))
{
	$h= $_GET['f'];	 
}
if(isset($_GET['g']))
{
	$dotage= $_GET['g'];	 
}

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="4" align="center" class="tblheading">List of Lots</td>
</tr>
</table>		   
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td width="30" align="center" valign="middle" class="tblheading">#</td>
<td width="146" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="76" align="center" valign="middle" class="tblheading">QC Status</td>
<td width="107" align="center" valign="middle" class="tblheading">DoT</td>
<td width="107" align="center" valign="middle" class="tblheading">Days since DoT</td>
<td width="118" align="center" valign="middle" class="tblheading">NoB</td>
<td width="100" align="center" valign="middle" class="tblheading">Qty</td>
<td width="100" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="100" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="chkall()">CA</a>  |  <a href="Javascript:void(0);" onclick="clall()">CL</a></td>
</tr>

<?php
$srn=1; $totalups=0; $totalqty=0; $cnt=0;

$sql_m=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop='".$a."' and lotldg_variety='".$b."' and lotldg_sstage='".$c."'") or die(mysqli_error($link));
$tot_m=mysqli_num_rows($sql_m);
if($tot_m > 0)
{
while($row_m=mysqli_fetch_array($sql_m))
{
$val=$row_m['lotldg_lotno'];
$vflg=0;
$rtotalups=0; $rtotalqty=0; $qc=""; $got=""; $blends_sstatus=""; $slocs=""; 
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop='".$a."' and lotldg_variety='".$b."' and lotldg_sstage='".$c."' and lotldg_lotno='".$val."'") or die(mysqli_error($link));
$trtr=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$b."'  and lotldg_lotno='".$val."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 

$qc=$row_issuetbl['lotldg_qc']; 
$got123=explode(" ",$row_issuetbl['lotldg_got1']); 
$got=$got123[0]." ".$row_issuetbl['lotldg_got']; 
$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];


$trdate=$row_issuetbl['lotldg_qctestdate'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dot=$trday."-".$trmonth."-".$tryear;
if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
if($dot=="00-00-0000" || $dot=="--")$dot="";


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

}
}
$trdate240=date("Y-m-d");
$flg=0;
if($dotage!="" && $dotage=="30")
{
	$dt=30;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else if($dotage!="" && $dotage=="45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else if($dotage!="" && $dotage=="90")
{
	$dt=90;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else
{
}
//echo $trdate."  =  ".$trdate240."<br />";	
$diff = abs(strtotime($trdate240) - strtotime($trdate));
$days = floor($diff / (60*60*24));
$days=$days;

if($days <= $dotage)
{
$vflg++;
}
if($flg>0)
{
//$vflg++;
}

if($qc!="OK" && $qc!="NUT")
{
$vflg++;
}

if($rtotalqty<=0)
{
$vflg++;
}

if($vflg==0)
{

$totalups=$totalups+$rtotalups;
$totalqty=$totalqty+$rtotalqty;

$cnt++;
if($srn%2!=0)
{
?>  
  <tr class="Light" height="30">
<td align="center" valign="middle" class="tblheading"><?php echo $srn;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="lotno_<?php echo $srn;?>" name="lotno_<?php echo $srn;?>" value="<?php echo $val;?>" /><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="qcst_<?php echo $srn;?>" name="qcst_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $qc;?>" size="10" /><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dot_<?php echo $srn;?>" name="dot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dot;?>" size="10" /><?php echo $dot;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dsdot_<?php echo $srn;?>" name="dsdot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $days;?>" size="10" /><?php echo $days;?> Days</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><input type="hidden" id="upsavl_<?php echo $srn;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalups;?>" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?><input type="hidden" id="qtyavl_<?php echo $srn;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalqty;?>" size="10" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="checkbox" name="fet" id="foc_"<?php echo $srn;?> value="<?php echo $val;?>" /></td>
  </tr>
<?php
}
else
{
?>
  <tr class="Light" height="30">
<td align="center" valign="middle" class="tblheading"><?php echo $srn;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="lotno_<?php echo $srn;?>" name="lotno_<?php echo $srn;?>" value="<?php echo $val;?>" /><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="qcst_<?php echo $srn;?>" name="qcst_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $qc;?>" size="10" /><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dot_<?php echo $srn;?>" name="dot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dot;?>" size="10" /><?php echo $dot;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dsdot_<?php echo $srn;?>" name="dsdot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $days;?>" size="10" /><?php echo $days;?> Days</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><input type="hidden" id="upsavl_<?php echo $srn;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalups;?>" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?><input type="hidden" id="qtyavl_<?php echo $srn;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalqty;?>" size="10" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="checkbox" name="fet" id="foc_"<?php echo $srn;?> value="<?php echo $val;?>" /></td>
  </tr>
<?php
}
$srn++;
}
}
}

?>
<?php if($cnt > 0){ ?>
<tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totalups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
<td align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="chkall()">CA</a>  |  <a href="Javascript:void(0);" onclick="clall()">CL</a></td>
  </tr>
<?php } ?> 
<input type="hidden" name="srn" value="<?php echo $srn;?>" /> 
</table>
<?php if($cnt > 0){ ?>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
<?php } ?>