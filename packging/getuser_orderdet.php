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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
{
  $a = $_GET['a'];	 
}


$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno='$a'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$arrivalid=$row_month['orderm_id'];
$sql_mon=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrivalid."' order by order_sub_crop")or die("Error:".mysqli_error($link));
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Order No.</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoMP Loaded</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Loaded</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Balance</td>
</tr>
<?php 
$sn=1;
while($row_tbl_sub=mysqli_fetch_array($sql_mon))
{
$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";


			if($reptyp1=="hold")
	    	{	
				if($row_tbl_sub['order_sub_hold_flag']!=0)
				$statussub=$row_tbl_sub['order_sub_hold_type'];	
			}
			else
			{
			$statussub="";
			}


		$variet=$row_dept4['popularname'];
		$upstyp=$row_tbl_sub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['order_sub_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['order_sub_crop'];
		}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['order_sub_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['order_sub_variety'];	
		}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}
		//echo $row_tbl_sub['order_sub_id'];
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrivalid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
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
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}
	 //$row_tbl_sub['arrsub_id'];
}
	 
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $a;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;</td>
</tr>
<?php
$sn++;
}
?>
</table><input type="hidden" name="maintrid" value="0" />