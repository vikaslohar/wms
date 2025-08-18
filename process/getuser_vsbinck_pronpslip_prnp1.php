<?php
	/*session_start();
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
	}*/
	
	
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
else
{ 
	$c="";
}
if(isset($_GET['f']))
{
	$f = $_GET['f'];	 
}
if(isset($_GET['g']))
{
	$g = $_GET['g'];	 
}
if(isset($_GET['h']))
{
	$h = $_GET['h'];	 
}	
if(isset($_GET['trid']))
{
	$trid = $_GET['trid'];	 
}	
	//$d="";
$flag=0; 	

$typ=$f;

$chkflg=0; $existview="Empty"; $pflg=0;
$trflg=0; $tflg=0; $row_month=0; $tpflg=0; $tpmflg=0; $itmid=""; $varid11="";

$sql_sbin=mysqli_query($link,"select * from tbl_subbin where sid='".$a."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
$row_sbn=mysqli_num_rows($sql_sbin); 
$row_sbin=mysqli_fetch_array($sql_sbin);
$tp=$row_sbin['status'];

$sqlveriety=mysqli_query($link,"select * from tblvariety where popularname='".$b."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlveriety);
if($totvariety > 0)
{
$rowvariety=mysqli_fetch_array($sqlveriety);
$b=$rowvariety['varietyid'];
$varid=$rowvariety['popularname'];
}
else
{
$sqlveriety=mysqli_query($link,"select * from tblvariety where varietyid='".$b."' and actstatus='Active'") or die(mysqli_error($link));
$rowvariety=mysqli_fetch_array($sqlveriety);
$zx=mysqli_num_rows($sqlveriety);
if($zx > 0)
{
$b=$rowvariety['varietyid'];
$varid=$rowvariety['popularname'];
}
else
{
//$b=$rowvariety['varietyid'];
$varid=$b;
}
//$varid=$b;
}
//echo $varid;
//echo $trid;

		/*$varchk=$g."-"."Coded";
		$varchk2=$g."-"."Unidentified";
		//$varty="";
		if($varchk==$b || $varchk2==$b)
		{$trcflg=1; $existview=$g.", ".$b.", ".$typ;}*/
		
/*$sql_tr_222=mysqli_query($link,"select * from tblarr_sloc where subbin='".$a."' order by arrsloc_id desc") or die(mysqli_error($link));
$tot_tr_222=mysqli_num_rows($sql_tr_222);
if($tot_tr_222 > 0)
{
$row_tr_222=mysqli_fetch_array($sql_tr_222);

if($varid==$row_tr_222['lotvariety'])
$varid11=$varid;
else
$varid11=$row_tr_222['lotvariety'];

if($trid=="" || $trid=="undefined")
{$trid=$row_tr_222['arr_tr_id'];}
}

if($varid11!=$varid)$varid11=$varid; //echo $varid11;
$sql_tr=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$trid."' and lotvariety!='".$varid11."' and subbin='".$a."'") or die(mysqli_error($link));
 $tot_tr=mysqli_num_rows($sql_tr);
if($tot_tr > 0)
{
	$trflg=1; $existview="Occupied";
}
else
{	
	$trflg=0;
	
	$sql_t=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$trid."' and lotvariety='".$varid11."' and subbin='".$a."'") or die(mysqli_error($link));
	$xt=mysqli_num_rows($sql_t);
	while($row_tr=mysqli_fetch_array($sql_t))
	{	
		//echo $varid11; echo $varid;
		//echo $row_tr['lotvariety'];
				$varchk=$f."-"."Coded";
				$varchk2=$f."-"."Unidentified";
				//$varty="";
				if($varchk==$row_tr['lotvariety'] || $varchk2==$row_tr['lotvariety'])
				{$trflg=1; $existview=$f.", ".$row_tr['lotvariety'].", ".$typ;}
				
		if($varid11==$varid)
		$sql_sb=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$trid."' and lotvariety='".$varid11."' and arrsub_id='".$row_tr['arr_id']."'")or die(mysqli_error($link));
		else
		$sql_sb=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$trid."' and lotvariety='".$varid."' and arrsub_id='".$row_tr['arr_id']."'")or die(mysqli_error($link));
		$t_sb=mysqli_num_rows($sql_sb);
		if($t_sb > 0)
		{
			while($row_sb=mysqli_fetch_array($sql_sb))
			{
				if($typ!=$row_sb['sstage'])
				{
					$tflg=1; $existview=$row_sb['lotcrop'].$row_sb['lotvariety'].$row_sb['sstage'];
				}
				else
				{
					if($trflg!=1)
					{$tflg=0; $existview="Allowed";}
					else
					{$tflg=0; }
				}
			}
		}
	}
}*/
//echo $tp;
//echo $existview;
$stg=""; $stg2=""; $crp=""; $crp2=""; $vr=""; $vr2="";
/*if($tp=="" || $typ=="")$tpmflg=1;
if($tpmflg==0)
{
	if($typ!=$tp && $tp!="Empty")
	{
		$tpmflg=1;
	}
	else
	{ 
		$tpmflg=0;
	}
}*/

if($tpmflg==0)
{
	if(($tp==$typ || $tp=="Empty"))
	{
		$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety!='".$b."' and plantcode='$plantcode'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
		$cnt=0;
		while($row_issueg=mysqli_fetch_array($s_good))
 	{ 
	$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_lot=mysqli_fetch_array($sql_lot))
 	{ 
	$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotldg_lotno='".$row_lot['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$totno=mysqli_num_rows($sql_issuetblg);
	
		//$t_good=mysqli_num_rows($s_good);
		
		if($totno > 0)
		{	
			$cnt++;
			//$tpflg=1;
		}
	} 
	}
		if($cnt > 0)
		{	
			$tpflg=1;
		}

		else
		{	
			$tpflg=0;
		}
	}
}
//echo $chkflg;
//echo $tpflg;
//exit;

//echo $cnt;
$xcflg=0;
$s_good_new=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_lotno='".$row_issueg_new['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1_new[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$totno_new=mysqli_num_rows($sql_issuetblg_new);
	
	if($totno_new > 0)
	{	$xcflg++;
		$row_issuetblg_new=mysqli_fetch_array($sql_issuetblg_new);
		if($row_issuetblg_new['lotldg_trtype']=="Fresh Seed with PDN")
		{
		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
		$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new=mysqli_fetch_array($sql_crop_new);
		
		$varchk=$row_crop_new['cropname']."-"."Coded";
		$varchk2=$row_crop_new['cropname']."-"."Unidentified";
		$varty="";
		if($row_issuetblg_new['lotldg_variety']!=$varchk && $row_issuetblg_new['lotldg_variety']!=$varchk2)
		{			
			$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_veriety);
			$varty=$row_variety['popularname'];
		}
		else
		{
		$varty=$row_issuetblg_new['lotldg_variety'];
		}	

		$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'];
		
		}
		else
		{
		$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new=mysqli_fetch_array($sql_crop_new);
		
		$varchk=$row_crop_new['cropname']."-"."Coded";
		$varchk2=$row_crop_new['cropname']."-"."Unidentified";
		$varty="";
		if($row_issuetblg_new['lotldg_variety']!=$varchk && $row_issuetblg_new['lotldg_variety']!=$varchk2)
		{		
			$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_veriety);
			$varty=$row_variety['popularname'];
		}
		else
		{
		$varty=$row_issuetblg_new['lotldg_variety'];
		}	

		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
		$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'];
		$stg=$row_issuetblg_new['lotldg_sstage'];
		$crp=$row_issuetblg_new['lotldg_crop'];
		$vr=$row_issuetblg_new['lotldg_variety'];
		}
	
	}
	else
	{
	//$tpmflg=0;
	//$existview="Empty";
	}
//}	
/*if($xcflg>0)
{
$tpmflg=1;
}*/
if($tpflg>0)$pflg=1;
if($tpmflg==0)
{
	if(($tp==$typ || $tp=="Empty"))
	{ $sa="";
		$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."' and plantcode='$plantcode'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
		$cnt=0;
	while($row_issueg=mysqli_fetch_array($s_good))
 	{ 
	
	$sql_lot=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_lot=mysqli_fetch_array($sql_lot))
 	{ 
	
	$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotno='".$row_lot['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	 $totno=mysqli_num_rows($sql_issuetblg);
	
		//$t_good=mysqli_num_rows($s_good);
		
		if($totno > 0)
		{	
			$cnt++;
			$zx_good=mysqli_fetch_array($sql_issuetblg);
			$sa=$zx_good['lotdgp_id'];
			//$tpflg=1;
		}
	} 
	}
		if($cnt > 0)
		{	
			$tpflg=1;
			$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$sa."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2=mysqli_fetch_array($sql_issuetblg2);
			$sql_crop_new2=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new2=mysqli_fetch_array($sql_crop_new2);
		
		$varchk=$row_crop_new2['cropname']."-"."Coded";
		$varchk2=$row_crop_new2['cropname']."-"."Unidentified";
		$varty="";
		if($row_issuetblg_new2['lotldg_variety']!=$varchk && $row_issuetblg_new2['lotldg_variety']!=$varchk2)
		{		
			$sql_veriety2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety2=mysqli_fetch_array($sql_veriety2);
			$varty=$row_variety2['popularname'];
		}
		else
		{
		$varty=$row_issuetblg_new2['lotldg_variety'];
		}	

		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new2[subbinid],$row_issuetblg_new2[binid],$row_issuetblg_new2[whid],$row_issuetblg_new2[lotdgp_id])'>Details</a>";
		$existview=$row_crop_new2['cropname'].", ".$varty.", ".$row_issuetblg_new2['lotldg_sstage'].", ".$details;
		$stg2=$row_issuetblg_new2['lotldg_sstage'];
		$crp2=$row_issuetblg_new2['lotldg_crop'];
		$vr2=$row_issuetblg_new2['lotldg_variety'];
		}

		else
		{	
			if($pflg==0)
			$tpflg=0;
		}
	}
}


//echo $chkflg;
//echo $tpflg;
//exit;

//echo $cnt;

$xcflg=0;
$s_good_new=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$zx=mysqli_num_rows($s_good_new);
//$r_good_new=mysqli_fetch_array($s_good_new);
while($row_issueg_new=mysqli_fetch_array($s_good_new))
{

	$sql_issueg1_new=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$a."' and lotno='".$row_issueg_new['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1_new[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$totno_new=mysqli_num_rows($sql_issuetblg_new);
	
	if($totno_new > 0)
	{
		$xcflg++;
		$row_issuetblg_new=mysqli_fetch_array($sql_issuetblg_new);
		if($row_issuetblg_new['lotldg_trtype']=="Fresh Seed with PDN")
		{
		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[subbinid],$row_issuetblg_new[binid],$row_issuetblg_new[whid],$row_issuetblg_new[lotdgp_id])'>Details</a>";
		$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new=mysqli_fetch_array($sql_crop_new);
		
		$varchk=$row_crop_new['cropname']."-"."Coded";
		$varchk2=$row_crop_new['cropname']."-"."Unidentified";
		$varty="";
		if($row_issuetblg_new['lotldg_variety']!=$varchk && $row_issuetblg_new['lotldg_variety']!=$varchk2)
		{			
			$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_veriety);
			$varty=$row_variety['popularname'];
		}
		else
		{
		$varty=$row_issuetblg_new['lotldg_variety'];
		}	

		$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		
		}
		else
		{
		$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new=mysqli_fetch_array($sql_crop_new);
		
		$varchk=$row_crop_new['cropname']."-"."Coded";
		$varchk2=$row_crop_new['cropname']."-"."Unidentified";
		$varty="";
		if($row_issuetblg_new['lotldg_variety']!=$varchk && $row_issuetblg_new['lotldg_variety']!=$varchk2)
		{		
			$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_veriety);
			$varty=$row_variety['popularname'];
		}
		else
		{
		$varty=$row_issuetblg_new['lotldg_variety'];
		}	

		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[subbinid],$row_issuetblg_new[binid],$row_issuetblg_new[whid],$row_issuetblg_new[lotdgp_id])'>Details</a>";
		$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		$stg=$row_issuetblg_new['lotldg_sstage'];
		$crp=$row_issuetblg_new['lotldg_crop'];
		$vr=$row_issuetblg_new['lotldg_variety'];
		}
	
	}
	else
	{
	//$tpmflg=0;
	//$existview="Empty";
	}
}
/*if($xcflg>0)
{
$tpmflg=1;
}*/

if($stg=="" && $stg2!="")$stg=$stg2;
if($stg!="" && $stg2="")$stg=$stg;
if($stg!="" && $stg2!="")$stg="";
if($crp=="" && $crp2!="")$crp=$crp2;
if($crp!="" && $crp2="")$crp=$crp;
if($crp!="" && $crp2!="")$crp="";
if($vr=="" && $vr2!="")$vr=$vr2;
if($vr!="" && $vr2="")$vr=$vr;
if($vr!="" && $vr2!="")$vr="";

if($stg==$f && $crp==$crop && $b==$vr && $tpmflg>0) $tpmflg=0;

//echo $chkflg;

//echo $trflg;
//echo $tpflg;
//echo $tflg;
//echo $tpmflg;
?>
<?php
if($trflg==1)
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse;">		
<tr>
<td align="center" valign="middle" class="smalltblheading"><?php echo $existview?><input type="hidden" name="existview<?php echo $g?>" id="existview<?php echo $g?>" class="tbltext" value="<?php echo $existview?>" /></td>
</tr></table>
<?php
}
else if($tpflg==1)
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse;">		
<tr>
<td align="center" valign="middle" class="smalltblheading"><?php echo $existview?><input type="hidden" name="existview<?php echo $g?>" id="existview<?php echo $g?>" class="tbltext" value="<?php echo $existview?>" /></td>
</tr></table>
<?php
}
elseif($tflg == 1)
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >		
<tr>
<td align="center"  valign="middle" class="smalltblheading"><?php echo $existview?><input type="hidden" name="existview<?php echo $g?>" id="existview<?php echo $g?>" class="tbltext" value="<?php echo $existview?>" /></td>
</tr></table>
<?php
}
elseif($tpmflg == 1)
{ if($existview=="Empty" || $existview=="")$existview="Seed Stage Not Matching";
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >		
<tr>
<td align="center"  valign="middle" class="smalltblheading"><?php echo $existview?><input type="hidden" name="existview<?php echo $g?>" id="existview<?php echo $g?>" class="tbltext" value="<?php echo $existview?>" /></td>
</tr></table>
<?php
}
else
{
?><table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr>
<td  align="center" valign="middle" class="smalltbltext"><?php echo $existview?><input type="hidden" name="existview<?php echo $g?>" id="existview<?php echo $g?>" class="tbltext" value="<?php echo $existview?>" /></td>
</tr></table><?php }?><input type="hidden" name="trflg<?php echo $g?>" id="trflg<?php echo $g?>" value="<?php echo $trflg?>" /><input type="hidden" name="tpflg<?php echo $g?>" id="tpflg<?php echo $g?>" value="<?php echo $tpflg?>" /><input type="hidden" name="tflg<?php echo $g?>" id="tflg<?php echo $g?>" value="<?php echo $tflg?>" /><input type="hidden" name="tpmflg<?php echo $g?>" id="tpmflg<?php echo $g?>" value="<?php echo $tpmflg?>" />
