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

if(isset($_REQUEST['code'])) { $code = $_REQUEST['code']; }
if(isset($_REQUEST['txtdate'])) { $trdate = $_REQUEST['txtdate']; }
if(isset($_REQUEST['txtclass'])) { $txtcrop = $_REQUEST['txtclass']; }
if(isset($_REQUEST['txtitem'])) { $txtvariety = $_REQUEST['txtitem']; }
if(isset($_REQUEST['txtfritem'])) { $txtfritem = $_REQUEST['txtfritem']; }
if(isset($_REQUEST['txttoitem'])) { $txttoitem = $_REQUEST['txttoitem']; }
if(isset($_REQUEST['txtlot1'])) { $txtlot1 = $_REQUEST['txtlot1']; }
if(isset($_REQUEST['paceptyp'])) { $paceptyp = $_REQUEST['paceptyp']; }
if(isset($_REQUEST['txtstage'])) { $txtstage = $_REQUEST['txtstage']; }
if(isset($_REQUEST['txtplotno'])) { $txtplotno = $_REQUEST['txtplotno']; }	

if(isset($_REQUEST['maintrid'])) { $trid = $_REQUEST['maintrid']; }
if(isset($_REQUEST['subtrid'])) { $subtrid = $_REQUEST['subtrid']; }

if(isset($_REQUEST['extslwhg1'])) { $extslwhg1 = $_REQUEST['extslwhg1']; }
if(isset($_REQUEST['extslbing1'])) { $extslbing1 = $_REQUEST['extslbing1']; }
if(isset($_REQUEST['extslsubbg1'])) { $extslsubbg1 = $_REQUEST['extslsubbg1']; }
if(isset($_REQUEST['txtavlnob1'])) { $txtavlnob1 = $_REQUEST['txtavlnob1']; }
if(isset($_REQUEST['txtavlqty1'])) { $txtavlqty1 = $_REQUEST['txtavlqty1']; }
if(isset($_REQUEST['txttrnob1'])) { $txttrnob1 = $_REQUEST['txttrnob1']; }
if(isset($_REQUEST['txttrqty1'])) { $txttrqty1 = $_REQUEST['txttrqty1']; }
if(isset($_REQUEST['txtbalnob1'])) { $txtbalnob1 = $_REQUEST['txtbalnob1']; }	
if(isset($_REQUEST['txtbalqty1'])) { $txtbalqty1 = $_REQUEST['txtbalqty1']; }	

$extslwhg2 = '';
$extslbing2 = '';
$extslsubbg2 = '';
$txtavlnob2 = '';
$txtavlqty2 = '';
$txttrnob2 = '';
$txttrqty2 = '';
$txtbalnob2 = '';
$txtbalqty2 = '';

if(isset($_REQUEST['srno2'])) { $srno2 = $_REQUEST['srno2']; }		

if($srno2>=2)
{
	if(isset($_REQUEST['extslwhg2'])) { $extslwhg2 = $_REQUEST['extslwhg2']; }
	if(isset($_REQUEST['extslbing2'])) { $extslbing2 = $_REQUEST['extslbing2']; }
	if(isset($_REQUEST['extslsubbg2'])) { $extslsubbg2 = $_REQUEST['extslsubbg2']; }
	if(isset($_REQUEST['txtavlnob2'])) { $txtavlnob2 = $_REQUEST['txtavlnob2']; }
	if(isset($_REQUEST['txtavlqty2'])) { $txtavlqty2 = $_REQUEST['txtavlqty2']; }
	if(isset($_REQUEST['txttrnob2'])) { $txttrnob2 = $_REQUEST['txttrnob2']; }
	if(isset($_REQUEST['txttrqty2'])) { $txttrqty2 = $_REQUEST['txttrqty2']; }
	if(isset($_REQUEST['txtbalnob2'])) { $txtbalnob2 = $_REQUEST['txtbalnob2']; }	
	if(isset($_REQUEST['txtbalqty2'])) { $txtbalqty2 = $_REQUEST['txtbalqty2']; }	
}	

if(isset($_REQUEST['txtslwhg1'])) { $txtslwhg1 = $_REQUEST['txtslwhg1']; }
if(isset($_REQUEST['txtslbing1'])) { $txtslbing1 = $_REQUEST['txtslbing1']; }
if(isset($_REQUEST['txtslsubbg1'])) { $txtslsubbg1= $_REQUEST['txtslsubbg1']; }
if(isset($_REQUEST['txtconslnob1'])) { $txtconslnob1 = $_REQUEST['txtconslnob1']; }
if(isset($_REQUEST['txtconslqty1'])) { $txtconslqty1 = $_REQUEST['txtconslqty1']; }
if(isset($_REQUEST['txtslwhg2'])) { $txtslwhg2 = $_REQUEST['txtslwhg2']; }
if(isset($_REQUEST['txtslbing2'])) { $txtslbing2 = $_REQUEST['txtslbing2']; }
if(isset($_REQUEST['txtslsubbg2'])) { $txtslsubbg2 = $_REQUEST['txtslsubbg2']; }
if(isset($_REQUEST['txtconslnob2'])) { $txtconslnob2 = $_REQUEST['txtconslnob2']; }
if(isset($_REQUEST['txtconslqty2'])) { $txtconslqty2 = $_REQUEST['txtconslqty2']; }


if(isset($_REQUEST['enob'])) { $enob = $_REQUEST['enob']; }
if(isset($_REQUEST['eqty'])) { $eqty = $_REQUEST['eqty']; }
if(isset($_REQUEST['eqc'])) { $eqc = $_REQUEST['eqc']; }
if(isset($_REQUEST['edot'])) { $edot = $_REQUEST['edot']; }
if(isset($_REQUEST['egot'])) { $egot = $_REQUEST['egot']; }
if(isset($_REQUEST['edogr'])) { $edogr = $_REQUEST['edogr']; }
if(isset($_REQUEST['srfet'])) { $srfet = $_REQUEST['srfet']; }
if(isset($_REQUEST['srtyp'])) { $srtyp = $_REQUEST['srtyp']; }
if(isset($_REQUEST['srflg'])) { $srflg = $_REQUEST['srflg']; }
echo  $srfet." - ".$srtyp." - ".$srflg;
$zzz=implode(",", str_split($txtplotno));
$orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];

if($srfet==""){$srtyp="";$srflg=0;}
//frm_action=submit&code=1&logid=PM1&txtstage=Condition&txtdate=20-02-2017&txtclass=51&txtitem=528&itmdchk=&txtfritem=528&txttoitem=537&txtlot1=DI90186%2F00000%2F00C&paceptyp=P&txtplotno=DI90186%2F00000%2F01C&extslwhg1=11&extslbing1=356&extslsubbg1=7104&txtavlnob1=10&txtavlqty1=586.000&txttrnob1=1&txttrqty1=86&txtbalnob1=9&txtbalqty1=500&srno=&chkbox=P&srno1=-1&srno2=1&txtslwhg1=10&txtslbing1=328&txtslsubbg1=6558&txtconslnob1=1&txtconslqty1=86&txtslwhg2=WH&txtslbing2=Bin&txtslsubbg2=Subbin&txtconslnob2=&txtconslqty2=&maintrid=0&subtrid=0

$tdate11=explode("-",$trdate);
$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];

$tdate12=explode("-",$edot);
$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
		
$tdate13=explode("-",$edogr);
$tdate3=$tdate13[2]."-".$tdate13[1]."-".$tdate13[0];		
		
if($trid == 0)
{
	$sql_in1="insert into tbl_ivtmain(ivt_tcode, ivt_date, ivt_crop, ivt_pvariety, ivt_trfromvariety, ivt_trtovariety, ivt_yearid, ivt_logid, plantcode) values ('$code', '$tdate1', '$txtcrop', '$txtvariety', '$txtfritem', '$txttoitem', '$yearid_id', '$logid', '$plantcode')";
	if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);

		$sql_sub="insert into tbl_ivtsub(ivt_id, ivts_olotno, ivts_nlotno, ivts_orlotno, ivts_onob, ivts_oqty, ivts_nob, ivts_qty, ivts_bnob, ivts_bqty, ivts_qc, ivts_dot, ivts_got, ivts_dogt, ivts_trnall, ivts_srflg, ivts_srtyp, plantcode) values('$mainid', '$txtlot1', '$txtplotno', '$orlot', '$enob', '$eqty', '0', '0', '$enob', '$eqty', '$eqc', '$tdate2', '$egot', '$tdate3', '$paceptyp', '$srflg', '$srtyp', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			
			$sql_sub_sub="insert into tbl_ivtsub_sub(ivt_id, ivts_id, ivtss_wh, ivtss_bin, ivtss_subbin, ivtss_onob, ivtss_oqty, ivtss_nob, ivtss_qty, ivtss_bnob, ivtss_bqty, plantcode) values('$mainid', '$subid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtavlnob1', '$txtavlqty1', '$txttrnob1', '$txttrqty1', '$txtbalnob1', '$txtbalqty1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			
			if($srno2>1)
			{
				$sql_sub_sub2="insert into tbl_ivtsub_sub(ivt_id, ivts_id, ivtss_wh, ivtss_bin, ivtss_subbin, ivtss_onob, ivtss_oqty, ivtss_nob, ivtss_qty, ivtss_bnob, ivtss_bqty, plantcode) values('$mainid', '$subid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtavlnob2', '$txtavlqty2', '$txttrnob2', '$txttrqty2', '$txtbalnob2', '$txtbalqty2', '$plantcode')";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));
			}
			
			$nqty=0; $nnob=0;
			
			$sql_sub_sub3="insert into tbl_ivtsub_sub2(ivt_id, ivts_id, ivtss2_wh, ivtss2_bin, ivtss2_subbin, ivtss2_nob, ivtss2_qty, plantcode) values('$mainid', '$subid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
			if(mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link)))
			{
				$nqty=$nqty+$txtconslqty1; $nnob=$nnob+$txtconslnob1;
			}
			
			if($txtconslqty2 > 0)
			{
				$sql_sub_sub4="insert into tbl_ivtsub_sub2(ivt_id, ivts_id, ivtss2_wh, ivtss2_bin, ivtss2_subbin, ivtss2_nob, ivtss2_qty, plantcode) values('$mainid', '$subid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
				if(mysqli_query($link,$sql_sub_sub4) or die(mysqli_error($link)))
				{
					$nqty=$nqty+$txtconslqty2; $nnob=$nnob+$txtconslnob2;
				}
			}
			
			$sqlsub2="update tbl_ivtsub set ivts_nob='$nnob', ivts_qty='$nqty' where ivts_id='$subid'";
			$xcv=mysqli_query($link,$sqlsub2) or die(mysqli_error($link));
			
		}
	}
	$trid=$mainid;
}
else
{
	$mainid=$trid;
	//$sql_in1="insert into tbl_ivtmain(ivt_tcode, ivt_date, ivt_crop, ivt_pvariety, ivt_trfromvariety, ivt_trtovariety, ivt_yearid, ivt_logid) values ('$code', '$tdate1', '$txtcrop', '$txtvariety', '$txtfritem', '$txttoitem', '$yearid_id', '$logid')";
	//if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
	{
		//$mainid=mysqli_insert_id($link);

		$sql_sub="update tbl_ivtsub set ivts_olotno='$txtlot1', ivts_nlotno='$txtplotno', ivts_orlotno='$orlot', ivts_onob='$enob', ivts_oqty='$eqty', ivts_nob='0', ivts_qty='0', ivts_bnob='$enob', ivts_bqty='$eqty', ivts_qc='$eqc', ivts_dot='$tdate2', ivts_got='$egot', ivts_dogt='$tdate3', ivts_trnall='$paceptyp', ivts_srflg='$srflg', ivts_srtyp='$srtyp' where ivts_id='$subtrid'";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=$subtrid;
			$sql_2=mysqli_query($link,"delete from tbl_ivtsub_sub where ivts_id=$subid")or die(mysqli_error($link));
			//$row=mysqli_fetch_array($sql1);
			$sql_3=mysqli_query($link,"delete from tbl_ivtsub_sub2 where ivts_id=$subid")or die(mysqli_error($link));
			//$row=mysqli_fetch_array($sql3);
			$nqty=0; $nnob=0;
			$sql_sub_sub="insert into tbl_ivtsub_sub(ivt_id, ivts_id, ivtss_wh, ivtss_bin, ivtss_subbin, ivtss_onob, ivtss_oqty, ivtss_nob, ivtss_qty, ivtss_bnob, ivtss_bqty, plantcode) values('$mainid', '$subid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtavlnob1', '$txtavlqty1', '$txttrnob1', '$txttrqty1', '$txtbalnob1', '$txtbalqty1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			
			if($srno2>1)
			{
				$sql_sub_sub2="insert into tbl_ivtsub_sub(ivt_id, ivts_id, ivtss_wh, ivtss_bin, ivtss_subbin, ivtss_onob, ivtss_oqty, ivtss_nob, ivtss_qty, ivtss_bnob, ivtss_bqty, plantcode) values('$mainid', '$subid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtavlnob2', '$txtavlqty2', '$txttrnob2', '$txttrqty2', '$txtbalnob2', '$txtbalqty2', '$plantcode')";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));
			}
			
			$sql_sub_sub3="insert into tbl_ivtsub_sub2(ivt_id, ivts_id, ivtss2_wh, ivtss2_bin, ivtss2_subbin, ivtss2_nob, ivtss2_qty, plantcode) values('$mainid', '$subid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
			if(mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link)))
			{
				$nqty=$nqty+$txtconslqty1; $nnob=$nnob+$txtconslnob1;
			}
			
			if($txtconslqty2 > 0)
			{
				$sql_sub_sub4="insert into tbl_ivtsub_sub2(ivt_id, ivts_id, ivtss2_wh, ivtss2_bin, ivtss2_subbin, ivtss2_nob, ivtss2_qty, plantcode) values('$mainid', '$subid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
				if(mysqli_query($link,$sql_sub_sub4) or die(mysqli_error($link)))
				{
					$nqty=$nqty+$txtconslqty2; $nnob=$nnob+$txtconslnob2;
				}
			}
			
			$sqlsub2="update tbl_ivtsub set ivts_nob='$nnob', ivts_qty='$nqty' where ivts_id='$subid'";
			$xcv=mysqli_query($link,$sqlsub2) or die(mysqli_error($link));
		}
	}
}
?>

<?php 
 $tid=$mainid;
 $subtid=0;
 
$sql1=mysqli_query($link,"select * from tbl_ivtmain where ivt_id=$tid and plantcode='$plantcode'")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);

$tdate=$row['ivt_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;

$code="TVT".$row['ivt_tcode']."/".$row['ivt_yearid']."/".$row['ivt_logid'];	
 ?> 
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Add Inter Variety Transfer</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
           <td width="202" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID&nbsp;</td>
           <td width="268"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="183" height="24"  align="right"  valign="middle" class="tblheading">IVT&nbsp;Date&nbsp;</td>
           <td width="287" align="left"  valign="middle">&nbsp;<?php echo $tdate;?><input name="txtdate" type="hidden" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>" /></td>
</tr>
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['ivt_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Dark" height="25">
   <td width="202"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden"  class="tbltext" name="txtclass" value="<?php echo $noticia_class['cropid'];?>"  /></td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_pvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver = mysqli_fetch_array($itemqry);
?>            
<td align="right" valign="middle" class="tblheading">Production Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="vitem" >&nbsp;<?php echo $noticia_ver['popularname'];?><input type="hidden"  class="tbltext" name="txtitem" id="itm" value="<?php echo $noticia_ver['varietyid'];?>"  /></td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
  <?php 
$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trfromvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver2 = mysqli_fetch_array($itemqry2);

$itemqry3=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trtovariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver3 = mysqli_fetch_array($itemqry3);
?>            
	<td align="right" valign="middle" class="tblheading">Transfer From - Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="frvitem">&nbsp;<?php echo $noticia_ver2['popularname'];?><input type="hidden"  class="tbltext" name="txtfritem" id="fritm" value="<?php echo $noticia_ver2['varietyid'];?>"  /></td>
<td align="right" valign="middle" class="tblheading">Transfer To - Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="tovitem">&nbsp;<?php echo $noticia_ver3['popularname'];?><input type="hidden"  class="tbltext" name="txttoitem" id="toitm" value="<?php echo $noticia_ver3['varietyid'];?>"  /></td>
</tr>		
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
<td width="1%" align="center" valign="middle" class="tblheading">Inter Variety Transfer Lots(N)</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
	<td width="1%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Original Lot No.</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Entire/Partial</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">New Lot No.</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="9%" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="3%" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>

<?php
$sr=1;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_ivtsub where ivt_id=$tid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage='Condition';
$olotn=$row_eindent_sub['ivts_olotno'];
$lotn=$row_eindent_sub['ivts_nlotno'];
$onob=$row_eindent_sub['ivts_onob'];
$oqty=$row_eindent_sub['ivts_oqty'];
$ttntyp=$row_eindent_sub['ivts_trnall'];
if($ttntyp=="E")$ttntyp="Entire";
if($ttntyp=="P")$ttntyp="Partial";
$slups=0; $slqty=0; $sloc=""; 
$sql_tblissue=mysqli_query($link,"select * from tbl_ivtsub_sub2 where ivt_id='".$tid."' and ivts_id='".$row_eindent_sub['ivts_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ivtss2_nob'];
$slqty=$slqty+$row_tblissue['ivtss2_qty'];

$wareh=""; $binn=""; $subbinn="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tblissue['ivtss2_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tblissue['ivtss2_subbin']."' and binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($sloc!="")
$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
else
$sloc=$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
}

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $onob;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $oqty;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $ttntyp;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $sloc;?></td>
	<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $onob;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $oqty;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $ttntyp;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $sloc;?></td>
	<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
</table>
<br />
<div id="postingsub">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Select Lot No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<a href="Javascript:void(0);" onclick="getdetails();">Get Details</a>&nbsp;(After selection of lot, click on 'Get Details')</td>
</tr>

</table>
<br />

<div id="maindiv" style="display:block"></div>	
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>