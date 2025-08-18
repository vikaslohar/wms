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
	if(isset($_GET['m']))
	{
		$seedstage = $_GET['m'];	 
	}	
	if(isset($_GET['n']))
	{
		$whval = $_GET['n'];	 
	}	
	if(isset($_GET['o']))
	{
		$crpval = $_GET['o'];	 
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
			$typ=$seedstage;
		}
		if($c=="txtslsubbg2")
		{
			$d="txtslBagsg2";
			$id="txtslqtyg2";
			$uid="Bags2";
			$qid="qty2";
			$u="Bagsf2(this.value)";
			$q="qtyf2(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg3")
		{
			$d="txtslBagsg3";
			$id="txtslqtyg3";
			$uid="Bags3";
			$qid="qty3";
			$u="Bagsf3(this.value)";
			$q="qtyf3(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg4")
		{
			$d="txtslBagsg4";
			$id="txtslqtyg4";
			$uid="Bags4";
			$qid="qty4";
			$u="Bagsf4(this.value)";
			$q="qtyf4(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg5")
		{
			$d="txtslBagsg5";
			$id="txtslqtyg5";
			$uid="Bags5";
			$qid="qty5";
			$u="Bagsf5(this.value)";
			$q="qtyf5(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg6")
		{
			$d="txtslBagsg6";
			$id="txtslqtyg6";
			$uid="Bags6";
			$qid="qty6";
			$u="Bagsf6(this.value)";
			$q="qtyf6(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg7")
		{
			$d="txtslBagsg7";
			$id="txtslqtyg7";
			$uid="Bags7";
			$qid="qty7";
			$u="Bagsf7(this.value)";
			$q="qtyf7(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg8")
		{
			$d="txtslBagsg8";
			$id="txtslqtyg8";
			$uid="Bags8";
			$qid="qty8";
			$u="Bagsf8(this.value)";
			$q="qtyf8(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg9")
		{
			$d="txtslBagsg9";
			$id="txtslqtyg9";
			$uid="Bags9";
			$qid="qty9";
			$u="Bagsf9(this.value)";
			$q="qtyf9(this.value)";
			$typ=$seedstage;
		}
		if($c=="txtslsubbg10")
		{
			$d="txtslBagsg10";
			$id="txtslqtyg10";
			$uid="Bags10";
			$qid="qty10";
			$u="Bagsf10(this.value)";
			$q="qtyf10(this.value)";
			$typ=$seedstage;
		}
	}
	if($typ=="")$typ="Raw";
//echo $b;
//echo $typ;
$chkflg=0; $existview=""; $pflg=0;
$trflg=0; $tflg=0; $row_month=0; $tpflg=0; $tpmflg=0; $itmid=""; $varid11="";

$sql_sbin=mysqli_query($link,"select * from tbl_subbin where sid='".$a."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
$row_sbn=mysqli_num_rows($sql_sbin); 
$row_sbin=mysqli_fetch_array($sql_sbin);
$tp=$row_sbin['status'];

$sqlveriety=mysqli_query($link,"select * from tblvariety where varietyid='".$b."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlveriety);
if($totvariety > 0)
{
$rowvariety=mysqli_fetch_array($sqlveriety);
$b=$rowvariety['varietyid'];
$varid=$rowvariety['popularname'];
}
else
{
$sqlveriety=mysqli_query($link,"select * from tblvariety where popularname='".$b."' and actstatus='Active'") or die(mysqli_error($link));
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
//echo " ".$b." ";
//echo $varid;
//echo $trid;
$lotn=$f;
$whtype='';
$whquery=mysqli_query($link,"select whid, perticulars, whtype from tbl_warehouse where whid='$whval' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$noticiawh=mysqli_fetch_array($whquery);
$whtype=$noticiawh['whtype'];

//echo $tp;
//echo $existview;
if(($whtype=="Regular"))
{ 
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

	
		$sa="";$cnt=0;
		$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
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
					$zx_good=mysqli_fetch_array($sql_issuetblg);
					$sa=$zx_good['lotldg_id'];
					//$tpflg=1;
				}
			} 
		}
		if($cnt > 0)
		{	
			$tpflg=1;
			$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$sa."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2=mysqli_fetch_array($sql_issuetblg2);
			$sql_crop_new2=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2=mysqli_fetch_array($sql_crop_new2);
			
			$varchk=$row_crop_new2['cropname']."-"."Coded";
			$varchk2=$row_crop_new2['cropname']."-"."Unidentified";
			$varty="";
			if($row_issuetblg_new2['lotldg_variety']!=$varchk && $row_issuetblg_new2['lotldg_variety']!=$varchk2)
			{		
				$sql_veriety2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2['lotldg_variety']."' and actstatus='Active' ") or die(mysqli_error($link));
				$row_variety2=mysqli_fetch_array($sql_veriety2);
				$varty=$row_variety2['popularname'];
			}
			else
			{
			$varty=$row_issuetblg_new2['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2['cropname'].", ".$varty.", ".$row_issuetblg_new2['lotldg_sstage'].", ".$details;}
		}

		else
		{	
			$tpflg=0;
			$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_subbinid='".$a."' ") or die(mysqli_error($link));
			//echo $r_good=mysqli_num_rows($s_good);
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
						$zx_good=mysqli_fetch_array($sql_issuetblg);
						$sa=$zx_good['lotldg_id'];
						//$tpflg=1;
					}
				} 
			}
			$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$sa."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2=mysqli_fetch_array($sql_issuetblg2);
			$sql_crop_new2=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2=mysqli_fetch_array($sql_crop_new2);
			
			$varchk=$row_crop_new2['cropname']."-"."Coded";
			$varchk2=$row_crop_new2['cropname']."-"."Unidentified";
			$varty="";
			if($row_issuetblg_new2['lotldg_variety']!=$varchk && $row_issuetblg_new2['lotldg_variety']!=$varchk2)
			{		
				$sql_veriety2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2['lotldg_variety']."' and actstatus='Active' ") or die(mysqli_error($link));
				$row_variety2=mysqli_fetch_array($sql_veriety2);
				$varty=$row_variety2['popularname'];
			}
			else
			{
			$varty=$row_issuetblg_new2['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2['cropname'].", ".$varty.", ".$row_issuetblg_new2['lotldg_sstage'].", ".$details;}
		}
	

	if($tpflg>0)$pflg=1;

		$s_goodpack=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
		//$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
		$cnt=0;$sapack='';
		while($row_issuegpack=mysqli_fetch_array($s_goodpack))
		{ 
		
			$sql_lotpack=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			while($row_lotpack=mysqli_fetch_array($sql_lotpack))
			{ 
			
				$sql_issueg1pack=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and lotno='".$row_lotpack['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_issueg1pack=mysqli_fetch_array($sql_issueg1pack); 
				
				$sql_issuetblgpack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1pack[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$totnopack=mysqli_num_rows($sql_issuetblgpack);
			
				//$t_good=mysqli_num_rows($s_good);
				
				if($totnopack > 0)
				{	
					$cnt++;
					$zx_goodpack=mysqli_fetch_array($sql_issuetblgpack);
					$sapack=$zx_goodpack['lotdgp_id'];
					//$tpflg=1;
				}
			} 
		}
		if($cnt > 0)
		{	
			$tpflg=1;
			$sql_issuetblg2pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$sapack."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2pack=mysqli_fetch_array($sql_issuetblg2pack);
			$sql_crop_new2pack=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2pack['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2pack=mysqli_fetch_array($sql_crop_new2pack);
			
			$varchkpack=$row_crop_new2pack['cropname']."-"."Coded";
			$varchk2pack=$row_crop_new2pack['cropname']."-"."Unidentified";
			$vartypack="";
			if($row_issuetblg_new2pack['lotldg_variety']!=$varchkpack && $row_issuetblg_new2pack['lotldg_variety']!=$varchk2pack)
			{		
				$sql_veriety2pack=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2pack['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
				$row_variety2pack=mysqli_fetch_array($sql_veriety2pack);
				$vartypack=$row_variety2pack['popularname'];
			}
			else
			{
				$vartypack=$row_issuetblg_new2pack['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2pack['cropname'].", ".$vartypack.", ".$row_issuetblg_new2pack['lotldg_sstage'].", ".$detailspack;}
		}

		else
		{	
			if($pflg==0)
			$tpflg=0;
			
			$s_goodpack=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
			//$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
			//echo $r_good=mysqli_num_rows($s_good);
			$cnt=0;$sapack='';
			while($row_issuegpack=mysqli_fetch_array($s_goodpack))
			{ 
			
				$sql_lotpack=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				while($row_lotpack=mysqli_fetch_array($sql_lotpack))
				{ 
				
					$sql_issueg1pack=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and lotno='".$row_lotpack['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$row_issueg1pack=mysqli_fetch_array($sql_issueg1pack); 
					
					$sql_issuetblgpack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1pack[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
					$totnopack=mysqli_num_rows($sql_issuetblgpack);
				
					//$t_good=mysqli_num_rows($s_good);
					
					if($totnopack > 0)
					{	
						
						$zx_goodpack=mysqli_fetch_array($sql_issuetblgpack);
						$sapack=$zx_goodpack['lotdgp_id'];
						//$tpflg=1;
					}
				} 
			}
			$sql_issuetblg2pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$sapack."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2pack=mysqli_fetch_array($sql_issuetblg2pack);
			$sql_crop_new2pack=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2pack['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2pack=mysqli_fetch_array($sql_crop_new2pack);
			
			$varchkpack=$row_crop_new2pack['cropname']."-"."Coded";
			$varchk2pack=$row_crop_new2pack['cropname']."-"."Unidentified";
			$vartypack="";
			if($row_issuetblg_new2pack['lotldg_variety']!=$varchkpack && $row_issuetblg_new2pack['lotldg_variety']!=$varchk2pack)
			{		
				$sql_veriety2pack=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2pack['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
				$row_variety2pack=mysqli_fetch_array($sql_veriety2pack);
				$vartypack=$row_variety2pack['popularname'];
			}
			else
			{
				$vartypack=$row_issuetblg_new2pack['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2pack['cropname'].", ".$vartypack.", ".$row_issuetblg_new2pack['lotldg_sstage'].", ".$detailspack;}
		}
}	

if(($whtype=="Cold"))
{ 	
		$sa="";$cnt=0; //echo $b."  ";
		$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety!='".$b."' and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));
		 $r_good=mysqli_num_rows($s_good);
		while($row_issueg=mysqli_fetch_array($s_good))
		{ 
			$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));
			while($row_lot=mysqli_fetch_array($sql_lot))
			{ 
				$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotldg_lotno='".$row_lot['lotldg_lotno']."' and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
				$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$totno=mysqli_num_rows($sql_issuetblg);
			
				//$t_good=mysqli_num_rows($s_good);
				
				if($totno > 0)
				{	
					$cnt++;
					$zx_good=mysqli_fetch_array($sql_issuetblg);
					$sa=$zx_good['lotldg_id'];
					//$tpflg=1;
				}
			} 
		}
		if($cnt > 0)
		{	
			$tpflg=1;
			$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$sa."' and lotldg_balqty > 0 and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2=mysqli_fetch_array($sql_issuetblg2);
			$sql_crop_new2=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2=mysqli_fetch_array($sql_crop_new2);
			
			$varchk=$row_crop_new2['cropname']."-"."Coded";
			$varchk2=$row_crop_new2['cropname']."-"."Unidentified";
			$varty="";
			if($row_issuetblg_new2['lotldg_variety']!=$varchk && $row_issuetblg_new2['lotldg_variety']!=$varchk2)
			{		
				$sql_veriety2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2['lotldg_variety']."' and actstatus='Active' ") or die(mysqli_error($link));
				$row_variety2=mysqli_fetch_array($sql_veriety2);
				$varty=$row_variety2['popularname'];
			}
			else
			{
			$varty=$row_issuetblg_new2['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2['cropname'].", ".$varty.", ".$row_issuetblg_new2['lotldg_sstage'].", ".$details;}
		}

		else
		{	
			$tpflg=0;
			
			$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_subbinid='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
			//echo $r_good=mysqli_num_rows($s_good);
			while($row_issueg=mysqli_fetch_array($s_good))
			{ 
				$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
				while($row_lot=mysqli_fetch_array($sql_lot))
				{ 
					$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$a."' and lotldg_variety='".$row_issueg['lotldg_variety']."' and lotldg_lotno='".$row_lot['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$row_issueg1=mysqli_fetch_array($sql_issueg1); 
					
					$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
					$totno=mysqli_num_rows($sql_issuetblg);
				
					//$t_good=mysqli_num_rows($s_good);
					
					if($totno > 0)
					{	
						
						$zx_good=mysqli_fetch_array($sql_issuetblg);
						$sa=$zx_good['lotldg_id'];
						//$tpflg=1;
					}
				} 
			}
			//echo $sa;
			$sql_issuetblg2=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$sa."' and lotldg_balqty > 0 and plantcode='$plantcode' ") or die(mysqli_error($link));  
			$row_issuetblg_new2=mysqli_fetch_array($sql_issuetblg2);
			$sql_crop_new2=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2=mysqli_fetch_array($sql_crop_new2);
			
			$varchk=$row_crop_new2['cropname']."-"."Coded";
			$varchk2=$row_crop_new2['cropname']."-"."Unidentified";
			$varty="";
			
			if($row_issuetblg_new2['lotldg_variety']!=$varchk && $row_issuetblg_new2['lotldg_variety']!=$varchk2)
			{		
				$sql_veriety2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2['lotldg_variety']."' and actstatus='Active' ") or die(mysqli_error($link));
				$row_variety2=mysqli_fetch_array($sql_veriety2);
				$varty=$row_variety2['popularname'];
			}
			else
			{
			$varty=$row_issuetblg_new2['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2['cropname'].", ".$varty.", ".$row_issuetblg_new2['lotldg_sstage'].", ".$details;}
		}
	

	if($tpflg>0)$pflg=1;

		$s_goodpack=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."'  and lotldg_crop='".$crpval."'") or die(mysqli_error($link));
		//$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
		//echo $r_good=mysqli_num_rows($s_good);
		$cnt=0;$sapack='';
		while($row_issuegpack=mysqli_fetch_array($s_goodpack))
		{ 
		
			$sql_lotpack=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));
			while($row_lotpack=mysqli_fetch_array($sql_lotpack))
			{ 
			
				$sql_issueg1pack=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and lotno='".$row_lotpack['lotno']."' and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_issueg1pack=mysqli_fetch_array($sql_issueg1pack); 
				
				$sql_issuetblgpack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1pack[0]."' and balqty > 0 and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$totnopack=mysqli_num_rows($sql_issuetblgpack);
			
				//$t_good=mysqli_num_rows($s_good);
				
				if($totnopack > 0)
				{	
					$cnt++;
					$zx_goodpack=mysqli_fetch_array($sql_issuetblgpack);
					$sapack=$zx_goodpack['lotdgp_id'];
					//$tpflg=1;
				}
			} 
		}
		if($cnt > 0)
		{	
			$tpflg=1;

			$sql_issuetblg2pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$sapack."' and balqty > 0 and lotldg_crop='".$crpval."' and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2pack=mysqli_fetch_array($sql_issuetblg2pack);
			$sql_crop_new2pack=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2pack['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2pack=mysqli_fetch_array($sql_crop_new2pack);
			
			$varchkpack=$row_crop_new2pack['cropname']."-"."Coded";
			$varchk2pack=$row_crop_new2pack['cropname']."-"."Unidentified";
			$vartypack="";
			if($row_issuetblg_new2pack['lotldg_variety']!=$varchkpack && $row_issuetblg_new2pack['lotldg_variety']!=$varchk2pack)
			{		
				$sql_veriety2pack=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2pack['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
				$row_variety2pack=mysqli_fetch_array($sql_veriety2pack);
				$vartypack=$row_variety2pack['popularname'];
			}
			else
			{
				$vartypack=$row_issuetblg_new2pack['lotldg_variety'];
			}	
	
			$details="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2pack['cropname'].", ".$vartypack.", ".$row_issuetblg_new2pack['lotldg_sstage'].", ".$detailspack;}
		}

		else
		{	
			if($pflg==0)
			$tpflg=0;
			
			$s_goodpack=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and plantcode='$plantcode' ") or die(mysqli_error($link));
			//$s_good=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety!='".$b."'") or die(mysqli_error($link));
			//echo $r_good=mysqli_num_rows($s_good);
			$cnt=0;$sapack='';
			while($row_issuegpack=mysqli_fetch_array($s_goodpack))
			{ 
			
				$sql_lotpack=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
				while($row_lotpack=mysqli_fetch_array($sql_lotpack))
				{ 
				
					$sql_issueg1pack=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$a."' and lotldg_variety='".$row_issuegpack['lotldg_variety']."' and lotno='".$row_lotpack['lotno']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
					$row_issueg1pack=mysqli_fetch_array($sql_issueg1pack); 
					
					$sql_issuetblgpack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1pack[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
					$totnopack=mysqli_num_rows($sql_issuetblgpack);
				
					//$t_good=mysqli_num_rows($s_good);
					
					if($totnopack > 0)
					{	
						
						$zx_goodpack=mysqli_fetch_array($sql_issuetblgpack);
						$sapack=$zx_goodpack['lotdgp_id'];
						//$tpflg=1;
					}
				} 
			}
			
			
			$sql_issuetblg2pack=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$sapack."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));  
			$row_issuetblg_new2pack=mysqli_fetch_array($sql_issuetblg2pack);
			$sql_crop_new2pack=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new2pack['lotldg_crop']."'") or die(mysqli_error($link));
			$row_crop_new2pack=mysqli_fetch_array($sql_crop_new2pack);
			
			$varchkpack=$row_crop_new2pack['cropname']."-"."Coded";
			$varchk2pack=$row_crop_new2pack['cropname']."-"."Unidentified";
			$vartypack="";
			if($row_issuetblg_new2pack['lotldg_variety']!=$varchkpack && $row_issuetblg_new2pack['lotldg_variety']!=$varchk2pack)
			{		
				$sql_veriety2pack=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new2pack['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
				$row_variety2pack=mysqli_fetch_array($sql_veriety2pack);
				$vartypack=$row_variety2pack['popularname'];
			}
			else
			{
				$vartypack=$row_issuetblg_new2pack['lotldg_variety'];
			}	
	
			$detailspack="";
			if($existview=="Empty" || $existview==""){$existview=$row_crop_new2pack['cropname'].", ".$vartypack.", ".$row_issuetblg_new2pack['lotldg_sstage'].", ".$detailspack;}
		}
}


if($existview==", , , " )$existview="Empty";

//echo $existview;

//echo $trflg;
//echo $tpflg;
//echo $tflg;
//echo $tpmflg;
?>
<?php
if($trflg==1)
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse;">		
<tr>
<td  valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
<td align="center" valign="middle" class="smalltblheading">Bin is occupied by different Variety</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
else if($tpflg==1)
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse;">		
<tr>
<td  valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
<td align="center" valign="middle" class="smalltblheading">Bin is occupied by different Variety</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
elseif($tflg == 1)
{ if($existview=="Empty")$existview="";
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
<td align="center"  valign="middle" class="smalltblheading">Seed Stage is not matching.</td>
<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
elseif($tpmflg == 1)
{ if($existview=="Empty")$existview="";
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
<td align="center"  valign="middle" class="smalltblheading">Seed Stage is not matching.</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value=""  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="" />
</tr></table>
<?php
}
else
{
?><table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
<tr>
<td  valign="middle" width="110" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)"  value=""  onchange="<?php echo $u;?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"   value="<?php echo $h;?>"  onchange="<?php echo $q;?>"  onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php }?>