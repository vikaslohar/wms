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
	
$s_sub="delete from tbl_salesr_sub where salesrs_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$s_sub_sub="delete from tbl_salesrsub_sub where salesrs_id='".$b."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesr_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
?>
<?php
if($tot_sub > 0)
$tid=$a;
else
$tid=0;

$arrival_id=$tid;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php

$sql_tbl=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Opening Stock Condition' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="22" align="center" valign="middle" class="tblheading">#</td>
	<td width="85" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="105" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="90" align="center" valign="middle" class="tblheading">Old Lot No.</td>
	<td width="66" align="center" valign="middle" class="tblheading">New Lot No.</td>
	<td width="66" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="70" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="66" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="51" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="78" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="39" align="center" valign="middle" class="tblheading">Gemp %</td>
	<td width="128" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="35" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="39" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

if($row_tbl_sub['salesrs_pp']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['salesrs_pp']=="Not-Acceptable")
{
$cc="NAC";
}

	$trdate=$row_tbl_sub['salesrs_dot'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
		
if($row_tbl_sub['salesrs_qc']!="OK" && $row_tbl_sub['salesrs_qc']!="Fail")
{
$trdate="--";
}


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_id='".$row_tbl_sub['salesrs_id']."' order by salesrss_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_sloc['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_sloc['salesrss_bin']."' and whid='".$row_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_sloc['salesrss_subbin']."' and binid='".$row_sloc['salesrss_bin']."' and whid='".$row_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['salesrss_nob']; 
$slqty=$slqty+$row_sloc['salesrss_qty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
   <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table>
<div id="postingsubtable" style="display:block">		 
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="98" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="107" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="211" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           
<td width="86" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" width="164" valign="middle" class="smalltblheading"  >&nbsp;<input type="hidden" id="txtstage" name="txtstage" value="Condition" />Condition</td>
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="270" valign="middle" class="smalltbltext">&nbsp;
  <select class="smalltbltext" name="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onchange="stchko2();" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotchko"><input type="hidden" name="lotchecko" value="0" /></div></td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchk();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotcheck"><input type="hidden" name="lotcheck1" value="0" /></div></td>	
</tr>

<tr class="Light" height="30">
<!--<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"  >&nbsp;<input name="txtactqty" type="text" size="9" class="smalltbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6" >QC Information</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="qcstatus" style="width:100px;"  onchange="varchk(this.value);"  >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
	<option value="UT" >UT</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">Date of Test (DoT)&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"   >&nbsp;<input name="edate" id="edate1" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('edate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
          
	 
</tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtpp" style="width:110px;" onchange="qcchk();">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="smalltbltext" tabindex="" onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
	   <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtgemp" id="txtgerm" type="text" size="1" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);"/>%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

           </tr>
		   
</table>
<div id="subsubdivgood" style="display:block">
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
