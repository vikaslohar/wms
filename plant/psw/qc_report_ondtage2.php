<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
	echo '</script>';
	}*/
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
  	$edate = $_REQUEST['edate'];
 	$itemid = $_REQUEST['txtcrop'];
	$vv= $_REQUEST['txtvariety'];
	$result = $_REQUEST['result'];
	$dotage = $_REQUEST['dotage'];
	$seedstage = $_REQUEST['sstage'];
	$durtyp = $_REQUEST['durtyp'];
	$fillagetyp = $_REQUEST['fillagetyp'];
	$totdays = $_REQUEST['totdays'];
	
	 if(isset($_GET['print']))
	{
	 $print = $_GET['print'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
	 
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	}

?>

<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Quality-Report QC Ageing Status Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-qcondtage.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>&dotage=<?php echo $_REQUEST['dotage'];?>&sstage=<?php echo $_REQUEST['sstage'];?>&durtyp=<?php echo $_REQUEST['durtyp'];?>&fillagetyp=<?php echo $_REQUEST['fillagetyp'];?>&totdays=<?php echo $_REQUEST['totdays'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
  <br/>
<?php	
	$t=explode("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	
	$reslt="";
 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 
	
	$qry="select distinct lotldg_variety from tbl_lot_ldg where lotldg_qctestdate<='".$edate."' and lotldg_crop='".$itemid."' and plantcode='$plantcode'";
	
	
	if($vv!="ALL")
	{
		$qry.=" and lotldg_variety='".$vv."' ";
	}
	if($result!="ALL")	
	{
		$qry.=" and lotldg_qc='".$result."' ";
		$reslt=" and lotldg_qc='".$result."' ";
	}
	if($seedstage!="ALL")
	{
		$qry.=" and lotldg_sstage='".$seedstage."' ";
		$reslt=" and lotldg_sstage='".$seedstage."' ";
	}
	$qry.=" order by lotldg_variety asc,lotldg_qctestdate asc ";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	if($durtyp=="dsel")
	{
		$durations="ALL";
		if($dotage=="less45")
		$durations="Less than 45 days";
		if($dotage=="45-90")
		$durations="In-between 45 to 90 days";
		if($dotage=="more90")
		$durations="More than 90 days";
	}
	else if($durtyp=="dfill")
	{
		if($fillagetyp=="less")
		$durations="Less than $totdays days";
		if($fillagetyp=="equalto")
		$durations="Equal to $totdays days";
		if($fillagetyp=="more")
		$durations="More than $totdays days";
	}
	else
	{
		$durations="";
	}
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">QC Test Ageing Status Report as on Date: <?php echo $_GET['edate'];?></td>
</tr>
<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Duration since last QC Test: <?php echo $durations;?></td>
</tr>
</table>
<?php
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
	$row_dept=mysqli_fetch_array($quer2);
	$cropname=$row_dept['cropname'];
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home1['lotldg_variety']."'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$tt=$rowvv['popularname'];
	$tot=mysqli_num_rows($quer3);	
	if($tot==0)
	{
		$vvrt=$vv;
	}
	else
	{
		$vvrt=$tt;
	}
	$cont=0;
	$sql_arr_home244=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_qctestdate<='$edate' and lotldg_crop='".$itemid."'  and lotldg_variety='".$row_arr_home1['lotldg_variety']."' $reslt and plantcode='$plantcode' order by lotldg_variety asc, lotldg_qctestdate asc ") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_arr_home244);
	while($row_arr_home244=mysqli_fetch_array($sql_arr_home244))
	{
		//if($seedstage!="Pack")
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home244['lotldg_lotno']."' and plantcode='$plantcode' order by lotldg_subbinid") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{$total_tbl=0;
				$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home244['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
				
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));
				$total_tbl=mysqli_num_rows($sql1);
				if($total_tbl > 0)
				{
					$flg=0;$qty=0;
					$row_tbl_sub=mysqli_fetch_array($sql1);
					$qty=$row_tbl_sub['lotldg_balqty'];
					$qcresult=$row_tbl_sub['lotldg_qc'];
					if($result!="ALL" && $result!=$qcresult)$flg++;	
					if($qcresult=="NUT")$flg++;	
					if(($qcresult=="OK") && $qty==0)$flg++;
					if($flg==0){$cont++;}
					
				}
			}
		}
		//else
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$row_arr_home244['lotldg_lotno']."' and plantcode='$plantcode' order by subbinid") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{$total_tbl=0;
				$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home244['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
				
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));
				$total_tbl=mysqli_num_rows($sql1);
				if($total_tbl > 0)
				{
					$flg=0;$qty=0;
					$row_tbl_sub=mysqli_fetch_array($sql1);
					$qty=$row_tbl_sub['balqty'];
					$qcresult=$row_tbl_sub['lotldg_qc'];
					if($result!="ALL" && $result!=$qcresult)$flg++;	
					if($qcresult=="NUT")$flg++;	
					if(($qcresult=="OK") && $qty==0)$flg++;
					if($flg==0){$cont++;}
				}
			}
		}
		
	}

if($cont > 0)
{
$srno=1; $cnt=0;
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $cropname;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vvrt;?>&nbsp;</td>
  	</tr>
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="19" align="center" valign="middle" class="smalltblheading">#</td>
			<!--<td width="82"  align="center" valign="middle" class="smalltblheading">Crop</td>
			<td width="153"  align="center" valign="middle" class="smalltblheading">Variety</td>-->
			<td width="112"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
			<td width="42"  align="center" valign="middle" class="smalltblheading">NoB</td>
			<td width="51"  align="center" valign="middle" class="smalltblheading">Qty</td>
			<!--<td width="68"  align="center" valign="middle" class="smalltblheading">Stage</td>
			<td width="61" align="center" valign="middle" class="smalltblheading">PP</td>
			<td width="56" align="center" valign="middle" class="smalltblheading" >Moist %</td>-->
			<td width="49" align="center" valign="middle" class="smalltblheading" >Germ %</td>
			<td width="69" align="center" valign="middle" class="smalltblheading">DOT</td>
            <td width="69" align="center" valign="middle" class="smalltblheading">No. of Days since DoT</td>
            <td width="62" align="center" valign="middle" class="smalltblheading">QC Status</td>
            <td width="62" align="center" valign="middle" class="smalltblheading">DOGR</td>
            <td width="62" align="center" valign="middle" class="smalltblheading">GOT Status</td>
			<td align="center" valign="middle" class="smalltblheading">SLOC</td>
</tr>

<?php
$sql_arr_home2=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_qctestdate<='$edate' and lotldg_crop='".$itemid."'  and lotldg_variety='".$row_arr_home1['lotldg_variety']."' $reslt and plantcode='$plantcode' order by lotldg_variety asc, lotldg_qctestdate asc ") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{

$sql_arr_home3=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where lotldg_qctestdate<='".$edate."' and lotldg_crop='".$itemid."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_lotno='".$row_arr_home2['lotldg_lotno']."' $reslt and plantcode='$plantcode' order by lotldg_variety asc, lotldg_qctestdate asc  ") or die(mysqli_error($link));
$row_arr_home3=mysqli_fetch_array($sql_arr_home3);

$sql_arr_home=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_arr_home3[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_qctestdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['lotldg_id'];
	
//echo $row_arr_home2['lotno']."<br />";	
	
	$flg=0;		
	$sups=0; $sqty=0; $sstage=""; $sloc="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home2['lotldg_lotno']."' and plantcode='$plantcode' order by lotldg_subbinid") or die(mysqli_error($link));
if(	 $t=mysqli_num_rows($sql_tbl_sub1) > 0)
{
	while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{	 
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home2['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo "  ".$row_tbl1[0]."  ";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);

$slups=0; $slqty=0;
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$row_tbl_sub['lotldg_balbags'];
	$slqty=$row_tbl_sub['lotldg_balqty'];
	
	$sups=$sups+$row_tbl_sub['lotldg_balbags'];
	$sqty=$sqty+$row_tbl_sub['lotldg_balqty'];
	
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	if($row_tbl_sub['lotldg_got']!="" && $row_tbl_sub['lotldg_got']!="NULL" && $row_tbl_sub['lotldg_got']!=" ")
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	else
	$gotresult=$gorr[0]." ".$gorr[1];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_tbl_sub['lotldg_balbags'];
 $slqty=$row_tbl_sub['lotldg_balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

$lotno=$row_arr_home['lotldg_lotno'];
$sstage=$row_arr_home['lotldg_sstage'];
if($got=="")
$got=$row_arr_home['lotldg_moisture'];
if($stage=="")
$stage=$row_arr_home['lotldg_gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['lotldg_qc'];

//echo $slups;


		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotldg_crop'];
		}
		else
		{
		 $crop=$row_arr_home['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotldg_variety'];
		}
		else
		{
		$variety=$row_arr_home['lotldg_variety'];	
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
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
}	
}
}
else
{
	$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$row_arr_home2['lotldg_lotno']."'  and plantcode='$plantcode' order by subbinid") or die(mysqli_error($link));
	while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{	 
	
	$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home2['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo "  ".$row_tbl1[0]."  ";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);

$slups=0; $slqty=0;
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$row_tbl_sub['balnop'];
	$slqty=$row_tbl_sub['balqty'];
	
	$sups=$sups+$row_tbl_sub['balnop'];
	$sqty=$sqty+$row_tbl_sub['balqty'];
	
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	if($row_tbl_sub['lotldg_got']!="" && $row_tbl_sub['lotldg_got']!="NULL" && $row_tbl_sub['lotldg_got']!=" ")
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	else
	$gotresult=$gorr[0]." ".$gorr[1];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['binid']."' and whid='".$row_tbl_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['subbinid']."' and binid='".$row_tbl_sub['binid']."' and whid='".$row_tbl_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_tbl_sub['balnop'];
 $slqty=$row_tbl_sub['balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

$lotno=$row_arr_home['lotldg_lotno'];
$sstage=$row_arr_home['trstage'];
if($got=="")
$got=$row_arr_home['lotldg_moisture'];
if($stage=="")
$stage=$row_arr_home['lotldg_gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['lotldg_qc'];

//echo $slups;


		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotldg_crop'];
		}
		else
		{
		 $crop=$row_arr_home['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotldg_variety'];
		}
		else
		{
		$variety=$row_arr_home['lotldg_variety'];	
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
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
}	
}
}
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['lotldg_variety']."'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['lotldg_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  

    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($result!="ALL" && $result!=$qcresult)$flg++;	
if($qcresult=="NUT")$flg++;	
if(($qcresult=="OK" || $qcresult=="Fail") && $qty==0)$flg++;

$trdate6=explode("-", $edate);
$tryear=$trdate6[0];
$trmonth=$trdate6[1];
$trday=$trdate6[2];
$trdate240=$tryear."-".$trmonth."-".$trday;

if($durtyp=="dfill")
{
	if($fillagetyp=="less")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']<$dt2)$flg++;
		}
	}
	else if($fillagetyp=="equalto")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']!=$dt2)$flg++;
		}
	}
	else if($fillagetyp=="more")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']>$dt2)$flg++;
		}
	}
	else
	{
	}
}
else
{
	if($dotage!="ALL" && $dotage=="less45")
	{
	$dt=45;
	if($trdate!="")
	{
	$m=$trmonth;
	$de=$trday;
	$y=$tryear;
	$dt22=$dt;
	if($dt!="")
	{
	for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
	}
	else
	$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
	if($row_arr_home['lotldg_qctestdate']<=$dt2)$flg++;
	}
	}
	else if($dotage!="ALL" && $dotage=="45-90")
	{
		$dt=45;
		$dt6=90;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		if($trdate!="")
		{
			$trdate5=explode("-", $edate);
			$tryear5=$trdate5[0];
			$trmonth5=$trdate5[1];
			$trday5=$trdate5[2];
			
			$m5=$trmonth5;
			$de5=$trday5;
			$y5=$tryear5;
			$dt222=$dt6;
			if($dt6!="")
			{
				for($j=1; $j<$dt222; $j++) { $dt24=date('Y-m-d',mktime(0,0,0,$m5,($de5-$j),$y5)); } 
			}
			else
			$dt24="";
		}
		//echo $dt2;
		if($dt2!="" && $dt24!="")
		{
			if($row_arr_home['lotldg_qctestdate']>=$dt2 || $row_arr_home['lotldg_qctestdate']<$dt24)$flg++;
		}
	}
	else if($dotage!="ALL" && $dotage=="more90")
	{
		$dt=90;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']>=$dt2)$flg++;
		}
	}
	else
	{
	}
}
//echo $dt2;
$diff = abs(strtotime($trdate240) - strtotime($row_arr_home['lotldg_qctestdate']));

//$years = floor($diff / (365*60*60*24));
//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor($diff / (60*60*24));

//printf("%d days\n", $days);
//echo $row_arr_home['lotldg_qctestdate']."  -  ".$dt2."  -  ".$dt24."<br />";
$days=$days;
$gotres=explode(" ", $gotresult);
if($gotres[1]=="Fail")$flg=1;
if($flg==0)
{$cnt++;

if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
		 <!--<td width="82" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname']?></td>
         <td width="153" align="center" valign="middle" class="smalltbltext"><?php echo $vv?></td>-->
		 <td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="42" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <!-- <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $sstage;?></td>
         <td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
         <td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>-->
         <td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $days;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
		<!-- <td width="82" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname']?></td>
         <td width="153" align="center" valign="middle" class="smalltbltext"><?php echo $vv?></td>-->
		 <td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="42" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <!--<td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $sstage;?></td>
         <td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
         <td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>-->
         <td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $days;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
        <td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
</tr>
<?php
}
$srno=$srno+1;
//}
}
}
}
if($cnt==0)
{
?>
<tr  height="25"><td colspan="15" align="center" class="subheading">No Records found for selected criteria.</td></tr>
<?php
}
?>
</table>
<?php
}
}
}
?>
  <br/>

<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-qcondtage.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>&dotage=<?php echo $_REQUEST['dotage'];?>&sstage=<?php echo $_REQUEST['sstage'];?>&durtyp=<?php echo $_REQUEST['durtyp'];?>&fillagetyp=<?php echo $_REQUEST['fillagetyp'];?>&totdays=<?php echo $_REQUEST['totdays'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
