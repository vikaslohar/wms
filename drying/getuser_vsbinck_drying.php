<?php
/*	session_start();
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

$sql_sbin=mysqli_query($link,"select * from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$a."'")or die("Error:".mysqli_error($link));
$row_sbn=mysqli_num_rows($sql_sbin); 
$row_sbin=mysqli_fetch_array($sql_sbin);
$tp=$row_sbin['status']; 


$sqlveriety=mysqli_query($link,"select * from tblvariety where popularname='".$b."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlveriety);
if($totvariety > 0)
{
	$rowvariety=mysqli_fetch_array($sqlveriety);
	$b=$rowvariety['varietyid'];
	$varid=$rowvariety['popularname'];
}
else
{
	$sqlveriety=mysqli_query($link,"select * from tblvariety where varietyid='".$b."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
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
	//$trflg=0;
$sql_tr_222=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   subbin='".$a."' order by arrsloc_id desc") or die(mysqli_error($link));
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
$sql_tr=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$trid."' and lotvariety!='".$varid11."' and subbin='".$a."'") or die(mysqli_error($link));
$tot_tr=mysqli_num_rows($sql_tr);
if($tot_tr > 0)
{
	$trflg=1; $existview="Occupied";
}
else
{	
	$trflg=0;
	
	$sql_t=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$trid."' and lotvariety='".$varid11."' and subbin='".$a."'") or die(mysqli_error($link));
	$xt=mysqli_num_rows($sql_t);
	while($row_tr=mysqli_fetch_array($sql_t))
	{	
		//echo $varid11; echo $varid;
		//echo $row_tr['lotvariety'];
		$varchk=$g."-"."Coded";
		$varchk2=$g."-"."Unidentified";
		//$varty="";
		if($varchk==$row_tr['lotvariety'] || $varchk2==$row_tr['lotvariety'])
		{
			$asdf="select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$trid."' and lotvariety='".$varid."' and spcodef='".$spcdf."' and spcodem='".$spcdm."' and arrsub_id='".$row_tr['arr_id']."'";
			$sql_sb240=mysqli_query($link,$asdf)or die(mysqli_error($link));
			$t_sb240=mysqli_num_rows($sql_sb240);
			if($t_sb240 == 0)
			{$trflg=1; $existview=$g.", ".$row_tr['lotvariety'].", ".$typ; }
				
		}
				
		if($varid11==$varid)
			$sql_sb=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$trid."' and lotvariety='".$varid11."' and arrsub_id='".$row_tr['arr_id']."'")or die(mysqli_error($link));
		else
			$sql_sb=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$trid."' and lotvariety='".$varid."' and arrsub_id='".$row_tr['arr_id']."'")or die(mysqli_error($link));
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
}
/*
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
*/


//echo $trflg;
//echo $tpflg;
//echo $tflg;
//echo $tpmflg;
?>
<?php
if($tpflg==1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">Please check, Bin is occupied by different Variety</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
elseif($tflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Seed Stage is not matching. Please check it </td>
<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
elseif($tpmflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Seed Stage is not matching. Please check it </td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
else
{
?><table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" ><tr>
<td  align="center" width="50%"  valign="middle" class="smalltbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value=""  onchange="<?php echo $u;?>"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>	
<td width="50%" align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7"   value=""  onchange="<?php echo $q;?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr></table><?php }?>
