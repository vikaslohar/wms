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
if(isset($_GET['txt14'])) { $txt14 = $_GET['txt14']; }
else { $txt14=""; }
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
if(isset($_GET['txtstfp'])) { $txtstfp = $_GET['txtstfp']; }
else { $txtstfp=""; }
if(isset($_GET['txt12'])) { $txt12 = $_GET['txt12']; }
else { $txt12=""; }
if(isset($_GET['txtpp'])) { $party= $_GET['txtpp']; }
else { $party=""; }

if($party!="Export Buyer")
{
if(isset($_GET['txtparty'])) { $txtparty = $_GET['txtparty']; }
else { $txtparty=""; }
if(isset($_GET['txtadd'])) { $txtadd= $_GET['txtadd']; }
else { $txtadd=""; }
if(isset($_GET['txtcity'])) { $txtcity = $_GET['txtcity']; }
else { $txtcity=""; }
if(isset($_GET['txtstate'])) { $txtstate = $_GET['txtstate']; }
else { $txtstate=""; }
if(isset($_GET['txtpin'])) { $txtpin = $_GET['txtpin']; }
else { $txtpin=""; }
if(isset($_GET['pstd'])) { $pstd = $_GET['pstd']; }
else { $pstd=""; }
if(isset($_GET['pphno'])) { $pphno = $_GET['pphno']; }
else { $pphno=""; }
if(isset($_GET['txtcontact'])) { $txtcontact = $_GET['txtcontact']; }
else { $txtcontact=""; }
if(isset($_GET['txtctin'])) { $txtctin = $_GET['txtctin']; }
else { $txtctin=""; }
if(isset($_GET['txtccst'])) { $txtccst = $_GET['txtccst']; }
else { $txtccst=""; }
}
else
{
if(isset($_GET['txtpartycountry'])) { $txtparty = $_GET['txtpartycountry']; }
else { $txtparty=""; }
if(isset($_GET['txtaddcountry'])) { $txtadd= $_GET['txtaddcountry']; }
else { $txtadd=""; }
if(isset($_GET['txtcitycountry'])) { $txtcity = $_GET['txtcitycountry']; }
else { $txtcity=""; }
if(isset($_GET['txtstatecountry'])) { $txtstate = $_GET['txtstatecountry']; }
else { $txtstate=""; }
if(isset($_GET['txtpincountry'])) { $txtpin = $_GET['txtpincountry']; }
else { $txtpin=""; }
if(isset($_GET['pstdcountry'])) { $pstd = $_GET['pstdcountry']; }
else { $pstd=""; }
if(isset($_GET['pphnocountry'])) { $pphno = $_GET['pphnocountry']; }
else { $pphno=""; }
if(isset($_GET['txtcontactcountry'])) { $txtcontact = $_GET['txtcontactcountry']; }
else { $txtcontact=""; }
if(isset($_GET['txtctincountry'])) { $txtctin = $_GET['txtctincountry']; }
else { $txtctin=""; }
if(isset($_GET['txtccstcountry'])) { $txtccst = $_GET['txtccstcountry']; }
else { $txtccst=""; }
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

//frm_action=submit &txt11=Transport &txt14=TBB &txtid=1 &logid=OR1 &gln1= &txtconchk=Yes &txtupschk=Yes &txttranid=TOS1%2FD%2FOR1 &date=25-06-2010 &txtordno=ORS%2FD%2F1 &txtporf=123456 &txtstfp=105 &txt12=Yes &txtparty=ABC &txtadd=XYZ &txtcity=AAA &txtpin=111111 &txtstate=Andhra%20Pradesh &pstd=02457 &pphno=447859556 &txtcontact=9874665464 &txtctin=67964 &txtccst=646797987654563 &txtorderplby=Sharma &txt1=Transport &txttname=TMZ &txtlrn=a56466 &txtvn=cc77c6464 &txt13=TBB &txtcname= &txtdc= &txtpname= &txtcrop=49 &txtvariety=232 &itmdchk= &txtup=Yes &txtupsdc_1=1.000%20Gms &txtqtydc_1= &txtnopdc_1= &txtupsdc_2=5.000%20Gms &txtqtydc_2=5 &txtnopdc_2=1000 &txtupsdc_3=6.000%20Gms &txtqtydc_3= &txtnopdc_3= &txtupsdc_4=10.000%20Gms &txtqtydc_4=10 &txtnopdc_4=1000 &srn=4 &abc= &maintrid=0 &subtrid=0 &txtremarks=

		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
	$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
	$noticia3 = mysqli_fetch_array($quer3);
	$ycode=$noticia3['ycode'];
		
if($maintrid == 0)
{
 	$sql_main="insert into tbl_orderm (orderm_code, orderm_date, orderm_porderno, orderm_partyrefno, orderm_party, orderm_consigneeapp, orderm_consigneename, orderm_conadd, orderm_concity, orderm_conpin, orderm_constate, orderm_conphonestd, orderm_conphoneno, orderm_conmobile, orderm_contin, orderm_concst, orderm_placedby, orderm_tmode, orderm_trname, orderm_lrno, orderm_vehno, orderm_paymode, orderm_cname,  orderm_docno, orderm_pname, yearcode, logid, remarks, order_trtype, orderm_party_type, orderm_locstate, orderm_location, orderm_country, plantcode) values ('$txtid', '$tdate', '$txtordno', '$txtporf', '$txtstfp', '$txtconchk', '$txtparty', '$txtadd', '$txtcity', '$txtpin', '$txtstate', '$pstd', '$pphno', '$txtcontact', '$txtctin', '$txtccst', '$txtorderplby', '$txt11', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$ycode', '$logid', '$txtremarks', 'Order Sales','$party','$txtstatesl','$txtlocationsl','$txtcountrysl', '$plantcode')";

	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);
		$totq=0;$otq=0;$oltq=0;
		$sql_sub="insert into tbl_order_sub (orderm_id, order_sub_crop, order_sub_variety_typ, order_sub_variety, order_sub_ups_type, plantcode) values ('$mainid','$txtcrop','$txtvartyp','$txtvariety','$txtup', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			for($i=1; $i<=$srn; $i++)
			{
				$ups=$_GET['txtupsdc_'.$i];
				$qty=$_GET['txtqtydc_'.$i];
				$lqty=$_GET['txtlqtydc_'.$i];
				$nop=$_GET['txtnopdc_'.$i];
				$pt=$_GET['txtuptypchk_'.$i];
				$stdpt=$_GET['stdptval_'.$i];
				$nowb=$_GET['txtnopwb_'.$i];
				$nomp=$_GET['txtnopmp_'.$i];
				$ortqty=$qty+$lqty;
				if($ortqty!="" && $ortqty>0)
				{
				 	$sql_sub_sub="insert into tbl_order_sub_sub (order_sub_id, orderm_id, order_sub_sub_ups, order_sub_sub_qty, order_sub_sub_nop, order_sub_sub_pt, order_sub_sub_stdpt, order_sub_sub_nowb, order_sub_sub_nomp, order_sub_subbal_qty, order_sub_subqty, order_sub_sublqty, plantcode) values('$subid', '$mainid', '$ups', '$ortqty', '$nop', '$pt', '$stdpt', '$nowb', '$nomp', '$ortqty', '$qty', '$lqty', '$plantcode')";
					if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
					{ $totq=$totq+$ortqty;$otq=$otq+$qty;$oltq=$oltq+$lqty; }
				}	
			}
		$sql_subup="update tbl_order_sub set order_sub_tot_qty='$totq', order_sub_totbal_qty='$totq', order_sub_qty='$otq', order_sub_lqty='$oltq' where order_sub_id='$subid'";
		mysqli_query($link,$sql_subup) or die(mysqli_error($link));
		}
	}
	$maintrid=$mainid;
}
else
{
 	$sql_main="update tbl_orderm set orderm_code='$txtid', orderm_date='$tdate', orderm_porderno='$txtordno', orderm_partyrefno='$txtporf', orderm_party='$txtstfp', orderm_consigneeapp='$txtconchk', orderm_consigneename='$txtparty', orderm_conadd='$txtadd', orderm_concity='$txtcity', orderm_conpin='$txtpin', orderm_constate='$txtstate', orderm_conphonestd='$pstd', orderm_conphoneno='$pphno', orderm_conmobile='$txtcontact', orderm_contin='$txtctin', orderm_concst='$txtccst', orderm_placedby='$txtorderplby', orderm_tmode='$txt11', orderm_trname='$txttname', orderm_lrno='$txtlrn', orderm_vehno='$txtvn', orderm_paymode='$txt13', orderm_cname='$txtcname',  orderm_docno='$txtdc', orderm_pname='$txtpname', yearcode='$ycode', logid='$logid', remarks='$txtremarks', order_trtype='Order Sales' ,orderm_party_type='$party', orderm_locstate='$txtstatesl', orderm_location='$txtlocationsl', orderm_country='$txtcountrysl' where orderm_id='$maintrid'";

	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=$maintrid;
		
		$totq=0;$otq=0;$oltq=0;
		$sql_sub="update tbl_order_sub set orderm_id='$mainid', order_sub_crop='$txtcrop', order_sub_variety_typ='$txtvartyp', order_sub_variety='$txtvariety', order_sub_ups_type='$txtup' where order_sub_id='$subtrid'";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=$subtrid;
			$sql_del=mysqli_query($link,"delete from tbl_order_sub_sub where order_sub_id='$subtrid'") or die(mysqli_error($link));

			//$subid=mysqli_insert_id($link);
			for($i=1; $i<=$srn; $i++)
			{
				$ups=$_GET['txtupsdc_'.$i];
				$qty=$_GET['txtqtydc_'.$i];
				$lqty=$_GET['txtlqtydc_'.$i];
				$nop=$_GET['txtnopdc_'.$i];
				$pt=$_GET['txtuptypchk_'.$i];
				$stdpt=$_GET['stdptval_'.$i];
				$nowb=$_GET['txtnopwb_'.$i];
				$nomp=$_GET['txtnopmp_'.$i];
				$ortqty=$qty+$lqty;
				if($ortqty!="" && $ortqty>0)
				{
			 		$sql_sub_sub="insert into tbl_order_sub_sub (order_sub_id, orderm_id, order_sub_sub_ups, order_sub_sub_qty, order_sub_sub_nop, order_sub_sub_pt, order_sub_sub_stdpt, order_sub_sub_nowb, order_sub_sub_nomp, order_sub_subbal_qty, order_sub_subqty, order_sub_sublqty, plantcode) values('$subid', '$mainid', '$ups', '$ortqty', '$nop', '$pt', '$stdpt', '$nowb', '$nomp', '$ortqty', '$qty', '$lqty', '$plantcode')";
					if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
					{ $totq=$totq+$ortqty;$otq=$otq+$qty;$oltq=$oltq+$lqty; }
				}
			}
			$sql_subup="update tbl_order_sub set order_sub_tot_qty='$totq', order_sub_totbal_qty='$totq', order_sub_qty='$otq', order_sub_lqty='$oltq' where order_sub_id='$subid'";
			mysqli_query($link,$sql_subup) or die(mysqli_error($link));
		}
	}
}
$tid=$maintrid;		
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
 <?php
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order Sales' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$ordm_id=$row_tbl['orderm_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$ordm_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="10%" align="center" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="5%" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="12%" align="center" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="11%" align="center" valign="middle" class="tblheading">&nbsp;PV Variety</td>
		<td width="3%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="7%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="7%" align="center" valign="middle" class="tblheading">Total Qty (Kgs.)</td>
		<td width="6%" align="center" valign="middle" class="tblheading">SMC Qty (Kgs.)</td>
		<td width="6%" align="center" valign="middle" class="tblheading">L.Qty (Kgs.)</td>
        <td width="6%" align="center" valign="middle" class="tblheading">PT</td>
        <td width="4%" align="center" valign="middle" class="tblheading">Std MP</td>
        <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="5%" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
		<td width="4%" align="center" valign="middle" class="tblheading">Edit</td>
        <td width="5%" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1=""; $grtqty=0; $grsmqty=0; $grlqty=0; $getmp=""; $grtnop=0; $grtnowb=0; $getnomp=0;
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

$sql_pvveriety=mysqli_query($link,"select * from tblvariety where varietyid='".$p_1['pvverid']."' and actstatus='Active'") or die(mysqli_error($link));
$p_12=mysqli_fetch_array($sql_pvveriety);
$pvvariety=$p_12['popularname'];
		
$up=""; $up1=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz=""; $vtype=""; $smcqty=""; $lqty="";
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

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($smcqty!="")
$smcqty=$smcqty."<br />".$row_sloc['order_sub_subqty'];
else
$smcqty=$row_sloc['order_sub_subqty'];
 
if($lqty!="") 
$lqty=$lqty."<br />".$row_sloc['order_sub_sublqty'];
else
$lqty=$row_sloc['order_sub_sublqty'];

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

$grtqty=$grtqty+$qt1; 
$grsmqty=$grsmqty+$row_sloc['order_sub_subqty'];
$grlqty=$grlqty+$row_sloc['order_sub_sublqty'];
$grtnop=$grtnop+$row_sloc['order_sub_sub_nop'];
$grtnowb=$grtnowb+$nowb;
$getnomp=$getnomp+$nomp;

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
$vtype=$row_tbl_sub['order_sub_variety_typ'];

/*$grtqty=$grtqty+$qt; 
$grsmqty=$grsmqty+$smcqty;
$grlqty=$grlqty+$lqty;
$grtnop=$grtnop+$np;
$grtnowb=$grtnowb+$nowbp;
$getnomp=$getnomp+$nompp;
*/
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
		<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		<td width="10%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $vtype;?></td>
        <td width="12%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
		<td width="11%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $pvvariety;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><?php echo $up1;?></td>
		<td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
        <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $smcqty;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $lqty;?></td>
        <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $ptp;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $stdptv;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $np;?></td>
		<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $nowbp;?></td>
		<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $nompp;?></td>
		<td width="4%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order Sales');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		<td width="10%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $vtype;?></td>
        <td width="12%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
		<td width="11%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $pvvariety;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><?php echo $up1;?></td>
		<td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
        <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $smcqty;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $lqty;?></td>
        <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $ptp;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $stdptv;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $np;?></td>
		<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $nowbp;?></td>
		<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $nompp;?></td>
		<td width="4%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order Sales');" /></td>
</tr>
<?php
}$srno++;
}
}
?>
<tr class="Light" height="20">
    <td width="2%" align="right" valign="middle" class="smalltblheading" colspan="7">Grand Total&nbsp;</td>
    <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $grtqty;?></td>
	<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $grsmqty;?></td>
	<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $grlqty;?></td>
    <td width="6%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $grtnop;?></td>
	<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $grtnowb;?></td>
	<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $getnomp;?></td>
	<td width="3%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
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
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			  <td width="116" align="right"  valign="middle" class="tblheading">Select Variety Type&nbsp;</td>
<td width="112" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtvartyp" style="width:80px;" onchange="vartypechk(this.value)">
<option value="" selected>--Select--</option>
<option value="Hybrid" >Hybrid</option>
<option value="OP" >OP</option>
</select>
              <font color="#FF0000">*</font>&nbsp;</td>
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
<!--/*</table>
 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >*/--> 
  
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
<td valign="top" align="right" id="frmbutn" ><img src="../images/Post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
