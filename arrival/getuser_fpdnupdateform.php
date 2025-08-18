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


if(isset($_GET['gscheckbox']))
	{
	$gscheckbox = $_GET['gscheckbox'];	 
	}
	if(isset($_GET['txtqc']))
	{
	$txtqc = $_GET['txtqc'];	 
	}
	if(isset($_GET['txtqc1']))
	{
	$txtqc1 = $_GET['txtqc1'];	 
	}
	if(isset($_GET['gotstatus']))
	{
	$gotstatus = $_GET['gotstatus'];	 
	}
	
	if($gscheckbox==1)
	{
	$qc= $txtqc;	 
	}
	else
	{
	$qc= $txtqc;	 
	}
	
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
	if(isset($_GET['satype']))
	{
	$satype = $_GET['satype'];	 
	}
	if(isset($_GET['dateofarrival']))
	{
	$dateofarrival = $_GET['dateofarrival'];	 
	}
	if(isset($_GET['arrivaltype']))
	{
	$arrivaltype= $_GET['arrivaltype'];	 
	}
	if(isset($_GET['grnnumber']))
	{
	$grnnumber = $_GET['grnnumber'];	 
	}
	if(isset($_GET['noofpdn']))
	{
	$noofpdn = $_GET['noofpdn'];	 
	}
	if(isset($_GET['dcdate']))
	{
	$dcdate = $_GET['dcdate'];	 
	}
	if(isset($_GET['txtdcnumber']))
	{
	$txtdcnumber = $_GET['txtdcnumber'];	 
	}
	if(isset($_GET['txt1']))
	{
	$txt1 = $_GET['txt1'];	 
	}
	if(isset($_GET['txttname']))
	{
	$txttname = $_GET['txttname'];	 
	}
	if(isset($_GET['txtlrn']))
	{
	$txtlrn = $_GET['txtlrn'];	 
	}
	if(isset($_GET['txtvn']))
	{
	$txtvn= $_GET['txtvn'];	 
	}
	if(isset($_GET['txt13']))
	{
	$txt13 = $_GET['txt13'];	 
	}
	if(isset($_GET['txtcname']))
	{
	$txtcname= $_GET['txtcname'];	
	}
	if(isset($_GET['txtdc']))
	{
	$txtdc= $_GET['txtdc'];	
	}
	if(isset($_GET['dcdate1']))
	{
	$dcdate1 = $_GET['dcdate1'];	 
	}
	if(isset($_GET['txtpname']))
	{
	$txtpname= $_GET['txtpname'];	
	}
		
//			End of Main table fields	
//			2nd table fields start
	
	if(isset($_GET['txtlot1']))
	{
	$txtlot1 = $_GET['txtlot1'];	 
	}
	if(isset($_GET['grn']))
	{
	$grn = $_GET['grn'];	 
	}
	if(isset($_GET['organi']))
	{
	$organi = $_GET['organi'];	 
	}
	if(isset($_GET['txtpdno']))
	{
	$txtpdno = $_GET['txtpdno'];	 
	}
	if(isset($_GET['txtpdndate']))
	{
	$txtpdndate = $_GET['txtpdndate'];	 
	}
	if(isset($_GET['spcodem']))
	{
	$spcodem = $_GET['spcodem'];	 
	}
	if(isset($_GET['spcodef']))
	{
	$spcodef = $_GET['spcodef'];	 
	}
	if(isset($_GET['txtcrop']))
	{
	$txtcrop = $_GET['txtcrop'];	 
	}
	if(isset($_GET['cid']))
	{
	$cid = $_GET['cid'];	 
	}
	if(isset($_GET['txtvariety']))
	{
	$txtvariety = $_GET['txtvariety'];	 
	}
	if(isset($_GET['vid']))
	{
	$vid = $_GET['vid'];	 
	}
	if(isset($_GET['txtloc']))
	{
	$txtloc = $_GET['txtloc'];	 
	}
	if(isset($_GET['txtprod']))
	{
	$txtprod= $_GET['txtprod'];	 
	}
	if(isset($_GET['txtfar']))
	{
	$txtfar= $_GET['txtfar'];	 
	}
	if(isset($_GET['txtplot']))
	{
	$txtplot= $_GET['txtplot'];	 
	}
	if(isset($_GET['gcode']))
	{
	$gcode= $_GET['gcode'];	 
	}
	
	if(isset($_GET['sdate']))
	{
	$sdate= $_GET['sdate'];	 
	}
	
	if(isset($_GET['txtgstat']))
	{
	$txtgstat= $_GET['txtgstat'];	 
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
	$txtmoist= $_GET['txtmoist'];	 
	}
	if(isset($_GET['txtvisualck']))
	{
	$txtvisualck= $_GET['txtvisualck'];	 
	}
	if(isset($_GET['txtremarks']))
	{
	$txtremarks= $_GET['txtremarks'];	 
	}
	if(isset($_GET['sstage']))
	{
	$sstage= $_GET['sstage'];	 
	}
	if(isset($_GET['sstatus']))
	{
	$sstatus= $_GET['sstatus'];	 
	}
	if(isset($_GET['glotno']))
	{
	$glotno= $_GET['glotno'];	 
	}
	if(isset($_GET['gln1']))
	{
	$gln= $_GET['gln1'];	 
	}
	if(isset($_GET['qc2']))
	{
	$qc2= $_GET['qc3'];	 
	}
	if(isset($_GET['gotstatus2']))
	{
	$gotstatus2= $_GET['gotstatus2'];	 
	}
//	end 2nd table fields
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
	if(isset($_GET['gs1']))
	{
	$gs1 = $_GET['gs1'];	 
	}
	/*if(isset($_GET['balqty1']))
	{
	$balqty1 = $_GET['balqty1'];	 
	}
	if(isset($_GET['balBags1']))
	{
	$balbags1 = $_GET['balBags1'];	 
	}*/
	
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
	/*if(isset($_GET['balqty2']))
	{
	$balqty2 = $_GET['balqty2'];	 
	}
	if(isset($_GET['balBags2']))
	{
	$balbags2 = $_GET['balBags2'];	 
	}*/
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

	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}

	if(isset($_GET['txtremarks1']))
	{
	$txtremarks1= $_GET['txtremarks1'];	 
	}
	if(isset($_GET['productiontype']))
	{
	$productiontype= $_GET['productiontype'];	 
	}
	if(isset($_GET['leduration']))
	{
	$leduration= $_GET['leduration'];	 
	}
	if(isset($_GET['leupto']))
	{
	$leupto= $_GET['leupto'];	 
	}
	if(isset($_GET['prodctiongrade']))
	{
	$prodctiongrade= $_GET['prodctiongrade'];	 
	}
	if(isset($_GET['txttareqty']))
	{
	$txttareqty= $_GET['txttareqty'];	 
	}
	
//frm_action=submit&txt11=By%20Hand&txt14=&txtid=3&logid=ARR1&satype=&cdate=04-02-2010&dateofarrival=04-02-2010&arrivaltype=Fresh%20Arrival%20With%20PDN&grnnumber=132&dcdate=04-02-2010&txtdcnumber=635456&txt1=By%20Hand&txttname=&txtlrn=&txtvn=&txt13=Select&txtcname=&txtdc=&txtpname=abc&txtlot1=K00028&maintrid=0&subtrid=0&grn=132&organi=Mithalal&txtpdno=654&txtpdndate=04-02-2010&spcodem=PP123&spcodef=AA123&txtcrop=Bitter%20Gourd&cid=Bitter%20Gourd&txtvariety=&vid=0&txtloc=Hydrabad&txtprod=Ramchand&txtfar=Mithilesh&txtplot=pp5&gcode=645&sdate=04-02-2010&txtgstat=GOT-NR&autogotstatus=&gotsample=0&gscheckbox=1&txtdcqty=123&txtactqty=123&txtdiffqty=0&txtdcnob=1&txtactnob=1&txtdiffnob=0&txtmoist=1.52&txtvisualck=Acceptable&txtqc=--Select--&txtqc1=Under%20Test&gotstatus=GOT-NR%20Under%20Test&txtremarks=Test&sstage=Rawseed&sstatus=BayCoded&glotno=G-K00028-00000&txtslwhg1=64&txtslbing1=166&txtslsubbg1=2327&exusp1=&exqty1=&orowid1=0&txtslBagsg1=1&txtslqtyg1=123&balBags1=1&balqty1=123&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&exusp2=&exqty2=&txtslBagsg2=&txtslqtyg2=&balBags2=&balqty2=&orowid2=0&abc=
	
	
		$tdate=$dateofarrival;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		$ddate1=explode("-",$dcdate);
		$ddate=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
		$pdate1=explode("-",$txtpdndate);
		$pdate=$pdate1[2]."-".$pdate1[1]."-".$pdate1[0];
		
		$hdate1=explode("-",$sdate);
		$hdate1=$hdate1[2]."-".$hdate1[1]."-".$hdate1[0];
		
		$hdate12=explode("-",$dcdate1);
		$hdate12=$hdate12[2]."-".$hdate12[1]."-".$hdate12[0];	
		$hdate13=explode("-",$leupto);
		$ledate=$hdate13[2]."-".$hdate13[1]."-".$hdate13[0];
		
		$lotqry=mysqli_query($link,"select * from tbllotimp where lotnumber='".$txtlot1."' and lottrtype='Fresh Seed with PDN'")or die (mysqli_error($link));
		$row= mysqli_fetch_array($lotqry);
		$tot_row=mysqli_num_rows($lotqry);
		$statename=$row['lotstate'];
		
if($z1 == 0)
{
  $sql_main="insert into tblarrival (yearcode,arrival_type, arrival_code, arrival_date, grnno, dc_date,disp_date,  nolot, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no, pname_byhand, remarks, arr_role, arrtrflag, plantcode)values('$yearid_id', 'Fresh Seed with PDN', '$txtid', '$tdate', '$grn', '$ddate','$hdate12', '$noofpdn', '$txt1', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$txtremarks1', '$logid', '2', '$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tblarrival_sub (arrival_id, organiser, pdnno, pdndate, spcodef, spcodem, lotcrop, lotvariety, ploc, pper, farmer, plotno, gi, harvestdate, got, qty, act, diff, qty1, act1, diff1, moisture, vchk, qc, remarks, sstage, sstatus, lotno, old, got1, sample,qcsample,orlot,gssample,prodtype, lotstate, leduration, leupto, plantcode, prodgrade, tarewt) values('$mainid', '$organi', '$txtpdno', '$pdate', '$spcodef', '$spcodem', '$txtcrop', '$txtvariety', '$txtloc', '$txtprod', '$txtfar', '$txtplot', '$gcode', '$hdate1', '$txtgstat', '$txtdcqty', '$txtactqty', '$txtdiffqty', '$txtdcnob', '$txtactnob', '$txtdiffnob', '$txtmoist', '$txtvisualck', '$qc', '$txtremarks', '$sstage', '$sstatus', '$glotno', '$txtlot1', '$gotstatus', '$gscheckbox','$qc2','$gln','$gs1','$productiontype','$statename','$leduration','$ledate', '$plantcode', '$prodctiongrade', '$txttareqty')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Fresh Seed with PDN', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$b1', '$c1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Fresh Seed with PDN', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$g1', '$h1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
$z1=$mainid;
}
else
{
$sql_main="update tblarrival set arrival_date='$tdate', grnno='$grn', dc_date='$ddate',disp_date='$hdate12',  nolot='$noofpdn', tmode='$txt1', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt13', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname', remarks='$txtremarks1', arr_role='$logid', arrtrflag=2  where arrival_id = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;

$sql_sub="insert into tblarrival_sub (arrival_id, organiser, pdnno, pdndate, spcodef, spcodem, lotcrop, lotvariety, ploc, pper, farmer, plotno, gi, harvestdate, got, qty, act, diff, qty1, act1, diff1, moisture, vchk, qc, remarks, sstage, sstatus, lotno, old, got1, sample, qcsample, orlot, gssample, prodtype, lotstate, leduration, leupto, plantcode, prodgrade, tarewt) values('$mainid', '$organi', '$txtpdno', '$pdate', '$spcodef', '$spcodem', '$txtcrop', '$txtvariety', '$txtloc', '$txtprod', '$txtfar', '$txtplot', '$gcode', '$hdate1', '$txtgstat', '$txtdcqty', '$txtactqty', '$txtdiffqty', '$txtdcnob', '$txtactnob', '$txtdiffnob', '$txtmoist', '$txtvisualck', '$qc', '$txtremarks', '$sstage', '$sstatus', '$glotno', '$txtlot1', '$gotstatus', '$gscheckbox','$qc2','$gln','$gs1','$productiontype','$statename','$leduration','$ledate', '$plantcode', '$prodctiongrade', '$txttareqty')";

if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Fresh Seed with PDN', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$b1', '$c1', '$txtcrop', '$txtvariety', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode) values('Fresh Seed with PDN', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$g1', '$h1', '$txtcrop', '$txtvariety', '$plantcode')";
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
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sqlarrsub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode' order by arrsub_id") or die(mysqli_error($link));
		$totarrsub=mysqli_num_rows($sqlarrsub);
		while($rowarrsub=mysqli_fetch_array($sqlarrsub))
		{		
			$crop11=$rowarrsub['lotcrop'];
			$variety11=$rowarrsub['lotvariety'];
			$vrnew11=$crop."-"."Coded";
			
			if($variety11!="" && $variety11==$vrnew11)
			{
				$sql_spcdec=mysqli_query($link,"select * from tblspcodes where spcodef='".$rowarrsub['spcodef']."' and spcodem='".$rowarrsub['spcodem']."'") or die(mysqli_error($link));
				$tot_spcdec=mysqli_num_rows($sql_spcdec);
				if($tot_spcdec > 0)
				{
					$row_spcdec=mysqli_fetch_array($sql_spcdec);
					
					if($row_spcdec['variety']!="")
					{
						$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_spcdec['variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
						$row_variety=mysqli_fetch_array($sql_veriety);
						$itemname=$row_variety['popularname'];	
						
						$sqltblarsub=mysqli_query($link,"update tblarrival_sub set lotvariety='$itemname' where arrival_id='".$arrival_id."' and arrsub_id='".$rowarrsub['arrsub_id']."'") or die(mysqli_error($link));	
					}
				}	
			}
		}
		
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
            <tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="6%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="6%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN</td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>
		  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status</td>
		 <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Production Grade</td>
    <td width="5%" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="4%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="4%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="tblheading">Moist %</td>
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

$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
/*$lotqry=mysqli_query($link,"select * from tbllotimp where lotnumber='".$a."'");
$row= mysqli_fetch_array($lotqry)or die (mysqli_error($link));

  $lot=$row['lotcrop'];	
 $variety=$row['lotvariety'];
  $oldlot=$row['lotoldlot'];		


$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
*/if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	   <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
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
  <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['prodgrade'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    <td width="4%" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="8%" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Fresh Seed with PDN');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
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
   <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['prodgrade'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    <td width="4%" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="8%" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Fresh Seed with PDN');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;Lot Number&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E">&nbsp;<input name="txtlot1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;<a href="javascript:void(0);" onclick="getdetails();">Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubtable" style="display:block">
</div>
</div>
