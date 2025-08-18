<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
		echo '<script language="JavaScript" type="text/JavaScript">';
		echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$txtupsdc = $_REQUEST['txtupsdc'];
		$txtqcsts = $_REQUEST['txtqcsts'];
		
		$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
		if($crop!="ALL")
		{	
			$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
			$row_crp=mysqli_fetch_array($sql_crp);
			$crp=$row_crp['cropname'];
		}
		if($variety!="ALL")
		{	
			$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sql_var);
			$ver=$row_var['popularname'];
		}
		
	
?>
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>psw - Report - Pack Seed Stock Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_pswstock.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&txtupsdc=<?php echo $txtupsdc;?>&txtqcsts=<?php echo $txtqcsts;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Pack Seed Stock Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?>&nbsp;&nbsp;|&nbsp;&nbsp;UPS: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;Pack QC Status: <?php echo $txtqcsts;?></td>

</tr>
</table>
<?php

?>


  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="26" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="126"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Size</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Packaging Type</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="60"  align="center" valign="middle" class="smalltblheading">Pack QC status</td>
	<td width="70" align="center" valign="middle" class="smalltblheading">Pack DoT</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">Latest QC status</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Latest DoT</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">DoV</td>
	<td width="57"  align="center" valign="middle" class="smalltblheading">Validity (in Days)</td>
	<td width="190"  align="center" valign="middle" class="smalltblheading">SLOC</td>
	</tr>

<?php
$srno=0;

	
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where balqty > 0 and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtupsdc!="ALL")
	{	
		$qry.=" and packtype='$txtupsdc' ";
	}
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	if($tot_arr_home > 0)
	{
	
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
	
	if($txtupsdc!="ALL")
	{
		$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and plantcode='$plantcode' order by lotdgp_id desc") or die(mysqli_error($link));
	}
	else
	{
		$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and plantcode='$plantcode' order by lotdgp_id desc") or die(mysqli_error($link));
	}
	$tot_rr=mysqli_num_rows($sql_rr);
	while($row_rr=mysqli_fetch_array($sql_rr))
	{

		$cropname=''; $varietyname='';  $totalbags=0; $totalqty=0;
	
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $cropname=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."'") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
			$rowvv=mysqli_fetch_array($sql_variety);
			$varietyname=$rowvv['popularname'];
		}
		else
		{
			$varietyname=$row_rr['lotldg_variety'];
		}

$ccnt=0;
if($txtupsdc!="ALL")
{
	$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$txtupsdc."' and plantcode='$plantcode' order by packtype asc") or die(mysqli_error($link));
}
else
{
	$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and plantcode='$plantcode' order by packtype asc") or die(mysqli_error($link));
}
$tot_rr24=mysqli_num_rows($sql_rr24);
while($row_rr24=mysqli_fetch_array($sql_rr24))
{
		
	$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr24['packtype']."' and plantcode='$plantcode' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
	{  
	
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where  lotno='".$row_arhome['lotno']."' and packtype='".$row_rr24['packtype']."' and plantcode='$plantcode' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

	while($row_is=mysqli_fetch_array($sql_is))
	{ 
	
	$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and lotno='".$row_arhome['lotno']."' and packtype='".$row_rr24['packtype']."' and plantcode='$plantcode' order by lotdgp_id asc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
	
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty > 0 and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$ccnt++;
}
}
}
}
//echo $ccnt;
if($ccnt > 0)
{
// 		Table code for crop & variety wise lot numbers

if($txtupsdc!="ALL")
{
$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$txtupsdc."' and plantcode='$plantcode' order by packtype asc") or die(mysqli_error($link));
}
else
{
$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and plantcode='$plantcode' order by packtype asc") or die(mysqli_error($link));
}
$tot_rr2=mysqli_num_rows($sql_rr2);
while($row_rr2=mysqli_fetch_array($sql_rr2))
{
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and plantcode='$plantcode' group by lotno order by lotdgp_id desc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0; $cnt=0; $oqcsts=""; $odot=""; $txtdov=""; $validity=""; $wtmp='';
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $txtdot="";	$sloc="";
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where  lotno='".$row_arr_home['lotno']."' and packtype='".$row_rr2['packtype']."' and plantcode='$plantcode' group by subbinid order by lotdgp_id desc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and packtype='".$row_rr2['packtype']."'and lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode' order by lotdgp_id desc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and plantcode='$plantcode' order by lotdgp_id desc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
  $cnt++;
  	$wtmp=$row_issuetbl['wtinmp']; 
	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnomp']; 
	if($totnob<0) $totnob=0;
	if($totqty<0) $totqty=0;

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	
	$upspacktype=$row_issuetbl['packtype'];
	$upspacktype=trim($upspacktype);
	$packtp=explode(" ",$upspacktype);
	$packt=trim($packtp[0]);
	$packtyp=explode(".",$packt); 
				
	if($packtyp[1]=="000")
	$upssize=$packtyp[0]." ".$packtp[1];
	else
	$upssize=$upspacktype;
	
	if($row_issuetbl['lotldg_srflg'] > 0)
	{
		if($totsst!="")$totsst=$totsst."/"."S";
		else
		$totsst="S";
	}
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")$txtdot="";
	
	if($txtdov=="")
	{
	$rdate=$row_issuetbl['lotldg_valupto'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdov=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdov=="00-00-0000" || $txtdov=="--")$txtdov="";
	
	if($validity=="")
	{
	$diff = (strtotime($row_issuetbl['lotldg_valupto']) - strtotime($dt));
	$validity = floor($diff / (60*60*24));
	}
	
	if($totgemp==0 || $totgemp=="") $totgemp="";
	


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_issuetbl['balnomp'];
$slqty=$row_issuetbl['balqty'];
$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($slups<0) $slups=0;
if($slqty<0) $slqty=0;
	
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
}
}

$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipsub_plotno='".$row_arr_home['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_pnp=mysqli_num_rows($sql_pnp);
$row_pnp=mysqli_fetch_array($sql_pnp);
$oqcsts=$row_pnp['pnpslipsub_qcdttype'];
if($oqcsts=="DOT" || $oqcsts=="DoT")$oqcsts="OK";

$packgtype='';
$sql_pnpm=mysqli_query($link,"Select * from tbl_pnpslipmain where pnpslipmain_id='".$row_pnp['pnpslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_pnpm=mysqli_num_rows($sql_pnpm);
$row_pnpm=mysqli_fetch_array($sql_pnpm);
//$packgtype=$row_pnpm['pnpslipmain_ttype'];
if($row_pnpm['pnpslipmain_ttype']=='NST Packing Slip'){ $packgtype="NST-".$wtmp; }
else { $packgtype="ST-".$wtmp; }


$rdate=$row_pnp['pnpslipsub_qcdot'];
$ryear=substr($rdate,0,4);
$rmonth=substr($rdate,5,2);
$rday=substr($rdate,8,2);
$odot=$rday."-".$rmonth."-".$ryear;

$sql_pnp24=mysqli_query($link,"Select MAX(rv_id) from tbl_revalidate where rv_newlot='".$row_arr_home['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_pnp24=mysqli_num_rows($sql_pnp24);
$row_pnp24=mysqli_fetch_array($sql_pnp24);

$sql_pnp2=mysqli_query($link,"Select * from tbl_revalidate where rv_newlot='".$row_arr_home['lotno']."' and rv_id='".$row_pnp24[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_pnp2=mysqli_num_rows($sql_pnp2);
$row_pnp2=mysqli_fetch_array($sql_pnp2);
if($tot_pnp2>0)
{
	$oqcsts="RV";
	
	$rdate=$row_pnp2['rv_dot'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$odot=$rday."-".$rmonth."-".$ryear;
}	
if($odot=="00-00-0000" || $odot=="--")	$odot="";

if($txtqcsts!="Both")
{
	if($txtqcsts=="DoT" && $oqcsts=="DoSF")$cnt=0;
	if($txtqcsts=="DoSF" && ($oqcsts=="DOT" || $oqcsts=="DoT"))$cnt=0;
	if($txtqcsts=="DoSF" && $oqcsts=="RV")$cnt=0;
}
//echo $cnt;
if($cnt>0)
{
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($totqc=="RT"){$txtdot=""; $totgemp="";}
if($txtdov=="")$validity="";
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $packgtype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqcsts;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $odot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdov;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $validity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $packgtype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqcsts;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $odot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdov;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $validity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
</tr>
<?php
}
$srno++;
}
}
}
}
}

if($ccnt > 0)
{
?>
<tr class="Dark">
			<td align="center" valign="middle" class="tblheading" colspan="6">Total</td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totalbags?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
			<td align="center" valign="middle" class="tblheading" colspan="8">&nbsp;</td>
</tr>
<?php
}
}
}
?></table>			

  <br/>
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="right" class="smalltbltext" style="color:#303918;"><font color="#FF0000">* </font>Validity is calculated as on Report generation Date <?php echo date("d-m-Y");?>&nbsp;&nbsp;</td>
</tr>
</table>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_pswstock.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&txtupsdc=<?php echo $txtupsdc;?>&txtqcsts=<?php echo $txtqcsts;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
