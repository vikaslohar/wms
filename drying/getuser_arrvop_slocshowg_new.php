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
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$rid = $_GET['g'];	 
	}
$sql_issue1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   orlot='".$f."'") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_issue1);
$sql_i="select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   orlot='".$f."' and arrsub_id!='".$rid."'";
$sql_iss=mysqli_query($link,$sql_i) or die(mysqli_error($link));
$tt=mysqli_num_rows($sql_iss);
if($t == 0 && $tt == 0)
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbldrywarehouse  where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbldrybin where plantcode='".$plantcode."' and   plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
        <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbldrysubbin where plantcode='".$plantcode."' and   plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
        <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbldrywarehouse  where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbldrybin where plantcode='".$plantcode."' and   plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbldrysubbin where plantcode='".$plantcode."' and   plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

</table>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" ><tr>
<td valign="middle" class="tblheading" align="left"><font color="#FF0000">&nbsp;&nbsp;Can not enter the Lot.&nbsp;&nbsp;Reasons : </font><br /><br /><font color="#0000FF">&nbsp;&nbsp;1. The Lot has been already Arrived.<br />&nbsp;&nbsp;2. The Lot is in the same transaction for Opening Stock.</font></td>
</tr>
</table>
<?php
}
?>