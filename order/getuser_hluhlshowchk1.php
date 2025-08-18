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
echo 	 $a = $_GET['a'];	 
	}

if(isset($_GET['c']))
	{
	echo $c = $_GET['c'];	 
	}
if(isset($_GET['b']))
	{
	echo $b = $_GET['b'];	 
	}
	if(isset($_GET['d']))
	{
	echo $d = $_GET['d'];	 
	}
	if(isset($_GET['e']))
	{
	echo $e = $_GET['e'];	 
	}
	if(isset($_GET['f']))
	{
	echo $f = $_GET['f'];	 
	}
//echo $a."   -   ".$b."   -   ".$c."   -   ".$f."   -   ".$g;

?>
<?php

 if($a=="Party")
{ 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="7" align="left" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Check All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a>&nbsp;</td></tr>
<tr class="tblsubtitle" height="20">
	<td width="36" align="center" valign="middle" class="tblheading">#</td>
	<td width="77" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="153" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="269" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="213" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="88" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1;  $ort=$c; $rec=0;
//if($ort=="TDF - Individual")$ort="Individual";
//$sql_main=mysqli_query($link,"select * from tbl_order_sub where order_sub_crop='".$c."' and order_sub_variety='".$f."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$f."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($g!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$f."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$f."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($g!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$f."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$f."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$cnt=0;
if($row_main['orderm_holdflag'] > 0)
	{
	$cnt++;
	}
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{ $rec++;
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($row_main['order_sub_hold_flag'] > 0)
	{
		$cnt++;
	}
}


	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php if($cnt > 0) echo "checked";  ?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php if($cnt > 0) echo "checked"; ?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
	
</table>

<?php
if($c!="partysearch")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="7" align="left" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Check All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a>&nbsp;</td></tr>
<tr class="tblsubtitle" height="20">
	<td width="31" align="center" valign="middle" class="tblheading">#</td>
	<td width="42" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="91" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="163" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="125" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="296" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="86" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1;  $rec=0;
if($c=="ordersearch")
{  //echo $f;
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$f%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$f%' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$f%' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{

		$sdate=$f;
		$sday=substr($sdate,0,2);
		$smonth=substr($sdate,3,2);
		$syear=substr($sdate,6,4);
		$sdate=$syear."-".$smonth."-".$sday;
		
		$edate=$g;
		$eday=substr($edate,0,2);
		$emonth=substr($edate,3,2);
		$eyear=substr($edate,6,4);
		$edate=$eyear."-".$emonth."-".$eday;	
			
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate' and orderm_date >='$sdate' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate' and orderm_date >='$sdate' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate' and orderm_date >='$sdate' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
 $tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$cnt=0; 
	if($row_main['orderm_holdflag'] > 0)
	{
	$cnt++;
	}
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{ $rec++;
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($row_main['order_sub_hold_flag'] > 0)
	{
		$cnt++;
	}
}

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php if($cnt > 0) echo "checked"; ?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php if($cnt > 0) echo "checked"; ?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>

<?php
}
?>		
</table>

<?php
}
else 
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading">Records Not Found.</td>
  </tr>

</table>
<?php
}
?><input type="hidden" name="srno" value="<?php echo $srno;?>" />