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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
 $a = $_GET['a'];	 
	}
//echo $a;  orlot
$tt=0;
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Select Stage</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">Select</td>
  <td align="center" class="tblheading">Stage</td>
  <td align="center" class="tblheading">NoB</td>
  <td align="center" class="tblheading">Qty</td>
  <td align="center" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1; $cntt=0;
$sql_tbl_sub=mysqli_query($link,"select distinct(lotldg_sstage) from tbl_lot_ldg where orlot='".$a."'")or die(mysqli_error($link));
$ct1=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; 
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE orlot='".$a."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$a."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{
//echo $row_qc[0];
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and lotldg_balqty > 0 ")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_month['lotldg_balbags'];
$slqty=$row_month['lotldg_balqty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";	

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$nob=$nob+$slups;
$qty=$qty+$slqty;
}
}
}

$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
//echo $acn;
if($nob > 0)
{
$cntt++;
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
  <td align="center" class="tblheading"><input type="checkbox" name="optsel" value="<?php echo $row_tbl_sub['lotldg_sstage'];?>" onclick="optsl(this.value);" /></td>
  <td align="center" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
  <td align="center" class="tblheading"><?php echo $ac;?></td>
  <td align="center" class="tblheading"><?php echo $acn;?></td>
  <td align="center" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
  <td align="center" class="tblheading"><input type="checkbox" name="optsel" value="<?php echo $row_tbl_sub['lotldg_sstage'];?>" onclick="optsl(this.value);" /></td>
  <td align="center" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
  <td align="center" class="tblheading"><?php echo $ac;?></td>
  <td align="center" class="tblheading"><?php echo $acn;?></td>
  <td align="center" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
//echo $cntt;
if($cntt==0)
{
?>
<tr class="light" height="20">
  <td colspan="5" align="left" class="tblheading">&nbsp;Lot number not found reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="5" align="left" class="tblheading">&nbsp;1. Lot number Dispatched/Released completely.</td>
</tr>
<?php
}
?>
<input type="hidden" name="txtstage" value="" /><input type="hidden" name="srno" value="<?php echo $srno;?>" /><input type="hidden" name="cntt" value="<?php echo $cntt?>" />
</table>