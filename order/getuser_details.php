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
	$crop = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	 $variet = $_GET['c'];	 
	}

if(isset($_GET['f']))
	{
	 $f = $_GET['f'];	
	} 
/*	}
$sql_crop=mysqli_query($link,"select * from tblarrival where sstage='".$d."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$stage=$row_crop['sstage'];
*/
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$tot_crop=mysqli_num_rows($sql_crop);
if($tot_crop > 0)
{ $crop=$row_crop['cropname'];}
// $crop;
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variet."' and actstatus='Active'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$tot_variety=mysqli_num_rows($sql_variety);
if($tot_variety > 0)
{ $variet=$row_variety['popularname'];}


$tot_row=0;
$lotqry=mysqli_query($link,"select * from tbllotimp where plantcode='$plantcode' and lotnumber='".$a."' and lotcrop='".$crop."' and lotvariety='".$variet."'and lottrtype='Trading'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
 $tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

 
 if($row['lotvariety']!="")
 {
 	$variety=$row['lotvariety'];
 	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$variet."' and actstatus='Active'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$qctyp=$row11['opt'];
	$i=$row11['varietyid'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($xx > 0)
	{
	$x=$row_spc['variety'];
	$z=$row_spc['crop'];
	$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."' and actstatus='Active'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$variety=$row11['popularname'];
	$qctyp=$row11['opt'];
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	}
 }
// echo $tot_row;
 $oldlot=$row['lotoldlot'];		
if($tot_row > 0)
{
?>
<div id="postingsubtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="6" align="right" class="tblheading"> Check ALL&nbsp;<input type="checkbox" name="tname"/>
|&nbsp;Clear All&nbsp;<input type="checkbox" name="tname"/>&nbsp;</td></tr>

  <?php
 $tid=$pid;
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <td width="75" align="center" valign="middle" class="tblheading">View Order</td>
			<td width="43" align="center" valign="middle" class="tblheading">Cancel</td>
              <!-- <td width="48" align="center" valign="middle" class="tblheading">Party Name</td>-->
	</tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

	if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading">&nbsp;</td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="75" align="center" valign="middle" class="tblheading"><a href="javascript:void(0);" onclick="getdetails();" >Get </a></td>
	<td width="43" align="center" valign="middle" class="tblheading"><input type="checkbox" name="tname"/></td>
   <!-- <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>-->
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
   <td width="75" align="center" valign="middle" class="tblheading"><a href="javascript:void(0);" onclick="getdetails();" >Get </a></td>
	 <td width="43" align="center" valign="middle" class="tblheading"><input type="checkbox" name="tname"/></td>
  <!-- <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td> -->
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>
	 <?php
}
$srno++;
}
}

?>
 </table>
<div id="transs" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="757" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
<?php
}
else
{
?>
<?php
}
?>
