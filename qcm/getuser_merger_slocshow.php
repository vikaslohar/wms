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

if(isset($_POST['a']))
{
	$a = $_POST['a'];	 
}
if(isset($_POST['b']))
{
	$trid = $_POST['b'];	 
}
if(isset($_POST['c']))
{
	$c = $_POST['c'];	 
}
if(isset($_POST['h']))
{
	$h = $_POST['h'];	 
}
if(isset($_POST['g']))
{
	$typ = $_POST['g'];	 
}
	

	$sx=""; $g=0;
	$sd2=explode(",",$h);
	$sd3=explode(",",$c);
	for($i=0; $i<count($sd2);$i++)
	{
		$val2=$sd2[$i];
		$val=$sd3[$i];
		$asd=explode(" ",$val);
		$vl=$asd[1];
		//echo $asd;
		if($asd[0]=="Group")
		$sq2="update tbl_blends set blends_group='$vl', blends_delflg=0 where blendm_id='$trid' and blends_id='$val2'";
		else if($asd[0]=="Deleted")
		$sq2="update tbl_blends set blends_group=0, blends_delflg=1 where blendm_id='$trid' and blends_id='$val2'";
		else if($asd[0]=="Open")
		$sq2="update tbl_blends set blends_group=0, blends_delflg=0 where blendm_id='$trid' and blends_id='$val2'";
		else
		$sq2="update tbl_blends set blendm_id='$trid' where blendm_id='$trid' and blends_id='$val2'";
		$cx2=mysqli_query($link,$sq2) or die(mysqli_error($link));
		if($sx!="")
			$sx=$sx.",".$val2;
		else
			$sx=$val2;
	}
	
	$sqlsub=mysqli_query($link,"select max(blends_group) from tbl_blends where blendm_id='$trid' and blends_group>0 order by blends_group desc") or die(mysqli_error($link));
	$tt=mysqli_num_rows($sqlsub);
	if($tt > 0)
	{
		$rowsub=mysqli_fetch_array($sqlsub);
		if($rowsub[0]!="" && $rowsub[0]>0)
		$g=$rowsub[0]+1;
		else
		$g=1;
	}
	else
	{
		$g=1;
	}
	//exit;
	$sd=explode(",",$a);
	foreach($sd as $val)
	{
		if($val<>"")	
		{
			if($typ=="group")
			$sq2="update tbl_blends set blends_group='$g' where blendm_id='$trid' and blends_id='$val'";
			else if($typ=="delete")
			$sq2="update tbl_blends set blends_delflg=1 where blendm_id='$trid' and blends_id='$val'";
			else
			$sq2="update tbl_blends set blendm_id='$trid' where blendm_id='$trid' and blends_id='$val'";
			$cx2=mysqli_query($link,$sq2) or die(mysqli_error($link));
			if($sx!="")
			$sx=$sx.",".$val;
			else
			$sx=$val;
		}
	}
	
$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$trid")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);	
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td  align="center" valign="middle" class="tblheading" >Blending Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
        <td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td colspan="5"  align="center" valign="middle" class="smalltblheading">Quality Status</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">Arrival Type</td>
		<td width="111" rowspan="2"  align="center" valign="middle" class="smalltblheading">Production Location</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">Date of Harvest</td>
		<td width="92" rowspan="2"  align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="chkall();">CA</a>/<a href="Javascript:void(0);" onclick="clall();">CL</a></td>
	</tr>
	<tr class="tblsubtitle">
	  <td width="35"  align="center" valign="middle" class="smalltblheading">QC</td>
	  <td width="60"  align="center" valign="middle" class="smalltblheading">DoT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">GOT</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">DoGT</td>
	</tr>
<?php
$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0;
$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($grs!="")
		$grs=$grs.",".$row_sub['blends_group'];
	else
		$grs=$row_sub['blends_group'];	
	$sql_sub23=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='".$row_sub['blends_group']."' order by blends_group asc") or die(mysqli_error($link));	
	if($tot_sub23=mysqli_num_rows($sql_sub23) == 1)$gflg++;
}
$sql_sub=mysqli_query($link,"select distinct blends_delflg from tbl_blends where blendm_id='$trid' and blends_delflg>0 group by blends_delflg order by blends_delflg asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$drs=$row_sub['blends_delflg'];	
}
//echo $gflg;
$sr=1; $itmdchk=0;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' order by blends_group asc, blends_lotno asc") or die(mysqli_error($link));
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
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class['cropname']."' and lotvariety='".$noticia_item['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' order by orlot asc") or die(mysqli_error($link));
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

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row['blendm_variety']."' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."' order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
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

			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
					
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
						
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
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
			
if($sr%2!=0)
{
?>		  
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") {echo "bgcolor='#EE9A4D'";} else if($mlot>=90000 && $llot!="00000") {if($trtype=="Merger")$trtype="SR Merger";echo "bgcolor='#FFE5B4'"; }else ""?> height="20" class="smalltbltext">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $germ?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dogt?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $trtype?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pdate?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) {?><input type="checkbox" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="<?php echo $subid;?>" /><?php } else { ?><select name="grp" id="grp_<?php echo $sr;?>" class="smalltbltext" style="size:70px;" onchange="ddvalchk(this.value,'<?php echo $sr;?>','<?php echo $subid;?>')" >
		<option <?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Selected";?> value="Open">Open</option>
		<?php $gs=explode(",",$grs); foreach($gs as $val){ if($val<>""){ ?>
		<option <?php if($row_eindent_sub['blends_group']==$val) echo "Selected";?> value="Group <?php echo $val?>">Group <?php echo $val?></option>
		<?php } }?>
		<option <?php if($row_eindent_sub['blends_delflg']>0) echo "Selected";?> value="Deleted <?php echo $val?>">Deleted</option>
		</select><input type="hidden" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="" /><?php }?><input type="hidden" name="ddval" id="ddval_<?php echo $sr;?>" value="<?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Open"; else if($row_eindent_sub['blends_group']>0 && $row_eindent_sub['blends_delflg']==0) echo "Group ".$row_eindent_sub['blends_group']; else if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']>0) echo "Deleted ".$row_eindent_sub['blends_delflg']; else echo "";?>" /><input type="hidden" name="ddsid" id="ddsid_<?php echo $sr;?>" value="<?php echo $subid;?>" /></td>
	</tr>

<?php
}
else
{
?>
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") {echo "bgcolor='#EE9A4D'";} else if($mlot>=90000 && $llot!="00000"){if($trtype=="Merger")$trtype="SR Merger";echo "bgcolor='#FFE5B4'"; } else ""?> height="20" class="smalltbltext">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $germ?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dogt?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $trtype?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pdate?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) {?><input type="checkbox" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="<?php echo $subid;?>" /><?php } else { ?><select name="grp" id="grp_<?php echo $sr;?>" class="smalltbltext" style="size:70px;" onchange="ddvalchk(this.value,'<?php echo $sr;?>','<?php echo $subid;?>')" >
		<option <?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Selected";?> value="Open">Open</option>
		<?php $gs=explode(",",$grs); foreach($gs as $val){ if($val<>""){ ?>
		<option <?php if($row_eindent_sub['blends_group']==$val) echo "Selected";?> value="Group <?php echo $val?>">Group <?php echo $val?></option>
		<?php } }?>
		<option <?php if($row_eindent_sub['blends_delflg']>0) echo "Selected";?> value="Deleted <?php echo $val?>">Deleted</option>
		</select><input type="hidden" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="" /><?php }?><input type="hidden" name="ddval" id="ddval_<?php echo $sr;?>" value="<?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Open"; else if($row_eindent_sub['blends_group']>0 && $row_eindent_sub['blends_delflg']==0) echo "Group ".$row_eindent_sub['blends_group']; else if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']>0) echo "Deleted ".$row_eindent_sub['blends_delflg']; else echo "";?>" /><input type="hidden" name="ddsid" id="ddsid_<?php echo $sr;?>" value="<?php echo $subid;?>" /></td>
	</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
<input type="hidden" name="sr" value="<?php echo $sr;?>" />	
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
</table>


<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
  <tr height="10"><td></td></tr>
  <tr height="20">
    <td width="647"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#EE9A4D" class="tblheading" >&nbsp;</td>
    <td width="80"  align="left" valign="middle" class="tblheading" >&nbsp;Blended Lot</td>
    <td width="15"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#FFE5B4" class="tblheading" >&nbsp;</td>
    <td width="148"  align="left" valign="middle" class="tblheading" >&nbsp;Sales Return Blended Lot</td>
  </tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right">&nbsp;<?php if($grpflg+$delflg!=$tot_rows){?><img src="../images/delete.gif" border="0"style="display:inline;cursor:pointer;" onclick="recdele()" /><?php }?>&nbsp;&nbsp;<img src="../images/group.gif" border="0"style="display:inline;cursor:pointer;" onclick="groupchk();" />&nbsp;&nbsp;</td>
</tr>
</table>
