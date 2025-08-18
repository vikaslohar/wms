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

if(isset($_POST['pid'])) { $pid = $_POST['pid']; }
if(isset($_POST['txtnlotno'])) { $txtnlotno = $_POST['txtnlotno']; }
if(isset($_POST['enob'])) { $enob = $_POST['enob'];	}
if(isset($_POST['eqty'])) { $eqty = $_POST['eqty'];	}
	
if(isset($_POST['txtslwhg1'])) { $txtslwhg1 = $_POST['txtslwhg1'];	}	
if(isset($_POST['txtslbing1'])) { $txtslbing1 = $_POST['txtslbing1'];	}	
if(isset($_POST['txtslsubbg1'])) { $txtslsubbg1 = $_POST['txtslsubbg1'];	}	
if(isset($_POST['txtconslnob1'])) { $txtconslnob1 = $_POST['txtconslnob1'];	}	
if(isset($_POST['txtconslqty1'])) { $txtconslqty1 = $_POST['txtconslqty1'];	}	

if(isset($_POST['txtslwhg2'])) { $txtslwhg2 = $_POST['txtslwhg2'];	}	
if(isset($_POST['txtslbing2'])) { $txtslbing2 = $_POST['txtslbing2'];	}	
if(isset($_POST['txtslsubbg2'])) { $txtslsubbg2 = $_POST['txtslsubbg2'];	}	
if(isset($_POST['txtconslnob2'])) { $txtconslnob2 = $_POST['txtconslnob2'];	}	
if(isset($_POST['txtconslqty2'])) { $txtconslqty2 = $_POST['txtconslqty2'];	}	

if(isset($_POST['typs'])) { $typs = $_POST['typs'];	}	

//frm_action=submit&code=&tid=&pid=1&txtdate=27-12-2014&txtcrop=51&txtvariety=559&txtstage=Condition&sr=5&itmdchk=0&gflg=0&trid=1&subtrid=0&txtnlotno=DF90449%2F00000%2F00C&enob=68&eqty=4022&txtslwhg1=1&txtslbing1=9&txtslsubbg1=173&txtconslnob1=68&txtconslqty1=4022&txtslwhg2=WH&txtslbing2=Bin&txtslsubbg2=Subbin&txtconslnob2=&txtconslqty2=
$zzz=str_split($txtnlotno);
$olot24=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];
if($typs=="new")
{
$sql_main="insert into tbl_blendss(blendm_id, blendss_newlot, blendss_orlot,  blendss_whid, blendss_binid, blendss_subbinid, blendss_nob, blendss_qty, plantcode) values ('$pid','$txtnlotno','$olot24','$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
$asc=mysqli_query($link,$sql_main) or die(mysqli_error($link));

if($txtconslqty2 > 0)
{
$sql_main2="insert into tbl_blendss(blendm_id, blendss_newlot, blendss_orlot,  blendss_whid, blendss_binid, blendss_subbinid, blendss_nob, blendss_qty, plantcode) values ('$pid','$txtnlotno','$olot24','$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
$asc2=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
}
}
else
{
$sq="delete from tbl_blendss where blendm_id='$pid' and blendss_newlot='$txtnlotno'";
$ssdd=mysqli_query($link,$sq) or die(mysqli_error($link));

$sql_main="insert into tbl_blendss(blendm_id, blendss_newlot, blendss_orlot,  blendss_whid, blendss_binid, blendss_subbinid, blendss_nob, blendss_qty, plantcode) values ('$pid','$txtnlotno','$olot24','$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
$asc=mysqli_query($link,$sql_main) or die(mysqli_error($link));

if($txtconslqty2 > 0)
{
$sql_main2="insert into tbl_blendss(blendm_id, blendss_newlot, blendss_orlot,  blendss_whid, blendss_binid, blendss_subbinid, blendss_nob, blendss_qty, plantcode) values ('$pid','$txtnlotno','$olot24','$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
$asc2=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
}
}

$sql_main="update tbl_blends set blends_sstatus=1 where blendm_id='$pid' and blends_newlot='$txtnlotno'";
$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		
$trid=$pid;
$subtrid=0;	
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td  align="center" valign="middle" class="tblheading" >Blending Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
        <td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td colspan="5"  align="center" valign="middle" class="smalltblheading">Quality Status</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Blended Lot No.</td>
		<td width="45" rowspan="2"  align="center" valign="middle" class="smalltblheading">Total NoB</td>
		<td width="65" rowspan="2"  align="center" valign="middle" class="smalltblheading">Total Qty</td>
		<td width="110" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td width="26" rowspan="2"  align="center" valign="middle" class="smalltblheading"></td>
	</tr>
	<tr class="tblsubtitle">
	  <td width="35"  align="center" valign="middle" class="smalltblheading">QC</td>
	  <td width="60"  align="center" valign="middle" class="smalltblheading">DoT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">GOT</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">DoGT</td>
	</tr>
<?php

$sql12=mysqli_query($link,"select * from tbl_blendm where blendm_id=$trid and plantcode='$plantcode'")or die(mysqli_error($link));
$row2=mysqli_fetch_array($sql12);
	
$classqry2=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row2['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class2=mysqli_fetch_array($classqry2);

$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row2['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item2=mysqli_fetch_array($itemqry2);



$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0;
$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 and blends_delflg=0 and plantcode='$plantcode' group by blends_group order by blends_group asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($grs!="")
		$grs=$grs.",".$row_sub['blends_group'];
	else
		$grs=$row_sub['blends_group'];	
}
$sql_sub=mysqli_query($link,"select distinct blends_delflg from tbl_blends where blendm_id='$trid' and blends_delflg>0 and plantcode='$plantcode' group by blends_delflg order by blends_delflg asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$drs=$row_sub['blends_delflg'];	
}

$sql_sub23=mysqli_query($link,"select distinct blends_sstatus from tbl_blends where blendm_id='$trid' and blends_sstatus=0 and blends_delflg=0 and plantcode='$plantcode' order by blends_sstatus asc") or die(mysqli_error($link));
while($row_sub23=mysqli_fetch_array($sql_sub23))
{
	$gflg++;
}

//echo $grs;
$sr=1; $itmdchk=0; 
$gs=explode(",",$grs); 
foreach($gs as $val)
{ 
if($val<>"")
{
$lotnos=""; $qcss=""; $gotss=""; $dots=""; $gempss=""; $dgots=""; $artps=""; $plocss=""; $dohss=""; $statuses=""; $stss=""; $nlotno=""; $norlot=""; $slocss=""; $nobss=""; $qtyss=""; $tnob=0; $tqty=0; $slocss2=""; 

$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='$val' and plantcode='$plantcode' order by blends_group asc, blends_lotno asc") or die(mysqli_error($link));
$tot_rows=mysqli_num_rows($sql_eindent_sub);
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0)$itmdchk++;

$subid=$row_eindent_sub['blends_id'];

$ltno=$row_eindent_sub['blends_lotno'];
$zzz=str_split($ltno);
$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];

$olot2=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12];

$ploc=""; $pdate="";
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class2['cropname']."' and lotvariety='".$noticia_item2['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' and plantcode='$plantcode' order by orlot asc") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
if($tot_rr > 0)
{
	$row_rr=mysqli_fetch_array($sql_rr);
	$ploc=$row_rr['ploc'];
	if($row_rr['lotstate']!="")
	$ploc=$ploc.", ".$row_rr['lotstate'];
	$rpdate=$row_rr['harvestdate'];
	$rpyear=substr($rpdate,0,4);
	$rpmonth=substr($rpdate,5,2);
	$rpday=substr($rpdate,8,2);
	$pdate=$rpday."-".$rpmonth."-".$rpyear;
	
	if($pdate=="00-00-0000" || $pdate=="--")$pdate="";	
}

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row2['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row2['blendm_variety']."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row2['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row2['blendm_variety']."'  and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row2['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row2['blendm_variety']."' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$qc=$row_issuetbl['lotldg_qc']; 
			$germ=$row_issuetbl['lotldg_gemp']; 
			$got1=explode(" ",$row_issuetbl['lotldg_got1']);
			$got2=$row_issuetbl['lotldg_got']; 
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
			$totnob=$totnob+$row_issuetbl['lotldg_balbags'];		
			
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$dot=$rday."-".$rmonth."-".$ryear;
			
			$rgdate=$row_issuetbl['lotldg_gottestdate'];
			$rgyear=substr($rgdate,0,4);
			$rgmonth=substr($rgdate,5,2);
			$rgday=substr($rgdate,8,2);
			$dogt=$rgday."-".$rgmonth."-".$rgyear;
						
			if($dot=="00-00-0000" || $dot=="--")$dot="";	
			if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
			if($qc=="RT" || $qc=="UT")$dot="";
			if($got2=="RT" || $got2=="UT")$dogt="";
			if($germ<=0)$germ="";

			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
					
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
						
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
						
			$slups=$row_issuetbl['lotldg_balbags'];
			$slqty=$row_issuetbl['lotldg_balqty'];
						 
			if($sloc!="")
				$sloc="<br />".$sloc.$wareh.$binn.$subbinn;
			else
				$sloc=$wareh.$binn.$subbinn;
			$cont++;
		}	
	}
}

if($trtype=="Fresh Seed with PDN")$trtype="Fresh Seed";

if($row_eindent_sub['blends_group']>0)$grpflg++;
if($row_eindent_sub['blends_delflg']>0)$delflg++;

$stss2=0;
$stss="Group ".$row_eindent_sub['blends_group'];
$stss2=$row_eindent_sub['blends_delflg'];
$nlotno=$row_eindent_sub['blends_newlot'];
$norlot=$row_eindent_sub['blends_orlot'];

if($lotnos!="") $lotnos=$lotnos."<br />".$ltno; else $lotnos=$ltno;
if($qcss!="") $qcss=$qcss."<br />".$qc; else $qcss=$qc;
if($gotss!="") $gotss=$gotss."<br />".$got; else $gotss=$got;
if($dots!="") $dots=$dots."<br />".$dot; else $dots=$dot;
if($gempss!="") $gempss=$gempss."<br />".$germ; else $gempss=$germ;
if($dgots!="") $dgots=$dgots."<br />".$dogt; else $dgots=$dogt;
if($artps!="") $artps=$artps."<br />".$trtype; else $artps=$trtype;
if($plocss!="") $plocss=$plocss."<br />".$ploc; else $plocss=$ploc;
if($dohss!="") $dohss=$dohss."<br />".$pdate; else $dohss=$pdate;
if($slocss!="") $slocss=$slocss."<br />".$sloc; else $slocss=$sloc;
if($nobss!="") $nobss=$nobss."<br />".$totnob; else $nobss=$totnob;
if($qtyss!="") $qtyss=$qtyss."<br />".$totqty; else $qtyss=$totqty;

$tnob=$tnob+$totnob;
$tqty=$tqty+$totqty;
}
$sq_sub=mysqli_query($link,"Select * from tbl_blendss where blendm_id='$trid' and blendss_newlot='$nlotno' and plantcode='$plantcode'") or die(mysqli_error($link));
while($ro_sub=mysqli_fetch_array($sq_sub))
{
$sql_whouse2=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$ro_sub['blendss_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse2=mysqli_fetch_array($sql_whouse2);
$wareh2=$row_whouse2['perticulars']."/";
					
$sql_binn2=mysqli_query($link,"select binname from tbl_bin where binid='".$ro_sub['blendss_binid']."' and whid='".$ro_sub['blendss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn2=mysqli_fetch_array($sql_binn2);
$binn2=$row_binn2['binname']."/";
					
$sql_subbinn2=mysqli_query($link,"select sname from tbl_subbin where sid='".$ro_sub['blendss_subbinid']."' and binid='".$ro_sub['blendss_binid']."' and whid='".$ro_sub['blendss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn2=mysqli_fetch_array($sql_subbinn2);
$subbinn2=$row_subbinn2['sname'];
					 
if($slocss2!="")
	$slocss2="<br />".$slocss2.$wareh2.$binn2.$subbinn2;
else
	$slocss2=$wareh2.$binn2.$subbinn2;
}				
				
			
if($sr%2!=0)
{
?>		  
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $lotnos?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nobss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qtyss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qcss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gempss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dgots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nlotno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss2;?></td>
		<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="updatesloc('<?php echo $nlotno;?>', '<?php echo $tnob?>', '<?php echo $tqty?>');" /></td>
	</tr>

<?php
}
else
{
?>
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $lotnos?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nobss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qtyss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qcss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gempss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dgots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nlotno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss2;?></td>
		<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="updatesloc('<?php echo $nlotno;?>', '<?php echo $tnob?>', '<?php echo $tqty?>');" /></td>
</tr>
<?php 
}
$sr=$sr+1;	
//}
}
}
?>	
<input type="hidden" name="sr" value="<?php echo $sr;?>" />	
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="gflg" value="<?php echo $gflg;?>" />
</table>


<input type="hidden" name="trid" value="<?php echo $trid?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtrid?>" />
<br />
<div id="subdiv" style="display:block"></div>
