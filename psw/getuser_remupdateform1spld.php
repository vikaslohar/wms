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

//frm_action=submit&txt11=&txt14=&txtid=1&logid=PS1&getdetflg=1&date=02-05-2013&itmdchk=0&txtcrop1=Cowpea&txtcrop=33&txtvariety1=Kashi%20Kanchan&txtvariety=338&txtlotno_1=DA00140%2F00000P&wtinmp_1=20.000&upspacktype_1=500.000%20Gms&sloc_1=WH-01%2FA01%2F10&wh_1=1&bin_1=133&sbin_1=2650&txtdisp_1=0&txtnomp_1=116&txtqty_1=2320.000&txtrecbagp_1=0&txtrecnomp_1=16&recqtyp_1=320&txtdbagp_1=&txtdnomp_1=100&txtdqtyp_1=2000&rtotalnop=0&rtotalups=116&rtotalqty=2320&maintrid=0&subtrid=0&srno1=1

if(isset($_REQUEST['txt11'])) { $txt11 = $_REQUEST['txt11']; }
if(isset($_REQUEST['txt14'])) { $txt14 = $_REQUEST['txt14']; }
if(isset($_REQUEST['txtid'])) { $txtid = $_REQUEST['txtid']; }
if(isset($_REQUEST['date'])) { $date = $_REQUEST['date']; }
if(isset($_REQUEST['dcdate'])) { $dcdate = $_REQUEST['dcdate']; }
if(isset($_REQUEST['txtdcno'])) { $txtdcno = $_REQUEST['txtdcno']; }
if(isset($_REQUEST['txtcrop'])) { $txtcrop = $_REQUEST['txtcrop']; }
if(isset($_REQUEST['txtvariety'])) { $txtvariety= $_REQUEST['txtvariety']; }
if(isset($_REQUEST['txtups'])) { $txtups= $_REQUEST['txtups']; }
if(isset($_REQUEST['itmdchk'])) { $itmdchk = $_REQUEST['itmdchk']; }
if(isset($_REQUEST['maintrid'])) { $z1 = $_REQUEST['maintrid']; }
if(isset($_REQUEST['srno1'])) { $srno1 = $_REQUEST['srno1']; }
if(isset($_REQUEST['subtrid'])) { $subtrid = $_REQUEST['subtrid']; }
if(isset($_REQUEST['txtlotno_1'])) { $txtlotno_1 = $_REQUEST['txtlotno_1']; }	

if(isset($_REQUEST['upspacktype_1'])) { $upspacktype_1 = $_REQUEST['upspacktype_1']; }	
if(isset($_REQUEST['party'])) { $party = $_REQUEST['party']; }	
	

	$tdate11=$date;
	$tday1=substr($tdate11,0,2);
	$tmonth1=substr($tdate11,3,2);
	$tyear1=substr($tdate11,6,4);
	$tdate1=$tyear1."-".$tmonth1."-".$tday1;
	
	$tdate12=$dcdate;
	$tday12=substr($tdate12,0,2);
	$tmonth12=substr($tdate12,3,2);
	$tyear12=substr($tdate12,6,4);
	$tdate2=$tyear12."-".$tmonth12."-".$tday12;

//frm_action=submit&txt11=&txt14=&txtid=1862&logid=PS1&getdetflg=1&date=30-06-2015&dcdate=10-06-2015&txtdcno=qwerty&itmdchk=0&txtcrop1=Paddy&txtcrop=24&txtvariety1=2245&txtvariety=445&txtlotno_1=DP90303%2F00000%2F00P&wtinmp_1=30.000&upspacktype_1=3.000%20Kgs&sloc_1=WH-01%2FA36%2F9&wh_1=1&bin_1=38&sbin_1=749&txtdisp_1=0&txtnomp_1=183&txtqty_1=5490.000&txtrecbagp_1=0&txtrecnomp_1=10&recqtyp_1=300.000&txtdbagp_1=0&txtdnomp_1=173&txtdqtyp_1=5190.000&rtotalnop=0&rtotalups=183&rtotalqty=5490&txtlot1=DP90303%2F00000%2F00P&maintrid=0&subtrid=0&srno1=1


if($z1 == 0)
{
   $sql_main="insert into tbl_pswrem(pswrem_tcode, pswrem_date, logid, yearcode, pswrem_typ, pswrem_dcno, pswrem_dcdate, pswrem_party, plantcode)values('$txtid', '$tdate1', '$logid', '$yearid_id',  'splrelease', '$txtdcno', '$tdate2', '$party', '$plantcode')";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);
		$sql_sub="insert into tbl_pswrem_sub (pswrem_id, crop, variety, lotnumber, upssize, plantcode)values('$mainid', '$txtcrop', '$txtvariety', '$txtlotno_1', '$upspacktype_1', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{	
			$subid=mysqli_insert_id($link);
			for($i=1; $i<=$srno1;$i++)
			{
				$wh="wh_".$i;
				$bin="bin_".$i;
				$sbin="sbin_".$i;
				$onob="txtdisp_".$i;
				$onomp="txtnomp_".$i;
				$oqty="txtqty_".$i;
				$rnob="txtrecbagp_".$i;
				$rnomp="txtrecnomp_".$i;
				$rqty="recqtyp_".$i;
				$balnob="txtdbagp_".$i;
				$balnomp="txtdnomp_".$i;
				$balqty="txtdqtyp_".$i;
				
				$wh2=$_REQUEST[$wh];
				$bin2=$_REQUEST[$bin];
				$sbin2=$_REQUEST[$sbin];
				$onob2=$_REQUEST[$onob];
				$onomp2=$_REQUEST[$onomp];
				$oqty2=$_REQUEST[$oqty];
				$rnob2=$_REQUEST[$rnob];
				$rnomp2=$_REQUEST[$rnomp];
				$rqty2=$_REQUEST[$rqty];
				$balnob2=$_REQUEST[$balnob];
				$balnomp2=$_REQUEST[$balnomp];
				$balqty2=$_REQUEST[$balqty];
				
				$sql_sub="insert into tbl_pswremsub_sub (pswremsub_id, pswrem_id, whid, binid, subbinid, opnop, opnomp, opqty, remnop, remnomp, remqty, balnop, balnomp, balqty, plantcode)values('$subid','$mainid', '$wh2', '$bin2', '$sbin2', '$onob2', '$onomp2', '$oqty2', '$rnob2', '$rnomp2', '$rqty2', '$balnob2', '$balnomp2', '$balqty2', '$plantcode')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
		}
	}
	$z1=$mainid;
}
else
{
	$sql_main="update tbl_pswrem set  pswrem_date='$tdate1', logid='$logid', yearcode='$yearid_id', pswrem_typ='splrelease', pswrem_dcno='$txtdcno', pswrem_dcdate='$tdate2'  where pswrem_id='$z1'";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=$z1;
		$sql_sub="insert into tbl_pswrem_sub (pswrem_id, crop, variety, lotnumber, upssize, plantcode)values('$mainid', '$txtcrop', '$txtvariety', '$txtlotno_1', '$upspacktype_1', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{	
			$subid=mysqli_insert_id($link);
			for($i=1; $i<=$srno1;$i++)
			{
				$wh="wh_".$i;
				$bin="bin_".$i;
				$sbin="sbin_".$i;
				$onob="txtdisp_".$i;
				$onomp="txtnomp_".$i;
				$oqty="txtqty_".$i;
				$rnob="txtrecbagp_".$i;
				$rnomp="txtrecnomp_".$i;
				$rqty="recqtyp_".$i;
				$balnob="txtdbagp_".$i;
				$balnomp="txtdnomp_".$i;
				$balqty="txtdqtyp_".$i;
				
				$wh2=$_REQUEST[$wh];
				$bin2=$_REQUEST[$bin];
				$sbin2=$_REQUEST[$sbin];
				$onob2=$_REQUEST[$onob];
				$onomp2=$_REQUEST[$onomp];
				$oqty2=$_REQUEST[$oqty];
				$rnob2=$_REQUEST[$rnob];
				$rnomp2=$_REQUEST[$rnomp];
				$rqty2=$_REQUEST[$rqty];
				$balnob2=$_REQUEST[$balnob];
				$balnomp2=$_REQUEST[$balnomp];
				$balqty2=$_REQUEST[$balqty];
				
				$sql_sub="insert into tbl_pswremsub_sub (pswremsub_id, pswrem_id, whid, binid, subbinid, opnop, opnomp, opqty, remnop, remnomp, remqty, balnop, balnomp, balqty, plantcode)values('$subid','$mainid', '$wh2', '$bin2', '$sbin2', '$onob2', '$onomp2', '$oqty2', '$rnob2', '$rnomp2', '$rqty2', '$balnob2', '$balnomp2', '$balqty2', '$plantcode')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
		}
	}
}

?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<?php  
 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];

$tdate=$row_tbl['pswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;

$tdate=$row_tbl['pswrem_dcdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;	
?>	

<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Pack Seed SP Release</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TCR".$row_tbl['pswrem_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="smalltbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['pswrem_dcno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<input name="txtparty" type="text" size="50" class="smalltbltext" value="VNR Seeds Private Limited-Raipur Depot" readonly="true" style="background-color:#CCCCCC"  tabindex="0"/><input type="hidden" name="party" value="907" /></td>

</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#0BC5F4" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_sub where plantcode='$plantcode' and pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No.</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >UPS</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Crop</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Variety</td>
	<td width="91" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
	<td align="center" valign="middle" class="tblheading"  colspan="3">Actual Quantity</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Quantity Released</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Balance Quantity</td>
	<td width="30" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
	<td width="39" align="center" valign="middle" class="tblheading"rowspan="2" >Delete</td>
</tr>
<tr class="tblsubtitle">
	<td width="50" align="center" valign="middle" class="tblheading" >NoP</td>
	<td width="50" align="center" valign="middle" class="tblheading" >NoMP</td>
	<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="53" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="52" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $difq="";  $rtotalnop=0; $rtotalups=0; $rtotalqty=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['pswrem_id'];

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pswremsub_sub where plantcode='$plantcode' and pswremsub_id='".$row_tbl_sub['pswremsub_id']."' and pswrem_id='".$row_tbl_sub['pswrem_id']."'") or die(mysqli_error($link));
while($row_subsub=mysqli_fetch_array($sql_tbl_subsub))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=""; $slocs=""; $gd=""; $slups=0; $slqty=0; $onob=0; $onomp=0; $oqty=0; $nob=0; $nomp=0; $qty=0; $baln=0; $balmp=0; $balq=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_subsub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_subsub['subbinid']."' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$onob=$onob+$row_subsub['opnop'];
$onomp=$onomp+$row_subsub['opnomp'];
$oqty=$oqty+$row_subsub['opqty'];
$nob=$nob+$row_subsub['remnop'];
$nomp=$nomp+$row_subsub['remnomp'];
$qty=$qty+$row_subsub['remqty'];
$baln=$baln+$row_subsub['balnop'];
$balmp=$balmp+$row_subsub['balnomp'];
$balq=$balq+$row_subsub['balqty'];

}
$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['crop']."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);

$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);

$rtotalnop=$rtotalnop+$onob;
$rtotalups=$rtotalups+$onomp;
$rtotalqty=$rtotalqty+$oqty;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crp['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_var['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $slocs;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $onob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balq;?></td>
    <td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
    <td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crp['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_var['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balq;?></td>
    <td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
    <td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
  </tr>
<?php
}
$srno++;
}
}
?>
<input type="hidden" name="rtotalnop" value="<?php echo $rtotalnop;?>" />
<input type="hidden" name="rtotalups" value="<?php echo $rtotalups;?>" />
<input type="hidden" name="rtotalqty" value="<?php echo $rtotalqty;?>" />
</table><br />

  <div id="postingsubtable" style="display:block">
		<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  where cropname IN ('Paddy Seed','Bajra Seed','Maize Seed') order by cropname Asc");
?>
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
<option value="<?php echo $noticia['cropid'];?>" />   
<?php echo $noticia['cropname'];?>
<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="72" height="30" align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="158"  align="left"  valign="middle" class="smalltbltext" id="vitem2">&nbsp;<select class="smalltbltext" name="txtups" style="width:100px;" onchange="upschk(this.value)"  >
<option value="" selected>--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30" id="vitem">
<td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#0BC5F4" >&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" colspan="4" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	  
</tr>		   
</table>
<!--<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /></div>