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

$sql_bar=mysqli_query($link,"Select * from tbl_barcodes where plantcode='$plantcode' and bar_barcode='$a' and bar_dispflg=0 and bar_unpackflg=0") or die(mysqli_error($link));
$tot_bar=mysqli_num_rows($sql_bar);	
$row_bar=mysqli_fetch_array($sql_bar);

$totextpouches="";	$qtyyy=""; $mptype="";
$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$cropname=""; $varietyname=""; $lotnumber=""; $upssize="";
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_barcode='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_spremflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=explode(",", $row_mps['mpmain_crop']);
		$verarr=explode(",", $row_mps['mpmain_variety']);
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=explode(",", $row_mps['mpmain_upssize']);
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		for ($i=0; $i<count($lotarr); $i++)
		{
			$qtys=$row_mps['mpmain_wtmp'];
			$sqlcrop=mysqli_query($link,"Select * from tblcrop where cropid='".$crparr[$i]."'") or die(mysqli_error($link));
			$totcrop=mysqli_num_rows($sqlcrop);
			$rowcrop=mysqli_fetch_array($sqlcrop);
				
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$verarr[$i]."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
		
			$up=explode(" ", $upsarr[$i]);
			if($up[1]=="Gms")
			{
				$ptp=1000/$up[0];
			}
			else
			{
				$ptp=$up[0];
			}
		
			$nops=$ptp*$qtys;  
			
			//$nops=$qtys/$ptp;
			if($totextpouches!="")
			$totextpouches=$totextpouches."<br/>".$nops; 
			else
			$totextpouches=$nops; 
			
			if($qtyyy!="")
			$qtyyy=$qtyyy."<br/>".$qtys; 
			else
			$qtyyy=$qtys;
			
			if($cropname!="")
			$cropname=$cropname."<br/>".$rowcrop['cropname']; 
			else
			$cropname=$rowcrop['cropname'];
			
			if($varietyname!="")
			$varietyname=$varietyname."<br/>".$rowvariety['popularname']; 
			else
			$varietyname=$rowvariety['popularname'];
			
			if($lotnumber!="")
			$lotnumber=$lotnumber."<br/>".$lotarr[$i]; 
			else
			$lotnumber=$lotarr[$i];
			
			if($upssize!="")
			$upssize=$upssize."<br/>".$upsarr[$i]; 
			else
			$upssize=$upsarr[$i];
		}
	$mptype="SMC";	
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_barcode='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_spremflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=explode(",", $row_mpl['mpmain_crop']);
		$verarr=explode(",", $row_mpl['mpmain_variety']);
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpl['mpmain_upssize']);
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);

		for ($i=0; $i<count($lotarr); $i++)
		{
			$nopl=$noparr[$i];
			$sqlcrop=mysqli_query($link,"Select * from tblcrop where cropid='".$crparr[$i]."'") or die(mysqli_error($link));
			$totcrop=mysqli_num_rows($sqlcrop);
			$rowcrop=mysqli_fetch_array($sqlcrop);
				
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$verarr[$i]."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
		
			$up=explode(" ", $upsarr[$i]);
			if($up[1]=="Gms")
			{
				$ptp=$up[0]/1000;
			}
			else
			{
				$ptp=$up[0];
			}
			
			$qtyl=$ptp*$nopl; 
			
			if($totextpouches!="")
			$totextpouches=$totextpouches."<br/>".$nopl; 
			else
			$totextpouches=$nopl; 
			
			if($qtyyy!="")
			$qtyyy=$qtyyy."<br/>".$qtyl; 
			else
			$qtyyy=$qtyl;
			
			if($cropname!="")
			$cropname=$cropname."<br/>".$rowcrop['cropname']; 
			else
			$cropname=$rowcrop['cropname'];
			
			if($varietyname!="")
			$varietyname=$varietyname."<br/>".$rowvariety['popularname']; 
			else
			$varietyname=$rowvariety['popularname'];
			
			if($lotnumber!="")
			$lotnumber=$lotnumber."<br/>".$lotarr[$i]; 
			else
			$lotnumber=$lotarr[$i];
			
			if($upssize!="")
			$upssize=$upssize."<br/>".$upsarr[$i]; 
			else
			$upssize=$upsarr[$i];
		} 
	$mptype="LMC";	
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_barcode='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_spremflg=0") or die(mysqli_error($link));
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
		
		for ($i=0; $i<count($lotarr); $i++)
		{
			$nopm=$noparr[$i];
			$sqlcrop=mysqli_query($link,"Select * from tblcrop where cropid='".$crparr[$i]."'") or die(mysqli_error($link));
			$totcrop=mysqli_num_rows($sqlcrop);
			$rowcrop=mysqli_fetch_array($sqlcrop);
				
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$verarr[$i]."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
		
			$up=explode(" ", $upsarr[$i]);
			if($up[1]=="Gms")
			{
				$ptp=$up[0]/1000;
			}
			else
			{
				$ptp=$up[0];
			}
			$qtym=$ptp*$nopm; 
			
			if($totextpouches!="")
			$totextpouches=$totextpouches."<br/>".$nopm; 
			else
			$totextpouches=$nopm; 
			
			if($qtyyy!="")
			$qtyyy=$qtyyy."<br/>".$qtym; 
			else
			$qtyyy=$qtym;
			
			if($cropname!="")
			$cropname=$cropname."<br/>".$rowcrop['cropname']; 
			else
			$cropname=$rowcrop['cropname'];
			
			if($varietyname!="")
			$varietyname=$varietyname."<br/>".$rowvariety['popularname']; 
			else
			$varietyname=$rowvariety['popularname'];
			
			if($lotnumber!="")
			$lotnumber=$lotnumber."<br/>".$lotarr[$i]; 
			else
			$lotnumber=$lotarr[$i];
			
			if($upssize!="")
			$upssize=$upssize."<br/>".$upsarr[$i]; 
			else
			$upssize=$upsarr[$i];
		}
	$mptype="MMC";
	}
}

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_barcode='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_spremflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=explode(",", $row_mpns['mpmain_crop']);
		$verarr=explode(",", $row_mpns['mpmain_variety']);
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=explode(",", $row_mpns['mpmain_upssize']);
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		for ($i=0; $i<count($lotarr); $i++)
		{
			$qtys=$row_mpns['mpmain_wtmp'];
			$sqlcrop=mysqli_query($link,"Select * from tblcrop where cropid='".$crparr[$i]."'") or die(mysqli_error($link));
			$totcrop=mysqli_num_rows($sqlcrop);
			$rowcrop=mysqli_fetch_array($sqlcrop);
				
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$verarr[$i]."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
		
			$up=explode(" ", $upsarr[$i]);
			if($up[1]=="Gms")
			{
				$ptp=1000/$up[0];
			}
			else
			{
				$ptp=$up[0];
			}
		
			$nops=$ptp*$qtys;    
			//$nops=$qtys/$ptp;
			if($totextpouches!="")
			$totextpouches=$totextpouches."<br/>".$nops; 
			else
			$totextpouches=$nops; 
			
			if($qtyyy!="")
			$qtyyy=$qtyyy."<br/>".$qtys; 
			else
			$qtyyy=$qtys;
			
			if($cropname!="")
			$cropname=$cropname."<br/>".$rowcrop['cropname']; 
			else
			$cropname=$rowcrop['cropname'];
			
			if($varietyname!="")
			$varietyname=$varietyname."<br/>".$rowvariety['popularname']; 
			else
			$varietyname=$rowvariety['popularname'];
			
			if($lotnumber!="")
			$lotnumber=$lotnumber."<br/>".$lotarr[$i]; 
			else
			$lotnumber=$lotarr[$i];
			
			if($upssize!="")
			$upssize=$upssize."<br/>".$upsarr[$i]; 
			else
			$upssize=$upsarr[$i];
		}
	$mptype="NMC";	
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_barcode='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_spremflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=explode(",", $row_mpnl['mpmain_crop']);
		$verarr=explode(",", $row_mpnl['mpmain_variety']);
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpnl['mpmain_upssize']);
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);

		for ($i=0; $i<count($lotarr); $i++)
		{
			$nopl=$noparr[$i];
			$sqlcrop=mysqli_query($link,"Select * from tblcrop where cropid='".$crparr[$i]."'") or die(mysqli_error($link));
			$totcrop=mysqli_num_rows($sqlcrop);
			$rowcrop=mysqli_fetch_array($sqlcrop);
				
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$verarr[$i]."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
		
			$up=explode(" ", $upsarr[$i]);
			if($up[1]=="Gms")
			{
				$ptp=$up[0]/1000;
			}
			else
			{
				$ptp=$up[0];
			}
			
			$qtyl=$ptp*$nopl; 
			
			if($totextpouches!="")
			$totextpouches=$totextpouches."<br/>".$nopl; 
			else
			$totextpouches=$nopl; 
			
			if($qtyyy!="")
			$qtyyy=$qtyyy."<br/>".$qtyl; 
			else
			$qtyyy=$qtyl;
			
			if($cropname!="")
			$cropname=$cropname."<br/>".$rowcrop['cropname']; 
			else
			$cropname=$rowcrop['cropname'];
			
			if($varietyname!="")
			$varietyname=$varietyname."<br/>".$rowvariety['popularname']; 
			else
			$varietyname=$rowvariety['popularname'];
			
			if($lotnumber!="")
			$lotnumber=$lotnumber."<br/>".$lotarr[$i]; 
			else
			$lotnumber=$lotarr[$i];
			
			if($upssize!="")
			$upssize=$upssize."<br/>".$upsarr[$i]; 
			else
			$upssize=$upsarr[$i];
		} 
	$mptype="NLC";	
	}
}

//$totextpouches=$nops+$nopl+$nopm;
//$qtyyy=$qtys+$qtyl+$qtym;
if($qtyyy!="")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode<?php echo $b?>" id="txtbarcod<?php echo $b?>" type="text" size="9" class="smalltbltext" value="<?php echo $a;?>" maxlength="11" onchange="chkbarcode(this.value,'<?php echo $b?>');" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $mptype;?></td>
<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $varietyname;?></td>
<td width="119" align="center" valign="middle" class="smalltbltext"><?php echo $lotnumber;?></td>
<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $upssize;?></td>
<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $totextpouches;?></td>
<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $qtyyy;?></td>
<td width="60" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="resetbarcode('<?php echo $b?>','<?php echo $a?>');">Reset</a></td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet<?php echo $b?>" /></td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode<?php echo $b?>" id="txtbarcod<?php echo $b?>" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,'<?php echo $b?>');" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td align="left" valign="middle" class="smalltbltext" colspan="7">&nbsp;<font color="#FF0000" style="font-weight:bold">Barcode Not Found. Reason: Barcode may be Dispatched / Unpacked / Not generated.</font></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet<?php echo $b?>" disabled="disabled" /></td>
</tr>
</table>
<?php
}
?>
