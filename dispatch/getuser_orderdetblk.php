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

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='$a' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_id='".$rowtbl['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid;
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

$sn=1;
//if($arrivalid!="")
{
/*$sql_crp=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_crp);
while($row_crp=mysqli_fetch_array($sql_crp))
{
$sql_ver=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_crop='".$row_crp['order_sub_crop']."' and orderm_id in($arrivalid) order by order_sub_variety") or die(mysqli_error($link));
$totver=mysqli_num_rows($sql_ver);
while($row_ver=mysqli_fetch_array($sql_ver))
{*/
//$sqlver=mysqli_query($link,"select distinct order_sub_ups_type from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_crop='".$row_crp['order_sub_crop']."' and order_sub_variety='".$row_ver['order_sub_variety']."' and orderm_id in($arrivalid) order by order_sub_ups_type") or die(mysqli_error($link));
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
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety'"); 
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
}
if($qt > 0 && $upstyp=="NST")	 
{
 $nolots=0;
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
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nolots;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>" /></td>
</tr>
<?php
$sn++;
}
}
}
}
/*}
}*/
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="" />
</table>