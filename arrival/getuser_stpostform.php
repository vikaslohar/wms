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
	$variety = $_GET['c'];	 
	}

	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $a;
/*$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$a."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$sql_month=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$crop."' and spcodef='".$b."' and spcodem='".$c."' order by lotvariety")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$variety=$row['lotvariety'];
//$row_month=mysqli_fetch_array($sql_month);
$tt=mysqli_num_rows($sql_month);
*/
if($a != "")
{

if($a != "Pack")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="25">
           <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;ST Lot Number&nbsp;</td>
           <td width="250" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlotp" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   <td align="right"  valign="middle" class="tblheading">Quality Status &nbsp;</td>
<td width="260" align="left"  valign="middle" class="tbltext">&nbsp;<select name="txtqtystat" class="tbltext"  style="width:120px;" tabindex=""  onchange="classchk(this.value);">
		<option value="" selected>--Select--</option>
    <option value="UT" >UT</option>
	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
		  <option value="RT" >RT</option>
		</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

         <tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch Total Bags&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsdcchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="177" align="right"  valign="middle" class="tblheading" >Dispatch Total No. of Qty&nbsp;</td>
<td width="260" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="Bagsdcchk1();" /  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Receive No. of Bags&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagschk1(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Received Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="qtychk1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Difference Bag&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" >&nbsp;<font color="#FF0000"  readonly="true" >*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"  />%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:120px;" onchange="clk3(this.value)">
   <option value="" selected>--Select--</option>
   <option value="Acceptable">Acceptable</option>
	<option  value="Not-Acceptable" >Not- Acceptable</option>

     
  </select>  <font color="#FF0000">*</font>	</td>
</tr>
</table>
<table id="transs" align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="display:none; border-color:#F1B01E" >
<tr class="Light" height="30">
<td align="right" width="230" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<table  align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Dark" height="20">
	<td width="147" align="right"  valign="middle" class="tblheading">Seed status&nbsp;</td>
<td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgot" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="GOT-R" >GOT-R</option>
    <option value="GOT-NR" >GOT-NR</option>
  </select>  <font color="#FF0000">*</font>
  </td>

<td align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="gotstatus" style="width:100px;" onchange="visuchk1(this.value)">
    <option value="" selected>--Select--</option>
    <option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >RT</option>
  </select>  <font color="#FF0000">*</font>
  </td>

  </tr>
  <tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk1();" onkeypress="return isNumberKey(event)"   />%&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="84" align="center" valign="middle" class="tblheading">Bin</td>
<td width="103" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">Bags</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
<br />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="25">
           <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;ST Lot Number&nbsp;</td>
           <td width="250" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlotp" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   <td align="right"  valign="middle" class="tblheading">Quality Status &nbsp;</td>
<td width="260" align="left"  valign="middle" class="tbltext">&nbsp;<select name="txtqtystat" class="tbltext"  style="width:120px;" tabindex=""  onchange="classchk(this.value);">
		<option value="" selected>--Select--</option>
    <option value="UT" >UT</option>
	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
		  <option value="RT" >RT</option>
		</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

<?php
$sql_var=mysqli_query($link,"select * from tblvariety where cropname='".$crop."' and varietyid='".$variety."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$tot_var=mysqli_num_rows($sql_var);
$row_var=mysqli_fetch_array($sql_var);
//echo $row_var['gm'];
$parr=explode(",", $row_var['gm']);
$sn=0;
foreach($parr as $val)
{
if($val<>"")
{
$sql_ups=mysqli_query($link,"select * from tblups where uid='".$val."'") or die(mysqli_error($link));
$row_ups=mysqli_fetch_array($sql_ups);
$sn++;
?>
<tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading"><?php echo $row_ups['ups']." ".$row_ups['wt']; ?></td>
<td align="left" valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtp_<?php echo $sn;?>" id="txtp_<?php echo $sn;?>" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="packqchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtqtinkgs_<?php echo $sn;?>" id="txtqtinkgs_<?php echo $sn;?>" value="<?php echo $row_ups['uom']; ?>" /><input type="hidden" name="txtpcktyp_<?php echo $sn;?>" id="txtpcktyp_<?php echo $sn;?>" value="<?php echo $row_ups['ups']." ".$row_ups['wt']; ?>" /></td>
</tr>
<?php
}
}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" />
         <tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch Total Packs&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsdcchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="177" align="right"  valign="middle" class="tblheading" >Dispatch Total No. of Qty&nbsp;</td>
<td width="260" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="Bagsdcchk1();" /  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Receive No. of Packs&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagschk1(this.value);" readonly="true" style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Received Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="qtychk1(this.value);" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Difference Packs&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" >&nbsp;<font color="#FF0000"  readonly="true" >*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"  /> %&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:120px;" onchange="clk3(this.value)">
   <option value="" selected>--Select--</option>
   <option value="Acceptable">Acceptable</option>
	<option  value="Not-Acceptable" >Not- Acceptable</option>

     
  </select>  <font color="#FF0000">*</font>	</td>
</tr>
</table>
<table id="transs" align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="display:none; border-color:#F1B01E" >
<tr class="Light" height="30">
<td align="right" width="230" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<table  align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Dark" height="20">
	<td width="147" align="right"  valign="middle" class="tblheading">Seed status&nbsp;</td>
<td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgot" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="GOT-R" >GOT-R</option>
    <option value="GOT-NR" >GOT-NR</option>
  </select>  <font color="#FF0000">*</font>
  </td>

<td align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="gotstatus" style="width:100px;" onchange="visuchk1(this.value)">
    <option value="" selected>--Select--</option>
    <option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >RT</option>
  </select>  <font color="#FF0000">*</font>
  </td>

  </tr>
  <tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk1();" onkeypress="return isNumberKey(event)"   />%&nbsp;<font color="#FF0000">*</font>	</td>
 
</tr>
</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="84" align="center" valign="middle" class="tblheading">Bin</td>
<td width="103" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">Bags</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
<br />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
<?php
}
}
?>