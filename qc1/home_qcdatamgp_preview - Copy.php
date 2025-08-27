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
	
	if(isset($_REQUEST['flagcode']))
	{
		$flagcode = $_REQUEST['flagcode'];
	}
	
	$ofoccode=trim($_REQUEST['ofoccode']); 
	$ofoccode1=trim($_REQUEST['ofoccode1']); 
	$ofoccode2=trim($_REQUEST['ofoccode2']); 
	$ofoccode3=trim($_REQUEST['ofoccode3']); 
	$ofoccode4=trim($_REQUEST['ofoccode4']); 
	$oflagcode=trim($_REQUEST['oflagcode']);
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$foccode=trim($_POST['foccode']); //echo "<br />";
		$foccode1=trim($_POST['foccode1']); //echo "<br />";
		$foccode2=trim($_POST['foccode2']); //echo "<br />";
		$foccode3=trim($_POST['foccode3']); //echo "<br />";
		$foccode4=trim($_POST['foccode4']); //echo "<br />";
		$flagcode=trim($_POST['flagcode']); //echo "<br />";
		
		$fctrid=explode(",",$flagcode);
		$fcgermper=explode(",",$foccode1);
		$fcleduration=explode(",",$foccode2);
		$fctxtreult=explode(",",$foccode3);
		$fctxtrefno=explode(",",$foccode4);
		$count=count($fctrid);
		//exit;	
		$reccount=0;
		for($k=0; $k<count($fctrid); $k++)
		{
		
			$germinationper=$fcgermper[$k];
			$leduration=$fcleduration[$k];
			$germptestresult=$fctxtreult[$k];
			$txtremark='';
			$result=$fctxtreult[$k];
			$gemp=$fcgermper[$k];
			$txtrefno=$fctxtrefno[$k];
			
			
			$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='".$fctrid[$k]."' ") or die(mysqli_error($link));
			$tot_arr_home=mysqli_num_rows($sql_arr_home);
			$row_arr_home24=mysqli_fetch_array($sql_arr_home);
			
			$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
			$row_param=mysqli_fetch_array($sql_param);
			
			$tp1=$row_param['code'];
			$sampno=$tp1.$row_arr_home24['yearid'].sprintf("%000006d",$row_arr_home24['sampleno']);
			
			$samplenumber=$sampno;
			$lotnumber=$row_arr_home24['lotno'];
			
			//$sqlgdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' ") or die(mysqli_error($link));
			//$rowgdata=mysqli_fetch_array($sqlgdata);
			//$txtrefno=$fctxtrefno['qcg_docsrefno'];
			
			if($samplenumber!='')
			{
				$dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $moist=0; $vchk='Acceptable';
				$tdate=date("Y-m-d");
				$sql_in1="update tbl_qcgdata set qcg_germp='$germinationper', qcg_le='$leduration', qcg_supremark='$txtremark', qcg_suplogid='$logid', qcg_germpflg='$one', qcg_germpdt='$tdate', qcg_docsrefno='$txtrefno' where qcg_sampleno='$samplenumber'";	
				if($aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link)))
				{
					
					$sql_mdata=mysqli_query($link,"select * from tbl_qcmdata where qcm_sampno='".$samplenumber."' ") or die(mysqli_error($link));
					if(mysqli_num_rows($sql_mdata)>0)
					{
						$row_mdata=mysqli_fetch_array($sql_mdata);
						$moist=$row_mdata['qcm_moistper'];
					}
					$sql_pdata=mysqli_query($link,"select * from tbl_qcpdata where qcp_sampleno='".$samplenumber."' ") or die(mysqli_error($link));
					if(mysqli_num_rows($sql_pdata)>0)
					{
						$row_pdata=mysqli_fetch_array($sql_pdata);
						$vchk=$row_pdata['qcp_ppresult'];
					}
					
					$nwlotn=str_split($lotnumber);
					$nwlotno=$nwlotn[0].$nwlotn[1].$nwlotn[2].$nwlotn[3].$nwlotn[4].$nwlotn[5].$nwlotn[6];
					$lotnn=$nwlotn[1].$nwlotn[2].$nwlotn[3].$nwlotn[4].$nwlotn[5].$nwlotn[6];
					
					$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where old='".$lotnn."'") or die(mysqli_error($link));
					$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
					$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
					$harvestdt=$row_tbl_sub['harvestdate'];
					if($harvestdt!="")
					{
						$trdate2=explode("-",$harvestdt);
						$m=$trdate2[1];
						$de=$trdate2[0];
						$y=$trdate2[2];
						
						//$dt=$a;
						if($leduration!="")
						{
							for($i=0; $i<=$leduration; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
						}
						else
						{$dp1="";}
					}
					else
					{$dp1="";}
					$leupto=$dp1;
					
					$hdate13=explode("-",$leupto);
					$ledate=$hdate13[2]."-".$hdate13[1]."-".$hdate13[0];
						
					$xamp=str_split($samplenumber);
					$plcode=$xamp[0];
					$yrcd=$xamp[1];
					$smpcode=$xamp[2].$xamp[3].$xamp[4].$xamp[5].$xamp[6].$xamp[7];
					
					
					
					
					$sqlck=mysqli_query($link,"select distinct sampleno from tbl_qctest where sampleno='$smpcode' and yearid='$yrcd' and  SUBSTRING(`oldlot`,1,7)='$nwlotno' order by tid desc") or die(mysqli_error($link));
					while($rowck=mysqli_fetch_array($sqlck))
					{
						$sqlck2=mysqli_query($link,"select * from tbl_qctest where sampleno='".$rowck['sampleno']."' and yearid='$yrcd' and  SUBSTRING(`oldlot`,1,7)='$nwlotno' and qcstatus!='OK' and qcstatus!='Fail' order by tid asc") or die(mysqli_error($link));
						while($rowck2=mysqli_fetch_array($sqlck2))
						{
						
							$sql_ck=mysqli_query($link,"select * from tbl_qctest where tid='".$rowck2['tid']."' order by tid desc") or die(mysqli_error($link));
							while($row_ck=mysqli_fetch_array($sql_ck))
							{
								$ores=$row_ck['qcstatus'];
								$osamp22=$row_ck['sampleno'];
								$olotno22=$row_ck['lotno'];
								$yearid22=$row_ck['yearid'];
								$olot=$row_ck['lotno'];
								$oldlotn=$row_ck['oldlot'];
								if($ores=="RT")
								{
									$crp=$row_ck['crop'];
									$ver=$row_ck['variety'];
									$srdt=$row_ck['srdate'];
									$spdt=$row_ck['spdate'];
									$smpno=$row_ck['sampleno'];
									$stats=$row_ck['state'];
									$oqc=$row_ck['qc'];
									$stge=$row_ck['trstage'];
									$opp=$row_ck['pp'];
									$omt=$row_ck['moist'];
									$ogmp=$row_ck['gemp'];
									$oqcst=$row_ck['qcstatus'];
									$oqtdt=$row_ck['testdate'];
									//$oref=$row_ck['qcrefno'];
									$ogotdate=$row_ck['gotdate'];
									$odosdate=$row_ck['dosdate'];
									$ogot=$row_ck['got'];
									$ogotstatus=$row_ck['gotstatus'];
									$oaflg=$row_ck['aflg'];
									$obflg=$row_ck['bflg'];
									$ocflg=$row_ck['cflg'];
									$oqcflg=$row_ck['qcflg'];
									$ogotflg=$row_ck['gotflg'];
									$ogsflg=$row_ck['gsflg'];
									$ogs=$row_ck['gs'];
									$ogotrefno=$row_ck['gotrefno'];
									$ogotauth=$row_ck['gotauth'];
									$odoswdate=$row_ck['doswdate'];
									$ogotsmpdflg=$row_ck['gotsmpdflg'];
									$ostsno=$row_ck['stsno'];
									$oqcrefno=$row_ck['qcrefno'];
									$yearid=$row_ck['yearid'];
									$stage=$row_ck['tratage'];
									
										
										
									$sql_sub_sub="insert into tbl_qctest(lotno,  oldlot, crop, variety, srdate, spdate, sampleno, state, qc, trstage, pp, moist, gemp, qcstatus, testdate, gotdate, dosdate, got, gotstatus, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, yearid, logid) values('$olotno22', '$oldlotn', '$crp', '$ver', '$srdt', '$spdt', '$smpno', '$stats', '$oqc', '$stge', '$opp', '$omt', '$ogmp', '$oqcst', '$oqtdt', '$ogotdate', '$odosdate', '$ogot', '$ogotstatus', '$oaflg', '$obflg', '$ocflg', '$oqcflg', '$ogotflg', '$ogsflg', '$ogs', '$ogotrefno', '$ogotauth', '$odoswdate', '$ogotsmpdflg', '$ostsno', '$oqcrefno', '$yearid', '$logid')";
									if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
									{
										$id=mysqli_insert_id($link);
										if($result=="OK" || $result=="Fail")
										{
											$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', testdate='$tdate', qcflg=1, qcrefno='$txtrefno' where tid='$id'";
												
											$sql_sub_sub1222="update tbl_qctest set qcflg=1 where lotno='$olotno22' and sampleno='$osamp22' and yearid='$yearid22'";
											$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
										}
										else if($result=="RT")
										{
											$sql_sub_sub12="update tbl_qctest set qcstatus='$result', testdate='$tdate', qcflg=0, gemp='$gemp', qcrefno='$txtrefno' where tid='$id'";
										}
										else
										{
											$sql_sub_sub12="update tbl_qctest set gemp='$gemp', qcstatus='$result', qcflg=0, testdate='$tdate', qcrefno='$txtrefno' where tid='$id'";
										}
										$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
											
										$sql_sub_sub122="update tbl_qctest set qcflg=1 where tid='".$rowck2['tid']."'";
										$qq22=mysqli_query($link,$sql_sub_sub122) or die(mysqli_error($link));
									}
								}
								else
								{ 
									if($result=="OK" || $result=="Fail")
									{
										$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', testdate='$tdate', qcflg=1, qcrefno='$txtrefno' where tid='".$rowck2['tid']."' and sampleno='$osamp22' and yearid='$yearid22'";
										$sql_sub_sub1222="update tbl_qctest set qcflg=1 where sampleno='$osamp22' and yearid='$yearid22'";
										$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
									}
									else if($result=="RT")
									{
										$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', qcstatus='$result', testdate='$tdate', qcflg=0, gemp='$gemp', qcrefno='$txtrefno' where tid='".$rowck2['tid']."' and  sampleno='$osamp22' and yearid='$yearid22'";
									}
									else
									{
										$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', qcflg=0, testdate='$tdate', qcrefno='$txtrefno' where tid='".$rowck2['tid']."' and sampleno='$osamp22' and yearid='$yearid22'";
									}
									
									$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
								}
									//exit;	
								if($result=="RT")
								{
									$sql_sub="update tbl_lot_ldg set lotldg_qc='$result', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
									$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='$result', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
									$sql_sub3="update tbl_salesrv_sub set salesrs_qc='$result', salesrs_dot='$tdate' where salesrs_orlot='$oldlotn' and (salesrs_qc='UT' OR salesrs_qc='RT')";
									$sql_sub4="update tbl_revalidate set rv_qc='$result', rv_dot='$tdate' where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";
								}
								else
								{
									$sql_sub="update tbl_lot_ldg set lotldg_qc='$result', lotldg_vchk='$vchk', lotldg_gemp='$gemp', lotldg_moisture='$moist', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
									$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='$result', lotldg_vchk='$vchk', lotldg_gemp='$gemp', lotldg_moisture='$moist', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
									$sql_sub3="update tbl_salesrv_sub set salesrs_qc='$result', salesrs_dot='$tdate' where salesrs_orlot='$oldlotn' and (salesrs_qc='UT' OR salesrs_qc='RT')";	
									$sql_sub4="update tbl_revalidate set rv_qc='$result', rv_dot='$tdate' where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";
								}
									$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
									$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
									$qq3=mysqli_query($link,$sql_sub3) or die(mysqli_error($link));
									$qq4=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
									
								$dt=date("Y-m-d"); 
								if($txtstage=="")
								{
									if($nwlotn[12]=="R")$txtstage="Raw";
									if($nwlotn[12]=="C")$txtstage="Condition";
									if($nwlotn[12]=="P")$txtstage="Pack";
								}
								$sqlisstbl=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$olot."'") or die(mysqli_error($link)); 
								if($totisstbl=mysqli_num_rows($sqlisstbl)>0)
								{
									$rowisstbl=mysqli_fetch_array($sqlisstbl);
									$sqlsubsub1="UPDATE tbl_lemain SET le_duration='$leduration', le_upto='$ledate'  where le_lotno='$olot' and le_stage='$txtstage'";
									mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
								}
								else
								{
									$sqlsubsub1="insert into tbl_lemain (le_lotno, le_stage, le_duration, le_upto) values( '$olot' ,'$txtstage', '$leduration','$ledate' )";
									mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
								}
								
								$sqlsubsub13="insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid) values( '$olot' ,'$txtstage', '$leduration','$ledate', '$dt', 'QC Manager', '$logid' )";
								mysqli_query($link,$sqlsubsub13) or die(mysqli_error($link));
									
								if($result=="Fail" || $result=="BL")	
								{
									$sqlin1="delete from tbl_revalidate where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";	
									$aa=mysqli_query($link,$sqlin1)or die(mysqli_error($link));
									$sqlsub2="update tbl_lot_ldg_pack set lotldg_rvflg='1' where lotno='$lotno'";
									$qqp2=mysqli_query($link,$sqlsub2) or die(mysqli_error($link));
								}
								if($result!="RT")
								{	
									$sql_chk=mysqli_query($link,"select * from tbl_lot_ldg where orlot='$oldlotn' order by lotldg_id desc") or die(mysqli_error($link));
									$tot_chk=mysqli_num_rows($sql_chk);
									if($tot_chk > 0)
									{
										$row_chk=mysqli_fetch_array($sql_chk);
										$zz=explode(" ", $row_chk['lotldg_got1']);
										/*if($zz[0]=="GOT-NR")
										{*/
											if(($row_chk['lotldg_got']=="OK" || $row_chk['lotldg_got']=="Fail") && $row_chk['lotldg_srflg']==1)
											{
												$x="";
												$sql_mainchk="update tbl_lot_ldg set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$oldlotn'";
												mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
												$sql_mainchk2="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$oldlotn'";
												mysqli_query($link,$sql_mainchk2) or die(mysqli_error($link));
												$sql_subchk="update tbl_softr_sub set softrsub_srflg='0' where softrsub_lotno ='$oldlotn'";
												mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
											}
										//}
									}
								}
							}
						}
					}
					
					$reccount++;
				}
			}
		
		}
		if($reccount==0)
		{
			echo "<script>window.location='home_qcdatamgp_preview.php?flagcode=$flagcode'</script>";
		}
		else
		{
			echo "<script>window.location='home_qcdatamgp.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - QC Data Verification and Result Update</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>

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

function openslocpopprint1(tid)
{
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

function openslocpopprint(tid)
{
var cnt=0;
	document.frmaddDept.flagcode.value ="";
	if(document.frmaddDept.srno.value>2)
	{
		for (var i = 0; i < document.frmaddDept.prchk.length; i++) 
		{          
			if(document.frmaddDept.prchk[i].checked == true)
			{
				if(document.frmaddDept.flagcode.value =="")
				{
					document.frmaddDept.flagcode.value=document.frmaddDept.prchk[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.prchk[i].value;
					cnt++;
				}
			}
		}
	}
	else
	{
		if(document.frmaddDept.prchk.checked == true)
		{
			if(document.frmaddDept.flagcode.value =="")
			{
				document.frmaddDept.flagcode.value=document.frmaddDept.prchk.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.prchk.value;
				cnt++;
			}
		}
	}
	
	if(cnt > 0)
	{
		var itm=document.frmaddDept.flagcode.value;
		winHandle=window.open('getuser_sts_sl.php?tid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
		}
	else
	{
		alert("Select Sample(s) No. To Print");
		return false;
	}
}

function openst(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('filter.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 	
function mySubmit()
{	
	return true;
	var cnt=0;
	document.frmaddDept.foccode.value ="";
	document.frmaddDept.foccode1.value ="";
	document.frmaddDept.foccode2.value ="";
	document.frmaddDept.foccode3.value ="";
	//alert(document.frmaddDept.srno.value);
	for (var i = 0; i < document.frmaddDept.srno.value-1; i++) 
	{          
		if(document.frmaddDept.foccode.value =="")
		{
			document.frmaddDept.foccode.value=document.frmaddDept.trrid[i].value;
			cnt++;
		}
		else
		{
			document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.trrid[i].value;
			cnt++;
		}
		
		if(document.frmaddDept.foccode1.value =="")
		{
			document.frmaddDept.foccode1.value=document.frmaddDept.germper[i].value;
			cnt++;
		}
		else
		{
			document.frmaddDept.foccode1.value = document.frmaddDept.foccode1.value +','+document.frmaddDept.germper[i].value;
			cnt++;
		}
		
		if(document.frmaddDept.foccode2.value =="")
		{
			document.frmaddDept.foccode2.value=document.frmaddDept.leduration[i].value;
			cnt++;
		}
		else
		{
			document.frmaddDept.foccode2.value = document.frmaddDept.foccode2.value +','+document.frmaddDept.leduration[i].value;
			cnt++;
		}
		
		if(document.frmaddDept.foccode3.value =="")
		{
			document.frmaddDept.foccode3.value=document.frmaddDept.txtrefno[i].value;
			cnt++;
		}
		else
		{
			document.frmaddDept.foccode3.value = document.frmaddDept.foccode3.value +','+document.frmaddDept.txtrefno[i].value;
			cnt++;
		}
		//alert(i);
		//alert(document.frmaddDept.foccode.value);
		//alert(document.frmaddDept.foccode1.value);
		//alert(document.frmaddDept.foccode2.value);
		//alert(document.frmaddDept.foccode3.value);
	}
	
	
	//cnt=0;
	if(cnt > 0)
	{
		return true;
	}
	else
	{
		alert("Select Sample(s) No. To Update");
		return false;
	}

}
function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}
function searchlotname(searchval)
{
	//if(searchval.length==7)
	searchUser(searchval,"searchresult","lotserch",'','','','','','','','','','');
}

function openmoistdata(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_moistdatavfy.php?tid='+tid,'WelCome','top=10,left=180,width=820,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function openppdata(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_ppdatavfy.php?tid='+tid,'WelCome','top=10,left=180,width=820,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function opengermpdata(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_germpdatavfy.php?tid='+tid,'WelCome','top=10,left=180,width=820,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - QC Data Verification and Result Update</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="flagcode" value="<?php echo $oflagcode;?>" />
	  <input type="hidden" name="foccode" value="<?php echo $ofoccode;?>" />
	  <input type="hidden" name="foccode1" value="<?php echo $ofoccode1;?>" />
	  <input type="hidden" name="foccode2" value="<?php echo $ofoccode2;?>" />
	  <input type="hidden" name="foccode3" value="<?php echo $ofoccode3;?>" />
	  <input type="hidden" name="foccode4" value="<?php echo $ofoccode4;?>" />
	  
	   <input type="hidden" name="eurl" value="<?php echo $eurl;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="0" width="943" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="center" class="tblheading">QC Data Verification and Result Pending List</td>
  <!-- <td width="171" align="left" class="tblheading">&nbsp;Search Lot No.&nbsp;<input type="text" class="smalltbltext" size="7" maxlength="7" name="lsearch" id="lsearch" onkeyup="searchlotname(this.value)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="DP12345" />&nbsp;</td>
 <td width="98" align="right" class="tblheading"><a href="home_qcdata_filter.php">Search Options</a>&nbsp;&nbsp;&nbsp;</td>-->
</tr>
<tr height="3"></tr>
</table>
<div id="searchresult" name="searchresult">



<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="19" height="22"align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="84" align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
	<td width="115" align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td width="101" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">Qty</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">GKD</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="4">SGT Data</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">FGT Data</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Germ. %</td>
	<td width="50" align="center" valign="middle" class="smalltblheading" rowspan="2">LE</td>
	<td width="80" align="center" valign="middle" class="smalltblheading" rowspan="2">QC Result</td>
	<td width="60" align="center" valign="middle" class="smalltblheading" rowspan="2">QC Doc Ref No.</td>
</tr>
<tr class="tblsubtitle" height="20">
<td width="39" align="center" valign="middle" class="smalltblheading">Normal</td>
<td width="54" align="center" valign="middle" class="smalltblheading">Abnormal</td>
<td align="center" valign="middle" class="smalltblheading">Hard / FUG</td>
<td align="center" valign="middle" class="smalltblheading">Dead</td>
<td align="center" valign="middle" class="smalltblheading">Normal</td>
<td align="center" valign="middle" class="smalltblheading">Abnormal</td>
<td align="center" valign="middle" class="smalltblheading">Dead</td>
<td align="center" valign="middle" class="smalltblheading">Select</td>
<td align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
$srno=1; $sel=1;
$xflagcode=explode(",",$oflagcode);
$xfoccode=explode(",",$ofoccode);
$xfoccode1=explode(",",$ofoccode1);
$xfoccode2=explode(",",$ofoccode2);
$xfoccode3=explode(",",$ofoccode3);
$xfoccode4=explode(",",$ofoccode4);

for($i=0; $i<count($xflagcode);$i++)
{
$flagcode=$xflagcode[$i];

$sql_arr_home=mysqli_query($link,"select distinct sampleno from tbl_qctest where bflg=1 and tid IN ($flagcode) and spdate IS NOT NULL and spdate!='0000-00-00' and qcflg=0 and state!='T' order by  spdate ASC, tid desc ") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{
while($row_arr_home24=mysqli_fetch_array($sql_arr_home))
{
	
	$flg=0;
	
	$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where bflg=1 and tid IN ($flagcode) and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
	
	$sql_arr_home24=mysqli_query($link,"select * from tbl_qctest where bflg=1 and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' and tid='".$row_arr_home2[0]."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home24))
	{
	$moistflg=0; $ppflg=0; $germflg=0; $resultflg=0; $moistpercentages=''; $ppresult='';
	
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	
	$tp1=$row_param['code'];
	$germper=''; $qcg_sgtnormalavg=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfugavg=0; $qcg_sgtdeadavg=0; $qcg_vignormalavg=0; $qcg_vigabnormalavg=0; $qcg_vigdeadavg=0; $qcg_testtype=''; $qcg_docsrefno=''; $qcg_setupdt='';
	$sampno=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$row_arr_home24['sampleno']);
	if($row_arr_home['state']!="G")
	{
		
		$sql_gdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' ") or die(mysqli_error($link));
		while($row_gdata=mysqli_fetch_array($sql_gdata))
		{
			if($row_gdata['qcg_germpflg']==1)
				{$germflg=1; }
			if($row_gdata['qcg_germpflg']==2)
				{$germflg=2;}
			if($row_gdata['qcg_germpflg']==0)
				{$germflg=3;}
			$qcg_sgtnormalavg=$row_gdata['qcg_sgtnormalavg']; 
			$qcg_sgtabnormalavg=$row_gdata['qcg_sgtabnormalavg']; 
			$qcg_sgthardfugavg=$row_gdata['qcg_sgthardfugavg']; 
			$qcg_sgtdeadavg=$row_gdata['qcg_sgtdeadavg']; 
			$qcg_vignormalavg=$row_gdata['qcg_vignormalavg']; 
			$qcg_vigabnormalavg=$row_gdata['qcg_vigabnormalavg']; 
			$qcg_vigdeadavg=$row_gdata['qcg_vigdeadavg']; 
			$qcg_testtype=$row_gdata['qcg_testtype']; 
			$qcg_docsrefno=$row_gdata['qcg_docsrefno'];	
			$qcg_setupdt=$row_gdata['qcg_setupdt'];		
		}
		
		if($moistflg==1 && $ppflg==1 && $germflg>0) {$resultflg=1;}
	}
	else
	{
		$sql_gdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' ") or die(mysqli_error($link));
		while($row_gdata=mysqli_fetch_array($sql_gdata))
		{
			if($row_gdata['qcg_germpflg']==1)
				{$germflg=1; }
			if($row_gdata['qcg_germpflg']==2)
				{$germflg=2;}
			if($row_gdata['qcg_germpflg']==0)
				{$germflg=3;}
			
			$qcg_sgtnormalavg=$row_gdata['qcg_sgtnormalavg']; 
			$qcg_sgtabnormalavg=$row_gdata['qcg_sgtabnormalavg']; 
			$qcg_sgthardfugavg=$row_gdata['qcg_sgthardfugavg']; 
			$qcg_sgtdeadavg=$row_gdata['qcg_sgtdeadavg']; 
			$qcg_vignormalavg=$row_gdata['qcg_vignormalavg']; 
			$qcg_vigabnormalavg=$row_gdata['qcg_vigabnormalavg']; 
			$qcg_vigdeadavg=$row_gdata['qcg_vigdeadavg']; 
			$qcg_testtype=$row_gdata['qcg_testtype']; 
			$qcg_docsrefno=$row_gdata['qcg_docsrefno'];	
			$qcg_setupdt=$row_gdata['qcg_setupdt'];	
				
		}
		if($germflg>0) {$resultflg=1;}
	}
	$setupdt=='';
	if($qcg_setupdt!='' && $qcg_setupdt!='0000-00-00' && $qcg_setupdt!='--' && $qcg_setupdt!='- -')
	{
		$setupdt=$qcg_setupdt;
	}	
	//echo $moistflg."  -  ".$ppflg."  -  ".$germflg."<br/>";
	if($moistflg>0 || $ppflg>0 || $germflg>0) 
	{
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno="";  $bags=0; $qty=0; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub1['qcstatus'];
		}
		else
		{
		$qc=$row_tbl_sub1['qcstatus'];
		}
	
		$trdate=$row_arr_home['srdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;	
		
		$trdate1=$row_arr_home['spdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
		
	
		$lrole=$row_arr_home['arr_role'];
		$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
		$row3=mysqli_fetch_array($quer3);
		
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
		$rowvv=mysqli_fetch_array($quer3);
		$tt=$rowvv['popularname'];
		$leduration=$rowvv['leduration'];
		$tot=mysqli_num_rows($quer3);	
		if($tot==0)
		{
		 $vv=$row_arr_home['variety'];
		}
		else
		{
		  $vv=$tt;
		}
		  
		$stage=$row_tbl_sub1['trstage'];
		$pp=$row_tbl_sub1['state'];	
		$lotn=$row_tbl_sub1['lotno'];
			 
		$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2="";
		if($stage!="Pack")
		{
			$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."'");
			$tt_sub=mysqli_num_rows($sql_qc_sub);
			while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
			{
			
				$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
				$tt=mysqli_num_rows($sql_qc);
				while($row_qc=mysqli_fetch_array($sql_qc))
				{
				
					$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
					$zz=mysqli_num_rows($sql_month);
					while ($row_month=mysqli_fetch_array($sql_month))
					{
					
					/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];*/
					
					$slups=$row_month['lotldg_balbags'];
					$slqty=$row_month['lotldg_balqty'];
					
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					
					$nob=$nob+$slups;
					$qty=$qty+$slqty;
					}
				}
			}
		}
		else
		{
			$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."'");
			$tt_sub=mysqli_num_rows($sql_qc_sub);
			while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
			{
			
				$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."' and subbinid='".$row_qc_sub['subbinid']."'");
				$tt=mysqli_num_rows($sql_qc);
				while($row_qc=mysqli_fetch_array($sql_qc))
				{
				
					$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and balqty > 0")or die(mysqli_error($link));
					$zz=mysqli_num_rows($sql_month);
					while ($row_month=mysqli_fetch_array($sql_month))
					{
					
					/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];*/
					
					//$slups=$row_month['lotldg_balbags'];
					$slqty=$row_month['balqty'];
					
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					
					$nob=$nob+$slups;
					$qty=$qty+$slqty;
					}
				}
			}
		}
	
		$aq=explode(".",$nob);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}
		
		$an=explode(".",$qty);
		if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
	
	
			
	
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
		$row31=mysqli_fetch_array($quer3);
	
		$tdate=$row_arr_home['testdate'];
		if($qc=="UT" && $tdate!='NULL')
		$flg++;
	}
if($germflg==2)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $setupdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode1[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode2[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode3[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode4[$i]?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $setupdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode1[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode2[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode3[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode4[$i]?></td>
</tr>
<?php
}
$srno=$srno+1;$cont++;
}
}
}
}
}
}
?><input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="950">
    <tr >
      <td align="right" colspan="3"><a href="home_qcdatamgp.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="return mySubmit();" src="../images/submit.gif" alt="Submit Value" border="0"/>
	  </td>
    </tr>
  </table>
</div>
		  

</td>
<td width="30"></td>
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
