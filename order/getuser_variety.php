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
	if(isset($_GET['b']))
	{
     $b = $_GET['b'];	 
	}


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$a."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
  $crop=$noticia['cropname'];

$quer22=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$b."' and actstatus='Active'"); 
$noticia22 = mysqli_fetch_array($quer22);
 $variet=$noticia22['popularname'];

$sql_month=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$a."' and order_sub_variety='".$b."' and order_sub_hold_flag=1 ")or die(mysqli_error($link));
//$row= mysqli_fetch_array($sql_month);
   $tt=mysqli_num_rows($sql_month);
  // echo $type=$tt['order_sub_variety_typ'];
  
$quer22=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='".$variet."' and actstatus='Active' order by cropname Asc"); 
$noticia22 = mysqli_fetch_array($quer22);
 //$typee=$noticia22['vt'];

$row20=mysqli_query($link,"select * from tblvariety where cropname='".$a."' and varietyid='".$b."' and actstatus='Active'")or die(mysqli_error($link));
   $tt1=mysqli_fetch_array($row20);
  $typee=$tt1['vt'];

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
    <tr class="Light" height="25">
      <td align="left" class="subheading" style="color:#303918; " colspan="3">&nbsp;Crop:<?php echo $crop;?>&nbsp;</td>
       <td width="325" align="left" class="subheading" style="color:#303918; ">&nbsp;Variety Type:<?php echo $typee;?>&nbsp;&nbsp;</td>   
      <td width="243" align="left" class="subheading" style="color:#303918; ">&nbsp;Variety:<?php echo $variet;?>&nbsp;&nbsp;</td>
          
    </tr>
</table>
	 <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
    <tr class="tblsubtitle" height="25">
      <td width="75" align="center" valign="middle" class="tblheading"> Date</td>
      <td width="83"  align="center" valign="middle" class="tblheading">Order No.</td>
      <td width="115"  align="center" valign="middle" class="tblheading">Order Type</td>
      <td width="218" align="center" valign="middle" class="tblheading">Party </td>
      <td width="103"  align="center" valign="middle" class="tblheading">UPS Type</td>
      <td width="114" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="126" align="center" valign="middle" class="tblheading">Qty</td>
      <!-- <td width="56" align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td width="53" align="center" valign="middle" class="tblheading">GOT Status</td>
            <td width="40" align="center" valign="middle" class="tblheading">Status</td>-->
    </tr>
    <?php
$srno=1; 
if($tt > 0)
{

	while($row_tbl_sub=mysqli_fetch_array($sql_month))
	{
	 $arid=$row_tbl_sub['orderm_id'];
	$crop=""; $variety="";  
	$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$arid."'")or die(mysqli_error($link));
    $subtbltot= mysqli_fetch_array($sql_m);
    //$to=mysqli_num_rows($sql_m);
 
 // $arid=row_tbl_sub['orderm_id'];
  
	  $trdate=$subtbltot['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
  	      $crop=$subtbltot['orderm_porderno'];
		 $variety=$subtbltot['order_trtype'];	
	
		$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$subtbltot['orderm_party']."'"); 
	     $row3=mysqli_fetch_array($quer3);
	
	if($subtbltot['orderm_party']!="" && $subtbltot['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$subtbltot['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$subtbltot['orderm_partyname'];
	}
	
		
		$up=""; $up1="";$up11=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
 // $to1=mysqli_num_rows($sql_m);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
 $up11="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
 $up11="NST";
}
}

	
	if($srno%2!=0)
{

	
?>
    <tr class="Light" height="25">
      <td align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
      <td width="83" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
      <td width="115" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
      <td width="218" align="center" valign="middle" class="tblheading"><?php echo $partyname?></td>
      <td width="103" align="center" valign="middle" class="tblheading"><?php echo $up11?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $up?></td>
      <td width="126" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>

    </tr
>
    <?php
}
else
{
?>
    <tr class="Light" height="25">
      <td align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
      <td width="83" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
      <td width="115" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
      <td width="218" align="center" valign="middle" class="tblheading"><?php echo $partyname?></td>
      <td width="103" align="center" valign="middle" class="tblheading"><?php echo $up11?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
      <td width="126" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
   
    </tr> </table>
    <?php
}}
$srno=$srno+1;
}



else
{

?>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25">
    <td colspan="10" align="center" class="subheading">No Records found for selected Crop &amp; Variety </td>
  </tr>
</table>
<?php
}

?>