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


$sql_tbl=mysqli_query($link,"select * from tbl_dbulk where plantcode='".$plantcode."' and  dbulk_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['dbulk_id'];

	$tdate=$row_tbl['dbulk_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dbulk_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
$subtid=$subtrid;
$subsubtid=0;
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Bulk</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dbulk_tcode']."/".$row_tbl['dbulk_yearcode']."/".$row_tbl['dbulk_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?><input name="dcdate" id="dcdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;</td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dbulk_dcno'];?><input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['dbulk_dcno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>-->

<?php
//$quer3=mysqli_query($link,"SELECT * FROM tblclassification  where (main='Channel' or main='Stock Transfer') order by classification"); 
?>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dbulk_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dbulk_partytype']; ?>"  />
<!--<option value="" selected>--Select--</option>
	<?php /*while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['classification']==$row_tbl['dbulk_partytype']){ echo "Selected";} ?> value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php }*/ ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dbulk_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dbulk_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dbulk_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dbulk_state']; ?>" />
</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dbulk_state']."' and productionlocationid='".$row_tbl['dbulk_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dbulk_location']; ?>" />
<!--<option value="" selected>--Select--</option>
<?php /*while($noticia3 = mysqli_fetch_array($sql_month3)) { ?>
		<option <?php if($row_tbl['dbulk_location']==$noticia3['productionlocationid']){ echo "Selected";} ?> value="<?php echo $noticia3['productionlocationid'];?>" />   
		<?php echo $noticia3['productionlocation'];?>
		<?php }*/ ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dbulk_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dbulk_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dbulk_location'];?>" />
<!--<option value="">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia['country']==$row_tbl['dbulk_location']){ echo "Selected";} ?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dbulk_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dbulk_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dbulk_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dbulk_party'];?>"  />
<!--<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month24)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['dbulk_party']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dbulk_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
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

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='".$row_tbl['dbulk_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
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
$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
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
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $nord=0; $ordno="";
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_ups_type='No' and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
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

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
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
}
if($qt > 0 && $upstyp=="NST")	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		

$sq=mysqli_query($link,"Select * from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulks_crop='$cro' and dbulks_variety='$variet' and dbulks_id=$subtid and dbulks_flg!=1 and dbulk_id='$tid'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt; $nolots=0;

if($to=mysqli_num_rows($sq) > 0)
{
$ro=mysqli_fetch_array($sq);
$nups=$ro['dbulks_ups']; 
$nnob=$ro['dbulks_nob']; 
$nqty=$ro['dbulks_qty']; 
$nbqty=$ro['dbulks_bqty'];
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['dbulks_id'];
$sn24=$sn;
$dbsflg=$ro['dbulks_flg'];

$sq23=mysqli_query($link,"Select distinct dbss_lotno from tbl_dbulksub_sub where plantcode='".$plantcode."' and  dbulks_id='$sid' and dbulk_id='$tid'") or die(mysqli_error($link));
$totre=mysqli_num_rows($sq23);
while($row23=mysqli_fetch_array($sq23))
{
	$nolots++;
}



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
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($nbqty>0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
}
}
}
}
}
//}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" />
</table>
</div>	
<br />

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
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
$sql_month=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='Condition'")or die("Error:".mysqli_error($link));
while($row_month=mysqli_fetch_array($sql_month))
{
$flg=0;
$lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; 

	$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='Condition' and lotldg_lotno='".$row_month['lotldg_lotno']."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='$vernm' and lotldg_sstage='Condition' and lotldg_lotno='".$row_month['lotldg_lotno']."' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
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
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$rowmonth3['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$rowmonth3['lotldg_subbinid']."' and binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
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
			if($row_issuetbl['lotldg_got']=="BL")
			$vflg++;
			if($row_issuetbl['lotldg_qc']=="BL")
			$vflg++;
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
$sqq=mysqli_query($link,"Select * from tbl_dbulksub_sub where plantcode='".$plantcode."' and  dbulks_id='$subtid'") or die(mysqli_error($link));
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
	<td align="center"  valign="middle" class="tbltext"><?php if(!in_array($lotno,$xcltn)){?><input type="radio" name="lotsel" value="<?php echo $lotno?>" onchange="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn24;?>,'<?php echo $variety?>')" /><?php } else { ?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrec('<?php echo $lotno;?>',<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $variety?>')" /><?php } ?></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
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
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $sid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="bform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
</div>