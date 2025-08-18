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
if(isset($_GET['h']))
{
	$tpd = $_GET['h'];	 
}
if(isset($_GET['l']))
{
	$tpg = $_GET['l'];	 
}
if(isset($_GET['p']))
{
	$typs = $_GET['p'];	 
}
if($tpg > 0)
{	
if($a=="P2P")
{

	/*$upspacktype=$row_issuetbl['packtype'];
	$packtp=explode(" ",$upspacktype);
	$packtyp=$packtp[0]; 
	if($packtp[1]=="Gms")
	{ 
		$ptp=(1000/$packtp[0]);
	}
	else
	{
		$ptp=$packtp[0];
	}*/
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC - Good</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing1">&nbsp;<select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,1);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing1">&nbsp;<select class="smalltbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,1);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
<?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;<select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;<select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,2);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,2);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>




<?php
$whg3_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:70px;" onchange="wh(this.value,3);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg3 = mysqli_fetch_array($whg3_query)) { ?>
          <option value="<?php echo $noticia_whg3['whid'];?>" />  
          <?php echo $noticia_whg3['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:60px;" onchange="bin(this.value,3);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:80px;" onchange="subbin(this.value,3);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow3">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,3);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,3);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid3" value="0" />
  </tr>
  <?php
$whg4_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:70px;" onchange="wh(this.value,4);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg4 = mysqli_fetch_array($whg4_query)) { ?>
          <option value="<?php echo $noticia_whg4['whid'];?>" />  
          <?php echo $noticia_whg4['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:60px;" onchange="bin(this.value,4);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:80px;" onchange="subbin(this.value,4);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow4">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,4);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,4);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid4" value="0" />
  </tr>
  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
</table>
<?php
} 
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC - Good</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing1">&nbsp;<select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,1);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing1">&nbsp;<select class="smalltbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,1);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;<select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;<select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,2);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,2);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

</table>
<?php
}
}
?>
<?php
if($tpd > 0)
{
?>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
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
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhd1" style="width:70px;" onchange="whd1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind1">&nbsp;
        <select class="smalltbltext" name="txtslbind1" style="width:60px;" onchange="bind1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind1">&nbsp;
        <select class="smalltbltext" name="txtslsubbd1" style="width:80px;" onchange="subbind1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd1" id="Bagsd1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd1" id="qtyd1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <input type="hidden" name="dorowid1" value="0" />
  <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhd2" style="width:70px;" onchange="whd2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
          <option value="<?php echo $noticia_whd2['whid'];?>" />  
          <?php echo $noticia_whd2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind2">&nbsp;
        <select class="smalltbltext" name="txtslbind2" style="width:60px;" onchange="bind2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind2">&nbsp;
        <select class="smalltbltext" name="txtslsubbd2" style="width:80px;" onchange="subbind2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd2" id="Bagsd2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd2" id="qtyd2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="dorowid2" value="0" />
  </tr>

</table>
<?php
}
?>
<?php
if($typs!="edit")
{
?>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pform();" id="postbutn" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" id="postbutn" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>