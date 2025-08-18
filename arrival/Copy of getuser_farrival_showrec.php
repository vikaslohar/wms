<?php
/*session_start();
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
	}*/
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
	$tid = $_GET['g'];	 
	}

if($c=="organiser")
{
$organizer=mysqli_query($link,"select orgid , orgname from tblorganiser where orgid='".$f."' order by orgid ") or die(mysqli_error($link));
 while($noticia_class = mysqli_fetch_array($organizer)) 
 { 
	$srfname=$noticia_class['orgname'];
 } 
}
else if($c=="farmer")
{
/*$farmer1=mysqli_query($link,"select farmerid , farmername from  tblfarmer where farmerid='".$f."' order by farmerid ") or die(mysqli_error($link));
 while($noticia_class = mysqli_fetch_array($farmer1)) 
 { */
	$srfname="";
// } 

}
else
{
	$srfname="";
}

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">GRN No.&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="grn" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $b;?>" maxlength="10"/>  &nbsp;</td>

<td width="131" align="right" valign="middle" class="tblheading">Organiser&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="organi" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $srfname;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">PDN No&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtpdno" type="text" size="10" class="tbltext" tabindex=""    maxlength="5" onchange="pdchk();" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font></td>
	<td width="131" align="right" valign="middle" class="tblheading">PDN Date&nbsp;</td>
            <td width="171" align="left"  valign="middle">&nbsp;<input name="txtpdndate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.txtpdndate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
           </tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">SP Code Male&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodem" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onBlur="javascript:this.value=this.value.toUpperCase();"  onchange="spmchk(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">SP Code Female&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodef" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onBlur="javascript:this.value=this.value.toUpperCase();"  onchange="spfchk(this.value);">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30" id="crver">
<td width="205" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="" maxlength="10"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="131" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="" maxlength="10"/>&nbsp;</td>
</tr>

<?php 
$prloc=mysqli_query($link,"select productionlocationid  , productionlocation  from tblproductionlocation order by productionlocationid ") or die(mysqli_error($link));
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Production Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="" maxlength="10"/>&nbsp;<font color="#FF0000">*</font></td>
<?php 
$p=mysqli_query($link,"select productionpersonnelid , productionpersonnel from tblproductionpersonnel order by productionpersonnelid ") or die(mysqli_error($link));
?>
<td align="right"  valign="middle" class="tblheading">Production Personnel&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="personnel">&nbsp;<input name="txtprod" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="" maxlength="10"/>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
<?php 
$farmer=mysqli_query($link,"select farmerid , farmername from  tblfarmer order by farmerid ") or die(mysqli_error($link));
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Farmer&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="farm">&nbsp;<input name="txtfar" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="" maxlength="10"/>&nbsp;
</select>&nbsp;<font color="#FF0000">*</font></td>

<td align="right"  valign="middle" class="tblheading">Plot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtplot" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" onchange="plnchk();" onkeypress="return isNumberKey(event)"/>	</td>
</tr>
<tr class="Light" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Geographic Index&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="gcode" type="text" size="10" class="tbltext" tabindex=""    maxlength="5" onchange="gichk(this.value);"/>&nbsp;<font color="#FF0000">*</font></td>
	<td align="right"  valign="middle" class="tblheading">Date Of Harvest&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Got Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onchange="gotchk()">
<option value="" selected>--Select--</option>
	<option value="gotr" >GOT-R</option>
	<option value="gotnr" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font>	</td>

<!--<td align="right"  valign="middle" class="tblheading">Plot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtplot" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" onchange="vendorchk();" onkeypress="return isNumberKey(event)" /><font color="#FF0000">*</font>	</td>-->
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;PDN</td>

<td align="left"  valign="middle" class="tblheading">&nbsp;Actual</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;Difference	</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Quantitiy&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" onchange="qtychk1();" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font></td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" onchange="qtychk2(this.value);" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font>	</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffqty" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">No. Of Bags&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcnob" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" onchange="bagschk1();" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font> </td>

<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtactnob" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" onchange="bagschk2(this.value);" onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font></td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdiffnob" type="text" size="10" class="tbltext" tabindex=""    maxlength="2" style="background-color:#CCCCCC" readonly="true"  onkeypress="return isNumberKey(event)"/>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Prelimnary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"/>%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Visual Check&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:100px;" onchange="visuchk()">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not- Acceptable</option>
  </select>  <font color="#FF0000">*</font>	</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="qc" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Under QC" maxlength="10"/>  </td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="206" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>

</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Storage Location </td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="sstage" style="width:100px;" onchange="sschk()">
    <option value="" selected>--Select--</option>
    <option value="Rawseed" >Raw seed</option>
    <!--<option value="Conditionseed" >Condition seed</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<td width="131" align="right" valign="middle" class="tblheading">Seed Staus&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="sstatus" style="width:100px;" onchange="sstschk()">
    <option value="" selected>--Select--</option>
    <option value="BayCoded" >Bay Coded</option>
    <option value="Quarantine" >Quarantine</option>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						?>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Lot No&nbsp;</td>
 <td align="left"  valign="middle" class="tblheading" colspan="3" >&nbsp;<input name="glotno" type="text" size="20" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" maxlength="20" value="<?php echo $tp1?>-<?php echo $a?>-00000" /><!--<input name="lotno" type="text" size="1" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC"  value="G" maxlength="1"/><input name="lotno1" type="text" size="3" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC"  value="" maxlength="3"/><input name="lotno2" type="text" size="4" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC"   value="" maxlength="5"/>/<input name="lotno3" type="text" size="4" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC"  value="00000" maxlength="5"/>--></td>
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
<td width="103" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>

</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="pdnum" value="<?php echo $a;?>" /><textarea name="abc" cols="50" rows="10"></textarea>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>