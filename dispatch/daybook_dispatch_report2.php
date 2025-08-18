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
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$txtstate = $_REQUEST['txtstate'];
	$txtloc = $_REQUEST['txtloc'];
	$txtparty = $_REQUEST['txtparty'];
	/*$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtlotno = $_REQUEST['txtlotno'];
	$txtupsdc = $_REQUEST['txtupsdc'];*/
	$txtdisptype = $_REQUEST['txtdisptype'];
?>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<title>Dispatch - Report - Periodical Dispatch Report - DC wise</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_dbdr.php?sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtstate=<?php echo $_REQUEST['txtstate']?>&txtloc=<?php echo $_REQUEST['txtloc']?>&txtparty=<?php echo $_REQUEST['txtparty']?>&txtdisptype=<?php echo $_REQUEST['txtdisptype']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php

	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$txtstate = $_REQUEST['txtstate'];
	$txtloc = $_REQUEST['txtloc'];
	$txtparty = $_REQUEST['txtparty'];
	/*$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtlotno = $_REQUEST['txtlotno'];
	$txtupsdc = $_REQUEST['txtupsdc'];*/
	$txtdisptype = $_REQUEST['txtdisptype'];
 	if($txtdisptype=="C" || $txtdisptype=="CandF" || $txtdisptype=="CnF")	{$txtdisptype="C&F";}
  
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL"; $locname="ALL"; $partyname="ALL"; $totnqty=0; $totnomp=0;
	
	if($txtloc!="ALL")
	{	
		if($txtdisptype=="Export Buyer")
		{
			$locname=$txtloc;
		}
		else
		{
			$sql_var=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtloc."'") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sql_var);
			$locname=$row_var['productionlocation'];
		}
	}
	if($txtparty!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$partyname=$row_var['business_name'];
	}
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Periodical Dispatch Report - DC wise</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?>&nbsp;&nbsp;|&nbsp;&nbsp;State: <?php echo $txtstate;?>&nbsp;&nbsp;|&nbsp;&nbsp;Location: <?php echo $locname;?>&nbsp;&nbsp;|&nbsp;&nbsp;Party Name: <?php echo $partyname;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="23" align="center" valign="middle" class="smalltblheading">#</td>	  
	<td width="80" align="center" valign="middle" class="smalltblheading">Dispatch Date</td>
	<td width="98" align="center" valign="middle" class="smalltblheading">DC No.</td>
	<td width="227" align="center" valign="middle" class="smalltblheading">Party Name</td>
	<td width="90" align="center" valign="middle" class="smalltblheading">Location</td>
	<td width="90" align="center" valign="middle" class="smalltblheading">State</td>
	<td width="155" align="center" valign="middle" class="smalltblheading">Dispatch Type</td>
	<td width="85" align="center" valign="middle" class="smalltblheading">Transport Name</td>
	<td width="82" align="center" valign="middle" class="smalltblheading">Vehicle No.</td>
	<td width="82" align="center" valign="middle" class="smalltblheading">LR No.</td>
	<!--<td width="94" align="center" valign="middle" class="smalltblheading">Lot No.</td>-->
	<td width="65" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="50" align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="164" align="center" valign="middle" class="smalltblheading">Gross Weight</td>
	<!-- <td width="50" align="center" valign="middle" class="smalltblheading">Output</td>-->
</tr>
<?php
$srno=1; $cnt=0;
	// Dispatch table with party Type as All
	if($txtdisptype!="ALL")
		$sqdm="select * from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$sdt' and disp_dodc<='$edt' and disp_tflg=1 and disp_partytype='$txtdisptype'  ";
	else
		$sqdm="select * from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$sdt' and disp_dodc<='$edt' and disp_tflg=1  ";
	if($txtstate!="ALL")
		$sqdm.=" and disp_state='$txtstate' ";
	if($txtloc!="ALL")
		$sqdm.=" and disp_location='$txtloc' ";
	if($txtparty!="ALL")
		$sqdm.=" and disp_party='$txtparty' ";
			
	$sqdm.=" order by disp_partytype asc, disp_dodc asc";
	$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($rowdispm=mysqli_fetch_array($sql_istbl))
		{
			$trdate=''; $state=''; $disptype=''; $dcno='';	$xc=0; $lotno=''; $ups=''; $nqty=0; $nomp=0; $grwt=0; $trasname=''; $vehno=''; $lrno='';
			$sqlis="select sum(dpss_qty), sum(dpss_grosswt) from tbl_dispsub_sub where plantcode='".$plantcode."' and disp_id='".$rowdispm['disp_id']."'";
			$sqlis.=" order by disp_id asc";
			$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$qt=$row_is[0]; 
				if($qt<0)$qt=0;
				$xc=$xc+$qt;
				$grwt=$grwt+$row_is[1]; 
			}
			$sqlis1="select distinct dpss_barcode from tbl_dispsub_sub where plantcode='".$plantcode."' and disp_id='".$rowdispm['disp_id']."' ";
			$sql_is1=mysqli_query($link,$sqlis1) or die(mysqli_error($link));
			while($row_is1=mysqli_fetch_array($sql_is1))
			{ 
				$nomp=$nomp+1;
			}		
			$tdate=$rowdispm['disp_dodc'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$trdate=$tday."-".$tmonth."-".$tyear;
				
			$state=$rowdispm['disp_state'];
			$disptype=$rowdispm['disp_partytype'];
			$nqty=$xc;
				
			$ptype=$rowdispm['disp_partytype'];
			
			if($rowdispm['tmode']=="Transport") { $trasname=$rowdispm['trans_name']; }  else if($rowdispm['tmode']=="Courier") { $trasname=$rowdispm['courier_name']; } else if($rowdispm['tmode']=="By Hand") { $trasname=$rowdispm['pname_byhand']; }  else { $trasname=""; }
	 		if($rowdispm['tmode']=="Transport"){$vehno=$rowdispm['trans_vehno'];} else if($rowdispm['tmode']=="Courier"){$vehno=$rowdispm['docket_no'];} else if($rowdispm['tmode']=="By Hand"){$vehno="";} else{$vehno="";}
			if($rowdispm['tmode']=="Transport"){$lrno=$rowdispm['trans_lorryrepno'];} else if($rowdispm['tmode']=="Courier"){$lrno="";} else if($rowdispm['tmode']=="By Hand"){$lrno="";} else{$lrno="";}
	
			//$trasname=$rowdispm['trans_name'];
			//$vehno=$rowdispm['trans_vehno']; 
			//$lrno=$rowdispm['trans_lorryrepno'];
					
			if($ptype=="Dealer" || $ptype=="Export Buyer")
			{
				$ntitle="Pack Seed Dispatch Note (PSDN)";
				$ntyps="PSDN";
			}
			if($ptype=="C&F" || $ptype=="Branch")
			{
				$ntitle="Stock Transfer Dispatch Note (STDN)";
				$ntyps="STDN";
			}			
								
			$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
			$noticia3 = mysqli_fetch_array($quer3);
			$ycode=$noticia3['ycode'];
							
			$sql_code1="SELECT * FROM tbl_dispnote where dnote_trid='".$rowdispm['disp_id']."' and dnote_trtype='Dispatch Pack Seed' and dnote_ptype='$ptype'";
			$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			$row_code1=mysqli_fetch_array($res_code1);
						
			$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
			$row_param=mysqli_fetch_array($sql_param);
						
			if($ptype=="Dealer" || $ptype=="Export Buyer")
				$dcno=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."SD"."/".sprintf("%004d",$row_code1['dnote_code']);
			else
				$dcno=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."ST"."/".sprintf("%004d",$row_code1['dnote_code']);
			//$dcno=$row_param['code']."/"."SD"."/".$ycode."/".$row_code1['dnote_code'];		
						
					
			$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['disp_party']."' order by business_name")or die(mysqli_error($link));
			$noticia = mysqli_fetch_array($sql_month24);
			$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
			$noticia240 = mysqli_fetch_array($sql_month240);
			$locn=$noticia240['productionlocation'];
			if($disptype=="Export Buyer")
				$locn=$rowdispm['disp_location'];
						
			if($disptype=="Dealer")$disptype="Sales";
			if($disptype=="C&F")$disptype="Stock Transfer(Branch & C&F)";
			if($disptype=="Branch")$disptype="Stock Transfer(Branch & C&F)";
			if($disptype=="Export Buyer")$disptype="Export (Buyer)";
if($nqty>0)						
{						
$cnt++; $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp; $totgrtotal=$totgrtotal+$grwt;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trasname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vehno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grwt;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
//}
	

	// Dispatch  BULK table with party Type as All
			
	if($txtdisptype!="ALL")
		$sqdm2="select * from tbl_dbulk where plantcode='".$plantcode."' and dbulk_date>='$sdt' and dbulk_date<='$edt' and dbulk_tflg=1 and dbulk_partytype='$txtdisptype'  ";
	else
		$sqdm2="select * from tbl_dbulk where plantcode='".$plantcode."' and dbulk_date>='$sdt' and dbulk_date<='$edt' and dbulk_tflg=1  ";
			
	if($txtstate!="ALL")
		$sqdm2.=" and dbulk_state='$txtstate' ";
	if($txtloc!="ALL")
		$sqdm2.=" and dbulk_location='$txtloc' ";
	if($txtparty!="ALL")
		$sqdm2.=" and dbulk_party='$txtparty' ";
			
			
	$sqdm2.=" order by dbulk_partytype asc, dbulk_date asc";
	$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
			
	$t2=mysqli_num_rows($sql_istbl2);
	if($t2 > 0)
	{
		while($rowdispm2=mysqli_fetch_array($sql_istbl2))
		{
			$trdate=''; $state=''; $disptype=''; $dcno='';	$xc=0; $lotno=''; $ups=''; $nqty=0; $nomp=0; $grwt=''; $trasname=''; $vehno=''; $lrno='';
			$sqlis2="select sum(dbss_qty), sum(dbss_nob) from tbl_dbulksub_sub where plantcode='".$plantcode."' and dbulk_id='".$rowdispm2['dbulk_id']."' ";
			$sqlis2.=" order by dbulk_id asc";
			$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
			while($row_is2=mysqli_fetch_array($sql_is2))
			{ 
				$qt=$row_is2[0]; 
				if($qt<0)$qt=0;
				$xc=$xc+$qt;
				$nomp=$nomp+$row_is2[1]; 
			}		
					
			$tdate=$rowdispm2['dbulk_date'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$trdate=$tday."-".$tmonth."-".$tyear;
				
			$state=$rowdispm2['dbulk_state'];
			$disptype=$rowdispm2['dbulk_partytype'];
			$nqty=$xc;
							
			$ptype=$rowdispm2['dbulk_partytype'];
			
			if($rowdispm2['tmode']=="Transport") { $trasname=$rowdispm2['trans_name']; }  else if($rowdispm2['tmode']=="Courier") { $trasname=$rowdispm2['courier_name']; } else if($rowdispm2['tmode']=="By Hand") { $trasname=$rowdispm2['pname_byhand']; }  else { $trasname=""; }
	 		if($rowdispm2['tmode']=="Transport"){$vehno=$rowdispm2['trans_vehno'];} else if($rowdispm2['tmode']=="Courier"){$vehno=$rowdispm2['docket_no'];} else if($rowdispm2['tmode']=="By Hand"){$vehno="";} else{$vehno="";}
			if($rowdispm2['tmode']=="Transport"){$lrno=$rowdispm2['trans_lorryrepno'];} else if($rowdispm2['tmode']=="Courier"){$lrno="";} else if($rowdispm2['tmode']=="By Hand"){$lrno="";} else{$lrno="";}
	
			//$trasname=$rowdispm['trans_name'];
			//$vehno=$rowdispm['trans_vehno']; 
			//$lrno=$rowdispm['trans_lorryrepno'];
							
			$ntyps="BSDN";
										
								
			$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and dnote_trid='".$rowdispm2['dbulk_id']."' and dnote_trtype='Dispatch Bulk Seed' and dnote_ptype='$ptype'";
			$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			$row_code1=mysqli_fetch_array($res_code1);
						
			$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
			$row_param=mysqli_fetch_array($sql_param);
							
			$dcno=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."BD"."/".sprintf("%004d",$row_code1['dnote_code']);
			//$dcno=$row_param['code']."/"."SD"."/".$rowdispm2['dbulk_yearcode']."/".$row_code1['dnote_code'];
							
			$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['dbulk_party']."' order by business_name")or die(mysqli_error($link));
			$noticia = mysqli_fetch_array($sql_month24);
							
			$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
			$noticia240 = mysqli_fetch_array($sql_month240);
			$sql_arhome=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_trid='".$rowdispm2['dbulk_id']."' and lotldg_trtype='Dispatch Bulk' ") or die(mysqli_error($link));
			$row_arhome=mysqli_fetch_array($sql_arhome);
			$ups=$row_arhome['lotldg_sstage'];
							
			$locn=$noticia240['productionlocation'];
			if($disptype=="Export Buyer")
			$locn=$rowdispm2['dbulk_location'];
							
			if($disptype=="Dealer")$disptype="Sales";
			if($disptype=="C&F")$disptype="Stock Transfer(Branch & C&F)";
			if($disptype=="Branch")$disptype="Stock Transfer(Branch & C&F)";
			if($disptype=="Export Buyer")$disptype="Export (Buyer)";
if($nqty>0)						
{							
$cnt++; $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp; $totgrtotal=$totgrtotal+0;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trasname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vehno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grwt;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
//}
//}


	// Pack Seed Release Table  with party Type as All
	if($txtdisptype!="ALL")	
		$sqdm2="select * from tbl_pswrem where plantcode='".$plantcode."' and pswrem_date>='$sdt' and pswrem_date<='$edt' and pswrem_ptype='$txtdisptype'  ";
	else
		$sqdm2="select * from tbl_pswrem where plantcode='".$plantcode."' and pswrem_date>='$sdt' and pswrem_date<='$edt'";
	if($txtstate!="ALL")
		$sqdm2.=" and pswrem_state='$txtstate' ";
	if($txtloc!="ALL")
		$sqdm2.=" and pswrem_location='$txtloc' ";
	if($txtparty!="ALL")
		$sqdm2.=" and pswrem_party='$txtparty' ";
			
	$sqdm2.=" order by pswrem_ptype asc, pswrem_date asc";
	//echo $sqdm2."<br />";
	$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
			
	$t2=mysqli_num_rows($sql_istbl2);
	if($t2 > 0)
	{
		while($rowdispm2=mysqli_fetch_array($sql_istbl2))
		{
			$trdate=''; $state=''; $disptype=''; $dcno=''; $xc=0; $lotno=''; $ups=''; $nqty=0;  $nomp=0; $grwt=''; $trasname=''; $vehno=''; $lrno='';
					 
			$sqlis12="select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_id='".$rowdispm2['pswrem_id']."' and trtype='Qty-Rem' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' ";
						
			$sql_is12=mysqli_query($link,$sqlis12) or die(mysqli_error($link));
			while($row_is12=mysqli_fetch_array($sql_is12))
			{ 
				
				$sqlis2="select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_id='".$rowdispm2['pswrem_id']."' and lotno='".$row_is12['lotno']."'  and trtype='Qty-Rem' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' ";
							
				$sqlis2.=" order by lotdgp_id asc";
				$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
				while($row_is2=mysqli_fetch_array($sql_is2))
				{ 
					$qt=$row_is2['tqty']; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
						
					$nomp=$nomp+$row_is2['nomp']; 
					$ups=$row_is2['packtype']; 
				}
			}			
			$tdate=$rowdispm2['pswrem_date'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$trdate=$tday."-".$tmonth."-".$tyear;
							
			$state=$rowdispm2['pswrem_state'];
							
			$disptype=$rowdispm2['pswrem_ptype'];
			$nqty=$xc;
							
			$ptype=$rowdispm2['pswrem_ptype'];
							
										
			$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
			$row_param=mysqli_fetch_array($sql_param);
							
			$dcno="CR".$rowdispm2['pswrem_code']."/".$rowdispm2['yearcode']."/".$rowdispm2['logid'];
							
			$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['pswrem_party']."' order by business_name")or die(mysqli_error($link));
			$noticia = mysqli_fetch_array($sql_month24);
							
			if($state=="")$state=$noticia['state'];
			$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
			$noticia240 = mysqli_fetch_array($sql_month240);
						
			if($disptype=="Dealer")$disptype="Sales";
			if($disptype=="C&F")$disptype="Stock Transfer(Branch & C&F)";
			if($disptype=="Branch")$disptype="Stock Transfer(Branch & C&F)";
			if($disptype=="Export Buyer")$disptype="Export (Buyer)";
			if($disptype=="")$disptype="Pack Seed Release";
if($nqty>0)						
{							
$cnt++;	 $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp;	 $totgrtotal=$totgrtotal+0;					
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trasname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vehno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grwt;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}	
//}		


	// Stock Transfer Out table with party Type as All
	if($txtdisptype=="ALL" || $txtdisptype=="Stock Transfer-Plant")	
	{
		$sqdm="select * from tbl_stoutm where plantcode='".$plantcode."' and stoutm_date>='$sdt' and stoutm_date<='$edt' and stoutm_tflg=1  ";
			
		/*if($txtstate!="ALL")
			$sqdm.=" and disp_state='$txtstate' ";
		if($txtloc!="ALL")
			$sqdm.=" and disp_location='$txtloc' ";*/
		if($txtparty!="ALL")
			$sqdm.=" and stoutm_plant='$txtparty' ";
			
			
		$sqdm.=" order by stoutm_date asc";
		$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
		$t=mysqli_num_rows($sql_istbl);
		if($t > 0)
		{
			while($rowdispm=mysqli_fetch_array($sql_istbl))
			{
				$trdate=''; $state=''; $disptype=''; $dcno=''; $xc=0; $lotno=''; $ups=''; $nqty=0; $nomp=0; $grwt=''; $trasname=''; $vehno=''; $lrno='';
				$sqlis="select sum(stouts_qty), sum(stouts_nob) from tbl_stouts where plantcode='".$plantcode."' and stoutm_id='".$rowdispm['stoutm_id']."'  ";
				$sqlis.=" order by stoutm_id asc";
				$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$qt=$row_is[0]; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
							
					$nomp=$nomp+$row_is[1]; 
				}	

				$tdate=$rowdispm['stoutm_date'];
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$trdate=$tday."-".$tmonth."-".$tyear;
						
				$disptype="Stock Transfer-(Plant)";
				
				if($rowdispm['tmode']=="Transport") { $trasname=$rowdispm['trans_name']; }  else if($rowdispm['tmode']=="Courier") { $trasname=$rowdispm['courier_name']; } else if($rowdispm['tmode']=="By Hand") { $trasname=$rowdispm['pname_byhand']; }  else { $trasname=""; }
	 		if($rowdispm['tmode']=="Transport"){$vehno=$rowdispm['trans_vehno'];} else if($rowdispm['tmode']=="Courier"){$vehno=$rowdispm['docket_no'];} else if($rowdispm['tmode']=="By Hand"){$vehno="";} else{$vehno="";}
			if($rowdispm['tmode']=="Transport"){$lrno=$rowdispm['trans_lorryrepno'];} else if($rowdispm['tmode']=="Courier"){$lrno="";} else if($rowdispm['tmode']=="By Hand"){$lrno="";} else{$lrno="";}
	
				//$trasname=$rowdispm['trans_name'];
				//$vehno=$rowdispm['trans_vehno']; 
				//$lrno=$rowdispm['trans_lorryrepno'];
				
				$nqty=$xc;
						
				$dcno="DS".$rowdispm['stoutm_code']."/".$rowdispm['stoutm_yearid']."/".$rowdispm['stoutm_logid'];		
						
				$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['stoutm_plant']."' order by business_name")or die(mysqli_error($link));
				$noticia = mysqli_fetch_array($sql_month24);
				$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
				$noticia240 = mysqli_fetch_array($sql_month240);
				$state=$noticia['state'];
						
				if($txtstate!="ALL" && $txtstate!=$noticia['state'])
					$nqty=0;
				else if($txtloc!="ALL" && $txtloc!=$noticia['location_id'])
					$nqty=0;

if($nqty>0)						
{
$cnt++; $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp; $totgrtotal=$totgrtotal+0;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trasname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vehno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grwt;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
//}

/*


	// Stock Transfer Out table with party Type as All
	if($txtdisptype=="ALL" || $txtdisptype=="Stock Transfer-Plant")	
	{
		$sqdm="select * from tbl_stoutmpack where stoutmp_date>='$sdt' and stoutmp_date<='$edt' and stoutmp_tflg=1  ";
			

		if($txtparty!="ALL")
			$sqdm.=" and stoutmp_plant='$txtparty' ";
			
			
		$sqdm.=" order by stoutmp_date asc";
		$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
		$t=mysqli_num_rows($sql_istbl);
		if($t > 0)
		{
			while($rowdispm=mysqli_fetch_array($sql_istbl))
			{
				$trdate=''; $state=''; $disptype=''; $dcno='';
				$xc=0; $lotno=''; $ups=''; $nqty=0; $nomp=0;
				$sqlis="select sum(stoutsp_loadqty) from tbl_stoutspack where stoutmp_id='".$rowdispm['stoutmp_id']."'  ";
				$sqlis.=" order by stoutmp_id asc";
				$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$qt=$row_is[0]; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
							
					$nomp=$nomp+$row_is[1]; 
				}	

				$tdate=$rowdispm['stoutmp_date'];
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$trdate=$tday."-".$tmonth."-".$tyear;
						
				$disptype="Stock Transfer Out-Pack";
				$nqty=$xc;
						
				$dcno="DS".$rowdispm['stoutmp_code']."/".$rowdispm['stoutmp_yearid']."/".$rowdispm['stoutmp_logid'];		
						
				$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['stoutmp_plantid']."' order by business_name")or die(mysqli_error($link));
				$noticia = mysqli_fetch_array($sql_month24);
				$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
				$noticia240 = mysqli_fetch_array($sql_month240);
				$state=$noticia['state'];
						
				

if($nqty>0)						
{
$cnt++; $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="daybook_dispatch_report_output.php?p_id=<?php echo $rowdispm['stoutm_id']; ?>&optyp=stout" target="_blank">Output</a></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
//}

*/
	// TDF Dispatch table with party Type as All
	if($txtdisptype=="ALL" || $txtdisptype=="TDF - Individual")	
	{
		$sqdm2="select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_date>='$sdt' and dtdf_date<='$edt' and dtdf_tflg=1  ";
		if($txtstate!="ALL")
			$sqdm2.=" and dtdf_state='$txtstate' ";
		if($txtloc!="ALL")
			$sqdm2.=" and dtdf_location='$txtloc' ";
		if($txtparty!="ALL")
			$sqdm2.=" and dtdf_party='$txtparty' ";
			
			
		$sqdm2.=" order by dtdf_partytype asc, dtdf_id asc";
		$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
			
		$t2=mysqli_num_rows($sql_istbl2);
		if($t2 > 0)
		{
			while($rowdispm2=mysqli_fetch_array($sql_istbl2))
			{
				$trdate=''; $state=''; $disptype=''; $dcno=''; $xc=0; $lotno=''; $ups=''; $nqty=0; $nomp=0; $grwt=0; $trasname=''; $vehno=''; $lrno='';
				$sqlis2="select sum(dbss_qty), sum(dbss_nob) from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='".$rowdispm2['dtdf_id']."' ";
				$sqlis2.=" order by dtdf_id asc";
				$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
				while($row_is2=mysqli_fetch_array($sql_is2))
				{ 
					$qt=$row_is2[0]; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
					
					$nomp=$nomp+$row_is2[1]; 
				}	
				
				$sqlis12="select sum(dmmc_grosswt) from tbl_dtdfmmc where dtdf_id='".$rowdispm2['dtdf_id']."' ";
				$sqlis12.=" order by dtdf_id asc";
				$sql_is12=mysqli_query($link,$sqlis12) or die(mysqli_error($link));
				while($row_is12=mysqli_fetch_array($sql_is12))
				{ 
					$grwt=$grwt+$row_is12[0]; 
				}	
					
				$tdate=$rowdispm2['dtdf_date'];
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$trdate=$tday."-".$tmonth."-".$tyear;
							
				$state=$rowdispm2['dtdf_state'];
				$disptype=$rowdispm2['dtdf_partytype'];
				
				if($rowdispm2['tmode']=="Transport") { $trasname=$rowdispm2['trans_name']; }  else if($rowdispm2['tmode']=="Courier") { $trasname=$rowdispm2['courier_name']; } else if($rowdispm2['tmode']=="By Hand") { $trasname=$rowdispm2['pname_byhand']; }  else { $trasname=""; }
	 		if($rowdispm2['tmode']=="Transport"){$vehno=$rowdispm2['trans_vehno'];} else if($rowdispm2['tmode']=="Courier"){$vehno=$rowdispm2['docket_no'];} else if($rowdispm2['tmode']=="By Hand"){$vehno="";} else{$vehno="";}
			if($rowdispm2['tmode']=="Transport"){$lrno=$rowdispm2['trans_lorryrepno'];} else if($rowdispm2['tmode']=="Courier"){$lrno="";} else if($rowdispm2['tmode']=="By Hand"){$lrno="";} else{$lrno="";}
	
				//$trasname=$rowdispm['trans_name'];
				//$vehno=$rowdispm['trans_vehno']; 
				//$lrno=$rowdispm['trans_lorryrepno'];
				//$trasname=$rowdispm2['trans_name'];
				//$vehno=$rowdispm2['trans_vehno']; 
				//$lrno=$rowdispm2['trans_lorryrepno'];
				
				$nqty=$xc;
							
				$ptype=$rowdispm2['dtdf_partytype'];
						
				$ntyps="TDFSDN";
										
				$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and dnote_trid='".$rowdispm2['dtdf_id']."' and dnote_trtype='Dispatch TDF Seed'";
				$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
				$row_code1=mysqli_fetch_array($res_code1);
							
				$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
				$row_param=mysqli_fetch_array($sql_param);
							
				$dcno=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."TD"."/".$row_code1['dnote_code'];
							
				$bsname=""; $bslocation="";
				//echo	"select * from tbl_partymaser where p_id='".$rowdispm2['dtdf_party']."' order by business_name";
				$sql_qc=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['dtdf_party']."' order by business_name");
				$tt=mysqli_num_rows($sql_qc);
				if($tt==0)
				{
					$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$rowdispm2['dtdf_party']."' and orderm_holdflag=0 and orderm_dispatchflag!=1 and orderm_cancelflag!=1")or die("Error:".mysqli_error($link));
					$row_month=mysqli_fetch_array($sql_month);
					$bsname=$row_month['orderm_partyname'];
					$bslocation=$row_month['orderm_partycity'];
					$state=$row_month['orderm_partystate'];
				}
				else
				{
					
					$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['dtdf_party']."' order by business_name")or die(mysqli_error($link));
					$noticia = mysqli_fetch_array($sql_month24);
								
					$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
					$noticia240 = mysqli_fetch_array($sql_month240);
					$bsname=$noticia['business_name']; 
					$bslocation=$noticia240['productionlocation'];
					$state=$noticia240['state'];
				}
				$disptype="TDF - Individual";
if($nqty>0)						
{							
$cnt++; $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp; $totgrtotal=$totgrtotal+$grwt;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bsname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bslocation;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trasname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vehno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grwt;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
//}	
//}

	// Discard table with party Type as All
			
	if($txtdisptype=="ALL" || $txtdisptype=="Discard")
	{	
		$sqdm="select * from tbl_discard where plantcode='".$plantcode."' and tdate>='$sdt' and tdate<='$edt' and ddflg=1  ";
		if($txtstate!="ALL")
			$sqdm.=" and state='$txtstate' ";
			
		if($txtparty!="ALL")
		{
			$sqlmonth24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."' order by business_name")or die(mysqli_error($link));
			$noticia24 = mysqli_fetch_array($sqlmonth24);
			$pname=$noticia24['business_name'];
			$sqdm.=" and party_name='$pname' ";
		}
		if($txtloc!="ALL")
		{
			$sqlmonth240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
			$noticia20 = mysqli_fetch_array($sqlmonth240);
			$ploc=$noticia20['productionlocation'];
			$sqdm.=" and city='$ploc' ";
		}	
			
		$sqdm.=" order by tdate asc";
		$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
		$t=mysqli_num_rows($sql_istbl);
		if($t > 0)
		{
			while($rowdispm=mysqli_fetch_array($sql_istbl))
			{
				$trdate=''; $state=''; $disptype=''; $dcno=''; $xc=0; $lotno=''; $ups=0; $nqty=0; $nomp=0; $grwt=''; $trasname=''; $vehno=''; $lrno='';
				$sqlis="select SUM(qty), SUM(ups) from tbl_discard_sub where plantcode='".$plantcode."' and did_s='".$rowdispm['tid']."' ";
				$sqlis.=" order by did_s asc";
				$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$qt=$row_is[0]; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
							
					$nomp=$nomp+$row_is[1]; 
				}
					
				$tdate=$rowdispm['tdate'];
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$trdate=$tday."-".$tmonth."-".$tyear;
						
				$state=$rowdispm['state'];
				$disptype="Discard";
				$trasname=$rowdispm['tname'];
				$vehno=$rowdispm['vno']; 
				$lrno=$rowdispm['lrno'];
				
				$nqty=$xc;
						
				$ptype="Discard";
				$ntyps="MDN";
									
				$dcno="MD".$rowdispm['dd_code']."/".$rowdispm['yearcode']."/".$rowdispm['ncode'];		
if($nqty>0)						
{						
$cnt++;	 $totnqty=$totnqty+$nqty; $totnomp=$totnomp+$nomp;	$totgrtotal=$totgrtotal+$grwt;				
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowdispm['party_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowdispm['city'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trasname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vehno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grwt;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
if($totnqty>0)
{
?>
<tr class="Light">
	<td align="right" valign="middle" class="smalltblheading" colspan="10">Grand Total&nbsp;</td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $totnqty;?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $totnomp;?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $totgrtotal;?></td>
</tr>
<?php
}
if($cnt==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" colspan="10">No Record Found</td>
</tr>
<?php
}
?>
</table>

			
 
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_dbdr.php?sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtstate=<?php echo $_REQUEST['txtstate']?>&txtloc=<?php echo $_REQUEST['txtloc']?>&txtparty=<?php echo $_REQUEST['txtparty']?>&txtdisptype=<?php echo $_REQUEST['txtdisptype']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>