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

if(isset($_GET['date'])) { 	$date= $_GET['date'];	 }
else { $date=""; }
if(isset($_GET['txt11'])) { $txt11 = $_GET['txt11']; }
else { $txt11=""; }
if(isset($_GET['txtslflchk'])) { $txtslflchk = $_GET['txtslflchk']; }
else { $txtslflchk=""; }
if(isset($_GET['txtptyp'])) { $txtptyp = $_GET['txtptyp']; }
else { $txtptyp=""; }
if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
else { $txtid=""; }
if(isset($_GET['txtconchk'])) { $txtconchk = $_GET['txtconchk']; }
else { $txtconchk=""; }
if(isset($_GET['txtupschk'])) { $txtupschk = $_GET['txtupschk']; }
else { $txtupschk=""; }
if(isset($_GET['txtordno'])) { $txtordno= $_GET['txtordno']; }
else { $txtordno=""; }
if(isset($_GET['txtporf'])) { $txtporf = $_GET['txtporf']; }
else { $txtporf=""; }
if(isset($_GET['txtparty'])) { $txtparty = $_GET['txtparty']; }
else { $txtparty=""; }

if(isset($_GET['txtparty1'])) { $txtparty1 = $_GET['txtparty1']; }
else { $txtparty1=""; }
if(isset($_GET['txtadd1'])) { $txtadd1= $_GET['txtadd1']; }
else { $txtadd1=""; }
if(isset($_GET['txtcity1'])) { $txtcity1 = $_GET['txtcity1']; }
else { $txtcity1=""; }
if(isset($_GET['txtstate1'])) { $txtstate1 = $_GET['txtstate1']; }
else { $txtstat1e=""; }
if(isset($_GET['txtpin1'])) { $txtpin1 = $_GET['txtpin1']; }
else { $txtpin1=""; }
if(isset($_GET['pstd1'])) { $pstd1 = $_GET['pstd1']; }
else { $pstd1=""; }
if(isset($_GET['pphno1'])) { $pphno1 = $_GET['pphno1']; }
else { $pphno1=""; }
if(isset($_GET['txtcontact1'])) { $txtcontact1 = $_GET['txtcontact1']; }
else { $txtcontact1=""; }
if(isset($_GET['txttin'])) { $txttin = $_GET['txttin']; }
else { $txttin=""; }
if(isset($_GET['txtpan'])) { $txtccst = $_GET['txtpan']; }
else { $txtpan=""; }

if(isset($_GET['txtpp'])) { $party= $_GET['txtpp']; }
else { $party=""; }
if($party=="CandF")
	{
	$party="C&F";
	}
	if($party=="C")
	{
	$party="C&F";
	}
if($party!="Export Buyer")
{
if(isset($_GET['txtparty2'])) { $txtparty2 = $_GET['txtparty2']; }
else { $txtparty2=""; }
if(isset($_GET['txtadd2'])) { $txtadd2= $_GET['txtadd2']; }
else { $txtadd2=""; }
if(isset($_GET['txtcity2'])) { $txtcity2 = $_GET['txtcity2']; }
else { $txtcity2=""; }
if(isset($_GET['txtstate2'])) { $txtstate2 = $_GET['txtstate2']; }
else { $txtstate2=""; }
if(isset($_GET['txtpin2'])) { $txtpin2 = $_GET['txtpin2']; }
else { $txtpin2=""; }
if(isset($_GET['pstd2'])) { $pstd2 = $_GET['pstd2']; }
else { $pstd2=""; }
if(isset($_GET['pphno2'])) { $pphno2 = $_GET['pphno2']; }
else { $pphno2=""; }
if(isset($_GET['txtcontact2'])) { $txtcontact2 = $_GET['txtcontact2']; }
else { $txtcontact2=""; }
if(isset($_GET['txttin2'])) { $txtctin2 = $_GET['txttin2']; }
else { $txttin2=""; }
if(isset($_GET['txtpan2'])) { $txtccst2 = $_GET['txtpan2']; }
else { $txtpan2=""; }
}
else
{
if(isset($_GET['txtparty2country'])) { $txtparty2 = $_GET['txtparty2country']; }
else { $txtparty2=""; }
if(isset($_GET['txtadd2country'])) { $txtadd2= $_GET['txtadd2country']; }
else { $txtadd2=""; }
if(isset($_GET['txtcity2country'])) { $txtcity2 = $_GET['txtcity2country']; }
else { $txtcity2=""; }
if(isset($_GET['txtstate2country'])) { $txtstate2 = $_GET['txtstate2country']; }
else { $txtstate2=""; }
if(isset($_GET['txtpin2country'])) { $txtpin2 = $_GET['txtpin2country']; }
else { $txtpin2=""; }
if(isset($_GET['pstd2country'])) { $pstd2 = $_GET['pstd2country']; }
else { $pstd2=""; }
if(isset($_GET['pphno2country'])) { $pphno2 = $_GET['pphno2country']; }
else { $pphno2=""; }
if(isset($_GET['txtcontact2country'])) { $txtcontact2 = $_GET['txtcontact2country']; }
else { $txtcontact2=""; }
if(isset($_GET['txttin2country'])) { $txtctin2 = $_GET['txttin2country']; }
else { $txttin2=""; }
if(isset($_GET['txtpan2country'])) { $txtccst2 = $_GET['txtpan2country']; }
else { $txtpan2=""; }
}

if(isset($_GET['txtorderplby'])) { $txtorderplby= $_GET['txtorderplby']; }
else { $txtorderplby=""; }
if(isset($_GET['txt1'])) { $txt1 = $_GET['txt1']; }
else { $txt1=""; }
if(isset($_GET['txttname'])) { $txttname= $_GET['txttname']; }
else { $txttname=""; }
if(isset($_GET['txtlrn'])) { $txtlrn= $_GET['txtlrn']; }
else { $txtlrn=""; }
if(isset($_GET['txtvn'])) { $txtvn = $_GET['txtvn']; }
else { $txtvn=""; }
if(isset($_GET['txt13'])) { $txt13= $_GET['txt13']; }
else { $txt13=""; }
if(isset($_GET['txtcname'])) { $txtcname = $_GET['txtcname']; }
else { $txtcname=""; }
if(isset($_GET['txtdc'])) { $txtdc= $_GET['txtdc']; }
else { $txtdc=""; }
if(isset($_GET['txtpname'])) { $txtpname = $_GET['txtpname']; }
else { $txtpname=""; }
if(isset($_GET['txtcrop'])) { $txtcrop= $_GET['txtcrop']; }
else { $txtcrop=""; }
if(isset($_GET['txtvariety'])) { $txtvariety= $_GET['txtvariety']; }
else { $txtvariety=""; }
if(isset($_GET['txtup'])) { $txtup= $_GET['txtup']; }
else { $txtup=""; }
if(isset($_GET['srn'])) { $srn= $_GET['srn']; }
else { $srn=""; }
if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
else { $maintrid=""; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }
else { $subtrid=""; }
if(isset($_GET['txtremarks'])) { $txtremarks= $_GET['txtremarks']; }
else { $txtremarks=""; }

if(isset($_GET['txtstatesl'])) { $txtstatesl= $_GET['txtstatesl']; }
else { $txtstatesl=""; }

if(isset($_GET['txtlocationsl'])) { $txtlocationsl= $_GET['txtlocationsl']; }
else { $txtlocationsl=""; }

if(isset($_GET['txtvartyp'])) { $txtvartyp= $_GET['txtvartyp']; }
else { $txtvartyp=""; }

if(isset($_GET['txtcountrysl'])) { $txtcountrysl= $_GET['txtcountrysl']; }
else { $txtcountrysl=""; }

//frm_action=submit &txt11=By%20Hand &txtupschk=Yes &txtid=1 &logid=OB1 &txtslflchk=fillp &txtptyp= &txtconchk=Yes1 &txttranid=TOD1%2FD%2FOB1 &date=01-07-2010 &txtorno=TOR1%2FD%2FOB1 &txtporf=fdg45fdg &txtpt=fillp &txtparty=--Select-- &adddchk= &txtparty1=fgdfg &txtadd1=dfgfdg &txtcity1=fdg%20fdg%20gfdfg &txtpin1=465354 &txtstate1=Karnataka &pstd1=54656 &pphno1=465435635 &txtcontact1=546534 &txttin=fghfd657567 &txtpan=fcgdf546546vb &contxt=Yes1 &txtparty2=gfhgfh &txtadd2=gfhfdgh &txtcity2=gfd%20fdg &txtpin2=657657 &txtstate2=Bihar &pstd2=54654 &pphno2=5464564356 &txtcontact2=5463567657654 &txttin2=fgh6575647657 &txtpan2=dgfh54635fdh &txtorderplby=gfhgfdh%20%20fgfdggf &txt1=By%20Hand &txttname= &txtcname= &txtpname=fdgsfd%20fdgg &txtcrop=49 &txtvariety=232 &itmdchk= &itmdchk1= &txtup=Yes &txtupsdc_1=1.000%20Gms &txtqtydc_1=2 &txtnopdc_1=2000 &txtupsdc_2=5.000%20Gms &txtqtydc_2=2 &txtnopdc_2=400 &txtupsdc_3=6.000%20Gms &txtqtydc_3=2 &txtnopdc_3=333.3333333333333 &txtupsdc_4=10.000%20Gms &txtqtydc_4=2 &txtnopdc_4=200 &srn=4 &maintrid=0 &subtrid=0 &txtremarks=retrt &bbbb=
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;

if($txtslflchk=="fillp"){$party='';$orderm_country='';}
		
if($maintrid == 0)
{
 $sql_main="insert into tbl_orderm (orderm_code, orderm_date, orderm_porderno, orderm_partyrefno, orderm_partyselect, orderm_party_type, orderm_party, orderm_partyname, orderm_partyaddress, orderm_partycity, orderm_partystate, orderm_partypin, orderm_partyphstd, orderm_partyphno, orderm_partymobile, orderm_partytin, orderm_partypan, orderm_consigneeapp, orderm_consigneename, orderm_conadd, orderm_concity, orderm_conpin, orderm_constate, orderm_conphonestd, orderm_conphoneno, orderm_conmobile, orderm_contin, orderm_conpan, orderm_placedby, orderm_tmode, orderm_trname, orderm_lrno, orderm_vehno, orderm_paymode, orderm_cname,  orderm_docno, orderm_pname, yearcode, logid, remarks, order_trtype, orderm_locstate, orderm_location, orderm_country, plantcode) values ('$txtid', '$tdate', '$txtordno', '$txtporf', '$txtslflchk', '$party', '$txtparty', '$txtparty1', '$txtadd1', '$txtcity1', '$txtstate1', '$txtpin1', '$pstd1', '$pphno1', '$txtcontact1', '$txttin', '$txtpan', '$txtconchk', '$txtparty2', '$txtadd2', '$txtcity2', '$txtpin2', '$txtstate2', '$pstd2', '$pphno2', '$txtcontact2', '$txttin2', '$txtpan2', '$txtorderplby', '$txt11', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$ycode', '$logid', '$txtremarks', 'Order TDF','$txtstatesl','$txtlocationsl','$txtcountrysl', '$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);
$totq=0;
 $sql_sub="insert into tbl_order_sub (orderm_id, order_sub_crop, order_sub_variety_typ, order_sub_variety, order_sub_ups_type, plantcode) values ('$mainid','$txtcrop','$txtvartyp','$txtvariety','$txtup', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
for($i=1; $i<=$srn; $i++)
{
$ups=$_GET['txtupsdc_'.$i];
$qty=$_GET['txtqtydc_'.$i];
$nop=$_GET['txtnopdc_'.$i];
$stdpt=$_GET['stdptval_'.$i];
if($qty!="" || $qty>0)
{
$sql_sub_sub="insert into tbl_order_sub_sub (order_sub_id, orderm_id, order_sub_sub_ups, order_sub_sub_qty, order_sub_sub_nop, order_sub_sub_stdpt, order_sub_subbal_qty, plantcode) values('$subid', '$mainid', '$ups', '$qty', '$nop', '$stdpt', '$qty', '$plantcode')";
if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
	{ $totq=$totq+$qty; }
}	
}
$sql_subup="update tbl_order_sub set order_sub_tot_qty='$totq', order_sub_totbal_qty='$totq' where order_sub_id='$subid'";
mysqli_query($link,$sql_subup) or die(mysqli_error($link));
}
}
$maintrid=$mainid;
}
else
{
 $sql_main="update tbl_orderm set orderm_code='$txtid', orderm_date='$tdate', orderm_porderno='$txtordno', orderm_partyrefno='$txtporf', orderm_partyselect='$txtslflchk', orderm_party_type='$party', orderm_party='$txtparty', orderm_partyname='$txtparty1', orderm_partyaddress='$txtadd1', orderm_partycity='$txtcity1', orderm_partystate='$txtstate1', orderm_partypin='$txtpin1', orderm_partyphstd='$pstd1', orderm_partyphno='$pphno1', orderm_partymobile='$txtcontact1', orderm_partytin='$txttin', orderm_partypan='$txtpan', orderm_consigneeapp='$txtconchk', orderm_consigneename='$txtparty2', orderm_conadd='$txtadd2', orderm_concity='$txtcity2', orderm_conpin='$txtpin2', orderm_constate='$txtstate2', orderm_conphonestd='$pstd2', orderm_conphoneno='$pphno2', orderm_conmobile='$txtcontact2', orderm_contin='$txttin2', orderm_conpan='$txtpan2', orderm_placedby='$txtorderplby', orderm_tmode='$txt11', orderm_trname='$txttname', orderm_lrno='$txtlrn', orderm_vehno='$txtvn', orderm_paymode='$txt13', orderm_cname='$txtcname',  orderm_docno='$txtdc', orderm_pname='$txtpname', yearcode='$ycode', logid='$logid', remarks='$txtremarks', order_trtype='Order TDF', orderm_locstate='$txtstatesl', orderm_location='$txtlocationsl', orderm_country='$txtcountrysl' where orderm_id='$maintrid'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$maintrid;
$totq=0;
 $sql_sub="insert into tbl_order_sub (orderm_id, order_sub_crop, order_sub_variety_typ, order_sub_variety, order_sub_ups_type, plantcode) values ('$mainid','$txtcrop','$txtvartyp','$txtvariety','$txtup', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
for($i=1; $i<=$srn; $i++)
{
$ups=$_GET['txtupsdc_'.$i];
$qty=$_GET['txtqtydc_'.$i];
$nop=$_GET['txtnopdc_'.$i];
$stdpt=$_GET['stdptval_'.$i];
if($qty!="" || $qty>0)
{
$sql_sub_sub="insert into tbl_order_sub_sub (order_sub_id, orderm_id, order_sub_sub_ups, order_sub_sub_qty, order_sub_sub_nop, order_sub_sub_stdpt, order_sub_subbal_qty, plantcode) values('$subid', '$mainid', '$ups', '$qty', '$nop', '$stdpt', '$qty', '$plantcode')";
if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
	{ $totq=$totq+$qty; }
}
}
$sql_subup="update tbl_order_sub set order_sub_tot_qty='$totq', order_sub_totbal_qty='$totq' where order_sub_id='$subid'";
mysqli_query($link,$sql_subup) or die(mysqli_error($link));
}
}
}
$tid=$maintrid;		
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
 <?php
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order TDF' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$ordm_id=$row_tbl['orderm_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$ordm_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="17%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="20%" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="4%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="9%" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="3%" align="center" valign="middle" class="tblheading">Edit</td>
        <td width="8%" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		
$up=""; $up1=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="17%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="20%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="4%" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="8%" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
        <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order TDF');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="17%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="20%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="4%" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="8%" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
        <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order TDF');" /></td>
</tr>
<?php
}
$srno++;
}
}
?>
          </table>
		  <br />
		  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="106" align="right"  valign="middle" class="tblheading">Select Crop&nbsp;</td>
<td width="210" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
			  <td width="116" align="right"  valign="middle" class="tblheading">Select Variety Type&nbsp;</td>
<td width="112" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtvartyp" style="width:80px;" onchange="vartypechk(this.value)" >
<option value="" selected>--Select--</option>
<option value="Hybrid" >Hybrid</option>
<option value="OP" >OP</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="87" align="right"  valign="middle" class="tblheading" >Select Variety&nbsp;</td>
    <td width="205" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="cropchk();" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    </tr>
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" /><input type="hidden" name="itmdchk1" value="<?php echo $itmdchk1;?>" />
  
		<tr class="Light" height="25">
<td align="right" width="106" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Select UPS Type&nbsp;</td>
   <td colspan="5" align="left"  valign="middle" ><input name="txtup" type="radio" class="tbltext" value="Yes" onClick="clkp1(this.value);" />&nbsp;Standard&nbsp;&nbsp;<input name="txtup" type="radio" class="tbltext" value="No" onClick="clkp1(this.value);"  />&nbsp;Non-Standard&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="txtupschk" value="" />
</table> 
<div id="selectupst" style="display:none">
</div>
<div id="subsubdivgood" style="display:block"></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
