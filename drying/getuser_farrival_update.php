<?php
	/*session_start();
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
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");

$yearid_id="09-10";
$logid="OP1";
$lgnid="OP1";

if(isset($_GET['txt11']))
	{
	$transtype = $_GET['txt11'];	 
	}
if(isset($_GET['txtid']))
	{
	$txtid = $_GET['txtid'];	 
	}
if(isset($_GET['txt14']))
	{
	$txt14 = $_GET['txt14'];	 
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
	$arrivaltype = $_GET['arrivaltype'];	 
	}
if(isset($_GET['grnnumber']))
	{
	$grnnumber = $_GET['grnnumber'];	 
	}
if(isset($_GET['receivedfrom']))
	{
	$receivedfrom = $_GET['receivedfrom'];	 
	}
if(isset($_GET['txtorganizer']))
	{
	$txtorganizer = $_GET['txtorganizer'];	 
	}
if(isset($_GET['noofpdn']))
	{
	$noofpdn = $_GET['noofpdn'];	 
	}
if(isset($_GET['txtfarmer']))
	{
	$txtfarmer = $_GET['txtfarmer'];	 
	}
if(isset($_GET['noofpdn1']))
	{
	$noofpdn1 = $_GET['noofpdn1'];	 
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
	$txtvn = $_GET['txtvn'];	 
	}
if(isset($_GET['txt13']))
	{
	$txt13 = $_GET['txt13'];	 
	}
if(isset($_GET['txtcname']))
	{
	$txtcname = $_GET['txtcname'];	 
	}
if(isset($_GET['txtdc']))
	{
	$txtdc = $_GET['txtdc'];	 
	}
if(isset($_GET['txtpname']))
	{
	$txtpname = $_GET['txtpname'];	 
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
if(isset($_GET['txtvariety']))
	{
	$txtvariety = $_GET['txtvariety'];	 
	}
if(isset($_GET['txtloc']))
	{
	$txtloc = $_GET['txtloc'];	 
	}
if(isset($_GET['txtprod']))
	{
	$txtprod = $_GET['txtprod'];	 
	}
if(isset($_GET['txtfar']))
	{
	$txtfar = $_GET['txtfar'];	 
	}
if(isset($_GET['txtplot']))
	{
	$txtplot = $_GET['txtplot'];	 
	}
if(isset($_GET['gcode']))
	{
	$gcode = $_GET['gcode'];	 
	}
if(isset($_GET['sdate']))
	{
	$sdate = $_GET['sdate'];	 
	}
if(isset($_GET['txtgstat']))
	{
	$txtgstat = $_GET['txtgstat'];	 
	}
if(isset($_GET['txtdcqty']))
	{
	$txtdcqty = $_GET['txtdcqty'];	 
	}
if(isset($_GET['txtactqty']))
	{
	$txtactqty = $_GET['txtactqty'];	 
	}
if(isset($_GET['txtdiffqty']))
	{
	$txtdiffqty = $_GET['txtdiffqty'];	 
	}
if(isset($_GET['txtdcnob']))
	{
	$txtdcnob = $_GET['txtdcnob'];	 
	}
if(isset($_GET['txtactnob']))
	{
	$txtactnob = $_GET['txtactnob'];	 
	}
if(isset($_GET['txtdiffnob']))
	{
	$txtdiffnob = $_GET['txtdiffnob'];	 
	}
if(isset($_GET['txtmoist']))
	{
	$txtmoist = $_GET['txtmoist'];	 
	}
if(isset($_GET['txtvisualck']))
	{
	$txtvisualck = $_GET['txtvisualck'];	 
	}
if(isset($_GET['qc']))
	{
	$qc = $_GET['qc'];	 
	}
if(isset($_GET['txtremarks']))
	{
	$txtremarks = $_GET['txtremarks'];	 
	}
if(isset($_GET['sstage']))
	{
	$sstage = $_GET['sstage'];	 
	}
if(isset($_GET['sstatus']))
	{
	$sstatus = $_GET['sstatus'];	 
	}
if(isset($_GET['maintrid']))
	{
	$maintrid = $_GET['maintrid'];	 
	}
if(isset($_GET['subtrid']))
	{
	$subtrid = $_GET['subtrid'];	 
	}
if(isset($_GET['pdnum']))
	{
	$pdnum = $_GET['pdnum'];	 
	}

$rowid1=0;$rowid2=0;$rowid3=0;$rowid4=0;$rowid5=0; $god1=0;$god2=0;$god3=0; $dam1=0;$dam2=0;
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
	if(isset($_GET['txtslwhg3']))
	{
	$i1 = $_GET['txtslwhg3'];	 
	}
	if(isset($_GET['txtslbing3']))
	{
	$j1 = $_GET['txtslbing3'];	 
	}
	if(isset($_GET['txtslsubbg3']))
	{
	$k1 = $_GET['txtslsubbg3'];	 
	}
	if(isset($_GET['txtslqtyg3']))
	{
	$l1 = $_GET['txtslqtyg3'];	 
	}
	if(isset($_GET['txtslBagsg3']))
	{
	$m1 = $_GET['txtslBagsg3'];	 
	}
	$good1=0;$good2=0;$good3=0;
	
if($noofpdn!="")	
$numberofpdn=$noofpdn;
else
$numberofpdn=$noofpdn1;
		
//	frm_action=submit &txt11=By%20Hand &txt14= &txtid=1 &logid= &satype=organiser &dateofarrival=09-10-2009 &arrivaltype=Fresh%20Arrival &grnnumber=13256 &receivedfrom=organiser &txtorganizer=2 &noofpdn=2 &txtfarmer=--Select-- &noofpdn1= &dcdate=09-10-2009 &txtdcnumber=5456 &txt1=By%20Hand &txttname= &txtlrn= &txtvn= &txt13=Select &txtcname= &txtdc= &txtpname=fdhgfgh &grn=13256 &organi=456 &txtpdno=32156 &txtpdndate=09-10-2009 &spcodem=AA001 &spcodef=AA002 &txtcrop=Brinjal &txtvariety=VNR-28 &txtloc=21 &txtprod=1 &txtfar=57 &txtplot=2 &gcode=123 &sdate=09-10-2009 &txtgstat=gotnr &txtdcqty=10 &txtactqty=10 &txtdiffqty=0 &txtdcnob=10 &txtactnob=10 &txtdiffnob=0 &txtmoist=1.1 &txtvisualck=Acceptable &qc=Under%20QC &txtremarks=fbxdbvcb &sstage=Rawseed &sstatus=--Select-- &txtslwhg1=57 &txtslbing1=104 &txtslsubbg1=1071 &exusp1= &exqty1= &orowid1=0 &txtslBagsg1=1 &txtslqtyg1=10 &balBags1=1 &balqty1=10 &txtslwhg2=--WH-- &txtslbing2=--Bin-- &txtslsubbg2=--Sub%20Bin-- &exusp2= &exqty2= &txtslBagsg2= &txtslqtyg2= &balBags2= &balqty2= &orowid2=0 &txtslwhg3=--WH-- &txtslbing3=--Bin-- &txtslsubbg3=--Sub%20Bin-- &exusp3= &exqty3= &txtslBagsg3= &txtslqtyg3= &balBags3= &balqty3= &orowid3=0 &maintrid=0 &subtrid= &pdnum=1 &abc=


if($maintrid == 0)
{
$sql_main="insert into tbl_dryarrival (yearcode, arr_type, arrival_code, tr_date, grn_no, received_form, orgniser_id, farmerid, dc_date, dcno, mode_of_transit, tran_name, lr_no, vehicle_no, payment, courier_name, docket_no, name_of_person, no_of_pdn, remarks, arr_role,plantcode) values('$yearid_id', '$arrivaltype', '$txtid', '$dateofarrival', '$grnnumber', '$receivedfrom', '$txtorganizer', '$txtfarmer', '$dcdate', '$txtdcnumber', '$txt11', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$numberofpdn', '$txtremarks', '$logid','$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tbl_dryarrival_sub (tr_id, pdn_no, pdn_date, spcode_m, spcode_f, crop_id, variety_id, plocation_id, ppersonal_id, farmer_id, geo_index, plot_no, harvestdate, got_status, qty_asper_pdn, no_bags_pdn, qty_actual, noof_bagsactual, qty_diff, noof_bagsdiff, moisture, visual_check, qc_status, sl_stage, seed_status, lot _no, nopdn, remarks,plantcode) values('$mainid','$txtpdno','$txtpdndate','$spcodem','$spcodef','$txtcrop','$txtvariety','$txtloc','$txtprod','$txtfar','$gcode','$txtplot','$sdate','$txtgstat','$txtdcqty','$txtdcnob','$txtactqty','$txtactnob','$txtdiffqty','$txtdiffnob','$txtmoist','$txtvisualck','$qc','$sstage','$sstatus','$txtlotno','$pdnum','$txtremarks','$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
if($god1==1)
{
$sql_sub_sub="insert into tbl_dryarr_sloc (arr_type, arr_tr_id, arr_id, crop_id, variety_id, whid, binid, subbin, qty, bags,  rowid,plantcode) values('$arrivaltype', '$mainid', '$subid', '$txtcrop', '$txtvariety', '$y', '$z', '$a1', '$b1', '$c1', '0', '0', '$rowid1','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tbl_dryarr_sloc (arr_type, arr_tr_id, arr_id, crop_id, variety_id, whid, binid, subbin, qty, bags,  rowid,plantcode) values('$arrivaltype','$mainid','$subid','$n','$o','$d1','$e1','$f1','$g1','$h1','0','0', '$rowid2','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god3==1)
{
$sql_sub_sub="insert into tbl_dryarr_sloc (arr_type, arr_tr_id, arr_id, crop_id, variety_id, whid, binid, subbin, qty, bags,  rowid,plantcode) values('$arrivaltype','$mainid','$subid','$n','$o','$i1','$j1','$k1','$l1','$m1','0','0', '$rowid3','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
$maintrid=$mainid;
}
else
{
$sql_main="update tbl_dryarrival set  arr_type='$arrivaltype', tr_date='$dateofarrival', grn_no='$grnnumber', received_form='$receivedfrom', orgniser_id='$txtorganizer', farmerid='$txtfarmer', dc_date='$dcdate', dcno='$txtdcnumber', mode_of_transit='$txt11', tran_name='$txttname', lr_no='$txtlrn', vehicle_no='$txtvn', payment='$txt13', courier_name='$txtcname', docket_no='$txtdc', name_of_person='$txtpname', no_of_pdn='$numberofpdn', remarks='$txtremarks', arr_role='$logid' where tr_id = '$maintrid'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$maintrid;

$sql_sub="insert into tbl_dryarrival_sub (tr_id, pdn_no, pdn_date, spcode_m, spcode_f, crop_id, variety_id, plocation_id, ppersonal_id, farmer_id, geo_index, plot_no, harvestdate, got_status, qty_asper_pdn, no_bags_pdn, qty_actual, noof_bagsactual, qty_diff, noof_bagsdiff, moisture, visual_check, qc_status, sl_stage, seed_status, lot _no, nopdn, remarks,plantcode) values('$mainid','$txtpdno','$txtpdndate','$spcodem','$spcodef','$txtcrop','$txtvariety','$txtloc','$txtprod','$txtfar','$gcode','$txtplot','$sdate','$txtgstat','$txtdcqty','$txtdcnob','$txtactqty','$txtactnob','$txtdiffqty','$txtdiffnob','$txtmoist','$txtvisualck','$qc','$sstage','$sstatus','$txtlotno','$pdnum','$txtremarks','$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
if($god1==1)
{
$sql_sub_sub="insert into tbl_dryarr_sloc (arr_type, arr_tr_id, arr_id, crop_id, variety_id, whid, binid, subbin, qty, bags,  rowid,plantcode) values('$arrivaltype', '$mainid', '$subid', '$n', '$o', '$y', '$z', '$a1', '$b1', '$c1', '0', '0', '$rowid1','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tbl_dryarr_sloc (arr_type, arr_tr_id, arr_id, crop_id, variety_id, whid, binid, subbin, qty, bags,  rowid,plantcode) values('$arrivaltype','$mainid','$subid','$n','$o','$d1','$e1','$f1','$g1','$h1','0','0', '$rowid2','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god3==1)
{
$sql_sub_sub="insert into tbl_dryarr_sloc (arr_type, arr_tr_id, arr_id, crop_id, variety_id, whid, binid, subbin, qty, bags,  rowid,plantcode) values('$arrivaltype','$mainid','$subid','$n','$o','$i1','$j1','$k1','$l1','$m1','0','0', '$rowid3','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
}

echo $tid=$maintrid;



?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%" align="center" valign="middle" class="tblheading">#</td>
			 <td width="23%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="7%" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="4%" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
	<?php
	$srno=1;
	while($srno<=$rid)
	{
	if($srno%2!=0)
	{	
	?>
	<tr class="Light">
	<td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $srno;?>);" /></td>
	<td align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;"  /></td>
	</tr>
	<?php
	}
	else
	{
	?>	
	<tr class="Dark">
	<td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $srno;?>);" /></td>
	<td align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" /></td>
	</tr>
	<?php
	}
	$srno++;
	}
	?>	 
</table>

<div id="postingsubtable" style="display:none">
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>