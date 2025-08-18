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

//frm_action=submit&txt11=Transport&txt14=Paid&txtid=3&logid=SR1&slrgln1=2&txtconchk=&txtptype=Dealer&txtcountrysl=&txtcountryl=&rettype=&date=26-03-2014&dcdate=26-03-2014&txtdcno=Test&txtpp=Dealer&txtsrlno=00002&txtstatesl=Chhattisgarh&txtlocationsl=34&locationname=34&txtstfp=52&txt1=Transport&txttname=tetste&txtlrn=setsetet&txtvn=setset&txt13=Paid&txtcname=&txtdc=&txtpname=&txtdcnopbox=20&txtacnopbox=20&txtesnobox=0&txtdcnobag=5&txtacnopbag=5&txtesnopbag=0&txtdcnopto=25&txtacnopto=25&txtesnopto=0&whd1=WH-PV&txtslwhd1=1&txtslbind1=1&txtslBagsd1=20&whd2=WH-PV&txtslwhd2=1&txtslbind2=2&txtslBagsd2=5&txtcrop=28&txtvariety=16&upstype=Standard&txtupstyp=Standard&itmdchk=&txtupsdc=100.000%20Gms&txtnopdc=20&txtqtydc=2&maintrid=0&subtrid=0
	
	if(isset($_GET['txt11'])) { $txt11 = $_GET['txt11']; }
	if(isset($_GET['txt14'])) { $txt14 = $_GET['txt14']; }
	if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
	if(isset($_GET['date'])) { $date = $_GET['date']; }
	if(isset($_GET['txtptype'])) { $txtptype = $_GET['txtptype']; }
	if(isset($_GET['txtcountryl'])) { $txtcountryl = $_GET['txtcountryl']; }
	if(isset($_GET['dcdate'])) { $dcdate = $_GET['dcdate'];	}
	if(isset($_GET['txtdcno'])) { $txtdcno= $_GET['txtdcno']; }
	if(isset($_GET['txtpp'])) { $txtpp = $_GET['txtpp']; }
	if(isset($_GET['rettype'])) { $rettype= $_GET['rettype']; }
	if(isset($_GET['txtstatesl'])) { $txtstatesl= $_GET['txtstatesl']; }
	if(isset($_GET['txtlocationsl'])) { $txtlocationsl = $_GET['txtlocationsl']; }
	if(isset($_GET['locationname'])) { $locationname = $_GET['locationname']; }
	if(isset($_GET['txtstfp'])) { $txtstfp = $_GET['txtstfp']; }
	if(isset($_GET['txt1'])) { $txt1 = $_GET['txt1'];	}
	if(isset($_GET['txttname'])) { $txttname = $_GET['txttname']; }
	if(isset($_GET['txtlrn'])) { $txtlrn = $_GET['txtlrn']; }
	if(isset($_GET['txtvn'])) { $txtvn = $_GET['txtvn']; }
	if(isset($_GET['txt13'])) { $txt13 = $_GET['txt13']; }
	if(isset($_GET['txtcname'])) { $txtcname = $_GET['txtcname']; }
	if(isset($_GET['txtdc'])) { $txtdc = $_GET['txtdc']; }
	if(isset($_GET['txtpname'])) { $txtpname = $_GET['txtpname']; }
	if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop']; }
	if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }
	if(isset($_GET['itmdchk'])) { $itmdchk = $_GET['itmdchk']; }
	if(isset($_GET['txtupsdc'])) { $txtupsdc = $_GET['txtupsdc']; }
	if(isset($_GET['txtnopdc'])) { $txtnopdc = $_GET['txtnopdc']; }
	if(isset($_GET['txtqtydc'])) { $txtqtydc = $_GET['txtqtydc']; }
	if(isset($_GET['maintrid'])) { $z1 = $_GET['maintrid']; }
	if(isset($_GET['subtrid'])) { $subtrid = $_GET['subtrid']; }
	if(isset($_GET['slrgln1'])) { $slrgln1 = $_GET['slrgln1']; }
	if(isset($_GET['txtupstyp'])) { $txtupstyp = $_GET['txtupstyp']; }
	
	if(isset($_GET['txtdcnopbox'])) { $txtdcnopbox = $_GET['txtdcnopbox']; }
	if(isset($_GET['txtacnopbox'])) { $txtacnopbox = $_GET['txtacnopbox']; }
	if(isset($_GET['txtdcnobag'])) { $txtdcnobag = $_GET['txtdcnobag']; }
	if(isset($_GET['txtacnopbag'])) { $txtacnopbag = $_GET['txtacnopbag']; }
	if(isset($_GET['txtdcnopto'])) { $txtdcnopto = $_GET['txtdcnopto']; }
	if(isset($_GET['txtacnopto'])) { $txtacnopto = $_GET['txtacnopto']; }
	
	if(isset($_GET['txtslwhd1'])) { $txtslwhd1 = $_GET['txtslwhd1']; }
	if(isset($_GET['txtslbind1'])) { $txtslbind1 = $_GET['txtslbind1']; }
	if(isset($_GET['txtslBagsd1'])) { $txtslBagsd1 = $_GET['txtslBagsd1']; }
	if(isset($_GET['txtslwhd2'])) { $txtslwhd2 = $_GET['txtslwhd2']; }
	if(isset($_GET['txtslbind2'])) { $txtslbind2 = $_GET['txtslbind2']; }
	if(isset($_GET['txtslBagsd2'])) { $txtslBagsd2 = $_GET['txtslBagsd2']; }
	
	if(isset($_GET['txtremarks'])) { $txtremarks = $_GET['txtremarks']; }
	$txtremarks=str_replace("&","and",$txtremarks);
	
	$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
	$edate1=explode("-",$dcdate);
	$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
	
if($z1 == 0)
{
  $sql_main="insert into tbl_salesrv (salesr_yearcode, salesr_trtype, salesr_tcode, salesr_date, salesr_logid, salesr_dcno, salesr_dcdate, salesr_partytype, salesr_state, salesr_loc, salesr_party, salesr_tmode, salesr_tname, salesr_lrno, salesr_vehno, salesr_pmode, salesr_cname, salesr_docket, salesr_pname, salesr_retryp, salesr_tslrno, salesr_wh, salesr_bin, salesr_nop, salesr_wh1, salesr_bin1, salesr_nop1, salesr_dnop, salesr_dnop1, salesr_nob, salesr_nob1, salesr_tnop, salesr_tnop1, salesr_remarks, plantcode)values('$yearid_id', 'Sales Return', '$txtid', '$date', '$logid', '$txtdcno', '$dot', '$txtpp', '$txtstatesl', '$locationname', '$txtstfp', '$txt1', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$rettype', '$slrgln1', '$txtslwhd1', '$txtslbind1', '$txtslBagsd1', '$txtslwhd2', '$txtslbind2', '$txtslBagsd2', '$txtdcnopbox', '$txtacnopbox', '$txtdcnobag', '$txtacnopbag', '$txtdcnopto', '$txtacnopto', '$txtremarks', '$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tbl_salesrv_sub (salesr_id, salesrs_crop, salesrs_variety, salesrs_ups, salesrs_nob, salesrs_qty, salesrs_yearcode, salesrs_wh, salesrs_bin, salesrs_upstype, salesrs_typ, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtupsdc', '$txtnopdc', '$txtqtydc', '$yearid_id', '$txtslwhd1', '$txtslbind1', '$txtupstyp', 'verrec', '$plantcode')";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
$z1=$mainid;
}
else
{
$sql_main="update tbl_salesrv set salesr_yearcode='$yearid_id', salesr_trtype='Sales Return', salesr_tcode='$txtid', salesr_date='$date', salesr_logid='$logid', salesr_dcno='$txtdcno', salesr_dcdate='$dot', salesr_partytype='$txtpp', salesr_state='$txtstatesl', salesr_loc='$locationname', salesr_party='$txtstfp', salesr_tmode='$txt1', salesr_tname='$txttname', salesr_lrno='$txtlrn', salesr_vehno='$txtvn', salesr_pmode='$txt13', salesr_cname='$txtcname', salesr_docket='$txtdc', salesr_pname='$txtpname', salesr_retryp='$rettype', salesr_tslrno='$slrgln1', salesr_wh='$txtslwhd1', salesr_bin='$txtslbind1', salesr_nop='$txtslBagsd1', salesr_wh1='$txtslwhd2', salesr_bin1='$txtslbind2', salesr_nop1='$txtslBagsd2', salesr_dnop='$txtdcnopbox', salesr_dnop1='$txtacnopbox', salesr_nob='$txtdcnobag', salesr_nob1='$txtacnopbag', salesr_tnop='$txtdcnopto', salesr_tnop1='$txtacnopto', salesr_remarks='$txtremarks' where salesr_id = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;

$sql_sub="insert into tbl_salesrv_sub (salesr_id, salesrs_crop, salesrs_variety, salesrs_ups, salesrs_nob, salesrs_qty, salesrs_yearcode, salesrs_wh, salesrs_bin, salesrs_upstype, salesrs_typ, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtupsdc', '$txtnopdc', '$txtqtydc', '$yearid_id', '$txtslwhd1', '$txtslbind1', '$txtupstyp', 'verrec', '$plantcode')";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">#</td>
	<td width="16%" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="24%" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="14%" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="16%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="14%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Edit</td>
	<td width="7%" align="center" valign="middle" class="tblheading">Delete</td>
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

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table><br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="89" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="209" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
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
	<td width="70" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="70" align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td width="188" align="left"  valign="middle" class="tbltext"><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked" />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)" />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /></td>		
</tr>
<input type="hidden" name="itmdchk" value="" />
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="209" align="left"  valign="middle" class="tbltext" id="upschd">&nbsp;<select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="210" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="70" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="188" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="nopschk(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>