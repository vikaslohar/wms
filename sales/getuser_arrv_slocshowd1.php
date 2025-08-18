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

if(isset($_REQUEST['a']))
	{
		$txtpsrn = $_REQUEST['a'];
	}
	if(isset($_REQUEST['b']))
	{
		$trrid = $_REQUEST['b'];
	}
	if(isset($_REQUEST['c']))
	{
		$crop = $_REQUEST['c'];
	}
	if(isset($_REQUEST['f']))
	{
		$variety = $_REQUEST['f'];
	}
	if(isset($_REQUEST['g']))
	{
		$upsize = $_REQUEST['g'];
	}
	if(isset($_REQUEST['h']))
	{
		$lotno = $_REQUEST['h'];
	}
	if(isset($_REQUEST['l']))
	{
		$otqty = $_REQUEST['l'];
	}
	if(isset($_REQUEST['p']))
	{
		$subid = $_REQUEST['p'];
	}
?><table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC - Damage</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhd1" style="width:70px;" onchange="whd1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bind1">&nbsp;
        <select class="tbltext" name="txtslbind1" style="width:60px;" onchange="bind1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbind1">&nbsp;
        <select class="tbltext" name="txtslsubbd1" style="width:80px;" onchange="subbind1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsd1" id="Bagsd1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qtyd1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <input type="hidden" name="dorowid1" value="0" />
  <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhd2" style="width:70px;" onchange="whd2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
          <option value="<?php echo $noticia_whd2['whid'];?>" />  
          <?php echo $noticia_whd2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bind2">&nbsp;
        <select class="tbltext" name="txtslbind2" style="width:60px;" onchange="bind2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbind2">&nbsp;
        <select class="tbltext" name="txtslsubbd2" style="width:80px;" onchange="subbind2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsd2" id="Bagsd2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsfd2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qtyd2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="dorowid2" value="0" />
  </tr>

</table>