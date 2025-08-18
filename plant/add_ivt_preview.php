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
	
	
	if(isset($_REQUEST['p_id']))
	{
		$pid = $_REQUEST['p_id'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{	
		//exit;
		$pid=trim($_POST['pid']);
		
		$sql_arr=mysqli_query($link,"select * from tbl_ivtmain where ivt_id='".$pid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$crop=$row_arr['ivt_crop'];
			$pvariety=$row_arr['ivt_pvariety'];
			$fvariety=$row_arr['ivt_trfromvariety'];
			$tvariety=$row_arr['ivt_trtovariety'];
			$arrival_date=$row_arr['ivt_date'];
			$trdate=$row_arr['ivt_date'];
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_ivtsub where ivt_id='".$pid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$lotno=$row_arrsub['ivts_olotno'];
				$newlotno=$row_arrsub['ivts_nlotno'];
				$norlot=$row_arrsub['ivts_orlotno'];
				$noldlot=$row_arrsub['ivts_olotno'];
				
				$nosrflg=$row_arrsub['ivts_srflg'];
				$nosrtyp=$row_arrsub['ivts_srtyp'];

				$lotstage='Condition';
				$subid=$row_arrsub['ivts_id'];
				$sql_arrsubsub=mysqli_query($link,"select * from tbl_ivtsub_sub where ivt_id='".$pid."' and ivts_id='".$subid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
				while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
				{
					$nnob=$row_arrsubsub['ivtss_nob'];
					$nqty=$row_arrsubsub['ivtss_qty'];
					$subbid=$row_arrsubsub['ivtss_subbin'];
					
					$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$fvariety."' and lotldg_sstage='".$lotstage."' and lotldg_lotno='".$lotno."' and lotldg_subbinid='$subbid' and plantcode='$plantcode'") or die(mysqli_error($link));
					$trtr=mysqli_num_rows($sql_issue);
					while($row_issue=mysqli_fetch_array($sql_issue))
					{ 
						$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$fvariety."'  and lotldg_lotno='".$lotno."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
						$row_issue1=mysqli_fetch_array($sql_issue1); 
							
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='".$plantcode."'") or die(mysqli_error($link)); 
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$whid=$row_issuetbl['lotldg_whid'];
							$binid=$row_issuetbl['lotldg_binid'];
							$subbinid=$row_issuetbl['lotldg_subbinid'];
							$opups=$row_issuetbl['lotldg_balbags'];
							$opqty=$row_issuetbl['lotldg_balqty'];
							$balups=$opups-$nnob;
							$balqty=$opqty-$nqty;
												
							$sstage=$row_issuetbl['lotldg_sstage'];
							$sstatus=$row_issuetbl['lotldg_sstatus'];
							$moist=$row_issuetbl['lotldg_moisture'];
							$gemp=$row_issuetbl['lotldg_gemp'];
							$vchk=$row_issuetbl['lotldg_vchk'];
							$got1=$row_issuetbl['lotldg_got1'];
							$qc=$row_issuetbl['lotldg_qc'];
							
							$gotstatus=$row_issuetbl['lotldg_got'];
							$qctestdate=$row_issuetbl['lotldg_qctestdate'];
							$gottestdate=$row_issuetbl['lotldg_gottestdate'];
							$orlot=$row_issuetbl['orlot'];
							$gs=$row_issuetbl['lotldg_gs'];
							$resverstatus=$row_issuetbl['lotldg_resverstatus'];
							$revcomment=$row_issuetbl['lotldg_revcomment'];
							$lotno1=$row_issuetbl['lotldg_lotno'];
							$geneticpurity=$row_issuetbl['lotldg_genpurity'];
							$srtype=$row_issuetbl['lotldg_srtyp'];
							$srflg=$row_issuetbl['lotldg_srflg'];
							
							
							 $sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','IVTO', '$pid', '$trdate', '$lotno1', '$crop', '$fvariety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nnob', '$nqty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$srtype', '$srflg', '$plantcode')";
							
							mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
							if($balqty == 0)
							{
								$totups=0; $totqtyd=0; $cntd=0;
								$sql_issueg=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		
								while($row_issueg=mysqli_fetch_array($sql_issueg))
								{ 
									$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
									$row_issueg1=mysqli_fetch_array($sql_issueg1); 
									
									$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='".$plantcode."'") or die(mysqli_error($link)); 
									$totnog=mysqli_num_rows($sql_issuetblg);
									if($totnog > 0)
									{
									  $cntd++;
									} 
								}
								
								$sql_issueg=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$subbinid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
								
								while($row_issueg=mysqli_fetch_array($sql_issueg))
								{ 
									$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$subbinid."' and lotno='".$row_issueg['lotno']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
									$row_issueg1=mysqli_fetch_array($sql_issueg1); 
									
									$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0 and plantcode='".$plantcode."'") or die(mysqli_error($link)); 
									$totnog=mysqli_num_rows($sql_issuetblg);
									if($totnog > 0)
									{
									  $cntd++;
									} 
								}
								//echo $cntd;			
								if($cntd == 0)
								{
									$sql_itmd="update tbl_subbin set status='Empty' where sid='".$subbinid."'";
									mysqli_query($link,$sql_itmd) or die(mysqli_error($link));
								}
							
							}
						
						}
					}
				}
			//}
	
				$sql_arrsub_sub=mysqli_query($link,"select * from tbl_ivtsub_sub2 where ivt_id='".$pid."' and ivts_id='".$subid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
				while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
				{
					$whid=$row_arrsub_sub['ivtss2_wh'];
					$binid=$row_arrsub_sub['ivtss2_bin'];
					$subbinid=$row_arrsub_sub['ivtss2_subbin'];
					$ups=$row_arrsub_sub['ivtss2_nob'];
					$qty=$row_arrsub_sub['ivtss2_qty'];
					$opups=0;
					$opqty=0;
					$balups=$ups;
					$balqty=$qty;
						
					$sstage=$lotstage;
					$orlot=$norlot;
					$lotno1=$newlotno;
						
					$sql_ins_main2="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','IVTC', '$pid', '$trdate', '$newlotno', '$crop', '$tvariety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$norlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$nosrtyp', '$nosrflg', '$plantcode')";
						
					mysqli_query($link,$sql_ins_main2) or die(mysqli_error($link));
						
					$sql_itm="update tbl_subbin set status='$sstage' where sid='$subbinid'";
					mysqli_query($link,$sql_itm) or die(mysqli_error($link));
					
				}	
				if($nosrflg>0)
				{
					$sql_sb=mysqli_query($link,"select * from tbl_softr_sub where softrsub_lotno='$orlot' and plantcode='$plantcode' order by softrsub_id desc") or die(mysqli_error($link));
					$tot_sb=mysqli_num_rows($sql_sb);
					if($tot_sb>0)
					{
						$row_sb=mysqli_fetch_array($sql_sb);
							
						$sql_mn=mysqli_query($link,"select * from tbl_softr where softr_id='".$row_sb['softr_id']."' and plantcode='$plantcode' order by softr_id desc") or die(mysqli_error($link));
						$tot_mn=mysqli_num_rows($sql_mn);
						$row_mn=mysqli_fetch_array($sql_mn);
							
						$sql_srmain="Insert into tbl_softr (softr_tcode, softr_code, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode, plantcode) values('".$row_mn['softr_tcode']."', '".$row_mn['softr_code']."', '".$row_mn['softr_date']."', '$crop', '$tvariety', 'sllot', '', '', '', '".$row_mn['yearcode']."', '$plantcode')";
						if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
						{
							$id=mysqli_insert_id($link);
									
							$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg, plantcode) values('$id', '$norlot', '$nosrtyp', '1', '$plantcode')";
							$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
						}
					}
				}
				
				
					
				
				
				$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where oldlot='".$orlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_qc1=mysqli_fetch_array($sql_qc1);
				$yrco="";	
				
				
				$sql_got1=mysqli_query($link,"Select Max(gottest_tid) from tbl_gottest  where gottest_oldlot='".$orlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_got1=mysqli_fetch_array($sql_got1);
				$sql_got=mysqli_query($link,"Select * from tbl_gottest where gottest_tid='".$row_got1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_got=mysqli_fetch_array($sql_got);
				
				
				$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_qc=mysqli_fetch_array($sql_qc);
				$yrco=$row_qc['yearid'];
							
				if($yrco=="")$yrco=$ycr;
							
				$got="";$got12="";
				if($got1=="GOT-R UT")
				{
					$got12="UT";	
				}
				else if($got1=="GOT-NR UT")
				{
					$got12="UT";
				}
				else if($got1=="GOT-R UT")
				{
					$got12="UT";
				}
				else if($got1=="GOT-NR UT")
				{
					$got12="UT";
				}	
				else
				{
					$got12="";
				}
				//$got1="UT";
						
				if($got12=="UT")
				{
					$got="T";
				}
				if($qc=="UT")
				{
					$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$newlotno."','".$norlot."','$yrco','$logid', '".$row_qc['state']."', '$sstage2','".$row_qc['sampno']."', '".$plantcode."')";
					mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
				}
									
				if($got12=="UT")
				{
					$sql_sub_sub123="insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_srdate, gottest_gotstatus, gottest_sampleno, gottest_aflg, gottest_bflg, gottest_cflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, genpurity, gottest_lotno, gottest_oldlot, yearid, logid, gottest_trstage, gottest_sampno, plantcode) values('".$row_got['gottest_spdate']."','".$row_got['gottest_gotdate']."','".$row_got['gottest_dosdate']."','".$row_got['gottest_got']."','".$row_got['gottest_variety']."','".$row_got['gottest_crop']."','".$row_got['gottest_srdate']."','".$row_got['gottest_gotstatus']."','".$row_got['gottest_sampleno']."','".$row_got['gottest_aflg']."','".$row_got['gottest_bflg']."','".$row_got['gottest_cflg']."','".$row_got['gottest_gotflg']."','".$row_got['gottest_gotrefno']."','".$row_got['gottest_gotauth']."','".$row_got['gottest_gotsampdflg']."','".$row_got['genpurity']."','".$newlotno."','".$norlot."','$yrco','$logid', '$sstage2','".$row_got['gottest_sampno']."', '".$plantcode."')";
					mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
				}
				/*if($qc=="UT" || $got12=="UT")
				{
					$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity, lotno, oldlot, yearid, logid, state, trstage, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['gotdate']."','".$row_qc['dosdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['got']."','".$row_qc['qc']."','".$tvariety."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['gotstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gotflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['gotrefno']."','".$row_qc['gotauth']."','".$row_qc['doswdate']."','".$row_qc['gotsmpdflg']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$row_qc['genpurity']."','".$newlotno."','".$norlot."','$yrco','$logid', '".$row_qc['state']."', '$sstage', '$plantcode')";
					mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
				}*/
			
			}
			
			$sql_code="SELECT MAX(ivt_code) FROM tbl_ivtmain  where ivt_yearid='".$yearid_id."' and plantcode='$plantcode' ORDER BY ivt_code DESC";
			$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
			
			if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			}
			else
			{
				$code=1;
			}
			$sql_code2="SELECT MAX(ivt_ncode) FROM tbl_ivtmain  where ivt_yearid='".$yearid_id."' and plantcode='$plantcode' ORDER BY ivt_ncode DESC";
			$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
			
			if(mysqli_num_rows($res_code2) > 0)
			{
				$row_code2=mysqli_fetch_row($res_code2);
				$t_code2=$row_code2['0'];
				$code2=$t_code2+1;
			}
			else
			{
				$code2=1;
			}	
			$sql_main="update tbl_ivtmain set ivt_tflg=1, ivt_code=$code, ivt_ncode=$code2 where ivt_id='".$pid."'";
	
			$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		}
		//exit;
		echo "<script>window.location='select_ivt_op.php?p_id=$pid'</script>";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transction - Lot Merger - Preview</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="issue.js"></script>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<script language="JavaScript">

function openslocpopprint()
{

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_ivt_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
if(document.frmaddDept.txtdate.value=="00-00-0000" && document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
else if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
	}
}
	
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" 

bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" 

align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Inter Variety Transfer - Preview</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
$sql1=mysqli_query($link,"select * from tbl_ivtmain where ivt_id=$pid and plantcode='$plantcode'")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);
$tid=$pid;
$subtid=0;
 
$tdate=$row['ivt_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;

$code="TVT".$row['ivt_tcode']."/".$row['ivt_yearid']."/".$row['ivt_logid'];	
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />
	<input name="txtdate" type="hidden" value="<?php echo $tdate;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td width="30">	 </td><td>
<td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Add Inter Variety Transfer</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
           <td width="202" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID&nbsp;</td>
           <td width="268"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code?></td>
		   
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
	<!--<td width="3%" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Delete</td>-->
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
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>-->
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
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>-->
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
</table>
<br />
<div id="postingsub">
<div id="maindiv" style="display:block"></div>	
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
<br />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_ivt.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table></td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
	
<!-- actual page end--->	
		  
		  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
