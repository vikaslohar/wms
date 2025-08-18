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

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$tid = $_GET['g'];	 
	}

if(isset($_GET['txt11']))
	{
	$a = $_GET['txt11'];	 
	}
	if(isset($_GET['txt14']))
	{
	$b = $_GET['txt14'];	 
	}
	if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}
	if(isset($_GET['txtgrn']))
	{
	$d = $_GET['txtgrn'];	 
	}
	if(isset($_GET['date']))
	{
	$e = $_GET['date'];	 
	}
	if(isset($_GET['dcdate']))
	{
    $ee1= $_GET['dcdate'];	 
	}
	if(isset($_GET['txtlot1']))
	{
	$f = $_GET['txtlot1'];	 
	}
	if(isset($_GET['txtdcno']))
	{
	$g = $_GET['txtdcno'];	 
	}
	if(isset($_GET['txtparty']))
	{
	$party = $_GET['txtparty'];	 
	}
	if(isset($_GET['txtor']))
	{
	$or = $_GET['txtor'];	 
	}
	if(isset($_GET['txttname']))
	{
	$i = $_GET['txttname'];	 
	}
	if(isset($_GET['txtlrn']))
	{
	$j = $_GET['txtlrn'];	 
	}
	if(isset($_GET['txtvn']))
	{
	$k = $_GET['txtvn'];	 
	}
	if(isset($_GET['txtcname']))
	{
	$l= $_GET['txtcname'];	 
	}
	if(isset($_GET['txtdc']))
	{
	$m = $_GET['txtdc'];	 
	}
	if(isset($_GET['txtarr']))
	{
	$vv= $_GET['txtarr'];	
	}
	if(isset($_GET['txtlot2']))
	{
	$lot2= $_GET['txtlot2'];	
	}
	if(isset($_GET['txtcrop']))
	{
	 $o= $_GET['txtcrop'];	 
	}
	if(isset($_GET['txtvariety']))
	{
 $p = $_GET['txtvariety'];	 
	}
	if(isset($_GET['gln1']))
	{
	$orlot = $_GET['gln1'];	 
	}
	
	/*$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='$o11'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		 $o=$row_crop['cropname'];
		
		$sql_veriety=mysqli_query($link,"select * from tblvariety where popularname='".$p1."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
		$p=mysqli_fetch_array($sql_veriety);
		$p=$row_variety['varietyid'];		
		$p=$o."-"."Coded";*/
//			End of Main table fields	
	
	
//			2nd table fields start

	
	if(isset($_GET['txtold']))
	{
	$n = $_GET['txtold'];	 
	}
	
	if(isset($_GET['txtdcqty']))
	{
	$txtdcqty= $_GET['txtdcqty'];	 
	}
	if(isset($_GET['txtactqty']))
	{
	$txtactqty= $_GET['txtactqty'];	 
	}
	if(isset($_GET['txtdiffqty']))
	{
	$txtdiffqty= $_GET['txtdiffqty'];	 
	}
	if(isset($_GET['txtdcnob']))
	{
	$txtdcnob= $_GET['txtdcnob'];	 
	}
	if(isset($_GET['txtactnob']))
	{
	$txtactnob= $_GET['txtactnob'];	 
	}
	if(isset($_GET['txtdiffnob']))
	{
	$txtdiffnob= $_GET['txtdiffnob'];	 
	}
	if(isset($_GET['txtmoist']))
	{
	$w = $_GET['txtmoist'];	 
	}
	if(isset($_GET['txtvisualck']))
	{
	$x = $_GET['txtvisualck'];	 
	}
	if(isset($_GET['qc']))
	{
	$qc = $_GET['qc'];	 
	}
	if(isset($_GET['txtstage']))
	{
	$st= $_GET['txtstage'];	 
	}
	if(isset($_GET['sstatus']))
	{
	$status= $_GET['sstatus'];	 
	}
	if(isset($_GET['glotno']))
	{
	$lotno= $_GET['glotno'];	 
	}
	if(isset($_GET['txtold1']))
	{
	$oldlot= $_GET['txtold1'];	 
	}
	
	if(isset($_GET['txtgot']))
	{
	$got= $_GET['txtgot'];	 
	}
	
	if(isset($_GET['txtgot1']))
	{
	$got1= $_GET['txtgot1'];	 
	}
	if(isset($_GET['qc1']))
	{
	$sample= $_GET['qc1'];	 
	}

//		end 2nd table fields


// start of 3rd table fields
	
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
	if(isset($_GET['balqty1']))
	{
	$balqty1 = $_GET['balqty1'];	 
	}
	if(isset($_GET['balBags1']))
	{
	$balbags1 = $_GET['balBags1'];	 
	}
	
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
	if(isset($_GET['balqty2']))
	{
	$balqty2 = $_GET['balqty2'];	 
	}
	if(isset($_GET['balBags2']))
	{
	$balbags2 = $_GET['balBags2'];	 
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


	
	
	
//		end of 3rd table fields

//		start of 2nd table fields
	
	if(isset($_GET['tblslocnod']))
	{
	$n1 = $_GET['tblslocnod'];	 
	}

// 		end of 2nd table fields

//		start of 3rd table fields
	
	if(isset($_GET['txtslwhd1']))
	{
	$o1 = $_GET['txtslwhd1'];	 
	}
	if(isset($_GET['txtslbind1']))
	{
	$p1 = $_GET['txtslbind1'];	 
	}
	if(isset($_GET['txtslsubbd1']))
	{
	$q1 = $_GET['txtslsubbd1'];	 
	}
	if(isset($_GET['txtslqtyd1']))
	{
	$r1 = $_GET['txtslqtyd1'];	 
	}
	if(isset($_GET['txtslupsd1']))
	{
	$s1 = $_GET['txtslupsd1'];	 
	}
	if(isset($_GET['txtslwhd2']))
	{
	$t1 = $_GET['txtslwhd2'];	 
	}
	if(isset($_GET['txtslbind2']))
	{
	$u1 = $_GET['txtslbind2'];	 
	}
	if(isset($_GET['txtslsubbd2']))
	{
	$v1 = $_GET['txtslsubbd2'];	 
	}
	if(isset($_GET['txtslqtyd2']))
	{
	$w1 = $_GET['txtslqtyd2'];	 
	}
	if(isset($_GET['txtslupsd2']))
	{
	$x1 = $_GET['txtslupsd2'];	 
	}
	
	$damage1=0;$damage2=0;
	
	if($r1!="" && $r1 > 0)
	{
	$damage1=1; $dam1=1;
	if(isset($_GET['dorowid1']))
	{
	$rowid4 = $_GET['dorowid1'];	 
	}
	
	}
	if($w1!="" && $w1 > 0)
	{
	$damage2=1; $dam2=1;
	if(isset($_GET['dorowid2']))
	{
	$rowid5 = $_GET['dorowid2'];	 
	}
	}
		
	$n1=$damage1+$damage2;
	
	
//		end of 3rd table fields

//		start of 2nd table fields	
	if(isset($_GET['txtremarks']))
	{
	$y1 = $_GET['txtremarks'];	 
	}
	
	if(isset($_GET['txtremarks1']))
	{
	$remarks = $_GET['txtremarks1'];	 
	}
// 		end of 2nd table fields


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
	
	if(isset($_GET['txtpname']))
	{
	$pname = $_GET['txtpname'];	 
	}
	if(isset($_GET['txtuom']))
	{
	$txtuom = $_GET['txtuom'];	 
	}
	if(isset($_GET['balqty1']))
	{
	$balqty1 = $_GET['balqty1'];	 
	}
	if(isset($_GET['balBags1']))
	{
	$balbags1 = $_GET['balBags1'];	 
	}
	if(isset($_GET['balqty2']))
	{
	$balqty2 = $_GET['balqty2'];	 
	}
	if(isset($_GET['balBags2']))
	{
	$balbags2 = $_GET['balBags2'];	 
	}
	if(isset($_GET['txtparty']))
	{
	  $party= $_GET['txtparty'];	 
	}
	
	if(isset($_GET['txtloc']))
	{
	  $loc= $_GET['txtloc'];	 
	}
		if(isset($_GET['gs1']))
	{
	$gs1 = $_GET['gs1'];	 
	}
//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		 $tdate11=$ee1;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
if($z1 == 0)
{
 $sql_main="insert into tblarrival (nolot,type,sstage, lotcrop, lotvariety,yearcode,arrival_type, arrival_code, arrival_date,grnno,dc_date,dcno,orderno,party_id, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no, pname_byhand, remarks, arr_role,plantcode) values('$lot2','$vv','$st','$o','$p','$yearid_id','Unidentified','$c','$tdate','$g','$tdate1','$d','$or','$party','$a','$i','$j','$k','$b','$l','$m','$pname','$y1','$logid','$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

 $sql_sub="insert into tblarrival_sub (sstage,lotcrop, lotvariety,old,sample,sstatus,arrival_id,lotno,  qty, act, diff, qty1, act1, diff1, moisture ,vchk,qc,orlot,lotoldlot,got,got1,remarks,ploc,party_id,gssample,plantcode) values('$st','$o','$p','$f','$sample','$status','$mainid','$n','$txtdcqty', '$txtdcqty', '$txtdiffqty', '$txtdcnob', '$txtactnob', '$txtdiffnob','$w','$x','$qc','$orlot','$oldlot','$got','$got1','$remarks','$loc','$party','$gs1','$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('Unidentified', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$b1', '$c1', '$o', '$p','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('Unidentified', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$g1', '$h1', '$o', '$p','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}}
}
$z1=$mainid;
}
else
{
  $sql_main="update tblarrival set yearcode='$yearid_id',arrival_type='Unidentified', arrival_code='$c', arrival_date='$tdate', grnno='$g', dc_date='$tdate1',dcno='$d',orderno='$or',party_id='$party', tmode='$a', trans_name='$i', trans_lorryrepno='$j', trans_vehno='$k', trans_paymode='$b', courier_name='$l', docket_no='$m', pname_byhand='$pname',nolot='$lot2' ,remarks='$y1',lotcrop='$o',lotvariety='$p', nolot='$lot2',vvariety='$vv',sstage='$st',arr_role='$logid' where arrival_id = '$z1'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;

$sql_sub="insert into tblarrival_sub (sstage,lotcrop, lotvariety,old,sample,sstatus,arrival_id,lotno,  qty, act, diff, qty1, act1, diff1, moisture ,vchk,qc,orlot,lotoldlot,got,got1,remarks,ploc,party_id,gssample,plantcode) values('$st','$o','$p','$f','$sample','$status','$mainid','$n','$txtdcqty', '$txtdcqty', '$txtdiffqty', '$txtdcnob', '$txtactnob', '$txtdiffnob','$w','$x','$qc','$orlot','$oldlot','$got','$got1','$remarks','$loc','$party','$gs1','$plantcode')";
 if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('Unidentified', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$b1', '$c1', '$o', '$p','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('Unidentified', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$g1', '$h1', '$o', '$p','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
}
}
}
	
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">
  <?php
$tid=$z1;
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arr_role='".$logid."' and arrival_type='Unidentified' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!---->
    <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="8%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
	 <!--/* <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Difference</td>*/-->
<td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>

		  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <!--<td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type </td>-->
		 	 <td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status </td>
		   <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="6%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
     <!--<td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>-->
	  <td width="6%" align="center" valign="middle" class="tblheading">Moist %</td>
	         
      <td width="7%" align="center" valign="middle" class="tblheading">PP</td>
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
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
	 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
	  <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
     <!-- <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>-->
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <!--<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="4%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Unidentified');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
	 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
	  <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
     <!-- <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
     <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>-->
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <!--<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
   <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="4%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Unidentified');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11"  style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;Lot Number&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#adad11">&nbsp;<input name="txtlot1" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $mode;?>" onchange="ltchk(this.value);"  />
</span>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a>&nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
<!--<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>-->
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubtable" style="display:block">
</div>
</div>
