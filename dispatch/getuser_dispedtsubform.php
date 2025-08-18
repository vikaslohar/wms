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

if(isset($_REQUEST['b'])) { $maintrid=$_REQUEST['b']; }
if(isset($_REQUEST['a'])) { $subtrid=$_REQUEST['a']; }
if(isset($_REQUEST['c'])) { $sn=$_REQUEST['c']; }
if(isset($_POST['h'])) { $h=$_POST['h']; }

$tid=$maintrid;

//$sql_subsub5="update tbl_disp_sub set disps_tnomp='$h' where disps_id='$subtrid'";
//$asdf5=mysqli_query($link,$sql_subsub5) or die(mysqli_error($link));		

$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

	$arrival_id=$row_tbl['disp_id'];

	$tdate=$row_tbl['disp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
		
$subtid=$subtrid;
$subsubtid=0;
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch - Direct Loading / Non-Allocation Type</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="smalltblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TDP".$row_tbl['disp_tcode']."/".$row_tbl['disp_yearcode']."/".$row_tbl['disp_logid'];?></td>

<td width="172" align="right" valign="middle" class="smalltblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate;?><input name="date" type="hidden" size="10" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="smalltblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $row_tbl['disp_partytype']; ?><input type="hidden" class="smalltbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['disp_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['disp_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['disp_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="smalltblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['disp_state']; ?><input type="hidden"  class="smalltbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['disp_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['disp_state']."' and productionlocationid='".$row_tbl['disp_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="smalltblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="smalltbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="smalltbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['disp_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['disp_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['disp_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="230"  align="right"  valign="middle" class="smalltblheading">Country&nbsp;</td>
<td  colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="smalltbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['disp_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['disp_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['disp_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['disp_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="smalltblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="smalltbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="smalltbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['disp_party'];?>"  /></td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['disp_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="smalltblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td width="230" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport") echo "checked"; ?> />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier") echo "checked"; ?> />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand") echo "checked"; ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txt11" value="<?php echo $row_tbl['tmode'];?>" type="hidden"> </td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="230" align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td width="262" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txttname" type="text" size="25" class="smalltbltext" tabindex="" maxlength="25" value="<?php echo $row_tbl['trans_name'];?>"></td>
<td width="192" align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="smalltbltext" tabindex=""  maxlength="15" value="<?php echo $row_tbl['trans_lorryrepno'];?>" ></td>
</tr>

<tr class="Light" height="25">
<td width="230" align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td width="262" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="smalltbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>" ></td>
<td width="192" align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txt13" style="width:70px;"  >
<option value="" selected="selected">Select</option>
<option <?php if($row_tbl['trans_paymode']=="TBB")echo "Selected";?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="To Pay")echo "Selected";?> value="To Pay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid")echo "Selected";?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="230" align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td width="262" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtcname" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" ></td>
<td width="192" align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>" ></td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="230" align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtpname" type="text" size="30" class="smalltbltext" tabindex=""  maxlength="30" value="<?php echo $row_tbl['pname_byhand'];?>" ></td>
</tr>
</table>
</div>
</div>
<div id="orderdetails">
<?php

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='".$row_tbl['disp_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and (order_trtype='Order Sales' OR order_trtype='Order Stock') and orderm_tflag=1 and orderm_holdflag!=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
	else
		$arrivalid=$rowtbl['orderm_id'];
}

$ver=""; $cpr="";
if($arrivalid!="")
{
$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_crop") or die(mysqli_error($link));
$totver1=mysqli_num_rows($sql_ver1);
while($row_ver1=mysqli_fetch_array($sql_ver1))
{
	if($cpr!="")
		$cpr=$cpr.",".$row_ver1['order_sub_crop'];
	else
		$cpr=$row_ver1['order_sub_crop'];
}
//echo $arrivalid;
$cp="";
$sq_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid IN ($cpr) order by cropname Asc") or die(mysqli_error($link));
while($ro_crp=mysqli_fetch_array($sq_crp))
{
	if($cp!="")
		$cp=$cp.",".$ro_crp['cropid'];
	else
		$cp=$ro_crp['cropid'];
}
$arid=explode(",",$cp);
foreach($arid as $atrid)
{
if($atrid<>"")
{
$ver1="";
$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_crop='$atrid' and order_sub_hold_flag=0 and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
$totver2=mysqli_num_rows($sql_ver2);
while($row_ver2=mysqli_fetch_array($sql_ver2))
{
	if($ver1!="")
		$ver1=$ver1.",".$row_ver2['order_sub_variety'];
	else
		$ver1=$row_ver2['order_sub_variety'];
}
$vp="";
$sq_vrp=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid IN ($ver1) and actstatus='Active' order by popularname Asc") or die(mysqli_error($link));
while($ro_vrp=mysqli_fetch_array($sq_vrp))
{
	if($vp!="")
		$vp=$vp.",".$ro_vrp['varietyid'];
	else
		$vp=$ro_vrp['varietyid'];
}
if($ver!="")
	$ver=$ver.",".$vp;
else
	$ver=$vp;

}
}
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Pending Order(s) in Progress</td>
</tr>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Order No</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoMP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcodes</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Dispatched</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>
</tr>
<?php 
$ordnos=""; $veridno=""; $upsnos=""; $sn=1; $totbarcs=""; $orderns="";
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{

$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}


$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $nord=0; $ordno="";

$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

		

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1 and orderm_holdflag!=1")or die("Error:".mysqli_error($link));
		if($tot=mysqli_num_rows($sql_m) > 0)
		{
			while($row_m=mysqli_fetch_array($sql_m))
			{
				if($ordno!="")
				$ordno=$ordno.",".$row_m['orderm_porderno'];
				else
				$ordno=$row_m['orderm_porderno'];
				$nord++;
			}
		}
		
		$orxd=explode(",",$ordno);
		$tid240=array_keys(array_flip($orxd));
		$ordno=implode(",",$tid240);
		
		if($reptyp1=="hold")
	    {	
			if($rowtblsub['order_sub_hold_flag']!=0)
				$statussub=$rowtblsub['order_sub_hold_type'];	
		}
		else
		{
			$statussub="";
		}


		$variet=$row_dept4['popularname'];
		$upstyp=$rowtblsub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		/*if($crop!="")
		{
		$crop=$crop."<br>".$rowtblsub['order_sub_crop'];
		// $rowtblsub['lotcrop'];
		}
		else
		{*/
		$crop=$rowtblsub['order_sub_crop'];
		//}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		/*if($variety!="")
		{
		$variety=$variety."<br>".$rowtblsub['order_sub_variety'];
		}
		else
		{*/
		$variety=$rowtblsub['order_sub_variety'];	
		//}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		/*if($lotno!="")
		{
			$lotno=$lotno."<br>".$rowtblsub['lotno'];
		}
		else
		{
			$lotno=$rowtblsub['lotno'];
		}
		if($bags!="")
		{
			$bags=$bags."<br>".$acn;
		}
		else
		{
			$bags=$acn;
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		if($qc!="")
		{
			$qc=$qc."<br>".$rowtblsub['qc'];
		}
		else
		{
			$qc=$rowtblsub['qc'];
		}
		if($got!="")
		{
			$got=$got."<br>".$rowtblsub['got'];
		}
		else
		{
			$got=$rowtblsub['got'];
		}
		if($stage!="")
		{
			$stage=$stage."<br>".$rowtblsub['order_sub_totbal_qty'];
		}
		else
		{
			$stage=$rowtblsub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
			$per=$per."<br>".$rowtblsub['pper'];
		}
		else
		{
			$per=$rowtblsub['pper'];
		}*/
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	$xfd=count($dq);
	if($upstyp=="NST")
	{
		//$dq[1]="000";
		//if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
		if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
	}
	else
	{
		if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
	}
	$up1=$qt1." ".$zz[1];
	$ups24=$up1;
	/*if($up!="")
		$up=$up.$up1."<br/>";
	else*/
		$up=$up1;

	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	/*if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}*/
	$sstatus=$sstatus+$row_sloc['order_sub_sub_nop'];
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($ordnos!="")
{
	$ordnos=$ordnos.",".$ordno;
}
else
{
	$ordnos=$ordno;
}

if($veridno!="")
{
	$veridno=$veridno.",".$variety;
}
else
{
	$veridno=$variety;
}
if($upsnos!="")
{
	$upsnos=$upsnos.",".$up1;
}
else
{
	$upsnos=$up1;
}
if($qt > 0)	 
{



$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		

$sq3=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='$cro' and disps_variety='$variet' and disps_ups='$up1' and disps_flg!=1 and disp_id='$tid'") or die(mysqli_error($link));
if($to3=mysqli_num_rows($sq3) > 0)
{
	$ro3=mysqli_fetch_array($sq3);
	$sid3=$ro3['disps_id'];
	$sq23=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid3' and disp_id='$tid'") or die(mysqli_error($link));
	while($row_23=mysqli_fetch_array($sq23))
	{
		if($barcds!="")
			$barcds=$barcds.",".$row_23['dpss_barcode'];
		else
			$barcds=$row_2['dpss_barcode'];
		if($totbarcs!="")
			$totbarcs=$totbarcs.",".$row_23['dpss_barcode'];
		else
			$totbarcs=$row_23['dpss_barcode'];		
	}
}

if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='$cro' and disps_variety='$variet' and disps_ups='$up1' and disps_id='$subtid' and disps_upstype='$upstyp' and disps_flg!=1 and disp_id='$tid'") or die(mysqli_error($link));
else
$sq=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='$cro' and disps_variety='$variet' and disps_ups='$up1' and disps_flg!=1 and disps_upstype='$upstyp' and disp_id='$tid'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $barcds=""; //$nuqt=0;

if($to=mysqli_num_rows($sq) > 0)
{
$ro=mysqli_fetch_array($sq);
$nuqt=$qt;
$nups=$ro['disps_ups']; 
$nnob=$ro['disps_nob']; 
$nqty=$ro['disps_qty']; 
//$nbqty=$ro['disps_bqty'];
$nbqty=$qt-$nqty;
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['disps_id'];
$sn24=$sn;
$dbsflg=$ro['disps_flg'];

$sq2=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid' order by dpss_id ASC") or die(mysqli_error($link));
$totrec=mysqli_num_rows($sq2);
while($row_2=mysqli_fetch_array($sq2))
{
	if($barcds!="")
		$barcds=$barcds.",".$row_2['dpss_barcode'];
	else
		$barcds=$row_2['dpss_barcode'];
}
if($orderns!="")
$orderns=$orderns.",".$ordno;
else
$orderns=$ordno;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $up1?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up1;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext" title="<?php echo $ordno ?>"><?php echo $nord;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $totrec;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $totrec;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php if($barcds!=""){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $barcds;?>')">Details</a><?php } ?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $totrec;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php if($nbqty>0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $upstyp;?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $variety?>','<?php echo $up1 ?>','<?php echo $qt?>','<?php echo $ordno?>','<?php echo $upstyp;?>');"  /><?php } ?></td>
</tr>
<input type="hidden" name="mchksel" value="<?php echo $sn24?>" /><input type="hidden" name="txtornos" value="<?php echo $ordno;?>" /><input type="hidden" name="txtveridno" value="<?php echo $vt;?>" /><input type="hidden" name="txtupsnos" value="<?php echo $up1;?>" /><input type="hidden" name="txteqty" value="<?php echo $qt;?>" />
<?php
$sn++;
//}
//}
}
}
}
}
}
}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" />
</table>
</div>	
<br />
<div id="showorsel">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="13" align="center" class="tblheading">Loading IN-Progress</td>
</tr>
<tr class="Dark" height="30">
	<td width="67" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="100" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="150" align="center"  valign="middle" class="smalltblheading">PSDN Variety</td>
	<td width="40" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Ordered NoMP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">To Load NoMP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Loaded NoMP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">To be Loaded NoMP</td>
	<td width="65" align="center"  valign="middle" class="smalltblheading">Balance Ordered NoMP</td>
</tr>
<?php
$totre=0; $nolots=0; //echo $nuqt;
$sq=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disps_flg!=1 and disp_id='$tid'") or die(mysqli_error($link));
if($to=mysqli_num_rows($sq) > 0)
{
while($ro=mysqli_fetch_array($sq))
{
$sid=$ro['disps_id'];
$cro=$ro['disps_crop'];
$variet=$ro['disps_variety'];
$newvariet=$ro['disps_nvariety'];
//$orn=$ro['disps_ordno'];
$orn=$ordno;
$upstyp=$ro['disps_upstype'];
$up=$ro['disps_ups'];
$sstatus=$ro['disps_onop'];
//$qt=$ro['disps_oqty'];
//$onpmp=$ro['disps_onomp'];
$qt=$nuqt;

	$sq23=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
	}
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];
	
$ups24=$up;
$zx=explode(" ",$up);

$sql_sel="select * from tblups where wt='".$zx[1]."' and ups='".$zx[0]."' order by uom Asc";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$row1234=mysqli_num_rows($res);
$row12=mysqli_fetch_array($res);
$uid=$row12['uid'];

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$vt."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$srnonew=0;
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
foreach($p1_array as $val1)
{
	if($val1<>"")
	{
		if($val1==$uid)
		{
			$wtmp=$p1_array2[$srnonew];
			$mptnop=$p1_array3[$srnonew];
		}
	}
	$srnonew++;
}
//echo $upstyp;	
//if($wtmp=="" || $wtmp==0)$wtmp=$zx[0];
if($upstyp=="NST")
{
	$sqlissue121=mysqli_query($link,"select Distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  packtype='$ups24' and trtype='NSTPNPSLIP' and balnomp!=0 and lotldg_variety='$vt'") or die(mysqli_error($link));
	while($rowissue121=mysqli_fetch_array($sqlissue121))
	{
		$sqlissue12=mysqli_query($link,"select Distinct subbinid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$rowissue121['lotno']."' and packtype='$ups24' and trtype='NSTPNPSLIP' and lotldg_variety='$vt'") or die(mysqli_error($link));
		while($rowissue12=mysqli_fetch_array($sqlissue12))
		{
					
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$rowissue121['lotno']."' and packtype='$ups24' and lotldg_variety='$vt' and subbinid='".$rowissue12['subbinid']."'") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
							
			//$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and balnomp > 0") or die(mysqli_error($link)); 
			//$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
			
			$sql_lot2=mysqli_query($link,"Select packtype,wtinmp from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_issue1[0]."' and balqty > 0 and balnomp > 0") or die(mysqli_error($link));
			$tot_lot2=mysqli_num_rows($sql_lot2);
			$row_lot2=mysqli_fetch_array($sql_lot2);
			$wtmp=$row_lot2['wtinmp'];
			$up1=$ups24;
		}
	}
}
//echo $wtmp;	
if($wtmp=="" || $wtmp==0)$wtmp=$zx[0];
$mpno=$qt/$wtmp;	
$xcb=explode(".",$mpno);
if($xcb[1]>0)
$mpno=floor($mpno);

$onpmp=$mpno;
$tnomp=$ro['disps_tnomp'];
//$bnomp=$ro['disps_bnomp'];
$nomp=$ro['disps_nomp'];
$tlnomp=$tnomp-$nomp;
$bnomp=$onpmp-$tnomp;
if($bnomp<=0)$bnomp=0;
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cro?><input type="hidden" name="txtecrop" id="txtecrop" value="<?php echo $cro;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variet?><input type="hidden" name="txtevariety" id="txtevariety" value="<?php echo $variet;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="20" class="smalltbltext" maxlength="30" name="txtpvariety" id="txtpvariety" value="<?php echo $newvariet;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upstyp?><input type="hidden" name="txteupstyp" id="txteupstyp" value="<?php echo $upstyp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $up?><input type="hidden" name="txteups" id="txteups" value="<?php echo $up;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sstatus;?><input type="hidden" name="txtenop" id="txtenop" value="<?php echo $sstatus;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qt;?><input type="hidden" name="txteqty" id="txteqty" value="<?php echo $qt;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nolots;?><input type="hidden" name="txteordno" id="txteordno" value="<?php echo $orn;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" name="txtornomp" size="5" id="txtornomp" value="<?php echo $onpmp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="5" maxlength="5" name="txtnomp" id="txtnomp" value="<?php echo $tnomp;?>" onchange="nompchk(this.value);" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="5" name="txtlonomp" id="txtlonomp" value="<?php echo $nomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="5" name="txttlonomp" id="txttlonomp" value="<?php echo $tlnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="5" name="txtorblnomp" id="txtorblnomp" value="<?php echo $bnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
}
?>
</table>
</div>
<?php 
if($totre==0)
{
?>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" onClick="backupform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>
<br />

<div id="postingsubtable" style="display:block">
<div id="barupdetails" >
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Lot wise Loading IN-Progress View</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="28" align="center" class="smalltblheading">#</td>
	<td width="99" align="center" class="smalltblheading">Crop</td>
	<td width="134" align="center" class="smalltblheading">Variety</td>
	<td width="92" align="center" class="smalltblheading">UPS</td>
	<td width="117" align="center" class="smalltblheading">Lot No.</td>
	<td width="74" align="center" class="smalltblheading">QC Status</td>
	<td width="79" align="center" class="smalltblheading">DoT</td>
	<td width="89" align="center" class="smalltblheading">DoV</td>
	<td width="54" align="center" class="smalltblheading">NoMP</td>
	<td width="82" align="center" class="smalltblheading">Qty</td>
	<td width="102" align="center" class="smalltblheading">Barcodes</td>
</tr>
</table>
<?php
$sno2=0; $totrec=0;
$sq2=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
$totrec=mysqli_num_rows($sq2);
?>
<div id="table-wrapper" style=" <?php if($totrec<=4) {?>height:auto; width:945px; overflow:hidden;<?php } else{?>height:101px; width:970px; overflow:auto;<?php } ?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse;" > 
<?php
if($totrec=mysqli_num_rows($sq2) > 0)
{
	while($ro2=mysqli_fetch_array($sq2))
	{
		$lot2=$ro2['dpss_lotno']; 
		$nompt=0; $nqty2=0; $barc="";
		$sq3=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  dpss_lotno='$lot2' and disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
		while($ro3=mysqli_fetch_array($sq3))
		{
			$crps=$ro3['dpss_crop']; 
			$vers=$ro3['dpss_variety']; 
			$upss=$ro3['dpss_ups']; 
			$dovs=$ro3['dpss_dov']; 
			$qcss=$ro3['dpss_qc']; 
			$dots=$ro3['dpss_dot']; 
			
			$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
			$row_dept5=mysqli_fetch_array($quer5);
			$cps=$row_dept5['cropname'];
			$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
			$row_dept4=mysqli_fetch_array($quer4);
			$vts=$row_dept4['popularname'];
			
			$tdate=$dovs;
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dov=$tday."-".$tmonth."-".$tyear;
			
			$tdate=$dots;
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dot=$tday."-".$tmonth."-".$tyear;
			
			$nompt=$nompt+1;
			$nqty2=$nqty2+$ro3['dpss_qty'];
			if($barc!="") 
				$barc=$barc.",".$ro3['dpss_barcode'];
			else
				$barc=$ro3['dpss_barcode'];
		}
$sno2++;		
?>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext"><?php echo $sno2;?></td>
	<td width="97" align="center" class="smalltbltext"><?php echo $cps;?></td>
	<td width="131" align="center" class="smalltbltext"><?php echo $vts;?></td>
	<td width="90" align="center" class="smalltbltext"><?php echo $upss;?></td>
	<td width="115" align="center" class="smalltbltext"><?php echo $lot2;?></td>
	<td width="73" align="center" class="smalltbltext"><?php echo $qcss;?></td>
	<td width="80" align="center" class="smalltbltext"><?php echo $dot;?></td>
	<td width="87" align="center" class="smalltbltext"><?php echo $dov;?></td>
	<td width="53" align="center" class="smalltbltext"><?php echo $nompt;?></td>
	<td width="80" align="center" class="smalltbltext"><?php echo $nqty2;?></td>
	<td width="92" align="center" class="smalltbltext"><?php if($barc!=""){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $barc;?>')">Details</a><?php } ?></td>
</tr>
<?php

}
}
?>
</table>
</div>
</div><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Latest Barcode View</td>
</tr>
<tr class="Light" height="25">
	<!--<td width="20" align="center" class="smalltblheading">#</td>-->
	<td width="96" align="center" class="smalltblheading">Barcode</td>
	<td width="96" align="center" class="smalltblheading">Crop</td>
	<td width="130" align="center" class="smalltblheading">Variety</td>
	<td width="89" align="center" class="smalltblheading">UPS</td>
	<td width="102" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="67" align="center" class="smalltblheading">QC Status</td>
	<td width="90" align="center" class="smalltblheading">DoT</td>
	<td width="90" align="center" class="smalltblheading">DoV</td>
	<td width="80" align="center" class="smalltblheading">Net Weight</td>
	<td width="88" align="center" class="smalltblheading">Gross Weight</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php 
$sno=1;
$sq6=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid' and dpss_barcode='$barcode'") or die(mysqli_error($link));
if($to6=mysqli_num_rows($sq6) > 0)
{
while($ro6=mysqli_fetch_array($sq6))
{
	$lot6=$ro6['dpss_lotno']; 
	$crps2=$ro6['dpss_crop']; 
	$vers2=$ro6['dpss_variety']; 
	$upss2=$ro6['dpss_ups']; 
	$dovs2=$ro6['dpss_dov']; 
	$qcss2=$ro6['dpss_qc']; 
	$dots2=$ro6['dpss_dot']; 
	$grwts2=$ro6['dpss_grosswt']; 
	$nqty6=$ro6['dpss_qty'];
	
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cps2=$row_dept5['cropname'];
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$vts2=$row_dept4['popularname'];
		
	$tdate=$dovs2;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dov2=$tday."-".$tmonth."-".$tyear;
	
	$tdate=$dots2;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dot2=$tday."-".$tmonth."-".$tyear;
	
	
?>
<tr class="Dark" height="30">
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cps2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vts2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upss2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lot6?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcss2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
$sno++;
}
}
if($brfg!=0)
{
	if($brfg==1)
	$msgs="Barcode $b cannot be Dispatched. Reason: Barcode not present in System";
	if($brfg==2)
	$msgs="Barcode $b cannot be Dispatched. Reason: Barcode already Dispatched";
	if($brfg==3)
	$msgs="Barcode $b cannot be Dispatched. Reason: Barcode already Loaded in current OR other Operator's Transaction";
	if($brfg==4)
	$msgs="Barcode $b cannot be Dispatched. Reason: Variety not matching with Selected Line Item in Consolidated Pending Orders";
	if($brfg==5)
	$msgs="Barcode $b cannot be Dispatched. Reason: UPS not matching with Selected Line Item in Consolidated Pending Orders";
	if($brfg==6)
	$msgs="Barcode $b cannot be Dispatched. Reason: This Lot's current QC/GOT Status is FAIL";
	if($brfg==7)
	$msgs="Barcode $b cannot be Dispatched. Reason: This Lot's current QC/GOT Status is UT and Soft Release is not activated";
	if($brfg==8)
	$msgs="Barcode $b cannot be Dispatched. Reason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date";
	if($brfg==9)
	$msgs="Barcode $b cannot be Dispatched. Reason: This Barcode is already Unpackaged";
	if($brfg==10)
	$msgs="Barcode $b cannot be Dispatched. Reason: Lot is under Reserve Status";
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading" colspan="11"><font color="#FF0000"><?php echo $msgs;?></td>
</tr>
<?php
}
?>
</table>
<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $sid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="bform();" />&nbsp;&nbsp;</td>
</tr>
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Loading</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Loading (Unloading) </tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />&nbsp;<font color="#FF0000">*  Deleted Barcode will be stored back to its original SLOC Bin</font></td></tr>

</table><br />
</div>