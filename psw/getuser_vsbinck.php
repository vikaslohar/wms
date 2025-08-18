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
			$d="txtslBagsg1";
			$id="txtslqtyg1";
			$uid="Bags1";
			$qid="qty1";
			$u="Bagsf1(this.value)";
			$q="qtyf1(this.value)";
			$typ=$f;
		}
		if($c=="txtslsubbg2")
		{
			$d="txtslBagsg2";
			$id="txtslqtyg2";
			$uid="Bags2";
			$qid="qty2";
			$u="Bagsf2(this.value)";
			$q="qtyf2(this.value)";
			$typ=$f;
		}
	}


$chkflg=0;
$trflg=0; $tflg=0; $row_month=0; $tpflg=0; $tpmflg=0; $itmid="";

$sql_sbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' and sid='".$a."'")or die("Error:".mysqli_error($link));
$row_sbn=mysqli_num_rows($sql_sbin); 
$row_sbin=mysqli_fetch_array($sql_sbin);
$tp=$row_sbin['status']; 

$sql_tr=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$trid."' and lotvariety!='".$b."' and subbin='".$a."'") or die(mysqli_error($link));
$tot_tr=mysqli_num_rows($sql_tr);
if($tot_tr > 0)
{
	$trflg=1;
}
else
{
	$trflg=0;
	$sql_t=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$trid."' and lotvariety='".$b."' and subbin='".$a."'") or die(mysqli_error($link));
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


if($typ!=$tp && $tp!="Empty")
{
	$tpmflg=1;
}
else
{ 
	$tpmflg=0;
}

if($tpmflg==0)
{
	if(($tp==$typ || $tp=="Empty"))
	{
		$s_good=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$a."' and lotldg_varietyid!='".$b."'") or die(mysqli_error($link));
		//$r_good=mysqli_fetch_array($s_good);
		$cnt=0;
		while($row_issueg=mysqli_fetch_array($s_good))
 	{ 
	$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issueg['lotldg_subbinid']."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno=mysqli_num_rows($sql_issuetblg);
	
		//$t_good=mysqli_num_rows($s_good);
		
		if($totno > 0)
		{	
			$cnt++;
			//$tpflg=1;
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

//echo $tpflg;
?>
<?php
if($trflg==1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">Please check, Bin is occupied by different Variety</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
elseif($tflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Seed Stage is not matching. Please check it </td>
<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
elseif($tpmflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Seed Stage is not matching. Please check it </td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
else
{
?><table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" ><tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="<?php echo $g;?>"  onchange="<?php echo $u;?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7"   value="<?php echo $h;?>"  onchange="<?php echo $q;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php }?>