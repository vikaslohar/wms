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

if($a=="TDF")
{
$pnmeid="";$pnme="";
$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and orderm_partyselect='selectp' and orderm_dispatchflag!=1 order by orderm_party")or die(mysqli_error($link));
while($noticia = mysqli_fetch_array($sql_month)) 
{ 
$pn=$noticia['orderm_party'];
 if($pnmeid!="")
 $pnmeid=$pnmeid.","."'$pn'";
 else
 $pnmeid="'$pn'";
}
//echo $pnmeid;
if($pnmeid!="")
{
	$sql_month2=mysqli_query($link,"select * from tbl_partymaser where p_id IN ($pnmeid) order by business_name")or die(mysqli_error($link));
	$tot=mysqli_num_rows($sql_month2);
	while($noticia2 = mysqli_fetch_array($sql_month2)) 
	{
		if($pnme!="")
		$pnme=$pnme.",".$noticia2['business_name'];
		else
		$pnme=$noticia2['business_name'];
	}
}
//echo $pnme;
$sql_month3=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_dispatchflag!=1 order by orderm_party")or die(mysqli_error($link));
while($noticia3 = mysqli_fetch_array($sql_month3)) 
{ 
	if($pnme!="")
	$pnme=$pnme.",".$noticia3['orderm_partyname'];
	else
	$pnme=$noticia3['orderm_partyname'];
}
//echo $pnme;
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="207" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
<?php $p_array=explode(",",$pnme);
foreach($p_array as $parr)
{
if($parr<>"")
{?>
	<option value="<?php echo $parr;?>" />   
		<?php echo $parr;?>
<?php }} ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="207" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="637" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress">&nbsp;
  <input type="hidden" name="adddchk" value="" /> <input type="hidden" name="add" value="<?php echo $noticia['p_id'];?>" /> </td>
</tr>
</table>
<?php
}
else 
{
if($a=="Sales")
{
$sql_month=mysqli_query($link,"select Distinct  classification from  tbl_partymaser where classification='Dealer' or classification='Bulk' or classification='Export Buyer' order by business_name")or die(mysqli_error($link));
}
else if($a=="Stock")
{
$sql_month=mysqli_query($link,"select  Distinct classification from  tbl_partymaser where classification='C&F' or classification='Branch' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month=mysqli_query($link,"select Distinct  classification from tbl_partymaser where classification='".$a."' order by business_name")or die(mysqli_error($link));
}
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="Dark" height="30">
    <td width="205" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
    <td width="639" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)" tabindex="" >
          <option value="" selected>--Select--</option>
          <?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
          <option value="<?php echo $noticia['classification'];?>" />  
          <?php echo $noticia['classification'];?>
          <?php } ?>
		  
        </select>
    &nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
     
</table>
<div id="selectpartylocation"style="display:none" ></div>		   
<div id="vitem1"style="display:none" >
<!--<div id="vitem1">--->
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;  </td>
</tr>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="638" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress">&nbsp;
  <input type="hidden" name="adddchk" value="" />  </td>
</tr>
</table>
</div>
<?php
}
?>