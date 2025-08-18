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

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields



if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	
	/*if(isset($_GET['b']))
	{
	$tid = $_GET['b'];	 
	}	
*/

	
$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where plantcode='".$plantcode."' and  subtrid='".$a."'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row['trid'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_drying where plantcode='".$plantcode."' and  trid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];
$srno=1;
if($srno%2!=0)
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="10" align="center" class="tblheading">Post Item Form</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="43" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
    <td width="112" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
    <td align="center" valign="middle" class="tblheading"  colspan="2">Before Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">Damage Loss </td>
   
  </tr>
  <tr class="tblsubtitle">
    <td width="100" align="center" valign="middle" class="tblheading" >NoB</td>
    <td width="130" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="77" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="109" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="77" align="center" valign="middle" class="tblheading">%</td>
  </tr>
  <tr class="Light" height="30">
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno" type="text" size="20" class="tbltext"  maxlength="20" style="background-color:#CCCCCC" value="<?php echo $row['lotno'];?>"/></td>

    <td width="100"  align="left" valign="middle" class="tbltext">&nbsp;
      <input name="txtdisp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $row['onob'];?>" style="background-color:#CCCCCC"  readonly="true" />
    &nbsp;&nbsp;</td>
    <td width="130" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtqty" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $row['oqty'];?>"/>
    &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="recqtyp" type="text" size="3" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value);"  value="<?php echo $row['nob1'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

  <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtrecbagp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagschk1(this.value);"  onkeypress="return isNumberKey(event)" value="<?php echo $row['qty1'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp; <input name="txtdqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="3" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true"value="<?php echo $row['adnob'];?>" /></td>
       
      <td align="left"  valign="middle" class="tbltext"> &nbsp;&nbsp;<input name="txtdbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true"value="<?php echo $row['adqty'];?>" />  &nbsp;</td>
	  </tr>
	   <?php
}
else
{
?>
  <tr class="Light" height="30">
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno" type="text" size="20" class="tbltext"  maxlength="20" style="background-color:#CCCCCC" value="<?php echo $row['lotno'];?>"/></td>

    <td width="100"  align="left" valign="middle" class="tbltext">&nbsp;
      <input name="txtdisp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $row['onob'];?>" style="background-color:#CCCCCC"  readonly="true" />
    &nbsp;&nbsp;</td>
    <td width="130" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtqty" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $row['oqty'];?>"/>
    &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="recqtyp" type="text" size="3" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value);"  value="<?php echo $row['nob1'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

  <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtrecbagp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagschk1(this.value);"  onkeypress="return isNumberKey(event)" value="<?php echo $row['qty1'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp; <input name="txtdqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="3" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true"value="<?php echo $row['adnob'];?>" /></td>
       
      <td align="left"  valign="middle" class="tbltext"> &nbsp;&nbsp;<input name="txtdbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true"value="<?php echo $row['adqty'];?>" />  &nbsp;</td>
	  </tr>

<?php
}
$srno++;

?>
</table>
<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>