<?php
//ob_start(); 
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

	
	if(isset($_REQUEST['cropid']))
	{
	 $a = $_REQUEST['cropid'];	 
	}
	if(isset($_REQUEST['eurl']))
	{
	$eurl = $_REQUEST['eurl'];	 
	}
	$newLink = substr($_SERVER['QUERY_STRING'],0);  
	$zz=split("eurl=",$newLink);
	$eurl=$zz[1];
	
	if(isset($_POST['frm_action'])=='submit')
	{  
	
	$crop= $_POST['txtcrop'];	
	$variety= $_POST['txtvariety'];
	$vchk = $_POST['txtpp'];	
	$moist = $_POST['txtmoist'];	
	$gemp= $_POST['txtgemp'];	
	$samp= $_POST['txtsamp'];
	$result= $_POST['result'];
	$txtvariety = $_POST['txtvariety'];	 
    $e = $_POST['sdate'];	 
	$btnval=$_POST['btnval'];
	$lotn=$_POST['txtstfp2'];	
	$txtrefno=$_POST['txtrefno'];	 
	
	$tdate=$e;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;
	
	$xamp=str_split($samp);
	$plcode=$xamp[0];
	$yrcd=$xamp[1];
	$smpcode=$xamp[2].$xamp[3].$xamp[4].$xamp[5].$xamp[6].$xamp[7];
		
if($btnval==0)
{
	/*$sqlck=mysqli_query($link,"select distinct sampleno from tbl_qctest where sampleno='$smpcode' and yearid='$yrcd' order by tid desc") or die(mysqli_error($link));
	while($rowck=mysqli_fetch_array($sqlck))
	{
		$sqlck2=mysqli_query($link,"select max(tid) from tbl_qctest where sampleno='".$rowck['sampleno']."' and yearid='$yrcd' order by tid desc") or die(mysqli_error($link));
		$rowck2=mysqli_fetch_array($sqlck2);*/
		
	$sql_ck=mysqli_query($link,"select * from tbl_qctest where tid='".$a."' order by tid desc") or die(mysqli_error($link));
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
					
				$sql_sub_sub122="update tbl_qctest set qcflg=1 where tid='$a'";
				$qq22=mysqli_query($link,$sql_sub_sub122) or die(mysqli_error($link));
			}
		}
		else
		{ 
			if($result=="OK" || $result=="Fail")
			{
				$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', testdate='$tdate', qcflg=1, qcrefno='$txtrefno' where tid='$a' and sampleno='$osamp22' and yearid='$yearid22'";
				$sql_sub_sub1222="update tbl_qctest set qcflg=1 where sampleno='$osamp22' and yearid='$yearid22'";
				$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
			}
			else if($result=="RT")
			{
				$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', qcstatus='$result', testdate='$tdate', qcflg=0, gemp='$gemp', qcrefno='$txtrefno' where tid='$a' and  sampleno='$osamp22' and yearid='$yearid22'";
			}
			else
			{
				$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', qcflg=0, testdate='$tdate', qcrefno='$txtrefno' where tid='$a' and sampleno='$osamp22' and yearid='$yearid22'";
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
	//}	//exit;
}
else if($btnval!=2)
{
	$sql_chk=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotn'") or die(mysqli_error($link));
	$tot_chk=mysqli_num_rows($sql_chk);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotn' order by tid desc limit 1,1") or die(mysqli_error($link));
	$tot_tbl=mysqli_num_rows($sql_tbl);
	if($tot_tbl > 0 && $tot_chk > 1)
	{
		$row_tbl=mysqli_fetch_array($sql_tbl);
		$qcresult=$row_tbl['qcstatus'];
		if($qcresult=="")$qcresult="UT";
		$gempo=$row_tbl['gemp'];
		$tdateo=$row_tbl['testdate'];
		$moisto=$row_tbl['moist'];
		$sql_sub_sub12="update tbl_qctest set qcstatus='Abort', testdate='$tdate',qcflg=1 where tid='$a'";
		$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
		
		$sql_sub="update tbl_lot_ldg set lotldg_qc='$qcresult', lotldg_gemp='$gempo', lotldg_moisture='$moisto', lotldg_qctestdate='$tdateo' where orlot='$oldlotn'";
		$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='$qcresult', lotldg_gemp='$gempo', lotldg_moisture='$moisto', lotldg_qctestdate='$tdateo' where orlot='$oldlotn'";
		$sql_sub3="update tbl_salesrv_sub set salesrs_qc='$qcresult', salesrs_dot='$tdateo' where salesrs_orlot='$oldlotn' and (salesrs_qc='UT' OR salesrs_qc='RT')";	
		$sql_sub4="update tbl_revalidate set rv_qc='$qcresult', rv_dot='$tdateo' where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";
		$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
		$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
		$qq3=mysqli_query($link,$sql_sub3) or die(mysqli_error($link));
		$qq4=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
		
	}
	else
	{
		$sql_sub_sub12="update tbl_qctest set qcstatus='Abort', testdate='$tdate',qcflg=1 where tid='$a'";
		$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
		
		$sql_sub="update tbl_lot_ldg set lotldg_qc='NUT' where orlot='$oldlotn'";
		$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
		$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='NUT' where orlot='$oldlotn'";
		$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	}
	
	$arrival_id21=0;
	$sql_tbl21=mysqli_query($link,"select * from tbl_qcgen1 where arr_role='".$logid."' and lotno='".$lotn."'") or die(mysqli_error($link));
	while($row_tbl21=mysqli_fetch_array($sql_tbl21))
	{
		$arrival_id21=$row_tbl21['arrival_id'];	
		$s_sub21="delete from tbl_qcgen1 where arrival_id='".$row_tbl21['arrsub_id']."'";
		mysqli_query($link,$s_sub21) or die(mysqli_error($link));
	}
	$sql_tbl22=mysqli_query($link,"select * from tbl_qcgen1 where arr_role='".$logid."' and arrival_id='".$arrival_id21."'") or die(mysqli_error($link));
	if($tot_tbl22=mysqli_fetch_array($sql_tbl22) == 0)
	{
		$s_sub22="delete from tbl_qcgen where arr_role='".$logid."' and arrival_id='".$arrival_id21."'";
		mysqli_query($link,$s_sub22) or die(mysqli_error($link));	
	}		
}
else
{
	echo "<script>window.location='edit_update.php?cropid=$a&eurl=$eurl'</script>";	
}		//exit;
	echo "<script>window.location='$eurl'</script>";	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qty- Transaction - Qc Result Updation </title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="staddresschk.js"></script>
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
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function moischk(mosval)
{
		if(document.frmaddDepartment.txtpp.value=="")
		{
			alert("Please Select PP");
			document.frmaddDepartment.txtmoist.value="";
		}
		if(parseFloat(mosval)>99.9)
		{
			alert("Invalid Moisture % value");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtmoist.focus();
		}
}

/*function moischk1(mosval1)
{
		if(document.frmaddDepartment.txtgemp.value < document.frmaddDepartment.sig.value)
		{
			alert("Germination is less than SIG");
			document.frmaddDepartment.sig.value="";
		}
		}*/
function gemp(val)
{
		/*if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Please Enter Moisture %");
			document.frmaddDepartment.txtgemp.value="";
		}
		
		if(document.frmaddDepartment.txtmoist.value < 0)
		{
			alert("Please Valid Moisture %");
			document.frmaddDepartment.txtgemp.value="";
		}*/
		
		if(parseFloat(val)>100)
		{
			alert("Invalid Germination %");
			document.frmaddDepartment.txtgemp.value="";
			document.frmaddDepartment.txtgemp.focus();
		}
		
		if(parseFloat(document.frmaddDepartment.txtgemp.value) < parseFloat(document.frmaddDepartment.sig.value))
		{
			alert("Germination % is less than SIG %");
			document.frmaddDepartment.txtgemp.focus();
			//document.frmaddDepartment.txtgemp.value="";
			return false;
		}
}

function mySubmit()
{ 
	if(document.frmaddDepartment.btnval.value==0)
	{

		if(document.frmaddDepartment.txtgemp.value=="")
		{
			alert("Please Enter Germination %.");
			document.frmaddDepartment.txtgemp.focus();
			return false;
		}
		if(document.frmaddDepartment.txtpp.value=="")
		{
			alert("Please Select Physical Purity");
			document.frmaddDepartment.txtpp.focus();
			return false;
		}
		if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Please Enter Moisture %.");
			document.frmaddDepartment.txtmoist.focus();
			return false;
		}
		if(document.frmaddDepartment.result.value=="")
		{
			alert("Please Select Result.");
			document.frmaddDepartment.result.focus();
			return false;
		}
		if(parseFloat(document.frmaddDepartment.txtgemp.value) < parseFloat(document.frmaddDepartment.sig.value) && document.frmaddDepartment.result.value=="OK")
		{
			alert("ALERT:\n\nGermination %is less than SIG %");
			document.frmaddDepartment.result.value="";
			return false;
		}
		if(document.frmaddDepartment.txtrefno.value=="")
		{
			alert("Please Enter QC Doc Ref No.");
			document.frmaddDepartment.txtrefno.focus();
			return false;
		}
		
	}		
	if(document.frmaddDepartment.btnval.value==2)
	{
	return false;
	}
	else
	{
		if(document.frmaddDepartment.result.value=="Fail")
		{
			if(document.frmaddDepartment.mflg.value > 0)
			{
				if(confirm('You are selecting \nQC Result: FAIL \nLot Number: '+document.frmaddDepartment.txtstfp2.value+' is under Blending\nDo you wish to continue?')==true)
				{
				return true;
				}
			}
			else if(confirm('You are selecting \nQC Result: FAIL \nLot Number: '+document.frmaddDepartment.txtstfp2.value+'\nDo you wish to continue?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
		}
		else if(document.frmaddDepartment.result.value=="RT")
		{
		document.frmaddDepartment.txtgemp.value=="";
		document.frmaddDepartment.txtpp.value=="";
		document.frmaddDepartment.txtmoist.value=="";

			if(confirm('You  are selecting \nQC Result: RETEST \nLot Number: '+document.frmaddDepartment.txtstfp2.value+'\nIf QC Result Retest is selected then Values cannot be filled\nDo you wish to continue?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
		}
		else
		{
			if(confirm('You  are selecting \nQC Result: '+document.frmaddDepartment.result.value+'\nLot Number: '+document.frmaddDepartment.txtstfp2.value+'\nDo you wish to continue?')==true)
			return true;
			else
			return false;
		}
	}
}

function smpabort(btval)
{
	if(!confirm("Do you wish to Abort this QC Request?")==true)
	{
		document.frmaddDepartment.btnval.value=2;
		return false;
	}
	else
	{
		document.frmaddDepartment.btnval.value=btval;
		return true;
	}
}	
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
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
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp; QC Transaction- QC Result Updation </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="btnval" value="0" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">QC Result Updation </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php
 $quer3=mysqli_query($link,"SELECT * FROM tbl_qctest where tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $tt=mysqli_num_rows($quer3);
 $lotn=$noticia['oldlot'];
 $lotnn=$noticia['lotno'];

$sql_month=mysqli_query($link,"select * from tbl_qctest where tid='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
	$crop=$row31['cropname'];	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$tt=$rowvv['popularname'];
	 $tot=mysqli_num_rows($quer3);	
	 $qc1=$row['sampleno'];
	 $vtyp="OP";
	 if($tot==0)
	 {
	 $vv=$row['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  $vtyp=$row['vt'];
	 }
	 
	 $stage=$noticia['trstage'];

$lotn=$row['lotno'];
	 
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2=""; $mflg=0;
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

if($row_month['lotldg_mergerflg']==1)$mflg++;
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
		
		
$sap=$row['sampleno'];
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>
 <tr class="Dark" height="30">
<!--<td width="205" align="right" valign="middle" class="tblheading">Transaction id    &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1="TAS".$code."/".$yearid_id."/".$lgnid;?>&nbsp;</td>-->

<td width="148" align="right" valign="middle" class="tblheading">&nbsp;Date  &nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Sample No.  &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtsamp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $tp1?><?php echo $row['yearid']?><?php echo sprintf("%000006d",$qc1);?>"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Lot No.  &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="txtstfp2" type="text" size="20" class="tbltext" tabindex=""  readonly="true"  maxlength="20" style="background-color:#CCCCCC" value="<?php echo $lotn?>"/>  &nbsp;<input type="hidden" name="mflg" value="<?php $mflg;?>" /></td>
 </tr>
 
 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td width="209" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtcrop" type="text" size="10" class="tbltext" tabindex=""   maxlength="5"  readonly="true"style="background-color:#CCCCCC" value="<?php echo $crop;?>" id="itm"/>&nbsp;</td>
<td width="93" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td width="290" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex="" readonly="true" maxlength="20"style="background-color:#CCCCCC" value="<?php echo $vv;?>"/>&nbsp;&nbsp;<?php echo $vtyp;?></td>
           </tr>
		   
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td width="209" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtcrop" type="text" size="10" class="tbltext" tabindex=""   readonly="true" maxlength="5" style="background-color:#CCCCCC" value="<?php echo $ac;?>" id="itm"/>&nbsp;</td>
<td width="93" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
    <td width="290" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex="" readonly="true" maxlength="20"style="background-color:#CCCCCC" value="<?php echo $acn;?>"/>&nbsp;</td>
           </tr>
		   
		   <tr class="Light" height="30">
<?php 

 $crop=$row31['cropname'];
  $quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropname='".$crop."'"); 
 $noticia = mysqli_fetch_array($quer3);
 $pp=mysqli_num_rows($quer3);
 if($vtyp=="OP")
 {
   	$sig=$noticia['sig'];
 }
 else
 {
 	$sig=$noticia['sig1'];
 }
  ?>
<td align="right"  valign="middle" class="tblheading">SIG&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="sig" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $sig;?>" />&nbsp;%</td>
<td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="txtgemp" type="text" size="1" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);"/>%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  >&nbsp;<select class="tbltext" name="txtpp" style="width:150px;">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
           </tr>
		   <tr class="Light" height="30">


<td align="right"  valign="middle" class="tblheading" >Result&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="result" style="width:100px;"  >
    <option value="" selected>--Select--</option>
  	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
		  <option value="RT" >Retest</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">QC Doc Ref No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtrefno" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</tr>
  </table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="Center"><a href="<?php echo $eurl;?>" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="smpabort('1');" src="../images/abort.gif" alt="Abort Value" border="0"/>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
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

 
