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
	if($c!="")
	{
		if($c=="txtslsubbg1")
		{
			$d="recqtyp".$g;
			$id="txtrecbagp".$g;
			$uid="recqtyp".$g;
			$qid="txtrecbagp".$g;
			$u="qtychk1(this.value,$g)";
			$q="Bagschk1(this.value,$g)";
			$typ=$f;
		}
		if($c=="txtslsubbg2")
		{
			$d="recqtyp".$g;
			$id="txtrecbagp".$g;
			$uid="recqtyp".$g;
			$qid="txtrecbagp".$g;
			$u="qtychk1(this.value,$g)";
			$q="Bagschk1(this.value,$g)";
			$typ=$f;
		}
	}


$chkflg=0;  $pflg=0;
$trflg=0; $tflg=0; $row_month=0; $tpflg=0; $tpmflg=0; $itmid="";

$sql_sbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' and  sid='".$a."'")or die("Error:".mysqli_error($link));
$row_sbn=mysqli_num_rows($sql_sbin); 
$row_sbin=mysqli_fetch_array($sql_sbin);
$tp=$row_sbin['status']; 

/*$sql_tr=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$trid."' and lotvariety!='".$b."' and subbin='".$a."'") or die(mysqli_error($link));
echo $tot_tr=mysqli_num_rows($sql_tr);
if($tot_tr > 0)
{
	$trflg=1;
}
else
{*/
	$trflg=0;
/*	$sql_t=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$trid."' and lotvariety='".$b."' and subbin='".$a."'") or die(mysqli_error($link));
	while($row_tr=mysqli_fetch_array($sql_t))
	{	
		if($c=="txtslsubbg1" || $c=="txtslsubbg2")
		{
			if($typ!=$tp)
			{
			$tflg=1;
			}
			else
			{
			$tflg=0;
			}
		}
	}
}
*/

if($tp=="" || $typ=="")$tpmflg=1;
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
}

if($tpmflg==0)
{
	if(($tp==$typ || $tp=="Empty"))
	{
		$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
		$cnt=0;
		while($row_issueg=mysqli_fetch_array($s_good))
 	{ 
	$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."'") or die(mysqli_error($link));
	while($row_lot=mysqli_fetch_array($sql_lot))
 	{ 
	$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotldg_lotno='".$row_lot['lotldg_lotno']."'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1);  
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno=mysqli_num_rows($sql_issuetblg);
	
		//$t_good=mysqli_num_rows($s_good);
		
		if($totno > 0)
		{	
			$cnt++;
			//$tpflg=1;
		}
	}
	}
	//echo $cnt;
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

$xcflg=0;
$s_good_new=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$a."'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
while($row_issueg_new=mysqli_fetch_array($s_good_new))
{

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_subbinid='".$a."' and lotldg_lotno='".$row_issueg_new['lotldg_lotno']."'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and  lotldg_id='".$row_issueg1_new[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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

		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
		$existview=$row_crop_new['cropname'].", ".$varty.", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		}
	
	}
	else
	{
	//$tpmflg=0;
	//$existview="Empty";
	}
}
//echo $xcflg;
/*if($xcflg>0)
{
$tpmflg=1;
}*/
if($tpflg>0)$pflg=1;
if($tpmflg==0)
{
	if(($tp==$typ || $tp=="Empty"))
	{ $sa="";
		$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and  subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
		$cnt=0;
	while($row_issueg=mysqli_fetch_array($s_good))
 	{ 
	
	$sql_lot=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."'") or die(mysqli_error($link));
	while($row_lot=mysqli_fetch_array($sql_lot))
 	{ 
	
	$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and  subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotno='".$row_lot['lotno']."'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
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
			$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotdgp_id='".$sa."' and balqty > 0") or die(mysqli_error($link));  
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
$s_good_new=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  subbinid='".$a."'") or die(mysqli_error($link));
$zx=mysqli_num_rows($s_good_new);
//$r_good_new=mysqli_fetch_array($s_good_new);
while($row_issueg_new=mysqli_fetch_array($s_good_new))
{

	$sql_issueg1_new=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack whereplantcode='$plantcode' and  subbinid='".$a."' and lotno='".$row_issueg_new['lotno']."'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotdgp_id='".$row_issueg1_new[0]."' and balqty > 0") or die(mysqli_error($link)); 
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

//echo $tpflg;
//echo $tflg;
//exit;

//echo $tpmflg;
?>
<?php
if($tpflg==1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">Please check, Bin is occupied by different Variety</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
elseif($tflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Seed Stage is not matching. Please check it </td>
<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
elseif($tpmflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Seed Stage is not matching. Please check it </td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
else
{
?><table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" ><tr>
<td  align="center" width="50%"  valign="middle" class="smalltbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value=""  onchange="<?php echo $u;?>"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>	
<td width="50%" align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7"   value=""  onchange="<?php echo $q;?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr></table><?php }?>