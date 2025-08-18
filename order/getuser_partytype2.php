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

if($a=="TDF")
{
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_party!='0' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_party='0' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$tot=mysqli_num_rows($sqlpty);
while($rowpty=mysqli_fetch_array($sqlpty))
{
if($partyarr!="")
$partyarr=$partyarr.",".$rowpty['orderm_party'];
else
$partyarr=$rowpty['orderm_party'];
}

while($rowpty1=mysqli_fetch_array($sqlpty1))
{
if($partyarrc!="")
$partyarrc=$partyarrc.",".$rowpty1['orderm_partyname'];
else
$partyarrc=$rowpty1['orderm_partyname'];
}

$zzz=array_values(array_unique(explode(",",$partyarrc)));
$zx=explode(",",$partyarrc);
foreach($zx as $val)
{
if($val<>"")
{ 
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where business_name='".$val."'"); 
	$tot=mysqli_num_rows($quer3);
	if($tot > 0)
	{	//echo "HI";
		$row3=mysqli_fetch_array($quer3);
		if($partyarr!="")
		$partyarr=$partyarr.",".$row3['p_id'];
		else
		$partyarr=$row3['p_id'];
		unset($zzz[$key]);
	}
}
}
//echo $partyarr;
$xc=explode(",",$partyarr);
$zc=array_merge($xc,$zzz);
$list3 = explode(",", implode(",",array_values(array_unique($xc))));
sort($list3);
//$partyar=implode(",",$list3);

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="Dark" height="30">
    <td width="205" align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
    <td width="639" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="party(this.value)" tabindex="" >
          <option value="" selected>--Select--</option>
          <?php 
		  	foreach($xc as $val1)
			{
			if($val1<>"")
			{ 
				$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$val1."'"); 
				$row3=mysqli_fetch_array($quer3);
				//echo $val1." = ".$row3['business_name'];
		?>
          <option value="<?php echo $row3['p_id'];?>" />  
          <?php echo $row3['business_name'];?>
          <?php } }
		  	foreach($zzz as $val)
			{
			if($val<>"")
			{ 
		   ?>
		   <option value="<?php echo $val;?>" />  
          <?php echo $val;?>
		  <?php } } ?>
        </select>
    &nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<?php
}
?>