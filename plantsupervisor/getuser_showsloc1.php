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
	echo $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	echo $b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}

	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $a;
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$a."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$sql_month=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$crop."' and spcodef='".$b."' and spcodem='".$c."' and plantcode='$plantcode' order by lotvariety")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$variety=$row['lotvariety'];
$arid=$row['arrival_id'];
//$row_month=mysqli_fetch_array($sql_month);
echo $tt=mysqli_num_rows($sql_month);

$quer22=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='".$variety."' and actstatus='Active' order by cropname Asc"); 
$noticia22 = mysqli_fetch_array($quer22);
$variet=$noticia22['varietyid'];

if($tt > 0)
{
/*$sql_tbll=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trid='".$arid."'") or die(mysqli_error($link));
$row_tbll=mysqli_fetch_array($sql_tbll);
$whid=$row_tbll['lotldg_whid'];
$bid=$row_tbll['lotldg_binid'];
$sid=$row_tbll['lotldg_subbinid'];*/

 $sql_tb="select * from tbl_lot_ldg where lotldg_variety='".$variet."' and plantcode='$plantcode' group by lotldg_subbinid, lotldg_lotno, lotldg_crop order by lotldg_subbinid";  
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="8%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="7%" align="center" valign="middle" class="tblheading">Bags</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Stage</td>
			  <td align="center" valign="middle" class="tblheading">Quality status </td>
</tr>
<?php
  $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link)); 
  $srno=1; 
while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$row_tbl['lotldg_whid']."' and lotldg_binid='".$row_tbl['lotldg_binid']."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_variety='".$variet."' and lotldg_lotno='".$row_tbl['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
  $t1=mysqli_num_rows($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

 $total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$bid."' and whid='".$whid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

		
	$lrole=$row_tbl_sub['arr_role'];
	$arrival_id=$row_tbl_sub['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

				
		 $lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		
		/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{*/
		$qc=$row_tbl_sub['lotldg_qc'];
		$stage=$row_tbl_sub['lotldg_sstage'];
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
</tr>
<?php
}
 $srno++;
}
}
}
//}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#2e81c1" style="border-collapse:collapse">

                <tr class="Light" height="25">
	<td align="left"  valign="middle" class="tblheading" >&nbsp;Record Not Found.</td>
                </tr>
</table>
<?php
}
?>