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
		
		$sql_arr=mysqli_query($link,"select * from tbl_blendm where blendm_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$crop=$row_arr['blendm_crop'];
			$variety=$row_arr['blendm_variety'];
			$arrival_date=date("Y-m-d");
			$totssub=0;
			$sqlarsub=mysqli_query($link,"select * from tbl_blends where blendm_id='".$pid."' and blends_group>0 and plantcode='$plantcode'") or die(mysqli_error($link));
			if($totsub=mysqli_num_rows($sqlarsub)>0)
			{
				$sqlsubsub=mysqli_query($link,"select * from tbl_blendss where blendm_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$totssub=mysqli_num_rows($sqlsubsub);
			}
			else
			{
				$totssub=1;
			}
			//exit;
			if($totssub>0)
			{
				$sql_arrsub=mysqli_query($link,"select * from tbl_blends where blendm_id='".$pid."' and blends_delflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
				while($row_arrsub=mysqli_fetch_array($sql_arrsub))
				{
					$lotno=$row_arrsub['blends_lotno'];
					
					$sql_arrsubsub=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where lotldg_lotno='".$lotno."' and lotldg_variety='".$variety."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$a_sub=mysqli_num_rows($sql_arrsubsub);
					while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
					{
						$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_arrsubsub['lotldg_subbinid']."' and lotldg_binid='".$row_arrsubsub['lotldg_binid']."' and lotldg_whid='".$row_arrsubsub['lotldg_whid']."' and lotldg_variety='".$variety."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode' order by lotldg_balqty desc") or die(mysqli_error($link));
				
						$row_issue1=mysqli_fetch_array($sql_issue1); 
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'and lotldg_balqty>0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{
								$otrid=$row_issuetbl['lotldg_id'];
								
								$whid=$row_issuetbl['lotldg_whid'];
								$binid=$row_issuetbl['lotldg_binid'];
								$subbinid=$row_issuetbl['lotldg_subbinid'];
								$opups=$row_issuetbl['lotldg_balbags'];
								$opqty=$row_issuetbl['lotldg_balqty'];
								
								
								$balups=0;
								$balqty=0;
								
								if($balqty<=0){$balqty=0; $balups=0;}
								
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
								$geneticpurity=$row_issuetbl['lotldg_genpurity'];
								$yearcode=$row_issuetbl['yearcode'];
								
								 $sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, plantcode) values('$yearcode','Blending', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$opups', '$opqty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity','$plantcode')";
								//exit;
								if(mysqli_query($link,$sql_ins_main) or die(mysqli_error($link)))
								{
								$oldtid=mysqli_insert_id($link);
								}
								
							$cntg=0;
							
							$sql_issueg=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
				
							while($row_issueg=mysqli_fetch_array($sql_issueg))
							{ 
								$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
								$row_issueg1=mysqli_fetch_array($sql_issueg1); 
								
								$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
								$totnog=mysqli_num_rows($sql_issuetblg);
								if($totnog > 0)
								{
								  $cntg++;
								} 
							}
							
							$sql_issueg=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
							
							while($row_issueg=mysqli_fetch_array($sql_issueg))
							{ 
								$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$subbinid."' and lotno='".$row_issueg['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
								$row_issueg1=mysqli_fetch_array($sql_issueg1); 
								
								$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
								$totnog=mysqli_num_rows($sql_issuetblg);
								if($totnog > 0)
								{
								  $cntg++;
								} 
							}
							if($cntg==0)
							{
								$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
								mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
							}
						}
					}
				}
				$sqlarrsub=mysqli_query($link,"select * from tbl_blends where blendm_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
				while($rowarrsub=mysqli_fetch_array($sqlarrsub))
				{
					$lotno1=$rowarrsub['blends_lotno'];
					$sqlm="update tbl_lot_ldg set lotldg_mergerflg=0 where lotldg_lotno='".$lotno1."'";
					$xcs=mysqli_query($link,$sqlm) or die(mysqli_error($link));
				}	
				$sql_arrsubsub=mysqli_query($link,"select * from tbl_blendss where blendm_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$a_sub=mysqli_num_rows($sql_arrsubsub);
				while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
				{
					$nlot=$row_arrsubsub['blendss_newlot'];
					$orlot2=$row_arrsubsub['blendss_orlot'];
					
					$nob2=$row_arrsubsub['blendss_nob'];
					$qty2=$row_arrsubsub['blendss_qty'];
					$balups2=$row_arrsubsub['blendss_nob'];
					$balqty2=$row_arrsubsub['blendss_qty'];
					
					$whid2=$row_arrsubsub['blendss_whid'];
					$binid2=$row_arrsubsub['blendss_binid'];
					$subbinid2=$row_arrsubsub['blendss_subbinid'];
					$opups2=0;
					$opqty2=0;
					
					if($balqty2<=0){$balqty2=0; $balups2=0;}
							
					$sstage2=$row_arr['blendm_stage'];
					if($sstage2=="Both")$sstage2="Raw";
 
					$sstatus2="";
					$moist2="";
					$gemp2="";
					$vchk2="Acceptable";
					$got12="GOT-NR OK";
					$class_qry=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['blendm_crop']."' order by cropname") or die(mysqli_error($link));
					$noticiaclass=mysqli_fetch_array($class_qry);
					if($sstage2=="Raw") {if($noticiaclass['croptype']=='Field Crop'){$qc2="UT";}else{$qc2="NUT";}}					else {$qc2="UT";}
						
					$gotstatus2="OK";
					$qctestdate2="";
					$gottestdate2=$arrival_date;
					
					$gs2=0;
					$resverstatus2="";
					$revcomment2="";
					$geneticpurity2="";
					$yearcode2=$yearid_id;
					
					 $sql_ins_main2="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, plantcode) values('$yearcode2','Blending', '$pid', '$arrival_date', '$nlot', '$crop', '$variety', '$whid2', '$binid2', '$subbinid2', '$opups2', '$opqty2', '$nob2', '$qty2', '$balups2', '$balqty2', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlot2', '$gs2', '$resverstatus2', '$revcomment2', '$geneticpurity', '$plantcode')";
						//exit;
					if(mysqli_query($link,$sql_ins_main2) or die(mysqli_error($link)))
					{
						$oldtid2=mysqli_insert_id($link);
						
						$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softrsub_lotno='".$orlot2."' and plantcode='$plantcode' order by softrsub_id desc") or die(mysqli_error($link));
						$tot_srsub=mysqli_num_rows($sql_srsub);
						while($row_srsub=mysqli_fetch_array($sql_srsub))
						{
							$type = $row_srsub['softrsub_srtyp'];	 
							$lotno = $row_srsub['softrsub_lotno'];
						
							$sql_lotldg="update tbl_lot_ldg set lotldg_srtyp='".$type."', lotldg_srflg='1' where orlot='".$orlot2."'";
							$zz=mysqli_query($link,$sql_lotldg)or die(mysqli_error($link));
						}
					}
						
					$cntg=0;
					
					$sql_issueg=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$subbinid2."' and plantcode='$plantcode'") or die(mysqli_error($link));
		
					while($row_issueg=mysqli_fetch_array($sql_issueg))
					 { 
						$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid2."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
						$totnog=mysqli_num_rows($sql_issuetblg);
						if($totnog > 0)
						{
						  $cntg++;
						} 
					}
					
		
					$sql_issueg=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$subbinid2."' and plantcode='$plantcode'") or die(mysqli_error($link));
					
					while($row_issueg=mysqli_fetch_array($sql_issueg))
					 { 
						$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$subbinid2."' and lotno='".$row_issueg['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
						$totnog=mysqli_num_rows($sql_issuetblg);
						if($totnog > 0)
						{
						  $cntg++;
						} 
					}
					if($cntg==0)
					{
						$sql_itmg22="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
						mysqli_query($link,$sql_itmg22) or die(mysqli_error($link));
					}
					
					//if($sstage2!="Raw")
					{
						$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearid_id."' and plantcode='$plantcode' ORDER BY tid DESC";
						$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
						if(mysqli_num_rows($res_code1) > 0)
						{
							$row_code1=mysqli_fetch_row($res_code1);
							$t_code1=$row_code1['0'];
							$ncode1=$t_code1+1;
						}
						else
						{
							$ncode1=1;
						}
							
						$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where lotno='".$nlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$row_qc1=mysqli_fetch_array($sql_qc1);
							
						$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1['tid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$row_qc=mysqli_fetch_array($sql_qc);
							
						$got="";$got1="";
						if($got12=="GOT-R UT")
						{
							$got1="UT";	
						}
						else if($got12=="GOT-NR UT")
						{
							$got1="UT";
						}
						else if($got12=="GOT-R UT")
						{
							$got1="UT";
						}
						else if($got12=="GOT-NR UT")
						{
							$got1="UT";
						}	
						else
						{
							$got1="";
						}
							//$got1="UT";
					
						if($got1=="UT")
						{
							$got="T";
						}
						if($got!="")
						$state="P/M/G"."/".$got;	
						else
						$state="P/M/G";	
						$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
						$row_param=mysqli_fetch_array($sql_param);

						$smpnno=$row_param['code'].$yearid_id.sprintf("%000006d",$ncode1);
						
						$state="P/M/G";	
						if($qc2=="UT")
						{
							$sql_sub_sub1244="insert into tbl_qctest(pp, moist, lotno, srdate, crop, variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid, sampno, plantcode) values ('$vchk2', '$moist2', '$nlot', '$arrival_date', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1 ,'$orlot2', '$yearid_id','$logid','$smpnno', '$plantcode')";
							mysqli_query($link,$sql_sub_sub1244) or die(mysqli_error($link));
						}
						if($got1=="UT")
						{
							$sql_sub_sub1244="insert into tbl_gottest(gottest_got, gottest_lotno, gottest_srdate, gottest_crop, gottest_variety, gottest_sampleno, gottest_trstage, gottest_oldlot, yearid, logid, gottest_sampno, plantcode) values ('$got1', '$nlot', '$arrival_date', '$crop', '$variety', '$ncode1', '$sstage2', '$orlot2', '$yearid_id','$logid','$smpnno', '$plantcode')";
							mysqli_query($link,$sql_sub_sub1244) or die(mysqli_error($link));
						}
						
						/*if($qc2=="UT" && $got1!="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, gotdate, gotflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$nlot', '".$arrival_date."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',0,'$orlot2', '".$arrival_date."', '".$arrival_date."',0,'".$arrival_date."',1, '$got1','$yearid_id','$logid')";
						}
						else if($qc2!="UT" && $got1=="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, qcstatus,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$nlot', '".$arrival_date."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',0,'$orlot2', '".$arrival_date."', '',0,'".$arrival_date."',1, '$qc2',1,'$yearid_id','$logid')";
						}	
						else if($qc2=="UT" || $got1=="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$nlot', '".$arrival_date."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',0,'$orlot2', '".$arrival_date."', '',0,1,'$yearid_id','$logid')";
						}	
						else
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, gotdate, gotflg, qcstatus,gotsmpdflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$nlot', '".$arrival_date."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',0,'$orlot2', '".$arrival_date."', '".$arrival_date."',1,'".$arrival_date."',0,'".$arrival_date."',1, '$qc2',1, '$got1','$yearid_id','$logid')";
						}	
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));	*/
					}
				}
				$dt=date("Y-m-d");
				$sqlmain="update tbl_blendm set blendm_bflg=1, blendm_bdate='$dt' where blendm_id='$pid'";
				$a1236=mysqli_query($link,$sqlmain) or die(mysqli_error($link));
				echo "<script>window.location='select_blending_op.php?p_id=$pid'</script>";	
			}
			else
			{
				echo "<script>alert('Please update SLOC first then Final Submit the Transaction')</script>";	
			}
		}
		//exit;
		/*echo "<script>window.location='select_blending_op.php?p_id=$pid'</script>";	*/
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing - Transction - Lot Blending SLOC Updation - Preview</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('issue_blending_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
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
          <td valign="top"><?php require_once("../include/arr_process.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/process_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Lot Blending SLOC Updation - Preview</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$pid and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
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
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Blending</td>
</tr>

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "LB".$row['blendm_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Blending Request Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
?>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['blendm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots to be Blended&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['blendm_nolots'];?></td>
</tr>
</table>
</br>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td  align="center" valign="middle" class="tblheading" >Blending Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
        <td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td colspan="6"  align="center" valign="middle" class="smalltblheading">Quality Status</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Blended Lot No.</td>
		<td width="45" rowspan="2"  align="center" valign="middle" class="smalltblheading">Total NoB</td>
		<td width="65" rowspan="2"  align="center" valign="middle" class="smalltblheading">Total Qty</td>
		<td width="110" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
	</tr>
	<tr class="tblsubtitle">
	  <td width="35"  align="center" valign="middle" class="smalltblheading">QC</td>
	  <td width="60"  align="center" valign="middle" class="smalltblheading">DoT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">GOT</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">DoGT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">GOT Grade</td>
	</tr>
<?php

$sql12=mysqli_query($link,"select * from tbl_blendm where blendm_id=$trid and plantcode='$plantcode'")or die(mysqli_error($link));
$row2=mysqli_fetch_array($sql12);
	
$classqry2=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row2['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class2=mysqli_fetch_array($classqry2);

$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row2['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item2=mysqli_fetch_array($itemqry2);



$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0;
$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 and blends_delflg=0 and plantcode='$plantcode' group by blends_group order by blends_group asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($grs!="")
		$grs=$grs.",".$row_sub['blends_group'];
	else
		$grs=$row_sub['blends_group'];	
	$sql_sub23=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='".$row_sub['blends_group']."' and plantcode='$plantcode' order by blends_group asc") or die(mysqli_error($link));	
	if($tot_sub23=mysqli_num_rows($sql_sub23) == 1)$gflg++;
}
$sql_sub=mysqli_query($link,"select distinct blends_delflg from tbl_blends where blendm_id='$trid' and blends_delflg>0 and plantcode='$plantcode' group by blends_delflg order by blends_delflg asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$drs=$row_sub['blends_delflg'];	
}

//echo $grs;
$sr=1; $itmdchk=0; 
$gs=explode(",",$grs); 
foreach($gs as $val)
{ 
if($val<>"")
{
$lotnos=""; $qcss=""; $gotss=""; $dots=""; $gempss=""; $dgots=""; $artps=""; $plocss=""; $dohss=""; $statuses=""; $stss=""; $nlotno=""; $norlot=""; $slocss=""; $nobss=""; $qtyss=""; $tnob=0; $tqty=0; $slocss2="";  $gotgrade=''; 

$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='$val' and plantcode='$plantcode' order by blends_group asc, blends_lotno asc") or die(mysqli_error($link));
$tot_rows=mysqli_num_rows($sql_eindent_sub);
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0)$itmdchk++;

$subid=$row_eindent_sub['blends_id'];

$ltno=$row_eindent_sub['blends_lotno'];
$zzz=str_split($ltno);
$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];

$olot2=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12];

$ploc=""; $pdate="";
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class2['cropname']."' and lotvariety='".$noticia_item2['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' and plantcode='$plantcode' order by orlot asc") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
if($tot_rr > 0)
{
	$row_rr=mysqli_fetch_array($sql_rr);
	$ploc=$row_rr['ploc'];
	if($row_rr['lotstate']!="")
	$ploc=$ploc.", ".$row_rr['lotstate'];
	$rpdate=$row_rr['harvestdate'];
	$rpyear=substr($rpdate,0,4);
	$rpmonth=substr($rpdate,5,2);
	$rpday=substr($rpdate,8,2);
	$pdate=$rpday."-".$rpmonth."-".$rpyear;
	
	if($pdate=="00-00-0000" || $pdate=="--")$pdate="";	
}

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row2['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row2['blendm_variety']."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row2['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row2['blendm_variety']."' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row2['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row2['blendm_variety']."' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$qc=$row_issuetbl['lotldg_qc']; 
			$germ=$row_issuetbl['lotldg_gemp']; 
			$got1=explode(" ",$row_issuetbl['lotldg_got1']);
			$got2=$row_issuetbl['lotldg_got']; 
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
			$totnob=$totnob+$row_issuetbl['lotldg_balbags'];		
			
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$dot=$rday."-".$rmonth."-".$ryear;
			
			$rgdate=$row_issuetbl['lotldg_gottestdate'];
			$rgyear=substr($rgdate,0,4);
			$rgmonth=substr($rgdate,5,2);
			$rgday=substr($rgdate,8,2);
			$dogt=$rgday."-".$rgmonth."-".$rgyear;
						
			if($dot=="00-00-0000" || $dot=="--")$dot="";	
			if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
			if($qc=="RT" || $qc=="UT")$dot="";
			if($got2=="RT" || $got2=="UT")$dogt="";
			if($germ<=0)$germ="";

			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
					
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
						
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
						
			$slups=$row_issuetbl['lotldg_balbags'];
			$slqty=$row_issuetbl['lotldg_balqty'];
						 
			if($sloc!="")
				$sloc="<br />".$sloc.$wareh.$binn.$subbinn;
			else
				$sloc=$wareh.$binn.$subbinn;
			$cont++;
		}	
	}
}

if($trtype=="Fresh Seed with PDN")$trtype="Fresh Seed";

if($row_eindent_sub['blends_group']>0)$grpflg++;
if($row_eindent_sub['blends_delflg']>0)$delflg++;

$stss2=0;
$stss="Group ".$row_eindent_sub['blends_group'];
$stss2=$row_eindent_sub['blends_delflg'];
$nlotno=$row_eindent_sub['blends_newlot'];
$norlot=$row_eindent_sub['blends_orlot'];


$gotgrade2='';
$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_eindent_sub['blends_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
$gotgrade2=$row_tbl_gotgrade['gotgrade_finalgrade'];

$qry_tbl_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$row_eindent_sub['blends_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tbl_gottest=mysqli_num_rows($qry_tbl_gottest);	
$row_tbl_gottest=mysqli_fetch_array($qry_tbl_gottest);	
if($row_tbl_gottest['grade']!='' && $row_tbl_gottest['grade']!=NULL && $row_tbl_gottest['grade']!='NULL')
{$gotgrade2=$row_tbl_gottest['grade'];}
if($gotgrade!="") $gotgrade=$gotgrade."<br />".$gotgrade2; else $gotgrade=$gotgrade2;

if($lotnos!="") $lotnos=$lotnos."<br />".$ltno; else $lotnos=$ltno;
if($qcss!="") $qcss=$qcss."<br />".$qc; else $qcss=$qc;
if($gotss!="") $gotss=$gotss."<br />".$got; else $gotss=$got;
if($dots!="") $dots=$dots."<br />".$dot; else $dots=$dot;
if($gempss!="") $gempss=$gempss."<br />".$germ; else $gempss=$germ;
if($dgots!="") $dgots=$dgots."<br />".$dogt; else $dgots=$dogt;
if($artps!="") $artps=$artps."<br />".$trtype; else $artps=$trtype;
if($plocss!="") $plocss=$plocss."<br />".$ploc; else $plocss=$ploc;
if($dohss!="") $dohss=$dohss."<br />".$pdate; else $dohss=$pdate;
if($slocss!="") $slocss=$slocss."<br />".$sloc; else $slocss=$sloc;
if($nobss!="") $nobss=$nobss."<br />".$totnob; else $nobss=$totnob;
if($qtyss!="") $qtyss=$qtyss."<br />".$totqty; else $qtyss=$totqty;

$tnob=$tnob+$totnob;
$tqty=$tqty+$totqty;
}	
$sq_sub=mysqli_query($link,"Select * from tbl_blendss where blendm_id='$trid' and blendss_newlot='$nlotno' and plantcode='$plantcode'") or die(mysqli_error($link));
while($ro_sub=mysqli_fetch_array($sq_sub))
{
$sql_whouse2=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$ro_sub['blendss_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse2=mysqli_fetch_array($sql_whouse2);
$wareh2=$row_whouse2['perticulars']."/";
					
$sql_binn2=mysqli_query($link,"select binname from tbl_bin where binid='".$ro_sub['blendss_binid']."' and whid='".$ro_sub['blendss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn2=mysqli_fetch_array($sql_binn2);
$binn2=$row_binn2['binname']."/";
					
$sql_subbinn2=mysqli_query($link,"select sname from tbl_subbin where sid='".$ro_sub['blendss_subbinid']."' and binid='".$ro_sub['blendss_binid']."' and whid='".$ro_sub['blendss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn2=mysqli_fetch_array($sql_subbinn2);
$subbinn2=$row_subbinn2['sname'];
					 
if($slocss2!="")
	$slocss2="<br />".$slocss2.$wareh2.$binn2.$subbinn2;
else
	$slocss2=$wareh2.$binn2.$subbinn2;
}				
				
		
if($sr%2!=0)
{
?>		  
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $lotnos?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nobss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qtyss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qcss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gempss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dgots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nlotno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss2;?></td>
	</tr>

<?php
}
else
{
?>
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $lotnos?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nobss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qtyss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qcss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gempss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dgots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nlotno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss2;?></td>
</tr>
<?php 
}
$sr=$sr+1;	
//}
}
}
?>	
<input type="hidden" name="sr" value="<?php echo $sr;?>" />	
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="gflg" value="<?php echo $gflg;?>" />
</table>


<input type="hidden" name="trid" value="<?php echo $trid?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtrid?>" />
<br />
<div id="subdiv" style="display:block"></div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="119" align="right"  valign="middle" class="smalltblheading">&nbsp;Requester Remarks&nbsp;</td>
<td width="825" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row['blendm_remarks'];?></td>
</tr></table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="119" align="right"  valign="middle" class="smalltblheading">&nbsp;QCM Remarks&nbsp;</td>
<td width="825" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row['blendm_qcremarks'];?></td>
</tr></table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_lotmerger.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
