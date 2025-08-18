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

if(isset($_GET['txt11'])) { $txt11 = $_GET['txt11']; }
if(isset($_GET['txt14'])) { $txt14 = $_GET['txt14']; }
if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
if(isset($_GET['date'])) { $date = $_GET['date']; }
if(isset($_GET['txtcrop'])) { $txtcrop= $_GET['txtcrop']; }
if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety'];	}
if(isset($_GET['txtdrefno'])) { $txtdrefno = $_GET['txtdrefno']; }
if(isset($_GET['itmdchk'])) { $itmdchk = $_GET['itmdchk']; }
if(isset($_GET['txtstage'])) { $txtstage = $_GET['txtstage']; }
if(isset($_GET['txtlot1'])) { $txtlot1= $_GET['txtlot1']; }
if(isset($_GET['txtlotnoid'])) { $txtlotnoid = $_GET['txtlotnoid']; }
if(isset($_GET['txtlotno'])) { $txtlotno = $_GET['txtlotno']; }

if(isset($_GET['extslwhg1'])) { $extslwhg1 = $_GET['extslwhg1']; }
if(isset($_GET['extslbing1'])) { $extslbing1 = $_GET['extslbing1']; }
if(isset($_GET['extslsubbg1'])) { $extslsubbg1 = $_GET['extslsubbg1']; }
if(isset($_GET['txtdisp1'])) { $txtdisp1 = $_GET['txtdisp1']; }
if(isset($_GET['txtqty1'])) { $txtqty1 = $_GET['txtqty1']; }
if(isset($_GET['samebin1'])) { $samebin1 = $_GET['samebin1']; }
if(isset($_GET['txtslwhg1'])) { $txtslwhg1 = $_GET['txtslwhg1']; }
if(isset($_GET['txtslbing1'])) { $txtslbing1 = $_GET['txtslbing1']; }
if(isset($_GET['txtslsubbg1'])) { $txtslsubbg1 = $_GET['txtslsubbg1']; }
if(isset($_GET['recqtyp1'])) { $recqtyp1 = $_GET['recqtyp1']; }
if(isset($_GET['txtrecbagp1'])) { $txtrecbagp1 = $_GET['txtrecbagp1']; }
if(isset($_GET['txtdqtyp1'])) { $txtdqtyp1 = $_GET['txtdqtyp1']; }
if(isset($_GET['txtdbagp1'])) { $txtdbagp1 = $_GET['txtdbagp1']; }

if(isset($_GET['srno2'])) { $srno2 = $_GET['srno2']; }

if($srno2==2)
{
if(isset($_GET['extslwhg2'])) { $extslwhg2 = $_GET['extslwhg2']; }
if(isset($_GET['extslbing2'])) { $extslbing2 = $_GET['extslbing2']; }
if(isset($_GET['extslsubbg2'])) { $extslsubbg2 = $_GET['extslsubbg2']; }
if(isset($_GET['txtdisp2'])) { $txtdisp2 = $_GET['txtdisp2']; }
if(isset($_GET['txtqty2'])) { $txtqty2 = $_GET['txtqty2']; }
if(isset($_GET['samebin2'])) { $samebin2 = $_GET['samebin2']; }
if(isset($_GET['txtslwhg2'])) { $txtslwhg2 = $_GET['txtslwhg2']; }
if(isset($_GET['txtslbing2'])) { $txtslbing2 = $_GET['txtslbing2']; }
if(isset($_GET['txtslsubbg2'])) { $txtslsubbg2 = $_GET['txtslsubbg2']; }
if(isset($_GET['recqtyp2'])) { $recqtyp2 = $_GET['recqtyp2']; }
if(isset($_GET['txtrecbagp2'])) { $txtrecbagp2 = $_GET['txtrecbagp2']; }
if(isset($_GET['txtdqtyp2'])) { $txtdqtyp2 = $_GET['txtdqtyp2']; }
if(isset($_GET['txtdbagp2'])) { $txtdbagp2 = $_GET['txtdbagp2']; }
}

if(isset($_GET['txtdisptot'])) { $txtdisptot = $_GET['txtdisptot'];	}
if(isset($_GET['txtqtytot'])) { $txtqtytot = $_GET['txtqtytot']; }
if(isset($_GET['recqtyptot'])) { $recqtyptot = $_GET['recqtyptot']; }
if(isset($_GET['txtrecbagptot'])) { $txtrecbagptot = $_GET['txtrecbagptot']; }
if(isset($_GET['txtdqtyptot'])) { $txtdqtyptot= $_GET['txtdqtyptot']; }
if(isset($_GET['txtdbagptot'])) { $txtdbagptot= $_GET['txtdbagptot']; }

if(isset($_GET['datestart'])) { $datestart= $_GET['datestart']; }
if(isset($_GET['dateend'])) { $dateend= $_GET['dateend']; }
if(isset($_GET['txttottime'])) { $txttottime= $_GET['txttottime']; }
if(isset($_GET['txtdmtyp'])) { $txtdmtyp= $_GET['txtdmtyp']; }
if(isset($_GET['txtdid'])) { $txtdid= $_GET['txtdid']; }
	
if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }
	

//frm_action=submit&txt11=&txt14=&txtid=4&logid=PR1&date=24-08-2011&txtcrop=28&txtvariety=145&txtdrefno=sd45&itmdchk=0&txtstage=Raw&txtlot1=DN00164%2F00000R&txtlotnoid=&maintrid=0&subtrid=0&extslwhg1=58&extslbing1=125&extslsubbg1=1503&txtdisp1=10&txtqty1=150.000&chkbox1=samebin&samebin1=No&txtslwhg1=WH-02&txtslbing1=B1&txtslsubbg1=13&recqtyp1=9&txtrecbagp1=135&txtdqtyp1=15&txtdbagp1=10&extslwhg2=58&extslbing2=125&extslsubbg2=1502&txtdisp2=10&txtqty2=150.000&chkbox2=samebin&samebin2=No&txtslwhg2=WH-02&txtslbing2=B1&txtslsubbg2=12&recqtyp2=9&txtrecbagp2=125&txtdqtyp2=25&txtdbagp2=17&txtlotno=DN00164%2F00000R&txtdisptot=20&txtqtytot=300&recqtyptot=18&txtrecbagptot=260&txtdqtyptot=40&txtdbagptot=0.13&datestart=01-08-2011%2009%3A30%20AM&txtdmtyp=Floor&txtdid=01&dateend=02-08-2011%2005%3A30%20PM&txttottime=1%20days%2C%208%20hours%2C%20and%200%20minutes%20&srno2=2


//echo $a; echo $b; exit;
	
	$z1=$maintrid;	
		 $tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
if($z1 == 0)
{
$sql_main="insert into tbl_drying(arr_code, dryingdate, crop,  variety, drefno, logid, plantcode) values ('$txtid','$tdate1','$txtcrop','$txtvariety','$txtdrefno', '$logid', '$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

  $sql_sub="insert into tbl_dryingsub (lotno, trid, onob, oqty, nob1, qty1, adnob , adqty, sstage, dsdate, dedate, dtime, ddtype, ddid, plantcode) values ('$txtlotno', '$mainid', '$txtdisptot', '$txtqtytot', '$recqtyptot', '$txtrecbagptot', '$txtdqtyptot', '$txtdbagptot', '$txtstage', '$datestart', '$dateend', '$txttottime', '$txtdmtyp', '$txtdid', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$suid=mysqli_insert_id($link);
	$sql_sub="insert into tbl_dryingsubsub (subtrid, trid, owh, obin, osubbin, onob, oqty, nwh, nbin, nsubbin, nnob, nqty, dryingloss, dlossper, samebin, plantcode) values ('$suid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtdisp1', '$txtqty1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$recqtyp1', '$txtrecbagp1', '$txtdqtyp1', '$txtdbagp1', '$samebin1', '$plantcode')";
	mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	if($srno2==2)
	{
		$sql_sub="insert into tbl_dryingsubsub (subtrid, trid, owh, obin, osubbin, onob, oqty, nwh, nbin, nsubbin, nnob, nqty, dryingloss, dlossper, samebin, plantcode) values ('$suid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtdisp2', '$txtqty2', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$recqtyp2', '$txtrecbagp2', '$txtdqtyp2', '$txtdbagp2', '$samebin2', '$plantcode')";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	}

}
}
 $z1=$mainid;
}
else
{
$mainid=$z1;
   $sql_sub="update tbl_dryingsub set lotno='$txtlotno', trid='$mainid', onob='$txtdisptot', oqty='$txtqtytot', nob1='$recqtyptot', qty1='$txtrecbagptot', adnob='$txtdqtyptot', adqty='$txtdbagptot', sstage='$txtstage', dsdate='$datestart', dedate='$dateend', dtime='$txttottime', ddtype='$txtdmtyp', ddid='$txtdid' where  subtrid='".$subtrid."' ";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$s_sub="delete from tbl_dryingsubsub where subtrid='".$subtrid."' and trid='".$mainid."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	//$suid=mysqli_insert_id($link);
	$sql_sub="insert into tbl_dryingsubsub (subtrid, trid, owh, obin, osubbin, onob, oqty, nwh, nbin, nsubbin, nnob, nqty, dryingloss, dlossper, samebin, plantcode) values ('$subtrid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtdisp1', '$txtqty1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$recqtyp1', '$txtrecbagp1', '$txtdqtyp1', '$txtdbagp1', '$samebin1', '$plantcode')";
	mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	if($srno2==2)
	{
		$sql_sub="insert into tbl_dryingsubsub (subtrid, trid, owh, obin, osubbin, onob, oqty, nwh, nbin, nsubbin, nnob, nqty, dryingloss, dlossper, samebin, plantcode) values ('$subtrid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtdisp2', '$txtqty2', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$recqtyp2', '$txtrecbagp2', '$txtdqtyp2', '$txtdbagp2', '$samebin2', '$plantcode')";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	}

}
}
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<?php  

 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_drying where trid='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);*/
$subtid=0;
?>	

<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Drying Slip </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRD".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" class="tbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="25" />   <input type="hidden" class="tbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input type="text" class="tbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="25" />   <input type="hidden" class="tbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
           </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Drying slip reference No. &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdrefno" type="text" size="20" class="tbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['drefno']?>" /></td>
	</tr>

</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">

  <?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
    <tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
			   <td width="89" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No. </td>
			   <td width="110" align="center" valign="middle" class="smalltblheading" rowspan="2">Existing SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading"  colspan="2">Before Drying </td>
			    <td width="110" align="center" valign="middle" class="smalltblheading"rowspan="2" >Updated SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying  </td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
			   <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying Start</td>
			    <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying End</td>
				<td width="91" align="center" valign="middle" class="smalltblheading" rowspan="2">Total D.Time</td>
				 <td width="49" align="center" valign="middle" class="smalltblheading" rowspan="2">Drying Details</td>
              <td width="20" align="center" valign="middle" class="smalltblheading" rowspan="2">Edit</td>
              <td width="35" align="center" valign="middle" class="smalltblheading"rowspan="2" >Delete</td>
  </tr>
  <tr class="tblsubtitle">
                    <td width="40" align="center" valign="middle" class="smalltblheading" >NoB</td>
                    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="40" align="center" valign="middle" class="smalltblheading">NoB</td>
                    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="40" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="35" align="center" valign="middle" class="smalltblheading">%</td>
                            </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++;
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_dryingsubsub where subtrid='".$row_tbl_sub['subtrid']."' and trid='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['owh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['osubbin']."' and binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['nwh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars']."/";

$sql_binn1=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname']."/";

$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['nsubbin']."' and binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];

$nb1=$row_tbl_subsub['onob']; 
//$qt1=$row_tbl_subsub['oqty']; 
$nb2=$row_tbl_subsub['nnob']; 
//$qt2=$row_tbl_subsub['nqty'];

$diq=explode(".",$row_tbl_subsub['oqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_subsub['nqty']);
if($diq[1]==000){$qt2=$diq[0];}else{$qt2=$row_tbl_subsub['nqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}

if($sloc1!=""){
$sloc1=$sloc1."<BR/>".$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}
else{
$sloc1=$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}

}	
$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $difq1;?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	 <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        <td width="20" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $difq1;?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        <td width="20" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
  <div id="postingsubtable" style="display:block">	
       <table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<select class="tbltext" name="txtstage" style="width:170px;" onchange="modetchk22(this.value)">
<option value="" selected>--Select Stage--</option>
<option value="Raw" >Raw</option>
<option value="Condition" >Condition</option>
<!--<option value="Pack" >Pack</option>-->
</select>
              <font color="#FF0000">*</font>&nbsp;</td>
</tr>			  
<tr class="Light" height="30">

           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	</tr> 
	</table>
	
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
	
<div id="postingsubsubtable" style="display:block">
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>	</div>
</div>
