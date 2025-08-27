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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
{
	$crop = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$variety = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$type = $_GET['c'];	 
}
if(isset($_GET['f']))
{
	$wh = $_GET['f'];	 
}
if(isset($_GET['g']))
{
	$bin = $_GET['g'];	 
}
if(isset($_GET['h']))
{
	$subbin = $_GET['h'];	 
}

if($type=="sllot")	
{
$sql="SELECT distinct orlot, lotldg_got1 FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot ";
$sql2="SELECT distinct orlot, lotldg_got1 FROM tbl_lot_ldg_pack WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_rvflg=0 order by orlot";
}
else
{
$sql="SELECT distinct orlot, lotldg_got1 FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_whid='".$wh."' and lotldg_binid='".$bin."' and lotldg_subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot";
$sql2="SELECT distinct orlot, lotldg_got1 FROM tbl_lot_ldg_pack WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and whid='".$wh."' and binid='".$bin."' and subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_rvflg=0 order by orlot";
}
$sql_qc=mysqli_query($link,$sql)or die(mysqli_error($link));
$sql_qc22=mysqli_query($link,$sql2)or die(mysqli_error($link));
$tt=mysqli_num_rows($sql_qc);
while($row_arr_home=mysqli_fetch_array($sql_qc))
{
	if($olt!="")
	$olt=$olt.",".$row_arr_home['orlot'];
	else
	$olt=$row_arr_home['orlot'];
}
while($row_arr_home22=mysqli_fetch_array($sql_qc22))
{
	if($olt!="")
	$olt=$olt.",".$row_arr_home22['orlot'];
	else
	$olt=$row_arr_home22['orlot'];
}
$countrec=0;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
	<td width="92" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="40" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="41" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="55" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="70" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="52" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="56" align="center" valign="middle" class="tblheading">Germ %</td>
	<td width="72" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="56" align="center" valign="middle" class="tblheading">Select<br />
<a href="Javascript:vopid(0);" onclick="checkall();">CA</a> | <a href="Javascript:vopid(0);" onclick="clearall();">CL</a></td>
	<td width="90" align="center" valign="middle" class="tblheading">Soft Release</td>
</tr>
<?php
$srno=1;
$p_olt=explode(",",$olt);
//echo count($p_olt);
foreach($p_olt as $orlt)
{
if($orlt<>"")
{
$flg=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $stage="";	$sloc="";

$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where  orlot='".$orlt."'  and lotldg_balqty > 0  and lotldg_srflg='0' and lotldg_qc!='Fail'  order by orlot") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_issue);
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$orlt."'  and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link)); 
 $xxz=mysqli_num_rows($sql_issuetbl);
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']);
	if($row_issuetbl['lotldg_balqty'] > 0)
	{
		if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		{$flg=1;}
		if($tgot[0]=="GOT-NR")
		{
		$flg=1;
		}
		if($tgot[0]=="GOT-R" && $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="Fail")
		{
		$flg=1;
		}
	}
	//echo $tgot[0];
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_issuetbl['lotldg_balbags'];
$slqty=$slqty+$row_issuetbl['lotldg_balqty'];
 
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}

}
}

if($totqty>0 && $totnob==0)$totnob=1;

$sql_issue=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where orlot='".$orlt."' and balqty > 0 and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_issue);
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$orlt."' and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_rvflg=0 order by orlot") or die(mysqli_error($link)); 
 $xxz=mysqli_num_rows($sql_issuetbl);
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$row_issuetbl['balqty']; 
	//$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']); 
	if($row_issuetbl['balqty'] > 0)
	{
		if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		{$flg=1;}
		if($tgot[0]=="GOT-NR")
		{
		$flg=1;
		}
		if($tgot[0]=="GOT-R" && $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="Fail")
		{
		$flg=1;
		}
	}
	//echo $tgot[0];
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

//$slups=$slups+$row_issuetbl['lotldg_balbags'];
$slqty=$row_issuetbl['balqty'];
 
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}

}
}

if($totqty<0)$totqty=0;
if($totqty==0)$flg++;

if($flg==0)
{
$countrec++;
if($srno%2!=0)
{
?>
<tr class="Light" height="30">
	
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $orlt;?></td>
	<td width="40" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="41" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>
	<td width="146" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotchk" id="fet<?php echo $srno;?>" onchange="chklot(<?php echo $srno;?>)" value="<?php echo $orlt;?>" /></td>
	<td width="90" align="center" valign="middle" class="tblheading"><select class="tbltext" id="srtyp<?php echo $srno;?>" name="srtyp" style="width:80px;" disabled="disabled"  >
<option value="" selected>--Select--</option>
<?php if($stage=="Raw"){ ?>
<option value="condition">Condition</option>
<option value="pack">Pack</option>
<option value="dispatch">Dispatch</option>
<?php }else if($stage=="Condition"){ ?>
<option value="pack">Pack</option>
<option value="dispatch">Dispatch</option>
<?php }else if($stage=="Pack"){ ?>
<option value="dispatch">Dispatch</option>
<?php }?>
</select></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
	
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $orlt;?></td>
	<td width="40" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="41" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>
	<td width="146" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotchk" id="fet<?php echo $srno;?>" onchange="chklot(<?php echo $srno;?>)" value="<?php echo $orlt;?>" /></td>
	<td width="90" align="center" valign="middle" class="tblheading"><select class="tbltext" id="srtyp<?php echo $srno;?>" name="srtyp" style="width:80px;" disabled="disabled"  >
<option value="" selected>--Select--</option>
<?php if($stage=="Raw"){ ?>
<option value="condition">Condition</option>
<option value="pack">Pack</option>
<option value="dispatch">Dispatch</option>
<?php }else if($stage=="Condition"){ ?>
<option value="pack">Pack</option>
<option value="dispatch">Dispatch</option>
<?php }else if($stage=="Pack"){ ?>
<option value="dispatch">Dispatch</option>
<?php }?>
</select></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
<?php
if($countrec==0)
{
?>
<tr class="Light" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="12">Record not found</td>
</tr>
<?php
}
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
