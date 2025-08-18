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

	if(isset($_REQUEST['a']))
	{
	$itmid = $_REQUEST['a'];
	}
	if(isset($_REQUEST['b']))
	{
	$orderreltyp = $_REQUEST['b'];
	}		
	if(isset($_REQUEST['c']))
	{
	$srno24 = $_REQUEST['c'];
	}
	if(isset($_REQUEST['f']))
	{
	$gorn = $_REQUEST['f'];
	}
if($orderreltyp=="Partial"   )
{
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);*/
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
/*if($row_tbl['order_trtype']=="Order Sales")
{
*/	?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_dispatch_flag!=1 and order_sub_hold_flag!=1") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;
$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

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
$qt=$qt1;

$subsaubsubid=$row_sloc['order_sub_sub_id'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";


if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $gorn?>" id="subsubid<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $gorn?>" id="extorqty<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $gorn?>" id="relqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $gorn?>);"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $gorn?>" id="orbalqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $gorn?>" id="subsubid<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $gorn?>" id="extorqty<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $gorn?>" id="relqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $gorn?>);"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $gorn?>" id="orbalqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
}
?>
</table>

<?php
}
else
{
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);*/
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
/*if($row_tbl['order_trtype']=="Order Sales")
{
*/	?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;
$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

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
$qt=$qt1;

$subsaubsubid=$row_sloc['order_sub_sub_id'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";


if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $gorn?>" id="subsubid<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $gorn?>" id="extorqty<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $gorn?>" id="relqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $gorn?>);" value="<?php echo $qt;?>" readonly="true" style="background-color:#CCCCCC"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $gorn?>" id="orbalqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="0"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $gorn?>" id="subsubid<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $gorn?>" id="extorqty<?php echo $gorn?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $gorn?>" id="relqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $gorn?>);" value="<?php echo $qt;?>" readonly="true" style="background-color:#CCCCCC"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $gorn?>" id="orbalqty<?php echo $gorn?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="0"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
}
?>
</table>

<?php
}
?>
<input type="hidden" name="srno24" id="srno24<?php echo $gorn?>" value="<?php echo $srno24?>" />