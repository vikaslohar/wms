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
if(isset($_GET['dopc'])) { $dopc = $_GET['dopc']; }
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
if(isset($_GET['txtclotno'])) { $txtclotno = $_GET['txtclotno']; }
if(isset($_GET['txtplotno'])) { $txtplotno = $_GET['txtplotno']; }

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

if(isset($_GET['paceptyp'])) { $paceptyp= $_GET['paceptyp']; }
if(isset($_GET['pcktype'])) { $pcktype= $_GET['pcktype']; }
if(isset($_GET['avlnobpck'])) { $avlnobpck= $_GET['avlnobpck']; }
if(isset($_GET['avlqtypck'])) { $avlqtypck= $_GET['avlqtypck']; }
if(isset($_GET['picqtyp'])) { $picqtyp= $_GET['picqtyp']; }
if(isset($_GET['pckloss'])) { $pckloss= $_GET['pckloss']; }
if(isset($_GET['ccloss'])) { $ccloss= $_GET['ccloss']; }
if(isset($_GET['balpck'])) { $balpck= $_GET['balpck']; }
if(isset($_GET['balcnob'])) { $balcnob= $_GET['balcnob']; }
if(isset($_GET['balcqty'])) { $balcqty= $_GET['balcqty']; }
if(isset($_GET['qcstatus'])) { $qcstatus= $_GET['qcstatus']; }
if(isset($_GET['qctestdate'])) { $qctestdate= $_GET['qctestdate']; }
if(isset($_GET['validityperiod'])) { $validityperiod= $_GET['validityperiod']; }
if(isset($_GET['validityupto'])) { $validityupto= $_GET['validityupto']; }
if(isset($_GET['qcdttype'])) { $qcdttype= $_GET['qcdttype']; }

if(isset($_GET['fet'])) { $fet= $_GET['fet']; }
if(isset($_GET['upsidno'])) { $upsidno= $_GET['upsidno']; }
if(isset($_GET['upssize'])) { $upssize= $_GET['upssize']; }
if(isset($_GET['sno'])) { $sno= $_GET['sno']; }
if(isset($_GET['nopks'])) { $nopks= $_GET['nopks']; }
if(isset($_GET['sno3'])) { $sno3= $_GET['sno3']; }

if(isset($_GET['slocssyncs24'])) { $slocssyncs24= $_GET['slocssyncs24']; }

for ($i=1; $i<=$sno; $i++)
{
	if($upssize==$i)
	{
		$wtnopkgx="wtnopkg_".$i;
		if(isset($_GET[$wtnopkgx])) { $wtnopkg= $_GET[$wtnopkgx]; }
		$packqtyx="packqty_".$i;
		if(isset($_GET[$packqtyx])) { $packqty= $_GET[$packqtyx]; }
		$nopcx="nopc_".$i;
		if(isset($_GET[$nopcx])) { $nopc= $_GET[$nopcx]; }
		$domcsx="domcs_".$i;
		if(isset($_GET[$domcsx])) { $domcs= $_GET[$domcsx]; }
		$lblsx="lbls_".$i;
		if(isset($_GET[$lblsx])) { $lbls= $_GET[$lblsx]; }
		$domcex="domce_".$i;
		if(isset($_GET[$domcex])) { $domce= $_GET[$domcex]; }
		$lblex="lble_".$i;
		if(isset($_GET[$lblex])) { $lble= $_GET[$lblex]; }
		$mpckx="mpck_".$i;
		if(isset($_GET[$mpckx])) { $mpck= $_GET[$mpckx]; }
		$nompx="nomp_".$i;
		if(isset($_GET[$nompx])) { $nomp= $_GET[$nompx]; }
		$wtmpx="wtmp_".$i;
		if(isset($_GET[$wtmpx])) { $wtmp= $_GET[$wtmpx]; }
		$wtnopx="wtnop_".$i;
		if(isset($_GET[$wtnopx])) { $wtnop= $_GET[$wtnopx]; }
		$nowbx="nowb_".$i;
		if(isset($_GET[$nowbx])) { $nowb= $_GET[$nowbx]; }
		$noofpacksx="noofpacks_".$i;
		if(isset($_GET[$noofpacksx])) { $noofpcks= $_GET[$noofpacksx]; }
	}
}	


$noofpcks=$nopks;
/*if(isset($_GET['wtnopkg_1'])) { $wtnopkg_1= $_GET['wtnopkg_1']; }
if(isset($_GET['packqty_1'])) { $packqty_1= $_GET['packqty_1']; }
if(isset($_GET['nopc_1'])) { $nopc_1= $_GET['nopc_1']; }
if(isset($_GET['domcs_1'])) { $domcs_1= $_GET['domcs_1']; }
if(isset($_GET['lbls_1'])) { $lbls_1= $_GET['lbls_1']; }
if(isset($_GET['domce_1'])) { $domce_1= $_GET['domce_1']; }
if(isset($_GET['lble_1'])) { $lble_1= $_GET['lble_1']; }
if(isset($_GET['mpck_1'])) { $mpck_1= $_GET['mpck_1']; }
if(isset($_GET['nomp_1'])) { $nomp_1= $_GET['nomp_1']; }
if(isset($_GET['wtmp_1'])) { $wtmp_1= $_GET['wtmp_1']; }
if(isset($_GET['wtnop_1'])) { $wtnop_1= $_GET['wtnop_1']; }
if(isset($_GET['nowb_1'])) { $nowb_1= $_GET['nowb_1']; }
if(isset($_GET['wtnopkg_2'])) { $wtnopkg_2= $_GET['wtnopkg_2']; }
if(isset($_GET['wtmp_2'])) { $wtmp_2= $_GET['wtmp_2']; }
if(isset($_GET['wtnop_2'])) { $wtnop_2= $_GET['wtnop_2']; }
if(isset($_GET['nowb_2'])) { $nowb_2= $_GET['nowb_2']; }
if(isset($_GET['wtnopkg_3'])) { $wtnopkg_3= $_GET['wtnopkg_3']; }
if(isset($_GET['wtmp_3'])) { $wtmp_3= $_GET['wtmp_3']; }
if(isset($_GET['wtnop_3'])) { $wtnop_3= $_GET['wtnop_3']; }
if(isset($_GET['nowb_3'])) { $nowb_3= $_GET['nowb_3']; }
if(isset($_GET['wtnopkg_4'])) { $wtnopkg_4= $_GET['wtnopkg_4']; }
if(isset($_GET['wtmp_4'])) { $wtmp_4= $_GET['wtmp_4']; }
if(isset($_GET['wtnop_4'])) { $wtnop_4= $_GET['wtnop_4']; }
if(isset($_GET['nowb_4'])) { $nowb_4= $_GET['nowb_4']; }*/

if(isset($_GET['detmpbno'])) { $detmpbno= $_GET['detmpbno']; }
/*if(isset($_GET['txtwhg1'])) { $txtwhg1= $_GET['txtwhg1']; }
if(isset($_GET['txtbing1'])) { $txtbing1= $_GET['txtbing1']; }
if(isset($_GET['txtsubbg1'])) { $txtsubbg1= $_GET['txtsubbg1']; }
if(isset($_GET['existview1'])) { $existview1= $_GET['existview1']; }
if(isset($_GET['nopmpcs_1'])) { $nopmpcs_1= $_GET['nopmpcs_1']; }
if(isset($_GET['noppchs_1'])) { $noppchs_1= $_GET['noppchs_1']; }
if(isset($_GET['noptpchs_1'])) { $noptpchs_1= $_GET['noptpchs_1']; }
if(isset($_GET['noptqtys_1'])) { $noptqtys_1= $_GET['noptqtys_1']; }
if(isset($_GET['txtwhg2'])) { $txtwhg2= $_GET['txtwhg2']; }
if(isset($_GET['txtbing2'])) { $txtbing2= $_GET['txtbing2']; }
if(isset($_GET['txtsubbg2'])) { $txtsubbg2= $_GET['txtsubbg2']; }
if(isset($_GET['nopmpcs_2'])) { $nopmpcs_2= $_GET['nopmpcs_2']; }
if(isset($_GET['noppchs_2'])) { $noppchs_2= $_GET['noppchs_2']; }
if(isset($_GET['noptpchs_2'])) { $noptpchs_2= $_GET['noptpchs_2']; }
if(isset($_GET['noptqtys_2'])) { $noptqtys_2= $_GET['noptqtys_2']; }
if(isset($_GET['txtwhg3'])) { $txtwhg3= $_GET['txtwhg3']; }
if(isset($_GET['txtbing3'])) { $txtbing3= $_GET['txtbing3']; }
if(isset($_GET['txtsubbg3'])) { $txtsubbg3= $_GET['txtsubbg3']; }
if(isset($_GET['nopmpcs_3'])) { $nopmpcs_3= $_GET['nopmpcs_3']; }
if(isset($_GET['noppchs_3'])) { $noppchs_3= $_GET['noppchs_3']; }
if(isset($_GET['noptpchs_3'])) { $noptpchs_3= $_GET['noptpchs_3']; }
if(isset($_GET['noptqtys_3'])) { $noptqtys_3= $_GET['noptqtys_3']; }
if(isset($_GET['txtwhg4'])) { $txtwhg4= $_GET['txtwhg4']; }
if(isset($_GET['txtbing4'])) { $txtbing4= $_GET['txtbing4']; }
if(isset($_GET['txtsubbg4'])) { $txtsubbg4= $_GET['txtsubbg4']; }
if(isset($_GET['nopmpcs_4'])) { $nopmpcs_4= $_GET['nopmpcs_4']; }
if(isset($_GET['noppchs_4'])) { $noppchs_4= $_GET['noppchs_4']; }
if(isset($_GET['noptpchs_4'])) { $noptpchs_4= $_GET['noptpchs_4']; }
if(isset($_GET['noptqtys_4'])) { $noptqtys_4= $_GET['noptqtys_4']; }
if(isset($_GET['txtwhg5'])) { $txtwhg5= $_GET['txtwhg5']; }
if(isset($_GET['txtbing5'])) { $txtbing5= $_GET['txtbing5']; }
if(isset($_GET['txtsubbg5'])) { $txtsubbg5= $_GET['txtsubbg5']; }
if(isset($_GET['nopmpcs_5'])) { $nopmpcs_5= $_GET['nopmpcs_5']; }
if(isset($_GET['noppchs_5'])) { $noppchs_5= $_GET['noppchs_5']; }
if(isset($_GET['noptpchs_5'])) { $noptpchs_5= $_GET['noptpchs_5']; }
if(isset($_GET['noptqtys_5'])) { $noptqtys_5= $_GET['noptqtys_5']; }
if(isset($_GET['txtwhg6'])) { $txtwhg6= $_GET['txtwhg6']; }
if(isset($_GET['txtbing6'])) { $txtbing6= $_GET['txtbing6']; }
if(isset($_GET['txtsubbg6'])) { $txtsubbg6= $_GET['txtsubbg6']; }
if(isset($_GET['nopmpcs_6'])) { $nopmpcs_6= $_GET['nopmpcs_6']; }
if(isset($_GET['noppchs_6'])) { $noppchs_6= $_GET['noppchs_6']; }
if(isset($_GET['noptpchs_6'])) { $noptpchs_6= $_GET['noptpchs_6']; }
if(isset($_GET['noptqtys_6'])) { $noptqtys_6= $_GET['noptqtys_6']; }
if(isset($_GET['txtwhg7'])) { $txtwhg7= $_GET['txtwhg7']; }
if(isset($_GET['txtbing7'])) { $txtbing7= $_GET['txtbing7']; }
if(isset($_GET['txtsubbg7'])) { $txtsubbg7= $_GET['txtsubbg7']; }
if(isset($_GET['nopmpcs_7'])) { $nopmpcs_7= $_GET['nopmpcs_7']; }
if(isset($_GET['noppchs_7'])) { $noppchs_7= $_GET['noppchs_7']; }
if(isset($_GET['noptpchs_7'])) { $noptpchs_7= $_GET['noptpchs_7']; }
if(isset($_GET['noptqtys_7'])) { $noptqtys_7= $_GET['noptqtys_7']; }
if(isset($_GET['txtwhg8'])) { $txtwhg8= $_GET['txtwhg8']; }
if(isset($_GET['txtbing8'])) { $txtbing8= $_GET['txtbing8']; }
if(isset($_GET['txtsubbg8'])) { $txtsubbg8= $_GET['txtsubbg8']; }
if(isset($_GET['nopmpcs_8'])) { $nopmpcs_8= $_GET['nopmpcs_8']; }
if(isset($_GET['noppchs_8'])) { $noppchs_8= $_GET['noppchs_8']; }
if(isset($_GET['noptpchs_8'])) { $noptpchs_8= $_GET['noptpchs_8']; }
if(isset($_GET['noptqtys_8'])) { $noptqtys_8= $_GET['noptqtys_8']; }*/


if(isset($_GET['txtremarks'])) { $txtremarks= $_GET['txtremarks']; }
	
if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }
	
//frm_action=submit&txtid=1028&date=29-11-2012&txtpsrn=hgfjghj&txtcrop=28&txtvariety=33&txtstage=Raw&txtpromech=7&txtoprname=9&txttreattyp=00002&itmdchk=0&txtlot1=DS02083%2F00000R&maintrid=0&subtrid=0&softstatus=&txtonob=3&txtoqty=87&protyp=E&protype=E&extslwhg1=1&extslbing1=30&extslsubbg1=594&txtextnob1=3&txtextqty1=87&recnobp1=3&recqtyp1=87&txtbalnobp1=0&txtbalqtyp1=0&srno2=1&txtconnob=3&txtconqty=85&txtconrem=1&txtconim=1&txtconpl=0&txtconloss=2&txtconper=2.3&paceptyp=P&pcktype=P&avlnobpck=3&avlqtypck=85&picqtyp=50&pckloss=2&ccloss=3&balpck=45&balcnob=2&balcqty=35&txtslwhg1=1&txtslbing1=18&txtslsubbg1=355&txtconslnob1=2&txtconslqty1=35&txtslwhg2=WH&txtslbing2=Bin&txtslsubbg2=Subbin&txtconslnob2=&txtconslqty2=&fet=2&wtnopkg_1=0.010&packqty_1=45&nopc_1=4500&domcs_1=A&lbls_1=1&domce_1=A&lble_1=5001&mpck_1=mp_1&nomp_1=16&wtmp_1=2.8&wtnop_1=280&nowb_1=&wtnopkg_2=0.025&wtmp_2=7&wtnop_2=280&nowb_2=&wtnopkg_3=0.050&wtmp_3=7&wtnop_3=140&nowb_3=&wtnopkg_4=0.100&wtmp_4=7&wtnop_4=70&nowb_4=&sno=5&detmpbno=16&txtwhg1=1&txtbing1=133&txtsubbg1=2650&existview1=Empty&nopmpcs_1=16&noppchs_1=20&noptpchs_1=4500&noptqtys_1=45&txtwhg2=WH&txtbing2=Bin&txtsubbg2=Subbin&nopmpcs_2=&noppchs_2=&noptpchs_2=&noptqtys_2=&txtwhg3=WH&txtbing3=Bin&txtsubbg3=Subbin&nopmpcs_3=&noppchs_3=&noptpchs_3=&noptqtys_3=&txtwhg4=WH&txtbing4=Bin&txtsubbg4=Subbin&nopmpcs_4=&noppchs_4=&noptpchs_4=&noptqtys_4=&txtwhg5=WH&txtbing5=Bin&txtsubbg5=Subbin&nopmpcs_5=&noppchs_5=&noptpchs_5=&noptqtys_5=&txtwhg6=WH&txtbing6=Bin&txtsubbg6=Subbin&nopmpcs_6=&noppchs_6=&noptpchs_6=&noptqtys_6=&txtwhg7=WH&txtbing7=Bin&txtsubbg7=Subbin&nopmpcs_7=&noppchs_7=&noptpchs_7=&noptqtys_7=&txtwhg8=WH&txtbing8=Bin&txtsubbg8=Subbin&nopmpcs_8=&noppchs_8=&noptpchs_8=&noptqtys_8=&txtremarks=gfh

$ttype="Online Processing and Packing Slip";
$pl=$txtconpl;
$rpl=$txtconpl;

//echo $a; echo $b; exit;
$zz=str_split($txtlot1);
 $orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$z1=$maintrid;
		
	$tdate11=explode("-",$date);
	$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
	
	$tdate12=explode("-",$dopc);
	$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
	
	$tdate13=explode("-",$validityupto);
	$tdate3=$tdate13[2]."-".$tdate13[1]."-".$tdate13[0];
	
	$tdate14=explode("-",$qctestdate);
	$tdate4=$tdate14[2]."-".$tdate14[1]."-".$tdate14[0];
	
	$pnob=$recnobp1+$recnobp2;
	$pqty=$recqtyp1+$recqtyp2;
	
	$sql_sel="select * from tblups where uid='".$upsidno."' order by uom Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	$row12=mysqli_fetch_array($res);
	$upss=$row12['ups']." ".$row12['wt'];

if($z1 == 0)
{
   $sql_main="insert into tbl_pnpslipmain(pnpslipmain_code, pnpslipmain_date, pnpslipmain_proslipno,  pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_stage, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_ttype, logid, yearid, pnpslipmain_dop, plantcode) values ('$txtid','$tdate1','$txtpsrn','$txtcrop','$txtvariety','$txtstage', '$txtpromech', '$txtoprname', '$txttreattyp', '$ttype', '$logid', '$yearid_id', '$tdate2', '$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

  $sql_sub="insert into tbl_pnpslipsub (pnpslipsub_lotno, pnpslipmain_id, pnpslipsub_onob, pnpslipsub_oqty, pnpslipsub_processtype, pnpslipsub_pnob, pnpslipsub_pqty , pnpslipsub_bnob, pnpslipsub_bqty, pnpslipsub_connob, pnpslipsub_conqty, pnpslipsub_rm, pnpslipsub_im, pnpslipsub_pl, pnpslipsub_rpl, pnpslipsub_tlqty, pnpslipsub_tlper, pnpslipsub_packtype, pnpslipsub_availpnob, pnpslipsub_availpqty, pnpslipsub_pickpqty, pnpslipsub_packloss, pnpslipsub_packcc, pnpslipsub_packqty, pnpslipsub_balcnob, pnpslipsub_balcqty, pnpslipsub_ups, pnpslipsub_upsid, pnpslipsub_qty, pnpslipsub_nop, pnpslipsub_lblschar, pnpslipsub_lblsno, pnpslipsub_lbechar, pnpslipsub_lbeno, pnpslipsub_convtomp, pnpslipsub_nomp, pnpslipsub_balpouch, pnpslipsub_nobarcodes, pnpslipsub_remarks, pnpslipsub_sstatus, pnpslipsub_orlot, pnpslipsub_valperiod, pnpslipsub_valupto, pnpslipsub_qc, pnpslipsub_qcdot, pnpslipsub_qcdttype, pnpslipsub_sltyp, pnpslipsub_clotno, pnpslipsub_plotno, plantcode) values ('$txtlot1', '$mainid', '$txtonob', '$txtoqty', '$protyp', '$pnob', '$pqty', '$txtbalnobp1', '$txtbalqtyp1', '$txtconnob', '$txtconqty', '$txtconrem', '$txtconim', '$pl', '$rpl', '$txtconloss', '$txtconper', '$pcktype', '$avlnobpck', '$avlqtypck', '$picqtyp', '$pckloss', '$ccloss', '$balpck', '$balcnob', '$balcqty', '$upss', '$upsidno', '$packqty', '$nopc', '$domcs', '$lbls', '$domce', '$lble', '$mpck', '$nomp', '$noofpcks', '$detmpbno', '$txtremarks', '$softstatus', '$orlot', '$validityperiod', '$tdate3', '$qcstatus', '$tdate4', '$qcdttype', '$slocssyncs24', '$txtclotno', '$txtplotno', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$suid=mysqli_insert_id($link);
	
	$sql_subsub="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtextnob1', '$txtextqty1', '$recnobp1', '$recqtyp1', '$txtbalnobp1', '$txtbalqtyp1', '$plantcode')";
	mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
	if($srno2==2 && $recqtyp2!="" && $recqtyp2>0)
	{
		$sql_subsub1="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtextnob2', '$txtextqty2', '$recnobp2', '$recqtyp2', '$txtbalnobp2', '$txtbalqtyp2', '$plantcode')";
		mysqli_query($link,$sql_subsub1) or die(mysqli_error($link));
	}
	
	if($txtconslqty1!="")
	{
	$sql_subsub2="insert into tbl_pnpslipsubsub2 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '0', '0', '$txtconslnob1', '$txtconslqty1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
	mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));
	}
	if($txtconslqty2!="")
	{
		$sql_subsub3="insert into tbl_pnpslipsubsub2 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '0', '0', '$txtconslnob2', '$txtconslqty2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
		mysqli_query($link,$sql_subsub3) or die(mysqli_error($link));
	}
	for($j=1; $j<=8; $j++)
	{
		$noptqtys=0;
		$txtwhgx="txtwhg".$j;
		$txtbingx="txtbing".$j;
		$txtsubbgx="txtsubbg".$j;
		$existviewx="existview".$j;
		$nopmpcsx="nopmpcs_".$j;
		$noppchsx="noppchs_".$j;
		$noptpchsx="noptpchs_".$j;
		$noptqtysx="noptqtys_".$j;
		if(isset($_GET[$txtwhgx])) { $txtwhg= $_GET[$txtwhgx]; }
		if(isset($_GET[$txtbingx])) { $txtbing= $_GET[$txtbingx]; }
		if(isset($_GET[$txtsubbgx])) { $txtsubbg= $_GET[$txtsubbgx]; }
		if(isset($_GET[$existviewx])) { $existview= $_GET[$existviewx]; }
		if(isset($_GET[$nopmpcsx])) { $nopmpcs= $_GET[$nopmpcsx]; }
		if(isset($_GET[$noppchsx])) { $noppchs= $_GET[$noppchsx]; }
		if(isset($_GET[$noptpchsx])) { $noptpchs= $_GET[$noptpchsx]; }
		if(isset($_GET[$noptqtysx])) { $noptqtys= $_GET[$noptqtysx]; }
		if($noptqtys!="" || $noptqtys>0)
		{
		$sql_subsub4="insert into tbl_pnpslipsubsub3 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onomp, pnpslipsubsub_oqty, pnpslipsubsub_onop, pnpslipsubsub_nomp, pnpslipsubsub_pouches, pnpslipsubsub_totpouches, pnpslipsubsub_totqty, pnpslipsubsub_bnomp, pnpslipsubsub_bnop, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtwhg', '$txtbing', '$txtsubbg', '0', '0', '0', '$nopmpcs', '$noppchs', '$noptpchs', '$noptqtys', '$nopmpcs', '$noptpchs', '$noptqtys', '$plantcode')";
		mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
		}
	}
	$sql_barcode="update tbl_barcodestmp set bar_tid='$mainid', bar_subid='$suid' where bar_lotno='$txtlot1' and bar_logid='$logid' and bar_psrn='$txtpsrn'";
	mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
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

$sql_sub="update  tbl_pnpslipsub set pnpslipsub_lotno='$txtlot1', pnpslipmain_id='$mainid', pnpslipsub_onob='$txtonob', pnpslipsub_oqty='$txtoqty', pnpslipsub_processtype='$protyp', pnpslipsub_pnob='$pnob', pnpslipsub_pqty='$pqty', pnpslipsub_bnob='$txtbalnobp1', pnpslipsub_bqty='$txtbalqtyp1', pnpslipsub_connob='$txtconnob', pnpslipsub_conqty='$txtconqty', pnpslipsub_rm='$txtconrem', pnpslipsub_im='$txtconim', pnpslipsub_pl='$pl', pnpslipsub_rpl='$rpl', pnpslipsub_tlqty='$txtconloss', pnpslipsub_tlper='$txtconper', pnpslipsub_packtype='$pcktype', pnpslipsub_availpnob='$avlnobpck', pnpslipsub_availpqty='$avlqtypck', pnpslipsub_pickpqty='$picqtyp', pnpslipsub_packloss='$pckloss', pnpslipsub_packcc='$ccloss', pnpslipsub_packqty='$balpck', pnpslipsub_balcnob='$balcnob', pnpslipsub_balcqty='$balcqty', pnpslipsub_ups='$upss', pnpslipsub_upsid='$upsidno', pnpslipsub_qty='$packqty', pnpslipsub_nop='$nopc', pnpslipsub_lblschar='$domcs', pnpslipsub_lblsno='$lbls', pnpslipsub_lbechar='$domce', pnpslipsub_lbeno='$lble', pnpslipsub_convtomp='$mpck', pnpslipsub_nomp='$nomp', pnpslipsub_balpouch='$noofpcks', pnpslipsub_nobarcodes='$detmpbno', pnpslipsub_remarks='$txtremarks', pnpslipsub_sstatus='$softstatus', pnpslipsub_orlot='$orlot', pnpslipsub_valperiod='$validityperiod', pnpslipsub_valupto='$tdate3', pnpslipsub_qc='$qcstatus', pnpslipsub_qcdot='$tdate4', pnpslipsub_qcdttype='$qcdttype', pnpslipsub_sltyp='$slocssyncs24', pnpslipsub_clotno='$txtclotno', pnpslipsub_plotno='$txtplotno' where pnpslipsub_id='".$subtrid."'";

if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$suid=$subtrid;
	$s_sub="delete from tbl_pnpslipsubsub where pnpslipsub_id='".$subtrid."' and pnpslipmain_id='".$mainid."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$sql_subsub="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtextnob1', '$txtextqty1', '$recnobp1', '$recqtyp1', '$txtbalnobp1', '$txtbalqtyp1', '$plantcode')";
	mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
	if($srno2==2 && $recqtyp2!="" && $recqtyp2>0)
	{
		$sql_subsub1="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtextnob2', '$txtextqty2', '$recnobp2', '$recqtyp2', '$txtbalnobp2', '$txtbalqtyp2', '$plantcode')";
		mysqli_query($link,$sql_subsub1) or die(mysqli_error($link));
	}
	
	$s_sub2="delete from tbl_pnpslipsubsub2 where pnpslipsub_id='".$subtrid."' and pnpslipmain_id='".$mainid."'";
	mysqli_query($link,$s_sub2) or die(mysqli_error($link));
	if($txtconslqty1!="")
	{
	$sql_subsub2="insert into tbl_pnpslipsubsub2 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '0', '0', '$txtconslnob1', '$txtconslqty1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
	mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));
	}
	if($txtconslqty2!="")
	{
		$sql_subsub3="insert into tbl_pnpslipsubsub2 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '0', '0', '$txtconslnob2', '$txtconslqty2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
		mysqli_query($link,$sql_subsub3) or die(mysqli_error($link));
	}
	$s_sub3="delete from tbl_pnpslipsubsub3 where pnpslipsub_id='".$subtrid."' and pnpslipmain_id='".$mainid."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));
	for($j=1; $j<=8; $j++)
	{
		$noptqtys=0;
		$txtwhgx="txtwhg".$j;
		$txtbingx="txtbing".$j;
		$txtsubbgx="txtsubbg".$j;
		$existviewx="existview".$j;
		$nopmpcsx="nopmpcs_".$j;
		$noppchsx="noppchs_".$j;
		$noptpchsx="noptpchs_".$j;
		$noptqtysx="noptqtys_".$j;
		if(isset($_GET[$txtwhgx])) { $txtwhg= $_GET[$txtwhgx]; }
		if(isset($_GET[$txtbingx])) { $txtbing= $_GET[$txtbingx]; }
		if(isset($_GET[$txtsubbgx])) { $txtsubbg= $_GET[$txtsubbgx]; }
		if(isset($_GET[$existviewx])) { $existview= $_GET[$existviewx]; }
		if(isset($_GET[$nopmpcsx])) { $nopmpcs= $_GET[$nopmpcsx]; }
		if(isset($_GET[$noppchsx])) { $noppchs= $_GET[$noppchsx]; }
		if(isset($_GET[$noptpchsx])) { $noptpchs= $_GET[$noptpchsx]; }
		if(isset($_GET[$noptqtysx])) { $noptqtys= $_GET[$noptqtysx]; }
		if($noptqtys!="" || $noptqtys>0)
		{
		$sql_subsub4="insert into tbl_pnpslipsubsub3 (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onomp, pnpslipsubsub_oqty, pnpslipsubsub_onop, pnpslipsubsub_nomp, pnpslipsubsub_pouches, pnpslipsubsub_totpouches, pnpslipsubsub_totqty, pnpslipsubsub_bnomp, pnpslipsubsub_bnop, pnpslipsubsub_bqty, plantcode) values ('$suid', '$mainid', '$txtwhg', '$txtbing', '$txtsubbg', '0', '0', '0', '$nopmpcs', '$noppchs', '$noptpchs', '$noptqtys', '$nopmpcs', '$noptpchs', '$noptqtys', '$plantcode')";
		mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
		}
	}
	$sql_barcode="update tbl_barcodestmp set bar_tid='$mainid', bar_subid='$suid' where bar_lotno='$txtlot1' and bar_logid='$logid' and bar_psrn='$txtpsrn'";
	mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
}
}
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<?php  
$tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['pnpslipmain_dop'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
$subtid=0;
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Online Processing and Packing Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Processing &amp; Packing&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="157" align="right"  valign="middle" class="smalltblheading">Packing Slip Ref. No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="152" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="166" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="107" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" /> &nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where promac_id='".$row_tbl['pnpslipmain_promachcode']."' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));

$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_id='".$row_tbl['pnpslipmain_proopr']."'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtpromech" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtoprname" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txttreattyp" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
  </tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="101" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
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
    <td width="108" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">CSW SLOC</td>
	<td width="108" colspan="3" align="center" valign="middle" class="smalltblheading">Pack Details</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    <td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
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
	    <td width="51" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="30" align="center" valign="middle" class="smalltblheading">%</td>
      <td width="54" align="center" valign="middle" class="smalltblheading">NoMP</td>
      <td width="54" align="center" valign="middle" class="smalltblheading">Barcodes</td>
      <td width="108" align="center" valign="middle" class="smalltblheading">Details</td>
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
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['pnpslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['pnpslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['pnpslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/
$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlper'];?></td>
	<td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nomp'];?><input type="hidden" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['pnpslipsub_nomp'];?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $tot_barcnomp;?><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="30" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlper'];?></td>
	<td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nomp'];?><input type="hidden" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['pnpslipsub_nomp'];?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $tot_barcnomp;?><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="30" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"></div></div>