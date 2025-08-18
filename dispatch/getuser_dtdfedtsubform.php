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

	$tid=$maintrid;
	
	$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dtdf_id'];

	$tdate=$row_tbl['dtdf_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dtdf_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$subtid=$subtrid;
	$subsubtid=0;  
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
	<td colspan="6" align="center" class="tblheading">Dispatch TDF</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dtdf_tcode']."/".$row_tbl['dtdf_yearcode']."/".$row_tbl['dtdf_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?><input name="dcdate" id="dcdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;</td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_dcno'];?><input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['dtdf_dcno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dtdf_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dtdf_partytype']; ?>"  />
</td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dtdf_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dtdf_state']; ?>" />
</td>

<?php
	$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dtdf_state']."' and productionlocationid='".$row_tbl['dtdf_location']."' order by productionlocation")or die(mysqli_error($link));
	$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dtdf_location']; ?>" />
</td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dtdf_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dtdf_location'];?>" />
</td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >-->
<?php
$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
	if($tt=mysqli_num_rows($quer33)>0)
	{
		$row33=mysqli_fetch_array($quer33);
		$name==$row33['business_name'];
		$address=$row33['address'];
		$city=$row33['city']; 
		$state=$row33['state'];
		$pincode=$row33['pin'];
	}
	else
	{
		$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
		$tt=mysqli_num_rows($sql_month2);
		$row_month2=mysqli_fetch_array($sql_month2);
		$name=$row_month2['orderm_partyname'];
		$address=$row_month2['orderm_partyaddress'];
		$city=$row_month2['orderm_partycity']; 
		$state=$row_month2['orderm_partystate'];
		$pincode=$row_month2['orderm_partypin'];
	}
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dtdf_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $name;?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dtdf_party'];?>"  />
<!--<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month24)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['dtdf_party']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
	</tr>
<?php
	
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
</div>
<div id="orderdetails">
<?php
$quer330=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
if($tt=mysqli_num_rows($quer330)>0)
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
else
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
//$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid
$ver="";
if($arrivalid!="")
{
	$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
	$totver2=mysqli_num_rows($sql_ver2);
	while($row_ver2=mysqli_fetch_array($sql_ver2))
	{
		if($ver!="")
			$ver=$ver.",".$row_ver2['order_sub_variety'];
		else
			$ver=$row_ver2['order_sub_variety'];
	}
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS Type</td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoP</td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">No. of Orders</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoB Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Select</td>
</tr>
<?php 

/*$arid=explode(",",$arrivalid);
foreach($arid as atrid)
{
if($atrid<>"")
{*/

$sn=1; $sn24=0; $sid=0; $dflg=0;
//if($arrivalid!="")
{
/*$sql_crp=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_crp);
while($row_crp=mysqli_fetch_array($sql_crp))
{
$sql_ver=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and orderm_id in($arrivalid) order by order_sub_variety") or die(mysqli_error($link));
$totver=mysqli_num_rows($sql_ver);
while($row_ver=mysqli_fetch_array($sql_ver))
{*/
//$sqlver=mysqli_query($link,"select distinct order_sub_ups_type from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and order_sub_variety='".$row_ver['order_sub_variety']."' and orderm_id in($arrivalid) order by order_sub_ups_type") or die(mysqli_error($link));
//$totv=mysqli_num_rows($sqlver);
//while($rowver=mysqli_fetch_array($sqlver))
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{
$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}

//$sqlmon=mysqli_query($link,"select * from tbl_order_sub where order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
//$totz=mysqli_num_rows($sqlmon);
//while($rowtblsub=mysqli_fetch_array($sqlmon))
//{
	$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid)  and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
	$totvs=mysqli_num_rows($sqlsloc);
	while($rowsloc=mysqli_fetch_array($sqlsloc))
	{
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
	$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_id")or die("Error:".mysqli_error($link));
	$totz=mysqli_num_rows($sqlmon);
	while($rowtblsub=mysqli_fetch_array($sqlmon))
	{

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
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
		if($lotno!="")
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
		}
		//echo $rowtblsub['order_sub_id'];

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";


	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($qt > 0 )	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		
$selups=$rowsloc['order_sub_sub_ups'];
$dq=explode(" ",$selups);
//if($upstyp=="ST")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_id=$subtid and dtdfs_flg!=1 and dtdf_id='$tid' and dtdfs_ups='".$selups."'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt; $nolots=0;

if($to=mysqli_num_rows($sq) > 0)
{
$ro=mysqli_fetch_array($sq);
$nups=$ro['dtdfs_ups']; 
$nnob=$ro['dtdfs_nob']; 
$nqty=$ro['dtdfs_qty']; 
$nbqty=$ro['dtdfs_bqty'];
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['dtdfs_id'];
$sn24=$sn;
$dbsflg=$ro['dtdfs_flg'];

$sq23=mysqli_query($link,"Select distinct dbss_lotno from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$tid'") or die(mysqli_error($link));
$totre=mysqli_num_rows($sq23);
while($row23=mysqli_fetch_array($sq23))
{
	$nolots++;
}
$stageval=$ro['dtdfs_stage'];
$selups=$ro['dtdfs_ups'];

?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $ordno ?>"><?php echo $nord;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nups;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $nups;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nolots;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($nqty==0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $selups?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $selups?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
}
}
}
}
}
}
}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" /><input type="hidden" name="selcrp" value="" /><input type="hidden" name="selver" value="" /><input type="hidden" name="selord" value="" /><input type="hidden" name="selups" value="" /><input type="hidden" name="selups" value="" />
</table>
</div>

<?php
$sql_dtdfsub=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_id='$subtid'") or die (mysqli_error($link));
$row_dtdfsub=mysqli_fetch_array($sql_dtdfsub);
$stageval=$row_dtdfsub['dtdfs_stage'];
$selups=$row_dtdfsub['dtdfs_ups'];
?>	

<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="50%"  align="right"  valign="middle" class="tblheading">Select Stage&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" class="tbltext" name="sstage" id="tmt" value="<?php echo $stageval;?>" width="10" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
</table>
<table id="lottbl" align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
$b=$crpnm;
$c=$vernm;	
if($stageval!="Pack")
{
?>
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="112" align="center" class="smalltblheading">Crop</td>
	<td width="165" align="center" class="smalltblheading">Variety</td>
	<td width="105" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="65" align="center" class="smalltblheading">UPS</td>-->
	<td width="60" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="83" align="center" class="smalltblheading">DoT</td>
	<td width="187" align="center" class="smalltblheading">SLOC</td>
	<td width="66" align="center" class="smalltblheading">Select</td>
</tr>
<?php 
$sno1=1;
//if($dflg==0)
{
$sql_month=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='$stageval'")or die("Error:".mysqli_error($link));
while($row_month=mysqli_fetch_array($sql_month))
{
$flg=0;
$lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; 

	$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='$stageval' and lotldg_lotno='".$row_month['lotldg_lotno']."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='$stageval' and lotldg_lotno='".$row_month['lotldg_lotno']."' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$rowmonth3['lotldg_balbags']; 
			$qty=$rowmonth3['lotldg_balqty'];
			
			$qc=$rowmonth3['lotldg_qc'];
			
			$trdate=$rowmonth3['lotldg_qctestdate'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$rowmonth3['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$rowmonth3['lotldg_subbinid']."' and binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				
				
				$diq=explode(".",$nob);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
				$nob=$difq;
				$diq=explode(".",$qty);
				if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
				$qty=$difq1;
				
				$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
				
				if($sloc=="")
				$sloc=$slocs;
				else
				$sloc=$sloc."<br />".$slocs;
				
				$totqty=$totqty+$qty; 
				$totnob=$totnob+$nob;
			}
			
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
			/*if($rowmonth3['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;*/
			if($zz[0]=="GOT-NR")
			{
				if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				if(($rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="OK" && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
			
			if($vflg > 0) $flg++;
		}
	}
	
	if($totqty==0)$flg++;
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crpnm."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$vernm."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$lotno=$row_month['lotldg_lotno'];
//echo $flg;	
$subtid=$sid;
$llttn=""; $xcltn=array();
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$subtid'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	if($llttn!="")
	$llttn=$llttn.",".$roo['dbss_lotno'];
	else
	$llttn=$roo['dbss_lotno'];
}
if($llttn!="")
{
	$xcltn=explode(",",$llttn);
}

$aldnob=0; $aldqty=0;
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='$tid' and dbss_lotno='$lotno' and dtdfs_id!='$subtid'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	$aldnob=$aldnob+$roo['dbss_nob'];
	$aldqty=$aldqty+$roo['dbss_qty'];
}
$totnob=$totnob-$aldnob;
$totqty=$totqty-$aldqty;
if($totqty>0 && $totnob<=0)	$totnob=1;
if($totqty<=0 && $totnob>0)	$totnob=0;
//if(!in_array($lotno,$xcltn))
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php if(!in_array($lotno,$xcltn)){?><input type="radio" name="lotsel" value="<?php echo $lotno?>" onchange="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn24;?>,'<?php echo $variety?>','<?php echo $stageval?>')" /><?php } else { ?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrec('<?php echo $lotno;?>',<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $variety?>')" /><?php } ?></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
}
}
else
{
?>
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="112" align="center" class="smalltblheading">Crop</td>
	<td width="140" align="center" class="smalltblheading">Variety</td>
	<td width="125" align="center" class="smalltblheading">Lot No.</td>
	<td width="95" align="center" class="smalltblheading">UPS</td>
	<td width="60" align="center" class="smalltblheading">NoP</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="45" align="center" class="smalltblheading">QC at Packing</td>
	<td width="83" align="center" class="smalltblheading">DoT</td>
	<td width="167" align="center" class="smalltblheading">SLOC</td>
	<td width="56" align="center" class="smalltblheading">Select</td>
</tr>
<?php
$b=$crpnm;
$c=$vernm;
$dq=explode(" ",$selups);
//if($dq[1]=="Gms")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
$sno1=1;
$sql_month=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='$b' and lotldg_variety='$c' and packtype='$selups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 order by packtype ")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sql_month);
while($row_month=mysqli_fetch_array($sql_month))
{
$flg=0;
$lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; 

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='$b' and lotldg_variety='$c' and lotno='".$row_month['lotno']."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='$b' and lotldg_variety='$c' and lotno='".$row_month['lotno']."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$rowmonth2[0]."' and balqty > 0")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$rowmonth3['balnomp']; 
			$qty=$rowmonth3['balqty'];
			$lotallqty=$rowmonth3['lotldg_alqtys'];
			if($lotallqty<=0)$lotallqty=0;
			
			$lotallnmp=$rowmonth3['lotldg_alnomps'];
			if($lotallnmp<=0)$lotallnmp=0;
			
			$qc=$rowmonth3['lotldg_qc'];
			$lotups=$rowmonth3['packtype'];
			$dot=$rowmonth3['lotldg_qctestdate'];
			$ups=$lotups;
			
			$lotno=$rowmonth3['lotno'];
			
			$zz=str_split($lotno);
			$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
			$qcstsap="DoT";	$srfl=0; $qcdot2=""; $trdate23=""; $trdate24="";
				
			$sql_pnp2=mysqli_query($link,"Select max(pnpslipsub_id) from tbl_pnpslipsub where plantcode='".$plantcode."' and pnpslipsub_plotno='".$lotn."' order by pnpslipsub_id desc") or die(mysqli_error($link));
			$row_pnp2=mysqli_fetch_array($sql_pnp2);
							
			$sql_pnp=mysqli_query($link,"Select pnpslipsub_qcdot from tbl_pnpslipsub where plantcode='".$plantcode."' and pnpslipsub_plotno='".$lotn."' and pnpslipsub_id='".$row_pnp2[0]."' order by pnpslipsub_qcdot desc") or die(mysqli_error($link));
			$row_pnp=mysqli_fetch_array($sql_pnp);
			if($tot_pnp=mysqli_num_rows($sql_pnp)>0)
			{
				$trdate23=$row_pnp['pnpslipsub_qcdot'];
				$qcstsap=$row_pnp['pnpslipsub_qcdttype'];
				if($trdate23!="0000-00-00" && $trdate23!="--" && $trdate23!="- -" && $trdate23!="")
				{
					$qcdot2=$row_pnp['pnpslipsub_qcdot'];
					//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
								
			$sqlpnp2=mysqli_query($link,"Select max(rv_id) from tbl_revalidate where plantcode='".$plantcode."' and rv_newlot='".$lotn."' order by rv_id desc ") or die(mysqli_error($link));
			$rowpnp2=mysqli_fetch_array($sqlpnp2);
								
			$sqlpnp=mysqli_query($link,"Select rv_dot from tbl_revalidate where plantcode='".$plantcode."' and rv_newlot='".$lotn."' and rv_id='".$rowpnp2[0]."' order by rv_dot desc ") or die(mysqli_error($link));
			$rowpnp=mysqli_fetch_array($sqlpnp);
			if($totpnp=mysqli_num_rows($sqlpnp)>0)
			{
				$trdate24=$rowpnp['rv_dot'];
				if($trdate24!="0000-00-00" && $trdate24!="--" && $trdate24!="- -" && $trdate24!="")
				{
					if($trdate23!="" && ($trdate24>$trdate23))
					{ 
						$qcdot2=$trdate24;
						//$qcdot2=$trdate24[2]."-".$trdate24[1]."-".$trdate24[0];
					}
				}
			}
			if($qcdot2=="")
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
				$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
				if($tot_softr_sub > 0)
				{
					$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
					//echo $row_softr_sub[0];
					$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
					$tot_softr=mysqli_num_rows($sql_softr);
					$row_softr=mysqli_fetch_array($sql_softr);
					if($tot_softr > 0)
					{
						$qcdot2=$row_softr['softr_date'];
						//$trdate=explode("-",$trdate);
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
					}
				}
				if($qcdot2=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
					$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
					if($tot_softr_sub2 > 0)
					{
						$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
						//echo $row_softr_sub2[0];
						$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
						$tot_softr2=mysqli_num_rows($sql_softr2);
						$row_softr2=mysqli_fetch_array($sql_softr2);
						if($tot_softr2 > 0)
						{
							$qcdot2=$row_softr2['softr_date'];
							//$trdate=explode("-",$trdate);
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
						}
					}
				}
			}
									
			if($qcdot2!="")	{$dot=$qcdot2;  $qcstsap='DoSF';}
								
			/*$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
			$tot_pnp=mysqli_num_rows($sql_pnp);
			if($tot_pnp > 0)
			{	
				$row_pnp=mysqli_fetch_array($sql_pnp);
				$qcstsap=$row_pnp['pnpslipsub_qcdttype'];
				if($row_pnp['pnpslipsub_qcdttype']=="DoSF" || $row_pnp['pnpslipsub_qcdttype']=="DosF" || $row_pnp['pnpslipsub_qcdttype']=="DOSF")
				$srfl=1;
			}
			//echo $lotn."  ".$qcstsap." ";
									
			if($srfl==1)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
				$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
				if($tot_softr_sub > 0)
				{
					$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
					$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
					$tot_softr=mysqli_num_rows($sql_softr);
					$row_softr=mysqli_fetch_array($sql_softr);
					if($tot_softr > 0)
					{
						$qcdot2=$row_softr['softr_date'];
					}
				}
				//echo $qcdot2;
				if($qcdot2=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
					$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
					if($tot_softr_sub2 > 0)
					{
						$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
						$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
						$tot_softr2=mysqli_num_rows($sql_softr2);
						$row_softr2=mysqli_fetch_array($sql_softr2);
						if($tot_softr2 > 0)
						{
							$qcdot2=$row_softr2['softr_date'];
						}
					}
				}
			}
			if($srfl==1 && $qcdot2!=""){$dot=$qcdot2; $qcstsap='DoSF';}*/
			
			$trdate=$dot;
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$tdate=$rowmonth3['lotldg_valupto'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dov=$tday."-".$tmonth."-".$tyear;
			
			$dt=date("Y-m-d");
			$diff = abs(strtotime($rowmonth3['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
			if($days<30)$flg++;
			
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$rowmonth3['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$rowmonth3['subbinid']."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				$diq=explode(".",$nob);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
				$nob=$difq;
				if($nob<0)$nob=0;
				
				$diq=explode(".",$qty);
				if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
				$qty=$difq1;
				
				$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
				
				if($sloc=="")
					$sloc=$slocs;
				else
					$sloc=$sloc."<br />".$slocs;
				
				$totqty=$totqty+$qty; 
				$totnob=$totnob+$nob;
			}
			
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
			/*if($rowmonth3['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;*/
			if($zz[0]=="GOT-NR")
			{
				/*if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}*/
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				/*if(($rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="OK" && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}*/
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
			if($vflg > 0) $flg++;
			
			
			
			$nop1=0; $nop2=0; $b1=0; $b2=0;
			$ups=$rowmonth3['packtype'];
			$wtinmp=$rowmonth3['wtinmp'];
			$upspacktype=$rowmonth3['packtype'];
			$packtp2=explode(" ",$upspacktype);
			$packtyp=$packtp2[0]; 
			if($packtp2[1]=="Gms")
			{ 
				$ptp2=(1000/$packtp2[0]);
				$ptp1=($packtp2[0]/1000);
			}
			else
			{
				if($packtp2[0]<1)
				{
					$ptp2=(1000/$packtp2[0])/1000;
					$ptp1=($packtp2[0]/1000)*1000;
				}
				else
				{
					$ptp2=$packtp2[0];
					$ptp1=$packtp2[0];
				}
			}
			$nmp=$rowmonth3['balnomp'];
			if($nmp<0)$nmp=0;
			$penqty=(($rowmonth3['balqty'])-($wtinmp*$nmp));
			//echo $ptp2;
			if($penqty > 0)
			{
				if($packtp2[1]=="Gms")
				{
					$nop1=($ptp2*$penqty);
				}
				else
				{
					if($packtp2[0]<1)
					$nop1=($penqty*$ptp2);
					else
					$nop1=($penqty/$ptp2);
				}
			}
			if($packtp2[1]=="Gms")
			{
				$nop2=($ptp2*$rowmonth3['balqty']);
			}
			else
			{
				if($packtp2[0]<1)
				$nop2=($rowmonth3['balqty']*$ptp2);
				else
				$nop2=($rowmonth3['balqty']/$ptp2);
			}
			$nop2;
			
			$bnmp=$rowmonth3['balnomp'];
			$bqty1=$rowmonth3['balqty'];
			if($packtp2[1]=="Gms")
			{$bnob=$bqty1*$ptp2;}
			else
			{
				if($packtp2[0]<1)
					$bnob=$bqty1*$ptp2;
				else
					$bnob=$bqty1/$ptp2;	
			}
	
		}
		
	}
	
	//echo $lotn."  ";
	$bqty=$totqty;
	//echo "  ";
	
	//$lotno=$lotn;
	$zz=str_split($lotno);
	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
	$totextpouches=0; $totextqtys=0;
	$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKSMC' and mpmain_lotno='".$lotno."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mps=mysqli_num_rows($sql_mps);
	if($tot_mps > 0)
	{
		while($row_mps=mysqli_fetch_array($sql_mps))
		{
			$crparr=$row_mps['mpmain_crop'];
			$verarr=$row_mps['mpmain_variety'];
			$lotarr=explode(",", $row_mps['mpmain_lotno']);
			$upsarr=$row_mps['mpmain_upssize'];
			$noparr=explode(",", $row_mps['mpmain_mptnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nops=$nops+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
				}
			}
			
		}
	}
	
	$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKLMC' and mpmain_variety='".$c."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpl=mysqli_num_rows($sql_mpl);
	if($tot_mpl > 0)
	{
		while($row_mpl=mysqli_fetch_array($sql_mpl))
		{
			$crparr=$row_mpl['mpmain_crop'];
			$verarr=$row_mpl['mpmain_variety'];
			$lotarr=explode(",", $row_mpl['mpmain_lotno']);
			$upsarr=$row_mpl['mpmain_upssize'];
			$noparr=explode(",", $row_mpl['mpmain_lotnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nopl=$nopl+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
				}
			}
			
		}
	}
	
	$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKMMC' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpm=mysqli_num_rows($sql_mpm);
	if($tot_mpm > 0)
	{
		while($row_mpm=mysqli_fetch_array($sql_mpm))
		{
			$crparr=explode(",", $row_mpm['mpmain_crop']);
			$verarr=explode(",", $row_mpm['mpmain_variety']);
			$lotarr=explode(",", $row_mpm['mpmain_lotno']);
			$upsarr=explode(",", $row_mpm['mpmain_upssize']);
			$noparr=explode(",", $row_mpm['mpmain_lotnop']);
			
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr[$i])
				{
					$nopm=$nopm+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtym=$qtym+($ptp*$noparr[$i]); $nompm=$nompm+$ct; 
				}
			}
			
		}
	}
	$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKNMC' and mpmain_lotno='".$lotno."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpns=mysqli_num_rows($sql_mpns);
	if($tot_mpns > 0)
	{
		while($row_mpns=mysqli_fetch_array($sql_mpns))
		{
			$crparr=$row_mpns['mpmain_crop'];
			$verarr=$row_mpns['mpmain_variety'];
			$lotarr=explode(",", $row_mpns['mpmain_lotno']);
			$upsarr=$row_mpns['mpmain_upssize'];
			$noparr=explode(",", $row_mpns['mpmain_lotnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nopns=$nopns+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct; 
				}
			}
			
		}
	}
	
	$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKNLC' and mpmain_variety='".$c."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpnl=mysqli_num_rows($sql_mpnl);
	if($tot_mpnl > 0)
	{
		while($row_mpnl=mysqli_fetch_array($sql_mpnl))
		{
			$crparr=$row_mpnl['mpmain_crop'];
			$verarr=$row_mpnl['mpmain_variety'];
			$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
			$upsarr=$row_mpnl['mpmain_upssize'];
			$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nopnl=$nopnl+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$nompnl+$ct; 
				}
			}
			
		}
	}
	
	$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
	$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 
	$bqty=floatval($bqty);
	$totextqtys=floatval($totextqtys);	
	// $avlqty=($bqty1)-($qtyl+$qtynl)-($lotallqty);
	//echo $lotno."  =  ".$qtys."  -  ".$nomps." -> ".$totextqtys."  -  ".$bqty1."  =  ".$avlqty."<br/>";
	$totnomp1=$nomps+$nompl+$nompm+$nompns+$nompnl;
	$totnomp=$nomps+$nompm+$nompns;
	
	//$totnomp1=$nomps+$nompns;
	$qbnmp=$nmp-$totnomp1;
	//echo $lotno." - ";
	$zqt=$qbnmp*$wtinmp;
	$qbqty=$bqty-$zqt;
	//echo "<br/>";
	$avlqty=($bqty)-($totextqtys)-($lotallqty);
	
	if($bnmp>0)
	$bnob=$bnob-$totextpouches;
	
	$nop1=$bnob;
	//$avlqty=$nop1*$ptp1;
	$totnob=$nop1;
	//$totnob=$nmp-$lotallnmp;
	$totqty=$avlqty;
	
	
	
	
	
	if($totnob<0)$totnob=0;
	if($totqty<=0)$totnob=0;
	if($totqty<=0)$flg++;
	if($totnob==0)$flg++;
	
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='".$c."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_var['cropname']."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	//$lotno=$lotn;
	//echo $lotno."  -  ".$nop1."<br>";
	$llttn=""; $xcltn=array();
	$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$subtid'") or die(mysqli_error($link));
	while($roo=mysqli_fetch_array($sqq))
	{
		if($llttn!="")
		$llttn=$llttn.",".$roo['dbss_lotno'];
		else
		$llttn=$roo['dbss_lotno'];
	}
	if($llttn!="")
	{
		$xcltn=explode(",",$llttn);
	}
$aldnob=0; $aldqty=0;
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='$tid' and dbss_lotno='$lotno' and dtdfs_id!='$subtid'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	$aldnob=$aldnob+$roo['dbss_nob'];
	$aldqty=$aldqty+$roo['dbss_qty'];
}
$totnob=$totnob-$aldnob;
$totqty=$totqty-$aldqty;	
if($totqty>0 && $totnob<=0)	$totnob=1;
if($totqty<=0 && $totnob>0)	$totnob=0;
//if(!in_array($lotno,$xcltn))
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcstsap;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php if(!in_array($lotno,$xcltn)){?><input type="radio" name="lotsel" value="<?php echo $lotno?>" onchange="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn24;?>,'<?php echo $variety?>','<?php echo $stageval?>')" /><?php } else { ?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrec('<?php echo $lotno;?>',<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $variety?>','<?php echo $stageval?>')" /><?php } ?></td>

	<!--<td align="center"  valign="middle" class="tbltext"><input type="radio" name="lotsel" value="<?php echo $lotno?>" onclick="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $a;?>,'<?php echo $variety?>','<?php echo $stageval?>')"  /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
}
?>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" /><input type="hidden" name="ltchksel" value="" />
</table>
<br />

<div id="postingsubsubtable" style="display:block">
<table id="lotdt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<table id="lotsldt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $sid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="bform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
</div>