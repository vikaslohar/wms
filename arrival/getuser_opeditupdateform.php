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


//frm_action=submit&txt11=&txt14=&txtid=1&logid=AR1&date=18-04-2011&itmdchk=0&txtcrop=51&txtvariety=248&txtstage=Raw&pcode=G&ycodee=D&txtlot2=11111&stcode=00000&txtslwhg1=57&txtslbing1=104&txtslsubbg1=1072&txtslBagsg1=10&txtslqtyg1=1000&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&txtslBagsg2=&txtslqtyg2=&orowid2=0&maintrid=0&subtrid=0
	
	if(isset($_GET['txt11']))
	{
	$txt11 = $_GET['txt11'];	 
	}
	if(isset($_GET['txt14']))
	{
	$txt14 = $_GET['txt14'];	 
	}
	if(isset($_GET['txtid']))
	{
	$txtid = $_GET['txtid'];	 
	}
	if(isset($_GET['date']))
	{
	$date = $_GET['date'];	 
	}

	if(isset($_GET['itmdchk']))
	{
	$itmdchk = $_GET['itmdchk'];	 
	}
	if(isset($_GET['txtcrop']))
	{
	$txtcrop = $_GET['txtcrop'];	 
	}
	if(isset($_GET['txtvariety']))
	{
	$txtvariety = $_GET['txtvariety'];	 
	}
	
	if(isset($_GET['qcstatus']))
	{
	$qcstatus = $_GET['qcstatus'];	 
	}
	if(isset($_GET['edate']))
	{
	$edate = $_GET['edate'];	 
	}
	if(isset($_GET['txtpp']))
	{
	$txtpp = $_GET['txtpp'];	 
	}
	if(isset($_GET['txtmoist']))
	{
	$txtmoist = $_GET['txtmoist'];	 
	}
	if(isset($_GET['txtgemp']))
	{
	$txtgemp = $_GET['txtgemp'];	 
	}
	if(isset($_GET['txtgottyp']))
	{
	$txtgottyp = $_GET['txtgottyp'];	 
	}
	if(isset($_GET['gotstatus']))
	{
	$gotstatus = $_GET['gotstatus'];	 
	}
	if(isset($_GET['sdate']))
	{
	$sdate = $_GET['sdate'];	 
	}

	
	if(isset($_GET['txtstage']))
	{
	$txtstage= $_GET['txtstage'];	 
	}
	if(isset($_GET['pcode']))
	{
	$pcode = $_GET['pcode'];	 
	}
	if(isset($_GET['ycodee']))
	{
	$ycodee= $_GET['ycodee'];	
	}
	if(isset($_GET['txtlot2']))
	{
	$txtlot2= $_GET['txtlot2'];	
	}
	if(isset($_GET['stcode']))
	{
	$stcode = $_GET['stcode'];	 
	}
	if(isset($_GET['stcode2']))
	{
	$stcode2 = $_GET['stcode2'];	 
	}
	

	$god1=0;$god2=0;
	if(isset($_GET['txtslwhg1']))
	{
	$y = $_GET['txtslwhg1'];	 
	}
	if(isset($_GET['txtslbing1']))
	{
	$z = $_GET['txtslbing1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$a1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$b1 = $_GET['txtslqtyg1'];	 
	}
	if(isset($_GET['txtslBagsg1']))
	{
	$c1 = $_GET['txtslBagsg1'];	 
	}
	if(isset($_GET['gs1']))
	{
	$gs1 = $_GET['gs1'];	 
	}

//frm_action=submit&txt11=&txt14=&txtid=1&logid=AR1&date=18-04-2011&itmdchk=0&txtcrop=51&txtvariety=248&txtstage=Raw&pcode=G&ycodee=D&txtlot2=11111&stcode=00000&txtslwhg1=57&txtslbing1=104&txtslsubbg1=1072&txtslBagsg1=10&txtslqtyg1=1000&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&txtslBagsg2=&txtslqtyg2=&orowid2=0&maintrid=0&subtrid=0	
	if(isset($_GET['txtslwhg2']))
	{
	$d1 = $_GET['txtslwhg2'];	 
	}
	if(isset($_GET['txtslbing2']))
	{
	$e1= $_GET['txtslbing2'];	 
	}
	if(isset($_GET['txtslsubbg2']))
	{
	$f1 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$g1 = $_GET['txtslqtyg2'];	 
	}
	if(isset($_GET['txtslBagsg2']))
	{
	$h1 = $_GET['txtslBagsg2'];	 
	}

	$good1=0;$good2=0;
	
	if($b1!="" && $b1 > 0)
	{
	$good1=1; $god1=1;
	if(isset($_GET['orowid1']))
	{
	$rowid1 = $_GET['orowid1'];	 
	}
	}
	if($g1!="" && $g1 > 0)
	{
	$good2=1; $god2=1;
	if(isset($_GET['orowid2']))
	{
	$rowid2 = $_GET['orowid2'];	 
	}
	}

//		main field for the query i.e. if its is 0 then insert query should run & insblock should be replaced else the query should be update query & updblock should be replaced.
	
	if(isset($_GET['maintrid']))
	{
	  $z1 = $_GET['maintrid'];	 
	}

	if(isset($_GET['subtrid']))
	{
	  $subtrid = $_GET['subtrid'];	 
	}
	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
	if(isset($_GET['txtactnob']))
	{
	$txtactnob = $_GET['txtactnob'];	 
	}
	if(isset($_GET['txtactqty']))
	{
	$txtactqty = $_GET['txtactqty'];	 
	}

//frm_action=submit&txt11=&txt14=&txtid=1&logid=AR1&date=18-04-2011&itmdchk=0&txtcrop=51&txtvariety=248&txtstage=Raw&pcode=G&ycodee=D&txtlot2=11111&stcode=00000&txtslwhg1=57&txtslbing1=104&txtslsubbg1=1072&txtslBagsg1=10&txtslqtyg1=1000&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&txtslBagsg2=&txtslqtyg2=&orowid2=0&maintrid=0&subtrid=0
	
		$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
		$edate1=explode("-",$edate);
		$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
		
		$sdate1=explode("-",$sdate);
		$dogt=$sdate1[2]."-".$sdate1[1]."-".$sdate1[0];
		
if($txtstage=="Raw") $chr="R";
if($txtstage=="Condition") $chr="C";		
if($txtstage=="Pack") $chr="P";

if($qcstatus!="Ok" || $qcstatus!="Fail")$edate="";
if($gotstatus!="Ok" || $gotstatus!="Fail")$sdate="";

$sstatus="";
$got=$txtgottyp;
$gotstatus1=$txtgottyp." ".$gotstatus;
$glotno=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2.$chr;	
$gln=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2;	

if($z1 == 0)
{
  $sql_main="insert into tblarrival (yearcode, arrival_type, arrival_code, arrival_date, arr_role, plantcode)values('$yearid_id', 'Opening Stock', '$txtid', '$date', '$logid', '$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tblarrival_sub (arrival_id, lotcrop, lotvariety, moisture, gemp, vchk, qc, testd, sstage, sstatus, lotno, got, got1, orlot, gotdate,act,qty,act1,qty1, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtmoist', '$txtgemp', '$txtpp', '$qcstatus', '$dot', '$txtstage', '$sstatus', '$glotno', '$got', '$gotstatus1', '$gln', '$dogt','$txtactqty','$txtactqty','$txtactnob','$txtactnob', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Opening Stock', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$b1', '$c1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Opening Stock', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$g1', '$h1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
$z1=$mainid;
}
else
{
$sql_main="update tblarrival set yearcode='$yearid_id', arrival_type='Opening Stock', arrival_code='$txtid', arrival_date='$date', arr_role='$logid'  where arrival_id = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;

$sql_sub="update tblarrival_sub set arrival_id='$mainid', lotcrop='$txtcrop', lotvariety='$txtvariety', moisture='$txtmoist', gemp='$txtgemp', vchk='$txtpp', qc='$qcstatus', testd='$dot', sstage='$txtstage', sstatus='$sstatus', lotno='$glotno', got='$got', got1='$gotstatus1', orlot='$gln', gotdate='$dogt',act='$txtactqty',qty='$txtactqty',act1='$txtactnob',qty1='$txtactnob' where arrsub_id='$subtrid'";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=$subtrid;
$sql_del=mysqli_query($link,"delete from tblarr_sloc where arr_id='$subtrid'") or die(mysqli_error($link));

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Opening Stock', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$b1', '$c1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Opening Stock', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$g1', '$h1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
  <?php
 $tid=$z1;
?>
    <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Opening Stock' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
				<td width="32" align="center" valign="middle" class="tblheading">#</td>
			    <td width="189" align="center" valign="middle" class="tblheading">Crop</td>
			    <td width="201" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="124" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="55" align="center" valign="middle" class="tblheading">NoB</td>
                <td width="63" align="center" valign="middle" class="tblheading">Qty</td>
				<td width="82" align="center" valign="middle" class="tblheading">Stage</td>
			    <td width="82" align="center" valign="middle" class="tblheading">QC Status</td>
		        <td width="82" align="center" valign="middle" class="tblheading">DoT</td>
		        <td width="82" align="center" valign="middle" class="tblheading">PP</td>
		        <td width="82" align="center" valign="middle" class="tblheading">Moist %</td>
		        <td width="82" align="center" valign="middle" class="tblheading">Gemp %</td>
		        <td width="82" align="center" valign="middle" class="tblheading">GOT Status</td>
		        <td width="82" align="center" valign="middle" class="tblheading">DoGT</td>
			    <td width="95" align="center" valign="middle" class="tblheading">SLOC</td>
			    <td width="34" align="center" valign="middle" class="tblheading">Edit</td>
    			<td width="53" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}

	$trdate=$row_tbl_sub['testd'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$tdate1=$row_tbl_sub['gotdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
if($row_tbl_sub['qc']!="OK" && $row_tbl_sub['qc']!="Fail")
{
$trdate="--";
}
$ssss=explode(" ", $row_tbl_sub['got1']);

if($ssss[1]!="OK" && $ssss[1]!="Fail")
{
$tdate1="--";
}	


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
   <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['balbags']; 
$slqty=$slqty+$row_sloc['balqty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}
?>	
	<td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php if($row_tbl_sub['gemp'] > 0 ) echo $row_tbl_sub['gemp'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php if($tdate1!="--"){ echo $tdate1;}?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Opening Stock');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['balbags']; 
$slqty=$slqty+$row_sloc['balqty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}
?>	
	<td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php if($row_tbl_sub['gemp'] > 0 ) echo $row_tbl_sub['gemp'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php if($tdate1!="--"){ echo $tdate1;}?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Opening Stock');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>
 <div id="postingsubtable" style="display:block">		 
		<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="107" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropname'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="135" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['popularname'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

<tr class="Light" height="30" >
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchk();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />
	  &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotcheck"><input type="hidden" name="lotcheck1" value="0" /></div></td>	
	   		 
           <td align="right"  valign="middle" class="tblheading">Stage &nbsp;</td>
           <td align="left" width="332" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<select class="tbltext" id="txtstage" name="txtstage" style="width:120px;"  onchange="gotschk(this.value)">
<option value="" selected>--Select--</option>
<!--<option value="Raw" >Raw</option>-->
<option value="Condition">Condition</option>
<!--<option value="Pack">Pack</option>-->
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;
</td>
  
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="txtactqty" type="text" size="9" class="tbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="4" >Quality Details</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="qcstatus" style="width:100px;"  onchange="varchk(this.value);"  >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
	<option value="UT" >UT</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">Date of Test (DoT)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="edate" id="edate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('edate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
           </tr>
<tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpp" style="width:110px;" onchange="qcchk();">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex="" onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
           </tr>
		   		   
		   <tr class="Light" height="30">
	  <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="txtgemp" id="txtgerm" type="text" size="1" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);"/>%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgottyp" style="width:80px;" onchange="gempchk()">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>   
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="gotstatus" style="width:100px;" onchange="gottypchk();" >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
	<option value="UT" >UT</option>
    
  </select><font color="#FF0000">*</font>	</td>            
 <td width="196" align="right" valign="middle" class="tblheading">&nbsp;Date of GOT Test (DoGT)&nbsp;</td>
    <td width="196" align="left" valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dogtchk('sdate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>            
          </tr>
			   
</table>
<div id="subsubdivgood" style="display:block">
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
