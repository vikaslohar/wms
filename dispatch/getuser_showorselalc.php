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
	$orn = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	$vrids = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$upids = $_GET['g'];	 
}
if(isset($_GET['l']))
{
	$qtt = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	$tid = $_GET['m'];	 
}

$sqlcode="SELECT  dalloc_id FROM tbl_dalloc where plantcode='".$plantcode."' and  dalloc_dflg!=1 and dalloc_party='".$a."' ORDER BY dalloc_id DESC";
$rescode=mysqli_query($link,$sqlcode)or die(mysqli_error($link));
$t=mysqli_num_rows($rescode);
$rowcode=mysqli_fetch_array($rescode);
$dalcid=$rowcode['dalloc_id'];

$arrivalid=""; 
if($a!="")
{
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and (order_trtype='Order Sales' OR order_trtype='Order Stock') and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
	$t=mysqli_num_rows($sqlmonth);
	
	while($rowtbl=mysqli_fetch_array($sqlmonth))
	{
			if($arrivalid!="")
			$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
			else
			$arrivalid=$rowtbl['orderm_id'];
	}
}


//echo $arrivalid;
$ver=""; $cpr="";
if($arrivalid!="")
{
$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_crop") or die(mysqli_error($link));
$totver1=mysqli_num_rows($sql_ver1);
while($row_ver1=mysqli_fetch_array($sql_ver1))
{
	if($cpr!="")
		$cpr=$cpr.",".$row_ver1['order_sub_crop'];
	else
		$cpr=$row_ver1['order_sub_crop'];
}
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
$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_crop='$atrid' and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
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
	<td width="150" align="center"  valign="middle" class="smalltblheading">PSDN Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Order No</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Allocated</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoMP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcodes</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Dispatched</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Balance</td>
	<!--<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>-->
</tr>
<?php 
$ordnos=""; $veridno=""; $upsnos=""; $totbarcs=""; $up123="";
/*$arid=explode(",",$arrivalid);
foreach($arid as atrid)
{
if($atrid<>"")
{*/

$sn=1;
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
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety")or die("Error:".mysqli_error($link));
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
$up=""; $up1=""; $qt=0; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=0; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
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
		if($dq[1]==000){$qt123=$dq[0];}else{$qt123=$dq[0].".".$dq[1];}
		if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
		$up13=$qt1." ".$zz[1];
		if($up13==$upids)$up123=$qt123." ".$zz[1];
	}
	else
	{
		if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
		if($dq[1]==000){$qt123=$dq[0].".".$dq[1];}else{$qt123=$dq[0].".".$dq[1];}
		$up123=$upids;
	}
	$up1=$qt1." ".$zz[1];
	
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
if($qt > 0 && $vrids==$variety && $upids==$up1)	 
{
if($upstyp=="ST")$up1234=$up1;
else $up1234=$up123;
$sql_lot2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dalloc_id='$dalcid' and dallocs_ups='$up1' and dallocs_variety='$variet' and dallocs_upstype='$upstyp' and dallocs_allocqty>0 order by dallocs_variety ASC") or die(mysqli_error($link));
$tot_lot2=mysqli_num_rows($sql_lot2);
while($row_lot2=mysqli_fetch_array($sql_lot2))
//$row_lot2=mysqli_fetch_array($sql_lot2);
{
$ealqt=$row_lot2['dallocs_allocqty'];
$newvariet=$variet;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="20" class="smalltbltext" maxlength="30" name="txtpvariety<?php echo $sn;?>" id="txtpvariety<?php echo $sn;?>" value="<?php echo $newvariet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $up1?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up1;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext" title="<?php echo $ordno ?>"><?php echo $ordno;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $ealqt;?><input type="hidden" name="ealqty<?php echo $sn;?>" id="ealqty_<?php echo $sn;?>" value="<?php echo $ealqt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $totrec;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $totrec;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php if($barcds!=""){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $barcds;?>')">Details</a><?php } ?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $barcds;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	
	<!--<td width="275" align="center"  valign="middle" class="smalltbltext"><input type="radio" checked="checked" name="selsh" id="selsh_<?php echo $sn;?>" value="<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $variety?>','<?php echo $up1 ?>','<?php echo $qt?>','<?php echo $ordno?>');" /></td>-->
</tr>
<input type="hidden" name="mchksel" value="<?php echo $sn?>" /><input type="hidden" name="txtornos" value="<?php echo $ordno;?>" /><input type="hidden" name="txtveridno" value="<?php echo $vt;?>" /><input type="hidden" name="txtupsnos" value="<?php echo $up1;?>" /><input type="hidden" name="txteqty" value="<?php echo $qt;?>" />
<?php
$sn++;
}
//}
}
}
}
}
}
}
/*if($ordnos!="")
{
$tid24=explode(",",$ordnos); 
$tid24=array_keys(array_flip($tid24));
$ordnos=implode(",",$tid24);
}
if($veridno!="")
{
$tid24=explode(",",$veridno); 
$tid24=array_keys(array_flip($tid24));
$veridno=implode(",",$tid24);
}
if($upsnos!="")
{
$tid24=explode(",",$upsnos); 
$tid24=array_keys(array_flip($tid24));
$upsnos=implode(",",$tid24);
}*/
?>
<input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" />
</table><br />
<div id="showorsel">
<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
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
$up123=$up1234;
$orn1=$orn.","; $ctn=0; $sid=0;
$up=""; $up1=""; $qt=0; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=0; $nord=0; $ordno=""; $ups24="";
$ordx=explode(",",$orn1);
$ordnx="";
foreach($ordx as $odx)
{
if($odx<>"")
{
$ctn++;
$od="'$odx'";
if($ordnx!="")
$ordnx=$ordnx.",".$od;
else
$ordnx=$od;
}
}
$arrivalid=""; 
if($a!="")
{
	if($cnt>1)
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_porderno in($ordnx) and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
	else if($ctn==1)
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_porderno=$ordnx and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
	else
	$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
	$t=mysqli_num_rows($sqlmonth);
	
	
	while($rowtbl=mysqli_fetch_array($sqlmonth))
	{
			if($arrivalid!="")
			$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
			else
			$arrivalid=$rowtbl['orderm_id'];
	}
}
$ar=explode(",",$arrivalid);
$acr=count($ar);
$orsid="";
if($acr>1)
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$vrids."' and orderm_id in($arrivalid) order by order_sub_variety")or die("Error:".mysqli_error($link));
else
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$vrids."' and orderm_id='$arrivalid' order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}
//echo $orsid;
//$ar1=explode(",",$orsid);
//count $acr1=count($ar1);
//if($acr1>1)
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_sub_ups='".$up123."' order by order_sub_sub_ups") or die(mysqli_error($link));
//else
//$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where orderm_id in($arrivalid) and order_sub_id='$orsid' and order_sub_sub_ups='".$up123."' order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_sub_ups='".$up123."' order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$vrids."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

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
		
	$crop=$rowtblsub['order_sub_crop'];
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cro=$row_dept5['cropname'];
	$variety=$rowtblsub['order_sub_variety'];	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$variet=$row_dept4['popularname'];
		
		
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$up123."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
		$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
		$dq=explode(".",$zz[0]);
		$xfd=count($dq);
		if($upstyp=="NST")
		{
			//$dq[1]="000";
			//if($dq[1]==000){$qt12=$dq[0];}else{$qt12=$dq[0].".".$dq[1];}
			if($xfd>1)$qt12=$dq[0].".".$dq[1]; else $qt12=$dq[0].".000";
		}
		else
		{
			if($dq[1]==000){$qt12=$dq[0].".".$dq[1];}else{$qt12=$dq[0].".".$dq[1];}
		}
		$up1=$qt12." ".$zz[1];
		$ups24=$up1;
		/*if($up!="")
			$up=$up."<br/>".$up1;
		else*/
			$up=$up1;
	
		$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
		if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
		
		$qt=$qt+$qt1;
		/*if($sstatus!="")
		{
			$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
		}
		else
		{*/
			$sstatus=$sstatus+$row_sloc['order_sub_sub_nop'];
		//}
	}
}
}
}	
if($qt > 0)	 
{

$zx=explode(" ",$up1);

$sql_sel="select * from tblups where wt='".$zx[1]."' and ups='".$zx[0]."' order by uom Asc";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$row1234=mysqli_num_rows($res);
$row12=mysqli_fetch_array($res);
$uid=$row12['uid'];

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$vrids."' and actstatus='Active'") or die(mysqli_error($link));
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

//if($wtmp=="" || $wtmp==0)$wtmp=$zx[0];
if($upstyp=="NST")
{
	$sql_lot2=mysqli_query($link,"Select packtype,wtinmp from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  packtype='$ups24' and trtype='NSTPNPSLIP' and balnomp!=0 order by lotdgp_id ASC") or die(mysqli_error($link));
	$tot_lot2=mysqli_num_rows($sql_lot2);
	$row_lot2=mysqli_fetch_array($sql_lot2);
	$wtmp=$row_lot2['wtinmp'];
	$up1=$ups24;
}
if($wtmp=="" || $wtmp==0)$wtmp=$zx[0];
$mpno=floor($qt/$wtmp);

$totre=0; $nolots=0;
$sq=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  disps_crop='$cro' and disps_variety='$variet' and disps_flg!=1 and disp_id='$tid'") or die(mysqli_error($link));
if($to=mysqli_num_rows($sq) > 0)
{
	$ro=mysqli_fetch_array($sq);
	$sid=$ro['disps_id'];
	$sq23=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
	}
}
?>

<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cro?><input type="hidden" name="txtecrop" id="txtecrop" value="<?php echo $cro;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variet?><input type="hidden" name="txtevariety" id="txtevariety" value="<?php echo $variet;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="20" class="smalltbltext" maxlength="30" name="txtpvariety" id="txtpvariety" value="<?php echo $variet;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upstyp?><input type="hidden" name="txteupstyp" id="txteupstyp" value="<?php echo $upstyp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $up1?><input type="hidden" name="txteups" id="txteups" value="<?php echo $up1;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sstatus;?><input type="hidden" name="txtenop" id="txtenop" value="<?php echo $sstatus;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qt;?><input type="hidden" name="txteqty" id="txteqty" value="<?php echo $qt;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nolots;?><input type="hidden" name="txteordno" id="txteordno" value="<?php echo $orn;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" name="txtornomp" size="5" id="txtornomp" value="<?php echo $mpno;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" maxlength="5" name="txtnomp" id="txtnomp" value="" onchange="nompchk(this.value);" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtlonomp" id="txtlonomp" value="0" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txttlonomp" id="txttlonomp" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtorblnomp" id="txtorblnomp" value="" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
//}
//}
//}
}
?>-->
</table>
</div>
<?php 
if($totre==0)
{
?>
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" onClick="backupform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
<?php
}
?>