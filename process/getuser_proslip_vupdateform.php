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

if(isset($_GET['protype'])) { $protype = $_GET['protype']; } 
if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
if(isset($_GET['date'])) { $date = $_GET['date']; }
if(isset($_GET['txtpsrn'])) { $txtpsrn= $_GET['txtpsrn']; }
if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop'];	}
if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }
if(isset($_GET['txtstage'])) { $txtstage = $_GET['txtstage']; }
if(isset($_GET['txtpromech'])) { $txtpromech = $_GET['txtpromech']; }
if(isset($_GET['txtoprname'])) { $txtoprname= $_GET['txtoprname']; }
if(isset($_GET['txttreattyp'])) { $txttreattyp = $_GET['txttreattyp']; }
if(isset($_GET['txtlot1'])) { $txtlot1 = $_GET['txtlot1']; }

if(isset($_GET['softstatus'])) { $softstatus = $_GET['softstatus']; }

if(isset($_GET['pdnum'])) { $pdnum = $_GET['pdnum']; }
if(isset($_GET['txtonob'])) { $txtonob = $_GET['txtonob']; }
if(isset($_GET['txtoqty'])) { $txtoqty = $_GET['txtoqty']; }
if(isset($_GET['protyp'])) { $protyp = $_GET['protyp']; }
if(isset($_GET['extslwhg1'])) { $extslwhg1 = $_GET['extslwhg1']; }
if(isset($_GET['extslbing1'])) { $extslbing1 = $_GET['extslbing1']; }
if(isset($_GET['extslsubbg1'])) { $extslsubbg1 = $_GET['extslsubbg1']; }
if(isset($_GET['txtextnob1'])) { $txtextnob1 = $_GET['txtextnob1']; }
if(isset($_GET['txtextqty1'])) { $txtextqty1 = $_GET['txtextqty1']; }
if(isset($_GET['recnobp1'])) { $recnobp1 = $_GET['recnobp1']; }
if(isset($_GET['recqtyp1'])) { $recqtyp1 = $_GET['recqtyp1']; }
if(isset($_GET['txtbalnobp1'])) { $txtbalnobp1 = $_GET['txtbalnobp1']; }
if(isset($_GET['txtbalqtyp1'])) { $txtbalqtyp1 = $_GET['txtbalqtyp1']; }

if(isset($_GET['srno2'])) { $srno2 = $_GET['srno2']; }

if($srno2==2)
{
if(isset($_GET['extslwhg2'])) { $extslwhg2 = $_GET['extslwhg2']; }
if(isset($_GET['extslbing2'])) { $extslbing2 = $_GET['extslbing2']; }
if(isset($_GET['extslsubbg2'])) { $extslsubbg2 = $_GET['extslsubbg2']; }
if(isset($_GET['txtextnob2'])) { $txtextnob2 = $_GET['txtextnob2']; }
if(isset($_GET['txtextqty2'])) { $txtextqty2 = $_GET['txtextqty2']; }
if(isset($_GET['recnobp2'])) { $recnobp2 = $_GET['recnobp2']; }
if(isset($_GET['recqtyp2'])) { $recqtyp2 = $_GET['recqtyp2']; }
if(isset($_GET['txtbalnobp2'])) { $txtbalnobp2 = $_GET['txtbalnobp2']; }
if(isset($_GET['txtbalqtyp2'])) { $txtbalqtyp2 = $_GET['txtbalqtyp2']; }
}

if(isset($_GET['txtconnob'])) { $txtconnob = $_GET['txtconnob'];	}
if(isset($_GET['txtconqty'])) { $txtconqty = $_GET['txtconqty']; }
if(isset($_GET['txtconrem'])) { $txtconrem = $_GET['txtconrem']; }
if(isset($_GET['txtconim'])) { $txtconim = $_GET['txtconim']; }
if(isset($_GET['txtconpl'])) { $txtconpl = $_GET['txtconpl']; }
if(isset($_GET['txtconloss'])) { $txtconloss= $_GET['txtconloss']; }
if(isset($_GET['txtconper'])) { $txtconper= $_GET['txtconper']; }

if(isset($_GET['txtslwhg1'])) { $txtslwhg1= $_GET['txtslwhg1']; }
if(isset($_GET['txtslbing1'])) { $txtslbing1= $_GET['txtslbing1']; }
if(isset($_GET['txtslsubbg1'])) { $txtslsubbg1= $_GET['txtslsubbg1']; }
if(isset($_GET['txtconslnob1'])) { $txtconslnob1= $_GET['txtconslnob1']; }
if(isset($_GET['txtconslqty1'])) { $txtconslqty1= $_GET['txtconslqty1']; }
if(isset($_GET['txtslwhg2'])) { $txtslwhg2= $_GET['txtslwhg2']; }
if(isset($_GET['txtslbing2'])) { $txtslbing2= $_GET['txtslbing2']; }
if(isset($_GET['txtslsubbg2'])) { $txtslsubbg2= $_GET['txtslsubbg2']; }
if(isset($_GET['txtconslnob2'])) { $txtconslnob2= $_GET['txtconslnob2']; }
if(isset($_GET['txtconslqty2'])) { $txtconslqty2= $_GET['txtconslqty2']; }

if(isset($_GET['txtremarks'])) { $txtremarks= $_GET['txtremarks']; }
	
if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }
	
//frm_action=submit&protype=E&txtid=12&date=15-09-2011&txtpsrn=P%2FN%2F001&txtcrop=28&txtvariety=145&txtstage=Raw&txtpromech=PM01&txtoprname=PO1&txttreattyp=TTC01&itmdchk=0&txtlot1=DN00204%2F00000R&maintrid=0&subtrid=0&pdnum=&txtonob=20&txtoqty=50&protyp=E&extslwhg1=57&extslbing1=174&extslsubbg1=2477&txtextnob1=10&txtextqty1=20&txtbalnobp1=0&txtbalqtyp1=0&extslwhg2=57&extslbing2=174&extslsubbg2=2478&txtextnob2=10&txtextqty2=30&txtbalnobp2=0&txtbalqtyp2=0&srno2=2&txtconnob=20&txtconqty=45&txtconrem=1&txtconim=1&txtconpl=3&txtconloss=5&txtconper=10&txtslwhg1=57&txtslbing1=174&txtslsubbg1=2479&txtconslnob1=10&txtconslqty1=25&txtslwhg2=57&txtslbing2=174&txtslsubbg2=2480&txtconslnob2=10&txtconslqty2=20&txtremarks=Testing%20of%20Processing%20Slip%20Transaction

if($txtstage=="Raw")
{
$ttype="Processing Slip";
$pl=$txtconpl;
$rpl="";
}
else if($txtstage=="Condition")
{
$ttype="Re-Processing Slip";
$pl="";
$rpl=$txtconpl;
}
else 
{
$ttype="";
$pl="";
$rpl="";
}
//echo $a; echo $b; exit;
$zz=str_split($txtlot1);
 $orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	
	$z1=$maintrid;
		
		 $tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
		/*$pnob=$txtextnob1+$txtextnob2;
		$pqty=$txtextqty1+$txtextqty2;*/
		$pnob=$recnobp1+$recnobp2;
		$pqty=$recqtyp1+$recqtyp2;
		
if($z1 == 0)
{
   $sql_main="insert into tbl_proslipmain(proslipmain_code, proslipmain_date, proslipmain_proslipno,  proslipmain_crop, proslipmain_variety, proslipmain_stage, proslipmain_promachcode, proslipmain_proopr, proslipmain_treattype, proslipmain_ttype, logid, yearid, plantcode) values ('$txtid','$tdate1','$txtpsrn','$txtcrop','$txtvariety','$txtstage', '$txtpromech', '$txtoprname', '$txttreattyp', '$ttype', '$logid', '$yearid_id', '$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

  $sql_sub="insert into tbl_proslipsub (proslipsub_lotno, proslipmain_id, proslipsub_onob, proslipsub_oqty, proslipsub_processtype, proslipsub_pnob, proslipsub_pqty , proslipsub_bnob, proslipsub_bqty, proslipsub_connob, proslipsub_conqty, proslipsub_rm, proslipsub_im, proslipsub_pl, proslipsub_rpl, proslipsub_tlqty, proslipsub_tlper, proslipsub_remarks, proslipsub_sstatus, proslipsub_orlot, plantcode) values ('$txtlot1', '$mainid', '$txtonob', '$txtoqty', '$protyp', '$pnob', '$pqty', '$txtbalnobp1', '$txtbalqtyp1', '$txtconnob', '$txtconqty', '$txtconrem', '$txtconim', '$pl', '$rpl', '$txtconloss', '$txtconper', '$txtremarks', '$softstatus', '$orlot', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$suid=mysqli_insert_id($link);
	
	$sql_sub="insert into tbl_proslipsubsub (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtextnob1', '$txtextqty1', '$recnobp1', '$recqtyp1', '$txtbalnobp1', '$txtbalqtyp1', '$plantcode')";
	mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	if($srno2==2)
	{
		$sql_sub="insert into tbl_proslipsubsub (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtextnob2', '$txtextqty2', '$recnobp2', '$recqtyp2', '$txtbalnobp2', '$txtbalqtyp2', '$plantcode')";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	}
	
	if($txtconslqty1!="")
	{
	$sql_sub2="insert into tbl_proslipsubsub2 (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '0', '0', '$txtconslnob1', '$txtconslqty1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
	mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	}
	if($txtconslqty2!="")
	{
		$sql_sub2="insert into tbl_proslipsubsub2 (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '0', '0', '$txtconslnob2', '$txtconslqty2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
		mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	}

}
}
 $z1=$mainid;
}
else
{
/*$sql_main="update tbl_drying set  dryingdate='$tdate1',crop='$o',variety='$p',stage='RSW'  where trid='$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{*/
$mainid=$z1;
  $sql_sub="insert into tbl_proslipsub (proslipsub_lotno, proslipmain_id, proslipsub_onob, proslipsub_oqty, proslipsub_processtype, proslipsub_pnob, proslipsub_pqty , proslipsub_bnob, proslipsub_bqty, proslipsub_connob, proslipsub_conqty, proslipsub_rm, proslipsub_im, proslipsub_pl, proslipsub_rpl, proslipsub_tlqty, proslipsub_tlper, proslipsub_remarks, proslipsub_sstatus, proslipsub_orlot, plantcode) values ('$txtlot1', '$mainid', '$txtonob', '$txtoqty', '$protyp', '$pnob', '$pqty', '$txtbalnobp1', '$txtbalqtyp1', '$txtconnob', '$txtconqty', '$txtconrem', '$txtconim', '$pl', '$rpl', '$txtconloss', '$txtconper', '$txtremarks', '$softstatus', '$orlot', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$suid=mysqli_insert_id($link);
	
	$sql_sub="insert into tbl_proslipsubsub (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtextnob1', '$txtextqty1', '$recnobp1', '$recqtyp1', '$txtbalnobp1', '$txtbalqtyp1', '$plantcode')";
	mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	if($srno2==2)
	{
		$sql_sub="insert into tbl_proslipsubsub (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtextnob2', '$txtextqty2', '$recnobp2', '$recqtyp2', '$txtbalnobp2', '$txtbalqtyp2', '$plantcode')";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	}
	
	if($txtconslqty1!="")
	{
	$sql_sub2="insert into tbl_proslipsubsub2 (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '0', '0', '$txtconslnob1', '$txtconslqty1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
	mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	}
	if($txtconslqty2!="")
	{
		$sql_sub2="insert into tbl_proslipsubsub2 (proslipsub_id, proslipmain_id, proslipsubsub_wh, proslipsubsub_bin, proslipsubsub_subbin, proslipsubsub_onob, proslipsubsub_oqty, proslipsubsub_pnob, proslipsubsub_pqty, proslipsubsub_bnob, proslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '0', '0', '$txtconslnob2', '$txtconslqty2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
		mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	}

}
}

?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<?php  
 
 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['proslipmain_id'];

$tdate=$row_tbl['proslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$subtid=0;
?>	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Processing Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="134" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="144"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['proslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="95" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="182" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>

<td width="137" align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['proslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['proslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="133" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="145" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['proslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="95" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="182" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="137" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['proslipmain_stage'];?>" size="20" /> &nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where promac_id='".$row_tbl['proslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row_tbl['proslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtpromech" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtoprname" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txttreattyp" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['proslipmain_treattype']?>" /></td>
	</tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$arrival_id."' and plantcode='$plantcode' order by proslipsub_id asc") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="100" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <!--<td width="10%" align="center" valign="middle" class="smalltblheading" colspan="2">Raw Seed </td>-->
	 <td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="60" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	 <td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
     <td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>

	 	 <td align="center" valign="middle" class="smalltblheading"  rowspan="2">IM </td>
<td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
		  <!--/*<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">QC Status </td>	 
		   <td width="12%" rowspan="3" align="center" valign="middle" class="smalltblheading">GOT Type </td>*/-->
    <td width="107" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="54" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    <td width="24" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
    <td width="39" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
  </tr>
   <tr class="tblsubtitle">
    
     <!--<td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="smalltblheading">%</td>-->
     <td width="45" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="4%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="2%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>-->
	    <td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="30" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_proslipsubsub2 where proslipsub_id='".$row_tbl_sub['proslipsub_id']."' and proslipmain_id='".$arrival_id."' and plantcode='$plantcode' order by proslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['proslipsubsub_bin']."' and whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['proslipsubsub_subbin']."' and binid='".$row_tbl_subsub['proslipsubsub_bin']."' and whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['proslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['proslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['proslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlper'];?></td>
	<td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['proslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['proslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['proslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="24" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['proslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['proslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlper'];?></td>
	<td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['proslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['proslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['proslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="24" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['proslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['proslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#adad11">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#adad11">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#adad11">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"></div></div>
