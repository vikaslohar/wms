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

$tot_row=0; $nob=0; $qty=0; $sstage="";
$lotqry=mysqli_query($link,"select * from tbl_cobdryingsub where subtrid ='".$c."' and plantcode='$plantcode'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);

if($row['drytyp']=='single')
$ltno=$row['lotno'];
else if($row['drytyp']=='batch')
$ltno=$row['newlono'];

$sql_tbl_sub23=mysqli_query($link,"select * from tbl_cobdrying where trid='".$row['trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_arrival23=mysqli_num_rows($sql_tbl_sub23);
$row23=mysqli_fetch_array($sql_tbl_sub23);

if($row['drytyp']=='single')
$lotqry2=mysqli_query($link,"select * from tbl_cobdryingsub where trid ='".$row['trid']."' and lotno='$a' and plantcode='$plantcode'")or die (mysqli_error($link));
else if($row['drytyp']=='batch')
$lotqry2=mysqli_query($link,"select * from tbl_cobdryingsub where trid ='".$row['trid']."' and newlono='$a' and plantcode='$plantcode'")or die (mysqli_error($link));
else
$lotqry2=mysqli_query($link,"select * from tbl_cobdryingsub where subtrid ='".$c."' and plantcode='$plantcode'")or die (mysqli_error($link));
$tot_row2=mysqli_num_rows($lotqry2);
while($row2= mysqli_fetch_array($lotqry2))
{
	$lotqry3=mysqli_query($link,"select * from tbl_cobdryingsubsub where subtrid ='".$row2['subtrid']."' and plantcode='$plantcode'")or die (mysqli_error($link));
	$tot_row3=mysqli_num_rows($lotqry3);
	while($row3= mysqli_fetch_array($lotqry3))
	{
		$nob=$nob+$row3['nnob']; 
		$qty=$qty+$row3['nqty']; 
		$sstage=$row2['sstage'];
	}
}

$lot=$row23['crop '];	

 if($row23['variety']!="")
 {
 	$variety=$row23['variety'];
 }
else
{
	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$row23['variety']."' and actstatus='Active' and vertype='PV'");
	if($t=mysqli_num_rows($lotqry1)>0)
	{
		$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
		$variety=$row11['popularname'];
		$qctyp=$row11['opt'];
	}
	else
	{
		$variety="";
		$qctyp="";
		$fg++;
	}
}

// echo $tot_row;
$vvr=$lot."-"."Coded";
 
 if($row['drytyp']=='single')
	$ltno=$row['lotno'];
	else if($row['drytyp']=='batch')
	$ltno=$row['newlono'];
	else
	$ltno=$row['lotno'];
	
 $tdate1=$row23['dryingdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
	
if($tot_row > 0)
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext"  maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row23['crop'];?>"/></td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="113" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="249" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext"  maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row23['variety'];?>"/>
&nbsp;</td>
  </tr>

 <tr class="Dark" height="25">
<td width="206" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  >&nbsp;<input name="sstage" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" readonly="true" value="<?php echo $sstage;?>"/>
  	</td>
<td width="147" align="right"  valign="middle" class="tblheading">Seed Status&nbsp;</td>
    <td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" style="background-color:#CCCCCC" readonly="true"></td>
  </tr>
<!--<td width="206" align="right" valign="middle" class="tblheading">Seed Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtstage" style="width:170px;" onChange="sschk1()">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <option value="Condition" >Condition</option>
	  </select>&nbsp;<font color="#FF0000">*</font>	</td>-->
	 <?php
	  $sql_pl=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
	  $row_pl=mysqli_fetch_array($sql_pl);
	  $pl=$row_pl['code'];
	  ?>
 <tr class="Light" height="25">
           <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;Lot Number&nbsp;</td>
    <td width="250" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlotp22" type="text" size="20" class="tbltext" tabindex="" maxlength="20" style="background-color:#CCCCCC"  value="<?php echo $ltno;?>"   readonly="true"/>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Date&nbsp;</td>
<td width="247" align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="dcdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"   style="background-color:#EFEFEF"  value="<?php echo $tdate1;?>" />&nbsp;</td>
 </tr>
 
        <tr class="Dark" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch NoB &nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsdcchk(this.value);"  value="<?php echo $nob;?>" style="background-color:#CCCCCC" readonly="true" /></a>&nbsp;&nbsp;</td>
		
<td width="197" align="right"  valign="middle" class="tblheading" >Dispatch  Qty&nbsp;</td>
<td width="212" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $qty;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Actual NoB &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagschk1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Actual Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onchange="qtychk1(this.value);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Difference NoB &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="4" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" />  &nbsp;&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="9" class="tbltext" tabindex="" maxlength="3" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" >&nbsp;&nbsp;</td>
</tr>

<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" id="txtmoist" name="txtmoist" style="width:110px;" onchange="moischk(this.value)">
    <option value="Acceptable" selected="selected" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" id="tvisualck" name="txtvisualck" style="width:110px;" onchange="clk3(this.value)">
    <option value="Acceptable" selected="selected" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>

<!--<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">QC Status &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtqc" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="UT" >UT</option>
	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >RT</option>
    
  </select>  <font color="#FF0000">*</font><input name="txtqc1" type="hidden" size="30" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="30"/></td>
  
</tr>
--><tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Generate QC Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qc2"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 <td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqc" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="UT" maxlength="20"/></td>
</tr>
<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">GS Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="gs1"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 </tr>
</table>
<div id="transs" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="230" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT ) </td>
</tr>		   
		   <tr class="Light" height="30">
<td width="229" align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td width="325" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onchange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Auto GOT at Arrival Status&nbsp;<input name="autogotstatus" type="text" size="7" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $qctyp?>" /></td>
<td width="232" align="right"  valign="middle" class="tblheading">Generate GOT Sample&nbsp;</td>
 <td width="154" align="left"  valign="middle" class="tbltext">&nbsp;<?php if($variety==$vvr){?>  <input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else if($qctyp == "Mandatory"){?>
   <input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1" /><?php } else { ?><input id="gscb" name="gotsample"  type="checkbox" class="tbltext" tabindex="0" value="0" onclick="gensmpchk()" /><?php } ?><input type="hidden" name="gscheckbox" value="<?php if($qctyp == "Mandatory"){ echo "1";} if($variety==$vvr){ echo "1";}?>"  /></td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="gotstatus" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="20"/></td>
 </tr>

</table>

<div id="subsubdivgood" style="display:block">
<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" > 
 <tr class="Light" height="30" style="border-color:#F1B01E">
<td align="right" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl_sub['remarks'];?>" ></td>
</tr>
</table>-->
<div id="transs" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="230" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >

  <tr class="tblsubtitle" height="20">
    <td colspan="9" align="center" class="tblheading">Storage Location (SLOC) </td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC </td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
    <td width="292" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">SuB Bin</td>
  </tr>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
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
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
        <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' ") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
        <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
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
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="5" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

</table>
<br />

<?php $tid=$b; ?>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details cannot display reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot number not Imported</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already arrived.</td>
</tr>
</table>
<?php
}
?>