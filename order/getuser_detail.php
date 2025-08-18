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
if(isset($_GET['c']))
{
 	$c = $_GET['c'];	 
}
//echo $a;
if($c=="TDF")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where business_name='".$a."'"); 
	$tot=mysqli_num_rows($quer3);
	$row3=mysqli_fetch_array($quer3);
	if($tot > 0)
	{
		$a=$row3['p_id'];
	}
	else
	{
		$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$a."'"); 
		$tot=mysqli_num_rows($quer3);
		$row3=mysqli_fetch_array($quer3);
		$a=$row3['p_id'];
	}
	
}

$sql_crop=mysqli_query($link,"select * from  tbl_orderm where plantcode='$plantcode' and orderm_party='".$a."'") or die(mysqli_error($link));
$tot_crop=mysqli_num_rows($sql_crop);
if($tot_crop==0)
{
$sql_crop=mysqli_query($link,"select * from  tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$a."'") or die(mysqli_error($link));
$tot_crop=mysqli_num_rows($sql_crop);
}

$row_crop=mysqli_fetch_array($sql_crop);
$ortype="";
if($c=="Sales")
{
$ortype="Order Sales";
}
if($c=="Stock")
{
$ortype="Order Stock";
}
if($c=="TDF")
{
$ortype="Order TDF";
}
?>
<div id="fill" >
<?php
$srno=0;
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$a' and order_trtype='$ortype' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{			
?>
    <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr height="15"><td colspan="6" align="right" class="tblheading"> <a href="javascript:void(0)" onclick="selectall()">Check  All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear  All</a></td></tr>
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <td width="76" align="center" valign="middle" class="tblheading">View Order</td>
			<td width="42" align="center" valign="middle" class="tblheading">Cancel</td>
	</tr>
  <?php
$srno=1;

while($row_tbl=mysqli_fetch_array($sql_tbl))
{

 	 $arrival_id=$row_tbl['orderm_id'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_tbl['orderm_id']."'") or die(mysqli_error($link));
$total_tbl1=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($row_tbl_sub['order_sub_dispatch_flag']==1)$total_tbl1++;
if($row_tbl_sub['order_sub_hold_flag']==1)$total_tbl1++;

}	
//echo $total_tbl1; 
  if($total_tbl1==0)
  {
	if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
    <td width="76" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" value="<?php echo $row_tbl['orderm_id'];?>"/></td>
     
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="76" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	 <td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc"  value="<?php echo $row_tbl['orderm_id'];?>"/>
	  </td>
				
    
	 <?php
}
$srno++;
}
}
?>


 </table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25">
    <td colspan="10" align="center" class="subheading">No Records found for selected Party</td>
  </tr>
  </table>
  <?php
  }
  ?>
  <input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
<input type="hidden" name="tt" value="" />
<input type="hidden" name="tt1" value="" />
  <input type="hidden" name="srno" value="<?php echo $srno;?>" />
</div>